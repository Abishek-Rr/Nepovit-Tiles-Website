<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php

$phone_icon = ( hompark_get_option( 'phone_icon' ) ) ? hompark_get_option( 'phone_icon' ) : get_template_directory_uri() . '/images/icon-phone.png';
$logo = ( hompark_get_option( 'logo' ) ) ? hompark_get_option( 'logo' ) : get_template_directory_uri() . '/images/logo@2x.png';
$retina_logo = ( hompark_get_option( 'retina_logo' ) ) ? hompark_get_option( 'retina_logo' ) : '';



$enable_navbar_contact = ( hompark_get_field( 'disable_navbar_contact' ) ) ? false : true;
$custom_menu = hompark_get_option( 'custom_menu' );
$enable_navbar_phone = ( hompark_get_field( 'disable_navbar_phone' ) ) ? false : true;
$enable_phone_icon = ( hompark_get_field( 'disable_phone_icon' ) ) ? false : true;
$preloader_texts = hompark_get_option( 'preloader_texts' );

?>
<?php
if ( hompark_get_option( 'enable_preloader' ) ):
  $pre_loader_icon = ( hompark_get_option( 'pre_loader_icon' ) ) ? hompark_get_option( 'pre_loader_icon' ) : get_template_directory_uri() . '/images/preloader.gif';
?>
<div class="preloader">
  <div class="layer"></div>
  <!-- end layer -->
  <div class="inner">
    <figure> <img src="<?php echo esc_url( $pre_loader_icon ); ?>" alt="<?php bloginfo( 'name' ); ?>"></figure>
    <p><span class="text-rotater" data-text="
		<?php 
		$count = count($preloader_texts);
		foreach($preloader_texts as $i => $pre):
		?>                                              
		<?php echo esc_attr( $pre['label'], '|' ); ?> 
		<?php if ($i < $count - 1) echo "| "; ?>
    <?php endforeach; ?>">

      </span></p>
  </div>
  <!-- end inner --> 
</div>
<!-- end preloader -->
<div class="transition-overlay">
  <div class="layer"></div>
</div>
<!-- end transition-overlay -->
<?php endif; ?>
	
	
<?php if( is_active_sidebar( 'hamburger-content' ) ) : ?>
<div class="side-navigation">
  <div class="menu">
    <?php
    if ( has_nav_menu( 'header' ) ) {
      wp_nav_menu( array(
        'theme_location' => 'header',
        'menu_class' => 'menu-horizontal',
        'walker' => new WP_hompark_Navwalker(),
      ) );
    }
    ?>
  </div>
  <?php dynamic_sidebar( 'hamburger-content' ); ?>
</div>
<?php endif; ?>
<nav class="navbar">
  <div class="container">
    <div class="upper-side">
      <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"
	<?php if( $retina_logo != '' ) : ?>
		srcset="<?php echo esc_url( $retina_logo ); ?>"
	<?php endif; ?>
		alt="<?php bloginfo( 'name' ); ?>"></a></div>
		
		 <?php if ( hompark_get_option( 'enable_navbar_contact' ) ): ?>
		
      <div class="phone-email"> 
        <?php {
          $navbar_phone = ( hompark_get_option( 'navbar_phone' ) )  ;
          ?>
        <h4><a href="tel:<?php echo esc_attr( $navbar_phone ); ?>"><?php echo esc_html( $navbar_phone ); ?></a></h4>
        <?php } ?>
        <?php {
          $navbar_email = ( hompark_get_option( 'navbar_email' ) )  ;
          ?>
        <small><a href="mailto:<?php echo esc_attr( $navbar_email ); ?>"><?php echo esc_html( $navbar_email ); ?></a></small>
        <?php } ?>
      </div>
      <!-- end phone -->
		<figure class="phone-email-icon"><img src="<?php echo esc_url( $phone_icon ); ?>" alt="Image"></figure>
		<?php endif; ?>
		 <?php
    if ( hompark_get_option( 'custom_menu' ) ):
      ?>
    <div class="language">
     
        <?php foreach ( $custom_menu as $menu ) { ?>
        <a href="<?php echo esc_url( $menu['url'] ); ?>"><?php echo esc_html( $menu['label'] ); ?></a> 
        <?php } ?>
     
    </div>
		 <!-- end language -->
    <?php endif; ?>
		
		
      
	<?php if( is_active_sidebar( 'hamburger-content' ) ) : ?>
      <div class="hamburger"> <span></span> <span></span> <span></span><span></span> </div>
      <!-- end hamburger --> 
      <?php endif; ?>
    </div>
    <!-- end upper-side -->
    <div class="menu">
      <?php
      if ( has_nav_menu( 'header' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'header',
          'menu_class' => 'menu-horizontal',
          'walker' => new WP_hompark_Navwalker(),
        ) );
      }
      ?>
    </div>
  </div>
</nav>
