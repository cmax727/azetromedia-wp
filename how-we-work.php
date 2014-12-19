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

<?php
?>
<style>
.data .center-align{
	width:964px;
}
.how-it-work-pnl {
width: 100%;
height: 850px;
float: left;
	position: relative;
}
.htw-foot{
	
}
</style>
 <div class="how-it-work-pnl">
  <div class="ss2_wrapper"> <a href="#" class="slideshow_prev"><span>Previous</span></a> <a href="#" class="slideshow_next"><span>Next</span></a>
   <div class="slideshow_paging"></div>
   <div class="slideshow_box">
    <div class="data"></div>
   </div>
   <div id="slideshow_2" class="slideshow">
    <div class="slideshow_item">
     <!-- div class="slide-one"></div -->
	 <div class="slide-one"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image1',true); ?>" align="middle" alt=""></div>
     <div class="data">
	 <div class="center-align">
      <h1><?php echo get_option('hw_heading1');?></h1>
      <p><?php echo get_option('hw_description1');?></p>
     </div>
	 </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image2',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading2');?></h1>
       <p><?php echo get_option('hw_description2');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image3',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading3');?></h1>
       <p><?php echo get_option('hw_description3');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image4',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading4');?></h1>
       <p><?php echo get_option('hw_description4');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image5',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading5');?></h1>
       <p><?php echo get_option('hw_description5');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image6',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading6');?></h1>
       <p><?php echo get_option('hw_description6');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image7',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading7');?></h1>
       <p><?php echo get_option('hw_description7');?></p>
      </div>
     </div>
    </div>
    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image8',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading8');?></h1>
       <p><?php echo get_option('hw_description8');?> </p>
      </div>
     </div>
    </div>
<!--    <div class="slideshow_item">
     <div class="image"><img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_option('hw_image9',true); ?>" alt=""></div>
     <div class="data">
      <div class="center-align">
       <h1><?php echo get_option('hw_heading9');?></h1>
       <p><?php echo get_option('hw_description9');?> </p>
      </div>
     </div>
    </div> -->
   </div>
  </div>
 </div>
 <div class="htw-foot"> 
  <div class="menu-way-point"></div>
