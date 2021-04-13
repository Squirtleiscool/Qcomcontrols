// Widgetize Page with Sidebar Selection
window.addEventListener( 'DOMContentLoaded', function(){
   setTimeout(() => {
      if(jQuery('#customize_page_panel_new')[0]){ return; }
      //Append the Widgetizer html
      jQuery('.edit-post-header').prepend(params.content);
      var settigsWidth = jQuery('.edit-post-header__settings').innerWidth();
      jQuery('#customize_page_panel_new').css('right', settigsWidth);

      var editorHeight = jQuery('.editor-writing-flow').innerHeight();
      
      jQuery('.page_widgetized').height(editorHeight - 100);
      
      jQuery('#customize_page_bttn_new').on('click',function(){
         if(!jQuery(this).parent().hasClass('active_customize')){
            jQuery(this).parent().addClass('active_customize');	
         }else{
            jQuery(this).parent().removeClass('active_customize');	
         }
      });


      jQuery(".widgetize_btn").on('click',function() {

         nonce = jQuery("input#optimizer_widgetize_nonce").val();
   
         jQuery.post(
            params.ajaxURL, {
               'action': 'optimizer_widgetizer_new',
               'nonce' : nonce,
               'widgetize_pid': params.pid,
            },
            function(response) {
               console.log('Widgetzed Page!');
               location.reload();
            }
         );
      });
         
      jQuery(".unwidgetize_btn").on('click',function() {
         nonce = jQuery("input#optimizer_unwidgetize_nonce").val();
   
         jQuery.post(
            params.ajaxURL, {
               'action': 'optimizer_unwidgetizer_new',
               'nonce' : nonce,
               'widgetize_pid': params.pid,
            },
            function(response) {
               console.log('UnWidgetzed Page!');
               location.reload();
            }
         );
      });
      
      
      jQuery("#optimizer_widgetize_form").on('click',function() {
         jQuery('#choose_custom_sidebar').slideUp(300);
           //console.log('Button clicked.');
         nonce = jQuery("input#optimizer_pagemeta_nonce").val();
         
         var pagesidebar = jQuery('#optimizer_widgetize_sidebar').val();
         var pagesidebarpos = jQuery('.page_sidebar_position input:radio:checked').val();
           jQuery.post(
               params.ajaxURL, {
                   'action': 'optimizer_widgetize_page',
                   'nonce' : nonce,
               'postid': jQuery('#optimizer_widgetize_pageid').val(),
               'pagesidebar': pagesidebar,
               },
               function(response) {
               console.log('Page Meta Updated!');
               jQuery( "#optimizer_widgetize_redirect" ).trigger( "click" );
               }
           );
      });
   
      jQuery(".customize_page_panel_layout ul li").on('click',function() {
         //console.log('CLICKED: customize_page_panel_layout');
         const val = jQuery(this).attr('data-val');
         if(val !== 'default' && val !== 'full'){ return }
         const currentMeta = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' );
         const newMeta = { ...currentMeta, optimizer_post_layout: val };
         wp.data.dispatch( 'core/editor' ).editPost( { meta: newMeta } );
         jQuery(".customize_page_panel_layout ul li").removeClass('opti_layout_active');
         jQuery(this).addClass('opti_layout_active');
      });
      jQuery(".customize_page_panel_Widgetize h3").on('click',function() {
         //console.log('CLICKED: customize_page_panel_layout');
         jQuery(this).parent().toggleClass('customize_page_panel_Widgetize--show');
      });

   }, 1000);
} );
