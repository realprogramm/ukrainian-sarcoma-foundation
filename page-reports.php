<?php
/**
 * Template Name: Звіти
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Звіти' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Прозорість — наш головний принцип. Тут ви знайдете фінансові та діяльнісні звіти фонду.' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<?php
		$reports = new WP_Query( array(
			'post_type'      => 'report',
			'posts_per_page' => 20,
			'orderby'        => 'date',
			'order'          => 'DESC',
		) );
		?>

		<?php if ( $reports->have_posts() ) : ?>

			<!-- Фільтр по роках -->
			<div class="reports-filter" style="text-align: center; margin-bottom: var(--space-10);">
				<button class="btn btn-outline btn-sm report-filter-btn active" data-year="all"><?php pll_esc_html_e( 'Усі' ); ?></button>
				<?php
				$years = array();
				$temp_posts = get_posts( array( 'post_type' => 'report', 'posts_per_page' => -1 ) );
				foreach ( $temp_posts as $tp ) {
					$y = get_the_date( 'Y', $tp );
					if ( ! in_array( $y, $years, true ) ) {
						$years[] = $y;
					}
				}
				rsort( $years );
				foreach ( $years as $year ) :
				?>
					<button class="btn btn-outline btn-sm report-filter-btn" data-year="<?php echo esc_attr( $year ); ?>"><?php echo esc_html( $year ); ?></button>
				<?php endforeach; ?>
			</div>

			<div class="reports-grid">
				<?php while ( $reports->have_posts() ) : $reports->the_post(); ?>
					<?php
					$report_type = get_field( 'report_type' );
					$report_file = get_field( 'report_file' );
					$year = get_the_date( 'Y' );
					?>
					<article class="report-card" data-year="<?php echo esc_attr( $year ); ?>">
						<div class="report-card__icon">📊</div>
						<div class="report-card__content">
							<span class="report-card__type"><?php echo esc_html( $report_type ?: pll__( 'Звіт' ) ); ?></span>
							<h3 class="report-card__title"><?php the_title(); ?></h3>
							<p class="report-card__date"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></p>
							<?php if ( has_excerpt() ) : ?>
								<p class="report-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>
						</div>
						<div class="report-card__actions">
							<?php if ( $report_file ) : ?>
								<a href="<?php echo esc_url( $report_file['url'] ); ?>" class="btn btn-primary btn-sm" target="_blank" rel="noopener">
									📥 <?php pll_esc_html_e( 'Завантажити PDF' ); ?>
								</a>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm">
								<?php pll_esc_html_e( 'Детальніше' ); ?>
							</a>
						</div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>

		<?php else : ?>
			<div style="text-align: center; padding: var(--space-12) 0;">
				<p class="text-muted" style="font-size: var(--text-lg);"><?php pll_esc_html_e( 'Звіти будуть опубліковані найближчим часом.' ); ?></p>
			</div>
		<?php endif; ?>

		<!-- Таблиця надходжень (із ACF Options або контенту сторінки) -->
		<section class="donate-section" style="margin-top: var(--space-12);">
			<?php
			while ( have_posts() ) :
				the_post();
				if ( get_the_content() ) :
			?>
				<h2 class="donate-section__title"><?php pll_esc_html_e( 'Фінансова інформація' ); ?></h2>
				<div class="page-content__text">
					<?php the_content(); ?>
				</div>
			<?php
				endif;
			endwhile;
			?>
		</section>
	</div>
</div>

<?php
get_footer();
