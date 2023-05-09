<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_post_id    = get_the_ID();
$mahogany_post_date  = mahogany_get_date();
$mahogany_post_title = get_the_title();
$mahogany_post_link  = get_permalink();
$mahogany_post_author_id   = get_the_author_meta('ID');
$mahogany_post_author_name = get_the_author_meta('display_name');
$mahogany_post_author_url  = get_author_posts_url($mahogany_post_author_id, '');

$mahogany_args = get_query_var('mahogany_args_widgets_posts');
$mahogany_show_date = isset($mahogany_args['show_date']) ? (int) $mahogany_args['show_date'] : 1;
$mahogany_show_image = isset($mahogany_args['show_image']) ? (int) $mahogany_args['show_image'] : 1;
$mahogany_show_author = isset($mahogany_args['show_author']) ? (int) $mahogany_args['show_author'] : 1;
$mahogany_show_counters = isset($mahogany_args['show_counters']) ? (int) $mahogany_args['show_counters'] : 1;
$mahogany_show_categories = isset($mahogany_args['show_categories']) ? (int) $mahogany_args['show_categories'] : 1;

$mahogany_output = mahogany_storage_get('mahogany_output_widgets_posts');

$mahogany_post_counters_output = '';
if ( $mahogany_show_counters ) {
	$mahogany_post_counters_output = '<span class="post_info_item post_info_counters">'
								. mahogany_get_post_counters('comments')
							. '</span>';
}


$mahogany_output .= '<article class="post_item with_thumb">';

if ($mahogany_show_image) {
	$mahogany_post_thumb = get_the_post_thumbnail($mahogany_post_id, mahogany_get_thumb_size('tiny'), array(
		'alt' => the_title_attribute( array( 'echo' => false ) )
	));
	if ($mahogany_post_thumb) $mahogany_output .= '<div class="post_thumb">' . ($mahogany_post_link ? '<a href="' . esc_url($mahogany_post_link) . '">' : '') . ($mahogany_post_thumb) . ($mahogany_post_link ? '</a>' : '') . '</div>';
}

$mahogany_output .= '<div class="post_content">'
			. ($mahogany_show_categories 
					? '<div class="post_categories">'
						. mahogany_get_post_categories()
						. $mahogany_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($mahogany_post_link ? '<a href="' . esc_url($mahogany_post_link) . '">' : '') . ($mahogany_post_title) . ($mahogany_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('mahogany_filter_get_post_info', 
								'<div class="post_info">'
									. ($mahogany_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($mahogany_post_link ? '<a href="' . esc_url($mahogany_post_link) . '" class="post_info_date">' : '') 
											. esc_html($mahogany_post_date) 
											. ($mahogany_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($mahogany_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'mahogany') . ' ' 
											. ($mahogany_post_link ? '<a href="' . esc_url($mahogany_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($mahogany_post_author_name) 
											. ($mahogany_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$mahogany_show_categories && $mahogany_post_counters_output
										? $mahogany_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
mahogany_storage_set('mahogany_output_widgets_posts', $mahogany_output);
?>