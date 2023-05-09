<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.06
 */

$mahogany_header_css = '';
$mahogany_header_image = get_header_image();
$mahogany_header_video = mahogany_get_header_video();
if (!empty($mahogany_header_image) && mahogany_trx_addons_featured_image_override(is_singular() || mahogany_storage_isset('blog_archive') || is_category())) {
	$mahogany_header_image = mahogany_get_current_mode_image($mahogany_header_image);
}

$mahogany_header_id = str_replace('header-custom-', '', mahogany_get_theme_option("header_style"));
if ((int) $mahogany_header_id == 0) {
	$mahogany_header_id = mahogany_get_post_id(array(
			'name' => $mahogany_header_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
		)
	);
} else {
	$mahogany_header_id = apply_filters('mahogany_filter_get_translated_layout', $mahogany_header_id);
}
$mahogany_header_meta = get_post_meta($mahogany_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($mahogany_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($mahogany_header_id)));
				echo !empty($mahogany_header_image) || !empty($mahogany_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($mahogany_header_video!='') 
					echo ' with_bg_video';
				if ($mahogany_header_image!='') 
					echo ' '.esc_attr(mahogany_add_inline_css_class('background-image: url('.esc_url($mahogany_header_image).');'));
				if (!empty($mahogany_header_meta['margin']) != '') 
					echo ' '.esc_attr(mahogany_add_inline_css_class('margin-bottom: '.esc_attr(mahogany_prepare_css_value($mahogany_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (mahogany_is_on(mahogany_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight mahogany-full-height';
				?> scheme_<?php echo esc_attr(mahogany_is_inherit(mahogany_get_theme_option('header_scheme')) 
												? mahogany_get_theme_option('color_scheme') 
												: mahogany_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($mahogany_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('mahogany_action_show_layout', $mahogany_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>