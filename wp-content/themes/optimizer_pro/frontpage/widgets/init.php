<?php

//Load the frontpage widgets
require(get_template_directory() . '/frontpage/widgets/front-about.php');
require(get_template_directory() . '/frontpage/widgets/front-blocks.php');
require(get_template_directory() . '/frontpage/widgets/front-text.php');
require(get_template_directory() . '/frontpage/widgets/front-posts.php');
require(get_template_directory() . '/frontpage/widgets/front-dynamic.php');
require(get_template_directory() . '/frontpage/widgets/front-cta.php');
require(get_template_directory() . '/frontpage/widgets/front-map.php');
require(get_template_directory() . '/frontpage/widgets/front-clients.php');
require(get_template_directory() . '/frontpage/widgets/front-testimonials.php');
require(get_template_directory() . '/frontpage/widgets/front-slider.php');
require(get_template_directory() . '/frontpage/widgets/front-video.php');
require(get_template_directory() . '/frontpage/widgets/front-portfolio.php');
require(get_template_directory() . '/frontpage/widgets/front-newsletter.php');
require(get_template_directory() . '/frontpage/widgets/front-countdown.php');
require(get_template_directory() . '/frontpage/widgets/front-social.php');

//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'optimizer_in_widget_form',5,3);
//Callback function for options update (priority 5, 3 parameters)
add_filter('widget_update_callback', 'optimizer_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'optimizer_dynamic_sidebar_params');


function optimizer_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array( 'width' => 'none', 'max_inner_width'=>'', 'animation' => '', 'customclasses' => '', 'visibility' => 'none', 'margin' => array('','','',''), 'padding'=> array('','','','')) );
    
    if (isset($t->id) && (strpos($t->id, 'optimizer') > -1 || strpos($t->id, 'ast_countdown')  > -1 || strpos($t->id, 'ast_scoial')  > -1  )) {

      if ( !isset($instance['width']) )
         $instance['width'] = null;
      if ( !isset($instance['visibility']) )
         $instance['visibility'] = null;
      if ( !isset($instance['customclasses']) )
         $instance['customclasses'] = '';

      if ( !isset($instance['margin']) ){
         $instance['margin'] = array();
      }
      if ( !isset($instance['animation']) ){
         $instance['animation'] = '';
      }
      if ( !isset($instance['padding']) )
         $instance['padding'] = array();	

      if ( !isset($instance['max_inner_width']) )
         $instance['max_inner_width'] = null;	
      ?>

         <div class="optimizer_widget_tab optimizer_widget_tab--advanced" style="display:none">
            <!-- <h4><i>+</i> <?php _e('Advanced','optimizer'); ?></h4> -->
               <div class="widget_advanced_controls">
                  <label for="<?php echo $t->get_field_id('width'); ?>"><span><?php _e('Width:','optimizer'); ?></span>
                  <select id="<?php echo $t->get_field_id('width'); ?>" name="<?php echo $t->get_field_name('width'); ?>">
                     <option <?php selected($instance['width'], '1');?> value="1"><?php _e('Full (1/1)','optimizer'); ?></option>
                     <option <?php selected($instance['width'], '2');?>value="2"><?php _e('Half (1/2)','optimizer'); ?></option>
                     <option <?php selected($instance['width'], '3');?> value="3"><?php _e('One Third (1/3)','optimizer'); ?></option>
                     <option <?php selected($instance['width'], '4');?> value="4"><?php _e('Two Quarter (2/3)','optimizer'); ?></option>
                     <option <?php selected($instance['width'], '5');?> value="5"><?php _e('Quarter (1/4)','optimizer'); ?></option>
                     <option <?php selected($instance['width'], '6');?> value="6"><?php _e('Three Quarter (3/4)','optimizer'); ?></option>
                  </select>
                  </label>
                  
                  <label for="<?php echo $t->get_field_id('visibility'); ?>"><span><?php _e('Display On:','optimizer'); ?></span>
                  <select id="<?php echo $t->get_field_id('visibility'); ?>" name="<?php echo $t->get_field_name('visibility'); ?>">
                     <option <?php selected($instance['visibility'], '1');?> value="1"><?php _e('All Devices','optimizer'); ?></option>
                     <option <?php selected($instance['visibility'], '2');?>value="2"><?php _e('Desktop Only','optimizer'); ?></option>
                     <option <?php selected($instance['visibility'], '3');?> value="3"><?php _e('Mobile Only','optimizer'); ?></option>
                  </select>
                  </label>

                  <label for="<?php echo $t->get_field_id('animation'); ?>"><span><?php _e('Animation','optimizer'); ?></span>
                  <select id="<?php echo $t->get_field_id('animation'); ?>" name="<?php echo $t->get_field_name('animation'); ?>">
                     <option <?php selected($instance['animation'], '');?> value=""><?php _e('None','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'fadeInLeft');?> value="fadeInLeft"><?php _e('Fade In From Left','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'fadeInRight');?>value="fadeInRight"><?php _e('Fade In From Right','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'fadeInBottom');?> value="fadeInBottom"><?php _e('Fade In From Bottom','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'zoomIn');?> value="zoomIn"><?php _e('Zoom In','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'rotateInLeft');?> value="rotateInLeft"><?php _e('Rotate In Left','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'rotateInRight');?> value="rotateInRight"><?php _e('Rotate In Right','optimizer'); ?></option>
                     <option <?php selected($instance['animation'], 'bounceIn');?> value="bounceIn"><?php _e('Bounce In','optimizer'); ?></option>
                  </select>
                  </label>

                  <label for="<?php echo $t->get_field_id('customclasses'); ?>"><span><?php _e('Custom Calsses:','optimizer'); ?></span>
                     <input class="widgt_custom_classes" id="<?php echo $t->get_field_id('customclasses'); ?>" name="<?php echo $t->get_field_name('customclasses'); ?>" value="<?php echo isset($instance['customclasses']) ? $instance['customclasses'] : ''; ?>" placeholder="myclass1, myclass2" />
                  </label>

                  <label for="<?php echo $t->get_field_id('max_inner_width'); ?>"><span><?php _e('Max Inner Width (in px):','optimizer'); ?></span>
                     <input class="widgt_custom_classes" id="<?php echo $t->get_field_id('max_inner_width'); ?>" name="<?php echo $t->get_field_name('max_inner_width'); ?>" value="<?php echo isset($instance['max_inner_width']) ? $instance['max_inner_width'] : ''; ?>" placeholder="700px" />
                  </label>

                  <label for="<?php echo $t->get_field_id('margin'); ?>"><span><?php _e('Margin (in px or %):','optimizer'); ?></span><br>
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('margin'); ?>_Top" name="<?php echo $t->get_field_name('margin'); ?>[]" value="<?php echo isset($instance['margin'][0]) ? $instance['margin'][0] : ''; ?>" placeholder="Top" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('margin'); ?>_Bottom" name="<?php echo $t->get_field_name('margin'); ?>[]" value="<?php echo isset($instance['margin'][1]) ? $instance['margin'][1] : ''; ?>" placeholder="Bottom" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('margin'); ?>_Left" name="<?php echo $t->get_field_name('margin'); ?>[]" value="<?php echo isset($instance['margin'][2]) ? $instance['margin'][2] : ''; ?>" placeholder="Left" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('margin'); ?>_Right" name="<?php echo $t->get_field_name('margin'); ?>[]" value="<?php echo isset($instance['margin'][3]) ? $instance['margin'][3] : ''; ?>" placeholder="Right" />
                  </label>
                  
                  <label for="<?php echo $t->get_field_id('padding'); ?>"><span><?php _e('Padding (in px or %):','optimizer'); ?></span><br>
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('padding'); ?>_Top" name="<?php echo $t->get_field_name('padding'); ?>[]" value="<?php echo isset($instance['padding'][0]) ? $instance['padding'][0] : ''; ?>" placeholder="Top" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('padding'); ?>_Bottom" name="<?php echo $t->get_field_name('padding'); ?>[]" value="<?php echo isset($instance['padding'][1]) ? $instance['padding'][1] : ''; ?>" placeholder="Bottom" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('padding'); ?>_Left" name="<?php echo $t->get_field_name('padding'); ?>[]" value="<?php echo isset($instance['padding'][2]) ? $instance['padding'][2] : ''; ?>" placeholder="Left" />
                  <input class="widgt_spacing" id="<?php echo $t->get_field_id('padding'); ?>_Right" name="<?php echo $t->get_field_name('padding'); ?>[]" value="<?php echo isset($instance['padding'][3]) ? $instance['padding'][3] : ''; ?>" placeholder="Right" />
                  </label>
                  

               </div>
         </div>
         <div class="optimizer_widget_nav">
            <ul>
               <li class="optimizer_widget_navItem optimizer_widget_nav--active" data-type="content"><span class="fa fa-align-left"></span><?php _e('Content', 'optimizer') ?></li>
               <li class="optimizer_widget_navItem" data-type="style"><span class="fa fa-adjust"></span><?php _e('Style', 'optimizer') ?></li>
               <li class="optimizer_widget_navItem" data-type="advanced"><span class="fa fa-cog"></span><?php _e('Advanced', 'optimizer') ?></li>
            </ul>
         </div>

      <?php
      $retrun = null;
      return array($t,$return,$instance);
   }else{
      return;
   }
}


