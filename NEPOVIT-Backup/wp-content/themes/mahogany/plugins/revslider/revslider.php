<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('mahogany_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'mahogany_revslider_theme_setup9', 9 );
	function mahogany_revslider_theme_setup9() {
		if (mahogany_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'mahogany_revslider_frontend_scripts', 1100 );
			add_filter( 'mahogany_filter_merge_styles',			'mahogany_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'mahogany_filter_tgmpa_required_plugins','mahogany_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'mahogany_revslider_tgmpa_required_plugins' ) ) {
	
	function mahogany_revslider_tgmpa_required_plugins($list=array()) {
		if (mahogany_storage_isset('required_plugins', 'revslider')) {
			$path = mahogany_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || mahogany_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> mahogany_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
                    'version'	=> '6.5.14',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'mahogany_exists_revslider' ) ) {
	function mahogany_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'mahogany_revslider_frontend_scripts' ) ) {
	
	function mahogany_revslider_frontend_scripts() {
		if (mahogany_is_on(mahogany_get_theme_option('debug_mode')) && mahogany_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'mahogany-revslider',  mahogany_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'mahogany_revslider_merge_styles' ) ) {
	
	function mahogany_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>