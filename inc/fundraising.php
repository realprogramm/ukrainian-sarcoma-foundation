<?php
/**
 * Fundraising Progress & Statistics
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode: Прогрес-бар збору коштів
 * [fundraising_progress]
 */
function sarcoma_fundraising_progress_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'post_id' => 0,
	), $atts, 'fundraising_progress' );

	if ( ! function_exists( 'get_field' ) ) {
		return '';
	}

	if ( $atts['post_id'] ) {
		// Прогрес конкретного кейсу
		$target    = get_field( 'target_amount', $atts['post_id'] );
		$collected = get_field( 'collected_amount', $atts['post_id'] );
		$title     = get_the_title( $atts['post_id'] );
	} else {
		// Глобальна кампанія
		$target    = get_field( 'campaign_target', 'option' );
		$collected = get_field( 'campaign_collected', 'option' );
		$title     = get_field( 'campaign_title', 'option' );
	}

	$percent = sarcoma_get_progress_percent( $collected, $target );

	ob_start();
	?>
	<div class="fundraising-progress" data-target="<?php echo esc_attr( $percent ); ?>">
		<?php if ( $title ) : ?>
			<h3 class="fundraising-progress__title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>
		<div class="progress-bar">
			<div class="progress-bar__fill" style="width: 0%;" data-width="<?php echo esc_attr( $percent ); ?>%">
				<span class="progress-bar__percent"><?php echo esc_html( $percent ); ?>%</span>
			</div>
		</div>
		<div class="fundraising-progress__amounts">
			<span class="amount-collected">
				<?php echo esc_html( sarcoma_format_amount( $collected ) ); ?>
			</span>
			<span class="amount-target">
				<?php
				/* translators: %s — target amount */
				printf( esc_html( pll__( 'з %s' ) ), esc_html( sarcoma_format_amount( $target ) ) );
				?>
			</span>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fundraising_progress', 'sarcoma_fundraising_progress_shortcode' );

/**
 * REST API endpoint для оновлення прогресу (після callback від платіжного шлюзу)
 */
function sarcoma_register_fundraising_routes() {
	register_rest_route( 'sarcoma/v1', '/update-progress', array(
		'methods'             => 'POST',
		'callback'            => 'sarcoma_update_progress_callback',
		'permission_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
	) );
}
add_action( 'rest_api_init', 'sarcoma_register_fundraising_routes' );

/**
 * Callback: оновити суму зібраних коштів
 */
function sarcoma_update_progress_callback( $request ) {
	$amount  = (float) $request->get_param( 'amount' );
	$case_id = (int) $request->get_param( 'case_id' );

	if ( $amount <= 0 ) {
		return new WP_Error( 'invalid_amount', pll__( 'Невірна сума' ), array( 'status' => 400 ) );
	}

	if ( ! function_exists( 'get_field' ) || ! function_exists( 'update_field' ) ) {
		return new WP_Error( 'acf_missing', pll__( 'ACF не знайдено' ), array( 'status' => 500 ) );
	}

	// Оновити глобальну кампанію
	$current_global = (float) get_field( 'campaign_collected', 'option' );
	update_field( 'campaign_collected', $current_global + $amount, 'option' );

	// Якщо вказано кейс — оновити і його
	if ( $case_id && 'case' === get_post_type( $case_id ) ) {
		$current_case = (float) get_field( 'collected_amount', $case_id );
		update_field( 'collected_amount', $current_case + $amount, $case_id );
	}

	return rest_ensure_response( array(
		'success'     => true,
		'new_global'  => $current_global + $amount,
		'new_case'    => isset( $current_case ) ? $current_case + $amount : null,
	) );
}