function optimizer_widget_basic_styles($instance, $widget, $type='', $hideTitle=false, $hideContent=false){
   $fontList = optimizer_fonts_editor(array());
   $fontArray = explode(";",$fontList['font_formats']);
   $titleFontSizeLabel = __('Title Font Size', 'optimizer');
   $titleFontFamilyLabel = __('Title Font Family','optimizer');
   $defaultTitleSize = 27;
   if($type === 'cta'){   $titleFontSizeLabel = __('Button Font Size', 'optimizer');   $titleFontFamilyLabel = __('Button Font Family','optimizer');   }
   if($type === 'about'){   $defaultTitleSize = 48; }
   ?>
   <?php if($hideTitle === false) { ?>
      <p>
         <label for="<?php echo $widget->get_field_id( 'title_size' ); ?>"><?php echo $titleFontSizeLabel; ?></label>
         <input class="optimizer_range_slider" id="<?php echo $widget->get_field_id( 'title_size' ); ?>" name="<?php echo $widget->get_field_name( 'title_size' ); ?>" value="<?php echo isset($instance['title_size']) ? $instance['title_size'] : $defaultTitleSize; ?>" type="range" min="5" max="120" onchange="updateRangeInput(this.value, '<?php echo $widget->get_field_id( 'title_size' ); ?>_range', 'px');" />
         <span class="optimizer_range_slider_val" id="<?php echo $widget->get_field_id( 'title_size' ); ?>_range"><?php echo isset($instance['title_size']) ? $instance['title_size'] : $defaultTitleSize; ?>px</span>
      </p>
   <?php } ?>
   <?php if($hideContent === false) { ?>
   <p>
      <label for="<?php echo $widget->get_field_id( 'font_size' ); ?>"><?php _e('Font Size', 'optimizer') ?></label>
      <input class="optimizer_range_slider" id="<?php echo $widget->get_field_id( 'font_size' ); ?>" name="<?php echo $widget->get_field_name( 'font_size' ); ?>" value="<?php echo isset($instance['font_size']) ? $instance['font_size'] : 16; ?>" type="range" min="5" max="120" onchange="updateRangeInput(this.value, '<?php echo $widget->get_field_id( 'font_size' ); ?>_range', 'px');" />
      <span class="optimizer_range_slider_val" id="<?php echo $widget->get_field_id( 'font_size' ); ?>_range"><?php echo isset($instance['font_size']) ? $instance['font_size'] : 16; ?>px</span>
   </p>
   <?php } ?>
   <?php if($hideTitle === false) { ?>
      <p>
         <label for="<?php echo $widget->get_field_id('title_family'); ?>"><span><?php echo $titleFontFamilyLabel; ?></span>
            <select class="widefat" id="<?php echo $widget->get_field_id('title_family'); ?>" name="<?php echo $widget->get_field_name('title_family'); ?>">
               <option <?php selected(isset($instance['title_family']) ? $instance['title_family'] : '', '');?> value=""><?php _e('Default Font','optimizer'); ?></option>
               <?php
                  foreach ($fontArray as $key => $value) {
                     $titleExtract = explode("=", $value, 2);  $titleLabel = $titleExtract[0]; $titleVal = $titleExtract[1];
                     $currentTitleVal = isset($instance['title_family']) ? $instance['title_family'] : ''; 
                  ?>
                     <option <?php selected($currentTitleVal, $titleVal);?> value="<?php echo $titleVal; ?>"><?php echo $titleLabel; ?></option>
               <?php } ?>

            </select>
         </label>
      </p>
   <?php } ?>
   <?php if($hideContent === false) { ?>
   <p>
      <label for="<?php echo $widget->get_field_id('font_family'); ?>"><span><?php _e('Content Font Family','optimizer'); ?></span>
         <select class="widefat" id="<?php echo $widget->get_field_id('font_family'); ?>" name="<?php echo $widget->get_field_name('font_family'); ?>">
         <option <?php selected(isset($instance['font_family']) ? $instance['font_family'] : '', '');?> value=""><?php _e('Default Font','optimizer'); ?></option>
            <?php
               foreach ($fontArray as $key => $value) {
                  $fontExtract = explode("=", $value, 2);  $fontLabel = $fontExtract[0]; $fontValue = $fontExtract[1];
                  $currentVal = isset($instance['font_family']) ? $instance['font_family'] : ''; 
               ?>
                  <option <?php selected($currentVal, $fontValue);?> value="<?php echo $fontValue; ?>"><?php echo $fontLabel; ?></option>
            <?php } ?>

         </select>
      </label>
   </p>
   <?php } ?>
<?php
}

