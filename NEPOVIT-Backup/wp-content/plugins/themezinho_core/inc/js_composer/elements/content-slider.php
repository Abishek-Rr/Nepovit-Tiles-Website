<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_image_slider extends WPBakeryShortCode {


	
	
	
	
	 protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
        'next' => '',
        'prev' => '',
        'details' => '',
        'image' => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
        ), $atts ) );

        
        ob_start();
	
		 $wrapper_class = array();
		if ( $animate_block == 'yes' ) {
      $wrapper_class[] = 'wow';
      $wrapper_class[] = $animation_type;
    }

    $wrapper_class = implode( ' ', $wrapper_class );
		
	
	
    $images = wp_get_attachment_image_src($image,''); 
    $details = vc_param_group_parse_atts($atts['details']);
    ?> 



    
      <div class="content-slider <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
        <div class="swiper-wrapper">
          <?php $new_accordion_value = array();
      foreach($details as $data){
        $new_line = $data;
        $new_line['image'] = isset($new_line['image']) ? $new_line['image'] : '';
        $new_line['video'] = isset($new_line['video']) ? $new_line['video'] : '';
        $new_line['title'] = isset($new_line['title']) ? $new_line['title'] : '';
        $new_line['description'] = isset($new_line['description']) ? $new_line['description'] : '';
        $new_line['link'] = isset($new_line['link']) ? $new_line['link'] : '';
        $new_line['link_url'] = isset($new_line['link_url']) ? $new_line['link_url'] : '';
     
        $new_accordion_value[] = $new_line;
     
      }
     
      $idd = 0;
      foreach($new_accordion_value as $accordion):
      $idd++;
    $images = wp_get_attachment_image_src($accordion['image'],'');
                ?>
          <?php if($accordion['image']){ ?>
          <div class="swiper-slide" data-background="<?php echo esc_url($images[0]);?>">
			 <?php if($accordion['video']) { ?>
            <video src="<?php echo esc_url($accordion['video']); ?>" muted autoplay loop></video>
			  <?php } ?>
			 <div class="slide-inner">
				 <?php if($accordion['title']) { ?>
			    <h6><?php echo esc_attr($accordion['title']);?></h6> 
				 <?php } ?>
				  <?php if($accordion['description']) { ?>
			    <p><?php echo esc_attr($accordion['description']);?></p> 
				 <?php } ?>
				 <?php if($accordion['link']) { ?>
			  <a href="<?php echo esc_url($accordion['link_url']); ?>"><?php echo esc_attr($accordion['link']);?></a>
				 <?php } ?>
				    </div>
			  <!-- end slide-inner -->
			</div>
          
        <?php } ?>
          <?php endforeach;
                  wp_reset_query(); ?>
        </div>
        <!-- end swiper-wrapper -->
        <div class="swiper-button-prev"><?php echo esc_attr($prev);?></div>
        <!-- end button-prev -->
        <div class="swiper-button-next"><?php echo esc_attr($next);?></div>
        <!-- end button-next --> 
		   <div class="swiper-pagination"></div>
		  <!-- end swiper-pagination -->
      </div>
      <!-- end content-slider -->
    








<?php  return ob_get_clean();
} 
	}
	


vc_map( array(
	"base" 			    => "ts_image_slider",
	"name" 			    => __( 'Content Slider', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		
             array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Next", 'themezinho'),
                "param_name" => "next",
                "value" => "",
                "description" => __("Text next", 'themezinho')
             ),
             array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Prev", 'themezinho'),
                "param_name" => "prev",
                "value" => "",
                "description" => __("Text Prev", 'themezinho')
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
		),
   array(
      'type' => 'param_group',
      'param_name' => 'details',
      'heading' => __('Item Slider', 'themezinho'),
      'params' => array(
            array(
                  'type' => 'attach_image',
                  'heading' => __( 'Image background', 'themezinho' ),
                  'param_name' => 'image',
                  'value' => '',
                  'description' => __( 'Even for using video bg at least add transparent image here ! Otherwise you can use here for adding background image', 'themezinho' )
               ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Video BG URL", 'themezinho'),
               "param_name" => "video",
               "value" => "",
               "description" => __("First upload to media library and copy url of video", 'themezinho')
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Title", 'themezinho'),
               "param_name" => "title",
               "value" => ""
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Description", 'themezinho'),
               "param_name" => "description",
               "value" => ""
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Link Label", 'themezinho'),
               "param_name" => "link",
               "value" => ""
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Link URL", 'themezinho'),
               "param_name" => "link_url",
               "value" => ""
            ),
	  	)
	   
		
	   
	),
)));
