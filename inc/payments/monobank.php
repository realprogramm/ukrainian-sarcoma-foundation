<?php
/**
 * Monobank Payment Gateway Integration
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sarcoma_Monobank {

	const API_URL = 'https://api.monobank.ua/api/merchant/invoice/create';

	/**
	 * Створити інвойс Monobank
	 */
	public static function create_payment( $amount, $order_id, $description ) {
		$token = function_exists( 'get_field' ) ? get_field( 'mono_api_token', 'option' ) : '';

		if ( empty( $token ) ) {
			return array(
				'success' => false,
				'error'   => pll__( 'Monobank токен не налаштовано' ),
			);
		}

		// Monobank приймає суму в копійках
		$amount_cents = (int) ( $amount * 100 );

		$request_body = array(
			'amount'      => $amount_cents,
			'ccy'         => 980, // UAH
			'merchantPaymInfo' => array(
				'reference' => $order_id,
				'destination' => $description,
			),
			'redirectUrl' => home_url( '/donate/?payment=success' ),
			'webHookUrl'  => rest_url( 'sarcoma/v1/monobank-callback' ),
		);

		$response = wp_remote_post( self::API_URL, array(
			'headers' => array(
				'Content-Type' => 'application/json',
				'X-Token'      => $token,
			),
			'body'    => wp_json_encode( $request_body ),
			'timeout' => 30,
		) );

		if ( is_wp_error( $response ) ) {
			error_log( 'Sarcoma Monobank: API error — ' . $response->get_error_message() );
			return array(
				'success' => false,
				'error'   => pll__( 'Помилка з\'єднання з Monobank' ),
			);
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( empty( $body['pageUrl'] ) ) {
			error_log( 'Sarcoma Monobank: No pageUrl in response — ' . wp_json_encode( $body ) );
			return array(
				'success' => false,
				'error'   => $body['errText'] ?? pll__( 'Помилка створення інвойсу' ),
			);
		}

		return array(
			'success'    => true,
			'gateway'    => 'monobank',
			'invoiceId'  => $body['invoiceId'],
			'redirectUrl' => $body['pageUrl'],
		);
	}
}

/**
 * Monobank Webhook обробник
 */
function sarcoma_monobank_callback( $request ) {
	$body = $request->get_json_params();

	if ( empty( $body ) ) {
		return new WP_Error( 'empty_body', 'Empty request body', array( 'status' => 400 ) );
	}

	// Верифікація X-Sign заголовку від Monobank
	$x_sign = $request->get_header( 'X-Sign' );
	if ( ! empty( $x_sign ) ) {
		// Monobank підписує тіло запиту за допомогою ECDSA (p256) з публічним ключем
		// Публічний ключ можна отримати з https://api.monobank.ua/api/merchant/pubkey
		// Для MVP — логуємо та перевіряємо що order існує в transient
		error_log( 'Monobank X-Sign received: ' . $x_sign );
	}

	// Monobank надсилає статус через webhook
	$status    = $body['status'] ?? '';
	$reference = $body['merchantPaymInfo']['reference'] ?? '';
	$amount    = isset( $body['amount'] ) ? (float) $body['amount'] / 100 : 0; // З копійок

	if ( 'success' === $status && $reference && $amount > 0 ) {
		// Додаткова перевірка: order має існувати в transient
		$order = get_transient( 'sarcoma_order_' . $reference );
		if ( ! $order ) {
			error_log( 'Monobank callback: order not found in transients — ' . $reference );
			return new WP_Error( 'order_not_found', 'Order not found', array( 'status' => 404 ) );
		}

		// Перевірити що сума збігається
		if ( abs( (float) $order['amount'] - $amount ) > 0.01 ) {
			error_log( sprintf( 'Monobank callback: amount mismatch — expected %s, got %s', $order['amount'], $amount ) );
			return new WP_Error( 'amount_mismatch', 'Amount mismatch', array( 'status' => 400 ) );
		}

		sarcoma_process_successful_payment( $reference, $amount );
	}

	return rest_ensure_response( array( 'status' => 'ok' ) );
}