function optimizer_widget_paddingMargin($id, $instance){
   $marginTop =''; $marginBottom =''; $marginLeft =''; $marginRight ='';$calcWidth =''; 
   $paddingTop =''; $paddingBottom =''; $paddingLeft =''; $paddingRight =''; $boxSizing=''; 
   
   //Margin
   if ( (isset($instance['margin'][0]) && !empty($instance['margin'][0])) || (isset($instance['margin'][1]) && !empty($instance['margin'][1])) || (isset($instance['margin'][2]) && !empty($instance['margin'][2])) || (isset($instance['margin'][3]) && !empty($instance['margin'][3])) ) {
      if(isset($instance['margin'][0]) && !empty($instance['margin'][0])){ $marginTop ='margin-top:'.$instance['margin'][0].';';}
      if(isset($instance['margin'][1]) && !empty($instance['margin'][1])){ $marginBottom ='margin-bottom:'.$instance['margin'][1].';';}
      if(isset($instance['margin'][2]) && !empty($instance['margin'][2])){ $marginLeft ='margin-left:'.$instance['margin'][2].';';}
      if(isset($instance['margin'][3]) && !empty($instance['margin'][3])){ $marginRight ='margin-right:'.$instance['margin'][3].';';}
         //Width
         $thewidth ='100';
         $leftrightmargin ='0px';
         
         if ( isset($instance['width']) && !empty( $instance['width']) ) {
               if($instance['width'] == 2){ $thewidth = '50';} if($instance['width'] == 3){ $thewidth = '33.33';} if($instance['width'] == 4){ $thewidth = '66.67';}  
               if($instance['width'] == 5){ $thewidth = '25';}  if($instance['width'] == 6){ $thewidth = '75';}   
         }
         if ( isset($instance['width']) && !empty( $instance['width']) && !empty($instance['margin'][2]  ) ) {	$leftrightmargin = $instance['margin'][2];   }
         if ( isset($instance['margin'][0]) && !empty( $instance['width']) && !empty($instance['margin'][3]  ) ) {	$leftrightmargin = $instance['margin'][3];	}
         
         if ( isset($instance['width']) && !empty( $instance['width']) ) {
            if(!empty($instance['margin'][2]) && !empty($instance['margin'][3]) ){
                  $leftrightmargin = '('.$instance['margin'][2].' + '.$instance['margin'][3].')';
            }
         }
         $calcWidth ='width: calc('.$thewidth.'% - '.$leftrightmargin.')!important;';
         
   }
   
   //Padding
   if ( (isset($instance['padding'][0]) && !empty($instance['padding'][0])) || (isset($instance['padding'][1]) && !empty($instance['padding'][1])) || (isset($instance['padding'][2]) && !empty($instance['padding'][2])) || (isset($instance['padding'][3]) && !empty($instance['padding'][3])) ) {
      if(isset($instance['padding'][0]) && !empty($instance['padding'][0])){ $paddingTop ='padding-top:'.$instance['padding'][0].';';}
      if(isset($instance['padding'][1]) && !empty($instance['padding'][1])){ $paddingBottom ='padding-bottom:'.$instance['padding'][1].';';}
      if(isset($instance['padding'][2]) && !empty($instance['padding'][2])){ $paddingLeft ='padding-left:'.$instance['padding'][2].';';}
      if(isset($instance['padding'][3]) && !empty($instance['padding'][3])){ $paddingRight ='padding-right:'.$instance['padding'][3].';';}
      
      $boxSizing='box-sizing:border-box;';
   }

   return array($marginTop.$marginBottom.$marginLeft.$marginRight. $paddingTop.$paddingBottom.$paddingLeft.$paddingRight, $boxSizing.$calcWidth);

}

