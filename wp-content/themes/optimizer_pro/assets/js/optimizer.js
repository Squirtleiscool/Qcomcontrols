/**
 * The Javascript file for Optimizer
 *
 * Stores all the javascript of the template.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */

 jQuery(function() {
	//MENU Animation
	if (jQuery(window).width() > 768) {
		
		jQuery('#topmenu ul > li').not('#topmenu ul > li.mega-menu-item').hoverIntent(function(){
			jQuery(this).find('.sub-menu, ul.children').eq(0).removeClass('animated fadeOut').addClass('animated fadeInUp menushow');
		}, function(){
			jQuery(this).find('.sub-menu, ul.children').eq(0).addClass('animated fadeOut').delay(300).queue(function(next){ jQuery(this).removeClass("animated fadeInUp menushow");next();});
		});
	
		jQuery('#topmenu ul li ul li').not('#topmenu ul li.mega-menu-item ul.mega-sub-menu li').hoverIntent(function(){
			jQuery(this).find('.sub-menu, ul.children').eq(0).removeClass('animated fadeOut').addClass('animated fadeInUp menushow');
		}, function(){
			jQuery(this).find('.sub-menu, ul.children').eq(0).addClass('animated fadeOut').delay(300).queue(function(next){
						jQuery(this).removeClass("animated fadeInUp menushow");next();});
		});
	
		jQuery('#topmenu ul li').not('#topmenu ul li.mega-menu-item, #topmenu ul li ul li').on('mouseenter', function(){ jQuery(this).addClass('menu_hover'); });
      jQuery('#topmenu ul li').not('#topmenu ul li.mega-menu-item, #topmenu ul li ul li').on('mouseleave', function(){ jQuery(this).removeClass('menu_hover');	 });
      
	}
	
	jQuery('#topmenu li, #topbar_menu li').has("ul").addClass('zn_parent_menu');
	jQuery('.zn_parent_menu > a').append('<span class="menu_arrow"><i class="fa-angle-down"></i></span>');
	
		
	//TOPMENU ICON STYLE
	jQuery('.menu_style_5 ul>li a').each(function() {
	jQuery(this).attr('title', jQuery(this).find('.menu_icon').attr('title'));
	jQuery(this).miniTip({content: jQuery(this).attr('title')});
	jQuery(this).find('.menu_icon').attr('title', '');
	});

	//Slider CTA Buttons Scroll function
	jQuery('.cta_buttons a[href^="#"], .slide_button_wrap a[href^="#"], a.lts_button_sc[href^="#"], .home_action_button a[href^="#"]').each(function() {
			var scrollidraw = jQuery(this).attr('href'); 
			var scrollid = scrollidraw.substr(0, scrollidraw.indexOf('='));
			if(scrollid.indexOf('#') !== -1){
				//scrollid = '#'+scrollid.split("#")[1];
				
			}
			var scrollname = scrollidraw.substr(scrollidraw.indexOf("=") + 1);
			jQuery(this).attr('href', '#'+scrollname); 
		
		//console.log(scrollid);
		jQuery(this).on('click',function() {
			//e.preventDefault();
			jQuery(this).attr('data-scrollid', scrollid); 
			
			jQuery('html, body').animate({scrollTop: jQuery(scrollid).offset().top -100}, 'slow');
		});	

		//Nivo Slider and Accordion Slider
		jQuery(document).on('click', '.slide_button_wrap a[href^="#"]', function(e) {		
			jQuery(this).attr('data-scrollid', scrollid); 
			jQuery('html, body').animate({scrollTop: jQuery(scrollid).offset().top -100}, 'slow');
		});
	
	});	
	
	//NEW TOPMENU Onepage Scroll function
	jQuery('#topmenu ul>li[class^="optimizer_front_"], #topbar_menu ul>li[class^="optimizer_front_"], #topmenu ul>li[class^="ast_"], #footer_menu ul>li[class^="ast_"], #footer_menu ul>li[class^="optimizer_front_"]').each(function(){
		var getClass = jQuery.grep(this.className.split(" "), function(v, i){if( v.indexOf('optimizer_front_') === 0){ return v.indexOf('optimizer_front_') ===0; }else{ return v.indexOf('ast_') ===0; } }).join();

		if(jQuery('#'+getClass).length){
			jQuery('#topmenu ul .'+getClass+' a, #topbar_menu ul .'+getClass+' a, #footer_menu ul .'+getClass+' a').on('click',function(e) {e.preventDefault(); jQuery('html, body').animate({scrollTop: jQuery('#'+getClass).offset().top -100}, 'slow'); });

	var menucount = jQuery('#topmenu ul>li').length;
	var onemenucount = jQuery('#topmenu ul>li[class^="optimizer_front_"]').length;
	if(menucount == onemenucount){jQuery('body').addClass('optimizer_onepager');}
	
		if(menucount == onemenucount){
				new Waypoint.Inview({
				  element: jQuery('#'+getClass)[0],
				  enter: function(direction) {  
				  jQuery('.header ul li').removeClass('current-menu-item onepagemenu_highlight');
				  jQuery('.header ul li.'+getClass).addClass('current-menu-item onepagemenu_highlight'); 
				  },
				});
			jQuery(window).on("scroll", function() {
				if (jQuery(this).scrollTop() < 300) {
					jQuery('.header ul li').removeClass('current-menu-item onepagemenu_highlight');
				}
			});
		}else{
				new Waypoint.Inview({
				  element: jQuery('#'+getClass)[0],
				  enter: function(direction) {  jQuery('.header ul li.'+getClass).addClass('current-menu-item onepagemenu_highlight'); },
				  exited: function(direction) { jQuery('.header ul li.'+getClass).removeClass('current-menu-item onepagemenu_highlight'); }
				});

		}
		}
	});
	//Scroll to the specific widget when clicked from other pages
	jQuery(window).on("load", function() {
		if(window.location.hash) {
			var currenturl = window.location.href;

			jQuery('#topmenu a[href="'+currenturl+'"], #topbar_menu a[href="'+currenturl+'"], #footer_menu ul li a[href="'+currenturl+'"]').each(function(){

				var matchedmenu = jQuery(this).parent();
				var getClass = jQuery.grep(matchedmenu.attr('class').split(" "), function(v, i){if( v.indexOf('optimizer_front_') === 0){ return v.indexOf('optimizer_front_') ===0; }else{ return v.indexOf('ast_') ===0; } }).join();
			
				if(jQuery('#'+getClass).length){
					jQuery('html, body').animate({scrollTop: jQuery('#'+getClass).offset().top -100}, 'slow');
				}
			});
			
		}
	});
	

	//Load Logo in Middle
	if(jQuery('.logo_middle #topmenu .menu-header').length !==0){ var menunum = jQuery('.logo_middle #topmenu ul.menu>li').not('li.menu-item.menu-item-language').length;}else{ var menunum = jQuery('.logo_middle #topmenu .menu ul>li').length;}
	var logopos = Math.round(menunum/2);
	jQuery('.logo_middle #topmenu ul.menu > li:nth-child('+logopos+'), .logo_middle #topmenu .menu>ul>li:nth-child('+logopos+')').after('<div class="logo">'+jQuery('.logo_middle .logo').html()+'</div>');
	jQuery('.logo_middle, .logo_middle #topmenu .logo').animate({"opacity": "1"});
	jQuery('.logo_middle #topmenu ul.menu>li').slice( 0, logopos ).wrapAll('<div class="logobefore"></div>');
	jQuery('.logo_middle #topmenu .logo').each(function () { jQuery(this).nextAll('li').wrapAll('<div class="logoafter"/>'); });
	

	//CENTER MENU ITEMS VERTICALLY FOR MENU STYLE2
	jQuery('.logo_middle #topmenu').waitForImages(function() {
		jQuery('.logo_middle #topmenu .menu-item, #topmenu .head_soc').not('.logo_middle #topmenu .menu-item .menu-item').css({ "bottom":(jQuery(".logo_middle #topmenu").height() / 2) /2});
	});
	
	//Slider empty content
	jQuery('.acord_text p:empty, .acord_text h3 a:empty, .nivoinner h3 a:empty').css({"display":"none"});


	//Equal height - BLOCKS
	jQuery('.midrow_blocks_wrap').each(function(index, element) {
		jQuery(this).waitForImages(function() {
			jQuery(this).find('.midrow_block').matchHeight({ property: 'min-height', byRow: 'height'});
		});
    });
	
	//Equal Heights - Blog Page
	jQuery('.page_blog_wrap .lay4, .page_blog_wrap .lay2').each(function(index, element) {
		jQuery(this).waitForImages(function() {
			jQuery(this).find('.hentry').matchHeight({ property: 'min-height', byRow: 'height'});
		});
    });
	
	//if Blocks image has image link and the image is set as background
	jQuery('.hasimglink').each(function(index, element) {
		var blocklink = jQuery(this).find('.block_img a').attr('href');
		jQuery(this).find('.mid_block_content').wrap('<a class="blockimglink" href="'+blocklink +'"></a>');
	});

	
	//Layout1 Animation
	jQuery(".lay1").each(function(index, element) {
		var divs = jQuery(this).find(".hentry");
		for(var i = 0; i < divs.length; i+=3) {
		  divs.slice(i, i+3).wrapAll("<div class='ast_row'></div>");
		}
		if (jQuery(window).width() < 1200) {
			var flaywidth = jQuery(this).find(".hentry").width();
			jQuery(this).find('.post_image').css({"maxHeight":(flaywidth * 66)/100});
		}
    });

	jQuery('.lay1 .postitle a:empty').closest("h2").addClass('no_title');
	jQuery('.no_title').css({"padding":"0"});
	
	jQuery('.lay1 h2.postitle a').each(function() {
        if(jQuery(this).height() >80){   jQuery(this).parent().parent().parent().addClass('lowreadmo');   }
    });
	jQuery('.lts_layout1 .listing-item h2').each(function() {
        if(jQuery(this).outerHeight() >76){   jQuery(this).parent().addClass('lowreadmo');   }
    });
	
	// TO_TOP
	jQuery(window).on("scroll", function() {
		if (jQuery(this).scrollTop() > 800) {
			jQuery(".to_top").fadeIn('slow');
		} else {
			jQuery(".to_top").fadeOut('fast');
		}
	});
	jQuery(".to_top").on('click',function() {
	  jQuery("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});

	
	//Divider icon style
	jQuery('.div_middle i.fa-minus').after('<i class="fa fa-minus"></i><i class="fa fa-minus"></i>');
	jQuery('.homeposts_title.title_border-center, .homeposts_title.title_border-left, .homeposts_title.title_border-right, .about_inner.title_border-center, .about_inner.title_border-left, .about_inner.title_border-right').each(function(index, element) {
        var wtitle = jQuery(this).find('.home_title span, .block_header span, .about_header span');
		var wstitle = jQuery(this).find('.home_subtitle');
			if(wtitle.width() > wstitle.width()){  jQuery(this).find('.div_left, .div_right').css({"width":"calc(47% - "+wtitle.width() / 2+"px)"});  }
			if(wtitle.width() < wstitle.width()){  jQuery(this).find('.div_left, .div_right').css({"width":"calc(47% - "+wstitle.width() / 2+"px)"});  }
			if(jQuery(this).find('.home_title span, .block_header span').length == 0 && jQuery(this).find('.home_subtitle').length == 0){  jQuery(this).addClass('widget_notitle');  }
    });

	//STICKY SINGLE SHARE LEFT ICONS
	//jQuery(".share_pos_left").stick_in_parent();
	//Share Buttons move after:
	jQuery('.share_foot.share_pos_after').appendTo(".single_post_content");

	//STATIC SLIDER IMAGE FIXED
	jQuery('.stat_has_img').waitForImages(function() {
		var statimg = jQuery(".stat_has_img .stat_bg_img").attr('src');
      var statimgAlt = jQuery(".stat_has_img .stat_bg_img").attr('alt');
		var body_size = jQuery('.stat_has_img .stat_content_inner .center').height() + 120;
		var statimgheight = jQuery(".stat_has_img .stat_bg_img").height() + jQuery(".header").height();
		if(body_size > statimgheight){var statimgheight = body_size + jQuery(".header").height();}
		var hheight = jQuery(".header").height();
		
		jQuery("body.home").prepend('<div class="stat_bg" style="height:'+statimgheight+'px"><img src="'+statimg+'" alt="'+statimgAlt+'" /></div><div class="stat_bg_overlay overlay_off" style="height:'+statimgheight+'px" />');
		jQuery('#slidera').css({"minHeight":"initial"});
		jQuery('.home .stat_has_img .stat_bg_img').css('opacity', 0);

		//Static Slider Overlay on scroll
		var overlayon = jQuery(".home .stat_has_img");
		overlayon.waypoint({  handler: function(direction) {   jQuery('.home .stat_bg_overlay').removeClass("overlay_off").addClass("overlay_on");  },   offset: '-170px'   });
		
		var overlayoff = jQuery(".home .stat_has_img");
		overlayoff.waypoint({  handler: function(direction) {   jQuery('.home .stat_bg_overlay').removeClass("overlay_on").addClass("overlay_off");;  },   offset: '-90px'   });
		
		//Slider Image Resize Function v0.4.5
		jQuery(window).on("resize", function() {
				var body_size = jQuery('.stat_bg_img').height();
				jQuery('#stat_img, .stat_bg, .stat_bg img, .stat_bg_overlay').css('height',body_size);

		});
		
	});	
	
	
	jQuery('.stat_has_img').waitForImages(function() {
		if (jQuery(window).width() > 480) {	
			var resizeTimer;
			jQuery(window).on("load resize", function() {
			  clearTimeout(resizeTimer);
			  resizeTimer = setTimeout(function() {
				var body_size = jQuery('.stat_has_img .stat_content_inner .center').height() + 120;
				jQuery('#stat_img, .stat_bg, .stat_bg img, .stat_bg_overlay').css('min-height',body_size);
			  }, 50);
			});
		}
	});

		
		
jQuery(window).on("load resize", function() {
	if (jQuery(window).width() <= 480) {	
		jQuery(".stat_bg_img").css({"opacity":"0"});
		jQuery('.stat_content_inner').waitForImages(function() { jQuery("#stat_img").height(jQuery(".stat_content_inner").height());  });
		var statbg = jQuery(".stat_bg_img").attr('src');
		jQuery(".stat_has_img").css({"background":"url("+statbg+")", "background-repeat":"no-repeat", "background-size":"cover"});
		jQuery('.has_sticky_header .header').waitForImages(function() {

		});
	}
	if (jQuery(window).width() > 480) {	
		var statbg = jQuery(".stat_bg_img").attr('src');
		jQuery(".stat_has_img").css({"background":"url("+statbg+") top center", "background-repeat":"no-repeat", "background-size":"cover"});
		jQuery('.has_trans_header .stat_content_inner, .has_trans_header .header').waitForImages(function() { 
			var mhheight = jQuery(".has_trans_header .header").height();
			jQuery(".has_trans_header .stat_content_inner").css({"paddingTop":mhheight});
			
		});
		jQuery('.page_header_transparent .has_header_img .pagetitle_wrap').css({"top":jQuery(".page_header_transparent .header").height()});
	}
});
//WAYPOINT ANIMATIONS
if (jQuery(window).width() > 480) {	
	jQuery('.home #zn_nivo, .home #accordion').waitForImages(function() {
      //Header color on scroll
      var sliderheight = jQuery('.home #zn_nivo, .home #accordion').height();
      var stickyheadwaypoint = jQuery(".home #zn_nivo, .home #accordion");
      stickyheadwaypoint.waypoint({  handler: function(direction) { jQuery(".is-sticky .header").addClass("headcolor"); },   offset: '-'+sliderheight/2+'px'  });
      stickyheadwaypoint.waypoint({  handler: function(direction) { jQuery(".is-sticky .header").removeClass("headcolor"); },   offset: '-90px'  });
	});	
}

//Next Previous post button Link
    var nlink = jQuery('.ast-next > a').attr('href');
    jQuery('.right_arro').attr('href', nlink);

    var llink = jQuery('.ast-prev > a').attr('href');
    jQuery('.left_arro').attr('href', llink);

	//Gallery Template
	jQuery("#sidebar .widget_pages ul li a, #sidebar .widget_meta ul li a, #sidebar .widget_nav_menu ul li a, #sidebar .widget_categories ul li a, #sidebar .widget_recent_entries ul li a, #sidebar .widget_recent_comments ul li, #sidebar .widget_archive ul li, #sidebar .widget_rss ul li").prepend('<i class="fa-angle-double-right"></i> ');
	jQuery('#sidebar .fa-angle-double-right').css({"opacity":"0.5"});



	//Mobile Menu
		var padmenu = jQuery("#simple-menu").html();
		
		jQuery("#simple-menu").on('click',function(e) {
				e.preventDefaultEvents;
				e.preventDefault();
		});
		jQuery('#simple-menu').sidr({name: 'sidr-main', source: '#topmenu',  side: 'right'});
		
		//Make Icons show up in sidr
		jQuery('.sidr-class-menu-item i').attr('class', function(_, klass) {
			if(klass){
				return 'fa fa' + klass.split('-fa').pop();
			}
		});
			
		jQuery("#topmenu .head_soc").clone().appendTo(".sidr-class-head_soc");

		//Topbar Hamburger Menu

		jQuery('#topbar-hamburger-menu').sidr({ name: 'sidr-topbar', source: '#topbar_menu', side: 'right'});
		jQuery(".sidr").prepend("<div class='pad_menutitle'><i class='fa fa-bars'></i><span><i class='fa-times'></i></span></div>");
		
		jQuery(".pad_menutitle span").on('click',function() {
			jQuery.sidr('close', 'sidr-main');
			jQuery.sidr('close', 'sidr-topbar');
			preventDefaultEvents: true;
		});
		
	//Hamburger Onepage Scroll Compatibility
	jQuery('.sidr-class-menu li[class^="sidr-class-optimizer_front_"], .sidr-class-menu li[class^="sidr-class-ast_"]').each(function(){
		var getClassraw = jQuery.grep(this.className.split(" "), function(v, i){return v.indexOf('sidr-class-optimizer_front_') === 0; }).join();
		var getClassrawo = jQuery.grep(this.className.split(" "), function(v, i){return v.indexOf('sidr-class-ast_') === 0; }).join();
		var getClass = getClassraw.replace("sidr-class-", "");
		var getClasso = getClassrawo.replace("sidr-class-", "");

		if(jQuery('#'+getClass).length){
			jQuery('.sidr-class-menu .'+getClassraw+' a').on('click',function(e) {e.preventDefault(); jQuery('html, body').animate({scrollTop: jQuery('#'+getClass).offset().top -100}, 'slow'); });
		}
		//For Other optimizer widgets
		if(jQuery('#'+getClasso).length){
			jQuery('.sidr-class-menu .'+getClassrawo+' a').on('click',function(e) {e.preventDefault(); jQuery('html, body').animate({scrollTop: jQuery('#'+getClasso).offset().top -100}, 'slow'); });
		}
		
	});	
	
	jQuery('.sidr-class-menu_arrow').on( 'click', function ( e ) {
			e.preventDefault();  e.stopPropagation();
			jQuery(this).addClass('sidrsubmenu_on');
			jQuery(this).parent().parent().find('.sidr-class-sub-menu').eq(0).slideToggle();
	});	
	
	//If the topmenu is empty remove it
	if (jQuery(window).width() < 1025) {
		if(jQuery("#topmenu:has(ul)").length == 0){
			jQuery('#simple-menu, #dropdown-menu').addClass('hide_mob_menu');
		}
	}
	
	//Dropdown Mobile Menu
	jQuery("#dropdown-menu").on('click',function(e) {
      if(!jQuery(this).hasClass('mobile_dropdown_on')){
         jQuery('#topmenu.mobile_dropdown').css("top", jQuery('.head_inner').outerHeight()).slideDown(300);
         jQuery("#dropdown-menu i.fa-chevron-down").removeClass('fa-chevron-down').addClass('fa-chevron-up');
         jQuery(this).addClass('mobile_dropdown_on');
      }else{
         jQuery('#topmenu.mobile_dropdown').slideUp(300);
         jQuery("#dropdown-menu i.fa-chevron-up").removeClass('fa-chevron-up').addClass('fa-chevron-down');
         jQuery(this).removeClass('mobile_dropdown_on');
      }
	});
	

//NivoSlider Navigation Bug Fix
if (jQuery(window).width() < 480) {
	jQuery(".nivo-control").text('');
}
	
	jQuery('#zn_nivo img, .clients_logo img, .static_gallery img').unveil();
	
	jQuery(window).on('load', function(){
			jQuery("#zn_nivo img, .static_gallery img").trigger("unveil");
						

		//slider porgressbar loader
		jQuery('.slider-wrapper, .stat_has_slideshow').waitForImages(function() {
			setTimeout(function() {
				jQuery('.slider-wrapper, .slideshow_loading').css({"minHeight":"initial"});	
				jQuery("#zn_nivo, .nivo-controlNav, #slide_acord, .nivoinner").css({"display":"block"});
				jQuery(".pbar_wrap, .pbar_overlay").fadeOut();
				jQuery("#zn_nivo").removeClass('slider_loading');
				jQuery(".static_gallery").removeClass('stat_has_slideshow slideshow_loading');
				
			}, 200);
			
		});
	});



	//TESTIMONIAL SLIDE
        jQuery('.home_testi .looper').on('shown', function(e){
            jQuery('.looper-nav > li', this).removeClass('active').eq(e.relatedIndex).addClass('active');
        });
	//jQuery('.testi_col3 ul.looper-inner li').matchHeight({ property: 'min-height', byRow: 'height'});	
	
	
	//HEADER SWITCH
	jQuery('#slidera').has('.stat_has_img').addClass('selected_stat');
	jQuery('#slidera').has('.slide_wrap').addClass('selected_slide');
	


	if (jQuery(window).width() < 1025) {
	 jQuery('.dlthref').removeAttr("href");
	}

	
	//WIDGET BORDER
	jQuery("#sidebar .widget .widgettitle, .related_h3, h3#comments, #reply-title").after("<span class='widget_border' />");
	
	//Rearragnge comment form box
	jQuery(".comm_wrap").insertAfter(".comment-form-comment");
	
	//404 class is not being added in body
	jQuery('body').has('.error_msg').addClass('error404');
	
	//TOP Header Search
	jQuery('.head_search').each(function() {
      jQuery(this).find('i').on('click',function(){
         if(!jQuery('.header_s.head_search').hasClass('head_s_on')){
          jQuery(this).parent().find('form').css({"width":"200px"});
          jQuery('.header_s.head_search').addClass('head_s_on')
         }else{
          jQuery(this).parent().find('form').css({"width":"0px"});
          jQuery('.header_s.head_search').removeClass('head_s_on');
         }
      });	
   });
	
	//Search in Hamburger
	if (jQuery(window).width() < 961) {  
		jQuery('.header_s.head_search').insertAfter('#topmenu'); 
		//jQuery('.head_s_on .fa-search').on("click", function(e) { console.log('i clicked');  jQuery('.header_s.head_search').removeClass('head_s_on'); }); 
	}
	jQuery('.sidr-inner').on("click", '.sidr-class-head_search', function(e) {
		console.log('search clicked');
		jQuery('.header_s.head_search').addClass('head_s_on');
		jQuery.sidr('close', 'sidr-main');
	});
	
	
	//MAILCHIMP
	jQuery('.mc-field-group').each(function() {
        var placeholder = jQuery(this).find('label').text();
		jQuery(this).find('input').attr('placeholder', ''+placeholder+'');
    });
	//Subscribe2
	jQuery('.ast_subs_form').has("#s2email").addClass('ast_subscribe2');
	

	//Next-Previous Post Image Check
	jQuery(".nav-box.ast-prev, .nav-box.ast-next").not(":has(img)").addClass('navbox-noimg');
	
	
	//Make sure the footer always stays to the bottom of the page when the page is short
	jQuery(window).on("load", function() {
		var docHeight = jQuery(window).height();
		var footerHeight = jQuery('#footer').height();
		var footerTop = jQuery('#footer').position().top + footerHeight;
		   
		if (footerTop < docHeight) {  jQuery('#footer').css('margin-top', 1 + (docHeight - footerTop) + 'px');  }
	
		/*Widget Parallax*/
/*		if (jQuery(window).width() >= 480) {	
			jQuery('.parallax_img').each(function(index, element) {
			   jQuery(this).parallax({naturalHeight: jQuery(this).parent().outerHeight(), bleed: 50, iosFix: true, androidFix: true}).css({"backgroundImage":"none"});
			});
		}*/
	});
	
	//Woocommerce
	jQuery('.lay1.optimposts, .lay2.optimposts, .lay4.optimposts').each(function(index, element) {  jQuery(this).waitForImages(function() { jQuery(this).find('.type-product').matchHeight({property: 'min-height'});  });  });
	jQuery('.lay1.optimposts .type-product').each(function(index, element) {
		if (jQuery(window).width() >= 960) {	jQuery(this).find('.button.add_to_cart_button').prependTo(jQuery(this).find('.imgwrap'));  }
		jQuery(this).find('span.price').prependTo(jQuery(this).find('.post_image '));
    });
	
	jQuery('.header li.woocom_cart_icon.menu-item a').on("click", function(e) {
      e.preventDefault();
      if(!jQuery('#optimizer_minicart_wrap').hasClass('optimizer_minicart_wrap--active')){
         jQuery('#optimizer_minicart_wrap').addClass('optimizer_minicart_wrap--active').fadeIn();
      }else{
         jQuery('#optimizer_minicart_wrap').removeClass('optimizer_minicart_wrap--active').fadeOut();
      }
	});
	
	//MENU WIDGET & TOPBAR MENU DROPDOWN
	jQuery('#frontsidebar .widget_nav_menu ul.menu li, #topbar_menu ul li').not('#topbar_menu ul > li.mega-menu-item').hoverIntent( function(){
		jQuery(this).find('ul').first().fadeIn();
	}, function(){
		jQuery(this).find('ul').first().fadeOut();
	});

	//Hide the Next Previous Post area when empty
	if( !jQuery('body.single #ast_nextprev .ast-prev').length && !jQuery('body.single #ast_nextprev .ast-next').length){jQuery('body.single #ast_nextprev').hide()}
	
	//Portfolio Share Buttons
	jQuery('.portfolio_wrapper .social_buttons').append('<div class="lgn_more"><i class="fa fa-ellipsis-h"></i></div>');
	jQuery('.portfolio_wrapper .social_buttons .lgn_stmbl, .portfolio_wrapper .social_buttons .lgn_del, .portfolio_wrapper .social_buttons .lgn_digg, .portfolio_wrapper .social_buttons .lgn_email, .portfolio_wrapper .social_buttons .lgn_print').wrapAll('<div class="social_more" />');
	jQuery('.portfolio_wrapper .lgn_more').on('click',function(e) {
      if(!jQuery('.portfolio_wrapper .social_more').hasClass('social_more_show')){
         jQuery('.portfolio_wrapper .social_more').addClass('social_more_show');
      }else{
         jQuery('.portfolio_wrapper .social_more').removeClass('social_more_show');
      }
	});
	
	//IF iOS, Hide the video slider:
	if(getMobileOperatingSystem() == 'iOS'){
		jQuery('body').addClass('is-ios');
	}else{
		jQuery('body').addClass('not-ios');
	}
	//Check If Safari
	if(isSafari == true){
		jQuery('body').addClass('is_safari');
	}
	
	//Newsletter--------------
	jQuery('.optim_newsletter_form .mimi_field').each(function(index, element) { 	jQuery(this).find('br').remove(); 	});
	jQuery('.optim_newsletter_form label').each(function(index, element) { 
		if(jQuery(this).next().is('input')){
			jQuery(this).addClass('placeholder_label');
		}
	});
	
	jQuery('.optim_newsletter_form input[type="text"], .optim_newsletter_form input[type="email"], .optim_newsletter_form input[type="phone"]').each(function(index, element) { 
		if(jQuery(this).prev().is('label') ){
			var attr = jQuery(this).attr('placeholder');
			if (typeof attr == typeof undefined || attr == false) {
			jQuery(this).attr('placeholder', jQuery(this).prev().text());
			}
		}
	});
	
	//Single Header Style
	jQuery('.single.single_style_header .single_post .postitle, .single.single_style_header .single_post .single_metainfo').appendTo('.single.single_style_header .post_head_content')

});

// var isInViewport = function (elem) {
//    var rect = elem.getBoundingClientRect();
//    return (rect.bottom >= 0 && rect.right >= 0 && rect.top <= (window.innerHeight || document.documentElement.clientHeight) && rect.left <= (window.innerWidth || document.documentElement.clientWidth));
// };

if(!document.querySelector('body.customizer-prev')){
   var widgetsWithAnimation = document.querySelectorAll('[data-animation]');
   var allWidgetAnimTargets = [];
   for (var i = 0; i < widgetsWithAnimation.length; ++i) {
      var widgetID = '#'+jQuery(widgetsWithAnimation[i]).attr('id');
      var animType = 'opti'+jQuery(widgetsWithAnimation[i]).attr('data-animation');
      var animTarget = 'widget_wrap';
      if(widgetID.includes('optimizer_front_text')){  animTarget = 'text_block_wrap'; }
      if(widgetID.includes('optimizer_front_blocks')){  animTarget = 'midrow_wrap'; }
      if(widgetID.includes('optimizer_front_slider')){  animTarget = 'the_slider_widget '; }
      
      if(animTarget && animType){
         var animTarget = jQuery(widgetID+' .'+animTarget);
         animTarget.css('opacity', 0);
         allWidgetAnimTargets.push({target:animTarget, animation: animType});
      }
    }
   
   jQuery(function() {
      allWidgetAnimTargets.forEach(function(elm){
         elm.target.waypoint({  handler: function(direction) {   elm.target.addClass(elm.animation);  },   offset: '50%'   });
      });
   });
}
