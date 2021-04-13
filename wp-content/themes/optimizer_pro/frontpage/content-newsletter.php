<?php 
/**
 * The Frontpage NEWSLETTER SUBSCRIPTION for LayerFramework
 *
 * Displays The NEWSLETTER SUBSCRIPTION Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>


<!--Homepage Newsletter START-->
    <div class="centerfix">
        <div class="ast_newsletter <?php if(!empty($optimizer['hide_mob_newsletter'])){ echo 'mobile_hide_newsletter';} ?>">
        <?php /* If homepage Display the Title */?>
        <?php if ( is_home() ) { ?>
            <div class="homeposts_title">
            <?php if($optimizer['newsletter_title_id']) { ?><h2 class="home_title"><span><?php echo do_shortcode($optimizer['newsletter_title_id']); ?></span></h2><?php } ?>
            <?php if($optimizer['newsletter_subtitle_id']) { ?><div class="home_subtitle"><?php echo do_shortcode($optimizer['newsletter_subtitle_id']); ?></div><?php } ?> 
                    
                    <?php if($optimizer['newsletter_title_id']) { ?>
						<?php get_template_part('template_parts/divider','icon'); ?>
                	<?php } ?>  
            </div>
            
            <div class="ast_subs_form">
                <div class="center">
                	<?php echo do_shortcode($optimizer['newsletter_form_id']); ?>
                </div>
            </div>
        <?php }?>
         </div>
     </div>

<!--Homepage Newsletter END-->