function optimizer_in_widget_form_update($instance, $new_instance, $old_instance){

   $instance['width'] = isset($new_instance['width']) ?  $new_instance['width'] : ''; 
   $instance['max_inner_width'] = isset($new_instance['max_inner_width']) ?  $new_instance['max_inner_width'] : ''; 
	$instance['visibility'] = isset($new_instance['visibility']) ?  $new_instance['visibility'] : '';
	$instance['margin'] = isset($new_instance['margin']) ?  $new_instance['margin'] : '';
   $instance['padding'] = isset($new_instance['padding']) ?  $new_instance['padding'] : '';
   $instance['customclasses'] = isset($new_instance['customclasses']) ? $new_instance['customclasses'] :'';
   $instance['title_size'] = isset($new_instance['title_size']) ? $new_instance['title_size'] :'';
   $instance['font_size'] = isset($new_instance['font_size']) ?$new_instance['font_size'] :'';
   $instance['title_family'] = isset($new_instance['title_family']) ? $new_instance['title_family'] : '';
   $instance['font_family'] = isset($new_instance['font_family']) ?$new_instance['font_family'] :'';
   $instance['animation'] = isset($new_instance['animation']) ?  $new_instance['animation'] : '';
   
        if ( isset( $new_instance['margin'] ) )
        {
            foreach ( $new_instance['margin'] as $themargin )
            {
                if (is_array($themargin) && $themargin['margin'] && '' !== trim( $themargin['margin'] ) )
                    $instance['margin'][] = $themargin;
            }
        }
		
        if ( isset( $new_instance['padding'] ) )
        {
            foreach ( $new_instance['padding'] as $thepadding )
            {
                if (is_array($thepadding) && $thepadding['padding'] &&  '' !== trim( $thepadding['padding'] ) )
                    $instance['padding'][] = $thepadding;
            }
        }
	
    return $instance;
}

