<?php
/**
 * Template Part: Hero Block
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_title = function_exists( 'get_field' ) ? get_field( 'hero_title', 'option' ) : '';
$hero_text  = function_exists( 'get_field' ) ? get_field( 'hero_text', 'option' ) : '';
$hero_bg    = function_exists( 'get_field' ) ? get_field( 'hero_background', 'option' ) : '';

if ( empty( $hero_title ) ) {
	$hero_title = pll__( 'Фонд боротьби з саркомою' );
} else {
	$hero_title = pll__( $hero_title );
}
if ( empty( $hero_text ) ) {
	$hero_text = pll__( 'Ми допомагаємо хворим на саркому отримати якісну діагностику, лікування та шанс на нове життя. Кожен внесок рятує.' );
} else {
	$hero_text = pll__( $hero_text );
}
?>

<section class="hero" <?php if ( $hero_bg ) : ?>style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');"<?php endif; ?>>
	<div class="hero__overlay"></div>
	<div class="container">
		<div class="hero__content">
			<span class="hero__subtitle"><?php pll_esc_html_e( 'Допоможіть нам рятувати життя' ); ?></span>
			<h1 class="hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="hero__text"><?php echo esc_html( $hero_text ); ?></p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-lg">
					<?php pll_esc_html_e( 'Зробити внесок' ); ?>
				</a>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn-outline-white btn-lg">
					<?php pll_esc_html_e( 'Про фонд' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
