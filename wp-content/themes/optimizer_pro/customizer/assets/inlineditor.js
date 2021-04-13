//Initiate Inline TEXT Editor
function inline_textedit(classes, uniqueid, customizeid){
	//Make the Titles Editable
	jQuery(classes).each(function(index, element) {
		var controlid = jQuery(this).closest('.widget').attr('data-widget-id');
		jQuery(this).attr({ contenteditable:"true", 'data-widget-option':controlid, initialText:jQuery(this).html() }).addClass('inlinetxt '+uniqueid+'');
		
	});
	
	//Display the Save/Cancel Buttons on upon editing
    jQuery('.'+uniqueid).focus(function() {
		jQuery(this).on('input', function(){
			if( jQuery(this).parent().find('.texteditsave').length){ }else{jQuery(this).after('<span class="texteditsave '+uniqueid+'_save"><i class="fa fa-check"></i></span>'); }  
			if( jQuery(this).parent().find('.texteditcancel').length){ }else{jQuery(this).after('<span class="texteditcancel"><i class="fa fa-times"></i></span>'); }  
		});
    });

    //Save the Changes
	jQuery(document).on("click", '.'+uniqueid+'_save', function(e) {
	   //console.log('Saved!!');
        // ...if content is different...
        if (jQuery(this).parent().find('.inlinetxt').data("initialText") !== jQuery(this).parent().find('.inlinetxt').html()) {
			
			//Send The content to Customizer
			var widgetid = jQuery(this).parent().find('.inlinetxt').attr('data-widget-option')
			var thecontent = jQuery(this).parent().find('.inlinetxt').html()
			var content = [widgetid, thecontent ]; 
			
			jQuery(this).parent().find('.inlinetxt').attr("title","Saving Changes..").animate({"opacity":"0.4"});
			jQuery(this).parent().find('.texteditcancel').remove();
			jQuery(this).remove();
			
			//if Widget Title Trigger Title Saving Mechanism
			if (jQuery(this).is('.'+uniqueid+'_save')) {
				//console.log(''+uniqueid+' Change Detected');
				wp.customize.preview.send( customizeid, content );
			}
			
        }
    });
	//Cancel the Changes
	jQuery(document).on("click", ".texteditcancel", function(e) {
	   //console.log('Change Canceled!!');
        if (jQuery(this).parent().find('.inlinetxt').data("initialText") !== jQuery(this).parent().find('.inlinetxt').html()) {
			var contentdiv = jQuery(this).parent().find('.inlinetxt');
            contentdiv.html(contentdiv.attr('initialText'));
			jQuery(this).parent().find('.texteditsave').remove();
			jQuery(this).remove();
        }
    });

}


//If inline tinymce content has shortcode, display warning message
function noneditable_popup(){
	jQuery('.mce-content-body').each(function(index, element) {
        if(jQuery(this).find('.blockshortcode').length){
			 if(!jQuery(this).find('.noneditable_popup').length){
				jQuery(this).addClass('tiny_noneditable').before('<div class="noneditable_popup">This Content contains Complex Shortcode(s). Contents with Complex Shortcodes can be only edited with the <a class="fulleditbtn"><i class="fa fa-pencil"></i> Full Editor</a></div>');
			 }
		}
    });	
	jQuery('.tiny_noneditable').parent().toggle( function(){ 
		jQuery(this).find('.noneditable_popup').fadeIn(); jQuery(this).find('.tiny_noneditable').animate({"opacity":"0.3"});
	}, function(){  
		jQuery(this).find('.noneditable_popup').fadeOut(); jQuery(this).find('.tiny_noneditable').animate({"opacity":"1"});
	});
	
	jQuery('.fulleditbtn').on( 'click', function(){ 
		var widgetid = jQuery(this).closest('.widget').attr('data-widget-id');
		wp.customize.preview.send( "fulleditor", widgetid );
	});
}


//Inline Text Edit Paste Function - Strip HTML on Paste
function onPaste(e){
  var content;

  e.preventDefault();

  if( e.originalEvent.clipboardData ){
	content = (e.originalEvent || e).clipboardData.getData('text/plain');
	document.execCommand('insertText', false, content);
  }
  else if( window.clipboardData ){
	content = window.clipboardData.getData('Text');
	if (window.getSelection)
	  window.getSelection().getRangeAt(0).insertNode( document.createTextNode(content) );
  }
}


