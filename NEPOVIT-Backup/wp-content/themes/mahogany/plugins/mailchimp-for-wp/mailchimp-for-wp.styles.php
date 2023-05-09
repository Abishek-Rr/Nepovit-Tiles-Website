<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('mahogany_mailchimp_get_css')) {
	add_filter('mahogany_filter_get_css', 'mahogany_mailchimp_get_css', 10, 4);
	function mahogany_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
form.mc4wp-form .mc4wp-form-fields input[type="email"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
CSS;
		
			
			$rad = mahogany_get_border_radius();
			$css['fonts'] .= <<<CSS



CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

form.mc4wp-form input[type="email"] {
	background-color: {$colors['alter_dark']};
	border-color: {$colors['alter_dark']};
	color: {$colors['alter_text']};
}

form.mc4wp-form .mc4wp-form-fields button {
	background-color: transparent;
	border-color: transparent;
	color: {$colors['text_link']};
}
form.mc4wp-form .mc4wp-form-fields button:hover {
	background-color: transparent;
	border-color: transparent;
	color: {$colors['text_hover']};
}

form.mc4wp-form input[type="email"]::-webkit-input-placeholder {color:{$colors['alter_text']};}
form.mc4wp-form input[type="email"]::-moz-placeholder          {color:{$colors['alter_text']};}/* Firefox 19+ */
form.mc4wp-form input[type="email"]:-moz-placeholder           {color:{$colors['alter_text']};}/* Firefox 18- */
form.mc4wp-form input[type="email"]:-ms-input-placeholder      {color:{$colors['alter_text']};}

form.mc4wp-form .mc4wp-alert {
	background-color: {$colors['inverse_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.mc4wp-form a{
    color: {$colors['text_link3']};
}
CSS;
		}

		return $css;
	}
}
?>