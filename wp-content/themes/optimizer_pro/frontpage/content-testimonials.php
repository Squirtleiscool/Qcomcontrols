<?php 
/**
 * The FRONTPAGE TESTIMMONIALS for LayerFramework
 *
 * Displays The FRONTPAGE TESTIMMONIALS Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>


<!--Testimonials START-->
    <div class="home_testi_inner testi_<?php echo $optimizer['testi_layout']; ?> <?php if(!empty($optimizer['hide_mob_testi'])){ echo 'mobile_hide_testi';} ?>">
            <div class="center">
			<?php /* If homepage Display the Title */?>
                <div class="homeposts_title testimonial_title">
                    <?php if($optimizer['testi_title_id']) { ?><h2 class="home_title"><span><?php echo $optimizer['testi_title_id']; ?></span></h2><?php }?>
                    <?php if($optimizer['testi_subtitle_id']) { ?><div class="home_subtitle"><?php echo $optimizer['testi_subtitle_id']; ?></div><?php }?>
                        <?php if($optimizer['testi_title_id']) { ?>
							<?php get_template_part('template_parts/divider','icon'); ?>
                        <?php }?>
                </div>
        
        
		<?php if(!empty($optimizer['twitter_testi_on'])){ ?> 
        	<div class="home_tweets_wrap">
				<?php
                    if(!empty($optimizer['twitter_testi_on'])){
                        $i = 0;
                        $twitter_testi =$optimizer['twitter_testimonial'];
                            foreach($twitter_testi as $key => $value){
                                echo '<div class="home_tweet">'.wp_oembed_get(esc_url($value)).'</div>';
                            }
                    }
                ?>
            </div>
		<?php }elseif (!empty ($optimizer['custom_testi'])){ ?>
           
            <div id="testi-looper" <?php if( $optimizer['testi_layout'] == 'col1') { ?>data-looper="go" class="looper slide"<?php } ?>>
                <ul class='looper-inner'>
                
				<?php foreach ((array)$optimizer['custom_testi'] as $testimony){ ?>    
                     <li class='item'>
                              <div class="testi_content"><?php echo do_shortcode( $testimony['description']); ?></div>
                              <div class="testi_author">
                              <?php if (!empty ($testimony['image'])) { ?>
                                  <img alt="<?php echo $testimony['title']; ?>" class="testi_avatar" src="<?php echo $testimony['image']; ?>" /> 
                              <?php } ?>
                              <a <?php if(!empty($testimony['url'])){ echo 'href="'.esc_url($testimony['url']).'"'; }?>><?php echo $testimony['title']; ?></a>
                              </div>    
                     </li>
                <?php } ?>
                       
                </ul>
                <!--Tab End-->
            
            <!--NAVIGATION-->
			<?php if( $optimizer['testi_layout'] == 'col1') { ?>	
            <nav>
                <ul class="looper-nav">
				<?php $i = 0; foreach ((array)$optimizer['custom_testi'] as $testimony){ ?>    
					<li><a href="#testi-looper" data-looper="to" data-args="<?php echo $i +1; ?>"><span></span></a></li>
                    <?php $i++ ?>
                <?php } ?>
                </ul>
            </nav>
			<?php }?>
            <!--NAVIGATION END-->
            
         	</div> 
		<?php }?>

        </div>
    </div>

<!--Testimonials END--> 