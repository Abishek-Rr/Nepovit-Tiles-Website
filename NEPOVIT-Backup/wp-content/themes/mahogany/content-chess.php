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
$mahogany_columns = empty($mahogany_blog_style[1]) ? 1 : max(1, $mahogany_blog_style[1]);
$mahogany_expanded = !mahogany_sidebar_present() && mahogany_is_on(mahogany_get_theme_option('expand_content'));
$mahogany_post_format = get_post_format();
$mahogany_post_format = empty($mahogany_post_format) ? 'standard' : str_replace('post-format-', '', $mahogany_post_format);
$mahogany_animation = mahogany_get_theme_option('blog_animation');
$mahogany_show_gallery = in_array($mahogany_post_format, array('gallery'));
$mahogany_hide_gallery = !in_array($mahogany_post_format, array('gallery'));
$mahogany_show_audio = in_array($mahogany_post_format, array('audio'));
$mahogany_hide_audio = !in_array($mahogany_post_format, array('audio'));


?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($mahogany_columns).' post_format_'.esc_attr($mahogany_post_format) ); ?>
	<?php echo (!mahogany_is_off($mahogany_animation) ? ' data-animation="'.esc_attr(mahogany_get_animation_classes($mahogany_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($mahogany_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.the_title_attribute( array( 'echo' => false ) ).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"><span class="label_sticky_text"><?php esc_html_e('Sticky', 'mahogany'); ?></span></span><?php
	}

	// Featured image
	mahogany_show_post_featured( array(
											'class' => $mahogany_columns == 1 ? 'mahogany-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => mahogany_get_thumb_size(
																	strpos(mahogany_get_theme_option('body_style'), 'full')!==false
																		? ( $mahogany_columns > 1 ? 'huge' : 'original' )
																		: (	$mahogany_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
				
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
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );


			?>
			<div class="post_meta_container">
				<div class="post_meta_container_left">
					<?php
					// Post meta
					mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
						'components' => ($mahogany_columns > 1 ? 'date' : 'author,date'),
						'seo' => false
						), 'excerpt', 1)
					);

					?>
				</div><div class="post_meta_container_right">
					<?php
					// Post meta
					mahogany_show_post_meta(apply_filters('mahogany_filter_post_meta_args', array(
						'components' => ($mahogany_columns > 2 ? '' : 'counters'),
						'counters' => ($mahogany_columns > 2 ? '' : 'comments'),
						'seo' => false
						), 'excerpt', 1)
					);
					?>
				</div>
			</div>
		</div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$mahogany_show_learn_more = !in_array($mahogany_post_format, array('link', 'aside', 'status', 'quote'));
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
				mahogany_show_layout($mahogany_post_meta);
			}
			// More button
			if ( $mahogany_show_learn_more ) {
				?><p><a class="more-link color_style_link2 sc_button_default sc_button_size_small" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'mahogany'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>