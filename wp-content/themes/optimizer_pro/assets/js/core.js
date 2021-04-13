jQuery(function() {

	/*CAROUSEL SHORTCODE*/
	jQuery(".looper-inner p, .looper-inner .item, .lts_pricing p, .lts_blocks p, .lts_blocks br, .lts_tab br, .lts_tabtitle").each(function(){
		if (!jQuery(this).text().trim().length) {
			jQuery(this).addClass("emptyp_clear");
		}
	});
	
	jQuery('.looper-inner .item, .lts_pricing .pricebox, .lts_block, .lts_tab_child').siblings('.emptyp_clear').remove();
	jQuery('.price_body .emptyp_clear').remove();


	/*Responsive Video Shortcode*/
	jQuery('.thn_post_wrap .ast_vid, .frontpage_sidebar .widget .ast_vid').each( function(){	
		var vidwidth  = jQuery(this).data('width');  var vidheight  = jQuery(this).data('width'); 
		jQuery(this).find('iframe').width(vidwidth).height(vidheight);
	});
	
	jQuery('.thn_post_wrap .ast_vid iframe, .frontpage_sidebar .widget .ast_vid iframe').each(function () {
			var vidheights = jQuery(this).height();
			jQuery(this).closest('.ast_vid').css({ 'height':vidheights });
			
			if(jQuery(this).closest('.widget_wrap').find('.video_on_video').length){
				jQuery(this).closest('.ast_vid').css({ 'height':vidheights -240 });
			}
	});
	
	

	
	/*Social Icons Widget Custom Color*/
	jQuery('.ast_scoial').each( function(){	
		var iconscolor  = jQuery(this).attr('data-icon-color');
		if(iconscolor == '#FFFFFF') {var iconscolor ='';}
		jQuery(this).find('a').css("background-color",iconscolor);
	});
	jQuery('.ast_scoial.social_style_round_text').each( function(){	
		var iconscolor  = jQuery(this).attr('data-icon-color');  
		if(iconscolor == '#FFFFFF') {var iconscolor ='';}
		jQuery(this).find('i').css("background-color",iconscolor); jQuery(this).find('span').css("color",iconscolor);
	});

	//ADD ID to Carousel and MAP
	for (var i=0; i<20; i++){
		jQuery('.lts_looper').eq(i).attr('id', 'lts_looper'+i+'');
		jQuery('.lts_list').eq(i).attr('id', 'lts_list'+i+'');
		jQuery('.lts_map_wrap').eq(i).attr('id', 'map_'+i+'');
	}
	
	jQuery('.lts_looper.lts_default, .lts_looper.lts_simple').each( function(){	
		jQuery(this).find('br').remove(); 
		var button_color = jQuery(this).attr('data-buttoncolor');
		 jQuery(this).find('nav').prepend('<a style="background:'+button_color+';" class="looper-control" data-looper="prev" href="#'+jQuery(this).attr('id')+'"><i class="fa fa-chevron-left"></i></a><a style="background:'+button_color+';" class="looper-control right" data-looper="next" href="#'+jQuery(this).attr('id')+'"><i class="fa fa-chevron-right"></i></a>');
	});
	jQuery('.lts_looper.lts_thick_border').each( function(){	
		jQuery(this).find('br').remove(); 
		var button_color = jQuery(this).attr('data-buttoncolor');
		 jQuery(this).find('nav').prepend('<a style="background:'+jQuery('body').css("background-color")+';" class="looper-control" data-looper="prev" href="#'+jQuery(this).attr('id')+'"><i  style="color:'+button_color+'!important;" class="fa fa-chevron-left"></i></a><a style="background:'+jQuery('body').css("background-color")+';" class="looper-control right" data-looper="next" href="#'+jQuery(this).attr('id')+'"><i style="color:'+button_color+'!important;" class="fa fa-chevron-right"></i></a>');
	});
	


/*PRICING SHORTCODE*/
	jQuery('.pricebox').has('.pricebox_featured').addClass('feat_price');
	
	jQuery(".lts_pricing").each(function(){
		var button_bg = jQuery(this).attr('data-button-bg');
		var button_color = jQuery(this).attr('data-button-txt');
		var pricebox_bg = jQuery(this).attr('data-price-bg');
		var pricebox_txt = jQuery(this).attr('data-price-txt');
		//Convert Background Color to RGBA
		var rgbaCol = 'rgba(' + parseInt(button_bg.slice(-6,-4),16)
			+ ',' + parseInt(button_bg.slice(-4,-2),16)
			+ ',' + parseInt(button_bg.slice(-2),16)
			+',0.3)';
		
		jQuery(this).find('.price_button, .pricebox_featured').attr('style', 'color:'+button_color+'!important;background:'+button_bg+';');
		jQuery(this).find('.price_button').css({"borderColor":button_bg});
		jQuery(this).find('.pricebox').css({"background":pricebox_bg});
		
      jQuery('.pricing_style1 .pricebox_inner').on('mouseenter', function(){ 
         jQuery(this).css({"borderColor": rgbaCol});
			jQuery(this).find('.price_head h3').css({"backgroundColor": rgbaCol, "color":button_color});
      });
		jQuery('.pricing_style1 .pricebox_inner').on('mouseleave', function(){ 
         jQuery(this).css({"borderColor": "rgba(0, 0, 0, 0.04)"});
			jQuery(this).find('.price_head h3').css({"backgroundColor": 'rgba(0, 0, 0, 0.02)', "color":pricebox_txt}); 
      });

	});
	
	jQuery(".lts_pricing.pricing_style2, .lts_pricing.pricing_style3").each(function(){
		var button_bg = jQuery(this).attr('data-button-bg');
		jQuery(this).find('.price_head h3').css({"color":button_bg});
      jQuery(this).find('.pricebox_inner').on('mouseenter', function(){    jQuery(this).css({"borderColor": button_bg});  });
      jQuery(this).find('.pricebox_inner').on('mouseleave', function(){    jQuery(this).css({"borderColor": "transparent"});  });
	});	
	jQuery(".lts_pricing.pricing_style5").each(function(){
		var button_bg = jQuery(this).attr('data-button-bg');
		var button_color = jQuery(this).attr('data-button-txt');
		var rgbaCol = 'rgba(' + parseInt(button_bg.slice(-6,-4),16)
			+ ',' + parseInt(button_bg.slice(-4,-2),16)
			+ ',' + parseInt(button_bg.slice(-2),16)
			+',0.5)';
		jQuery(this).find('.price_head h3').css({"backgroundColor":rgbaCol});
		jQuery(this).find('.pricebox').each(function(){
			jQuery(this).find('.price_ammount, .price_label').insertAfter(jQuery(this).find('.price_body'));
		});
	});	
	

jQuery(".lts_pricing").each(function(){
	
	if(jQuery(this).find('.pricebox').length == 5){ jQuery(this).addClass('lts_pricebox5'); }
	if(jQuery(this).find('.pricebox').length == 4){ jQuery(this).addClass('lts_pricebox4'); }
	if(jQuery(this).find('.pricebox').length == 3){ jQuery(this).addClass('lts_pricebox3'); }
	if(jQuery(this).find('.pricebox').length == 2){ jQuery(this).addClass('lts_pricebox2'); }
	if(jQuery(this).find('.pricebox').length == 1){ jQuery(this).addClass('lts_pricebox1'); }
	//Equal Description Height
	var descheight = Math.max.apply(Math, jQuery(".price_desc").map(function () {return jQuery(this).outerHeight(); }));
	jQuery(this).find('.price_desc').outerHeight(descheight);
	//Equal Feature list box Height
	var featheight = Math.max.apply(Math, jQuery(".price_body ul").map(function () {return jQuery(this).outerHeight(); }));
	jQuery(this).find('.price_body ul').outerHeight(featheight);
});


/*Column Shortcode*/
jQuery(".text_block_content, .thn_post_wrap, #slidera, .about_inner, .block_content").each(function(){
   var colParent = jQuery(this);
   var col2Selectors = [1,3,5,7,9,11,13,15,17,19]; var col3Selectors = [2,5,8,11,14,17,20,23,26,29]; var col4Selectors = [3,7,11,15,19,23,27,31,35,39];
   col2Selectors.forEach(function(selectorIndex){  colParent.find('.col2').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
   col3Selectors.forEach(function(selectorIndex){  colParent.find('.col3').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
   col4Selectors.forEach(function(selectorIndex){  colParent.find('.col4').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
});

if (jQuery(window).width() >= 480) {	
		jQuery(".text_block_content, .thn_post_wrap, #slidera, .about_inner, .block_content").each(function(){jQuery(this).find('.col2, .col3, .col4').matchHeight({ byRow: true, property: 'min-height'});});
		jQuery(window).on('load',function() {
			jQuery(".optimizer_front_carousel .looper .looper-inner li").matchHeight({ byRow: false, property: 'min-height'});
		});
}


//BLOCKS SHORTCODE
	jQuery('.lts_blocks .lts_block:empty').remove();
	jQuery(".lts_blocks").each(function(){
		jQuery(this).waitForImages(function() {
			jQuery(this).find('.lts_block').not('.block_full').matchHeight();
		});
		
		if(jQuery(this).find('.lts_block').length == 4){ jQuery(this).addClass('lts_fourblocks'); }
		if(jQuery(this).find('.lts_block').length == 3){ jQuery(this).addClass('lts_threeblocks'); }
		if(jQuery(this).find('.lts_block').length == 2){ jQuery(this).addClass('lts_twoblocks'); }
		if(jQuery(this).find('.lts_block').length == 1){ jQuery(this).addClass('lts_oneblock'); }
	});


//LIST Shortcode COLOR
jQuery(".lts_list").each(function(){
	var bulletcolor = jQuery(this).attr('data-list-color');
	var listid = jQuery(this).attr('id');
	jQuery('<style>#'+listid+' li:before{color:'+bulletcolor+'}</style>').appendTo('head');
});



//Shortcode JS
//Tabs Javascript
 jQuery(".lts_tab p:empty").remove();
  jQuery(".lts_tabs .lts_tabtitle.emptyp_clear").remove();
 var i = 1; 
 jQuery(".tabs-container").each(function (){ jQuery(this).find('a.tabtrigger').each(function (){
	 	jQuery(this).attr('href', '#tab-'+i+''); i++;
	});
 });
 	
   var i = 1; 
   jQuery(".tabs-container").each(function (){
      jQuery(this).find(".lts_tab_child").not(':empty').each(function (){
         jQuery(this).attr('id', 'tab-'+i+''); i++;
      });
   });
   
   var i = 1; 
   jQuery(".tabs-container").each(function (){jQuery(this).attr('id', 'tabs-container_'+i+''); i++;});
 
  jQuery(".tabs-container.tabs_default").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
   if(active_color) jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+active_color+'!important;border-color:'+active_color+'}</style>').appendTo('head');
   });
   jQuery(".tabs-container.tabs_circular").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
      if(active_color) jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+jQuery('body').css('background-color')+'!important;background:'+active_color+'}</style>').appendTo('head');
   });
   jQuery(".tabs-container.tabs_minimal").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
      if(active_color) jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+active_color+'!important;border-color:'+active_color+'}</style>').appendTo('head');
   });
   jQuery(".tabs-container.tabs_capsule").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
      if(active_color) jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+jQuery('body').css('background-color')+'!important;background:'+active_color+';border-color:'+active_color+'}</style>').appendTo('head');
   });

   jQuery('.tabs-container').easytabs({updateHash: false});

	//Toggle Shortcode
	jQuery('.lts_toggle_content').hide(); // Hide even though it's already hidden
	jQuery('.lts_toggle .trigger').on('click',function() {
    jQuery(this).closest('.lts_toggle').find('.lts_toggle_content').slideToggle("fast"); // First click should toggle to 'show'
	  return false;
   });
   jQuery('.lts_toggle a.trigger').on('click',function(){
      if(!jQuery(this).hasClass('down')){
         jQuery(this).find('i').animateRotate(135);
         jQuery(this).addClass('down');
      }else{
         jQuery(this).find('i').animateRotate(-90);
         jQuery(this).removeClass('down');	
      }
   });

	 jQuery(".lts_toggle").each(function (){  if(jQuery(this).next('br')){ jQuery(this).next('br').addClass('tabsbr');  }   });
	
	//Widget image opacity animation
   jQuery('.widget_wrap a img').on('mouseenter', function(){  jQuery(this).stop().animate({ "opacity":"0.7" }, 300); });
   jQuery('.widget_wrap a img').on('mouseleave', function(){  jQuery(this).stop().animate({ "opacity":"1" }, 300);	 });

	
	//add CLASS for Slider Widget 
	for (var i=0; i<10; i++){  
		jQuery('.ast_slider_widget .slide_wdgt').eq(i).attr('id', 'lts_wdgt_nivo'+i+''); 
		jQuery('.ast_slider_widget #lts_wdgt_nivo'+i+'').nivoSlider({effect: 'fade', directionNav: true, prevText: '<i class="fa fa-chevron-left"></i>', nextText: '<i class="fa fa-chevron-right"></i>',  controlNav: false}); 
   }
   
	//Call to action shortcode animation
   jQuery('.act_right a').on('mouseenter', function(){  jQuery(this).addClass('animated pulse');  });
   jQuery('.act_right a').on('mouseleave', function(){  jQuery(this).removeClass('animated pulse');	 });
	


