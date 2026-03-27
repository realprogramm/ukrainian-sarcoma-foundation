<?php
/**
 * Polylang String Translations Registration
 *
 * Registers all theme strings with Polylang so they can be
 * translated via Polylang String Translations admin page.
 *
 * @package Sarcoma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Translate blogdescription (site tagline) for EN language.
 */
add_filter( 'option_blogdescription', function( $value ) {
	if ( function_exists( 'pll_current_language' ) && pll_current_language() === 'en' ) {
		return 'Charitable foundation fighting sarcoma';
	}
	return $value;
} );

/**
 * Register theme strings for Polylang translation.
 */
function sarcoma_register_strings() {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$strings = sarcoma_get_translatable_strings();

	foreach ( $strings as $group => $items ) {
		foreach ( $items as $name => $string ) {
			pll_register_string( $name, $string, $group, ( strlen( $string ) > 80 ) );
		}
	}
}
add_action( 'init', 'sarcoma_register_strings' );

/**
 * Get all translatable strings organized by group.
 *
 * @return array
 */
function sarcoma_get_translatable_strings() {
	return array(
		// ---- Header & Footer ----
		'Header & Footer' => array(
			'main_menu_label'    => 'Головне меню',
			'donate_btn'         => 'Зробити внесок',
			'menu_label'         => 'Меню',
			'footer_desc'        => 'Благодійний фонд допомоги хворим на саркому. Разом ми можемо більше.',
			'navigation'         => 'Навігація',
			'contacts'           => 'Контакти',
			'social_title'       => 'Ми в соцмережах',
			'copyright'          => 'Усі права захищені.',
		),

		// ---- Hero ----
		'Hero' => array(
			'hero_subtitle' => 'Допоможіть нам рятувати життя',
			'hero_title'    => 'Фонд боротьби з саркомою',
			'hero_desc'     => 'Ми допомагаємо хворим на саркому отримати якісну діагностику, лікування та шанс на нове життя. Кожен внесок рятує.',
			'hero_btn1'     => 'Зробити внесок',
			'hero_btn2'     => 'Про фонд',
		),

		// ---- Activities ----
		'Activities' => array(
			'activities_title'          => 'Напрями діяльності',
			'activities_subtitle'       => 'Основні напрямки роботи фонду',
			'activities_page_subtitle'  => 'Три ключові напрями, в яких ми допомагаємо пацієнтам із саркомою',
			'diagnostics'               => 'Діагностика',
			'diagnostics_desc'          => 'Забезпечуємо доступ до сучасних методів діагностики саркоми, включаючи біопсію, МРТ, КТ та генетичні дослідження.',
			'diagnostics_full_desc'     => 'Забезпечуємо доступ до сучасних методів діагностики саркоми: біопсія, МРТ, КТ, ПЕТ-КТ, генетичні та імуногістохімічні дослідження. Рання діагностика рятує життя.',
			'diagnostics_item1'         => 'Біопсія та гістологія',
			'diagnostics_item2'         => 'МРТ та КТ дослідження',
			'diagnostics_item3'         => 'ПЕТ-КТ сканування',
			'diagnostics_item4'         => 'Генетичні дослідження',
			'implants'                  => 'Імпланти та операції',
			'implants_desc'             => 'Фінансуємо хірургічні втручання, імпланти та протези для пацієнтів із саркомою кісток та м\'яких тканин.',
			'implants_full_desc'        => 'Фінансуємо хірургічні втручання, онкологічні ендопротези та реконструктивні операції для пацієнтів із саркомою кісток та м\'яких тканин.',
			'implants_item1'            => 'Ендопротезування',
			'implants_item2'            => 'Реконструктивна хірургія',
			'implants_item3'            => 'Кісткова трансплантація',
			'implants_item4'            => 'Післяопераційна реабілітація',
			'consultations'             => 'Міжнародні консиліуми',
			'consultations_desc'        => 'Організовуємо консультації з провідними міжнародними онкологами для визначення оптимальної стратегії лікування.',
			'consultations_full_desc'   => 'Організовуємо консультації з провідними міжнародними онкологами для визначення оптимальної стратегії лікування кожного пацієнта.',
			'consultations_item1'       => 'Консультації з експертами ЄС та США',
			'consultations_item2'       => 'Другу медичну думку',
			'consultations_item3'       => 'Телемедичні консиліуми',
			'consultations_item4'       => 'Направлення у закордонні клініки',
			'learn_more'                => 'Дізнатися більше',
			'help_btn'                  => 'Допомогти',
		),

		// ---- Statistics ----
		'Statistics' => array(
			'stats_title'  => 'Наша статистика',
			'stat_1'       => 'Пацієнтам допомогли',
			'stat_2'       => 'Операцій профінансовано',
			'stat_3'       => 'Міжнародних консиліумів',
			'stat_4'       => 'Років роботи',
		),

		// ---- Fundraising ----
		'Fundraising' => array(
			'fundraising_title'  => 'Прогрес збору коштів',
			'fundraising_label'  => 'Загальний збір коштів',
			'collected'          => 'Зібрано',
			'goal'               => 'Мета',
			'support_btn'        => 'Підтримати',
		),

		// ---- Cases ----
		'Cases' => array(
			'cases_title'        => 'Кейси',
			'cases_subtitle'     => 'Люди, яким ми допомагаємо. Кожна історія — це реальне життя.',
			'need_help'          => 'Потребують допомоги',
			'need_help_subtitle' => 'Допоможіть тим, хто зараз бореться з хворобою',
			'collection_done'    => 'Збір завершено',
			'collected_badge'    => 'Зібрано!',
			'of_amount'          => 'з %s',
			'details'            => 'Деталі',
			'all_cases'          => 'Усі кейси',
			'cases_soon'         => 'Кейси з\'являться найближчим часом.',
			'patient_age'        => 'Вік пацієнта:',
			'collection_done2'   => 'Збір завершено!',
			'progress_label'     => 'Прогрес збору',
		),

		// ---- About ----
		'About' => array(
			'about_title'       => 'Про фонд',
			'about_subtitle'    => 'Історія, місія та люди, які стоять за фондом',
			'history'           => 'Історія створення',
			'founder'           => 'Засновник',
			'mission_vision'    => 'Місія та бачення',
			'mission'           => 'Місія',
			'vision'            => 'Бачення',
			'documents'         => 'Документи',
			'org_structure'     => 'Організаційна структура',
		),

		// ---- Donate ----
		'Donate' => array(
			'donate_title'       => 'Як допомогти',
			'donate_subtitle'    => 'Кожен внесок наближає до одужання',
			'donate_thanks'      => 'Дякуємо за ваш внесок!',
			'donate_success'     => 'Ваш платіж успішно оброблено. Дякуємо за підтримку фонду!',
			'online_donate'      => 'Онлайн-донат',
			'one_time'           => 'Разовий внесок',
			'monthly_sub'        => 'Щомісячна підписка',
			'other_amount'       => 'Інша сума',
			'choose_payment'     => 'Оберіть спосіб оплати',
			'pay_btn'            => 'Оплатити',
			'bank_details'       => 'Банківські реквізити (SWIFT)',
			'bank_desc'          => 'Для міжнародних банківських переказів використовуйте наступні реквізити:',
			'recipient'          => 'Отримувач',
			'iban'               => 'IBAN',
			'swift'              => 'SWIFT',
			'bank_address'       => 'Адреса банку',
			'bank_soon'          => 'Реквізити будуть додані найближчим часом. Зверніться до нас за деталями.',
			'qr_title'           => 'QR-код для переказу',
		),

		// ---- Contacts ----
		'Contacts' => array(
			'contacts_title'     => 'Контакти',
			'contacts_subtitle'  => 'Зв\'яжіться з нами — ми завжди відкриті до спілкування',
			'write_us'           => 'Напишіть нам',
			'name_field'         => 'Ім\'я',
			'email_field'        => 'Email',
			'message_field'      => 'Повідомлення',
			'send_btn'           => 'Надіслати',
			'contact_info'       => 'Контактна інформація',
			'phone'              => 'Телефон',
			'address'            => 'Адреса',
			'contact_soon'       => 'Контактна інформація буде додана найближчим часом.',
		),

		// ---- Reports ----
		'Reports' => array(
			'reports_title'     => 'Звіти',
			'reports_subtitle'  => 'Прозорість — наш головний принцип. Тут ви знайдете фінансові та діяльнісні звіти фонду.',
			'all_filter'        => 'Усі',
			'report_label'      => 'Звіт',
			'download_pdf'      => 'Завантажити PDF',
			'more_details'      => 'Детальніше',
			'reports_soon'      => 'Звіти будуть опубліковані найближчим часом.',
			'financial_info'    => 'Фінансова інформація',
			'all_reports'       => 'Усі звіти',
		),

		// ---- Partners ----
		'Partners' => array(
			'partners_title'      => 'Партнерам',
			'partners_subtitle'   => 'Разом ми можемо зробити більше. Долучайтесь до місії фонду.',
			'cooperation_title'   => 'Формати співпраці',
			'corporate'           => 'Корпоративне партнерство',
			'corporate_desc'      => 'Спільні проєкти, благодійні акції та корпоративна соціальна відповідальність. Ваш бренд стає частиною важливої місії.',
			'medical'             => 'Медичне партнерство',
			'medical_desc'        => 'Співпраця з клініками, лабораторіями та медичними центрами для забезпечення діагностики та лікування пацієнтів.',
			'volunteer'           => 'Волонтерство та pro bono',
			'volunteer_desc'      => 'Юридична, маркетингова, IT-підтримка або волонтерська допомога — будь-яка експертиза цінна для фонду.',
			'presentation_title'  => 'Презентація фонду',
			'presentation_desc'   => 'Завантажте презентацію фонду для ознайомлення з нашою діяльністю та можливостями співпраці.',
			'download_pres'       => 'Завантажити презентацію',
			'our_partners'        => 'Наші партнери',
			'become_partner'      => 'Стати партнером',
			'partner_form_desc'   => 'Заповніть форму, і ми зв\'яжемось з вами для обговорення можливостей співпраці.',
			'company_name'        => 'Назва компанії / організації',
			'contact_person'      => 'Контактна особа',
			'cooperation_format'  => 'Формат співпраці',
			'choose_option'       => 'Оберіть...',
			'volunteer_probono'   => 'Волонтерство / Pro bono',
			'other'               => 'Інше',
			'send_request'        => 'Надіслати запит',
		),

		// ---- Blog ----
		'Blog' => array(
			'blog_title'     => 'База знань',
			'blog_subtitle'  => 'Корисні статті про саркому, лікування та підтримку пацієнтів',
			'search_placeholder' => 'Пошук статей...',
			'search_btn'     => 'Шукати',
			'read_btn'       => 'Читати',
			'articles_soon'  => 'Статті з\'являться найближчим часом.',
		),

		// ---- CTA Donate ----
		'CTA' => array(
			'cta_title'   => 'Підтримуйте регулярно',
			'cta_desc'    => 'Щомісячний внесок — це стабільна підтримка, яка дозволяє фонду планувати допомогу та рятувати більше життів. Навіть невелика сума має значення.',
			'cta_monthly' => 'Регулярна підписка',
			'cta_onetime' => 'Разовий внесок',
		),

		// ---- Search ----
		'Search' => array(
			'search_results'  => 'Результати пошуку: «%s»',
			'found_results'   => 'Знайдено результатів: %d',
			'search_ph'       => 'Пошук...',
			'nothing_found'   => 'На жаль, нічого не знайдено. Спробуйте інший запит.',
		),

		// ---- Category ----
		'Category' => array(
			'category_title'  => 'Статті в категорії',
			'no_articles'     => 'У цій категорії поки що немає статей.',
		),

		// ---- Single Post ----
		'Single' => array(
			'updated_date' => 'Оновлено: %s',
		),

		// ---- Activity Single ----
		'Activity Single' => array(
			'need_help_single' => 'Потребують допомоги',
		),
	);
}
