<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_ts_sales_team extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'image'		            => '',
			'full_name'   			    => '',
			'job_title' 			=> '',
			'social_one_label'   			    => '',
			'social_one_icon'   			    => '',
			'social_one_link'   			    => '',
			'social_two_label'   			    => '',
			'social_two_icon'   			    => '',
			'social_two_link'   			    => '',
			'animate_block'			=> 'false',
			'animation_type'		=> 'fadeIn',
			'animation_delay'		=> '',
		), $atts ) );

		$wrapper_class = array();

		$image_url = '';
		if ( $image != '') {
			$image_url = wp_get_attachment_url( $image );
		}

		if( !$image_url ) return;

		if( $animate_block == 'yes' ) {
			$wrapper_class[] = 'wow';
			$wrapper_class[] = $animation_type;
		}

		$wrapper_class = implode( ' ', $wrapper_class );

		ob_start();
		?>
       
            <figure class="sales-team <?php echo esc_attr( $wrapper_class ); ?>" <?php if( $animate_block == 'yes' && $animation_delay != '' ) { echo 'data-wow-delay="' . esc_attr( $animation_delay ) . '"'; } ?>>

               
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $full_name ); ?>">
				
				<figcaption>
               	<?php if( $full_name ) { ?>
				<h4><?php echo wpb_js_remove_wpautop( $full_name ); ?></h4>
				 <?php } ?>
               
				
				<?php if( $job_title ) { ?>
				<small><?php echo esc_html( $job_title ); ?></small>
				 <?php } ?>
					
					<ul>
					<?php if( $social_one_label ) { ?>
				<li><a href="<?php echo esc_url( $social_one_link ); ?>"><i class="<?php echo esc_attr( $social_one_icon ); ?>"></i><?php echo esc_html( $social_one_label ); ?></a></li>
				 <?php } ?>
						
						<?php if( $social_two_label ) { ?>
				<li><a href="<?php echo esc_url( $social_two_link ); ?>"><i class="<?php echo esc_attr( $social_two_icon ); ?>"></i><?php echo esc_html( $social_two_label ); ?></a></li>
				 <?php } ?>
						
					</ul>
					
				</figcaption>
				
            </figure>
       

		<?php

		return ob_get_clean();
	}
}


vc_map( array(
	"base" 			    => "ts_sales_team",
	"name" 			    => __( 'Sales Team', 'themezinho' ),
	"icon"              => THEMEZINHO_CORE_URI . "assets/img/custom.png",
	"content_element"   => true,
	"category" 		    => PAGE_BUILDER_GROUP,
	'params' => array(
		array(
			"type" 			=> 	"attach_image",
			"heading" 		=> 	__( 'Member Image', 'themezinho' ),
			"param_name" 	=> 	"image",
			"group" 		=> "General",
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Full Name', 'themezinho' ),
			"param_name" 	=> 	"full_name",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Job Title', 'themezinho' ),
			"param_name" 	=> 	"job_title",
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Label', 'themezinho' ),
			"param_name" 	=> 	"social_one_label",
			"group" 		=> 'Social 01',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Icon', 'themezinho' ),
			"param_name" 	=> 	"social_one_icon",
			"group" 		=> 'Social 01',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Link', 'themezinho' ),
			"param_name" 	=> 	"social_one_link",
			"group" 		=> 'Social 01',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Label', 'themezinho' ),
			"param_name" 	=> 	"social_two_label",
			"group" 		=> 'Social 02',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Icon', 'themezinho' ),
			"param_name" 	=> 	"social_two_icon",
			"group" 		=> 'Social 02',
		),
		array(
			"type" 			=> 	"textfield",
			"heading" 		=> 	__( 'Social Link', 'themezinho' ),
			"param_name" 	=> 	"social_two_link",
			"group" 		=> 'Social 02',
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
