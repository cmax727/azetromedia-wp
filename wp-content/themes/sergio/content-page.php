<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div class="menu-way-point"></div>
<div class="center-align">
	<div class="blogCnt">
        <div class="topPnl">
                    <h1 class="entry-title-new"><?php the_title(); ?></h1>
                    
                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
                </div><!-- .entry-content -->
                
                
               <div class="entry-edit-cc"><?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></div>
               
        </div>
    </div>
</div>