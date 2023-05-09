<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_side_content_left extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'		            => '',
			'text'			    => '',
			'has_readmore'   	    => 'no',
			'readmore_label'   		=> 'SEE ALL CASES',
			'readmore_link'   		=> '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		ob_start();

        

		$wrapper_class = '';
		if( $animate_block == 'yes' ) {
			$wrapper_class = 'wow ' . $animation_type;
		}
		?>
        <div class="left-side-content <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
			
			
			
			<div class="inner">
				
				
				
				
            <?php if( $title != '' ) { ?>
			
			<h4><?php echo esc_html( $title ); ?></h4>
		 <?php } ?>
				
				
			
				<?php echo wpb_js_remove_wpautop( $text, true ); ?>
				
				
				<?php
            if( $has_readmore == 'yes' ) { ?>
         
                    <a class="custom-btn <?php echo esc_attr( $wrapper_class ); ?>" href="<?php echo esc_url( $readmore_link ); ?>" title="<?php echo esc_attr( $readmore_label ); ?>">
						<svg>
              <rect width="218" height="56" x="1" y="1" rx="0" fill="none" stroke="#ffffff"></rect>
            </svg>
						<span><?php echo esc_html( $readmore_label ); ?></span>
                        
                    </a>
            <?php
            }
            ?>
				
				
            
				
          
			
			</div>
			
			
        </div>
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_side_content_left",
	"name" 			    => __( 'Side Content Left', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textarea_html",
			"heading" 		=> 	__( 'Text', 'themezinho' ),
			"param_name" 	=> 	"text",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Custom Link', 'themezinho' ),
			"param_name" 	=> 	"has_readmore",
			"group" 		=> 'General',
			"value"			=>	array(
				"No"		=> 'no',
				"Yes"		=> 'yes',
			)
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Read More Label', 'themezinho' ),
			"param_name" 	=> 	"readmore_label",
			"dependency"    => array('element' => "has_readmore", 'value' => 'yes'),
			"value"         => __( 'SEE MORE CASES', 'themezinho' ),
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Custom Link URL', 'themezinho' ),
			"param_name" 	=> 	"readmore_link",
			"dependency"    => array('element' => "has_readmore", 'value' => 'yes'),
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
