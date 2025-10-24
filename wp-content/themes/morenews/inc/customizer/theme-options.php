<?php

/**
 * Option Panel
 *
 * @package MoreNews
 */

$morenews_default = morenews_get_default_theme_options();
/*theme option panel info*/
require get_template_directory() . '/inc/customizer/frontpage-options.php';

//font and color options
require get_template_directory() . '/inc/customizer/font-color-options.php';

//selective refresh
require get_template_directory() . '/inc/customizer/customizer-refresh.php';

/**
 * Front-page options section
 *
 * @package MoreNews
 */

// Add Front-page Options Panel.
$wp_customize->add_panel('site_header_option_panel', [
	'title' => esc_html__('Header Options', 'morenews'),
	'priority' => 198,
	'capability' => 'edit_theme_options',
]);

/**
 * Header section
 *
 * @package MoreNews
 */

// Front-page Section.
$wp_customize->add_section('header_options_settings', [
	'title' => esc_html__('Header Settings', 'morenews'),
	'priority' => 49,
	'capability' => 'edit_theme_options',
	'panel' => 'site_header_option_panel',
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('enable_site_mode_switch', [
	'default' => $morenews_default['enable_site_mode_switch'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('enable_site_mode_switch', [
	'label' => esc_html__('Site Mode Switch', 'morenews'),
	'section' => 'header_builder',
	'settings' => 'enable_site_mode_switch',
	'type' => 'select',
	'choices' => [
		'aft-enable-mode-switch' => esc_html__('Enable', 'morenews'),
		'aft-disable-mode-switch' => esc_html__('Disable', 'morenews'),
	],
	'priority' => 5,
]);

// Setting - sticky_header_option.
$wp_customize->add_setting('disable_sticky_header_option', [
	'default' => $morenews_default['disable_sticky_header_option'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);
$wp_customize->add_control('disable_sticky_header_option', [
	'label' => esc_html__('Disable Sticky Header', 'morenews'),
	'section' => 'header_builder',
	'type' => 'checkbox',
	'priority' => 5,
	'description' => esc_html__('Sticky header works only with builder at bottom.', 'morenews'),
]);

//section title
$wp_customize->add_setting('show_top_header_section_title', [
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control(
	new MoreNews_Section_Title($wp_customize, 'show_top_header_section_title', [
		'label' => esc_html__('Top Header Section', 'morenews'),
		'section' => 'header_builder',
		'priority' => 10,
	]),
);

// Setting - show_site_title_section.
$wp_customize->add_setting('show_top_header_section', [
	'default' => $morenews_default['show_top_header_section'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('show_top_header_section', [
	'label' => esc_html__('Show Top Header', 'morenews'),
	'section' => 'header_builder',
	'settings' => 'show_top_header_section',
	'type' => 'checkbox',
	'priority' => 10,
	//'active_callback' => 'morenews_top_header_status'
]);

// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings', [
	'title' => esc_html__('Header Advertisement', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'site_header_option_panel',
]);

// Advertisement Section.
// $wp_customize->add_section(
//   'frontpage_advertisement_settings',
//   array(
//     'title' => esc_html__('Header Advertisement', 'morenews'),
//     'priority' => 50,
//     'capability' => 'edit_theme_options',
//     'panel' => 'site_header_option_panel',
//   )
// );

//section title
$wp_customize->add_setting('banner_advertisement_section_title', [
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control(
	new MoreNews_Section_Title($wp_customize, 'banner_advertisement_section_title', [
		'label' => esc_html__('Header Advertisement', 'morenews'),
		'section' => 'header_builder',
		'priority' => 120,
	]),
);

// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section', [
	'default' => $morenews_default['banner_advertisement_section'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'absint',
]);

$wp_customize->add_control(
	new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section', [
		'label' => esc_html__('Header Section Advertisement', 'morenews'),
		'description' => esc_html(
			sprintf(__('Recommended Size %1$s px X %2$s px', 'morenews'), 930, 110),
		),
		'section' => 'header_builder',
		'width' => 930,
		'height' => 110,
		'flex_width' => true,
		'flex_height' => true,
		'priority' => 120,
	]),
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url', [
	'default' => $morenews_default['banner_advertisement_section_url'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
]);
$wp_customize->add_control('banner_advertisement_section_url', [
	'label' => esc_html__('URL Link', 'morenews'),
	'section' => 'header_builder',
	'type' => 'text',
	'priority' => 130,
]);

// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel', [
	'title' => esc_html__('Theme Options', 'morenews'),
	'priority' => 200,
	'capability' => 'edit_theme_options',
]);

// Breadcrumb Section.
$wp_customize->add_section('site_breadcrumb_settings', [
	'title' => esc_html__('Breadcrumb Options', 'morenews'),
	'priority' => 49,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb', [
	'default' => $morenews_default['enable_breadcrumb'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('enable_breadcrumb', [
	'label' => esc_html__('Show breadcrumbs', 'morenews'),
	'section' => 'site_breadcrumb_settings',
	'type' => 'checkbox',
	'priority' => 10,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('select_breadcrumb_mode', [
	'default' => $default['select_breadcrumb_mode'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('select_breadcrumb_mode', [
	'label' => esc_html__('Select Breadcrumbs', 'morenews'),
	'description' => esc_html__(
		"Please ensure that you have enabled the plugin's breadcrumbs before choosing other than Default",
		'morenews',
	),
	'section' => 'site_breadcrumb_settings',
	'settings' => 'select_breadcrumb_mode',
	'type' => 'select',
	'choices' => [
		'default' => esc_html__('Default', 'morenews'),
		'yoast' => esc_html__('Yoast SEO', 'morenews'),
		'rankmath' => esc_html__('Rank Math', 'morenews'),
		'bcn' => esc_html__('NavXT', 'morenews'),
	],
	'priority' => 100,
]);

/**
 * Layout options section
 *
 * @package MoreNews
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings', [
	'title' => esc_html__('Global Settings', 'morenews'),
	'priority' => 9,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader', [
	'default' => $morenews_default['enable_site_preloader'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('enable_site_preloader', [
	'label' => esc_html__('Enable Preloader', 'morenews'),
	'section' => 'site_layout_settings',
	'type' => 'checkbox',
	'priority' => 10,
]);

// Setting - Disable Emoji Script.
$wp_customize->add_setting('disable_wp_emoji', [
	'default' => $morenews_default['disable_wp_emoji'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('disable_wp_emoji', [
	'label' => esc_html__('Disable Emoji Script', 'morenews'),
	'description' => esc_html__('GDPR friendly & better performance', 'morenews'),
	'section' => 'site_layout_settings', // Use your preferred section.
	'type' => 'checkbox',
	'priority' => 10,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment', [
	'default' => $morenews_default['global_content_alignment'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_content_alignment', [
	'label' => esc_html__('Global Content Alignment', 'morenews'),
	'section' => 'site_layout_settings',
	'type' => 'select',
	'choices' => [
		'align-content-left' => esc_html__('Content - Primary sidebar', 'morenews'),
		'align-content-right' => esc_html__('Primary sidebar - Content', 'morenews'),
		'full-width-content' => esc_html__('Full width content', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_fetch_content_image_setting', [
	'default' => $default['global_fetch_content_image_setting'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_fetch_content_image_setting', [
	'label' => esc_html__('Also Show Content Image in Archive', 'morenews'),
	'description' => esc_html__('If there is no Post Featured image set', 'morenews'),
	'section' => 'site_layout_settings',
	'type' => 'select',
	'choices' => [
		'enable' => esc_html__('Enable ', 'morenews'),
		'disable' => esc_html__('Disable', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_toggle_image_lazy_load_setting', [
	'default' => $default['global_toggle_image_lazy_load_setting'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_toggle_image_lazy_load_setting', [
	'label' => esc_html__('Image Lazy Loading', 'morenews'),
	'description' => esc_html__('Set for better performance', 'morenews'),
	'section' => 'site_layout_settings',
	'type' => 'select',
	'choices' => [
		'enable' => esc_html__('Enable ', 'morenews'),
		'disable' => esc_html__('Disable', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_decoding_image_async_setting', [
	'default' => $default['global_decoding_image_async_setting'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_decoding_image_async_setting', [
	'label' => esc_html__('Image Async Decoding', 'morenews'),
	'description' => esc_html__('Set to enhance rendering speed', 'morenews'),
	'section' => 'site_layout_settings',
	'type' => 'select',
	'choices' => [
		'enable' => esc_html__('Enable ', 'morenews'),
		'disable' => esc_html__('Disable', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_scroll_to_top_position', [
	'default' => $morenews_default['global_scroll_to_top_position'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_scroll_to_top_position', [
	'label' => esc_html__('Scroll to Top Position', 'morenews'),
	'section' => 'site_layout_settings',
	'settings' => 'global_scroll_to_top_position',
	'type' => 'select',
	'choices' => [
		'right' => esc_html__('Right', 'morenews'),
		'left' => esc_html__('Left', 'morenews'),
	],
	'priority' => 130,
]);

// Global Section.
$wp_customize->add_section('site_categories_settings', [
	'title' => esc_html__('Categories Settings', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_categories', [
	'default' => $morenews_default['global_show_categories'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_show_categories', [
	'label' => esc_html__('Post Categories', 'morenews'),
	'section' => 'site_categories_settings',
	'type' => 'select',
	'choices' => [
		'yes' => esc_html__('Show', 'morenews'),
		'no' => esc_html__('Hide', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_number_of_categories', [
	'default' => $morenews_default['global_number_of_categories'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_number_of_categories', [
	'label' => esc_html__('Categories to be displayed', 'morenews'),
	'section' => 'site_categories_settings',
	'type' => 'select',
	'choices' => [
		'all' => esc_html__('Show All', 'morenews'),
		'one' => esc_html__('Top One Category', 'morenews'),
	],
	'priority' => 130,
	'active_callback' => 'morenews_global_show_category_number_status',
]);

// Setting - sticky_header_option.
$wp_customize->add_setting('global_custom_number_of_categories', [
	'default' => $morenews_default['global_custom_number_of_categories'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'absint',
]);
$wp_customize->add_control('global_custom_number_of_categories', [
	'label' => esc_html__('Number of Categories', 'morenews'),
	'section' => 'site_categories_settings',
	'type' => 'number',
	'priority' => 130,
	'active_callback' => 'morenews_global_show_custom_category_number_status',
]);

// Global Section.
$wp_customize->add_section('site_author_and_date_settings', [
	'title' => esc_html__('Author and Date Settings', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_author_icon_gravatar_display_setting', [
	'default' => $morenews_default['global_author_icon_gravatar_display_setting'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_author_icon_gravatar_display_setting', [
	'label' => esc_html__('Author Icon', 'morenews'),
	'section' => 'site_author_and_date_settings',
	'type' => 'select',
	'choices' => [
		'display-gravatar' => esc_html__('Show Gravatar', 'morenews'),
		'display-icon' => esc_html__('Show Icon', 'morenews'),
		'display-none' => esc_html__('None', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_date_display_setting', [
	'default' => $morenews_default['global_date_display_setting'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_date_display_setting', [
	'label' => esc_html__('Date Format', 'morenews'),
	'section' => 'site_author_and_date_settings',
	'type' => 'select',
	'choices' => [
		'default-date' => esc_html__('WordPress Default Date Format', 'morenews'),
		'theme-date' => esc_html__('Ago Date Format', 'morenews'),
	],
	'priority' => 130,
]);

//========== minutes read count options ===============

// Global Section.
$wp_customize->add_section('site_min_read_settings', [
	'title' => esc_html__('Minutes Read Count', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_show_min_read', [
	'default' => $morenews_default['global_show_min_read'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_show_min_read', [
	'label' => esc_html__('Minutes Read Count', 'morenews'),
	'section' => 'site_min_read_settings',
	'type' => 'select',
	'choices' => [
		'yes' => esc_html__('Show', 'morenews'),
		'no' => esc_html__('Hide', 'morenews'),
	],
	'priority' => 130,
]);

// Global Section.
$wp_customize->add_section('site_excerpt_settings', [
	'title' => esc_html__('Excerpt Settings', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - related posts.
$wp_customize->add_setting('global_read_more_texts', [
	'default' => $morenews_default['global_read_more_texts'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('global_read_more_texts', [
	'label' => __('Global Excerpt Read More', 'morenews'),
	'section' => 'site_excerpt_settings',
	'type' => 'text',
	'priority' => 130,
]);

//============= Watch Online Section ==========
//section title
$wp_customize->add_setting('show_watch_online_section_section_title', [
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control(
	new MoreNews_Section_Title($wp_customize, 'show_watch_online_section_section_title', [
		'label' => esc_html__('Primary Menu Section', 'morenews'),
		'section' => 'header_builder',
		'priority' => 100,
	]),
);

$wp_customize->add_setting('show_primary_menu_desc', [
	'default' => $morenews_default['show_primary_menu_desc'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('show_primary_menu_desc', [
	'label' => esc_html__('Show Primary Menu Description', 'morenews'),
	'section' => 'header_builder',
	'type' => 'checkbox',
	'priority' => 100,
]);

$wp_customize->add_setting('show_watch_online_section', [
	'default' => $morenews_default['show_watch_online_section'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('show_watch_online_section', [
	'label' => esc_html__('Enable Custom Menu Section', 'morenews'),
	'section' => 'header_builder',
	'type' => 'checkbox',
	'priority' => 100,
	'active_callback' => 'morenews_is_inactive_builder',
]);

// Setting - related posts.
$wp_customize->add_setting('aft_custom_title', [
	'default' => $morenews_default['aft_custom_title'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('aft_custom_title', [
	'label' => __('Title', 'morenews'),
	'section' => 'header_builder',
	'type' => 'text',
	'priority' => 100,
	'active_callback' => 'morenews_show_watch_online_section_status',
]);

// Setting - related posts.
$wp_customize->add_setting('aft_custom_link', [
	'default' => $morenews_default['aft_custom_link'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
]);

$wp_customize->add_control('aft_custom_link', [
	'label' => __('Link', 'morenews'),
	'section' => 'header_builder',
	'settings' => 'aft_custom_link',
	'type' => 'text',
	'priority' => 100,
	'active_callback' => 'morenews_show_watch_online_section_status',
]);

//========== single posts options ===============

// Single Section.
$wp_customize->add_section('site_single_posts_settings', [
	'title' => esc_html__('Single Post', 'morenews'),
	'priority' => 9,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - related posts.
$wp_customize->add_setting('single_show_featured_image', [
	'default' => $morenews_default['single_show_featured_image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('single_show_featured_image', [
	'label' => __('Show Featured Image', 'morenews'),
	'section' => 'site_single_posts_settings',
	'type' => 'checkbox',
	'priority' => 100,
]);

$wp_customize->add_setting('single_featured_image_view', [
	'default' => $morenews_default['single_featured_image_view'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('single_featured_image_view', [
	'label' => esc_html__('Featured Image Width', 'morenews'),
	'section' => 'site_single_posts_settings',
	'type' => 'select',
	'choices' => [
		'full' => esc_html__('Full - Default', 'morenews'),
		'original' => esc_html__('Original', 'morenews'),
	],
	'priority' => 100,
	'active_callback' => 'morenews_featured_image_status',
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('global_single_content_mode', [
	'default' => $default['global_single_content_mode'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('global_single_content_mode', [
	'label' => esc_html__('Single Content Mode', 'morenews'),
	'section' => 'site_single_posts_settings',
	'settings' => 'global_single_content_mode',
	'type' => 'select',
	'choices' => [
		'single-content-mode-default' => esc_html__('Default', 'morenews'),
		'single-content-mode-boxed' => esc_html__('Spacious', 'morenews'),
	],
	'priority' => 100,
]);

//Social share option

if (class_exists('Jetpack') && Jetpack::is_module_active('sharedaddy')):
	$wp_customize->add_setting('single_post_social_share_view', [
		'default' => $morenews_default['single_post_social_share_view'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'morenews_sanitize_select',
	]);

	$wp_customize->add_control('single_post_social_share_view', [
		'label' => esc_html__('Social Share Option', 'morenews'),
		'description' => esc_html__('Social Share from Jetpack plugin', 'morenews'),
		'section' => 'site_single_posts_settings',
		'type' => 'select',
		'choices' => [
			'after-title-default' => esc_html__('Top - Default', 'morenews'),
			'after-content' => esc_html__('Bottom', 'morenews'),
		],
		'priority' => 100,
	]);
endif;

// Setting - trending posts.
$wp_customize->add_setting('single_show_theme_author_bio', [
	'default' => $default['single_show_theme_author_bio'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('single_show_theme_author_bio', [
	'label' => __('Show Author Bio under Content', 'morenews'),
	'section' => 'site_single_posts_settings',
	'settings' => 'single_show_theme_author_bio',
	'type' => 'checkbox',
	'priority' => 100,
]);

// Setting - trending posts.
$wp_customize->add_setting('single_show_tags_list', [
	'default' => $default['single_show_tags_list'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('single_show_tags_list', [
	'label' => __('Show Tags under Content', 'morenews'),
	'section' => 'site_single_posts_settings',
	'settings' => 'single_show_tags_list',
	'type' => 'checkbox',
	'priority' => 100,
]);

//========== related posts  options ===============

$wp_customize->add_setting('single_related_posts_section_title', [
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control(
	new MoreNews_Section_Title($wp_customize, 'single_related_posts_section_title', [
		'label' => esc_html__('Related Posts Settings', 'morenews'),
		'section' => 'site_single_posts_settings',
		'priority' => 100,
	]),
);

// Setting - related posts.
$wp_customize->add_setting('single_show_related_posts', [
	'default' => $morenews_default['single_show_related_posts'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('single_show_related_posts', [
	'label' => __('Enable Related Posts', 'morenews'),
	'section' => 'site_single_posts_settings',
	'type' => 'checkbox',
	'priority' => 100,
]);

// Setting - related posts.
$wp_customize->add_setting('single_related_posts_title', [
	'default' => $morenews_default['single_related_posts_title'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('single_related_posts_title', [
	'label' => __('Title', 'morenews'),
	'section' => 'site_single_posts_settings',
	'settings' => 'single_related_posts_title',
	'type' => 'text',
	'priority' => 100,
	'active_callback' => 'morenews_related_posts_status',
]);

/**
 * Archive options section
 *
 * @package MoreNews
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings', [
	'title' => esc_html__('Archive Settings', 'morenews'),
	'priority' => 9,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Disable main banner in blog
$wp_customize->add_setting('disable_main_banner_on_blog_archive', [
	'default' => $default['disable_main_banner_on_blog_archive'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('disable_main_banner_on_blog_archive', [
	'label' => esc_html__('Disable Main Banner on Blog', 'morenews'),
	'section' => 'site_archive_settings',
	'type' => 'checkbox',
	'priority' => 50,
	'active_callback' => 'morenews_main_banner_section_status',
]);

//Setting - archive content view of news.
$wp_customize->add_setting('archive_layout', [
	'default' => $morenews_default['archive_layout'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('archive_layout', [
	'label' => esc_html__('Archive layout', 'morenews'),
	'description' => esc_html__('Select layout for archive', 'morenews'),
	'section' => 'site_archive_settings',
	'settings' => 'archive_layout',
	'type' => 'select',
	'choices' => [
		'archive-layout-list' => esc_html__('List', 'morenews'),
		'archive-layout-full' => esc_html__('Full', 'morenews'),
	],
	'priority' => 130,
]);

// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment', [
	'default' => $morenews_default['archive_image_alignment'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('archive_image_alignment', [
	'label' => esc_html__('Image Alignment', 'morenews'),
	'description' => esc_html__('Select image alignment for archive', 'morenews'),
	'section' => 'site_archive_settings',
	'type' => 'select',
	'choices' => [
		'archive-image-left' => esc_html__('Left', 'morenews'),
		'archive-image-right' => esc_html__('Right', 'morenews'),
	],
	'priority' => 130,
	'active_callback' => 'morenews_archive_image_status',
]);

//Settings - archive content full view
$wp_customize->add_setting('archive_layout_full', [
	'default' => $morenews_default['archive_layout_full'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('archive_layout_full', [
	'label' => esc_html__('Select Title Position', 'morenews'),
	'description' => esc_html__('Select full layout for archive', 'morenews'),
	'section' => 'site_archive_settings',
	'type' => 'select',
	'choices' => [
		'full-image-first' => esc_html__('After Image', 'morenews'),
		'full-title-first' => esc_html__('Before Image', 'morenews'),
	],
	'priority' => 130,
	'active_callback' => 'morenews_archive_full_status',
]);

//Setting - archive content view of news.
$wp_customize->add_setting('archive_content_view', [
	'default' => $morenews_default['archive_content_view'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('archive_content_view', [
	'label' => esc_html__('Content View', 'morenews'),
	'description' => esc_html__('Select content view for archive', 'morenews'),
	'section' => 'site_archive_settings',
	'type' => 'select',
	'choices' => [
		'archive-content-excerpt' => esc_html__('Post Excerpt', 'morenews'),
		'archive-content-full' => esc_html__('Full Content', 'morenews'),
		'archive-content-none' => esc_html__('None', 'morenews'),
	],
	'priority' => 130,
]);

//========== sidebar blocks options ===============

// Trending Section.
$wp_customize->add_section('sidebar_block_settings', [
	'title' => esc_html__('Sidebar Settings', 'morenews'),
	'priority' => 9,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting - frontpage_sticky_sidebar.
$wp_customize->add_setting('frontpage_sticky_sidebar', [
	'default' => $default['frontpage_sticky_sidebar'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('frontpage_sticky_sidebar', [
	'label' => esc_html__('Make Sidebar Sticky', 'morenews'),
	'section' => 'sidebar_block_settings',
	'type' => 'checkbox',
	'priority' => 100,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('frontpage_sticky_sidebar_position', [
	'default' => $default['frontpage_sticky_sidebar_position'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_select',
]);

$wp_customize->add_control('frontpage_sticky_sidebar_position', [
	'label' => esc_html__('Sidebar Sticky Position', 'morenews'),
	'section' => 'sidebar_block_settings',
	'type' => 'select',
	'choices' => [
		'sidebar-sticky-top' => esc_html__('Top', 'morenews'),
		'sidebar-sticky-bottom' => esc_html__('Bottom', 'morenews'),
	],
	'priority' => 100,
	'active_callback' => 'frontpage_sticky_sidebar_status',
]);

//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings', [
	'title' => esc_html__('You May Have Missed', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts', [
	'default' => $morenews_default['frontpage_show_latest_posts'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('frontpage_show_latest_posts', [
	'label' => __('Show Above Footer', 'morenews'),
	'section' => 'frontpage_latest_posts_settings',
	'type' => 'checkbox',
	'priority' => 100,
]);

// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title', [
	'default' => $morenews_default['frontpage_latest_posts_section_title'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('frontpage_latest_posts_section_title', [
	'label' => esc_html__('Posts Section Title', 'morenews'),
	'section' => 'frontpage_latest_posts_settings',
	'settings' => 'frontpage_latest_posts_section_title',
	'type' => 'text',
	'priority' => 100,
	'active_callback' => 'morenews_latest_news_section_status',
]);

//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings', [
	'title' => esc_html__('Footer', 'morenews'),
	'priority' => 50,
	'capability' => 'edit_theme_options',
	'panel' => 'theme_option_panel',
]);

// Setting banner_advertisement_section.
$wp_customize->add_setting('footer_background_image', [
	'default' => $default['footer_background_image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'absint',
]);

$wp_customize->add_control(
	new WP_Customize_Cropped_Image_Control($wp_customize, 'footer_background_image', [
		'label' => esc_html__('Footer Background Image', 'morenews'),
		'description' => esc_html(
			sprintf(__('Recommended Size %1$s px X %2$s px', 'morenews'), 1024, 800),
		),
		'section' => 'footer_builder',
		'width' => 1024,
		'height' => 800,
		'flex_width' => true,
		'flex_height' => true,
		'priority' => 100,
	]),
);

// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text', [
	'default' => $morenews_default['footer_copyright_text'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('footer_copyright_text', [
	'label' => __('Copyright Text', 'morenews'),
	'section' => 'footer_builder',
	'settings' => 'footer_copyright_text',
	'type' => 'text',
	'priority' => 100,
]);

// Setting - global content alignment of news.
$wp_customize->add_setting('hide_footer_menu_section', [
	'default' => $morenews_default['hide_footer_menu_section'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'morenews_sanitize_checkbox',
]);

$wp_customize->add_control('hide_footer_menu_section', [
	'label' => __('Hide footer Menu Section', 'morenews'),
	'section' => 'footer_builder',
	'type' => 'checkbox',
	'priority' => 100,
]);
