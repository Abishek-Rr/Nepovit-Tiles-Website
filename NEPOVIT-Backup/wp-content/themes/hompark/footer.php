<?php
$footer_bg_color = hompark_get_option( 'footer_bg_color' ) ? hompark_get_option( 'footer_bg_color' ) : '#26282b';
$footer_bg_image = hompark_get_option( 'footer_bg_image' ) ? hompark_get_option( 'footer_bg_image' ) : '';
$footer_style = 'background-color: ' . $footer_bg_color;

$show_social_icons = hompark_get_option( 'footer_show_social_links' );
$show_social_title = ( hompark_get_option( 'footer_social_link_title' ) ) ? hompark_get_option( 'footer_social_link_title' ) : 'Connect with us';

$copyright = hompark_get_option( 'footer_copyright_text' );

if ( !$copyright ) {
  $copyright = esc_html__( '&copy; 2020 Homepark | Real Estate & Luxury Homes', 'hompark' );
}

$footer_bg = ( $footer_bg_image != '' ) ? 'data-background="' . esc_url( $footer_bg_image ) . '"': '';
?>


     
 <?php if( hompark_get_option( 'footer_show_widgets' ) ) { ?>
<section class="footer-bar" <?php echo esc_attr( $footer_bg ); ?>
    style="<?php echo esc_attr( $footer_style ); ?>">
  <div class="container">
    <div class="inner wow fadeIn">
      <div class="row">
		 
        <div class="col-lg-4 wow fadeInUp">
			<?php echo wp_kses_post( hompark_get_option( 'footer_widget_one' ) ); ?>
        </div>
        <!-- end col-4 -->
		   
		  
        <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.10s">
         
			<?php echo wp_kses_post( hompark_get_option( 'footer_widget_two' ) ); ?>
        </div>
        <!-- end col-4 -->
        <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.15s">
         
			<?php echo wp_kses_post( hompark_get_option( 'footer_widget_three' ) ); ?>
        </div>
        <!-- end col-4 --> 
		  
      </div>
      <!-- end row --> 
    </div>
    <!-- end inner --> 
  </div>
  <!-- end container --> 
</section>
 <?php } ?>

<footer class="footer"
    <?php echo esc_attr( $footer_bg ); ?>
    style="<?php echo esc_attr( $footer_style ); ?>">
  <div class="container">
    <div class="row">
      <?php if( is_active_sidebar( 'footer-widget-1' ) || is_active_sidebar( 'footer-widget-2' ) || is_active_sidebar( 'footer-widget-3' ) || is_active_sidebar( 'footer-widget-4' ) ) { ?>
      <?php if( is_active_sidebar( 'footer-widget-1' ) ) : ?>
      <div class="col-lg-4 wow fadeInUp">
        <?php dynamic_sidebar( 'footer-widget-1' ); ?>
      </div>
      <?php endif; ?>
      <?php if( is_active_sidebar( 'footer-widget-2' ) ) : ?>
      <div class="col-lg-2 col-6 wow fadeInUp">
        <?php dynamic_sidebar( 'footer-widget-2' ); ?>
      </div>
      <?php endif; ?>
      <?php if( is_active_sidebar( 'footer-widget-3' ) ) : ?>
      <div class="col-lg-2 col-6 wow fadeInUp">
        <?php dynamic_sidebar( 'footer-widget-3' ); ?>
      </div>
      <?php endif; ?>
      <?php if( is_active_sidebar( 'footer-widget-4' ) ) : ?>
      <div class="col-lg-4 wow fadeInUp">
        <?php dynamic_sidebar( 'footer-widget-4' ); ?>
      </div>
      <?php endif; ?>
      <?php } ?>
     
      <div class="col-12 wow fadeIn">
        <div class="footer-bottom"> 
			 <?php if( $copyright ) { ?>
			<span class="copyright"><?php echo wp_kses_post( $copyright ); ?></span>
			<?php } ?>
			<span class="creation">
         <?php echo wp_kses_post( hompark_get_option( 'footer_site_credit' ) ); ?>
				</span>
        </div>
        <!-- end footer-bottom --> 
      </div>
      <!-- end col-12 -->
      
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</footer>
<?php wp_footer(); ?>
</body></html>