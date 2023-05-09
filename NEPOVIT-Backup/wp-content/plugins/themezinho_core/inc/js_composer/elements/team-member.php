<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_team_members extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'member'			        => '',
			'member_name' 			    => '',
			'social_link1' 			    => '#',
			'social_link2' 			    => '#',
			'social_link3' 			    => '#',
			'social_media1' 			    => '',
			'social_media2' 			    => '',
			'social_media3' 			    => '',
			'value' 			    => '',
			'title' 				=> '',
			'animate_block'			=> 'false',
		), $atts ) );
		$member_url = '';
		if ( $member != '') {
			$member_url = wp_get_attachment_url( $member );
		}
		ob_start();

		$wrapper_class = array();
		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = 'fadeIn';
		}
		$wrapper_class = implode( ' ', $wrapper_class );
		?>

<figure class="team">
	
	<?php if ($member_url != '') { ?>
				
				
		   		<img src="<?php echo esc_url($member_url); ?>" alt="<?php echo esc_attr($title); ?>">
			
				
		   	<?php } ?>
	
          <figcaption>
			  
			  <?php if( $member_name != '' ) { ?>
          		<h5><?php echo esc_attr( $member_name ); ?></h5>
 	 		<?php } ?>
			  
			  
			  <?php if( $title != '' ) { ?>
			
			<small><?php echo esc_html( $title ); ?></small>
		 <?php } ?>
			  
          <?php if( $social_media1 != '' ) { ?>
			  <ul>
				   
			  <li><a href="<?php echo esc_attr( $social_link1 ); ?>"><?php echo esc_attr( $social_media1 ); ?></a></li>
			  <li><a href="<?php echo esc_attr( $social_link2 ); ?>"><?php echo esc_attr( $social_media2 ); ?></a></li>
			  <li><a href="<?php echo esc_attr( $social_link3 ); ?>"><?php echo esc_attr( $social_media3 ); ?></a></li>
				 
			  </ul>
			   <?php } ?>
          </figcaption>
        </figure>



	  	

		
		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_team_members",
	"name" 			    => __( 'Team Member', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Member Name', 'themezinho' ),
			"param_name" 	=> 	"member_name",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Job Title', 'themezinho' ),
			"param_name" 	=> 	"title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Member', 'themezinho' ),
			"param_name" 	=> 	"member",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Link 01", "themezinho" ),
			"param_name" 	=> "social_link1",
			"group" 		=> "Social 01",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Media 01", "themezinho" ),
			"param_name" 	=> "social_media1",
			"group" 		=> "Social 01",
		),
		
		
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Link 02", "themezinho" ),
			"param_name" 	=> "social_link2",
			"group" 		=> "Social 02",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Media 02", "themezinho" ),
			"param_name" 	=> "social_media2",
			"group" 		=> "Social 02",
		),
		
		
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Link 03", "themezinho" ),
			"param_name" 	=> "social_link3",
			"group" 		=> "Social 03",
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( "Social Media 03", "themezinho" ),
			"param_name" 	=> "social_media3",
			"group" 		=> "Social 03",
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
