<?php
/**
 * Template Part: Прогрес збору коштів
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$campaign_title = function_exists( 'get_field' ) ? get_field( 'campaign_title', 'option' ) : '';
$target         = function_exists( 'get_field' ) ? get_field( 'campaign_target', 'option' ) : 1000000;
$collected      = function_exists( 'get_field' ) ? get_field( 'campaign_collected', 'option' ) : 0;

if ( empty( $campaign_title ) ) {
	$campaign_title = pll__( 'Загальний збір коштів' );
} else {
	$campaign_title = pll__( $campaign_title );
}
if ( empty( $target ) ) {
	$target = 1000000;
}

$percent = sarcoma_get_progress_percent( $collected, $target );
?>

<section class="section fundraising">
	<div class="container">
		<h2 class="section__title"><?php pll_esc_html_e( 'Прогрес збору коштів' ); ?></h2>

		<div class="fundraising-card">
			<h3 class="fundraising-card__title"><?php echo esc_html( $campaign_title ); ?></h3>

			<div class="progress-bar">
				<div class="progress-bar__fill" style="width: 0%;" data-width="<?php echo esc_attr( $percent ); ?>%">
					<span class="progress-bar__percent"><?php echo esc_html( $percent ); ?>%</span>
				</div>
			</div>

			<div class="fundraising-card__amounts">
				<div class="amount-block">
					<span class="amount-block__value"><?php echo esc_html( sarcoma_format_amount( $collected ) ); ?></span>
					<span class="amount-block__label"><?php pll_esc_html_e( 'Зібрано' ); ?></span>
				</div>
				<div class="amount-block">
					<span class="amount-block__value"><?php echo esc_html( sarcoma_format_amount( $target ) ); ?></span>
					<span class="amount-block__label"><?php pll_esc_html_e( 'Мета' ); ?></span>
				</div>
			</div>

			<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary">
				<?php pll_esc_html_e( 'Підтримати' ); ?>
			</a>
		</div>
	</div>
</section>
