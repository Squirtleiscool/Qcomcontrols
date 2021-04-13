// JavaScript Document

jQuery(function() {

	//Customize Page-------------
	jQuery('body.post-type-page .wp-editor-tabs').append('<a id="customize_page_btn">Customize</a>');

	//console.log(objectL10n.pageid);
	jQuery('body.post-type-page .wp-editor-tabs a, body.post-type-page .wp-editor-tabs button').on('click',function(){ 
			if(jQuery(this).attr('id') == 'customize_page_btn'){
				jQuery('#post-body-content').addClass('active_customize');	
			}else{
				jQuery('#post-body-content').removeClass('active_customize');
			}
	});	
	if(jQuery('#post-body-content .page_widgetized').length){
		jQuery('#poststuff').addClass('optim_page_customized');	
		jQuery('#post-body-content').addClass('active_customize');	
		//jQuery('#page_template, #optimizer_sidebar_meta_metabox').hide();
	}
	
	//-----------------------------------		
   if(window.optimizer_widgetized_pages && window.optimizer_widgetized_pages.length > 0){
      jQuery("#widgets-right .widgets-holder-wrap div[id^='optimizer_']").each(function(){
            var sidebarID = jQuery(this).attr('id');
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
               jQuery(this).find('.sidebar-name h2').append('<a class="optimizer_sidebar_page_link" target="_blank" href="'+sidebarPageURL+'" title="Open Page \''+pageTitle+'\'"><i class="fa fa-external-link" /></a>');
            }
      })
   }
});


// Duplicate Widgets
jQuery(window).on( 'load widget-updated widget-added', function(widget) {
   //Append The duplicate button
   jQuery('#wpbody-content .widget-control-actions').each(function(index, element) {
         if(jQuery(this).find('.optimizer_duplicate_backend_widget').length == 0){
            jQuery(this).find('.alignleft').after('<a class="optimizer_duplicate_backend_widget">Duplicate</a>');
         }
   });
});
//Duplicate Function
jQuery(document).on('click','.optimizer_duplicate_backend_widget', function(event) {
   let widget = jQuery(this).closest('.widget');
   let newwidget = optimizer_duplicate_backend_widget(widget);
   console.log(newwidget);
   widget.after(newwidget);
   wpWidgets.save(newwidget, 0, 1, 1);
});

function optimizer_duplicate_backend_widget(widget){

   let $widget = widget.clone();

   /// Copy widget hidden id & number values.
   let idBase = $widget.find('input[name="id_base"]').val();
   let wNumber = $widget.find('input[name="widget_number"]').val();
   let mNumber = $widget.find('input[name="multi_number"]').val();
   var highest = 0;


   jQuery('input.widget-id[value|="' + idBase + '"]').each(function() {
     let match = this.value.match(/-(\d+)$/);
     if(match && parseInt(match[1]) > highest)
       highest = parseInt(match[1]);
   });

   let newNum = highest + 1;

   $widget.find('.widget-content').find('input,select,textarea').each(function() {
     let thisAttrName = jQuery(this).attr('name');
     if(thisAttrName)
       jQuery(this).attr('name', thisAttrName.replace(wNumber, newNum));
   });

   // ID creation
   var highest = 0;
   jQuery('.widget').each(function() {
     let match = this.id.match(/^widget-(\d+)/);

     if(match && parseInt(match[1]) > highest)
       highest = parseInt(match[1]);
   });

   let newID = highest + 1;

   // Set widget hidden values.
   $widget[0].id = 'widget-' + newID + '_' + idBase + '-' + newNum;
   $widget.find('input.widget-id').val(idBase +'-'+ newNum);
   $widget.find('input.widget_number').val(newNum);
   $widget.find('.multi_number').val(newNum);

   return $widget;
 }

jQuery(document).on('panelsopen', function(e) {
	jQuery('.so-panels-dialog-wrapper .so-content .color-picker').wpColorPicker();
});

			//CUSTOMIZER & WIDGET COLRPICKER FIELD 
			( function( $ ){
				
					function initColorPicker( widget ) {
						widget.find( '.color-picker' ).wpColorPicker( {
							change: _.throttle( function() { // For Customizer
								$(this).trigger( 'change' );
							}, 2000 )
						});
					}
	
					function onFormUpdate( event, widget ) {
						initColorPicker( widget );
					}
	
					$( document ).on( 'widget-added widget-updated', onFormUpdate );
	
					$(function() {
						$( '#widgets-right .widget:has(.color-picker), .so-panels-dialog-wrapper .so-content .color-picker' ).each( function () {
							initColorPicker( $( this ) );
						} );
					} );
				
			}( jQuery ) );
		
			//REPEATER FIELD OPEN/CLOSE
			function repeatOpen(repeatparent){
				//console.log(repeatparent);
				var hidden = jQuery('#'+repeatparent).parent().find('input').eq(0).is(":hidden");
				var visible = jQuery('#'+repeatparent).parent().find('input').eq(0).is(":visible");
				if(hidden){
					jQuery('#'+repeatparent).parent().addClass('repeatopen');	
				}
				if(visible){
					jQuery('#'+repeatparent).parent().removeClass('repeatopen');	
				}
         }


			
			//BLOCK WIDGET ACCORDION
         jQuery(window).on( 'load', function() {
            jQuery(document).on('click', '.block_accordion h4', function() {
               if(!jQuery(this).parent().hasClass('acc_active')){
                  jQuery(this).parent().addClass('acc_active');
                  jQuery(this).next().slideDown();
               }else{
                  jQuery(this).parent().removeClass('acc_active');
                  jQuery(this).next().slideUp();
               }
            });
         });


jQuery(function($) {
    $(".meta_nav a").on('click',function(event) {
        event.preventDefault();
        $(this).parent().addClass("tabcurrent");
        $(this).parent().siblings().removeClass("tabcurrent");
        var tab = $(this).attr("href");
        $(".optimizer_meta_control").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});

jQuery( window ).on( 'load widget-added widget-updated', function () {

   //Show Clients Widget Auto Navigation Option
   jQuery('.clients_nav_opt').each(function() {
      jQuery(this).on('change', function () {
         if(jQuery(this).is( ":checked" )){
            jQuery(this).parent().parent().find('.clients_navauto_opt').fadeIn();
         }else{
            jQuery(this).parent().parent().find('.clients_navauto_opt').fadeOut();
         }
      })
   });

	//Posts Widget Category Select
	jQuery('.widget_post_type_select').each(function(index, element) {
			jQuery(this).find('select').on('change', function () {
				if (jQuery(this).val() == 'post') {	jQuery(this).parent().parent().find('.post_cat_select, .post_page_select , .product_cat_select').removeClass('post_type_selected');	jQuery(this).parent().parent().find('.post_cat_select').addClass('post_type_selected');		}
				if (jQuery(this).val() == 'page') {	jQuery(this).parent().parent().find('.post_cat_select, .post_page_select , .product_cat_select').removeClass('post_type_selected');	jQuery(this).parent().parent().find('.post_page_select').addClass('post_type_selected');		}
				if (jQuery(this).val() == 'product') {	jQuery(this).parent().parent().find('.post_cat_select, .post_page_select , .product_cat_select').removeClass('post_type_selected');	jQuery(this).parent().parent().find('.product_cat_select').addClass('post_type_selected');	}
			});
	});
	
	//Sldier Widget additional fields
	jQuery('.dynamic_type_field').each(function(index, element) {
		if(jQuery(this).find(":selected").val() == 'carousel'){
				jQuery(this).parent().parent().find('.cars_pausetime').fadeIn();
		}
		jQuery(this).on('change', function() {
			if( jQuery(this).find(":selected").val() == 'carousel'){
					jQuery(this).parent().parent().find('.cars_pausetime').fadeIn();
			}else{
					jQuery(this).parent().parent().find('.cars_pausetime').fadeOut();
			}
		});
		
	 });
	
});

jQuery( window ).on( 'load', function () {

	jQuery(document).on("click", ".remove-field", function(e) {
		jQuery(this).parent().remove();
	});
   
   //Widget Navigation
   jQuery(document).on('click', '.optimizer_widget_navItem', function(){
      var navType = jQuery(this).attr('data-type');
      var widgetContent = jQuery(this).closest('.widget-content');
      widgetContent.find('.optimizer_widget_navItem').removeClass('optimizer_widget_nav--active');
      jQuery(this).addClass('optimizer_widget_nav--active');
      widgetContent.find('.optimizer_widget_tab').hide();
      widgetContent.find('.optimizer_widget_tab--'+navType).fadeIn();
   });

   //Map Widget Tabs
	jQuery(document).on('click', ".widget_contact_title", function() {
		jQuery(this).addClass('widget_active_contact');jQuery('.widget_contact_fields').show();
		jQuery('.widget_map_title').removeClass('widget_active_contact');jQuery('.widget_map_fields').hide();
	});
	jQuery(document).on('click', ".widget_map_title", function() {
		jQuery(this).addClass('widget_active_contact');jQuery('.widget_map_fields').show();
		jQuery('.widget_contact_title').removeClass('widget_active_contact');jQuery('.widget_contact_fields').hide();
	});

});

//Range Input Text Update
function updateRangeInput(val, elmID, type) {
   document.getElementById(elmID).innerHTML = val+type; 
 }
	
//Custom Font Upload
	 function customFontUpload(pickerid){
		var custom_uploader;

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {custom_uploader.open();return; }

        //CREATE THE MEDIA WINDOW
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Insert File',
            button: { text: 'Insert File'},
			type: 'file',
            multiple: false
        });

        //"INSERT MEDIA" ACTION. PREVIEW IMAGE AND INSERT VALUE TO INPUT FIELD
		custom_uploader.on('select', function(){
		var selection = custom_uploader.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				jQuery('#'+pickerid).parent().find('input').val(""+attachment.url+"").trigger('change');

			});
		});
        //OPEN THE MEDIA WINDOW
        custom_uploader.open();

    }

	

