<?php
/**
 * Archive Cases Template
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Кейси' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Люди, яким ми допомагаємо. Кожна історія — це реальне життя.' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<!-- Фільтр по статусу -->
		<div class="cases-filter" style="display: flex; flex-wrap: wrap; gap: var(--space-2); justify-content: center; margin-bottom: var(--space-10);">
			<button class="btn btn-outline btn-sm case-filter-btn active" data-status="all"><?php pll_esc_html_e( 'Усі' ); ?></button>
			<button class="btn btn-outline btn-sm case-filter-btn" data-status="active"><?php pll_esc_html_e( 'Потребують допомоги' ); ?></button>
			<button class="btn btn-outline btn-sm case-filter-btn" data-status="completed"><?php pll_esc_html_e( 'Збір завершено' ); ?></button>
		</div>

		<?php
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$cases_query = new WP_Query( array(
			'post_type'      => 'case',
			'posts_per_page' => 12,
			'paged'          => $paged,
			'meta_key'       => 'case_status',
			'orderby'        => array(
				'meta_value' => 'ASC',
				'date'       => 'DESC',
			),
		) );
		?>

		<?php if ( $cases_query->have_posts() ) : ?>
			<div class="cases-grid">
				<?php while ( $cases_query->have_posts() ) : $cases_query->the_post(); ?>
					<?php
					$target    = sarcoma_get_field_fallback( 'target_amount' );
					$collected = sarcoma_get_field_fallback( 'collected_amount' );
					$percent   = sarcoma_get_progress_percent( $collected, $target );
					$status    = sarcoma_get_field_fallback( 'case_status' );
					?>
					<article class="case-card <?php echo 'completed' === $status ? 'case-card--completed' : ''; ?>" data-status="<?php echo esc_attr( $status ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="case-card__image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'case-card' ); ?>
								</a>
								<?php if ( 'completed' === $status ) : ?>
									<span class="case-card__badge case-card__badge--success"><?php pll_esc_html_e( 'Зібрано!' ); ?></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="case-card__content">
							<h2 class="case-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<?php if ( has_excerpt() ) : ?>
								<p class="case-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>

							<?php if ( $target ) : ?>
								<div class="case-card__progress">
									<div class="progress-bar progress-bar--small">
										<div class="progress-bar__fill" style="width: 0%;" data-width="<?php echo esc_attr( $percent ); ?>%"></div>
									</div>
									<div class="case-card__amounts">
										<span><?php echo esc_html( sarcoma_format_amount( $collected ) ); ?></span>
										<span><?php printf( esc_html( pll__( 'з %s' ) ), esc_html( sarcoma_format_amount( $target ) ) ); ?></span>
									</div>
								</div>
							<?php endif; ?>

							<a href="<?php the_permalink(); ?>" class="btn btn-sm <?php echo 'completed' === $status ? 'btn-outline' : 'btn-primary'; ?>">
								<?php echo 'completed' === $status ? esc_html( pll__( 'Деталі' ) ) : esc_html( pll__( 'Допомогти' ) ); ?>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div style="margin-top: var(--space-10);">
				<?php
				echo paginate_links( array(
					'total'   => $cases_query->max_num_pages,
					'current' => $paged,
				) );
				?>
			</div>
		<?php else : ?>
			<p class="text-center text-muted"><?php pll_esc_html_e( 'Кейси з\'являться найближчим часом.' ); ?></p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		<!-- CTA -->
		<div style="text-align: center; margin-top: var(--space-10);">
			<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-lg">
				<?php pll_esc_html_e( 'Зробити внесок' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
get_footer();
