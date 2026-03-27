<?php
/**
 * Sarcoma Foundation Theme Functions
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SARCOMA_THEME_VERSION', '1.5.1' );
define( 'SARCOMA_DONATE_URL', 'https://send.monobank.ua/jar/8FafTNXhpf' );
define( 'SARCOMA_THEME_DIR', get_template_directory() );
define( 'SARCOMA_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function sarcoma_theme_setup() {
	// HTML5 розмітка (textdomain loads via after_setup_theme which is correct for WP 6.7+)

	// HTML5 розмітка
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Мініатюри записів
	add_theme_support( 'post-thumbnails' );

	// Кастомний логотип
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 250,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Title tag
	add_theme_support( 'title-tag' );

	// Розміри зображень
	add_image_size( 'case-card', 400, 300, true );
	add_image_size( 'case-hero', 1200, 600, true );
	add_image_size( 'partner-logo', 200, 100, false );

	// Меню
	register_nav_menus( array(
		'primary'  => pll__( 'Головне меню' ),
		'footer'   => pll__( 'Меню у підвалі' ),
	) );
}
add_action( 'after_setup_theme', 'sarcoma_theme_setup' );

/**
 * Реєстрація рядків для перекладу в Polylang
 */
function sarcoma_register_polylang_strings() {
	if ( ! function_exists( 'pll_register_string' ) || ! is_admin() ) {
		return;
	}

	$strings = array(
		// Hero
		'Допоможіть нам рятувати життя',
		'Фонд боротьби з саркомою',
		'Ми допомагаємо хворим на саркому отримати якісну діагностику, лікування та шанс на нове життя. Кожен внесок рятує.',
		'Зробити внесок',
		'Про фонд',
		// Top bar
		'Київ, Україна',
		// Navigation
		'Головне меню',
		'Меню у підвалі',
		// Sections
		'Напрями діяльності',
		'Основні напрямки роботи фонду',
		'Діагностика',
		'Імпланти та операції',
		'Міжнародні консиліуми',
		'Прогрес збору коштів',
		'Наша статистика',
		'Пацієнтам допомогли',
		'Операцій профінансовано',
		'Міжнародних консиліумів',
		'Років роботи',
		'Наші партнери',
		'Кейси',
		'Контакти',
		'Звіти',
		// Donate page
		'Як допомогти',
		'Допоможіть тим, хто зараз бореться з хворобою',
		'Кожен внесок наближає до одужання',
		'Щомісячний внесок — це стабільна підтримка, яка дозволяє фонду планувати допомогу та рятувати більше життів. Навіть невелика сума має значення.',
		'Підтримуйте регулярно',
		'Регулярна підписка',
		'Разовий внесок',
		'Щомісячна підписка',
		'Онлайн-донат',
		'Оберіть спосіб оплати',
		'Оплатити',
		'Вкажіть суму',
		'Інше',
		'Банківські реквізити (SWIFT)',
		'QR-код для переказу',
		'Підтримати',
		'Зібрано',
		'Мета',
		'Прогрес збору',
		'Збір завершено',
		// About page
		'Місія',
		'Бачення',
		'Місія та бачення',
		'Засновник',
		'Організаційна структура',
		'Документи',
		'Презентація фонду',
		// Footer
		'Благодійний фонд допомоги хворим на саркому. Разом ми можемо більше.',
		'Навігація',
		'Ми в соцмережах',
		'Усі права захищені.',
		// Contacts
		'Контактна інформація',
		'Телефон',
		'Email',
		'Адреса',
		'Напишіть нам',
		'Надіслати',
		// Cases
		'Потребують допомоги',
		'Допомогти',
		'Деталі',
		'Усі кейси',
		// Reports
		'Усі звіти',
		'Звіт про діяльність',
		'Фінансовий звіт',
		'Аудиторський звіт',
		'Річний звіт',
		// Partners
		'Корпоративне партнерство',
		'Медичне партнерство',
		'Волонтерство та pro bono',
		'Стати партнером',
		// Blog
		'Статті',
		'Читати',
		'Детальніше',
		'Дізнатися більше',
		// Search
		'Шукати',
		// Common
		'Люди, яким ми допомагаємо. Кожна історія — це реальне життя.',
		'Разом ми можемо зробити більше. Долучайтесь до місії фонду.',
	);

	foreach ( $strings as $string ) {
		pll_register_string( 'sarcoma-theme', $string, 'Sarcoma Theme' );
	}
}
add_action( 'init', 'sarcoma_register_polylang_strings' );