function optimizer_dynamic_sidebar_params($params){
   global $wp_registered_widgets;
   $widget_id = $params[0]['widget_id'];
   $widget_obj = $wp_registered_widgets[$widget_id];
   $widget_opt = get_option($widget_obj['callback'][0]->option_name);
   $widget_num = $widget_obj['params'][0]['number'];

   $width = isset($widget_opt[$widget_num]['width']) ? $widget_opt[$widget_num]['width'] : '';
   $visibility = isset($widget_opt[$widget_num]['visibility']) ? $widget_opt[$widget_num]['visibility'] :'';
   $customClasses = isset($widget_opt[$widget_num]['customclasses']) ? $widget_opt[$widget_num]['customclasses'] :'';
   $animation = isset($widget_opt[$widget_num]['animation']) ? $widget_opt[$widget_num]['animation'] :'';
   $animationHTML = $animation ? ' data-animation="'.$animation.'"' : '';
		
   $params[0]['before_widget'] = preg_replace('/class="/', ' '.$animationHTML.' class="'.$customClasses.' widget_col_'.$width.' widget_visbility_'.$visibility.' ',  $params[0]['before_widget'], 1);

   return $params;
}



//CUSTOMIZE THIS PAGE PANEL
function optimizer_below_the_editor() {
	$screen = get_current_screen();
	if( current_user_can('manage_options') && $screen->id == 'page' ){ 
	
		$widgetized = get_post_meta(get_the_ID(), "widgetized", true);
		$sidebarid = get_post_meta(get_the_ID(), "page_sidebar");
		if($widgetized == '1' && $sidebarid !=='null' ){
			$cpanel = '<div id="customize_page_panel" class="page_widgetized"><div class="custimize_pp_inner">';
			$cpanel .= '<a href="'.admin_url('/customize.php?autofocus[panel]=widgets&url='.get_the_permalink(get_the_ID()).'').'" class="goto_customizer button button-primary button-large">'. __('Add/Edit Widgets','optimizer').'</a>';
			$cpanel .= '<form id="optimizer_unwidgetizer_form" method="post" action=""><input type="hidden" name="widgetize_pid" value="'.get_the_ID().'" />'.wp_nonce_field( 'optimizer_unwidgetized', 'optimizer_unwidgetized' ).'<input class="button button-large" type="submit" name="unwidgetizer" value="'. __('Remove Widgets & Switch Back to Editor','optimizer').'" /></form>';
			$cpanel .= '</div></div>';
			
		}else{

			$cpanel = '<div id="customize_page_panel"><div class="custimize_pp_inner"><p>'. __('Customize This Page with Widgets like Optimizer Frontpage.','optimizer').'</p>';
			$cpanel .= '<form id="optimizer_widgetizer_form" method="post" action=""><input type="hidden" name="widgetize_pid" value="'.get_the_ID().'" />'.wp_nonce_field( 'optimizer_widgetized', 'optimizer_widgetized' ).'<input class="button button-primary button-large" type="submit" name="widgetizer" value="'. __('Activate','optimizer').'" /></form>';
			$cpanel .= '</div></div>';
			
			}
		
		echo $cpanel;
	}
}
add_action( 'edit_form_after_editor', 'optimizer_below_the_editor' );



