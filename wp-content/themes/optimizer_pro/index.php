<?php 
/**
 * The index page LayerFramework
 *
 * Displays the home page elements.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php get_header(); ?>

<?php if ( is_front_page() ) { ?>
<div class="home_wrap layer_wrapper">
	<div class="fixed_wrap fixindex">
				<!--FRONTPAGE WIDGET AREA-->
                <?php do_action('optimizer_before_frontpage_widgets'); ?>
					<?php if ( is_active_sidebar( 'front_sidebar' ) ) : ?>
                        <div id="frontsidebar" class="frontpage_sidebar" data-sidebarid="front_sidebar">       
                            <?php dynamic_sidebar( 'front_sidebar' ); ?>
                         </div> 
                    <?php endif; ?>
                <?php do_action('optimizer_after_frontpage_widgets'); ?>

</div>
</div><!--layer_wrapper class END-->

				<!--DISPLAY LATEST POSTS WHEN NO WIDGET IS SET-->
                <?php if ( !is_active_sidebar( 'front_sidebar' ) ) : ?>
                    <div class="fixed_site layer_wrapper">
                        <div class="fixed_wrap fixindex dummypost">
                        
									<?php if(is_customize_preview()){ ?>
                                            <div class="replace_widget"><?php _e('You can Replace this Posts Section with Optimizer Widgets.','optimizer'); ?> <a class="add_widget_home"><?php _e('Add Widgets','optimizer'); ?></a></div>
                                    <?php } ?>
                                    <?php get_template_part('template_parts/post','layout4'); ?> 
                                    
                        </div>
                    </div>
                <?php endif; ?>

<?php }else{ ?>


<div class="fixed_site layer_wrapper">
	<div class="fixed_wrap fixindex">
    <?php get_template_part('template_parts/post','layout'.$optimizer['cat_layout_id'].''); ?>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>