<?php
/**
 * Front Page Template — Головна сторінка
 *
 * @package Sarcoma_Theme
 */

get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/activities' );
get_template_part( 'template-parts/statistics' );
get_template_part( 'template-parts/fundraising-progress' );
get_template_part( 'template-parts/latest-cases' );
get_template_part( 'template-parts/partners' );
get_template_part( 'template-parts/cta-donate' );

get_footer();
