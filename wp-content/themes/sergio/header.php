<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<meta name="description" content="Place your description here">
<meta name="keywords" content="put, your, keyword, here">
<link  rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css" >
<link href="<?php bloginfo('template_url'); ?>/fonts/stylesheet.css" rel="stylesheet" >
<link  rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/banenr.css" >
<link  rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/html-5.css" >
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.7.2.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.scrollorama.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/waypoints.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.cycle.all.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
<!-- <script src="<?php bloginfo('template_url'); ?>/js/libs/jquery.easing.1.3.min.js"></script> -->
<script src="<?php bloginfo('template_url'); ?>/js/mylibs/royal-slider-1.0.min.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/jsCarousel-2.0.0.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/organictabs.jquery.js"></script> 
<script src="<?php bloginfo('template_url'); ?>/js/gallery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox-1.3.4.pack.js"></script> 
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script> 
<![endif]-->
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->
<script type="text/javascript">
$(function(){
$('#menu li').hover(function(){
$('ul', this).slideDown()
},function(){
$('ul', this).slideUp()
})
})
</script>
<script type="text/javascript">
        $(function() {
                $("#tabs").organicTabs();  
        });
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $('#carouselhAuto').jsCarousel({autoscroll: true, masked: true, itemstodisplay: 4, orientation: 'h' });

        });       
</script>
<script type="text/javascript">
$(document).ready(function() {
	
    $.waypoints.settings.scrollThrottle = 25;
    $('.menu-way-point').waypoint(function(event, direction) {
								$('.menu-bar').toggleClass('all');
								 
    }, {
        offset: '10'
    });
});
</script>
<script type="text/javascript"> 
	$(document).ready(function() {
		$('#footer-menu1>li:first').addClass('hedding');
		$('#footer-menu2>li:first').addClass('hedding');
		$('#footer-menu3>li:first').addClass('hedding');
		$('#footer-menu4>li:first').addClass('hedding');
		$('#menu>li:first').addClass('active');
		$(".leftCnt article:odd").addClass("fr"); //for blog page
		$('#menu li').each(function(){
			if($(this).hasClass('current-menu-item'))
			{
				$('#menu>li:first').removeClass('active');
				$('.current-menu-item').addClass('active');
				$('.current-menu-parent').addClass('active');
			}
		});
		
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".all-pagination").show();
		$(".web-design-pagination").hide();
		$(".web-dev-pagination").hide();
		$(".identity-pagination").hide();
		$(".scl-mda-pagination").hide();
		$(".mrkt-pagination").hide();
		$(".all-port").live("click", function()
		{ 
			$(".all-pagination").show();
			$(".web-design-pagination").hide();
			$(".web-dev-pagination").hide();
			$(".identity-pagination").hide();
			$(".scl-mda-pagination").hide();
			$(".mrkt-pagination").hide();
		});	
		$(".wb-dsgn").live("click", function()
		{ 
			$(".all-pagination").hide();
			$(".web-design-pagination").show();
			$(".web-dev-pagination").hide();
			$(".identity-pagination").hide();
			$(".scl-mda-pagination").hide();
			$(".mrkt-pagination").hide();
		});	
		$(".wd-dev").live("click", function()
		{ 
			$(".all-pagination").hide();
			$(".web-design-pagination").hide();
			$(".web-dev-pagination").show();
			$(".identity-pagination").hide();
			$(".scl-mda-pagination").hide();
			$(".mrkt-pagination").hide();
		});	
		$(".idnty").live("click", function()
		{ 
			$(".all-pagination").hide();
			$(".web-design-pagination").hide();
			$(".web-dev-pagination").hide();
			$(".identity-pagination").show();
			$(".scl-mda-pagination").hide();
			$(".mrkt-pagination").hide();
		});	
		$(".scl-mdia").live("click", function()
		{ 
			$(".all-pagination").hide();
			$(".web-design-pagination").hide();
			$(".web-dev-pagination").hide();
			$(".identity-pagination").hide();
			$(".scl-mda-pagination").show();
			$(".mrkt-pagination").hide();
		});	
		$(".mrkt").live("click", function()
		{ 
			$(".all-pagination").hide();
			$(".web-design-pagination").hide();
			$(".web-dev-pagination").hide();
			$(".identity-pagination").hide();
			$(".scl-mda-pagination").hide();
			$(".mrkt-pagination").show();
		});	
	});
