<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($mahogany_columns).' post_format_'.esc_attr($mahogany_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}

	$mahogany_image_hover = mahogany_get_theme_option('image_hover');
	// Featured image
	mahogany_show_post_featured(array(
		'thumb_size' => mahogany_get_thumb_size(strpos(mahogany_get_theme_option('body_style'), 'full')!==false || $mahogany_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $mahogany_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $mahogany_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>