<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */

// Footer sidebar
$mahogany_footer_name = mahogany_get_theme_option('footer_widgets');
$mahogany_footer_present = !mahogany_is_off($mahogany_footer_name) && is_active_sidebar($mahogany_footer_name);
if ($mahogany_footer_present) { 
	mahogany_storage_set('current_sidebar', 'footer');
	$mahogany_footer_wide = mahogany_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($mahogany_footer_name) ) {
		dynamic_sidebar($mahogany_footer_name);
	}
	$mahogany_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($mahogany_out)) {
		$mahogany_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $mahogany_out);
		$mahogany_need_columns = true;
		if ($mahogany_need_columns) {
			$mahogany_columns = max(0, (int) mahogany_get_theme_option('footer_columns'));
			if ($mahogany_columns == 0) $mahogany_columns = min(4, max(1, substr_count($mahogany_out, '<aside ')));
			if ($mahogany_columns > 1)
				$mahogany_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($mahogany_columns).' widget', $mahogany_out);
			else
				$mahogany_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($mahogany_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$mahogany_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($mahogany_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'mahogany_action_before_sidebar' );
				mahogany_show_layout($mahogany_out);
				do_action( 'mahogany_action_after_sidebar' );
				if ($mahogany_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$mahogany_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>