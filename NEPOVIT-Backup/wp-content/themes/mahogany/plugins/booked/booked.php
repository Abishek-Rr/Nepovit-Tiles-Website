<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('mahogany_booked_theme_setup9')) {
	add_action( 'after_setup_theme', 'mahogany_booked_theme_setup9', 9 );
	function mahogany_booked_theme_setup9() {
		if (mahogany_exists_booked()) {
			add_action( 'wp_enqueue_scripts', 							'mahogany_booked_frontend_scripts', 1100 );
			add_filter( 'mahogany_filter_merge_styles',					'mahogany_booked_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'mahogany_filter_tgmpa_required_plugins',		'mahogany_booked_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'mahogany_booked_tgmpa_required_plugins' ) ) {
	
	function mahogany_booked_tgmpa_required_plugins($list=array()) {
		if (mahogany_storage_isset('required_plugins', 'booked')) {
			$path = mahogany_get_file_dir('plugins/booked/booked.zip');
			if (!empty($path) || mahogany_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> mahogany_storage_get_array('required_plugins', 'booked'),
					'slug' 		=> 'booked',
                    'version'	=> '2.3.5',
					'source' 	=> !empty($path) ? $path : 'upload://booked.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'mahogany_exists_booked' ) ) {
	function mahogany_exists_booked() {
		return class_exists('booked_plugin');
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'mahogany_booked_frontend_scripts' ) ) {
	
	function mahogany_booked_frontend_scripts() {
		if (mahogany_is_on(mahogany_get_theme_option('debug_mode')) && mahogany_get_file_dir('plugins/booked/booked.css')!='')
			wp_enqueue_style( 'mahogany-booked',  mahogany_get_file_url('plugins/booked/booked.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'mahogany_booked_merge_styles' ) ) {
	
	function mahogany_booked_merge_styles($list) {
		$list[] = 'plugins/booked/booked.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (mahogany_exists_booked()) { require_once MAHOGANY_THEME_DIR . 'plugins/booked/booked.styles.php'; }
?>