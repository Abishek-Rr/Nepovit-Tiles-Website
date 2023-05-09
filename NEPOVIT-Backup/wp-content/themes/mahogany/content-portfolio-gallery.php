<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_blog_style = explode('_', mahogany_get_theme_option('blog_style'));
$mahogany_columns = empty($mahogany_blog_style[1]) ? 2 : max(2, $mahogany_blog_style[1]);
$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
$mahogany_animation = mahogany_get_theme_option('blog_animation');
$mahogany_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($mahogany_columns).' post_format_'.esc_attr($mahogany_post_format) ); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($mahogany_image[1]) && !empty($mahogany_image[2])) echo intval($mahogany_image[1]) .'x' . intval($mahogany_image[2]); ?>"
	data-src="<?php if (!empty($mahogany_image[0])) echo esc_url($mahogany_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}

	// Featured image
	$mahogany_image_hover = 'icon';
	if (in_array($mahogany_image_hover, array('icons', 'zoom'))) $mahogany_image_hover = 'dots';
	$mahogany_components = mahogany_is_inherit(mahogany_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: mahogany_array_get_keys_by_value(mahogany_get_theme_option('meta_parts'));
	$mahogany_counters = mahogany_is_inherit(mahogany_get_theme_option_from_meta('counters')) 
								? 'comments'
								: mahogany_array_get_keys_by_value(mahogany_get_theme_option('counters'));
	mahogany_show_post_featured(array(
		'hover' => $mahogany_image_hover,
		'thumb_size' => mahogany_get_thumb_size( strpos(mahogany_get_theme_option('body_style'), 'full')!==false || $mahogany_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($mahogany_components)
										? mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
											'components' => $mahogany_components,
											'counters' => $mahogany_counters,
											'seo' => false,
											'echo' => false
											), $mahogany_blog_style[0], $mahogany_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'mahogany') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>