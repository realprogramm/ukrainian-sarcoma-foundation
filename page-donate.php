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
		<h1 class="page-header__title"><?php pll_esc_html_e( 'Як допомогти' ); ?></h1>
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

			<!-- Step 1: Type -->
			<div class="donate-card__step">
				<span class="donate-card__step-num">1</span>
				<h3 class="donate-card__step-title"><?php pll_esc_html_e( 'Оберіть тип внеску' ); ?></h3>
			</div>
			<div class="donate-type-toggle">
				<button class="donate-type-btn active" data-donate-type="one-time" data-tab="one-time">
					<span class="donate-type-btn__icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
					</span>
					<?php pll_esc_html_e( 'Разовий внесок' ); ?>
				</button>
				<button class="donate-type-btn" data-donate-type="subscribe" data-tab="subscribe">
					<span class="donate-type-btn__icon">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.83 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
					</span>
					<?php pll_esc_html_e( 'Щомісячна підписка' ); ?>
				</button>
			</div>

			<!-- Step 2: Amount -->
			<div class="donate-card__step">
				<span class="donate-card__step-num">2</span>
				<h3 class="donate-card__step-title"><?php pll_esc_html_e( 'Оберіть суму' ); ?></h3>
			</div>
			<div class="donate-amounts">
				<button class="donate-amount-btn" data-amount="100">100 <small>&#8372;</small></button>
				<button class="donate-amount-btn" data-amount="250">250 <small>&#8372;</small></button>
				<button class="donate-amount-btn active" data-amount="500">500 <small>&#8372;</small></button>
				<button class="donate-amount-btn" data-amount="1000">1 000 <small>&#8372;</small></button>
				<button class="donate-amount-btn" data-amount="5000">5 000 <small>&#8372;</small></button>
				<div class="donate-custom-wrap">
					<span class="donate-custom-wrap__currency">&#8372;</span>
					<input type="number" class="donate-custom-input" placeholder="<?php pll_esc_attr_e( 'Інша сума' ); ?>" min="1" step="1">
				</div>
			</div>

			<!-- Step 3: Gateway -->
			<div class="donate-card__step">
				<span class="donate-card__step-num">3</span>
				<h3 class="donate-card__step-title"><?php pll_esc_html_e( 'Оберіть спосіб оплати' ); ?></h3>
			</div>
			<div class="payment-gateways payment-gateways--3">
				<button class="payment-gateway-btn" data-gateway="monobank">
					<span class="payment-gateway-btn__logo">
						<img src="https://send.monobank.ua/img/mono-favicon.png" alt="Monobank" width="32" height="32">
					</span>
					<span class="payment-gateway-btn__info">
						<span class="payment-gateway-btn__name">Monobank</span>
						<span class="payment-gateway-btn__desc"><?php pll_esc_html_e( 'Банка Monobank' ); ?></span>
					</span>
				</button>
				<button class="payment-gateway-btn" data-gateway="liqpay">
					<span class="payment-gateway-btn__logo">
						<img src="https://www.liqpay.ua/favicon.ico" alt="LiqPay" width="32" height="32">
					</span>
					<span class="payment-gateway-btn__info">
						<span class="payment-gateway-btn__name">LiqPay</span>
						<span class="payment-gateway-btn__desc"><?php pll_esc_html_e( 'Visa / Mastercard' ); ?></span>
					</span>
				</button>
				<button class="payment-gateway-btn" data-gateway="wayforpay">
					<span class="payment-gateway-btn__logo">
						<img src="https://wayforpay.com/favicon.ico" alt="WayForPay" width="32" height="32">
					</span>
					<span class="payment-gateway-btn__info">
						<span class="payment-gateway-btn__name">WayForPay</span>
						<span class="payment-gateway-btn__desc"><?php pll_esc_html_e( 'Visa / Mastercard / Apple Pay' ); ?></span>
					</span>
				</button>
			</div>

			<!-- Submit -->
			<button class="donate-submit-btn">
				<span class="donate-submit-btn__text"><?php pll_esc_html_e( 'Оплатити' ); ?></span>
				<span class="donate-submit-btn__amount">500 &#8372;</span>
				<svg class="donate-submit-btn__arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
			</button>

			<p class="donate-card__secure">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
				<?php pll_esc_html_e( 'Безпечне з\'єднання. Ваші дані захищені.' ); ?>
			</p>
		</div>

		<!-- Банківські реквізити -->
		<?php if ( function_exists( 'get_field' ) ) : ?>
			<?php
			$bank_org   = get_field( 'bank_org_name' );
			$bank_iban  = get_field( 'bank_iban' );
			$bank_swift = get_field( 'bank_swift' );
			$bank_addr  = get_field( 'bank_address' );
			?>

			<section class="donate-bank" id="bank-details">
				<h2 class="donate-bank__title"><?php pll_esc_html_e( 'Банківські реквізити (SWIFT)' ); ?></h2>
				<p class="donate-bank__desc">
					<?php pll_esc_html_e( 'Для міжнародних банківських переказів використовуйте наступні реквізити:' ); ?>
				</p>

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
					<div class="bank-details">
						<p class="text-muted"><?php pll_esc_html_e( 'Реквізити будуть додані найближчим часом. Зверніться до нас за деталями.' ); ?></p>
					</div>
				<?php endif; ?>
			</section>
		<?php endif; ?>

		<!-- QR-код -->
		<?php if ( function_exists( 'get_field' ) ) : ?>
			<?php $qr_code = get_field( 'qr_code_image' ); ?>
			<?php if ( $qr_code ) : ?>
				<section class="donate-bank" id="qr-code" style="text-align: center;">
					<h2 class="donate-bank__title"><?php pll_esc_html_e( 'QR-код для переказу' ); ?></h2>
					<div style="max-width: 280px; margin: 0 auto;">
						<img src="<?php echo esc_url( $qr_code['url'] ); ?>" alt="<?php pll_esc_attr_e( 'QR-код для переказу' ); ?>" style="width: 100%; border-radius: var(--radius-lg);">
					</div>
				</section>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>

<?php
get_footer();
