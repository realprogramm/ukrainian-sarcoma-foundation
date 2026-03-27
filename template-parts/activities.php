<?php
/**
 * Template Part: Напрями діяльності
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uploads_url = wp_upload_dir()['baseurl'];
$activities = array(
	array(
		'image' => $uploads_url . '/sarcoma-photos/sarcoma-diagnostics.png',
		'title' => pll__( 'Діагностика' ),
		'desc'  => pll__( 'Забезпечуємо доступ до сучасних методів діагностики саркоми, включаючи біопсію, МРТ, КТ та генетичні дослідження.' ),
	),
	array(
		'image' => $uploads_url . '/sarcoma-photos/sarcoma-treatment.png',
		'title' => pll__( 'Імпланти та операції' ),
		'desc'  => pll__( 'Фінансуємо хірургічні втручання, імпланти та протези для пацієнтів із саркомою кісток та м\'яких тканин.' ),
	),
	array(
		'image' => $uploads_url . '/sarcoma-photos/sarcoma-consultations.png',
		'title' => pll__( 'Міжнародні консиліуми' ),
		'desc'  => pll__( 'Організовуємо консультації з провідними міжнародними онкологами для визначення оптимальної стратегії лікування.' ),
	),
);
?>

<section class="section activities">
	<div class="container">
		<h2 class="section__title"><?php pll_esc_html_e( 'Напрями діяльності' ); ?></h2>
		<p class="section__subtitle"><?php pll_esc_html_e( 'Основні напрямки роботи фонду' ); ?></p>

		<div class="activities__grid">
			<?php foreach ( $activities as $activity ) : ?>
				<div class="activity-card <?php echo ! empty( $activity['image'] ) ? 'activity-card--has-image' : ''; ?>">
					<?php if ( ! empty( $activity['image'] ) ) : ?>
						<div class="activity-card__image">
							<img src="<?php echo esc_url( $activity['image'] ); ?>" alt="<?php echo esc_attr( $activity['title'] ); ?>">
						</div>
					<?php else : ?>
						<div class="activity-card__icon">
							<?php echo esc_html( $activity['icon'] ); ?>
						</div>
					<?php endif; ?>
					<h3 class="activity-card__title"><?php echo esc_html( $activity['title'] ); ?></h3>
					<p class="activity-card__desc"><?php echo esc_html( $activity['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
