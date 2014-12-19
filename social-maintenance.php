<?php
global $post;	
?>
 <!--CONTENT_PNL-->
 <section class="content-pnl">
  <div class="menu-way-point"></div>
	<div class="center-align">
		<div class="inner-baner">
			<div class="in-ba-bg"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('slider_image',true); ?>" alt=""></div>
			<h1><?php echo get_option('slider_heading');?><br>
			 <small><?php echo get_option('slider_subheading');?></small></h1>
			<h3> <?php echo str_replace("\n","<br/>",get_option('slider_description'));?></h3>
		</div>
	</div>
 </section>
 <!--CONTENT_PNL_END-->
 
 <section class="midd-pnl">
  <div class="center-align">
   <article class="wrp me-midd">
    <div class="mm-left">
     <h3><?php echo $post->post_title; ?></h3>	 <?php		 $content = $post->post_content;		 $content = apply_filters('the_content', $content);		 $content = str_replace(']]>', ']]&gt;', $content);	?>		 <p><?php echo  $content; ?></p>
    
    </div>
    <div class="mm-right"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('blog_image',true); ?>" alt="" class=""></div>
   </article>
  </div>
 </section>
 <section class="row-one">
  <div class="center-align">
   <div class="wrp ">
    <hgroup>
	
     <h1><?php echo get_option('title_but_social_m');?></h1>
     <h3><?php echo get_option('sub_title_but_social_m');?></h3>
    </hgroup>
   </div>
   <div id="tabs" >
     <div class="wrp tabs">
	   <ul class="nav">
			<?php $content1 = get_option('button_heading_social_m1');
				$pos = strpos($content1," ",15); ?> 
		  <li class="one"><a href="#one" class="current"><?php if(strlen($content1) > 15) { echo substr(get_option('button_heading_social_m1'),0,$pos);?> ... <?php } else { echo get_option('button_heading_social_m1'); } ?></a></li>
			<?php $content2 = get_option('button_heading_social_m2');
				$pos = strpos($content2," ",10); ?> 
		  <li class="two"><a href="#two"><?php if(strlen($content1) > 15) { echo substr(get_option('button_heading_social_m2'),0,$pos);?> ... <?php } else { echo get_option('button_heading_social_m2'); } ?></a></li>
		   <?php $content3 = get_option('button_heading_social_m3');
				$pos = strpos($content3," ",15); ?> 
		  <li class="three"><a href="#three"><?php if(strlen($content3) > 15) { echo substr(get_option('button_heading_social_m3'),0,$pos);?> ... <?php } else { echo get_option('button_heading_social_m3'); } ?></a></li>
		   <?php $content4 = get_option('button_heading_social_m4');
				$pos = strpos($content4," ",15); ?> 	  
		  <li class="four"><a href="#four"><a href="#four"><?php if(strlen($content4) > 15) { echo substr(get_option('button_heading_social_m4'),0,$pos);?> ... <?php } else { echo get_option('button_heading_social_m4'); } ?></a></li>
			 <?php $content5 = get_option('button_heading_social_m5');
				$pos = strpos($content5," ",10); ?> 
		  <li class="five"><a href="#five"><?php if(strlen($content5) > 10) { echo substr(get_option('button_heading_social_m5'),0,$pos); 
		  ?> ... <?php } else { echo get_option('button_heading_social_m5'); 
		  } ?></a></li>
		 </ul>
		 <div class="tabs-Cnt" id="one">
		   <p class="sub-header-social"><?php echo get_option('button_heading_social_m1');?></p>
		  <p><?php echo get_option('buton_description_social_m1');?></p>
		 </div>
		 <div class="tabs-Cnt hide" id="two">
		  <p class="sub-header-social"><?php echo get_option('button_heading_social_m2');?></p>
		  <p><?php echo get_option('buton_description_social_m2');?></p>
		 </div>
		 <div class="tabs-Cnt hide" id="three">
		  <p class="sub-header-social"><?php echo get_option('button_heading_social_m3');?></p>
		  <p><?php echo get_option('buton_description_social_m3');?></p>
		 </div>
		 <div class="tabs-Cnt hide" id="four">
		  <p class="sub-header-social"><?php echo get_option('button_heading_social_m4');?></p>
		  <p><?php echo get_option('buton_description_social_m4');?></p>
		 </div>
		 <div class="tabs-Cnt hide" id="five">
		  <p class="sub-header-social"><?php echo get_option('button_heading_social_m5');?></p>
		  <p><?php echo get_option('buton_description_social_m5');?></p>
		 </div>
    </div>
   </div>
   <div class="wrp ">
    <hgroup>
     <h1><?php echo get_option('portfolio_heading');?></h1>
     <h3><?php echo get_option('portfolio_subheading');?></h3>
    </hgroup>
   </div>
   <?php 
		$all_port = array(
						'posts_per_page'  => 6,
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$all_portfolios	=	new WP_Query( $all_port );
		?>
	<ul class="gallary">
	<!-- Start code to display all portfolios -->
	<?php if($all_portfolios->have_posts()) :?>
	<?php while ( $all_portfolios->have_posts() ) : $all_portfolios->the_post(); ?>
		<li>
			<div class="gl-cnt"><?php echo get_the_post_thumbnail( get_the_ID()); ?> 
				<div class="mask">
				<h3><?php the_title(); ?></h3>
					<p>
						<?php $cntnt	=	get_the_content();
							echo substr($cntnt,0,50);
						?>
					</p>
				<p class="caption"> 
					<?php $cat	=	get_the_category(); 
							$cats = "";
							foreach($cat as $c)
							{
								$cats	.=	$c->cat_name .",";
							}
						echo substr($cats, 0, -1);
						echo "<br />".get_the_date('Y');
					?>
				</p>
				<a href="<?php the_permalink(); ?>"></a> </div>
			</div>
		</li>
	<?php endwhile; ?>
	<?php  endif; ?>
	</ul>
  </div>
 </section>
 