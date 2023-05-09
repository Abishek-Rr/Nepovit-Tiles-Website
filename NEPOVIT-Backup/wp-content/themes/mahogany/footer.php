<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0
 */

						// Widgets area inside page content
						mahogany_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					mahogany_create_widgets_area('widgets_below_page');

					$mahogany_body_style = mahogany_get_theme_option('body_style');
					if ($mahogany_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$mahogany_footer_type = mahogany_get_theme_option("footer_type");
			if ($mahogany_footer_type == 'custom' && !mahogany_is_layouts_available())
				$mahogany_footer_type = 'default';
			get_template_part( "templates/footer-{$mahogany_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (mahogany_is_on(mahogany_get_theme_option('debug_mode')) && mahogany_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(mahogany_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>