<?php 
/**
 * The Related Posts Function for LayerFramework
 *
 * Displays The related posts on single posts page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

    <div id="ast_related_wrap" class="<?php if (empty($optimizer['post_related_id'])){ echo 'hide_related'; }?>">
    	<!--Related Posts Title-->
    	<h3 class="related_h3"><?php _e('Related Posts' , 'optimizer'); ?></h3>
        
    <!--RELATED POSTS START-->    
    <div id="ast_related">
		<?php
        $backup = $post;
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        
            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'showposts'=>4, // Number of related posts that will be shown.
                'ignore_sticky_posts'=>1
            );
        
        $related_query = new wp_query($args);
        $totalpost = $related_query->found_posts; 

        echo '<div class="ast_related__wrap ast_related__wrap--total-'.$totalpost.'">';
            if( $related_query->have_posts() ) {
                echo '<div class="panel-container rel_eq">';
                while ($related_query->have_posts()) {
                    $related_query->the_post();
        
                ?>
        <div id="rel_<?php the_id(); ?>" class="rel_tab">
        
                        <?php if ( has_post_thumbnail() ) : ?>
                        
                        <div class="related_img">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <i class="fa-plus"></i>
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                        </div>
                        <a class="rel_hover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        
                        
                        <?php elseif((optimizer_first_image() !== '')): ?>
                        <div class="related_img">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <i class="fa-plus"></i>
                            <img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" />
                        </a>
                        </div>
						<a class="rel_hover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        
                        <?php else : ?>
                        <div class="related_img">
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <i class="fa-plus"></i>
                            <img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thumbnail" width="500" height="350" />
                        </a>
                        </div>
                        <a class="rel_hover" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        
                        <?php endif; ?>
        
        
        </div>
        
                <?php
                }
            echo '</div>';
            }
            echo '</div>';
        }
        $post = $backup;
        wp_reset_postdata(); 
        
        
        ?>
    	</div>
        <!--RELATED POSTS END--> 
        
	</div>