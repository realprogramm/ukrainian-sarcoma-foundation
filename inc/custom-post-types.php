<?php
/**
 * Custom Post Types Registration
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Реєстрація CPT: Кейси (case)
 */
function sarcoma_register_case_cpt() {
	$labels = array(
		'name'               => pll__( 'Кейси' ),
		'singular_name'      => pll__( 'Кейс' ),
		'menu_name'          => pll__( 'Кейси' ),
		'add_new'            => pll__( 'Додати кейс' ),
		'add_new_item'       => pll__( 'Додати новий кейс' ),
		'edit_item'          => pll__( 'Редагувати кейс' ),
		'new_item'           => pll__( 'Новий кейс' ),
		'view_item'          => pll__( 'Переглянути кейс' ),
		'search_items'       => pll__( 'Шукати кейси' ),
		'not_found'          => pll__( 'Кейсів не знайдено' ),
		'not_found_in_trash' => pll__( 'В кошику кейсів не знайдено' ),
		'all_items'          => pll__( 'Усі кейси' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'cases' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-heart',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'case', $args );
}
add_action( 'init', 'sarcoma_register_case_cpt' );

/**
 * Реєстрація CPT: Партнери (partner)
 */
function sarcoma_register_partner_cpt() {
	$labels = array(
		'name'               => pll__( 'Партнери' ),
		'singular_name'      => pll__( 'Партнер' ),
		'menu_name'          => pll__( 'Партнери' ),
		'add_new'            => pll__( 'Додати партнера' ),
		'add_new_item'       => pll__( 'Додати нового партнера' ),
		'edit_item'          => pll__( 'Редагувати партнера' ),
		'new_item'           => pll__( 'Новий партнер' ),
		'view_item'          => pll__( 'Переглянути партнера' ),
		'search_items'       => pll__( 'Шукати партнерів' ),
		'not_found'          => pll__( 'Партнерів не знайдено' ),
		'not_found_in_trash' => pll__( 'В кошику партнерів не знайдено' ),
		'all_items'          => pll__( 'Усі партнери' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'partner', $args );
}
add_action( 'init', 'sarcoma_register_partner_cpt' );

/**
 * Реєстрація CPT: Звіти (report)
 */
function sarcoma_register_report_cpt() {
	$labels = array(
		'name'               => pll__( 'Звіти' ),
		'singular_name'      => pll__( 'Звіт' ),
		'menu_name'          => pll__( 'Звіти' ),
		'add_new'            => pll__( 'Додати звіт' ),
		'add_new_item'       => pll__( 'Додати новий звіт' ),
		'edit_item'          => pll__( 'Редагувати звіт' ),
		'new_item'           => pll__( 'Новий звіт' ),
		'view_item'          => pll__( 'Переглянути звіт' ),
		'search_items'       => pll__( 'Шукати звіти' ),
		'not_found'          => pll__( 'Звітів не знайдено' ),
		'not_found_in_trash' => pll__( 'В кошику звітів не знайдено' ),
		'all_items'          => pll__( 'Усі звіти' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'reports' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
		'menu_icon'          => 'dashicons-analytics',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'report', $args );
}
add_action( 'init', 'sarcoma_register_report_cpt' );

/**
 * Polylang handles CPT archive rewrite rules automatically for translated post types.
 * No manual add_rewrite_rule() needed for /en/cases/ or /en/reports/.
 * Polylang's PLL_Links_Directory::rewrite_rules() adds language-prefixed versions
 * of all CPT archive rules when the post type is in Polylang's translated types.
 *
 * If archives still 404 after adding a CPT to Polylang, flush rewrite rules:
 * WP Admin -> Settings -> Permalinks -> Save (or visit ?flush_rewrite=1).
 */

/**
 * Flush rewrite rules при активації теми
 */
function sarcoma_rewrite_flush() {
	sarcoma_register_case_cpt();
	sarcoma_register_partner_cpt();
	sarcoma_register_report_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'sarcoma_rewrite_flush' );
