<?php
if ( !defined( 'ABSPATH' ) ) {
  die( '-1' );
}

class WPBakeryShortCode_ts_hero_slider extends WPBakeryShortCode {

  protected function content( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'hero_slider' => 0,
    ), $atts ) );

    //		 if( !is_int( $hero_slider ) ) {
    //		 	return;
    //		 }
    ob_start();
    $args = array(
      'post_type' => 'hero',
      'post__in' => array( $hero_slider )
    );


    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ):
      while ( $the_query->have_posts() ):
        $the_query->the_post();

    $hero_type = get_field( 'type' );
    $disable_social_icon = ( get_field( 'disable_social_icon' ) ) ? true : false;


    if ( $hero_type === 'swiper' ):

      if ( have_rows( 'slider' ) ):


        $slides = count( get_field( 'slider' ) );

    if ( $slides < 2 ) {
      $loop = 'disable';
    }

    ?>
<header class="slider">
  <div class="slider-container"
                                 data-speed="<?php echo esc_attr( $transition_speed ); ?>"
                                 data-autoplay-delay="<?php echo esc_attr( $auto_play_delay ); ?>"
                                 data-loop="<?php echo esc_attr( $loop ); ?>"
                                >
    <div class="swiper-wrapper">
      <?php
      while ( have_rows( 'slider' ) ): the_row();
      $background_image = get_sub_field( 'background_image' );
      $slide_icon = get_sub_field( 'slide_icon' );
      ?>
      <div class="swiper-slide" data-background="<?php echo esc_url( $background_image ); ?>" data-stellar-background-ratio="1.15">
        <div class="container">
          <h1>
            <?php the_sub_field( 'title' ); ?>
          </h1>
          <h2>
            <?php the_sub_field( 'sub_title' ); ?>
          </h2>
          <?php
          if ( $button_link = get_sub_field( 'button_link' ) ) {
            $button_label = get_sub_field( 'button_label' );
            ?>
          <a href="<?php echo esc_url( $button_link ); ?>" title="<?php echo esc_attr( $button_label ); ?>"> <?php echo esc_html( $button_label ); ?><i class="fas fa-caret-right"></i> </a>
          <?php } ?>
          <figure><img src="<?php echo esc_url( $slide_icon ); ?>" alt="<?php the_sub_field( 'title' ); ?>"></figure>
        </div>
        <!-- end container --> 
      </div>
      <!-- end swiper-slide -->
      
      <?php
      endwhile;
      ?>
    </div>
    <!-- end swiper-wrapper -->
    
    <div class="inner-elements">
      <div class="container">
        <?php if( $page_number ) { ?>
        <div class="pagination"></div>
        <?php } ?>
        <?php
        if ( $navigation ) {
          $prev_label = get_field( 'navigation_previous_label' ) ? get_field( 'navigation_previous_label' ) : __( 'PREV', 'hompark' );
          $next_label = get_field( 'navigation_next_label' ) ? get_field( 'navigation_next_label' ) : __( 'PREV', 'hompark' );
          ?>
        <div class="button-prev" data-text="<?php echo esc_html( $prev_label ); ?>"><?php echo esc_html( $prev_label ); ?></div>
        <!-- end button-prev -->
        <div class="button-next" data-text="<?php echo esc_html( $next_label ); ?>"><?php echo esc_html( $next_label ); ?></div>
        <!-- end button-next -->
        
        <?php } ?>
        <div class="social-media">
          <h6>
            <?php
            $social_media_label = hompark_get_option( 'social_media_label' );
            echo esc_html( $social_media_label );
            ?>
          </h6>
          <?php
          if ( !$disable_social_icon ):
            $social_media = hompark_get_option( 'social_media' );
          if ( $social_media ):
            ?>
          <ul>
            <?php foreach ( $social_media as $social ) { ?>
            <li> <a
                                                                    href="<?php echo esc_url( $social['url'] ); ?>"
                                                                    target="_blank"
                                                                    rel="noreferrer"> <i class="<?php echo esc_attr( $social['title'] ); ?>"></i> </a> </li>
            <?php } ?>
          </ul>
          <?php endif; ?>
          <?php endif; ?>
        </div>
        <!-- end social-media --> 
      </div>
      <!-- end container --> 
    </div>
    <!-- end inner-elements --> 
    
  </div>
  <!-- end swiper-container --> 
  
</header>
<?php
endif;

elseif ( $hero_type === 'video' ):
  ?>
<header class="video-header">
  <div class="video-bg">
    <video src="<?php echo esc_url( get_field( 'background_video' ) ); ?>" muted loop autoplay playsinline></video>
  </div>
  <!-- end video-bg -->
  <div class="container">
    <h1>
      <?php the_field( 'video_bg_title' ); ?>
    </h1>
    <?php if( get_field( 'video_bg_tagline' ) ) { ?>
    <h2>
      <?php the_field( 'video_bg_tagline' ); ?>
    </h2>
    <?php } ?>
    <?php if( get_field( 'video_bg_button_link' ) ){ ?>
    <a href="<?php echo esc_url( get_field( 'video_bg_button_link' ) ); ?>" title="<?php echo esc_attr( get_field( 'video_bg_button_label' ) ); ?>" class="link"> <?php echo esc_html( get_field( 'video_bg_button_label' ) ); ?> </a>
    <?php } ?>
    <div class="social-media">
      <h6>SOCIAL MEDIA</h6>
      <?php
      if ( !$disable_social_icon ):
        $social_media = hompark_get_option( 'social_media' );
      if ( $social_media ):
        ?>
      <ul>
        <?php foreach ( $social_media as $social ) { ?>
        <li> <a
                                                                    href="<?php echo esc_url( $social['url'] ); ?>"
                                                                    target="_blank"
                                                                    rel="noreferrer"> <i class="<?php echo esc_attr( $social['title'] ); ?>"></i> </a> </li>
        <?php } ?>
      </ul>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</header>
<?php

endif;

endwhile;
endif;

return ob_get_clean();
}
}

vc_map( array(
  "base" => "ts_hero_slider",
  "name" => __( 'Hero Slider', 'ts' ),
  "icon" => THEMEZINHO_CORE_URI . "assets/img/custom.png",
  "content_element" => true,
  "category" => PAGE_BUILDER_GROUP,
  'params' => array(
    array(
      "type" => "dropdown",
      "heading" => __( 'Hero Slider', 'ts' ),
      "param_name" => "hero_slider",
      "group" => "General",
      "description" => __( 'Select the slider that you created in Hero Slider section. Check documentation for further detail.', 'ts' ),
      "value" => ts_get_hero_slider()
    )
  ),
) );
