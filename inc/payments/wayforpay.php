<?php
/**
 * WayForPay Payment Gateway Integration
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sarcoma_WayForPay {

	/**
	 * Створити платіж WayForPay
	 */
	public static function create_payment( $amount, $order_id, $description ) {
		$merchant_account = function_exists( 'get_field' ) ? get_field( 'wfp_merchant_account', 'option' ) : '';
		$secret_key       = function_exists( 'get_field' ) ? get_field( 'wfp_secret_key', 'option' ) : '';

		if ( empty( $merchant_account ) || empty( $secret_key ) ) {
			return array(
				'success' => false,
				'error'   => pll__( 'WayForPay ключі не налаштовані' ),
			);
		}

		$order_date   = time();
		$product_name = array( $description );
		$product_count = array( 1 );
		$product_price = array( $amount );

		// Формування підпису
		$sign_string = implode( ';', array(
			$merchant_account,
			home_url(),
			$order_id,
			$order_date,
			$amount,
			'UAH',
			$description,
			1,
			$amount,
		) );

		$signature = hash_hmac( 'md5', $sign_string, $secret_key );

		return array(
			'success'   => true,
			'gateway'   => 'wayforpay',
			'form_data' => array(
				'action'           => 'https://secure.wayforpay.com/pay',
				'method'           => 'POST',
				'merchantAccount'  => $merchant_account,
				'merchantDomainName' => home_url(),
				'orderReference'   => $order_id,
				'orderDate'        => $order_date,
				'amount'           => $amount,
				'currency'         => 'UAH',
				'productName'      => $product_name,
				'productCount'     => $product_count,
				'productPrice'     => $product_price,
				'merchantSignature' => $signature,
				'returnUrl'        => home_url( '/donate/?payment=success' ),
				'serviceUrl'       => rest_url( 'sarcoma/v1/wayforpay-callback' ),
			),
		);
	}
}

/**
 * WayForPay Callback обробник
 */
function sarcoma_wayforpay_callback( $request ) {
	$body = $request->get_json_params();

	if ( empty( $body ) ) {
		$body = $request->get_body_params();
	}

	if ( empty( $body['merchantSignature'] ) ) {
		return new WP_Error( 'missing_signature', 'Missing signature', array( 'status' => 400 ) );
	}

	$secret_key = function_exists( 'get_field' ) ? get_field( 'wfp_secret_key', 'option' ) : '';

	// Перевірка підпису відповіді
	$sign_fields = array(
		$body['merchantAccount'] ?? '',
		$body['orderReference'] ?? '',
		$body['amount'] ?? '',
		$body['currency'] ?? '',
		$body['authCode'] ?? '',
		$body['cardPan'] ?? '',
		$body['transactionStatus'] ?? '',
		$body['reasonCode'] ?? '',
	);

	$expected_signature = hash_hmac( 'md5', implode( ';', $sign_fields ), $secret_key );

	if ( $body['merchantSignature'] !== $expected_signature ) {
		error_log( 'Sarcoma WayForPay: Invalid signature' );
		return new WP_Error( 'invalid_signature', 'Invalid signature', array( 'status' => 403 ) );
	}

	// Успішний платіж
	if ( isset( $body['transactionStatus'] ) && 'Approved' === $body['transactionStatus'] ) {
		$order_id = sanitize_text_field( $body['orderReference'] );
		$amount   = (float) $body['amount'];

		sarcoma_process_successful_payment( $order_id, $amount );
	}

	// WayForPay очікує відповідь у такому форматі
	$response_time = time();
	return rest_ensure_response( array(
		'orderReference' => $body['orderReference'] ?? '',
		'status'         => 'accept',
		'time'           => $response_time,
		'signature'      => hash_hmac( 'md5', implode( ';', array(
			$body['orderReference'] ?? '',
			'accept',
			$response_time,
		) ), $secret_key ),
	) );
}
