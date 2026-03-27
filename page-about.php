<?php
/**
 * Template Name: Про фонд
 *
 * @package Sarcoma_Theme
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Про фонд' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Історія, місія та люди, які стоять за фондом' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<!-- Історія створення -->
		<section class="donate-section">
			<h2 class="donate-section__title"><?php pll_esc_html_e( 'Історія створення' ); ?></h2>
			<div class="page-content__text">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</section>

		<!-- Засновник -->
		<?php if ( function_exists( 'get_field' ) ) : ?>
			<?php
			$founder_name  = sarcoma_get_field_fallback( 'founder_name' );
			$founder_bio   = sarcoma_get_field_fallback( 'founder_bio' );
			$founder_photo = sarcoma_get_field_fallback( 'founder_photo' );
			?>

			<?php if ( $founder_name || $founder_bio ) : ?>
				<?php
				$founder_photo_url = $founder_photo ? $founder_photo['url'] : wp_upload_dir()['baseurl'] . '/sarcoma-photos/founder.jpg';
				?>
				<section class="donate-section">
					<h2 class="donate-section__title"><?php pll_esc_html_e( 'Засновник' ); ?></h2>
					<div class="founder-block">
						<div class="founder-block__photo">
							<img src="<?php echo esc_url( $founder_photo_url ); ?>" alt="<?php echo esc_attr( $founder_name ); ?>" loading="lazy">
						</div>
						<div class="founder-block__info">
							<h3 class="founder-block__name"><?php echo esc_html( $founder_name ); ?></h3>
							<div class="founder-block__bio">
								<?php echo wp_kses_post( $founder_bio ); ?>
							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>

			<!-- Місія та бачення -->
			<?php
			$mission = sarcoma_get_field_fallback( 'mission_text' );
			$vision  = sarcoma_get_field_fallback( 'vision_text' );
			?>
			<?php if ( $mission || $vision ) : ?>
				<section class="donate-section">
					<h2 class="donate-section__title"><?php pll_esc_html_e( 'Місія та бачення' ); ?></h2>
					<div class="page-content__grid">
						<?php if ( $mission ) : ?>
							<div>
								<h3><?php pll_esc_html_e( 'Місія' ); ?></h3>
								<p><?php echo esc_html( $mission ); ?></p>
							</div>
						<?php endif; ?>
						<?php if ( $vision ) : ?>
							<div>
								<h3><?php pll_esc_html_e( 'Бачення' ); ?></h3>
								<p><?php echo esc_html( $vision ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

			<!-- Документи -->
			<?php
			$has_docs = have_rows( 'documents' );
			if ( ! $has_docs && function_exists( 'pll_get_post' ) ) {
				$ua_id = pll_get_post( get_the_ID(), 'uk' );
				if ( $ua_id && $ua_id !== get_the_ID() ) {
					$has_docs = have_rows( 'documents', $ua_id );
				}
			}
			?>
			<?php if ( $has_docs ) : ?>
				<section class="donate-section">
					<h2 class="donate-section__title"><?php pll_esc_html_e( 'Документи' ); ?></h2>
					<div class="documents-list">
						<?php while ( have_rows( 'documents' ) ) : the_row(); ?>
							<?php
							$doc_title = get_sub_field( 'doc_title' );
							$doc_file  = get_sub_field( 'doc_file' );
							?>
							<?php if ( $doc_file ) : ?>
								<a href="<?php echo esc_url( $doc_file['url'] ); ?>" class="document-item" target="_blank" rel="noopener noreferrer">
									<span class="document-item__icon">📄</span>
									<span class="document-item__name"><?php echo esc_html( $doc_title ?: $doc_file['filename'] ); ?></span>
								</a>
							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				</section>
			<?php endif; ?>

			<!-- Організаційна структура -->
			<?php $org_structure = sarcoma_get_field_fallback( 'org_structure' ); ?>
			<?php if ( $org_structure ) : ?>
				<section class="donate-section">
					<h2 class="donate-section__title"><?php pll_esc_html_e( 'Організаційна структура' ); ?></h2>
					<div class="org-structure">
						<?php echo wp_kses_post( $org_structure ); ?>
					</div>
				</section>
			<?php endif; ?>

		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
