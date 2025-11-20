<?php

/**
 * List block part for displaying header content in page.php
 *
 * @package MoreNews
 */

$select_header_image_mode = morenews_get_option('select_header_image_mode');
$morenews_class = '';
$morenews_background = '';
$inline_style = '';
if (has_header_image()) {
	if ($select_header_image_mode == 'above') {
		$morenews_class = 'af-header-image';
	} else {
		$morenews_class = 'af-header-image data-bg';
		$morenews_background = get_header_image();
		// Set inline style for background-image
		$inline_style = 'style="background-image: url(' . esc_url($morenews_background) . ');"';
	}
}
$morenews_show_top_header_section = morenews_get_option('show_top_header_section');
?>
<?php if ($morenews_show_top_header_section): ?>
  <div class="top-header">
    <div class="container-wrapper">
      <div class="top-bar-flex">
        <div class="top-bar-left col-2">
          <div class="date-bar-left">
            <?php do_action('morenews_load_date'); ?>
          </div>
        </div>
        <div class="top-bar-right col-2">
          <div class="aft-small-social-menu">
            <?php do_action('morenews_load_social_menu'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<div class="af-middle-header <?php echo esc_attr($morenews_class); ?>" <?php echo $inline_style; ?>>
  <div class="container-wrapper">

    <?php if (has_header_image() && $select_header_image_mode == 'above'): ?>
      <div class="header-image-above-site-title">
        <img src="<?php echo esc_url(get_header_image()); ?>" alt="<?php echo esc_attr(
	get_bloginfo('title'),
); ?>" />
      </div>
    <?php endif; ?>
    <div class="af-middle-container">
      <div class="logo">
        <?php do_action('morenews_load_site_branding'); ?>
      </div>
      <?php
      $morenews_banner_advertisement = morenews_get_option('banner_advertisement_section');
      if ('' != $morenews_banner_advertisement || is_active_sidebar('home-advertisement-widgets')) {
      	$morenews_banner_advertisement_scope = morenews_get_option('banner_advertisement_scope');
      	if ($morenews_banner_advertisement_scope == 'front-page-only'):
      		if (is_home() || is_front_page()): ?>
            <div class="header-promotion">
              <?php do_action('morenews_action_banner_advertisement'); ?>
            </div>
          <?php endif;
      	else:
      		 ?>
          <div class="header-promotion">
            <?php do_action('morenews_action_banner_advertisement'); ?>
          </div>
      <?php
      	endif;
      }
      ?>
    </div>
  </div>
