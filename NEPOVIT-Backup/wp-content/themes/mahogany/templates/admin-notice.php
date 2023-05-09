<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.1
 */
 
$mahogany_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="mahogany_admin_notice">
	<h3 class="mahogany_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(__('Welcome to %1$s v.%2$s', 'mahogany'),
				$mahogany_theme_obj->name . (MAHOGANY_THEME_FREE ? ' ' . __('Free', 'mahogany') : ''),
				$mahogany_theme_obj->version
				));
	?></h3>
	<?php
	if (!mahogany_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'mahogany')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=mahogany_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(__('About %s', 'mahogany'), $mahogany_theme_obj->name));
		?></a>
		<?php
		if (mahogany_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'mahogany'); ?></a>
			<?php
		}
		if (function_exists('mahogany_exists_trx_addons') && mahogany_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'mahogany'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'mahogany'); ?></a>
		<span> <?php esc_html_e('or', 'mahogany'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'mahogany'); ?></a>
        <a href="#" class="button mahogany_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'mahogany'); ?></a>
	</p>
</div>