//Widget MEDIAPICKER 
	 function mediaPicker(pickerid){
		var custom_uploader;
		var row_id 
        //e.preventDefault();
		row_id = jQuery('#'+pickerid).prev().attr('id');

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
        	custom_uploader.open();
        	return;
        }

        //CREATE THE MEDIA WINDOW
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Insert Images',
            button: {
                text: 'Insert Images'
            },
			type: 'image',
            multiple: false
        });

        //"INSERT MEDIA" ACTION. PREVIEW IMAGE AND INSERT VALUE TO INPUT FIELD
		custom_uploader.on('select', function(){
		var selection = custom_uploader.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				//INSERT THE SRC IN INPUT FIELD
				jQuery('#' + row_id).val(""+attachment.url+"").trigger('change');
					//APPEND THE PREVIEW IMAGE
					jQuery('#' + row_id).parent().find('.media-picker-preview, .media-picker-remove').remove();
					if(attachment.sizes && attachment.sizes.medium){
						jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.sizes.medium.url+'" /><i class="fa fa-times media-picker-remove"></i>');
					}else{
						jQuery('#' + row_id).parent().prepend('<img class="media-picker-preview" src="'+attachment.url+'" /><i class="fa fa-times media-picker-remove"></i>');
					}

			});
			jQuery(".media-picker-remove").on('click',function(e) {
				jQuery(this).parent().find('.media-picker').val('').trigger('change');
				jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
			});
		});
        //OPEN THE MEDIA WINDOW
        custom_uploader.open();

    }

//Widget SLIDER 
	 function sliderPicker(pickerid){
		var custom_uploader;
		var row_id 
        //e.preventDefault();
		row_id = jQuery('#'+pickerid).prev().attr('id');

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
        	custom_uploader.open();
        	return;
        }
		console.log(row_id);
		//CHECK IF INPUT FIELD IS NOT EMPTY
		var val = jQuery('#'+row_id).val();
		if ( !val ) {
			final = '[gallery ids="0"]';
		} else {
			final = '[gallery ids="' + val + '"]';
		}

        //CREATE THE MEDIA WINDOW
		var custom_uploader = wp.media.gallery.edit( final );

					custom_uploader.on('update', function( selection ) {
						
						jQuery('#'+row_id+'_preview .slider_preview_thumb').hide();
						//var numberlist = []; 

							//console.log(selection.models);
							var ids = selection.models.map(
								function( e ) {
									element = e.toJSON();
									preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
									preview_html = "<img class='slider_preview_thumb' src=" +preview_img+">";
									jQuery( '#'+row_id+'_preview' ).append( preview_html );
									jQuery( '#'+row_id+'_preview .slider_empty' ).hide();
									return e.id;
								}
							);
							
							//Insert Attachment ids in the Input field
							jQuery( '#'+row_id+'' ).val(ids.join(",")).trigger('change');
							jQuery( '#'+row_id+'_remove' ).show();

						});

					//Open the uploader dialog
					custom_uploader.open( jQuery('#'+custom_uploader.el.id).addClass('gallery-window'));


    }

	 function sliderRemove(buttonid){
		 jQuery('#'+buttonid).parent().find('img').remove();
		 jQuery('#'+buttonid).hide();
		 jQuery('#'+buttonid).parent().find('.slider_empty').show();
		 jQuery('#'+buttonid).parent().next('input.slider-picker').val('').trigger('change');

	 }

jQuery(window).on( 'load', function() {

	jQuery(document).on('click', ".media-picker-remove" ,function(e) {
		jQuery(this).parent().find('.media-picker').val('').trigger('change');
		jQuery(this).parent().find('.media-picker-preview, .media-picker-remove').remove();
	});


});

jQuery(function() {
	//CountDown Widget
    function runDatepicker() {
        var found = jQuery( '#widgets-right .ast_date' );
        found.each( function( index, value ) {
			var date = jQuery('.ast_date').datepicker({ dateFormat: 'mm/dd/yy' }).val();
		});
	}
    jQuery( document ).ajaxStop( function() {
        runDatepicker();
    });
	
});

/**
 * WP Editor Widget object
 */

WPEditorWidget = {
	
	/** 
	 * @var string
	 */
	currentContentId: '',
	
	/**
	 * @var string
	 */
	 currentEditorPage: '',
	 
	 /**
	  * @var int
	  */
	 wpFullOverlayOriginalZIndex: 0,

	/**
	 * Show the editor
	 * @param string contentId
	 */
	showEditor: function(contentId) {
		jQuery('#wp-editor-widget-backdrop').show();
		jQuery('body.widgets-php #wp-editor-widget-container, body.post-type-page #wp-editor-widget-container, body.fl-builder #wp-editor-widget-container').show();
		jQuery('body.wp-customizer #wp-editor-widget-container').fadeIn(100).animate({"left":"0"});
		
		this.currentContentId = contentId;
		
		if(jQuery('body').hasClass('wp-customizer')){  
			this.currentEditorPage =  'wp-customizer'; 
		}else if(jQuery('body').hasClass('widgets-php')){
			this.currentEditorPage =  'widgets-php'; 
		}else{  
			this.currentEditorPage =  'wp-pagescreen'; 
		}

		
		if (this.currentEditorPage == "wp-customizer") {
			this.wpFullOverlayOriginalZIndex = parseInt(jQuery('.wp-full-overlay').css('zIndex'));
			jQuery('.wp-full-overlay').css({ zIndex: 49000 });
		}
		
		this.setEditorContent(contentId);
	},
	
	/**
	 * Hide editor
	 */
	hideEditor: function() {
		jQuery('#wp-editor-widget-backdrop').hide();
		jQuery('body.widgets-php #wp-editor-widget-container, body.post-type-page #wp-editor-widget-container, body.fl-builder #wp-editor-widget-container').hide();
		jQuery('body.wp-customizer #wp-editor-widget-container').animate({"left":"-650px"}).fadeOut();
		
		if (this.currentEditorPage == "wp-customizer") {
			jQuery('.wp-full-overlay').css({ zIndex: this.wpFullOverlayOriginalZIndex });
		}
	},
	
	/**
	 * Set editor content
	 */
	setEditorContent: function(contentId) {
		var editor = tinyMCE.EditorManager.get('wpeditorwidget');
		var content = jQuery('#'+ contentId).val();

		if (typeof editor == "object" && editor !== null) {
			editor.setContent(content);
		}
		jQuery('#wpeditorwidget').val(content);
	},
	
	/**
	 * Update widget and close the editor
	 */
	updateWidgetAndCloseEditor: function() {
		
		jQuery('#wpeditorwidget-tmce').trigger('click');
		var editor = tinyMCE.EditorManager.get('wpeditorwidget');

		if (typeof editor == "undefined" || editor == null || editor.isHidden()) {
			var content = jQuery('#wpeditorwidget').val();
		}
		else {
			var content = editor.getContent();
		}

		jQuery('#'+ this.currentContentId).val(content);
		
		// customize.php
		if (this.currentEditorPage == "wp-customizer" &&  jQuery('#'+ this.currentContentId).attr('class') == 'editorfield') {
			var controlid = jQuery('#'+ this.currentContentId).data('customize-setting-link');
			//console.log(controlid);
			setTimeout(function(){
			wp.customize(controlid, function(obj) {
				obj.set(editor.getContent());
			} );
			}, 1000);
			
			
		}else if (this.currentEditorPage == "wp-customizer") {
			var widget_id = jQuery('#'+ this.currentContentId).closest('div.form').find('input.widget-id').val();
			var widget_form_control = wp.customize.Widgets.getWidgetFormControlForWidget( widget_id )
			widget_form_control.updateWidget();
		}
		// If Widgets Edit Page
		else if (this.currentEditorPage == "widgets-php") {
			wpWidgets.save(jQuery('#'+ this.currentContentId).closest('div.widget'), 0, 1, 0);
		}
		
		// If Page builder
		else {
			
			jQuery('#'+ this.currentContentId).closest('div.form').find('input.widget-id').val(editor.getContent());
		}
		
		this.hideEditor();
	}
	
};

