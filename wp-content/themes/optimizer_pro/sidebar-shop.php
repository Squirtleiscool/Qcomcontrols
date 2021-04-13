<?php 
/**
 * The Sidebar for LayerFramework
 *
 * Stores the sidebar area of the template. loaded in other template files with get_sidebar();
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

	<?php $hide_sidebar = get_post_meta( $post->ID, 'hide_sidebar', true); if (empty($hide_sidebar )){ ?> 
           
        <!--SHOP SIDEBAR STARTS-->
        <?php if(!empty($optimizer['shop_sidebar_id'])){?>
            <?php $right_sidebar = get_post_meta(  $post->ID, 'sidebar', true); if (!empty($right_sidebar )){ ?>
                <?php if ( is_active_sidebar( get_post_meta( $post->ID, 'sidebar', true) ) ) : ?>
                    <div id="sidebar" class="woo_sidebar custom_sidebar <?php if(!empty($optimizer['hide_mob_rightsdbr'])){ echo 'hide_mob_rightsdbr';} ?>">
                        <div class="widgets">          
                                <?php dynamic_sidebar( get_post_meta( $post->ID, 'sidebar', true) ); ?>
                         </div>
                     </div>
                <?php endif; ?>
                
            <?php }else{ ?>
            
                <?php if ( is_active_sidebar( $optimizer['shop_sidebar_id'] ) ) : ?>
                    <div id="sidebar" class="woo_sidebar">
                        <div class="widgets">          
                                <?php dynamic_sidebar( $optimizer['shop_sidebar_id'] ); ?>
                         </div>
                     </div>
                <?php endif; ?>
            <?php } ?>
            
        <?php } ?>
         <!--SHOP SIDEBAR ENDS-->
         
    <?php }?> 
