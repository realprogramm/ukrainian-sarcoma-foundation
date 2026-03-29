<?php
/**
 * Template Part: Про фонд — секція в стилі Unbound (home-about)
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

$about_text = pll__( 'Ми допомагаємо хворим на саркому отримати якісну діагностику, лікування та шанс на нове життя. Кожен внесок рятує.' );

$about_items = array(
	pll__( 'Фінансування діагностики та лікування' ),
	pll__( 'Оплата імплантів та операцій' ),
	pll__( 'Міжнародні консиліуми з онкологами' ),
	pll__( 'Підтримка пацієнтів та їх родин' ),
	pll__( 'Прозора звітність та контроль коштів' ),
);
?>

<section class="home-about">
	<div class="container">
		<div class="home-about-grid">
			<!-- Ліва частина: фото + лічильники -->
			<div class="home-about-left">
				<div class="home-about-image">
					<?php
					$about_img = function_exists( 'get_field' ) ? get_field( 'about_section_image', 'option' ) : '';
					if ( $about_img ) : ?>
						<img src="<?php echo esc_url( $about_img['url'] ); ?>" alt="<?php echo esc_attr( $about_img['alt'] ); ?>">
					<?php else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about-placeholder.svg' ); ?>" alt="<?php pll_esc_attr_e( 'Про фонд' ); ?>">
					<?php endif; ?>
				</div>

				<!-- Counter wrap — тёмно-синяя полоса со статистикой -->
				<div class="counter-wrap">
					<?php if ( $has_stats ) : ?>
						<?php while ( have_rows( 'statistics', 'option' ) ) : the_row(); ?>
							<div class="counter-item">
								<span class="counter-no">
									<span class="counter" data-count="<?php echo esc_attr( get_sub_field( 'stat_number' ) ); ?>">0</span><?php echo esc_html( get_sub_field( 'stat_suffix' ) ); ?>
								</span>
								<span class="counter-text"><?php echo esc_html( pll__( get_sub_field( 'stat_label' ) ) ); ?></span>
							</div>
						<?php endwhile; ?>
					<?php else : ?>
						<?php foreach ( $default_stats as $stat ) : ?>
							<div class="counter-item">
								<span class="counter-no">
									<span class="counter" data-count="<?php echo esc_attr( $stat['number'] ); ?>">0</span><?php echo esc_html( $stat['suffix'] ); ?>
								</span>
								<span class="counter-text"><?php echo esc_html( $stat['label'] ); ?></span>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

			<!-- Права частина: текст + список + бейдж -->
			<div class="home-about-right">
				<div class="home-about-content">
					<div class="sub-title"><?php pll_esc_html_e( 'Про фонд' ); ?></div>
					<h2 class="section-title"><?php pll_esc_html_e( 'Наша місія — рятувати життя хворих на саркому' ); ?></h2>
					<p><?php echo esc_html( $about_text ); ?></p>

					<div class="about-list">
						<ul>
							<?php foreach ( $about_items as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="exp-date">
							<h2>5</h2>
							<h3><?php pll_esc_html_e( 'РОКІВ' ); ?></h3>
							<span class="date-desc"><?php pll_esc_html_e( 'ДОСВІДУ РОБОТИ' ); ?></span>
						</div>
					</div>

					<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn-primary"><?php pll_esc_html_e( 'Дізнатися більше' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
