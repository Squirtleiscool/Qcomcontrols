<?php 
/**
 * The SHARE THIS Function for LayerFramework
 *
 * Displays The social share icons on single posts page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<div class="share_this social_<?php echo $optimizer['share_button_style']; ?>"> 
   <div class="social_buttons">
            
    <span class="share_label"><?php echo $optimizer['share_label']; ?></span>

                <div class="lgn_fb">
                        <a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&amp;amp;t=<?php echo urlencode(the_title('','', false)); ?>" title="<?php _e('Share this on Facebook', 'optimizer');?>" rel="noopener" or rel="noreferrer"><i class="fa-facebook"></i></a>
                </div>

                <div class="lgn_twt">
                    <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink();?>&text=<?php $escapett = get_the_title(); $twtt = rawurlencode($escapett); echo $twtt;?>" title="<?php _e('Tweet This', 'optimizer'); ?>" rel="noopener" or rel="noreferrer"><i class="fa-twitter"></i></a>
                </div>

                <div class="lgn_pin">
                    <a target="_blank" title="<?php _e('Pin This', 'optimizer'); ?>" onclick="javascript:void( (function() {var e=document.createElement('script' );e.setAttribute('type','text/javascript' );e.setAttribute('charset','UTF-8' );e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" rel="noopener" or rel="noreferrer"><i class="fa-pinterest"></i></a>
                </div>

                <div class="lgn_linkedin">
                    <a target="_blank" title="<?php _e('Share this on Linkedin', 'optimizer');?>" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php echo urlencode(the_title('','', false)) ?>" rel="noopener" or rel="noreferrer"><i class="fa-linkedin"></i></a>
                </div>

                <div class="lgn_stmbl">
                     <a target="_blank" title="<?php _e('Stumble This', 'optimizer'); ?>" href="https://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>" rel="noopener" or rel="noreferrer"><i class="fa fa-stumbleupon"></i></a>
                </div>

                <div class="lgn_digg">
                    <a target="_blank" href="https://www.digg.com/submit?url=<?php the_permalink() ?>&amp;amp;title=<?php echo urlencode(the_title('','', false)) ?>" title="<?php _e('Digg This', 'optimizer'); ?>" rel="noopener" or rel="noreferrer"><i class="fa fa-digg"></i></a>
                </div>

                <div class="lgn_email">
                    <a onclick="window.location.href='mailto:?subject='+document.title+'&body='+escape(window.location.href);" title="<?php _e('Email This', 'optimizer'); ?>"><i class="fa fa-envelope-o"></i></a>
                </div> 

                <div class="lgn_print">
                    <a onclick="window.print();" title="<?php _e('Print This Page', 'optimizer'); ?>"><i class="fa fa-print"></i></a>
                </div>    
                
                <?php do_action('optimizer_after_share_buttons'); ?>

  </div>           
</div>