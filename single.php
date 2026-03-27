<?php
/**
 * Single Post Template (Blog)
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="page-header">
	<div class="container">
		<?php $cats = get_the_category(); ?>
		<?php if ( $cats ) : ?>
			<span style="display: inline-block; font-size: var(--text-sm); text-transform: uppercase; color: var(--color-accent); font-weight: 600; letter-spacing: 0.5px; margin-bottom: var(--space-3);">
				<?php echo esc_html( $cats[0]->name ); ?>
			</span>
		<?php endif; ?>
		<h1 class="page-header__title"><?php the_title(); ?></h1>
		<div style="color: rgba(255,255,255,0.7); font-size: var(--text-sm); margin-top: var(--space-3);">
			<?php echo esc_html( get_the_date() ); ?>
			<?php if ( get_the_modified_date() !== get_the_date() ) : ?>
				&bull; <?php printf( esc_html( pll__( 'Оновлено: %s' ) ), esc_html( get_the_modified_date() ) ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<article class="single-post" style="max-width: 800px; margin: 0 auto;">
			<?php if ( has_post_thumbnail() ) : ?>
				<div style="margin-bottom: var(--space-8); border-radius: var(--radius-lg); overflow: hidden;">
					<?php the_post_thumbnail( 'large', array( 'style' => 'width:100%;height:auto;display:block;' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="page-content__text">
				<?php the_content(); ?>
			</div>

			<?php
			$tags = get_the_tags();
			if ( $tags ) :
			?>
				<div style="margin-top: var(--space-8); padding-top: var(--space-6); border-top: 1px solid var(--color-border);">
					<div style="display: flex; flex-wrap: wrap; gap: var(--space-2);">
						<?php foreach ( $tags as $tag ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="btn btn-outline btn-sm">
								#<?php echo esc_html( $tag->name ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</article>

		<!-- Навігація між статтями -->
		<nav style="max-width: 800px; margin: var(--space-10) auto 0; display: flex; justify-content: space-between; gap: var(--space-4);">
			<?php
			$prev = get_previous_post();
			$next = get_next_post();
			?>
			<?php if ( $prev ) : ?>
				<a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="btn btn-outline btn-sm">&laquo; <?php echo esc_html( wp_trim_words( $prev->post_title, 5 ) ); ?></a>
			<?php else : ?>
				<span></span>
			<?php endif; ?>
			<?php if ( $next ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="btn btn-outline btn-sm"><?php echo esc_html( wp_trim_words( $next->post_title, 5 ) ); ?> &raquo;</a>
			<?php endif; ?>
		</nav>
	</div>
</div>

<?php endwhile; ?>

<?php
get_footer();
