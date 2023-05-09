<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('mahogany_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'mahogany_essential_grid_theme_setup9', 9 );
	function mahogany_essential_grid_theme_setup9() {
		if (mahogany_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'mahogany_essential_grid_frontend_scripts', 1100 );
			add_filter( 'mahogany_filter_merge_styles',					'mahogany_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'mahogany_filter_tgmpa_required_plugins',		'mahogany_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'mahogany_essential_grid_tgmpa_required_plugins' ) ) {
	
	function mahogany_essential_grid_tgmpa_required_plugins($list=array()) {
		if (mahogany_storage_isset('required_plugins', 'essential-grid')) {
			$path = mahogany_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || mahogany_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> mahogany_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
                        'version'	=> '3.0.13',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'mahogany_exists_essential_grid' ) ) {
	function mahogany_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'mahogany_essential_grid_frontend_scripts' ) ) {
	
	function mahogany_essential_grid_frontend_scripts() {
		if (mahogany_is_on(mahogany_get_theme_option('debug_mode')) && mahogany_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'mahogany-essential-grid',  mahogany_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'mahogany_essential_grid_merge_styles' ) ) {
	
	function mahogany_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>