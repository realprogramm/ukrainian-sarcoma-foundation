<?php
/**
 * ACF Options Pages & Global Fields
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_options_page' ) ) {
	return;
}

/**
 * Головна сторінка налаштувань фонду
 */
acf_add_options_page( array(
	'page_title' => pll__( 'Налаштування фонду' ),
	'menu_title' => pll__( 'Фонд' ),
	'menu_slug'  => 'sarcoma-settings',
	'capability' => 'edit_posts',
	'redirect'   => false,
	'icon_url'   => 'dashicons-heart',
	'position'   => 2,
) );

/**
 * Підсторінка: Платіжні шлюзи
 */
acf_add_options_sub_page( array(
	'page_title'  => pll__( 'Платіжні шлюзи' ),
	'menu_title'  => pll__( 'Платіжні шлюзи' ),
	'parent_slug' => 'sarcoma-settings',
) );

/**
 * Глобальні поля — Options Page
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {

	// Головні налаштування фонду
	acf_add_local_field_group( array(
		'key'    => 'group_sarcoma_settings',
		'title'  => pll__( 'Загальні налаштування' ),
		'fields' => array(
			// Hero секція
			array(
				'key'   => 'field_hero_title',
				'label' => pll__( 'Hero — заголовок' ),
				'name'  => 'hero_title',
				'type'  => 'text',
				'default_value' => 'Фонд боротьби з саркомою',
			),
			array(
				'key'   => 'field_hero_text',
				'label' => pll__( 'Hero — текст місії' ),
				'name'  => 'hero_text',
				'type'  => 'textarea',
				'rows'  => 4,
				'default_value' => 'Ми допомагаємо хворим на саркому отримати якісну діагностику, лікування та шанс на нове життя.',
			),
			array(
				'key'           => 'field_hero_bg',
				'label'         => pll__( 'Hero — фонове зображення' ),
				'name'          => 'hero_background',
				'type'          => 'image',
				'return_format' => 'url',
			),

			// Прогрес збору (глобальна кампанія)
			array(
				'key'           => 'field_campaign_title',
				'label'         => pll__( 'Назва кампанії збору' ),
				'name'          => 'campaign_title',
				'type'          => 'text',
				'default_value' => 'Загальний збір коштів',
			),
			array(
				'key'           => 'field_campaign_target',
				'label'         => pll__( 'Цільова сума кампанії (₴)' ),
				'name'          => 'campaign_target',
				'type'          => 'number',
				'default_value' => 1000000,
			),
			array(
				'key'           => 'field_campaign_collected',
				'label'         => pll__( 'Зібрано (₴)' ),
				'name'          => 'campaign_collected',
				'type'          => 'number',
				'default_value' => 0,
			),

			// Лічильники статистики
			array(
				'key'    => 'field_statistics',
				'label'  => pll__( 'Статистика (лічильники)' ),
				'name'   => 'statistics',
				'type'   => 'repeater',
				'layout' => 'table',
				'min'    => 1,
				'max'    => 6,
				'sub_fields' => array(
					array(
						'key'   => 'field_stat_number',
						'label' => pll__( 'Число' ),
						'name'  => 'stat_number',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_stat_label',
						'label' => pll__( 'Підпис' ),
						'name'  => 'stat_label',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_stat_suffix',
						'label' => pll__( 'Суфікс (+, %, тощо)' ),
						'name'  => 'stat_suffix',
						'type'  => 'text',
					),
				),
			),

			// Контактна інформація
			array(
				'key'   => 'field_contact_email',
				'label' => pll__( 'Email' ),
				'name'  => 'contact_email',
				'type'  => 'email',
			),
			array(
				'key'   => 'field_contact_phone',
				'label' => pll__( 'Телефон' ),
				'name'  => 'contact_phone',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_contact_address',
				'label' => pll__( 'Адреса' ),
				'name'  => 'contact_address',
				'type'  => 'textarea',
				'rows'  => 3,
			),
			array(
				'key'   => 'field_google_maps_embed',
				'label' => pll__( 'Google Maps — embed код' ),
				'name'  => 'google_maps_embed',
				'type'  => 'textarea',
				'rows'  => 3,
				'instructions' => pll__( 'Вставте iframe код з Google Maps' ),
			),

			// Соціальні мережі
			array(
				'key'    => 'field_social_links',
				'label'  => pll__( 'Соціальні мережі' ),
				'name'   => 'social_links',
				'type'   => 'repeater',
				'layout' => 'table',
				'sub_fields' => array(
					array(
						'key'     => 'field_social_platform',
						'label'   => pll__( 'Платформа' ),
						'name'    => 'platform',
						'type'    => 'select',
						'choices' => array(
							'facebook'  => 'Facebook',
							'instagram' => 'Instagram',
							'telegram'  => 'Telegram',
							'youtube'   => 'YouTube',
							'tiktok'    => 'TikTok',
							'twitter'   => 'X (Twitter)',
						),
					),
					array(
						'key'   => 'field_social_url',
						'label' => pll__( 'Посилання' ),
						'name'  => 'url',
						'type'  => 'url',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'sarcoma-settings',
				),
			),
		),
	) );

	// Налаштування платіжних шлюзів
	acf_add_local_field_group( array(
		'key'    => 'group_payment_settings',
		'title'  => pll__( 'Ключі платіжних шлюзів' ),
		'fields' => array(
			// LiqPay
			array(
				'key'   => 'field_liqpay_public',
				'label' => pll__( 'LiqPay — Public Key' ),
				'name'  => 'liqpay_public_key',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_liqpay_private',
				'label' => pll__( 'LiqPay — Private Key' ),
				'name'  => 'liqpay_private_key',
				'type'  => 'password',
			),
			// WayForPay
			array(
				'key'   => 'field_wfp_merchant',
				'label' => pll__( 'WayForPay — Merchant Account' ),
				'name'  => 'wfp_merchant_account',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_wfp_secret',
				'label' => pll__( 'WayForPay — Secret Key' ),
				'name'  => 'wfp_secret_key',
				'type'  => 'password',
			),
			// Monobank
			array(
				'key'   => 'field_mono_token',
				'label' => pll__( 'Monobank — API Token' ),
				'name'  => 'mono_api_token',
				'type'  => 'password',
			),
			array(
				'key'          => 'field_mono_jar_id',
				'label'        => pll__( 'Monobank — Jar ID (Банка)' ),
				'name'         => 'mono_jar_id',
				'type'         => 'text',
				'instructions' => pll__( 'ID банки для прямих переказів' ),
			),
			// Тестовий режим
			array(
				'key'           => 'field_payment_sandbox',
				'label'         => pll__( 'Тестовий режим (Sandbox)' ),
				'name'          => 'payment_sandbox',
				'type'          => 'true_false',
				'default_value' => 1,
				'ui'            => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'acf-options-платіжні-шлюзи',
				),
			),
		),
	) );
}
