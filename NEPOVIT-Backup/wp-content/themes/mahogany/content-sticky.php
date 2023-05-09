<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
$mahogany_animation = mahogany_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($mahogany_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($mahogany_post_format) ); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}

	// Featured image
	mahogany_show_post_featured(array(
		'thumb_size' => mahogany_get_thumb_size($mahogany_columns==1 ? 'big' : ($mahogany_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($mahogany_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(), 'sticky', $mahogany_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>