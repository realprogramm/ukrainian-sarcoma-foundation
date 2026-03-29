/**
 * Main JS — каунтери, прогрес-бари, анімації
 *
 * @package Sarcoma_Theme
 */
(function () {
	'use strict';

	/**
	 * Анімовані каунтери (Intersection Observer)
	 */
	function initCounters() {
		const counters = document.querySelectorAll('.stat-item__number[data-count], .counter[data-count]');

		if (!counters.length) {
			return;
		}

		const animateCounter = function (el) {
			const target = parseInt(el.getAttribute('data-count'), 10);
			const duration = 2000;
			const start = performance.now();

			function update(currentTime) {
				const elapsed = currentTime - start;
				const progress = Math.min(elapsed / duration, 1);

				// Ease-out cubic
				const eased = 1 - Math.pow(1 - progress, 3);
				const current = Math.floor(eased * target);

				el.textContent = current.toLocaleString('uk-UA');

				if (progress < 1) {
					requestAnimationFrame(update);
				} else {
					el.textContent = target.toLocaleString('uk-UA');
				}
			}

			requestAnimationFrame(update);
		};

		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					animateCounter(entry.target);
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 0.1,
		});

		counters.forEach(function (counter) {
			observer.observe(counter);
		});
	}

	/**
	 * Анімовані прогрес-бари (Intersection Observer)
	 */
	function initProgressBars() {
		const bars = document.querySelectorAll('.progress-bar__fill[data-width]');

		if (!bars.length) {
			return;
		}

		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					const targetWidth = entry.target.getAttribute('data-width');
					// Невелика затримка для плавності
					setTimeout(function () {
						entry.target.style.width = targetWidth;
					}, 200);
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 0.2,
		});

		bars.forEach(function (bar) {
			observer.observe(bar);
		});
	}

	/**
	 * Smooth scroll для якірних посилань
	 */
	function initSmoothScroll() {
		document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
			anchor.addEventListener('click', function (e) {
				const target = document.querySelector(this.getAttribute('href'));
				if (target) {
					e.preventDefault();
					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start',
					});
				}
			});
		});
	}

	/**
	 * Анімація появи елементів при скролі
	 */
	function initScrollReveal() {
		const elements = document.querySelectorAll(
			'.activity-card, .case-card, .partner-logo, .stat-item, .fundraising-card'
		);

		if (!elements.length) {
			return;
		}

		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, {
			threshold: 0.1,
			rootMargin: '0px 0px -50px 0px',
		});

		elements.forEach(function (el) {
			el.classList.add('reveal');
			observer.observe(el);
		});
	}

	/**
	 * Фільтр звітів по роках
	 */
	function initReportFilter() {
		var buttons = document.querySelectorAll('.report-filter-btn');
		var cards = document.querySelectorAll('.report-card[data-year]');

		if (!buttons.length || !cards.length) {
			return;
		}

		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var year = this.getAttribute('data-year');

				buttons.forEach(function (b) { b.classList.remove('active'); });
				this.classList.add('active');

				cards.forEach(function (card) {
					if (year === 'all' || card.getAttribute('data-year') === year) {
						card.style.display = '';
					} else {
						card.style.display = 'none';
					}
				});
			});
		});
	}

	/**
	 * Фільтр кейсів по статусу
	 */
	function initCaseFilter() {
		var buttons = document.querySelectorAll('.case-filter-btn');
		var cards = document.querySelectorAll('.case-card[data-status]');

		if (!buttons.length || !cards.length) {
			return;
		}

		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var status = this.getAttribute('data-status');

				buttons.forEach(function (b) { b.classList.remove('active'); });
				this.classList.add('active');

				cards.forEach(function (card) {
					if (status === 'all' || card.getAttribute('data-status') === status) {
						card.style.display = '';
					} else {
						card.style.display = 'none';
					}
				});
			});
		});
	}

	// Ініціалізація
	document.addEventListener('DOMContentLoaded', function () {
		initCounters();
		initProgressBars();
		initSmoothScroll();
		initScrollReveal();
		initReportFilter();
		initCaseFilter();
	});
})();
