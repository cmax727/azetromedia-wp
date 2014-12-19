<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$ttPath = bloginfo('template_directory');
//echo $tmpPath; exit;
$post = $wp_query->post;
//var_dump($post);exit;

get_header(); 

?>

<script type="text/javascript">
$(function() {
 $('.slider-continer').cycle({
  fx: 'scrollHorz',		
		speed:  900, 
		timeout: 1500, 
  prev: '.slideshow_prev',
  next: '.slideshow_next',
		cleartype:false
								 });
				$('.protfolio-slider').mouseenter(function(){
		$('.slider-continer').cycle('pause');
		
    }).mouseleave(function(){
		$('.slider-continer').cycle('resume');

    });					
									
									
   	});
</script>

<!--CONTENT_PNL-->
<section class="content-pnl">
  <div class="menu-way-point"></div>
  <div class="center-align">
   <div class="inner-banner m-none">
   <div class="protfolio-slider">
   <div class="slider-controls">
   <a href="#" class="slideshow_prev"></a>
    <a href="#" class="slideshow_next"></a>
   </div>
   		<div class="slider-continer" style="position: relative; overflow: hidden;">
     <div class="slider-item" style="position: absolute; top: 35px; left: 38px; display: block; z-index: 3; opacity: 1; width: 614px; height: 385px;"><img src="<?php echo bloginfo('template_directory')?>/images/protfolio-slid-one.png" alt=""></div>
     <div class="slider-item" style="position: absolute; top: 0px; left: -614px; display: none; z-index: 2; opacity: 1; width: 614px; height: 385px;"><img src="<?php echo bloginfo('template_directory')?>/images/protfolio-slid-two.png" alt=""></div>
     </div>
   </div>
   </div>
  </div>
 </section>
 <!--CONTENT_PNL_END-->

<section class="midd-pnl">
  <div class="center-align">
   <article class="wrp">
  <hgroup>
     <h1><?php echo $post->post_title; ?></h1>
     <?php $subtitle = get_post_meta($post->ID, 'subtitle', $single = true);
	if($subtitle == '') $subtitle="Deliverables — Art Direction / Design / Interaction Design"; ?>

	<h3><?php echo $subtitle ?></h3>
    </hgroup>
    <p class="gray-color text-align-center">
	<?php echo $post->post_content; ?>
	</p>
   </article>
  </div>
 </section>

<!--CONTENT_PNL -2222 -->
 <section class="row-two">
  <div class="center-align">
   <div class="wrp ">
    <hgroup>
     <h1>SERVICES PROVIDED</h1>
     <h3>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem</h3>
    </hgroup>
    
    <div class="portfolio-services wrp" id="tabs">
    
    <div class="left">
    	<ul class="nav">
     		<li><a href="#tab-one" class="current"><img src="<?php bloginfo('template_directory'); ?>/images/logo-design.png" alt=""> <span class="arrow"></span></a></li>
       <li><a href="#tab-two"><img src="<?php bloginfo('template_directory'); ?>/images/word-press.png" alt=""> <span class="arrow"></span></a></li>
       <li><a href="#tab-three"><img src="<?php bloginfo('template_directory'); ?>/images/moneter-2.png" alt=""> <span class="arrow"></span></a></li>

     </ul>
    </div>
     <div class="right">
     <div class="white-panel">
     <div class="wrp m-none" id="tab-one">
     <h1>Logo Design</h1>
     <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.</p>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.
</p>
     </div>
     
     <div class="wrp m-none hide" id="tab-two" style="position: relative; top: 0px; left: 0px; display: none;">
     <h1>Logo Design</h1>
     <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.</p>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.
</p>
     </div>
     
     <div class="wrp m-none hide" id="tab-three" style="position: relative; top: 0px; left: 0px; display: none;">
     <h1>Logo Design</h1>
     <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.</p>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit.
</p>
     </div>
     </div>
     
     
     <div class="white-panel push-40">
     <div class="testmonial">
     <p>Sed massa dolor, feugiat nec pharetra sit amet, iaculis sed velit. Pellentesque malesuada suscipit neque non porta.Sed massa dolor, feugiat nec pharetra sit amet, iaculis sed velit. Pellentesque malesuada suscipit neque non porta.</p>
    <p class="author"> Mac Millan<br>
<span>Creative Commercials</span></p>
<h1>Testimonial</h1>
     </div>
     </div>
     </div>
    
    </div>
    
   </div>
  
  </div>
 </section>


<?php get_footer(); ?>