</div>
<?php if (!morenews_is_amp()) {
	if (is_active_sidebar('express-off-canvas-panel')): ?>
            
            <div id="sidr" class="primary-background">
              <a class="sidr-class-sidr-button-close" aria-label="<?php esc_attr_e(
              	'Open Off-Canvas Navigation',
              	'morenews',
              ); ?>" href="#sidr"></a>
              <?php dynamic_sidebar('express-off-canvas-panel'); ?>
            </div>
        <?php endif;
} ?>
<div id="main-navigation-bar" class="af-bottom-header">
  <div class="container-wrapper">
    <div class="bottom-bar-flex">
      <div class="offcanvas-navigaiton">
        <?php if (!morenews_is_amp()) {
        	if (is_active_sidebar('express-off-canvas-panel')): ?>
            <div class="off-cancas-panel">
              <?php do_action('morenews_load_off_canvas'); ?>
            </div>
            
        <?php endif;
        } ?>
        <div class="af-bottom-head-nav">
          <?php
          // Collect pages and bucket them by category (if pages support category taxonomy)
          $morenews_pages = get_pages([
            'post_status' => 'publish',
            'sort_column' => 'menu_order,post_title',
            'sort_order' => 'ASC',
          ]);

          $morenews_pages_without_category = [];
          $morenews_pages_by_category = [];

          foreach ($morenews_pages as $morenews_page) {
            $morenews_terms = get_the_terms($morenews_page->ID, 'category');
            if (is_wp_error($morenews_terms) || empty($morenews_terms)) {
              $morenews_pages_without_category[] = $morenews_page;
            } else {
              // If multiple categories exist, use the first one for placement
              $morenews_first_term = reset($morenews_terms);
              if ($morenews_first_term && !is_wp_error($morenews_first_term)) {
                $morenews_tid = $morenews_first_term->term_id;
                if (!isset($morenews_pages_by_category[$morenews_tid])) {
                  $morenews_pages_by_category[$morenews_tid] = [];
                }
                $morenews_pages_by_category[$morenews_tid][] = $morenews_page;
              } else {
                $morenews_pages_without_category[] = $morenews_page;
              }
            }
          }

          // Fetch categories
          $morenews_categories = get_categories([
            'hide_empty' => false,
          ]);

          // Build children map: parent_id => [child terms]
          $morenews_children_map = [];
          foreach ($morenews_categories as $morenews_term) {
            $morenews_pid = (int) $morenews_term->parent;
            if (!isset($morenews_children_map[$morenews_pid])) {
              $morenews_children_map[$morenews_pid] = [];
            }
            $morenews_children_map[$morenews_pid][] = $morenews_term;
          }

          $morenews_compare_terms = function ($a, $b) {
            $oa = get_term_meta($a->term_id, 'category_order', true);
            $ob = get_term_meta($b->term_id, 'category_order', true);
            $na = is_numeric($oa);
            $nb = is_numeric($ob);
            if ($na && $nb) {
              $da = intval($oa);
              $db = intval($ob);
              if ($da === $db) {
                return strcasecmp($a->name, $b->name);
              }
              return $da < $db ? -1 : 1;
            }
            if ($na !== $nb) {
              return $na ? -1 : 1;
            }
            return strcasecmp($a->name, $b->name);
          };

          foreach ($morenews_children_map as $morenews_pid => $morenews_children) {
            usort($morenews_children, $morenews_compare_terms);
            $morenews_children_map[$morenews_pid] = $morenews_children;
          }

          // Helper: render category item recursively, pages first then child categories
          if (!function_exists('morenews_render_category_item_nav')) {
            function morenews_render_category_item_nav($morenews_cat, $morenews_pages_by_category, $morenews_children_map)
            {
              $morenews_has_children = !empty($morenews_children_map[$morenews_cat->term_id]);
              $morenews_has_pages = !empty($morenews_pages_by_category[$morenews_cat->term_id]);
              $morenews_li_class = 'menu-item af-category';
              if ($morenews_has_children || $morenews_has_pages) {
                $morenews_li_class .= ' menu-item-has-children';
              }

              echo '<li class="' . esc_attr($morenews_li_class) . '">';
              echo '<a href="' . esc_url(get_category_link($morenews_cat->term_id)) . '">';
              echo esc_html($morenews_cat->name);
              echo '</a>';

              if ($morenews_has_children || $morenews_has_pages) {
                echo '<ul class="sub-menu">';
                // Pages first
                if ($morenews_has_pages) {
                  foreach ($morenews_pages_by_category[$morenews_cat->term_id] as $morenews_page) {
                    echo '<li class="menu-item af-page">';
                    echo '<a href="' . esc_url(get_permalink($morenews_page->ID)) . '">';
                    echo esc_html(get_the_title($morenews_page->ID));
                    echo '</a>';
                    echo '</li>';
                  }
                }
                // Child categories
                if ($morenews_has_children) {
                  foreach ($morenews_children_map[$morenews_cat->term_id] as $morenews_child) {
                    morenews_render_category_item_nav($morenews_child, $morenews_pages_by_category, $morenews_children_map);
                  }
                }
                echo '</ul>';
              }

              echo '</li>';
            }
          }

          // Keep theme styling consistent
          $morenews_global_show_home_menu = morenews_get_option('global_show_primary_menu_border');
          ?>
          <nav class="main-navigation clearfix" aria-label="Primary Page and Category Navigation">
            <div class="menu main-menu menu-desktop <?php echo esc_attr($morenews_global_show_home_menu); ?>">
              <ul id="primary-menu" class="menu">
              <?php foreach ($morenews_pages_without_category as $morenews_page): ?>
                <li class="menu-item af-page">
                  <a href="<?php echo esc_url(get_permalink($morenews_page->ID)); ?>">
                    <?php echo esc_html(get_the_title($morenews_page->ID)); ?>
                  </a>
                </li>
              <?php endforeach; ?>

              <?php
              // Top-level categories only
              if (!empty($morenews_children_map[0])) {
                foreach ($morenews_children_map[0] as $morenews_cat) {
                  morenews_render_category_item_nav($morenews_cat, $morenews_pages_by_category, $morenews_children_map);
                }
              }
              ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div class="search-watch">
      <?php do_action('morenews_dark_and_light_mode'); ?>
        <?php do_action('morenews_load_search_form'); ?>
        <?php do_action('morenews_load_watch_online'); ?>
      </div>
    </div>
  </div>
</div>
