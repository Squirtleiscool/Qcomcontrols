<?php 
/**
 * The Nivo Slide for LayerFramework
 *
 * Displays The Nivo Slider on Frontpage.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php if($optimizer['slider_type_id'] == "noslider" ) { ?>
<?php } else { ?>

    		<!--NEW SLIDER VERSION 1.0-->
			<?php if (!empty ($optimizer['nivo_accord_slider'])) { ?>
				<div class="slide_wrap">
                    <div class="slider-wrapper theme-default">
                        <div class="pbar_wrap"> 
                            <div class="sk-spinner sk-spinner-cube-grid">
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                               <div class="sk-cube"></div>
                             </div>
                         </div>
                         <div class="pbar_overlay"></div>
                         
                         
                    <div id="zn_nivo" class="zn_nivo  nivo_content_<?php echo $optimizer['slider_content_align']; ?> slider_loading">
                    
					<?php 
                    $statgall = $optimizer['nivo_accord_slider'];
                    $args = array(
                        'post_type' => 'attachment',
                        'post__in' => explode(',', $statgall), 
                        'posts_per_page' => 99,
						'order' => 'menu_order ID',
						'orderby' => 'post__in',
						//'lang' => substr(get_bloginfo ( 'language' ), 0, 2)
                        );
                    $attachments = get_posts( $args );
                            
                    foreach ( $attachments as $attachment ) {
                               
                        $imgsrc = wp_get_attachment_image_src( $attachment->ID, 'full' );
                        echo '<img title="#nv_'.$attachment->ID.'" src="'.get_template_directory_uri().'/assets/images/preloader.png'.'" data-src="'.$imgsrc[0].'" width="'.$imgsrc[1].'" height="'.$imgsrc[2].'" alt="'.esc_attr($attachment->post_title).'" class="sldimg" />';
            
                     } 
					 wp_reset_postdata();
					 ?>
                    </div>	
                    
                    <?php if (empty ($optimizer['slider_txt_hide'])) { ?>
                    
                    <?php foreach ( $attachments as $attachment ) { ?>
                    
							<div id="nv_<?php echo $attachment->ID; ?>" class="nivo-html-caption">
								<div class="nivoinner">
                                	<!--TITLE-->
									<h3 class="entry-title">
										<a <?php if (!empty ($attachment->post_content)) { ?>href="<?php echo do_shortcode(esc_url($attachment->post_content)); ?>"<?php } ?>>
											<?php echo do_shortcode($attachment->post_title); ?>
										</a>
									</h3>
                                    <!--DESCRIPTION-->
									<?php if(!empty($attachment->post_excerpt)) { ?>
                                    	<p class="slide_desc"><?php echo do_shortcode($attachment->post_excerpt); ?></p>
									<?php }?>
                                    <!--BUTTONS-->
                                    
									<?php 
									$sldcontent = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
									if (!empty ($sldcontent)) { ?>
                                        <p class="slide_button_wrap">
                                            <a class="lts_button animated" href="<?php echo do_shortcode($attachment->post_content); ?>">
                                                <?php echo do_shortcode($sldcontent); ?>
                                            </a>
                                        </p>
									<?php } ?>
                    
                         
								</div>
							</div>
                    
						<?php } //END FOREARCH ?>
                     <?php } //END slider_txt_hide condifion ?>
            
            
                </div>
			</div>
		<?php } //END nivo_accord_slider condition ?>

<?php } ?>