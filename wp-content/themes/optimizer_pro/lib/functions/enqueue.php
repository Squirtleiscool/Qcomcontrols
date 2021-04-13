<?php
/****************** LOAD CSS & Javascripts (FRONT-END) ******************/
if(!function_exists( 'optimizer_css_js' ) ){
function optimizer_css_js() {
	if ( !is_admin() ) {
	//LOAD CSS-----------------------------------------------
	$theme_data = wp_get_theme();
	wp_enqueue_style( 'optimizer-style', get_stylesheet_uri());
	wp_enqueue_style( 'optimizer-style-core', get_template_directory_uri().'/style_core.css', 'style_core', $theme_data->get( 'Version' ));
	wp_enqueue_style('optimizer-icons',get_template_directory_uri().'/assets/fonts/font-awesome.css', 'font_awesome', $theme_data->get( 'Version' ));
	//wp_enqueue_style('animated_css',get_template_directory_uri().'/assets/css/animate.min.css', 'optimizer-style', $theme_data->get( 'Version' ));
	if ( is_rtl() ) {
		wp_enqueue_style('rtl_css',get_template_directory_uri().'/assets/css/rtl.css', 'rtl_css' );
   }
   // if ( function_exists( 'has_blocks' ) ){
   //    if( has_blocks( ) ){
   //       wp_enqueue_style('optimizer_blocks',get_template_directory_uri().'/blocks/style.css', 'optimizer-style', $theme_data->get( 'Version' ));
   //    }
   // }

	//LOAD JS-----------------------------------------------
	wp_enqueue_script('jquery');
	wp_enqueue_script('optimizer_js',get_template_directory_uri().'/assets/js/optimizer.js', array('jquery'), $theme_data->get( 'Version' ), true);
	wp_enqueue_script('optimizer_otherjs',get_template_directory_uri().'/assets/js/other.js', array('jquery'), $theme_data->get( 'Version' ), true);
		global $optimizer; 
		$optimo = array('smoothscroll' => $optimizer['smoothscroll']);
		wp_localize_script( 'optimizer_otherjs', 'optimo', $optimo );
	
	wp_enqueue_script('optimizer_core',get_template_directory_uri().'/assets/js/core.js', array('jquery'), $theme_data->get( 'Version' ), true);
		$optim = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'sent' => __('Message Sent Successfully!','optimizer'),
		'day' => __('Days','optimizer'),'hour' => __('Hours','optimizer'),'mins' => __('Min','optimizer'),'sec' => __('Sec','optimizer'),
		'redirect' => $optimizer['contactredirect'],
		);
		wp_localize_script( 'optimizer_core', 'optim', $optim );
		
	global $optimizer; if ( ! empty ( $optimizer['post_lightbox_id'] ) ) {wp_enqueue_script('optimizer_lightbox',get_template_directory_uri().'/assets/js/magnific-popup.js', array('jquery'), $theme_data->get( 'Version' ), true);}
	global $optimizer; if($optimizer['slider_type_id'] == "accordion"){wp_enqueue_script('optimizer_accordion',get_template_directory_uri().'/assets/js/accordion.js', array('jquery'), $theme_data->get( 'Version' ), true);}
	//Load MASONRY
	global $optimizerdb;
	if ($optimizer['cat_layout_id'] == "3" ) {
		if (!is_home() ){
			wp_enqueue_script('optimizer_masonry',get_template_directory_uri().'/assets/js/masonry.js', array('jquery'), $theme_data->get( 'Version' ), true);
		}
	}
	if ( is_page() || is_single() ) {
		//Load Masonry
		global $optimizer; global $post; $content = $post->post_content;
		if(has_shortcode( $content, 'display-posts' ) || ( $optimizer['blog_layout_id'] == '5' && is_page_template('template_parts/page-blog_template.php') )){
			wp_enqueue_script('optimizer_masonry',get_template_directory_uri().'/assets/js/masonry.js', array('jquery'), $theme_data->get( 'Version' ), true);
		}
	}
	//Load Coment Reply Javascript
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	if ( is_page() || is_single() ) {
		//Load Gallery Javascript
		global $optimizer; global $post; $content = $post->post_content;
		if (!empty( $optimizer['post_gallery_id'] ) && optimizer_has_shortcode( $content, 'gallery' ) ) {
			wp_enqueue_script('optimizer_gallery',get_template_directory_uri().'/assets/js/gallery.js', array('jquery'), $theme_data->get( 'Version' ), true);
		}
		if ( function_exists( 'has_block' ) ){
			if(has_block( 'gallery', $post ) ){
				wp_enqueue_script('optimizer_gallery',get_template_directory_uri().'/assets/js/gallery.js', array('jquery'), $theme_data->get( 'Version' ), true);
			}
		}
		
	}
	if(is_customize_preview()){ wp_enqueue_script('optimizer_map',get_template_directory_uri().'/assets/js/map-styles.js', array('jquery'), $theme_data->get( 'Version' ), true); }
	if( is_page_template('template_parts/page-contact_template.php') || is_customize_preview() ) {
		
		global $optimizer;
		if(!empty($optimizer['map_api'])){ $mapkey = 'https://maps.googleapis.com/maps/api/js?key='.$optimizer['map_api'].''; }else{ $mapkey = 'https://maps.googleapis.com/maps/api/js?sensor=false';}
		wp_enqueue_script('optimizer_googlemaps', $mapkey);
	}
	//Beaver Builder Support
	if(isset($_GET['fl_builder'])) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false,  1 );
		wp_enqueue_script(  'wp-color-picker', admin_url( 'js/color-picker.min.js' ),  array( 'iris' ), false,  1 );
		$colorpicker_l10n = array( 'clear' => __( 'Clear', 'optimizer' ), 'defaultString' => __( 'Default', 'optimizer'  ),  'pick' => __( 'Select Color', 'optimizer'  ));
		wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
		wp_enqueue_script( 'optimizer_widgets', get_template_directory_uri() . '/assets/js/widgets.js' );
		wp_enqueue_style( 'optimizer_backend', get_template_directory_uri() . '/assets/css/backend.css' );
	}

	}//IF_Not_Admin check ENDS
}//optimizer_head_js ENDS
}
add_action('wp_enqueue_scripts', 'optimizer_css_js');

