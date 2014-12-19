<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
	 
 <!--CONTENT_PNL-->
 
<section class="content-pnl">
  <div class="menu-way-point"></div>
  <!--BANNER-->
	<div class="slider-continer">
		<div id="banner" class="royalSlider">
			<ul class="royalSlidesContainer" >
				<li class="royalSlide">
					<div class="center-align">
						<div class="royalCaption">
							<div class="royalCaptionItem bnIcons" data-show-effect="moveleft fade" data-move-offset="193"> <a href="#"><span class="one"></span></a> <a href="#"><span class="two"></span></a> <a href="#"><span class="three"></span></a> 
							</div>
							<div class="royalCaptionItem elTwo" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200"> we are aztro<br>
							 media</div>
							<div class="royalCaptionItem elThree" data-easing="easeOutElastic" data-show-effect="moveright fade" data-move-offset="-300">consectetur adipiscing elit</div>
							<a href="#" class="royalCaptionItem elFour" data-show-effect="movetop" data-easing="easeOutBounce" data-move-offset="700" data-speed="200" data-delay="400"> <span>DEMO</span> REEL</a> 
						</div>
					</div>
				</li>
				<li class="royalSlide">
				  <div class="center-align">
				   <div class="royalCaption">
					<div class="royalCaptionItem b2-elOne" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200" data-delay="400"> WEB Design &amp; <br>
					 Development </div>
					<div class="royalCaptionItem slidTwo" data-show-effect="movebottom" data-easing="easeOutBounce" data-move-offset="200" data-speed="200" data-delay="400"></div>
					<div class="royalCaptionItem b2-elTwo" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200"> Web products built 
					 to scale and 
					 withstand the
					 test of time.</div>
				   </div>
				  </div>	
				</li>
				<li class="royalSlide">
				  <div class="center-align">
				   <div class="royalCaption">
					<div class="royalCaptionItem bnIcons" data-show-effect="moveleft fade" data-move-offset="193"> <a href="#"><span class="one"></span></a> <a href="#"><span class="two"></span></a> <a href="#"><span class="three"></span></a> </div>
					<div class="royalCaptionItem elTwo" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200"> we are aztro<br>
					 media</div>
					<div class="royalCaptionItem elThree" data-easing="easeOutElastic" data-show-effect="moveright fade" data-move-offset="-300">consectetur adipiscing elit</div>
					<div class="royalCaptionItem elFour" data-show-effect="movetop" data-easing="easeOutBounce" data-move-offset="700" data-speed="200" data-delay="400"><span>DEMO</span> REEL</div>
				   </div>
				  </div>
				</li>
				<li class="royalSlide">
				  <div class="center-align">
				   <div class="royalCaption">
					<div class="royalCaptionItem b2-elOne" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200" data-delay="400"> WEB Design &amp; <br>
					 Development </div>
					<div class="royalCaptionItem slidTwo" data-show-effect="movebottom" data-easing="easeOutBounce" data-move-offset="200" data-speed="200" data-delay="400"></div>
					<div class="royalCaptionItem b2-elTwo" data-easing="easeOutSine" data-show-effect="moveright fade" data-move-offset="200"> Web products built 
					 to scale and 
					 withstand the
					 test of time.</div>
				   </div>
				  </div>
				</li>
			</ul>
		</div>
	</div>
<script>	
	 	$(function(){var a=new RoyalSlider("#banner",{slideTransitionSpeed:1200,slideTransitionEasing:"easeInOutCubic",captionShowEffects:["moveleft","fade"],captionShowDelay:300,captionShowSpeed:700,captionShowEasing:"easeOutBack",directionNavEnabled:false,controlNavEnabled:false,slideshowEnabled:true,slideshowDelay:5000,slideshowPauseOnHover:false});$("#toogleSlideshow1").click(function(e){e.preventDefault();if(a.isSlideshowRunning){a.stopSlideshow()}else{a.resumeSlideshow()}})});	 