//Reintiate the inline tinymce on widget change.
function reinitiate_inline_tiny(){
	//First Remove the tinyMce
	tinymce.remove("div.tiny_content_editable");
	
	//Then initiate again
		( function() {
			var init, id, $wrap;

			if ( typeof tinymce !== 'undefined' ) {
				for ( id in tinyMCEPreInit.mceInit ) {
					init = tinyMCEPreInit.mceInit[id];
					$wrap = tinymce.$( '#wp-' + id + '-wrap' );

					if ( ( $wrap.hasClass( 'tmce-active' ) || ! tinyMCEPreInit.qtInit.hasOwnProperty( id ) ) && ! init.wp_skip_init ) {
						tinymce.init( init );

						if ( ! window.wpActiveEditor ) {
							window.wpActiveEditor = id;
						}
					}
				}
			}

			if ( typeof quicktags !== 'undefined' ) {
				for ( id in tinyMCEPreInit.qtInit ) {
					quicktags( tinyMCEPreInit.qtInit[id] );

					if ( ! window.wpActiveEditor ) {
						window.wpActiveEditor = id;
					}
				}
			}
		}());
}




function inline_button_editor(event){
	
	//Editor Button Popup----------------
	jQuery(document).on('click','.widget .lts_button', function(event) {
		event.preventDefault();
		console.log('Button Clicked');
		var btnpos = jQuery(this).offset();

		jQuery(this).addClass('editing_shortcode');
		jQuery('#inline_button_editor').css({"top":btnpos.top - 360, "left":btnpos.left });
		jQuery('#inline_button_editor').removeClass('animated bounceOut').show().addClass('animated bounceIn');

		
		//Set Current Values
		jQuery('#inline_button_text').val( jQuery(this).attr('data-btn-text') );   jQuery('#inline_button_link').val( jQuery(this).attr('data-btn-url') );
		jQuery('#inline_button_style').val( jQuery(this).attr('data-btn-style') );  jQuery('#inline_button_size').val( jQuery(this).attr('data-btn-size') );
		jQuery('#inline_button_bg').val( jQuery(this).attr('data-btn-bg') );   jQuery('#inline_button_color').val( jQuery(this).attr('data-btn-color') );
		if(jQuery(this).attr('data-btn-window') =='true'){   jQuery('#inline_button_window').val( '1' ).prop('checked');    }
		if(jQuery(this).attr('data-btn-rounded')  =='true'){   jQuery('#inline_button_rounded').val( '1' ).prop('checked');    }
		if(jQuery(this).attr('data-btn-rounded')  =='aligncenter'){   jQuery('#inline_button_center').val( '1' ).prop('checked');    }
		
	});
	//Editor Button Save----------------
	jQuery(document).on('click','#btn_shortcode_update', function(event) {
		
		//Get Updated Values
		var button_text = jQuery('#inline_button_text').val( );  var button_link = jQuery('#inline_button_link').val(  );
		var button_style = jQuery('#inline_button_style').val(  );  var button_size = jQuery('#inline_button_size').val(  );
		var button_bg = jQuery('#inline_button_bg').val(  );  var button_color = jQuery('#inline_button_color').val(  );
		  
		if(jQuery('#inline_button_window').prop('checked')){   var button_window = 'true';    }else{ var button_window = ''; }
		if(jQuery('#inline_button_rounded').prop('checked')){   var button_rounded = 'true'; var lt_rounded = 'lt_rounded';   }else{var button_rounded = ''; var lt_rounded = '';}
		if(jQuery('#inline_button_center').prop('checked')){   var button_center = 'aligncenter'; }else{ var button_center = ''; }
		
		//Add the Datas
		jQuery('.editing_shortcode').attr('data-shortcode','[button text="'+button_text+'" url="'+button_link+'" background_color="'+button_bg+'" text_color="'+button_color+'" style="'+button_style+'" size="'+button_size+'" icon="" open_new_window="'+button_window+'" rounded="'+button_rounded+'" class="'+button_center+'"]');
		jQuery('.editing_shortcode').attr('data-btn-text',button_text); jQuery('.editing_shortcode').attr('data-btn-url',button_link); jQuery('.editing_shortcode').attr('data-btn-style',button_style);
		jQuery('.editing_shortcode').attr('data-btn-size',button_size); jQuery('.editing_shortcode').attr('data-btn-bg',button_bg); jQuery('.editing_shortcode').attr('data-btn-color',button_color);
		jQuery('.editing_shortcode').attr('data-btn-window',button_window); jQuery('.editing_shortcode').attr('data-btn-rounded',button_rounded); jQuery('.editing_shortcode').attr('data-btn-class',button_center);
		
		//Add Content in HTML
		jQuery('.editing_shortcode').html(button_text);
		jQuery('.editing_shortcode').removeClass('lts_button_default lts_button_small lts_button_large lt_rounded lt_flat lt_circular lt_hollow aligncenter');
		jQuery('.editing_shortcode').addClass( button_style + ' lts_button_'+button_size+' '+ lt_rounded+' '+ button_center);
		jQuery('.editing_shortcode').attr('style', 'background: '+button_bg+'; color: '+button_color+'; border-color: '+button_bg+';');
		jQuery('.editing_shortcode').removeClass('.editing_shortcode');
		jQuery('#inline_button_editor').addClass('animated bounceOut').removeClass('animated bounceIn');
		setTimeout(function(){jQuery('#inline_button_editor').fadeOut();}, 600);	
	});
	//Editor Button Cancel-----------------
	jQuery(document).on('click','#btn_shortcode_cancel', function(event) {
		jQuery('#inline_button_editor').addClass('animated bounceOut').removeClass('animated bounceIn');
		setTimeout(function(){jQuery('#inline_button_editor').fadeOut();}, 600);	
		jQuery('.editing_shortcode').removeClass('.editing_shortcode');
	});
}


