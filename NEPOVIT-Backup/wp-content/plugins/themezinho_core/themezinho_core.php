<?php
/*
Plugin Name: Themezinho Core
Plugin URI: https://themezinho.net
Description: Themezinho Core
Author: THEMEZINHO
Version: 1.1.1
Author URI: https://themezinho.net
*/

define( "THEMEZINHO_CORE_PATH", plugin_dir_path( __FILE__ ) );
define( "THEMEZINHO_CORE_URI", plugins_url( 'themezinho_core/' ) );
define( "PAGE_BUILDER_GROUP", __( 'hompark', 'themezinho' ) );

add_action( 'vc_before_init', 'themezinho_vc_addons' );
/**
 * JS Composer Elements
 */

function themezinho_vc_addons() {
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/sales-team.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-support-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/faq.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/press-release.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/sales-office.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/video-content.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/about-text-content.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/info-counter.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/facilities-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-text-left.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/tab-content.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/gallery-thumb.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/consultation-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/icon-box.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/certificates.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/icon-counter.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-image-right.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/side-image-left.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/content-slider.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/contact-block.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/client.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/google-map.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/header.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/image.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/portfolio.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/section-title.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/text-content-block.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/recent-news.php';
  require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/elements/portfolio-text-content.php';
}

require_once THEMEZINHO_CORE_PATH . '/inc/js_composer/vc_extra_params.php';

/**
 * Include advanced custom field
 */
// 1. customize ACF path
add_filter( 'acf/settings/path', 'themezinho_acf_settings_path' );

function themezinho_acf_settings_path( $path ) {
  $path = THEMEZINHO_CORE_PATH . '/inc/acf/';

  return $path;
}


// 2. customize ACF dir
add_filter( 'acf/settings/dir', 'themezinho_acf_settings_dir' );

function themezinho_acf_settings_dir( $dir ) {
  $dir = THEMEZINHO_CORE_URI . '/inc/acf/';

  return $dir;
}

//Hide ACF field group menu item
add_filter( 'acf/settings/show_admin', '__return_false' );
require THEMEZINHO_CORE_PATH . '/inc/acf/acf.php';

require_once THEMEZINHO_CORE_PATH . '/inc/theme-options.php';

require_once THEMEZINHO_CORE_PATH . '/inc/cpt-taxonomy.php';


function motts_animations() {

  return array(
    'bounce' => 'bounce',
    'flash' => 'flash',
    'pulse' => 'pulse',
    'rubberBand' => 'rubberBand',
    'shake' => 'shake',
    'headShake' => 'headShake',
    'swing' => 'swing',
    'tada' => 'tada',
    'wobble' => 'wobble',
    'jello' => 'jello',
    'bounceIn' => 'bounceIn',
    'bounceInDown' => 'bounceInDown',
    'bounceInLeft' => 'bounceInLeft',
    'bounceInRight' => 'bounceInRight',
    'bounceInUp' => 'bounceInUp',
    'bounceOut' => 'bounceOut',
    'bounceOutDown' => 'bounceOutDown',
    'bounceOutLeft' => 'bounceOutLeft',
    'bounceOutRight' => 'bounceOutRight',
    'bounceOutUp' => 'bounceOutUp',
    'fadeIn' => 'fadeIn',
    'fadeInDown' => 'fadeInDown',
    'fadeInDownBig' => 'fadeInDownBig',
    'fadeInLeft' => 'fadeInLeft',
    'fadeInLeftBig' => 'fadeInLeftBig',
    'fadeInRight' => 'fadeInRight',
    'fadeInRightBig' => 'fadeInRightBig',
    'fadeInUp' => 'fadeInUp',
    'fadeInUpBig' => 'fadeInUpBig',
    'fadeOut' => 'fadeOut',
    'fadeOutDown' => 'fadeOutDown',
    'fadeOutDownBig' => 'fadeOutDownBig',
    'fadeOutLeft' => 'fadeOutLeft',
    'fadeOutLeftBig' => 'fadeOutLeftBig',
    'fadeOutRight' => 'fadeOutRight',
    'fadeOutRightBig' => 'fadeOutRightBig',
    'fadeOutUp' => 'fadeOutUp',
    'fadeOutUpBig' => 'fadeOutUpBig',
    'flipInX' => 'flipInX',
    'flipInY' => 'flipInY',
    'flipOutX' => 'flipOutX',
    'flipOutY' => 'flipOutY',
    'lightSpeedIn' => 'lightSpeedIn',
    'lightSpeedOut' => 'lightSpeedOut',
    'rotateIn' => 'rotateIn',
    'rotateInDownLeft' => 'rotateInDownLeft',
    'rotateInDownRight' => 'rotateInDownRight',
    'rotateInUpLeft' => 'rotateInUpLeft',
    'rotateInUpRight' => 'rotateInUpRight',
    'rotateOut' => 'rotateOut',
    'rotateOutDownLeft' => 'rotateOutDownLeft',
    'rotateOutDownRight' => 'rotateOutDownRight',
    'rotateOutUpLeft' => 'rotateOutUpLeft',
    'rotateOutUpRight' => 'rotateOutUpRight',
    'hinge' => 'hinge',
    'jackInTheBox' => 'jackInTheBox',
    'rollIn' => 'rollIn',
    'rollOut' => 'rollOut',
    'zoomIn' => 'zoomIn',
    'zoomInDown' => 'zoomInDown',
    'zoomInLeft' => 'zoomInLeft',
    'zoomInRight' => 'zoomInRight',
    'zoomInUp' => 'zoomInUp',
    'zoomOut' => 'zoomOut',
    'zoomOutDown' => 'zoomOutDown',
    'zoomOutLeft' => 'zoomOutLeft',
    'zoomOutRight' => 'zoomOutRight',
    'zoomOutUp' => 'zoomOutUp',
    'slideInDown' => 'slideInDown',
    'slideInLeft' => 'slideInLeft',
    'slideInRight' => 'slideInRight',
    'slideInUp' => 'slideInUp',
    'slideOutDown' => 'slideOutDown',
    'slideOutLeft' => 'slideOutLeft',
    'slideOutRight' => 'slideOutRight',
    'slideOutUp' => 'slideOutUp',
    'heartBeat' => 'heartBeat'
  );
}


