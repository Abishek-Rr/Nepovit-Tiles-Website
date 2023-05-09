<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_ts_section_title extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
		'color' => '',
		'align' => '',
      'index' => '',
      'title' => '',
		'sub_title' => '',
		'tagline' => '',
      'animate_block' => 'false',
      'animation_type' => 'fadeIn',
      'animation_delay' => '',
    ), $atts ) );

    ob_start();

    $wrapper_class = array();

    if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );
    ?>
<div class="section-titles <?php if( $color == 'light' )  { ?>   light <?php
            }
            ?>
			<?php if( $align == 'center' )  { ?>   center <?php
            }
            ?>
			
			
			 <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
	
	<?php if( $index ) { ?>
  <b>
  <?php echo wp_kses_post( $index ); ?>
  </b>
  <?php } ?>
	
	
  
  <?php if( $title ) { ?>
  <h2><?php echo wpb_js_remove_wpautop( $title ); ?></h2>
  <?php } ?>
	
<?php if( $sub_title ) { ?>
  <h3>
  <?php echo wp_kses_post( $sub_title ); ?>
  </h3>
  <?php } ?>
	
	
	<?php if( $tagline ) { ?>
  <small>
  <?php echo wp_kses_post( $tagline ); ?>
  </small>
  <?php } ?>
	
	
</div>
<?php

return ob_get_clean();
}
}


vc_map( array(
  "base" => "ts_section_title",
  "name" => __( 'Section Title Block', 'themezinho' ),
  "icon" => THEMEZINHO_CORE_URI . "assets/img/custom.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
	  array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Title Color', 'themezinho' ),
			"param_name" 	=> 	"color",
			"group" 		=> 'General',
			"value"			=>	array(
				"Dark"		=> 'dark',
				"Light"		=> 'light',
			)
		),
	  array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Title Position', 'themezinho' ),
			"param_name" 	=> 	"align",
			"group" 		=> 'General',
			"value"			=>	array(
				"Left"		=> 'left',
				"Centered"		=> 'center',
			)
		),
	   array(
      "type" => "textfield",
      "heading" => __( 'Index', 'themezinho' ),
      "param_name" => "index",
      "group" => 'General',
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Title', 'themezinho' ),
      "param_name" => "title",
      "group" => 'General',
      "description" => 'If you wanna use colored words use inside span tag',
    ),
	  array(
      "type" => "textfield",
      "heading" => __( 'Sub Title', 'themezinho' ),
      "param_name" => "sub_title",
      "group" => 'General',
    ),
	 array(
      "type" => "textfield",
      "heading" => __( 'Tagline', 'themezinho' ),
      "param_name" => "tagline",
      "group" => 'General',
    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Animate', 'themezinho' ),
      "param_name" => "animate_block",
      "group" => 'Animation',
      "value" => array(
        "No" => 'no',
        "Yes" => 'yes',
      )
    ),
    array(
      "type" => "dropdown",
      "heading" => __( 'Animation Type', 'themezinho' ),
      "param_name" => "animation_type",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "group" => 'Animation',
      "value" => motts_animations()
    ),
    array(
      "type" => "textfield",
      "heading" => __( 'Animation Delay', 'themezinho' ),
      "param_name" => "animation_delay",
      "dependency" => array( 'element' => "animate_block", 'value' => 'yes' ),
      "description" => __( 'Animation delay set in second e.g. 0.6s', 'themezinho' ),
      "group" => 'Animation',
    )
  ),
) );
