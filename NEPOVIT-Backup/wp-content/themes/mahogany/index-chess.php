<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

mahogany_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	mahogany_show_layout(get_query_var('blog_archive_start'));

	$mahogany_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$mahogany_sticky_out = mahogany_get_theme_option('sticky_style')=='columns' 
							&& is_array($mahogany_stickies) && count($mahogany_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($mahogany_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$mahogany_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($mahogany_sticky_out && !is_sticky()) {
			$mahogany_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $mahogany_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	mahogany_show_pagination();

	mahogany_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>