/*CHECK IF TOUCH ENABLED DEVICE*/
	function is_touch_device() {
	 return (('ontouchstart' in window)
		  || (navigator.MaxTouchPoints > 0)
		  || (navigator.msMaxTouchPoints > 0));
	}
if (is_touch_device()) { jQuery('body').addClass('touchon'); }else{	jQuery('body').addClass('notouchdevice'); }

/*BUG FIX: In iOS landscape, menu and posts widgets links has to be clicked twice.*/
if (is_touch_device()) {
	if (jQuery(window).width() > 480) {
	   jQuery('#topmenu ul li a').on('click touchend', function(e) {
		   if((typeof jQuery(this).attr('href')) !== 'undefined') { 
				var el = jQuery(this);
				var link = el.attr('href');
				window.location = link;
		   }
	   });
	}
}

	//CountDown Widget
	jQuery('.optim_countdown_widget').each(function(index, element) {
		jQuery(this).find(".ast_countdown ul").countdown(jQuery(this).find(".ast_countdown ul").attr('data-countdown')).on('update.countdown', function(event) {
	   jQuery(this).html(event.strftime(''
		+ '<li><span class="days">%D</span><p class="timeRefDays">'+optim.day+'</p></li>'
		+ '<li><span class="hours">%H</span><p class="timeRefHours">'+optim.hour+'</p></li>'
		+ '<li><span class="minutes">%M</span><p class="timeRefMinutes">'+optim.mins+'</p></li>'
		+ '<li><span class="seconds">%S</span><p class="timeRefSeconds">'+optim.sec+'</p></li>'));
		});
    });

