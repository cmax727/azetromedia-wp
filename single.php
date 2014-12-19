<?php
    $post = $wp_query->post;
//	print_r($post);	exit;
	$ptype = get_post_type( $post );
    if ( in_category('3', $post) &&  $ptype=="post") {
		include(TEMPLATEPATH . '/singleBlog.php');
	}else if($ptype == "portfolio"){
		include(TEMPLATEPATH . '/singlePortfolio.php');
	}
    else {include(TEMPLATEPATH . '/singleDefault.php');
    }
    ?>
