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
        <!--CUSTOM PAGE HEADER STARTS-->
            <?php //get_template_part('framework/core','pageheader'); ?>
        <!--CUSTOM PAGE HEADER ENDS-->

		<?php do_action('optimizer_before_portfolio_archive'); ?>

            <div class="center">
                <!--PORTFOLIO CATEGORIES-->
                <!--RENDER PORTFOLIO-->
                <?php optimizer_portfolio_layouts($optimizer['portfolio_layout'], '-1', $optimizer['portfolio_hover_layout']); ?>
            </div>
        
        <?php do_action('optimizer_after_portfolio_archive'); ?>
        
    </div><!--layer_wrapper class END-->

<?php get_footer(); ?>