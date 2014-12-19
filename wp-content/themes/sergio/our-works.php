<?php
?>
 
 <!--CONTENT_PNL-->
 <section class="content-pnl">
  <div class="menu-way-point"></div>
  <div class="center-align">
   <div class="inner-baner ourWorks">
    <h1>OUR RECENT WORK</h1>
    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eSed ut perspiciatis unde omnis iste natus error sit 
     voluptatem accusantiu doloremque laudantium, totam rem aperiam.</p>
   </div>
  </div>
  <div class="protfilioNav">
   <div class="center-align">
    <ul class="menu">
     <li class="selected"><a class="all-port" title="all">All</a></li>
     <li><a class="wb-dsgn" title="wb">WEB DESIGN</a></li>
     <li><a class="wd-dev" title="wd">WEB DEVELOPMENT</a></li>
     <li><a class="idnty" title="idt">IDENTITY</a></li>
     <li><a class="scl-mdia" title="sm">SOCIAL MEDIA</a></li>
     <li><a class="mrkt" title="mt">MARKETING</a></li>
    </ul>
   </div>
  </div>
 </section>
 <!--CONTENT_PNL_END-->
<?php 	
		$WEB_DESIGN_ID		=	get_cat_ID('WEB DESIGN');
		$WEB_DEVELOPMENT_ID	=	get_cat_ID('WEB DEVELOPMENT');
		$SOCIAL_MEDIA_ID	=	get_cat_ID('SOCIAL MEDIA');
		$IDENTITY_ID		=	get_cat_ID('IDENTITY');
		$MARKETING_ID		=	get_cat_ID('MARKETING');
		$num=9;
		$all_port_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		
		$all_portfolios	=	new WP_Query( $all_port_args );
		/* Code to get portfolio for Web Design category */
		$web_dsgn_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'category_name'	  => 'web-design',
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$web_design_portfolios	=	new WP_Query( $web_dsgn_args );
		/* Code to get portfolio for Web Design category */
		/* Code to get portfolio for Web Design category */
		$web_dev_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'category_name'	  => 'web-development',
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$web_development_portfolios	=	new WP_Query( $web_dev_args );
		/* Code to get portfolio for Web Design category */
		/* Code to get portfolio for Identity category */
		$web_idnt_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'category_name'	  => 'identity',
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$identity_portfolios	=	new WP_Query( $web_idnt_args );
		/* Code to get portfolio for Identity category */
		/* Code to get portfolio for Social Media category */
		$web_sm_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'category_name'	  => 'social-media',
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$social_media_portfolios	=	new WP_Query( $web_sm_args );
		/* Code to get portfolio for Social Media category */
		/* Code to get portfolio for Social Media category */
		$mrkt_args = array(
						'posts_per_page'  => 10,
						'paged'			  => get_query_var('paged'),
						'category_name'	  => 'marketing',
						'post_type'       => 'portfolio',
						'post_status'     => 'publish',
						'orderby'		  => 'post_date'
					); 
		$marketing_portfolios	=	new WP_Query( $mrkt_args );
		/* Code to get portfolio for Social Media category */
		
		
		
