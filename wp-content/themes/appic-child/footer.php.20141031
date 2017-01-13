<div class="footer_above">
	<div class="container">
	<?php 
	if (is_front_page()){
		dynamic_sidebar('footer-above-home');
	} else {
		dynamic_sidebar('footer-above-inner');
	}
	?>
	</div>
</div>

<?php if (get_theme_option('footer_show_widgets')) :
	if ('4' == get_theme_option('footer_widgets_columns')) {
		get_template_part('includes/templates/footer/4columns');
	} else {
		get_template_part('includes/templates/footer/3columns');
	}
endif; ?>

<div class="footer-wrap">
	<div class="blue-line-wrap">
		<footer class="container">
		<?php if (get_theme_option('footer_show_social_media')) : ?>
			<ul class="social pull-right">
			<?php
				if($slPinterest = get_theme_option("social_link_pinterest")){
					echo '<li title="pinterest" class="custom-tooltip blue-tooltip"><a href="' . $slPinterest . '" class="pinterest-icon"></a></li>';
				}
				
				if($slGoogle = get_theme_option("social_link_google")){
					echo '<li title="google" class="custom-tooltip blue-tooltip"><a href="' . $slGoogle . '" class="google-icon"></a></li>';
				}
				
				if($slLinkedIn = get_theme_option("social_link_linkedin")){
					echo '<li title="linkedin" class="custom-tooltip blue-tooltip"><a href="' . $slLinkedIn . '" class="linkedin-icon"></a></li>';
				}
				
				if($slTwitter = get_theme_option("social_link_twitter")){
					echo '<li title="twitter" class="custom-tooltip blue-tooltip"><a href="' . $slTwitter . '" class="twitter-icon"></a></li>';
				}
				
				if($slFacebook = get_theme_option("social_link_facebook")){
					echo '<li title="facebook" class="custom-tooltip blue-tooltip"><a href="' . $slFacebook . '" class="facebook-icon"></a></li>';
				}
			?>
			</ul>
		<?php endif; ?>
		
		<div class="container__">
			
			<div class="row row_upper_border">
				<div class="span6">
					<?php dynamic_sidebar('coyright-area-1');?>
				</div>
				<div class="span6 right_align">
					<?php dynamic_sidebar('coyright-area-2');?>
				</div>
			</div>
		</div>
			<div class="copyright pull-left">
				<?php //echo get_theme_option('footer_note'); ?>
			</div>
		</footer>
	</div>
</div>

<script style="text/javascript">
jQuery(document).ready(function($){
	var i = 1;
	$('#use_the_1').addClass('featured_active');
    //$('#carousel_ul li:first').before($('#carousel_ul li:last'));  

    //when user clicks the image for sliding right  
    $('#right_scroll').click(function(){  
        if (i < 5){
            i++;
            console.log(i);
        
            //get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '  
            var item_width = $('#carousel_ul li').outerWidth() + 10;  
  
            //calculate the new left indent of the unordered list  
            var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;  
  
            //make the sliding effect using jquery's anumate function '  
            $('#carousel_ul').animate({'left' : left_indent},{queue:false, duration:500},function(){  
  
                //get the first list item and put it after the last list item (that's how the infinite effects is made) '  
                $('#carousel_ul li:last').after($('#carousel_ul li:first'));  
                
                //and get the left indent to the default -210px  
                $('#carousel_ul').css({'left' : '-210px'});  
            });
        }  
    });  

    //when user clicks the image for sliding left  
    $('#left_scroll').click(function(){  
        if (i > 1){
            i--;
            console.log(i);
        
            var item_width = $('#carousel_ul li').outerWidth() + 10;  
  
            /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */  
            var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;  
  
            $('#carousel_ul').animate({'left' : left_indent},{queue:false, duration:500},function(){  
  
            /* when sliding to left we are moving the last item before the first item */  
            $('#carousel_ul li:first').before($('#carousel_ul li:last'));  
  
            /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */  
            $('#carousel_ul').css({'left' : '-210px'});  
            });  
        }
    }); 

	var visible_featured = 1;
	$('#featured_hidden_1').show();
	$('.featured_h').mouseover(function(){

		var id = $(this).attr('id');
		id = id.split("_");
		id = id[2];
		console.log(id);
		if (id != visible_featured){
			
			visible_featured = id;
			$('.li_inactive').removeClass('featured_active');
			$('#use_the_' + id).addClass('featured_active');

			$('.featured_listing_hidden_info').hide();
			$('#featured_hidden_' + id).fadeIn();
			visible_featured = id;
		}
	});

	var visible_tab = 1;
	$('.tab_title').click(function(){
		var id = $(this).attr('id');
		id = id.split("_");
		id = id[1];
		
		if (id != visible_tab){
			$('.listings_tab').hide();
			$('#tab_' + id).fadeIn();
			$('.tab_title').removeClass('visible_tab');
			$('#tab_' + id + '_title').addClass('visible_tab');
			visible_tab = id;

		}
	});
});
</script>
<?php wp_footer(); ?>

</body>
</html>