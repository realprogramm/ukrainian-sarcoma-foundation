<?php
/**
 * Template Name: Як допомогти
 *
 * @package Sarcoma_Theme
 */

get_header();

$payment_success = isset( $_GET['payment'] ) && 'success' === $_GET['payment'];
?>

<div class="page-header">
	<div class="container">
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Підтримати фонд' ); ?></h1>
		<p class="page-header__desc"><?php pll_esc_html_e( 'Кожен внесок наближає до одужання' ); ?></p>
	</div>
</div>

<div class="page-content">
	<div class="container">

		<?php if ( $payment_success ) : ?>
			<div class="donate-success">
				<div class="donate-success__icon">&#10003;</div>
				<h2 class="donate-success__title"><?php pll_esc_html_e( 'Дякуємо за ваш внесок!' ); ?></h2>
				<p class="donate-success__text"><?php pll_esc_html_e( 'Ваш платіж успішно оброблено. Дякуємо за підтримку фонду!' ); ?></p>
			</div>
		<?php endif; ?>

		<!-- Donate Card -->
		<div class="donate-card">

			<!-- Tabs: one-time / monthly -->
			<div class="donate-tabs">
				<button class="donate-tab active" data-donate-type="one-time"><?php pll_esc_html_e( 'Разова допомога' ); ?></button>
				<button class="donate-tab" data-donate-type="subscribe"><?php pll_esc_html_e( 'Щомісячна підтримка' ); ?></button>
			</div>

			<!-- Amount input -->
			<div class="donate-amount-input-wrap">
				<input type="number" class="donate-amount-input" id="donateAmount" value="500" min="1" max="29999" step="1">
				<span class="donate-amount-input-wrap__currency">&#8372;</span>
			</div>

			<!-- Quick add buttons -->
			<div class="donate-quick-add">
				<button class="donate-quick-btn" data-add="100">+ 100 &#8372;</button>
				<button class="donate-quick-btn" data-add="500">+ 500 &#8372;</button>
				<button class="donate-quick-btn" data-add="1000">+ 1 000 &#8372;</button>
			</div>

			<!-- Anonymous checkbox -->
			<label class="donate-checkbox">
				<input type="checkbox" id="donateAnonymous">
				<span class="donate-checkbox__mark"></span>
				<span class="donate-checkbox__text"><?php pll_esc_html_e( 'Допомогти анонімно' ); ?></span>
			</label>

			<!-- Submit -->
			<button class="donate-submit-btn" id="donateSubmit">
				<span class="donate-submit-btn__text"><?php pll_esc_html_e( 'Підтримати' ); ?></span>
			</button>

			<p class="donate-card__note">
				<?php pll_esc_html_e( 'Ліміт переказу з карти — 29 999 ₴. Для більших сум скористайтеся банківським переказом.' ); ?>
			</p>

			<p class="donate-card__secure">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
				<?php pll_esc_html_e( 'Безпечне з\'єднання. Ваші дані захищені.' ); ?>
			</p>
		</div>

		<!-- Alternative payment methods -->
		<section class="donate-alternatives">
			<h2 class="donate-alternatives__title"><?php pll_esc_html_e( 'Інші способи допомогти' ); ?></h2>

			<div class="donate-alt-grid">

				<!-- Monobank Jar -->
				<a href="https://send.monobank.ua/jar/8FafTNXhpf" target="_blank" rel="noopener" class="donate-alt-card">
					<div class="donate-alt-card__icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 5c-1.5 0-2.8 1.4-3 2-3.5-1.5-11-.3-11 5 0 1.8 0 3 2 4.5V20h4v-2h3v2h4v-4c1-0.5 1.7-1 2-2h2v-4h-2c0-1-0.5-1.5-1-2z"/><circle cx="17" cy="10" r="1"/></svg>
					</div>
					<div class="donate-alt-card__info">
						<h3 class="donate-alt-card__name"><?php pll_esc_html_e( 'Монобанка' ); ?></h3>
						<p class="donate-alt-card__desc"><?php pll_esc_html_e( 'Переказ на банку Monobank' ); ?></p>
					</div>
					<svg class="donate-alt-card__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
				</a>

				<!-- Bank Transfer -->
				<div class="donate-alt-card donate-alt-card--expandable" id="bankTransferCard">
					<div class="donate-alt-card__header">
						<div class="donate-alt-card__icon">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg>
						</div>
						<div class="donate-alt-card__info">
							<h3 class="donate-alt-card__name"><?php pll_esc_html_e( 'Банківський переказ' ); ?></h3>
							<p class="donate-alt-card__desc"><?php pll_esc_html_e( 'SWIFT / IBAN реквізити' ); ?></p>
						</div>
						<svg class="donate-alt-card__chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
					</div>
					<div class="donate-alt-card__body">
						<?php if ( function_exists( 'get_field' ) ) : ?>
							<?php
							$bank_org   = sarcoma_get_field_fallback( 'bank_org_name' );
							$bank_iban  = sarcoma_get_field_fallback( 'bank_iban' );
							$bank_swift = sarcoma_get_field_fallback( 'bank_swift' );
							$bank_addr  = sarcoma_get_field_fallback( 'bank_address' );
							?>
							<?php if ( $bank_org || $bank_iban ) : ?>
								<div class="bank-details">
									<?php if ( $bank_org ) : ?>
										<div class="bank-details__row">
											<span class="bank-details__label"><?php pll_esc_html_e( 'Отримувач' ); ?></span>
											<span class="bank-details__value"><?php echo esc_html( $bank_org ); ?></span>
										</div>
									<?php endif; ?>
									<?php if ( $bank_iban ) : ?>
										<div class="bank-details__row">
											<span class="bank-details__label"><?php pll_esc_html_e( 'IBAN' ); ?></span>
											<span class="bank-details__value"><?php echo esc_html( $bank_iban ); ?></span>
										</div>
									<?php endif; ?>
									<?php if ( $bank_swift ) : ?>
										<div class="bank-details__row">
											<span class="bank-details__label"><?php pll_esc_html_e( 'SWIFT' ); ?></span>
											<span class="bank-details__value"><?php echo esc_html( $bank_swift ); ?></span>
										</div>
									<?php endif; ?>
									<?php if ( $bank_addr ) : ?>
										<div class="bank-details__row">
											<span class="bank-details__label"><?php pll_esc_html_e( 'Адреса банку' ); ?></span>
											<span class="bank-details__value"><?php echo esc_html( $bank_addr ); ?></span>
										</div>
									<?php endif; ?>
								</div>
							<?php else : ?>
								<p class="text-muted"><?php pll_esc_html_e( 'Реквізити будуть додані найближчим часом.' ); ?></p>
							<?php endif; ?>
						<?php else : ?>
							<p class="text-muted"><?php pll_esc_html_e( 'Реквізити будуть додані найближчим часом.' ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<!-- QR Code -->
				<?php if ( function_exists( 'get_field' ) ) : ?>
					<?php $qr_code = sarcoma_get_field_fallback( 'qr_code_image' ); ?>
					<?php if ( $qr_code ) : ?>
						<div class="donate-alt-card donate-alt-card--expandable" id="qrCodeCard">
							<div class="donate-alt-card__header">
								<div class="donate-alt-card__icon">
									<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="8" height="8" rx="1"/><rect x="14" y="2" width="8" height="8" rx="1"/><rect x="2" y="14" width="8" height="8" rx="1"/><rect x="14" y="14" width="4" height="4" rx="0.5"/><line x1="22" y1="14" x2="22" y2="22"/><line x1="14" y1="22" x2="22" y2="22"/></svg>
								</div>
								<div class="donate-alt-card__info">
									<h3 class="donate-alt-card__name"><?php pll_esc_html_e( 'QR-код' ); ?></h3>
									<p class="donate-alt-card__desc"><?php pll_esc_html_e( 'Скануйте для переказу' ); ?></p>
								</div>
								<svg class="donate-alt-card__chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
							</div>
							<div class="donate-alt-card__body" style="text-align: center;">
								<img src="<?php echo esc_url( $qr_code['url'] ); ?>" alt="<?php pll_esc_attr_e( 'QR-код для переказу' ); ?>" style="max-width: 220px; border-radius: var(--radius-lg);">
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

			</div>
		</section>

	</div>
</div>

<?php
get_footer();
