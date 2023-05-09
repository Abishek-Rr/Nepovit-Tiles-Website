<div class="front_page_section front_page_section_contacts<?php
			$mahogany_scheme = mahogany_get_theme_option('front_page_contacts_scheme');
			if (!mahogany_is_inherit($mahogany_scheme)) echo ' scheme_'.esc_attr($mahogany_scheme);
			echo ' front_page_section_paddings_'.esc_attr(mahogany_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$mahogany_css = '';
		$mahogany_bg_image = mahogany_get_theme_option('front_page_contacts_bg_image');
		if (!empty($mahogany_bg_image)) 
			$mahogany_css .= 'background-image: url('.esc_url(mahogany_get_attachment_url($mahogany_bg_image)).');';
		if (!empty($mahogany_css))
			echo ' style="' . esc_attr($mahogany_css) . '"';
?>><?php
	// Add anchor
	$mahogany_anchor_icon = mahogany_get_theme_option('front_page_contacts_anchor_icon');	
	$mahogany_anchor_text = mahogany_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($mahogany_anchor_icon) || !empty($mahogany_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($mahogany_anchor_icon) ? ' icon="'.esc_attr($mahogany_anchor_icon).'"' : '')
										. (!empty($mahogany_anchor_text) ? ' title="'.esc_attr($mahogany_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (mahogany_get_theme_option('front_page_contacts_fullheight'))
				echo ' mahogany-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$mahogany_css = '';
			$mahogany_bg_mask = mahogany_get_theme_option('front_page_contacts_bg_mask');
			$mahogany_bg_color = mahogany_get_theme_option('front_page_contacts_bg_color');
			if (!empty($mahogany_bg_color) && $mahogany_bg_mask > 0)
				$mahogany_css .= 'background-color: '.esc_attr($mahogany_bg_mask==1
																	? $mahogany_bg_color
																	: mahogany_hex2rgba($mahogany_bg_color, $mahogany_bg_mask)
																).';';
			if (!empty($mahogany_css))
				echo ' style="' . esc_attr($mahogany_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$mahogany_caption = mahogany_get_theme_option('front_page_contacts_caption');
			$mahogany_description = mahogany_get_theme_option('front_page_contacts_description');
			if (!empty($mahogany_caption) || !empty($mahogany_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($mahogany_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($mahogany_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses($mahogany_caption, 'mahogany_kses_content');
					?></h2><?php
				}
			
				// Description
				if (!empty($mahogany_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($mahogany_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses(wpautop($mahogany_description), 'mahogany_kses_content');
					?></div><?php
				}
			}

			// Content (text)
			$mahogany_content = mahogany_get_theme_option('front_page_contacts_content');
			$mahogany_layout = mahogany_get_theme_option('front_page_contacts_layout');
			if ($mahogany_layout == 'columns' && (!empty($mahogany_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($mahogany_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($mahogany_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses($mahogany_content, 'mahogany_kses_content');
				?></div><?php
			}

			if ($mahogany_layout == 'columns' && (!empty($mahogany_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$mahogany_sc = mahogany_get_theme_option('front_page_contacts_shortcode');
			if (!empty($mahogany_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($mahogany_sc) ? 'filled' : 'empty'; ?>"><?php
					mahogany_show_layout(do_shortcode($mahogany_sc));
				?></div><?php
			}

			if ($mahogany_layout == 'columns' && (!empty($mahogany_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>