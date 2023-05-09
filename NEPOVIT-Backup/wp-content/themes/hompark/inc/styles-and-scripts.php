<?php

function hompark_add_google_fonts() {

  wp_enqueue_style( 'poppins-google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:400,600,800', false );
  wp_enqueue_style( 'fjalla-google-fonts', 'https://fonts.googleapis.com/css?family=Fjalla+One', false );

}

add_action( 'wp_enqueue_scripts', 'hompark_add_google_fonts' );

if ( ! function_exists( 'hompark_enqueue_styles_and_scripts' ) ) {
	/**
	 * This function enqueues the required css and js files.
	 *
	 * @return void
	 */
	function hompark_enqueue_styles_and_scripts() {
		/**
		 * Enqueue css files.
		 */
		wp_enqueue_style( 'font awesome', get_template_directory_uri() . '/css/fontawesome.min.css' );
		wp_enqueue_style( 'hompark-bundle', get_template_directory_uri() . '/css/bundle.min.css' );
		wp_enqueue_style( 'bootsrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'hompark-main-style', get_template_directory_uri() . '/css/style.css' );
		wp_enqueue_style( 'hompark-stylesheet', get_stylesheet_uri() );
		wp_add_inline_style( 'hompark-stylesheet', hompark_dynamic_css() );

		/**
		 * Enqueue javascript files.
		 */

		wp_enqueue_script( 'comments', get_template_directory_uri() . '/js/comments.js', array(), false, false );
		wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hompark-bundle', get_template_directory_uri() . '/js/bundle.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hompark-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), false, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$data = array(
			'pre_loader_typewriter' => [],
			'audio_source' => '',
			'enable_sound_bar' => false
		);

		if( hompark_get_option( 'enable_preloader' ) ) {
			$typewriter_text = [];
			$text_rotater = hompark_get_option( 'pre_loader_text_rotater' );
			if( $text_rotater ) {
				foreach ( $text_rotater as $rotater ) {
					$typewriter_text[] = esc_html( $rotater['title'] );
				}
			}
			$data['pre_loader_typewriter'] = $typewriter_text;
		}
		

		$comment_data = array(
			'name'      => esc_html__( 'Name is required', 'hompark' ),
			'email'     => esc_html__( 'Email is required', 'hompark' ),
			'comment'   => esc_html__( 'Comment is required', 'hompark' ),

		);

		wp_localize_script( 'hompark-scripts', 'data', $data );
		wp_localize_script( 'comments', 'comment_data', $comment_data );
	}

	add_action( 'wp_enqueue_scripts', 'hompark_enqueue_styles_and_scripts', 10 );
}

if( !function_exists( 'hompark_dynamic_css' ) ) {
	function hompark_dynamic_css() {

		$styles = '';
		if( hompark_get_option( 'logo_height' ) ) {
			$logo_height = str_replace(' ', '', hompark_get_option( 'logo_height' ) );
			$logo_height = str_replace('px', '', $logo_height);
			$styles .= "
				body .navbar > .logo img{
					height: {$logo_height}px;
				}
			";
		}
		if( hompark_get_option( 'enable_dynamic_color' ) ) {

			$site_color = ( hompark_get_option( 'theme_color' ) ) ? hompark_get_option( 'theme_color' ) : '#9f8054';
			$site_color2 = ( hompark_get_option( 'theme_color2' ) ) ? hompark_get_option( 'theme_color2' ) : '#ebcfa7';
			$body_bg_color = ( hompark_get_option( 'body_background_color' ) ) ? hompark_get_option( 'body_background_color' ) : '#fff';

			$styles .= "
				body{
					background: {$body_bg_color} !important;
				}
				button[type=submit], input[type=submit],
				.video-bg,
				.slider .slider-container .swiper-slide:after,
				.slider .slider-container .swiper-slide .container a:hover,
				.page-header:after,
				.page-header .container .breadcrumb,
				.consultation-box,
				.apartment .property-infos,
				.info-counter,
				.side-support-box,
				.not-found a:hover,
				.blog-post .post-content blockquote,
				.footer-bar .inner,
				.blog-post .post-content .wp-block-quote,
				.blog-post .post-content .post-tags li a,
				.blog-post .post-content blockquote,
				.sidebar .widget_tag_cloud .tagcloud a,
				.woocommerce ul.products li.product .onsale,
				.woocommerce span.onsale
				{
					background-color: {$site_color} !important;
				}
				.section-titles h2 em,
				.side-image-right a:hover,
				.property-plans h4 span,
				.side-text-left table tr td:first-child,
				.consultation-box a:hover,
				.recent-posts h4 span,
				.recent-news h6 a:hover,
				.apartment-content h2 em,
				.about-content h2 em,
				.gallery-filter li a:hover,
				.sales-team figcaption h4 span,
				.sales-team figcaption ul li a:hover,
				.not-found h2,
				.not-found a,
				.blog-post .post-content .post-title a:hover,
				.contact h4 span,
				.footer .select-box .dropdown-menu li a:hover,
				.accordion .card .card-header a:hover,
				.accordion .card [aria-expanded=true],
				.accordion .card [aria-expanded=true]:before
				{
				  color: {$site_color} !important;
				}
				
				
				.breadcrumb li,
				.breadcrumb li.active,
				.side-navigation .menu ul li a:hover,
				.navbar .container .upper-side .phone-email small a:hover,
				.navbar .container .upper-side .language a:hover,
				.navbar .container .menu ul li a:hover,
				.video-header .container h1,
				.video-header .social-media ul li a:hover,
				.slider .slider-container .swiper-slide .container h1,
				.slider .slider-container .inner-elements .container .social-media ul li a:hover,
				.slider .slider-container .inner-elements .container .button-prev:hover,
				.slider .slider-container .inner-elements .container .button-next:hover,
				.page-header .container h1,
				.section-titles.light h2 em,
				.consultation-box h4 em,
				.footer .footer-menu li a:hover
				{
				  color: {$site_color2} !important;
				}
				
				.gallery-container .gallery-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
				.preloader,
				.transition-overlay,
				.side-navigation .social-media li a:hover,
				.side-image-left,
				.icon-counter figure:after,
				.apartment-content blockquote,
				.video-content,
				.map,
				.map:before,
				.footer .contact-box ul li a:hover
				{
				  background-color: {$site_color2} !important;
				}
				
				.navbar .container .menu ul li a:hover,
				.video-header .container .link,
				.slider .slider-container .swiper-slide .container a,
				.consultation-box:after,
				.gallery-filter li a.current,
				.not-found a
				{
				  border-color: {$site_color2} !important;
				}
			";
		}

		return $styles;
	}
}

add_action( 'init', 'hompark_dynamic_css' );
add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);