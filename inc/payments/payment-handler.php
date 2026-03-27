<?php
/**
 * Payment Handler — центральний обробник платежів
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Підключення класів платіжних шлюзів
require_once __DIR__ . '/liqpay.php';
require_once __DIR__ . '/wayforpay.php';
require_once __DIR__ . '/monobank.php';

/**
 * Реєстрація REST API routes для callbacks
 */
function sarcoma_register_payment_routes() {
	// LiqPay callback
	register_rest_route( 'sarcoma/v1', '/liqpay-callback', array(
		'methods'             => 'POST',
		'callback'            => 'sarcoma_liqpay_callback',
		'permission_callback' => '__return_true',
	) );

	// WayForPay callback
	register_rest_route( 'sarcoma/v1', '/wayforpay-callback', array(
		'methods'             => 'POST',
		'callback'            => 'sarcoma_wayforpay_callback',
		'permission_callback' => '__return_true',
	) );

	// Monobank webhook
	register_rest_route( 'sarcoma/v1', '/monobank-callback', array(
		'methods'             => 'POST',
		'callback'            => 'sarcoma_monobank_callback',
		'permission_callback' => '__return_true',
	) );

	// AJAX: створити платіж (nonce перевіряється автоматично через X-WP-Nonce)
	register_rest_route( 'sarcoma/v1', '/create-payment', array(
		'methods'             => 'POST',
		'callback'            => 'sarcoma_create_payment',
		'permission_callback' => function () {
			// WP REST API автоматично перевіряє nonce через X-WP-Nonce заголовок
			return true;
		},
	) );
}
add_action( 'rest_api_init', 'sarcoma_register_payment_routes' );

/**
 * Створити платіж через обраний шлюз
 */
function sarcoma_create_payment( $request ) {
	$gateway = sanitize_text_field( $request->get_param( 'gateway' ) );
	$amount  = (float) $request->get_param( 'amount' );
	$case_id = (int) $request->get_param( 'case_id' );
	$type    = sanitize_text_field( $request->get_param( 'type' ) ); // one-time | subscribe

	if ( $amount <= 0 ) {
		return new WP_Error( 'invalid_amount', pll__( 'Вкажіть суму' ), array( 'status' => 400 ) );
	}

	$order_id = 'sarcoma_' . wp_generate_uuid4();

	$description = pll__( 'Благодійний внесок — Фонд Саркома' );
	if ( $case_id ) {
		$description = sprintf(
			/* translators: %s — case title */
			pll__( 'Допомога: %s' ),
			get_the_title( $case_id )
		);
	}

	$result = array();

	switch ( $gateway ) {
		case 'liqpay':
			$result = Sarcoma_LiqPay::create_payment( $amount, $order_id, $description, $type );
			break;
		case 'wayforpay':
			$result = Sarcoma_WayForPay::create_payment( $amount, $order_id, $description );
			break;
		case 'monobank':
			$result = Sarcoma_Monobank::create_payment( $amount, $order_id, $description );
			break;
		default:
			return new WP_Error( 'invalid_gateway', pll__( 'Невідомий платіжний шлюз' ), array( 'status' => 400 ) );
	}

	// Зберігаємо order в transient для callback
	set_transient( 'sarcoma_order_' . $order_id, array(
		'amount'  => $amount,
		'case_id' => $case_id,
		'gateway' => $gateway,
		'type'    => $type,
	), HOUR_IN_SECONDS );

	return rest_ensure_response( $result );
}

/**
 * Обробка успішного платежу (спільна логіка)
 */
function sarcoma_process_successful_payment( $order_id, $amount ) {
	$order = get_transient( 'sarcoma_order_' . $order_id );

	if ( ! $order ) {
		error_log( 'Sarcoma: Order not found — ' . $order_id );
		return false;
	}

	if ( ! function_exists( 'get_field' ) || ! function_exists( 'update_field' ) ) {
		return false;
	}

	// Оновити глобальний збір
	$current = (float) get_field( 'campaign_collected', 'option' );
	update_field( 'campaign_collected', $current + $amount, 'option' );

	// Оновити кейс
	if ( ! empty( $order['case_id'] ) ) {
		$case_collected = (float) get_field( 'collected_amount', $order['case_id'] );
		update_field( 'collected_amount', $case_collected + $amount, $order['case_id'] );
	}

	// Видалити transient
	delete_transient( 'sarcoma_order_' . $order_id );

	// Лог
	error_log( sprintf(
		'Sarcoma: Payment success — Order: %s, Amount: %s, Gateway: %s',
		$order_id,
		$amount,
		$order['gateway']
	) );

	return true;
}
