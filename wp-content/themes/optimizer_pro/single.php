<?php global $optimizer;?>
<?php get_header(); ?>


<div class="post_wrap layer_wrapper">

	<div id="content">
    <?php if($optimizer['single_post_layout'] == 'header') { ?>
    	<div class="single_post_header" ><div class="post_head_content"></div><?php the_post_thumbnail('full'); ?><?php do_action('optimizer_single_header'); ?></div>
    <?php } ?>
    
		<div class="center">
           <!--POST START-->
				<?php 
				//NO SIDEBAR LOGIC
            $nosidebar ='';
            $hidesidebar = get_post_meta($post->ID, 'hide_sidebar', true);
            //$post_layout = get_post_meta($post->ID, 'optimizer_post_layout', true) === 'full' && true;
				$sidebar = get_post_meta($post->ID, 'sidebar', true);
                if (!empty( $hidesidebar )){
                        $nosidebar = 'no_sidebar';
                }else{
                        if(!empty( $sidebar ) && is_active_sidebar( $sidebar )){
                            $nosidebar = ''; 
						}elseif(!empty( $sidebar ) && !is_active_sidebar( $sidebar )){
							$nosidebar = 'no_sidebar'; 
                        }elseif(!is_active_sidebar( 'sidebar' ) ){ 
                            $nosidebar = 'no_sidebar'; 
                 		}    
                } ?>
           
			<div class="single_wrap <?php echo $nosidebar; ?>" <?php optimizer_schema_item_type('post'); ?>>
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
                    
                    <!--POST START-->
                        <div class="single_post_content has_share_pos_<?php echo $optimizer['share_position']; ?>">
                        <!--FEATURED IMAGE-->
                        <?php if ((!empty ($optimizer['single_featured']) && has_post_thumbnail())  || is_customize_preview()) { ?>
                                <div class="single_featured <?php if (empty($optimizer['single_featured'])){ echo 'hide_featuredimg'; }?>">
									<?php the_post_thumbnail('full'); ?>
                                </div>
                        <?php } ?>
                        <!--FEATURED IMAGE END-->
                        
                        <!--POST TITLE START-->
						<?php do_action('optimizer_before_title'); ?>
                            <h1 class="postitle entry-title" <?php optimizer_schema_prop('title'); ?>><?php the_title(); ?></h1>
						<?php do_action('optimizer_after_title'); ?>
                        <!--POST TITLE END-->
                        
                           <!--POST INFO START-->
								   <?php if (!empty ($optimizer['post_info_id']) || is_customize_preview()) { ?>
                                <div class="single_metainfo <?php if (empty($optimizer['post_info_id'])){ echo 'hide_singlemeta';}?>">

                                	<!--DATE-->
                                    <?php if (!empty($optimizer['hide_post_info_date'])){ ?>
                                    <i class="fa-calendar"></i><span class="comm_date post-date updated"><?php the_time( get_option('date_format') ); ?></span>
                                    <?php } ?>
                                    
                                    <!--AUTHOR-->
                                    <?php if (!empty($optimizer['hide_post_info_author'])){ ?>
                                    <i class="fa-user"></i>
									            <?php global $authordata; ?>
									         <a class="vcard author post-author" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename );?>" <?php optimizer_schema_item_type('author'); ?> <?php optimizer_schema_prop('author'); ?> ><span class='fn author' <?php optimizer_schema_prop('name'); ?>><?php echo get_the_author(); ?></span></a>
                                    <?php } ?>

                                    <!--COMMENTS COUNT-->
                                    <?php if (!empty($optimizer['hide_post_info_comment'])){ ?>
                                    <i class="fa-comments-o"></i>
                                       <?php if (!empty($post->post_password)) { ?>
                                       <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Comment', 'optimizer'), __('1 Comment', 'optimizer'), __('% Comments', 'optimizer'), '', __('Off' , 'optimizer')); ?></div><?php } ?>
                                    <?php } ?>


                                	<!--CATEGORY LIST-->
                                   <?php if (!empty($optimizer['hide_post_info_cats'])){ ?>
                                  <i class="fa-th-list"></i><div class="catag_list" <?php optimizer_schema_prop('category'); ?>><?php the_category(', '); ?></div>
                                  <?php } ?>
                                  
                                  <?php do_action('optimizer_after_single_meta'); ?>
                                  
                                </div>
                           <?php } ?>
                            <!--POST INFO END-->
                            
                            <!--SOCIAL SHARE POSTS START-->
                            <?php if (!empty ($optimizer['social_single_id']) || is_customize_preview()) { ?>
                            <?php $hide_share = get_post_meta($post->ID, 'hide_share', true);  ?>
                                <div class="share_foot share_pos_<?php echo $optimizer['share_position']; ?> <?php if (empty($optimizer['social_single_id']) || !empty($hide_share) ){ echo 'hide_share'; }?>">
									<?php get_template_part('framework/core','share_this'); ?>
                                </div>
                             <?php } ?> 
                            <!--SOCIAL SHARE POSTS END-->
                            
                            <!--POST CONTENT START-->
                                <div class="thn_post_wrap" <?php optimizer_schema_prop('content'); ?>>
									<?php do_action('optimizer_before_content'); ?>
										<?php the_content(); ?>
                                    <?php do_action('optimizer_after_content'); ?>
                                </div>
                                	<div style="clear:both"></div>
                                <div class="thn_post_wrap wp_link_pages">
									<?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                </div>
                            <!--POST CONTENT END-->
                            
                            
                            
                            <!--POST FOOTER START-->
                                <div class="post_foot">
                                    <div class="post_meta">
										 <?php if( has_tag() ) { ?>
                                             <div class="post_tag">
                                                 <div class="tag_list" <?php optimizer_schema_prop('tags'); ?>>
                                                   <?php if(get_the_tag_list()) {
    													echo get_the_tag_list('<ul><li><i class="fa-tag"></i>','</li><li><i class="fa-tag"></i>','</li></ul>');
													}
													?>
                                                 </div>
                                             </div>
                                         <?php } ?>
                                    </div>
                               </div>
                           <!--POST FOOTER END-->
                            
                        </div>
                    <!--POST END-->
                    </div>
                        
            <?php endwhile ?> 
       
            <?php endif ?>
            
				<?php if (!empty ($optimizer['post_nextprev_id']) || is_customize_preview()) { ?>
				<!--NEXT AND PREVIOUS POSTS START--> 
					<?php if ( get_post_status ( get_the_ID() ) !== 'private' ) { ?>
							<?php get_template_part('framework/core','nextprev'); ?>
                    <?php } ?>
                <!--NEXT AND PREVIOUS POSTS END-->          
                <?php }?>
                
                <!--ABOUT AUTHOR BOX-->
				<?php if (!empty ($optimizer['author_about_id']) || is_customize_preview()) { ?>
                    <?php get_template_part('framework/core','authorbox'); ?>
                <?php }?>   
                <!--ABOUT AUTHOR BOX END-->
        
            <!--RELATED POSTS START-->   
				<?php if (!empty ($optimizer['post_related_id']) || is_customize_preview()) { ?>
                    <?php get_template_part('framework/core','related'); ?>
                <?php }?>    
            <!--RELATED POSTS END-->

            <!--COMMENT START: Calling the Comment Section. If you want to hide comments from your posts, remove the line below-->     
				<?php if (!empty ($optimizer['post_comments_id']) || is_customize_preview()) { ?>
                    <div class="comments_template <?php if (empty($optimizer['post_comments_id'])){ echo 'hide_comments'; }?>">
                        <?php comments_template('',true); ?>
                    </div>
                <?php }?> 
            <!--COMMENT END-->


			</div>
	</div>
            
                <!--SIDEBAR LEFT OR RIGHT--> 
                <?php /* Sidebar Variables */?>
                  <?php $hide_sidebar = get_post_meta( $post->ID, 'hide_sidebar', true);  
                        //$hide_sidebar = get_post_meta($post->ID, 'optimizer_post_layout', true) === 'full' && true;
                     if(empty($hide_sidebar)){	get_sidebar(); 	}
                  ?>
                <!--SIDEBAR LEFT OR RIGHT END--> 



		</div><!--center class END-->
	</div><!--#content END-->
</div><!--layer_wrapper class END-->

<?php get_footer(); ?>