<?php
ob_start();
if( has_excerpt() ) {
    $post_content = the_excerpt();
} else {
    $post_content = the_content();
}
$post_content = ob_get_clean();

$strip_content = ( hompark_get_option( 'archive_strip_content' ) ) ? hompark_get_option( 'archive_strip_content' ) : 'no';
if( $strip_content == 'yes' ){
    $post_content = preg_replace( '~\[[^\]]+\]~', '', $post_content );
    $post_content = strip_tags( $post_content );
    $post_content = hompark_get_the_post_excerpt( $post_content, 0 );
}
?>



<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-post' ) ); ?>>
	<?php if( hompark_get_post_thumbnail_url() ) { ?>
    <figure class="post-image">
        
		

           <img src="<?php echo esc_url( hompark_get_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>">
           
        </figure>
    <?php } ?>
    
	
	
	<div class="post-content">
		<div class="post-inner">
			<small class="post-date"><?php the_date('d F, Y'); ?></small>
			 <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php hompark_posted_by(); ?>

      
        
	      <?php if( $strip_content == 'yes' ) {
            echo wp_kses_post( $post_content );
            ?>
        <div class="post-link">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'READ MORE',  'hompark' ); ?></a>
            </div>
			<!-- end post-link -->
        <?php }
        else {
            the_content();
        }
        ?>
			
			

    </div>
		<!-- end post-inner -->
	</div>
	<!-- end post-content -->
	
	
</div>
<!-- end blog-post -->
