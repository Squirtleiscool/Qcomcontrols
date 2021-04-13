<?php global $optimizer;?>
<?php get_header(); ?>


<div class="post_wrap layer_wrapper portfolio_wrapper portfolio_single_<?php echo $optimizer['portfolio_single_layout']; ?>">

	<div id="content">
		<div class="center">
           <!--POST START-->
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
                    
                    <!--POST START-->
                        <div class="single_post_content has_share_pos_<?php echo $optimizer['share_position']; ?>">
                        
                        <?php if($optimizer['portfolio_single_layout'] != '3' && $optimizer['portfolio_single_layout'] != '5'){ ?>
                            <div id="portfolio_left" class="portfolio_style_<?php echo $optimizer['portfolio_single_layout']; ?>">
                                <!--FEATURED IMAGE-->
                                <?php
                                if ( has_shortcode( get_the_content(), 'gallery' ) ) {
                                        echo get_post_gallery();
                                }elseif ( has_post_thumbnail() ) {
                                       echo ' <div class="portfolio_featured">'.the_post_thumbnail('full').'</div>';
                                } 
                                ?>
                                <!--FEATURED IMAGE END-->
                            </div>
                        <?php } ?>
                        
                        
                        <div id="portfolio_right">
                        
                       <!--portfolio_category -->
							<?php 
							if(function_exists('portfolio_post_type_init')){
                            	$taxonomy= 'portfolio_category'; 
							}elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ){
								$taxonomy= 'jetpack-portfolio-type'; 
							 }else{ $taxonomy ='';}?>
                            
							<div class="catag_list"><?php the_terms( $post->ID, $taxonomy, '', ' / ' ); ?></div>
                        <!--portfolio_category END --> 
                        
                            
                        <!--POST TITLE START-->
						<?php do_action('optimizer_before_portfolio_title'); ?>
                            <h1 class="postitle entry-title"><?php the_title(); ?></h1>
						<?php do_action('optimizer_after_portfolio_title'); ?>
                        <!--POST TITLE END-->
                        

                            <!--POST CONTENT START-->
                                <div class="thn_post_wrap">
									<?php do_action('optimizer_before_portfolio_content'); ?>
										<?php the_content(); ?>
                                    <?php do_action('optimizer_after_portfolio_content'); ?>
                                </div>
                                	<div style="clear:both"></div>
                                <div class="thn_post_wrap wp_link_pages">
									<?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                </div>
                            <!--POST CONTENT END-->

                            <!--POST FOOTER START-->
							<?php 
                            if(function_exists('portfolio_post_type_init')){
                                $taxonomy_tags= 'portfolio_tag'; 
                            }elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ){
                                $taxonomy_tags= 'jetpack-portfolio-tag'; 
                            }else{ $taxonomy_tags ='';}?>
							 <?php if( $taxonomy_tags ) { ?>
                                 <div class="post_tag">
                                     <div class="tag_list">
                                       <?php the_terms( $post->ID, $taxonomy_tags, '', ' ' ); ?>
                                     </div>
                                 </div>
                             <?php } ?>
                           <!--POST FOOTER END-->
                           
                            <!--SOCIAL SHARE POSTS START-->
                            <?php if (!empty ($optimizer['portfolio_share']) || is_customize_preview()) { ?>
                                <div class="share_foot <?php if (empty($optimizer['portfolio_share'])){ echo 'hide_share'; }?>">
									<?php get_template_part('framework/core','share_this'); ?>
                                </div>
                             <?php } ?> 
                            <!--SOCIAL SHARE POSTS END-->
                           
                         </div>  <!--#portfolio_right END-->
                         
                        <?php if($optimizer['portfolio_single_layout'] == '3'){ ?>
                            <div id="portfolio_left">
                                <!--FEATURED IMAGE-->
                                <?php
                                if ( has_shortcode( get_the_content(), 'gallery' ) ) {
                                        echo get_post_gallery();
                                }elseif ( has_post_thumbnail() ) {
                                       echo ' <div class="portfolio_featured">'.the_post_thumbnail('full').'</div>';
                                } 
                                ?>
                                <!--FEATURED IMAGE END-->
                            </div>
                        <?php } ?>
                         
                          
                        </div>
                    <!--POST END-->
                    </div>
                        
            <?php endwhile ?> 
       
            <?php endif ?>
            
				<!--NEXT AND PREVIOUS POSTS START--> 
                      <div id="portfolio_nextprev">
                          <?php previous_post_link('%link','<i title="'.__('Previous','optimizer').'" class="fa fa-angle-left"></i>'); ?>
                          <?php next_post_link('%link','<i title="'.__('Next','optimizer').'" class="fa fa-angle-right"></i>'); ?>
                      </div>
                <!--NEXT AND PREVIOUS POSTS END-->          


            <!--COMMENT START: DISABLED-->     
				<?php if (!empty ($optimizer['post_comments_id']) || is_customize_preview()) { ?>
                		<?php do_action('optimizer_after_portfolio_content'); ?>
<!--                    <div class="comments_template <?php if (empty($optimizer['post_comments_id'])){ echo 'hide_comments'; }?>">
                        <?php //comments_template('',true); ?>
                    </div>-->
                <?php }?> 
            <!--COMMENT END-->


			</div>
</div>
            
            <!--SIDEBAR START: DISABLED---> 
            <?php //$hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true); if (empty($hide_sidebar )){ ?>
            	<?php //get_sidebar(); ?>
            <?php //}?> 
            <!--SIDEBAR END--> 



		</div><!--center class END-->
	</div><!--#content END-->
</div><!--layer_wrapper class END-->

<?php get_footer(); ?>