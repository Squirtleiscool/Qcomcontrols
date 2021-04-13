<?php
/*
Template Name: Full Width Page
*/
?>
<?php global $optimizer;?>
<?php get_header(); ?>


    <div class="page_fullwidth_wrap layer_wrapper">
        
        <!--CUSTOM PAGE HEADER STARTS-->
        <?php $show_pgheader = get_post_meta( $post->ID, 'show_page_header', true); if (empty($show_pgheader)){ ?>
        	<?php get_template_part('framework/core','pageheader'); ?>
        <?php }else{ ?>
		<?php } ?>
        <!--CUSTOM PAGE HEADER ENDS-->
  
    <div id="content">
        <div class="center">
            <div class="single_wrap no_sidebar">
                <div class="single_post">
					  <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
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
                        
                        <!--PAGE CONTENT START--> 
                        <div class="single_post_content">
                        	<?php if(empty($optimizer['pageheader_switch'])){ ?>
                            	<?php do_action('optimizer_before_title'); ?>
                        			<h1 class="postitle"><?php the_title(); ?></h1>
                                <?php do_action('optimizer_after_title'); ?>
							<?php } ?>
                            
                            <!--SOCIAL SHARE POSTS START-->
                            <?php if (!empty ($optimizer['social_page_id']) || is_customize_preview()) { ?>
                            <?php $hide_share = get_post_meta($post->ID, 'hide_share', true);  ?>
                                <div class="share_foot share_pos_<?php echo $optimizer['share_position']; ?> <?php if (empty($optimizer['social_page_id']) || !empty($hide_share) ){ echo 'hide_share'; }?>">
									<?php get_template_part('framework/core','share_this'); ?>
                                </div>
                             <?php } ?> 
                            <!--SOCIAL SHARE POSTS END-->
                            
                                <!--THE CONTENT START-->
                                    <div class="thn_post_wrap" <?php optimizer_schema_prop('content'); ?>>
										<?php do_action('optimizer_before_content'); ?>
                                            <?php the_content(); ?>
                                        <?php do_action('optimizer_after_content'); ?>
                                    </div>
                                        <div style="clear:both"></div>
                                    <div class="thn_post_wrap wp_link_pages">
                                        <?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                    </div>
                                <!--THE CONTENT END-->
                        </div>
                        <!--PAGE CONTENT END-->                       
                  </div>
                  <?php endwhile ?> 
                  </div><!--single_post class END-->
                      
                  <!--COMMENT START: Calling the Comment Section. If you want to hide comments from your posts, remove the line below-->     
                  <?php if (!empty ($optimizer['post_comments_id'])) { ?>
                      <div class="comments_template">
                          <?php comments_template('',true); ?>
                      </div>
                  <?php }?> 
                  <!--COMMENT END-->
                  
              <?php endif ?>
            
              </div><!--single_wrap class END-->
           
            
            </div>
        </div>
   </div><!--layer_wrapper class END-->
<?php get_footer(); ?>