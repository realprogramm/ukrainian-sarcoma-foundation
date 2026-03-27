<?php
/**
 * Default Template (fallback)
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-card__image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'case-card' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="post-card__content">
							<h2 class="post-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="post-card__excerpt">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
			) ); ?>
		<?php else : ?>
			<p><?php pll_esc_html_e( 'Записів не знайдено.' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
