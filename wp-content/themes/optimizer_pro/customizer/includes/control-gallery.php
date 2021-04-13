<?php
class Optimizer_Controls_Gallery_Control extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     */
    public $type = 'gallery';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content() {
	$id = str_replace( '[', '-', str_replace( ']', '', $this->id ) );
    ?>
        
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            	
                <div id="<?php echo $id; ?>_preview" class="control_gallery_preview">
				<?php 
				$value = $this->value();
				if(!empty($value)){
						$sliderimgs = $value;
						$args = array(
							'post_type' => 'attachment',
							'post__in' => explode(',', $sliderimgs), 
							'posts_per_page' => 99,
							'order' => 'menu_order ID',
							'orderby' => 'post__in',
							);
						$attachments = get_posts( $args );
								
						foreach ( $attachments as $attachment ) {
								   
							$imgsrc = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
							echo '<img  class="gallery_preview_thumb" src="'.$imgsrc[0].'" />';
				
						 }
				}else{
				
					echo '<span class="gallery_empty">'.__('No Images Added','optimizer').'</span>';	
				}
				
				?>
                </div>
        <label>        
			<button type="button" class="button upload-button control_gallery_clear" id="<?php echo $id; ?>_clear"><?php _e('Clear', 'optimizer');?></button>
            <button type="button" class="button upload-button" id="<?php echo $id; ?>_add_slides"><?php _e('Add Slides', 'optimizer');?></button>
            <input <?php $this->link(); ?> type="hidden" id="<?php echo $id; ?>" value="<?php $this->value(); ?>" />
        </label>
        <script type="text/javascript">
			jQuery(function($) {
				 var custom_uploader;
				 $("#<?php echo $id; ?>_add_slides").click(function(e) {
					e.preventDefault();
			
					//If the uploader object has already been created, reopen the dialog
					if (custom_uploader) {
						custom_uploader.open();
						return;
					}
					
					var val = $('#<?php echo $id; ?>').val();
					if ( !val ) {
						final = '[gallery ids="0"]';
					} else {
						final = '[gallery ids="' + val + '"]';
					}

					var custom_uploader = wp.media.gallery.edit( final );
/*					var custom_uploader = wp.media({
								id:         'slider-window',                
								frame:      'post',
								state:      'gallery-edit',
								title:      wp.media.view.l10n.editGalleryTitle,
								editing:    true,
								multiple:   true,
					});
			*/
					
					custom_uploader.on('update', function( selection ) {
						
						$('#<?php echo $id; ?>_preview .gallery_preview_thumb').hide();
						//var numberlist = []; 

							//console.log(selection.models);
							var ids = selection.models.map(
								function( e ) {
									element = e.toJSON();
									preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
									preview_html = "<img class='gallery_preview_thumb' src=" +preview_img+">";
									$( '#<?php echo $id; ?>_preview' ).append( preview_html );
									$( '#<?php echo $id; ?>_preview .gallery_empty' ).hide();
									return e.id;
								}
							);
							
							//Insert Attachment ids in the Input field and Refresh the Customizer
							var control_key = $('#<?php echo $id; ?>').data('customize-setting-link');
							var currentval = $('#<?php echo $id; ?>').val();
							var updatedval = ids.join(",");
							
							if(currentval == updatedval){
								wp.customize(control_key, function(obj) {
									obj.set(ids.join(", "));
								} );
							}else{
								wp.customize(control_key, function(obj) {
									obj.set(ids.join(","));
								} );	
							}


						});

					//Open the uploader dialog
					if(jQuery(this).attr('id') == 'nivo_accord_slider_add_slides'){
						custom_uploader.open( jQuery('#'+custom_uploader.el.id).addClass('gallery-window'));
					}else{
						custom_uploader.open( jQuery('#'+custom_uploader.el.id).addClass('gall-window'));
					}
			
				});
						$(document).on("click", "#<?php echo $id; ?>_trigger", function(e) {
							console.log('Gallery Clicked!');
                            $('#<?php echo $id; ?>').trigger( 'change' );
                        });
				
				//Clear the Images
				$('#<?php echo $id; ?>_clear').click(function(e) {
					e.preventDefault();
					//Insert Attachment ids in the Input field and Refresh the Customizer
					var control_key = $('#<?php echo $id; ?>').data('customize-setting-link');
						wp.customize(control_key, function(obj) {
							obj.set('');
					} );
					//remove the preview
					$('#<?php echo $id; ?>_preview .gallery_preview_thumb').remove();
					$( '#<?php echo $id; ?>_preview .gallery_empty' ).show();
				});

			});
        </script>
        <style type="text/css">
		
		
		.gall-window .collection-settings.gallery-settings, .gallery-window .collection-settings.gallery-settings{ display:none;} /*Hides The Gallery Settings*/
		
		.gallery-window .attachments-browser .media-toolbar{right: 400px;}
		.gallery-window .attachments-browser .attachments{right: 380px;}
		.gallery-window .media-sidebar{  width: 367px;}
		
		.gallery-window li.attachment input.describe{display: none!important;}
		.gallery-window .attachment-info .details{ float:none;}
		/*Change Field Names*/
		.gallery-window [data-setting="url"]{ display:none;} 
		.gallery-window [data-setting="caption"] .name, .gallery-window [data-setting="alt"] .name, .gallery-window [data-setting="description"] .name{ color:#f3f3f3!important;}
		.gallery-window .attachment-details .setting input[type=text], .gallery-window .attachment-details .setting textarea{ width:99%;}
		.gallery-window .media-sidebar .setting .name { max-width: none; width: 100%; font-size: 14px;  font-weight: bold;  text-align: left;}
		
		.gallery-window [data-setting="caption"] .name:after{content:"<?php _e('Description','optimizer'); ?>"; margin-top:-20px; color:#666; display: block;}
		.gallery-window [data-setting="alt"] .name:after{content:"<?php _e('Button Text','optimizer'); ?>"; margin-top:-20px; color:#666; display: block;}
		.gallery-window [data-setting="description"] .name:after{content:"<?php _e('Button Link','optimizer'); ?>"; margin-top:-20px; color:#666; display: block;}
		.gallery-window [data-setting="description"] textarea{ height:30px;}
		
		.gallery-window .media-frame-title h1 { width: 0px; overflow: hidden; color: transparent;}
		.gallery-window .media-frame-title h1:before {  content: "<?php _e('Slider Settings','optimizer'); ?>";  color: #333;  width: 170px;  position: absolute;}
		.gallery-window .media-frame:not(.hide-menu) .media-frame-title .dashicons {  color: #21759b;  position: absolute;top: 4px; left: 125px;}
		/* .gallery-window .media-frame-menu .media-menu-item, .gallery-window .media-frame-menu .media-menu-item.active, .gallery-window .media-frame-menu .media-menu-item:hover { color: transparent!important;} */
		/* .gallery-window .media-frame-menu .media-menu a.active {background-color: #E7E7ED;}
		.gallery-window .media-frame-menu .media-menu a:nth-child(1):before { content: "<?php _e('< Cancel Slider','optimizer'); ?>"; color: #888; width: 120px;}
		.gallery-window .media-frame-menu .media-menu a:nth-child(3):before { content: "<?php _e('Edit Slider','optimizer'); ?>"; color: #888; width: 120px;}
		.gallery-window .media-frame-menu .media-menu a:nth-child(4):before { content: "<?php _e('Add to Slider','optimizer'); ?>"; color: #888; width: 120px;} */
		/* .gallery-window .media-button-insert{  text-indent: -9999px;  line-height: 0; overflow: hidden;} */
		/* .gallery-window .media-button-insert:before { content: "<?php _e('Update','optimizer'); ?>";  text-indent: 0; line-height: 27px; display: block;} */
        </style>
    <?php }
}


