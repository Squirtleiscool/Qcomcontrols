// JavaScript Document

( function( $ ) {

	
	//Call values directly (Example)
		//wp.customize.value('optimizer[content_bg_color]')();
		//wp.customize.instance('optimizer[content_bg_color]').get()


	//Content Font Family
	$("head").append("<style id='content_font_css'></style>");
	wp.customize('optimizer[content_font_id][font-family]', function( value ) {value.bind(function( newval) {
		$('#content_font_google').remove();
		var updatedval = newval.replace(" ", "+");
		var contentsubset = wp.customize.instance('optimizer[content_font_id][subsets]').get();
		$("<link />", {id: "content_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+updatedval+"&subset="+contentsubset, }).appendTo("head");
		$('#content_font_css').text('html body{font-family:'+newval+'}')
		} );
	} );
	//Subsets
	wp.customize('optimizer[content_font_id][subsets]', function( value ) {value.bind(function( newval) {
		$('#content_font_google').remove();
		var contentfont = wp.customize.instance('optimizer[content_font_id][font-family]').get();
		var contentfontclean  =contentfont.replace(" ", "+");
		
		$("<link />", {id: "content_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+contentfontclean+"&subset="+newval, }).appendTo("head");
		$('#content_font_css').text('html body{font-family:'+contentfont+'}');
		} );
	} );
	//Weight
	$("head").append("<style id='content_font_weight'></style>");
	wp.customize('optimizer[content_font_id][font-weight]', function( value ) {value.bind(function( newval) {
		$('#content_font_weight').text('html body{font-weight:'+newval+'!important}');
		} );
	} );
	
	
	
	//Menu Font Family
	$("head").append("<style id='ptitle_font_css'></style>");
	wp.customize('optimizer[ptitle_font_id][font-family]', function( value ) {value.bind(function( newval) {
		$('#ptitle_font_google').remove();
		var updatedval = newval.replace(" ", "+");
		var ptitlesubset = wp.customize.instance('optimizer[ptitle_font_id][subsets]').get();
		$("<link />", {id: "ptitle_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+updatedval+"&subset="+ptitlesubset, }).appendTo("head");
		$('#ptitle_font_css').text('h1, h2, h3, h4, h5, h6, #topmenu ul li a, .postitle, .product_title{font-family:'+newval+'!important}');
		} );
	} );
	//Subsets
	wp.customize('optimizer[ptitle_font_id][subsets]', function( value ) {value.bind(function( newval) {
		$('#ptitle_font_google').remove();
		var ptitlefont = wp.customize.instance('optimizer[ptitle_font_id][font-family]').get();
		var ptitlefontclean  =ptitlefont.replace(" ", "+");
		
		$("<link />", {id: "ptitle_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+ptitlefontclean+"&subset="+newval, }).appendTo("head");
		$('#ptitle_font_css').text('h1, h2, h3, h4, h5, h6, #topmenu ul li a, .postitle, .product_title{font-family:'+ptitlefont+'!important}');
		} );
	} );
	
	//Weight
	$("head").append("<style id='ptitle_font_weight'></style>");
	wp.customize('optimizer[ptitle_font_id][font-weight]', function( value ) {value.bind(function( newval) {
		$('#ptitle_font_weight').text('h1, h2, h3, h4, h5, h6, #topmenu ul li a, .postitle, .product_title{font-weight:'+newval+'!important}');
		} );
	} );
	
	

	//Logo Font Family
	$("head").append("<style id='logo_font_css'></style>");
	wp.customize('optimizer[logo_font_id][font-family]', function( value ) {value.bind(function( newval) {
		$('#logo_font_google').remove();
		var updatedval = newval.replace(" ", "+");
		var logosubset = wp.customize.instance('optimizer[logo_font_id][subsets]').get();
		$("<link />", {id: "logo_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+updatedval+"&subset="+logosubset, }).appendTo("head");
		$('#logo_font_css').text('.logo h2, .logo h1, .logo h2 a, .logo h1 a{font-family:'+newval+'!important}')
		} );
	} );
	//Subsets
	wp.customize('optimizer[logo_font_id][subsets]', function( value ) {value.bind(function( newval) {
		$('#logo_font_google').remove();
		var logofont = wp.customize.instance('optimizer[logo_font_id][font-family]').get();
		var logofontclean  =logofont.replace(" ", "+");
		
		$("<link />", {id: "logo_font_google", rel: "stylesheet", type: "text/css", href: "https://fonts.googleapis.com/css?family="+logofontclean+"&subset="+newval, }).appendTo("head");
		$('#logo_font_css').text('.logo h2, .logo h1, .logo h2 a, .logo h1 a{font-family:'+logofont+'!important}');
		} );
	} );
	
			
	
	// SITE LAYOUT------------
	
	//Boxed Layout Background Color
	wp.customize( 'optimizer[content_bg_color]', function( value ) { value.bind( function( newval ) { 
		$('.site_boxed .layer_wrapper, .site_boxed .social_buttons').css({"background":newval});
		} );   
	} );

	
	//Fixed Background
	wp.customize( 'optimizer[background_fixed]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( 'body' ).css('background-attachment', 'scroll');}   if(newval == 1){ $( 'body' ).css('background-attachment', 'fixed');}  } );
	} );
	
	
	// HEADER------------
	//Logo Position
	wp.customize( 'optimizer[logo_position]', function( value ) {
		value.bind( function( newval ) {   
			$( '.header' ).removeClass('logo_left logo_right logo_center logo_middle logo_center_left topbarlogo').addClass(newval); 
			$('#topmenu .logo').remove(); $('#topmenu ul li').css({"bottom":"0"}); $('.logobefore, .logoafter').children().unwrap(); 
			if(newval == 'logo_middle'){
				if(jQuery('.logo_middle #topmenu .menu-header').length !==0){ var menunum = jQuery('.logo_middle #topmenu ul.menu>li').length;}else{ var menunum = jQuery('.logo_middle #topmenu .menu ul>li').length;}
				var logopos = Math.round(menunum/2);
				$('.logo_middle #topmenu ul.menu>li:nth-child('+logopos+'), .logo_middle #topmenu .menu ul>li:nth-child('+logopos+')').after('<div class="logo">'+jQuery('.logo_middle .logo').html()+'</div>');
				$('.logo_middle, .logo_middle #topmenu .logo').animate({"opacity": "1"});
				$('.logo_middle #topmenu ul.menu>li').slice( 0, logopos ).wrapAll('<div class="logobefore"></div>');
				$('.logo_middle #topmenu .logo').each(function () { jQuery(this).nextAll('li').wrapAll('<div class="logoafter"/>'); });
				$('.logo_middle #topmenu .menu-item, #topmenu .head_soc').not('.logo_middle #topmenu .menu-item .menu-item').css({ "bottom":(jQuery(".logo_middle #topmenu").height() / 2) /2});

			}
/*			if(newval !== 'topbarlogo'){
				$('.head_top .logo').show();
				$('.header .logo').hide();
			}else{
				$('.head_top .logo').hide();
				$('.header .logo').show();
			}*/

		} );   
	} );
		
	//Logo Position
	wp.customize( 'optimizer[trans_header_color]', function( value ) { value.bind( function( newval ) { 
		$('body.has_trans_header.home .header .logo h2, body.has_trans_header.home .header .logo h1, body.has_trans_header.home .header .logo h2 a, body.has_trans_header.home .header .logo h1 a, body.has_trans_header.home span.desc, body.home.has_trans_header #simple-menu, body.has_trans_header.home #topmenu ul li a').css({"color":newval});
		} );   
	} );

	//Menubar Color
	wp.customize( 'optimizer[menubar_color_id]', function( value ) { value.bind( function( newval ) { 
		$('.logo_center_left #topmenu, .logo_center #topmenu').css({"background-color":newval});
		} );   
	} );
		

	
		
	
	// TOPHEAD------------
	//Enable tophead
	wp.customize( 'optimizer[tophead_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.head_top ' ).removeClass('hide_topbar');}   if(newval == ''){ $( '.head_top' ).addClass('hide_topbar');}  } );
	} );
	//Enable Topbar menu
	wp.customize( 'optimizer[topmenu_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '.head_top ' ).addClass('hide_topmenu');}   if(newval == 1){ $( '.head_top' ).removeClass('hide_topmenu');}  } );
	} );
	//Hide tophead Menu Swich
	wp.customize( 'optimizer[topmenu_switch]', function( value ) {
		value.bind( function( newval ) {   if(newval == ''){ $( '.head_top ' ).addClass('topmenu_switch');}   if(newval == 1){ $( '.head_top ' ).removeClass('topmenu_switch');}  } );
	} );
	//Hide tophead Search
	wp.customize( 'optimizer[topsearch_id]', function( value ) {
		value.bind( function( newval ) {   if(newval == 1){ $( '.head_top' ).addClass('topsearch_on');}   if(newval == 0){ $( '.head_top ' ).removeClass('topsearch_on');}  } );
	} );
	
	//Hide tophead Search
	wp.customize( 'optimizer[headsearch_id]', function( value ) {
		value.bind( function( newval ) {   if(newval == 1){ $( '.header' ).addClass('headsearch_on');}   if(newval == 0){ $( '.header' ).removeClass('headsearch_on');}  } );
	} );
	//Tophead Phone Number
	wp.customize( 'optimizer[tophone_id]', function( value ) {
		value.bind( function( newval ) {   if(newval !== ''){ $( '.head_top' ).addClass('tophone_on');  $( '.head_phone span' ).html( newval );  }  if(newval == ''){ $( '.head_top' ).removeClass('tophone_on');}});
	} );
	
	//Hide Topmenu
	wp.customize( 'optimizer[hide_head_menu]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '#topmenu' ).addClass('hide_headmenu');}   if(newval == ''){ $( '#topmenu' ).removeClass('hide_headmenu');}  } );
	} );
	
	//Hide Site Title
	wp.customize( 'optimizer[hide_sitett]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.logo' ).addClass('hide_sitetitle');}   if(newval == ''){ $( '.logo' ).removeClass('hide_sitetitle');}  } );
	} );
	
	//Hide Site Description
	wp.customize( 'optimizer[hide_tagline]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.logo' ).addClass('hide_sitetagline');}   if(newval == ''){ $( '.logo' ).removeClass('hide_sitetagline');}  } );
	} );
	
	
	//Header Sidebar Text Center
	wp.customize( 'optimizer[header_sidebar_style]', function( value ) {
		value.bind( function( newval ){ $( '.header_sidebar' ).removeClass('header_sidebar_default header_sidebar_center header_sidebar_border header_sidebar_border_center').addClass(newval);}  );
	} );
	
	
	// SLIDER-----------------------
	//Static Slide CTA 1 Text
	wp.customize( 'optimizer[static_cta1_text]', function( value ) { value.bind( function( newval ) {   $( '.static_cta1' ).html( newval );  } );  } );
	//Static Slide CTA 1 Link
	wp.customize( 'optimizer[static_cta1_link]', function( value ) { value.bind( function( newval ) {   $( '.static_cta1' ).attr('href', newval);  } );  } );
	//Static Slide CTA 1 Style
	wp.customize( 'optimizer[static_cta1_txt_style]', function( value ) { value.bind( function( newval ) {   $( '.static_cta1' ).removeClass('cta_flat cta_flat_big cta_flat_small cta_hollow cta_hollow_big cta_hollow_small cta_rounded cta_rounded_big cta_rounded cta_rounded_small cta_square cta_square_big cta_square_small cta_square_hollow cta_square_hollow_big cta_square_hollow_small').addClass('cta_'+newval);  }); });
	
	//Static Slide CTA 2 Text
	wp.customize( 'optimizer[static_cta2_text]', function( value ) { value.bind( function( newval ) {   $( '.static_cta2' ).html( newval );  } );  } );
	//Static Slide CTA 2 Link
	wp.customize( 'optimizer[static_cta2_link]', function( value ) { value.bind( function( newval ) {   $( '.static_cta2' ).attr('href', newval);  } );  } );
	//Static Slide CTA 2 Style
	wp.customize( 'optimizer[static_cta2_txt_style]', function( value ) { value.bind( function( newval ) {   $( '.static_cta2' ).removeClass('cta_flat cta_flat_big cta_flat_small cta_hollow cta_hollow_big cta_hollow_small cta_rounded cta_rounded_big cta_rounded cta_rounded_small cta_square cta_square_big cta_square_small cta_square_hollow cta_square_hollow_big cta_square_hollow_small').addClass('cta_'+newval);  });  });	
	

	//Slider Text Color
	wp.customize( 'optimizer[slider_txt_color]', function( value ) { value.bind( function( newval ) { 
		$('.stat_content_inner').css({"color":newval});
		} );   
	});
	
	//Static Slide Text Alignment
	wp.customize( 'optimizer[slider_content_align]', function( value ) { value.bind( function( newval ) {   $( '.stat_content' ).removeClass('stat_content_right stat_content_left stat_content_center').addClass('stat_content_'+newval);  }); });
	
	
	//Static Slide CTA 1 Hover Background Color
	$("head").append("<style id='static_cta1_hover_bg'></style>");wp.customize('optimizer[static_cta1_bg_color]', function( value ) {value.bind(function( newval) {
		$("#static_cta1_hover_bg").text("body .static_cta1.cta_flat, body .static_cta1.cta_flat_big, body .static_cta1.cta_flat_small, body .static_cta1.cta_rounded, body .static_cta1.cta_rounded_small, body .static_cta1.cta_rounded_big, body .static_cta1.cta_hollow:hover, body .static_cta1.cta_hollow_big:hover, body .static_cta1.cta_hollow_small:hover, body .static_cta1.cta_rounded, body .static_cta1.cta_rounded_big, body .static_cta1.cta_rounded_small, body .static_cta1.cta_hollow:hover, body .static_cta1.cta_hollow_big:hover, body .static_cta1.cta_hollow_small:hover, body .static_cta1.cta_square, body .static_cta1.cta_square_small, body .static_cta1.cta_square_big, body .static_cta1.cta_square_hollow:hover, body .static_cta1.cta_square_hollow_small:hover, body .static_cta1.cta_square_hollow_big:hover{background-color:"+newval+"!important;border-color:"+newval+"!important;}");} );   
	} );
	//Static Slide CTA 1 Hover Text Color
	$("head").append("<style id='static_cta1_hover_txt'></style>");wp.customize('optimizer[static_cta1_txt_color]', function( value ) {value.bind(function( newval) {		$("#static_cta1_hover_txt").text("body .static_cta1.cta_hollow, body .static_cta1.cta_hollow_big, body .static_cta1.cta_hollow_small, body .static_cta1.cta_flat, body .static_cta1.cta_flat_big, body .static_cta1.cta_flat_small, body .static_cta1.cta_rounded, body .static_cta1.cta_rounded_small, body .static_cta1.cta_rounded_big, body .static_cta1.cta_hollow:hover, body .static_cta1.cta_hollow_big:hover, body .static_cta1.cta_hollow_small:hover, body .static_cta1.cta_rounded, body .static_cta1.cta_rounded_big, body .static_cta1.cta_rounded_small, body .static_cta1.cta_hollow:hover, body .static_cta1.cta_hollow_big:hover, body .static_cta1.cta_hollow_small:hover, body .static_cta1.cta_square, body .static_cta1.cta_square_small, body .static_cta1.cta_square_big, body .static_cta1.cta_square_hollow:hover, body .static_cta1.cta_square_hollow_small:hover, body .static_cta1.cta_square_hollow_big:hover, body .static_cta1.cta_square_hollow, body .static_cta1.cta_square_hollow_small, body .static_cta1.cta_square_hollow_big{color:"+newval+"!important}");} );   
	} );


	//Static Slide CTA 2 Hover Background Color
	$("head").append("<style id='static_cta2_hover_bg'></style>");wp.customize('optimizer[static_cta2_bg_color]', function( value ) {value.bind(function( newval) {
		$("#static_cta2_hover_bg").text("body .static_cta2.cta_flat, body .static_cta2.cta_flat_big, body .static_cta2.cta_flat_small, body .static_cta2.cta_rounded, body .static_cta2.cta_rounded_small, body .static_cta2.cta_rounded_big, body .static_cta2.cta_hollow:hover, body .static_cta2.cta_hollow_big:hover, body .static_cta2.cta_hollow_small:hover, body .static_cta2.cta_rounded, body .static_cta2.cta_rounded_big, body .static_cta2.cta_rounded_small, body .static_cta2.cta_hollow:hover, body .static_cta2.cta_hollow_big:hover, body .static_cta2.cta_hollow_small:hover, body .static_cta2.cta_square, body .static_cta2.cta_square_small, body .static_cta2.cta_square_big, body .static_cta2.cta_square_hollow:hover, body .static_cta2.cta_square_hollow_small:hover, body .static_cta2.cta_square_hollow_big:hover{background-color:"+newval+"!important;border-color:"+newval+"!important;}");} );   
	} );
	//Static Slide CTA 2 Hover Text Color
	$("head").append("<style id='static_cta2_hover_txt'></style>");wp.customize('optimizer[static_cta2_txt_color]', function( value ) {value.bind(function( newval) {		$("#static_cta2_hover_txt").text("body .static_cta2.cta_hollow, body .static_cta2.cta_hollow_big, body .static_cta2.cta_hollow_small, body .static_cta2.cta_flat, body .static_cta2.cta_flat_big, body .static_cta2.cta_flat_small, body .static_cta2.cta_rounded, body .static_cta2.cta_rounded_small, body .static_cta2.cta_rounded_big, body .static_cta2.cta_hollow:hover, body .static_cta2.cta_hollow_big:hover, body .static_cta2.cta_hollow_small:hover, body .static_cta2.cta_rounded, body .static_cta2.cta_rounded_big, body .static_cta2.cta_rounded_small, body .static_cta2.cta_hollow:hover, body .static_cta2.cta_hollow_big:hover, body .static_cta2.cta_hollow_small:hover, body .static_cta2.cta_square, body .static_cta2.cta_square_small, body .static_cta2.cta_square_big, body .static_cta2.cta_square_hollow:hover, body .static_cta2.cta_square_hollow_small:hover, body .static_cta2.cta_square_hollow_big:hover, body .static_cta2.cta_square_hollow, body .static_cta2.cta_square_hollow_small, body .static_cta2.cta_square_hollow_big{color:"+newval+"!important}");} );   
	} );

	//Slider Content Width
	wp.customize( 'optimizer[static_textbox_width]', function( value ) { value.bind( function( newval ) {  $('.stat_content_inner .center').css({"width":newval+'%'});
		} );   
	} );
	//Slider Content Bottom margin
	wp.customize( 'optimizer[static_textbox_bottom]', function( value ) { value.bind( function( newval ) {  $('.stat_content_inner').css({"bottom":newval+'%'});
		} );   
	} );

	
	//NIVO-ACCORDION Slider-------------
	//HIDE Slider TEXT
	$("head").append("<style id='slider_txt_hide'></style>");
	wp.customize( 'optimizer[slider_txt_hide]', function( value ) { value.bind( function( newval ) {  
		if(newval ==''){ $("#slider_txt_hide").text("#zn_nivo .nivo-caption, .acord_text{display:block!important;}");}   if(newval == 1){ $("#slider_txt_hide").text("#zn_nivo .nivo-caption, .acord_text{display:none!important;}");}
		} );   
	} );
	
	//Slider Title Font Size
	$("head").append("<style id='slidefont_size_id'></style>");wp.customize('optimizer[slidefont_size_id]', function( value ) {value.bind(function( newval) {					
			$("#slidefont_size_id").text("#accordion h3 a, #zn_nivo h3 a{font-size:"+newval+"!important}");} );   
	} );
	
	//ACCORDION Height
	$("head").append("<style id='slide_height'></style>");wp.customize('optimizer[slide_height]', function( value ) {value.bind(function( newval) {					
			$("#slide_height").text("#accordion, #slide_acord{height:"+newval+"!important}.kwicks li{ max-height:"+newval+"!important;min-height:"+newval+"!important;}");} );   
	} );


	//Restrict Slider Height
	$("head").append("<style id='restrict_slider_height'></style>");wp.customize('optimizer[slider_height]', function( value ) {value.bind(function( newval) {					
			$("#restrict_slider_height").text("body .stat_bg img, body .stat_bg, .stat_bg_img, body .stat_bg_overlay, body .static_gallery.nivoSlider, body #zn_nivo{max-height:"+newval.replace('%', 'vh')+"!important}body #stat_img.stat_has_vid{ max-height:"+newval.replace('%', 'vh')+"!important; overflow: hidden;}");} );   
	} );
	
	// FOOTER------------
	//Hide To Top Button
	wp.customize( 'optimizer[totop_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '.to_top ' ).addClass('hide_totop');}   if(newval == 1){ $( '.to_top' ).removeClass('hide_totop');}  } );
	} );
	//Hide To Top Button
	wp.customize( 'optimizer[footmenu_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '#footer_menu ' ).addClass('hide_footmenu');}   if(newval == 1){ $( '#footer_menu' ).removeClass('hide_footmenu');}  } );
	} );
	//Center Footer Text
	wp.customize( 'optimizer[copyright_center]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '#copyright' ).removeClass('copyright_center');}   if(newval == 1){ $( '#copyright' ).addClass('copyright_center');}  } );
	} );

	//Footer Copyright Content
	wp.customize( 'optimizer[footer_text_id]', function( value ) { value.bind( function( newval ) {   $( '.copytext' ).html( newval );  } );  } );

	// Update the site title and description in real time...
	wp.customize( 'blogname', function( value ) { value.bind( function( newval ) {   $( '.logo h1 a, .logo h2 a' ).html( newval );  } );  } );
	wp.customize( 'blogdescription', function( value ) { value.bind( function( newval ) {   $( '.logo .desc' ).html( newval );  } );  } );

	
	//SINGLE POSTS-----------
	//Hide Featured Image
	wp.customize( 'optimizer[single_featured]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.single_featured' ).removeClass('hide_featuredimg');}   if(newval == ''){ $( '.single_featured' ).addClass('hide_featuredimg');}  } );
	} );
	//Hide Single Meta Info
	wp.customize( 'optimizer[post_info_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.single_metainfo' ).removeClass('hide_singlemeta');}   if(newval == ''){ $( '.single_metainfo' ).addClass('hide_singlemeta');}  } );
	} );
	//Hide About Author
	wp.customize( 'optimizer[author_about_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.author_box' ).removeClass('hide_authorbox');}   if(newval == ''){ $( '.author_box' ).addClass('hide_authorbox');}  } );
	} );
	//Hide Related Content
	wp.customize( 'optimizer[post_related_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '#ast_related_wrap' ).removeClass('hide_related');}   if(newval == ''){ $( '#ast_related_wrap' ).addClass('hide_related');}  } );
	} );
	//Hide Social Share Buttons
	wp.customize( 'optimizer[social_single_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '.share_foot ' ).addClass('hide_share');}   if(newval == 1){ $( '.share_foot ' ).removeClass('hide_share');}  } );
	} );
	//Hide Next Previous Posts
	wp.customize( 'optimizer[post_nextprev_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '#ast_nextprev' ).addClass('hide_nextprev');}   if(newval == 1){ $( '#ast_nextprev' ).removeClass('hide_nextprev');}  } );
	} );
	//Hide Comments
	wp.customize( 'optimizer[post_comments_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.comments_template' ).removeClass('hide_comments');}   if(newval == ''){ $( '.comments_template' ).addClass('hide_comments');}  } );
	} );
	//Leave a Reply Text
	wp.customize( 'optimizer[leave_reply_title]', function( value ) { value.bind( function( newval ) {   $( '#reply-title' ).html( newval );  } );  } );

	
	//PAGE HEADER---------------
	//Hide PAGE HEADER
	wp.customize( 'optimizer[pageheader_switch]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.page_head' ).removeClass('hide_page_head');}   if(newval == ''){ $( '.page_head' ).addClass('hide_page_head');}  } );
	} );
	//Hide BreadCrumbs
	wp.customize( 'optimizer[breadcrumbs_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.layerbread' ).removeClass('hide_breadcrumbs');}   if(newval == ''){ $( '.layerbread' ).addClass('hide_breadcrumbs');}  } );
	} );
	
	//Page Header Font Size
	wp.customize( 'optimizer[pgtitle_size_id]', function( value ) { value.bind( function( newval ) {  $('.page .page_head .postitle').css({"font-size":newval});
		} );   
	} );
	//Page Header Background Color
	wp.customize( 'optimizer[page_header_color]', function( value ) { value.bind( function( newval ) {  $('.page_head, .author_div').css({"background-color":newval});
		} );   
	} );
	//Page Header Text Color
	wp.customize( 'optimizer[page_header_txtcolor]', function( value ) { value.bind( function( newval ) {  $('.page_head, .author_div, .page_head .layerbread a, .page_head .postitle').css({"color":newval});
		} );   
	} );
	//Page Header Text Align
	wp.customize( 'optimizer[page_header_align]', function( value ) { value.bind( function( newval ) {  $('.page_head, .author_div').css({"text-align":newval});
		} );   
	} );


	//COLORS-------------
	//Base Color
	wp.customize( 'optimizer[sec_color_id]', function( value ) { value.bind( function( newval ) { 
		$('#topmenu ul li ul li a:hover, #topmenu li.menu_highlight_slim:hover, #topmenu li.menu_highlight, .widget_border, .heading_border, #wp-calendar #today, .thn_post_wrap .more-link:hover, .moretag:hover, .search_term #searchsubmit, .error_msg #searchsubmit, #searchsubmit, .optimizer_pagenav a:hover, .nav-box a:hover .left_arro, .nav-box a:hover .right_arro, .pace .pace-progress, .homeposts_title .menu_border, .pad_menutitle, span.widget_border, .ast_login_widget #loginform #wp-submit, .prog_wrap, .lts_layout1 a.image, .lts_layout2 a.image, .lts_layout3 a.image, .rel_tab:hover .related_img, .wpcf7-submit, .woo-slider #post_slider li.sale .woo_sale, .nivoinner .slide_button_wrap .lts_button, #accordion .slide_button_wrap .lts_button, .img_hover').css({"background-color":newval});
		} );   
	} );
	
	//#topmenu li.menu_highlight:hover>a
	wp.customize( 'optimizer[sec_color_id]', function( value ) { value.bind( function( newval ) { 
		$('#topmenu li.menu_highlight:hover>a, .share_active, .comm_auth a, .logged-in-as a, .citeping a, .lay3 h2 a:hover, .lay4 h2 a:hover, .lay5 .postitle a:hover, .nivo-caption p a, .acord_text p a, p.form-submit #submit, .org_comment a, .org_ping a, .contact_submit input:hover, .widget_calendar td a, .ast_biotxt a, .ast_bio .ast_biotxt h3, .lts_layout2 .listing-item h2 a:hover, .lts_layout3 .listing-item h2 a:hover, .lts_layout4 .listing-item h2 a:hover, .lts_layout5 .listing-item h2 a:hover, .rel_tab:hover .rel_hover, .post-password-form input[type~=submit], .bio_head h3, .blog_mo a:hover, .ast_navigation a:hover, .lts_layout4 .blog_mo a:hover, #home_widgets .widget .thn_wgt_tt, #sidebar .widget .thn_wgt_tt, #footer .widget .thn_wgt_tt, .astwt_iframe a, .ast_bio .ast_biotxt h3, .ast_bio .ast_biotxt a, .nav-box a span, .lay2 h2.postitle:hover a ').css({"color":newval});
		} );   
	} );
	
	
	//Text Color on Base Color
	wp.customize( 'optimizer[sectxt_color_id]', function( value ) { value.bind( function( newval ) { 
		$('#topmenu ul li ul li a:hover, #topmenu li.menu_highlight_slim:hover>a, #topmenu li.menu_highlight a, #topmenu li.menu_highlight_slim a, .icon_round a, #wp-calendar #today, .moretag:hover, .search_term #searchsubmit, .error_msg #searchsubmit, .optimizer_pagenav a:hover, .ast_login_widget #loginform #wp-submit, #searchsubmit, .prog_wrap, .rel_tab .related_img i, .lay1 h2.postitle a, .nivoinner .slide_button_wrap .lts_button, #accordion .slide_button_wrap .lts_button, .lts_layout1 .icon_wrap a, .lts_layout2 .icon_wrap a, .lts_layout3 .icon_wrap a, .lts_layout1 .icon_wrap a:hover, .lts_layout2 .icon_wrap a:hover, .lts_layout3 .icon_wrap a:hover, .thn_post_wrap .listing-item .moretag:hover, body .lts_layout1 .listing-item .title, .lts_layout2 .img_wrap .optimizer_plus, .img_hover .icon_wrap a, body .thn_post_wrap .lts_layout1 .icon_wrap a, .wpcf7-submit, .woo-slider #post_slider li.sale .woo_sale').css({"color":newval});
		} );   
	} );
	
	//Site Body Text Color
	$("head").append("<style id='bodyfont_color_css'></style>");
	wp.customize( 'optimizer[primtxt_color_id]', function( value ) { value.bind( function( newval ) { 
		$("#bodyfont_color_css").text("html body, .single_metainfo, body .single_post .single_metainfo a, body a:link, body a:visited{color:"+newval+"}");
		} );   
	} );
	//Site Body Font Size
	$("head").append("<style id='bodyfont_size_css'></style>");
	wp.customize( 'optimizer[content_font_id][font-size]', function( value ) { value.bind( function( newval ) { 
		$("#bodyfont_size_css").text("html body, body .comment-form-comment textarea, body .comm_wrap input{font-size:"+newval+"}");
		} );   
	} );
	
	//Logo Color
	wp.customize( 'optimizer[logo_color_id]', function( value ) { value.bind( function( newval ) { 
		$('.logo h2, .logo h1, .logo h2 a, .logo h1 a, #simple-menu, span.desc').css({"color":newval});
		} );   
	} );
	//Logo Size
	wp.customize( 'optimizer[logo_font_id][font-size]', function( value ) { value.bind( function( newval ) { 
		$('.logo h2, .logo h1, .logo h2 a, .logo h1 a').css({"font-size":newval});
		} );   
	} );
	
	//Tagline Font Size
	$("head").append("<style id='tagline_size_id'></style>");wp.customize('optimizer[tagline_font_size]', function( value ) {value.bind(function( newval) {					
			$("#tagline_size_id").text(".desc{font-size:"+newval+"!important}");} );   
	} );

	//Header Color
	wp.customize( 'optimizer[head_color_id]', function( value ) { value.bind( function( newval ) { 
		$('.header, .home.has_trans_header.page .header, .home.has_trans_header.page-template-page-frontpage_template .is-sticky .header, .home .is-sticky .header, .header_sidebar .head_inner').css({"background-color":newval});
		} );   
	} );
	
	//Topbar Background
	wp.customize( 'optimizer[topbar_bg_color]', function( value ) { value.bind( function( newval ) {  $('.head_top ').css({"background-color":newval});  } );  } );
	//Topbar Color
	wp.customize( 'optimizer[topbar_color_id]', function( value ) { value.bind( function( newval ) {  $('.head_search, .top_head_soc a, .topsearch_on .head_phone, .topsearch_on .head_search i, #topbar_menu ul li a, .head_top').css({"color":newval});  } );   } );
	
	//Menu Text Color
	wp.customize( 'optimizer[menutxt_color_id]', function( value ) { value.bind( function( newval ) {  $('#topmenu ul li a, .head_soc .social_bookmarks a').css({"color":newval});  } );   } );
	
	//Menu Text Color Active
	wp.customize( 'optimizer[menutxt_color_active]', function( value ) { value.bind( function( newval ) {  $('#topmenu ul li.current-menu-item>a').css({"color":newval});  } );   } );	
	//Menu Text Color Hover
	$("head").append("<style id='menutxt_css_hover'></style>");  
	wp.customize( 'optimizer[menutxt_color_hover]', function( value ) { value.bind( function( newval ) {  
		$("#menutxt_css_hover").text("#topmenu ul li.menu_hover>a{color:"+newval+"!important}");
	 } );  
	} );	
	
	//Menu Text Font Size
	wp.customize( 'optimizer[menu_size_id]', function( value ) { value.bind( function( newval ) {  
		$('#topmenu ul li a').css({"font-size":newval});  $('#topmenu ul li').css({"line-height":newval});  } );   
	} );
	
	//Slider Title Font Size
	$("head").append("<style id='topbar_font_size'></style>");wp.customize('optimizer[topbar_font_size]', function( value ) {value.bind(function( newval) {					
			$("#topbar_font_size").text(".head_top, #topbar_menu ul li a{font-size:"+newval+"!important}");} );   
	} );
	
	
	//Sidebar Widgets Background Color
	wp.customize( 'optimizer[sidebar_color_id]', function( value ) { value.bind( function( newval ) {  
		$('#sidebar .widget').css({"background-color":newval});  } );   
	} );	
	//Sidebar Widgets Title Color
	wp.customize( 'optimizer[sidebar_tt_color_id]', function( value ) { value.bind( function( newval ) {  
		$('#sidebar .widget .widgettitle, #sidebar .widget .widgettitle a').css({"color":newval});  } );   
	} );
	//Sidebar Widgets Text Color
	wp.customize( 'optimizer[sidebartxt_color_id]', function( value ) { value.bind( function( newval ) {  
		$('#sidebar .widget li a, #sidebar .widget, #sidebar .widget .widget_wrap').css({"color":newval});  } );   
	} );
	//Sidebar Widgets Font Size
	wp.customize( 'optimizer[wgttitle_size_id]', function( value ) { value.bind( function( newval ) {  
		$('#sidebar .widget .widgettitle, #sidebar .widget .widgettitle a').css({"font-size":newval});  } );   
	} );
	
	
	//Footer Widgets Background Color
	wp.customize( 'optimizer[footer_color_id]', function( value ) { value.bind( function( newval ) {  
		$('#footer').css({"background-color":newval});  } );   
	} );
	//Sidebar Widgets Text Color
	wp.customize( 'optimizer[footwdgtxt_color_id]', function( value ) { value.bind( function( newval ) {  
		$('#footer .widgets .widget a, #footer .widgets').css({"color":newval});  } );   
	} );
	//FOOTER Widget Title Color
	wp.customize( 'optimizer[footer_title_color]', function( value ) { value.bind( function( newval ) {  
		$('#footer .widgets .widgettitle, #copyright a').css({"color":newval});  } );   
	} );


	//Post Title Font Size
	wp.customize( 'optimizer[ptitle_size_id]', function( value ) { value.bind( function( newval ) {  
		$('.single .single_post_content .postitle, .product_title').css({"font-size":newval});  } );   
	} );
	//Post Title Color
	wp.customize( 'optimizer[title_txt_color_id]', function( value ) { value.bind( function( newval ) {  
		$('.postitle, .postitle a, .nav-box a, h3#comments, h3#comments_ping, .comment-reply-title, .related_h3, .nocomments, .lts_layout2 .listing-item h2 a, .lts_layout3 .listing-item h2 a, .lts_layout4 .listing-item h2 a, .lts_layout5 .listing-item h2 a, .author_inner h5, .product_title, .woocommerce-tabs h2, .related.products h2, .lts_layout4 .blog_mo a').css({"color":newval});  } );   
	} );
	//Heading Color in Posts
	wp.customize( 'optimizer[heading_color_id]', function( value ) { value.bind( function( newval ) {  
		$('.thn_post_wrap h1, .thn_post_wrap h2, .thn_post_wrap h3, .thn_post_wrap h4, .thn_post_wrap h5, .thn_post_wrap h6').css({"color":newval});  } );   
	} );
	
	//Link Color (Regular)
	$("head").append("<style id='optimlink_color'></style>");  
	wp.customize( 'optimizer[link_color_id]', function( value ) { value.bind( function( newval ) {  
		$("#optimlink_color").text(".org_comment a, .thn_post_wrap a:link, .thn_post_wrap a:visited, .lts_lightbox_content a:link, .lts_lightbox_content a:visited, .athor_desc a:link, .athor_desc a:visited{color:"+newval+"!important}");  } );   
	} );
	//Link Color (HOVER)
	$("head").append("<style id='optimlink_hover'></style>");  
	wp.customize( 'optimizer[link_color_hover]', function( value ) { value.bind( function( newval ) {  
		$("#optimlink_hover").text(".org_comment a:hover, .thn_post_wrap a:link:hover, .lts_lightbox_content a:link:hover, .lts_lightbox_content a:visited:hover, .athor_desc a:link:hover, .athor_desc a:visited:hover{color:"+newval+"!important}");  } );    
	} );
 
	//Turn Menu Text &amp; All Headings to Uppercase
	$("head").append("<style id='txt_upcase_css'></style>"); 
	wp.customize( 'optimizer[txt_upcase_id]', function( value ) {
		value.bind( function( newval ) {   
			if(newval == 0){ $("#txt_upcase_css").text("#topmenu ul li a, .midrow_block h3, .lay1 h2.postitle, .more-link, .moretag, .single_post .postitle, .related_h3, .comments_template #comments, #comments_ping, #reply-title, #submit, #sidebar .widget .widgettitle, #sidebar .widget .widgettitle a, .search_term h2, .search_term #searchsubmit, .error_msg #searchsubmit, #footer .widgets .widgettitle, .home_title, body .lts_layout1 .listing-item .title, .lay4 h2.postitle, .lay2 h2.postitle a, #home_widgets .widget .widgettitle, .product_title, .page_head h1{text-transform:none!important}");	}   
			if(newval == 1){ $("#txt_upcase_css").text("#topmenu ul li a, .midrow_block h3, .lay1 h2.postitle, .more-link, .moretag, .single_post .postitle, .related_h3, .comments_template #comments, #comments_ping, #reply-title, #submit, #sidebar .widget .widgettitle, #sidebar .widget .widgettitle a, .search_term h2, .search_term #searchsubmit, .error_msg #searchsubmit, #footer .widgets .widgettitle, .home_title, body .lts_layout1 .listing-item .title, .lay4 h2.postitle, .lay2 h2.postitle a, #home_widgets .widget .widgettitle, .product_title, .page_head h1{text-transform:uppercase!important}");	}  
		} );
	} );	
	//Copyright Area Background Color
	wp.customize( 'optimizer[copyright_bg_color]', function( value ) { value.bind( function( newval ) {  
		$('#copyright').css({"background-color":newval});  } );   
	} );
	//Copyright Area Text Color
	wp.customize( 'optimizer[copyright_txt_color]', function( value ) { value.bind( function( newval ) {  
		$('#copyright a, #copyright, .copytext').css({"color":newval});  } );   
	} );


	// SOCIAL------------
	//Social Bookmarks Style
	wp.customize( 'optimizer[social_button_style]', function( value ) {
		value.bind( function( newval ) {   
			$( '.social_bookmarks' ).removeClass('bookmark_simple bookmark_round bookmark_square bookmark_hexagon').addClass('bookmark_'+newval+''); 
	} );  });
	//Social Bookmarks Color
	wp.customize( 'optimizer[social_show_color]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.social_bookmarks' ).addClass('social_color');}   if(newval == ''){ $( '.social_bookmarks' ).removeClass('social_color');}  } );
	} );
	//Social Bookmarks Position
	wp.customize( 'optimizer[social_bookmark_pos]', function( value ) {
		value.bind( function( newval ) {   
		if(newval =='topbar'){    $( 'body' ).removeClass('soc_pos_topbar soc_pos_header soc_pos_headfoot soc_pos_topfoot soc_pos_footer');  $( 'body' ).addClass('soc_pos_topbar');}   
		if(newval == 'header'){   $( 'body' ).removeClass('soc_pos_topbar soc_pos_header soc_pos_headfoot soc_pos_topfoot soc_pos_footer');  $( 'body' ).addClass('soc_pos_header'); $('#topmenu').addClass('has_bookmark');} 
		if(newval == 'headfoot'){  $( 'body' ).removeClass('soc_pos_topbar soc_pos_header soc_pos_headfoot soc_pos_topfoot soc_pos_footer'); $( 'body' ).addClass('soc_pos_headfoot'); $('#topmenu').addClass('has_bookmark');}
		if(newval == 'topfoot'){  $( 'body' ).removeClass('soc_pos_topbar soc_pos_header soc_pos_headfoot soc_pos_topfoot soc_pos_footer');  $( 'body' ).addClass('soc_pos_topfoot');  } 
		if(newval == 'footer'){   $( 'body' ).removeClass('soc_pos_topbar soc_pos_header soc_pos_headfoot soc_pos_topfoot soc_pos_footer');  $( 'body' ).addClass('soc_pos_footer');  }  
		} );
	} );
	//Social Bookmarks Size
	wp.customize( 'optimizer[social_bookmark_size]', function( value ) {
		value.bind( function( newval ) {   
			$( '.social_bookmarks' ).removeClass('bookmark_size_normal bookmark_size_large').addClass('bookmark_size_'+newval+''); 
	} );  });
	
	//Share This Label
	wp.customize( 'optimizer[share_label]', function( value ) {
		value.bind( function( newval ) {   $( '.share_label' ).html( newval );  });
	} );
	
	//Social Share Style
	wp.customize( 'optimizer[share_button_style]', function( value ) {
		value.bind( function( newval ) {   
			$( '.share_this' ).removeClass('social_round social_square social_hexagon social_round_color social_square_color social_hexagon_color').addClass('social_'+newval+''); 
	} );  });
	
	//Display Social Share Buttons on Pages Too
	wp.customize( 'optimizer[social_page_id]', function( value ) {
		value.bind( function( newval ) {   if(newval ==''){ $( '.share_foot ' ).addClass('hide_share');}   if(newval == 1){ $( '.share_foot ' ).removeClass('hide_share');}  } );
	} );	
	
	//SOCIAL Links
	wp.customize( 'optimizer[facebook_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_fb' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[twitter_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_twt' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[gplus_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_gplus' ).attr( 'href', newval );  } );  } );
   wp.customize( 'optimizer[youtube_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_ytb' ).attr( 'href', newval );  } );  } );
   wp.customize( 'optimizer[vimeo_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_vimeo' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[flickr_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_flckr' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[linkedin_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_lnkdin' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[pinterest_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_pin' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[tumblr_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_tmblr' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[dribble_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_dribble' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[behance_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_behance' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[instagram_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_insta' ).attr( 'href', newval );  } );  } );
	wp.customize( 'optimizer[rss_field_id]', function( value ) { value.bind( function( newval ) {   $( '.ast_rss' ).attr( 'href', newval );  } );  } );
	

	//MOBILE LAYOUT---------------
	//Hide Slider on Mobile
	wp.customize( 'optimizer[hide_mob_slide]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '#slidera' ).addClass('mobile_hide_slide');}   if(newval == ''){ $( '#slidera' ).removeClass('mobile_hide_slide');}  } );
	} );
	//Hide Right Sidebar on Mobile
	wp.customize( 'optimizer[hide_mob_rightsdbr]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '#sidebar' ).addClass('hide_mob_rightsdbr');}   if(newval == ''){ $( '#sidebar' ).removeClass('hide_mob_rightsdbr');}  } );
	} );
	//Hide Page Header on Mobile
	wp.customize( 'optimizer[hide_mob_page_header]', function( value ) {
		value.bind( function( newval ) {   if(newval ==1){ $( '.page_head' ).addClass('hide_mob_headerimg');}   if(newval == ''){ $( '.page_head' ).removeClass('hide_mob_headerimg');}  } );
	} );
	
	
	//CUSTOM CODE-------------------------
	//Custom CSS
	$("head").append("<style id='live_custom_css'></style>");
	wp.customize( 'optimizer[custom-css]', function( value ) {
		value.bind( function( newval ) {   
			$("#live_custom_css").html(newval);
		} );
	} );
	
})( jQuery );


/*Customizer----------------------------------------------------------*/
jQuery(function() {
if (! jQuery( "body" ).hasClass( "customizer-prev" ) ) { return; }
jQuery('label.current_edit a').on('click',function() {
   if(!jQuery('#customizer_nav').hasClass('customizer_nav_open')){
      jQuery('#customizer_nav').addClass('customizer_nav_open');
   }else{
      jQuery('#customizer_nav').removeClass('customizer_nav_open');
   }
});
jQuery('#customizer_nav ul li a').click(function() {
    jQuery('#customizer_nav').removeClass('customizer_nav_open');
});

jQuery('.customize_page_setting').on('click',function() {
   if(!jQuery('#customizer_nav').hasClass('cogactive')){
      jQuery('.customize_pagemeta_inner').fadeIn('customizer_nav_open');
      jQuery(this).addClass('cogactive');
   }else{
      jQuery('.customize_pagemeta_inner').fadeOut('customizer_nav_open');
      jQuery(this).removeClass('cogactive');
   }
});

	jQuery('.page_sidebar_position label').each(function(index, element) {
		jQuery(this).find('img').removeClass('active_pos');

		if(jQuery(this).find('input:radio').is(":checked")) {
			jQuery(this).find('img').addClass('active_pos');
		}
	});
	jQuery('.page_sidebar_position label').on( 'click', function ( e ) {
		jQuery('.page_sidebar_position label').each(function(index, element) {
            jQuery(this).find('img').removeClass('active_pos');

			if(jQuery(this).find('input:radio').is(":checked")) {
				jQuery(this).find('img').addClass('active_pos');
			}
        });
	});
	jQuery('.customizer_sidebar_holder.has_no_sidebar').prependTo('#content .single_post');
	jQuery('.customizer_sidebar_holder.has_sidebar').insertAfter('#sidebar');

	
	jQuery('.home .customizer_sidebar_holder').insertAfter('#frontsidebar');
	
	//ADD Widget Button for Other Pages
	jQuery('.add_widget_topage').on( 'click', function ( e ) {
			e.preventDefault();
			wp.customize.preview.send( 'focus-current-sidebar', jQuery( this ).parent().data( 'sidebar-id' ) );
	});

//Customizer Static Slide bottom grey bar fix
	jQuery('.customizer-prev .stat_has_img').waitForImages(function() {
			var body_size = jQuery('.stat_has_img .stat_bg_img').height();
			jQuery('.stat_bg, .stat_bg_overlay').height(body_size + 50);
		var resizeTimer;
		jQuery(window).on('resize',function() {
		  clearTimeout(resizeTimer);
		  resizeTimer = setTimeout(function() {
			var body_size = jQuery('.stat_has_img .stat_bg_img').height();
			jQuery('.stat_bg, .stat_bg_overlay').height(body_size + 50);
		  }, 60);
		});
	});

//CUSTOMIZER TOPBAR
if(Cookies.get('customizer_topbar') == 1){
	jQuery('body').addClass('body_tophide');
	jQuery('#customizer_topbar').addClass('tophide');
	jQuery('.hidetop').css({"opacity":"0.5"}).find('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
}
		
jQuery('.hidetop').on('click',function() {
   if(!jQuery('body').hasClass('body_tophide')){
      jQuery('.customizer-prev .header_wrap.layer_wrapper').animate({"marginTop":"0px"}, 200);
      jQuery('#customizer_topbar').addClass('tophide').animate({"top":"-50px", "height":"0px"}, 200);
      jQuery('body').addClass('body_tophide');
      jQuery(this).css({"opacity":"0.5"}).find('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
      Cookies.set('customizer_topbar', 1, { expires: 30, path: '/'});
   }else{
      jQuery('.customizer-prev .header_wrap.layer_wrapper').animate({"marginTop":"50px"}, 200);
      jQuery('#customizer_topbar').removeClass('tophide').animate({"top":"0px", "height":"30px"}, 200);
      jQuery('body').removeClass('body_tophide');
      jQuery(this).css({"opacity":"1"}).find('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
      Cookies.set('customizer_topbar', null, { expires: 30, path: '/'});
   }
});

	//Remove the "Shift Click to Edit the Widget" Message
	setTimeout(function(){
		jQuery('.widget').attr('title', '');
	}, 2000);
	
	//Widget EDIT Button for Front Page
	jQuery(document).on("click", ".edit_widget", function(e) {
			e.preventDefault();
			wp.customize.preview.send( 'focus-widget-control', jQuery( this ).parent().parent().prop( 'id' ) );
	});
	
	//Slider EDIT Button for Front Page
	jQuery(document).on("click", ".edit_slider", function(e) {
			e.preventDefault();
			wp.customize.preview.send( 'focus-slider-control', 'slider_type_id' );
	});
	
	setTimeout(function(){
		wp.customize.preview.send( 'start-tour', jQuery('#customizer_nav').attr('class') );
		
	}, 2000);
	
/*	setTimeout(function(){
		wp.customize.preview.send( 'sidebars-loaded' );
	}, 2000);*/
	
/*	setTimeout(function(){
		wp.customize.preview.send( 'sidebarid', jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid') );
		
	}, 2000);*/

	wp.customize.preview.bind( 'active', function() {
		wp.customize.preview.send( 'sidebarid', jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid') );
	});

	/*Frontpage Replace Posts Section*/
	jQuery('.dummypost .lay4_wrap, .dummypost .home_sidebar').wrapAll('<div class="dummy_content" />');
	jQuery('.replace_widget').prependTo('.dummy_content');

	//Replace Button
	jQuery('.add_widget_home').on( 'click', function ( e ) {
		e.preventDefault();
		wp.customize.preview.send( 'focus-frontsidebar');
   });
   
   jQuery('.custom_preset_window__navs li').on( "click", function(e) {
      var currentTab = jQuery(this).attr('data-tab');
      jQuery('.custom_preset_window__navs li').removeClass('preset_nav_active');
      jQuery(this).addClass('preset_nav_active');
      jQuery('.custom_preset_window__tab').hide();
      jQuery('.custom_preset_window__tab--'+currentTab).show();
      if(currentTab === 'presets'){
         jQuery(".preset_p img").unveil();
      }
      
   });

		//SAVE PAGE PRESET
		var ajaxurl = optim.ajaxurl;
		jQuery( '.preset_save_btn' ).on( "click", function(e) {
			console.log('clicked');
			e.preventDefault();
			var getsidebarid = jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid');
			console.log('getsidebarid- ', getsidebarid); 
         var presetnameval = jQuery('.preset_save input[name="preset_name"]').val();
         
			if(presetnameval !==''){
					var value = jQuery.ajax({
						type: "POST",
						url: ajaxurl,
						data:{action: 'optimizer_wie_save_preset', "sidebarid": getsidebarid, "presetname": presetnameval}
						})
						 .fail(function(r,status,jqXHR) { console.log('failed'); })
						 .done(function(result,status,jqXHR) {
							var array = result.split(',');
							
							//IF Preset Already Exist!
							if(jQuery.inArray(presetnameval, array) !== -1){
								
								jQuery('.preset_save').append('<div class="preset_exist">Preset "'+presetnameval+'" already exist! Overwrite? <button class="preset_exist_cont">Yes</button><button class="preset_exist_cancel">Cancel</button></div>');
								jQuery( '.preset_exist_cont' ).on( "click", function(e) {
									jQuery.ajax({
										type: "POST",
										url: ajaxurl,
										data:{
											"sidebarid": getsidebarid,
											"presetname": presetnameval,
											action: 'optimizer_wie_save_preset'
											}
										})
										 .fail(function(r,status,jqXHR) {
											 console.log('failed');
										 })
										 .done(function(result,status,jqXHR) {
											console.log('success');
											//console.log(result);
											jQuery('.preset_exist').remove();
											jQuery('.save_preset').slideUp();
											jQuery('.custom_preset_window__tab--custom').append('<div class="cpreset_p cpreset_appended" data-presetname="'+presetnameval+'"><div class="preset_holder" title="Preset '+presetnameval+'"><i class="fa fa-star"></i>'+presetnameval+'</div><span class="cpreset_import"><i class="fa-arrow-down"></i> Import Preset</span><span class="cpreset_remove"><i class="fa-trash"></i> Remove </span></div>');
									});
								});
								jQuery( '.preset_exist_cancel' ).on( "click", function(e) {
									jQuery('.preset_exist').remove();
								});
							}else{	

								jQuery.ajax({
									type: "POST",
									url: ajaxurl,
									data:{
										"sidebarid": getsidebarid,
										"presetname": presetnameval,
										action: 'optimizer_wie_save_preset'
										}
									})
									 .fail(function(r,status,jqXHR) {
										 console.log('failed');
									 })
									 .done(function(result,status,jqXHR) {
										console.log('success', jQuery('.preset_save input[name="preset_name"]').val());
										console.log(result);
										jQuery('.save_preset').slideUp();
										jQuery('.custom_preset_window__tab--custom').append('<div class="cpreset_p cpreset_appended" data-presetname="'+presetnameval+'"><div class="preset_holder" title="Preset '+presetnameval+'"><i class="fa fa-star"></i> '+presetnameval+'</div><span class="cpreset_import"><i class="fa-arrow-down"></i> Import Preset</span><span class="cpreset_remove"><i class="fa-trash"></i> Remove </span></div>');
								});
						
							}
					});


			}else{
				console.log('Please Select a name for your Page Preset.');	
			}
			
			
		});
		
		jQuery( '.preset_save_trigger' ).on( "click", function(e) {
				jQuery('.save_preset').slideToggle();
		});
		jQuery( '.preset_import_trigger' ).on( "click", function(e) {
				jQuery('.custom_preset_window').fadeToggle();
		});

	
	//Page Preset IMPORT
	jQuery('.cpreset_import').on( "click", function(e) {
      var presetID = jQuery(this).parent().attr('data-presetid') || '';
		var presetname = jQuery(this).parent().attr('data-presetname');
		var currentsidebar = jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid');
		//var currentpageid = jQuery(this).parent().parent().attr('data-pageid');
		
		if((presetname || presetID) && currentsidebar){
         console.log(presetID);
			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data:{
               "getpresetid": presetID,
					"getpresetname": presetname,
					"getsidebarid": currentsidebar,
					action: 'optimizer_import_custom_preset'
					}
				})
				 .fail(function(r,status,jqXHR) {
					 console.log('failed');
				 })
				 .done(function(result,status,jqXHR) {
					console.log('success');
					jQuery('.custom_preset_window').slideUp();
					wp.customize.preview.send( 'refreshafterpreset' );
					
			});
		}
	});
   
   //Custom Wie file IMPORT
	jQuery('#import_custom_widgets').on( "submit", function(event) {
      event.preventDefault();
		var currentsidebar = jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid');
		var customdata = '';
      
      var fileToLoad = document.getElementById("customwiedata").files[0];
      
      if(!fileToLoad){
         return alert("Please Insert a valid .wie file!");
      }

      var fileReader = new FileReader();
      fileReader.onload = function(fileLoadedEvent){
         customdata = fileLoadedEvent.target.result;
          console.log(customdata);
            if(customdata && customdata.includes('page_x9x9x') && currentsidebar){
               jQuery.ajax({
                  type: "POST",
                  url: ajaxurl,
                  data:{
                     "customdata": customdata,
                     "getsidebarid": currentsidebar,
                     action: 'optimizer_import_custom_preset'
                     }
                  })
                  .fail(function(r,status,jqXHR) {
                     console.log('failed');
                  })
                  .done(function(result,status,jqXHR) {
                     console.log('success');
                     jQuery('.custom_preset_window').slideUp();
                     wp.customize.preview.send( 'refreshafterpreset' );
               });
            }else{
               alert("Not a Valid .wie File! Make sure you have exported the .wie file by clicking the 'Save as Page Preset' button.");
            }

      };
    
      fileReader.readAsText(fileToLoad, "UTF-8");

	});
	
	//Page Preset REMOVE
	jQuery('.cpreset_remove').on( "click", function(e) {
		var presetname = jQuery(this).parent().attr('data-presetname');
		
		if(presetname){
			
			jQuery.ajax({
				context: this,
				type: "POST",
				url: ajaxurl,
				data:{
					"presetremove": presetname,
					action: 'optimizer_remove_custom_preset'
					}
				})
				 .fail(function(r,status,jqXHR) {
					 console.log('failed');
				 })
				 .done(function(result,status,jqXHR) {
					console.log('success');
					//jQuery('.custom_preset_window').slideUp();
					jQuery(this).parent().hide();
			});
		}
   });
   
   //Page Preset Export
   jQuery( '.preset_export_trigger' ).on( "click", function(e) {
      console.log('clicked');
      e.preventDefault();
      var getsidebarid = jQuery("#pagesidebar, #frontsidebar").attr('data-sidebarid');
      console.log('getsidebarid- ', getsidebarid); 
         
         jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data:{
               "sidebarid": getsidebarid,
               "export": true,
               action: 'optimizer_wie_save_preset'
               }
         })
         .fail(function(r,status,jqXHR) {
            console.log('failed');
         })
         .done(function(result,status,jqXHR) {
            console.log('success');
            var filename = jQuery('#pagesidebar') && jQuery('#pagesidebar').attr('data-sidebarid') ? jQuery('#pagesidebar').attr('data-sidebarid') : 'page';
            wp.customize.preview.send( 'widgetized-widgets-export', {filename: filename+"-widgets.wie", widgets: result} );
         });
   });


//Customizer Tooltips
jQuery('.edit_widget, .edit_slider').miniTip();
jQuery('.page_sidebar_position label, .add_widget_topage').miniTip();

	//Customizer widget equal width & Column Shortcode JS
	jQuery( document ).ajaxStop( function() {
		jQuery('.frontpage_sidebar, #pagesidebar').each(function (){  jQuery(this).waitForImages(function() { jQuery(this).find('.widget_col_2').matchHeight({ property: 'min-height'});  });  });
		jQuery('.frontpage_sidebar, #pagesidebar').each(function (){   jQuery(this).waitForImages(function() { jQuery(this).find('.widget_col_3').matchHeight({ property: 'min-height'});  });  });
		jQuery('.frontpage_sidebar, #pagesidebar').each(function (){   jQuery(this).waitForImages(function() { jQuery(this).find('.widget_col_4, .widget_col_3').matchHeight({ property: 'min-height'});  });  });
		jQuery('.frontpage_sidebar, #pagesidebar').each(function (){   jQuery(this).waitForImages(function() { jQuery(this).find('.widget_col_5, .widget_col_6').matchHeight({ property: 'min-height'});  });  });
		jQuery(".text_block_content, .thn_post_wrap, #slidera, .about_inner, .block_content").each(function(){
         var colParent = jQuery(this);
         var col2Selectors = [1,3,5,7,9,11,13,15,17,19]; var col3Selectors = [2,5,8,11,14,17,20,23,26,29]; var col4Selectors = [3,7,11,15,19,23,27,31,35,29];
         col2Selectors.forEach(function(selectorIndex){  colParent.find('.col2').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
         col3Selectors.forEach(function(selectorIndex){  colParent.find('.col3').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
         col4Selectors.forEach(function(selectorIndex){  colParent.find('.col4').eq(selectorIndex).after('<div class="colclear" style="clear:both" />');  })
		});
		jQuery(".text_block_content, .thn_post_wrap, #slidera, .about_inner, .block_content").each(function(){jQuery(this).find('.col2').matchHeight({ byRow: false, property: 'min-height'});});
		
	});

	jQuery( document ).ajaxStop( function() {
		if (typeof noneditable_popup == 'function') { 
			noneditable_popup();
		}
		
		//Newsletter--------------
		jQuery('.optim_newsletter_form input[type="text"], .optim_newsletter_form input[type="email"], .optim_newsletter_form input[type="phone"]').each(function(index, element) { 
			if(jQuery(this).prev().is('label') ){
				var attr = jQuery(this).attr('placeholder');
				if (typeof attr == typeof undefined || attr == false) {
				jQuery(this).attr('placeholder', jQuery(this).prev().text());
				}
			}
		});
			
	});
});

wp.customize.bind( 'preview-ready', function() {
   //console.log('PREVIEW READY!!!!');
   wp.customize.preview.bind( 'OPTIMIZER_CUSTOMIZER_LOAD_URL', function( URL ) {
      console.info( 'OPTIMIZER_CUSTOMIZER_LOAD_URL:', URL );
      if(URL){
         window.location = URL;
         jQuery('body').append('<a id="optimizer_new_preview_link" href="'+URL+'" style="display:none"></a>');
         jQuery('#optimizer_new_preview_link').trigger('click');
      }
   } );
   setTimeout(() => {
      var optim_focus_sidebar = jQuery('#pagesidebar').attr('data-sidebarid')
      //console.log(optim_focus_sidebar);
      if(optim_focus_sidebar){
         wp.customize.preview.send( 'focus-page-sidebar', optim_focus_sidebar );
      }
   }, 1000);


});


jQuery(window).on("load", function() { 
	jQuery(".short_colpick").colpick({layout:'hex',submit:0,colorScheme:'dark',onChange:function(hsb,hex,rgb,el,bySetColor) {
	jQuery(el).css('border-color','#'+hex);
	if(!bySetColor) jQuery(el).val('#'+hex);}}).keyup(function(){jQuery(this).colpickSetColor(this.value);});
	//Tooltip
	jQuery('.mce-btn_shorty, .mce-col2_shorty, .mce-col3_shorty, .mce-col4_shorty').each(function (){ 
		jQuery(this).attr('title', jQuery(this).attr('aria-label'));
	});
	setTimeout(function(){
		jQuery('.mce-btn_shorty').miniTip({ fadeIn: 100, content: 'Button Shortcode'}); jQuery('.mce-col2_shorty').miniTip({ fadeIn: 100, content: '2 Columns Shortcode'});
		jQuery('.mce-col3_shorty').miniTip({ fadeIn: 100, content: '3 Columns Shortcode'}); jQuery('.mce-col4_shorty').miniTip({ fadeIn: 100, content: '4 Columns Shortcode'});
	}, 12000);	
});

/*! js-cookie v3.0.0-rc.0 | MIT */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self,function(){var r=e.Cookies,n=e.Cookies=t();n.noConflict=function(){return e.Cookies=r,n}}())}(this,function(){"use strict";function e(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)e[n]=r[n]}return e}var t={read:function(e){return e.replace(/%3B/g,";")},write:function(e){return e.replace(/;/g,"%3B")}};return function r(n,i){function o(r,o,u){if("undefined"!=typeof document){"number"==typeof(u=e({},i,u)).expires&&(u.expires=new Date(Date.now()+864e5*u.expires)),u.expires&&(u.expires=u.expires.toUTCString()),r=t.write(r).replace(/=/g,"%3D"),o=n.write(String(o),r);var c="";for(var f in u)u[f]&&(c+="; "+f,!0!==u[f]&&(c+="="+u[f].split(";")[0]));return document.cookie=r+"="+o+c}}return Object.create({set:o,get:function(e){if("undefined"!=typeof document&&(!arguments.length||e)){for(var r=document.cookie?document.cookie.split("; "):[],i={},o=0;o<r.length;o++){var u=r[o].split("="),c=u.slice(1).join("="),f=t.read(u[0]).replace(/%3D/g,"=");if(i[f]=n.read(c,f),e===f)break}return e?i[e]:i}},remove:function(t,r){o(t,"",e({},r,{expires:-1}))},withAttributes:function(t){return r(this.converter,e({},this.attributes,t))},withConverter:function(t){return r(e({},this.converter,t),this.attributes)}},{attributes:{value:Object.freeze(i)},converter:{value:Object.freeze(n)}})}(t,{path:"/"})});