<?php
/**
 * Template Part: Останні кейси
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_query = new WP_Query( array(
	'post_type'      => 'case',
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query'     => array(
		array(
			'key'     => 'case_status',
			'value'   => 'active',
			'compare' => '=',
		),
	),
) );

// Якщо нема активних — показати всі
if ( ! $cases_query->have_posts() ) {
	$cases_query = new WP_Query( array(
		'post_type'      => 'case',
		'posts_per_page' => 6,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );
}
?>

<section class="section latest-cases">
	<div class="container">
		<h2 class="section__title"><?php pll_esc_html_e( 'Потребують допомоги' ); ?></h2>
		<p class="section__subtitle"><?php pll_esc_html_e( 'Допоможіть тим, хто зараз бореться з хворобою' ); ?></p>

		<?php if ( $cases_query->have_posts() ) : ?>
			<div class="cases-grid">
				<?php while ( $cases_query->have_posts() ) : $cases_query->the_post(); ?>
					<?php
					$target    = sarcoma_get_field_fallback( 'target_amount' );
					$collected = sarcoma_get_field_fallback( 'collected_amount' );
					$percent   = sarcoma_get_progress_percent( $collected, $target );
					$status    = sarcoma_get_field_fallback( 'case_status' );
					?>
					<article class="case-card <?php echo 'completed' === $status ? 'case-card--completed' : ''; ?>">
						<div class="case-card__image">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'case-card' ); ?>
								<?php endif; ?>
							</a>
							<?php if ( 'completed' === $status ) : ?>
								<span class="case-card__badge case-card__badge--success"><?php pll_esc_html_e( 'Зібрано!' ); ?></span>
							<?php endif; ?>
							<?php if ( $target ) : ?>
								<div class="progress-bar">
									<div class="progress-bar__fill" style="width: 0%;" data-width="<?php echo esc_attr( $percent ); ?>%">
										<span class="progress-bar__percent" style="margin-left: 15px;"><?php pll_esc_html_e( 'Зібрано' ); ?></span>
										<span class="progress-bar__percent" style="margin-left: auto; margin-right: 15px;"><?php echo esc_html( $percent ); ?>%</span>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="case-card__content">
							<h3 class="case-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>

							<?php if ( has_excerpt() ) : ?>
								<p class="case-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php endif; ?>

							<div class="btn-wrap" style="margin-bottom: var(--space-4);">
								<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-sm"><?php pll_esc_html_e( 'Допомогти' ); ?></a>
								<a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm"><?php pll_esc_html_e( 'Деталі' ); ?></a>
							</div>

							<?php if ( $target ) : ?>
								<div class="case-card__fund-detail">
									<div class="case-card__fund-item">
										<span class="case-card__fund-name"><?php pll_esc_html_e( 'Зібрано' ); ?></span>
										<span class="case-card__fund-value"><?php echo esc_html( sarcoma_format_amount( $collected ) ); ?></span>
									</div>
									<div class="case-card__fund-item">
										<span class="case-card__fund-name"><?php pll_esc_html_e( 'Мета' ); ?></span>
										<span class="case-card__fund-value"><?php echo esc_html( sarcoma_format_amount( $target ) ); ?></span>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="section__more">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'case' ) ); ?>" class="btn btn-outline">
					<?php pll_esc_html_e( 'Усі кейси' ); ?>
				</a>
			</div>
		<?php else : ?>
			<p class="text-center text-muted"><?php pll_esc_html_e( 'Кейси з\'являться найближчим часом.' ); ?></p>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>
