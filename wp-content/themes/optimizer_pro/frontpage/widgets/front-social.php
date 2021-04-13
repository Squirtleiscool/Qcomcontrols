<?php



/* ---------------------------- */
/* -------- Social Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_scoial_widgets' );


/*
 * Register widget.
 */
function ast_scoial_widgets() {
	register_widget( 'ast_scoial_widget' );
}

/*
 * Widget class.
 */
class ast_scoial_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	
	function __construct() {
		parent::__construct( 'ast_scoial_widget', __( 'Social Bookmark', 'optimizer' ), array(
			'classname'   => 'ast_scoial_widget',
			'description' => __( 'An Optimizer Social widget to display your Social Follow Buttons.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_scoial_widget';
		// add_action('wp_enqueue_scripts', array(&$this, 'front_social_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings.*/
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : '';
		$verb = isset( $instance['verb'] ) ? $instance['verb'] : __('Follow Us On','optimizer');
		$style = isset( $instance['style'] ) ? $instance['style'] : 'square_text';
		$icon_color = isset( $instance['icon_color'] ) ? $instance['icon_color'] : '#ffffff';
		
		$facebook_uri = isset( $instance['fb_uri'] ) ? esc_url($instance['fb_uri']) : 'https://www.facebook.com/optimizerwp';
		$twitter_uri = isset( $instance['twt_uri'] ) ? esc_url($instance['twt_uri']) : 'https://twitter.com/optimizerwp';
		$google_uri = isset( $instance['gplus_uri'] ) ? esc_url($instance['gplus_uri']) :'https://plus.google.com/u/0/b/103483167150562533630/+Layerthemes/posts';
		$youtube_uri = isset( $instance['ytb_uri'] ) ? esc_url($instance['ytb_uri']) : '';
		$flickr_uri = isset( $instance['flckr_uri'] ) ? esc_url($instance['flckr_uri']) : '';
		$linkedin_uri = isset( $instance['lnkdn_uri'] ) ? esc_url($instance['lnkdn_uri']) : '';
		$pinterest_uri = isset( $instance['pntrst_uri'] ) ? esc_url($instance['pntrst_uri']) : '';
		$tumblr_uri = isset( $instance['tumblr_uri'] ) ? esc_url($instance['tumblr_uri']) : '';
		$instagram_uri = isset( $instance['insta_uri'] ) ? esc_url($instance['insta_uri']) : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		
		if($style == 'square_text' || $style == 'round_text' || $style == 'full_text' ){ $has_text = 'soc_has_text'; }else{ $has_text = ''; }
		/* Display a containing div */
		echo '<div class="ast_scoial social_style_'. $style .' '.$has_text.'">';
		
		if($icon_color == '#FFFFFF' || $icon_color == '#ffffff'){ $icon_color = ''; }else{ $icon_color = 'style="background-color:'.$instance['icon_color'].'!important;"'; }
		if( $style == 'simple'){ $icon_color = 'style="color:'.$instance['icon_color'].'!important;"'; }	 


		if($facebook_uri){ echo '<a target="_blank" class="ast_wdgt_fb" href="'.$facebook_uri.'" '.$icon_color.'><i class="fa-facebook"></i> <span>'.do_shortcode($verb).' </span></a>'; }
		
		if($twitter_uri){echo '<a target="_blank" class="ast_wdgt_twt" href="'.$twitter_uri.'" '.$icon_color.'><i class="fa-twitter"></i> <span>'.do_shortcode($verb).' </span></a>';}
		
		if($google_uri){echo '<a target="_blank" class="ast_wdgt_gplus" href="'.$google_uri.'" '.$icon_color.'><i class="fa-google-plus"></i> <span>'.do_shortcode($verb).' </span></a>';}		
		
		if($youtube_uri){echo '<a target="_blank" class="ast_wdgt_ytb" href="'.$youtube_uri.'" '.$icon_color.'><i class="fa-youtube-play"></i> <span>'.do_shortcode($verb).' </span></a>';}		
		
		if($flickr_uri){echo '<a target="_blank" class="ast_wdgt_flickr" href="'.$flickr_uri.'" '.$icon_color.'><i class="fa-flickr"></i> <span>'.do_shortcode($verb).' </span></a>';}
		
		if($linkedin_uri){echo '<a target="_blank" class="ast_wdgt_lnkdn" href="'.$linkedin_uri.'" '.$icon_color.'><i class="fa-linkedin"></i> <span>'.do_shortcode($verb).' </span></a>';}		
		
		if($pinterest_uri){echo '<a target="_blank" class="ast_wdgt_pntrst" href="'.$pinterest_uri.'" '.$icon_color.'><i class="fa-pinterest"></i> <span>'.do_shortcode($verb).' </span></a>';	}	
		
		if($tumblr_uri){echo '<a target="_blank" class="ast_wdgt_tmblr" href="'.$tumblr_uri.'" '.$icon_color.'><i class="fa-tumblr"></i> <span>'.do_shortcode($verb).' </span></a>';}	
			
		if($instagram_uri){echo '<a target="_blank" class="ast_wdgt_insta" href="'.$instagram_uri.'" '.$icon_color.'><i class="fa-instagram"></i> <span>'.do_shortcode($verb).' </span></a>';	}	
				

		echo '</div>';
		
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
		$instance['verb'] = strip_tags( $new_instance['verb']);
		$instance['style'] = strip_tags( $new_instance['style']);
      $instance['icon_color'] = optimizer_sanitize_hex( $new_instance['icon_color']);
      $instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
      $instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
		$instance['fb_uri'] = esc_url_raw( $new_instance['fb_uri']);
		$instance['twt_uri'] = esc_url_raw( $new_instance['twt_uri']);
		$instance['gplus_uri'] = esc_url_raw( $new_instance['gplus_uri']);	
		$instance['ytb_uri'] = esc_url_raw( $new_instance['ytb_uri']);
		$instance['flckr_uri'] = esc_url_raw( $new_instance['flckr_uri']);
		$instance['lnkdn_uri'] = esc_url_raw( $new_instance['lnkdn_uri']);
		$instance['pntrst_uri'] = esc_url_raw( $new_instance['pntrst_uri']);
		$instance['tumblr_uri'] = esc_url_raw( $new_instance['tumblr_uri']);
		$instance['insta_uri'] = esc_url_raw( $new_instance['insta_uri']);
		

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'verb' => 'Follow me on',
		'style' => 'square_text',
      'icon_color' => '#ffffff',
      'title_color' => '#222222',
		'content_bg' => '#ffffff',
		'content_bgimg' => '',
		'fb_uri' => 'https://www.facebook.com/optimizerwp',
		'twt_uri' => 'https://twitter.com/optimizerwp',
		'gplus_uri' => 'https://plus.google.com/u/0/b/103483167150562533630/+Layerthemes/posts',
		'ytb_uri' => '',
		'flckr_uri' => '',
		'lnkdn_uri' => '',
		'pntrst_uri' => '',
		'tumblr_uri' => '',
		'insta_uri' => '',
		);
		
      $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      
      <div class="optimizer_widget_tab optimizer_widget_tab--content">

         <!-- Widget Title: Text Input -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlentities($instance['title']); ?>" type="text" />
         </p>
      
         <p>
            <label for="<?php echo $this->get_field_id('verb'); ?>"><?php _e('Follow Text', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('verb'); ?>" id="<?php echo $this->get_field_id('verb'); ?>" value="<?php echo $instance['verb']; ?>" class="widefat" />
         </p>
      
         <p>
            <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Icon Style:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat">
                  <option value="simple" <?php if ( 'simple' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Simple', 'optimizer') ?></option>
               <option value="round" <?php if ( 'round' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Round', 'optimizer') ?></option>
                  <option value="square" <?php if ( 'square' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Square', 'optimizer') ?></option>
               <option value="round_text" <?php if ( 'round_text' == $instance['style']) echo 'selected="selected"'; ?>><?php _e('Round (With Text)', 'optimizer') ?></option>
               <option value="square_text" <?php if ( 'square_text' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Square (With Text)', 'optimizer') ?>
                  <option value="full" <?php if ( 'full' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Full', 'optimizer') ?>
                  <option value="full_text" <?php if ( 'full_text' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Full (With Text)', 'optimizer') ?>
            </select>
         </p>

         <p style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 15px;"><strong><?php _e('Pleace Your Social Links in the fields below and they will be auto detected:','optimizer'); ?></strong></p>

         <p>
            <label for="<?php echo $this->get_field_id('fb_uri'); ?>"><?php _e('Link 1 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('fb_uri'); ?>" id="<?php echo $this->get_field_id('fb_uri'); ?>" value="<?php echo esc_url($instance['fb_uri']); ?>" class="widefat" />
         </p>
         
         <p>
            <label for="<?php echo $this->get_field_id('twt_uri'); ?>"><?php _e('Link 2 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('twt_uri'); ?>" id="<?php echo $this->get_field_id('twt_uri'); ?>" value="<?php echo esc_url($instance['twt_uri']); ?>" class="widefat" />
         </p>
         
         <p>
            <label for="<?php echo $this->get_field_id('gplus_uri'); ?>"><?php _e('Link 3 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('gplus_uri'); ?>" id="<?php echo $this->get_field_id('gplus_uri'); ?>" value="<?php echo esc_url($instance['gplus_uri']); ?>" class="widefat" />
         </p>
         
         <p>
            <label for="<?php echo $this->get_field_id('ytb_uri'); ?>"><?php _e('Link 4 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('ytb_uri'); ?>" id="<?php echo $this->get_field_id('ytb_uri'); ?>" value="<?php echo esc_url($instance['ytb_uri']); ?>" class="widefat" />
         </p>   
         
         <p>
            <label for="<?php echo $this->get_field_id('flckr_uri'); ?>"><?php _e('Link 5 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('flckr_uri'); ?>" id="<?php echo $this->get_field_id('flckr_uri'); ?>" value="<?php echo esc_url($instance['flckr_uri']); ?>" class="widefat" />
         </p>
         
         <p>
            <label for="<?php echo $this->get_field_id('lnkdn_uri'); ?>"><?php _e('Link 6 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('lnkdn_uri'); ?>" id="<?php echo $this->get_field_id('lnkdn_uri'); ?>" value="<?php echo esc_url($instance['lnkdn_uri']); ?>" class="widefat" />
         </p>
         
         
         <p>
            <label for="<?php echo $this->get_field_id('pntrst_uri'); ?>"><?php _e('Link 7 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('pntrst_uri'); ?>" id="<?php echo $this->get_field_id('pntrst_uri'); ?>" value="<?php echo esc_url($instance['pntrst_uri']); ?>" class="widefat" />
         </p>    
         
         <p>
            <label for="<?php echo $this->get_field_id('tumblr_uri'); ?>"><?php _e('Link 8 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('tumblr_uri'); ?>" id="<?php echo $this->get_field_id('tumblr_uri'); ?>" value="<?php echo esc_url($instance['tumblr_uri']); ?>" class="widefat" />
         </p>   
         
         <p>
            <label for="<?php echo $this->get_field_id('insta_uri'); ?>"><?php _e('Link 9 ', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('insta_uri'); ?>" id="<?php echo $this->get_field_id('insta_uri'); ?>" value="<?php echo esc_url($instance['insta_uri']); ?>" class="widefat" />
         </p>
      </div>

      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         <p>
            <label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php _e('Override Default Icons Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" value="<?php echo $instance['icon_color']; ?>" type="text" />
         </p>
         
         <!-- About Content Heading Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Heading Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
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

         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this, 'social',false, true);?>
         
      </div>

	<?php
	}
	
	//ENQUEUE CSS
   function front_social_enqueue_css() {
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
      $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#ffffff;';
      $title_color =		! empty( $instance['title_color']) ?   'color:'.$instance['title_color'].';' : 'color:#222222;';
      $content_bgimg =	! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
      $icon_color =     ! empty( $instance['icon_color']) ?   $instance['icon_color'] : '';
   
      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg.'}';
      $widget_style .= ($title_size || $title_family ||$icon_color) ? '#'.$id.' .widgettitle{' . $title_size . $title_family. $title_color. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= $icon_color && !$icon_color  == '#FFFFFF' ? '#'.$id.' .ast_scoial_widget .ast_scoial a{ background-color:' . $icon_color.'!important;}' : '';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }

}