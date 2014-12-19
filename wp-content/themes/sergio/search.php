<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div class="menu-way-point"></div>
<div class="center-align">
	<div class="blogCnt">
        <div class="topPnl">
		
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				
			     <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>				

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						 
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				
				    <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>					

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
						<?php //get_search_form(); ?>
					</div><!-- .entry-content -->
				

			<?php endif; ?>

			</div><!-- #content -->
            </div>
            </div>
            </div>
            

<?php get_sidebar(); ?>
<?php get_footer(); ?>