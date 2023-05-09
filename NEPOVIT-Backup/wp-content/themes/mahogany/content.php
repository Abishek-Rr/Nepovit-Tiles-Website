<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_seo = mahogany_is_on(mahogany_get_theme_option('seo_snippets'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												);
		if ($mahogany_seo) {
			?> itemscope="itemscope" 
			   itemprop="articleBody" 
			   itemtype="//schema.org/<?php echo esc_attr(mahogany_get_markup_schema()); ?>"
			   itemid="<?php echo esc_url(get_the_permalink()); ?>"
			   content="<?php the_title_attribute(); ?>"<?php
		}
?>><?php

	do_action('mahogany_action_before_post_data'); 

	// Structured data snippets
	if ($mahogany_seo)
		get_template_part('templates/seo');

	// Featured image
	if ( mahogany_is_off(mahogany_get_theme_option('hide_featured_on_single'))
			&& !mahogany_sc_layouts_showed('featured') 
			&& strpos(get_the_content(), '[trx_widget_banner]')===false) {
		do_action('mahogany_action_before_post_featured'); 
		mahogany_show_post_featured(array( 'thumb_size' => mahogany_get_thumb_size( 'huge' ) ));
		do_action('mahogany_action_after_post_featured'); 
	} else if (has_post_thumbnail()) {
		?><meta itemprop="image" itemtype="//schema.org/ImageObject" content="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><?php
	}

	// Title and post meta
	if ( (!mahogany_sc_layouts_showed('title') || !mahogany_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		do_action('mahogany_action_before_post_title'); 
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if (!mahogany_sc_layouts_showed('title')) {
				the_title( '<h3 class="post_title entry-title"'.($mahogany_seo ? ' itemprop="headline"' : '').'>', '</h3>' );
			}
			// Post meta
			if (!mahogany_sc_layouts_showed('postmeta')) {
				?>
				<div class="post_featured_container">
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
				</div>
			<?php
			}
			?>
		</div><!-- .post_header -->
		<?php
		do_action('mahogany_action_after_post_title'); 
	}

	do_action('mahogany_action_before_post_content'); 

	// Post content
	?>
	<div class="post_content entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content( );

		do_action('mahogany_action_before_post_pagination'); 

		wp_link_pages( array(
			'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'mahogany' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'mahogany' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );

		// Taxonomies and share
		if ( is_single() && !is_attachment() ) {
			
			do_action('mahogany_action_before_post_meta'); 

			?><div class="post_meta post_meta_single"><?php
				
				// Post taxonomies
				the_tags( '<span class="post_tags_container"><span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'mahogany').'</span> ', '', '</span></span>' );

				// Share
				if (mahogany_is_on(mahogany_get_theme_option('show_share_links'))) {
					mahogany_show_share_links(array(
							'type' => 'block',
							'caption' => '',
							'before' => '<span class="post_meta_item post_share"><span class="post_share_label">'.esc_html__('Share:', 'mahogany').' </span>',
							'after' => '</span>'
						));
				}
			?></div><?php

			do_action('mahogany_action_after_post_meta'); 
		}
		?>
	</div><!-- .entry-content -->
	

	<?php
	do_action('mahogany_action_after_post_content'); 

	// Author bio.
	if ( mahogany_get_theme_option('show_author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action('mahogany_action_before_post_author'); 
		get_template_part( 'templates/author-bio' );
		do_action('mahogany_action_after_post_author'); 
	}

	do_action('mahogany_action_after_post_data'); 
	?>
</article>
