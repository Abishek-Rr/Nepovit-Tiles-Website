<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js scheme_<?php
										 // Class scheme_xxx need in the <html> as context for the <body>!
										 echo esc_attr(mahogany_get_theme_option('color_scheme'));
										 ?>">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>
      <?php wp_body_open(); ?>

	<?php do_action( 'mahogany_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap"><?php
			
			// Desktop header
			$mahogany_header_type = mahogany_get_theme_option("header_type");
			if ($mahogany_header_type == 'custom' && !mahogany_is_layouts_available())
				$mahogany_header_type = 'default';
			get_template_part( "templates/header-{$mahogany_header_type}");

			// Side menu
			if (in_array(mahogany_get_theme_option('menu_style'), array('left', 'right'))) {
				get_template_part( 'templates/header-navi-side' );
			}

			// Mobile header
			get_template_part( 'templates/header-mobile');
			?>

			<div class="page_content_wrap">

				<?php if (mahogany_get_theme_option('body_style') != 'fullscreen') { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					mahogany_create_widgets_area('widgets_above_page');
					?>				

					<div class="content">
						<?php
						// Widgets area inside page content
						mahogany_create_widgets_area('widgets_above_content');
						?>				
