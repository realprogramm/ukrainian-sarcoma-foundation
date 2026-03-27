<?php
/**
 * Template Part: CTA — Регулярний донат
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="section cta-donate">
	<div class="container">
		<div class="cta-donate__inner">
			<h2 class="cta-donate__title"><?php pll_esc_html_e( 'Підтримуйте регулярно' ); ?></h2>
			<p class="cta-donate__text">
				<?php pll_esc_html_e( 'Щомісячний внесок — це стабільна підтримка, яка дозволяє фонду планувати допомогу та рятувати більше життів. Навіть невелика сума має значення.' ); ?>
			</p>
			<div class="cta-donate__actions">
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>?type=subscribe" class="btn btn-primary btn-lg">
					<?php pll_esc_html_e( 'Регулярна підписка' ); ?>
				</a>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-outline-light btn-lg">
					<?php pll_esc_html_e( 'Разовий внесок' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
