<?php

if( ! function_exists( 'hompark_register_nav_menus' ) ) {
	/**
	 * Register required nav menus
	 */
	function hompark_register_nav_menus() {

		register_nav_menus( array(
			'header' => esc_html__( 'Main menu',  'hompark' ),
		) );
		
		

	}
	add_action( 'after_setup_theme', 'hompark_register_nav_menus' );
}