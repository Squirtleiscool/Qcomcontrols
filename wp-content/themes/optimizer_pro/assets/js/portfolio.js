// JavaScript Document
jQuery(function() {
	
	jQuery('.widget .portfolio_nav').each(function(index, element) {
		var wparent =jQuery(this).parent();
		jQuery(this).find('li.cat-item').on('click',function(e) {
			e.preventDefault();
			jQuery(this).siblings().removeClass('active_port_cat');
			jQuery(this).addClass('active_port_cat');

			var getClass = jQuery.grep(this.className.split(" "), function(v, i){return v.indexOf('cat-item-') === 0; }).join();
			jQuery(this).parent().parent().find('.hentry').removeClass('matched_port').hide();
				jQuery(this).parent().parent().find('.hentry').each(function(index, element) {
					var string = jQuery(this).attr('data-cats');
					var array = string.split(',');

					if(jQuery.inArray( getClass, array ) !== -1 ){
						jQuery(this).addClass('matched_port').fadeIn(600);
					}
				});
		});
	});
		//If there is No Category, hide the navigation
		jQuery('.portfolio_nav').not(":has(li.cat-item-none)").show(); 
		
		jQuery('.widget .portfolio_nav').each(function(index, element) {
			
			jQuery(this).find('li.portcat_all').on('click',function(e) {
				e.preventDefault();
				jQuery(this).siblings().removeClass('active_port_cat');
				jQuery(this).addClass('active_port_cat');
				jQuery(this).parent().parent().find('.hentry').fadeOut(400);
				jQuery(this).parent().parent().find('.hentry').addClass('matched_port').fadeIn(400);

			});
		});	
	
	
	jQuery('.lay1_wrap').each(function(index, element) {
			var parentid = '.lay1_wrap';
			
		jQuery(this).on("click", ".hentry .port_preview", function(e) {
			var currentid = jQuery(this).closest('.hentry').attr('id');
			jQuery(parentid).attr('data-current', currentid);
			console.log(parentid);
			portfolio_preview(parentid, currentid);
		});
		
		
		jQuery(document).on("click", ".port_next_prev i.fa.fa-angle-left", function(e) {
			
			var currentid = jQuery(this).data('id');
			jQuery(parentid).attr('data-current', currentid);
			
			jQuery("#portfolio_preview").remove();
			portfolio_preview(parentid, currentid);
			
			console.log(currentid);
		});
		
		
		jQuery(document).on("click", ".port_next_prev i.fa.fa-angle-right", function(e) {
			
			var currentid = jQuery(this).data('id');
			jQuery(parentid).attr('data-current', currentid);
			
			jQuery("#portfolio_preview").remove();
			portfolio_preview(parentid, currentid);
			
			console.log(currentid);
		});

	});
	
	
	jQuery(document).on("click", "span.port_close, .portfolio_backdrop", function(e) {
		jQuery("#portfolio_preview, .portfolio_backdrop").fadeOut(400).delay(400).remove();
	});
	
	function portfolio_preview(parent, id){
			var previd = jQuery(parent+' '+'#'+id).prev().attr('id');
			var nextid = jQuery(parent+' '+'#'+id).next().attr('id');
			var previdhtml=''; var nextidhtml='';
			if(previd){var previdhtml = '<i data-id="'+previd+'" class="fa fa-angle-left"></i>';}
			if(nextid){var nextidhtml = '<i data-id="'+nextid+'" class="fa fa-angle-right"></i>';}
			
			var next_prev = '<div class="port_next_prev">'+previdhtml+''+nextidhtml+'</div><span class="port_close">+</span>';
			var port_url=jQuery(parent+' '+'#'+id).find('.postitle a').attr('href');
			var port_title='<h3><a href="'+port_url+'">'+jQuery(parent+' '+'#'+id).find('.postitle a').text()+'</a></h3>';
			var port_image='<img src="'+jQuery(parent+' '+'#'+id).attr('data-image')+'" />';
			var port_excerpt='<p>'+jQuery(parent+' '+'#'+id).attr('data-excerpt')+'</p>';
			var port_more='<a class="port_more" href="'+port_url+'">'+jQuery(parent+' '+'#'+id).attr('data-moretxt')+'</a>';
			jQuery('body').append('<div id="portfolio_preview"><div class="port_prev_left">'+port_image+'</div><div class="port_prev_right">'+next_prev+''+port_title+''+port_excerpt+''+port_more+'</div><div class="portfolio_backdrop"></div></div>');
			jQuery(this).addClass('active_port_cat');
			
			
		}


});



jQuery(function() {
		
		jQuery( '.optimportfolio #nav-below a' ).on( "click", function(e) {
		e.preventDefault();
		jQuery( this ).siblings().removeClass('current');jQuery( this ).addClass('current');
		
		var pagi = jQuery(this).parentsUntil('.optimportfolio').parent();
		var ajaxurl = postsq.ajaxurl;
		var layout= pagi.data('post-layout');
		var count= pagi.data('post-count');
		var category= pagi.data('post-category');
		var hover= pagi.data('post-hover');
		var previewbtn= pagi.data('post-previewbtn');
		var linkbtn= pagi.data('post-linkbtn');
		var navigation= 'infscroll';
		var nextpage= jQuery(this).parent().parent().data('infinte-next');
		
		var value = jQuery.ajax({
		
			type: "POST",
			url: ajaxurl,
			context: this,
			data:{
				"layout": layout,
				"count": count,
				"category": category,
				"previewbtn": previewbtn,
				"hover": hover,
				"previewbtn": previewbtn,
				"navigation": navigation,
				"nextpage": nextpage,
				action: "optimizer_portfolio_layouts"
				}
		
			})
			 .fail(function(r,status,jqXHR) {
				 console.log("failed");
		
			 })
			 .done(function(response,status,jqXHR) {
				//console.log(nextpage);
				//console.log(hover);
				//console.log(response);
				var ajaxsource = jQuery('<div>' + response + '</div>');

				if(navigation ==='infscroll'){
					var currentpage = jQuery(this).parent().parent().data('infinte-next');
					jQuery(this).parent().parent().data('infinte-next', currentpage + 1);
					jQuery('html, body').animate({scrollTop: jQuery(this).offset().top -300}, 'medium');
					if(layout !== '3' || layout !== '4'){
						var newappend = ajaxsource.find('.port_layout_'+layout+' .lay1_wrap_ajax').html();
						jQuery(this).parentsUntil('.optimportfolio').find('.port_layout_'+layout+' .lay1_wrap_ajax').append(newappend);
					}
					var postoucnt = jQuery(this).parentsUntil('.optimportfolio').find('.port_layout_'+layout+' .lay1_wrap_ajax .hentry').length;
					
					if(postoucnt >= jQuery(this).parent().parent().data('infinite-max') ){
						jQuery(this).parent().parent().addClass('infloaded');
					}
				}

				//LAYOUT 3 MASONRY with Infinite Scroll
				if((layout === 3 ) || (layout === 4 )){
               var container = jQuery(this).parentsUntil('.optimportfolio').find('.port_layout_'+layout+' .lay1_wrap_ajax');
               var allPortSelected = jQuery(this).parentsUntil('.optimportfolio').find('.portfolio_nav .portcat_all').hasClass('active_port_cat') ? true : false;
               console.log(allPortSelected);
						imagesLoaded( container, function() {
							container.masonry({ itemSelector: allPortSelected ? '.hentry' : '.matched_port' });
						});
						jQuery(this).parentsUntil('.optimportfolio').find('.lay1_wrap').css({"height":"auto"});

				}
				
				
			 });
		
		});	
	});	