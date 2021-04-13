jQuery.noConflict();
var customizerLoaded = false;
/** Fire up jQuery - let's dance! */
jQuery(function($) {
	
	//Get customizer settings:
	//console.log(_wpCustomizeSettings);
	//console.log(_wpCustomizeWidgetsSettings);
		
	$('#footlinks').appendTo('#customize-controls');
	
	/*SETTINGS*/
	$('.optim_settings').on('click',function() {
		$(this).addClass('opactive');
		$('#optimizer_settings').animate({"left":"-280px"});
	 });
	 $('.optim_settings_close').on('click',function() {
		$('.optim_settings').removeClass('opactive');
		$('#optimizer_settings').animate({"left":"-830px"});
    });
	
	$('.optim_presets').on('click',function() {
		$(this).addClass('opactive');
		$('#preset_options').fadeIn();
	 });
	 $('.preset_close').on('click',function() {
		$('.optim_presets').removeClass('opactive');
		$('#preset_options').fadeOut();
    });
	

	 /*SETTINGS Options Toggle*/
    $('.setting_option h4').on('click',function(){
      if(!$(this).parent().hasClass('setting_toggle')){
         $(this).parent().addClass('setting_toggle');
         $(this).next('.settings_toggle_inner').slideDown(200);
      }else{
         $(this).parent().removeClass('setting_toggle');
         $(this).next('.settings_toggle_inner').slideUp(200);
      }
	 });
	 
	 /*EXPAND*/
    $('.optim_expand').on('click', function(){ 
      if(!$(this).hasClass('opactive')){
         $(this).addClass('opactive');
         $('body').addClass('optimizer_expand');
         $('#customize-controls').animate({"width":"420px"});
         $('#optimizer_settings').animate({"width":"360px"});
      }else{
         $(this).removeClass('opactive');
         $('body').removeClass('optimizer_expand');
         $('#customize-controls').animate({"width":"330px"});
         $('#optimizer_settings').animate({"width":"270px"});
      }
	});




wp.customize.previewer.bind('ready', function() {
   if(!customizerLoaded){
      /*MOVE Frontpage Widget Section before footer widget are*/
      wp.customize.section( 'sidebar-widgets-front_sidebar' ).panel( 'front_panel' );
      wp.customize.section( 'sidebar-widgets-front_sidebar' ).priority( 11 );
      wp.customize.section( 'sidebar-widgets-sidebar' ).priority( 3 );
      wp.customize.section( 'sidebar-widgets-foot_sidebar' ).panel( 'footer_panel' );
      wp.customize.section( 'sidebar-widgets-foot_sidebar' ).priority( 1 );
      wp.customize.section( 'basic_sidebar_section' ).panel( 'widgets' );
      wp.customize.section( 'basic_sidebar_section' ).priority( 1 );
      if(!jQuery('#customize-theme-controls #accordion-section-nav').length && jQuery('#customize-theme-controls #accordion-panel-nav_menus').length){ 
         wp.customize.panel( 'nav_menus' ).priority( 1 ); 
      }
      if(jQuery('#customize-theme-controls #accordion-section-nav').length){
         wp.customize.section( 'nav' ).priority( 1 ); 
      }
      wp.customize.panel( 'widgets' ).priority( 2 );
      
      /*TOOLTIP*/
      jQuery('.customize-control-description').each(function() {
         jQuery(this).hide();
         var tipcontent = jQuery(this).text();
         jQuery(this).parent().find('.customize-control-title').first().append('<i class="fa fa-question-circle customize-tooltip"><span class="optim_tooltip">'+tipcontent+'<dl class="tipbottom" /></span></i>');
      });
         $('.customize-tooltip').hoverIntent(function(){ 
            var x = jQuery(this).position();  jQuery(this).find('span').css({"left":-x.left - 8}); jQuery(this).find('dl').css({"left": x.left + 8}); 
               jQuery(this).addClass('tipactive');
               jQuery(this).find('span').stop().fadeIn(300);
         },function(){
               jQuery(this).removeClass('tipactive');
            jQuery(this).find('span').fadeOut(300);
         });
         
         $('ul.accordion-section-content').each(function(index, element) {
                  $(this).find('.customize-control .optim_tooltip').addClass('first_tooltip').prepend('<dl class="tipbottom" />');
         });

      //Footer Tooltip
      jQuery('#footlinks a').each(function(index, element) {
         var footip = jQuery(this).attr('title');
         jQuery(this).append('<span class="footer_tooltip">'+footip+'<dl class="tipbottom" /></span>');
         jQuery(this).removeAttr('title');
      });
      jQuery('#customize-footer-actions .devices button').each(function(index, element) {
         var responsivetip = jQuery(this).find('.screen-reader-text').text();
         jQuery(this).append('<span class="footer_tooltip">'+responsivetip+'<dl class="tipbottom" /></span>');
      });

      jQuery('.button.change-theme').append('<span class="footer_tooltip">'+jQuery(this).attr('title')+'<dl class="tipbottom" /></span>');
      
      if(window.optimizer_widgetized_pages && window.optimizer_widgetized_pages.length > 0){
         jQuery("#sub-accordion-panel-widgets li[id^='accordion-section-sidebar-widgets-optimizer_']").each(function(){
               var sidebarID = jQuery(this).attr('id').replace('accordion-section-sidebar-widgets-', '');
               var sidebarPageURL = ''; var pageTitle = '';
               if(sidebarID){
                  optimizer_widgetized_pages.forEach( function(page) {
                     if(page.sidebar === sidebarID){
                        sidebarPageURL = page.url;
                        pageTitle = page.title;
                     }
                  });
               }
               if(sidebarPageURL){
                  jQuery(this).find('.accordion-section-title').append('<a class="optimizer_sidebar_preview_link" onclick="optimizer_preview_link(\''+sidebarPageURL+'\')" title="Open Page \''+pageTitle+'\'"><i class="fa fa-arrow-right" /></a>');
               }
         })
      }

      customizerLoaded = true;
   }
});



	//Section Description Tooltip
	setTimeout(function(){
		jQuery('.customize-section-description-container').each(function(index, element) {
			jQuery(this).find('.customize-section-description').before('<i class="fa fa-question section-desc-toggle"></i>');
      });

      jQuery('.section-desc-toggle').on('click',function(){ 
         console.log('.section-desc-toggle');
         if(jQuery(this).hasClass('fa-question')){
            jQuery(this).removeClass('fa-question').addClass('fa-times');
            jQuery(this).parent().find('.customize-section-description').slideDown(300);
         }else{
            jQuery(this).addClass('fa-question').removeClass('fa-times');
            jQuery(this).parent().find('.customize-section-description').slideUp(300);
         }
      });
   }, 1000);	
	
	//QUICKIE
	$('.wp-full-overlay-sidebar').prepend('<div class="quickie"><i class="optimizer_logo">O</i></div>');
	
	$('.wp-full-overlay-sidebar .quickie').after('<div class="quickie_text"><span class="logotxt"></span></div>');
	$('.quickie, .quickie_text, .logotxt').hover(function(){ 
			jQuery('.wp-full-overlay').addClass('quickiehover');
	},function(){
			jQuery('.wp-full-overlay').removeClass('quickiehover');
	});


	//Logo 
	$('.optimizer_logo').on('click', function(){
		$('.quickie i').removeClass('activeq');
		$('.wp-full-overlay').removeClass('quickiehover subsection-open');
		wp.customize.panel.each( function ( panel ) {  panel.collapse();});
		wp.customize.section.each( function ( section ) {  section.collapse();});
	});
	
	
	//Wordpress 4.7 FIXES------------------------
		if(objectL10n.wp4_7 == 'wp4_7'){
			jQuery('body').addClass('wp4_7');
		}
		
		//Wordpress 4.7 Section toggle
		jQuery(".wp4_7 #customize-theme-controls .control-section ").on("click", ".accordion-section-title", function(e) {
			$('.accordion-section').removeClass('sec_open'); 
			
			if( $(this).parent().has('.open')){
				setTimeout(function () { $('.control-section.open').parent().addClass('sec_open');  }, 50);
			}else{
				setTimeout(function () { $('.control-section.open').parent().removeClass('sec_open');   }, 50);
			}
			
		});
		//Wordpress 4.7 Widget Focus 
		wp.customize.previewer.bind( 'focus-widget-control', function(param){
			wp.customize.control.each( function ( control ) {  if(control.expanded) control.collapse();  });
			
			jQuery('.wp4_7 .accordion-section').removeClass('sec_open'); 
			setTimeout(function () { jQuery('.wp4_7 .control-section.open').parent().addClass('sec_open');  }, 100);
			
			var thewidgetid = param.replace( /^\D+/g, ''); 
			var thewidgetname = param.split("-")[0];
         if(thewidgetname && thewidgetid){
            if(wp.customize.control( 'widget_'+thewidgetname+'['+thewidgetid+']' ).expanded() === false){
               wp.customize.control( 'widget_'+thewidgetname+'['+thewidgetid+']' ).focus();
            }
         }
			
		} );
	//Wordpress 4.7 - Group All Controls in sections
	$('.customize-pane-child:not(.control-section-nav_menu )').each(function(index, element) {
		var ariaid = $(this).attr('id');
        $(this).insertAfter('li.control-subsection[aria-owns="'+ariaid+'"] h3');
    });
	/*Custom Sections Added by Plugins*/
	$('.accordion-section-content').not('.control-section-nav_menu, #sub-accordion-section-colors').each(function(index, element) {
		if(! $(this).parent().parent().hasClass("control-panel-content")) {
			if($(this).has('.customize-control')){
				$(this).addClass('custom_section');
			}
		}
    });
	//-------------------------------------------


	
	//REMOVE NOW CUSTOMIZING THEME INFO
	$('#customize-info').remove();
	
	
	//WIDGET PRESETS
	jQuery('#widget_presets i.fa.fa-times').on('click', function(){
		jQuery('#widget_presets, .tour_backdrop').fadeOut();
	});
		
	function optim_preset_widgets(target){
		jQuery('.preset_widgets_button').on('click', function(){
			jQuery('#widget_presets, .tour_backdrop').fadeIn();
			jQuery(".preset_tabs img").unveil();
		});
		if(target == ''){}else{ jQuery('.widget_preset_left li').removeClass('.active_presw'); jQuery('.widget_preset_left li').eq(target).addClass('.active_presw'); }
	}
	
	optim_preset_widgets();

});

