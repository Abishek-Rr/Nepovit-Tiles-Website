<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
$mahogany_animation = mahogany_get_theme_option('blog_animation');
$mahogany_show_gallery = in_array($mahogany_post_format, array('gallery'));
$mahogany_hide_gallery = !in_array($mahogany_post_format, array('gallery'));
$mahogany_show_audio = in_array($mahogany_post_format, array('audio'));
$mahogany_hide_audio = !in_array($mahogany_post_format, array('audio'));
$mahogany_show_video = in_array($mahogany_post_format, array('video'));

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($mahogany_post_format) ); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}
	?>
	<?php if (has_post_thumbnail() || $mahogany_show_gallery) { ?>
	<div class="post_featured_container">
	<?php
		// Featured image
		mahogany_show_post_featured(array( 'thumb_size' => mahogany_get_thumb_size( strpos(mahogany_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));
	?>
		<?php
		if ( !is_sticky() ) {
		?>
			<div class="post_meta_container">
				<div class="post_meta_container_left">
					<?php
					// Post meta
					mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
						'components' => 'author,date',
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
	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('mahogany_action_before_post_meta'); 

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
			
			do_action('mahogany_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );


			?>
			<?php if (!has_post_thumbnail() ) { 
					if ( $mahogany_hide_gallery ) {
				?>
				<div class="post_meta_container">
					<div class="post_meta_container_left">
						<?php
						// Post meta
						mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
							'components' => 'author,date',
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
			<?php } } ?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?>
	<?php if ($mahogany_show_audio || $mahogany_show_video) {
		// Featured image
		mahogany_show_post_featured(array( 'thumb_size' => mahogany_get_thumb_size( strpos(mahogany_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));
	} ?>
	<div class="post_content entry-content"><?php
		if (mahogany_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'mahogany' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'mahogany' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$mahogany_show_learn_more = !in_array($mahogany_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
			// More button
			if ( $mahogany_show_learn_more ) {
				?><p><a class="more-link color_style_link2 sc_button_default sc_button_size_small" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'mahogany'); ?></a></p><?php
			}

		}
		if ( !is_sticky() ) {
		the_tags( '<div class="post_tags_container"><span class="post_tags">'.esc_html__('Tags:', 'mahogany').'</span> ', '', '</div>' );
		}
	?></div><!-- .entry-content -->
</article>