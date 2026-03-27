<?php
/**
 * Template Part: Статистика (анімовані лічильники)
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$has_stats = function_exists( 'get_field' ) && have_rows( 'statistics', 'option' );

// Дефолтні значення якщо ACF ще не заповнено
$default_stats = array(
	array( 'number' => '150', 'label' => pll__( 'Пацієнтам допомогли' ), 'suffix' => '+' ),
	array( 'number' => '50', 'label' => pll__( 'Операцій профінансовано' ), 'suffix' => '+' ),
	array( 'number' => '30', 'label' => pll__( 'Міжнародних консиліумів' ), 'suffix' => '' ),
	array( 'number' => '5', 'label' => pll__( 'Років роботи' ), 'suffix' => '' ),
);
?>

<section class="section statistics">
	<div class="container">
		<h2 class="section__title"><?php pll_esc_html_e( 'Наша статистика' ); ?></h2>

		<div class="statistics__grid">
			<?php if ( $has_stats ) : ?>
				<?php while ( have_rows( 'statistics', 'option' ) ) : the_row(); ?>
					<div class="stat-item">
						<span class="stat-item__number" data-count="<?php echo esc_attr( get_sub_field( 'stat_number' ) ); ?>">0</span>
						<span class="stat-item__suffix"><?php echo esc_html( get_sub_field( 'stat_suffix' ) ); ?></span>
						<p class="stat-item__label"><?php echo esc_html( pll__( get_sub_field( 'stat_label' ) ) ); ?></p>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php foreach ( $default_stats as $stat ) : ?>
					<div class="stat-item">
						<span class="stat-item__number" data-count="<?php echo esc_attr( $stat['number'] ); ?>">0</span>
						<span class="stat-item__suffix"><?php echo esc_html( $stat['suffix'] ); ?></span>
						<p class="stat-item__label"><?php echo esc_html( $stat['label'] ); ?></p>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
