<?php 
/**
 * The Nivo Slide for LayerFramework
 *
 * Displays The Posts Slider on Frontpage.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php if($optimizer['slider_type_id'] == "noslider" ) { ?>
<?php } else { ?>

<div class="slide_wrap">
    <div class="slider-wrapper theme-default">
    <div class="pbar_wrap"><div class="prog_wrap"><div class="progrssn" style="width:10%;"></div></div><div class="pbar" id='astbar'>0%</div></div>   
    
            <div id="post_slider">
                <a class="buttons prev" href="#"><i class="fa fa-angle-left"></i></a>
                    <div class="viewport">
                        <ul class="overview">
                            <?php 
							$postcat = '';
							if(!empty($optimizer['slider_posts_cat'])){ $postcat = implode(',',$optimizer['slider_posts_cat']);}
							$postslides = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $optimizer['slider_n_posts'], 'cat' => $postcat ) ); ?>
                            <?php if ( $postslides->have_posts() ): while ( $postslides->have_posts() ) : $postslides->the_post(); ?>
                                <li>
                                  <!--POST IMAGE STARTS-->
                                  <?php if ( has_post_thumbnail() ) : ?>
                                  
                                  <div class="slide_image">                      
                                  <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                                  
                                  <?php elseif((optimizer_first_image() !== '')): ?>
                                  <div class="slide_image">                      
                                  <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                                  
                                  <?php else : ?>
                                  <div class="slide_image">
                                  <a href="<?php the_permalink();?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" /></a></div>   
                                           
                                  <?php endif; ?>
                                  <!--POST IMAGE END-->
                                <div class="slide_content">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="cat_name">
                                    	<?php _e('in ','optimizer'); ?>
                                        <?php if($post->post_type == 'post'){$category = get_the_category(); 
                                        if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}
                                        } ?>
                                    </div>
                                    <div class="slide_excerpt">
                                        <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?> 
                                    </div>
                                    <div class="slide_readmo">
                                        <a href="<?php the_permalink(); ?>">Read More <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                                </li>   
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                <a class="buttons next" href="#"><i class="fa fa-angle-right"></i></a>
            </div>
       
    </div>
</div>

	
<?php } ?>