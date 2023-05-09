<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hompark
 */

get_header();
?>
<?php
hompark_render_page_header( 'archive' );

$show_sidebar = ( hompark_get_option( 'archive_show_sidebar' ) ) ? hompark_get_option( 'archive_show_sidebar' ) : 'yes';
$wrapper_cols = '10';
$section_class = 'blog';

if ( !is_active_sidebar( 'sidebar-1' ) ) {
  $show_sidebar = 'no';
}

if ( $show_sidebar == 'yes' ) {
  $wrapper_cols = '8';
}
?>
<main>
  <section class="content-section">
    <div class="container">
      <div class="row justify-content-center">
        <?php
        if ( have_posts() ):
          ?>
        <div class="col-lg-<?php echo esc_attr( $wrapper_cols ); ?>">
          <?php
          while ( have_posts() ):
            the_post();

          get_template_part( 'template-parts/listing' );

          endwhile;
          // show pagination
          hompark_pagination();
          ?>
        </div>
        <!-- end col-8 -->
        <?php
        if ( $show_sidebar == 'yes' ) {
          ?>
        <div class="col-lg-4">
          <?php get_sidebar(); ?>
        </div>
        <!-- end col-4 -->
        <?php
        }
        ?>
        <?php
        else :
          get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 
  </section>
</main>
<!-- end blog -->
<?php
get_footer();
