<?php 
/**
 * The Front page BLOCKS for LayerFramework
 *
 * Displays The BLOCKS on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<!--Blocks-->
<div class="midrow block_type<?php echo $optimizer['block_layout_id'];?> <?php if(!empty($optimizer['blocks_hover'])){?>blocks_hover<?php } ?> <?php if(!empty($optimizer['hide_mob_blocks'])){ echo 'mobile_hide_blocks';} ?>">
 <div class="center">
  <div class="midrow_wrap">       
        <div class="midrow_blocks">   
            <div class="midrow_blocks_wrap">
            
            <!--BLOCK1 START-->
            <?php if ((!empty ($optimizer['block1_text_id'])) || (!empty ($optimizer['block1_textarea_id']))  ) { ?>
    
            <div class="midrow_block axn_block1">
                <div class="mid_block_content">
     
                  <!--BLOCK1 IMAGE-->
                  <?php if(!empty($optimizer['block1_image']['url']) && empty($optimizer['block1_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block1_image']['url']; ?>" width="<?php echo $optimizer['block1_image']['width']; ?>" height="<?php echo $optimizer['block1_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block1_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block1_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
    
            <?php } ?>
            <!--BLOCK1 END-->
            
            <!--BLOCK2 START-->
            <?php if ((!empty ($optimizer['block2_text_id'])) || (!empty ($optimizer['block2_textarea_id']))  ) { ?>
            
            <div class="midrow_block axn_block2">
                <div class="mid_block_content">
     
                  <!--BLOCK2 IMAGE-->
                  <?php if(!empty($optimizer['block2_image']['url']) && empty($optimizer['block2_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block2_image']['url']; ?>" width="<?php echo $optimizer['block2_image']['width']; ?>" height="<?php echo $optimizer['block2_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block2_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block2_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
    
            <?php } ?>
            <!--BLOCK2 END-->
            
            <!--BLOCK3 START-->
            <?php if ((!empty ($optimizer['block3_text_id'])) || (!empty ($optimizer['block3_textarea_id']))  ) { ?>
            
            <div class="midrow_block axn_block3">
                <div class="mid_block_content">
     
                  <!--BLOCK3 IMAGE-->
                  <?php if(!empty($optimizer['block3_image']['url']) && empty($optimizer['block3_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block3_image']['url']; ?>" width="<?php echo $optimizer['block3_image']['width']; ?>" height="<?php echo $optimizer['block3_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block3_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block3_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
    
            <?php } ?>
            <!--BLOCK3 END-->
            
            <!--BLOCK4 START-->
            <?php if ((!empty ($optimizer['block4_text_id'])) || (!empty ($optimizer['block4_textarea_id']))  ) { ?>
            
            <div class="midrow_block axn_block4">
                <div class="mid_block_content">
     
                  <!--BLOCK4 IMAGE-->
                  <?php if(!empty($optimizer['block4_image']['url']) && empty($optimizer['block4_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block4_image']['url']; ?>" width="<?php echo $optimizer['block4_image']['width']; ?>" height="<?php echo $optimizer['block4_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block4_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block4_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
            <?php } ?>
            <!--BLOCK4 END-->
            
            
             
            <!--BLOCK5 START-->
            <?php if ((!empty ($optimizer['block5_text_id'])) || (!empty ($optimizer['block5_textarea_id']))  ) { ?>
            
            <div class="midrow_block axn_block5">
                <div class="mid_block_content">
     
                  <!--BLOCK5 IMAGE-->
                  <?php if(!empty($optimizer['block5_image']['url']) && empty($optimizer['block5_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block5_image']['url']; ?>" width="<?php echo $optimizer['block5_image']['width']; ?>" height="<?php echo $optimizer['block5_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block5_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block5_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
            <?php } ?>
            <!--BLOCK5 END-->       
            
            
            
            <!--BLOCK6 START-->
            <?php if ((!empty ($optimizer['block6_text_id'])) || (!empty ($optimizer['block6_textarea_id']))  ) { ?>
            
			<div class="midrow_block axn_block6">
                <div class="mid_block_content">
     
                  <!--BLOCK6 IMAGE-->
                  <?php if(!empty($optimizer['block6_image']['url']) && empty($optimizer['block6_img_bg'])){   ?>
                      <div class="block_img"><img src="<?php echo $optimizer['block6_image']['url']; ?>" width="<?php echo $optimizer['block6_image']['width']; ?>" height="<?php echo $optimizer['block6_image']['height']; ?>" /></div>
                  <?php } ?>
                  
                  <div class="block_content">
                      <h3>
                      <?php echo do_shortcode( $optimizer['block6_text_id']); ?>
                      </h3>
                      <?php echo do_shortcode($optimizer['block6_textarea_id']); ?>
                  </div>
                           
        
                </div>
            </div>
            <?php } ?>
            <!--BLOCK6 END--> 
            
    </div>
        </div>
                
        
    </div>
  </div>
</div>


<!--Blocks END-->

