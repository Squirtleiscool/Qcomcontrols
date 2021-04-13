<?php


/* ---------------------------- */
/* -------- Video Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'optimizer_front_videos' );


/*
 * Register widget.
 */
function optimizer_front_videos() {
	register_widget( 'optimizer_front_video' );
}

/*
 * Widget class.
 */
class optimizer_front_Video extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */


	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Video', 'optimizer' ); }else{ $widgetname = __( '&diams; Video Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_video', $widgetname, array(
			'classname'   => 'optimizer_front_video videoblock optimizer_front_video',
			'description' => __( 'A Responsive Video widget that let\'s you display your Youtube, Vimeo and Custom videos.', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_video';
		// add_action('wp_enqueue_scripts', array(&$this, 'front_video_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ?  $instance['title'] : __('Check Out This Video','optimizer');
		
		$video_uri = isset( $instance['video_uri'] ) ? $instance['video_uri'] : 'https://vimeo.com/86472013';
		$customvdo = isset( $instance['customvdo'] ) ? $instance['customvdo'] : '';
		$vdothumb = isset( $instance['vdothumb'] ) ? $instance['vdothumb'] : '';
		$autoplay = isset( $instance['autoplay'] ) ? $instance['autoplay'] : '';
		$border = isset( $instance['border'] ) ? $instance['border'] : '';
		$content = isset( $instance['content'] ) ? apply_filters( 'wp_editor_widget_content', $instance['content'] ) : __('Sustainable messenger bag Thundercats mixtape typewriter, locavore synth Marfa Intelligentsia try-hard biodiesel four loko distillery. ','optimizer');
		$contentposition = isset( $instance['contentposition'] ) ? $instance['contentposition'] : 'right';
		
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '#00214c';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '#eff9f9';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
		/* Display a containing div */
		if($border == '1'){$border = 'bordered_video';}
		
		echo '<div class="optimizer_video_wrap video_'.$contentposition.' '.$border.'">';
			if ( !empty($title) || !empty($content) ){
				echo '<div class="widget_video_content">';
						if ( !empty($title) || is_customize_preview()  ){
							echo '<h3 class="widgettitle">'.do_shortcode($title).'</h3>';
						}
						if ( !empty($content) || is_customize_preview() ){
							//Make inline editable
							if(is_customize_preview()){ $id= $this->id; $controlid = 'data-optionid="widget-'.$id.'-content"';}else{ $controlid = '';}
							
							echo '<div class="video_content_inner tiny_content_editable" '.$controlid.'>'.do_shortcode($content).'</div>';
						}
				echo '</div>';
			}
			
			

			$class1=''; $class2=''; $class3='';
			if(strpos($video_uri, 'youtu.be') !== false || strpos($video_uri, 'youtube.com') !== false){  $class1='astytb';  }
			if (strpos($video_uri,'vimeo.com') !== false) {  $class1='astvimeo';  }
			if(strpos($video_uri,'vimeo.com') !== false && $autoplay == ''){$class2 ='hidecontrols';}
			if(strpos($video_uri, 'youtu.be') !== false || strpos($video_uri, 'youtube.com') !== false && $autoplay == '1' && $contentposition == 'on_video'){  $class3='hidecontrols';  }
			
			echo '<div class="ast_video '.$class1.' '.$class2.' '.$class3.'">';
			
			
			//CUSTOM VIDEO -------If has Custom Video Show Custom Video. Else youtube/vimeo
			if(!empty($customvdo )){
				if($autoplay == '1'){$autoplay = 'true';}
				if( $autoplay == 'true' && $contentposition == 'on_video'){ $hidecontrols ='hidecontrols'; $loop='true';  }else{ $hidecontrols ='';  $loop='false'; }
				
				echo '<div class="custom_vdo_wrap '.$hidecontrols.'">';
					echo do_shortcode('[video src="'.$customvdo.'" autoplay="'.$autoplay.'" loop="'.$loop.'" poster="'.$vdothumb.'"]'); 
				echo '</div>';
				
			}else{
				$video_uri = strip_tags($video_uri);
				
				//YOUTUBE VIDEO
				if(strpos($video_uri, 'youtu.be') !== false || strpos($video_uri, 'youtube.com') !== false){
					
					$auto = wp_oembed_get($video_uri);
					$idraw = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_uri, $match);
    				$id = $match[1];
					$widgetid = str_replace("-", "_", $this->id);
					if( $autoplay == '1' && $contentposition == 'on_video'){  $loop='data-video-loop=1';  }else{  $loop=''; }
					
					if(!empty($vdothumb )){
						$thumbid = $vdothumb;
					}else{
						if($contentposition == 'on_video' || $contentposition == 'top'){ 
							$thumbid = 'https://img.youtube.com/vi/'.$id.'/maxresdefault.jpg';
						}else{
							$thumbid = 'https://img.youtube.com/vi/'.$id.'/hqdefault.jpg';
						}
					}
					
					if($autoplay == ''){  echo '<i id="play-button_'.$widgetid.'" class="fa fa-play"></i><img id="ytb_thumb_'.$this->id.'" class="ytb_thumb ytb_video_'.$id.'" src="'.$thumbid.'" alt="'.__("Youtube Video","optimizer").'" />';  }
					
					echo '<div class="ast_vid"><div class="responsive-container"><div class="ytb_widget_iframe" data-video-id="'.$id .'" data-autoplay="'.$autoplay .'" data-position="'.$contentposition .'" id="ytb_'.$widgetid.'" '.$loop.'></div></div></div>';
					
					if($autoplay == '1'){
					echo '<script>
							var tag = document.createElement("script");
							tag.src = "https://www.youtube.com/player_api";
							var firstScriptTag = document.getElementsByTagName("script")[0];
							firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
						</script>';
					}
							
				}
				
				//VIMEO VIDEO
				if (strpos($video_uri,'vimeo.com') !== false) {
					$auto = wp_oembed_get($video_uri);
					$widgetid = str_replace("-", "_", $this->id);
					$autoplayClass = '';
					if( $autoplay == '1' && $contentposition == 'on_video'){  $loop='&loop=1'; $mute= '&background=1';  }else{  $loop='';$mute= ''; }
					
					if(!empty($vdothumb )){$vimeothumb = '<img id="vim_thumb_'.$this->id.'" class="vim_thumb vim_video_'.$id.'" src= "'.$vdothumb.'" '.optimizer_image_attr( esc_url($vdothumb) ).' alt="'.__("Youtube Video","optimizer").'" />';}else{$vimeothumb ='';}
					
					if( $autoplay == '1'){
						$vimbutton = '';
					}else{ 
						$vimbutton = '<i id="play-button_'.$widgetid.'" class="fa fa-play"></i>'.$vimeothumb.''; 
					}
					
					echo $vimbutton;
					
					if($autoplay == '1'){ 
						$autoplayClass = 'autoPlay_vim';
						$return = preg_replace('@vimeo.com/video/([^"&]*)@', 'vimeo.com/video/$1&autoplay=1&api=1'.$loop.$mute.'', $auto); 
					}else{ 
						$return = preg_replace('@vimeo.com/video/([^"&]*)@', 'vimeo.com/video/$1?api=1', $auto);
						$return = str_replace( 'allowfullscreen>', 'allowfullscreen id="player_'.$widgetid.'">', $return );
					}
					
					echo '<div class="ast_vid '.$autoplayClass.'"><div class="responsive-container" data-thumb="'.$vdothumb.'">'.$return.'</div></div>';
				}
				
			} //If Custom video ENDS
			
			echo '</div>';

			
		echo '</div>';

		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
         echo  '<style>'.$this->generate_css($id, $instance).'</style>';
      }

		/* After widget (defined by themes). */
		echo $after_widget;
		
		//Enque Vimeo Video Script
		if (strpos($video_uri,'vimeo.com') !== false) {
			wp_enqueue_script('froogaloop', 'https://f.vimeocdn.com/js/froogaloop2.min.js', array('jquery'), true);
		}
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
      $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_uri'] = esc_url_raw( $new_instance['video_uri']);
		$instance['customvdo'] = esc_url_raw( $new_instance['customvdo']);
		$instance['vdothumb'] = esc_url_raw( $new_instance['vdothumb']);
		$instance['autoplay'] = isset( $new_instance['autoplay']) ? absint( $new_instance['autoplay']) : '';	
		$instance['border'] = isset( $new_instance['border']) ? absint( $new_instance['border']) : '';		
		$instance['content'] = wp_kses_post($new_instance['content']);
		$instance['contentposition'] = strip_tags( $new_instance['contentposition']);	
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
      $instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */

	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => __('Check Out This Video','optimizer'),
		'video_uri' => 'https://vimeo.com/86472013',
		'customvdo' => '',
		'vdothumb' => '',
		'autoplay' => '',
		'border' => '',
		'content' => __('Sustainable messenger bag Thundercats mixtape typewriter, locavore synth Marfa Intelligentsia try-hard biodiesel four loko distillery. ','optimizer'),
		'contentposition' => 'right',
		'content_color' => '#00214c',
      'content_bg' => '#eff9f9',
      'content_bgimg' => '',
		);
		
      $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      
      <div class="optimizer_widget_tab optimizer_widget_tab--content">
         <!-- Widget Title: Text Input -->
         <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" class="widefat" />
         </p>

      
         <!-- Youtube or Vimeo Video url Field -->
         <p>
            <label for="<?php echo $this->get_field_id('video_uri'); ?>"><?php _e('Youtube or Vimeo Video url', 'optimizer'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('video_uri'); ?>" id="<?php echo $this->get_field_id('video_uri'); ?>" value="<?php echo esc_url($instance['video_uri']); ?>" class="widefat" />
         </p>

         
         <!-- Custom Video Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'customvdo' ); ?>"><?php _e('Custom Video (.mp4)', 'optimizer') ?></label>
            <div class="media-picker-wrap video-picker-wrap">
               <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'customvdo' ); ?>" name="<?php echo $this->get_field_name( 'customvdo' ); ?>" value="<?php echo esc_url($instance['customvdo']); ?>" type="text" />
               <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'customvdo' ).'mpick'; ?>"><?php _e('Select', 'optimizer') ?></a>
               </div>
         </p>

         
         <!-- Video Autoplay Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e('Autoplay Video', 'optimizer') ?>
               </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['autoplay'] ) echo 'checked'; ?> />
         </p>
         
         <!-- Video Border Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'border' ); ?>"><?php _e('Display Border Around Video', 'optimizer') ?>
               </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'border' ); ?>" name="<?php echo $this->get_field_name( 'border' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['border'] ) echo 'checked'; ?> />
         </p>
         
         
         <!-- Video Thumbnail Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'vdothumb' ); ?>"><?php _e('Video Thumbnail', 'optimizer') ?></label>
            <div class="media-picker-wrap">
                  <?php if(!empty($instance['vdothumb'])) { ?>
                     <img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['vdothumb']); ?>" />
                     <i class="fa fa-times media-picker-remove"></i>
                  <?php } ?>
               <input class="widefat media-picker vdothumb-picker" id="<?php echo $this->get_field_id( 'vdothumb' ); ?>" name="<?php echo $this->get_field_name( 'vdothumb' ); ?>" value="<?php echo esc_url($instance['vdothumb']); ?>" type="text" />
               <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'vdothumb' ).'mpick'; ?>"><?php _e('Select Image', 'optimizer') ?></a>
               </div>
         </p> 
         
         <!-- Video Content Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Content:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>" type="hidden" />
               <a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'content' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
         
         
         <!-- Video Content Position Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'contentposition' ); ?>"><?php _e('Content Position:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'contentposition' ); ?>" name="<?php echo $this->get_field_name( 'contentposition' ); ?>">
               <option value="right" <?php if ( 'right' == $instance['contentposition'] ) echo 'selected="selected"'; ?>><?php _e('Right','optimizer') ?></option>
               <option value="left" <?php if ( 'left' == $instance['contentposition'] ) echo 'selected="selected"'; ?>><?php _e('Left', 'optimizer') ?></option>
                  <option value="top" <?php if ( 'top' == $instance['contentposition'] ) echo 'selected="selected"'; ?>><?php _e('Top', 'optimizer') ?></option>
               <option value="on_video" <?php if ( 'on_video' == $instance['contentposition'] ) echo 'selected="selected"'; ?>><?php _e('On Video', 'optimizer') ?></option>
            </select>
         </p>
      </div>
      

      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         
         <!-- Video Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>
                  
         <!-- Video Content Background Color Field -->
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
      

         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this, 'video');?>

      </div>
   
   
<?php
	}
	//ENQUEUE CSS
   function front_video_enqueue_css() {
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
		}//END FOREACH
   } 
   
   function generate_css($id, $instance){
      $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#eff9f9;';
      $content_bgimg =	!empty( $instance['content_bgimg'] ) ? 'background-image:url(' . $instance['content_bgimg'] . ');' : '';
      $content_color =		! empty( $instance['content_color']) ? 'color: ' . $instance['content_color'] . '!important; ' : 'color:#00214c;';

      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg . $content_color. $font_size. $font_family.'}';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .widgettitle{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }

}
		
?>