<?php
/**
 * Footer Template
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main><!-- .site-main -->

<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<!-- Про фонд -->
			<div class="footer-col">
				<h3 class="footer-title"><?php bloginfo( 'name' ); ?></h3>
				<p class="footer-desc">
					<?php pll_esc_html_e( 'Благодійний фонд допомоги хворим на саркому. Разом ми можемо більше.' ); ?>
				</p>
			</div>

			<!-- Навігація -->
			<div class="footer-col">
				<h3 class="footer-title"><?php pll_esc_html_e( 'Навігація' ); ?></h3>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 1,
				) );
				?>
			</div>

			<!-- Контакти -->
			<div class="footer-col">
				<h3 class="footer-title"><?php pll_esc_html_e( 'Контакти' ); ?></h3>
				<?php if ( function_exists( 'get_field' ) ) : ?>
					<?php $email = get_field( 'contact_email', 'option' ); ?>
					<?php $phone = get_field( 'contact_phone', 'option' ); ?>
					<?php if ( $email ) : ?>
						<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<p><a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<!-- Соцмережі -->
			<div class="footer-col">
				<h3 class="footer-title"><?php pll_esc_html_e( 'Ми в соцмережах' ); ?></h3>
				<?php if ( function_exists( 'get_field' ) && have_rows( 'social_links', 'option' ) ) : ?>
					<div class="social-links">
						<?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
							<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php echo esc_attr( get_sub_field( 'platform' ) ); ?>">
								<span class="social-icon social-icon--<?php echo esc_attr( sanitize_title( get_sub_field( 'platform' ) ) ); ?>"></span>
							</a>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom">
			<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php pll_esc_html_e( 'Усі права захищені.' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