function optimizer_preview_link(pageURL){
   console.log(pageURL);
   wp.customize.previewer.send( 'OPTIMIZER_CUSTOMIZER_LOAD_URL', pageURL );
}

/*REFACTOR CONTROLS*/
jQuery(window).on('load', function(){

	//Move Switch theme button to footer
	jQuery('.change-theme').prependTo('#footlinks');
	jQuery('.change-theme').attr('title',objectL10n.switchtheme).html('<i class="fa fa-random"></i>');
	jQuery('.button.change-theme').append('<span class="footer_tooltip">'+jQuery('.button.change-theme').attr('title')+'<dl class="tipbottom" /></span>');
	
	//===QUCIKIES===
	//ASSIGN QUICKIE ICONS
	jQuery('#accordion-panel-basic_panel').attr('data-qicon', 'fa-sliders');  jQuery('#accordion-panel-header_panel').attr('data-qicon', 'fa-credit-card');
	jQuery('#accordion-panel-front_panel').attr('data-qicon', 'fa-desktop');  jQuery('#accordion-panel-footer_panel').attr('data-qicon', 'fa-copyright');
	jQuery('#accordion-panel-singlepages_panel').attr('data-qicon', 'fa-indent');  jQuery('#accordion-panel-misc_panel').attr('data-qicon', 'fa-cogs');
	jQuery('#accordion-panel-nav_menus').attr('data-qicon', 'fa-bars');  jQuery('#accordion-panel-widgets').attr('data-qicon', 'fa-codepen');
	jQuery('#accordion-panel-help_panel').attr('data-qicon', 'fa-life-saver');
	
	//INITIATE QUCIKIES
	jQuery('li.control-panel').each(function(index, element) {
        var rawtitle = jQuery(this).find('h3.accordion-section-title').contents().get(0).nodeValue;
		var quickieidraw = jQuery(this).attr('id');
		var quickieid = quickieidraw.replace("accordion-panel-", "");
		if(jQuery(this).attr('data-qicon')){   var qicon = jQuery(this).attr('data-qicon');  }else{  var qicon ='fa-cog';  }
		jQuery('.quickie').append('<i class="fa '+qicon+' quickie_'+quickieid+'"><dl>'+rawtitle+ '</dl></i>');
		
		jQuery('.quickie_'+quickieid).on('click', function(){  
			jQuery('.quickie i, .quickie_text dl').removeClass('activeq'); jQuery(this).addClass('activeq'); wp.customize.panel( quickieid ).focus(); 	
			jQuery('.wp-full-overlay').removeClass('quickiehover subsection-open'); 
		});
		
		jQuery('#'+quickieidraw).find('h3').on('click', function(){ 
			jQuery('.quickie i, .quickie_text dl').removeClass('activeq'); jQuery('.quickie_'+quickieid).addClass('activeq');
		});
		
    });
	

		jQuery('.quickie i, .quickie_text dl').on('click', function(){ 
			wp.customize.section.each( function ( section ) {section.collapse();}); 
		});
		
		jQuery('.accordion-section.control-subsection h3').on('click',function() {
			if(jQuery('.wp-full-overlay').find('.accordion-section.control-subsection.open').length != 0){
				jQuery( '.wp-full-overlay').removeClass('subsection-open').addClass('subsection-open');
			}else{
				jQuery( '.wp-full-overlay').removeClass('subsection-open');
			}
		});
		

		//before WORDPRESS 4.3 Menus Section
		if(jQuery('#customize-theme-controls #accordion-section-nav').length){
			jQuery('#accordion-section-nav').attr('data-qicon', 'fa-bars'); 
			jQuery('#accordion-section-nav').each(function(index, element) {
				var rawtitle = jQuery(this).find('h3.accordion-section-title').contents().get(0).nodeValue;
				var quickieidraw = jQuery(this).attr('id');
				var quickieid = quickieidraw.replace("accordion-section-", "");
				var qicon = jQuery(this).attr('data-qicon');
				jQuery('.quickie_misc_panel').after('<i class="fa '+qicon+' quickie_'+quickieid+'"><dl>'+rawtitle+ '</dl></i>');
				
				jQuery('.quickie_'+quickieid).on('click', function(){  
					jQuery('.quickie i, .quickie_text dl').removeClass('activeq'); jQuery(this).addClass('activeq'); wp.customize.section( quickieid ).focus(); 
					jQuery('.wp-full-overlay').removeClass('quickiehover subsection-open'); 
				});
				
				jQuery('#'+quickieidraw).find('h3').on('click', function(){ 
					jQuery('.quickie i, .quickie_text dl').removeClass('activeq'); jQuery('.quickie_'+quickieid).addClass('activeq');
				});
				
			});
		}
		//Hide Customizer Navigation control icon if the navigation control itself is not present
		if(!jQuery('#customize-theme-controls #accordion-section-nav').length){
			jQuery('.quickie_nav').hide();
		}
		
		/*MINI Controls*/
		jQuery('.mini_control').each(function(index, element) {
            jQuery(this).closest('li.customize-control').addClass('has_mini_control');
        });
		
		/*FONT CONTROL NAMES*/
		jQuery('#customize-control-logo_font_family').before('<h4 class="font_controlheader">'+objectL10n.sitettfont+'</h4>');
		jQuery('#customize-control-ptitle_font_family').before('<h4 class="font_controlheader no_border">'+objectL10n.menufont+'</h4>');
		jQuery('#customize-control-content_font_family').before('<h4 class="font_controlheader content_border">'+objectL10n.logofont+'</h4>');
		

		/*LOGO CONTROL TAB*/
		jQuery('#customize-control-logo_image_id, #customize-control-home_logo_id, #customize-control-logo_max_width').hide('');
		jQuery('#customize-control-blogname, #customize-control-blogdescription, #accordion-section-headlogo_section .font_controlheader, #customize-control-logo_font_family, #customize-control-logo_font_subsets, #customize-control-logo_font_size, #customize-control-logo_color_id, #customize-control-tagline_font_size').addClass('activelogoption');
		
		jQuery('#customize-control-blogname').addClass('activelogoption').before('<ul class="logo_control_tabs"><li class="txtlogo activlogo"><a>Text</a></li><li class="imglogo"><a>'+objectL10n.image+'</a></li></ul>');
		
	jQuery('.logo_control_tabs li.txtlogo a').on('click', function(){ 
		jQuery('.logo_control_tabs li').removeClass('activlogo');	jQuery(this).parent().addClass('activlogo');
		jQuery('#customize-control-blogname, #customize-control-blogdescription, #accordion-section-headlogo_section .font_controlheader, #customize-control-logo_font_family, #customize-control-logo_font_subsets, #customize-control-logo_font_size, #customize-control-logo_color_id, #customize-control-tagline_font_size').addClass('activelogoption').show();
		jQuery('#customize-control-logo_image_id, #customize-control-home_logo_id, #customize-control-logo_max_width').removeClass('activelogoption');
	});
	
	jQuery('.logo_control_tabs li.imglogo a').on('click', function(){ 
		jQuery('.logo_control_tabs li').removeClass('activlogo');	jQuery(this).parent().addClass('activlogo');
		jQuery('#customize-control-logo_image_id, #customize-control-home_logo_id, #customize-control-logo_max_width').addClass('activelogoption');
		jQuery('#customize-control-blogname, #customize-control-blogdescription, #accordion-section-headlogo_section .font_controlheader, #customize-control-logo_font_family, #customize-control-logo_font_subsets, #customize-control-logo_font_size, #customize-control-logo_color_id, #customize-control-tagline_font_size').removeClass('activelogoption').hide();
	});
		

		//CTA Buttons
		jQuery('#customize-control-static_cta1_text').before('<h4 class="control_cta1_title">'+objectL10n.button1+'</h4>');
		jQuery('#customize-control-static_cta2_text').before('<h4 class="control_cta2_title">'+objectL10n.button2+'</h4>');
	
		var cta1controls = jQuery('#customize-control-static_cta1_text, #customize-control-static_cta1_link, #customize-control-static_cta1_txt_style, #customize-control-static_cta1_bg_color, #customize-control-static_cta1_txt_color');
		var cta2controls = jQuery('#customize-control-static_cta2_text, #customize-control-static_cta2_link, #customize-control-static_cta2_txt_style, #customize-control-static_cta2_bg_color, #customize-control-static_cta2_txt_color');
		
      cta1controls.addClass('hidectas');
      cta2controls.addClass('hidectas');
      
		jQuery('.control_cta1_title').on('click',function() {  
         if(!jQuery(cta1controls).hasClass('showctas')){
            cta1controls.removeClass('hidectas').addClass('showctas');  
         }else{
            cta1controls.addClass('hidectas').removeClass('showctas');  
         } 
      });
      
      jQuery('.control_cta2_title').on('click',function() {  
         if(!jQuery(cta2controls).hasClass('showctas')){
            cta2controls.removeClass('hidectas').addClass('showctas');  
         }else{
            cta2controls.addClass('hidectas').removeClass('showctas');  
         } 
      });
		
		/*SLIDER CONTROL TAB*/
		jQuery('#customize-control-static_image_id, #customize-control-static_gallery, #customize-control-static_video_id, #customize-control-slide_ytbid, #customize-control-static_vid_loop, #customize-control-static_vid_mute').hide('');
		
		jQuery('#customize-control-static_image_id').addClass('activebgoption').before('<ul class="slider_control_tabs"><li class="imgbg activbg"><a>'+objectL10n.image+'</a></li><li class="slideshowbg"><a>'+objectL10n.slideshow+'</a></li><li class="vdobg"><a>'+objectL10n.video+'</a></li></ul>');
		
	jQuery('.slider_control_tabs li.imgbg a').on('click', function(){ 
		jQuery('.slider_control_tabs li').removeClass('activbg');	jQuery(this).parent().addClass('activbg');
		jQuery('#customize-control-static_gallery, #customize-control-static_slide_timer, #customize-control-static_video_id, #customize-control-slide_ytbid, #customize-control-static_vid_loop, #customize-control-static_vid_mute').removeClass('activebgoption');
		jQuery('#customize-control-static_image_id').addClass('activebgoption');
	});
	
	jQuery('.slider_control_tabs li.slideshowbg a').on('click', function(){ 
		jQuery('.slider_control_tabs li').removeClass('activbg');	jQuery(this).parent().addClass('activbg');
		jQuery('#customize-control-static_image_id').attr('style', '').hide();
		jQuery('#customize-control-static_image_id, #customize-control-static_slide_timer, #customize-control-static_video_id, #customize-control-slide_ytbid, #customize-control-static_vid_loop, #customize-control-static_vid_mute').removeClass('activebgoption');
		jQuery('#customize-control-static_gallery, #customize-control-static_slide_timer').addClass('activebgoption');
	});
	
	jQuery('.slider_control_tabs li.vdobg a').on('click', function(){ 
		jQuery('.slider_control_tabs li').removeClass('activbg');	jQuery(this).parent().addClass('activbg');
		jQuery('#customize-control-static_image_id').attr('style', '').hide();
		jQuery('#customize-control-static_gallery, #customize-control-static_image_id, #customize-control-static_slide_timer').removeClass('activebgoption');
		jQuery('#customize-control-static_video_id, #customize-control-slide_ytbid, #customize-control-static_vid_loop, #customize-control-static_vid_mute').addClass('activebgoption');
	});

	//Slider Dropdown Select
	var staticontrols = jQuery('.slider_control_tabs, #customize-control-static_image_id, #customize-control-static_img_text_id, #customize-control-slider_txt_color, .control_cta1_title, .control_cta2_title, #customize-control-static_textbox_width, #customize-control-static_textbox_bottom, #customize-control-disable_slider_parallax');
	
	var staticontrols2 = jQuery('#customize-control-static_gallery, #customize-control-static_slide_timer, #customize-control-static_video_id, #customize-control-slide_ytbid, #customize-control-static_vid_loop, #customize-control-static_vid_mute,li#customize-control-static_cta1_text, li#customize-control-static_cta1_link, li#customize-control-static_cta1_txt_style, li#customize-control-static_cta1_bg_color, li#customize-control-static_cta1_txt_color, li#customize-control-static_cta2_text, li#customize-control-static_cta2_link, li#customize-control-static_cta2_txt_style,li#customize-control-static_cta2_bg_color, li#customize-control-static_cta2_txt_color');
	
	var nivoaccordion = jQuery('#customize-control-nivo_accord_slider, #customize-control-slider_txt_hide, #customize-control-slidefont_size_id, #customize-control-n_slide_time_id, #customize-control-slide_height');
	
	var currentslider = jQuery('#customize-control-slider_type_id select option:selected').val();
	
	if(currentslider == 'accordion' || currentslider == 'nivo' || currentslider == 'noslider'){  
		staticontrols.addClass('hideslider'); staticontrols2.addClass('hideslider'); 
		jQuery('#customize-control-static_image_id').addClass('hidestatimgc'); 
	}
	
	if(currentslider == 'static' || currentslider == 'noslider'){  nivoaccordion.addClass('hideslider');  }
	
	if(currentslider == 'noslider'){  jQuery('#customize-control-slider_content_align').addClass('hideslider');}
	
	
	if(currentslider == 'accordion' || currentslider == 'nivo' || currentslider == 'static'){  	jQuery('#customize-control-slider_content_align').removeClass('hideslider');   }
	if(currentslider == 'accordion' || currentslider == 'noslider'){  	jQuery('#customize-control-n_slide_time_id, #customize-control-slider_height').addClass('hideslider');   }
	if(currentslider == 'nivo' || currentslider == 'static'){ 	 jQuery('#customize-control-slider_height').removeClass('hideslider');    }
	

		
	jQuery('#customize-control-slider_type_id select').on('change', function(){ 
		if(jQuery(this).find('option:selected').val() == 'static'){
			jQuery('#customize-control-static_image_id').removeClass('hideslider hidestatimgc');
			nivoaccordion.addClass('hideslider');
			staticontrols.removeClass('hideslider');
			jQuery('#customize-control-slider_content_align').removeClass('hideslider');
		}
		if(jQuery(this).find('option:selected').val() == 'accordion' || jQuery(this).find('option:selected').val() == 'nivo'){
			jQuery('#customize-control-static_image_id').attr('style', 'display:none!important;');
			staticontrols.addClass('hideslider');
			staticontrols2.addClass('hideslider').removeClass('activebgoption');
			nivoaccordion.removeClass('hideslider');
			jQuery('#customize-control-slider_content_align').removeClass('hideslider');
			jQuery('#customize-control-slider_height').addClass('hideslider');
		}
		
		if(jQuery(this).find('option:selected').val() == 'static' || jQuery(this).find('option:selected').val() == 'nivo'){
			jQuery('#customize-control-slider_height').removeClass('hideslider');
		}
		
		if(jQuery(this).find('option:selected').val() == 'accordion'){
			jQuery('#customize-control-n_slide_time_id').addClass('hideslider');
		}
		
		if(jQuery(this).find('option:selected').val() == 'noslider'){
			jQuery('#customize-control-static_image_id').attr('style', 'display:none!important;')
			nivoaccordion.addClass('hideslider');
			staticontrols.addClass('hideslider');
			staticontrols2.addClass('hideslider');
			jQuery('#customize-control-slider_content_align, #customize-control-slider_height').addClass('hideslider');
		}
	});
	
	jQuery('.slider_control_tabs').prepend('<span class="stattitle">'+objectL10n.statictitle+'</span>');
	jQuery('#customize-control-nivo_accord_slider').prepend('<span class="nivotitle">'+objectL10n.nivotitle+'</span>');
	

	//Menu Background Color
	var logopos = jQuery('#customize-control-logo_position select option:selected').val();
	jQuery('#customize-control-menubar_color_id').addClass('hideslider');
	if(logopos == 'logo_center' || logopos == 'logo_center_left'){  jQuery('#customize-control-menubar_color_id').removeClass('hideslider');  }
	if(logopos == 'logo_left' || logopos == 'logo_right' || logopos == 'logo_middle'){  jQuery('#customize-control-menubar_color_id').addClass('hideslider');  }
	
	jQuery('#customize-control-logo_position select').on('change', function(){ 
		if(jQuery(this).find('option:selected').val() == 'logo_center' || jQuery(this).find('option:selected').val() == 'logo_center_left'){
			jQuery('#customize-control-menubar_color_id').removeClass('hideslider');
		}
		if(jQuery(this).find('option:selected').val() == 'logo_left' || jQuery(this).find('option:selected').val() == 'logo_right' || jQuery(this).find('option:selected').val() == 'logo_middle'){
			jQuery('#customize-control-menubar_color_id').addClass('hideslider');;
		}
	});
	



	//Refresh Icons beside Controls that are not postMessage
	jQuery( "span.customize-control-title:contains('*')" ).addClass('control-refresh');
	jQuery('.control-refresh').each(function(index, element) {
        jQuery(this).html(jQuery(this).html().replace(/\*/g, ''));
    });
	jQuery('.control-refresh').append('<i class="fa fa-refresh" />');

		//Add Widget Areas Title
		jQuery('#accordion-section-basic_sidebar_section').after('<h4 class="optimizer_available_widgets">'+objectL10n.widgetareas+'</h4>');
		
		//REPLACE DUMMY CONTENT BUTTON FUNCTIONALITY
		wp.customize.previewer.bind( 'focus-frontsidebar', function(){
			jQuery('.wp-full-overlay').addClass('subsection-open');
			wp.customize.section( 'sidebar-widgets-front_sidebar' ).focus();
			jQuery('html, body').animate({scrollTop: jQuery('#customize-control-sidebars_widgets-front_sidebar').offset().top-100}, 150);
			jQuery('#customize-control-sidebars_widgets-front_sidebar .add-new-widget').removeClass('flashaddbutton').addClass('flashaddbutton');
			setTimeout(function () {  jQuery('#customize-control-sidebars_widgets-front_sidebar .add-new-widget').removeClass('flashaddbutton');  }, 500);
		});
		
		//REPLACE DUMMY CONTENT BUTTON FUNCTIONALITY
		wp.customize.previewer.bind( 'focus-slider-control', function(){
			jQuery('.wp-full-overlay').addClass('subsection-open');
			wp.customize.section( 'slider_section' ).focus();
		});
		
		//Custom Sidebar - Update Button
		//jQuery('#customize-control-custom_sidebar input').after('<button type="button" class="button update-custom-sidebar"><i class="fa fa-circle-o-notch fa-spin" /> Update</button>');
		jQuery('.update-custom-sidebar').on('click', function() {
			jQuery('#save').trigger('click');
			jQuery(this).find('i').fadeIn(200);
            setTimeout(function () {   window.location = objectL10n.widgetfocusurl;  }, 2000)
        });


	//Customizer Loading Spinner
/*	wp.customize.preview.bind( 'unload', function () { 
		

	});	*/
/*	setTimeout(function(){		
		wp.customize.control( 'widget_optimizer_front_about[1]' ).focus(); //WORKS!		
	}, 3000);*/
   
   
   //Export Widgetized Page Widgets
   wp.customize.previewer.bind( 'widgetized-widgets-export', function(param){
      console.log(param);
      if(param.widgets && param.filename){
         function SaveAsFile(t,f,m) {
            try {
               var b = new Blob([t],{type:m});
               saveAs(b, f);
            } catch (e) {
               window.open("data:"+m+"," + encodeURIComponent(t), '_blank','');
            }
         }
         SaveAsFile(param.widgets, param.filename+"-widgets.wie","text/plain;charset=utf-8");
      }

   });
	
	
	
	/*FRONTPAGE EDIT BUTTON*/				
	jQuery('.frontpage_edit_btn').on('click', function(){ 		
		jQuery('.quickie i, .quickie_text dl').removeClass('activeq'); jQuery('.quickie_widgets').addClass('activeq');		
		wp.customize.section( 'sidebar-widgets-front_sidebar' ).focus();		
	});		
	//Edit Widget Button For Other Pages
	wp.customize.previewer.bind( 'focus-current-sidebar', function(param){
			jQuery('.wp-full-overlay').addClass('subsection-open in-sub-panel section-open');

			//console.log('Add Button Clicked!');
			wp.customize.section( 'sidebar-widgets-'+param ).focus();
			wp.customize.control.each( function ( control ) {  if(control.expanded) control.collapse();  });
			jQuery('html, body').animate({scrollTop: jQuery('#customize-control-sidebars_widgets-front_sidebar').offset().top-100}, 150);
			jQuery('#customize-control-sidebars_widgets-'+param+' .add-new-widget').removeClass('flashaddbutton').addClass('flashaddbutton');
			
			setTimeout(function () {  jQuery('#customize-control-sidebars_widgets-'+param+' .add-new-widget').removeClass('flashaddbutton');  }, 500);
			jQuery('#customize-control-sidebars_widgets-'+param+' .add-new-widget').trigger('click');  
	} );
	
   //Only Open the Selected Sidebar Panel
   wp.customize.previewer.bind( 'focus-page-sidebar', function(param){
      //wp.customize.section.each( function ( section ) {  if(section.expanded()) section.collapse();  });
      wp.customize.section.each( function ( section ) {  
         if(section.id === 'sidebar-widgets-'+param){ 
            console.log(section);
            wp.customize.section( 'sidebar-widgets-'+param ).focus();
         }else{
            section.collapse(); 
         }
      });
      // setTimeout(() => {
      //    wp.customize.section( 'sidebar-widgets-'+param ).focus();
      // }, 1000);
      
	} );

	//Widget Advanced Controls Toggle
	jQuery(document).on("click", ".widget_advanced.advanced_widget_toggle_off h4", function(e) {
			jQuery(this).parent().removeClass('advanced_widget_toggle_off').addClass('advanced_widget_toggle_on');
			jQuery(this).next('.widget_advanced_controls').slideDown(200);
	});

	jQuery(document).on("click", ".widget_advanced.advanced_widget_toggle_on h4", function(e) {
			jQuery(this).parent().removeClass('advanced_widget_toggle_on').addClass('advanced_widget_toggle_off');
			jQuery(this).next('.widget_advanced_controls').slideUp(200);
	 });
	 
	 
	//Custom Font Upload
	jQuery('#customize-control-custom_font_ttf input').after('<a class="fontuploadbtn" onclick="customFontUpload(this.id)" id="cfuttf"><i class="fa fa-upload"></i></a>');
	jQuery('#customize-control-custom_font_eot input').after('<a class="fontuploadbtn" onclick="customFontUpload(this.id)" id="cfueot"><i class="fa fa-upload"></i></a>');
	jQuery('#customize-control-custom_font_woff input').after('<a class="fontuploadbtn" onclick="customFontUpload(this.id)" id="cfuwoff"><i class="fa fa-upload"></i></a>');
	
	//fontstep1
	if(objectL10n.fontonmsg ==''){
	  jQuery('#customize-control-custom_font_ttf').before('<p><span class="customize-control-title">'+objectL10n.fontstep3+'</span>'+objectL10n.fontstep1+'</p>');
	  jQuery('#customize-control-custom_font_woff').after('<a class="font_activate"><i class="fa fa-circle-o-notch fa-spin" /> '+objectL10n.fontstep2+'</a>');
	}else{
	jQuery('#customize-control-custom_font_ttf').before('<p><span class="customize-control-title">'+objectL10n.fontstep5+'</span>'+objectL10n.fontonmsg+'</p>');
		jQuery('#customize-control-custom_font_woff').after('<a class="font_activate font_deactivate"><i class="fa fa-circle-o-notch fa-spin" /> '+objectL10n.fontstep4+'</a>');
	}
	
/*	if(jQuery('#customize-control-custom_font_ttf input').val() =='' && jQuery('#customize-control-custom_font_eot input').val() =='' && jQuery('#customize-control-custom_font_eot input').val() ==''){
		jQuery('#customize-control-custom_font_woff').after('<a class="font_activate"><i class="fa fa-circle-o-notch fa-spin" /> '+objectL10n.fontstep2+'</a>');
	}else{
		jQuery('#customize-control-custom_font_woff').after('<a class="font_activate font_deactivate"><i class="fa fa-circle-o-notch fa-spin" /> '+objectL10n.fontstep4+'</a>');
		}*/
	
	jQuery('.font_deactivate').on('click', function() {
		jQuery('#customize-control-custom_font_ttf input, #customize-control-custom_font_eot input, #customize-control-custom_font_woff input').val('').trigger('change');
	});
	jQuery('.font_activate').on('click', function() {
			setTimeout(function () {jQuery('#save').trigger('click');  }, 400)
			jQuery(this).find('i').fadeIn(200);
            setTimeout(function () {   window.location = objectL10n.customfontfocus;  }, 2600)
     });

});