jQuery('.ast_scoial_widget .widget_wrap').has('.social_style_full, .social_style_full_text').addClass('has_full_social_icons');

//Radial Progress bar Shortcode
jQuery('.circle_progress').each(function(index, element) {
	jQuery(this).circleProgress({ value: jQuery(this).data('progress'), size: 160, fill: { color: jQuery(this).data('background') } });
});
jQuery('.progress_circular').each(function(index, element) {
	if(jQuery(this).next().is('.progress_circular')){jQuery(this).addClass('float_progress');}else{jQuery(this).addClass('last_progress').after('<div style="clear:both" />');}
});

//ToolTip Shortcode
jQuery('.tooltip').miniTip({ fadeIn: 100 });

//post shortcode layout1 thumbnal resize
	var laywidth = jQuery('.lts_layout1 .listing-item').width();
	jQuery('.lts_layout1 .listing-item').height( (laywidth * 66)/100);
	jQuery(window).on('resize',function() {
		var laywidth = jQuery('.lts_layout1 .listing-item').width();
		jQuery('.lts_layout1 .listing-item').height( (laywidth * 66)/100);
	});
	
	var flaywidth = jQuery('.lay1 .hentry').width();
		jQuery('.lay1 .ast_row').height( (flaywidth * 66)/100);
	jQuery(window).on('resize',function() {
		var flaywidth = jQuery('.lay1 .hentry').width();
		jQuery('.lay1 .ast_row').height( (flaywidth * 66)/100);
	});
	
