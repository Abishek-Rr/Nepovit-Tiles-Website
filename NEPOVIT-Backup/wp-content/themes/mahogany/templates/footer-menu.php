<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */

// Footer menu
$mahogany_menu_footer = mahogany_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($mahogany_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php mahogany_show_layout($mahogany_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>