/*CONVERSION PROCESS*/
jQuery(window).on('load', function(){

		var isconverted = wp.customize.instance('optimizer[converted]').get();
		if(isconverted == ''){
			wp.customize.instance('optimizer[converted]').set('1');
			jQuery('.conversion_message').prependTo('body.wp-customizer').fadeIn();
		}
});

jQuery(window).on('load', function(){
   setTimeout(() => {
      if(Cookies.get('hidenowidgetnotice') && Cookies.get('hidenowidgetnotice') !== 'null'){
         jQuery('.no-widget-areas-rendered-notice').addClass('no-widget-areas-rendered-notice--hide');
      }
      jQuery('.no-widget-areas-rendered-notice').prepend('<span class="fa fa-times"></span>').fadeIn();
      jQuery('.no-widget-areas-rendered-notice span').on('click', function(){
         jQuery('.no-widget-areas-rendered-notice').addClass('no-widget-areas-rendered-notice--hide');
         Cookies.set('hidenowidgetnotice', 1, { expires: 365, path: '/'});
      })
   }, 2000);
});

jQuery( document ).on('load ready', function() {

      jQuery( document ).on( 'change', '.customize-control-multicheck input[type="checkbox"]', function() {

         checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
               return this.value;
            }
         ).get().join( ',' );

         jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
      });

	/* === RADIO Image Control === */
	
    // Use buttonset() for radio images.
    jQuery( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    jQuery( '.customize-control-radio-image input:radio' ).on('change', function() {

            // Get the name of the setting.
            var setting = jQuery( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = jQuery( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

} ); // jQuery( document ).on('load ready)


jQuery(function($) {
	"use strict";

	$(".customize-control-toggle").on("click", ".Switch.On", function(e) {
		$(this).removeClass('On').addClass('Off');
	});
	$(".customize-control-toggle").on("click", ".Switch.Off", function(e) {
		$(this).removeClass('Off').addClass('On');
	});

});


jQuery(window).on('load', function(){
	//Widgets List Modification
		jQuery('#available-widgets-list').prepend('<ul class="optimizer_widget_list"><li class="currnt_widgets"><a>'+objectL10n.optimwidgt+'</a></li><li><a>'+objectL10n.othrimwidgt+'</a></li></ul>');
		jQuery('.optimizer_widget_list li').eq(1).on('click', function() {
			jQuery( '.optimizer_widget_list li').removeClass('currnt_widgets');
			jQuery( this ).addClass('currnt_widgets');
			jQuery( '#available-widgets').addClass('active-otherwidget');
		});
		
		jQuery('.optimizer_widget_list li').eq(0).on('click', function() {
			jQuery( '.optimizer_widget_list li').removeClass('currnt_widgets');
			jQuery( this ).addClass('currnt_widgets');
			jQuery( '#available-widgets').removeClass('active-otherwidget');
		});
		
	//Social Link fields
	jQuery('#customize-control-facebook_field_id').prepend('<div class="social_fields_heading">'+objectL10n.socialinks+'</div>');
	
	//Replace the "Widget"
	jQuery('#available-widgets-list .widget-tpl').each(function() {
		jQuery(this).prepend('<i class="fa fa-info"></i>');
	});
	//Sort Widgets
	jQuery('#available-widgets-list .widget-tpl').attr('data-order','99');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_about"]').attr('data-order','1').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_text"]').attr('data-order','2').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_blocks"]').attr('data-order','3').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_posts"]').attr('data-order','4').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_video"]').attr('data-order','5').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_carousel"]').attr('data-order','6').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_slider"]').attr('data-order','7').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_portfoio"]').attr('data-order','8').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_map"]').attr('data-order','9').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_newsletter"]').attr('data-order','10').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_cta"]').attr('data-order','11').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_testimonials"]').attr('data-order','12').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_clients"]').attr('data-order','13').addClass('widget-tpl-odd');
	jQuery('#available-widgets-list [id^="widget-tpl-ast_countdown_widget"]').attr('data-order','14').addClass('widget-tpl-even');
	jQuery('#available-widgets-list [id^="widget-tpl-ast_scoial_widget"]').attr('data-order','15').addClass('widget-tpl-odd');

	
	//Sort The widgets to Optimizer Widgets First
	jQuery('#available-widgets-list').find('.widget-tpl').sort(function (a, b) {
	   return jQuery(a).attr('data-order') - jQuery(b).attr('data-order');
	}).appendTo('#available-widgets-list');
	//Wrap All Optimizer Widgets to fix the description popup 
	jQuery('#available-widgets [id*="widget-tpl-optimizer_"], #available-widgets [id*="widget-tpl-ast_"], #available-widgets [id*="widget-tpl-thn_"]').wrapAll('<div class="the_optim_widgets"></div>');
	jQuery('#available-widgets-list > .widget-tpl').wrapAll('<div class="the_other_widgets"></div>');
	
	jQuery('#available-widgets-list .widget-tpl .fa-info').hoverIntent(function(){ 
		jQuery(this).parent().find('.widget-description').fadeIn(200);
	},function(){
		jQuery(this).parent().find('.widget-description').fadeOut(200);
	});
	
	//Widgets Library Close Button
	jQuery('#available-widgets-list').prepend('<a id="close_widget_library">✖</a>');
	//Close Widgets Library
	jQuery('#close_widget_library').on('click', function() {
			jQuery('.adding-widget .add-new-widget').trigger("click");
	});
	
	
	//WIDGET PRESETS-------------------------------------------------
	//Move the Widget Presets in the Widget Library
	jQuery('.widget_preset_right').appendTo('.the_optim_widgets');
	
	//Append The Preset buttons to widgets that have presets
	jQuery('#available-widgets-list [id^="widget-tpl-optimizer_front_text"], #available-widgets-list [id^="widget-tpl-optimizer_front_blocks"], #available-widgets-list [id^="widget-tpl-optimizer_front_posts"], #available-widgets-list [id^="widget-tpl-optimizer_front_video"] , #available-widgets-list [id^="widget-tpl-optimizer_front_map"], #available-widgets-list [id^="widget-tpl-optimizer_front_cta"], #available-widgets-list [id^="widget-tpl-optimizer_front_newsletter"]').each(function() {
		var title = jQuery(this).find('.widget-title h3').text();
		var widgetid = jQuery(this).attr('data-widget-id');
		var widgetid = widgetid.replace(/[0-9]/g, '');
		var widgetid = widgetid.replace("-", "");

		var position = jQuery(this).find('.widget-top').offset();
		
		jQuery(this).after('<div title="'+title+' Widget Presets" class="widget_preset_btn widget_preset_'+widgetid+'" id="trigger-'+widgetid+'" style="top:'+position.top+'px; bottom:'+position.bottom+'px; left:'+position.left+'px; right:'+position.right+'px;"></div>');

		//Display presets on button clicks
		jQuery('#trigger-'+widgetid).on('click', function() {
			jQuery('#available-widgets-list [id^="widget-tpl-"]').addClass('hide_widgets_fo_presets');
			jQuery('.widget_preset_right').fadeIn(400);
			jQuery('.widget_preset_right .preset_tabs, ul.optimizer_widget_list, .widget_preset_btn').hide();
			jQuery('.widget_preset_right').find('#tab_'+widgetid).fadeIn(400);
			jQuery('.preset_tabs img').trigger("unveil");
		});
		
		jQuery('.widget_preset_right .fa-angle-left').on('click', function() {
			jQuery('.widget_preset_right, .widget_preset_right .preset_tabs').fadeOut(400);
			jQuery('ul.optimizer_widget_list, .widget_preset_btn').show();
			jQuery('#available-widgets-list [id^="widget-tpl-"]').removeClass('hide_widgets_fo_presets');
		});
	
	});
	
});

