<?php 
/**
 * The Nivo Slide for LayerFramework
 *
 * Displays The Woocommerce Product Slider on Frontpage.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php if($optimizer['slider_type_id'] == "noslider" ) { ?>
<?php } else { ?>

<div class="slide_wrap">
    <div class="slider-wrapper theme-default woo-slider">
    <div class="pbar_wrap"><div class="prog_wrap"><div class="progrssn" style="width:10%;"></div></div><div class="pbar" id='astbar'>0%</div></div>   
    
            <div id="post_slider">
                <a class="buttons prev" href="#"><i class="fa fa-angle-left"></i></a>
                    <div class="viewport woocommerce">
                        <ul class="overview">
                            <?php 
							$postcat = '';
							if(!empty($optimizer['woo_category'])){ $postcat = $optimizer['woo_category'];}
							$postslides = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => $optimizer['slider_n_woo']) ); ?>
                            <?php if ( $postslides->have_posts() ): while ( $postslides->have_posts() ) : $postslides->the_post(); ?>
                                <li <?php post_class( ); ?>>
                                
                                <span class="woo_sale" style="background:<?php $woo_color = get_option( 'woocommerce_frontend_css_colors' ) ; echo $woo_color['highlight'];?>"><?php _e('Sale!','optimizer'); ?></span>
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
										<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                                        <a href="<?php the_permalink(); ?>">
                                        
                                            <h3><?php the_title(); ?></h3>
                                    
                                            <?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
                                    
                                        </a>
                                    
                                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
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