//Widgetize The Page WORDPRESS 5.0
add_action('wp_ajax_nopriv_optimizer_widgetizer_new', 'optimizer_widgetizer_new');
add_action('wp_ajax_optimizer_widgetizer_new', 'optimizer_widgetizer_new');
function optimizer_widgetizer_new() {

	if (!wp_verify_nonce($_POST['nonce'], 'optimizer_widgetize_nonce'))
    exit();

    if(isset($_POST['widgetize_pid']) ) {
		global $optimizer;

		//echo(log("page ID:"). absint($_POST['widgetize_pid']));
		$post_id = absint($_POST['widgetize_pid']);
		$post_tt = get_the_title($post_id);
		$post_tt = str_replace(',','',$post_tt);
		if(strpos($post_tt, " ") !== false){
			$pieces = explode(" ", $post_tt);
			$sidebarname = implode(" ", array_splice($pieces, 0, 5));
		}else{
			$sidebarname = get_the_title($post_id);
			$sidebarname = str_replace(',','',$sidebarname);
		}
		$sidebarid = 'optimizer_'.str_replace('%','',sanitize_title($sidebarname));
		$currentsidebars = explode(',',$optimizer['custom_sidebar']);
		
		
		$active_widgets = get_option( 'sidebars_widgets' );
		$active_widgets[ $sidebarid ][] = 'calendar-'.$post_id.'';
		// Assing a default widget
		$activ_about = get_option( 'widget_calendar' );
		$activ_about[ $post_id ] = array ();
		update_option( 'widget_calendar', $activ_about);
		update_option( 'sidebars_widgets', $active_widgets );
		
		//First Add a New Sidebar
		if(!empty($optimizer['custom_sidebar']) && !in_array($sidebarname, $currentsidebars)){  
				$optimizer['custom_sidebar'] = $optimizer['custom_sidebar'].','.$sidebarname;   
				update_option( 'optimizer', $optimizer ); 
		}
		if(empty($optimizer['custom_sidebar'])){   
				$optimizer['custom_sidebar'] = $sidebarname;   
				update_option( 'optimizer', $optimizer ); 
		}
		//Change the page template & Then Assign the newly created sidebar to this page & Then add "widetize" post_meta for identification
		update_post_meta($post_id, "_wp_page_template", "template_parts/page-nocontent_template.php");
		update_post_meta($post_id, "page_sidebar", $sidebarid);
		update_post_meta($post_id, "widgetized", "1");

		//$redirect = admin_url('/customize.php?autofocus[panel]=widgets&url='.get_the_permalink($post_id).''); 
		//wp_redirect( $redirect);
    }
}

