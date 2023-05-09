<?php
/**
 * The template for displaying for WP Builder
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hompark
 */

get_header();
?>
<?php hompark_render_page_header( 'page' ); ?>
<main>
  <?php
  if ( have_posts() ):
    while ( have_posts() ):
      the_post();
  the_content();
  endwhile;
  endif;
  ?>
  <!-- end wrap-page -->
</main>
<?php
get_footer();