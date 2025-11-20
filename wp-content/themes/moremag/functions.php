<?php
/* Child theme generated with WPS Child Theme Generator */
if (!function_exists('moremag_theme_enqueue_styles')) {
	add_action('wp_enqueue_scripts', 'moremag_theme_enqueue_styles');

	function moremag_theme_enqueue_styles()
	{
		$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$parent_style = 'morenews-style';
		$gmoremag_version = wp_get_theme()->get('Version');

		wp_enqueue_style(
			'bootstrap',
			get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css',
		);
		wp_enqueue_style(
			$parent_style,
			get_template_directory_uri() . '/style' . $min . '.css',
			[],
			$gmoremag_version,
		);
		wp_enqueue_style(
			'moremag',
			get_stylesheet_directory_uri() . '/style.css',
			['bootstrap', $parent_style],
			wp_get_theme()->get('Version'),
		);

		// Enqueue RTL Styles if the site is in RTL mode
		if (is_rtl()) {
			wp_enqueue_style(
				'morenews-rtl',
				get_template_directory_uri() . '/rtl.css',
				[$parent_style],
				$gmoremag_version,
			);
		}
	}
}

// Set up the WordPress core custom background feature.
add_theme_support(
	'custom-background',
	apply_filters('morenews_custom_background_args', [
		'default-color' => 'f5f5f5',
		'default-image' => '',
	]),
);

function moremag_filter_default_theme_options($defaults)
{
	$defaults['site_title_font_size'] = 56;
	$defaults['secondary_color'] = '#0c794f';
	$defaults['select_main_banner_layout_section'] = 'layout-5';
	$defaults['site_title_uppercase'] = 0;
	$defaults['flash_news_title'] = __('Breaking News', 'moremag');
	$defaults['show_watch_online_section'] = 0;
	$defaults['show_primary_menu_desc'] = 0;
	$defaults['global_show_min_read'] = 'no';
	$defaults['aft_custom_title'] = __('Subscribe', 'moremag');
	$defaults['main_latest_news_section_title'] = __("Editor's Picks", 'moremag');
	$defaults['main_popular_news_section_title'] = __('Trending Now', 'moremag');
	$defaults['frontpage_content_type'] = 'frontpage-widgets-and-content';
	return $defaults;
}
add_filter('morenews_filter_default_theme_options', 'moremag_filter_default_theme_options', 1);

if (!function_exists('moremag_print_secondary_css_var')) {
	function moremag_print_secondary_css_var()
	{
		$secondary = morenews_get_option('secondary_color');
		$secondary = sanitize_hex_color($secondary);
		if (!empty($secondary)) {
			echo '<style id="moremag-secondary-color-var">:root{--secondary-color:' .
				esc_html($secondary) .
				';}</style>';
		}
	}
}
add_action('wp_head', 'moremag_print_secondary_css_var', 20);

function moremag_remove_theme_menu()
{
    remove_menu_page('morenews');
    remove_submenu_page('morenews', 'morenews');
    remove_submenu_page('morenews', 'starter-sites');
    remove_submenu_page('morenews', 'aft-template-kits');
    remove_submenu_page('morenews', 'aft-block-patterns');
    remove_submenu_page('morenews', 'customize.php');
    remove_submenu_page('morenews', 'customize.php?autofocus[section]=header_builder');
    remove_submenu_page('morenews', 'customize.php?autofocus[section]=footer_builder');
}
add_action('admin_menu', 'moremag_remove_theme_menu', 999);
