<?php

/* ---------------------------- */
/* -------- Coundown Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_countdown_widgets' );

function optimizer_datepicker(){
  wp_enqueue_script('jquery-ui-datepicker');
}
add_action('admin_enqueue_scripts', 'optimizer_datepicker');

/*
 * Register widget.
 */
function ast_countdown_widgets() {
	register_widget( 'ast_countdown_widget' );
}

/*
 * Widget class.
 */
class ast_countdown_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	
	function __construct() {
		parent::__construct( 'ast_countdown_widget', __( 'Countdown', 'optimizer' ), array(
			'classname'   => 'optim_countdown_widget',
			'description' => __( 'An Optimizer widget to display a Countdown.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_countdown_widget';
		add_action('wp_enqueue_scripts', array(&$this, 'front_countdown_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : __('Minutes to Midnight','optimizer');
		$desc = isset( $instance['desc'] ) ? $instance['desc'] : __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence.','optimizer');
		$day = isset( $instance['day'] ) ? $instance['day'] : '11/27/2016';
		$hour = isset( $instance['hour'] ) ? $instance['hour'] : '00';
		$minute = isset( $instance['minute'] ) ? $instance['minute'] : '00';
		$seconds = isset( $instance['seconds'] ) ? $instance['seconds'] : '00';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'circle_trans';	
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '#666E73';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '#666E73';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '#F2F9FD';	
		$content_bgimg = isset( $instance['content_bgimg'] ) ? $instance['content_bgimg'] : '';	

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display a containing div */
 		if(!empty($content_bgimg)){ $hasbgimg = 'hasbgimg';}else{$hasbgimg = '';}
		echo '<div class="ast_countdown '.$hasbgimg.'">';
			if ( $title ){
				echo $before_title . $title . $after_title;
			}
			
			if ( $desc || is_customize_preview() ) {
				echo '<div class="ast_count"><span class="countdown_content">'.$desc.' </span></div>';
			}
			echo '<ul id="countdown" class="countdown_'.$style.'" data-countdown="'.$day.' '.$hour.':'.$minute.':'.$seconds.'"></ul>';

		echo '</div>';


		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
			
			echo '<script>jQuery(window).on("load", function(){
					jQuery("#'.$id.'").each(function(index, element) {
						jQuery(this).find(".ast_countdown ul").countdown(jQuery(this).find(".ast_countdown ul").attr("data-countdown")).on("update.countdown", function(event) {
					   jQuery(this).html(event.strftime(""
						+ "<li><span class=\'days\'>%D</span><p class=\'timeRefDays\'>'.__('Days', 'optimizer').'</p></li>"
						+ "<li><span class=\'hours\'>%H</span><p class=\'timeRefHours\'>'.__('Hours', 'optimizer').'</p></li>"
						+ "<li><span class=\'minutes\'>%M</span><p class=\'timeRefMinutes\'>'.__('Min', 'optimizer').'</p></li>"
						+ "<li><span class=\'seconds\'>%S</span><p class=\'timeRefSeconds\'>'.__('Sec', 'optimizer').'</p></li>"));
						});
					});
				});</script>';
			
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
      $instance['desc'] = wp_kses_post($new_instance['desc']) ;		
      $instance['day'] = strip_tags( $new_instance['day'] );
		$instance['hour'] = strip_tags( $new_instance['hour'] );
		$instance['minute'] = strip_tags( $new_instance['minute'] );
		$instance['seconds'] = strip_tags( $new_instance['seconds'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
		$instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);

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
		'title' => __('Minutes to Midnight','optimizer'),
		'desc' => __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence.','optimizer'),		
		'day' => '11/27/2016',
		'hour' => '00',
		'minute' => '00',
		'seconds' => '00',
		'style' => 'circle_trans',
		'title_color' => '#666E73',
		'content_color' => '#666E73',
		'content_bg' => '#F2F9FD',
		'content_bgimg' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
   
      <div class="optimizer_widget_tab optimizer_widget_tab--content">
            <!-- Widget Title: Text Input -->
         <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
         </p>
         
            <p>
            <label><?php _e('Description', 'optimizer'); ?></label>
            <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $instance['desc']; ?></textarea>
            </p>
            
            
         <p>
         <label><?php _e('Set Countdown Date', 'optimizer'); ?></label>
            <input style="display:inline;" type="text" class="widefat ast_date" name="<?php echo $this->get_field_name('day'); ?>" id="<?php echo $this->get_field_id('day'); ?>" value="<?php echo $instance['day']; ?>" placeholder="mm/dd/yyyy"></p>
            

            
            <p>
            <label><?php _e('Set Countdown Time', 'optimizer'); ?></label>
            <input style="display:inline;width:50px;" type="text" size="3" name="<?php echo $this->get_field_name('hour'); ?>" id="<?php echo $this->get_field_id('hour'); ?>" value="<?php echo $instance['hour']; ?>">:
            <input style="display:inline;width:50px;" type="text" size="3" name="<?php echo $this->get_field_name('minute'); ?>" id="<?php echo $this->get_field_id('minute'); ?>" value="<?php echo $instance['minute']; ?>">:
            <input style="display:inline;width:50px;" type="text" size="3" name="<?php echo $this->get_field_name('seconds'); ?>" id="<?php echo $this->get_field_id('seconds'); ?>" value="<?php echo $instance['seconds']; ?>">
            <div>
            <span style="width:50px; text-align:center; display: inline-block;">Hours</span>
            <span style="width:50px; text-align:center; margin-right:5px;display: inline-block;">Minutes</span>
            <span style="width:50px; text-align:center;display: inline-block;">Seconds</span>
            </div>


         </p>
         
            <p>
               <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Coundtown Style:', 'optimizer') ?></label>
               <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat">
                  <option value="circle_trans" <?php if ( 'circle_trans' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Circle (Transparent)', 'optimizer') ?></option>
                  <option value="circle_white" <?php if ( 'circle_white' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Circle (White)', 'optimizer') ?></option>
                     <option value="circle_black" <?php if ( 'circle_black' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Circle (Black)', 'optimizer') ?></option>
                     <option value="square_trans" <?php if ( 'square_trans' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Square (Transparent)', 'optimizer') ?></option>
                  <option value="square_white" <?php if ( 'square_white' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Square (White)', 'optimizer') ?></option>
                     <option value="square_black" <?php if ( 'square_black' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Square (Black)', 'optimizer') ?></option>
                  <option value="skewed_trans" <?php if ( 'skewed_trans' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Skewed (Transparent)', 'optimizer') ?></option>
                  <option value="skewed_white" <?php if ( 'skewed_white' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Skewed (White)', 'optimizer') ?></option>
                     <option value="skewed_black" <?php if ( 'skewed_black' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Skewed (Black)', 'optimizer') ?></option>
                  <option value="diamond_trans" <?php if ( 'diamond_trans' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Diamond (Transparent)', 'optimizer') ?></option>
                  <option value="diamond_white" <?php if ( 'diamond_white' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Diamond (White)', 'optimizer') ?></option>
                     <option value="diamond_black" <?php if ( 'diamond_black' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Diamond (Black)', 'optimizer') ?></option>
               </select>
            </p>

      </div>
      

      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
        
         <!-- Countdown Content Title Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Title Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>
      
      
         <!-- Countdown Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>
                  
         <!-- Countdown Content Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- Countdown Content Background Image -->
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
         
         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this, 'countdown');?>

      </div>
		
	<?php
	}

   //ENQUEUE CSS
   function front_countdown_enqueue_css() {
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
         }
		}
   } 
   
   function generate_css($id, $instance){
      $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#F2F9FD;';
      $title_color =		! empty( $instance['title_color']) ?   'color: ' . $instance['title_color'].';' : 'color:#666E73;';
      $content_bgimg =	! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
      $content_color =	! empty( $instance['content_color']) ? 'color: ' . $instance['content_color'] . '!important; ' : 'color:#666E73;';
      $content_rgba =   ! empty( $instance['content_color']) ?  $instance['content_color']  : '#666E73';
               
      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg. $font_size. $font_family.$content_color.'}';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '#'.$id.' .widget_wrap{' . $content_color . '}';
      $widget_style .= '#'.$id.' .widget_wrap .widgettitle{' . $title_color. $title_size . $title_family . '}';
      $widget_style .= '#'.$id.' .widget_wrap .ast_countdown li{color:rgba('.optimizer_hex2rgb($content_rgba).', 0.8)!important;}';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }
}