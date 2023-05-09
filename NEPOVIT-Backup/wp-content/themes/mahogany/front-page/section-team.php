<div class="front_page_section front_page_section_team<?php
			$mahogany_scheme = mahogany_get_theme_option('front_page_team_scheme');
			if (!mahogany_is_inherit($mahogany_scheme)) echo ' scheme_'.esc_attr($mahogany_scheme);
			echo ' front_page_section_paddings_'.esc_attr(mahogany_get_theme_option('front_page_team_paddings'));
		?>"<?php
		$mahogany_css = '';
		$mahogany_bg_image = mahogany_get_theme_option('front_page_team_bg_image');
		if (!empty($mahogany_bg_image)) 
			$mahogany_css .= 'background-image: url('.esc_url(mahogany_get_attachment_url($mahogany_bg_image)).');';
		if (!empty($mahogany_css))
			echo ' style="' . esc_attr($mahogany_css) . '"';
?>><?php
	// Add anchor
	$mahogany_anchor_icon = mahogany_get_theme_option('front_page_team_anchor_icon');	
	$mahogany_anchor_text = mahogany_get_theme_option('front_page_team_anchor_text');	
	if ((!empty($mahogany_anchor_icon) || !empty($mahogany_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_team"'
										. (!empty($mahogany_anchor_icon) ? ' icon="'.esc_attr($mahogany_anchor_icon).'"' : '')
										. (!empty($mahogany_anchor_text) ? ' title="'.esc_attr($mahogany_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_team_inner<?php
			if (mahogany_get_theme_option('front_page_team_fullheight'))
				echo ' mahogany-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$mahogany_css = '';
			$mahogany_bg_mask = mahogany_get_theme_option('front_page_team_bg_mask');
			$mahogany_bg_color = mahogany_get_theme_option('front_page_team_bg_color');
			if (!empty($mahogany_bg_color) && $mahogany_bg_mask > 0)
				$mahogany_css .= 'background-color: '.esc_attr($mahogany_bg_mask==1
																	? $mahogany_bg_color
																	: mahogany_hex2rgba($mahogany_bg_color, $mahogany_bg_mask)
																).';';
			if (!empty($mahogany_css))
				echo ' style="' . esc_attr($mahogany_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_team_content_wrap content_wrap">
			<?php
			// Caption
			$mahogany_caption = mahogany_get_theme_option('front_page_team_caption');
			if (!empty($mahogany_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_team_caption front_page_block_<?php echo !empty($mahogany_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses($mahogany_caption, 'mahogany_kses_content'); ?></h2><?php
			}
		
			// Description (text)
			$mahogany_description = mahogany_get_theme_option('front_page_team_description');
			if (!empty($mahogany_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_team_description front_page_block_<?php echo !empty($mahogany_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses(wpautop($mahogany_description), 'mahogany_kses_content'); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_team_output"><?php 
				if (is_active_sidebar('front_page_team_widgets')) {
					dynamic_sidebar( 'front_page_team_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!mahogany_exists_trx_addons())
						mahogany_customizer_need_trx_addons_message();
					else
						mahogany_customizer_need_widgets_message('front_page_team_caption', 'ThemeREX Addons - Team');
				}
			?></div>
		</div>
	</div>
</div>