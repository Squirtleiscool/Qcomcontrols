<?php 
/**
 * The SHARE THIS Function for LayerFramework
 *
 * Displays Next Previous Posts on single posts page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>
  
        <div id="ast_nextprev" class="navigation <?php if (empty($optimizer['post_nextprev_id'])){ echo 'hide_nextprev'; }?>">
        
			<span class="div_middle"><i class="fa fa-stop"></i></span> 
            
            <?php $prevPost = get_previous_post(false); if($prevPost) {?>
                <div class="nav-box ast-prev">
                <?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'thumbnail' );?>
                <?php previous_post_link('%link','<i class="fa fa-angle-left"></i>'.$prevthumbnail.''.__('Previous Post','optimizer').'<br><span>%title</span>', false); ?>
                  <div class="prev_cat_name">
                  <?php echo the_category(', ',$prevPost->ID);?>
                  </div>
                </div>
            <?php }?>
            <?php $nextPost = get_next_post(false); if($nextPost) { ?>
                <div class="nav-box ast-next">
                <?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'thumbnail' ); ?>
                <?php next_post_link('%link','<i class="fa fa-angle-right"></i>'.$nextthumbnail.''.__('Next Post','optimizer').'<br><span>%title</span>', false); ?>
                  <div class="next_cat_name">
                  <?php echo the_category(', ',$nextPost->ID);?>
                  </div>
                </div>
            <?php }?>
        </div>
                        