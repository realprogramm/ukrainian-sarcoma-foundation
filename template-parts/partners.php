<?php
/**
 * Template Part: Партнери
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$partners_query = new WP_Query( array(
	'post_type'      => 'partner',
	'posts_per_page' => 20,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
?>

<section class="section partners">
	<div class="container">
		<h2 class="section__title"><?php pll_esc_html_e( 'Наші партнери' ); ?></h2>

		<?php if ( $partners_query->have_posts() ) : ?>
			<div class="partners__grid">
				<?php while ( $partners_query->have_posts() ) : $partners_query->the_post(); ?>
					<?php
					$partner_url = get_field( 'partner_url' );
					$tag         = $partner_url ? 'a' : 'div';
					$attrs       = $partner_url ? ' href="' . esc_url( $partner_url ) . '" target="_blank" rel="noopener noreferrer"' : '';
					?>
					<<?php echo $tag; ?> class="partner-logo"<?php echo $attrs; ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'partner-logo', array( 'alt' => get_the_title() ) ); ?>
						<?php else : ?>
							<span class="partner-logo__name"><?php the_title(); ?></span>
						<?php endif; ?>
					</<?php echo $tag; ?>>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p class="text-center text-muted"><?php pll_esc_html_e( 'Інформація про партнерів з\'явиться найближчим часом.' ); ?></p>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>