/*ADD Facebook JS code for widget and shortcode*/
function optimizer_facebook_js() {
	if(is_page() || is_single()){  global $post; $content = $post->post_content;  }else{  $content = ''; }
	if(is_page() || optimizer_has_shortcode( $content, 'fblike' )){
		echo '<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=219966444765853";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, "script", "facebook-jssdk"));</script>';
	}
}
//add_action('optimizer_body_top','optimizer_facebook_js');
/****************** DYNAMIC CSS & JS ******************/
//Include Dynamic Stylesheet
if ( !is_admin() ) {
	include(get_template_directory() . '/template_parts/custom-style.php');
}
//Load RAW Java Scripts
add_action('wp_footer', 'optimizer_load_js');
function optimizer_load_js() {
if ( !is_admin() ) {
	include(get_template_directory() . '/template_parts/custom-javascript.php');
}
}
/****************** ADMIN CSS & JS ******************/
//Load ADMIN CSS & JS SCRIPTS
function optimizer_admin_cssjs($hook) {
		wp_enqueue_script( 'optimizer_colpickjs', get_template_directory_uri() . '/assets/js/colpick.js' );
		wp_enqueue_style('adminFontAwesome',get_template_directory_uri().'/assets/fonts/font-awesome.css');
      wp_enqueue_style( 'optimizer_colpick_css', get_template_directory_uri() . '/assets/css/colpick.css' );
		wp_enqueue_style( 'optimizer_backend', get_template_directory_uri() . '/assets/css/backend.css' );
      wp_enqueue_script( 'optimizer_widgets', get_template_directory_uri() . '/assets/js/widgets.js' );
      global $current_user;$user_id = $current_user->ID;
      if ( ! get_user_meta($user_id, 'optimizer_brave_ignore') && current_user_can('edit_theme_options') ) { 
         wp_enqueue_script( 'optimizer_admin', get_template_directory_uri() . '/assets/js/admin.js' );
      }

		if ( 'widgets.php' == $hook ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
		}
		if ( 'edit-tags.php' == $hook ) {
			wp_enqueue_media();
		}
}
add_action( 'admin_enqueue_scripts', 'optimizer_admin_cssjs' );

//add_action( 'admin_head', 'optimizer_wp5_5_colorpicker' );
// function optimizer_wp5_5_colorpicker($hook) { 
//    print_r('<script> var wpColorPickerL10n  = wpColorPickerL10n? wpColorPickerL10n : {}; var commonL10n  = commonL10n? commonL10n : {};</script>');
// }

