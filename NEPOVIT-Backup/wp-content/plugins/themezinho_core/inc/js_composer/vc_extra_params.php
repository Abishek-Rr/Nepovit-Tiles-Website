<?php
function motts_add_vc_params() {

	// vc_row Attributes
	$vc_row_attrs = array(
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Wrap with Section', 'themezinho' ),
			"param_name" 	=> 	"anchor_wrap_section",
			"description"	=>	__( "If you select <code>Yes</code>, it will wrap the row with container.", "themezinho" ),
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"Yes"			=>		'yes',
				"No"			=>		'no',
			)
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( 'Section Background Parallax', 'themezinho' ),
			"param_name" 	=> "section_ratio",
            "dependency" => array( 'element' => "anchor_wrap_section", 'value' => 'yes'),
			"value"         => "",
			"group" 		=> 'hompark Options',
		),
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Section Background Image', 'themezinho' ),
			"param_name" 	=> 	"section_background_image",
			"dependency" => array( 'element' => "anchor_wrap_section", 'value' => 'yes'),
			"group" 		=> "hompark Options",
		),
		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Section Background Color', 'themezinho' ),
			"param_name" 	=> "section_background_color",
            "dependency" => array( 'element' => "anchor_wrap_section", 'value' => 'yes'),
			"value"         => "",
			"group" 		=> 'hompark Options',
		),

		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Add Theme Default Padding', 'themezinho' ),
			"param_name" 	=> 	"motts_theme_padding",
			"group" 		=> 'hompark Options',
            "dependency" => array( 'element' => "anchor_wrap_section", 'value' => 'yes'),
			"value"			=>	array(
				"Yes"			=>		'yes',
				"No"   	=>		'no',
			)
		),

		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Video Background', 'themezinho' ),
			"param_name" 	=> 	"has_video_background",
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"No"			=>		'no',
				"Video"   	=>		'youtube',
//				"Hosted"		=>		'hosted',
			)
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Video URL', 'themezinho' ),
			"param_name" 	=> 	"video_youtube_link",
			"dependency"    => array('element' => "has_video_background", 'value' => 'youtube'),
			"group" 		=> 'hompark Options',
		),

		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Wrap with Container', 'themezinho' ),
			"param_name" 	=> 	"use_container",
			"description"	=>	__( "If you select <code>Yes</code>, it will wrap the row with container.", "themezinho" ),
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Center Content', 'themezinho' ),
			"param_name" 	=> 	"conter_content",
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),

		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Is Predefined Section', 'themezinho' ),
			"param_name" 	=> 	"use_predefined_class",
			"description"	=>	__( "If you select <code>Yes</code>, it overrides the element's default <code>class</code> field.</code>", "themezinho" ),
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Predefined Section', 'themezinho' ),
			"param_name" 	=> 	"predefined_class",
			"dependency" => array( 'element' => "use_predefined_class", 'value' => 'yes'),
			"description"	=>	__( "Please check documentation for more detail.", "themezinho" ),
			"group" 		=> 'hompark Options',
			"value"			=>	array(
				"None"          => "none",
				"Clients"        => "clients",
				"Contact"        => "contact",
			)
		),

	);

	vc_add_params( 'vc_row', $vc_row_attrs );

	$vc_inner_rows_attrs = array(
        array(
            "type" 			=> 	"dropdown",
            "heading" 		=> 	__( 'Wrap with Container', 'themezinho' ),
            "param_name" 	=> 	"wrap_container",
            "description"	=>	__( "If you select <code>Yes</code>, it will wrap this element with container.", "themezinho" ),
            "group" 		=> 'hompark Options',
            "value"			=>	array(
                "No"			=>		'no',
                "Yes"			=>		'yes',
            )
        ),
    );

    vc_add_params( 'vc_row_inner', $vc_inner_rows_attrs );
}

add_action( 'vc_before_init', 'motts_add_vc_params' );