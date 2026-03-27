<?php
/**
 * Single Case Template
 *
 * @package Sarcoma_Theme
 */

get_header();

while ( have_posts() ) :
	the_post();

	$target    = sarcoma_get_field_fallback( 'target_amount' );
	$collected = sarcoma_get_field_fallback( 'collected_amount' );
	$status    = sarcoma_get_field_fallback( 'case_status' );
	$age       = sarcoma_get_field_fallback( 'patient_age' );
	$diagnosis = sarcoma_get_field_fallback( 'diagnosis' );
	$percent   = sarcoma_get_progress_percent( $collected, $target );
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<?php if ( $diagnosis ) : ?>
			<p class="page-header__desc"><?php echo esc_html( $diagnosis ); ?></p>
		<?php endif; ?>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="page-content__grid">
			<!-- Основний контент -->
			<div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin-bottom: var(--space-8); border-radius: var(--radius-lg); overflow: hidden;">
						<?php the_post_thumbnail( 'case-hero' ); ?>
					</div>
				<?php endif; ?>

				<div class="page-content__text">
					<?php the_content(); ?>
				</div>

				<?php if ( $age ) : ?>
					<p style="margin-top: var(--space-4); color: var(--color-text-light);">
						<strong><?php pll_esc_html_e( 'Вік пацієнта:' ); ?></strong> <?php echo esc_html( $age ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Бічна панель з прогресом -->
			<div>
				<div class="fundraising-card" style="position: sticky; top: calc(var(--header-height) + var(--space-6));">
					<?php if ( 'completed' === $status ) : ?>
						<div style="background: var(--color-success-light); padding: var(--space-3); border-radius: var(--radius); margin-bottom: var(--space-4); text-align: center;">
							<strong style="color: var(--color-success);">✅ <?php pll_esc_html_e( 'Збір завершено!' ); ?></strong>
						</div>
					<?php endif; ?>

					<h3 class="fundraising-card__title"><?php pll_esc_html_e( 'Прогрес збору' ); ?></h3>

					<?php if ( $target ) : ?>
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
					<?php endif; ?>

					<?php if ( 'active' === $status ) : ?>
						<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-lg" style="width: 100%;">
							<?php pll_esc_html_e( 'Допомогти' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<!-- Навігація -->
		<div style="margin-top: var(--space-12); display: flex; justify-content: space-between;">
			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			?>
			<?php if ( $prev ) : ?>
				<a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="btn btn-outline">
					← <?php echo esc_html( get_the_title( $prev ) ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $next ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="btn btn-outline" style="margin-left: auto;">
					<?php echo esc_html( get_the_title( $next ) ); ?> →
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
endwhile;

get_footer();
