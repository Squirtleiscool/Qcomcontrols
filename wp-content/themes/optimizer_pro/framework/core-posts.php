<?php

function optimizer_posts($layout='1', $type='post', $count='6', $category=array(), $product_category='', $pages='', $previewbtn='2' , $linkbtn='1', $navigation='numbered', $sidebar=''){
?>
	<?php  
	if(!empty($category) && $type == 'post'){	$blogcat = $category;	$blogcats =implode(',', $blogcat);	}else{	$blogcats = '';	}
	if(!empty($pages) && $type == 'page'){		$optimpages = $pages;	}else{	$optimpages = '';	}
	if ( class_exists( 'WooCommerce' ) ) {		if(!empty($product_category) && $type == 'product'){	$prodcats = $product_category;	}else{	$prodcats = '';	}	}
	//AJAX DATA
	if(isset($_REQUEST['layout'])){			$layout = absint($_REQUEST['layout']);	}
	if(isset($_REQUEST['type'])){			$type = strip_tags($_REQUEST['type']);	}
	if(isset($_REQUEST['count'])){			$count = absint($_REQUEST['count']);	}
	if(isset($_REQUEST['category'])){		$blogcats = strip_tags($_REQUEST['category']);	}
	if(isset($_REQUEST['pages'])){			if(!empty($_REQUEST['pages'])){$optimpages = isset($_REQUEST['pages']) ? explode(',',$_REQUEST['pages']) : array();	}}
	if(isset($_REQUEST['previewbtn'])){		$previewbtn = strip_tags($_REQUEST['previewbtn']);	}
	if(isset($_REQUEST['linkbtn'])){		$linkbtn = absint($_REQUEST['linkbtn']);	}
	if(isset($_REQUEST['nextpage'])){		$currentpage = absint($_REQUEST['nextpage']);	}else{	$currentpage = 1;	}
	
	if(isset($_REQUEST['sidebar'])){		$sidebar = strip_tags($_REQUEST['sidebar']);	}
   
   //WPML for the Ajaxed Posts
   if (isset($_REQUEST['layout']) && class_exists('SitePress')) {
      global $sitepress;
      $current_lang = $sitepress->get_current_language();
      //$default_lang = $sitepress->get_default_language();
      $sitepress->switch_lang($current_lang);
   }

	//PRODUCT CATEGORY
	if(isset($_REQUEST['product_category'])){	
		if(!empty($_REQUEST['product_category'])){
			$prodcats = explode(',', $_REQUEST['product_category']);	
		}else{	
			$prodcats = get_terms(array( 'product_cat' ), array( 'fields' => 'ids' ));	
		} 
	}
	
		//THE QUERY
		if(is_category() || is_tag() || is_search() || is_author() || is_archive() ){
			global $wp_query;
			$widget_query = $wp_query;
		}else{
			if ( class_exists( 'WooCommerce' ) && !empty($prodcats) && $type == 'product' ) {	

				$args = array(
					'post_type' => $type,
					'post_status' => 'publish',
					'tax_query'     => array(
						array(
							'taxonomy'  => 'product_cat',
							'field'     => 'id', 
							'terms'     => $prodcats
						)
					),
					'post__in'=> $optimpages,
					'paged' => get_query_var( 'page', $currentpage ),
					'posts_per_page' => ''.$count.''
				);
			}else{
				
				$args = array(
					'post_type' => $type,
					'post_status' => 'publish',
					'cat' => ''.$blogcats.'',
					'post__in'=> $optimpages,
					'paged' => get_query_var( 'page', $currentpage ),
					'posts_per_page' => ''.$count.''
				);
				
			}
		$widget_query = new WP_Query( $args );
		}
	?>
    
    
	<!-- - - - - - - - - - - - - - - - - - - - LAYOUT 1 - - - - - - - - - - - - - - - - - - - -->
	<?php if($layout == '1') { ?>
            <div class="lay1_wrap <?php if(empty($linkbtn)) { ?>hide_img_hover<?php } ?>">
            	<div class="lay1_wrap_ajax">
            
				  <?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                  
                      <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                                 
       
                  <!--POST THUMBNAIL START-->
                      <div class="post_image">
                      
                      		<!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_inside_front_post_thumb' ); ?>
                                <?php } ?>
                      		<?php } ?> 
                            <!--Woocommerce Stuff END-->
                      
                      	<!--Post Image Hover-->
                          <div class="img_hover"></div>
                          
                          <!--CALL POST IMAGE-->
                          <?php if ( has_post_thumbnail() ) : ?>
                          
                          <div class="imgwrap">    
                              <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                              </div>                 
                          <a href="<?php the_permalink();?>"><?php the_post_thumbnail('optimizer_thumb'); ?></a>
                          </div>
                          
                          
                          <?php elseif(!optimizer_gallery_thumb() == ''): ?>
                          <div class="imgwrap">       
                              <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                              </div>            
                          <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a>		
                          </div>
                          
                          <?php elseif(!optimizer_first_image() == ''): ?>
                          <div class="imgwrap">       
                              <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                              </div>            
                          <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a>		
                          </div>
                          
                          <?php else : ?>
                          <div class="imgwrap">
							<div class="icon_wrap animated fadeInUp">
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                            </div>
                          <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" /></a></div>   
                                   
                          <?php endif; ?>
                          
                          <!--POST CONTENT-->
                          <div class="post_content">
                          <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                          <?php do_action( 'optimizer_after_layout1_content' ); ?>
                          <!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_after_front_post'); ?>
                                <?php } ?>
                      		<?php } ?>
                            <!--Woocommerce Stuff END-->
                          </h2>
                          </div>
                          
                      </div>
                    <!--POST THUMBNAIL END-->  

                      </div>
              <?php endwhile ?> 
				<?php wp_reset_postdata(); ?>
              <?php endif ?>
             </div><!--lay1_wrap_ajax END-->
            </div><!--lay1_wrap class END-->
            
             <!--Sidebar-->
               <?php if(!empty($sidebar) ) { ?>
                        <div id="sidebar" class="home_sidebar">
                            <div class="widgets">  
                                    <?php dynamic_sidebar( $sidebar ); ?>
                             </div>
                         </div>
               <?php } ?> 
            
	<?php } ?>
    
    
    
 	<!-- - - - - - - - - - - - - - - - - - - - LAYOUT 2 - - - - - - - - - - - - - - - - - - - -->
	<?php if($layout == '2') { ?>
      
		<div class="lay2_wrap <?php if($sidebar =='no_sidebar' || empty($sidebar)){ echo 'widgt_no_sidebar'; }else{ echo 'widgt_has_sidebar'; } ?>  <?php if(empty($linkbtn)) { ?>hide_img_hover<?php } ?>">
            	<div class="lay2_wrap_ajax">
            
				<?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
            
 
            <!--POST THUMBNAIL START-->
                <div class="post_image">
                
                      		<!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_inside_front_post_thumb' ); ?>
                                <?php } ?>
                      		<?php } ?> 
                            <!--Woocommerce Stuff END-->
                            
                     <!--CALL TO POST IMAGE-->
                    <?php if ( has_post_thumbnail() ) : ?>
                    
                    <div class="imgwrap">  
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                    
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                    
                    <?php elseif(!optimizer_gallery_thumb() == ''): ?>
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a></div>
                    
                    <?php elseif(!optimizer_first_image() == ''): ?>
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                    <?php else : ?>
                    
                    <div class="imgwrap">
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" /></a></div>   
                             
                    <?php endif; ?>
                    <div class="post_content">
                    <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                     <?php do_action( 'optimizer_before_layout2_content' ); ?>
					 <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?> 
                     <?php do_action( 'optimizer_after_layout2_content' ); ?>
                          <!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_after_front_post'); ?>
                                <?php } ?>
                      		<?php } ?>
                            <!--Woocommerce Stuff END-->
                            
                    </div>
                </div>
           <!--POST THUMBNAIL END-->     

                
            </div>
            <?php endwhile ?> 
				<?php wp_reset_postdata(); ?>
            <?php endif ?>
            </div><!--lay2_wrap_ajax END-->
		</div><!--lay2_wrap class end-->
             <!--Sidebar-->
               <?php if(!empty($sidebar) ) { ?>
                        <div id="sidebar" class="home_sidebar">
                            <div class="widgets">  
                                    <?php dynamic_sidebar( $sidebar ); ?>
                             </div>
                         </div>
               <?php } ?>
        
	<?php } ?>
    
    
    
 	<!-- - - - - - - - - - - - - - - - - - - - LAYOUT 3 - - - - - - - - - - - - - - - - - - - -->
	<?php if($layout == '3') { ?> 

		<div class="lay3_wrap <?php if($sidebar =='no_sidebar' || empty($sidebar)){ echo 'widgt_no_sidebar'; }else{ echo 'widgt_has_sidebar'; } ?> <?php if(empty($linkbtn)) { ?>hide_img_hover<?php } ?>">
			<div class="lay3_wrap_ajax">
				  <?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                  <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                            
   
              <!--POST THUMBNAIL START-->
                  <div class="post_image">
                  
                      		<!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_inside_front_post_thumb' ); ?>
                                <?php } ?>
                      		<?php } ?> 
                            <!--Woocommerce Stuff END-->
                            
                            
                     <!--CALL TO POST IMAGE-->
                    <?php if ( has_post_thumbnail() ) : ?>
                    
                    <div class="imgwrap">  
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                    
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                    
                    <?php elseif(!optimizer_gallery_thumb() == ''): ?>
       
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a></div>
                    
                    
                    <?php elseif(!optimizer_first_image() == ''): ?>
                    <div class="imgwrap"> 
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="imgzoom" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" title="<?php echo _e('Preview','optimizer'); ?>" data-title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>                     
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                    <?php else : ?>
                    
                    <div class="imgwrap">
                    <div class="img_hover">
                        <div class="icon_wrap animated fadeInUp">
                              	<?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                        </div>
                    </div>
                    <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" /></a></div>   
                             
                    <?php endif; ?>
                </div>
			<!--POST THUMBNAIL END-->

                  
                  <!--POST CONTENT END-->
                      <div class="post_content">
                          <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                           <?php do_action( 'optimizer_before_layout3_content' ); ?>
						   <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?> 
                           <?php do_action( 'optimizer_after_layout3_content' ); ?>
                     
                          <!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_after_front_post' ); ?>
                                <?php } ?>
                      		<?php } ?>
                            <!--Woocommerce Stuff END-->
                             
                      </div>
                  <!--POST CONTENT END-->

               </div>
              <?php endwhile ?> 
  
              <?php endif; ?>
            </div><!--lay3_ajax_warp END-->
            </div><!--lay3_wrap END-->
             <!--Sidebar-->
               <?php if(!empty($sidebar) ) { ?>
                        <div id="sidebar" class="home_sidebar">
                            <div class="widgets">  
                                    <?php dynamic_sidebar( $sidebar ); ?>
                             </div>
                         </div>
               <?php } ?>
    
	<?php } ?>
    
        
    
	<!-- - - - - - - - - - - - - - - - - - - - LAYOUT 4 - - - - - - - - - - - - - - - - - - - -->
	<?php if($layout == '4') { ?>
    <div class="lay4pagifix>">
		<div class="lay4_wrap <?php if($sidebar !=='no_sidebar'  ) { echo 'widgt_has_sidebar'; }else{ echo 'widgt_no_sidebar';} ?>">
			<div class="lay4_wrap_ajax">
                <div class="lay4_inner">
					<?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 

                <!--POST THUMBNAIL START-->
                        <div class="post_image">
                        
                      		<!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_inside_front_post_thumb' ); ?>
                                <?php } ?>
                      		<?php } ?> 
                            <!--Woocommerce Stuff END-->
                            
                             <!--CALL TO POST IMAGE-->
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
                            
                            
                            <?php elseif(!optimizer_gallery_thumb() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" /></a></div>
                            
                            
                            <?php elseif(!optimizer_first_image() == ''): ?>
            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" /></a></div>
                        
                            <?php else : ?>
                            
                            <div class="imgwrap">
                            <a href="<?php the_permalink();?>" aria-label="<?php echo _e('Read More','optimizer'); ?>"><img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="optimizer_thumbnail" width="500" height="350" /></a></div>   
                                     
                            <?php endif; ?>
                        </div>
                 <!--POST THUMBNAIL END-->

                    <!--POST CONTENT START-->
                        <div class="post_content">
                            <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            
                         <!--META INFO START-->   
                            <div class="single_metainfo">
                            	<!--DATE-->
                                <i class="fa-calendar"></i><a class="comm_date"><?php the_time( get_option('date_format') ); ?></a>
                                <!--AUTHOR-->
                                <i class="fa-user"></i><?php global $authordata; $post_author = "<a class='auth_meta' href=\"".get_author_posts_url( $authordata->ID, $authordata->user_nicename )."\">".get_the_author()."</a>\r\n"; echo $post_author; ?>
                                <!--COMMENTS COUNT-->
                                <i class="fa-comments"></i><?php if (!empty($post->post_password)) { ?>
                            <?php } else { ?><div class="meta_comm"><?php comments_popup_link( __('0 Comment', 'optimizer'), __('1 Comment', 'optimizer'), __('% Comments', 'optimizer'), '', __('Off' , 'optimizer')); ?></div><?php } ?>
                            	<!--CATEGORY-->
                              	<i class="fa-th-list"></i><div class="catag_list"><?php the_category(', '); ?></div>
                            </div>
                         <!--META INFO START-->  
                         	<?php do_action( 'optimizer_before_layout4_content' ); ?>
                            <?php optimizer_excerpt('optimizer_excerptlength_teaser', 'optimizer_excerptmore'); ?>
                            <?php do_action( 'optimizer_after_layout4_content' ); ?>
                           
                          <!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_after_front_post' ); ?>
                                <?php } ?>
                      		<?php } ?>
                            <!--Woocommerce Stuff END-->
                            
                        </div>
                    <!--POST CONTENT END-->
					<!--Read More Button-->
                    <div class="blog_mo"><a href="<?php the_permalink();?>">+ <?php _e('Read More', 'optimizer'); ?></a></div>
                    
                </div>
                <?php endwhile ?> 
    				<?php wp_reset_postdata(); ?>
                <?php endif ?>
                </div><!--lay4_inner class END-->
            
            </div><!--lay4_wrap_ajax class END-->
    	</div><!--lay4_wrap class END-->

             <!--Sidebar-->
               <?php if(!empty($sidebar) ) { ?>
                        <div id="sidebar" class="home_sidebar">
                            <div class="widgets">  
                                    <?php dynamic_sidebar( $sidebar ); ?>
                             </div>
                         </div>
               <?php } ?>
               
             
     		<?php /*LOAD THE PAGINATION INSIDE LAYOUT4 */?> 
            <?php if(isset($_REQUEST['nextpage'])){		exit();		} ?>
			<?php optimizer_pagination($navigation, $widget_query); ?>
            
       </div>
            


                
	<?php } ?>   
    
    
    
    
 	<!-- - - - - - - - - - - - - - - - - - - - LAYOUT 5 - - - - - - - - - - - - - - - - - - - -->
	<?php if($layout == '5') { ?>


		<div class="single_wrap <?php if($sidebar !=='no_sidebar'  ) { echo 'widgt_has_sidebar'; }else{ echo 'widgt_no_sidebar';} ?>">
			<div class="lay5_wrap">
				<div class="lay5_wrap_ajax">
                        <?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                			<div class="single_post">

           <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                    
                        
                    <!--EDIT BUTTON START-->
						<?php if ( is_user_logged_in() && is_admin() ) { ?>
                            <div class="edit_wrap"><a href="<?php echo get_edit_post_link(); ?>"><?php _e('Edit','optimizer'); ?></a></div>
                        <?php } ?>
    				<!--EDIT BUTTON END-->
                    
                    <?php if($type == 'post') { ?>
                        <!--FEATURED IMAGE-->
                        <?php if ((!empty ($optimizer['single_featured']) && has_post_thumbnail())  || is_customize_preview()) { ?>
                                <div class="single_featured <?php if (empty($optimizer['single_featured'])){ echo 'hide_featuredimg'; }?>"><?php the_post_thumbnail('full'); ?></div>
                        <?php } ?>
                        <!--FEATURED IMAGE END-->
                      <?php } ?>   
                    
                      <!--Woocommerce Stuff-->
                      <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                         <?php if($type == 'product') { ?>
                          <?php if ( has_post_thumbnail() ) { ?>
                            <div class="imgwrap">
                            
								<?php do_action( 'optimizer_inside_front_post_thumb' ); ?>
                            
                            	<a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a>
                            </div>
                          <?php } ?>
                       <?php } ?>   
                    <?php } ?>
                    <!--Woocommerce Stuff END-->
                    
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
                                	<?php do_action( 'optimizer_before_layout5_content' ); ?>
									<?php the_content(); ?>
                                    <?php do_action( 'optimizer_after_layout5_content' ); ?>
                                </div>
                                	<div style="clear:both"></div>
                                <div class="thn_post_wrap">
									<?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                </div>
                            <!--POST CONTENT END-->
                            
                            
                           
                          <!--Woocommerce Stuff-->
                          	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                            	<?php if($type == 'product') { ?>
                                	<?php do_action( 'optimizer_after_front_post' ); ?>
                                <?php } ?>
                      		<?php } ?>
                            <!--Woocommerce Stuff END-->
                            
                            
                            
                            <!--POST FOOTER START-->
                                <div class="post_foot"><div class="post_meta">
										 <?php if( has_tag() ) { ?>
                                             <div class="post_tag"><div class="tag_list">
											 <?php if(get_the_tag_list()) {echo get_the_tag_list('<ul><li><i class="fa-tag"></i>','</li><li><i class="fa-tag"></i>','</li></ul>');} ?>
                                             </div></div>
                                         <?php } ?>
								</div></div>
                           <!--POST FOOTER END-->
                            
                        </div>
                    <!--POST END-->
                    </div>
            
			</div><!--single_post class END--> 
			<?php endwhile ?>
				<?php wp_reset_postdata(); ?> 
            <?php endif ?>
                
            </div><!--lay5_wrap_ajax class END--> 
     </div><!--lay5_wrap class END-->
               
             
     		<?php /*LOAD THE PAGINATION INSIDE LAYOUT4 */?> 
            <?php if(isset($_REQUEST['nextpage'])){		exit();		} ?>
			<?php optimizer_pagination($navigation, $widget_query); ?>
            
       </div>
       
     

             <!--Sidebar-->
               <?php if(!empty($sidebar) ) { ?>
                        <div id="sidebar" class="home_sidebar">
                            <div class="widgets">  
                                    <?php dynamic_sidebar( $sidebar ); ?>
                             </div>
                         </div>
               <?php } ?>
    
	<?php } ?> 
    

<?php if(isset($_REQUEST['nextpage'])){		exit();		} ?>


		<?php if($layout == '1' || $layout == '2' || $layout == '3') { optimizer_pagination($navigation, $widget_query); } ?>
		<?php 			
			if(is_category() || is_tag() || is_search() || is_author() || is_archive() ){}else{		
			//REGISTER and ENQUEUE AJAX PAGINATION SCRIPT
			wp_register_script( 'optimizer-pagination',get_template_directory_uri().'/assets/js/pagination.js', array('jquery'), true);
			// Localize the script with new data
			$pagiajax = array(
				'ajaxurl' => admin_url('admin-ajax.php'),
			);
			wp_localize_script( 'optimizer-pagination', 'postsq', $pagiajax );
			wp_enqueue_script( 'optimizer-pagination' );
			}
		?>

<?php } ?>
<?php
add_action('wp_ajax_nopriv_optimizer_posts', 'optimizer_posts');
add_action('wp_ajax_optimizer_posts', 'optimizer_posts'); ?>