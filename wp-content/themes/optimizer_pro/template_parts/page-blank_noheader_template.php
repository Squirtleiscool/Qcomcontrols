<?php
/*
Template Name: Blank Page Template
*/
?>
<?php global $optimizer;?>
<?php get_header(); ?>


    <div class="page_fullwidth_wrap layer_wrapper">
    
    <div id="content">
        <div class="center">
            <div class="blank_wrap no_sidebar">

					  <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                      
                        
                        <!--PAGE CONTENT START-->   
                        <div class="single_post_content" <?php optimizer_schema_prop('content'); ?>>
                        	<?php do_action('optimizer_before_title'); ?>
                        		<h1 class="postitle"><?php the_title(); ?></h1>
                            <?php do_action('optimizer_after_title'); ?>
                            
								<?php do_action('optimizer_before_content'); ?>
                                    <?php the_content(); ?>
                                <?php do_action('optimizer_after_content'); ?>
                        </div>
                        <!--PAGE CONTENT END-->                       
                  </div>
                  <?php endwhile ?> 
                  </div><!--single_post class END-->
                      
                  
              <?php endif ?>

            
            </div>
        </div>
   </div><!--layer_wrapper class END-->
<?php get_footer(); ?>