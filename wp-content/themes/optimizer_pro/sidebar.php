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

<?php do_action('optimizer_before_sidebar'); ?>
<?php if(!empty($optimizer['hide_mob_rightsdbr'])){ $mobsidebar = 'hide_mob_rightsdbr';}else{ $mobsidebar = ''; } ?>
    <!--HOME SIDEBAR STARTS--> 
    <?php if(is_home()){?>

            <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                <div id="sidebar" class="home_sidebar <?php echo $mobsidebar; ?>" <?php optimizer_schema_item_type('sidebar'); ?>>
                    <div class="widgets">  
                            <?php dynamic_sidebar( 'sidebar' ); ?>
                     </div>
                 </div>
            <?php endif; ?>

    <?php } ?>
    <!--HOME SIDEBAR ENDS-->
            
    <!--PAGE SIDEBAR STARTS-->
    <?php if(is_page()){?>
		<?php $right_sidebar = get_post_meta( $post->ID, 'sidebar', true); 
		if (!empty($right_sidebar )){ ?>
					<?php if ( is_active_sidebar( get_post_meta( $post->ID, 'sidebar', true) ) ) : ?>
                        <div id="sidebar" class="page_sidebar custom_sidebar <?php echo $mobsidebar; ?>" <?php optimizer_schema_item_type('sidebar'); ?>>
                            <div class="widgets">          
                                    <?php dynamic_sidebar( get_post_meta( $post->ID, 'sidebar', true) ); ?>
                             </div>
                         </div>
                    <?php endif; ?>
        <?php }else{ ?>
					<?php if(optimizer_is_woocommerce_page()) { //If Wooceommerce Pages Show different Sidebar  ?>
                          <div id="sidebar" class="page_sidebar woo_sidebar" <?php echo $mobsidebar; ?> <?php optimizer_schema_item_type('sidebar'); ?>>
                              <div class="widgets">          
                                      <?php dynamic_sidebar( $optimizer['shop_sidebar_id'] ); ?>
                               </div>
                           </div> 
                    <?php }else{ //Else show default page sidebar ?>
                        <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                            <div id="sidebar" class="page_sidebar" <?php echo $mobsidebar; ?> <?php optimizer_schema_item_type('sidebar'); ?>>
                                <div class="widgets">          
                                        <?php dynamic_sidebar( 'sidebar' ); ?>
                                 </div>
                             </div> 
                        <?php endif; ?>
                    <?php } ?> 
        <?php } //get_post_meta() END ?>
    <?php } //is_page() END ?>
     <!--PAGE SIDEBAR ENDS-->
     
    <!--SINGLE SIDEBAR STARTS-->
    <?php if(is_single() || is_archive() || is_search()){?>
		<?php $right_sidebar = get_post_meta( $post->ID, 'sidebar', true); if (!empty($right_sidebar )){ ?>
			<?php if ( is_active_sidebar( get_post_meta( $post->ID, 'sidebar', true) ) ) : ?>
                <div id="sidebar" class="single_sidebar custom_sidebar <?php echo $mobsidebar; ?>" <?php optimizer_schema_item_type('sidebar'); ?>>
                    <div class="widgets">          
                            <?php dynamic_sidebar( get_post_meta( $post->ID, 'sidebar', true) ); ?>
                     </div>
                 </div>
            <?php endif; ?>
    <?php }else{ ?>
					<?php if(optimizer_is_woocommerce_page()) { //If Wooceommerce Pages Show different Sidebar  ?>
                          <div id="sidebar" class="page_sidebar woo_sidebar" <?php echo $mobsidebar; ?> <?php optimizer_schema_item_type('sidebar'); ?>>
                              <div class="widgets">          
                                      <?php dynamic_sidebar( $optimizer['shop_sidebar_id'] ); ?>
                               </div>
                           </div> 
                    <?php }else{ //Else show default page sidebar ?>
                        <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                            <div id="sidebar" class="page_sidebar" <?php echo $mobsidebar; ?> <?php optimizer_schema_item_type('sidebar'); ?>>
                                <div class="widgets">          
                                        <?php dynamic_sidebar( 'sidebar' ); ?>
                                 </div>
                             </div> 
                        <?php endif; ?>
                    <?php } ?> 
        <?php } ?>
    <?php } ?>
    <!--SINGLE SIDEBAR ENDS--> 

<?php do_action('optimizer_after_sidebar'); ?>