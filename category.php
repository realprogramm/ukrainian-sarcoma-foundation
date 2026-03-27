<?php
/**
 * Category Archive Template
 *
 * @package Sarcoma_Theme
 */

get_header();
$current_cat = get_queried_object();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php single_cat_title(); ?></h1>
		<?php if ( category_description() ) : ?>
			<p class="page-header__desc"><?php echo esc_html( wp_strip_all_tags( category_description() ) ); ?></p>
		<?php else : ?>
			<p class="page-header__desc"><?php pll_esc_html_e( 'Статті в категорії' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<div class="page-content">
	<div class="container">

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
				<?php $blog_page = get_page_by_path( 'blog' ); ?>
				<a href="<?php echo $blog_page ? esc_url( get_permalink( $blog_page ) ) : esc_url( home_url( '/' ) ); ?>" class="btn btn-outline btn-sm"><?php pll_esc_html_e( 'Усі' ); ?></a>
				<?php foreach ( $categories as $cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="btn btn-sm <?php echo $current_cat && $cat->term_id === $current_cat->term_id ? 'btn-primary' : 'btn-outline'; ?>">
						<?php echo esc_html( $cat->name ); ?> <span style="opacity:0.5">(<?php echo esc_html( $cat->count ); ?>)</span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

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
				<?php the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) ); ?>
			</div>
		<?php else : ?>
			<p class="text-center text-muted"><?php pll_esc_html_e( 'У цій категорії поки що немає статей.' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
