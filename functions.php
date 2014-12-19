<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	$theme_options = twentyeleven_get_theme_options();
	if ( 'dark' == $theme_options['color_scheme'] )
		$default_background_color = '1d1d1d';
	else
		$default_background_color = 'f1f1f1';

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		// This is dependent on our current color scheme.
		'default-color' => $default_background_color,
	) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// Add support for custom headers.
	$custom_header_support = array(
		// The default header text color.
		'default-text-color' => '000',
		// The height and width of our custom header.
		'width' => apply_filters( 'twentyeleven_header_image_width', 1000 ),
		'height' => apply_filters( 'twentyeleven_header_image_height', 288 ),
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
		'random-default' => true,
		// Callback for styling the header.
		'wp-head-callback' => 'twentyeleven_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentyeleven_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'twentyeleven_admin_header_image',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );

	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
		define( 'HEADER_IMAGE', '' );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-head-callback'], $custom_header_support['admin-preview-callback'] );
		add_custom_background();
	}

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// Add Twenty Eleven's custom image sizes.
	// Used for large feature (header) images.
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'small-feature', 500, 300 );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;
		
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

/* Start Code to make the sergio theme Dynamic */
/* 
* Author	:	Varun Srivastava
* Date		:	30th Nov 2012
* Desc		:	Code to make the theme content Dynamic.
*/	
	add_action('admin_menu','ser_themes_option_menu');
	function ser_themes_option_menu(){
		$ser_icon_url	= get_bloginfo("template_url").'/images/faver-icon1.png';	
        add_menu_page('wp_themes_option_settings','Sergio','administrator','themes_option','ser_themes_custome_options',$ser_icon_url);
	    add_submenu_page('themes_option', 'Sergio', 'Social Media', 'administrator', 'social_media','social_media_fun'); 
		add_submenu_page('themes_option', 'Sergio', 'How We Work', 'administrator', 'how_we_work','how_we_work_fun'); 
		add_submenu_page('themes_option', 'Sergio', 'web Solutions', 'administrator', 'web_solutions','web_solutions_fun'); 
		add_submenu_page('themes_option', 'Sergio', 'Marketing', 'administrator', 'marketing','marketing_fun'); 
		add_submenu_page('themes_option', 'Sergio', 'Maintenance', 'administrator', 'maintenance','social_media_maintenance_fun'); 
		add_submenu_page('themes_option', 'Sergio', 'Online Marketing', 'administrator', 'Online_marketing','online_marketing_fun'); 		
	} 
	
	
	function ser_themes_custome_options()
	{
		global $wpdb;
		if($_POST['submit']=='Save' ){
		
			/* Code to update the fields */
			update_option('footer_content',$_POST['footer_content']);
			/* Code for below slider content */
				update_option('page_below_slider_1',$_POST['page_below_slider_1']);
				update_option('page_below_slider_2',$_POST['page_below_slider_2']);
				update_option('page_below_slider_3',$_POST['page_below_slider_3']);
			/* End Code for below slider content */
			/* Start Code for below three pages */
			/* Contact details*/
				update_option('contact_heading',$_POST['contact_heading']);
				update_option('contact_sub_heading',$_POST['contact_sub_heading']);
				update_option('contact_address',$_POST['contact_address']);
				update_option('contact_number',$_POST['contact_number']);
				update_option('contact_email',$_POST['contact_email']);
			/* Contact details*/
			/* Testimonial details*/
				update_option('testimonial_page',$_POST['testimonial_page']);
			/* Testimonial details*/
			/* About us details*/
				update_option('about_us_page',$_POST['about_us_page']);
			/* About Us details*/			
			/* End Code for below three pages */
			/*Code for update logo*/
			$logo      		  = $_FILES['logo_image']['name']; 
			$target_file      = get_template_directory()."/images/";
			$target_path      = $target_file."".basename( $_FILES['logo_image']['name']);
			if(move_uploaded_file($_FILES['logo_image']['tmp_name'],$target_path))
			{ 
				update_option('sergio_logo_image',$logo);               
			}
			
			/* Blog details*/
			update_option('blog_content',$_POST['blog_content']);
			
			/*slider images*/
					update_option('hp_link1',$_POST['hp_link1']);
					update_option('hp_link2',$_POST['hp_link2']);
					update_option('hp_link3',$_POST['hp_link3']);
					update_option('sl_heading',$_POST['sl_heading']);
					update_option('sl_subheading',$_POST['sl_subheading']);
			/* End Code for below slider content */
				
			$slider_img       = $_FILES['sl_image1']['name']; 
			$target_file1      = get_template_directory()."/images/";
			$target_path1      = $target_file1."".basename( $_FILES['sl_image1']['name']);
			if(move_uploaded_file($_FILES['sl_image1']['tmp_name'],$target_path1))
			{ 
				update_option('sl_image1',$slider_img);               
			}
			
			
			$slider_img       = $_FILES['sl_image2']['name']; 
			$target_file2      = get_template_directory()."/images/";
			$target_path2      = $target_file2."".basename( $_FILES['sl_image2']['name']);
			if(move_uploaded_file($_FILES['sl_image2']['tmp_name'],$target_path2))
			{ 
				update_option('sl_image2',$slider_img);               
			}
			
			$slider_img       = $_FILES['sl_image3']['name']; 
			$target_file3      = get_template_directory()."/images/";
			$target_path3      = $target_file3."".basename( $_FILES['sl_image3']['name']);
			if(move_uploaded_file($_FILES['sl_image3']['tmp_name'],$target_path3))
			{ 
				update_option('sl_image3',$slider_img);               
			}
			
			$slider_img       = $_FILES['sl_image']['name']; 
			$target_file      = get_template_directory()."/images/";
			$target_path      = $target_file."".basename( $_FILES['sl_image']['name']);
			if(move_uploaded_file($_FILES['sl_image']['tmp_name'],$target_path))
			{ 
				update_option('sl_image',$slider_img);               
			}
			
			
			
			/* Code for below slider content */
				update_option('slid_heading',$_POST['slider_heading']);
				update_option('slid_subheading',$_POST['slider_subheading']);
				update_option('slid_description',$_POST['slider_description']);
			/* End Code for below slider content */
				
			$slider_img       = $_FILES['slid_image']['name']; 
			$target_file6      = get_template_directory()."/images/";
			$target_path6      = $target_file6."".basename( $_FILES['slid_image']['name']);
			if(move_uploaded_file($_FILES['slid_image']['tmp_name'],$target_path6))
			{ 
				update_option('slid_image',$slider_img);               
			}
			
		} 
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Sergio General Settings</h2>
			<br/>
			&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
					<div class="update-nag" align="left"><strong>Logo</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
							<tr>
								<td>Logo</td>
								<td><input type="file" name="logo_image" id="logo_image"/>
								<img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('sergio_logo_image',true); ?>" height="80" border="0"/></td>
								<!-- -End logo here -->
							</tr>
						</tbody>
					</table>
					<br />
					<div class="update-nag" align="left"><strong>Footer Content</strong></div><br/>
					<!-- Change of footer content starts here -->
					<table class="widefat">
						<tbody>
							<tr>
								<td>Footer Content</td>
								<td>
									<textarea name="footer_content" id="footer_content" rows="5" cols="80"><?php echo stripcslashes(get_option('footer_content')); ?></textarea>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- Change of footer content starts here -->
					<br />
					<!-- Change of Home Page content starts here -->
					<div class="update-nag" align="left"><strong>Home Page Content</strong></div><br/>
					<table class="widefat">
						<tbody>
							<h3>Select Pages for Below Slider Content</h3>
							<tr>
								<td>Selete Pages1</td>
								<td>
									<select name="page_below_slider_1" id="page_below_slider_1">
										<option value="">Select Page1</option>

										<?php $page_below_slider_1 = "SELECT * FROM wp_posts WHERE post_status ='publish' AND post_type='page'  ORDER BY post_title";
											   $result_1 = $wpdb->get_results($page_below_slider_1); 
											foreach( $result_1  as $val_1):
											?>
										<option value="<?php echo $val_1->ID; ?>"<?php if(get_option("page_below_slider_1")== $val_1->ID): echo "selected='selected'"; endif; ?>><?php echo $val_1->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Selete Pages2</td>
								<td>
									<select name="page_below_slider_2" id="page_below_slider_2">
										<option value="">Select Page2</option>

										<?php $page_below_slider_2 = "SELECT * FROM wp_posts WHERE post_status ='publish' AND post_type='page'  ORDER BY post_title";
											   $result_2 = $wpdb->get_results($page_below_slider_2); 
											foreach( $result_2  as $val_2):
											?>
										<option value="<?php echo $val_2->ID; ?>"<?php if(get_option("page_below_slider_2")== $val_2->ID): echo "selected='selected'"; endif; ?>><?php echo $val_2->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Selete Pages3</td>
								<td>
									<select name="page_below_slider_3" id="page_below_slider_3">
										<option value="">Select Page3</option>

										<?php $page_below_slider_3 = "SELECT * FROM wp_posts WHERE post_status ='publish' AND post_type='page'  ORDER BY post_title";
											   $result_3 = $wpdb->get_results($page_below_slider_3); 
											foreach( $result_3  as $val_3):
											?>
										<option value="<?php echo $val_3->ID; ?>"<?php if(get_option("page_below_slider_3")== $val_3->ID): echo "selected='selected'"; endif; ?>><?php echo $val_3->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<h3>Content for Below Three Pages</h3>
					<table class="widefat">
						<tbody>
						<h3>Contact Details</h3>
							<tr>
								<td>Heading</td>
								<td><input type="text" name="contact_heading" value="<?php echo get_option('contact_heading');?>" size="65"></td>
							</tr>
							<tr>
								<td>Sub Heading</td>
								<td><input type="text" name="contact_sub_heading" value="<?php echo get_option('contact_sub_heading');?>" size="65"></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><textarea name="contact_address" rows="4" cols="60"><?php echo get_option('contact_address');?></textarea></td>
							</tr>
							<tr>
								<td>Contact Number</td>
								<td><input type="text" name="contact_number" value="<?php echo get_option('contact_number');?>" size="65"></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input type="text" name="contact_email" value="<?php echo get_option('contact_email');?>" size="65"></td>
							</tr>
						</tbody>
					</table>
					<!-- Code For Testimonials -->
					<table class="widefat">
						<tbody>
							<h3>Testimonial Details</h3>
							<tr>
								<td>Selete Testimonial Page</td>
								<td>
									<select name="testimonial_page" id="testimonial_page">
										<option value="">Select Page</option>

										<?php $testimonial_page = "SELECT * FROM wp_posts WHERE post_status ='publish' AND post_type='page'  ORDER BY post_title";
											   $testimonial_page = $wpdb->get_results($testimonial_page); 
											foreach( $testimonial_page  as $test):
											?>
										<option value="<?php echo $test->ID; ?>"<?php if(get_option("testimonial_page")== $test->ID): echo "selected='selected'"; endif; ?>><?php echo $test->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>	
					<!-- Code For Testimonials -->
					<!-- Code For About Us -->
					<table class="widefat">
						<tbody>
							<h3>About Us Details</h3>
							<tr>
								<td>Selete About Us Page</td>
								<td>
									<select name="about_us_page" id="about_us_page">
										<option value="">Select Page</option>

										<?php $about_us_page = "SELECT * FROM wp_posts WHERE post_status ='publish' AND post_type='page'  ORDER BY post_title";
											   $about_us_page = $wpdb->get_results($about_us_page); 
											foreach( $about_us_page  as $about):
											?>
										<option value="<?php echo $about->ID; ?>"<?php if(get_option("about_us_page")== $about->ID): echo "selected='selected'"; endif; ?>><?php echo $about->post_title; ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>	
					<!-- Code For Testimonials -->
					<!-- Change of Home Page content starts here -->
					<br />
					<!--
					Add by swapnil
					-->
					<div class="update-nag" align="left"><strong>Blog Content</strong></div><br/>
					<table class="widefat">
						<tbody>
							<tr>
								<td>Blog Title</td>
								<td>
									<input type="text" size="65" name="blog_content" id="blog_content" value="<?php echo get_option('blog_content'); ?>">
								</td>
							</tr>
						</tbody>
					</table>
					<br/>
					<!--
					<div class="update-nag" align="left"><strong>Slider</strong></div><br/>
					<table class="widefat">
						<tbody>
							<tr>
								<td>Image 1</td>
								<td><input type="file" name="sl_image2" id="slide_image"/>
								<img src="<?php //bloginfo('template_url'); ?>/images/<?php //echo get_option('sl_image1',true); ?>" height="80" border="0"/>
								</td>
							</tr>
							<tr>
								<td>Hyper link text:</td>							
								<td><input type="text" size="65" name="hp_link1" value="<?php //echo get_option('hp_link1'); ?>">								</td>
							</tr>
							<tr><td>Image 2</td>
								<td><input type="file" name="sl_image2" id="slide_image"/>
								<img src="<?php //bloginfo('template_url'); ?>/images/<?php //echo get_option('sl_image2',true); ?>" height="80" border="0"/>
								</td>
							</tr>
							<tr>
								<td>Hyper link text:</td>							
								<td><input type="text" size="65" name="hp_link2" value="<?php //echo get_option('hp_link2'); ?>">								</td>
							</tr>
							<tr><td>Image 3</td>
								<td><input type="file" name="sl_image3" id="slide_image"/>
								<img src="<?php //bloginfo('template_url'); ?>/images/<?php //echo get_option('sl_image3',true); ?>" height="80" border="0"/>
								</td>
							</tr>
							<tr>
								<td>Hyper link text:</td>							
								<td><input type="text" size="65" name="hp_link3"  value="<?php //echo get_option('hp_link3'); ?>">								</td>
							</tr>
							
							<tr><td>Sliding Image </td>
								<td><input type="file" name="sl_image" id="slide_image"/>
								<img src="<?php //bloginfo('template_url'); ?>/images/<?php //echo get_option('sl_image',true); ?>" height="80" border="0"/>
								</td>
							</tr>
							<tr><td>Heading Text</td>
								<td><textarea name="sl_heading" rows="5" cols="80"><?php //echo get_option('sl_heading'); ?></textarea></td>
							</tr>
							<tr><td>Sub Heading Text</td>
								<td><input type="text" size="65" value="<?php //echo get_option('sl_subheading'); ?>" name="sl_subheading"></td>
							</tr>
						</tbody>
					</table>
					<br/> 
					<table class="widefat">
					<tbody>
						<tr>
							<td>Slider Image:</td>
							<td><input type="file" name="slid_image" id="slide_image"/>
							<img src="<?php //bloginfo('template_url'); ?>/images/<?php //echo get_option('slid_image',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading:</td>
							<td><input type="text" name="slid_heading" id="heading" value="<?php //echo get_option('slid_heading');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Sub-Heading:</td>
							<td><input type="text" name="slid_subheading" id="subheading" value="<?php //echo get_option('slid_subheading');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description:</td>
							<td><textarea name="slid_description" id="slider_description" rows="5" cols="80"><?php //echo get_option('slid_description');?></textarea></td>
						</tr>
					</tbody>
					</table> -->
					<br />
				<input type="submit" value="Save" name="submit" class="button-primary"/>
			</form>
		</div>
	<?php
	}
	/*
	 Author :	Murli Kumar Patel
	 Desc 	:	Code to make social media Subpage maintenance dynamic.
	 Date 	:	Dec 25, 2012	 
	*/
	function social_media_maintenance_fun() {
	global $wpdb;
		if($_POST['submit']=='Save' ){
					//print_r($_REQUEST);	
			/*====5 boxes ===*/
				update_option('title_but_social_m',$_POST['button_title_social_m']);
				update_option('sub_title_but_social_m',$_POST['buton_sub_title_social_m']);
				update_option('button_heading_social_m1',$_POST['button_heading_social_m1']);
				update_option('buton_description_social_m1',$_POST['buton_description_social_m1']);
				update_option('button_heading_social_m2',$_POST['button_heading_social_m2']);
				update_option('buton_description_social_m2',$_POST['buton_description_social_m2']);
				update_option('button_heading_social_m3',$_POST['button_heading_social_m3']);
				update_option('buton_description_social_m3',$_POST['buton_description_social_m3']);
				update_option('button_heading_social_m4',$_POST['button_heading_social_m4']);
				update_option('buton_description_social_m4',$_POST['buton_description_social_m4']);
				update_option('button_heading_social_m5',$_POST['button_heading_social_m5']);
				update_option('buton_description_social_m5',$_POST['buton_description_social_m5']);
			/*====5 boxes ===*/	
			} 
	
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Socail Media Maintenance</h2>
			<br/>&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="update-nag" align="left"><strong>Five Boxes</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
								<tr>
								<td>Title:</td>
								<td><input type="text" name="button_title_social_m" id="heading" value="<?php echo get_option('title_but_social_m');?>" size="83"></td>
								</tr>
								<tr>
								<td>Sub Title:</td>
								<td><input type="text" name="buton_sub_title_social_m" id="heading" value="<?php echo get_option('sub_title_but_social_m');?>" size="83"></td>
								</tr>
								
								<tr>
								<td>Button Heading 1:</td>
								<td><input type="text" name="button_heading_social_m1" id="heading" value="<?php echo get_option('button_heading_social_m1');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 1:</td>
								<td><textarea name="buton_description_social_m1" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description_social_m1');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 2:</td>
								<td><input type="text" name="button_heading_social_m2" id="heading" value="<?php echo get_option('button_heading_social_m2');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 2:</td>
								<td><textarea name="buton_description_social_m2" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description_social_m2');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 3:</td>
								<td><input type="text" name="button_heading_social_m3" id="heading" value="<?php echo get_option('button_heading_social_m3');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 3:</td>
								<td><textarea name="buton_description_social_m3" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description_social_m3');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 4:</td>
								<td><input type="text" name="button_heading_social_m4" id="heading" value="<?php echo get_option('button_heading_social_m4');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 4:</td>
								<td><textarea name="buton_description_social_m4" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description_social_m4');?></textarea></td>
								</tr>
								
								
								<tr>
								<td>Button Heading 5:</td>
								<td><input type="text" name="button_heading_social_m5" id="heading" value="<?php echo get_option('button_heading_social_m5');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 5:</td>
								<td><textarea name="buton_description_social_m5" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description_social_m5');?></textarea></td>
								</tr>
					</table>
					<br/>
					<input type="submit" value="Save" name="submit" class="button-primary"/>
			</form>
		</div>
	<?php
	}
	/*
	 Author :	Murli Kumar Patel
	 Desc 	:	Code to make web solution dynamic.
	 Date 	:	Dec 24, 2012	 
	*/
	function web_solutions_fun() {
	global $wpdb;
		if($_POST['submit']=='Save' ){
					//print_r($_REQUEST);	
			/*====5 boxes ===*/
				update_option('title_but1',$_POST['button_title1']);
				update_option('sub_title_but1',$_POST['buton_sub_title1']);
				update_option('button_heading11',$_POST['button_heading11']);
				update_option('buton_description11',$_POST['buton_description11']);
				update_option('button_heading21',$_POST['button_heading21']);
				update_option('buton_description21',$_POST['buton_description21']);
				update_option('button_heading31',$_POST['button_heading31']);
				update_option('buton_description31',$_POST['buton_description31']);
				update_option('button_heading41',$_POST['button_heading41']);
				update_option('buton_description41',$_POST['buton_description41']);
				update_option('button_heading51',$_POST['button_heading51']);
				update_option('buton_description51',$_POST['buton_description51']);
			/*====5 boxes ===*/	
			} 
	
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>web Solutions</h2>
			<br/>&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="update-nag" align="left"><strong>Five Boxes</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
								<tr>
								<td>Title:</td>
								<td><input type="text" name="button_title1" id="heading" value="<?php echo get_option('title_but1');?>" size="83"></td>
								</tr>
								<tr>
								<td>Sub Title:</td>
								<td><input type="text" name="buton_sub_title1" id="heading" value="<?php echo get_option('sub_title_but1');?>" size="83"></td>
								</tr>
								
								<tr>
								<td>Button Heading 1:</td>
								<td><input type="text" name="button_heading11" id="heading" value="<?php echo get_option('button_heading11');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 1:</td>
								<td><textarea name="buton_description11" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description11');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 2:</td>
								<td><input type="text" name="button_heading21" id="heading" value="<?php echo get_option('button_heading21');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 2:</td>
								<td><textarea name="buton_description21" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description21');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 3:</td>
								<td><input type="text" name="button_heading31" id="heading" value="<?php echo get_option('button_heading31');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 3:</td>
								<td><textarea name="buton_description31" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description31');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 4:</td>
								<td><input type="text" name="button_heading41" id="heading" value="<?php echo get_option('button_heading41');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 4:</td>
								<td><textarea name="buton_description41" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description41');?></textarea></td>
								</tr>
								
								
								<tr>
								<td>Button Heading 5:</td>
								<td><input type="text" name="button_heading51" id="heading" value="<?php echo get_option('button_heading51');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 5:</td>
								<td><textarea name="buton_description51" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description51');?></textarea></td>
								</tr>
					</table>
					<br/>
					<input type="submit" value="Save" name="submit" class="button-primary"/>
			</form>
		</div>
	<?php
	}
	/*
	 Author :	Murli Kumar Patel
	 Desc 	:	Code to make marketing dynamic.
	 Date 	:	Dec 24, 2012	 
	*/
	function marketing_fun() {
	global $wpdb;
		if($_POST['submit']=='Save' ){
			//print_r($_REQUEST);			
			/*====5 boxes ===*/
				update_option('title_but2',$_POST['button_title2']);
				update_option('sub_title_but2',$_POST['buton_sub_title2']);
				update_option('button_heading12',$_POST['button_heading12']);
				update_option('buton_description12',$_POST['buton_description12']);
				update_option('button_heading22',$_POST['button_heading22']);
				update_option('buton_description22',$_POST['buton_description22']);
				update_option('button_heading32',$_POST['button_heading32']);
				update_option('buton_description32',$_POST['buton_description32']);
				update_option('button_heading42',$_POST['button_heading42']);
				update_option('buton_description42',$_POST['buton_description42']);
				update_option('button_heading52',$_POST['button_heading52']);
				update_option('buton_description52',$_POST['buton_description52']);
			/*====5 boxes ===*/	
			} 
	
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Marketing</h2>
			<br/>&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="update-nag" align="left"><strong>Five Boxes</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
								<tr>
								<td>Title:</td>
								<td><input type="text" name="button_title2" id="heading" value="<?php echo get_option('title_but2');?>" size="83"></td>
								</tr>
								<tr>
								<td>Sub Title:</td>
								<td><input type="text" name="buton_sub_title2" id="heading" value="<?php echo get_option('sub_title_but2');?>" size="83"></td>
								</tr>
								
								<tr>
								<td>Button Heading 1:</td>
								<td><input type="text" name="button_heading12" id="heading" value="<?php echo get_option('button_heading12');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 1:</td>
								<td><textarea name="buton_description12" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description12');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 2:</td>
								<td><input type="text" name="button_heading22" id="heading" value="<?php echo get_option('button_heading22');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 2:</td>
								<td><textarea name="buton_description22" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description22');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 3:</td>
								<td><input type="text" name="button_heading32" id="heading" value="<?php echo get_option('button_heading32');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 3:</td>
								<td><textarea name="buton_description32" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description32');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 4:</td>
								<td><input type="text" name="button_heading42" id="heading" value="<?php echo get_option('button_heading42');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 4:</td>
								<td><textarea name="buton_description42" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description42');?></textarea></td>
								</tr>
								
								
								<tr>
								<td>Button Heading 5:</td>
								<td><input type="text" name="button_heading52" id="heading" value="<?php echo get_option('button_heading52');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 5:</td>
								<td><textarea name="buton_description52" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description52');?></textarea></td>
								</tr>
					</table>
					<br/>
					<input type="submit" value="Save" name="submit" class="button-primary"/>
			</form>
		</div>
	<?php
	}
	/*
	 Author :	Murli Kumar Patel
	 Desc 	:	Code to make Online Marketing dynamic.
	 Date 	:	Dec 24, 2012	 
	*/
	function online_marketing_fun() {
	global $wpdb;
		if($_POST['submit']=='Save' ){
					//print_r($_REQUEST);	
			/*====5 boxes ===*/
				update_option('onM_title_but1',$_POST['onM_button_title1']);
				update_option('onM_sub_title_but1',$_POST['onM_buton_sub_title1']);
				update_option('onM_button_heading11',$_POST['onM_button_heading11']);
				update_option('onM_buton_description11',$_POST['onM_buton_description11']);
				update_option('onM_button_heading21',$_POST['onM_button_heading21']);
				update_option('onM_buton_description21',$_POST['onM_buton_description21']);
				update_option('onM_button_heading31',$_POST['onM_button_heading31']);
				update_option('onM_buton_description31',$_POST['onM_buton_description31']);
				update_option('onM_button_heading41',$_POST['onM_button_heading41']);
				update_option('onM_buton_description41',$_POST['onM_buton_description41']);
				update_option('onM_button_heading51',$_POST['onM_button_heading51']);
				update_option('onM_buton_description51',$_POST['onM_buton_description51']);
			/*====5 boxes ===*/	
			} 
	
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Online Marketing</h2>
			<br/>&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="update-nag" align="left"><strong>Five Boxes</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
								<tr>
								<td>Title:</td>
								<td><input type="text" name="onM_button_title1" id="heading" value="<?php echo get_option('onM_title_but1');?>" size="83"></td>
								</tr>
								<tr>
								<td>Sub Title:</td>
								<td><input type="text" name="onM_buton_sub_title1" id="heading" value="<?php echo get_option('onM_sub_title_but1');?>" size="83"></td>
								</tr>
								
								<tr>
								<td>Button Heading 1:</td>
								<td><input type="text" name="onM_button_heading11" id="heading" value="<?php echo get_option('onM_button_heading11');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 1:</td>
								<td><textarea name="onM_buton_description11" id="onM_blog_description" rows="5" cols="80"><?php echo get_option('onM_buton_description11');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 2:</td>
								<td><input type="text" name="onM_button_heading21" id="heading" value="<?php echo get_option('onM_button_heading21');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 2:</td>
								<td><textarea name="onM_buton_description21" id="blog_description" rows="5" cols="80"><?php echo get_option('onM_buton_description21');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 3:</td>
								<td><input type="text" name="onM_button_heading31" id="heading" value="<?php echo get_option('onM_button_heading31');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 3:</td>
								<td><textarea name="onM_buton_description31" id="blog_description" rows="5" cols="80"><?php echo get_option('onM_buton_description31');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 4:</td>
								<td><input type="text" name="onM_button_heading41" id="heading" value="<?php echo get_option('onM_button_heading41');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 4:</td>
								<td><textarea name="onM_buton_description41" id="blog_description" rows="5" cols="80"><?php echo get_option('onM_buton_description41');?></textarea></td>
								</tr>
								
								
								<tr>
								<td>Button Heading 5:</td>
								<td><input type="text" name="onM_button_heading51" id="heading" value="<?php echo get_option('onM_button_heading51');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 5:</td>
								<td><textarea name="onM_buton_description51" id="blog_description" rows="5" cols="80"><?php echo get_option('onM_buton_description51');?></textarea></td>
								</tr>
					</table>
					<br/>
					<input type="submit" value="Save" name="submit" class="button-primary"/>
			</form>
		</div>
	<?php
	}
	/*
	 Author :	Swapnil Bansal
	 Desc 	:	Code to make social media dynamic.
	 Date 	:	4th Dec 2012	 
	*/
	function social_media_fun() {
	global $wpdb;
		if($_POST['submit']=='Save' ){
			/* Code for below slider content */
				update_option('slider_heading',$_POST['slider_heading']);
				update_option('slider_subheading',$_POST['slider_subheading']);
				update_option('slider_description',$_POST['slider_description']);
			/* End Code for below slider content */
				
			$slider_img       = $_FILES['slide_image']['name']; 
			$target_file      = get_template_directory()."/images/";
			$target_path      = $target_file."".basename( $_FILES['slide_image']['name']);
			if(move_uploaded_file($_FILES['slide_image']['tmp_name'],$target_path))
			{ 
				update_option('slider_image',$slider_img);               
			}
			
			
			/*====2nd block===*/
				update_option('blog_heading',$_POST['blog_heading']);
				update_option('blog_description',$_POST['blog_description']);
			
			$blog_image       = $_FILES['blog_image']['name']; 
			$target_file      = get_template_directory()."/images/";
			$target_path      = $target_file."".basename( $_FILES['blog_image']['name']);
			if(move_uploaded_file($_FILES['blog_image']['tmp_name'],$target_path))
			{ 
				update_option('blog_image',$blog_image);               
			}
			/*====2nd block===*/
			
			/*====5 boxes ===*/
				update_option('title_but',$_POST['button_title']);
				update_option('sub_title_but',$_POST['buton_sub_title']);
				update_option('button_heading1',$_POST['button_heading1']);
				update_option('buton_description1',$_POST['buton_description1']);
				update_option('button_heading2',$_POST['button_heading2']);
				update_option('buton_description2',$_POST['buton_description2']);
				update_option('button_heading3',$_POST['button_heading3']);
				update_option('buton_description3',$_POST['buton_description3']);
				update_option('button_heading4',$_POST['button_heading4']);
				update_option('buton_description4',$_POST['buton_description4']);
				update_option('button_heading5',$_POST['button_heading5']);
				update_option('buton_description5',$_POST['buton_description5']);
			/*====5 boxes ===*/	
				
				/*====Portfolio ===*/
				update_option('portfolio_heading',$_POST['pt_heading']);
				update_option('portfolio_subheading',$_POST['pt_subheading']);
		} 
	
	?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Social Media</h2>
			<br/>
			&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="update-nag" align="left"><strong>Slider</strong></div><br/>
						<!--Change logo here -->
				<table class="widefat">
					<tbody>
						<tr>
							<td>Slider Image:</td>
							<td><input type="file" name="slide_image" id="slide_image"/>
							<img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('slider_image',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading:</td>
							<td><input type="text" name="slider_heading" id="heading" value="<?php echo get_option('slider_heading');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Sub-Heading:</td>
							<td><input type="text" name="slider_subheading" id="subheading" value="<?php echo get_option('slider_subheading');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description:</td>
							<td><textarea name="slider_description" id="slider_description" rows="5" cols="80"><?php echo get_option('slider_description');?></textarea></td>
						</tr>
					</tbody>
				</table>
					<br />
					<div class="update-nag" align="left"><strong>Second Block Content</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
							<tr>
								<td> Image:</td>
								<td><input type="file" name="blog_image" id="blog_image"/>
								<img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('blog_image',true); ?>" height="80" border="0"/></td>
								</tr>
								
								<tr>
								<td> Heading:</td>
								<td><input type="text" name="blog_heading" id="heading" value="<?php echo get_option('blog_heading');?>" size="83"></td>
								</tr>
													
								<tr>
								<td> Description:</td>
								<td><textarea name="blog_description" id="blog_description" rows="5" cols="80"><?php echo get_option('blog_description');?></textarea></td>
							</tr>
						</tbody>
					</table>
					<br/>
					<div class="update-nag" align="left"><strong>Five Boxes</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>
								<tr>
								<td>Title:</td>
								<td><input type="text" name="button_title" id="heading" value="<?php echo get_option('title_but');?>" size="83"></td>
								</tr>
								<tr>
								<td>Sub Title:</td>
								<td><input type="text" name="buton_sub_title" id="heading" value="<?php echo get_option('sub_title_but');?>" size="83"></td>
								</tr>
								
								<tr>
								<td>Button Heading 1:</td>
								<td><input type="text" name="button_heading1" id="heading" value="<?php echo get_option('button_heading1');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 1:</td>
								<td><textarea name="buton_description1" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description1');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 2:</td>
								<td><input type="text" name="button_heading2" id="heading" value="<?php echo get_option('button_heading2');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 2:</td>
								<td><textarea name="buton_description2" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description2');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 3:</td>
								<td><input type="text" name="button_heading3" id="heading" value="<?php echo get_option('button_heading3');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 3:</td>
								<td><textarea name="buton_description3" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description3');?></textarea></td>
								</tr>
								
								<tr>
								<td>Button Heading 4:</td>
								<td><input type="text" name="button_heading4" id="heading" value="<?php echo get_option('button_heading4');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 4:</td>
								<td><textarea name="buton_description4" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description4');?></textarea></td>
								</tr>
								
								
								<tr>
								<td>Button Heading 5:</td>
								<td><input type="text" name="button_heading5" id="heading" value="<?php echo get_option('button_heading5');?>" size="83"></td>
								</tr>
													
								<tr>
								<td>Button Description 5:</td>
								<td><textarea name="buton_description5" id="blog_description" rows="5" cols="80"><?php echo get_option('buton_description5');?></textarea></td>
								</tr>
					</table>
					<br/>
					<div class="update-nag" align="left"><strong>PortFolio</strong></div><br/>
						<!--Change logo here -->
					<table class="widefat">
						<tbody>				
								<tr>
									<td>Portfolio Heading:</td>
									<td><input type="text"  name="pt_heading" id="ptheading" size="83" value="<?php echo get_option('portfolio_heading');?>"></td>
								</tr>													
								<tr>
									<td>Portfolio Sub-heading:</td>
									<td><input type="text"  name="pt_subheading" id="ptheading" size="83" value="<?php echo get_option('portfolio_subheading');?>"></td>
							</tr>
							<tr>
								<td><input type="submit" name="submit" value="Save"></td>
							</tr>
						</tbody>
					</table>
					<br/>
			</form>
		</div>
	<?php
	}
	
	function how_we_work_fun(){
			global $wpdb;
			if($_POST['submit']=='Save' ){
				/*====1st block===*/
				update_option('hw_heading1',$_POST['hslider_head1']);
				update_option('hw_description1',$_POST['hslider_descrip1']);
				
				
				$image1       	  = $_FILES['slide_img1']['name']; 
				$target_file1      = get_template_directory()."/images/";
				$target_path1      = $target_file1."".basename( $_FILES['slide_img1']['name']);
				
				if(move_uploaded_file($_FILES['slide_img1']['tmp_name'],$target_path1))
				{ 
					update_option('hw_image1',$image1);
				}
				/*====1st block===*/
				/*====2nd block===*/
				update_option('hw_heading2',$_POST['hslider_head2']);
				update_option('hw_description2',$_POST['hslider_descrip2']);
				
				$image2      	  = $_FILES['slide_img2']['name']; 
				$target_file2      = get_template_directory()."/images/";
				$target_path2      = $target_file2."".basename( $_FILES['slide_img2']['name']);
				if(move_uploaded_file($_FILES['slide_img2']['tmp_name'],$target_path2))
				{ 
					update_option('hw_image2',$image2);               
				}
				/*====2nd block===*/
				/*====3rd block===*/
				update_option('hw_heading3',$_POST['hslider_head3']);
				update_option('hw_description3',$_POST['hslider_descrip3']);
				
				$image3       = $_FILES['slide_img3']['name']; 
				$target_file3      = get_template_directory()."/images/";
				$target_path3      = $target_file3."".basename( $_FILES['slide_img3']['name']);
				if(move_uploaded_file($_FILES['slide_img3']['tmp_name'],$target_path3))
				{ 
					update_option('hw_image3',$image3);               
				}
				/*====3rd block===*/
				/*====4th block===*/
				update_option('hw_heading4',$_POST['hslider_head4']);
				update_option('hw_description4',$_POST['hslider_descrip4']);
				
				 $image4       = $_FILES['slide_img4']['name']; 
				$target_file4      = get_template_directory()."/images/";
				$target_path4      = $target_file4."".basename( $_FILES['slide_img4']['name']);
				if(move_uploaded_file($_FILES['slide_img4']['tmp_name'],$target_path4))
				{ 
					update_option('hw_image4',$image4);               
				}
				/*====4th block===*/
				/*====5th block===*/
				update_option('hw_heading5',$_POST['hslider_head5']);
				update_option('hw_description5',$_POST['hslider_descrip5']);
				
				$image5       = $_FILES['slide_img5']['name']; 
				$target_file5      = get_template_directory()."/images/";
				$target_path5      = $target_file5."".basename( $_FILES['slide_img5']['name']);
				if(move_uploaded_file($_FILES['slide_img5']['tmp_name'],$target_path5))
				{ 
					update_option('hw_image5',$image5);               
				}
				/*====5th block===*/
				/*====6th block===*/
				update_option('hw_heading6',$_POST['hslider_head6']);
				update_option('hw_description6',$_POST['hslider_descrip6']);
				
				$image6       = $_FILES['slide_img6']['name']; 
				$target_file6      = get_template_directory()."/images/";
				$target_path6     = $target_file6."".basename( $_FILES['slide_img6']['name']);
				if(move_uploaded_file($_FILES['slide_img6']['tmp_name'],$target_path6))
				{ 
					update_option('hw_image6',$image6);               
				}
				/*====6th block===*/
				/*====7th block===*/
				update_option('hw_heading7',$_POST['hslider_head7']);
				update_option('hw_description7',$_POST['hslider_descrip7']);
				
				$image7       = $_FILES['slide_img7']['name']; 
				$target_file7      = get_template_directory()."/images/";
				$target_path7      = $target_file7."".basename( $_FILES['slide_img7']['name']);
				if(move_uploaded_file($_FILES['slide_img7']['tmp_name'],$target_path7))
				{ 
					update_option('hw_image7',$image7);               
				}
				/*====7th block===*/
				/*====8th block===*/
				update_option('hw_heading8',$_POST['hslider_head8']);
				update_option('hw_description8',$_POST['hslider_descrip8']);
				
				$image8       = $_FILES['slide_img8']['name']; 
				$target_file8      = get_template_directory()."/images/";
				$target_path8      = $target_file8."".basename( $_FILES['slide_img8']['name']);
				if(move_uploaded_file($_FILES['slide_img8']['tmp_name'],$target_path8))
				{ 
					update_option('hw_image8',$image8);               
				}
				/*====8th block===*/
				/*====9th block===*/
				update_option('hw_heading9',$_POST['hslider_head9']);
				update_option('hw_description9',$_POST['hslider_descrip9']);
				
				$image9       = $_FILES['slide_img9']['name']; 
				$target_file9      = get_template_directory()."/images/";
				$target_path9      = $target_file9."".basename( $_FILES['slide_img9']['name']);
				if(move_uploaded_file($_FILES['slide_img9']['tmp_name'],$target_path9))
				{ 
					update_option('hw_image9',$image9);               
				}
				/*====9th block===*/
			}
	?>
	<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>How We Work</h2>
			<br/>
			&nbsp;
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="update-nag" align="left"><strong>Slider</strong></div><br/>
						
				<table class="widefat">
					<tbody>
						<tr>
							<td>Slider Image 1:</td>
							<td><input type="file" name="slide_img1" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image1',true); ?>" height="80" width="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 1:</td>
							<td><input type="text" name="hslider_head1" id="heading" value="<?php echo get_option('hw_heading1');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 1:</td>
							<td><textarea name="hslider_descrip1" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description1');?></textarea></td>
						</tr>
												<tr>
							<td>Slider Image 2:</td>
							<td><input type="file" name="slide_img2" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image2',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 2:</td>
							<td><input type="text" name="hslider_head2" id="heading" value="<?php echo get_option('hw_heading2');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 2:</td>
							<td><textarea name="hslider_descrip2" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description2');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 3:</td>
							<td><input type="file" name="slide_img3" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image3',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 3:</td>
							<td><input type="text" name="hslider_head3" id="heading" value="<?php echo get_option('hw_heading3');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 3:</td>
							<td><textarea name="hslider_descrip3" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description3');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 4:</td>
							<td><input type="file" name="slide_img4" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image4',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 4:</td>
							<td><input type="text" name="hslider_head4" id="heading" value="<?php echo get_option('hw_heading4');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 4:</td>
							<td><textarea name="hslider_descrip4" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description4');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 5:</td>
							<td><input type="file" name="slide_img5" id="slide_image"/>
							<img  style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image5',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 5:</td>
							<td><input type="text" name="hslider_head5" id="heading" value="<?php echo get_option('hw_heading5');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 5:</td>
							<td><textarea name="hslider_descrip5" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description5');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 6:</td>
							<td><input type="file" name="slide_img6" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image6',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 6:</td>
							<td><input type="text" name="hslider_head6" id="heading" value="<?php echo get_option('hw_heading6');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 6:</td>
							<td><textarea name="hslider_descrip6" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description6');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 7:</td>
							<td><input type="file" name="slide_img7" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image7',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 7:</td>
							<td><input type="text" name="hslider_head7" id="heading" value="<?php echo get_option('hw_heading7');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 7:</td>
							<td><textarea name="hslider_descrip7" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description7');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 8:</td>
							<td><input type="file" name="slide_img8" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image8',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 8:</td>
							<td><input type="text" name="hslider_head8" id="heading" value="<?php echo get_option('hw_heading8');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 8:</td>
							<td><textarea name="hslider_descrip8" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description8');?></textarea></td>
						</tr>
						
						<tr>
							<td>Slider Image 9:</td>
							<td><input type="file" name="slide_img9" id="slide_image"/>
							<img style="background:#000" src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image9',true); ?>" height="80" border="0"/></td>
						</tr>
						<tr>
							<td>Slider Heading 9:</td>
							<td><input type="text" name="hslider_head9" id="heading" value="<?php echo get_option('hw_heading9');?>" size="83"></td>
						</tr>
						<tr>
							<td>Slider Description 9:</td>
							<td><textarea name="hslider_descrip9" id="slider_description" rows="5" cols="80"><?php echo get_option('hw_description9');?></textarea></td>
						</tr>
						
						<tr>
								<td><input type="submit" name="submit" value="Save"></td>
						</tr>
					</tbody>
				</table>
					<br />
			</form>
	</div>
	<?php }
	/* End Code to make the sergio theme Dynamic */
	
	// Add to the init hook of your theme functions.php file
	add_filter('request', 'se_expanded_request');

		function se_expanded_request($q) {
		if (isset($q['tag']) || isset($q['category_name']))
		$q['post_type'] = array('post', 'portfolio');
		return $q;
		}

	