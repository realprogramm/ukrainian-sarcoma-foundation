<?php
/**
 * Template Name: База знань
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'База знань' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Корисні статті про саркому, лікування та підтримку пацієнтів' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<!-- Пошук -->
		<div class="blog-search" style="max-width: 600px; margin: 0 auto var(--space-10);">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div style="display: flex; gap: var(--space-3);">
					<input type="search" name="s" placeholder="<?php pll_esc_attr_e( 'Пошук статей...' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" style="flex: 1; padding: var(--space-3) var(--space-4); border: 2px solid var(--color-border); border-radius: var(--radius); font-size: var(--text-base);">
					<button type="submit" class="btn btn-primary"><?php pll_esc_html_e( 'Шукати' ); ?></button>
				</div>
			</form>
		</div>

		<!-- Категорії -->
		<?php
		$categories = get_categories( array(
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => true,
		) );
		?>
		<?php if ( $categories ) : ?>
			<div class="blog-categories" style="display: flex; flex-wrap: wrap; gap: var(--space-2); justify-content: center; margin-bottom: var(--space-10);">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-outline btn-sm"><?php pll_esc_html_e( 'Усі' ); ?></a>
				<?php foreach ( $categories as $cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="btn btn-outline btn-sm">
						<?php echo esc_html( $cat->name ); ?> <span style="opacity:0.5">(<?php echo esc_html( $cat->count ); ?>)</span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<!-- Статті -->
		<?php
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$blog_query = new WP_Query( array(
			'post_type'      => 'post',
			'posts_per_page' => 9,
			'paged'          => $paged,
		) );
		?>

		<?php if ( $blog_query->have_posts() ) : ?>
			<div class="posts-grid">
				<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
					<article class="post-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-card__image">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'case-card' ); ?></a>
							</div>
						<?php endif; ?>
						<div class="post-card__content">
							<?php $cats = get_the_category(); ?>
							<?php if ( $cats ) : ?>
								<span class="post-card__cat" style="font-size: var(--text-xs); text-transform: uppercase; color: var(--color-primary); font-weight: 600; letter-spacing: 0.5px;">
									<?php echo esc_html( $cats[0]->name ); ?>
								</span>
							<?php endif; ?>
							<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post-card__meta" style="font-size: var(--text-sm); color: var(--color-text-muted); margin-bottom: var(--space-3);">
								<?php echo esc_html( get_the_date() ); ?>
							</div>
							<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
							<a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm"><?php pll_esc_html_e( 'Читати' ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div style="margin-top: var(--space-10);">
				<?php
				echo paginate_links( array(
					'total'   => $blog_query->max_num_pages,
					'current' => $paged,
				) );
				?>
			</div>
		<?php else : ?>
			<p class="text-center text-muted"><?php pll_esc_html_e( 'Статті з\'являться найближчим часом.' ); ?></p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>

<?php
get_footer();
