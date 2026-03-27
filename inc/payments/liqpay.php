<?php
/**
 * LiqPay Payment Gateway Integration
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sarcoma_LiqPay {

	/**
	 * Створити платіж LiqPay
	 */
	public static function create_payment( $amount, $order_id, $description, $type = 'one-time' ) {
		$public_key  = function_exists( 'get_field' ) ? get_field( 'liqpay_public_key', 'option' ) : '';
		$private_key = function_exists( 'get_field' ) ? get_field( 'liqpay_private_key', 'option' ) : '';
		$sandbox     = function_exists( 'get_field' ) ? get_field( 'payment_sandbox', 'option' ) : true;

		if ( empty( $public_key ) || empty( $private_key ) ) {
			return array(
				'success' => false,
				'error'   => pll__( 'LiqPay ключі не налаштовані' ),
			);
		}

		$action = 'subscribe' === $type ? 'subscribe' : 'pay';

		$params = array(
			'public_key'   => $public_key,
			'version'      => '3',
			'action'       => $action,
			'amount'       => $amount,
			'currency'     => 'UAH',
			'description'  => $description,
			'order_id'     => $order_id,
			'result_url'   => home_url( '/donate/?payment=success' ),
			'server_url'   => rest_url( 'sarcoma/v1/liqpay-callback' ),
		);

		if ( $sandbox ) {
			$params['sandbox'] = 1;
		}

		if ( 'subscribe' === $type ) {
			$params['subscribe_date_start']   = gmdate( 'Y-m-d H:i:s' );
			$params['subscribe_periodicity']  = 'month';
		}

		$data      = base64_encode( wp_json_encode( $params ) );
		$signature = base64_encode( sha1( $private_key . $data . $private_key, true ) );

		return array(
			'success'   => true,
			'gateway'   => 'liqpay',
			'form_data' => array(
				'action'    => 'https://www.liqpay.ua/api/3/checkout',
				'method'    => 'POST',
				'data'      => $data,
				'signature' => $signature,
			),
		);
	}
}

/**
 * LiqPay Callback обробник
 */
function sarcoma_liqpay_callback( $request ) {
	$data      = $request->get_param( 'data' );
	$signature = $request->get_param( 'signature' );

	if ( empty( $data ) || empty( $signature ) ) {
		return new WP_Error( 'missing_data', 'Missing data or signature', array( 'status' => 400 ) );
	}

	$private_key = function_exists( 'get_field' ) ? get_field( 'liqpay_private_key', 'option' ) : '';

	// Перевірка підпису
	$expected_signature = base64_encode( sha1( $private_key . $data . $private_key, true ) );
	if ( $signature !== $expected_signature ) {
		error_log( 'Sarcoma LiqPay: Invalid signature' );
		return new WP_Error( 'invalid_signature', 'Invalid signature', array( 'status' => 403 ) );
	}

	$decoded = json_decode( base64_decode( $data ), true );

	if ( ! $decoded ) {
		return new WP_Error( 'invalid_data', 'Cannot decode data', array( 'status' => 400 ) );
	}

	// Успішний платіж
	if ( isset( $decoded['status'] ) && in_array( $decoded['status'], array( 'success', 'sandbox' ), true ) ) {
		$order_id = sanitize_text_field( $decoded['order_id'] );
		$amount   = (float) $decoded['amount'];

		sarcoma_process_successful_payment( $order_id, $amount );
	}

	return rest_ensure_response( array( 'status' => 'ok' ) );
}
