<?php
/**
 * Search Results Template
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title">
			<?php printf( esc_html( pll__( 'Результати пошуку: «%s»' ) ), esc_html( get_search_query() ) ); ?>
		</h1>
		<p class="page-header__desc">
			<?php printf( esc_html( pll__( 'Знайдено результатів: %d' ) ), (int) $wp_query->found_posts ); ?>
		</p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<!-- Пошук -->
		<div class="blog-search" style="max-width: 600px; margin: 0 auto var(--space-10);">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div style="display: flex; gap: var(--space-3);">
					<input type="search" name="s" placeholder="<?php pll_esc_attr_e( 'Пошук...' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" style="flex: 1; padding: var(--space-3) var(--space-4); border: 2px solid var(--color-border); border-radius: var(--radius); font-size: var(--text-base);">
					<button type="submit" class="btn btn-primary"><?php pll_esc_html_e( 'Шукати' ); ?></button>
				</div>
			</form>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="post-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-card__image">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'case-card' ); ?></a>
							</div>
						<?php endif; ?>
						<div class="post-card__content">
							<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-bottom: var(--space-2);">
								<?php echo esc_html( get_the_date() ); ?> &bull; <?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?>
							</div>
							<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm"><?php pll_esc_html_e( 'Читати' ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div style="margin-top: var(--space-10);">
				<?php the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) ); ?>
			</div>
		<?php else : ?>
			<div style="text-align: center; padding: var(--space-12) 0;">
				<p style="font-size: var(--text-lg); color: var(--color-text-muted);"><?php pll_esc_html_e( 'На жаль, нічого не знайдено. Спробуйте інший запит.' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