/**
 * ACF fallback — якщо поле порожнє, беремо з UA-версії сторінки
 */
function sarcoma_get_field_fallback( $field_name, $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$value = function_exists( 'get_field' ) ? get_field( $field_name, $post_id ) : '';

	if ( empty( $value ) && function_exists( 'pll_get_post' ) ) {
		$ua_post_id = pll_get_post( $post_id, 'uk' );
		if ( $ua_post_id && $ua_post_id !== $post_id ) {
			$value = get_field( $field_name, $ua_post_id );
		}
	}

	return $value;
}

/**
 * Підключення стилів та скриптів
 */
function sarcoma_enqueue_assets() {
	// Google Fonts
	wp_enqueue_style(
		'sarcoma-google-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap',
		array(),
		null
	);

	// CSS файли
	wp_enqueue_style( 'sarcoma-variables', SARCOMA_THEME_URI . '/assets/css/variables.css', array(), SARCOMA_THEME_VERSION );
	wp_enqueue_style( 'sarcoma-base', SARCOMA_THEME_URI . '/assets/css/base.css', array( 'sarcoma-variables' ), SARCOMA_THEME_VERSION );
	wp_enqueue_style( 'sarcoma-components', SARCOMA_THEME_URI . '/assets/css/components.css', array( 'sarcoma-base' ), SARCOMA_THEME_VERSION );
	wp_enqueue_style( 'sarcoma-layouts', SARCOMA_THEME_URI . '/assets/css/layouts.css', array( 'sarcoma-components' ), SARCOMA_THEME_VERSION );
	wp_enqueue_style( 'sarcoma-responsive', SARCOMA_THEME_URI . '/assets/css/responsive.css', array( 'sarcoma-layouts' ), SARCOMA_THEME_VERSION );
	wp_enqueue_style( 'sarcoma-style', get_stylesheet_uri(), array( 'sarcoma-responsive' ), SARCOMA_THEME_VERSION );

	// JS файли
	wp_enqueue_script( 'sarcoma-navigation', SARCOMA_THEME_URI . '/assets/js/navigation.js', array(), SARCOMA_THEME_VERSION, true );
	wp_enqueue_script( 'sarcoma-main', SARCOMA_THEME_URI . '/assets/js/main.js', array(), SARCOMA_THEME_VERSION, true );

	// Скрипт для донатів тільки на сторінці донатів
	if ( is_page_template( 'page-donate.php' ) || is_page( 'donate' ) ) {
		wp_enqueue_script( 'sarcoma-donations', SARCOMA_THEME_URI . '/assets/js/donations.js', array(), SARCOMA_THEME_VERSION, true );
		wp_localize_script( 'sarcoma-donations', 'sarcomaDonate', array(
			'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
			'restUrl'        => rest_url( 'sarcoma/v1/' ),
			'nonce'          => wp_create_nonce( 'wp_rest' ),
			'monobankJarUrl' => SARCOMA_DONATE_URL,
		) );
	}

	// Локалізація для main.js
	wp_localize_script( 'sarcoma-main', 'sarcomaTheme', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'sarcoma_nonce' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'sarcoma_enqueue_assets' );

/**
 * Підключення модулів теми
 */
require_once SARCOMA_THEME_DIR . '/inc/custom-post-types.php';
require_once SARCOMA_THEME_DIR . '/inc/acf-fields.php';
require_once SARCOMA_THEME_DIR . '/inc/acf-options.php';
require_once SARCOMA_THEME_DIR . '/inc/fundraising.php';
require_once SARCOMA_THEME_DIR . '/inc/payments/payment-handler.php';
require_once SARCOMA_THEME_DIR . '/inc/translations.php';

/**
 * Хелпер: отримати відсоток зібраних коштів
 */
function sarcoma_get_progress_percent( $collected, $target ) {
	if ( empty( $target ) || 0 === (int) $target ) {
		return 0;
	}
	$percent = ( (float) $collected / (float) $target ) * 100;
	return min( round( $percent, 1 ), 100 );
}

/**
 * Хелпер: форматування суми (₴)
 */
function sarcoma_format_amount( $amount ) {
	return number_format( (float) $amount, 0, ',', ' ' ) . ' ₴';
}

/**
 * Додати клас до body
 */
function sarcoma_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'home-page';
	}
	return $classes;
}
add_filter( 'body_class', 'sarcoma_body_classes' );
