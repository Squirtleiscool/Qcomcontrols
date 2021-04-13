<?php 
/**
 * The Custom Javascript for LayerFramework
 *
 * Loads the Custom Javascript of the template in the footer.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>
<?php if(!empty( $optimizer['custom-js'])) { ?>
<script type="text/javascript">
<?php echo stripslashes(htmlspecialchars_decode($optimizer['custom-js'])); ?>
</script>
<?php } ?>
<?php if($optimizer['slider_type_id'] == "nivo"){ ?>
<script type="text/javascript">
    jQuery(window).on('load', function(){
		jQuery('#zn_nivo').waitForImages(function() {
		// nivoslider init
		jQuery('#zn_nivo').nivoSlider({
				effect: 'fade',
				animSpeed:700,
				pauseTime:<?php echo $optimizer['n_slide_time_id']; ?>,
				startSlide:0,
				slices:10,
				directionNav:true,
				directionNavHide:true,
				controlNav:true,
				controlNavThumbs:false,
				keyboardNav:true,
				<?php if(is_home() || is_page_template('template_parts/page-frontpage_template.php')) {?>
				manualAdvance: false,
				<?php }else{ ?>
				manualAdvance: true,
				<?php } ?>
				pauseOnHover:true,
				captionOpacity:0.8,
				afterLoad: function(){
					jQuery("#zn_nivo .nivo-main-image").attr('src', jQuery('#zn_nivo img').eq(0).attr('data-src'));
					jQuery(".nivo-caption .slide_button_wrap .lts_button").css({"display":"none"});
					jQuery(".nivo-caption").animate({"opacity": "1"}, {easing:"easeOutQuad", duration: 600});
					
					jQuery(".nivo-caption").animate({"bottom":"25%"}, {easing:"easeOutQuad", duration: 1000})
						.promise().done(function (){	
						jQuery(".nivo-caption .slide_desc, .nivo-caption .slide_button_wrap .lts_button").animate({"opacity": "1", "top":"0px"}, {easing:"easeOutQuad", duration: 600}).promise().done(function (){	
						jQuery(".nivo-caption .slide_button_wrap .lts_button").addClass('bounceIn').css({"display":"block"});
					});
					
					});
						
				},
				beforeChange: function(){
					jQuery(".nivo-caption .slide_button_wrap .lts_button").css({"display":"none"});
					
					jQuery(".nivo-caption").animate({"opacity": "0", "bottom":"10%"}, {easing:"easeOutQuad", duration: 600})
						.promise().done(function (){	
						jQuery(".nivo-caption .slide_desc, .nivo-caption .slide_button_wrap .lts_button").animate({"opacity": "0", "top":"20px"}, {easing:"easeOutQuad", duration: 600}).promise().done(function (){	
						jQuery(".nivo-caption .slide_button_wrap .lts_button").css({"display":"none"});
					});
				});
				},
				afterChange: function(){
					jQuery(".nivo-caption .slide_button_wrap .lts_button").css({"display":"none"});
					
					jQuery(".nivo-caption").animate({"bottom":"25%", "opacity": "1"}, {easing:"easeOutQuad", duration: 1000})
					.promise().done(function (){	
					jQuery(".nivo-caption .slide_desc, .nivo-caption .slide_button_wrap .lts_button").animate({"opacity": "1", "top":"0px"}, {easing:"easeOutQuad", duration: 600}).promise().done(function (){	
					jQuery(".nivo-caption .slide_button_wrap .lts_button").addClass('bounceIn').css({"display":"block"});
					});
				});
						
				}
		});
		jQuery('#zn_nivo').css({"height":"auto"});
	});
	});
</script>
<?php } ?>


<?php if($optimizer['slider_type_id'] == "accordion"){ ?>
<script type="text/javascript">
	jQuery(window).on('load', function(){
		//Accordion
		if (jQuery(window).width() > 500) {
		jQuery('.kwicks').kwicks({maxSize : '80%', behavior: 'menu', spacing: 0});
		} else {
		jQuery(".kwicks .dlthref").attr("href", "#");
		var index = jQuery('.kwicks').kwicks({maxSize : '80%', spacing: 0, behavior: 'slideshow'});
		jQuery('.kwicks').kwicks('select', <?php echo optimizer_accordion_mobile_default_slide();?>);
		}
	});
</script>
<?php } ?>
<?php if($optimizer['slider_type_id'] == "static" && empty($optimizer['head_transparent'])){ ?>
<script type="text/javascript">
	jQuery(window).on('load',function() {
		//STATIC SLIDER IMAGE FIXED
		var statimgheight = jQuery(".stat_has_img .stat_bg_img").height();
		var hheight = jQuery(".header").height() + jQuery('.admin-bar #wpadminbar').height() + jQuery('#customizer_topbar').height();
		jQuery('.stat_bg img').css({"top":hheight+"px"});
		jQuery('.not_trans_header .stat_bg, .not_trans_header .stat_bg_overlay').css({"top":hheight+"px"});
	});		
	jQuery(window).on('scroll', function() {
			var scrollTop = jQuery(this).scrollTop();
			
			var hheight = jQuery(".header").height() + jQuery('.admin-bar #wpadminbar').height() + jQuery('#customizer_topbar').height();
				if ( !scrollTop ) {
					jQuery('.stat_bg img').css({"top":hheight+"px"});
					jQuery('.stat_bg').css({"background-position-y":hheight+"px"});
				}else{
					jQuery('.stat_bg img').css({"top":"0px"});
					jQuery('.stat_bg').css({"background-position-y":"0px"});
				}
				
	});

</script>
<?php } ?>


		<?php 
			if($optimizer['static_textbox_bottom'] == '0'){
				echo '<script>jQuery(".stat_content_inner").find("p").last().css({"marginBottom":"0"});</script>';
			} 
		?>


<?php if(!empty($optimizer['head_sticky'])){ ?>
<script type="text/javascript">
	jQuery(window).on('load', function(){
        if (jQuery("body").hasClass('admin-bar')) {
			if (jQuery(window).width() > 601) {  
				jQuery(".header").sticky({topSpacing:27}); 
				resizeStickyLogo()
			}else{  
				jQuery(".header").sticky({topSpacing:0});
				resizeStickyLogo() 
			}
		}else {
			jQuery(".header").sticky({topSpacing:0});
			resizeStickyLogo()
		}
		jQuery('body.site_boxed .header, body .header_wrap .sticky-wrapper .header').css({"width":jQuery('.header_wrap').width()});
    });
	jQuery(window).on('resize',optimizerStickyResize);

	 function optimizerStickyResize(){
			//Sticky Header width for Boxed Layout
			jQuery('body.site_boxed .header, body .header_wrap .sticky-wrapper .header').css({"width":jQuery('.header_wrap').width()});		
	 }
	 function resizeStickyLogo(){
      <?php if(!empty($optimizer['logo_image_id']['url']) && !empty($optimizer['head_sticky'])){   ?>
      var logoInitHeight = jQuery('.logo img').innerHeight();
      if(logoInitHeight > 60){
			jQuery('.header').on('sticky-start', function() { jQuery('.logo img').animate({"height": "60px"}, 300 ) }); 
			jQuery('.header').on('sticky-end', function() { jQuery('.logo img').animate({"height": logoInitHeight+"px"}, 300 ) });  
      }
		<?php } ?>
	}
	 
</script>
<?php } ?>


<?php /*?><!------------------------------------------------------------Other Javascripts--------------------------------------------------------><?php */?>

