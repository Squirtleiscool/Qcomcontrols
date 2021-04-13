<?php 
/**
 * Posts Layout 5 for LayerFramework
 *
 * Displays The Posts in Layout 5 
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

    <div id="content" class="lay5">
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
        
            <div class="single_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
                <div class="lay5_wrap">
                        <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                			<div class="single_post">

           <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                    
                        
                    <!--EDIT BUTTON START-->
						<?php if ( is_user_logged_in() && is_admin() ) { ?>
                            <div class="edit_wrap">
                            	<a href="<?php echo get_edit_post_link(); ?>">
                            		<?php _e('Edit','optimizer'); ?>
                                </a>
                            </div>
                        <?php } ?>
    				<!--EDIT BUTTON END-->
                    
                    <!--POST START-->
                        <div class="single_post_content">
                            <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <!--POST INFO START-->
								<?php if (!empty ($optimizer['post_info_id'])) { ?>
                                <div class="single_metainfo">
                                	<!--DATE-->
                                    <i class="fa-calendar"></i><a class="comm_date"><?php the_time( get_option('date_format') ); ?></a>
                                    <!--AUTHOR-->
                                    <i class="fa-user"></i><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
                                    <!--COMMENTS COUNT-->
                                    <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                                <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Comment', 'optimizer'), __('1 Comment', 'optimizer'), __('% Comments', 'optimizer'), '', __('Off' , 'optimizer')); ?></div><?php } ?>
                                	<!--CATEGORY LIST-->
                                  <i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>
                                </div>
                                <?php } ?>
                            <!--POST INFO END-->
                            
                            <!--POST CONTENT START-->
                                <div class="thn_post_wrap">
									<?php do_action('optimizer_before_content'); ?>
										<?php the_content(); ?>
                                    <?php do_action('optimizer_after_content'); ?>
                                </div>
                                	<div style="clear:both"></div>
                                <div class="thn_post_wrap">
									<?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                </div>
                            <!--POST CONTENT END-->
                            
                            
                            
                            <!--POST FOOTER START-->
                                <div class="post_foot">
                                    <div class="post_meta">
										 <?php if( has_tag() ) { ?>
                                             <div class="post_tag">
                                                 <div class="tag_list">
                                                 <?php the_tags('<i class="fa-tag"></i>','  '); ?>
                                                 </div>
                                             </div>
                                         <?php } ?>
                                    </div>
                               </div>
                           <!--POST FOOTER END-->
                            
                        </div>
                    <!--POST END-->
                    </div>
            
			</div><!--single_post class END--> 
			<?php endwhile ?> 
            <?php endif ?>
                
            </div><!--lay5_wrap class END--> 
                
                     
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
            
                </div>
           
            <!--PAGE END-->
        
        
                <!--SIDEBAR START-->    
            		<?php get_sidebar();?>
            	<!--SIDEBAR END--> 
        
     </div><!--center class end-->
   </div><!--lay5 class end-->