<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package hompark
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hompark_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if( !hompark_get_option( 'enable_preloader' ) ) {
		$classes[] = 'no-preloader';
	}

	$nav_menu_type = ( hompark_get_option( 'nav_menu_type' ) ) ? 'body-' . hompark_get_option( 'nav_menu_type' ) . '-menu' : 'body-horizontal-menu' ;
	$classes[] = $nav_menu_type;

	return $classes;
}
add_filter( 'body_class', 'hompark_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hompark_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'hompark_pingback_header' );