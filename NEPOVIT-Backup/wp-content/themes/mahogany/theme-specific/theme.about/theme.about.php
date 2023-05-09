<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if (!function_exists('mahogany_about_after_switch_theme')) {
	add_action('after_switch_theme', 'mahogany_about_after_switch_theme', 1000);
	function mahogany_about_after_switch_theme() {
		update_option('mahogany_about_page', 1);
	}
}
if ( !function_exists('mahogany_about_after_setup_theme') ) {
	add_action( 'init', 'mahogany_about_after_setup_theme', 1000 );
	function mahogany_about_after_setup_theme() {
		if (get_option('mahogany_about_page') == 1) {
			update_option('mahogany_about_page', 0);
			wp_safe_redirect(admin_url().'themes.php?page=mahogany_about');
			exit();
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if (!function_exists('mahogany_about_add_menu_items')) {
	add_action( 'admin_menu', 'mahogany_about_add_menu_items' );
	function mahogany_about_add_menu_items() {
		$theme = wp_get_theme();
		$theme_name = $theme->name . (MAHOGANY_THEME_FREE ? ' ' . esc_html__('Free', 'mahogany') : '');
		add_theme_page(
			// Translators: Add theme name to the page title
			sprintf(esc_html__('About %s', 'mahogany'), $theme_name),	//page_title
			// Translators: Add theme name to the menu title
			sprintf(esc_html__('About %s', 'mahogany'), $theme_name),	//menu_title
			'manage_options',											//capability
			'mahogany_about',											//menu_slug
			'mahogany_about_page_builder'								//callback
		);
	}
}


// Load page-specific scripts and styles
if (!function_exists('mahogany_about_enqueue_scripts')) {
	add_action( 'admin_enqueue_scripts', 'mahogany_about_enqueue_scripts' );
	function mahogany_about_enqueue_scripts() {
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && $screen->id == 'appearance_page_mahogany_about') {
			// Scripts
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			
			if (function_exists('mahogany_plugins_installer_enqueue_scripts'))
				mahogany_plugins_installer_enqueue_scripts();
			
			// Styles
			wp_enqueue_style( 'fontello-icons',  mahogany_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			if ( ($fdir = mahogany_get_file_url('theme-specific/theme.about/theme.about.css')) != '' )
				wp_enqueue_style( 'mahogany-about',  $fdir, array(), null );
		}
	}
}


// Build 'About Theme' page
if (!function_exists('mahogany_about_page_builder')) {
	function mahogany_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="mahogany_about">
			<div class="mahogany_about_header">
				<div class="mahogany_about_logo"><?php
					$logo = mahogany_get_file_url('theme-specific/theme.about/logo.jpg');
					if (empty($logo)) $logo = mahogany_get_file_url('screenshot.jpg');
					if (!empty($logo)) {
						?><img src="<?php echo esc_url($logo); ?>"><?php
					}
				?></div>
				
				<?php if (MAHOGANY_THEME_FREE) { ?>
					<a href="<?php echo esc_url(mahogany_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="mahogany_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'mahogany');
										?></a>
				<?php } ?>
				<h1 class="mahogany_about_title"><?php
					// Translators: Add theme name and version to the 'Welcome' message
					echo esc_html(sprintf(__('Welcome to %1$s %2$s v.%3$s', 'mahogany'),
								$theme->name,
								MAHOGANY_THEME_FREE ? __('Free', 'mahogany') : '',
								$theme->version
								));
				?></h1>
				<div class="mahogany_about_description">
					<?php
					if (MAHOGANY_THEME_FREE) {
						?><p><?php
							// Translators: Add the download url and the theme name to the message
							echo wp_kses_data(sprintf(__('Now you are using Free version of <a href="%1$s">%2$s Pro Theme</a>.', 'mahogany'),
														esc_url(mahogany_storage_get('theme_download_url')),
														$theme->name
														)
												);
							// Translators: Add the theme name and supported plugins list to the message
							echo '<br>' . wp_kses_data(sprintf(__('This version is SEO- and Retina-ready. It also has a built-in support for parallax and slider with swipe gestures. %1$s Free is compatible with many popular plugins, such as %2$s', 'mahogany'),
														$theme->name,
														mahogany_about_get_supported_plugins()
														)
												);
						?></p>
						<p><?php
							// Translators: Add the download url to the message
							echo wp_kses_data(sprintf(__('We hope you have a great acquaintance with our themes. If you are looking for a fully functional website, you can get the <a href="%s">Pro Version here</a>', 'mahogany'),
														esc_url(mahogany_storage_get('theme_download_url'))
														)
												);
						?></p><?php
					} else {
						?><p><?php
							// Translators: Add the theme name to the message
							echo wp_kses_data(sprintf(__('%s is a Premium WordPress theme. It has a built-in support for parallax, slider with swipe gestures, and is SEO- and Retina-ready', 'mahogany'),
														$theme->name
														)
												);
						?></p>
						<p><?php
							// Translators: Add supported plugins list to the message
							echo wp_kses_data(sprintf(__('The Premium Theme is compatible with many popular plugins, such as %s', 'mahogany'),
														mahogany_about_get_supported_plugins()
														)
												);
						?></p><?php
					}
					?>
				</div>
			</div>
			<div id="mahogany_about_tabs" class="mahogany_tabs mahogany_about_tabs">
				<ul>
					<li><a href="#mahogany_about_section_start"><?php esc_html_e('Getting started', 'mahogany'); ?></a></li>
					<li><a href="#mahogany_about_section_actions"><?php esc_html_e('Recommended actions', 'mahogany'); ?></a></li>
					<?php if (MAHOGANY_THEME_FREE) { ?>
						<li><a href="#mahogany_about_section_pro"><?php esc_html_e('Free vs PRO', 'mahogany'); ?></a></li>
					<?php } ?>
				</ul>
				<div id="mahogany_about_section_start" class="mahogany_tabs_section mahogany_about_section"><?php
				
					// Install required plugins
					if (!MAHOGANY_THEME_FREE_WP && !mahogany_exists_trx_addons()) {
						?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
							<h2 class="mahogany_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'mahogany'); ?>
							</h2>
							<div class="mahogany_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'mahogany');
							?></div>
							<?php mahogany_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'mahogany'); ?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'mahogany'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('Install plugins', 'mahogany');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'mahogany'); ?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'mahogany');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'mahogany');
						?></a>
						<?php esc_html_e('or', 'mahogany'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="mahogany_about_block_link button"><?php
							esc_html_e('Theme Options', 'mahogany');
						?></a>
					</div></div><?php
					
					// Documentation
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-book"></i>
							<?php esc_html_e('Read full documentation', 'mahogany');	?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(__('Need more details? Please check our full online documentation for detailed information on how to use %s.', 'mahogany'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(mahogany_storage_get('theme_doc_url')); ?>"
						   target="_blank"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('Documentation', 'mahogany');
						?></a>
					</div></div><?php
					
					// Video tutorials
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-video-alt2"></i>
							<?php esc_html_e('Video tutorials', 'mahogany');	?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(__('No time for reading documentation? Check out our video tutorials and learn how to customize %s in detail.', 'mahogany'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(mahogany_storage_get('theme_video_url')); ?>"
						   target="_blank"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('Watch videos', 'mahogany');
						?></a>
					</div></div><?php
					
					// Support
					if (!MAHOGANY_THEME_FREE) {
						?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
							<h2 class="mahogany_about_block_title">
								<i class="dashicons dashicons-sos"></i>
								<?php esc_html_e('Support', 'mahogany'); ?>
							</h2>
							<div class="mahogany_about_block_description"><?php
								// Translators: Add the theme name to the message
								echo esc_html(sprintf(__('We want to make sure you have the best experience using %s and that is why we gathered here all the necessary informations for you.', 'mahogany'), $theme->name));
							?></div>
							<a href="<?php echo esc_url(mahogany_storage_get('theme_support_url')); ?>"
							   target="_blank"
							   class="mahogany_about_block_link button button-primary"><?php
								esc_html_e('Support', 'mahogany');
							?></a>
						</div></div><?php
					}
					
					// Online Demo
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-images-alt2"></i>
							<?php esc_html_e('On-line demo', 'mahogany'); ?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(__('Visit the Demo Version of %s to check out all the features it has', 'mahogany'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(mahogany_storage_get('theme_demo_url')); ?>"
						   target="_blank"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('View demo', 'mahogany');
						?></a>
					</div></div>
					
				</div>



				<div id="mahogany_about_section_actions" class="mahogany_tabs_section mahogany_about_section"><?php
				
					// Install required plugins
					if (!MAHOGANY_THEME_FREE_WP && !mahogany_exists_trx_addons()) {
						?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
							<h2 class="mahogany_about_block_title">
								<i class="dashicons dashicons-admin-plugins"></i>
								<?php esc_html_e('ThemeREX Addons', 'mahogany'); ?>
							</h2>
							<div class="mahogany_about_block_description"><?php
								esc_html_e('It is highly recommended that you install the companion plugin "ThemeREX Addons" to have access to the layouts builder, awesome shortcodes, team and testimonials, services and slider, and many other features ...', 'mahogany');
							?></div>
							<?php mahogany_plugins_installer_get_button_html('trx_addons'); ?>
						</div></div><?php
					}
					
					// Install recommended plugins
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-admin-plugins"></i>
							<?php esc_html_e('Recommended plugins', 'mahogany'); ?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							// Translators: Add the theme name to the message
							echo esc_html(sprintf(__('Theme %s is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.', 'mahogany'), $theme->name));
						?></div>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>"
						   class="mahogany_about_block_link button button button-primary"><?php
							esc_html_e('Install plugins', 'mahogany');
						?></a>
					</div></div><?php
					
					// Customizer or Theme Options
					?><div class="mahogany_about_block"><div class="mahogany_about_block_inner">
						<h2 class="mahogany_about_block_title">
							<i class="dashicons dashicons-admin-appearance"></i>
							<?php esc_html_e('Setup Theme options', 'mahogany'); ?>
						</h2>
						<div class="mahogany_about_block_description"><?php
							esc_html_e('Using the WordPress Customizer you can easily customize every aspect of the theme. If you want to use the standard theme settings page - open Theme Options and follow the same steps there.', 'mahogany');
						?></div>
						<a href="<?php echo esc_url(admin_url().'customize.php'); ?>"
						   target="_blank"
						   class="mahogany_about_block_link button button-primary"><?php
							esc_html_e('Customizer', 'mahogany');
						?></a>
						<?php esc_html_e('or', 'mahogany'); ?>
						<a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>"
						   class="mahogany_about_block_link button"><?php
							esc_html_e('Theme Options', 'mahogany');
						?></a>
					</div></div>
					
				</div>



				<?php if (MAHOGANY_THEME_FREE) { ?>
					<div id="mahogany_about_section_pro" class="mahogany_tabs_section mahogany_about_section">
						<table class="mahogany_about_table" cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<td class="mahogany_about_table_info">&nbsp;</td>
									<td class="mahogany_about_table_check"><?php
										// Translators: Show theme name with suffix 'Free'
										echo esc_html(sprintf(__('%s Free', 'mahogany'), $theme->name));
									?></td>
									<td class="mahogany_about_table_check"><?php
										// Translators: Show theme name with suffix 'PRO'
										echo esc_html(sprintf(__('%s PRO', 'mahogany'), $theme->name));
									?></td>
								</tr>
							</thead>
							<tbody>
	
	
								<?php
								// Responsive layouts
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Mobile friendly', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Responsive layout. Looks great on any device.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Built-in slider
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Built-in posts slider', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Allows you to add beautiful slides using the built-in shortcode/widget "Slider" with swipe gestures support.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Revolution slider
								if (mahogany_storage_isset('required_plugins', 'revslider')) {
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Revolution Slider Compatibility', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Our built-in shortcode/widget "Slider" is able to work not only with posts, but also with slides created  in "Revolution Slider".', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// SiteOrigin Panels
								if (mahogany_storage_isset('required_plugins', 'siteorigin-panels')) {
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Free PageBuilder', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Full integration with a nice free page builder "SiteOrigin Panels".', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Additional widgets pack', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('A number of useful widgets to create beautiful homepages and other sections of your website with SiteOrigin Panels.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// WPBakery Page Builder
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('WPBakery Page Builder', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Full integration with a very popular page builder "WPBakery Page Builder". A number of useful shortcodes and widgets to create beautiful homepages and other sections of your website.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Additional shortcodes pack', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('A number of useful shortcodes to create beautiful homepages and other sections of your website with WPBakery Page Builder.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Layouts builder
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Headers and Footers builder', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Powerful visual builder of headers and footers! No manual code editing - use all the advantages of drag-and-drop technology.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// WooCommerce
								if (mahogany_storage_isset('required_plugins', 'woocommerce')) {
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('WooCommerce Compatibility', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Ready for e-commerce. You can build an online store with this theme.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Easy Digital Downloads
								if (mahogany_storage_isset('required_plugins', 'easy-digital-downloads')) {
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Easy Digital Downloads Compatibility', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Ready for digital e-commerce. You can build an online digital store with this theme.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
								<?php } ?>
	
								<?php
								// Other plugins
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Many other popular plugins compatibility', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('PRO version is compatible (was tested and has built-in support) with many popular plugins.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Support
								?>
								<tr>
									<td class="mahogany_about_table_info">
										<h2 class="mahogany_about_table_info_title">
											<?php esc_html_e('Support', 'mahogany'); ?>
										</h2>
										<div class="mahogany_about_table_info_description"><?php
											esc_html_e('Our premium support is going to take care of any problems, in case there will be any of course.', 'mahogany');
										?></div>
									</td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-no"></i></td>
									<td class="mahogany_about_table_check"><i class="dashicons dashicons-yes"></i></td>
								</tr>
	
								<?php
								// Get PRO version
								?>
								<tr>
									<td class="mahogany_about_table_info">&nbsp;</td>
									<td class="mahogany_about_table_check" colspan="2">
										<a href="<?php echo esc_url(mahogany_storage_get('theme_download_url')); ?>"
										   target="_blank"
										   class="mahogany_about_block_link mahogany_about_pro_link button button-primary"><?php
											esc_html_e('Get PRO version', 'mahogany');
										?></a>
									</td>
								</tr>
	
							</tbody>
						</table>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<?php
	}
}


// Utils
//------------------------------------

// Return supported plugin's names
if (!function_exists('mahogany_about_get_supported_plugins')) {
	function mahogany_about_get_supported_plugins() {
		return '"' . join('", "', array_values(mahogany_storage_get('required_plugins'))) . '"';
	}
}

require_once MAHOGANY_THEME_DIR . 'includes/plugins.installer/plugins.installer.php';
?>