<?php 
/*
Template Name: Widgetized Page with Right Sidebar
*/
global $optimizer;?>

<?php get_header(); ?>

	<?php do_action('optimizer_before_page_widgets'); ?>
    <div class="page_wrap layer_wrapper">
    
        <!--CUSTOM PAGE HEADER STARTS-->
        <?php if(!empty($optimizer['pageheader_widgetized'])){ ?>
			<?php $show_pgheader = get_post_meta( $post->ID, 'show_page_header', true); if (empty($show_pgheader)){ ?>
                <?php get_template_part('framework/core','pageheader'); ?>
            <?php }else{ ?>
            <?php } ?>
        <?php } ?>
        <!--CUSTOM PAGE HEADER ENDS-->
    

	<div class="single_wrap <?php echo $nosidebar; ?>">
		<div class="single_post">
			<?php if ( post_password_required() ) {
                
                    echo get_the_password_form();
                
                 }else{
        
                    optimizer_full_sidebar(); 
                    
            }?>
        </div>
    </div>  
    
    <?php get_sidebar(); ?>   
       
    </div>
    <?php do_action('optimizer_after_page_widgets'); ?>

<?php get_footer(); ?>