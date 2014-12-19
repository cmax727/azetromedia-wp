<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!--FOOTER-->
 <section id="footer">
  <section class="footer-nav">
   <div class="footer-nav-shadow">
    <div class="center-align">
     <div class="wrp">
      <nav>
	<!--  
       <ul>
        <li class="hedding">social media apps</li>
        <li><a href="#">Facebook Applications</a></li>
        <li><a href="#">Facebook Pages</a></li>
        <li><a href="#">Facebook App Guidelines</a></li>
        <li><a href="#">Facebook Page Guidelines</a></li>
        <li><a href="#"> Facebook Developers</a></li>
       </ul>
       <ul>
        <li class="hedding">Mobile Apps</li>
        <li><a href="#">iPhone Applications</a></li>
        <li><a href="#">iPad Applications</a></li>
        <li><a href="#">iOS App Guidelines</a></li>
        <li><a href="#">Android Applications</a></li>
       </ul>
       <ul>
        <li class="hedding">Web Products</li>
        <li><a href="#">Free Resources</a></li>
        <li><a href="#">Web Applications</a></li>
        <li><a href="#">Web App Guidelines</a></li>
        <li><a href="#"> Viral Videos</a></li>
       </ul>
       <ul>
        <li class="hedding">Site Map</li>
        <li><a href="#">Social Media</a></li>
        <li><a href="#">Web Solutions</a></li>
        <li><a href="#">Marketing</a></li>
        <li><a href="#"> Blog</a></li>
       </ul>
	-->
		<?php wp_nav_menu(array('menu' =>'Footer Menu 1','items_wrap' => '<ul id="footer-menu1">%3$s</ul>')); ?>
		<?php wp_nav_menu(array('menu' =>'Footer Menu 2','items_wrap' => '<ul id="footer-menu2">%3$s</ul>')); ?>
		<?php wp_nav_menu(array('menu' =>'Footer Menu 3','items_wrap' => '<ul id="footer-menu3">%3$s</ul>')); ?>
		<?php wp_nav_menu(array('menu' =>'Footer Menu 4','items_wrap' => '<ul id="footer-menu4">%3$s</ul>')); ?>
      </nav>
     </div>
    </div>
   </div>
  </section>
  <footer>
   <div class="center-align">
    <p><?php echo stripcslashes(str_replace("\n","<br />",get_option('footer_content')));?></p>
    <span><a href="<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ) ?>">Privacy Policy </a> | <a href="<?php echo get_permalink( get_page_by_path( 'terms-of-use' ) ) ?>">Terms of Use</a></span> </div>
  </footer>
 </section>
 <?php if(is_page('how-we-work'))
	{
		echo '</div>';
	}
 ?>
</div>
<?php wp_footer(); ?>

</body>
</html>