?>
 <section class="row-one">
  <div class="center-align">
   <div class="wb">
    <ul class="gallary item">
	<!-- Start code to display all portfolios -->
	<?php// if(($all_portfolios->have_posts())&& (!($web_design_portfolios->have_posts()))&& (!($web_development_portfolios->have_posts()))&& (!($marketing_portfolios->have_posts()))&& (!($social_media_portfolios->have_posts()))) :?>
	<?//$i=0;?>
	<?php //if($web_design_portfolios->have_posts()) :?>
	<?php //while ( $all_portfolios->have_posts() ) : $all_portfolios->the_post(); ?>
     <?php //$i++;
	// if($i<9){?> <!--
	 <li title="w">
      <div class="gl-cnt"><?php //echo get_the_post_thumbnail( get_the_ID()); ?> 
       <div class="mask">
        <h3><?php //the_title(); ?></h3>
			<p>
				<?php //$cntnt	=	get_the_content();
					//echo substr($cntnt,0,50);
				?>
			</p>
        <p class="caption"> 
			<?php /*$cat	=	get_the_category(); 
					$cats = "";
					foreach($cat as $c)
					{
						$cats	.=	$c->cat_name .",";
					}
				echo substr($cats, 0, -1);
				echo "<br />".get_the_date('Y');
				*/
			?>
		</p>
        <a href="<?php //the_permalink(); ?>"></a></div>
      </div>
     </li> -->
	<?php //}else{exit;}?>
	<?php //endwhile; ?>
	<?php  //endif; ?>
	<!-- End code to display all portfolios -->
	
	<!-- Start code to display web Design portfolios -->
	<?php if($web_design_portfolios->have_posts()) :?>
	<?php while ( $web_design_portfolios->have_posts() ) : $web_design_portfolios->the_post(); ?>
     <li  class="wb" title="wb">
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
        <a href="<?php the_permalink(); ?>"></a></div>
      </div>
     </li>
	<?php endwhile; ?>
	<?php  endif; ?>
	<!-- End code to display Web Design portfolios -->
	
	<!-- Start code to display web Development portfolios -->
	<?php if($web_development_portfolios->have_posts()) :?>
	<?php while ( $web_development_portfolios->have_posts() ) : $web_development_portfolios->the_post(); ?>
     <li class="wd" title="wd">
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
        <a href="<?php the_permalink(); ?>"></a></div>
      </div>
     </li>
	<?php endwhile; ?>
	<?php  endif; ?>
	<!-- End code to display Web Development portfolios -->
	
	<!-- Start code to display Identity portfolios -->
	<?php if($identity_portfolios->have_posts()) :?>
	<?php while ( $identity_portfolios->have_posts() ) : $identity_portfolios->the_post(); ?>
     <li class="idt" title="idt">
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
        <a href="<?php the_permalink(); ?>"></a></div>
      </div>
     </li>
	<?php endwhile; ?>
	<?php  endif; ?>
	<!-- End code to display Identity portfolios -->

	<!-- Start code to display Social Media portfolios -->
	<?php if($social_media_portfolios->have_posts()) :?>
	<?php $i=0;?>
	<?php while ( $social_media_portfolios->have_posts() ) : $social_media_portfolios->the_post(); ?>
     <li class="sm" title="sm">
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
        <a href="<?php the_permalink(); ?>"></a></div>
      </div>
     </li>
	 
	<?php endwhile; ?>
	
	<?php  endif; ?>
	<!-- End code to display Social Media portfolios -->
	<!-- Start code to display Social Media portfolios -->
	<?php if($marketing_portfolios->have_posts()) :?>
	<?php while ( $marketing_portfolios->have_posts() ) : $marketing_portfolios->the_post(); ?>
     <li class="mt" title="mt">
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
        <a href="<?php the_permalink(); ?>"></a></div>
      </div>
     </li>
	<?php endwhile; ?>
	<?php  endif; ?>
	<!-- End code to display Social Media portfolios -->
	</ul>
   </div>
   <!-- Code to get pagination for all portfolio -->
   <?php /*
	<div class="all-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php //next_posts_link('&laquo; Older Entries', $all_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php //previous_posts_link('Newer Entries &raquo;', $all_portfolios->max_num_pages); ?></div>
		</div>-->
		
		
		 <!-- page navi -->
			<div class="pagenavi">
			  <?php
			  global $all_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $all_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
        <!-- page navi end --> 
	</div>
	<!-- End Code to get pagination for all portfolio -->
	<!-- Code to get pagination for Web Design portfolio -->
	<div class="web-design-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php next_posts_link('&laquo; Older Entries', $web_design_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;', $web_design_portfolios->max_num_pages); ?></div>
		</div>-->
		
		<div class="pagenavi">
			  <?php
			  global $web_design_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $web_design_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
	</div>
	<!-- End Code to get pagination for Web Design portfolio -->
	<!-- Code to get pagination for Web Development portfolio -->
	<div class="web-dev-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php next_posts_link('&laquo; Older Entries', $web_development_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;', $web_development_portfolios->max_num_pages); ?></div>
		</div>-->
		<div class="pagenavi">
			  <?php
			  global $web_development_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $web_development_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
	</div>
	<!-- End Code to get pagination for Web Development portfolio -->
	<!-- Code to get pagination for identity portfolio -->
	<div class="identity-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php next_posts_link('&laquo; Older Entries', $identity_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;', $identity_portfolios->max_num_pages); ?></div>
		</div>-->
		<div class="pagenavi">
			  <?php
			  global $identity_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $identity_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
	</div>
	<!-- End Code to get pagination for Identity portfolio -->
	<!-- Code to get pagination for Social Media portfolio -->
	<div class="scl-mda-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php next_posts_link('&laquo; Older Entries', $social_media_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;', $social_media_portfolios->max_num_pages); ?></div>
		</div>-->
		<div class="pagenavi">
			  <?php
			  global $social_media_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $social_media_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
	</div>
	<!-- End Code to get pagination for Social Media portfolio -->
	<!-- Code to get pagination for Marketing portfolio -->
	<div class="mrkt-pagination">
		<!--<div class="navigation">
			<div class="next-posts"><?php next_posts_link('&laquo; Older Entries', $marketing_portfolios->max_num_pages); ?></div>
			<div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;', $marketing_portfolios->max_num_pages); ?></div>
		</div>-->
		<div class="pagenavi">
			  <?php
			  global $marketing_portfolios;
			  
			  $big = 999999999; // need an unlikely integer
			  
			  echo paginate_links( array(
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			  'format' => '?paged=%#%',
			  'current' => max( 1, get_query_var('paged') ),
			  'total' => $marketing_portfolios->max_num_pages
			  ) );
			  ?>
			</div>
	</div> 
	<!-- End Code to get pagination for Marketing portfolio -->
	*/ ?>
  </div>
 </section>