jQuery(function() {
	
if(jQuery('body .lts_layout3').length){
	jQuery('.lts_layout3 .listing-item').wrapAll('<div class="lts3_inner" />');
//Layout3 Shortcode Masonry 
	var container = document.querySelector('.lts3_inner');
	var msnry;
	imagesLoaded( container, function() {
		new Masonry( container, {
	  // options
	  itemSelector: '.listing-item'
	});
	});
}

	//Slider Widget
	jQuery('.slider_widget_nivo .the_slider_widget').each(function(index, element) {
		
		var nivoautoplay = jQuery(this).attr('data-pausetime');
		if(nivoautoplay){ nautoplay = false; }else{ nautoplay = true;}
		
		jQuery(this).nivoSlider({
			 effect: 'fade', 
			 directionNav: true, 
			 controlNav: true, 
			 pauseOnHover:false, 
			 slices:1, 
			 pauseTime:jQuery(this).attr('data-pausetime'),
			 manualAdvance: nautoplay ,
			 afterChange: function(){
				 	if(jQuery(this).height() < jQuery(this).parent().find('.widget_slider_content').height()){
						jQuery(this).height( jQuery(this).parent().find('.widget_slider_content').height() + 30);
						jQuery(this).find('nivo-slice').height( jQuery(this).parent().find('.widget_slider_content').height() + 30);
					}
			}
			 
		}); 
		//Set Slider Height to the Content of the slider so the content is not cut off
		jQuery(this).waitForImages(function() {
			if(jQuery(this).height() < jQuery(this).parent().find('.widget_slider_content').height()){
				jQuery(this).addClass('expand_slider_height')
				jQuery(this).height(jQuery(this).parent().find('.widget_slider_content').height() + 30);
				jQuery(this).find('nivo-slice').height(jQuery(this).parent().find('.widget_slider_content').height() + 30);
			}
		});

	});
	
	//Slider Widget
	jQuery('.slider_widget_gallery .the_slider_widget').each(function(index, element) {
		jQuery(this).nivoSlider({
			 effect: 'fade', 
			 directionNav: true, 
			 controlNav: true, 
			 controlNavThumbs: true,
			 pauseOnHover:true, 
			 slices:1, 
			 pauseTime:jQuery(this).attr('data-pausetime'),
		});   
	});
	
	//Clients Logo widget - Pagination
	jQuery(window).on('load', function(){
		jQuery('.clients_nav_on, .clients_nav_auto').waitForImages(function() {
         //jQuery('.clients_nav_auto').tinycarousel({"infinite ":false, "animationTime": 400});
      jQuery('.clients_nav_auto').tinycarousel({"infinite ":true, "animationTime": 400, "animate": true, "intervalTime": 3000, "interval": true});
		jQuery('.clients_nav_on').tinycarousel({"infinite ":false, "animationTime": 400});
		});
	});


});

