<?php 
/**
 * Posts Layout 4 for LayerFramework
 *
 * Displays The Posts in Layout 4 
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

    <div class="lay4">
        <div class="center">
        <?php /* If homepage Display the Title */?>
        
            <div class="lay4_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
                <div class="lay4_inner">
					<?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 

                <!--POST THUMBNAIL START-->
                        <div class="post_image">
                             <!--CALL TO POST IMAGE-->
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                            
                            
                            <?php elseif(!optimizer_gallery_thumb() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a></div>
                            
                            
                            <?php elseif(!optimizer_first_image() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                        
                            <?php else : ?>
                            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="optimizer_thumbnail" width="500" height="350" /></a></div>   
                                     
                            <?php endif; ?>
                        </div>
                 <!--POST THUMBNAIL END-->

                    <!--POST CONTENT START-->
                        <div class="post_content">
                            <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            
                         <!--META INFO START-->   
                            <?php if (!empty ($optimizer['post_info_id'])) { ?>
                            <div class="single_metainfo">
                            	<!--DATE-->
                                <i class="fa-calendar"></i><a class="comm_date"><?php the_time( get_option('date_format') ); ?></a>
                                <!--AUTHOR-->
                                <i class="fa-user"></i><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
                                <!--COMMENTS COUNT-->
                                <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                            <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Comment', 'optimizer'), __('1 Comment', 'optimizer'), __('% Comments', 'optimizer'), '', __('Off' , 'optimizer')); ?></div><?php } ?>
                            	<!--CATEGORY-->
                              	<i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>
                            </div>
                            <?php } ?>
                         <!--META INFO START-->  
                         
                            <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?>
                            
                        </div>
                    <!--POST CONTENT END-->
					<!--Read More Button-->
                    <div class="blog_mo"><a href="<?php the_permalink();?>">+ <?php _e('Read More', 'optimizer'); ?></a></div>
                    
                </div>
                <?php endwhile ?> 
    
                <?php endif ?>
                </div><!--lay4_inner class END-->
                
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
            
            </div><!--lay4_wrap class END-->
                    
                <!--SIDEBAR START-->    
            		<?php get_sidebar();?>
            	<!--SIDEBAR END--> 
                
            </div><!--center class END-->
        </div><!--lay4 class END-->