/*-----------------------------------------------------FONTAWESOME----------------------------------------------------------*/
jQuery(function() {
	//jQuery(".layer-menu-icon .icon_added").after("");
	jQuery(document).on("click", ".layer-icon-select>i", function(e) {
	  jQuery(this).parent().find('.package').remove();
	  jQuery(this).parent().append(appendIcons);
	  jQuery(this).parent().find('.package').fadeIn();
	});
	jQuery(document).on("click", ".layer-icon-select .package .faicons_wrap i", function(e) {
		jQuery(this).parent().parent().parent().parent().find("#layermenu").after("<span class='clear_icon'>+</span>");
		jQuery(this).parent().parent().parent().parent().find("#layermenu").removeClass().addClass(jQuery(this).attr('class'));
		jQuery(this).parent().parent().parent().parent().find("input").addClass('menuadded').val(jQuery(this).attr('class'));
	  //jQuery(this).parent().parent().parent().parent().parent().find('input').val(jQuery(this).attr('class'));
	  jQuery(".layer-icon-select .package").fadeOut();
	});
	
	jQuery(document).on("click", ".nav-menus-php div.icon_select_header i", function(e) {
		jQuery(".layer-icon-select .package").fadeOut();
	});
	
	jQuery(document).on("click", ".layer-icon-select .clear_icon", function(e) {
		jQuery(this).parent().find("#layermenu").removeClass().addClass("fa ");
		jQuery(this).parent().parent().find("input").val("");
		jQuery(this).remove();
	});
});
	
