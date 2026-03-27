<?php
/**
 * Template Name: Напрями діяльності
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Напрями діяльності' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Три ключові напрями, в яких ми допомагаємо пацієнтам із саркомою' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<?php
		$activities = array(
			array(
				'icon'  => '🔬',
				'slug'  => 'diagnostics',
				'title' => pll__( 'Діагностика' ),
				'desc'  => pll__( 'Забезпечуємо доступ до сучасних методів діагностики саркоми: біопсія, МРТ, КТ, ПЕТ-КТ, генетичні та імуногістохімічні дослідження. Рання діагностика рятує життя.' ),
				'features' => array(
					pll__( 'Біопсія та гістологія' ),
					pll__( 'МРТ та КТ дослідження' ),
					pll__( 'ПЕТ-КТ сканування' ),
					pll__( 'Генетичні дослідження' ),
				),
			),
			array(
				'icon'  => '🏥',
				'slug'  => 'implants-operations',
				'title' => pll__( 'Імпланти та операції' ),
				'desc'  => pll__( 'Фінансуємо хірургічні втручання, онкологічні ендопротези та реконструктивні операції для пацієнтів із саркомою кісток та м\'яких тканин.' ),
				'features' => array(
					pll__( 'Ендопротезування' ),
					pll__( 'Реконструктивна хірургія' ),
					pll__( 'Кісткова трансплантація' ),
					pll__( 'Післяопераційна реабілітація' ),
				),
			),
			array(
				'icon'  => '🌍',
				'slug'  => 'international-consultations',
				'title' => pll__( 'Міжнародні консиліуми' ),
				'desc'  => pll__( 'Організовуємо консультації з провідними міжнародними онкологами для визначення оптимальної стратегії лікування кожного пацієнта.' ),
				'features' => array(
					pll__( 'Консультації з експертами ЄС та США' ),
					pll__( 'Другу медичну думку' ),
					pll__( 'Телемедичні консиліуми' ),
					pll__( 'Направлення у закордонні клініки' ),
				),
			),
		);
		?>

		<div class="activities-detail">
			<?php foreach ( $activities as $i => $act ) : ?>
				<section class="activity-detail <?php echo 0 === $i % 2 ? '' : 'activity-detail--reverse'; ?>" id="<?php echo esc_attr( $act['slug'] ); ?>">
					<div class="activity-detail__icon-wrap">
						<span class="activity-detail__icon"><?php echo esc_html( $act['icon'] ); ?></span>
					</div>
					<div class="activity-detail__content">
						<h2 class="activity-detail__title"><?php echo esc_html( $act['title'] ); ?></h2>
						<p class="activity-detail__desc"><?php echo esc_html( $act['desc'] ); ?></p>
						<ul class="activity-detail__features">
							<?php foreach ( $act['features'] as $feat ) : ?>
								<li>✓ <?php echo esc_html( $feat ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="activity-detail__actions">
							<a href="<?php echo esc_url( get_permalink( get_page_by_path( $act['slug'] ) ) ); ?>" class="btn btn-primary">
								<?php pll_esc_html_e( 'Дізнатися більше' ); ?>
							</a>
							<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-outline">
								<?php pll_esc_html_e( 'Допомогти' ); ?>
							</a>
						</div>
					</div>
				</section>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php
get_footer();