</script>
<script type="text/javascript">
 $('#slideshow_2').cycle({
        fx: 'scrollHorz',		
		speed:  900, 
		timeout: 5000, 
		
        prev: '.ss2_wrapper .slideshow_prev',
        next: '.ss2_wrapper .slideshow_next',
		before: function(currSlideElement, nextSlideElement) {
			var data = $('.data', $(nextSlideElement)).html();
			$('.ss2_wrapper .slideshow_box').stop(true, true).animate({ bottom:'-40%'}, 400, function(){
				$('.ss2_wrapper .slideshow_box .data').html(data);
			});
			$('.ss2_wrapper .slideshow_box').delay(100).animate({ bottom:'23%'}, 400);
		}
    });

	$('.ss2_wrapper').mouseenter(function(){
		$('#slideshow_2').cycle('pause');
		$('.ss2_wrapper .slideshow_prev').stop(true, true).animate({ left:'20px'}, 200);
		$('.ss2_wrapper .slideshow_next').stop(true, true).animate({ right:'20px'}, 200);
    }).mouseleave(function(){
		$('#slideshow_2').cycle('resume');
		$('.ss2_wrapper .slideshow_prev').stop(true, true).animate({ left:'-40px'}, 200);
		$('.ss2_wrapper .slideshow_next').stop(true, true).animate({ right:'-40px'}, 200);
    });
				
</script>
<script>	
		$(function(){var a=new RoyalSlider("#banner",{slideTransitionSpeed:1200,slideTransitionEasing:"easeInOutCubic",captionShowEffects:["moveleft","fade"],captionShowDelay:300,captionShowSpeed:700,captionShowEasing:"easeOutBack",directionNavEnabled:false,controlNavEnabled:false,slideshowEnabled:true,slideshowDelay:5000,slideshowPauseOnHover:false});$("#toogleSlideshow1").click(function(e){e.preventDefault();if(a.isSlideshowRunning){a.stopSlideshow()}else{a.resumeSlideshow()}})});	
</script>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- <link rel="stylesheet" type="text/css" media="all" href="<?php //bloginfo( 'stylesheet_url' ); ?>" /> -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper"> 
 <!--TOP_PNL-->
 <section class="top-pnl" id="top-menu">
  <div class="cnt">
   <div class="menu-bar"></div>
   <div class="center-align"><a href="<?php bloginfo('home'); ?>" id="logo"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('sergio_logo_image',true); ?>" alt="Sergio" /></a>
    <nav class="mani-nav">
    <!-- <ul id="menu">
      <li class="active"><a href="media-services.html"><span></span>Social Media</a>
       <ul class="subNav">
        <li><a href="#">FACEBOOK APPLICATION</a></li>
        <li><a href="#">FACEBOOK PAGES</a></li>
        <li><a href="#">FACEBOOK CONTENT</a></li>
       </ul>
      </li>
      <li><a href="#"><span></span>Web Solutions</a>
       <ul class="subNav">
        <li><a href="#">FACEBOOK APPLICATION</a></li>
        <li><a href="#">FACEBOOK PAGES</a></li>
        <li><a href="#">FACEBOOK CONTENT</a></li>
       </ul>
      </li>
      <li><a href="#"><span></span>Marketing</a></li>
      <li><a href="how-it-work.html"><span></span>How We Work</a></li>
      <li><a href="portfolio.html"><span></span>Our Works</a></li>
      <li><a href="blog.html"><span></span>Blog</a></li>
     </ul> -->
	 <?php wp_nav_menu(array('menu' =>'Main Menu', 'container_class'=> 'ser-dropdown','items_wrap' => '<ul id="menu">%3$s</ul>')); ?>
    </nav>
   </div>
  </div>
 </section>
 <!--TOP_PNL_END--> 