//MAP WIDGET SUBTITLE SWAP	
	jQuery('.ast_map.no_map').each(function(index, element) {
		jQuery(this).find('.home_subtitle').insertAfter(jQuery(this).find('.optimizer_divider'));
    });



	//Equal height - Gallery (Square)
	jQuery('div[data-gallery-style="1"], div[data-gallery-style="2"]').each(function(index, element) {
		jQuery(this).waitForImages(function() {
			jQuery(this).find('.gallery-item, .gallery-item img').matchHeight({ byRow: true, property: 'min-height'});
		});
    });
	jQuery('div[data-gallery-style="3"], div[data-gallery-style="4"]').each(function(index, element) {
		jQuery(this).waitForImages(function() {
			minigrid('div[data-gallery-style="3"]', '.gallery-item', 0);
	   		minigrid('div[data-gallery-style="4"]', '.gallery-item', 0);
			window.addEventListener('resize', function(){
			  minigrid('div[data-gallery-style="3"]', '.gallery-item', 0);
			  minigrid('div[data-gallery-style="4"]', '.gallery-item', 0);
			});
		});
	});
	
	
jQuery('div[data-gallery-style="5"]').each(function (){
	jQuery(this).find('.gallery-item').css({"display":"none"});
	jQuery(this).append('<div class="slideshow_gallery" />')
		var tn_array = jQuery(this).find(".gallery-item a").map(function() {
		  return jQuery(this).attr("href");
		});
		var tn_array_src = jQuery(this).find(".gallery-item img").map(function() {
		  return jQuery(this).attr("src");
		});
		var pageLimit= jQuery(this).find(".gallery-item img").length - 1;
		for (var i = 0; i <= pageLimit; i++) {
			var article = jQuery(this).find(".gallery-item a");
				jQuery(article[i]).addClass("" + i + "");
				jQuery(article[i]).attr('id' , "vis" + i + "");
				jQuery(this).find('.slideshow_gallery').append("<img id='mainImage" + i + "' src='"+tn_array[i]+"'/>");

			}
			
		jQuery(this).find('.slideshow_gallery').nivoSlider({effect: 'fade', directionNav: true, prevText: '<i class="fa fa-chevron-left"></i>', nextText: '<i class="fa fa-chevron-right"></i>',  controlNav: false, }); 
		
});

});


