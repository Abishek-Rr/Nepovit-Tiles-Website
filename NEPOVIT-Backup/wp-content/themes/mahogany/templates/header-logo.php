<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

$mahogany_args = get_query_var('mahogany_logo_args');

// Site logo
$mahogany_logo_type   = isset($mahogany_args['type']) ? $mahogany_args['type'] : '';
$mahogany_logo_image  = mahogany_get_logo_image($mahogany_logo_type);
$mahogany_logo_text   = mahogany_is_on(mahogany_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$mahogany_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($mahogany_logo_image) || !empty($mahogany_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($mahogany_logo_image)) {
			if (empty($mahogany_logo_type) && function_exists('the_custom_logo') && is_numeric( $mahogany_logo_image['logo'] ) && $mahogany_logo_image['logo'] > 0) {
				the_custom_logo();
			} else {
				$mahogany_attr = mahogany_getimagesize($mahogany_logo_image);
				echo '<img src="'.esc_url($mahogany_logo_image).'" alt="'.esc_attr__('img', 'mahogany').'"'.(!empty($mahogany_attr[3]) ? ' '.wp_kses_data($mahogany_attr[3]) : '').'>';
			}
		} else {
			mahogany_show_layout(mahogany_prepare_macros($mahogany_logo_text), '<span class="logo_text">', '</span>');
			mahogany_show_layout(mahogany_prepare_macros($mahogany_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>