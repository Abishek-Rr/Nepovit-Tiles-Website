<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_info_counter extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'value' 			    => '',
			'char' 			    => '',
			'title' 				=> '',
			'animate_block'			=> 'false',
		), $atts ) );
		
		ob_start();

		$wrapper_class = array();
		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = 'fadeIn';
		}
		$wrapper_class = implode( ' ', $wrapper_class );
		?>

	  	<div class="info-counter">
		   
 			
          
			
			
			
			<?php if( $value != '' ) { ?>
          		<span class="odometer" data-count="<?php echo esc_attr( $value ); ?>" data-status="yes">0</span>
 	 		<?php } ?>
			<?php if( $char != '' ) { ?>
			<span class="char"><?php echo esc_html( $char ); ?></span>
			<?php } ?>
			
			<?php if( $title != '' ) { ?>
			
			<h6><?php echo esc_html( $title ); ?></h6>
		 <?php } ?>
			
		</div>

		
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_info_counter",
	"name" 			    => __( 'Icon Counter', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Value', 'themezinho' ),
			"param_name" 	=> 	"value",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Character', 'themezinho' ),
			"param_name" 	=> 	"char",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animate', 'themezinho' ),
			"param_name" 	=> 	"animate_block",
			"group" 		=> 'Animation',
			"value"			=>	array(
				"No"			=>		'no',
				"Yes"			=>		'yes',
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Animation Type', 'themezinho' ),
			"param_name" 	=> 	"animation_type",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"group" 		=> 'Animation',
			"value"			=>	motts_animations()
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Animation Delay', 'themezinho' ),
			"param_name" 	=> 	"animation_delay",
			"dependency" => array('element' => "animate_block", 'value' => 'yes'),
			"description"	=>	__( 'Animation delay set in second e.g. 0.6s', 'themezinho' ),
			"group" 		=> 'Animation',
		)
	),
) );