//UNWidgetize The Page WORDPRESS 5.0
add_action('wp_ajax_nopriv_optimizer_unwidgetizer_new', 'optimizer_unwidgetizer_new');
add_action('wp_ajax_optimizer_unwidgetizer_new', 'optimizer_unwidgetizer_new');
function optimizer_unwidgetizer_new() {
	
	if (!wp_verify_nonce($_POST['nonce'], 'optimizer_unwidgetize_nonce'))
    exit();
	
	if(isset($_POST['widgetize_pid']) ) {
		global $optimizer;

		$post_id = absint($_POST['widgetize_pid']);
		$post_tt = get_the_title($post_id);
		if(strpos($post_tt, " ") !== false){
			$pieces = explode(" ", $post_tt);
			$sidebarname = implode(" ", array_splice($pieces, 0, 5));
		}else{
			$sidebarname = get_the_title($post_id);
		}
		$sidebarid = 'optimizer_'.str_replace('%','',sanitize_title($sidebarname));
		$currentsidebars = explode(',',$optimizer['custom_sidebar']);
		

		//Then Remove the Custom Sidebar
		if(!empty($optimizer['custom_sidebar']) && in_array($sidebarname, $currentsidebars)){  
					//REMOVE The sidebar from the Optimizer Option
					$key = array_search ($sidebarname, $currentsidebars);
					unset( $currentsidebars[$key] );
					$currentsidebars = rtrim(implode(',',$currentsidebars));
					$optimizer['custom_sidebar'] = $currentsidebars ;    
					update_option( 'optimizer', $optimizer ); 
		}
		
		//Remove the Widgets First
		$active_widgets = get_option( 'sidebars_widgets' );
		unset($active_widgets[$sidebarid]);
		//$active_widgets[ $sidebarid ] = null;
		update_option( 'sidebars_widgets', $active_widgets );
		
		
		//THEN Change the page template & Then Assign the newly created sidebar to this page & Then add "widetize" post_meta for identification
		update_post_meta($post_id, "_wp_page_template", "default");
		update_post_meta($post_id, "page_sidebar", "null");
		update_post_meta($post_id, "widgetized", "");
	}

}	


//Widgetize The Page
add_action( 'shutdown', 'optimizer_widgetizer' );
function optimizer_widgetizer() {

    if(isset($_POST['widgetizer']) && isset($_POST['widgetize_pid']) && check_admin_referer( 'optimizer_widgetized', 'optimizer_widgetized' ) ) {
		global $optimizer;

		//echo(log("page ID:"). absint($_POST['widgetize_pid']));
		$post_id = absint($_POST['widgetize_pid']);
		$post_tt = get_the_title($post_id);
		$post_tt = str_replace(',','',$post_tt);
		if(strpos($post_tt, " ") !== false){
			$pieces = explode(" ", $post_tt);
			$sidebarname = implode(" ", array_splice($pieces, 0, 5));
		}else{
			$sidebarname = get_the_title($post_id);
			$sidebarname = str_replace(',','',$sidebarname);
		}
		$sidebarid = 'optimizer_'.str_replace('%','',sanitize_title($sidebarname));
		$currentsidebars = explode(',',$optimizer['custom_sidebar']);
		
		
		$active_widgets = get_option( 'sidebars_widgets' );
		$active_widgets[ $sidebarid ][] = 'calendar-'.$post_id.'';
		// Assing a default widget
		$activ_about = get_option( 'widget_calendar' );
		$activ_about[ $post_id ] = array ();
		update_option( 'widget_calendar', $activ_about);
		update_option( 'sidebars_widgets', $active_widgets );
		
		//First Add a New Sidebar
		if(!empty($optimizer['custom_sidebar']) && !in_array($sidebarname, $currentsidebars)){  
				$optimizer['custom_sidebar'] = $optimizer['custom_sidebar'].','.$sidebarname;   
				update_option( 'optimizer', $optimizer ); 
		}
		if(empty($optimizer['custom_sidebar'])){   
				$optimizer['custom_sidebar'] = $sidebarname;   
				update_option( 'optimizer', $optimizer ); 
		}
		//Change the page template & Then Assign the newly created sidebar to this page & Then add "widetize" post_meta for identification
		update_post_meta($post_id, "_wp_page_template", "template_parts/page-nocontent_template.php");
		update_post_meta($post_id, "page_sidebar", $sidebarid);
		update_post_meta($post_id, "widgetized", "1");

		//$redirect = admin_url('/customize.php?autofocus[panel]=widgets&url='.get_the_permalink($post_id).''); 
		//wp_redirect( $redirect);
    }
}	

