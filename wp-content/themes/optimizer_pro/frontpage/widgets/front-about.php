<?php
/*
 *FRONTPAGE - ABOUT WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_about' );

/*
 * Register widget.
 */
function optimizer_register_front_about() {
	register_widget( 'optimizer_front_about' );
}


/*
 * Widget class.
 */
class optimizer_front_About extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'About', 'optimizer' ); }else{ $widgetname = __( '&diams; About Widget', 'optimizer' ); }
		parent::__construct( 'optimizer_front_about', $widgetname, array(
			'classname'   => 'optimizer_front_about aboutblock',
			'description' => __( 'Optimizer About Section widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_about';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_about_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		extract( $args );
		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? $instance['title'] : __('THE OPTIMIZER','optimizer');
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : __('a little about..','optimizer');
		$content = isset( $instance['content'] ) ? apply_filters( 'wp_editor_widget_content', $instance['content'] ) : '<p>'.__('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.','optimizer').'</p>';
		$divider = isset( $instance['divider'] ) ? apply_filters('widget_title', $instance['divider']) : 'fa-stop';
		$aboutwidth = isset( $instance['aboutwidth'] ) ? $instance['aboutwidth'] : '60';
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '#222222';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '#a8b4bf';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '#ffffff';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? esc_url($instance['content_bgimg']) : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
		echo '<div class="text_block_wrap"><div class="center"><div class="about_inner title_'.str_replace('fa-','dvd_',$divider).'">';
		if ( isset($subtitle) || is_customize_preview() ){
			echo '<span class="about_pre">'.do_shortcode($subtitle).'</span>';
		}
		if ( !empty($title) || is_customize_preview() ){
			echo '<h2 class="about_header"><span>'.do_shortcode($title).'</span></h2>';
		}
		if ( $divider ){
			if( $divider !== 'no_divider'){
				if($divider == 'underline'){ $underline= 'title_underline';}else{$underline='';}
					echo '<div class="optimizer_divider '.$underline.' divider_style_'.str_replace('fa-','dvd_',$divider).'"><span class="div_left"></span><span class="div_middle"><i class="fa '.$divider.'"></i></span><span class="div_right"></span></div>';
			}
		}

		if ( $content || is_customize_preview() ){
			//Make inline editable
         if(is_customize_preview()){ $id= $this->id; $controlid = 'data-optionid="widget-'.$id.'-content"';}else{ $controlid = '';}
         
         $responsiveImage =  function_exists( 'wp_filter_content_tags' )  ? wp_filter_content_tags( $content ) : wp_make_content_images_responsive($content);
			
			echo '<div class="about_content tiny_content_editable" '.$controlid.'>'.do_shortcode($responsiveImage).'</div>';
		}
		echo '</div></div></div>';

		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
         echo  '<style>'.$this->generate_css($id, $instance).'</style>';
		}
		
		/* After widget (defined by themes). */
		echo $after_widget;
		
	}



	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		/* No need to strip tags */
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['content'] = wp_kses_post($new_instance['content']);
		$instance['divider'] = strip_tags($new_instance['divider']);
		$instance['aboutwidth'] = strip_tags($new_instance['aboutwidth']);
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
      $instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
      $instance['link_color'] = isset($new_instance['link_color']) ? $new_instance['link_color'] : '';
      $instance['line_height'] = isset($new_instance['line_height']) ? strip_tags($new_instance['line_height']) : '';

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
		'title' => __('THE OPTIMIZER','optimizer'),
		'subtitle' => __('a little about..','optimizer'),
		'content' => __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.','optimizer'),
		'divider' => 'fa-stop',
		'aboutwidth' => '60',
      'title_color' => '#222222',
      'link_color' => '',
      'line_height' => '',
		'content_color' => '#a8b4bf',
		'content_bg' => '#ffffff',
		'content_bgimg' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <div class="optimizer_widget_tab optimizer_widget_tab--content">
         <!-- About Pre Heading Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Pre Heading:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo htmlspecialchars($instance['subtitle'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
         <!-- About Heading Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Heading:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
         
         <!-- About Content Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Content:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>" type="hidden" />
               <a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'content' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
      </div>
        
        
      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         <!-- About Content TITLE DIVIDER Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'divider' ); ?>"><?php _e('Title Divider:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'divider' ); ?>" name="<?php echo $this->get_field_name( 'divider' ); ?>" class="widefat">
                  <option value="underline" <?php if ( 'underline' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Underline', 'optimizer') ?></option>
                  <option value="border-center" <?php if ( 'border-center' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Center)', 'optimizer') ?></option>
                  <option value="border-left" <?php if ( 'border-left' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Left)', 'optimizer') ?></option>
                  <option value="border-right" <?php if ( 'border-right' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Right)', 'optimizer') ?></option>
                  <option value="fa-stop" <?php if ( 'fa-stop' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Rhombus', 'optimizer') ?></option>
               <option value="fa-star" <?php if ( 'fa-star' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Star', 'optimizer') ?></option>
                  <option value="fa-times" <?php if ( 'fa-times' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Cross', 'optimizer') ?></option>
               <option value="fa-bolt" <?php if ( 'fa-bolt' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bolt', 'optimizer') ?></option>
               <option value="fa-asterisk" <?php if ( 'fa-asterisk' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Asterisk', 'optimizer') ?></option>
                  <option value="fa-chevron-down" <?php if ( 'fa-chevron-down' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Chevron', 'optimizer') ?></option>
               <option value="fa-heart" <?php if ( 'fa-heart' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Heart', 'optimizer') ?></option>
               <option value="fa-plus" <?php if ( 'fa-plus' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Plus', 'optimizer') ?></option>
                  <option value="fa-bookmark" <?php if ( 'fa-bookmark' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bookmark', 'optimizer') ?></option>
               <option value="fa-circle-o" <?php if ( 'fa-circle-o' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Circle', 'optimizer') ?></option>
                  <option value="fa-th-large" <?php if ( 'fa-th-large' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Blocks', 'optimizer') ?></option>
               <option value="fa-minus" <?php if ( 'fa-minus' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Sides', 'optimizer') ?></option>
               <option value="fa-cog" <?php if ( 'fa-cog' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Cog', 'optimizer') ?></option>
                  <option value="fa-reorder" <?php if ( 'fa-reorder' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Blinds', 'optimizer') ?></option>
                  <option value="fa-diamond" <?php if ( 'fa-diamond' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Diamond', 'optimizer') ?></option>
                  <option value="fa-gg" <?php if ( 'fa-gg' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Tetris', 'optimizer') ?></option>
                  <option value="fa-houzz" <?php if ( 'fa-houzz' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Digital', 'optimizer') ?></option>
                  <option value="fa-rocket" <?php if ( 'fa-rocket' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Rocket', 'optimizer') ?></option>
                  <option value="no_divider" <?php if ( 'no_divider' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Hide Divider', 'optimizer') ?></option>
            </select>
         </p>
         <!-- About Content Padding left/right Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'aboutwidth' ); ?>"><?php _e('Content Side Padding', 'optimizer') ?></label>
            <input class="widefat optimizer_range_slider" id="<?php echo $this->get_field_id( 'aboutwidth' ); ?>" name="<?php echo $this->get_field_name( 'aboutwidth' ); ?>" value="<?php echo $instance['aboutwidth']; ?>"  min="0" max="100" type="range" />
         </p> 

         
         <!-- About Content Heading Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Heading Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>
         
         
         <!-- About Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>

         <!-- LINK COLOR Style -->
         <p>
            <label for="<?php echo $this->get_field_id( 'link_color' ); ?>"><?php _e('Link Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'link_color' ); ?>" name="<?php echo $this->get_field_name( 'link_color' ); ?>" value="<?php echo $instance['link_color']; ?>" type="text" />
         </p>
                  
         <!-- About Content Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- About Content Background Image Field -->
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
         <?php optimizer_widget_basic_styles($instance, $this, 'about');?>

      </div>

<?php
	}

	//ENQUEUE CSS
   function front_about_enqueue_css() {
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
				wp_add_inline_style( 'optimizer-style', $this->generate_css($id, $instance) );
				
			}//END FOREACH
		} 
   }
      
      
   function generate_css($id, $instance){
      $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#ffffff;';
      $rawbg =		! empty( $instance['content_bg']) ?  $instance['content_bg'] : '#ffffff';
      $title_color =		! empty( $instance['title_color']) ?   $instance['title_color'] : '#222222';
      $content_bgimg =		! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
      $content_color =		! empty( $instance['content_color']) ? 'color: ' . $instance['content_color'] . '!important; ' : 'color:#a8b4bf;';
      $aboutwidth =		isset( $instance['aboutwidth'] ) ? 'width:'.$instance['aboutwidth'].'%;' : 'width:60%;';
      $link_color =	!empty( $instance['link_color'] ) ? 'color:'.$instance['link_color'].';' : $content_color;
      $line_height =	!empty( $instance['line_height'] ) && $instance['line_height'] != 0 ? 'line-height:'.$instance['line_height'].'px;' : '';
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);

      $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg. $font_size. $font_family.$line_height.'}';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .about_header{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= $line_height ? '#'.$id.' .about_content{'.$line_height. '}':'';
      $widget_style .= '#'.$id.' .about_header, #'.$id.' .about_pre, #'.$id.' span.div_middle{color: ' . $title_color . '}';
      $widget_style .= '#'.$id.' span.div_left, #'.$id.' span.div_right{background-color: ' . $title_color . '}';
      $widget_style .= '#'.$id.' .about_content{' . $content_color . '}';
      $widget_style .= '#'.$id.' .about_content a:link, #'.$id.' .about_content a:visited{'.$link_color. '}';
      $widget_style .= '#'.$id.' .about_inner{' . $aboutwidth . '}';  
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }
}
?>