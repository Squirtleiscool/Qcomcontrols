<?php
/*
 *FRONTPAGE - TEXT SECTION WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_text' );

/*
 * Register widget.
 */
function optimizer_register_front_text() {
	register_widget( 'optimizer_front_text' );
}


/*
 * Widget class.
 */
class optimizer_front_Text extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Advanced Text', 'optimizer' ); }else{ $widgetname = __( '&diams; Advanced Text Widget', 'optimizer' ); }
		parent::__construct( 'optimizer_front_text', $widgetname, array(
			'classname'   => 'optimizer_front_text textblock',
			'description' => __( 'Optimizer Advanced Text Section widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
      $this->alt_option_name = 'optimizer_front_text';
      
		//add_action('wp_enqueue_scripts', array(&$this, 'front_text_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		
		extract( $args );
		/* Our variables from the widget settings. */
		$content = isset( $instance['content'] ) ? apply_filters( 'wp_editor_widget_content', $instance['content'] ) : __('Lorem ipsum dolor sit amet, consectetur dol adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibe.', 'optimizer');
		$padtopbottom = isset( $instance['padtopbottom'] ) ? apply_filters('widget_title', $instance['padtopbottom'] ) : '';
		$paddingside = isset( $instance['paddingside'] ) ? apply_filters('widget_title', $instance['paddingside'] ) : '';
		$parallax = isset( $instance['parallax'] ) ? $instance['parallax'] : '';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? esc_url($instance['content_bgimg']) : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

			if ( !empty($parallax) ){$parallax = 'text_parallax';}else{$parallax = '';}
			
		echo '<div class="text_block '.$parallax.'">
				'.($parallax ? '<div class="parallax_img" data-parallax="scroll" data-image-src="'.$content_bgimg.'"></div>' :'').'
				<div class="text_block_wrap">
				<div class="center">';

			
			if ( $content || is_customize_preview() ){  
					//Make inline editable
					if(is_customize_preview()){ $id= $this->id; $controlid = 'data-optionid="widget-'.$id.'-content"';}else{ $controlid = '';}
					$responsiveImage =  function_exists( 'wp_filter_content_tags' )  ? wp_filter_content_tags( $content ) : wp_make_content_images_responsive($content);
					echo '<div class="text_block_content tiny_content_editable" '.$controlid .'>'.do_shortcode($responsiveImage).'</div>';  
			}
		
		
		echo '</div></div></div>';

      $id= $this->id;
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
         echo  '<style>'.$this->generate_css($id, $instance).'</style>';
		}

		if($parallax){ echo '<script>jQuery(function() { jQuery("#'.$id.' .parallax_img").parallax({naturalHeight: jQuery(this).parent().outerHeight(), bleed: 50, iosFix: true, androidFix: true});  });</script>';}
		
		
		/* After widget (defined by themes). */
		echo $after_widget;
		
	}


	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* No need to strip tags */
		$instance['content'] = wp_kses_post($new_instance['content']);
		$instance['padtopbottom'] = strip_tags($new_instance['padtopbottom']);
		$instance['paddingside'] = strip_tags($new_instance['paddingside']);
		$instance['parallax'] = isset($new_instance['parallax']) ? strip_tags($new_instance['parallax']) : '';
      $instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
      $instance['link_color'] = isset($new_instance['link_color']) ? $new_instance['link_color'] : '';
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
      $instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
      $instance['line_height'] = strip_tags($new_instance['line_height']);

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'content' => __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.','optimizer'),
		'padtopbottom' => '2',
		'paddingside' => '2',
		'parallax' => '',
      'content_color' => '#ffffff',
      'link_color' => '',
      'line_height' => '',
		'content_bg' => '#333333',
		'content_bgimg' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>


      <div class="optimizer_widget_tab optimizer_widget_tab--content">
         <!-- Text Content Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Content:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>" type="hidden" />
               <a onclick="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'content' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
         
         
         <!-- Text Content Padding top/bottom Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'padtopbottom' ); ?>"><?php _e('Top &amp; Bottom Padding', 'optimizer') ?></label>
            <input class="widefat optimizer_range_slider" id="<?php echo $this->get_field_id( 'padtopbottom' ); ?>" name="<?php echo $this->get_field_name( 'padtopbottom' ); ?>" value="<?php echo $instance['padtopbottom']; ?>"  min="0" max="80" type="range" />
         </p>
         
         <!-- Text Content Padding left/right Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'paddingside' ); ?>"><?php _e('Side Padding', 'optimizer') ?></label>
            <input class="widefat optimizer_range_slider" id="<?php echo $this->get_field_id( 'paddingside' ); ?>" name="<?php echo $this->get_field_name( 'paddingside' ); ?>" value="<?php echo $instance['paddingside']; ?>"  min="0" max="80" type="range" />
         </p> 

         <!-- Text Content Parallax Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'parallax' ); ?>"><?php _e('Parallax Effect', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'parallax' ); ?>" name="<?php echo $this->get_field_name( 'parallax' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['parallax'] ) echo 'checked'; ?> />
         </p>
      </div>


      
      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">

         <!-- Text Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>

         <!-- LINK COLOR Style -->
         <p>
            <label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e('Link Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'link_color' ); ?>" name="<?php echo $this->get_field_name( 'link_color' ); ?>" value="<?php echo $instance['link_color']; ?>" type="text" />
         </p>
                  
         <!-- Text Content Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- Text Content Background Image Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bgimg' ); ?>"><?php _e('Background Image', 'optimizer') ?></label>
            <div class="media-picker-wrap">
               <?php if(!empty($instance['content_bgimg'])) { ?>
               <img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['content_bgimg']); ?>" />
                  <i class="fa fa-times media-picker-remove"></i>
               <?php } ?>
               <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'content_bgimg' ); ?>" name="<?php echo $this->get_field_name( 'content_bgimg' ); ?>" value="<?php echo esc_url($instance['content_bgimg']); ?>" type="hidden" />
               <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'content_bgimg' ).'mpick'; ?>"><?php _e('Select Image', 'optimizer') ?></a>
               </div>
         </p>

         <!-- LINE HEIGHT Style -->
         <p>
            <label for="<?php echo $this->get_field_id( 'line_height' ); ?>"><?php _e('Line Height', 'optimizer') ?></label>
            <input class="optimizer_range_slider" id="<?php echo $this->get_field_id( 'line_height' ); ?>" name="<?php echo $this->get_field_name( 'line_height' ); ?>" value="<?php echo !empty($instance['line_height']) ? $instance['line_height'] : 0; ?>" type="range" min="0" max="120" onchange="updateRangeInput(this.value, '<?php echo $this->get_field_id( 'line_height' ); ?>_range', 'px');" />
            <span class="optimizer_range_slider_val" id="<?php echo $this->get_field_id( 'line_height' ); ?>_range"><?php echo !empty($instance['line_height']) && $instance['line_height'] != 0 ? $instance['line_height'].'px' : 'auto'; ?></span>
         </p>
      
         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this, 'text', true);?>

   </div>
  
        