function ts_get_hero_slider() {
  $args = array(
    'post_type' => 'hero',
    'posts_per_page' => -1,
  );
  $sliders = get_posts( $args );

  $_slider = array();

  if ( count( $sliders ) ) {
    foreach ( $sliders as $slider ) {
      $_slider[ $slider->ID . ' ' . $slider->post_title ] = $slider->ID;
    }
  }

  return $_slider;
}


// default options
function hompark_after_import() {

  update_field( 'enable_preloader', 1, 'option' );


  $social_media = array(
    array(
      'title' => esc_html__( 'fab fa-facebook-f', 'hompark' ),
      'url' => '#',
    ),
    array(
      'title' => esc_html__( 'fab fa-twitter', 'hompark' ),
      'url' => '#',
    ),
    array(
      'title' => esc_html__( 'fab fa-google-plus-g', 'hompark' ),
      'url' => '#',
    ),
    array(
      'title' => esc_html__( 'fab fa-youtube', 'hompark' ),
      'url' => '#',
    ),
  );

  $preloader_texts = array(
    array(
      'label' => esc_html__( 'Hompark', 'hompark' ),
      'url' => '#',
    ),
    array(
      'label' => esc_html__( 'Elements', 'hompark' ),
      'url' => '#',
    ),
    array(
      'label' => esc_html__( 'Loading', 'hompark' ),
      'url' => '#',
    ),
  );


  $custom_menu = array(
    array(
      'label' => esc_html__( 'EN', 'hompark' ),
      'url' => '#',
    ),
    array(
      'label' => esc_html__( 'RU', 'hompark' ),
      'url' => '#',
    ),
  );


  update_field( 'enable_social_media', 1, 'option' );
  update_field( 'enable_navbar_contact', 1, 'option' );

  update_field( 'social_media', $social_media, 'option' );
  update_field( 'preloader_texts', $preloader_texts, 'option' );
  update_field( 'custom_menu', $custom_menu, 'option' );


  update_field( 'archive_show_sidebar', 'yes', 'option' );
  update_field( 'archive_strip_content', 'yes', 'option' );

  update_field( 'footer_show_widgets', 1, 'option' );

  update_field( 'social_media_label', wp_kses_post( "SOCIAL MEDIA" ), 'option' );
  update_field( 'navbar_phone', wp_kses_post( "+380(98)298-59-73" ), 'option' );
  update_field( 'navbar_email', wp_kses_post( "hello@homepark.com.ua" ), 'option' );

  update_field( 'footer_widget_one', wp_kses_post( "<figure><img src='https://themezinho.net/hompark/images/footer-icon01.png' alt='Image'></figure><h3>Address Infos</h3><p>Kyiv | G. Stalingrada Avenue, 6<br>
Vilnius | Antakalnio St. 17</p>" ), 'option' );
  update_field( 'footer_widget_two', wp_kses_post( "<figure><img src='https://themezinho.net/hompark/images/footer-icon02.png' alt='Image'></figure><h3>Working Hours</h3><p>Monday to Friday <strong>09:00</strong> to <strong>18:30</strong><br>Saturday we work until <strong>15:30</strong></p>" ), 'option' );
  update_field( 'footer_widget_three', wp_kses_post( "<figure><img src='https://themezinho.net/hompark/images/footer-icon03.png' alt='Image'></figure><h3>Sales Office</h3><p>Boryssa Himry 124 B Block Pozniaky<br>Kiev Oblast – Ukraine</p>" ), 'option' );
}