<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

if (mahogany_sidebar_present()) {
	ob_start();
	$mahogany_sidebar_name = mahogany_get_theme_option('sidebar_widgets');
	mahogany_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($mahogany_sidebar_name) ) {
		dynamic_sidebar($mahogany_sidebar_name);
	}
	$mahogany_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($mahogany_out)) {
		$mahogany_sidebar_position = mahogany_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($mahogany_sidebar_position); ?> widget_area<?php if (!mahogany_is_inherit(mahogany_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(mahogany_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'mahogany_action_before_sidebar' );
				mahogany_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $mahogany_out));
				do_action( 'mahogany_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>