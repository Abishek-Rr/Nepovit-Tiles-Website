<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage MAHOGANY
 * @since MAHOGANY 1.0.22
 */

if (!defined("MAHOGANY_THEME_FREE")) define("MAHOGANY_THEME_FREE", false);
if (!defined("MAHOGANY_THEME_FREE_WP")) define("MAHOGANY_THEME_FREE_WP", false);

// Theme storage
$MAHOGANY_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'mahogany'),

			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'contact-form-7'				=> esc_html__('Contact Form 7', 'mahogany'),
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'mahogany'),
			'woocommerce'					=> esc_html__('WooCommerce', 'mahogany'),
            'yith-woocommerce-wishlist'		=> esc_html__('YITH WooCommerce Wishlist', 'mahogany'),
            'yith-woocommerce-compare'		=> esc_html__('YITH WooCommerce Compare', 'mahogany'),
            'elegro-payment'				=> esc_html__('Elegro Crypto Payment', 'mahogany'),
            'trx_updater'					=> esc_html__('ThemeREX Updater', 'mahogany')
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		MAHOGANY_THEME_FREE 
			? array(
					// Recommended (supported) plugins for the FREE (lite) version
					'siteorigin-panels'			=> esc_html__('SiteOrigin Panels', 'mahogany'),
					) 
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'booked'					=> esc_html__('Booked Appointments', 'mahogany'),
					'essential-grid'			=> esc_html__('Essential Grid', 'mahogany'),
					'revslider'					=> esc_html__('Revolution Slider', 'mahogany'),
					'js_composer'				=> esc_html__('WPBakery Page Builder', 'mahogany'),
				)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'	=> 'http://mahogany.themerex.net',
	'theme_doc_url'		=> 'http://mahogany.themerex.net/doc/',
	'theme_download_url'=> 'https://themeforest.net/item/mahogany-flooring-company-wordpress-theme/21220007?s_rank=1',
	'theme_pro_key' => 'env-themerex',

        'theme_support_url'	=> 'https://themerex.net/support/',								// ThemeREX

	'theme_video_url'	=> 'https://www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',	// ThemeREX
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('mahogany_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'mahogany_customizer_theme_setup1', 1 );
	function mahogany_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		mahogany_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false		// Allow upload not pre-packaged plugins via TGMPA
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		mahogany_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Satisfy',
				'family' => 'cursive',
				'styles' => '400'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif',
				'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i'		// Parameter 'style' used only for the Google fonts
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		mahogany_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		mahogany_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'mahogany'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.688em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.36px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.7em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '5em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2.6px',
				'margin-top'		=> '0.87em',
				'margin-bottom'		=> '0.87em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '4.375em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.15em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2.2px',
				'margin-top'		=> '0.77em',
				'margin-bottom'		=> '0.77em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '3.75em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.17em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.8px',
				'margin-top'		=> '0.7em',
				'margin-bottom'		=> '0.7em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '2.813em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.12em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.75px',
				'margin-top'		=> '0.87em',
				'margin-bottom'		=> '0.87em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '2.188em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.35em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.88px',
				'margin-top'		=> '1.05em',
				'margin-bottom'		=> '1.05em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '1.563em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.78px',
				'margin-top'		=> '1.18em',
				'margin-bottom'		=> '1.18em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'mahogany'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '18px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'mahogany'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '0.938em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',	// Attention! Firefox don't allow line-height less then 1.5em in the select
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.65px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'mahogany'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'mahogany'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.35px',
				'margin-top'		=> '',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'mahogany'),
				'description'		=> esc_html__('Font settings of the main menu items', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '18px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.45px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'mahogany'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'mahogany'),
				'font-family'		=> '"Montserrat",sans-serif',
				'font-size' 		=> '18px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.6px'
				),
			'decorfont' => array(
				'title'				=> esc_html__('Decor font', 'mahogany'),
				'description'		=> esc_html__('Font settings for some decor text', 'mahogany'),
				'font-family'		=> '"Satisfy",cursive'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		mahogany_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'mahogany'),
							'description'	=> esc_html__('Colors of the main content area', 'mahogany')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'mahogany'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'mahogany')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'mahogany'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'mahogany')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'mahogany'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'mahogany')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'mahogany'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'mahogany')
							),
			)
		);
		mahogany_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'mahogany'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'mahogany')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'mahogany'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'mahogany')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'mahogany'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'mahogany')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'mahogany'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'mahogany')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'mahogany'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'mahogany')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'mahogany'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'mahogany')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'mahogany'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'mahogany')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'mahogany'),
							'description'	=> esc_html__('Color of the links inside this block', 'mahogany')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'mahogany'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'mahogany')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'mahogany'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'mahogany')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'mahogany'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'mahogany')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'mahogany'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'mahogany')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'mahogany'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'mahogany')
							)
			)
		);
		mahogany_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'mahogany'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff', //
					'bd_color'			=> '#f5f4f0', //
		
					// Text and links colors
					'text'				=> '#a6a49a', //
					'text_light'		=> '#e4e2dd', //
					'text_dark'			=> '#5b5551', //
					'text_link'			=> '#f3ab3b', //
					'text_hover'		=> '#5b5551', //
					'text_link2'		=> '#ee8d4d', //
					'text_hover2'		=> '#d57b3f', //
					'text_link3'		=> '#5b5551', //
					'text_hover3'		=> '#f3ab3b', //
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f5f4f0', //
					'alter_bg_hover'	=> '#a6a49a', //
					'alter_bd_color'	=> '#e3e2dd', //
					'alter_bd_hover'	=> '#e5e4e4', //
					'alter_text'		=> '#a6a49a', //
					'alter_light'		=> '#f5f4f0', //
					'alter_dark'		=> '#5b5551', //
					'alter_link'		=> '#f3ab3b', //
					'alter_hover'		=> '#ffffff', //
					'alter_link2'		=> '#ee8d4d', //
					'alter_hover2'		=> '#d57b3f', //
					'alter_link3'		=> '#2d2928', //
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#f3ab3b', //
					'extra_bg_hover'	=> '#936649', //
					'extra_bd_color'	=> '#ffffff', //
					'extra_bd_hover'	=> '#edece7', //
					'extra_text'		=> '#a6a49a', //
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff', //
					'extra_link'		=> '#2d211e', //
					'extra_hover'		=> '#ffffff',
					'extra_link2'		=> '#ffffff', //
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f5f4f0', //
					'input_bg_hover'	=> '#f5f4f0', //
					'input_bd_color'	=> '#f5f4f0', //
					'input_bd_hover'	=> '#5b5551', //
					'input_text'		=> '#a6a49a', //
					'input_light'		=> '#a7a7a7',
					'input_dark'		=> '#a6a49a', //
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff', //
					'inverse_hover'		=> '#ffffff' //
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'mahogany'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#2d2928', //
					'bd_color'			=> '#2e2c33',
		
					// Text and links colors
					'text'				=> '#a6a49a', //
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff', //
					'text_link'			=> '#f3ab3b', //
					'text_hover'		=> '#5b5551', //
					'text_link2'		=> '#ee8d4d', //
					'text_hover2'		=> '#d57b3f', //
					'text_link3'		=> '#ffffff', //
					'text_hover3'		=> '#5b5551', //

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#2d2928', //
					'alter_bg_hover'	=> '#7a776f', //
					'alter_bd_color'	=> '#464646',
					'alter_bd_hover'	=> '#4a4a4a',
					'alter_text'		=> '#a6a49a', //
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#f3ab3b', //
					'alter_hover'		=> '#ffffff', //
					'alter_link2'		=> '#ee8d4d',
					'alter_hover2'		=> '#d57b3f',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#f3ab3b', //
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#464646',
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#a6a49a', //
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#f3ab3b', //
					'extra_hover'		=> '#ffffff', //
					'extra_link2'		=> '#5b5551', //
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff', //
					'inverse_hover'		=> '#ffffff' //
				)
			)
		
		));
		
		// Simple schemes substitution
		mahogany_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 
			'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));

		// Additional colors for each scheme
		mahogany_storage_set('scheme_colors_add', array(
			'bg_color_0'		=> array('color' => 'bg_color',			'alpha' => 0),
			'bg_color_02'		=> array('color' => 'bg_color',			'alpha' => 0.2),
			'bg_color_07'		=> array('color' => 'bg_color',			'alpha' => 0.7),
			'bg_color_08'		=> array('color' => 'bg_color',			'alpha' => 0.8),
			'bg_color_09'		=> array('color' => 'bg_color',			'alpha' =>  0.9),
			'alter_bg_color_02'	=> array('color' => 'alter_bg_color',	'alpha' => 0.2),
			'alter_bg_color_03'	=> array('color' => 'alter_bg_color',	'alpha' => 0.3),
			'alter_bg_color_04'	=> array('color' => 'alter_bg_color',	'alpha' => 0.4),
			'alter_bg_color_05'	=> array('color' => 'alter_bg_color',	'alpha' => 0.5),
			'alter_bg_color_07'	=> array('color' => 'alter_bg_color',	'alpha' => 0.7),
			'alter_bg_hover_01'	=> array('color' => 'alter_bg_hover',	'alpha' => 0.1),
			'alter_bg_hover_07'	=> array('color' => 'alter_bg_hover',	'alpha' => 0.7),
			'alter_bd_color_02'	=> array('color' => 'alter_bd_color',	'alpha' => 0.2),
			'alter_bd_color_03'	=> array('color' => 'alter_bd_color',	'alpha' => 0.3),
			'alter_link3_07'	=> array('color' => 'alter_link3',	'alpha' => 0.7),
			'alter_dark_01'	=> array('color' => 'alter_dark',	'alpha' => 0.1),
			'extra_bg_hover_03'	=> array('color' => 'extra_bg_hover',	'alpha' => 0.3),
			'extra_bg_color_07'	=> array('color' => 'extra_bg_color',	'alpha' => 0.7),
			'extra_bg_hover_01'	=> array('color' => 'extra_bg_hover',	'alpha' => 0.1),
			'extra_bd_color_02'	=> array('color' => 'extra_bd_color',	'alpha' => 0.2),
			'extra_bd_hover_02'	=> array('color' => 'extra_bd_hover',	'alpha' => 0.2),
			'extra_dark_01'		=> array('color' => 'extra_dark',		'alpha' => 0.1),
			'extra_link_05'		=> array('color' => 'extra_link',		'alpha' => 0.5),
			'text_light_05'		=> array('color' => 'text_light',		'alpha' => 0.5),
			'text_dark_01'		=> array('color' => 'text_dark',		'alpha' => 0.1),
			'text_dark_04'		=> array('color' => 'text_dark',		'alpha' => 0.4),
			'text_dark_07'		=> array('color' => 'text_dark',		'alpha' => 0.7),
			'text_link_02'		=> array('color' => 'text_link',		'alpha' => 0.2),
			'text_link_07'		=> array('color' => 'text_link',		'alpha' => 0.7),
			'text_link3_05'		=> array('color' => 'text_link3',		'alpha' => 0.5),
			'inverse_link_04'	=> array('color' => 'inverse_link',	'alpha' => 0.4),
			'text_link_blend'	=> array('color' => 'text_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5),
			'alter_link_blend'	=> array('color' => 'alter_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		mahogany_storage_set('theme_thumbs', apply_filters('mahogany_filter_add_thumb_sizes', array(
			'mahogany-thumb-huge'		=> array(
												'size'	=> array(1290, 543, true),
												'title' => esc_html__( 'Huge image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-huge'
												),
			'mahogany-thumb-big' 		=> array(
												'size'	=> array( 850, 358, true),
												'title' => esc_html__( 'Large image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-big'
												),

			'mahogany-thumb-med' 		=> array(
												'size'	=> array( 370, 208, true),
												'title' => esc_html__( 'Medium image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-medium'
												),
			'mahogany-thumb-related' 		=> array(
												'size'	=> array( 410, 271, true),
												'title' => esc_html__( 'Related image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-related'
												),
			'mahogany-thumb-team' 		=> array(
												'size'	=> array( 600, 486, true),
												'title' => esc_html__( 'Team image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-team'
												),
			'mahogany-thumb-servlist' 		=> array(
												'size'	=> array( 501, 534, true),
												'title' => esc_html__( 'Services list image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-servlist'
												),
			'mahogany-thumb-tiny' 		=> array(
												'size'	=> array(  90,  90, true),
												'title' => esc_html__( 'Small square avatar', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-tiny'
												),

			'mahogany-thumb-recent-posts' 		=> array(
												'size'	=> array( 330, 146, true),
												'title' => esc_html__( 'Recent posts image', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-recent-posts'
												),

			'mahogany-thumb-masonry-big' => array(
												'size'	=> array( 760,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry Large (scaled)', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-masonry-big'
												),

			'mahogany-thumb-masonry'		=> array(
												'size'	=> array( 370,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry (scaled)', 'mahogany' ),
												'subst'	=> 'trx_addons-thumb-masonry'
												)
			))
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'mahogany_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'mahogany_importer_set_options', 9 );
	function mahogany_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(mahogany_get_protocol() . '://demofiles.themerex.net/mahogany/');
			// Required plugins
			$options['required_plugins'] = array_keys(mahogany_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('Mahogany Demo', 'mahogany');
			$options['files']['default']['domain_dev'] = esc_url('http://mahogany.themerex.net');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url('http://mahogany.themerex.net');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// Banners
			$options['banners'] = array(
				array(
					'image' => mahogany_get_file_url('theme-specific/theme.about/images/frontpage.png'),
					'title' => esc_html__('Front page Builder', 'mahogany'),
					'content' => wp_kses(__('Create your Frontpage right in WordPress Customizer! To do this, you will not need either the WPBakery Page Builder or any other Builder. Just turn on/off sections, and fill them with content and decorate to your liking', 'mahogany'), 'mahogany_kses_content'),
					'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
					'link_caption' => esc_html__('More about Frontpage Builder', 'mahogany'),
					'duration' => 20
					),
				array(
					'image' => mahogany_get_file_url('theme-specific/theme.about/images/layouts.png'),
					'title' => esc_html__('Custom layouts', 'mahogany'),
					'content' => wp_kses(__('Forget about problems with customization of header or footer! You can edit any layout without any changes in CSS or HTML, directly in Visual Builder. Moreover - you can easily create your own headers and footers and use them along with built-in', 'mahogany'), 'mahogany_kses_content'),
					'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
					'link_caption' => esc_html__('More about Custom Layouts', 'mahogany'),
					'duration' => 20
					),
				array(
					'image' => mahogany_get_file_url('theme-specific/theme.about/images/documentation.png'),
					'title' => esc_html__('Read full documentation', 'mahogany'),
					'content' => wp_kses(__('Need more details? Please check our full online documentation for detailed information on how to use Mahogany', 'mahogany'), 'mahogany_kses_content'),
					'link_url' => esc_url(mahogany_storage_get('theme_doc_url')),
					'link_caption' => esc_html__('Online documentation', 'mahogany'),
					'duration' => 15
					),
				array(
					'image' => mahogany_get_file_url('theme-specific/theme.about/images/video-tutorials.png'),
					'title' => esc_html__('Video tutorials', 'mahogany'),
					'content' => wp_kses(__('No time for reading documentation? Check out our video tutorials and learn how to customize Mahogany in detail.', 'mahogany'), 'mahogany_kses_content'),
					'link_url' => esc_url(mahogany_storage_get('theme_video_url')),
					'link_caption' => esc_html__('Video tutorials', 'mahogany'),
					'duration' => 15
					),
				array(
					'image' => mahogany_get_file_url('theme-specific/theme.about/images/studio.png'),
					'title' => esc_html__('Website Customization', 'mahogany'),
					'content' => wp_kses(__('We can make a website based on this theme for a very fair price.
We can implement any extra functional: translate your website, WPML implementation and many other customization according to your request.', 'mahogany'), 'mahogany_kses_content'),
					'link_url' => esc_url('//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall'),
					'link_caption' => esc_html__('Contact us', 'mahogany'),
					'duration' => 25
					)
				);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('mahogany_create_theme_options')) {

	function mahogany_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'mahogany');

		mahogany_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'mahogany'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'mahogany'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'mahogany'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'mahogany') ),
				"class" => "mahogany_column-1_2 mahogany_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'mahogany'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'mahogany') ),
				"class" => "mahogany_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_max_height' => array(
				"title" => esc_html__('Logo max. height', 'mahogany'),
				"desc" => wp_kses_data( __("Max. height of the logo image (in pixels). Maximum size of logo depends on the actual size of the picture", 'mahogany') ),
				"std" => 80,
				"min" => 20,
				"max" => 160,
				"step" => 1,
				"refresh" => false,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'mahogany') ),
				"class" => "mahogany_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'mahogany') ),
				"class" => "mahogany_column-1_2 mahogany_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'mahogany') ),
				"class" => "mahogany_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'mahogany') ),
				"class" => "mahogany_column-1_2 mahogany_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'mahogany') ),
				"class" => "mahogany_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'mahogany') ),
				"class" => "mahogany_column-1_2 mahogany_new_row",
				"hidden" => true,
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'mahogany') ),
				"class" => "mahogany_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"hidden" => true,
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'mahogany'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'mahogany'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'mahogany'),
				"desc" => wp_kses_data( __('Select width of the body content', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'mahogany')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => mahogany_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'mahogany') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'mahogany')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'mahogany'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'mahogany')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'mahogany'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'mahogany'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'mahogany'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'mahogany'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'mahogany') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'mahogany'),
				"desc" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'mahogany'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'mahogany'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'mahogany'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'mahogany'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'mahogany')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'mahogany'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'mahogany'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'mahogany') ),
				"hidden" => true,
				"std" => 0,
				"type" => "text"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'mahogany'),
				"desc" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'mahogany'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'mahogany') ),
				"std" => 0,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'mahogany'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'mahogany') ),
                "std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'mahogany'), 'mahogany_kses_content'),
                "type"  => "text"
            ),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'mahogany'),
				"desc" => wp_kses( $msg_override, 'mahogany_kses_content' ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'mahogany'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'mahogany'),
				"desc" => wp_kses( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'mahogany'), 'mahogany_kses_content' ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"std" => 'default',
				"options" => mahogany_get_list_header_footer_types(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'mahogany'),
				"desc" => wp_kses( __("Select custom header from Layouts Builder", 'mahogany'), 'mahogany_kses_content' ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => MAHOGANY_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'mahogany'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"std" => 'default',
				"options" => array(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'mahogany'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'mahogany') ),
				"override" => array(
					'mode' => 'none',
					'section' => esc_html__('Header', 'mahogany')
				),
				"hidden" => true,
				"std" => 0,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'mahogany'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'mahogany') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'mahogany'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'mahogany'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'mahogany') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'mahogany'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'mahogany') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'mahogany'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => mahogany_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'mahogany'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'mahogany') ),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'mahogany'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'mahogany')
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'mahogany'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'mahogany'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'mahogany')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'mahogany'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'mahogany') ),
				"hidden" => true,
				"std" => 1,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'mahogany'),
				"desc" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'mahogany'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'mahogany') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'mahogany')
				),
				"std" => 0,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'mahogany'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'mahogany') ),
				"priority" => 500,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'mahogany'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'mahogany') ),
				"hidden" => true,
				"std" => 1,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'mahogany'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'mahogany') ),
				"std" => '',
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'mahogany'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'mahogany'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'mahogany'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'mahogany'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'mahogany'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'mahogany'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'mahogany'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'mahogany')
				),
				"std" => 'default',
				"options" => mahogany_get_list_header_footer_types(),
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'mahogany'),
				"desc" => wp_kses( __("Select custom footer from Layouts Builder", 'mahogany'), 'mahogany_kses_content' ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'mahogany')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => MAHOGANY_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'mahogany'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'mahogany')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'mahogany'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'mahogany')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => mahogany_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'mahogany'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'mahogany') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'mahogany')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'mahogany'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'mahogany') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'mahogany') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'mahogany') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'mahogany'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'mahogany') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'mahogany'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'mahogany') ),
				"std" => esc_html__('Copyright &copy; {Y} by ThemeREX. All rights reserved.', 'mahogany'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'mahogany'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'mahogany') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'mahogany'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'mahogany') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'mahogany'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'mahogany'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'mahogany'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'mahogany'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'mahogany') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'mahogany'),
						'fullpost'	=> esc_html__('Full post',	'mahogany')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'mahogany'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'mahogany') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 40,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'mahogany'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'mahogany') ),
					"std" => 2,
					"options" => mahogany_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'mahogany'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'mahogany'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'mahogany'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'mahogany'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"std" => "pages",
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'mahogany'),
						'infinite' => esc_html__("Infinite scroll", 'mahogany')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'mahogany'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'mahogany'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'mahogany'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'mahogany') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'mahogany'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'mahogany') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'mahogany'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'mahogany') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'mahogany'),
					"desc" => '',
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'mahogany'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'mahogany') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'mahogany'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'mahogany') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'mahogany'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'mahogany') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'mahogany'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'mahogany') ),
					"std" => 'hide',
					"options" => array(),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'mahogany'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'mahogany'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'mahogany') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'mahogany'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'mahogany') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'mahogany'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'mahogany') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'mahogany'),
						'columns' => esc_html__('Mini-cards',	'mahogany')
					),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'mahogany'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'mahogany') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"std" => "none",
					"options" => array(),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'mahogany'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'mahogany') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'mahogany') ),
					"override" => array(
						'mode' => 'none',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"hidden" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'mahogany'),
						'date'		 => esc_html__('Post date', 'mahogany'),
						'author'	 => esc_html__('Post author', 'mahogany'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'mahogany'),
						'share'		 => esc_html__('Share links', 'mahogany'),
						'edit'		 => esc_html__('Edit link', 'mahogany')
					),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'mahogany'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'mahogany') ),
					"override" => array(
						'mode' => 'none',
						'section' => esc_html__('Content', 'mahogany')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					"dir" => 'vertical',
					"sortable" => true,
					"hidden" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'mahogany'),
						'likes' => esc_html__('Likes', 'mahogany'),
						'comments' => esc_html__('Comments', 'mahogany')
					),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'mahogany'),
					"desc" => wp_kses_data( __('Settings of the single post', 'mahogany') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'mahogany'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'mahogany') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'mahogany')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'mahogany'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'mahogany') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'mahogany'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'mahogany') ),
					"hidden" => true,
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'mahogany'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'mahogany') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"hidden" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'mahogany'),
						'date'		 => esc_html__('Post date', 'mahogany'),
						'author'	 => esc_html__('Post author', 'mahogany'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'mahogany'),
						'share'		 => esc_html__('Share links', 'mahogany'),
						'edit'		 => esc_html__('Edit link', 'mahogany')
					),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'mahogany'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'mahogany') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"hidden" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'mahogany'),
						'likes' => esc_html__('Likes', 'mahogany'),
						'comments' => esc_html__('Comments', 'mahogany')
					),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'mahogany'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'mahogany') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'mahogany'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'mahogany') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'mahogany'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'mahogany'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'mahogany') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'mahogany')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'mahogany'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'mahogany') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => mahogany_get_list_range(1,9),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'mahogany'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page', 'mahogany') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"hidden" => true,
					"options" => mahogany_get_list_range(2,2),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'mahogany'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'mahogany') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"hidden" => true,
					"std" => 2,
					"options" => mahogany_get_list_styles(2,2),
					"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'mahogany'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'mahogany'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'mahogany') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'mahogany'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'mahogany')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'mahogany'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'mahogany')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'mahogany'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'mahogany')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'mahogany'),
				"desc" => '',
				"override" => array(
					'mode' => 'none',
					'section' => esc_html__('Colors', 'mahogany')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"hidden" => true,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'mahogany'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'mahogany')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'mahogany'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'mahogany') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'mahogany'),
				"desc" => '',
				"std" => '$mahogany_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'mahogany'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'mahogany') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'mahogany')
				),
				"hidden" => true,
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'mahogany'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'mahogany') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'mahogany')
				),
				"hidden" => true,
				"std" => '',
				"type" => MAHOGANY_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'mahogany'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'mahogany'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'mahogany') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'mahogany') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'mahogany'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'mahogany') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'mahogany') ),
				"class" => "mahogany_column-1_3 mahogany_new_row",
				"refresh" => false,
				"std" => '$mahogany_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=mahogany_get_theme_setting('max_load_fonts'); $i++) {
			if (mahogany_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'mahogany'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'mahogany'),
				"desc" => '',
				"class" => "mahogany_column-1_3 mahogany_new_row",
				"refresh" => false,
				"std" => '$mahogany_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'mahogany'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'mahogany') )
							: '',
				"class" => "mahogany_column-1_3",
				"refresh" => false,
				"std" => '$mahogany_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'mahogany'),
					'serif' => esc_html__('serif', 'mahogany'),
					'sans-serif' => esc_html__('sans-serif', 'mahogany'),
					'monospace' => esc_html__('monospace', 'mahogany'),
					'cursive' => esc_html__('cursive', 'mahogany'),
					'fantasy' => esc_html__('fantasy', 'mahogany')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'mahogany'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'mahogany') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'mahogany') )
							: '',
				"class" => "mahogany_column-1_3",
				"refresh" => false,
				"std" => '$mahogany_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = mahogany_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'mahogany'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'mahogany'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'mahogany'),
						'100' => esc_html__('100 (Light)', 'mahogany'), 
						'200' => esc_html__('200 (Light)', 'mahogany'), 
						'300' => esc_html__('300 (Thin)',  'mahogany'),
						'400' => esc_html__('400 (Normal)', 'mahogany'),
						'500' => esc_html__('500 (Semibold)', 'mahogany'),
						'600' => esc_html__('600 (Semibold)', 'mahogany'),
						'700' => esc_html__('700 (Bold)', 'mahogany'),
						'800' => esc_html__('800 (Black)', 'mahogany'),
						'900' => esc_html__('900 (Black)', 'mahogany')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'mahogany'),
						'normal' => esc_html__('Normal', 'mahogany'), 
						'italic' => esc_html__('Italic', 'mahogany')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'mahogany'),
						'none' => esc_html__('None', 'mahogany'), 
						'underline' => esc_html__('Underline', 'mahogany'),
						'overline' => esc_html__('Overline', 'mahogany'),
						'line-through' => esc_html__('Line-through', 'mahogany')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'mahogany'),
						'none' => esc_html__('None', 'mahogany'), 
						'uppercase' => esc_html__('Uppercase', 'mahogany'),
						'lowercase' => esc_html__('Lowercase', 'mahogany'),
						'capitalize' => esc_html__('Capitalize', 'mahogany')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "mahogany_column-1_5",
					"refresh" => false,
					"std" => '$mahogany_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		mahogany_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			mahogany_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'mahogany'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'mahogany') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'mahogany')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			mahogany_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'mahogany'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'mahogany') ),
				"class" => "mahogany_column-1_2 mahogany_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('mahogany_options_get_list_cpt_options')) {
	function mahogany_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'mahogany'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'mahogany'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'mahogany') ),
						"std" => 'inherit',
						"options" => mahogany_get_list_header_footer_types(true),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'mahogany'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'mahogany'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'mahogany'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'mahogany'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'mahogany'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'mahogany') ),
						"std" => 0,
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'mahogany'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'mahogany'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'mahogany'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'mahogany'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'mahogany'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'mahogany'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'mahogany'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'mahogany'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'mahogany') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'mahogany'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'mahogany'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'mahogany') ),
						"std" => 'inherit',
						"options" => mahogany_get_list_header_footer_types(true),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'mahogany'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'mahogany') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'mahogany'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'mahogany') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'mahogany'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'mahogany') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => mahogany_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'mahogany'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'mahogany') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'mahogany'),
						"desc" => '',
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'mahogany'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'mahogany') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'mahogany'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'mahogany') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'mahogany'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'mahogany') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'mahogany'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'mahogany') ),
						"std" => 'hide',
						"options" => array(),
						"type" => MAHOGANY_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('mahogany_options_get_list_choises')) {
	add_filter('mahogany_filter_options_get_list_choises', 'mahogany_options_get_list_choises', 10, 2);
	function mahogany_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = mahogany_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = mahogany_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = mahogany_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = mahogany_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = mahogany_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = mahogany_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = mahogany_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = mahogany_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = mahogany_array_merge(array(0 => esc_html__('- Select category -', 'mahogany')), mahogany_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = mahogany_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = mahogany_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = mahogany_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>