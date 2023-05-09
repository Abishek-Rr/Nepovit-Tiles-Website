<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_blog_style = explode('_', mahogany_get_theme_option('blog_style'));
$mahogany_columns = empty($mahogany_blog_style[1]) ? 2 : max(2, $mahogany_blog_style[1]);
$mahogany_expanded = !mahogany_sidebar_present() && mahogany_is_on(mahogany_get_theme_option('expand_content'));
$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
$mahogany_animation = mahogany_get_theme_option('blog_animation');
$mahogany_components = mahogany_is_inherit(mahogany_get_theme_option_from_meta('meta_parts')) 
							? 'categories,date,counters'.($mahogany_columns < 3 ? ',edit' : '')
							: mahogany_array_get_keys_by_value(mahogany_get_theme_option('meta_parts'));
$mahogany_counters = mahogany_is_inherit(mahogany_get_theme_option_from_meta('counters')) 
							? 'comments'
							: mahogany_array_get_keys_by_value(mahogany_get_theme_option('counters'));
$mahogany_show_gallery = in_array($mahogany_post_format, array('gallery'));
$mahogany_hide_gallery = !in_array($mahogany_post_format, array('gallery'));
$mahogany_show_audio = in_array($mahogany_post_format, array('audio'));
$mahogany_hide_audio = !in_array($mahogany_post_format, array('audio'));

?><div class="<?php mahogany_show_layout($mahogany_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($mahogany_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($mahogany_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($mahogany_columns)
					. ' post_layout_'.esc_attr($mahogany_blog_style[0]) 
					. ' post_layout_'.esc_attr($mahogany_blog_style[0]).'_'.esc_attr($mahogany_columns)
					); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}
	?>
	<?php if (has_post_thumbnail() || $mahogany_show_gallery || $mahogany_show_audio) { ?>
	<div class="post_featured_container">
	<?php
	// Featured image
	mahogany_show_post_featured( array( 'thumb_size' => mahogany_get_thumb_size($mahogany_blog_style[0] == 'classic'
													? (strpos(mahogany_get_theme_option('body_style'), 'full')!==false 
															? ( $mahogany_columns > 2 ? 'big' : 'huge' )
															: (	$mahogany_columns > 2
																? ($mahogany_expanded ? 'big' : 'med')
																: ($mahogany_expanded ? 'huge' : 'big')
																)
														)
													: (strpos(mahogany_get_theme_option('body_style'), 'full')!==false 
															? ( $mahogany_columns > 2 ? 'masonry-big' : 'full' )
															: (	$mahogany_columns <= 2 && $mahogany_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );
	?>
		<?php
		if ( !is_sticky() ) {
		?>
			<div class="post_meta_container">
				<div class="post_meta_container_left">
					<?php
					// Post meta
					mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
						'components' => 'date',
						'seo' => false
						), 'excerpt', 1)
					);

					?>
				</div><div class="post_meta_container_right">
					<?php
					// Post meta
					mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
						'components' => 'counters',
						'counters' => 'comments',
						'seo' => false
						), 'excerpt', 1)
					);
					?>
				</div>
			</div>
		<?php
		}	
		?>
	</div>
	<?php } ?>

	<?php
	if ( !in_array($mahogany_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('mahogany_action_before_post_title'); 
				if ( !is_sticky() ) {
				?>
					<div class="post_meta_over_title">
						<?php
						// Post meta
						mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
							'components' => 'categories',
							'seo' => false
							), 'excerpt', 1)
						);
						?>
					</div>
				<?php
				}
				?>
			<?php
			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('mahogany_action_before_post_meta'); 

			do_action('mahogany_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$mahogany_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($mahogany_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($mahogany_post_format == 'quote') {
				if (($quote = mahogany_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					mahogany_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($mahogany_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($mahogany_components))
				mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
					'components' => $mahogany_components,
					'counters' => $mahogany_counters
					), $mahogany_blog_style[0], $mahogany_columns)
				);
		}
		// More button
		if ( $mahogany_show_learn_more ) {
			?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'mahogany'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>