add_action( 'wp_enqueue_scripts', 'optimizer_widget_css_enqueue' );
if(!function_exists('optimizer_widget_css_enqueue')){
   function optimizer_widget_css_enqueue() {
         $sidebars_widgets = get_option( 'sidebars_widgets' );
         $allOptimizerWidgets = array('optimizer_front_text', 'optimizer_front_about', 'optimizer_front_blocks', 'optimizer_front_cta', 'optimizer_front_clients', 'ast_countdown_widget', 'optimizer_front_carousel', 'optimizer_front_map', 'optimizer_front_newsletter', 'optimizer_front_portfoio', 'optimizer_front_posts','optimizer_front_slider', 'ast_scoial_widget', 'optimizer_front_testimonials', 'optimizer_front_video');
         $footerHasOptimizerWidgets = false; $sidebarHasOptimizerWidgets = false;
         //Load the Optimizer widget CSS for the Widgetized pages
         if(is_singular('page')){
            global $post;
            $widgetized = get_post_meta($post->ID, "widgetized", true);
            $sidebarid = get_post_meta($post->ID, "page_sidebar");
            $sidebarID = isset($sidebarid[0]) ? $sidebarid[0] : '';
            if( $sidebarID ){
               optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, $sidebarID);
            }
         }
         
         //If user created a Custom Right Sidebar
         if(is_singular('page') || is_singular('post')){
            global $post;
            $right_sidebarid = get_post_meta($post->ID, "sidebar");
            $right_sidebarID = isset($right_sidebarid[0]) ? $right_sidebarid[0] : '';
            if( $right_sidebarID ){
               optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, $right_sidebarID);
            }
         }

         //Load the Optimizer widget CSS for the Frontpage
         if(is_front_page() || is_home()){
            optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, 'front_sidebar');
         }

         //Check if Footer has Optimizer Widgets and load the Widgets CSS if does.
         if(is_array($sidebars_widgets['foot_sidebar']) && count($sidebars_widgets['foot_sidebar']) > 0){
            foreach ($sidebars_widgets['foot_sidebar'] as $key => $widgetid) {
               $widget_type = strstr( $widgetid, "-", true );
               if(in_array($widget_type, $allOptimizerWidgets) ){
                  $footerHasOptimizerWidgets = true;
               }
            }
            if($footerHasOptimizerWidgets){
               optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, 'foot_sidebar');
            }
         }

         if(is_active_sidebar('sidebar')){
            if(is_array($sidebars_widgets['sidebar']) && count($sidebars_widgets['sidebar']) > 0){
               foreach ($sidebars_widgets['sidebar'] as $key => $widgetid) {
                  $widget_type = strstr( $widgetid, "-", true );
                  if(in_array($widget_type, $allOptimizerWidgets) ){
                     $sidebarHasOptimizerWidgets = true;
                  }
               }
               if($sidebarHasOptimizerWidgets){
                  optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, 'sidebar');
               }
            }
         }
         if(isset($sidebars_widgets['global_widgets']) && is_array($sidebars_widgets['global_widgets']) && count($sidebars_widgets['global_widgets']) > 0){
            foreach ($sidebars_widgets['global_widgets'] as $key => $widgetid) {
               $widget_type = strstr( $widgetid, "-", true );
               if(in_array($widget_type, $allOptimizerWidgets) ){
                  $sidebarHasOptimizerWidgets = true;
               }
            }
            if($sidebarHasOptimizerWidgets){
               optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, 'global_widgets');
            }
         }

   }

}