/*GENERATE EXPORT*/
jQuery(function($) {
	jQuery( '#generatexport' ).on( "click", function(e) {
		e.preventDefault();
		var value = jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data:{
				action: 'optimizer_get_options'
				}
			})
			 .fail(function(r,status,jqXHR) {
				 console.log('failed');
			 })
			 .done(function(result,status,jqXHR) {
				//console.log('success');
				//console.log(result);
				jQuery('#opt_current_options').html(result);
				  function SaveAsFile(t,f,m) {
						try {
							var b = new Blob([t],{type:m});
							saveAs(b, f);
						} catch (e) {
							window.open("data:"+m+"," + encodeURIComponent(t), '_blank','');
						}
					}
			
					SaveAsFile(result,"themeoptions.json","text/plain");
			 });
	});
	
	
	jQuery( '#widgetexport' ).on( "click", function(e) {
		e.preventDefault();
		var value = jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			data:{
				action: 'optimizer_wie_send_export_file'
				}
			})
			 .fail(function(r,status,jqXHR) {
				 console.log('failed');
			 })
			 .done(function(result,status,jqXHR) {
				console.log('success');
				console.log(result);
				//jQuery('#opt_current_widgets').html(result);
				  function SaveAsFile(t,f,m) {
						try {
							var b = new Blob([t],{type:m});
							saveAs(b, f);
						} catch (e) {
							window.open("data:"+m+"," + encodeURIComponent(t), '_blank','');
						}
					}
			
					SaveAsFile(result,"theme-widgets.wie","text/plain");
			 });
	});

