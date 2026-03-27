<?php
/**
 * ACF Field Groups Registration (via PHP)
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

/**
 * Поля для кейсів (CPT: case)
 */
acf_add_local_field_group( array(
	'key'      => 'group_case_details',
	'title'    => pll__( 'Деталі кейсу' ),
	'fields'   => array(
		array(
			'key'          => 'field_case_target_amount',
			'label'        => pll__( 'Цільова сума (₴)' ),
			'name'         => 'target_amount',
			'type'         => 'number',
			'required'     => 1,
			'default_value' => 0,
			'min'          => 0,
			'step'         => 1,
		),
		array(
			'key'          => 'field_case_collected_amount',
			'label'        => pll__( 'Зібрано (₴)' ),
			'name'         => 'collected_amount',
			'type'         => 'number',
			'required'     => 0,
			'default_value' => 0,
			'min'          => 0,
			'step'         => 1,
		),
		array(
			'key'           => 'field_case_status',
			'label'         => pll__( 'Статус' ),
			'name'          => 'case_status',
			'type'          => 'select',
			'choices'       => array(
				'active'    => pll__( 'Активний збір' ),
				'completed' => pll__( 'Збір завершено' ),
				'closed'    => pll__( 'Закрито' ),
			),
			'default_value' => 'active',
		),
		array(
			'key'   => 'field_case_patient_age',
			'label' => pll__( 'Вік пацієнта' ),
			'name'  => 'patient_age',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_case_diagnosis',
			'label' => pll__( 'Діагноз' ),
			'name'  => 'diagnosis',
			'type'  => 'text',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'case',
			),
		),
	),
	'menu_order' => 0,
	'position'   => 'normal',
	'style'      => 'default',
) );

/**
 * Поля для партнерів (CPT: partner)
 */
acf_add_local_field_group( array(
	'key'      => 'group_partner_details',
	'title'    => pll__( 'Деталі партнера' ),
	'fields'   => array(
		array(
			'key'   => 'field_partner_url',
			'label' => pll__( 'Посилання на сайт' ),
			'name'  => 'partner_url',
			'type'  => 'url',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'partner',
			),
		),
	),
) );

/**
 * Поля для сторінки "Про фонд" (page-about.php)
 */
acf_add_local_field_group( array(
	'key'      => 'group_about_page',
	'title'    => pll__( 'Про фонд — додаткові поля' ),
	'fields'   => array(
		// Засновник
		array(
			'key'   => 'field_founder_photo',
			'label' => pll__( 'Фото засновника' ),
			'name'  => 'founder_photo',
			'type'  => 'image',
			'return_format' => 'array',
		),
		array(
			'key'   => 'field_founder_name',
			'label' => pll__( "Ім'я засновника" ),
			'name'  => 'founder_name',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_founder_bio',
			'label' => pll__( 'Біографія засновника' ),
			'name'  => 'founder_bio',
			'type'  => 'wysiwyg',
			'media_upload' => 0,
		),
		// Місія та бачення
		array(
			'key'   => 'field_mission_text',
			'label' => pll__( 'Місія' ),
			'name'  => 'mission_text',
			'type'  => 'textarea',
			'rows'  => 4,
		),
		array(
			'key'   => 'field_vision_text',
			'label' => pll__( 'Бачення' ),
			'name'  => 'vision_text',
			'type'  => 'textarea',
			'rows'  => 4,
		),
		// Документи
		array(
			'key'   => 'field_documents',
			'label' => pll__( 'Документи для завантаження' ),
			'name'  => 'documents',
			'type'  => 'repeater',
			'layout' => 'table',
			'sub_fields' => array(
				array(
					'key'   => 'field_doc_title',
					'label' => pll__( 'Назва документа' ),
					'name'  => 'doc_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_doc_file',
					'label' => pll__( 'Файл (PDF)' ),
					'name'  => 'doc_file',
					'type'  => 'file',
					'return_format' => 'array',
					'mime_types'    => 'pdf',
				),
			),
		),
		// Організаційна структура
		array(
			'key'   => 'field_org_structure',
			'label' => pll__( 'Організаційна структура (HTML або зображення)' ),
			'name'  => 'org_structure',
			'type'  => 'wysiwyg',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-about.php',
			),
		),
	),
) );

/**
 * Поля для звітів (CPT: report)
 */
acf_add_local_field_group( array(
	'key'      => 'group_report_details',
	'title'    => pll__( 'Деталі звіту' ),
	'fields'   => array(
		array(
			'key'           => 'field_report_type',
			'label'         => pll__( 'Тип звіту' ),
			'name'          => 'report_type',
			'type'          => 'select',
			'choices'       => array(
				'financial'   => pll__( 'Фінансовий звіт' ),
				'activity'    => pll__( 'Звіт про діяльність' ),
				'annual'      => pll__( 'Річний звіт' ),
				'audit'       => pll__( 'Аудиторський звіт' ),
			),
			'default_value' => 'financial',
		),
		array(
			'key'           => 'field_report_file',
			'label'         => pll__( 'Файл звіту (PDF)' ),
			'name'          => 'report_file',
			'type'          => 'file',
			'return_format' => 'array',
			'mime_types'    => 'pdf',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'report',
			),
		),
	),
) );

/**
 * Поля для сторінки "Партнерам" (page-partners.php)
 */
acf_add_local_field_group( array(
	'key'      => 'group_partners_page',
	'title'    => pll__( 'Партнерам — додаткові поля' ),
	'fields'   => array(
		array(
			'key'           => 'field_partner_presentation',
			'label'         => pll__( 'Презентація фонду (PDF)' ),
			'name'          => 'partner_presentation',
			'type'          => 'file',
			'return_format' => 'array',
			'mime_types'    => 'pdf',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-partners.php',
			),
		),
	),
) );

/**
 * Поля для сторінки "Як допомогти" (page-donate.php)
 */
acf_add_local_field_group( array(
	'key'      => 'group_donate_page',
	'title'    => pll__( 'Як допомогти — додаткові поля' ),
	'fields'   => array(
		// Банківські реквізити
		array(
			'key'   => 'field_bank_name',
			'label' => pll__( 'Назва організації (для переказу)' ),
			'name'  => 'bank_org_name',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_bank_iban',
			'label' => pll__( 'IBAN / Рахунок' ),
			'name'  => 'bank_iban',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_bank_swift',
			'label' => pll__( 'SWIFT-код банку' ),
			'name'  => 'bank_swift',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_bank_address',
			'label' => pll__( 'Адреса банку' ),
			'name'  => 'bank_address',
			'type'  => 'textarea',
			'rows'  => 3,
		),
		// QR-код
		array(
			'key'   => 'field_qr_code',
			'label' => pll__( 'QR-код' ),
			'name'  => 'qr_code_image',
			'type'  => 'image',
			'return_format' => 'array',
		),
	),
	'location' => array(
		array(
			array(
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'page-donate.php',
			),
		),
	),
) );
