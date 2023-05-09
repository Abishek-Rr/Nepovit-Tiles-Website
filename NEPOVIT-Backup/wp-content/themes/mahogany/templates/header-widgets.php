<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

// Header sidebar
$mahogany_header_name = mahogany_get_theme_option('header_widgets');
$mahogany_header_present = !mahogany_is_off($mahogany_header_name) && is_active_sidebar($mahogany_header_name);
if ($mahogany_header_present) { 
	mahogany_storage_set('current_sidebar', 'header');
	$mahogany_header_wide = mahogany_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($mahogany_header_name) ) {
		dynamic_sidebar($mahogany_header_name);
	}
	$mahogany_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($mahogany_widgets_output)) {
		$mahogany_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $mahogany_widgets_output);
		$mahogany_need_columns = strpos($mahogany_widgets_output, 'columns_wrap')===false;
		if ($mahogany_need_columns) {
			$mahogany_columns = max(0, (int) mahogany_get_theme_option('header_columns'));
			if ($mahogany_columns == 0) $mahogany_columns = min(6, max(1, substr_count($mahogany_widgets_output, '<aside ')));
			if ($mahogany_columns > 1)
				$mahogany_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($mahogany_columns).' widget', $mahogany_widgets_output);
			else
				$mahogany_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($mahogany_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$mahogany_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($mahogany_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'mahogany_action_before_sidebar' );
				mahogany_show_layout($mahogany_widgets_output);
				do_action( 'mahogany_action_after_sidebar' );
				if ($mahogany_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$mahogany_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>