</script>  
  <!--THUMB-SCROLL-->
  <?php
		$all_arg = array(
						'posts_per_page'  => 8,
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date',
						'order'		  	  => 'DESC'
					); 
		$home_portfolios	=	new WP_Query( $all_arg );
  ?>
	<section class="product-scroll">
   <div class="cnt">
		<div class="center-align2">
		 <div class="ps-pnal">
		  <div class="ps-wrp">
		   <div id="hWrapperAuto">
			<div id="carouselhAuto">
			<?php if($home_portfolios->have_posts()) :?>
				<?php while ( $home_portfolios->have_posts() ) : $home_portfolios->the_post(); ?>
					<div><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID()); ?></a></div>
				<?php endwhile; ?>
			<?php  endif; ?>
			</div>
		   </div>
		  </div>
		 </div>
		</div>
	   </div>
	</section>
  
  <!--SERVICES-->
	<section class="pnal-one">
		<div class="center-align">
			<div class="wrp services">
				<div class="clm">
				<?php 	$ID_1	=	get_option('page_below_slider_1',true);
						$page_1	=	get_page($ID_1);
				?>
				  <h1><?php echo $page_1->post_title; ?></h1>
				  <?php echo get_the_post_thumbnail( $page_1->ID); ?> 
				  <?php  $content1 = $page_1->post_content;
				$pos = strpos($content1, ' ',100); ?>
				 <p><?php echo substr($content1,0,$pos); ?> <a href="<?php echo get_site_url(); ?>/social-media/"><font  style="color: #5A5A5A;">Read more...</font></a></p>
				</div>
				<div class="clm">
				<?php 	$ID_2	=	get_option('page_below_slider_2',true);
						$page_2	=	get_page($ID_2);
				?>
				  <h1><?php echo $page_2->post_title; ?></h1>
				  <?php echo get_the_post_thumbnail( $page_2->ID); ?> 
				  <p><?php
					$content2 = $page_2->post_content;
					$pos = strpos($content2, ' ',80); ?>
					<?php echo substr($content2,0,$pos); ?> <a href="<?php echo get_site_url(); ?>/web-solutions/"><font  style="color: #5A5A5A;">Read more...</font></a></p>
				 </div>
				<div class="clm">
				<?php 	$ID_3	=	get_option('page_below_slider_3',true);
						$page_3	=	get_page($ID_3);
				?>
				  <h1><?php echo $page_3->post_title; ?></h1>
				  <?php echo get_the_post_thumbnail( $page_3->ID); ?> 
				  <p><?php
					$content3 = $page_3->post_content;
					$pos = strpos($content3, ' ',90); ?>
					<?php echo substr($content3,0,$pos); ?> <a href="<?php echo get_site_url(); ?>/marketing/"><font  style="color: #5A5A5A;">Read more...</font></a></p>
				</div>
			</div>
		</div>
	</section>
</section>
<section class="row-one">
	<div class="center-align">
		<div class="wrp footCnt">
		 <div class="clm">
		  <h1><?php echo get_option('contact_heading');?><br>
		   <small><?php echo get_option('contact_sub_heading');?></small></h1>
		  <p><img src="<?php bloginfo('template_url'); ?>/images/land-mark.png" alt=""><?php echo str_replace("\n","<br />",get_option('contact_address'));?></p>
		  <span><small>Call Us</small><br>
		  <?php echo get_option('contact_number');?></span> <span class="e-mail">e-mail:<a href="mailto:<?php echo get_option('contact_email');?>"><?php echo get_option('contact_email');?></a></span> </div>
		 <div class="clm">
			<?php 	$tstmonl	=	get_option('testimonial_page',true);
					$testimonial	=	get_page($tstmonl);
			?>
		  <h1><?php echo $testimonial->post_title; ?><br>
		   <small><?php $ts_sb_hd	=	get_post_custom_values('Sub Heading', $testimonial->ID); echo $ts_sb_hd[0];?></small></h1>
		  <div class="testmonial">
		  <p><?php echo str_replace("\n","<br />",substr($testimonial->post_content,0,110));?></p>
		  <p class="tst-au"><?php $ts_author	=	get_post_custom_values('Testimonial Author', $testimonial->ID); echo $ts_author[0];?><br>
		   <small><?php $ts_lis	=	get_post_custom_values('Liscence', $testimonial->ID); echo $ts_lis[0];?></small></p>
		  </div> </div>
		 <div class="clm">
			<?php 	$about		=	get_option('about_us_page',true);
					$about_us	=	get_page($about);
					
			?>
		  <h1><?php echo $about_us->post_title; ?><br>
		   <small><?php $ab_sb_hd	=	get_post_custom_values('Sub Heading', $about_us->ID,'string'); $postData = $ab_sb_hd[0];
		   if( strlen($postData) > 260) {
								$pos = strpos($postData, ' ',254);
								echo substr($postData,0,$pos);
							}
							else {
								echo $postData;
							}  ?>
				<a href="<?php echo get_site_url(); ?>/more-about-us/"><font  style="color: #5A5A5A;">Read more...</font></a>
		   </small></h1> 
		   <p><?php  // echo str_replace("\n","<br />",substr($about_us->post_content,0,200)); ?> </p>
		 </div>
		</div>
	</div>
</section>
 <!--CONTENT_PNL_END--> 
<?php //get_sidebar(); ?>
<?php get_footer(); ?>