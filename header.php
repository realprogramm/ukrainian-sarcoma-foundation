<?php
/**
 * Header Template
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Top Bar — контакти та соцмережі -->
<div class="top-bar" id="top-bar">
	<div class="container">
		<div class="top-bar__inner">
			<div class="top-bar__contacts">
				<a href="tel:+380991234567" class="top-bar__item">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
					+380 (99) 123-45-67
				</a>
				<a href="mailto:info@sarcomafund.org" class="top-bar__item">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					info@sarcomafund.org
				</a>
				<span class="top-bar__item top-bar__item--address">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
					<?php pll_esc_html_e( 'Київ, Україна' ); ?>
				</span>
			</div>
			<div class="top-bar__right">
				<div class="top-bar__social">
					<a href="https://facebook.com/" target="_blank" rel="noopener noreferrer" class="top-bar__social-link" aria-label="Facebook">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
					</a>
					<a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" class="top-bar__social-link" aria-label="Instagram">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
					<a href="https://t.me/" target="_blank" rel="noopener noreferrer" class="top-bar__social-link" aria-label="Telegram">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
					</a>
					<a href="https://youtube.com/" target="_blank" rel="noopener noreferrer" class="top-bar__social-link" aria-label="YouTube">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<header class="site-header" id="site-header">
	<div class="container">
		<div class="header-inner">
			<!-- Логотип -->
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo">
				</a>
			</div>

			<!-- Навігація (десктоп — inline) -->
			<nav class="main-navigation main-navigation--desktop" role="navigation" aria-label="<?php pll_esc_attr_e( 'Головне меню' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_class'     => 'nav-menu',
					'container'      => false,
					'fallback_cb'    => false,
					'depth'          => 2,
				) );
				?>
			</nav>

			<!-- Кнопка "Зробити внесок" (десктоп) -->
			<div class="header-cta">
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary btn-donate-header">
					<?php pll_esc_html_e( 'Зробити внесок' ); ?>
				</a>
			</div>

			<!-- Переключатель мови (десктоп, в хедері) -->
			<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
				<div class="lang-switcher lang-switcher--header">
					<ul>
					<?php
					pll_the_languages( array(
						'show_flags'             => 0,
						'show_names'             => 1,
						'hide_current'           => 0,
						'hide_if_no_translation' => 0,
						'display_names_as'       => 'slug',
					) );
					?>
					</ul>
				</div>
			<?php endif; ?>

			<!-- Бургер-кнопка (мобільна) -->
			<button class="menu-toggle" id="menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php pll_esc_attr_e( 'Меню' ); ?>">
				<span class="hamburger-line"></span>
				<span class="hamburger-line"></span>
				<span class="hamburger-line"></span>
			</button>
		</div>
	</div>
</header>

<!-- Мобільне меню — ОКРЕМО від header, прямо на body -->
<div class="mobile-menu" id="mobile-menu">
	<button class="mobile-menu__close" id="mobile-menu-close" aria-label="<?php pll_esc_attr_e( 'Закрити меню' ); ?>">&times;</button>
	<nav role="navigation" aria-label="<?php pll_esc_attr_e( 'Мобільне меню' ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class'     => 'mobile-menu__nav',
			'container'      => false,
			'fallback_cb'    => false,
			'depth'          => 2,
		) );
		?>
	</nav>
	<div class="mobile-menu__extras">
		<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
			<div class="lang-switcher">
				<ul>
				<?php
				pll_the_languages( array(
					'show_flags'             => 0,
					'show_names'             => 1,
					'hide_current'           => 0,
					'hide_if_no_translation' => 0,
					'display_names_as'       => 'slug',
				) );
				?>
				</ul>
			</div>
		<?php endif; ?>
		<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'donate' ) ) ); ?>" class="btn btn-primary mobile-menu__donate">
			<?php pll_esc_html_e( 'Зробити внесок' ); ?>
		</a>
	</div>
</div>

<main class="site-main" id="main-content">
