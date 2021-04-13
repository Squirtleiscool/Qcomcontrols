<?php
/*
 *FRONTPAGE - SLIDER WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_slider' );

/*
 * Register widget.
 */
function optimizer_register_front_slider() {
	register_widget( 'optimizer_front_slider' );
}


/*
 * Widget class.
 */
class optimizer_front_Slider extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Slider', 'optimizer' ); }else{ $widgetname = __( '&diams; Slider Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_slider', $widgetname, array(
			'classname'   => 'optimizer_front_slider sliderblock',
			'description' => __( 'Optimizer Slider Widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_slider';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_slider_enqueue_css'));
		add_action('wp_footer', array(&$this,  'optimizer_slider_widget_js'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		extract( $args );
		$content = isset( $instance['content'] ) ? apply_filters( 'wp_editor_widget_content', $instance['content'] ) : '';
		$slider_caption = isset( $instance['slider_caption'] ) ? $instance['slider_caption'] : '';
		$slider = isset( $instance['slider_images'] ) ? $instance['slider_images'] : '';
		$slider_height = isset( $instance['slider_height'] ) ? $instance['slider_height'] : '';
		$slider_type = isset( $instance['slider_type'] ) ? $instance['slider_type'] : 'nivo';
		$slider_nav = isset( $instance['slider_nav'] ) ? $instance['slider_nav'] : 'slider_nav_default';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '#ffffff';
		$slider_pausetime = isset( $instance['slider_pausetime'] ) ? $instance['slider_pausetime'] : '4000';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
			if(!empty($slider_caption)){ $slide_cap = 'slide_cap_on'; }else{ $slide_cap = 'slide_cap_off'; }

		echo '<div class="slider_inner '.$slider_nav.' slider_widget_'.$slider_type.' '.$slide_cap.'">';
		
			  if(!empty($instance['slider_images'])) {
				  echo '<div class="the_slider_widget" data-pausetime="'.$slider_pausetime.'">';
						  $sliderimgs = $slider;
						  $args = array(
							  'post_type' => 'attachment',
							  'post__in' => explode(',', $sliderimgs), 
							  'posts_per_page' => 99,
							  'order' => 'menu_order ID',
							  'orderby' => 'post__in',
							  'lang' => '',
							  );
						  $attachments = get_posts( $args );
								  
						  //FOR EACH STARTS
						  foreach ( $attachments as $attachment ) {
									 
							  $imgsrc = wp_get_attachment_image_src( $attachment->ID, 'full' );
							  $thumbsrc = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
							  
							  if(!empty($slider_caption) && ($slider_type == 'nivo' || $slider_type == 'gallery')){ $slide_title = '#nv_'.$attachment->ID.'';}else{$slide_title = '';}
							  
							  if(!empty($slider_caption) && $slider_type !== 'nivo'){ $slidedata = 'data-slide-desc="'.do_shortcode($attachment->post_excerpt).'" data-slide-button="'.do_shortcode(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)).'" data-slide-link="'.do_shortcode(esc_url($attachment->post_content)).'"';}else{$slidedata ='';}
							    if($slider_type == 'gallery'){ $slide_thumb ='data-thumb="'.$thumbsrc[0].'"'; }else{$slide_thumb = '';}
							  
							  
								echo '<img class="widget_slide_img" src="'.$imgsrc[0].'" width="'.$imgsrc[1].'" height="'.$imgsrc[2].'" alt="'.$attachment->post_title.'" title="'.$slide_title.'" '.$slidedata.' '.$slide_thumb.' />';
						  }
						  //FOR EACH ENDS
					echo '</div>';
				  }
		
			if ( !empty($content) && empty($slider_caption) || is_customize_preview()){
				//Make inline editable
				if(is_customize_preview()){ $id= $this->id; $controlid = 'data-optionid="widget-'.$id.'-content"';}else{ $controlid = '';}
				echo '<div class="widget_slider_content tiny_content_editable" '.$controlid.'>'.do_shortcode($content).'</div>';
			}
			if ( !empty($slider_caption) && ($slider_type == 'nivo' || $slider_type == 'gallery')){

					foreach ( $attachments as $attachment ) {
						$slide_title =''; if(!empty($attachment->post_title)){ $slide_title = do_shortcode($attachment->post_title);}
						$slide_desc =''; if(!empty($attachment->post_excerpt)){ $slide_desc = do_shortcode($attachment->post_excerpt);}
						$slide_link =''; if(!empty($attachment->post_content)){ $slide_link = 'href="'.do_shortcode(esc_url($attachment->post_content)).'"';}
						$slide_button =''; 
						$slide_content = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
						if(!empty($attachment->post_excerpt) && !empty($slide_content)){ 
							$slide_button = '<p class="slide_button_wrap"><a class="lts_button animated" '.$slide_link.'>'.do_shortcode(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)).'</a></p>';
						}
						
						echo '<div id="nv_'.$attachment->ID.'" class="nivo-html-caption"><div class="nivoinner"><h3 class="entry-title"><a '.$slide_link.'>'.$slide_title.'</a></h3><p class="slide_desc">'.$slide_desc.'</p>'.$slide_button.'</div></div>';
					}
			}

		echo '</div>';
		
		
		
		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
			if($slider_type == 'nivo'){
				echo '<script>jQuery(window).on("load",function() {
					jQuery("#'.$id.' .slider_widget_nivo .the_slider_widget").nivoSlider({
						 effect: "fade", 
						 directionNav: true, 
						 controlNav: true, 
						 pauseOnHover:false, 
						 slices:1, 
						 pauseTime:4000,
					});
					
					});</script>';
			}
			
			if($slider_type == 'gallery'){
				echo '<script>jQuery(window).on("load",function() {
					jQuery("#'.$id.' .slider_widget_gallery .the_slider_widget").nivoSlider({
						 effect: "fade", 
						 directionNav: true, 
						 controlNav: true, 
						 controlNavThumbs: true,
						 pauseOnHover:true, 
						 slices:1, 
						 pauseTime:4000,
					});
					
					});</script>';
			}
			
			if($slider_type == 'accordion'){
				
				echo '<script>jQuery(window).on("load",function() {
						jQuery(".slider_widget_accordion .the_slider_widget").wrapInner(\'<div id="accordion"><ul class=" kwicks horizontal"></ul></div>\');
						jQuery(".slider_widget_accordion .the_slider_widget img").wrap("<li></li>");
						
						jQuery(".slider_widget_accordion .the_slider_widget img").each(function(index, element) {
							var slidedesc = ""; var slidebtn = ""; var slidelink = "";
							if(jQuery(this).attr("data-slide-desc")){ var slidedesc = "<p class=\'slide_desc\'>"+jQuery(this).attr(\'data-slide-desc\')+"</p>"; }
							if(jQuery(this).attr("data-slide-link") && jQuery(this).attr("alt")){ var slidebtn = "<p class=\'slide_button_wrap\'><a class=\'lts_button animated\' href=\'"+jQuery(this).attr("data-slide-link")+"\'>"+jQuery(this).attr("data-slide-button")+"</a></p>"; }
							
							jQuery(this).before("<div class=\'acord_text\'><h3 class=\'entry-title\'><a>"+jQuery(this).attr(\'alt\')+"</a></h3>"+slidedesc+" "+slidebtn+"</div>");
						});
						jQuery.getScript("'.get_template_directory_uri().'/assets/js/accordion.js", function(){
							//Accordion
							if (jQuery(window).width() > 500) {
								jQuery(".kwicks").kwicks({maxSize : "80%", behavior: "menu", spacing: 0});
							} else {
								jQuery(".kwicks .dlthref").attr("href", "#");
								var index = jQuery(".kwicks").kwicks({maxSize : "80%", spacing: 0, behavior: "slideshow"});
								jQuery(".kwicks").kwicks("select", 1);	
							}
						});
					});</script>';
			}
			
			
			if($slider_type == 'carousel'){
				
				echo '<script>jQuery(window).on("load",function() {
						jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").waitForImages(function() {
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").wrapInner(\'<div id="opt_carousel_'.$id.'"><ul class="slidee"></ul><a class="carousel_left"><i></i></a><a class="carousel_right"><i></i></a></div>\');
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget img").wrap("<li></li>");
							
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget img").each(function(index, element) {
								var slidedesc = ""; var slidebtn = ""; var slidelink = "";
								if(jQuery(this).attr("data-slide-desc")){ var slidedesc = "<p class=\'slide_desc\'>"+jQuery(this).attr(\'data-slide-desc\')+"</p>"; }
								if(jQuery(this).attr("data-slide-link") && jQuery(this).attr("alt")){ var slidebtn = "<p class=\'slide_button_wrap\'><a class=\'lts_button animated\' href=\'"+jQuery(this).attr("data-slide-link")+"\'>"+jQuery(this).attr("data-slide-button")+"</a></p>"; }
								
								jQuery(this).before("<div class=\'acord_text\'><h3 class=\'entry-title\'><a>"+jQuery(this).attr(\'alt\')+"</a></h3>"+slidedesc+" "+slidebtn+"</div>");
							});
					
					jQuery.getScript("'.get_template_directory_uri().'/assets/js/jquery.sly.min.js", function(){	
							var options = {
									horizontal: true,
									itemNav: "centered",
									speed: 300,
									activateOn: "click",
									releaseSwing: 1,
									mouseDragging: false,
									touchDragging: 1,
									startAt: 1,
									prev:  "#'.$id.' .carousel_left",
									next: "#'.$id.' .carousel_right", 
									smart: true,
									easing: "easeOutExpo"
							};
							jQuery("#'.$id.' .slider_widget_carousel #opt_carousel_'.$id.'").sly(options);
							jQuery("#'.$id.' .slider_widget_carousel").css({"maxHeight":"none"});
							jQuery(window).on("resize",function(e) {
								jQuery("#'.$id.' .slider_widget_carousel #opt_carousel_'.$id.'").sly("reload");
							});
							
						  
					});	
					});
					});	
					</script>';
			}
			
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
		$instance['slider_images'] = strip_tags($new_instance['slider_images']);
		$instance['slider_type'] = strip_tags($new_instance['slider_type']);
		$instance['slider_height'] = strip_tags($new_instance['slider_height']);
		$instance['slider_caption'] = strip_tags($new_instance['slider_caption']);
		$instance['slider_nav'] = strip_tags($new_instance['slider_nav']);
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['slider_pausetime'] = strip_tags($new_instance['slider_pausetime']);

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
		'content' => '',
		'slider_caption' => '',
		'slider_images' => '',
		'slider_type' => 'nivo',
		'slider_height' => '',
		'slider_nav' => 'slider_nav_default',
		'slider_pausetime' => '4000',
		'content_color' => '#ffffff',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <div class="optimizer_widget_tab optimizer_widget_tab--content">
        
         <!-- SLIDER Content Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e('Content:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" value="<?php echo esc_attr($instance['content']); ?>" type="hidden" />
               <a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'content' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
         
         <!-- SLIDER Images Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'slider_images' ); ?>"><?php _e('Slider Images:', 'optimizer') ?></label>
            <div class="slider-picker-wrap">
               
                     <div id="<?php echo $this->get_field_id( 'slider_images' ); ?>_preview" class="widget_slider_preview">
                  <a onclick="sliderRemove(this.id)" class="widget_slider_remove" id="<?php echo $this->get_field_id( 'slider_images' ); ?>_remove" <?php if(empty($instance['slider_images'])) { ?>style="display:none;"<?php } ?>><i class="fa fa-times"></i></a>
                     <?php if(!empty($instance['slider_images'])) { ?>
                           <?php 
                                 $sliderimgs = $instance['slider_images'];
                                 $args = array(
                                       'post_type' => 'attachment',
                                       'post__in' => explode(',', $sliderimgs), 
                                       'posts_per_page' => 99,
                              'order' => 'menu_order ID',
                              'orderby' => 'post__in',
                                       );
                                 $attachments = get_posts( $args );
                                          
                                 foreach ( $attachments as $attachment ) {
                                             
                                       $imgsrc = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                                       echo '<img  class="slider_preview_thumb" src="'.$imgsrc[0].'" />';
                                 }
         
                           ?>
                           <?php } ?>
                           
                           <span class="slider_empty" <?php if(!empty($instance['slider_images'])) { ?>style="display:none;"<?php } ?>><?php _e('No Images Added','optimizer'); ?></span>
                           
                           </div>
                           
               <input class="widefat slider-picker" id="<?php echo $this->get_field_id( 'slider_images' ); ?>" name="<?php echo $this->get_field_name( 'slider_images' ); ?>" value="<?php echo esc_attr($instance['slider_images']); ?>" type="hidden" />
               <a class="slider-picker-button button" onclick="sliderPicker(this.id)" id="<?php echo $this->get_field_id( 'slider_images' ).'mpick'; ?>"><?php _e('Select Images', 'optimizer') ?></a>
               </div>
         </p>
         
         
         
         <!-- SLIDER Caption Field -->
         <p>
            <label style="letter-spacing: -0.5px;" for="<?php echo $this->get_field_id( 'slider_caption' ); ?>"><?php _e('Display Image Caption as Content', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'slider_caption' ); ?>" name="<?php echo $this->get_field_name( 'slider_caption' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['slider_caption'] ) echo 'checked'; ?> />
         </p>
         

         <!-- Slider Type Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'slider_type' ); ?>"><?php _e('Slider Type:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'slider_type' ); ?>" name="<?php echo $this->get_field_name( 'slider_type' ); ?>" class="widefat slider_type_field">
               <option value="nivo" <?php if ( 'nivo' == $instance['slider_type'] ) echo 'selected="selected"'; ?>><?php _e('Nivo', 'optimizer') ?></option>
               <option value="accordion" <?php if ( 'accordion' == $instance['slider_type'] ) echo 'selected="selected"'; ?>><?php _e('Accordion', 'optimizer') ?></option>
                  <option value="carousel" <?php if ( 'carousel' == $instance['slider_type'] ) echo 'selected="selected"'; ?>><?php _e('Carousel', 'optimizer') ?></option>
                  <option value="gallery" <?php if ( 'gallery' == $instance['slider_type'] ) echo 'selected="selected"'; ?>><?php _e('Gallery', 'optimizer') ?></option>
            </select>
         </p>
         
               
         <!-- SLIDER Height Field -->
         <p class="slider_height_field">
            <label for="<?php echo $this->get_field_id( 'slider_height' ); ?>"><?php _e('Slider Height (in px)', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'slider_height' ); ?>" name="<?php echo $this->get_field_name( 'slider_height' ); ?>" value="<?php echo $instance['slider_height']; ?>" type="text" placeholder="700px" />
         </p>
         
         <!-- SLIDER PauseTime Field -->
         <p class="slider_pause_field">
            <label for="<?php echo $this->get_field_id( 'slider_pausetime' ); ?>"><?php _e('Slider Pause Time', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'slider_pausetime' ); ?>" name="<?php echo $this->get_field_name( 'slider_pausetime' ); ?>" value="<?php echo $instance['slider_pausetime']; ?>" type="text" placeholder="4000" />
         </p>

         <!-- SLIDER Navigation Type Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'slider_nav' ); ?>"><?php _e('Slider Navigation:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'slider_nav' ); ?>" name="<?php echo $this->get_field_name( 'slider_nav' ); ?>" class="widefat">
               <option value="slider_nav_default" <?php if ( 'slider_nav_default' == $instance['slider_nav'] ) echo 'selected="selected"'; ?>><?php _e('Buttons + Navigation', 'optimizer') ?></option>
               <option value="slider_nav_controls" <?php if ( 'slider_nav_controls' == $instance['slider_nav'] ) echo 'selected="selected"'; ?>><?php _e('Only Buttons', 'optimizer') ?></option>
                  <option value="slider_nav_nav" <?php if ( 'slider_nav_nav' == $instance['slider_nav'] ) echo 'selected="selected"'; ?>><?php _e('Only Navigation', 'optimizer') ?></option>

                  <option value="slider_nav_disable" <?php if ( 'slider_nav_disable' == $instance['slider_nav'] ) echo 'selected="selected"'; ?>><?php _e('Disabled', 'optimizer') ?></option>
            </select>
         </p> 

      </div>
        

      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         <!-- SLIDER Content Text Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Slider Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>

         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this);?>
      
      </div>

