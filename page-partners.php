<?php
/**
 * Template Name: Партнерам
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Партнерам' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Разом ми можемо зробити більше. Долучайтесь до місії фонду.' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<!-- Формати співпраці -->
		<section class="donate-section">
			<h2 class="donate-section__title"><?php pll_esc_html_e( 'Формати співпраці' ); ?></h2>
			<div class="activities__grid">
				<div class="activity-card">
					<div class="activity-card__icon">💼</div>
					<h3 class="activity-card__title"><?php pll_esc_html_e( 'Корпоративне партнерство' ); ?></h3>
					<p class="activity-card__desc"><?php pll_esc_html_e( 'Спільні проєкти, благодійні акції та корпоративна соціальна відповідальність. Ваш бренд стає частиною важливої місії.' ); ?></p>
				</div>
				<div class="activity-card">
					<div class="activity-card__icon">🏥</div>
					<h3 class="activity-card__title"><?php pll_esc_html_e( 'Медичне партнерство' ); ?></h3>
					<p class="activity-card__desc"><?php pll_esc_html_e( 'Співпраця з клініками, лабораторіями та медичними центрами для забезпечення діагностики та лікування пацієнтів.' ); ?></p>
				</div>
				<div class="activity-card">
					<div class="activity-card__icon">🤝</div>
					<h3 class="activity-card__title"><?php pll_esc_html_e( 'Волонтерство та pro bono' ); ?></h3>
					<p class="activity-card__desc"><?php pll_esc_html_e( 'Юридична, маркетингова, IT-підтримка або волонтерська допомога — будь-яка експертиза цінна для фонду.' ); ?></p>
				</div>
			</div>
		</section>

		<!-- Контент сторінки (якщо є) -->
		<?php
		while ( have_posts() ) :
			the_post();
			if ( get_the_content() ) :
		?>
			<section class="donate-section">
				<div class="page-content__text">
					<?php the_content(); ?>
				</div>
			</section>
		<?php
			endif;
		endwhile;
		?>

		<!-- Презентація PDF -->
		<?php if ( function_exists( 'get_field' ) ) : ?>
			<?php $presentation = sarcoma_get_field_fallback( 'partner_presentation' ); ?>
			<?php if ( $presentation ) : ?>
				<section class="donate-section" style="text-align: center;">
					<h2 class="donate-section__title"><?php pll_esc_html_e( 'Презентація фонду' ); ?></h2>
					<p><?php pll_esc_html_e( 'Завантажте презентацію фонду для ознайомлення з нашою діяльністю та можливостями співпраці.' ); ?></p>
					<a href="<?php echo esc_url( $presentation['url'] ); ?>" class="btn btn-primary btn-lg" target="_blank" rel="noopener">
						📥 <?php pll_esc_html_e( 'Завантажити презентацію' ); ?>
					</a>
				</section>
			<?php endif; ?>
		<?php endif; ?>

		<!-- Поточні партнери -->
		<?php
		$partners_query = new WP_Query( array(
			'post_type'      => 'partner',
			'posts_per_page' => 20,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		) );
		?>
		<?php if ( $partners_query->have_posts() ) : ?>
			<section class="donate-section">
				<h2 class="donate-section__title"><?php pll_esc_html_e( 'Наші партнери' ); ?></h2>
				<div class="partners__grid">
					<?php while ( $partners_query->have_posts() ) : $partners_query->the_post(); ?>
						<?php $url = get_field( 'partner_url' ); ?>
						<<?php echo $url ? 'a href="' . esc_url( $url ) . '" target="_blank" rel="noopener"' : 'div'; ?> class="partner-logo">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'partner-logo', array( 'alt' => get_the_title() ) ); ?>
							<?php else : ?>
								<span class="partner-logo__name"><?php the_title(); ?></span>
							<?php endif; ?>
						</<?php echo $url ? 'a' : 'div'; ?>>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</section>
		<?php endif; ?>

		<!-- Форма бізнес-запиту -->
		<section class="donate-section" id="partner-form">
			<h2 class="donate-section__title"><?php pll_esc_html_e( 'Стати партнером' ); ?></h2>
			<p style="text-align: center; max-width: 600px; margin: 0 auto var(--space-8); color: var(--color-text-light);">
				<?php pll_esc_html_e( 'Заповніть форму, і ми зв\'яжемось з вами для обговорення можливостей співпраці.' ); ?>
			</p>

			<form class="contact-form" style="max-width: 600px; margin: 0 auto;" id="partner-inquiry-form" method="post">
				<?php wp_nonce_field( 'sarcoma_partner_form', 'sarcoma_partner_nonce' ); ?>
				<input type="hidden" name="form_type" value="partner">

				<div class="form-group">
					<label for="partner-company"><?php pll_esc_html_e( 'Назва компанії / організації' ); ?></label>
					<input type="text" id="partner-company" name="company_name" required>
				</div>
				<div class="form-group">
					<label for="partner-name"><?php pll_esc_html_e( 'Контактна особа' ); ?></label>
					<input type="text" id="partner-name" name="contact_name" required>
				</div>
				<div class="form-group">
					<label for="partner-email"><?php pll_esc_html_e( 'Email' ); ?></label>
					<input type="email" id="partner-email" name="contact_email" required>
				</div>
				<div class="form-group">
					<label for="partner-phone"><?php pll_esc_html_e( 'Телефон' ); ?></label>
					<input type="tel" id="partner-phone" name="contact_phone">
				</div>
				<div class="form-group">
					<label for="partner-type"><?php pll_esc_html_e( 'Формат співпраці' ); ?></label>
					<select id="partner-type" name="partnership_type" style="width:100%;padding:var(--space-3) var(--space-4);border:2px solid var(--color-border);border-radius:var(--radius);font-size:var(--text-base);">
						<option value=""><?php pll_esc_html_e( 'Оберіть...' ); ?></option>
						<option value="corporate"><?php pll_esc_html_e( 'Корпоративне партнерство' ); ?></option>
						<option value="medical"><?php pll_esc_html_e( 'Медичне партнерство' ); ?></option>
						<option value="volunteer"><?php pll_esc_html_e( 'Волонтерство / Pro bono' ); ?></option>
						<option value="other"><?php pll_esc_html_e( 'Інше' ); ?></option>
					</select>
				</div>
				<div class="form-group">
					<label for="partner-message"><?php pll_esc_html_e( 'Повідомлення' ); ?></label>
					<textarea id="partner-message" name="message" rows="4"></textarea>
				</div>

				<button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
					<?php pll_esc_html_e( 'Надіслати запит' ); ?>
				</button>
			</form>
		</section>
	</div>
</div>

<?php
get_footer();