//Un-Widgetize The Page
add_action( 'shutdown', 'optimizer_unwidgetizer' );
add_action('wp_trash_post','optimizer_unwidgetizer');
function optimizer_unwidgetizer($post_id) {
	
	if(!empty($post_id) || (isset($_POST['unwidgetizer']) && isset($_POST['widgetize_pid']) && check_admin_referer( 'optimizer_unwidgetized', 'optimizer_unwidgetized' ) )) {	
		global $optimizer;

		$post_id = $post_id ? $post_id : absint($_POST['widgetize_pid']);
		$post_tt = get_the_title($post_id);
		if(strpos($post_tt, " ") !== false){
			$pieces = explode(" ", $post_tt);
			$sidebarname = implode(" ", array_splice($pieces, 0, 5));
		}else{
			$sidebarname = get_the_title($post_id);
		}
		$sidebarid = 'optimizer_'.str_replace('%','',sanitize_title($sidebarname));
		$currentsidebars = explode(',',$optimizer['custom_sidebar']);
		

		//Then Remove the Custom Sidebar
		if(!empty($optimizer['custom_sidebar']) && in_array($sidebarname, $currentsidebars)){  
         //REMOVE The sidebar from the Optimizer Option
         $key = array_search ($sidebarname, $currentsidebars);
         unset( $currentsidebars[$key] );
         $currentsidebars = rtrim(implode(',',$currentsidebars));
         $optimizer['custom_sidebar'] = $currentsidebars ;    
         update_option( 'optimizer', $optimizer );
		}
		
		//Remove the Widgets First
		$active_widgets = get_option( 'sidebars_widgets' );
		unset($active_widgets[$sidebarid]);
		//$active_widgets[ $sidebarid ] = null;
		update_option( 'sidebars_widgets', $active_widgets );

		//error_log($post_id);
		//THEN Change the page template & Then Assign the newly created sidebar to this page & Then add "widetize" post_meta for identification
		update_post_meta($post_id, "_wp_page_template", "default");
		update_post_meta($post_id, "page_sidebar", "null");
		update_post_meta($post_id, "widgetized", "");
	}

}

/* Add custom column to post list */
add_filter( 'manage_pages_columns' , 'optimizer_customize_column' );
function optimizer_customize_column( $columns ) {
    return array_merge( $columns, 
        array( 'customizer' => __( 'Customize', 'optimizer' ) ) );
}


add_action( 'manage_pages_custom_column', 'optimizer_page_column_content', 10, 2 );
function optimizer_page_column_content( $column_name, $post_id ) {
	if ( $column_name == 'customizer' ) {
		
		$widgetized = get_post_meta(get_the_ID(), "widgetized", true);
		$sidebarid = get_post_meta(get_the_ID(), "page_sidebar");
		
		if($widgetized == '1' && $sidebarid !=='null' ){
			echo '<a href="'.admin_url('/customize.php?autofocus[panel]=widgets&url='.get_the_permalink(get_the_ID()).'').'" class="goto_customizer button button-primary button-large">Customize</a>';
		}
	}
}