//Refresh when Custom preset is imported
wp.customize.previewer.bind( 'refreshafterpreset', function() {
    //wp.customize.previewer.refresh();
	window.location.reload( true );
} );


//---------------------INLINE EDIT-------------------------------------------------
	//Get Updated tinyMce content
	wp.customize.previewer.bind( 'tinycontent', function(content) {
		//console.log('Triggered tinymce content Update...'+ content[0] + content[1] );
		var optionid = content[0];
		
		//Check If the optionid is of Widget's or Slider's and then focus that specific option and save the changes.
		if(optionid.match(/widget-/g) ){
			var widgetid = content[0];
			var widgetid = widgetid.replace("widget-", ""); var widgetid = widgetid.replace("-content", "");
			var widgetid = widgetid.replace("-block1content", ""); var widgetid = widgetid.replace("-block2content", ""); var widgetid = widgetid.replace("-block3content", ""); 
			var widgetid = widgetid.replace("-block4content", ""); var widgetid = widgetid.replace("-block5content", ""); var widgetid = widgetid.replace("-block6content", "");
			var widgetid = widgetid.replace("-", "[");
			//console.log('Expected: widget_optimizer_front_about[102] - '+widgetid );
			wp.customize.control( 'widget_'+widgetid+']' ).focus();
		}else{
			wp.customize.control( 'static_img_text_id' ).focus(); 
		}
		//SAVE THE CHANGES
		//console.log('Input Data: '+ content[0] + content[1] );
		jQuery('#'+optionid).val(content[1]).trigger('change');
		//setTimeout(function () {jQuery('#save').trigger('click');  }, 1200);

	} );
	
	function inline_editsave(customizeid, string){
		//Update the Widget Title 
		wp.customize.previewer.bind( customizeid, function(content) {
			var str = content[0]; var widgetid = str.replace("-", "[");
			wp.customize.control( 'widget_'+widgetid+']' ).focus();  /*FOCUS FIRST*/
			jQuery('#widget-'+str+string).val(content[1]).trigger('change'); /*THEN CHANGE VALUE*/
			setTimeout(function () {jQuery('#save').trigger('click');  }, 1200); /*THEN TRIGGER SAVE*/
			//console.log('id: '+content[0] + ' data: '+content[1]);
		});
	}

	inline_editsave('titledit', '-title');  /*Widget Title Saving*/
	inline_editsave('subtitledit', '-subtitle'); /*Widget Subtitle Saving*/
	
	/*Widget Subtitle Saving*/
	inline_editsave('blckttedit1', '-block1title');  inline_editsave('blckttedit2', '-block2title');  inline_editsave('blckttedit3', '-block3title');
	inline_editsave('blckttedit4', '-block4title');  inline_editsave('blckttedit5', '-block5title');  inline_editsave('blckttedit6', '-block6title'); 

	/*Countdown Content Edit*/
	inline_editsave('countdnedit', '-desc'); 
	/*Biography Content Edit*/
	inline_editsave('bioedit', '-bio'); inline_editsave('bionamedit', '-name'); inline_editsave('bioccuedit', '-occu'); 
	
	
	//Open up the FullScreen Editor
	wp.customize.previewer.bind( 'fulleditor', function(widgetid) {
		var str = widgetid;
		var widgetidm = str.replace("-", "[");
		wp.customize.control( 'widget_'+widgetidm+']' ).focus();
		
		jQuery('#widget-'+widgetid+'-content').next('a').trigger('click');
		jQuery('#widget-'+widgetid+'-content').next('a').trigger('onclick');
	});

	
});


