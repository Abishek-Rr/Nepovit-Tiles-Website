<?php

class sandwich_Menu_Walker extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		$permalink = $item->url;
		$classes[] = 'menu-item';
		if ( $args->walker->has_children ) {
			$classes[] = 'dropdown';
		}


		$output .= "<li class='". esc_attr( implode( ' ', $classes ) ) ."'><i></i>";
		if( $item->target ) {
			$output .= '<a target="' . $item->target . '" href="' . $permalink . '" title="' . esc_attr__( 'Add a menu', 'hompark' ) . ' ">';
		}
		else {
			$output .= '<a href="' . $permalink . '" data-text="'. $item->title .'">';
		}
		$output .= $item->title;
		$output .= '</a>';

	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "<ul class='dropdown'>";
	}

}