<script type="text/javascript">

//Hide Slider until its loaded
jQuery('#zn_nivo, .nivo-controlNav').css({"display":"none"});	

	//Midrow Blocks Equal Width
	if(jQuery('.midrow_block').length == 4){ jQuery('.midrow_blocks').addClass('fourblocks'); }
	if(jQuery('.midrow_block').length == 3){ jQuery('.midrow_blocks').addClass('threeblocks'); }
	if(jQuery('.midrow_block').length == 2){ jQuery('.midrow_blocks').addClass('twoblocks'); }
	if(jQuery('.midrow_block').length == 1){ jQuery('.midrow_blocks').addClass('oneblock'); }



<?php if(is_page_template('template_parts/page-contact_template.php') ) { ?>
	jQuery(window).on('load', function(){
	//FORM VALIDATION
		jQuery('#layer_contact_form').isHappy({
			fields: {
			  '#layer_cntct_name': {required: true,message: '<?php _e('Name is Required!', 'optimizer'); ?>'},
			  '#layer_cntct_email': {required: true,message: '<?php _e('Email is Required!', 'optimizer'); ?>',},
			  '#layer_cntct_subject': {required: true,message: '<?php _e('Subject is Required!', 'optimizer'); ?>',},
			  '#layer_cntct_msg': {required: true,message: '<?php _e('Your Message is Required!', 'optimizer'); ?>', },
			  '#layer_cntct_math': {required: true,message: '<?php _e('Please solve the math!', 'optimizer'); ?>'},
			  <?php if($optimizer['gdpr_policy']){ ?>
			  '#layer_cntct_gdpr_policy': {
				  required: true,
				  message: '<?php _e('Please agree to the Terms', 'optimizer'); ?>',
				  error_target: '#layer_cntct_gdpr_policy',
				  when: 'change',
				  test: function(){ 
					return jQuery('#layer_cntct_gdpr_policy').is(':checked');
				  },
				},
			  <?php } ?>
			}
		  });
	});
<?php } ?>	


