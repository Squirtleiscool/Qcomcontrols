<?php
/*
Template Name: Blog Page Template
*/
?>
<?php global $optimizer;?>
<?php get_header(); ?>

<div class="page_blog_wrap layer_wrapper blog_layout<?php echo $optimizer['blog_layout_id']; ?>">

        <!--CUSTOM PAGE HEADER STARTS-->
        <?php $show_pgheader = get_post_meta( $post->ID, 'show_page_header', true); if (empty($show_pgheader)){ ?>
        	<?php get_template_part('framework/core','pageheader'); ?>
        <?php }else{ ?>
		<?php } ?>
        <!--CUSTOM PAGE HEADER ENDS-->

  <?php  
  		
		if(!empty($optimizer['blog_cat_id'])){
			$blogcat = $optimizer['blog_cat_id'];
			$blogcats =implode(',', $blogcat);
			}else{$blogcats = '';}
       $args = array(
                     'post_type' => 'post',
                     'cat' => ''.$blogcats.'',
                     'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
                     'posts_per_page' => ''.$optimizer['blog_num_id'].'');
      $the_query = new WP_Query( $args );
   ?>
                 
    <div class="lay4">
        <div class="center">
				<?php 
				//NO SIDEBAR LOGIC
                $nosidebar ='';
                $hidesidebar = get_post_meta($post->ID, 'hide_sidebar', true);
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
            <div class="lay4_wrap <?php echo $nosidebar; ?>" <?php optimizer_schema_item_type('blog'); ?>>
                <div class="lay4_inner">

                      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" <?php optimizer_schema_item_type('post'); ?>> 
                     
                <!--POST THUMBNAIL START-->
                <?php if(!empty($optimizer['show_blog_thumb']) && ($optimizer['blog_layout_id'] == '1' || $optimizer['blog_layout_id'] == '4' || $optimizer['blog_layout_id'] == '5') ) { ?>
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
                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image(); ?>" /></a></div>
                        
                            <?php else : ?>
                            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="optimizer_thumbnail" width="500" height="350" /></a></div>   
                                     
                            <?php endif; ?>
                        </div>
                 <?php } ?>
                 <!--POST THUMBNAIL END-->
                 
                 
                <!--POST THUMBNAIL FOR BLOG LAYOUT 3 START-->
                <?php if(!empty($optimizer['show_blog_thumb']) &&  $optimizer['blog_layout_id'] == '2' ) { ?>
                        <div class="post_image">
                             <!--CALL TO POST IMAGE-->
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('full'); ?></a></div>
                            
                            <?php elseif(!optimizer_gallery_thumb() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb(); ?>" /></a></div>
                            
                            <?php elseif(!optimizer_first_image() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image(); ?>" /></a></div>
                        
                            <?php else : ?>
                            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="optimizer_thumbnail" width="500" height="350" /></a></div>   
                                     
                            <?php endif; ?>
                        </div>
                 <?php } ?>
                 <!--POST THUMBNAIL END--> 
                 

                    
                    <!--POST CONTENT START-->
                        <div class="post_content">
                            <h2 class="postitle" <?php optimizer_schema_prop('title'); ?>><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            
                         <!--META INFO START-->   
                            <?php if (!empty ($optimizer['post_info_id'])) { ?>
                            <div class="single_metainfo">
                            	<!--DATE-->
                                <?php if($optimizer['blog_layout_id'] == '1' || $optimizer['blog_layout_id'] == '4' || $optimizer['blog_layout_id'] == '5'){ ?>
                                <i class="fa-calendar"></i><a class="comm_date"><?php the_time( get_option('date_format') ); ?></a>
                                <?php }else{ ?>
                                <div class="datebox">
                                    <div class="datebox_inner">
                                        <span class="sdate"><?php the_time('jS') ?></span>
                                        <span class="smonth"><?php the_time('M') ?></span>
                                     </div>  
                                    <span class="syear"><?php the_time('Y') ?></span>
                        		</div>
								<?php } ?>
                                    <!--AUTHOR-->
                                    <i class="fa-user"></i>
									<?php global $authordata; ?>
									<a class="vcard author post-author auth_meta" href="<?php echo get_author_posts_url( $authordata->ID, $authordata->user_nicename );?>" <?php optimizer_schema_item_type('author'); ?> <?php optimizer_schema_prop('author'); ?> ><span class='fn' <?php optimizer_schema_prop('name'); ?>><?php echo get_the_author(); ?></span></a>
                                    
                            	<!--CATEGORY-->
                              	<i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>
                                <!--COMMENTS COUNT-->
                                <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                            <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Comment', 'optimizer'), __('1 Comment', 'optimizer'), __('% Comments', 'optimizer'), '', __('Off' , 'optimizer')); ?></div><?php } ?>
                            </div>
                            <?php do_action('optimizer_after_single_meta'); ?>
                            <?php } ?>
                            
                         <!--META INFO END-->  
                         
                         
                         <?php if($optimizer['blog_layout_id'] == '3'){ ?>
                         	<div class="blog_content_wrap" <?php optimizer_schema_prop('content'); ?>><?php the_content(); ?></div>
                         <?php } else { ?>
							<div class="blog_content_wrap" <?php optimizer_schema_prop('content'); ?>><?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?></div>
						 <?php } ?>  
                        </div>
                    <!--POST CONTENT END-->
					<!--Read More Button-->
                    <div class="blog_mo"><a href="<?php the_permalink();?>">+ <?php _e('Read More', 'optimizer'); ?></a></div>
                    
                </div>
                <?php endwhile ?> 
                
                <?php wp_reset_postdata(); ?>
                </div><!--lay4_inner class END-->
            
            <!--PAGINATION START-->
                <div class="ast_pagenav">
                    <?php
                        global $the_query;
                        $big = 999999999; // need an unlikely integer
                            echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $the_query->max_num_pages,
                                'show_all'     => false,
                                'prev_next'    => false
                            
                            ) );
                    ?>
                </div>
            <!--PAGINATION END-->
            
            </div><!--lay4_wrap class END-->
            
        <!--SIDEBAR START-->
                <!--SIDEBAR START--> 
				<?php $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true); if (empty($hide_sidebar )){ ?>
                    <?php get_sidebar(); ?>
                <?php }?> 
                <!--SIDEBAR END--> 
        <!--SIDEBAR END-->
        
		</div><!--center class END-->
	  </div><!--lay4 class END-->
</div><!--layer_wrapper class END-->
<?php get_footer(); ?>