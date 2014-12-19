<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
	<?php
		if(is_page('how-we-work'))
		{
			include('how-we-work.php');
		}
		elseif(is_page('our-works'))
		{
			include('our-works.php');
		}
		elseif(is_page('social-media'))
		{
			include('social-media.php');
		} 
		elseif(is_page('web-solutions'))
		{
			include('web-solutions.php');
		}
		elseif(is_page('marketing'))
		{
			include('marketing.php');
		}
		elseif(is_page('blog'))
		{
			include('blog-category.php');
		}
		elseif(is_page('maintenance'))
		{
			include('social-maintenance.php');
		}
		elseif(is_page('online-marketing'))
		{
			include('online-marketing.php');
		}		
		else
		{
	?>
			<div id="primary">
				<div id="content" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

						<?php //comments_template( '', true ); ?>

					<?php endwhile; // end of the loop. ?>

				</div><!-- #content -->
			</div><!-- #primary -->
<?php 	} ?>
<?php get_footer(); ?>