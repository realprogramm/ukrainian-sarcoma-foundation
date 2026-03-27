<?php
/**
 * Single Report Template
 *
 * @package Sarcoma_Theme
 */

get_header();

while ( have_posts() ) :
	the_post();
	$report_type = get_field( 'report_type' );
	$report_file = get_field( 'report_file' );
?>

<div class="page-header">
	<div class="container">
		<?php if ( $report_type ) : ?>
			<span style="display: inline-block; font-size: var(--text-sm); text-transform: uppercase; color: var(--color-accent); font-weight: 600; letter-spacing: 0.5px; margin-bottom: var(--space-3);">
				<?php echo esc_html( $report_type ); ?>
			</span>
		<?php endif; ?>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<p class="page-header__desc"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<article style="max-width: 800px; margin: 0 auto;">
			<?php if ( $report_file ) : ?>
				<div style="text-align: center; margin-bottom: var(--space-8);">
					<a href="<?php echo esc_url( $report_file['url'] ); ?>" class="btn btn-primary btn-lg" target="_blank" rel="noopener">
						📥 <?php pll_esc_html_e( 'Завантажити PDF' ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="page-content__text">
				<?php the_content(); ?>
			</div>
		</article>

		<div style="text-align: center; margin-top: var(--space-10);">
			<?php $reports_page = get_page_by_path( 'reports' ); ?>
			<a href="<?php echo $reports_page ? esc_url( get_permalink( $reports_page ) ) : '#'; ?>" class="btn btn-outline">
				&laquo; <?php pll_esc_html_e( 'Усі звіти' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
endwhile;
get_footer();
