<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_tab_content extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'image1'			        => '',
			'title1'		            => '',
			'image2'			        => '',
			'title2'		            => '',
			'image3'			        => '',
			'title3'		            => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		ob_start();

        $image_url1 = '';
        if ( $image1 != '') {
            $image_url1 = wp_get_attachment_url( $image1 );
        }

        if( !$image_url1 ) return;
		
		$image_url2 = '';
        if ( $image2 != '') {
            $image_url2 = wp_get_attachment_url( $image2 );
        }

        if( !$image_url2 ) return;
		
		$image_url3 = '';
        if ( $image3 != '') {
            $image_url3 = wp_get_attachment_url( $image3 );
        }

        if( !$image_url3 ) return;

		$wrapper_class = '';
		if( $animate_block == 'yes' ) {
			$wrapper_class = 'wow ' . $animation_type;
		}
		?>


<div class="tab-content <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
	
 <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item"> <a class="nav-link active" data-toggle="pill" href="#tab-one"><?php echo esc_html( $title1 ); ?></a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" href="#tab-two" role="tab"><?php echo esc_html( $title2 ); ?></a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="pill" href="#tab-three" role="tab"><?php echo esc_html( $title3 ); ?></a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tab-one">
            <figure><img src="<?php echo esc_url( $image_url1 ); ?>" alt="<?php echo esc_attr( get_the_title( $title1 ) ); ?>"></figure>
          </div>
          <!-- end tab-pane -->
          <div class="tab-pane fade" id="tab-two">
            <figure><img src="<?php echo esc_url( $image_url2 ); ?>" alt="<?php echo esc_attr( get_the_title( $title2 ) ); ?>"></figure>
          </div>
          <!-- end tab-pane -->
          <div class="tab-pane fade" id="tab-three">
             <figure><img src="<?php echo esc_url( $image_url3 ); ?>" alt="<?php echo esc_attr( get_the_title( $title3 ) ); ?>"></figure>
          </div>
          <!-- end tab-pane --> 
        </div>
        <!-- end tab-contnet --> 




          
           
			
       
	</div>
                
           
     
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_tab_content",
	"name" 			    => __( 'Tab Content', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title 01', 'themezinho' ),
			"param_name" 	=> 	"title1",
			"group" 		=> 'Tab 01',
		),
        array(
            "type" 			=> 	"attach_image",
            "heading" 		=> 	__( 'Image 01', 'themezinho' ),
            "param_name" 	=> 	"image1",
            "group" 		=> "Tab 01",
        ),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title 02', 'themezinho' ),
			"param_name" 	=> 	"title2",
			"group" 		=> 'Tab 02',
		),
        array(
            "type" 			=> 	"attach_image",
            "heading" 		=> 	__( 'Image 02', 'themezinho' ),
            "param_name" 	=> 	"image2",
            "group" 		=> "Tab 02",
        ),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Title 03', 'themezinho' ),
			"param_name" 	=> 	"title3",
			"group" 		=> 'Tab 03',
		),
        array(
            "type" 			=> 	"attach_image",
            "heading" 		=> 	__( 'Image 03', 'themezinho' ),
            "param_name" 	=> 	"image3",
            "group" 		=> "Tab 03",
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
