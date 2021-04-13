<?php 
/**
 * The Category page for LayerFramework
 *
 * Displays the Category pages.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php get_header(); ?>
        
	<!--Category Posts-->
    <div class="category_wrap layer_wrapper">
    	<?php do_action('optimizer_before_category_archive'); ?>
        
            <!--CUSTOM PAGE HEADER STARTS-->
                <?php get_template_part('framework/core','pageheader'); ?>
            <!--CUSTOM PAGE HEADER ENDS-->
            
            <?php get_template_part('template_parts/post','layout'.(isset($optimizer['cat_layout_id']) ? absint($optimizer['cat_layout_id']) : 1).''); ?>
            
        <?php do_action('optimizer_after_category_archive'); ?>
    </div><!--layer_wrapper class END-->

<?php get_footer(); ?>