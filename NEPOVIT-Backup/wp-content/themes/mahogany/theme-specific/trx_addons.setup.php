<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */
if (!function_exists('mahogany_trx_addons_theme_specific_setup1')) {
	add_filter( 'trx_addons_filter_components_editor', 'mahogany_trx_addons_theme_specific_components');
	function mahogany_trx_addons_theme_specific_components($enable=false) {
		return MAHOGANY_THEME_FREE
					? false		// Free version
					: false;		// Pro version or Developer mode
	}
}

if (!function_exists('mahogany_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'mahogany_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'mahogany_trx_addons_theme_specific_setup1', 1 );
	function mahogany_trx_addons_theme_specific_setup1() {
		if (mahogany_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',					'mahogany_trx_addons_cv_enable');
			add_filter( 'trx_addons_demo_enable',				'mahogany_trx_addons_demo_enable');
			add_filter( 'trx_addons_filter_edd_themes_market',	'mahogany_trx_addons_edd_themes_market_enable');
			add_filter( 'trx_addons_cpt_list',					'mahogany_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',					'mahogany_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',				'mahogany_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'mahogany_trx_addons_cv_enable' ) ) {
	
	function mahogany_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return MAHOGANY_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}

// Demo mode
if ( !function_exists( 'mahogany_trx_addons_demo_enable' ) ) {
	
	function mahogany_trx_addons_demo_enable($enable=false) {
		// To do: return false if theme not use Demo functionality
		return MAHOGANY_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}

// EDD Themes market
if ( !function_exists( 'mahogany_trx_addons_edd_themes_market_enable' ) ) {
	
	function mahogany_trx_addons_edd_themes_market_enable($enable=false) {
		// To do: return false if theme not Themes market functionality
		return MAHOGANY_THEME_FREE
					? false		// Free version
					: true;		// Pro version
	}
}


// API
if ( !function_exists( 'mahogany_trx_addons_api_list' ) ) {
	
	function mahogany_trx_addons_api_list($list=array()) {
		// To do: Enable/Disable Third-party plugins API via add/remove it in the list

		// If it's a free version - leave only basic set
		if (MAHOGANY_THEME_FREE) {
			$free_api = array('instagram_feed', 'siteorigin-panels', 'woocommerce', 'contact-form-7');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_api)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}


// CPT
if ( !function_exists( 'mahogany_trx_addons_cpt_list' ) ) {
	
	function mahogany_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list

		// If it's a free version - leave only basic set
		if (MAHOGANY_THEME_FREE) {
			$free_cpt = array('layouts', 'portfolio', 'post', 'services', 'team', 'testimonials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_cpt)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'mahogany_trx_addons_sc_list' ) ) {
	
	function mahogany_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php

		// If it's a free version - leave only basic set
		if (MAHOGANY_THEME_FREE) {
			$free_shortcodes = array('action', 'anchor', 'blogger', 'button', 'form', 'icons', 'price', 'promo', 'socials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_shortcodes)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Widgets
if ( !function_exists( 'mahogany_trx_addons_widgets_list' ) ) {
	
	function mahogany_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php

		// If it's a free version - leave only basic set
		if (MAHOGANY_THEME_FREE) {
			$free_widgets = array('aboutme', 'banner', 'contacts', 'flickr', 'popular_posts', 'recent_posts', 'slider', 'socials');
			foreach ($list as $k=>$v) {
				if (!in_array($k, $free_widgets)) {
					unset($list[$k]);
				}
			}
		}
		return $list;
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'mahogany_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'mahogany_trx_addons_menu_cache');
	function mahogany_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add theme-specific vars into localize array
if (!function_exists('mahogany_trx_addons_localize_script')) {
	add_filter( 'mahogany_filter_localize_script', 'mahogany_trx_addons_localize_script' );
	function mahogany_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = mahogany_get_scheme_color('alter_link');
		return $arr;
	}
}


// Shortcodes support
//------------------------------------------------------------------------
// Add new styles to content
if ( !function_exists( 'mahogany_filter_get_list_sc_content_widths' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_content_widths',	'mahogany_filter_get_list_sc_content_widths');
	function mahogany_filter_get_list_sc_content_widths($list) {
		$list['95p'] = esc_html__('95% of container', 'mahogany');
		return $list;
	}
}

// Add new styles to content
if ( !function_exists( 'mahogany_filter_widget_args' ) ) {
	add_filter( 'trx_addons_filter_widget_args', 'mahogany_filter_widget_args', 10, 3);
	function mahogany_filter_widget_args($list, $instance, $sc) {
		
		if (in_array($sc, array('trx_addons_widget_contacts'))){
			$socials_label = isset($instance['socials_label']) ? $instance['socials_label'] : '';
			$address_label = isset($instance['address_label']) ? $instance['address_label'] : '';
			$phone_label = isset($instance['phone_label']) ? $instance['phone_label'] : '';
			$email_label = isset($instance['email_label']) ? $instance['email_label'] : '';

			$list['socials_label'] = $socials_label;
			$list['address_label'] = $address_label;
			$list['phone_label'] = $phone_label;
			$list['email_label'] = $email_label;
		}
		
		return $list;
	}
}

// Add class in the form shortcodes
if ( !function_exists( 'mahogany_trx_addons_filter_sc_item_link_classes' ) ) {
	add_filter( 'trx_addons_filter_sc_item_link_classes', 'mahogany_trx_addons_filter_sc_item_link_classes', 10, 3);
	function mahogany_trx_addons_filter_sc_item_link_classes($list, $sc, $args) {
		if ($sc == 'sc_form') {
			echo " sc_button color_style_link2 sc_button_default sc_button_size_small ";
		}		
		if ($sc == 'sc_price') {
			echo " sc_button color_style_link2 sc_button_default sc_button_size_normal ";
		}		
		return $list;
	}
}
// Thumb for widget posts
if ( !function_exists( 'mahogany_trx_addons_filter_posts_list_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_posts_list_thumb_size', 'mahogany_trx_addons_filter_posts_list_thumb_size', 10, 2);
	function mahogany_trx_addons_filter_posts_list_thumb_size($thumb_size='', $type='') {
		$thumb_size = mahogany_get_thumb_size('recent-posts');
		return $thumb_size;
	}
}

if ( !function_exists( 'mahogany_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'mahogany_trx_addons_thumb_size', 10, 2);
}


// Add new output types (layouts) in the shortcodes
if ( !function_exists( 'mahogany_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'mahogany_trx_addons_sc_type', 10, 2);
	function mahogany_trx_addons_sc_type($list, $sc) {
		// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
		if ($sc == 'trx_sc_title') {
			$list['2'] = esc_html__('Style 2', 'mahogany');
			$list['3'] = esc_html__('Style 3', 'mahogany');
			$list['4'] = esc_html__('Style 4', 'mahogany');
		}			
		if ($sc == 'trx_sc_price') {
			$list['alter'] = esc_html__('Alter', 'mahogany');
		}			

		return $list;
	}
}

// Mask opacity
if ( !function_exists( 'mahogany_filter_get_list_sc_content_extra_bg_mask' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_content_extra_bg_mask', 'mahogany_filter_get_list_sc_content_extra_bg_mask', 10);
	function mahogany_filter_get_list_sc_content_extra_bg_mask($list) {
		$list['95'] = esc_html__('95%', 'mahogany');
		return $list;
	}
}

// Mask opacity
if ( !function_exists( 'mahogany_filter_get_list_sc_button_sizes' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_button_sizes', 'mahogany_filter_get_list_sc_button_sizes', 10);
	function mahogany_filter_get_list_sc_button_sizes($list) {
		unset($list['large']);
		return $list;
	}
}

// Layouts row types
if ( !function_exists( 'mahogany_trx_addons_filter_get_list_sc_layouts_row_types' ) ) {
	add_filter( 'trx_addons_filter_get_list_sc_layouts_row_types', 'mahogany_trx_addons_filter_get_list_sc_layouts_row_types', 10);
	function mahogany_trx_addons_filter_get_list_sc_layouts_row_types($list) {
		unset($list['compact']);
		return $list;
	}
}



// Add params to the default shortcode's atts
if ( !function_exists( 'mahogany_trx_addons_sc_atts' ) ) {
	add_filter( 'trx_addons_sc_atts', 'mahogany_trx_addons_sc_atts', 10, 2);
	function mahogany_trx_addons_sc_atts($atts, $sc) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter', 'trx_sc_layouts_container')))
			$atts['scheme'] = 'inherit';
		// Param 'color_style'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter',
								'trx_sc_button')))
			$atts['color_style'] = 'default';

		// Param 'contacts'
		if (in_array($sc, array('trx_widget_contacts'))){
			$atts['socials_label'] = '';
			$atts['address_label'] = '';
			$atts['phone_label'] = '';
			$atts['email_label'] = '';
		}

		return $atts;
	}
}

// Add params into shortcodes VC map
if ( !function_exists( 'mahogany_trx_addons_sc_map' ) ) {
	add_filter( 'trx_addons_sc_map', 'mahogany_trx_addons_sc_map', 10, 2);
	function mahogany_trx_addons_sc_map($params, $sc) {

		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form', 'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter', 'trx_sc_layouts_container'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$params['params'][] = array(
					'param_name' => 'scheme',
					'heading' => esc_html__('Color scheme', 'mahogany'),
					'description' => wp_kses_data( __('Select color scheme to decorate this block', 'mahogany') ),
					'group' => esc_html__('Colors', 'mahogany'),
					'admin_label' => true,
					'value' => array_flip(mahogany_get_list_schemes(true)),
					'type' => 'dropdown'
				);
		}
		// Param 'color_style'
		$param = array(
			'param_name' => 'color_style',
			'heading' => esc_html__('Color style', 'mahogany'),
			'description' => wp_kses_data( __('Select color style to decorate this block', 'mahogany') ),
			'edit_field_class' => 'vc_col-sm-4',
			'admin_label' => true,
			'value' => array_flip(mahogany_get_list_sc_color_styles()),
			'type' => 'dropdown'
		);
		if (in_array($sc, array('trx_sc_button'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$new_params = array();
			foreach ($params['params'] as $v) {
				if (in_array($v['param_name'], array('type', 'size'))) $v['edit_field_class'] = 'vc_col-sm-4';
				$new_params[] = $v;
				if ($v['param_name'] == 'size') {
					$new_params[] = $param;
				}
			}
			$params['params'] = $new_params;
		} else if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$new_params = array();
			foreach ($params['params'] as $v) {
				if (in_array($v['param_name'], array('title_style', 'title_tag', 'title_align'))) $v['edit_field_class'] = 'vc_col-sm-6';
				$new_params[] = $v;
				if ($v['param_name'] == 'title_align') {
					if (!empty($v['group'])) $param['group'] = $v['group'];
					$param['edit_field_class'] = 'vc_col-sm-6';
					$new_params[] = $param;
				}
			}
			$params['params'] = $new_params;
		}

		// Param for widget contacts
		if (in_array($sc, array('trx_widget_contacts'))) {
			if (empty($params['params']) || !is_array($params['params'])) $params['params'] = array();
			$params['params'][] = array(
	                "param_name" => "socials_label",
	                "heading" => esc_html__("Socials title", 'mahogany'),
	                "description" => wp_kses_data( __("Socials title", 'mahogany') ),
					'dependency' => array(
						'element' => 'socials',
						'value' => '1',
					),                
	                "admin_label" => true,
	                "type" => "textfield"
				);
			$params['params'][] = array(
	                "param_name" => "address_label",
	                "heading" => esc_html__("Address title", 'mahogany'),
	                "description" => wp_kses_data( __("Address title", 'mahogany') ),
	                "admin_label" => true,
	                "type" => "textfield"
				);
			$params['params'][] = array(
                    "param_name" => "phone_label",
                    "heading" => esc_html__("Phone title", 'mahogany'),
                    "description" => wp_kses_data( __("Phone title", 'mahogany') ),
                    "admin_label" => true,
                    "type" => "textfield"
				);
			$params['params'][] = array(
                    "param_name" => "email_label",
                    "heading" => esc_html__("E-mail title", 'mahogany'),
                    "description" => wp_kses_data( __("E-mail title", 'mahogany') ),
                    "admin_label" => true,
                    "type" => "textfield"
				);
		}


		/* dependency */
		if (in_array($sc, array('trx_sc_button'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'new_window'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'subtitle'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'icon'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'image'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'icon_position'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'back_image'){
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}
		if (in_array($sc, array('trx_sc_skills'))) {   
			$aa = $params['params'];
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'compact'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
			$ab = $params['params'];   
			foreach ($ab as $k => $v) {    
				if($v['param_name'] == 'values'){     
					$a = $params['params'][$k]['params'];
					foreach ($a as $g => $v) {    
						if($v['param_name'] == 'icon'){     
							unset($params['params'][$k]['params'][$g]);
						}
					}  
					 
				}
			}  
		}		
		if (in_array($sc, array('trx_sc_team'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'slider'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}
		if (in_array($sc, array('trx_sc_form'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'labels'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'align'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}
		if (in_array($sc, array('trx_sc_countdown'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'align'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}
		if (in_array($sc, array('trx_sc_blogger'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'slider'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'post_type'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}		
		if (in_array($sc, array('trx_sc_services'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'icons_animation'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'popup'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'post_type'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'featured'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'featured_position'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'hide_excerpt'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'tabs_effect'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'no_margin'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'slider'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
		}		
		if (in_array($sc, array('trx_sc_price'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'slider'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
			$ab = $params['params'];   
			foreach ($ab as $k => $v) {    
				if($v['param_name'] == 'prices'){     
					$a = $params['params'][$k]['params'];
					foreach ($a as $g => $v) {    
						if($v['param_name'] == 'icon'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'subtitle'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'label'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'description'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'image'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'bg_color'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'bg_image'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'color'){     
							unset($params['params'][$k]['params'][$g]);
						}
					}  
					 
				}
			}  
		}
		if (in_array($sc, array('trx_sc_icons'))) {   
			$aa = $params['params'];   
			foreach ($aa as $k => $v) {    
				if($v['param_name'] == 'size'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'color'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
				if($v['param_name'] == 'icons_animation'){     
					$params['params'][$k]['dependency'] = array(      
						'element' => 'type',      
						'value' => array('none')
					);    
				}
			}  
			$ab = $params['params'];   
			foreach ($ab as $k => $v) {    
				if($v['param_name'] == 'icons'){     
					$a = $params['params'][$k]['params'];
					foreach ($a as $g => $v) {    
						if($v['param_name'] == 'description'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'color'){     
							unset($params['params'][$k]['params'][$g]);
						}
						if($v['param_name'] == 'image'){     
							unset($params['params'][$k]['params'][$g]);
						}
					}  
					 
				}
			}  
		}

		return $params;
	}
}

// Add params into shortcodes SOW map
if ( !function_exists( 'mahogany_trx_addons_sow_map' ) ) {
	add_filter( 'trx_addons_sow_map', 'mahogany_trx_addons_sow_map', 10, 2);
	function mahogany_trx_addons_sow_map($params, $sc) {

		// Param 'color_style'
		$param = array(
			'color_style' => array(
				'label' => esc_html__('Color style', 'mahogany'),
				'description' => wp_kses_data( __('Select color style to decorate this block', 'mahogany') ),
				'options' => mahogany_get_list_sc_color_styles(),
				'default' => 'default',
				'type' => 'select'
			)
		);
		if (in_array($sc, array('trx_sc_button')))
			mahogany_array_insert_after($params, 'size', $param);
		else if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_cars', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_dishes',
								'trx_sc_events', 'trx_sc_form',	'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo',
								'trx_sc_properties', 'trx_sc_services', 'trx_sc_team', 'trx_sc_testimonials', 'trx_sc_title',
								'trx_widget_audio', 'trx_widget_twitter')))
			mahogany_array_insert_after($params, 'title_align', $param);
		return $params;
	}
}

// Add classes to the shortcode's output
if ( !function_exists( 'mahogany_trx_addons_sc_output' ) ) {
	add_filter( 'trx_addons_sc_output', 'mahogany_trx_addons_sc_output', 10, 4);
	function mahogany_trx_addons_sc_output($output, $sc, $atts, $content) {
		
		if (in_array($sc, array('trx_sc_action'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_action ', 'class="sc_action scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_action ', 'class="sc_action color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_blogger'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_blogger ', 'class="sc_blogger scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_blogger ', 'class="sc_blogger color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_button'))) {
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_button ', 'class="sc_button color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_cars'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_cars ', 'class="sc_cars scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_cars ', 'class="sc_cars color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_courses'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_courses ', 'class="sc_courses scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_courses ', 'class="sc_courses color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_content'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_content ', 'class="sc_content scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_content ', 'class="sc_content color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_dishes'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_dishes ', 'class="sc_dishes scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_dishes ', 'class="sc_dishes color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_events'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_events ', 'class="sc_events scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_events ', 'class="sc_events color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_form'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_form ', 'class="sc_form scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_form ', 'class="sc_form color_style_'.esc_attr($atts['color_style']).' ', $output);

		} else if (in_array($sc, array('trx_sc_googlemap'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_googlemap_content', 'class="sc_googlemap_content scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_googlemap_content ', 'class="sc_googlemap_content color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_portfolio'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_portfolio ', 'class="sc_portfolio scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_portfolio ', 'class="sc_portfolio color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_price'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_price ', 'class="sc_price scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_price ', 'class="sc_price color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_promo'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_promo ', 'class="sc_promo scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_promo ', 'class="sc_promo color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_properties'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_properties ', 'class="sc_properties scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_properties ', 'class="sc_properties color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_services'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_services ', 'class="sc_services scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_services ', 'class="sc_services color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_team'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_team ', 'class="sc_team scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_team ', 'class="sc_team color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_testimonials'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_testimonials ', 'class="sc_testimonials scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_testimonials ', 'class="sc_testimonials color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_title'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_title ', 'class="sc_title scheme_'.esc_attr($atts['scheme']).' ', $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_title ', 'class="sc_title color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_widget_audio'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_audio', 'sc_widget_audio scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_widget_audio ', 'class="sc_widget_audio color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_widget_twitter'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_twitter', 'sc_widget_twitter scheme_'.esc_attr($atts['scheme']), $output);
			if (!empty($atts['color_style']) && !mahogany_is_inherit($atts['color_style']))
				$output = str_replace('class="sc_widget_twitter ', 'class="sc_widget_twitter color_style_'.esc_attr($atts['color_style']).' ', $output);
	
		} else if (in_array($sc, array('trx_sc_layouts_container'))) {
			if (!empty($atts['scheme']) && !mahogany_is_inherit($atts['scheme']))
				$output = str_replace('sc_layouts_container', 'sc_layouts_container scheme_'.esc_attr($atts['scheme']), $output);
	
		}
		return $output;
	}
}

// Return tag for the item's title
if ( !function_exists( 'mahogany_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'mahogany_trx_addons_sc_item_title_tag');
	function mahogany_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'mahogany_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'mahogany_trx_addons_sc_item_button_args', 10, 3);
	function mahogany_trx_addons_sc_item_button_args($args, $sc, $sc_args) {
		if (!empty($sc_args['color_style']))
			$args['color_style'] = $sc_args['color_style'];
		return $args;
	}
}

// Return theme specific title layout for the slider
if ( !function_exists( 'mahogany_trx_addons_slider_title' ) ) {
	add_filter( 'trx_addons_filter_slider_title',	'mahogany_trx_addons_slider_title', 10, 2 );
	function mahogany_trx_addons_slider_title($title, $data) {
		$title = '';
		if (!empty($data['title'])) 
			$title .= '<h3 class="slide_title">'
						. (!empty($data['link']) ? '<a href="'.esc_url($data['link']).'">' : '')
						. esc_html($data['title'])
						. (!empty($data['link']) ? '</a>' : '')
						. '</h3>';
		if (!empty($data['cats']))
			$title .= sprintf('<div class="slide_cats">%s</div>', $data['cats']);
		return $title;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'mahogany_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'mahogany_trx_addons_sc_googlemap_styles');
	function mahogany_trx_addons_sc_googlemap_styles($list) {
		$list['dark'] = esc_html__('Ultra Light with Labels', 'mahogany');
		return $list;
	}
}

// Input hover
if ( !function_exists( 'mahogany_filter_get_list_input_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_input_hover',	'mahogany_filter_get_list_input_hover');
	function mahogany_filter_get_list_input_hover($list) {
		unset($list['accent']);
		unset($list['path']);
		unset($list['jump']);
		unset($list['underline']);
		unset($list['iconed']);
		return $list;
	}
}

// menu hover
if ( !function_exists( 'mahogany_filter_get_list_menu_hover' ) ) {
	add_filter( 'trx_addons_filter_get_list_menu_hover',	'mahogany_filter_get_list_menu_hover');
	function mahogany_filter_get_list_menu_hover($list) {
		unset($list['fade_box']);
		unset($list['slide_line']);
		unset($list['slide_box']);
		unset($list['zoom_line']);
		unset($list['path_line']);
		unset($list['roll_down']);
		unset($list['color_line']);
		return $list;
	}
}

// animation in
if ( !function_exists( 'mahogany_filter_get_list_animations_in' ) ) {
	add_filter( 'trx_addons_filter_get_list_animations_in',	'mahogany_filter_get_list_animations_in');
	function mahogany_filter_get_list_animations_in($list) {
		unset($list['fadeInUp']);
		unset($list['fadeInUpSmall']);
		unset($list['fadeInUpBig']);
		unset($list['fadeInDown']);
		unset($list['fadeInDownBig']);
		unset($list['fadeInLeft']);
		unset($list['fadeInLeftBig']);
		unset($list['fadeInRight']);
		unset($list['fadeInRightBig']);
		unset($list['bounceIn']);
		unset($list['bounceInUp']);
		unset($list['bounceInDown']);
		unset($list['bounceInLeft']);
		unset($list['bounceInRight']);
		unset($list['elastic']);
		unset($list['flipInX']);
		unset($list['flipInY']);
		unset($list['lightSpeedIn']);
		unset($list['rotateIn']);
		unset($list['rotateInUpLeft']);
		unset($list['rotateInUpRight']);
		unset($list['rotateInDownLeft']);
		unset($list['rotateInDownRight']);
		unset($list['rollIn']);
		unset($list['slideInUp']);
		unset($list['slideInDown']);
		unset($list['slideInLeft']);
		unset($list['slideInRight']);
		unset($list['wipeInLeftTop']);
		unset($list['zoomIn']);
		unset($list['zoomInUp']);
		unset($list['zoomInDown']);
		unset($list['zoomInLeft']);
		unset($list['zoomInRight']);
		return $list;
	}
}

// animation out
if ( !function_exists( 'mahogany_filter_get_list_animations_out' ) ) {
	add_filter( 'trx_addons_filter_get_list_animations_out',	'mahogany_filter_get_list_animations_out');
	function mahogany_filter_get_list_animations_out($list) {
		unset($list['fadeOutUp']);
		unset($list['fadeOutUpBig']);
		unset($list['fadeOutDownSmall']);
		unset($list['fadeOutDownBig']);
		unset($list['fadeOutDown']);
		unset($list['fadeOutLeft']);
		unset($list['fadeOutLeftBig']);
		unset($list['fadeOutRight']);
		unset($list['fadeOutRightBig']);
		unset($list['bounceOut']);
		unset($list['bounceOutUp']);
		unset($list['bounceOutDown']);
		unset($list['bounceOutLeft']);
		unset($list['bounceOutRight']);
		unset($list['flipOutX']);
		unset($list['flipOutY']);
		unset($list['hinge']);
		unset($list['lightSpeedOut']);
		unset($list['rotateOut']);
		unset($list['rotateOutUpLeft']);
		unset($list['rotateOutUpRight']);
		unset($list['rotateOutDownLeft']);
		unset($list['rotateOutDownRight']);
		unset($list['rollOut']);
		unset($list['slideOutUp']);
		unset($list['slideOutDown']);
		unset($list['slideOutLeft']);
		unset($list['slideOutRight']);
		unset($list['zoomOut']);
		unset($list['zoomOutUp']);
		unset($list['zoomOutDown']);
		unset($list['zoomOutLeft']);
		unset($list['zoomOutRight']);
		return $list;
	}
}

// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'mahogany_trx_addons_tiny_mce_style_formats' ) ) {
	add_filter( 'trx_addons_filter_tiny_mce_style_formats', 'mahogany_trx_addons_tiny_mce_style_formats');
	function mahogany_trx_addons_tiny_mce_style_formats($style_formats) {
		// Add style 'Arrow' to the 'List styles'
		// Remove 'false &&' from the condition below to add new style to the list
		if (is_array($style_formats) && count($style_formats)>0 ) {
			unset($style_formats[1]);
			$style_formats[1]['title'] = "Copyright";
			$style_formats[1]['items'] = array();			
			foreach ($style_formats as $k=>$v) {
				if ( $v['title'] == esc_html__('Inline', 'mahogany') ) {
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Hovered text', 'mahogany'),
								'inline' => 'span',
								'classes' => 'trx_addons_color_hovered'
							);
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Text style decor', 'mahogany'),
								'inline' => 'span',
								'classes' => 'trx_addons_inline_decor'
							);					
				}

				if ( $v['title'] == esc_html__('List styles', 'mahogany') ) {
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Arrow', 'mahogany'),
								'selector' => 'ul',
								'classes' => 'trx_addons_list_custom'
							);
					unset($style_formats[$k]['items'][0]);
					unset($style_formats[$k]['items'][1]);
					unset($style_formats[$k]['items'][2]);
					unset($style_formats[$k]['items'][3]);
					unset($style_formats[$k]['items'][4]);
					unset($style_formats[$k]['items'][5]);
					unset($style_formats[$k]['items'][6]);
					unset($style_formats[$k]['items'][7]);
					unset($style_formats[$k]['items'][8]);
					unset($style_formats[$k]['items'][9]);
					unset($style_formats[$k]['items'][10]);
					unset($style_formats[$k]['items'][11]);
					unset($style_formats[$k]['items'][12]);
					unset($style_formats[$k]['items'][13]);
					unset($style_formats[$k]['items'][14]);
					unset($style_formats[$k]['items'][15]);
					unset($style_formats[$k]['items'][16]);
				}				
				if ( $v['title'] == esc_html__('Copyright', 'mahogany') ) {
					$style_formats[$k]['items'][] = array(
								'title' => esc_html__('Default', 'mahogany'),
								'inline' => 'span',
								'classes' => 'copyright_text'
							);

				}				
			}
		}
		return $style_formats;
	}
}


// Setup team and portflio pages
//------------------------------------------------------------------------

// Disable override header image on team and portfolio pages
if ( !function_exists( 'mahogany_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'mahogany_filter_allow_override_header_image', 'mahogany_trx_addons_allow_override_header_image' );
	function mahogany_trx_addons_allow_override_header_image($allow) {
		return mahogany_is_team_page() ? false : $allow;
	}
}

// Get thumb size for the team items
if ( !function_exists( 'mahogany_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'mahogany_trx_addons_thumb_size', 10, 2);
	function mahogany_trx_addons_thumb_size($thumb_size='', $type='') {
		if ($type == 'team-default')
			$thumb_size = mahogany_get_thumb_size('team');
		return $thumb_size;
	}
}

// Add fields to the override options for the team members
// All other CPT override optionses may be modified in the same method
if (!function_exists('mahogany_trx_addons_override_options_fields')) {
	add_filter( 'trx_addons_filter_override_options_fields', 'mahogany_trx_addons_override_options_fields', 10, 2);
	function mahogany_trx_addons_override_options_fields($mb, $post_type) {
		if (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT) {
			$mb['email'] = array(
				"title" => esc_html__("E-mail",  'mahogany'),
				"desc" => wp_kses_data( __("Team member's email", 'mahogany') ),
				"std" => "",
				"details" => true,
				"type" => "text"
			);

		}
		return $mb;
	}
}
?>