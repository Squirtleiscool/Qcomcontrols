<?php
/*IMPORTANT: get_post_meta is used instead of wp-alchemy $meta through-out this file because of redux conversion.*/ 
$optimizer = optimizer_option_defaults();
$widgetized = get_post_meta( $post->ID, 'widgetized', true );
$screen = get_current_screen(); 
?>
<div id="metatabs-container">
        <ul class="meta_nav">
        	<?php  
			if ( $screen->parent_base == 'edit' && $screen->id == 'page' ){ ?>
			   <li class="tabcurrent"><a href="#meta_pageheader"><?php _e('Custom Page Header', 'optimizer'); ?></a></li>
         <?php } ?>
			<li<?php if( $screen->parent_base == 'edit' && $screen->id == 'post' ){ ?> class="tabcurrent"<?php } ?>><a href="#meta_singlebg"><?php _e('Custom Background', 'optimizer'); ?></a></li>
			<li><a href="#meta_seo"><?php _e('SEO Settings', 'optimizer'); ?></a></li>
         <li><a href="#meta_misc"><?php _e('Miscellaneous', 'optimizer'); ?></a></li>
         <?php if ( $widgetized && ( $screen->parent_base == 'edit' && $screen->id == 'page') ){ ?>
			   <li><a href="#widget_content_meta"><?php _e('Widget Content', 'optimizer'); ?></a></li>
         <?php } ?>
        </ul>


        <div class="tabs">
        	 	<?php if( $screen->parent_base == 'edit' && $screen->id == 'page' ){ ?>
                
                <?php ?>
                    <div class="optimizer_meta_control <?php if($optimizer['pageheader_widgetized'] === ''){ echo 'force_phead_off'; }else{  echo 'force_phead_on'; } ?>" id="meta_pageheader">
                     
                        <h4><?php _e('Custom Page Header', 'optimizer'); ?></h4>

						<?php if($optimizer['pageheader_widgetized'] === ''){ ?>
                            <div class="page_header_notice" style="display: flex;">
                            <?php /* var_dump( $optimizer );*/ ?>
                                <p><?php _e('Page Header is disabled for Widgetzied Pages. To enable it go to Appearance > Customize > Post &amp; Page and Enable the "Display Page Headers in Widgetized Pages" option.', 'optimizer'); ?></p>
                            </div>
                        <?php } ?>
                        
                        
                        <p class="page_header_child">
                            <label><?php _e( 'Hide Page Header', 'optimizer' ); ?></label>
                            <?php $mb->the_field('show_page_header'); ?>
                            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                        </p>
                        
                            <div class="page_header_child" style="display: flex;">
                                    <label><?php _e('Custom Header Image', 'optimizer') ?></label>
                                    
                                    <?php $mb->the_field('page_head'); ?>
                                    <?php $headimg = get_post_meta( $post->ID, 'page_head', true ); ?>
                                    
                                    <div class="media-picker-wrap">
                                    <?php if(!empty($headimg['url'])) { ?>
                                        <img style="max-width:300px; height:auto;" class="media-picker-preview" src="<?php if(!empty($headimg['url'])) echo$headimg['url']; ?>" />
                                        <i class="fa fa-times media-picker-remove"></i>
                                    <?php } ?><br>
            
                                    <input class="media-picker" type="hidden" name="<?php $metabox->the_id(); ?>[page_head][url]" value="<?php if(!empty($headimg['url'])) echo $headimg['url']; ?>" id="<?php $mb->the_id( ); ?>_page_head"/>
                                    <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php $mb->the_id( ); ?>_page_head_mpick"><?php _e('Select Image', 'optimizer') ?></a>
                                    </div>
                            </div>
                        
                        
                        
                        <p class="page_header_child">
                            <label><?php _e( 'Header Background Color', 'optimizer' ); ?></label>
                            <?php $mb->the_field('page_header_bg'); ?>
                            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="color-picker" />
                        </p>
                        
                        <p class="page_header_child">
                            <label><?php _e( 'Header Text Color', 'optimizer' ); ?></label>
                            <?php $mb->the_field('page_header_txt'); ?>
                            <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="color-picker" />
                        </p>
                     
                        <p class="page_header_child">
                            <label><?php _e( 'Page Header Text Alignment', 'optimizer' ); ?></label>
                            <?php $mb->the_field('page_head_align'); ?>
                            <select name="<?php $mb->the_name(); ?>">
                                 <option value=""<?php if ($mb->get_the_value() == '') echo ' selected="selected"'; ?>><?php _e('Default', 'optimizer'); ?></option>
                                <option value="left"<?php if ($mb->get_the_value() == 'left') echo ' selected="selected"'; ?>><?php _e('Left', 'optimizer'); ?></option>
                                <option value="right"<?php if ($mb->get_the_value() == 'right') echo ' selected="selected"'; ?>><?php _e('Right', 'optimizer'); ?></option>
                                <option value="center"<?php if ($mb->get_the_value() == 'center') echo ' selected="selected"'; ?>><?php _e('Center', 'optimizer'); ?></option>
                                <option value="middle"<?php if ($mb->get_the_value() == 'middle') echo ' selected="selected"'; ?>><?php _e('Center Middle', 'optimizer'); ?></option>
                            </select>
                        </p>
                            
                     
                        <p class="page_header_child">
                            <label><?php _e( 'Hide Page Title', 'optimizer' ); ?></label>
                            <?php $mb->the_field('hide_page_title'); ?>
                            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                        </p>
                        
                        <p>
                            <label><?php _e( 'Make Header Transparent', 'optimizer' ); ?></label>
                            <?php $mb->the_field('page_header_transparent'); ?>
                            <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                        </p>
                    
                    </div>
                <?php } ?>
        
        
                <div class="optimizer_meta_control" id="meta_singlebg" <?php if( $screen->parent_base == 'edit' && $screen->id == 'post' ){ ?>style="display:block;"<?php } ?>>
                 
                    <h4><?php _e('Custom Background', 'optimizer'); ?></h4>
                
                    
                    <div>
                        <?php $mb->the_field('single_bg'); ?>
                        <label><?php _e('Background Color', 'optimizer') ?></label>
                        <input type="text" name="<?php $metabox->the_id(); ?>[single_bg][background-color]" value="<?php if(!empty($meta['single_bg']['background-color'])) echo $meta['single_bg']['background-color']; ?>" class="color-picker" />
                        
                        <div style="display: flex; margin-bottom: 20px;">
                                <label><?php _e('Background Image', 'optimizer') ?></label>
                                <div class="media-picker-wrap">
                                <?php if(!empty($meta['single_bg']['background-image'])) { ?>
                                    <img style="max-width:300px; height:auto;" class="media-picker-preview" src="<?php if(!empty($meta['single_bg']['background-image'])) echo $meta['single_bg']['background-image']; ?>" />
                                    <i class="fa fa-times media-picker-remove"></i>
                                <?php } ?><br>
        
                                <input class="media-picker" type="hidden" name="<?php $metabox->the_id(); ?>[single_bg][background-image]" value="<?php if(!empty($meta['single_bg']['background-image'])) echo $meta['single_bg']['background-image']; ?>" id="<?php $mb->the_id( ); ?>single_bg"/>
                                <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php $mb->the_id( ); ?>_single_bg_mpick"><?php _e('Select Image', 'optimizer') ?></a>
                                </div>
                        </div>
                        
                       <label><?php _e('Background Image Repeat', 'optimizer') ?></label>
                        <select name="<?php $metabox->the_id(); ?>[single_bg][background-repeat]">
                        	<?php $singlebg = get_post_meta( $post->ID, 'single_bg', true ); ?>
                            
                            <option value="no-repeat"<?php if ($singlebg) if ($singlebg['background-repeat'] == 'no-repeat') echo ' selected="selected"'; ?>><?php _e('No Repeat', 'optimizer'); ?></option>
                            <option value="repeat"<?php if ($singlebg) if ($singlebg['background-repeat'] == 'repeat') echo ' selected="selected"'; ?> ><?php _e('Repeat', 'optimizer'); ?></option>
                        </select>
                        
                       <label><?php _e('Background Image Position', 'optimizer') ?></label>
                        <select name="<?php $metabox->the_id(); ?>[single_bg][background-attachment]">
                            <option value="scroll"<?php if ($singlebg) if ($singlebg['background-attachment'] == 'scroll') echo ' selected="selected"'; ?>><?php _e('Scroll', 'optimizer'); ?></option>
                            <option value="fixed"<?php if ($singlebg) if ($singlebg['background-attachment'] == 'fixed') echo ' selected="selected"'; ?>><?php _e('Fixed', 'optimizer'); ?></option>
                        </select>
                
                    </div>
                 
                
                
                </div>
        
        
        
        
                <div class="optimizer_meta_control" id="meta_seo">
                 
                    <h4><?php _e('SEO Options', 'optimizer'); ?></h4>
                 
                
                    <p>
                        <label><?php _e( 'Meta Title', 'optimizer' ); ?></label>
                        <?php $mb->the_field('seo_title'); ?>
                        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                        <span><?php _e( 'Limit: 55 characters', 'optimizer' ); ?></span>
                    </p>
                 
                 
                    <p>
                        <label><?php _e( 'Meta Description', 'optimizer' ); ?></label>
                        <?php $mb->the_field('seo_description'); ?>
                        <textarea name="<?php $mb->the_name(); ?>" rows="3"><?php $mb->the_value(); ?></textarea>
                        <span><?php _e( 'Limit: 115 characters', 'optimizer' ); ?></span>
                    </p>
                
                </div>
                
                
				<div class="optimizer_meta_control" id="meta_misc">
                 
                    <h4><?php _e('Miscellaneous Settings', 'optimizer'); ?></h4>
                 
                 
                 <?php if( $screen->parent_base == 'edit' && $screen->id == 'page' ){ ?>
                 
                    <p>
                     <label><?php _e( 'Hide Header', 'optimizer' ); ?></label>
                     <?php $mb->the_field('hide_header'); ?>
                     <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                     <span><?php _e( 'Force Hide Header for this page', 'optimizer' ); ?></span>
                    </p>
                    <p>
                     <label><?php _e( 'Hide Header Menu', 'optimizer' ); ?></label>
                     <?php $mb->the_field('hide_header_menu'); ?>
                     <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                     <span><?php _e( 'Force Hide Header Menu for this page', 'optimizer' ); ?></span>
                    </p>
                 <?php } ?>
                
                    <p>
                     <label><?php _e( 'Hide Share Buttons', 'optimizer' ); ?></label>
                     <?php $mb->the_field('hide_share'); ?>
                     <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
                     <span><?php _e( 'Force Hide Share buttons for this post', 'optimizer' ); ?></span>
                    </p>
                 
                    <p>
                        <label><?php _e( 'Custom CSS Body Classes', 'optimizer' ); ?></label>
                        <?php $mb->the_field('custom_classes'); ?>
                        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder=" class1, class2, class3" />
                        <span><?php _e( 'Limit: 55 characters', 'optimizer' ); ?></span>
                    </p>
                </div>


         <?php if( $screen->parent_base == 'edit' && $screen->id == 'page' ){ ?>
               <?php if($widgetized){  ?>
                  <div class="optimizer_meta_control" id="widget_content_meta">
                     <h4><?php _e('Optimizer Widget Content', 'optimizer'); ?></h4>
                     <p><?php _e('This is a text representation of your Widgetized Page. The widget text content is displyed here so you can have quick view of your page content. If you are using Yoast SEO or RankMath, focus keyword is automatically highlighted.', 'optimizer'); ?></p>
                     <div id="widget_content_meta_html"></div>
                  </div>
               <?php } ?>
         <?php } ?>    


        </div>



</div><!--metatabs_container END-->