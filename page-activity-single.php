<?php
/**
 * Template Name: Напрям діяльності (деталі)
 *
 * @package Sarcoma_Theme
 */

get_header();

while ( have_posts() ) :
	the_post();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) : ?>
			<p class="page-header__desc"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<?php endif; ?>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<!-- Контент сторінки -->
		<div class="page-content__text" style="max-width: 800px; margin: 0 auto var(--space-12);">
			<?php the_content(); ?>
		</div>

		<!-- Кейси цього напряму -->
		<?php
		$related_cases = new WP_Query( array(
			'post_type'      => 'case',
			'posts_per_page' => 3,
			'meta_query'     => array(
				array(
					'key'     => 'case_status',
					'value'   => 'active',
					'compare' => '=',
				),
			),
		) );
		?>

		<?php if ( $related_cases->have_posts() ) : ?>
			<section class="donate-section">
				<h2 class="donate-section__title"><?php pll_esc_html_e( 'Потребують допомоги' ); ?></h2>
				<div class="cases-grid">
					<?php while ( $related_cases->have_posts() ) : $related_cases->the_post(); ?>
						<?php
						$target    = sarcoma_get_field_fallback( 'target_amount' );
						$collected = sarcoma_get_field_fallback( 'collected_amount' );
						$percent   = sarcoma_get_progress_percent( $collected, $target );
						?>
						<article class="case-card">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="case-card__image">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'case-card' ); ?></a>
								</div>
							<?php endif; ?>
							<div class="case-card__content">
								<h3 class="case-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
								<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary"><?php pll_esc_html_e( 'Допомогти' ); ?></a>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</section>
		<?php endif; ?>

		<!-- CTA -->
		<div style="text-align: center; margin-top: var(--space-10);">
			<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-lg">
				<?php pll_esc_html_e( 'Зробити внесок' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
endwhile;
get_footer();