/*OPTIMIZER THEME TOUR*/
jQuery( document ).on('load ready', function() {
	
	//Remove all the "Shift Click to Edit this Widget" message
	setTimeout(function () {  jQuery('.frontpage_sidebar .widget').attr('title','');  }, 3000);

	//Map APi Key Description
	jQuery('#customize-control-map_api input').before(objectL10n.getmapkey);
	
	//Append Previwe window inner shadow
	jQuery('#customize-preview').prepend('<div id="tour_innerglow"><span class="innerglow glow1"></span><span class="innerglow glow2"></span><span class="innerglow glow3"></span><span class="innerglow glow4"></span></div>');
	
	//Tour Function
	jQuery('.tournext').on('click', function() {
		if(jQuery(this).parent().next().is("li")){
			jQuery(this).parent().hide();
			jQuery(this).parent().next().show();
			var elmid = jQuery(this).parent().next().data('id');
			if(jQuery(this).parent().next().data('preview') == 'true'){}
			jQuery('.tourhighlight').removeClass('tourhighlight');
			jQuery("#customize-preview iframe").contents().find('.tourhighlight').removeClass('tourhighlight'); 
			jQuery('#'+elmid).addClass('tourhighlight');
			if(elmid == 'frontsidebar' || elmid == 'customizer_topbar'){ 
				//console.log('Preview True');
				jQuery("#customize-preview iframe").contents().find('#'+elmid).addClass('tourhighlight'); 
			}
		}
	} );
	
	jQuery('.tourprev').on('click', function() {
		if(jQuery(this).parent().prev().is("li")){
			jQuery(this).parent().hide();
			jQuery(this).parent().prev().show();
			var elmid = jQuery(this).parent().prev().data('id');
			jQuery('.tourhighlight').removeClass('tourhighlight');
			jQuery("#customize-preview iframe").contents().find('.tourhighlight').removeClass('tourhighlight'); 
			jQuery('#'+elmid).addClass('tourhighlight');
			if(elmid == 'frontsidebar' || elmid == 'customizer_topbar'){ 
				console.log('Preview True');
				jQuery("#customize-preview iframe").contents().find('#'+elmid).addClass('tourhighlight'); 
			}
		}
	} );

	jQuery('.tourend, .tourclose').on('click', function() {
		jQuery('#optimizerTour, .tour_backdrop').fadeOut();
		Cookies.set('optimizertour', 1, { expires: 365, path: '/'});
	} );
	
	jQuery('#tour_btn').on('click', function() {
		jQuery('#optimizerTour, .tour_backdrop').fadeIn();
		jQuery('.tourclose').show();
		jQuery('#optimizerTour>li').hide();
		jQuery('#optimizerTour li').eq(0).show();
		jQuery('#optimizer_settings').animate({"left":"-831px"});
		jQuery('.opactive').removeClass('opactive');
		wp.customize.panel.each( function ( panel ) {
			panel.collapse();
		});
	} );
	
} );