<?php
	}
	//ENQUEUE CSS
   function front_text_enqueue_css() {
      $settings = $this->get_settings();
		if(!is_customize_preview()){
         if ( empty( $settings ) ) {
            return;
         }
         foreach ( $settings as $instance_id => $instance ) {
            $id = $this->id_base . '-' . $instance_id;
            if ( ! is_active_widget( false, $id, $this->id_base ) ) {
               continue;
            }
            //error_log($id.json_encode($instance));
            wp_add_inline_style( 'optimizer-style', $this->generate_css($id, $instance) );
         }
      }
   }
   
      
   function generate_css($id, $instance){
      $content_bgimg =	!empty( $instance['content_bgimg'] ) ? 'background-image:url(' . $instance['content_bgimg'] . ');' : '';
      $content_bg =		!empty( $instance['content_bg'] ) ? 'background-color:'.$instance['content_bg'].';' : 'background-color:#333333;';
      $padtopbottom =		isset( $instance['padtopbottom'] ) ? 'padding-top:'.$instance['padtopbottom'].'%;padding-bottom:'.$instance['padtopbottom'].'%;' : 'padding-top:5%;padding-bottom:5%;';
      $paddingside =		isset( $instance['paddingside'] ) ? 'padding-left:'.$instance['paddingside'].'%;padding-right:'.$instance['paddingside'].'%;' : 'padding-left:5%;padding-right:5%;';
      $content_color =	!empty( $instance['content_color'] ) ? 'color:'.$instance['content_color'].';' : 'color:#ffffff;';
      $link_color =	!empty( $instance['link_color'] ) ? 'color:'.$instance['link_color'].';' : $content_color;
      $line_height =	!empty( $instance['line_height'] ) && $instance['line_height'] != 0 ? 'line-height:'.$instance['line_height'].'px;' : '';
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';
      
      //error_log('$line_height: '.json_encode($instance));
      //Basic Styles
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);

      $widget_style = '#'.$id.' .text_block{ ' . $content_bg . $content_bgimg. $content_color. $font_size. $font_family.$paddingside.$padtopbottom.'}';
      $widget_style .= '#'.$id.' .text_block a:link, #'.$id.' .text_block a:visited{'.$link_color. '}';
      $widget_style .= $line_height ? '#'.$id.' .text_block_wrap{'.$line_height. '}':'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= $content_bgimg ? '@media screen and (max-width: 480px){#'.$id.' .text_block .parallax_img{'.$content_bgimg.'}} ' : ''; 
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' .text_block{'.$marginPadding[0].'} .frontpage_sidebar #'.$id.' {'.$marginPadding[1].'} } ';
      return $widget_style;
   } 
}
?>