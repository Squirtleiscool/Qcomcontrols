<?php
if(!function_exists( 'optimizer_portfolio_layouts' ) ){
function optimizer_portfolio_layouts($layout='1', $count='6', $hover='1', $category='',$previewbtn='2' , $linkbtn='1'){
?>

<?php if(function_exists('portfolio_post_type_init') || ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) ){ ?>
	<?php  
	if(function_exists('portfolio_post_type_init')){
			$type= 'portfolio';  $taxonomy= 'portfolio_category'; 
	}elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ){
			$type= 'jetpack-portfolio';  $taxonomy= 'jetpack-portfolio-type';
	}else{  $type= 'post';}
	
	if(!empty($category)){	
		$blogcats = array(array('taxonomy' => $taxonomy, 'field'=> 'term_id', 'terms'=> $category ),);	
	}else{	
		$blogcats = '';	
	}
	
	//AJAX DATA
	if(isset($_REQUEST['layout'])){			$layout = absint($_REQUEST['layout']);	}
	if(isset($_REQUEST['type'])){			$type = strip_tags($_REQUEST['type']);	}
	if(isset($_REQUEST['count'])){			$count = absint($_REQUEST['count']);	}
	if(isset($_REQUEST['hover'])){			$hover = absint($_REQUEST['hover']);	}
	if(isset($_REQUEST['category'])){		$blogcats = strip_tags($_REQUEST['category']);	}
	if(isset($_REQUEST['previewbtn'])){		$previewbtn = strip_tags($_REQUEST['previewbtn']);	}
	if(isset($_REQUEST['linkbtn'])){		$linkbtn = absint($_REQUEST['linkbtn']);	}
	if(isset($_REQUEST['nextpage'])){		$currentpage = absint($_REQUEST['nextpage']);	}else{	$currentpage = 1;	}
	
	
	
		//THE QUERY
		if(is_category() || is_tag() || is_search() || is_author() || is_archive() ){
			global $wp_query;
			$widget_query = $wp_query;
		}else{
		$args = array(
			'post_type' => $type,
			'post_status' => 'publish',
			'tax_query' => $blogcats,
			'paged' => get_query_var( 'page', $currentpage ),
			'posts_per_page' => $count);
		$widget_query = new WP_Query( $args );
		}
	?>
    
    
	<!-----------------------------------LAYOUT 1-------------------------------------------->
            <?php if(empty($category)){ ?>
                <ul class="portfolio_nav">
                	<li class="portcat_all <?php if(!is_archive() || is_post_type_archive()){ echo 'active_port_cat';}?>"><a href="<?php echo get_post_type_archive_link( $type ); ?>"><?php _e('All','optimizer'); ?></a></li>
                    <?php wp_list_categories(array('taxonomy'=> $taxonomy,'title_li'=> '')); ?>
                </ul>
            <?php } ?>
    <div class="<?php if($layout =='3' || $layout=='4'){ echo 'lay3'; }else{ echo 'portlay1'; }?> portfolio_wrap port_layout_<?php echo $layout; ?>">
            <div class="lay1_wrap hover_style_<?php echo $hover; ?> <?php if(empty($linkbtn)) { ?>hide_portfolio_link<?php } ?> <?php if(empty($previewbtn)) { ?>hide_portfolio_preview<?php } ?>">

            	<div class="lay1_wrap_ajax">
            
				  <?php if($widget_query->have_posts()): ?><?php while($widget_query->have_posts()): ?><?php $widget_query->the_post(); ?>
                  
                      <div <?php post_class('matched_port'); ?> id="portfolio-<?php the_ID(); ?>" data-excerpt="<?php echo strip_tags(get_the_excerpt()); ?>" data-image="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full'); echo $image[0]; ?>" data-moretxt="<?php _e('Details','optimizer'); ?>" data-cats="<?php $categories = get_the_terms(get_the_ID(), $taxonomy); if ( ! empty( $categories ) ) { foreach( $categories as $category ) {  echo 'cat-item-' .$category->term_id.','; } }?>"> 
         
       
                  <!--POST THUMBNAIL START-->
                      <div class="post_image hoverxx_style_<?php echo $hover; ?>">

                          <!--CALL POST IMAGE-->
                          <?php if ( has_post_thumbnail() ) : ?>
                          
                          <div class="imgwrap">    
                              <div class="icon_wrap animated <?php if ($hover == '1' || $hover == '3'){echo 'fadeInUp';}else{echo 'fadeInDown';}?>">
                              <?php if(!empty($previewbtn) ) { ?>
                                	<a class="port_preview" title="<?php echo _e('Preview','optimizer'); ?>"><i class="fa fa-search"></i></a>
                                <?php } ?>
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a class="port_link" href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                              </div>                 
                          <a href="<?php the_permalink();?>">
                          	<!--Post Image Hover-->
                          	<div class="img_hover"></div>
						  	<?php if($layout =='3' || $layout=='4'){ 
						  			the_post_thumbnail('medium');
						   		}else{
							   		the_post_thumbnail('optimizer_thumb');
							} ?>
                          </a>
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
                          <a href="<?php the_permalink();?>">
                          	<!--Post Image Hover-->
                          	<div class="img_hover"></div>
                          <img alt="<?php the_title(); ?>" src="<?php echo optimizer_gallery_thumb('optimizer_thumb'); ?>" />
                          </a>		
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
                          <a href="<?php the_permalink();?>">
                          	<!--Post Image Hover-->
                          	<div class="img_hover"></div>
                          <img alt="<?php the_title(); ?>" src="<?php echo optimizer_first_image('optimizer_thumb'); ?>" />
                          </a>		
                          </div>
                          
                          <?php else : ?>
                          <div class="imgwrap">
							<div class="icon_wrap animated fadeInUp">
                                <?php if(!empty($linkbtn) ) { ?>
                              		<a href="<?php the_permalink();?>" title="<?php echo _e('Read More','optimizer'); ?>"><i class="fa fa-plus"></i></a>
                                <?php } ?>
                            </div>
                          <a href="<?php the_permalink();?>">
                          	<!--Post Image Hover-->
                          	<div class="img_hover"></div>
                          <img src="<?php echo optimizer_placeholder_image();?>" alt="<?php the_title_attribute(); ?>" class="thn_thumbnail" width="500" height="350" />
                          </a>
                          </div>   
                                   
                          <?php endif; ?>
                          
                          <!--POST CONTENT-->
                          <div class="post_content">
                          
                                
                                <?php if($hover =='1' || $hover =='2' || $hover =='3' || $hover =='4'){ ?>
                                <!--portfolio_category -->
                                    <?php 
                                    if(function_exists('portfolio_post_type_init')){
                                        $taxonomy= 'portfolio_category'; 
                                    }elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ){
                                        $taxonomy= 'jetpack-portfolio-type'; 
                                     }else{ $taxonomy ='';}?>
                                    
                                    <div class="catag_list"><?php the_terms( get_the_ID(), $taxonomy, '', ' / ' ); ?></div>
                                <!--portfolio_category END -->    
                          		<?php } ?>
                          <h2 class="postitle"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                          
                                <?php if($hover =='5'){ ?>
                                <!--portfolio_category -->
                                    <?php 
                                    if(function_exists('portfolio_post_type_init')){
                                        $taxonomy= 'portfolio_category'; 
                                    }elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ){
                                        $taxonomy= 'jetpack-portfolio-type'; 
                                     }else{ $taxonomy ='';}?>
                                    
                                    <div class="catag_list"><?php the_terms( get_the_ID(), $taxonomy, '', ' / ' ); ?></div>
                                <!--portfolio_category END -->    
                          		<?php } ?>
                          <?php do_action( 'optimizer_portfolio_content' ); ?>
                          </div>
                          
                      </div>
                    <!--POST THUMBNAIL END-->  

                      </div>
              <?php endwhile ?> 
				<?php wp_reset_postdata(); ?>
              <?php endif ?>
             </div><!--lay1_wrap_ajax END-->
            </div><!--lay1_wrap class END-->
            
	</div>

    
    
<?php if(isset($_REQUEST['nextpage'])){		exit();		} ?>


		<?php $navigation = 'infscroll'; optimizer_pagination($navigation, $widget_query);  ?>
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

<?php }//If Portfolio Plugin Exist END ?>
<?php } 

}?>
<?php
add_action('wp_ajax_nopriv_optimizer_portfolio_layouts', 'optimizer_portfolio_layouts');
add_action('wp_ajax_optimizer_portfolio_layouts', 'optimizer_portfolio_layouts'); ?>