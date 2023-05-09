<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

// Page (category, tag, archive, author) title

if ( mahogany_need_page_title() ) {
	mahogany_sc_layouts_showed('title', true);
	mahogany_sc_layouts_showed('postmeta', false);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$mahogany_blog_title = mahogany_get_blog_title();
							$mahogany_blog_title_text = $mahogany_blog_title_class = $mahogany_blog_title_link = $mahogany_blog_title_link_text = '';
							if (is_array($mahogany_blog_title)) {
								$mahogany_blog_title_text = $mahogany_blog_title['text'];
								$mahogany_blog_title_class = !empty($mahogany_blog_title['class']) ? ' '.$mahogany_blog_title['class'] : '';
								$mahogany_blog_title_link = !empty($mahogany_blog_title['link']) ? $mahogany_blog_title['link'] : '';
								$mahogany_blog_title_link_text = !empty($mahogany_blog_title['link_text']) ? $mahogany_blog_title['link_text'] : '';
							} else
								$mahogany_blog_title_text = $mahogany_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($mahogany_blog_title_class); ?>"><?php
								$mahogany_top_icon = mahogany_get_category_icon();
								if (!empty($mahogany_top_icon)) {
									$mahogany_attr = mahogany_getimagesize($mahogany_top_icon);
									?><img src="<?php echo esc_url($mahogany_top_icon); ?>" alt="<?php esc_attr__('img', 'mahogany'); ?>" <?php if (!empty($mahogany_attr[3])) mahogany_show_layout($mahogany_attr[3]);?>><?php
								}
								echo wp_kses_post($mahogany_blog_title_text);
							?></h1>
							<?php
							if (!empty($mahogany_blog_title_link) && !empty($mahogany_blog_title_link_text)) {
								?><a href="<?php echo esc_url($mahogany_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($mahogany_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'mahogany_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>