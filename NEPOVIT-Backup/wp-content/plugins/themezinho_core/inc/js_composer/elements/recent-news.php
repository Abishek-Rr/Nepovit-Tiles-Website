<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class WPBakeryShortCode_ts_recent_news extends WPBakeryShortCode {

    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array(
            'animate_block'			=> 'false',
            'animation_type'		=> 'fadeIn',
            'animation_delay'       => ''
        ), $atts ) );

        
        ob_start();

        

        $wrapper_class = array();
        if( $animate_block == 'yes' ) {
            $wrapper_class[] = 'wow';
            $wrapper_class[] = $animation_type;
        }

        $wrapper_class = implode( ' ', $wrapper_class );

            ?>
           
            



<div class="row">
	
	

	
	
    <?php
		
		
		
		$post_content = the_excerpt();
		
		
    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 3, // Number of recent posts thumbnails to display
        'post_status' => 'publish' // Show only the published posts
    ));
    foreach($recent_posts as $post) : ?>
        <div class="col-lg-4 col-md-6">
			<div class="recent-news <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>
				<figure>
					<?php echo get_the_post_thumbnail($post['ID'], 'full'); ?>
					
					</figure>
						
						<span><?php the_time(get_option( 'date_format' ));?></span>
              <h6><a href="<?php echo get_permalink($post['ID']) ?>"><?php echo $post['post_title'] ?></a></h6>
				
				
				

				<?php 
		 //echo wp_kses_post( $post['post_content'] );
		 ?>
			
				
				
				
					
					
				
            
			</div>
        </div>
    <?php endforeach; wp_reset_query(); ?>
</div>






        <?php
     

        wp_reset_query();
        return ob_get_clean();
    }
}


vc_map( array(
    "base" 			    => "ts_recent_news",
    "name" 			    => __( "Recent News", "themezinho" ),
    "icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
    "content_element"   => true,
    "category" 		    => PAGE_BUILDER_GROUP,
    'params' => array(
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
