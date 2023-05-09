<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.10
 */

// Copyright area
$mahogany_footer_scheme =  mahogany_is_inherit(mahogany_get_theme_option('footer_scheme')) ? mahogany_get_theme_option('color_scheme') : mahogany_get_theme_option('footer_scheme');
$mahogany_copyright_scheme = mahogany_is_inherit(mahogany_get_theme_option('copyright_scheme')) ? $mahogany_footer_scheme : mahogany_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($mahogany_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$mahogany_copyright = mahogany_prepare_macros(mahogany_get_theme_option('copyright'));
				if (!empty($mahogany_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $mahogany_copyright, $mahogany_matches)) {
						$mahogany_copyright = str_replace($mahogany_matches[1], date_i18n(str_replace(array('{', '}'), '', $mahogany_matches[1])), $mahogany_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($mahogany_copyright));
				}
			?></div>
		</div>
	</div>
</div>