jQuery(window).on('load',function() {
	/*2columns Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_2, .widget_col_2 .home_action').matchHeight({ property: 'min-height'});
			});
	});
	/*3columns Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_3, .widget_col_3 .home_action').matchHeight({ property: 'min-height'});
			});
	});
	/*2 quarter Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_4, .widget_col_3').matchHeight({ property: 'min-height'});
				
			});
	});
	/*1 quarter Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_2, .widget_col_5').matchHeight({ property: 'min-height'});
				
			});
	});
	/*3 quarter Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_6, .widget_col_2').matchHeight({ property: 'min-height'});
				
			});
	});
	/*3 quarter Widget EQUAL HEIGHT*/
	jQuery('.frontpage_sidebar, #pagesidebar').each(function (){
			jQuery(this).waitForImages(function() {
				jQuery(this).find('.widget_col_5, .widget_col_5 .home_action, .widget_col_6, .widget_col_6 .home_action').matchHeight({ property: 'min-height'});
				
			});
	});
	
});


//CONTACT FORM FOR WIDGETS/
function optimizerContact_validate(element) {
		console.log(element);
		jQuery('html, body').animate({scrollTop: jQuery(element).offset().top-100}, 150);
		jQuery(element).parent().addClass('contact_error');
	}
function optimizerValidateEmail(val) 
{
	
    if(val === ''){ //Check to see if value is empty
		return false;
    }
    if(!val.match(/\S+@\S+\.\S+/)){ //Check to see if has @
		return false;
    }
    if( val.indexOf(' ')!=-1 || val.indexOf('..')!=-1){
		return false;
    }
}
	
