<?php
/*
 *FRONTPAGE - Newsletter WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_newsletter' );

/*
 * Register widget.
 */
function optimizer_register_front_newsletter() {
	register_widget( 'optimizer_front_newsletter' );
}

/*
 * Widget class.
 */
class optimizer_front_Newsletter extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Newsletter', 'optimizer' ); }else{ $widgetname = __( '&diams; Newsletter Widget', 'optimizer' ); }
		parent::__construct( 'optimizer_front_newsletter', $widgetname, array(
			'classname'   => 'optimizer_front_newsletter newsletterblock',
			'description' => __( 'Optimizer Newsletter widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_newsletter';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_newsletter_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		extract( $args );
		/* Our variables from the widget settings. */
		$form = isset( $instance['form'] ) ? $instance['form'] : '';
		$content = isset( $instance['content'] ) ? apply_filters( 'wp_editor_widget_content', $instance['content'] ) : '<p style="text-align: center;"><span style="font-size: 30px; color:#333;"><strong>STAY UPDATED. JOIN OUR EMAIL LIST!</strong></span></p><p style="text-align: center;">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</p>';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '#99a5b1';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '#e8ecf0';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? esc_url($instance['content_bgimg']) : '';
		
		$button_color = isset( $instance['button_color'] ) ? $instance['button_color'] : '#ffffff';
		$button_bg = isset( $instance['button_bg'] ) ? $instance['button_bg'] : '#a8b4bf';
		$formposition = isset( $instance['formposition'] ) ? apply_filters('widget_title', $instance['formposition']) : 'center';
		$formstyle = isset( $instance['formstyle'] ) ? apply_filters('widget_title', $instance['formstyle']) : 'simple';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
			if(!empty($content_bgimg)){ $hasbg ='nwsltr_hasbg';}else{ $hasbg =''; }
		
		echo '<div class="text_block_wrap"><div class="center"><div class="newsletter_inner formspos_'.$formposition.' formstyle_'.$formstyle.' '.$hasbg.'">';


		if ( $content || is_customize_preview() ){
			//Make inline editable
			if(is_customize_preview()){ $id= $this->id; $controlid = 'data-optionid="widget-'.$id.'-content"';}else{ $controlid = '';}
			$responsiveImage =  function_exists( 'wp_filter_content_tags' )  ? wp_filter_content_tags( $content ) : wp_make_content_images_responsive($content);
			echo '<div class="newsletter_content tiny_content_editable" '.$controlid.'>'.do_shortcode($responsiveImage).'</div>';
		}
		
		if ( $form){
			echo '<div class="optim_newsletter_form">'.do_shortcode($form).'</div>';
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
		
		/* No need to strip tags */
		$instance['content'] = wp_kses_post($new_instance['content']);
		$instance['form'] = optimizer_sanitize_html($new_instance['form']);
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
		$instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
		
		$instance['button_color'] = optimizer_sanitize_hex($new_instance['button_color']);
		$instance['button_bg'] = optimizer_sanitize_hex($new_instance['button_bg']);
		$instance['formposition'] = strip_tags($new_instance['formposition']);
		$instance['formstyle'] = strip_tags($new_instance['formstyle']);


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
		'content' => 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.',
		'form' => '',
		'formposition' => 'center',
		'formstyle' => 'simple',
		'button_color' => '#ffffff',
		'button_bg' => '#a8b4bf',
		'content_color' => '#99a5b1',
		'content_bg' => '#e8ecf0',
		'content_bgimg' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <div class="optimizer_widget_tab optimizer_widget_tab--content">    
         <!-- Newsletter Content Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Content:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>" type="hidden" />
               <a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'content' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
         
         
         <!-- Newsletter FORM Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'form' ); ?>"><?php _e('Newsletter Form HTML or Shortcode', 'optimizer') ?></label>
               <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>"><?php echo $instance['form']; ?></textarea>
         </p>


         <!-- Newsletter Content Positon Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'formposition' ); ?>"><?php _e('Content Position:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'formposition' ); ?>" name="<?php echo $this->get_field_name( 'formposition' ); ?>" class="widefat">
                  <option value="left" <?php if ( 'left' == $instance['formposition'] ) echo 'selected="selected"'; ?>><?php _e('Content Left | Form Right', 'optimizer') ?></option>
                  <option value="right" <?php if ( 'right' == $instance['formposition'] ) echo 'selected="selected"'; ?>><?php _e('Content Right | Form Left', 'optimizer') ?></option>
                  <option value="bothleft" <?php if ( 'bothleft' == $instance['formposition'] ) echo 'selected="selected"'; ?>><?php _e('Content Left | Form Left', 'optimizer') ?></option>
                  <option value="bothright" <?php if ( 'bothright' == $instance['formposition'] ) echo 'selected="selected"'; ?>><?php _e('Content Right | Form Right', 'optimizer') ?></option>
                  <option value="center" <?php if ( 'center' == $instance['formposition'] ) echo 'selected="selected"'; ?>><?php _e('Center', 'optimizer') ?></option>
            </select>
		   </p>


        <!-- Newsletter Form Style Field -->
        <p>
            <label for="<?php echo $this->get_field_id( 'formstyle' ); ?>"><?php _e('Form Style:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'formstyle' ); ?>" name="<?php echo $this->get_field_name( 'formstyle' ); ?>" class="widefat">
                  <option value="simple" <?php if ( 'simple' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Simple', 'optimizer') ?></option>
                  <option value="borderw" <?php if ( 'borderw' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (White)', 'optimizer') ?></option>
                  <option value="borderb" <?php if ( 'borderb' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Black)', 'optimizer') ?></option>
                  <option value="stylish" <?php if ( 'stylish' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Stylish', 'optimizer') ?></option>
                  <option value="modern" <?php if ( 'modern' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Modern', 'optimizer') ?></option>
                  <option value="mail" <?php if ( 'mail' == $instance['formstyle'] ) echo 'selected="selected"'; ?>><?php _e('Envelope', 'optimizer') ?></option>
            </select>
		   </p>

      </div>



      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         
         <!-- Newsletter Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>
                  
                  
         
         <!-- Newsletter Button Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'button_color' ); ?>"><?php _e('Button Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'button_color' ); ?>" name="<?php echo $this->get_field_name( 'button_color' ); ?>" value="<?php echo $instance['button_color']; ?>" type="text" />
         </p>
         
         
         <!-- Newsletter Button Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'button_bg' ); ?>"><?php _e('Button background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'button_bg' ); ?>" name="<?php echo $this->get_field_name( 'button_bg' ); ?>" value="<?php echo $instance['button_bg']; ?>" type="text" />
         </p>
         
         
         <!-- Newsletter Content Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- Newsletter Content Background Image Field -->
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
         <?php optimizer_widget_basic_styles($instance, $this, 'newsletter', true);?>

      </div>
<?php
	}
	   //ENQUEUE CSS
      function front_newsletter_enqueue_css() {
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
            } //END FOREACH
      }

      function generate_css($id, $instance){
         $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#e8ecf0;';
         $content_bgimg =		! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
         $content_color =		! empty( $instance['content_color']) ? 'color: ' . $instance['content_color'] . '!important; ' : 'color:#99a5b1;';
         $button_color =		! empty( $instance['button_color']) ? 'color: ' . $instance['button_color'] . '!important; ' : 'color:#ffffff;';
         $button_bg =		! empty( $instance['button_bg']) ? 'background-color: ' . $instance['button_bg'] . '!important; ' : 'background-color:#a8b4bf;';
                  
         //Basic Styles
         $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
         $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
         $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
         $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
         $marginPadding = optimizer_widget_paddingMargin($id, $instance);
         $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

         $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg. $font_size. $font_family.'}';
         $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
         $widget_style .= '#'.$id.' .optim_newsletter_form .button, #'.$id.' .optim_newsletter_form input[type="button"], #'.$id.' .optim_newsletter_form input[type="submit"], #'.$id.' .optim_newsletter_form button{' . $button_bg . '' . $button_color . '}   ';
         $widget_style .= '#'.$id.' .newsletter_content, #'.$id.' .optim_newsletter_form, #'.$id.' .optim_newsletter_form .ctct-embed-signup >div{' . $content_color . '}';
         $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
         
         return $widget_style;
      }

	}
?>