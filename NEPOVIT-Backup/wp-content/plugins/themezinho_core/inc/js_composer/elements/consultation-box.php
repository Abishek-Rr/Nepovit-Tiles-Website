<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_consultation_box extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'index'   				=> '',
			'title'   				=> '',
			'subtitle'   				=> '',
			'block_type'   			=> 'normal',
			'has_readmore'   	    => 'yes',
			'readmore_label'   		=> 'SCHEDULE A VISIT',
			'readmore_link'   		=> '#',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		ob_start();

		$wrapper_class = array();

		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = $animation_type;
		}

		$wrapper_class = implode( ' ', $wrapper_class );
		?>
		<div class="consultation-box <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
			
			
		
				
				<?php if( $index ) { ?>
  <b>
  <?php echo wp_kses_post( $index ); ?>
  </b>
  <?php } ?>
			
				<?php if( $title ) { ?>
  <h4>
  <?php echo wp_kses_post( $title ); ?>
  </h4>
  <?php } ?>
				
				<?php if( $subtitle ) { ?>
  <h3>
  <?php echo wp_kses_post( $subtitle ); ?>
  </h3>
  <?php } ?>
				
				
          
         
        
			
			
			
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>

            <?php
            if( $has_readmore == 'yes' ) { ?>
                    <a href="<?php echo esc_url( $readmore_link ); ?>" title="<?php echo esc_attr( $readmore_label ); ?>">
                        <?php echo esc_html( $readmore_label ); ?> <i class="fas fa-caret-right"></i>
                    </a>
             
            <?php
            }
            ?>
		</div>
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_consultation_box",
	"name" 			    => __( 'Consultation Box', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Index', 'themezinho' ),
			"param_name" 	=> 	"index",
			"group" 		=> 'General',
		),array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Subtitle', 'themezinho' ),
			"param_name" 	=> 	"subtitle",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textarea_html",
			"heading" 		=> 	__( 'Text', 'themezinho' ),
			"param_name" 	=> 	"content",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Read More', 'themezinho' ),
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
			"value"         => __( 'SCHEDULE A VISIT', 'themezinho' ),
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Read More Link', 'themezinho' ),
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
