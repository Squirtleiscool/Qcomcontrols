<?php 
/**
 * The Front page CALL TO ACTION  for LayerFramework
 *
 * Displays The CALL TO ACTION Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<!--Call to Action START-->
    <div class="home_action cta_<?php echo $optimizer['cta_button_align'];?>">
        <div class="center">
        	
                <div class="home_action_left"><?php echo do_shortcode( $optimizer['call_textarea_id']); ?></div>
                <?php if($optimizer['call_text_id']){ ?>
                <div class="home_action_right">
                    <div class="home_action_button_wrap">
                        <div class="home_action_button <?php echo $optimizer['cta_button_style'];?>">
                        <a <?php if (!empty ($optimizer['call_url_id'])) { ?>href="<?php echo do_shortcode(esc_url($optimizer['call_url_id'])); ?>"<?php } ?>><?php echo do_shortcode($optimizer['call_text_id']); ?></a>
                        </div>
                    </div>
                </div>
                <?php } ?>

        </div>
    </div>
    <!--Call to Action END-->