function wrap_columns(){
	
	jQuery(".col2").each(function(index) {  if(jQuery(this).next().is('.col2')){	jQuery(this).next(".col2").andSelf().wrapAll("<div class='col2wrap' />");	}   });
	jQuery(".col3").each(function(index) {  if(jQuery(this).prev().is('.col3') && jQuery(this).next().is('.col3')){	jQuery(this).prev('.col3').nextAll('.col3').slice( 0, 2 ).andSelf().wrapAll("<div class='col3wrap' />");	}   });
	jQuery(".col4").each(function(index) {  if(jQuery(this).next().is('.col4') && jQuery(this).next().next().is('.col4') && jQuery(this).next().next().next().is('.col4')){	jQuery(this).nextAll('.col4').slice( 0, 3 ).andSelf().wrapAll("<div class='col4wrap' />");	}   });
}


function inline_col2_editor(event){
	
	//Editor Button Popup----------------
	jQuery(document).on('click','.col2wrap', function(event) {
		event.preventDefault();
		console.log('Button Clicked');
		var btnpos = jQuery(this).offset();

		jQuery(this).addClass('editing_col_shortcode');
		jQuery('#inline_col2_editor').css({"top":btnpos.top - 60, "left":btnpos.left });
		jQuery('#inline_col2_editor').removeClass('animated bounceOut').show().addClass('animated bounceIn');
	});
	
	jQuery(document).on('click','#col2_opt1', function(event) {    jQuery('.editing_col_shortcode .col2').css('width','50%').attr('data-width', '50%');    });
	
	jQuery(document).on('click','#col2_opt2', function(event) {    
			jQuery('.editing_col_shortcode .col2').eq(0).css('width','70%').attr('data-width', '70%'); jQuery('.editing_col_shortcode .col2').eq(1).css('width','30%').attr('data-width', '30%');
	});
	
	jQuery(document).on('click','#col2_opt3', function(event) {    
			jQuery('.editing_col_shortcode .col2').eq(0).css('width','30%').attr('data-width', '30%'); jQuery('.editing_col_shortcode .col2').eq(1).css('width','70%').attr('data-width', '70%');
	});
	
	
	jQuery(document).on('click','#col2_remove', function(event) {    jQuery('.editing_col_shortcode').remove();    });

}

