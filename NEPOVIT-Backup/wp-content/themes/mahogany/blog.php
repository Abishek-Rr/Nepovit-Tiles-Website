<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$mahogany_content = '';
$mahogany_blog_archive_mask = '%%CONTENT%%';
$mahogany_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $mahogany_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($mahogany_content = apply_filters('the_content', get_the_content())) != '') {
		if (($mahogany_pos = strpos($mahogany_content, $mahogany_blog_archive_mask)) !== false) {
			$mahogany_content = preg_replace('/(\<p\>\s*)?'.$mahogany_blog_archive_mask.'(\s*\<\/p\>)/i', $mahogany_blog_archive_subst, $mahogany_content);
		} else
			$mahogany_content .= $mahogany_blog_archive_subst;
		$mahogany_content = explode($mahogany_blog_archive_mask, $mahogany_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) mahogany_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$mahogany_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$mahogany_args = mahogany_query_add_posts_and_cats($mahogany_args, '', mahogany_get_theme_option('post_type'), mahogany_get_theme_option('parent_cat'));
$mahogany_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($mahogany_page_number > 1) {
	$mahogany_args['paged'] = $mahogany_page_number;
	$mahogany_args['ignore_sticky_posts'] = true;
}
$mahogany_ppp = mahogany_get_theme_option('posts_per_page');
if ((int) $mahogany_ppp != 0)
	$mahogany_args['posts_per_page'] = (int) $mahogany_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($mahogany_args);


// Add internal query vars in the new query!
if (is_array($mahogany_content) && count($mahogany_content) == 2) {
	set_query_var('blog_archive_start', $mahogany_content[0]);
	set_query_var('blog_archive_end', $mahogany_content[1]);
}

get_template_part('index');
?>