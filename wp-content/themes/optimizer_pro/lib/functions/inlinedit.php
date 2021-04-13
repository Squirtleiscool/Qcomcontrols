<?php
/**
 * The inline Editor for Optimizer
 *
 * Loads the inline Editor in Customize Mode
 *
 * @package Optimizer
 * 
 * @since Optimizer 0.4.4
 */
 
//First Clear the Basic Editor Settings for inline Editor
if ( !is_admin() && is_customize_preview() ) {

    add_filter('the_editor', 'optimizer_remove_editor_settings');
    function optimizer_remove_editor_settings(){
        $editor = '';
        return $editor;
    }

}
 
function optimizer_render_inlineditor(){
	global $optimizer;
	if(!empty($optimizer['inline_editor'])){
		if(is_customize_preview()){
			wp_editor( '', '', array(
				'textarea_rows' => '',
				'quicktags'     => false,
				'teeny'     => false,
				'media_buttons' => true,
				'tinymce'       => array(
					'selector'         => '.tiny_content_editable',
					'content_css'      => false,
					'inline'           => true,
					'toolbar1'=> 'bold italic underline forecolor link bullist alignleft aligncenter alignright shorty undo redo fullmode',
					'toolbar2'=> ' formatselect fontselect fontsizeselect removeformat optimedia save canceledit',
					'save_enablewhendirty'=> true,
					'save_onsavecallback'=> 'function () { 
														var widgetid = tinymce.activeEditor.getBody().id; 
														var widgetid = jQuery("#"+widgetid).attr("data-optionid"); 
														
														var gettinycontent = tinyMCE.activeEditor.getContent(); 
														
														
														var tree = jQuery("<div>" + tinyMCE.activeEditor.getContent() + "</div>"); 
														
														//console.log(tree[0].innerHTML); 
														
														
														//Only Carry on if the content doesnt have any shortcodes
														if (tree.find(".blockshortcode").length){
															error("Your Content contains Shortcode(s). Contents with Shortcodes can be only edited with the Full Editor.");
														}else{
															//Re-encode the Columns Shortcode
															tree.find(".shortcol.col2.inline_shortcode").each(function(index, element) {   jQuery(this).attr(\'data-shortcode\', \'[col2 width="\'+jQuery(this).attr( \'data-width\' )+\'"]\'+jQuery(this).html()+\'[/col2]\'); 	 	});
															tree.find(".shortcol.col3.inline_shortcode").each(function(index, element) {   jQuery(this).attr(\'data-shortcode\', \'[col3 width="\'+jQuery(this).attr( \'data-width\' )+\'"]\'+jQuery(this).html()+\'[/col3]\'); 	 	});
															tree.find(".shortcol.col4.inline_shortcode").each(function(index, element) {   jQuery(this).attr(\'data-shortcode\', \'[col4 width="\'+jQuery(this).attr( \'data-width\' )+\'"]\'+jQuery(this).html()+\'[/col4]\'); 	 	});
															tree.find(".col2").each(function(index, element) {   if(jQuery(this).parent().is(".col2wrap")){ jQuery(this).unwrap(); }  });
															tree.find(".col3").each(function(index, element) {   if(jQuery(this).parent().is(".col3wrap")){ jQuery(this).unwrap(); }  });
															tree.find(".col4").each(function(index, element) {   if(jQuery(this).parent().is(".col4wrap")){ jQuery(this).unwrap(); }  });
															tree.find(".colclear").remove();
															
															
															//First Re-encode the Button Shortcode
															tree.find(".inline_shortcode").each(function(index, element) {    jQuery(this).replaceWith(jQuery(this).attr("data-shortcode")); 	});
															
															
															var thecontent = tree.html();
															var content = [widgetid, thecontent ]; 
															wp.customize.preview.send( "tinycontent", content ); }
														}',
														
														
					
					'setup'=>'function(ed) {  ed.on("init", function () {  ed.init_content = ed.getContent(); });  }',
				),
			) );
		}
	
	}//If inline Editor Enabled---- <Close>
}
add_action( 'optimizer_after_footer', 'optimizer_render_inlineditor' );


/*ADD Button and Colunn Editor*/
function optimizer_inline_shortcode_editor() {
		?>
        <?php if(is_customize_preview()){ ?>
        
            <div id="inline_button_editor" class="shortcodeditor" style="display:none;">
            	<p><label><?php _e('Button Text', 'optimizer') ?></label><input id="inline_button_text" type="text" value="" placeholder="" /></p>
            	<p><label><?php _e('Button Link', 'optimizer') ?></label><input id="inline_button_link" type="text" value="" placeholder="" /></p>
                <p>
                    <label><?php _e('Button Style', 'optimizer') ?></label>
                    <select id="inline_button_style">
                        <option value="lt_flat" selected="selected"><?php _e('Square (Flat)','optimizer') ?></option>
                        <option value="lt_hollow"><?php _e('Square (Hollow)', 'optimizer') ?></option>
                        <option value="lt_circular"><?php _e('Circular (Flat)', 'optimizer') ?></option>
                        <option value="lt_circular lt_hollow"><?php _e('Circular (Hollow)', 'optimizer') ?></option>
                    </select>
                </p>
                <p>
                    <label><?php _e('Button Size', 'optimizer') ?></label>
                    <select id="inline_button_size">
                        <option value="default" selected="selected"><?php _e('Default','optimizer') ?></option>
                        <option value="small"><?php _e('Small', 'optimizer') ?></option>
                        <option value="large"><?php _e('Large', 'optimizer') ?></option>
                    </select>
                </p>
            	<p><label><?php _e('Background', 'optimizer') ?></label><input id="inline_button_bg" type="text" value="" placeholder="" class="short_colpick" /></p>
            	<p><label><?php _e('Text Color', 'optimizer') ?></label><input id="inline_button_color" type="text" value="" placeholder="" class="short_colpick" /></p>
                <p><label style="width:150px;"><?php _e('Open in New Window', 'optimizer') ?></label><input id="inline_button_window" type="checkbox" value="1"></p>
                <p><label style="width:150px;"><?php _e('Rounded Corner', 'optimizer') ?></label><input id="inline_button_rounded" type="checkbox" value="1" checked></p>
                <p><label style="width:150px;"><?php _e('Align to Center', 'optimizer') ?></label><input id="inline_button_center" type="checkbox" value=""></p>
                <p><button id="btn_shortcode_cancel"><?php _e('Cancel', 'optimizer') ?></button> <button id="btn_shortcode_update"><?php _e('Update', 'optimizer') ?></button></p>
            </div>
            
            
            
            <div id="inline_col2_editor" class="shortcodeditor coleditor" style="display:none">
            	<div id="col2_opt1" class="col_opts"></div><div id="col2_opt2" class="col_opts"></div><div id="col2_opt3" class="col_opts"></div>
                <div id="col2_remove" title="<?php _e('Remove Columns', 'optimizer') ?>"><i class="fa fa-trash "></i></div>
            </div>
            
            <div id="inline_col3_editor" class="shortcodeditor coleditor" style="display:none">
            	<div id="col3_opt1" class="col_opts"></div><div id="col3_opt2" class="col_opts"></div><div id="col3_opt3" class="col_opts"></div><div id="col3_opt4" class="col_opts"></div>
                <div id="col3_opt5" class="col_opts"></div><div id="col3_opt6" class="col_opts"></div><div id="col3_opt7" class="col_opts"></div>
                <div id="col3_remove" title="<?php _e('Remove Columns', 'optimizer') ?>"><i class="fa fa-trash "></i></div>
            </div>
            
            <div id="inline_col4_editor" class="shortcodeditor coleditor" style="display:none">
            	<div id="col4_opt1" class="col_opts"></div><div id="col4_opt2" class="col_opts"></div><div id="col4_opt3" class="col_opts"></div><div id="col4_opt4" class="col_opts"></div><div id="col4_opt5" class="col_opts"></div>
                <div id="col4_remove" title="<?php _e('Remove Columns', 'optimizer') ?>"><i class="fa fa-trash "></i></div>
            </div>

            
		<?php } ?>
		<?php
		
	} // END output_wp_editor_widget_html*/
	
add_action( 'wp_footer', 'optimizer_inline_shortcode_editor' );