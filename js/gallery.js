$(document).ready(function(){

	

 $(".gl-cnt").hover(function(){
    $( "img", this).stop(true, true).animate({ left: "272px" });
}, function() {
    $("img", this).stop(true, true).animate({ left: "0px" });
});


 $(".gl-cnt").hover(function(){
    $( ".mask", this).stop(true, true).animate({ left: "0px" });
}, function() {
    $(".mask", this).stop(true, true).animate({ left: "-272px" });
});


$('.menu li a').click(function() {
					
					
					$('.menu li').removeClass('selected');
					$(this).parent('li').addClass('selected');
					
					thisItem 			= $(this).attr('title');
					thisExplanation 	= $(this).attr('title');
					
					if(thisItem != "all") {
					
						$('.item li[title='+thisItem+']').stop()
																.animate({'width' : '315px', 
																			 
																				
																			 
																			}).addClass('show');
																			
						$('.item li[title!='+thisItem+']').stop()
																.animate({'width' : 0, 
																			 
																			
																			 
																			}).removeClass('show');
						makePagination();									
						
					} else {
						
						$('.item li').stop()
										.animate({'opacity' : 1, 
													 'width' : '315px',
												
													 
													}).addClass('show');
													
						makePagination();
						
					}
					
					$('.explanation').text(thisExplanation);
					
				});
				
				
				
				//makePagination();
				









 
 });
	
	
			