function optimizerContact(buttonid) {
		
        var formid = jQuery('#'+buttonid).parent().parent().attr('id');
		
		var cname = jQuery('#'+formid).find('.contact_name');
		var cemail = jQuery('#'+formid).find('.contact_email');
		var csubject = jQuery('#'+formid).find('.contact_subject');
		var cextrafld = jQuery('#'+formid).find('.contact_extra');
		var cmessage = jQuery('#'+formid).find('.contact_message');
		var cgdpr = jQuery('#'+formid).find('.contact_cgdpr'); 

		cname.parent().removeClass('contact_error'); cemail.parent().removeClass('contact_error'); csubject.parent().removeClass('contact_error'); cmessage.parent().removeClass('contact_error');
		cgdpr.parent().removeClass('contact_error');
		
        if(cname.val() === '') {
            optimizerContact_validate(cname);
            
        } else if(optimizerValidateEmail(cemail.val()) === false) {             
            optimizerContact_validate(cemail);
            
        } else if(csubject.val() === '') {               
            optimizerContact_validate(csubject);
			
        } else if(cmessage.val() === '') {               
            optimizerContact_validate(cmessage);
			
		} else if(cgdpr.is(":checked") === false) {               
            optimizerContact_validate(cgdpr);
			
        } else {
			jQuery('#'+buttonid).parent().append('<i class="fa fa-circle-o-notch fa-spin contact_buttn_spinner"></i>');
            var data = {
                'action': 'optimizer_send_message',
                'contact_name': cname.val(),
                'contact_email': cemail.val(), 
				'contact_subject': csubject.val(), 
				'contact_extra': cextrafld.val(),
                'contact_message': cmessage.val() 
            };
            
            var ajaxurl = optim.ajaxurl;
			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data : {
                'contact_name': cname.val(),
                'contact_email': cemail.val(), 
				'contact_subject': csubject.val(), 
                'contact_message': cmessage.val() ,
				'contact_extra': cextrafld.val(),
				'action' : 'optimizer_send_message',
				}
            	})
				.done(function(response,status,jqXHR) {
					console.log(response);
					jQuery('.contact_form_wrap .fa-circle-o-notch').remove();
					if(response === 'success'){
						alert(optim.sent);
						//console.log(response);
						cname.val(''); cemail.val(''); csubject.val(''); cmessage.val('');
						if(optim.redirect){
							location.href = optim.redirect;
						}
					}
				});	

        } 
}