function optimizer_generate_widgetCSS($allOptimizerWidgets, $sidebars_widgets, $sidebarID, $output_only=false){
   $currentWidgets = array();
   $allWidgetCSS = '';
   if(!empty( $sidebars_widgets[$sidebarID] ) ){
      foreach ($sidebars_widgets[$sidebarID] as $key => $widgetID) {
         $foundWidget = new stdClass();
         foreach ($allOptimizerWidgets as $key => $optimWidgetName) {
            if (strpos($widgetID, $optimWidgetName) !== false) {
               $foundWidget->ID =  (int)str_replace($optimWidgetName.'-', '',$widgetID);
               $foundWidget->name = 'widget_'.$optimWidgetName;
               $widgetData = get_option($foundWidget->name);
               if($widgetData[$foundWidget->ID]){
                  $foundWidget->data = $widgetData[$foundWidget->ID];
                  if(strpos($widgetID, 'optimizer_front_text') !== false ){   $optimizerWidgetInstance = new optimizer_front_Text();   }
                  if(strpos($widgetID, 'optimizer_front_about') !== false ){   $optimizerWidgetInstance = new optimizer_front_About();   }
                  if(strpos($widgetID, 'optimizer_front_blocks') !== false ){   $optimizerWidgetInstance = new optimizer_front_Blocks();   }
                  if(strpos($widgetID, 'optimizer_front_cta') !== false ){   $optimizerWidgetInstance = new optimizer_front_Cta();   }
                  if(strpos($widgetID, 'optimizer_front_clients') !== false ){   $optimizerWidgetInstance = new optimizer_front_Clients();   }
                  if(strpos($widgetID, 'optimizer_front_newsletter') !== false ){   $optimizerWidgetInstance = new optimizer_front_Newsletter();   }
                  if(strpos($widgetID, 'optimizer_front_carousel') !== false ){   $optimizerWidgetInstance = new optimizer_front_Carousel();   }
                  if(strpos($widgetID, 'optimizer_front_map') !== false ){   $optimizerWidgetInstance = new optimizer_front_Map();   }
                  if(strpos($widgetID, 'optimizer_front_portfoio') !== false ){   $optimizerWidgetInstance = new optimizer_front_Portfolio();   }
                  if(strpos($widgetID, 'optimizer_front_posts') !== false ){   $optimizerWidgetInstance = new optimizer_front_Posts();   }
                  if(strpos($widgetID, 'optimizer_front_slider') !== false ){   $optimizerWidgetInstance = new optimizer_front_Slider();   }
                  if(strpos($widgetID, 'optimizer_front_testimonials') !== false ){   $optimizerWidgetInstance = new optimizer_front_Testimonials();   }
                  if(strpos($widgetID, 'optimizer_front_video') !== false ){   $optimizerWidgetInstance = new optimizer_front_Video();   }
                  if(strpos($widgetID, 'ast_scoial_widget') !== false ){   $optimizerWidgetInstance = new ast_scoial_Widget();   }
                  if(strpos($widgetID, 'ast_countdown_widget') !== false ){   $optimizerWidgetInstance = new ast_countdown_Widget();   }


                  if(isset($optimizerWidgetInstance)){
                     $allWidgetCSS .=  $optimizerWidgetInstance->generate_css($widgetID, $widgetData[$foundWidget->ID]);
                  }
                  
               }
               $currentWidgets[] = $foundWidget;
            }
         }
      }
      if($allWidgetCSS && !$output_only){
         wp_add_inline_style( 'optimizer-style-core', $allWidgetCSS );
      }
      if($allWidgetCSS && $output_only){
         return  $allWidgetCSS;
      }
   }
}

