<?php 
/**
 * The Individual Page Header Function for LayerFramework
 *
 * Displays the page header on pages.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;
$headAlign = !empty($optimizer['page_header_align']) ? $optimizer['page_header_align'] : 'center';
$headAlignMeta = get_post_meta( $post->ID, 'page_head_align', true );
if($headAlignMeta){   $headAlign = $headAlignMeta ;}

?>
<?php do_action('optimizer_before_pageheader'); ?>
<?php if(!empty($optimizer['pageheader_switch'])   || is_customize_preview()  ){ ?>
   <?php if (is_single() || is_page()) {?>
   
   <?php $imgbg = get_post_meta( $post->ID, 'page_head', true ); ?>
	<!--Header for PAGE & POST-->
      <div class="page_head<?php if(!empty($optimizer['page_header_image']['url']) || !empty($imgbg['url'])){ ?> has_header_img<?php } ?> <?php if(!empty($optimizer['hide_mob_page_header'])) { ?> hide_mob_headerimg<?php } ?><?php if(empty($optimizer['pageheader_switch'])){ ?> hide_page_head<?php } ?>">
      
      <!--Load the Header Image-->
          <?php if(!empty($imgbg['url'])){ ?>
          	<img class="pageheadimg" src="<?php echo $imgbg['url'];?>" <?php echo optimizer_image_attr( esc_url($imgbg['url']) ); ?> <?php echo optimizer_image_alt(esc_url($imgbg['url']) ); ?> />
          <?php }elseif(!empty($optimizer['page_header_image']['url'])){ ?>
          	<img src="<?php echo $optimizer['page_header_image']['url'];?>" <?php echo optimizer_image_attr( esc_url($optimizer['page_header_image']['url']) ); ?> <?php echo optimizer_image_alt(esc_url($optimizer['page_header_image']['url']) ); ?> />
          <?php } ?>
      
      <!--The Page Title -->
          <div class="pagetitle_wrap page_head_<?php echo $headAlign; ?>">
              <?php $hide_sidebar = get_post_meta($post->ID, 'hide_page_title', true); if (empty($hide_sidebar)){ ?>
					<h1 class="postitle"><?php the_title(); ?></h1>
              <?php } ?>
				  <?php if(!empty($optimizer['breadcrumbs_id']) || is_customize_preview()){ ?>
                      <div class="layerbread <?php if(empty($optimizer['breadcrumbs_id'])){ echo 'hide_breadcrumbs'; } ?>">
					  	<?php echo breadcrumb_trail(array( 'show_browse'=> false, 'labels' => array('home' => __( 'Home', 'optimizer') ) )); ?>
                      </div>
                  <?php } ?>
                  <?php do_action('optimizer_pageheader_desc'); ?>
          </div>
          
      </div>
      <!--page_head class END-->
       <?php } ?>
      
      
      <?php if (is_category() || is_tax( 'portfolio_category' ) || is_tax( 'jetpack-portfolio-type' ) || is_post_type_archive( 'portfolio' ) || is_post_type_archive( 'jetpack-portfolio' ) ) {?>
      <!--Header for CATEGORY-->
      <div class="page_head<?php if(!category_description( )) { ?> has_cat_desc<?php } ?><?php if(!empty($optimizer['page_header_image']['url']) || wpds_tax_pic_url()){ ?> has_header_img<?php } ?> <?php if(!empty($optimizer['hide_mob_page_header'])) { ?> hide_mob_headerimg<?php } ?><?php if(empty($optimizer['pageheader_switch'])){ ?> hide_page_head<?php } ?>">
      
      <!--Load the Header Image-->
		<?php if(wpds_tax_pic_url()){ ?>
  			<img class="custom_pagehead" src="<?php echo wpds_tax_pic_url(); ?>" <?php echo optimizer_image_attr( esc_url(wpds_tax_pic_url()) ); ?> <?php echo optimizer_image_alt( esc_url(wpds_tax_pic_url()) ); ?> />
		<?php }elseif(!empty($optimizer['page_header_image']['url'])){ ?>
      		<img class="def_pagehead" src="<?php echo $optimizer['page_header_image']['url'];?>" <?php echo optimizer_image_attr( esc_url($optimizer['page_header_image']['url']) ); ?> <?php echo optimizer_image_alt( esc_url($optimizer['page_header_image']['url']) ); ?> />
      	<?php } ?>
      
      <!--The Page Title -->
          <div class="pagetitle_wrap">
              <h1 class="postitle"><?php single_cat_title( '', true ); ?></h1>
				  <?php if(!empty($optimizer['breadcrumbs_id']) || is_customize_preview()){ ?>
                      <div class="layerbread <?php if(empty($optimizer['breadcrumbs_id'])){ echo 'hide_breadcrumbs'; } ?>">
					  	<?php echo breadcrumb_trail(array( 'show_browse'=> false, 'labels' => array('home' => __( 'Home', 'optimizer') ) )); ?>
                      </div>
                  <?php } ?>
               <?php echo category_description( ); ?> 
          </div>
          
      </div>
      <!--page_head class END-->
      <?php } ?>
	  
      
      <?php if (is_tag()) {?>
      <!--Header for TAGS-->
      <div class="page_head<?php if(!tag_description( )) { ?> has_tag_desc<?php } ?><?php if(!empty($optimizer['page_header_image']['url']) || wpds_tax_pic_url()){ ?> has_header_img<?php } ?> <?php if(!empty($optimizer['hide_mob_page_header'])) { ?> hide_mob_headerimg<?php } ?><?php if(empty($optimizer['pageheader_switch']) || is_customize_preview()){ ?> hide_page_head<?php } ?>">
      
      <!--Load the Header Image-->
		<?php if(wpds_tax_pic_url()){ ?>
  			<img class="custom_pagehead" src="<?php echo wpds_tax_pic_url(); ?>" <?php echo optimizer_image_attr( esc_url(wpds_tax_pic_url()) ); ?> <?php echo optimizer_image_alt( esc_url(wpds_tax_pic_url()) ); ?> />
		<?php }elseif(!empty($optimizer['page_header_image']['url'])){ ?>
      		<img class="def_pagehead" src="<?php echo $optimizer['page_header_image']['url'];?>" <?php echo optimizer_image_attr( esc_url($optimizer['page_header_image']['url']) ); ?> <?php echo optimizer_image_alt( esc_url($optimizer['page_header_image']['url']) ); ?> />
      	<?php } ?>
        
      
      <!--The Page Title -->
          <div class="pagetitle_wrap">
              <h1 class="postitle"><?php single_tag_title( '', true ); ?></h1>
				  <?php if(!empty($optimizer['breadcrumbs_id']) || is_customize_preview()){ ?>
                      <div class="layerbread <?php if(empty($optimizer['breadcrumbs_id'])){ echo 'hide_breadcrumbs'; } ?>">
					  	<?php echo breadcrumb_trail(array( 'show_browse'=> false, 'labels' => array('home' => __( 'Home', 'optimizer') ) )); ?>
                      </div>
                  <?php } ?>
               <?php echo tag_description( ); ?>  
          </div>
          
      </div>
      <!--page_head class END-->
      <?php } ?>
      
      
	  <?php if ( class_exists( 'WooCommerce' ) ) { //If Wooceommerce  ?>
		  <?php if ('product' == get_post_type()) {?>
          <!--If woocommerce Shop Page Display the page header image from the shop page-->
          <?php 
		  $imgbg = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_head', true );
		  
		  
		   ?>
          <!--Header for TAGS-->
          <div class="page_head<?php if(!category_description( )) { ?> has_cat_desc<?php } ?><?php if(!empty($optimizer['page_header_image']['url']) || wpds_tax_pic_url() || !empty($imgbg)){ ?> has_header_img<?php } ?> <?php if(!empty($optimizer['hide_mob_page_header'])) { ?> hide_mob_headerimg<?php } ?><?php if(empty($optimizer['pageheader_switch']) || is_customize_preview()){ ?> hide_page_head<?php } ?> woopagehead">
          
      <!--Load the Header Image-->
		<?php if(wpds_tax_pic_url()){ ?>
  			<img class="custom_pagehead" src="<?php echo wpds_tax_pic_url(); ?>" <?php echo optimizer_image_attr( esc_url(wpds_tax_pic_url()) ); ?> <?php echo optimizer_image_alt( esc_url(wpds_tax_pic_url()) ); ?> />
		<?php }elseif(!empty($imgbg)){ ?>
      		<img class="def_pagehead" src="<?php echo $imgbg['url'];?>" <?php echo optimizer_image_alt( esc_url($imgbg['url']) ); ?> <?php echo optimizer_image_attr( esc_url($imgbg['url']) ); ?> />
      	<?php }elseif(!empty($optimizer['page_header_image']['url'])){ ?>
        	<img class="def_pagehead" src="<?php echo $optimizer['page_header_image']['url'];?>" <?php echo optimizer_image_attr( esc_url($optimizer['page_header_image']['url']) ); ?> <?php echo optimizer_image_alt( esc_url($optimizer['page_header_image']['url']) ); ?> />
        <?php } ?>
        
        
          <!--The Page Title -->
              <div class="pagetitle_wrap">
                  <h1 class="postitle"><?php echo woocommerce_page_title( '', true ); ?></h1> 
				  <?php if(!empty($optimizer['breadcrumbs_id'])){ ?>
                          <div class="layerbread"><?php woocommerce_breadcrumb(); ?></div>
                  <?php } ?>
                  <?php if(!category_description( )) { ?><?php echo category_description( ); ?><?php } ?>
              </div>
          </div>
          <!--page_head class END-->
          <?php } ?>
	  <?php } ?>
	  
<?php } ?>
<?php do_action('optimizer_after_pageheader'); ?>