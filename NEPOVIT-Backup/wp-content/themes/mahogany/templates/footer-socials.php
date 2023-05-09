<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */


// Socials
if ( mahogany_is_on(mahogany_get_theme_option('socials_in_footer')) && ($mahogany_output = mahogany_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php mahogany_show_layout($mahogany_output); ?>
		</div>
	</div>
	<?php
}
?>