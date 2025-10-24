<?php
// Front-page

$wp_customize->selective_refresh->add_partial('show_top_header_section', [
	'selector' => 'div.top-header div.date-bar-left',
]);

$wp_customize->selective_refresh->add_partial('banner_advertisement_section', [
	'selector' => 'div.header-promotion',
]);

$wp_customize->selective_refresh->add_partial('aft_custom_link', [
	'selector' => 'div.custom-menu-link',
]);

$wp_customize->selective_refresh->add_partial('flash_news_title', [
	'selector' => 'div.exclusive-now',
]);

$wp_customize->selective_refresh->add_partial('frontpage_popular_tags_section_title', [
	'selector' => 'div.aft-popular-tags > div',
]);

$wp_customize->selective_refresh->add_partial('main_banner_news_section_title', [
	'selector' => 'div.aft-slider-part div.morenews-customizer',
]);

$wp_customize->selective_refresh->add_partial('main_latest_news_section_title', [
	'selector' => 'div.af-main-banner-tabbed-posts',
]);

$wp_customize->selective_refresh->add_partial('main_editors_picks_section_title', [
	'selector' => 'div.af-main-banner-thumb-posts',
]);

$wp_customize->selective_refresh->add_partial('main_trending_news_section_title', [
	'selector' => 'div.aft-trending-part div.morenews-customizer',
]);

$wp_customize->selective_refresh->add_partial('featured_news_section_title', [
	'selector' => 'div.af-main-banner-featured-posts.morenews-customizer',
]);

$wp_customize->selective_refresh->add_partial('show_featured_post_list_section', [
	'selector' => 'section.aft-featured-category-section.morenews-customizer .container-wrapper',
]);

$wp_customize->selective_refresh->add_partial('frontpage_latest_posts_section_title', [
	'selector' => 'div.af-main-banner-latest-posts.morenews-customizer .container-wrapper',
]);

$wp_customize->selective_refresh->add_partial('frontpage_content_type', [
	'selector' => 'body.page-template-tmpl-front-page #content',
]);

$wp_customize->selective_refresh->add_partial('footer_copyright_text', [
	'selector' => 'footer.site-footer .site-info',
]);

$wp_customize->selective_refresh->add_partial('global_scroll_to_top_position', [
	'selector' => 'a#scroll-up',
]);

$wp_customize->selective_refresh->add_partial('select_breadcrumb_mode', [
	'selector' => 'div.af-breadcrumbs',
]);

$wp_customize->selective_refresh->add_partial('global_single_content_mode', [
	'selector' => 'article.af-single-article',
]);

$wp_customize->selective_refresh->add_partial('single_related_posts_title', [
	'selector' => 'div.af-reated-posts',
]);

$wp_customize->selective_refresh->add_partial('archive_layout', [
	'selector' => 'div.aft-archive-wrapper',
]);

$wp_customize->selective_refresh->add_partial('single_show_theme_author_bio', [
	'selector' => 'div.author-box-content',
]);

$wp_customize->selective_refresh->add_partial('enable_site_mode_switch', [
	'selector' => '#aft-dark-light-mode-wrap',
]);
