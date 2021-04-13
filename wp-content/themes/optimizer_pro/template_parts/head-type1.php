<?php 
/**
 * Header type 1 for LayerFramework
 *
 * Displays The Header type 1. This file is imported in header.php
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<!--HEADER STARTS-->
    <div class="header <?php echo $optimizer['logo_position']; ?> has_mobile_<?php echo $optimizer['mobile_menu_type']; ?> <?php if (!empty ($optimizer['headsearch_id'])) { ?> headsearch_on<?php } ?>" <?php optimizer_schema_item_type('header'); ?>>
    
    
    <!--TOP HEADER-->
    <?php if (!empty ($optimizer['tophead_id']) || is_customize_preview()) { ?>
    
    <div class="head_top<?php if (!empty ($optimizer['topsearch_id'])) { ?> topsearch_on<?php } ?><?php if (empty ($optimizer['topmenu_switch'])) { ?> topmenu_switch<?php } ?> <?php if (!empty ($optimizer['tophone_id'])) { ?>tophone_on<?php } ?> <?php if (empty ($optimizer['tophead_id'])) { ?>hide_topbar<?php } ?> <?php if (empty ($optimizer['topmenu_id'])) { ?>hide_topmenu<?php } ?>">
    
        <div class="center">
        	<?php if ($optimizer['logo_position'] == 'topbarlogo' || is_customize_preview()) { ?>
            	<?php if(!empty($optimizer['hide_sitett'])){ $hidelogo='hide_sitetitle'; }else{ $hidelogo=''; } ?>
            	<?php if(!empty($optimizer['hide_tagline'])){ $hidedesc='hide_sitetagline'; }else{ $hidedesc=''; } ?>
            	<div class="logo <?php echo $hidelogo.' '.$hidedesc; ?>">
                    <?php if(!empty($optimizer['home_logo_id']['url']) && is_front_page()  ){   ?>
                        	<a class="logoimga" title="<?php bloginfo('name') ;?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $logo = $optimizer['home_logo_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" class="<?php if(!empty($optimizer['logo_image_id']['url']) && !empty($optimizer['head_sticky'])){   ?> has_sticky_logo home_logo<?php } ?>" /><?php if(!empty($optimizer['logo_image_id']['url']) && (!empty($optimizer['head_sticky']) || is_front_page())){ ?><img class="sticky_logo" src="<?php $logo = $optimizer['logo_image_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" <?php echo optimizer_image_attr( esc_url($optimizer['logo_image_id']['url']) ); ?> /><?php } ?></a>
                    <?php }elseif(!empty($optimizer['logo_image_id']['url'])){   ?>
                        <a class="logoimga" title="<?php bloginfo('name') ;?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $logo = $optimizer['logo_image_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" <?php echo optimizer_image_attr( esc_url($optimizer['logo_image_id']['url']) ); ?> /></a>
                        <?php do_action('optimizer_after_logo'); ?>
                        <span class="desc logoimg_desc"><?php echo bloginfo('description'); ?></span>
                    <?php }else{ ?>
                    		<?php do_action('optimizer_before_site_title'); ?>
								<?php if ( is_front_page() ) { ?>   
                                    <h1><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo('name'); ?></a></h1>
                                    <span class="desc"><?php echo bloginfo('description'); ?></span>
                                <?php }else{ ?>
                                    <h2><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo('name'); ?></a></h2>
                                    <span class="desc"><?php echo bloginfo('description'); ?></span>
                                <?php } ?>
                    		<?php do_action('optimizer_after_site_title'); ?>
                    <?php } ?>
                </div>
            <?php } ?>
        
        	<?php if (!empty ($optimizer['topmenu_id']) || is_customize_preview()) { ?>
            	<div id="topbar_menu" class="<?php if( $optimizer['mobile_menu_topbar'] == 'hamburger'){ echo 'topham'; }?>" <?php optimizer_schema_item_type('menu'); ?>>
				<?php wp_nav_menu( array( 'container_class' => 'menu-topheader', 'theme_location' => 'topbar') ); ?>
                </div>
                <?php if( $optimizer['mobile_menu_topbar'] == 'hamburger'){ ?><a id="topbar-hamburger-menu" class="topmenu_hamburger" href="#sidr"><i class="fa fa-bars"></i></a><?php } ?>
            <?php } ?>
            <?php do_action('optimizer_before_topbar'); ?>
            
            <div id="topbar_right">
              <div class="head_phone"><i class="fa fa-phone"></i> <span><?php if (!empty ($optimizer['tophone_id'])) echo do_shortcode($optimizer['tophone_id']); ?></span></div>
			  <div class="top_head_soc"><?php if ($optimizer['social_bookmark_pos'] == 'topbar' || $optimizer['social_bookmark_pos'] == 'topfoot' || is_customize_preview()) { ?><?php get_template_part('framework/core','social'); ?><?php } ?></div>
              
              <!--TOPBAR SEARCH-->
                <div class="head_search">
                    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" >
                        <input placeholder="<?php _e( 'Search...', 'optimizer' ); ?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="topbar_s" />
                    </form>
                    <i class="fa fa-search"></i>
                </div>
                
                <?php do_action('optimizer_after_topbar'); ?>
              
            </div>
			
        </div>
    </div>
    
    <?php } ?>
    <!--TOP HEADER END-->
    <?php do_action('optimizer_between_header'); ?>
    
    
        <div class="center">
            <div class="head_inner">
            <!--LOGO START-->
            <?php if(!empty($optimizer['hide_sitett'])){ $hidelogo='hide_sitetitle'; }else{ $hidelogo=''; } ?>
            <?php if(!empty($optimizer['hide_tagline'])){ $hidedesc='hide_sitetagline'; }else{ $hidedesc=''; } ?>
            <?php if ($optimizer['logo_position'] !== 'topbarlogo' || is_customize_preview()) { ?>
                <div class="logo <?php echo $hidelogo.' '.$hidedesc; ?>">
                	
					<?php if(!empty($optimizer['home_logo_id']['url']) && is_front_page()  ){   ?>
                        	
                            <a class="logoimga" title="<?php bloginfo('name') ;?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $logo = $optimizer['home_logo_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" class="<?php if(!empty($optimizer['logo_image_id']['url']) && !empty($optimizer['head_sticky'])){   ?> has_sticky_logo home_logo<?php } ?>" /><?php if(!empty($optimizer['logo_image_id']['url']) && (!empty($optimizer['head_sticky']) || is_front_page())){   ?><img class="sticky_logo" src="<?php $logo = $optimizer['logo_image_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" <?php echo optimizer_image_attr( esc_url($optimizer['logo_image_id']['url']) ); ?> /><?php } ?></a>
                    		<span class="desc logoimg_desc"><?php echo bloginfo('description'); ?></span>
					<?php }elseif(!empty($optimizer['logo_image_id']['url'])){   ?>
                    	<?php do_action('optimizer_before_logo'); ?>
                        <a class="logoimga" title="<?php bloginfo('name') ;?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php $logo = $optimizer['logo_image_id']; echo $logo['url']; ?>" alt="<?php bloginfo('name') ;?>" <?php echo optimizer_image_attr( esc_url($optimizer['logo_image_id']['url']) ); ?> /></a>
                        <?php do_action('optimizer_after_logo'); ?>
                        <span class="desc logoimg_desc"><?php echo bloginfo('description'); ?></span>
                        
                    <?php }else{ ?>
                    		<?php do_action('optimizer_before_site_title'); ?>
								<?php if ( is_front_page() ) { ?>   
                                    <h1><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo('name'); ?></a></h1>
                                    <span class="desc"><?php echo bloginfo('description'); ?></span>
                                <?php }else{ ?>
                                    <h2><a href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo('name'); ?></a></h2>
                                    <span class="desc"><?php echo bloginfo('description'); ?></span>
                                <?php } ?>
                    		<?php do_action('optimizer_after_site_title'); ?>
                    <?php } ?>
                </div>
            <?php } ?>   
            <!--LOGO END-->
            
            <!--MENU START--> 
            <?php do_action('optimizer_before_menu'); ?>
                <!--MOBILE MENU START-->
                <?php if(!empty($optimizer['hide_head_menu'])){ ?>
                <?php }else{ ?>
                	<?php if( $optimizer['head_menu_type'] == '7' || $optimizer['mobile_menu_type'] == 'hamburger'){ ?><a id="simple-menu" class="<?php if($optimizer['head_menu_type'] == '7' ){ echo 'desktop_hamburger';} ?>" href="#sidr" aria-label="<?php echo _e('Menu','optimizer'); ?>"><i class="fa fa-bars"></i></a><?php } ?>
                	<?php if( $optimizer['mobile_menu_type'] == 'dropdown'){ ?><a id="dropdown-menu"><?php echo _e('Menu','optimizer'); ?> <i class="fa fa-chevron-down"></i></a><?php } ?>
                <?php } ?>
                <!--MOBILE MENU END--> 
                
                
                
                
                <div id="topmenu" class="menu_style_<?php echo $optimizer['head_menu_type']; ?><?php if ($optimizer['social_bookmark_pos'] == 'header' || $optimizer['social_bookmark_pos'] == 'headfoot') { ?> has_bookmark<?php } ?> mobile_<?php echo $optimizer['mobile_menu_type']; ?> <?php if(!empty($optimizer['hide_head_menu'])) echo 'hide_headmenu'; ?>"  <?php optimizer_schema_item_type('menu'); ?>>
                <?php 
                //LOAD PRIMARY MENU
                if ($optimizer['head_menu_type'] == '3' || $optimizer['head_menu_type'] == '4' || $optimizer['head_menu_type'] == '5' || $optimizer['head_menu_type'] == '6' ) {
					$walker = new rc_scm_walker; 
                    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'walker' => $walker ) ); 
                }else{
                    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); 
                }?>
                
                
                <!--LOAD THE HEADR SOCIAL LINKS-->
					<div class="head_soc">
						<?php if ($optimizer['social_bookmark_pos'] == 'header' || $optimizer['social_bookmark_pos'] == 'headfoot' || is_customize_preview()) { ?><?php get_template_part('framework/core','social'); ?><?php } ?>
                    </div>
                    
              <!--Header SEARCH-->
                <div class="header_s head_search<?php if (empty ($optimizer['headsearch_id'])) { ?> headrsearch_off<?php } ?>">
                    <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" >
                        <input placeholder="<?php _e( 'Search...', 'optimizer' ); ?>" type="text" value="<?php echo get_search_query(); ?>" name="s" id="head_s" />
                    </form>
                    <i class="fa fa-search"></i>
                </div>
                
                </div>
                
                
                
			<?php do_action('optimizer_after_menu'); ?>
            <!--MENU END-->
            
            <!--LEFT HEADER CONTENT-->
            <?php if (!empty($optimizer['head_sidebar']) && !empty($optimizer['left_head_content'])) { ?>
            		<div class="left_header_content"><?php echo do_shortcode($optimizer['left_head_content']); ?></div>
            <?php } ?>
            
            
            </div>
    </div>
    </div>
<!--HEADER ENDS-->