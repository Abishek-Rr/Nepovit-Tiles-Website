<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_link = get_permalink();
$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($mahogany_post_format) ); ?>><?php
	mahogany_show_post_featured(array(
		'thumb_size' => mahogany_get_thumb_size( (int) mahogany_get_theme_option('related_posts') == 1 ? 'huge' : 'related' ),
		'show_no_image' => false,
		'singular' => false
		)
	);
	?><div class="post_header entry-header">
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($mahogany_link); ?>"><?php the_title(); ?></a></h6><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($mahogany_link); ?>"><?php echo wp_kses_data(mahogany_get_date()); ?></a></span><?php
		}
		?>
	</div>
</div>