var appendIcons = '<div class="package"><div class="icon_select_header">Select Icon <i class="close_icon_select fa fa-times"></i></div><div class="faicons_wrap"><i class="fa-500px"><span>fa-500px</span></i><i class="fa-adjust"><span>fa-adjust</span></i><i class="fa-adn"><span>fa-adn</span></i><i class="fa-align-center"><span>fa-align-center</span></i><i class="fa-align-justify"><span>fa-align-justify</span></i><i class="fa-align-left"><span>fa-align-left</span></i><i class="fa-align-right"><span>fa-align-right</span></i><i class="fa-amazon"><span>fa-amazon</span></i><i class="fa-ambulance"><span>fa-ambulance</span></i><i class="fa-anchor"><span>fa-anchor</span></i><i class="fa-android"><span>fa-android</span></i><i class="fa-angellist"><span>fa-angellist</span></i><i class="fa-angle-double-down"><span>fa-angle-double-down</span></i><i class="fa-angle-double-left"><span>fa-angle-double-left</span></i><i class="fa-angle-double-right"><span>fa-angle-double-right</span></i><i class="fa-angle-double-up"><span>fa-angle-double-up</span></i><i class="fa-angle-down"><span>fa-angle-down</span></i><i class="fa-angle-left"><span>fa-angle-left</span></i><i class="fa-angle-right"><span>fa-angle-right</span></i><i class="fa-angle-up"><span>fa-angle-up</span></i><i class="fa-apple"><span>fa-apple</span></i><i class="fa-archive"><span>fa-archive</span></i><i class="fa-area-chart"><span>fa-area-chart</span></i><i class="fa-arrow-circle-down"><span>fa-arrow-circle-down</span></i><i class="fa-arrow-circle-left"><span>fa-arrow-circle-left</span></i><i class="fa-arrow-circle-o-down"><span>fa-arrow-circle-o-down</span></i><i class="fa-arrow-circle-o-left"><span>fa-arrow-circle-o-left</span></i><i class="fa-arrow-circle-o-right"><span>fa-arrow-circle-o-right</span></i><i class="fa-arrow-circle-o-up"><span>fa-arrow-circle-o-up</span></i><i class="fa-arrow-circle-right"><span>fa-arrow-circle-right</span></i><i class="fa-arrow-circle-up"><span>fa-arrow-circle-up</span></i><i class="fa-arrow-down"><span>fa-arrow-down</span></i><i class="fa-arrow-left"><span>fa-arrow-left</span></i><i class="fa-arrow-right"><span>fa-arrow-right</span></i><i class="fa-arrow-up"><span>fa-arrow-up</span></i><i class="fa-arrows"><span>fa-arrows</span></i><i class="fa-arrows-alt"><span>fa-arrows-alt</span></i><i class="fa-arrows-h"><span>fa-arrows-h</span></i><i class="fa-arrows-v"><span>fa-arrows-v</span></i><i class="fa-asterisk"><span>fa-asterisk</span></i><i class="fa-at"><span>fa-at</span></i><i class="fa-automobile"><span>fa-automobile</span></i><i class="fa-backward"><span>fa-backward</span></i><i class="fa-balance-scale"><span>fa-balance-scale</span></i><i class="fa-ban"><span>fa-ban</span></i><i class="fa-bank"><span>fa-bank</span></i><i class="fa-bar-chart"><span>fa-bar-chart</span></i><i class="fa-bar-chart-o"><span>fa-bar-chart-o</span></i><i class="fa-barcode"><span>fa-barcode</span></i><i class="fa-bars"><span>fa-bars</span></i><i class="fa-battery-0"><span>fa-battery-0</span></i><i class="fa-battery-1"><span>fa-battery-1</span></i><i class="fa-battery-2"><span>fa-battery-2</span></i><i class="fa-battery-3"><span>fa-battery-3</span></i><i class="fa-battery-4"><span>fa-battery-4</span></i><i class="fa-battery-empty"><span>fa-battery-empty</span></i><i class="fa-battery-full"><span>fa-battery-full</span></i><i class="fa-battery-half"><span>fa-battery-half</span></i><i class="fa-battery-quarter"><span>fa-battery-quarter</span></i><i class="fa-battery-three-quarters"><span>fa-battery-three-quarters</span></i><i class="fa-bed"><span>fa-bed</span></i><i class="fa-beer"><span>fa-beer</span></i><i class="fa-behance"><span>fa-behance</span></i><i class="fa-behance-square"><span>fa-behance-square</span></i><i class="fa-bell"><span>fa-bell</span></i><i class="fa-bell-o"><span>fa-bell-o</span></i><i class="fa-bell-slash"><span>fa-bell-slash</span></i><i class="fa-bell-slash-o"><span>fa-bell-slash-o</span></i><i class="fa-bicycle"><span>fa-bicycle</span></i><i class="fa-binoculars"><span>fa-binoculars</span></i><i class="fa-birthday-cake"><span>fa-birthday-cake</span></i><i class="fa-bitbucket"><span>fa-bitbucket</span></i><i class="fa-bitbucket-square"><span>fa-bitbucket-square</span></i><i class="fa-bitcoin"><span>fa-bitcoin</span></i><i class="fa-black-tie"><span>fa-black-tie</span></i><i class="fa-bluetooth"><span>fa-bluetooth</span></i><i class="fa-bluetooth-b"><span>fa-bluetooth-b</span></i><i class="fa-bold"><span>fa-bold</span></i><i class="fa-bolt"><span>fa-bolt</span></i><i class="fa-bomb"><span>fa-bomb</span></i><i class="fa-book"><span>fa-book</span></i><i class="fa-bookmark"><span>fa-bookmark</span></i><i class="fa-bookmark-o"><span>fa-bookmark-o</span></i><i class="fa-briefcase"><span>fa-briefcase</span></i><i class="fa-btc"><span>fa-btc</span></i><i class="fa-bug"><span>fa-bug</span></i><i class="fa-building"><span>fa-building</span></i><i class="fa-building-o"><span>fa-building-o</span></i><i class="fa-bullhorn"><span>fa-bullhorn</span></i><i class="fa-bullseye"><span>fa-bullseye</span></i><i class="fa-bus"><span>fa-bus</span></i><i class="fa-buysellads"><span>fa-buysellads</span></i><i class="fa-cab"><span>fa-cab</span></i><i class="fa-calculator"><span>fa-calculator</span></i><i class="fa-calendar"><span>fa-calendar</span></i><i class="fa-calendar-check-o"><span>fa-calendar-check-o</span></i><i class="fa-calendar-minus-o"><span>fa-calendar-minus-o</span></i><i class="fa-calendar-o"><span>fa-calendar-o</span></i><i class="fa-calendar-plus-o"><span>fa-calendar-plus-o</span></i><i class="fa-calendar-times-o"><span>fa-calendar-times-o</span></i><i class="fa-camera"><span>fa-camera</span></i><i class="fa-camera-retro"><span>fa-camera-retro</span></i><i class="fa-car"><span>fa-car</span></i><i class="fa-caret-down"><span>fa-caret-down</span></i><i class="fa-caret-left"><span>fa-caret-left</span></i><i class="fa-caret-right"><span>fa-caret-right</span></i><i class="fa-caret-square-o-down"><span>fa-caret-square-o-down</span></i><i class="fa-caret-square-o-left"><span>fa-caret-square-o-left</span></i><i class="fa-caret-square-o-right"><span>fa-caret-square-o-right</span></i><i class="fa-caret-square-o-up"><span>fa-caret-square-o-up</span></i><i class="fa-caret-up"><span>fa-caret-up</span></i><i class="fa-cart-arrow-down"><span>fa-cart-arrow-down</span></i><i class="fa-cart-plus"><span>fa-cart-plus</span></i><i class="fa-cc"><span>fa-cc</span></i><i class="fa-cc-amex"><span>fa-cc-amex</span></i><i class="fa-cc-diners-club"><span>fa-cc-diners-club</span></i><i class="fa-cc-discover"><span>fa-cc-discover</span></i><i class="fa-cc-jcb"><span>fa-cc-jcb</span></i><i class="fa-cc-mastercard"><span>fa-cc-mastercard</span></i><i class="fa-cc-paypal"><span>fa-cc-paypal</span></i><i class="fa-cc-stripe"><span>fa-cc-stripe</span></i><i class="fa-cc-visa"><span>fa-cc-visa</span></i><i class="fa-certificate"><span>fa-certificate</span></i><i class="fa-chain"><span>fa-chain</span></i><i class="fa-chain-broken"><span>fa-chain-broken</span></i><i class="fa-check"><span>fa-check</span></i><i class="fa-check-circle"><span>fa-check-circle</span></i><i class="fa-check-circle-o"><span>fa-check-circle-o</span></i><i class="fa-check-square"><span>fa-check-square</span></i><i class="fa-check-square-o"><span>fa-check-square-o</span></i><i class="fa-chevron-circle-down"><span>fa-chevron-circle-down</span></i><i class="fa-chevron-circle-left"><span>fa-chevron-circle-left</span></i><i class="fa-chevron-circle-right"><span>fa-chevron-circle-right</span></i><i class="fa-chevron-circle-up"><span>fa-chevron-circle-up</span></i><i class="fa-chevron-down"><span>fa-chevron-down</span></i><i class="fa-chevron-left"><span>fa-chevron-left</span></i><i class="fa-chevron-right"><span>fa-chevron-right</span></i><i class="fa-chevron-up"><span>fa-chevron-up</span></i><i class="fa-child"><span>fa-child</span></i><i class="fa-chrome"><span>fa-chrome</span></i><i class="fa-circle"><span>fa-circle</span></i><i class="fa-circle-o"><span>fa-circle-o</span></i><i class="fa-circle-o-notch"><span>fa-circle-o-notch</span></i><i class="fa-circle-thin"><span>fa-circle-thin</span></i><i class="fa-clipboard"><span>fa-clipboard</span></i><i class="fa-clock-o"><span>fa-clock-o</span></i><i class="fa-clone"><span>fa-clone</span></i><i class="fa-close"><span>fa-close</span></i><i class="fa-cloud"><span>fa-cloud</span></i><i class="fa-cloud-download"><span>fa-cloud-download</span></i><i class="fa-cloud-upload"><span>fa-cloud-upload</span></i><i class="fa-cny"><span>fa-cny</span></i><i class="fa-code"><span>fa-code</span></i><i class="fa-code-fork"><span>fa-code-fork</span></i><i class="fa-codepen"><span>fa-codepen</span></i><i class="fa-codiepie"><span>fa-codiepie</span></i><i class="fa-coffee"><span>fa-coffee</span></i><i class="fa-cog"><span>fa-cog</span></i><i class="fa-cogs"><span>fa-cogs</span></i><i class="fa-columns"><span>fa-columns</span></i><i class="fa-comment"><span>fa-comment</span></i><i class="fa-comment-o"><span>fa-comment-o</span></i><i class="fa-commenting"><span>fa-commenting</span></i><i class="fa-commenting-o"><span>fa-commenting-o</span></i><i class="fa-comments"><span>fa-comments</span></i><i class="fa-comments-o"><span>fa-comments-o</span></i><i class="fa-compass"><span>fa-compass</span></i><i class="fa-compress"><span>fa-compress</span></i><i class="fa-connectdevelop"><span>fa-connectdevelop</span></i><i class="fa-contao"><span>fa-contao</span></i><i class="fa-copy"><span>fa-copy</span></i><i class="fa-copyright"><span>fa-copyright</span></i><i class="fa-creative-commons"><span>fa-creative-commons</span></i><i class="fa-credit-card"><span>fa-credit-card</span></i><i class="fa-credit-card-alt"><span>fa-credit-card-alt</span></i><i class="fa-crop"><span>fa-crop</span></i><i class="fa-crosshairs"><span>fa-crosshairs</span></i><i class="fa-css3"><span>fa-css3</span></i><i class="fa-cube"><span>fa-cube</span></i><i class="fa-cubes"><span>fa-cubes</span></i><i class="fa-cut"><span>fa-cut</span></i><i class="fa-cutlery"><span>fa-cutlery</span></i><i class="fa-dashboard"><span>fa-dashboard</span></i><i class="fa-dashcube"><span>fa-dashcube</span></i><i class="fa-database"><span>fa-database</span></i><i class="fa-dedent"><span>fa-dedent</span></i><i class="fa-delicious"><span>fa-delicious</span></i><i class="fa-desktop"><span>fa-desktop</span></i><i class="fa-deviantart"><span>fa-deviantart</span></i><i class="fa-diamond"><span>fa-diamond</span></i><i class="fa-digg"><span>fa-digg</span></i><i class="fa-dollar"><span>fa-dollar</span></i><i class="fa-dot-circle-o"><span>fa-dot-circle-o</span></i><i class="fa-download"><span>fa-download</span></i><i class="fa-dribbble"><span>fa-dribbble</span></i><i class="fa-dropbox"><span>fa-dropbox</span></i><i class="fa-drupal"><span>fa-drupal</span></i><i class="fa-edge"><span>fa-edge</span></i><i class="fa-edit"><span>fa-edit</span></i><i class="fa-eject"><span>fa-eject</span></i><i class="fa-ellipsis-h"><span>fa-ellipsis-h</span></i><i class="fa-ellipsis-v"><span>fa-ellipsis-v</span></i><i class="fa-empire"><span>fa-empire</span></i><i class="fa-envelope"><span>fa-envelope</span></i><i class="fa-envelope-o"><span>fa-envelope-o</span></i><i class="fa-envelope-square"><span>fa-envelope-square</span></i><i class="fa-eraser"><span>fa-eraser</span></i><i class="fa-eur"><span>fa-eur</span></i><i class="fa-euro"><span>fa-euro</span></i><i class="fa-exchange"><span>fa-exchange</span></i><i class="fa-exclamation"><span>fa-exclamation</span></i><i class="fa-exclamation-circle"><span>fa-exclamation-circle</span></i><i class="fa-exclamation-triangle"><span>fa-exclamation-triangle</span></i><i class="fa-expand"><span>fa-expand</span></i><i class="fa-expeditedssl"><span>fa-expeditedssl</span></i><i class="fa-external-link"><span>fa-external-link</span></i><i class="fa-external-link-square"><span>fa-external-link-square</span></i><i class="fa-eye"><span>fa-eye</span></i><i class="fa-eye-slash"><span>fa-eye-slash</span></i><i class="fa-eyedropper"><span>fa-eyedropper</span></i><i class="fa-facebook"><span>fa-facebook</span></i><i class="fa-facebook-f"><span>fa-facebook-f</span></i><i class="fa-facebook-official"><span>fa-facebook-official</span></i><i class="fa-facebook-square"><span>fa-facebook-square</span></i><i class="fa-fast-backward"><span>fa-fast-backward</span></i><i class="fa-fast-forward"><span>fa-fast-forward</span></i><i class="fa-fax"><span>fa-fax</span></i><i class="fa-feed"><span>fa-feed</span></i><i class="fa-female"><span>fa-female</span></i><i class="fa-fighter-jet"><span>fa-fighter-jet</span></i><i class="fa-file"><span>fa-file</span></i><i class="fa-file-archive-o"><span>fa-file-archive-o</span></i><i class="fa-file-audio-o"><span>fa-file-audio-o</span></i><i class="fa-file-code-o"><span>fa-file-code-o</span></i><i class="fa-file-excel-o"><span>fa-file-excel-o</span></i><i class="fa-file-image-o"><span>fa-file-image-o</span></i><i class="fa-file-movie-o"><span>fa-file-movie-o</span></i><i class="fa-file-o"><span>fa-file-o</span></i><i class="fa-file-pdf-o"><span>fa-file-pdf-o</span></i><i class="fa-file-photo-o"><span>fa-file-photo-o</span></i><i class="fa-file-picture-o"><span>fa-file-picture-o</span></i><i class="fa-file-powerpoint-o"><span>fa-file-powerpoint-o</span></i><i class="fa-file-sound-o"><span>fa-file-sound-o</span></i><i class="fa-file-text"><span>fa-file-text</span></i><i class="fa-file-text-o"><span>fa-file-text-o</span></i><i class="fa-file-video-o"><span>fa-file-video-o</span></i><i class="fa-file-word-o"><span>fa-file-word-o</span></i><i class="fa-file-zip-o"><span>fa-file-zip-o</span></i><i class="fa-files-o"><span>fa-files-o</span></i><i class="fa-film"><span>fa-film</span></i><i class="fa-filter"><span>fa-filter</span></i><i class="fa-fire"><span>fa-fire</span></i><i class="fa-fire-extinguisher"><span>fa-fire-extinguisher</span></i><i class="fa-firefox"><span>fa-firefox</span></i><i class="fa-flag"><span>fa-flag</span></i><i class="fa-flag-checkered"><span>fa-flag-checkered</span></i><i class="fa-flag-o"><span>fa-flag-o</span></i><i class="fa-flash"><span>fa-flash</span></i><i class="fa-flask"><span>fa-flask</span></i><i class="fa-flickr"><span>fa-flickr</span></i><i class="fa-floppy-o"><span>fa-floppy-o</span></i><i class="fa-folder"><span>fa-folder</span></i><i class="fa-folder-o"><span>fa-folder-o</span></i><i class="fa-folder-open"><span>fa-folder-open</span></i><i class="fa-folder-open-o"><span>fa-folder-open-o</span></i><i class="fa-font"><span>fa-font</span></i><i class="fa-fonticons"><span>fa-fonticons</span></i><i class="fa-fort-awesome"><span>fa-fort-awesome</span></i><i class="fa-forumbee"><span>fa-forumbee</span></i><i class="fa-forward"><span>fa-forward</span></i><i class="fa-foursquare"><span>fa-foursquare</span></i><i class="fa-frown-o"><span>fa-frown-o</span></i><i class="fa-futbol-o"><span>fa-futbol-o</span></i><i class="fa-gamepad"><span>fa-gamepad</span></i><i class="fa-gavel"><span>fa-gavel</span></i><i class="fa-gbp"><span>fa-gbp</span></i><i class="fa-ge"><span>fa-ge</span></i><i class="fa-gear"><span>fa-gear</span></i><i class="fa-gears"><span>fa-gears</span></i><i class="fa-genderless"><span>fa-genderless</span></i><i class="fa-get-pocket"><span>fa-get-pocket</span></i><i class="fa-gg"><span>fa-gg</span></i><i class="fa-gg-circle"><span>fa-gg-circle</span></i><i class="fa-gift"><span>fa-gift</span></i><i class="fa-git"><span>fa-git</span></i><i class="fa-git-square"><span>fa-git-square</span></i><i class="fa-github"><span>fa-github</span></i><i class="fa-github-alt"><span>fa-github-alt</span></i><i class="fa-github-square"><span>fa-github-square</span></i><i class="fa-gittip"><span>fa-gittip</span></i><i class="fa-glass"><span>fa-glass</span></i><i class="fa-globe"><span>fa-globe</span></i><i class="fa-google"><span>fa-google</span></i><i class="fa-google-plus"><span>fa-google-plus</span></i><i class="fa-google-plus-square"><span>fa-google-plus-square</span></i><i class="fa-google-wallet"><span>fa-google-wallet</span></i><i class="fa-graduation-cap"><span>fa-graduation-cap</span></i><i class="fa-gratipay"><span>fa-gratipay</span></i><i class="fa-group"><span>fa-group</span></i><i class="fa-h-square"><span>fa-h-square</span></i><i class="fa-hacker-news"><span>fa-hacker-news</span></i><i class="fa-hand-grab-o"><span>fa-hand-grab-o</span></i><i class="fa-hand-lizard-o"><span>fa-hand-lizard-o</span></i><i class="fa-hand-o-down"><span>fa-hand-o-down</span></i><i class="fa-hand-o-left"><span>fa-hand-o-left</span></i><i class="fa-hand-o-right"><span>fa-hand-o-right</span></i><i class="fa-hand-o-up"><span>fa-hand-o-up</span></i><i class="fa-hand-paper-o"><span>fa-hand-paper-o</span></i><i class="fa-hand-peace-o"><span>fa-hand-peace-o</span></i><i class="fa-hand-pointer-o"><span>fa-hand-pointer-o</span></i><i class="fa-hand-rock-o"><span>fa-hand-rock-o</span></i><i class="fa-hand-scissors-o"><span>fa-hand-scissors-o</span></i><i class="fa-hand-spock-o"><span>fa-hand-spock-o</span></i><i class="fa-hand-stop-o"><span>fa-hand-stop-o</span></i><i class="fa-hashtag"><span>fa-hashtag</span></i><i class="fa-hdd-o"><span>fa-hdd-o</span></i><i class="fa-header"><span>fa-header</span></i><i class="fa-headphones"><span>fa-headphones</span></i><i class="fa-heart"><span>fa-heart</span></i><i class="fa-heart-o"><span>fa-heart-o</span></i><i class="fa-heartbeat"><span>fa-heartbeat</span></i><i class="fa-history"><span>fa-history</span></i><i class="fa-home"><span>fa-home</span></i><i class="fa-hospital-o"><span>fa-hospital-o</span></i><i class="fa-hotel"><span>fa-hotel</span></i><i class="fa-hourglass"><span>fa-hourglass</span></i><i class="fa-hourglass-1"><span>fa-hourglass-1</span></i><i class="fa-hourglass-2"><span>fa-hourglass-2</span></i><i class="fa-hourglass-3"><span>fa-hourglass-3</span></i><i class="fa-hourglass-end"><span>fa-hourglass-end</span></i><i class="fa-hourglass-half"><span>fa-hourglass-half</span></i><i class="fa-hourglass-o"><span>fa-hourglass-o</span></i><i class="fa-hourglass-start"><span>fa-hourglass-start</span></i><i class="fa-houzz"><span>fa-houzz</span></i><i class="fa-html5"><span>fa-html5</span></i><i class="fa-i-cursor"><span>fa-i-cursor</span></i><i class="fa-ils"><span>fa-ils</span></i><i class="fa-image"><span>fa-image</span></i><i class="fa-inbox"><span>fa-inbox</span></i><i class="fa-indent"><span>fa-indent</span></i><i class="fa-industry"><span>fa-industry</span></i><i class="fa-info"><span>fa-info</span></i><i class="fa-info-circle"><span>fa-info-circle</span></i><i class="fa-inr"><span>fa-inr</span></i><i class="fa-instagram"><span>fa-instagram</span></i><i class="fa-institution"><span>fa-institution</span></i><i class="fa-internet-explorer"><span>fa-internet-explorer</span></i><i class="fa-intersex"><span>fa-intersex</span></i><i class="fa-ioxhost"><span>fa-ioxhost</span></i><i class="fa-italic"><span>fa-italic</span></i><i class="fa-joomla"><span>fa-joomla</span></i><i class="fa-jpy"><span>fa-jpy</span></i><i class="fa-jsfiddle"><span>fa-jsfiddle</span></i><i class="fa-key"><span>fa-key</span></i><i class="fa-keyboard-o"><span>fa-keyboard-o</span></i><i class="fa-krw"><span>fa-krw</span></i><i class="fa-language"><span>fa-language</span></i><i class="fa-laptop"><span>fa-laptop</span></i><i class="fa-lastfm"><span>fa-lastfm</span></i><i class="fa-lastfm-square"><span>fa-lastfm-square</span></i><i class="fa-leaf"><span>fa-leaf</span></i><i class="fa-leanpub"><span>fa-leanpub</span></i><i class="fa-legal"><span>fa-legal</span></i><i class="fa-lemon-o"><span>fa-lemon-o</span></i><i class="fa-level-down"><span>fa-level-down</span></i><i class="fa-level-up"><span>fa-level-up</span></i><i class="fa-life-bouy"><span>fa-life-bouy</span></i><i class="fa-life-buoy"><span>fa-life-buoy</span></i><i class="fa-life-ring"><span>fa-life-ring</span></i><i class="fa-life-saver"><span>fa-life-saver</span></i><i class="fa-lightbulb-o"><span>fa-lightbulb-o</span></i><i class="fa-line-chart"><span>fa-line-chart</span></i><i class="fa-link"><span>fa-link</span></i><i class="fa-linkedin"><span>fa-linkedin</span></i><i class="fa-linkedin-square"><span>fa-linkedin-square</span></i><i class="fa-linux"><span>fa-linux</span></i><i class="fa-list"><span>fa-list</span></i><i class="fa-list-alt"><span>fa-list-alt</span></i><i class="fa-list-ol"><span>fa-list-ol</span></i><i class="fa-list-ul"><span>fa-list-ul</span></i><i class="fa-location-arrow"><span>fa-location-arrow</span></i><i class="fa-lock"><span>fa-lock</span></i><i class="fa-long-arrow-down"><span>fa-long-arrow-down</span></i><i class="fa-long-arrow-left"><span>fa-long-arrow-left</span></i><i class="fa-long-arrow-right"><span>fa-long-arrow-right</span></i><i class="fa-long-arrow-up"><span>fa-long-arrow-up</span></i><i class="fa-magic"><span>fa-magic</span></i><i class="fa-magnet"><span>fa-magnet</span></i><i class="fa-mail-forward"><span>fa-mail-forward</span></i><i class="fa-mail-reply"><span>fa-mail-reply</span></i><i class="fa-mail-reply-all"><span>fa-mail-reply-all</span></i><i class="fa-male"><span>fa-male</span></i><i class="fa-map"><span>fa-map</span></i><i class="fa-map-marker"><span>fa-map-marker</span></i><i class="fa-map-o"><span>fa-map-o</span></i><i class="fa-map-pin"><span>fa-map-pin</span></i><i class="fa-map-signs"><span>fa-map-signs</span></i><i class="fa-mars"><span>fa-mars</span></i><i class="fa-mars-double"><span>fa-mars-double</span></i><i class="fa-mars-stroke"><span>fa-mars-stroke</span></i><i class="fa-mars-stroke-h"><span>fa-mars-stroke-h</span></i><i class="fa-mars-stroke-v"><span>fa-mars-stroke-v</span></i><i class="fa-maxcdn"><span>fa-maxcdn</span></i><i class="fa-meanpath"><span>fa-meanpath</span></i><i class="fa-medium"><span>fa-medium</span></i><i class="fa-medkit"><span>fa-medkit</span></i><i class="fa-meh-o"><span>fa-meh-o</span></i><i class="fa-mercury"><span>fa-mercury</span></i><i class="fa-microphone"><span>fa-microphone</span></i><i class="fa-microphone-slash"><span>fa-microphone-slash</span></i><i class="fa-minus"><span>fa-minus</span></i><i class="fa-minus-circle"><span>fa-minus-circle</span></i><i class="fa-minus-square"><span>fa-minus-square</span></i><i class="fa-minus-square-o"><span>fa-minus-square-o</span></i><i class="fa-mixcloud"><span>fa-mixcloud</span></i><i class="fa-mobile"><span>fa-mobile</span></i><i class="fa-mobile-phone"><span>fa-mobile-phone</span></i><i class="fa-modx"><span>fa-modx</span></i><i class="fa-money"><span>fa-money</span></i><i class="fa-moon-o"><span>fa-moon-o</span></i><i class="fa-mortar-board"><span>fa-mortar-board</span></i><i class="fa-motorcycle"><span>fa-motorcycle</span></i><i class="fa-mouse-pointer"><span>fa-mouse-pointer</span></i><i class="fa-music"><span>fa-music</span></i><i class="fa-navicon"><span>fa-navicon</span></i><i class="fa-neuter"><span>fa-neuter</span></i><i class="fa-newspaper-o"><span>fa-newspaper-o</span></i><i class="fa-object-group"><span>fa-object-group</span></i><i class="fa-object-ungroup"><span>fa-object-ungroup</span></i><i class="fa-odnoklassniki"><span>fa-odnoklassniki</span></i><i class="fa-odnoklassniki-square"><span>fa-odnoklassniki-square</span></i><i class="fa-opencart"><span>fa-opencart</span></i><i class="fa-openid"><span>fa-openid</span></i><i class="fa-opera"><span>fa-opera</span></i><i class="fa-optin-monster"><span>fa-optin-monster</span></i><i class="fa-outdent"><span>fa-outdent</span></i><i class="fa-pagelines"><span>fa-pagelines</span></i><i class="fa-paint-brush"><span>fa-paint-brush</span></i><i class="fa-paper-plane"><span>fa-paper-plane</span></i><i class="fa-paper-plane-o"><span>fa-paper-plane-o</span></i><i class="fa-paperclip"><span>fa-paperclip</span></i><i class="fa-paragraph"><span>fa-paragraph</span></i><i class="fa-paste"><span>fa-paste</span></i><i class="fa-pause"><span>fa-pause</span></i><i class="fa-pause-circle"><span>fa-pause-circle</span></i><i class="fa-pause-circle-o"><span>fa-pause-circle-o</span></i><i class="fa-paw"><span>fa-paw</span></i><i class="fa-paypal"><span>fa-paypal</span></i><i class="fa-pencil"><span>fa-pencil</span></i><i class="fa-pencil-square"><span>fa-pencil-square</span></i><i class="fa-pencil-square-o"><span>fa-pencil-square-o</span></i><i class="fa-percent"><span>fa-percent</span></i><i class="fa-phone"><span>fa-phone</span></i><i class="fa-phone-square"><span>fa-phone-square</span></i><i class="fa-photo"><span>fa-photo</span></i><i class="fa-picture-o"><span>fa-picture-o</span></i><i class="fa-pie-chart"><span>fa-pie-chart</span></i><i class="fa-pied-piper"><span>fa-pied-piper</span></i><i class="fa-pied-piper-alt"><span>fa-pied-piper-alt</span></i><i class="fa-pinterest"><span>fa-pinterest</span></i><i class="fa-pinterest-p"><span>fa-pinterest-p</span></i><i class="fa-pinterest-square"><span>fa-pinterest-square</span></i><i class="fa-plane"><span>fa-plane</span></i><i class="fa-play"><span>fa-play</span></i><i class="fa-play-circle"><span>fa-play-circle</span></i><i class="fa-play-circle-o"><span>fa-play-circle-o</span></i><i class="fa-plug"><span>fa-plug</span></i><i class="fa-plus"><span>fa-plus</span></i><i class="fa-plus-circle"><span>fa-plus-circle</span></i><i class="fa-plus-square"><span>fa-plus-square</span></i><i class="fa-plus-square-o"><span>fa-plus-square-o</span></i><i class="fa-power-off"><span>fa-power-off</span></i><i class="fa-print"><span>fa-print</span></i><i class="fa-product-hunt"><span>fa-product-hunt</span></i><i class="fa-puzzle-piece"><span>fa-puzzle-piece</span></i><i class="fa-qq"><span>fa-qq</span></i><i class="fa-qrcode"><span>fa-qrcode</span></i><i class="fa-question"><span>fa-question</span></i><i class="fa-question-circle"><span>fa-question-circle</span></i><i class="fa-quote-left"><span>fa-quote-left</span></i><i class="fa-quote-right"><span>fa-quote-right</span></i><i class="fa-ra"><span>fa-ra</span></i><i class="fa-random"><span>fa-random</span></i><i class="fa-rebel"><span>fa-rebel</span></i><i class="fa-recycle"><span>fa-recycle</span></i><i class="fa-reddit"><span>fa-reddit</span></i><i class="fa-reddit-alien"><span>fa-reddit-alien</span></i><i class="fa-reddit-square"><span>fa-reddit-square</span></i><i class="fa-refresh"><span>fa-refresh</span></i><i class="fa-registered"><span>fa-registered</span></i><i class="fa-remove"><span>fa-remove</span></i><i class="fa-renren"><span>fa-renren</span></i><i class="fa-reorder"><span>fa-reorder</span></i><i class="fa-repeat"><span>fa-repeat</span></i><i class="fa-reply"><span>fa-reply</span></i><i class="fa-reply-all"><span>fa-reply-all</span></i><i class="fa-retweet"><span>fa-retweet</span></i><i class="fa-rmb"><span>fa-rmb</span></i><i class="fa-road"><span>fa-road</span></i><i class="fa-rocket"><span>fa-rocket</span></i><i class="fa-rotate-left"><span>fa-rotate-left</span></i><i class="fa-rotate-right"><span>fa-rotate-right</span></i><i class="fa-rouble"><span>fa-rouble</span></i><i class="fa-rss"><span>fa-rss</span></i><i class="fa-rss-square"><span>fa-rss-square</span></i><i class="fa-rub"><span>fa-rub</span></i><i class="fa-ruble"><span>fa-ruble</span></i><i class="fa-rupee"><span>fa-rupee</span></i><i class="fa-safari"><span>fa-safari</span></i><i class="fa-save"><span>fa-save</span></i><i class="fa-scissors"><span>fa-scissors</span></i><i class="fa-scribd"><span>fa-scribd</span></i><i class="fa-search"><span>fa-search</span></i><i class="fa-search-minus"><span>fa-search-minus</span></i><i class="fa-search-plus"><span>fa-search-plus</span></i><i class="fa-sellsy"><span>fa-sellsy</span></i><i class="fa-send"><span>fa-send</span></i><i class="fa-send-o"><span>fa-send-o</span></i><i class="fa-server"><span>fa-server</span></i><i class="fa-share"><span>fa-share</span></i><i class="fa-share-alt"><span>fa-share-alt</span></i><i class="fa-share-alt-square"><span>fa-share-alt-square</span></i><i class="fa-share-square"><span>fa-share-square</span></i><i class="fa-share-square-o"><span>fa-share-square-o</span></i><i class="fa-shekel"><span>fa-shekel</span></i><i class="fa-sheqel"><span>fa-sheqel</span></i><i class="fa-shield"><span>fa-shield</span></i><i class="fa-ship"><span>fa-ship</span></i><i class="fa-shirtsinbulk"><span>fa-shirtsinbulk</span></i><i class="fa-shopping-bag"><span>fa-shopping-bag</span></i><i class="fa-shopping-basket"><span>fa-shopping-basket</span></i><i class="fa-shopping-cart"><span>fa-shopping-cart</span></i><i class="fa-sign-in"><span>fa-sign-in</span></i><i class="fa-sign-out"><span>fa-sign-out</span></i><i class="fa-signal"><span>fa-signal</span></i><i class="fa-simplybuilt"><span>fa-simplybuilt</span></i><i class="fa-sitemap"><span>fa-sitemap</span></i><i class="fa-skyatlas"><span>fa-skyatlas</span></i><i class="fa-skype"><span>fa-skype</span></i><i class="fa-slack"><span>fa-slack</span></i><i class="fa-sliders"><span>fa-sliders</span></i><i class="fa-slideshare"><span>fa-slideshare</span></i><i class="fa-smile-o"><span>fa-smile-o</span></i><i class="fa-soccer-ball-o"><span>fa-soccer-ball-o</span></i><i class="fa-sort"><span>fa-sort</span></i><i class="fa-sort-alpha-asc"><span>fa-sort-alpha-asc</span></i><i class="fa-sort-alpha-desc"><span>fa-sort-alpha-desc</span></i><i class="fa-sort-amount-asc"><span>fa-sort-amount-asc</span></i><i class="fa-sort-amount-desc"><span>fa-sort-amount-desc</span></i><i class="fa-sort-asc"><span>fa-sort-asc</span></i><i class="fa-sort-desc"><span>fa-sort-desc</span></i><i class="fa-sort-down"><span>fa-sort-down</span></i><i class="fa-sort-numeric-asc"><span>fa-sort-numeric-asc</span></i><i class="fa-sort-numeric-desc"><span>fa-sort-numeric-desc</span></i><i class="fa-sort-up"><span>fa-sort-up</span></i><i class="fa-soundcloud"><span>fa-soundcloud</span></i><i class="fa-space-shuttle"><span>fa-space-shuttle</span></i><i class="fa-spinner"><span>fa-spinner</span></i><i class="fa-spoon"><span>fa-spoon</span></i><i class="fa-spotify"><span>fa-spotify</span></i><i class="fa-square"><span>fa-square</span></i><i class="fa-square-o"><span>fa-square-o</span></i><i class="fa-stack-exchange"><span>fa-stack-exchange</span></i><i class="fa-stack-overflow"><span>fa-stack-overflow</span></i><i class="fa-star"><span>fa-star</span></i><i class="fa-star-half"><span>fa-star-half</span></i><i class="fa-star-half-empty"><span>fa-star-half-empty</span></i><i class="fa-star-half-full"><span>fa-star-half-full</span></i><i class="fa-star-half-o"><span>fa-star-half-o</span></i><i class="fa-star-o"><span>fa-star-o</span></i><i class="fa-steam"><span>fa-steam</span></i><i class="fa-steam-square"><span>fa-steam-square</span></i><i class="fa-step-backward"><span>fa-step-backward</span></i><i class="fa-step-forward"><span>fa-step-forward</span></i><i class="fa-stethoscope"><span>fa-stethoscope</span></i><i class="fa-sticky-note"><span>fa-sticky-note</span></i><i class="fa-sticky-note-o"><span>fa-sticky-note-o</span></i><i class="fa-stop"><span>fa-stop</span></i><i class="fa-stop-circle"><span>fa-stop-circle</span></i><i class="fa-stop-circle-o"><span>fa-stop-circle-o</span></i><i class="fa-street-view"><span>fa-street-view</span></i><i class="fa-strikethrough"><span>fa-strikethrough</span></i><i class="fa-stumbleupon"><span>fa-stumbleupon</span></i><i class="fa-stumbleupon-circle"><span>fa-stumbleupon-circle</span></i><i class="fa-subscript"><span>fa-subscript</span></i><i class="fa-subway"><span>fa-subway</span></i><i class="fa-suitcase"><span>fa-suitcase</span></i><i class="fa-sun-o"><span>fa-sun-o</span></i><i class="fa-superscript"><span>fa-superscript</span></i><i class="fa-support"><span>fa-support</span></i><i class="fa-table"><span>fa-table</span></i><i class="fa-tablet"><span>fa-tablet</span></i><i class="fa-tachometer"><span>fa-tachometer</span></i><i class="fa-tag"><span>fa-tag</span></i><i class="fa-tags"><span>fa-tags</span></i><i class="fa-tasks"><span>fa-tasks</span></i><i class="fa-taxi"><span>fa-taxi</span></i><i class="fa-television"><span>fa-television</span></i><i class="fa-tencent-weibo"><span>fa-tencent-weibo</span></i><i class="fa-terminal"><span>fa-terminal</span></i><i class="fa-text-height"><span>fa-text-height</span></i><i class="fa-text-width"><span>fa-text-width</span></i><i class="fa-th"><span>fa-th</span></i><i class="fa-th-large"><span>fa-th-large</span></i><i class="fa-th-list"><span>fa-th-list</span></i><i class="fa-thumb-tack"><span>fa-thumb-tack</span></i><i class="fa-thumbs-down"><span>fa-thumbs-down</span></i><i class="fa-thumbs-o-down"><span>fa-thumbs-o-down</span></i><i class="fa-thumbs-o-up"><span>fa-thumbs-o-up</span></i><i class="fa-thumbs-up"><span>fa-thumbs-up</span></i><i class="fa-ticket"><span>fa-ticket</span></i><i class="fa-times"><span>fa-times</span></i><i class="fa-times-circle"><span>fa-times-circle</span></i><i class="fa-times-circle-o"><span>fa-times-circle-o</span></i><i class="fa-tint"><span>fa-tint</span></i><i class="fa-toggle-down"><span>fa-toggle-down</span></i><i class="fa-toggle-left"><span>fa-toggle-left</span></i><i class="fa-toggle-off"><span>fa-toggle-off</span></i><i class="fa-toggle-on"><span>fa-toggle-on</span></i><i class="fa-toggle-right"><span>fa-toggle-right</span></i><i class="fa-toggle-up"><span>fa-toggle-up</span></i><i class="fa-trademark"><span>fa-trademark</span></i><i class="fa-train"><span>fa-train</span></i><i class="fa-transgender"><span>fa-transgender</span></i><i class="fa-transgender-alt"><span>fa-transgender-alt</span></i><i class="fa-trash"><span>fa-trash</span></i><i class="fa-trash-o"><span>fa-trash-o</span></i><i class="fa-tree"><span>fa-tree</span></i><i class="fa-trello"><span>fa-trello</span></i><i class="fa-tripadvisor"><span>fa-tripadvisor</span></i><i class="fa-trophy"><span>fa-trophy</span></i><i class="fa-truck"><span>fa-truck</span></i><i class="fa-try"><span>fa-try</span></i><i class="fa-tty"><span>fa-tty</span></i><i class="fa-tumblr"><span>fa-tumblr</span></i><i class="fa-tumblr-square"><span>fa-tumblr-square</span></i><i class="fa-turkish-lira"><span>fa-turkish-lira</span></i><i class="fa-tv"><span>fa-tv</span></i><i class="fa-twitch"><span>fa-twitch</span></i><i class="fa-twitter"><span>fa-twitter</span></i><i class="fa-twitter-square"><span>fa-twitter-square</span></i><i class="fa-umbrella"><span>fa-umbrella</span></i><i class="fa-underline"><span>fa-underline</span></i><i class="fa-undo"><span>fa-undo</span></i><i class="fa-university"><span>fa-university</span></i><i class="fa-unlink"><span>fa-unlink</span></i><i class="fa-unlock"><span>fa-unlock</span></i><i class="fa-unlock-alt"><span>fa-unlock-alt</span></i><i class="fa-unsorted"><span>fa-unsorted</span></i><i class="fa-upload"><span>fa-upload</span></i><i class="fa-usb"><span>fa-usb</span></i><i class="fa-usd"><span>fa-usd</span></i><i class="fa-user"><span>fa-user</span></i><i class="fa-user-md"><span>fa-user-md</span></i><i class="fa-user-plus"><span>fa-user-plus</span></i><i class="fa-user-secret"><span>fa-user-secret</span></i><i class="fa-user-times"><span>fa-user-times</span></i><i class="fa-users"><span>fa-users</span></i><i class="fa-venus"><span>fa-venus</span></i><i class="fa-venus-double"><span>fa-venus-double</span></i><i class="fa-venus-mars"><span>fa-venus-mars</span></i><i class="fa-viacoin"><span>fa-viacoin</span></i><i class="fa-video-camera"><span>fa-video-camera</span></i><i class="fa-vimeo"><span>fa-vimeo</span></i><i class="fa-vimeo-square"><span>fa-vimeo-square</span></i><i class="fa-vine"><span>fa-vine</span></i><i class="fa-vk"><span>fa-vk</span></i><i class="fa-volume-down"><span>fa-volume-down</span></i><i class="fa-volume-off"><span>fa-volume-off</span></i><i class="fa-volume-up"><span>fa-volume-up</span></i><i class="fa-warning"><span>fa-warning</span></i><i class="fa-wechat"><span>fa-wechat</span></i><i class="fa-weibo"><span>fa-weibo</span></i><i class="fa-weixin"><span>fa-weixin</span></i><i class="fa-whatsapp"><span>fa-whatsapp</span></i><i class="fa-wheelchair"><span>fa-wheelchair</span></i><i class="fa-wifi"><span>fa-wifi</span></i><i class="fa-wikipedia-w"><span>fa-wikipedia-w</span></i><i class="fa-windows"><span>fa-windows</span></i><i class="fa-won"><span>fa-won</span></i><i class="fa-wordpress"><span>fa-wordpress</span></i><i class="fa-wrench"><span>fa-wrench</span></i><i class="fa-xing"><span>fa-xing</span></i><i class="fa-xing-square"><span>fa-xing-square</span></i><i class="fa-y-combinator"><span>fa-y-combinator</span></i><i class="fa-y-combinator-square"><span>fa-y-combinator-square</span></i><i class="fa-yahoo"><span>fa-yahoo</span></i><i class="fa-yc"><span>fa-yc</span></i><i class="fa-yc-square"><span>fa-yc-square</span></i><i class="fa-yelp"><span>fa-yelp</span></i><i class="fa-yen"><span>fa-yen</span></i><i class="fa-youtube"><span>fa-youtube</span></i><i class="fa-youtube-play"><span>fa-youtube-play</span></i><i class="fa-youtube-square"><span>fa-youtube-square</span></i></div></div>';