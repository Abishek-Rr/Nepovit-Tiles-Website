<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('mahogany_elegro_payment_theme_setup9')) {
    add_action( 'after_setup_theme', 'mahogany_elegro_payment_theme_setup9', 9 );
    function mahogany_elegro_payment_theme_setup9() {
        if (is_admin()) {
            add_filter( 'mahogany_filter_tgmpa_required_plugins',			'mahogany_elegro_payment_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( !function_exists( 'mahogany_elegro_payment_tgmpa_required_plugins' ) ) {
    function mahogany_elegro_payment_tgmpa_required_plugins($list=array()) {
        if (mahogany_storage_isset('required_plugins', 'elegro-payment')) {
            // CF7 plugin
            $list[] = array(
                'name' 		=> mahogany_storage_get_array('required_plugins', 'elegro-payment'),
                'slug' 		=> 'elegro-payment',
                'required' 	=> false
            );
        }
        return $list;
    }
}



// Check if elegro_payment installed and activated
if ( !function_exists( 'mahogany_exists_elegro_payment' ) ) {
    function mahogany_exists_elegro_payment() {
        return function_exists('init_Elegro_Payment');
    }
}
?>