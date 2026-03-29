/**
 * Donations — Zaporuka-style donation form
 *
 * @package Sarcoma_Theme
 */
(function () {
	'use strict';

	let donationType = 'one-time';

	/**
	 * Get amount input element
	 */
	function getAmountInput() {
		return document.getElementById('donateAmount');
	}

	/**
	 * Get current amount
	 */
	function getCurrentAmount() {
		var input = getAmountInput();
		return input ? (parseInt(input.value, 10) || 0) : 0;
	}

	/**
	 * Set amount value
	 */
	function setAmount(val) {
		var input = getAmountInput();
		if (input) {
			val = Math.max(0, Math.min(29999, val));
			input.value = val;
		}
	}

	/**
	 * Init tabs (one-time / monthly)
	 */
	function initTabs() {
		var tabs = document.querySelectorAll('.donate-tab');

		// Check URL params
		var params = new URLSearchParams(window.location.search);
		if (params.get('type') === 'subscribe') {
			donationType = 'subscribe';
			tabs.forEach(function (t) {
				t.classList.toggle('active', t.getAttribute('data-donate-type') === 'subscribe');
			});
		}

		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				donationType = tab.getAttribute('data-donate-type');
				tabs.forEach(function (t) { t.classList.remove('active'); });
				tab.classList.add('active');
			});
		});
	}

	/**
	 * Init quick-add buttons (+100, +500, +1000)
	 */
	function initQuickAdd() {
		document.querySelectorAll('.donate-quick-btn').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var addVal = parseInt(btn.getAttribute('data-add'), 10) || 0;
				var current = getCurrentAmount();
				setAmount(current + addVal);
			});
		});
	}

	/**
	 * Init expandable alt cards
	 */
	function initExpandableCards() {
		document.querySelectorAll('.donate-alt-card--expandable').forEach(function (card) {
			var header = card.querySelector('.donate-alt-card__header');
			if (header) {
				header.addEventListener('click', function () {
					card.classList.toggle('open');
				});
			}
		});
	}

	/**
	 * Submit payment — Monobank jar
	 */
	function initPaymentSubmit() {
		var submitBtn = document.getElementById('donateSubmit');
		if (!submitBtn) return;

		submitBtn.addEventListener('click', function (e) {
			e.preventDefault();

			var amount = getCurrentAmount();

			if (!amount || amount < 1) {
				alert('Будь ласка, введіть суму');
				return;
			}

			if (amount > 29999) {
				alert('Максимальна сума переказу з карти — 29 999 ₴. Для більших сум скористайтеся банківським переказом.');
				return;
			}

			// Monobank jar redirect
			if (typeof sarcomaDonate !== 'undefined' && sarcomaDonate.monobankJarUrl) {
				var amountCents = amount * 100;
				var jarUrl = sarcomaDonate.monobankJarUrl + '?a=' + amountCents;
				window.open(jarUrl, '_blank');
			} else {
				// Fallback: direct URL
				var amountCents = amount * 100;
				window.open('https://send.monobank.ua/jar/8FafTNXhpf?a=' + amountCents, '_blank');
			}
		});
	}

	// Init
	document.addEventListener('DOMContentLoaded', function () {
		initTabs();
		initQuickAdd();
		initExpandableCards();
		initPaymentSubmit();
	});
})();