jQuery( document ).on('load', function() {
	
	wp.customize.previewer.bind( 'start-tour', function(){
		if(!Cookies.get('optimizertour')){
			jQuery('#optimizerTour, .tour_backdrop').fadeIn();
		}
	});
	
	//Tutorial Video
	jQuery('#customize-control-help-tuts .description').on('click', function() {
		jQuery('.basic_guide, .guide_backdrop').removeClass('vid_maximize vid_minimize vid_minimized').fadeIn();
	});	
	
	//Video Guides
	jQuery('#customize-control-help-createbus .description').on('click', function() {
		jQuery('.business_guide, .guide_backdrop').removeClass('vid_maximize vid_minimize vid_minimized').fadeIn();
	});	
	
	//Faq Tabs
	jQuery('.faq_tab_controls h3').on('click', function() {
		jQuery('.faq_tab_controls h3, .faq_tabs').removeClass('faq_active faq_tab_active'); jQuery(this).addClass('faq_active');  jQuery('.'+jQuery(this).attr('data-tab')).addClass('faq_tab_active');
	});
	
	jQuery('#customize-control-help-faq .description a').on('click', function() {	jQuery('#faq_tab, .guide_backdrop').fadeIn(); });
	jQuery('.faq_title_bar i').on('click', function() {	jQuery('#faq_tab, .guide_backdrop').fadeOut(); });
	
});


jQuery(window).on('load', function(){
	/*PRESETS TABS*/
	jQuery('.widget_preset_left ul li a').on('click',function(event) {
		event.preventDefault();
		jQuery(this).parent().siblings().removeClass("active_presw");
		jQuery(this).parent().addClass("active_presw");
		var parenttab = jQuery(this).attr("href");
		jQuery(".preset_tabs").css({"display":"none"});
		jQuery(parenttab).fadeIn();
		jQuery(".preset_tabs img").unveil();
	});
	
		//Display presets on button clicks
		jQuery('.optim_presets').on('click',function() {
			jQuery('.preset_p img').trigger("unveil");
		});
	
	jQuery(".preset_tabs img, .preset_p img").unveil();
});	


   //REPEATER FIELD Reorder
   jQuery(window).on( 'load widget-updated widget-added', function() {
      if (jQuery.ui) {
         jQuery('.widget_repeater').sortable({
            items: ".widget_input_wrap",
            handle: ".fa-arrows-v",
            stop: function(event, ui){
               jQuery(ui.item).find('input').first().trigger('change');
               jQuery(ui.item).parent().find('.repeater_apply_message').fadeIn();
               setTimeout(function() {
                  jQuery(ui.item).parent().find('.repeater_apply_message').fadeOut();
               }, 3000);
               //jQuery('#'+buttonid).parent().next('input.slider-picker').val('').trigger('change');
            }
         });
      }
   });
   
   
   //DUPLICATE WIDGETS
   jQuery( document ).on( 'load widget-added', function(event, widget) {
      //Append The duplicate button
      jQuery('.widget-control-actions').each(function(index, element) {
            if(jQuery(this).find('.optimizer_duplicate_widget').length == 0){
               jQuery(this).find('.widget-control-close').before('<a class="optimizer_duplicate_widget" onclick="duplicateWidget(this)" >Duplicate</a>');
            }
      });
   });	

   function duplicateWidget(element) {
      console.log('.optimizer_duplicate_widget');
      rawsidebarid = jQuery(element).parent().parent().parent().parent().parent().parent().parent().parent().attr('id');
      rawidgetid = jQuery(element).parent().parent().parent().parent().parent().parent().attr('id');

      dsidebarid = rawsidebarid.split('accordion-section-sidebar-widgets-')[1];
      dwidgetid = rawidgetid.split(/_(.+)/)[1];

      console.log(rawidgetid); console.log(dsidebarid); console.log(dwidgetid);
      srcWidgetId = ''+dwidgetid+'';
      matches = srcWidgetId.match( /(.+)-(\d+)/ );
      sourceWidgetSettingId = 'widget_' + matches[1] + '[' + matches[2] + ']';
      idBase = matches[1];
      sidebarControl = wp.customize.control('sidebars_widgets['+dsidebarid+']');
      destWidgetControl = sidebarControl.addWidget( idBase );
      destWidgetControl.setting.set( wp.customize( sourceWidgetSettingId ).get( sourceWidgetSettingId ) );
      wp.customize.control.each( function ( control ) {  if(control.expanded) control.collapse();  });
      destWidgetControl.focus();
   }



