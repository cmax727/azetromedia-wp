<?php
?>
 <!--CONTENT_PNL-->
 <section class="content-pnl">
  <div class="menu-way-point"></div>
  <div class="center-align" >
   <div class="blogCnt">
   
     <div class="inner-baner" style="text-align:center;margin: 20px 0 -23px 0;padding:0">
			<h1><?php echo get_option('blog_content'); ?></h1> 

	 </div>
  
	
	<section class="leftCnt">
	<?php	/*
	$all_blog = array(
						'posts_per_page'  => 4,
						'paged'			  => get_query_var('paged'),
						'post_type'       => 'post',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date',
						'category_name'	  => 'blog'
					); 
		$all_blogs	=	new WP_Query( $all_blog ); */
		?>
		<?php
			 global $all_blogs;
			 $paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
			 $args     = array( 'post_type' => 'post', 'posts_per_page' => 4,'category_name' => 'blog', 'paged' => $paged );
			 $all_blogs = new WP_Query($args); 
		?>	
	<?php if($all_blogs->have_posts()) :?>
	<?php while ( $all_blogs->have_posts() ) : $all_blogs->the_post(); ?>
     
	<article>
		<div class="cnt">
			<h1><?php $title = the_title(); 
			echo substr($title,0,25);?></h1>
			<figure><?php echo get_the_post_thumbnail( get_the_ID()); ?></figure>
			<p>
				<?php $cntnt	=	get_the_content();
					echo substr($cntnt,0,115);
				?>
			</p>
			<a href="<?php the_permalink(); ?>">Read More</a>
				<div class="socalNtw">
					<span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span><span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span><span class='st_fblike_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='fblike'></span>
					 <!--<div><a href="mailto:">email</a></div>-->
					 <!-- google -->
					<!--<div class="g-plusone" data-annotation="none"></div>
				
					<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>-->
				
					<!--<img src="<?php bloginfo('template_url'); ?>/images/blog-socialNtw.png" alt="">
					<div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
					<div class="g-plusone" href="<?php the_permalink() ?>" data-annotation="inline" data-width="300"></div>-->

				</div>
			<div class="date"><?php echo get_the_date('d');?><span> <?php echo get_the_date('M');?> </span> <?php echo get_the_date('Y');?></div>
		</div>
    </article>
	<?php endwhile; ?>
	<?php  endif; ?>
 <!-- page navi -->
			<div class="pagenavi">
			  <?php
			  global $all_blogs;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $all_blogs->max_num_pages
			  ) );
			  ?>
			</div>
        <!-- page navi end --> 
		

    </section>
	
	 
    <aside class="rightCnt">
     <article>
      <div class="cnt">
       <h3>SEARCH</h3>
       <div class="searchPnl">
		<!--	<form method="GET" id="searchform" action="<?php echo home_url( '/' ); ?>">  -->
				<input name="s" id="s" type="text" class="se-search-input" onfocus="if(this.value=='Search Here...') this.value='';" onblur="if(this.value=='') this.value='Search Here...';" value="Search Here..."  />
				<input name="search" type="button" value="search"  />
		  <!-- </form>  -->
       </div>
      </div>
     </article>
     <article>
      <div class="cnt">
       <h3>Recent Posts</h3>
	   
	   <?php	
	$all_blogs = array(
						'posts_per_page'  => 8,
						'post_type'       => 'post',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date',
						
					); 
		$all_blogs1	=	new WP_Query( $all_blogs );
		?>
       <ul class="recentPost">
	   <?php if($all_blogs1->have_posts()) :?>
	<?php while ( $all_blogs1->have_posts() ) : $all_blogs1->the_post(); ?>
	
	 <li> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	
	<?php endwhile; ?>
	<?php  endif; ?>
	  
       </ul>
      </div>
     </article>
     <article>
      <div class="cnt">
       <h3>Newsletter</h3>
       <p>Sed massa dolor, feugiat nec 
        pharetra sit amet, iaculis sed 
        velit. Pellentesque</p>
       <div class="searchPnl">
        <input type="text" value="">
        <input type="button" value="search"> 
       </div>
      </div>
     </article>
    </aside>
   </div>
  </div>
 </section>
 
 <div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

 	<script type="text/javascript">
					(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					})();
					</script>
