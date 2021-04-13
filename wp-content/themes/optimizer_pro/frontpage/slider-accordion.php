<?php 
/**
 * The Accordion Slide for LayerFramework
 *
 * Displays The Accordion Slider on Frontpage.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php if($optimizer['slider_type_id'] == "noslider" ) { ?>
<?php } else { ?>

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
                        <div class="pbar_overlay accord_overlay"></div>
                        
                <div id="slide_acord">

                     <div id="accordion">
                        <ul class=" kwicks horizontal">
                         <?php 
							$accordgall = $optimizer['nivo_accord_slider'];
							$args = array(
								'post_type' => 'attachment',
								'post__in' => explode(',', $accordgall), 
								'posts_per_page' => 99,
								'order' => 'menu_order ID',
								'orderby' => 'post__in',
								'lang' => ''
								);
							$attachments = get_posts( $args );
									
							foreach ( $attachments as $attachment ) {?>
                             <li>
                            
                            <div class="acord_text">
								<?php if (empty ($optimizer['slider_txt_hide'])) { ?>
                                	<!--TITLE-->
									<h3 class="entry-title">
										<a <?php if (!empty ($attachment->post_content)) { echo 'href="'.do_shortcode(esc_url($attachment->post_content)).'"';} ?>>
											<?php echo do_shortcode($attachment->post_title); ?>
										</a>
									</h3>
                                 
                                 <!--DESCRIPTION-->
									<?php if(!empty($attachment->post_excerpt)) { ?>
                                    	<p class="slide_desc"><?php echo do_shortcode($attachment->post_excerpt); ?></p>
									<?php }?>
                                    
                                    <!--BUTTONS-->
									<?php $sldcontent = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
									if (!empty ($sldcontent)) { ?>
                                        <p class="slide_button_wrap">
                                            <a class="lts_button animated" href="<?php echo do_shortcode($attachment->post_content); ?>">
                                                <?php echo do_shortcode($sldcontent); ?>
                                            </a>
                                        </p>
									<?php } ?>
                                    
                             </div>
                             <?php } ?> 
                             
                             
                            <?php 
							//THE SLIDER IMAGE
							$imgsrc = wp_get_attachment_image_src( $attachment->ID, 'full' );
							echo '<img src="'.$imgsrc[0].'" alt="'.do_shortcode($attachment->post_title).'" width="'.$imgsrc[1].'" height="'.$imgsrc[2].'" /></a>';
							?>                  
                             

                             </li>
                        <?php } ?>
                        </ul>
                    </div>
                        
                </div>
                    
			</div>
                    
		</div>
		<?php } ?>
    
            
	<?php } ?>            
