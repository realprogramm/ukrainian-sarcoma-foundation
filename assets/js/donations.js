/**
 * Donations — форми донатів, вибір суми, платіжні шлюзи
 *
 * @package Sarcoma_Theme
 */
(function () {
	'use strict';

	// Стан форми
	let selectedAmount = 500;
	let selectedGateway = '';
	let donationType = 'one-time';

	/**
	 * Форматування суми з пробілами
	 */
	function formatAmount(num) {
		return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
	}

	/**
	 * Оновити суму на кнопці "Оплатити"
	 */
	function updateSubmitButton() {
		var amountEl = document.querySelector('.donate-submit-btn__amount');
		if (amountEl && selectedAmount > 0) {
			amountEl.textContent = formatAmount(selectedAmount) + ' \u20B4';
		} else if (amountEl) {
			amountEl.textContent = '';
		}
	}

	/**
	 * Ініціалізація вибору суми
	 */
	function initAmountButtons() {
		const buttons = document.querySelectorAll('.donate-amount-btn');
		const customInput = document.querySelector('.donate-custom-input');

		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				buttons.forEach(function (b) { b.classList.remove('active'); });
				btn.classList.add('active');
				selectedAmount = parseInt(btn.getAttribute('data-amount'), 10);

				if (customInput) {
					customInput.value = '';
				}
				updateSubmitButton();
			});
		});

		if (customInput) {
			customInput.addEventListener('input', function () {
				buttons.forEach(function (b) { b.classList.remove('active'); });
				selectedAmount = parseInt(customInput.value, 10) || 0;
				updateSubmitButton();
			});

			customInput.addEventListener('focus', function () {
				buttons.forEach(function (b) { b.classList.remove('active'); });
			});
		}
	}

	/**
	 * Ініціалізація вибору платіжного шлюзу
	 */
	function initGatewayButtons() {
		const buttons = document.querySelectorAll('.payment-gateway-btn');

		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				buttons.forEach(function (b) { b.classList.remove('active'); });
				btn.classList.add('active');
				selectedGateway = btn.getAttribute('data-gateway');
			});
		});
	}

	/**
	 * Ініціалізація типу донату (разовий / підписка)
	 */
	function initDonationType() {
		const params = new URLSearchParams(window.location.search);
		if (params.get('type') === 'subscribe') {
			donationType = 'subscribe';
			var subscribeTab = document.querySelector('[data-tab="subscribe"]');
			if (subscribeTab) {
				subscribeTab.click();
			}
		}

		document.querySelectorAll('[data-donate-type]').forEach(function (btn) {
			btn.addEventListener('click', function () {
				donationType = btn.getAttribute('data-donate-type');
				document.querySelectorAll('[data-donate-type]').forEach(function (b) {
					b.classList.remove('active');
				});
				btn.classList.add('active');
			});
		});
	}

	/**
	 * Відправити платіж
	 */
	function initPaymentSubmit() {
		const submitBtn = document.querySelector('.donate-submit-btn');

		if (!submitBtn) {
			return;
		}

		submitBtn.addEventListener('click', function (e) {
			e.preventDefault();

			// Валідація
			if (!selectedAmount || selectedAmount < 1) {
				alert('Будь ласка, оберіть або введіть суму');
				return;
			}

			if (!selectedGateway) {
				alert('Будь ласка, оберіть спосіб оплати');
				return;
			}

			// Monobank банка — пряме перенаправлення
			if (selectedGateway === 'monobank' && sarcomaDonate.monobankJarUrl) {
				var amountCents = selectedAmount * 100;
				var jarUrl = sarcomaDonate.monobankJarUrl + '?a=' + amountCents;
				window.open(jarUrl, '_blank');
				return;
			}

			submitBtn.disabled = true;
			var btnText = submitBtn.querySelector('.donate-submit-btn__text');
			if (btnText) {
				btnText.textContent = 'Обробка...';
			}

			// Отримати case_id якщо є
			var caseId = submitBtn.getAttribute('data-case-id') || 0;

			// Відправити запит на створення платежу (LiqPay / WayForPay)
			fetch(sarcomaDonate.restUrl + 'create-payment', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce': sarcomaDonate.nonce,
				},
				body: JSON.stringify({
					gateway: selectedGateway,
					amount: selectedAmount,
					case_id: parseInt(caseId, 10),
					type: donationType,
				}),
			})
				.then(function (response) { return response.json(); })
				.then(function (data) {
					if (data.success && data.form_data) {
						submitPaymentForm(data);
					} else {
						alert(data.error || 'Помилка створення платежу');
						submitBtn.disabled = false;
						if (btnText) btnText.textContent = 'Оплатити';
					}
				})
				.catch(function (error) {
					console.error('Payment error:', error);
					alert('Помилка з\'єднання. Спробуйте пізніше.');
					submitBtn.disabled = false;
					if (btnText) btnText.textContent = 'Оплатити';
				});
		});
	}

	/**
	 * Створити та сабмітнути форму для LiqPay / WayForPay
	 */
	function submitPaymentForm(data) {
		var form = document.createElement('form');
		form.method = data.form_data.method || 'POST';
		form.action = data.form_data.action;
		form.style.display = 'none';

		Object.keys(data.form_data).forEach(function (key) {
			if (key === 'action' || key === 'method') {
				return;
			}

			var value = data.form_data[key];

			if (Array.isArray(value)) {
				value.forEach(function (v) {
					var input = document.createElement('input');
					input.type = 'hidden';
					input.name = key + '[]';
					input.value = v;
					form.appendChild(input);
				});
			} else {
				var input = document.createElement('input');
				input.type = 'hidden';
				input.name = key;
				input.value = value;
				form.appendChild(input);
			}
		});

		document.body.appendChild(form);
		form.submit();
	}

	// Ініціалізація
	document.addEventListener('DOMContentLoaded', function () {
		initAmountButtons();
		initGatewayButtons();
		initDonationType();
		initPaymentSubmit();
		updateSubmitButton();
	});
})();
