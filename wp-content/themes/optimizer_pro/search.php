<?php 
/**
 * The Search Page Template for LayerFramework
 *
 * Displays the Search Page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php get_header(); ?>

    <div class="search_wrap layer_wrapper">
    	
		<?php do_action('optimizer_before_search'); ?>
            <!--SEARCH DETAILS START-->
            <div class="center">
                <div class="search_term">
                    <h2 class="postsearch">
                        <?php printf( __( 'Search Results for: %s', 'optimizer' ), '<span>' . esc_html( get_search_query() ) . '</span>'); ?>
                    </h2>
                    <a class="search_count">
                        <?php _e('Total posts found - ', 'optimizer'); ?> <?php global $wp_query; echo $wp_query->found_posts; wp_reset_query(); ?>
                    </a>
                
                    <?php get_search_form(); ?>
                </div>
            </div> 
            <!--SEARCH DETAILS END-->  
        <?php do_action('optimizer_after_search'); ?>    
          
		<?php 
      $postLayout = (isset($optimizer['search_layout_id']) ? absint($optimizer['search_layout_id']) : '');
      if(empty($postLayout)){  $postLayout = (isset($optimizer['cat_layout_id']) ? absint($optimizer['cat_layout_id']) : 1);  }
      get_template_part('template_parts/post','layout'.$postLayout); 
      ?>
    
     </div><!--layer_wrapper class END-->
<?php get_footer(); ?>