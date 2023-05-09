<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */


$mahogany_header_css = '';
$mahogany_header_image = get_header_image();
$mahogany_header_video = mahogany_get_header_video();
if (!empty($mahogany_header_image) && mahogany_trx_addons_featured_image_override(is_singular() || mahogany_storage_isset('blog_archive') || is_category())) {
	$mahogany_header_image = mahogany_get_current_mode_image($mahogany_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($mahogany_header_image) || !empty($mahogany_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($mahogany_header_video!='') echo ' with_bg_video';
					if ($mahogany_header_image!='') echo ' '.esc_attr(mahogany_add_inline_css_class('background-image: url('.esc_url($mahogany_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (mahogany_is_on(mahogany_get_theme_option('header_fullheight'))) echo ' header_fullheight mahogany-full-height';
					?> scheme_<?php echo esc_attr(mahogany_is_inherit(mahogany_get_theme_option('header_scheme')) 
													? mahogany_get_theme_option('color_scheme') 
													: mahogany_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($mahogany_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (mahogany_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

?></header>