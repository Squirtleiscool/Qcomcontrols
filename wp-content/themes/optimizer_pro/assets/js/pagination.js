// AJAX POST PAGINATION

	jQuery(function() {
		
		
		jQuery('.widget .ast_pagenav').each(function(index, element) {
			if(jQuery(this).data('query-max') >= 10){
            jQuery(this).find('.page-numbers:nth-child(1), .page-numbers:nth-child(2), .page-numbers:nth-child(3), .page-numbers:nth-child(1), .page-numbers:nth-child(3), .page-numbers:nth-last-child(3), .page-numbers:nth-last-child(2), .page-numbers:nth-last-child(1)').addClass('pagi_visible');
				jQuery( this ).find('.page-numbers:nth-last-child(3)').before('<span class="pagi_dots">....</span>');
			}else{
				jQuery( this ).find('.page-numbers').addClass('pagi_visible');
			}
      });
		
		
		//PAGINATION AJAX BEGIN
		jQuery( '.widget .ast_pagenav .page-numbers, #nav-below a, .ast_navigation i, .widget .ast_pagenav .pagi_prev, .widget .ast_pagenav .pagi_next' ).on( "click", function(e) {
		e.preventDefault();
				
				//Numbered Pagination Enhancement
				if(jQuery(this).parent().data('query-max') >= 10){
					jQuery( this ).siblings().not('.page-numbers:nth-last-child(3), .page-numbers:nth-last-child(2), .page-numbers:nth-last-child(1)').removeClass('current current-next current-prev pagi_visible');
					jQuery( this ).parent().find('.pagi_dots').remove();
					jQuery( this ).addClass('current');
					jQuery( this ).next('.page-numbers').addClass('current-next pagi_visible');
					jQuery( this ).prev('.page-numbers').prev('.page-numbers').addClass('current-prev pagi_visible'); 
					jQuery( this ).prev('.page-numbers').addClass('current-prev pagi_visible'); 
					jQuery( this ).next('.page-numbers').after('<span class="pagi_dots">....</span>');
					
					if(jQuery( this ).is('.page-numbers:nth-last-child(1), .page-numbers:nth-last-child(2), .page-numbers:nth-last-child(3), .page-numbers:nth-last-child(4), .page-numbers:nth-last-child(5)')){
						jQuery( this ).siblings().removeClass('current');
						jQuery( this ).addClass('current');
						jQuery( this ).parent().find('.pagi_dots').remove();
						jQuery( this ).parent().find('.page-numbers:nth-last-child(4)').before('<span class="pagi_dots">....</span>');
					}
					if(jQuery( this ).is('.page-numbers:nth-last-child(1), .page-numbers:nth-last-child(2)')){
						jQuery( this ).siblings().removeClass('current current-next current-prev pagi_visible');
						jQuery( this ).parent().find('.pagi_dots').remove();
						jQuery( this ).addClass('current');
						jQuery( this ).next('.page-numbers').addClass('current-next pagi_visible');
						jQuery( this ).prev('.page-numbers').addClass('current-prev pagi_visible'); 
						jQuery( this ).prev('.page-numbers').prev('.page-numbers').prev('.page-numbers').prev('.page-numbers').addClass('current-prev pagi_visible');
						jQuery( this ).prev('.page-numbers').prev('.page-numbers').prev('.page-numbers').addClass('current-prev pagi_visible');
						jQuery( this ).prev('.page-numbers').prev('.page-numbers').addClass('current-prev pagi_visible');  
						jQuery( this ).parent().find('.page-numbers:nth-last-child(3)').before('<span class="pagi_dots">....</span>');
					}
				}else{
					jQuery( this ).siblings().removeClass('current');
					jQuery( this ).addClass('current');
			}
				
		
				//Ajax Loading Animation
				jQuery(this).parentsUntil('.optimposts').find('.hentry, .type-product').animate({"opacity":"0.4"});
		
		
		var pagi = jQuery(this).parentsUntil('.optimposts').parent();
		var ajaxurl = postsq.ajaxurl;
		var layout= pagi.data('post-layout');
		var type= pagi.data('post-type');
		var count= pagi.data('post-count');
		var pages= pagi.data('post-pages');
		var category= pagi.data('post-category');
		var product_category= pagi.data('product-category');
		var previewbtn= pagi.data('post-previewbtn');
		var linkbtn= pagi.data('post-linkbtn');
		var navigation= pagi.data('post-navigation');
		
		if(navigation =='numbered'){
			var nextpage= jQuery(this).text();
		}
		
		
		if(navigation =='infscroll' || navigation =='infscroll_auto'){
			var nextpage= jQuery(this).parent().parent().data('infinte-next');
		}
		
		if(navigation =='oldnew'){
			var nextpage = jQuery(this).parent().parent().data('query-count');
			//If Next Button is clicked
			if(jQuery(this).hasClass('fa-angle-right')){
				if(nextpage == jQuery(this).parent().parent().data('query-max')){}else{
					var nextpage = nextpage + 1 ;
				}
			}
			//If Previous Button is clicked
			if(jQuery(this).hasClass('fa-angle-left')){
				if(nextpage == 1){}else{
					var nextpage = nextpage -1 ;
				}
			}
		}
		
		var value = jQuery.ajax({
		
			type: "POST",
			url: ajaxurl,
			context: this,
			data:{
				"layout": layout,
				"type": type,
				"count": count,
				"pages": pages,
				"category": category,
				"product_category": product_category,
				"previewbtn": previewbtn,
				"previewbtn": previewbtn,
				"nextpage": nextpage,
            action: "optimizer_posts",
            beforeSend: function(){
               if(navigation =='infscroll_auto'){
                  jQuery('div[data-post-navigation="infscroll_auto"] #nav-below').addClass('infscroll--loading');
               }
            }
				}
		
         })
			.fail(function(r,status,jqXHR) {
				console.log("failed");
            if(navigation =='infscroll_auto'){
               jQuery('div[data-post-navigation="infscroll_auto"] #nav-below').removeClass('infscroll--loading');
            }
			})
			.done(function(response,status,jqXHR) {
				//console.log(navigation);
				console.log(product_category);
				//console.log(response);
				var ajaxsource = jQuery('<div>' + response + '</div>');
				var newappend = ajaxsource.find('.lay'+layout+'_wrap_ajax').html();
				
				if(navigation =='numbered'){
					jQuery(this).parentsUntil('.optimposts').find('.lay'+layout+'_wrap_ajax').html(newappend);
					//console.log(response);
					//console.log(newappend);
					//jQuery('html, body').animate({scrollTop: jQuery(this).parentsUntil('.optimposts').offset().top -100}, 'medium');
				}
				if(navigation =='infscroll' || navigation =='infscroll_auto'){
					var currentpage = jQuery(this).parent().parent().data('infinte-next');
					jQuery(this).parent().parent().data('infinte-next', currentpage + 1);
					//jQuery('html, body').animate({scrollTop: jQuery(this).offset().top -300}, 'medium');
					if(layout !== '3'){
						jQuery(this).parentsUntil('.optimposts').find('.lay'+layout+'_wrap_ajax').append(newappend);
					}
					var postoucnt = jQuery(this).parentsUntil('.optimposts').find('.lay'+layout+'_wrap_ajax .hentry').length;

					if(postoucnt >= jQuery(this).parent().parent().data('infinite-max') ){
						jQuery(this).parent().parent().addClass('infloaded');
					}
				}
				//}
            if(navigation =='infscroll_auto'){
               jQuery('div[data-post-navigation="infscroll_auto"] #nav-below').removeClass('infscroll--loading');
            }
				
				if(navigation =='oldnew'){
					jQuery(this).parentsUntil('.optimposts').find('.lay'+layout+'_wrap_ajax').html(newappend);
					jQuery(this).parent().parent().data('query-count', nextpage);
					if(nextpage == jQuery(this).parent().parent().data('query-max')){
						jQuery(this).parent().parent().find('.fa-angle-right').addClass('nav_maxed');
					}else{jQuery(this).parent().parent().find('.fa-angle-right').removeClass('nav_maxed');}
					if(nextpage == 1){
						jQuery(this).parent().parent().find('.fa-angle-left').addClass('nav_maxed');
					}else{jQuery(this).parent().parent().find('.fa-angle-left').removeClass('nav_maxed');}
				}
				
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
				
	jQuery('.lay1.optimposts, .lay2.optimposts, .lay4.optimposts').each(function(index, element) {  jQuery(this).waitForImages(function() { jQuery(this).find('.type-product').matchHeight({ property: 'min-height'});  }); });
	jQuery('.lay1.optimposts .type-product').each(function(index, element) {
		jQuery(this).find('.button.add_to_cart_button').prependTo(jQuery(this).find('.imgwrap'));
		jQuery(this).find('span.price').prependTo(jQuery(this).find('.post_image '));
    });
				
				//FrontPage Post Image Zoom	

				if (typeof magnificPopup !== 'undefined' ) {
					jQuery(".imgzoom[href$='.jpg'], .imgzoom[href$='.png'], .imgzoom[href$='.gif']").magnificPopup({type:'image',image: {titleSrc: 'data-title'}});
				}
				
				
				//LAYOUT 3 MASONRY
				if(layout == 3 && ( navigation == 'numbered' || navigation == 'oldnew')){
						var container = jQuery(this).parentsUntil('.optimposts').find('.lay3_wrap_ajax');
						console.log(container);
						//Layout3 Masonry
						var msnry;
						imagesLoaded( container, function() {
							container.masonry({
						  // options
						  itemSelector: '.hentry'
						});
						});
				}
				//LAYOUT 3 MASONRY with Infinite Scroll
				if(layout == 3 && navigation == 'infscroll' || layout == 3 && navigation == 'infscroll_auto'){
					var container = jQuery(this).parentsUntil('.optimposts').find('.lay3_wrap_ajax');
						imagesLoaded( container, function() {
							container.masonry({
						  // options
						  itemSelector: '.hentry'
						});
						});
						jQuery(this).parentsUntil('.optimposts').find('.lay3_wrap').css({"height":"auto"});
						container.masonry('reloadItems');
				}
				
				
			 });
			 
			 //Ajax Loading Animation
			jQuery(this).parentsUntil('.optimposts').find('.hentry, .type-product').animate({"opacity":"1"});
		
      });	
      
       document.addEventListener("scroll", function(evt){
         var infnsCrollContainer  = jQuery('div[data-post-navigation="infscroll_auto"] #nav-below');
         if( infnsCrollContainer ){
            infnsCrollContainer.each(function(index, element) {
               if(optimizer_is_in_view(infnsCrollContainer[0]) && !infnsCrollContainer.hasClass('infscroll--loading')){
                  var postoucnt = jQuery(this).parentsUntil('.optimposts').find('.hentry').length;
                  if(postoucnt >= jQuery(this).data('infinite-max') ){
                     jQuery(this).addClass('infloaded');
                     jQuery(this).find('a').html('<i class="fa fa-smile-o"></i> Loading Complete');
                  }else{
                     jQuery(this).find('a').html('<i class="fa fa-circle-o-notch fa-spin"></i> Loading..');
                     jQuery(this).find('a').click();
                  }
               }
   
            });
         }
      });

	});	