jQuery(window).on('load', function(){	
setTimeout(function(){
	/*YOUTUBE VIDEOES*/
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}, 4000);
});
	//Load 
	var player;
	var tutsplayer;
	
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('business_video', {
			width: '',
			height: '',
			videoId: 'oMPwT2vEqx0',
			playerVars :{color: 'white', 'showinfo': 0, 'playlist':'oMPwT2vEqx0'},
			events: {
				onReady: guide_initialize
			}
		});
		
		tutsplayer = new YT.Player('tuts_video', {
			width: '',
			height: '',
			videoId: 'ziuDRK62Hr8',
			playerVars :{color: 'white', 'showinfo': 0, 'playlist':'ziuDRK62Hr8'},
			events: {
				onReady: tuts_initialize
			}
		});
		
	}

//Custom Code Full Width
jQuery( document ).on('load ready', function() {
   var codeTypes = [{id:'css', title: 'CSS'}, {id:'js', title: 'Javascript'}];
   codeTypes.forEach(function(code){
      jQuery('#customize-control-custom-'+code.id).prepend('<a id="optimizer_'+code.id+'_full_button" title="Expand"><i class="fa-expand" /></a>');
      jQuery('#optimizer_'+code.id+'_full_button').on('click', function(){
         var currentCode = jQuery('#_customize-input-custom-'+code.id).val();
         jQuery('.wp-full-overlay-sidebar').prepend('<div id="optimizer_custom_'+code.id+'_full"><h3>Custom '+code.title+'</h3><div><textarea value="'+currentCode+'">'+currentCode+'</textarea><a onclick="updateCustomCode(\''+code.id+'\')">Update</a></div></div>');
      });
   })
});
function updateCustomCode(type){
   var currentCode = jQuery('#_customize-input-custom-'+type).val();
   var updatedCode = jQuery('#optimizer_custom_'+type+'_full textarea').val();
   if(currentCode !== updatedCode){
      jQuery('#_customize-input-custom-'+type).val(updatedCode).trigger('change');
      jQuery('#optimizer_custom_'+type+'_full').remove();
   }else{
      jQuery('#optimizer_custom_'+type+'_full').remove();
   }
}
	
/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

(function(e){e.fn.unveil=function(t,n){function f(){var t=u.filter(function(){var t=e(this);if(t.is(":hidden"))return;var n=r.scrollTop(),s=n+r.height(),o=t.offset().top,u=o+t.height();return u>=n-i&&o<=s+i});a=t.trigger("unveil");u=u.not(a)}var r=e(window),i=t||0,s=window.devicePixelRatio>1,o=s?"data-src-retina":"data-src",u=this,a;this.one("unveil",function(){var e=this.getAttribute(o);e=e||this.getAttribute("data-src");if(e){this.setAttribute("src",e);if(typeof n==="function")n.call(this)}});r.on("scroll.unveil resize.unveil lookup.unveil",f);f();return this}})(window.jQuery||window.Zepto);

/*! 
 * FileSaver.js
 * https://github.com/eligrey/FileSaver.js/
 * Released under the MIT license
 */
(function(a,b){if("function"==typeof define&&define.amd)define([],b);else if("undefined"!=typeof exports)b();else{b(),a.FileSaver={exports:{}}.exports}})(this,function(){"use strict";function b(a,b){return"undefined"==typeof b?b={autoBom:!1}:"object"!=typeof b&&(console.warn("Deprecated: Expected third argument to be a object"),b={autoBom:!b}),b.autoBom&&/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(a.type)?new Blob(["\uFEFF",a],{type:a.type}):a}function c(a,b,c){var d=new XMLHttpRequest;d.open("GET",a),d.responseType="blob",d.onload=function(){g(d.response,b,c)},d.onerror=function(){console.error("could not download file")},d.send()}function d(a){var b=new XMLHttpRequest;b.open("HEAD",a,!1);try{b.send()}catch(a){}return 200<=b.status&&299>=b.status}function e(a){try{a.dispatchEvent(new MouseEvent("click"))}catch(c){var b=document.createEvent("MouseEvents");b.initMouseEvent("click",!0,!0,window,0,0,0,80,20,!1,!1,!1,!1,0,null),a.dispatchEvent(b)}}var f="object"==typeof window&&window.window===window?window:"object"==typeof self&&self.self===self?self:"object"==typeof global&&global.global===global?global:void 0,a=/Macintosh/.test(navigator.userAgent)&&/AppleWebKit/.test(navigator.userAgent)&&!/Safari/.test(navigator.userAgent),g=f.saveAs||("object"!=typeof window||window!==f?function(){}:"download"in HTMLAnchorElement.prototype&&!a?function(b,g,h){var i=f.URL||f.webkitURL,j=document.createElement("a");g=g||b.name||"download",j.download=g,j.rel="noopener","string"==typeof b?(j.href=b,j.origin===location.origin?e(j):d(j.href)?c(b,g,h):e(j,j.target="_blank")):(j.href=i.createObjectURL(b),setTimeout(function(){i.revokeObjectURL(j.href)},4E4),setTimeout(function(){e(j)},0))}:"msSaveOrOpenBlob"in navigator?function(f,g,h){if(g=g||f.name||"download","string"!=typeof f)navigator.msSaveOrOpenBlob(b(f,h),g);else if(d(f))c(f,g,h);else{var i=document.createElement("a");i.href=f,i.target="_blank",setTimeout(function(){e(i)})}}:function(b,d,e,g){if(g=g||open("","_blank"),g&&(g.document.title=g.document.body.innerText="downloading..."),"string"==typeof b)return c(b,d,e);var h="application/octet-stream"===b.type,i=/constructor/i.test(f.HTMLElement)||f.safari,j=/CriOS\/[\d]+/.test(navigator.userAgent);if((j||h&&i||a)&&"undefined"!=typeof FileReader){var k=new FileReader;k.onloadend=function(){var a=k.result;a=j?a:a.replace(/^data:[^;]*;/,"data:attachment/file;"),g?g.location.href=a:location=a,g=null},k.readAsDataURL(b)}else{var l=f.URL||f.webkitURL,m=l.createObjectURL(b);g?g.location=m:location.href=m,g=null,setTimeout(function(){l.revokeObjectURL(m)},4E4)}});f.saveAs=g.saveAs=g,"undefined"!=typeof module&&(module.exports=g)});


/*! js-cookie v3.0.0-rc.0 | MIT */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var r=e.Cookies,n=e.Cookies=t();n.noConflict=function(){return e.Cookies=r,n}}())}(this,function(){"use strict";function e(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)e[n]=r[n]}return e}var t={read:function(e){return e.replace(/%3B/g,";")},write:function(e){return e.replace(/;/g,"%3B")}};return function r(n,i){function o(r,o,u){if("undefined"!=typeof document){"number"==typeof(u=e({},i,u)).expires&&(u.expires=new Date(Date.now()+864e5*u.expires)),u.expires&&(u.expires=u.expires.toUTCString()),r=t.write(r).replace(/=/g,"%3D"),o=n.write(String(o),r);var c="";for(var f in u)u[f]&&(c+="; "+f,!0!==u[f]&&(c+="="+u[f].split(";")[0]));return document.cookie=r+"="+o+c}}return Object.create({set:o,get:function(e){if("undefined"!=typeof document&&(!arguments.length||e)){for(var r=document.cookie?document.cookie.split("; "):[],i={},o=0;o<r.length;o++){var u=r[o].split("="),c=u.slice(1).join("="),f=t.read(u[0]).replace(/%3D/g,"=");if(i[f]=n.read(c,f),e===f)break}return e?i[e]:i}},remove:function(t,r){o(t,"",e({},r,{expires:-1}))},withAttributes:function(t){return r(this.converter,e({},this.attributes,t))},withConverter:function(t){return r(e({},this.converter,t),this.attributes)}},{attributes:{value:Object.freeze(i)},converter:{value:Object.freeze(n)}})}(t,{path:"/"})});