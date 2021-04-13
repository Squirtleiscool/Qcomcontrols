<?php 
/**
 * The Frontpage LOCATION MAP  for LayerFramework
 *
 * Displays The LOCATION MAP Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>


<!--Homepage MAP START-->
    <div class="centerfix">
        <div class="ast_map <?php if(!empty($optimizer['hide_mob_map'])){ echo 'mobile_hide_map';} ?>">
        <?php /* If homepage Display the Title */?>
        <?php if ( is_home() ) { ?>
            <div class="homeposts_title">
            	<?php if($optimizer['map_title_id']) { ?><h2 class="home_title"><span><?php echo do_shortcode($optimizer['map_title_id']); ?></span></h2><?php } ?>
                <?php if($optimizer['map_subtitle_id']) { ?><div class="home_subtitle"><?php echo do_shortcode($optimizer['map_subtitle_id']); ?></div><?php } ?> 
                    
                    <?php if($optimizer['map_title_id']) { ?>
						<?php get_template_part('template_parts/divider','icon'); ?>
                	<?php } ?>  
            </div>
        <?php }?>

        	<div id="asthemap"></div>
         </div>
     </div>
<!--Homepage MAP END-->