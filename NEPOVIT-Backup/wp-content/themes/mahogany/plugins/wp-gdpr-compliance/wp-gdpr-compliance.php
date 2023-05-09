<?php
/* gdpr-compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('mahogany_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'mahogany_gdpr_theme_setup9', 9 );
	function mahogany_gdpr_theme_setup9() {

		if (mahogany_exists_gdpr()) {
			add_filter( 'mahogany_filter_merge_styles',						'mahogany_gdpr_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'mahogany_filter_tgmpa_required_plugins',			'mahogany_gdpr_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'mahogany_gdpr_tgmpa_required_plugins' ) ) {
	
	function mahogany_gdpr_tgmpa_required_plugins($list=array()) {
        if (mahogany_storage_isset('required_plugins', 'wp-gdpr-compliance')) {
			$list[] = array(
				'name' 		=> esc_html__('WP GDPR Compliance', 'mahogany'),
				'slug' 		=> 'wp-gdpr-compliance',
				'required' 	=> false
			);

		}
		return $list;
	}
}

// Check if gdpr installed and activated
if ( !function_exists( 'mahogany_exists_gdpr' ) ) {
	function mahogany_exists_gdpr() {
		return class_exists('GDPR_VERSION');
	}
}