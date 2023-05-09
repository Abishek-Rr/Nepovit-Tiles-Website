<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */

$mahogany_footer_scheme =  mahogany_is_inherit(mahogany_get_theme_option('footer_scheme')) ? mahogany_get_theme_option('color_scheme') : mahogany_get_theme_option('footer_scheme');
$mahogany_footer_id = str_replace('footer-custom-', '', mahogany_get_theme_option("footer_style"));
if ((int) $mahogany_footer_id == 0) {
	$mahogany_footer_id = mahogany_get_post_id(array(
												'name' => $mahogany_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$mahogany_footer_id = apply_filters('mahogany_filter_get_translated_layout', $mahogany_footer_id);
}
$mahogany_footer_meta = get_post_meta($mahogany_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($mahogany_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($mahogany_footer_id))); 
						if (!empty($mahogany_footer_meta['margin']) != '') 
							echo ' '.esc_attr(mahogany_add_inline_css_class('margin-top: '.mahogany_prepare_css_value($mahogany_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($mahogany_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('mahogany_action_show_layout', $mahogany_footer_id);
	?>
</footer><!-- /.footer_wrap -->
