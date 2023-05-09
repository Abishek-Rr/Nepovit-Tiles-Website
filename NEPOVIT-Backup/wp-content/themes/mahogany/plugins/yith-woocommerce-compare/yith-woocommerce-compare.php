<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'mahogany_yith_wcwl_compare_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'mahogany_yith_wcwl_compare_theme_setup9', 9 );
    function mahogany_yith_wcwl_compare_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'mahogany_filter_tgmpa_required_plugins', 'mahogany_yith_wcwl_compare_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'mahogany_yith_wcwl_compare_tgmpa_required_plugins' ) ) {
    
    function mahogany_yith_wcwl_compare_tgmpa_required_plugins( $list = array() ) {
        if ( mahogany_storage_isset( 'required_plugins', 'yith-woocommerce-compare' )) {
            $list[] = array(
                'name'     => mahogany_storage_get_array( 'required_plugins', 'yith-woocommerce-compare' ),
                'slug'     => 'yith-woocommerce-compare',
                'required' => false,
            );
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'mahogany_exists_yith_wcwl_compare' ) ) {
    function mahogany_exists_yith_wcwl_compare() {
        return defined( 'YITH_WOOCOMPARE_VERSION' );
    }
}