function inline_col3_editor(event){
	
	//Editor Button Popup----------------
	jQuery(document).on('click','.col3wrap', function(event) {
		event.preventDefault();
		console.log('Button Clicked');
		var btnpos = jQuery(this).offset();

		jQuery(this).addClass('editing_col_shortcode');
		jQuery('#inline_col3_editor').css({"top":btnpos.top - 60, "left":btnpos.left });
		jQuery('#inline_col3_editor').removeClass('animated bounceOut').show().addClass('animated bounceIn');
	});
	
	jQuery(document).on('click','#col3_opt1', function(event) {    jQuery('.editing_col_shortcode .col3').css('width','33%').attr('data-width', '33%');    });
	
	jQuery(document).on('click','#col3_opt2', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','50%').attr('data-width', '50%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','25%').attr('data-width', '25%'); jQuery('.editing_col_shortcode .col3').eq(2).css('width','25%').attr('data-width', '25%');    
	});
	
	jQuery(document).on('click','#col3_opt3', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','25%').attr('data-width', '25%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','25%').attr('data-width', '25%'); jQuery('.editing_col_shortcode .col3').eq(2).css('width','50%').attr('data-width', '50%');     
	});
	
	jQuery(document).on('click','#col3_opt4', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','25%').attr('data-width', '25%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','50%').attr('data-width', '50%'); jQuery('.editing_col_shortcode .col3').eq(2).css('width','25%').attr('data-width', '25%');    
	});
	
	jQuery(document).on('click','#col3_opt5', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','70%').attr('data-width', '70%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','15%').attr('data-width', '15%');  jQuery('.editing_col_shortcode .col3').eq(2).css('width','15%').attr('data-width', '15%');     
	});
	
	jQuery(document).on('click','#col3_opt6', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','15%').attr('data-width', '15%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','15%').attr('data-width', '15%'); jQuery('.editing_col_shortcode .col3').eq(2).css('width','70%').attr('data-width', '70%');    
	});
	
	jQuery(document).on('click','#col3_opt7', function(event) {    
			jQuery('.editing_col_shortcode .col3').eq(0).css('width','15%').attr('data-width', '15%'); jQuery('.editing_col_shortcode .col3').eq(1).css('width','70%').attr('data-width', '70%');  jQuery('.editing_col_shortcode .col3').eq(2).css('width','15%').attr('data-width', '15%');     
	});
	
	jQuery(document).on('click','#col3_remove', function(event) {    jQuery('.editing_col_shortcode').remove();    });

}


function inline_col4_editor(event){
	
	//Editor Button Popup----------------
	jQuery(document).on('click','.col4wrap', function(event) {
		event.preventDefault();
		console.log('Button Clicked');
		var btnpos = jQuery(this).offset();

		jQuery(this).addClass('editing_col_shortcode');
		jQuery('#inline_col4_editor').css({"top":btnpos.top - 60, "left":btnpos.left });
		jQuery('#inline_col4_editor').removeClass('animated bounceOut').show().addClass('animated bounceIn');
	});
	
	jQuery(document).on('click','#col4_opt1', function(event) {    jQuery('.editing_col_shortcode .col4').css('width','25%').attr('data-width', '25%');    });
	jQuery(document).on('click','#col4_opt2', function(event) {    
			jQuery('.editing_col_shortcode .col4').eq(0).css('width','50%').attr('data-width', '50%'); jQuery('.editing_col_shortcode .col4').eq(1).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(2).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(3).css('width','16.666%').attr('data-width', '16.666%');    
	
	});
	jQuery(document).on('click','#col4_opt3', function(event) {    
			jQuery('.editing_col_shortcode .col4').eq(0).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(1).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(2).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(3).css('width','50%').attr('data-width', '50%');    
	
	});
	jQuery(document).on('click','#col4_opt4', function(event) {    
			jQuery('.editing_col_shortcode .col4').eq(0).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(1).css('width','50%').attr('data-width', '50%'); jQuery('.editing_col_shortcode .col4').eq(2).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(3).css('width','16.666%').attr('data-width', '16.666%');    
	
	});
	jQuery(document).on('click','#col4_opt5', function(event) {    
			jQuery('.editing_col_shortcode .col4').eq(0).css('width','16.666%').attr('data-width', '16.666%'); jQuery('.editing_col_shortcode .col4').eq(1).css('width','16.666%').attr('data-width', '16.666%');  jQuery('.editing_col_shortcode .col4').eq(2).css('width','50%').attr('data-width', '50%');   jQuery('.editing_col_shortcode .col4').eq(3).css('width','16.666%').attr('data-width', '16.666%');    
	
	});
	
	jQuery(document).on('click','#col4_remove', function(event) {    jQuery('.editing_col_shortcode').remove();    });

}


