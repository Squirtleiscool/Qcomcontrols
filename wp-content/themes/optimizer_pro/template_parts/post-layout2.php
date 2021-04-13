<?php 
/**
 * Posts Layout 2 for LayerFramework
 *
 * Displays The Posts in Layout 2 
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

    <div class="lay2">
        <div class="center">
        <?php /* If homepage Display the Title */?>
        <?php if ( is_home() ) { ?>
            <div class="homeposts_title">
            	<?php if($optimizer['posts_title_id']) { ?><h2 class="home_title"><?php echo do_shortcode($optimizer['posts_title_id']); ?></h2><?php }?>
                <?php if($optimizer['posts_subtitle_id']) { ?><div class="home_subtitle"><?php echo do_shortcode($optimizer['posts_subtitle_id']); ?></div><?php }?>
                    <?php if($optimizer['posts_title_id']) { ?>
						<?php get_template_part('template_parts/divider','icon'); ?>
                    <?php }?>
            </div>
        <?php }?>
            <div class="lay2_wrap">
            
				<?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
            
 
            <!--POST THUMBNAIL START-->
                <div class="post_image <?php if(empty($optimizer['post_readmo']) && empty($optimizer['post_readmo'])) { ?>hide_img_hover<?php } ?>">
                     <!--CALL TO POST IMAGE-->
                    <?php if ( has_post_thumbnail() ) : ?>
                    
                    <div class="imgwrap">  
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($optimizer['post_zoom']) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($optimizer['post_readmo']) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                    
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                    
                    <?php elseif(!optimizer_gallery_thumb() == ''): ?>
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($optimizer['post_zoom']) ) { ?>
                                	<a class="imgzoom" href="<<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($optimizer['post_readmo']) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a></div>
                    
                    <?php elseif(!optimizer_first_image() == ''): ?>
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($optimizer['post_zoom']) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($optimizer['post_readmo']) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                    <?php else : ?>
                    
                    <div class="imgwrap">
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                                <?php if(!empty($optimizer['post_readmo']) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>
                    <a href="<?php the_permalink();?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" /></a></div>   
                             
                    <?php endif; ?>
                    <div class="post_content">
                    <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                     <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?> 
                    </div>
                </div>
           <!--POST THUMBNAIL END-->     

                
            </div>
            <?php endwhile ?> 

            <?php endif ?>
            </div><!--lay2_wrap class end-->
            
            
        <!--PAGINATION START-->
            <div class="ast_pagenav">
                <?php
                    global $wp_query;
                    $big = 999999999; // need an unlikely integer
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'show_all'     => false,
                            'prev_next'    => false,
							'add_args' => false
                        
                        ) );
                ?>
            </div>
        <!--PAGINATION END-->
        
        
        <?php wp_reset_postdata(); ?>

         <!--SIDEBAR START-->    
                 <?php //get_sidebar();?>
         <!--SIDEBAR END--> 


     </div><!--center class end-->
   </div><!--lay2 class end-->