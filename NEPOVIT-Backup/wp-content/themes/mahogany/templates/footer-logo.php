<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */

// Logo
if (mahogany_is_on(mahogany_get_theme_option('logo_in_footer'))) {
	$mahogany_logo_image = '';
	if (mahogany_is_on(mahogany_get_theme_option('logo_retina_enabled')) && mahogany_get_retina_multiplier(2) > 1)
		$mahogany_logo_image = mahogany_get_theme_option( 'logo_footer_retina' );
	if (empty($mahogany_logo_image)) 
		$mahogany_logo_image = mahogany_get_theme_option( 'logo_footer' );
	$mahogany_logo_text   = get_bloginfo( 'name' );
	if (!empty($mahogany_logo_image) || !empty($mahogany_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($mahogany_logo_image)) {
					$mahogany_attr = mahogany_getimagesize($mahogany_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($mahogany_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('img', 'mahogany').'"'.(!empty($mahogany_attr[3]) ? ' ' . wp_kses_data($mahogany_attr[3]) : '').'></a>' ;
				} else if (!empty($mahogany_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($mahogany_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>