//INITIATE THE EDITOR FUNCTIONS
jQuery(window).on("load", function() {  
	//Title Editor
	inline_textedit('.frontpage_sidebar .about_header span, .frontpage_sidebar .home_title span, .frontpage_sidebar .block_header span, .frontpage_sidebar .widgettitle', 'optimwidgett', 'titledit');
	//SubTitle Editor
	inline_textedit('.frontpage_sidebar .about_pre, .frontpage_sidebar .optimizer_front_clients .home_subtitle span, .frontpage_sidebar .testimonial_title .home_subtitle span, .frontpage_sidebar .homeposts_title .home_subtitle span', 'optimwidgetsub', 'subtitledit');
	//BLOCKS Title Editor
	inline_textedit('.frontpage_sidebar .axn_block1 .block_content > h3', 'block1ttedit', 'blckttedit1'); inline_textedit('.frontpage_sidebar .axn_block2 .block_content > h3', 'block2ttedit', 'blckttedit2');
	inline_textedit('.frontpage_sidebar .axn_block3 .block_content > h3', 'block3ttedit', 'blckttedit3'); inline_textedit('.frontpage_sidebar .axn_block4 .block_content > h3', 'block4ttedit', 'blckttedit4');
	inline_textedit('.frontpage_sidebar .axn_block5 .block_content > h3', 'block5ttedit', 'blckttedit5'); inline_textedit('.frontpage_sidebar .axn_block6 .block_content > h3', 'block6ttedit', 'blckttedit6');
	
	//Countdown Widget
	inline_textedit('.countdown_content', 'counteredit', 'countdnedit'); 
	//Bio Widget
	inline_textedit('.frontpage_sidebar .ast_biotxt p span', 'biotxtedit', 'bioedit'); 
	inline_textedit('.frontpage_sidebar .ast_biotxt h3 span', 'bionamsedit', 'bionamedit');
	inline_textedit('.frontpage_sidebar .ast_biotxt .ast_bioccu span', 'biooccedit', 'bioccuedit');

	//Prevent Pasting of Rich HTML TEXT in inline text editor
	jQuery(document).on('paste', '.inlinetxt', onPaste);

	//Content Has Shortcode Notice
	noneditable_popup(); 
	
	//Run inline Button Editor
	inline_button_editor();
	
	//Run the Columns Wrapper & Editors
	wrap_columns();
	inline_col2_editor();
	inline_col3_editor();
	inline_col4_editor();
	jQuery('html').click(function(e) {	   if(!jQuery(e.target).is('.col2wrap, .col3wrap, .col4wrap') ){	   jQuery('.coleditor').hide();     }  	}); 
	
	function updateCardIfDirty() {
	  if (tinymce.activeEditor.isDirty()) {
			var widgetid = tinymce.activeEditor.getBody().id; 
			jQuery("#"+widgetid).addClass("contentdirty"); 
			
	  }
	}
	setInterval(updateCardIfDirty, 2000); 

});

jQuery( document ).ajaxStop( function() { 
	//Title Editor
	inline_textedit('.frontpage_sidebar .about_header span, .frontpage_sidebar .home_title span, .frontpage_sidebar .block_header span, .frontpage_sidebar .widgettitle', 'optimwidgett', 'titledit');
	//SubTitle Editor
	inline_textedit('.frontpage_sidebar .about_pre, .frontpage_sidebar .optimizer_front_clients .home_subtitle span, .frontpage_sidebar .testimonial_title .home_subtitle span, .frontpage_sidebar .homeposts_title .home_subtitle span', 'optimwidgetsub', 'subtitledit');
	//BLOCKS Title Editor
	inline_textedit('.frontpage_sidebar .axn_block1 .block_content > h3', 'block1ttedit', 'blckttedit1'); inline_textedit('.frontpage_sidebar .axn_block2 .block_content > h3', 'block2ttedit', 'blckttedit2');
	inline_textedit('.frontpage_sidebar .axn_block3 .block_content > h3', 'block3ttedit', 'blckttedit3'); inline_textedit('.frontpage_sidebar .axn_block4 .block_content > h3', 'block4ttedit', 'blckttedit4');
	inline_textedit('.frontpage_sidebar .axn_block5 .block_content > h3', 'block5ttedit', 'blckttedit5'); inline_textedit('.frontpage_sidebar .axn_block6 .block_content > h3', 'block6ttedit', 'blckttedit6');
	
	//Countdown Widget
	inline_textedit('.countdown_content', 'counteredit', 'countdnedit'); 
	//Bio Widget
	inline_textedit('.frontpage_sidebar .ast_biotxt p span', 'biotxtedit', 'bioedit'); 
	inline_textedit('.frontpage_sidebar .ast_biotxt h3 span', 'bionamsedit', 'bionamedit');
	inline_textedit('.frontpage_sidebar .ast_biotxt .ast_bioccu span', 'biooccedit', 'bioccuedit');
	
	
	//Prevent Pasting of Rich HTML TEXT in inline text editor
	jQuery(document).on('paste', '.inlinetxt', onPaste);
	
	//Content Has Shortcode Notice
	noneditable_popup(); 
	
	//Reintiate Tinymce on Widget add/remove
	reinitiate_inline_tiny();
	
	//Run the Columns Wrapper
	wrap_columns();

});