/*VIDEO Widgets (Youtube)*/
jQuery(window).on('load', function(){
	setTimeout(function () {
		if ( jQuery( ".optimizer_front_video, .vid_iframe" ).length ) {
			var tag = document.createElement("script");
			tag.src = "https://www.youtube.com/player_api";
			var firstScriptTag = document.getElementsByTagName("script")[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		}
	}, 1000);
});	
							
var players = {};
function onYouTubePlayerAPIReady() {
        
      jQuery(function() {
         jQuery('.ytb_widget_iframe').each(function(event) {
                
            var iframeID = jQuery(this).attr('id');
        	var autoplay = jQuery(this).attr('data-autoplay');
			var position = jQuery(this).attr('data-position');
			if(autoplay == 1){var auto = 1;}else{var auto = 0;}
			
			if(autoplay == 1 && position == 'on_video'){ 
			
				players[iframeID] = new YT.Player(iframeID, {
					suggestedQuality: "large", videoId: jQuery(this).attr('data-video-id'), playerVars :{'autoplay': auto, 'loop':1, 'rel':0, 'playlist': jQuery(this).attr('data-video-id')}, events: {'onReady': muteVideo}
				});
			
			}else{ 
				players[iframeID] = new YT.Player(iframeID, {
					suggestedQuality: "large", videoId: jQuery(this).attr('data-video-id'), playerVars :{'autoplay': auto, 'rel':0}
				});
			}
			
 		});  //END .ytb_widget_iframe each
    });  //End document.ready
	
}

function muteVideo(event) {
	event.target.mute();
}
function playYouTubeVideo(iframeID) {      
    players[iframeID].playVideo();
}

jQuery(function() {
    jQuery('.astytb i.fa.fa-play').on('click', function() {
       var iframeID = jQuery(this).closest('.optimizer_video_wrap').find('iframe').attr('id');
       playYouTubeVideo(iframeID);
	   jQuery(this).hide();
	   jQuery(this).parent().parent('.video_on_video').find('.widget_video_content').hide();
	   jQuery(this).next('.ytb_thumb').hide();
    });
});


/*VIDEO Widgets (Vimeo)*/
jQuery(window).on('load',function() {
	
 jQuery('.astvimeo').each(function(index, element) {
		var iframeid = jQuery(this).find('iframe').attr('id');
		var buttonid = jQuery(this).find('i.fa.fa-play').attr('id');
		
		var iframe = document.getElementById(iframeid);
		var player = $f(iframe);
		
		jQuery('#'+buttonid).on('click', function(){
			jQuery(this).parent().parent('.video_on_video').find('.widget_video_content').hide();
			jQuery(this).hide();
			jQuery(this).parent().removeClass('hidecontrols');	
			jQuery(this).next('.vim_thumb').hide();
		});
	
		var playButton = document.getElementById(buttonid);
		if(playButton){
			playButton.addEventListener("click", function() {
				player.api("play");
			});
		}

		
/*		if(jQuery(this).has('.autoPlay_vim')){
			player.api("play");
		}*/
 }); 
 
//Custom Video
	jQuery('.video_on_video .custom_vdo_wrap').each(function(index, element) {
		jQuery(this).find('.mejs-overlay-button').on('click',function() {
			jQuery(this).closest('.video_on_video').find('.widget_video_content').hide();
			jQuery(this).next('.customvdo_thumb').hide();
		});
	});
	
});


//MAP SHORTCODE
jQuery(function() {
   //MAP SHORTCODE
   jQuery(".lts_map_wrap").each(function(){
      var lat = jQuery(this).find('.lts_map').attr('data-map-lat');
      var long = jQuery(this).find('.lts_map').attr('data-map-long');
      var text = jQuery(this).find('.lts_map').attr('data-map-text');
      var mapid = jQuery(this).attr('id');
   
   function initialize() {
      var myLatlng = new google.maps.LatLng(lat,long);
      var mapOptions = {
      zoom: 16,
      scrollwheel: false,
      center: myLatlng
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
});

//Check If IOS
function getMobileOperatingSystem() {
  var userAgent = navigator.userAgent || navigator.vendor || window.opera;
  if( userAgent.match( /iPad/i ) || userAgent.match( /iPhone/i ) || userAgent.match( /iPod/i ) )
  {	return 'iOS'; }
}

var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);


jQuery(window).on('load', function(){
	jQuery('.toggle_style3').each(function(index, element) {
		var first = jQuery('<div/>').addClass('first_toggles');
		var mid = jQuery('<div/>').addClass('mid_toggles');
		var last = jQuery('<div/>').addClass('last_toggles');
		
		var fElems = jQuery(this).find('div.lts_toggle:nth-child(3n+1)');
		var mElems = jQuery(this).find('div.lts_toggle:nth-child(3n+2)');
		var lElems = jQuery(this).find('div.lts_toggle:nth-child(3n+3)');
		
		fElems.appendTo(first);
		mElems.appendTo(mid);
		lElems.appendTo(last);
		jQuery(this).append(first,mid,last);
    });
	
	jQuery('.toggle_style2').each(function(index, element) {
		var first = jQuery('<div/>').addClass('first_toggles');
		var mid = jQuery('<div/>').addClass('mid_toggles');
		
		var fElems = jQuery(this).find('div.lts_toggle:nth-child(2n+1)');
		var mElems = jQuery(this).find('div.lts_toggle:nth-child(2n+2)');
		
		fElems.appendTo(first);
		mElems.appendTo(mid);
		
		jQuery(this).append(first,mid);
    });
	
});

function optimizer_is_in_view(elem) {
   var bounding = elem.getBoundingClientRect();
   return (
       bounding.top >= 0 &&
       bounding.left >= 0 &&
       bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
       bounding.right <= (window.innerWidth || document.documentElement.clientWidth)
   );
};