add_action( 'admin_enqueue_scripts', 'optimizer_widgetizer_enqueue' );
function optimizer_widgetizer_enqueue($hook) {
	    if ( function_exists('get_current_screen')) {  
			//Do not load if current editing post type is not Page
			$post_type = get_current_screen()->post_type;
			if ( $post_type != 'page') return;
		}
		//Do not load if user is not admin
		$userPermitted = current_user_can('manage_options');
		if(!$userPermitted ){
			return;
		}
		
		
      $widgetized = get_post_meta(get_the_ID(), "widgetized", true);
      //$layoutType = get_post_meta(get_the_ID(), "optimizer_post_layout", true);
		$sidebarid = get_post_meta(get_the_ID(), "page_sidebar");
		if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
			   wp_register_script( 'widgetize-ajax', get_template_directory_uri() . '/customizer/assets/widgetize_ajax.js');
            $optimizerLogo = '<svg xmlns="http://www.w3.org/2000/svg" width="18px" viewBox="0 0 241 286" style="position: relative; margin-top: -8px; top: 5px;"><path fill-rule="evenodd" fill="rgb(85, 99, 133)" d="M121.000,286.000 L0.000,212.000 L0.000,72.000 L121.000,-0.000 L241.000,72.000 L241.000,213.000 L121.000,286.000 ZM193.000,100.301 L120.801,57.000 L48.000,100.301 L48.000,184.497 L120.801,229.000 L193.000,185.098 L193.000,100.301 Z" /></svg>';
         
         $isWidgetized  = $widgetized == '1' && $sidebarid !=='null';
         $cpanel = '<div id="customize_page_panel_new" class="page_widgetized_new '.($widgetized ? 'active_customize' : '').'"><a id="customize_page_bttn_new" title="Customize">'.$optimizerLogo.'</a><div class="custimize_pp_inner_new">';
         
            // $cpanel .= '<div class="customize_page_panel_layout customize_page_panel_layout--'.$layoutType.'">';
            //    $cpanel .= '<ul>';
            //    $cpanel .= '<li data-val="default" class="'.($layoutType !== 'full' ? 'opti_layout_active' : '').'" ><img src="'.get_template_directory_uri() . '/assets/images/site_boxed.png" /><span>'.__('Default','').'</span></li>';
            //    $cpanel .= '<li data-val="full" id="" class="'.($layoutType === 'full' ? 'opti_layout_active' : '').'" ><img src="'.get_template_directory_uri() . '/assets/images/site_full.png" /><span>'.__('Full Width','').'</span></li>';
            //    $cpanel .= '</ul>';
            // $cpanel .= '</div>';


            $cpanel .= '<div class="customize_page_panel_Widgetize"><h3>'.__('Customize With Widgets','').'</h3><div class="customize_panel_Widgetize_inner">';
            if($isWidgetized){
               $cpanel .= '<p>'. __('Optimizer Widgets are active on this page','optimizer').'</p>';
               $cpanel .= '<a href="'.admin_url('/customize.php?autofocus[panel]=widgets&url='.get_the_permalink(get_the_ID()).'').'" class="goto_customizer button button-primary button-large">'. __('Add/Edit Widgets','optimizer').'</a>';
               $cpanel .= '<div>'. wp_nonce_field('optimizer_unwidgetize_nonce', 'optimizer_unwidgetize_nonce').'<button class="unwidgetize_btn button button-large">'. __('Remove Widgets & Switch Back to Editor','optimizer').'</button></div>';
            }else{
               $cpanel .= '<p>'. __('Customize This Page with Widgets.','optimizer').'</p>';
               $cpanel .= '<div>'. wp_nonce_field('optimizer_widgetize_nonce', 'optimizer_widgetize_nonce').'<button class="widgetize_btn button button-large">Activate</button></div>';
            }
            $cpanel .= '</div></div>';

         $cpanel .= '</div></div>';

			   $parameters = array('ajaxURL' => admin_url( 'admin-ajax.php' ), 'userPermitted' => $userPermitted, 'widgetized' => $widgetized, 'sidebarid' => $sidebarid, 'content'=> $cpanel, 'pid'=> get_the_ID()); 
			   wp_localize_script( 'widgetize-ajax', 'params', $parameters ); 
			   return wp_enqueue_script( 'widgetize-ajax' );
      }

}




add_action( 'admin_head', 'widgetizer_new_enqueue' );
function widgetizer_new_enqueue($hook) { 
   $opti_current_url = $_SERVER['REQUEST_URI'];
   if(is_admin() && strpos($opti_current_url, 'post-new.php') !== false){
      $cpanel = '<div id="customize_page_panel_new"><a id="customize_page_bttn_new" style=" position: relative; left: -80px;">Customize</a><div class="custimize_pp_inner_new"><p>'. __('Customize This Page with Widgets like Optimizer Frontpage.','optimizer').'</p>';
      $cpanel .= '<div style=" font-weight: 600; color: #9c6272; background: #f7e4e9; padding: 8px;">'.__('To Add Widgets, First add a Page title and Publish the Page and then reload the page.','optimizer').'</div>';
      $cpanel .= '</div></div>';
      $parameters = array('ajaxURL' => admin_url( 'admin-ajax.php' ), 'userPermitted' => true, 'widgetized' => false, 'sidebarid' => false, 'content'=> $cpanel, 'pid'=> get_the_ID()); 
      print_r('<script> var params = '.json_encode($parameters).';</script><script type="text/javascript" src="'.get_template_directory_uri() . '/customizer/assets/widgetize_ajax.js'.'" />');

   }
   
}

function optimizer_google_analytics() { ?>
    
        <?php global $optimizer; if (!empty ($optimizer['google_analytics_id'])) { ?><!--Google Analytics Start--><?php echo html_entity_decode($optimizer['google_analytics_id'], ENT_QUOTES, 'UTF-8'); ?><!--Google Analytics END--><?php } ?>
    
<?php }
add_action( 'wp_head', 'optimizer_google_analytics', 10 );
?>