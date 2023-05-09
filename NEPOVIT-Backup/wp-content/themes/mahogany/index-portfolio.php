<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

mahogany_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	mahogany_show_layout(get_query_var('blog_archive_start'));

	$mahogany_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$mahogany_sticky_out = mahogany_get_theme_option('sticky_style')=='columns' 
							&& is_array($mahogany_stickies) && count($mahogany_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$mahogany_cat = mahogany_get_theme_option('parent_cat');
	$mahogany_post_type = mahogany_get_theme_option('post_type');
	$mahogany_taxonomy = mahogany_get_post_type_taxonomy($mahogany_post_type);
	$mahogany_show_filters = mahogany_get_theme_option('show_filters');
	$mahogany_tabs = array();
	if (!mahogany_is_off($mahogany_show_filters)) {
		$mahogany_args = array(
			'type'			=> $mahogany_post_type,
			'child_of'		=> $mahogany_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $mahogany_taxonomy,
			'pad_counts'	=> false
		);
		$mahogany_portfolio_list = get_terms($mahogany_args);
		if (is_array($mahogany_portfolio_list) && count($mahogany_portfolio_list) > 0) {
			$mahogany_tabs[$mahogany_cat] = esc_html__('All', 'mahogany');
			foreach ($mahogany_portfolio_list as $mahogany_term) {
				if (isset($mahogany_term->term_id)) $mahogany_tabs[$mahogany_term->term_id] = $mahogany_term->name;
			}
		}
	}
	if (count($mahogany_tabs) > 0) {
		$mahogany_portfolio_filters_ajax = true;
		$mahogany_portfolio_filters_active = $mahogany_cat;
		$mahogany_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters mahogany_tabs mahogany_tabs_ajax">
			<ul class="portfolio_titles mahogany_tabs_titles">
				<?php
				foreach ($mahogany_tabs as $mahogany_id=>$mahogany_title) {
					?><li><a href="<?php echo esc_url(mahogany_get_hash_link(sprintf('#%s_%s_content', $mahogany_portfolio_filters_id, $mahogany_id))); ?>" data-tab="<?php echo esc_attr($mahogany_id); ?>"><?php echo esc_html($mahogany_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$mahogany_ppp = mahogany_get_theme_option('posts_per_page');
			if (mahogany_is_inherit($mahogany_ppp)) $mahogany_ppp = '';
			foreach ($mahogany_tabs as $mahogany_id=>$mahogany_title) {
				$mahogany_portfolio_need_content = $mahogany_id==$mahogany_portfolio_filters_active || !$mahogany_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $mahogany_portfolio_filters_id, $mahogany_id)); ?>"
					class="portfolio_content mahogany_tabs_content"
					data-blog-template="<?php echo esc_attr(mahogany_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(mahogany_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($mahogany_ppp); ?>"
					data-post-type="<?php echo esc_attr($mahogany_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($mahogany_taxonomy); ?>"
					data-cat="<?php echo esc_attr($mahogany_id); ?>"
					data-parent-cat="<?php echo esc_attr($mahogany_cat); ?>"
					data-need-content="<?php echo (false===$mahogany_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($mahogany_portfolio_need_content) 
						mahogany_show_portfolio_posts(array(
							'cat' => $mahogany_id,
							'parent_cat' => $mahogany_cat,
							'taxonomy' => $mahogany_taxonomy,
							'post_type' => $mahogany_post_type,
							'page' => 1,
							'sticky' => $mahogany_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		mahogany_show_portfolio_posts(array(
			'cat' => $mahogany_cat,
			'parent_cat' => $mahogany_cat,
			'taxonomy' => $mahogany_taxonomy,
			'post_type' => $mahogany_post_type,
			'page' => 1,
			'sticky' => $mahogany_sticky_out
			)
		);
	}

	mahogany_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>