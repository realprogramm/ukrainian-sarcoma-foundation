/**
 * Navigation — мобільне меню та sticky header
 *
 * @package Sarcoma_Theme
 */
(function () {
	'use strict';

	var header = document.getElementById('site-header');
	var menuToggle = document.getElementById('menu-toggle');
	var mobileMenu = document.getElementById('mobile-menu');
	var closeBtn = document.getElementById('mobile-menu-close');

	if (!menuToggle || !mobileMenu) {
		return;
	}

	function openMenu() {
		mobileMenu.classList.add('is-open');
		menuToggle.setAttribute('aria-expanded', 'true');
		document.body.style.overflow = 'hidden';
	}

	function closeMenu() {
		mobileMenu.classList.remove('is-open');
		menuToggle.setAttribute('aria-expanded', 'false');
		document.body.style.overflow = '';
	}

	menuToggle.addEventListener('click', function () {
		if (mobileMenu.classList.contains('is-open')) {
			closeMenu();
		} else {
			openMenu();
		}
	});

	if (closeBtn) {
		closeBtn.addEventListener('click', closeMenu);
	}

	// Закрити при кліку на посилання
	mobileMenu.querySelectorAll('a').forEach(function (link) {
		link.addEventListener('click', closeMenu);
	});

	// Закрити при Escape
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && mobileMenu.classList.contains('is-open')) {
			closeMenu();
			menuToggle.focus();
		}
	});

	// Sticky header з тінню при скролі
	if (header) {
		window.addEventListener('scroll', function () {
			if (window.pageYOffset > 50) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}
		}, { passive: true });
	}
})();
