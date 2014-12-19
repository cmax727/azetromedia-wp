<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$post = $wp_query->post;
//var_dump($post);exit;

get_header(); 

?>
<!--CONTENT_PNL-->
 <section class="content-pnl">
  <div class="menu-way-point"></div>
	<div class="center-align">
		<div class="inner-baner" style="text-align:center;margin: 20px 0 -23px 0;padding:0">
			<h1><?php echo "AZTRO MEDIA BLOG"?></h1> 

		</div>
	</div>
 </section>
 <!--CONTENT_PNL_END-->

<div class="center-align">
		<div id="primary">
			<div id="content" role="main">
	<?php //the_post();?>
	<?php //get_template_part( 'content', 'single' ); ?> 
					<!-- xxx --->
					<div class="menu-way-point"></div>
					<div class="center-align left-side">
					<div class="blogCnt">
						<div class="topPnl">
						<h1 class="entry-title-new"><?php echo $post->post_title; ?></h1>

						<div style="clear:both; margin:0px; padding:0px; height:0px;"></div>
						
					<div class="entry-content">
						<?php
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						  the_post_thumbnail();
						}
						?>
						<p><?php echo $post->post_content; ?> </p>
						
						<div class="socalNtw">
						
							<span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span><span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span><span class='st_fblike_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='fblike'></span>
						</div>
						
						<div class="date"><?php echo get_the_date('d');?><span> <?php echo get_the_date('M');?> </span> <?php echo get_the_date('Y');?></div>

						</div>
					</div><!-- .entry-content -->
					
					<div style="clear:both; margin:0px; padding:0px; height:0px;"></div>

<!-- xxx -->
						
					
					<?php //comments_template( '', true ); ?>
                    <div style="clear:both; margin:0px; padding:0px; height:0px;"></div>
                    
			</div><!-- #content -->
			
			

		</div><!-- #primary -->
	<?php get_sidebar(); ?>
        </div>

</div>
</div>
<div style="height: 80px;width: 100%;float: left;"></div>
<?php get_footer(); ?>