<?php
/**
 * Template Name: Контакти
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Контакти' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Зв\'яжіться з нами — ми завжди відкриті до спілкування' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="contacts-grid">
			<!-- Форма зворотного зв'язку -->
			<div>
				<h2 class="donate-section__title"><?php pll_esc_html_e( 'Напишіть нам' ); ?></h2>

				<?php
				// Contact Form 7
				if ( shortcode_exists( 'contact-form-7' ) ) {
					echo do_shortcode( '[contact-form-7 id="202" title="Контактна форма"]' );
				} else {
					// Fallback — кастомна форма
				?>
				<form class="contact-form" id="contact-form" method="post">
					<?php wp_nonce_field( 'sarcoma_contact_form', 'sarcoma_contact_nonce' ); ?>
					<div class="form-group">
						<label for="contact-name"><?php pll_esc_html_e( "Ім'я" ); ?></label>
						<input type="text" id="contact-name" name="contact_name" required>
					</div>
					<div class="form-group">
						<label for="contact-email"><?php pll_esc_html_e( 'Email' ); ?></label>
						<input type="email" id="contact-email" name="contact_email" required>
					</div>
					<div class="form-group">
						<label for="contact-message"><?php pll_esc_html_e( 'Повідомлення' ); ?></label>
						<textarea id="contact-message" name="contact_message" rows="5" required></textarea>
					</div>
					<button type="submit" class="btn btn-primary"><?php pll_esc_html_e( 'Надіслати' ); ?></button>
				</form>
				<?php } ?>
			</div>

			<!-- Контактна інформація -->
			<div>
				<h2 class="donate-section__title"><?php pll_esc_html_e( 'Контактна інформація' ); ?></h2>

				<?php if ( function_exists( 'get_field' ) ) : ?>
					<ul class="contact-info-list">
						<?php $email = get_field( 'contact_email', 'option' ); ?>
						<?php if ( $email ) : ?>
							<li class="contact-info-item">
								<span class="contact-info-item__icon">📧</span>
								<div class="contact-info-item__content">
									<h4><?php pll_esc_html_e( 'Email' ); ?></h4>
									<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
								</div>
							</li>
						<?php endif; ?>

						<?php $phone = get_field( 'contact_phone', 'option' ); ?>
						<?php if ( $phone ) : ?>
							<li class="contact-info-item">
								<span class="contact-info-item__icon">📞</span>
								<div class="contact-info-item__content">
									<h4><?php pll_esc_html_e( 'Телефон' ); ?></h4>
									<a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
								</div>
							</li>
						<?php endif; ?>

						<?php $address = get_field( 'contact_address', 'option' ); ?>
						<?php if ( $address ) : ?>
							<li class="contact-info-item">
								<span class="contact-info-item__icon">📍</span>
								<div class="contact-info-item__content">
									<h4><?php pll_esc_html_e( 'Адреса' ); ?></h4>
									<p><?php echo esc_html( $address ); ?></p>
								</div>
							</li>
						<?php endif; ?>
					</ul>

					<!-- Соцмережі -->
					<?php if ( have_rows( 'social_links', 'option' ) ) : ?>
						<div style="margin-top: var(--space-8);">
							<h3 style="margin-bottom: var(--space-4);"><?php pll_esc_html_e( 'Ми в соцмережах' ); ?></h3>
							<div class="social-links">
								<?php while ( have_rows( 'social_links', 'option' ) ) : the_row(); ?>
									<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="<?php echo esc_attr( get_sub_field( 'platform' ) ); ?>">
										<?php echo esc_html( ucfirst( get_sub_field( 'platform' ) ) ); ?>
									</a>
								<?php endwhile; ?>
							</div>
						</div>
					<?php endif; ?>

				<?php else : ?>
					<p class="text-muted"><?php pll_esc_html_e( 'Контактна інформація буде додана найближчим часом.' ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<!-- Google Maps -->
		<?php if ( function_exists( 'get_field' ) ) : ?>
			<?php $maps_embed = get_field( 'google_maps_embed', 'option' ); ?>
			<?php if ( $maps_embed ) : ?>
				<div class="map-embed">
					<?php echo $maps_embed; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — iframe from admin ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
