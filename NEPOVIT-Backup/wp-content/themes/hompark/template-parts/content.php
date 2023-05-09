<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hompark
 */

?>
<div class="post-content">
    <div class="post-inner">
        <?php
        if ( 'post' === get_post_type() ) :
            ?>
            <small class="post-date"><?php the_date('F d, Y'); ?></small>
            <?php hompark_posted_by(); ?>
		<?php the_tags( '<ul class="post-tags"><li>', '</li><li>', '</li></ul>' ); ?>
        <?php endif;
        ?>
		
		<h3 class="post-title"><?php the_title(); ?></h3>
		
		
    </div>

    

    <?php
    the_content( sprintf(
'%s %s',
        esc_html__('Continue reading', 'hompark'),
        '<span class="screen-reader-text"> ' . get_the_title() . '</span>'
    ) );

    wp_link_pages( array(
        'before'      => '<div class="page-links"><h6>' . esc_html__( 'Pages:',  'hompark' ) . '</h6>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
    ?>
    <div class="post-entry-footer">
        <?php hompark_entry_footer(); ?>
    </div>

</div>