<?php if(($optimizer['cat_layout_id'] == "3")){ ?>
	<?php if(is_category() || (is_tag()) || (is_archive())) { ?>
	jQuery(window).on('load', function(){
		//Layout3 Masonry
		var container = document.querySelector('.lay3_wrap');
		var msnry;
		if(container){
			imagesLoaded( container, function() {
				new Masonry( container, {
			  // options
			  itemSelector: '.hentry'
			});
			});
		}
	});
	<?php } ?>
<?php } ?>

<?php if(($optimizer['blog_layout_id'] == "5")){ ?>
	<?php if( $optimizer['blog_layout_id'] == '5' && is_page_template('template_parts/page-blog_template.php') ) { ?>
	jQuery(window).on('load', function(){
		//Layout3 Masonry
		var container = document.querySelector('.blog_layout5 .lay4_wrap');
		var msnry;
		if(container){
			imagesLoaded( container, function() {
				new Masonry( container, {
			  // options
			  itemSelector: '.hentry'
			});
			});
		}
	});
	<?php } ?>
<?php } ?>
					
<?php if(empty($optimizer['static_video_id']['url']) && !empty($optimizer['slide_ytbid'])){ ?>
      // YOUTUBE VIDEO ON FRONTPAGE
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('ytplayer', {
          height: '',
          width: '',
		  suggestedQuality: 'large',
          videoId: '<?php echo $optimizer['slide_ytbid']; ?>',
		  playerVars :{'controls':0, 'showinfo': 0, 'autoplay': 1, <?php if( $optimizer['static_vid_loop'] == true){?>'loop':1, 'playlist':'<?php echo $optimizer['slide_ytbid']; ?>'<?php }else{ ?> 'loop':0<?php } ?>, 'rel':0},
          
		  events: {
            'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
          }
		  
        });
      }

      function onPlayerReady(event) {
		//event.target.setPlaybackQuality('hd720');
		<?php if( $optimizer['static_vid_mute'] == true){?>event.target.mute();<?php } ?>
      }
	function onPlayerStateChange(event) {
			event.target.setPlaybackQuality('large');
			var id = '<?php echo $optimizer['slide_ytbid']; ?>';
		
			if(event.data === YT.PlayerState.ENDED){
				player.loadVideoById(id);
				
				<?php if( !$optimizer['static_vid_loop'] == true){?>
					player.pauseVideo();
				<?php } ?>
			}
	}
<?php } ?>

jQuery(window).on('load', function(){
	jQuery('.stat_has_slideshow').css({"maxHeight":"none"});
	jQuery('.static_gallery').nivoSlider({effect: 'fade', directionNav: false, controlNav: false, pauseOnHover:false, slices:6, pauseTime:<?php echo optimizer_statslideshow_time(); ?>});
});

jQuery(function() {
	jQuery('.pd_flick_gallery li img').addClass('hasimg');
});


<?php if(is_page_template('template_parts/page-contact_template.php') ) { ?>
	<?php if(!empty($optimizer['contact_latlong_id'])){ ?>
jQuery(function() {
	//MAP SHORTCODE
		var text = '<?php echo str_replace(array("\r\n", "\n"),"",nl2br(do_shortcode(addslashes($optimizer['contact_location_id'])))); ?>';
		var mapid = 'asthemap';
	
	function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo $optimizer['contact_latlong_id']; ?>);
	  var mapOptions = {
		zoom: 16,
		scrollwheel: false,
		center: myLatlng,
	  }
	  var map = new google.maps.Map(document.getElementById(mapid), mapOptions);
	
	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: map,
	  });
	  var infowindow = new google.maps.InfoWindow();
				google.maps.event.addListener(marker, 'click', (function (marker, i) {
					return function () {
						infowindow.setContent(text);
						infowindow.open(map, marker);
					}
				})(marker));
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	});
	<?php } ?>
<?php } ?>

<?php if ( class_exists( 'WooCommerce' ) ){ ?>
   jQuery(window).on('load', function(){
      jQuery('.single-product .single_post .thumbnails').looper({interval: false});
      jQuery('.archive.woocommerce-page.woo_archive_layout4 ul.products li.product').matchHeight({ property: 'min-height', byRow: 'height'});
      jQuery('.woocommerce.single.woo_single_layout1 .yith-wcwl-add-to-wishlist').insertBefore('div[itemprop="offers"]');
      jQuery('.woocommerce.single.woo_single_layout4 #content .onsale').prependTo('.woocommerce.single.woo_single_layout4 #content .product .images');
   });
<?php } ?>
</script> 