<?php
	}
	
	
	//ENQUE JAVASCRIPT
	function optimizer_slider_widget_js(){
		$settings = get_option($this->option_name);
		if(!is_customize_preview()){
		if ( empty( $settings ) ) {
			return;
		}
		

		foreach ( $settings as $instance_id => $instance ) {
			$id = $this->id_base . '-' . $instance_id;
			
			if ( ! is_active_widget( false, $id, $this->id_base ) ) {
				continue;
			}
		$idbase = str_replace('-','_',$this->id);
		if ( ! empty( $instance['slider_type'] ) ) {$slider_type = $instance['slider_type'];  }else{$slider_type = 'nivo';}
		
		if($slider_type == 'accordion'){
				echo '<script type="text/javascript">jQuery(function() {
						jQuery(".slider_widget_accordion .the_slider_widget").wrapInner(\'<div id="accordion"><ul class=" kwicks horizontal"></ul></div>\');
						jQuery(".slider_widget_accordion .the_slider_widget img").wrap("<li></li>");
						
						jQuery(".slider_widget_accordion .the_slider_widget img").each(function(index, element) {
							var slidedesc = ""; var slidebtn = ""; var slidelink = "";
							if(jQuery(this).attr("data-slide-desc")){ var slidedesc = "<p class=\'slide_desc\'>"+jQuery(this).attr(\'data-slide-desc\')+"</p>"; }
							if(jQuery(this).attr("data-slide-link") && jQuery(this).attr("alt")){ var slidebtn = "<p class=\'slide_button_wrap\'><a class=\'lts_button animated\' href=\'"+jQuery(this).attr("data-slide-link")+"\'>"+jQuery(this).attr("data-slide-button")+"</a></p>"; }
							
							jQuery(this).before("<div class=\'acord_text\'><h3 class=\'entry-title\'><a>"+jQuery(this).attr(\'alt\')+"</a></h3>"+slidedesc+" "+slidebtn+"</div>");
						});
						jQuery.getScript("'.get_template_directory_uri().'/assets/js/accordion.js", function(){
							//Accordion
							if (jQuery(window).width() > 500) {
								jQuery(".kwicks").kwicks({maxSize : "80%", behavior: "menu", spacing: 0});
							} else {
								jQuery(".kwicks .dlthref").attr("href", "#");
								var index = jQuery(".kwicks").kwicks({maxSize : "80%", spacing: 0, behavior: "slideshow"});
								jQuery(".kwicks").kwicks("select", 1);	
							}
						});
					});</script>';
			}


		//Load JS
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
			if($instance['slider_type'] == 'carousel'){
				wp_enqueue_script('optimizer_sly',get_template_directory_uri().'/assets/js/jquery.sly.min.js', array('jquery'), false);
				
				
			if($slider_type == 'carousel'){
				
				echo '<script>jQuery(window).on("load",function() {
                  if(jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").hasClass("the_slider_widget--carousel_prepared")){ return; }
						jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").waitForImages(function() {
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").wrapInner(\'<div id="opt_carousel_'.$id.'"><ul class="slidee"></ul><a class="carousel_left"><i></i></a><a class="carousel_right"><i></i></a></div>\');
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget img").wrap("<li></li>");
							
							jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget img").each(function(index, element) {
								var slidedesc = ""; var slidebtn = ""; var slidelink = "";
								if(jQuery(this).attr("data-slide-desc")){ var slidedesc = "<p class=\'slide_desc\'>"+jQuery(this).attr(\'data-slide-desc\')+"</p>"; }
								if(jQuery(this).attr("data-slide-link") && jQuery(this).attr("alt")){ var slidebtn = "<p class=\'slide_button_wrap\'><a class=\'lts_button animated\' href=\'"+jQuery(this).attr("data-slide-link")+"\'>"+jQuery(this).attr("data-slide-button")+"</a></p>"; }
								
								jQuery(this).before("<div class=\'acord_text\'><h3 class=\'entry-title\'><a>"+jQuery(this).attr(\'alt\')+"</a></h3>"+slidedesc+" "+slidebtn+"</div>");
							});
                     jQuery("#'.$id.' .slider_widget_carousel .the_slider_widget").addClass("the_slider_widget--carousel_prepared");
						var options = {	horizontal: true, itemNav: "centered", speed: 300, activateOn: "click", releaseSwing: 1, mouseDragging: false, touchDragging: 1, startAt: 1, prev:  "#'.$id.' .carousel_left", next: "#'.$id.' .carousel_right", smart: true, easing: "easeOutExpo"};
						
						jQuery("#'.$id.' .slider_widget_carousel #opt_carousel_'.$id.'").sly(options);
                  jQuery("#'.$id.' .slider_widget_carousel").css({"maxHeight":"none"});
                  
						jQuery(window).on("resize",function(e) {
							jQuery("#'.$id.' .slider_widget_carousel #opt_carousel_'.$id.'").sly("reload");
						});
							
						});
						jQuery( document ).on("load ready", function() {
								jQuery("#'.$id.' .slider_widget_carousel #opt_carousel_'.$id.'").sly("reload");
						});
					});
					</script>';
			}
				
			}
		}

	}
}
}
	
   //ENQUEUE CSS
   function front_slider_enqueue_css() {
		$settings = $this->get_settings();
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
   
   function generate_css($id, $instance){
      $content_color =		! empty( $instance['content_color']) ? 'color: ' . $instance['content_color'] . '!important; ' : 'color:#a8b4bf;';
      $slider_height =		isset( $instance['slider_height'] ) ? 'max-height:'.$instance['slider_height'].';' : '';
      
      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.', #'.$id.' .slide_desc, #'.$id.' .slide_button_wrap a{ '. $font_size. $font_family.'}';
      $widget_style .= '#'.$id.' .widget_slider_content, #'.$id.' .nivo-html-caption, #'.$id.' .acord_text .slide_desc, #'.$id.' .acord_text .entry-title{' . $content_color. '}';
      $widget_style .= '#'.$id.' .widget_slider_content, #'.$id.' #opt_carousel .slidee li, #'.$id.' .widget_slider_content, #'.$id.' #opt_carousel .slidee li img, #'.$id.' #accordion, #'.$id.' #slide_acord, #'.$id.' .kwicks li, #'.$id.' .nivoSlider, #'.$id.' .slidee li{' . $slider_height . '}';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .entry-title, #'.$id.' .entry-title a{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }
}
?>