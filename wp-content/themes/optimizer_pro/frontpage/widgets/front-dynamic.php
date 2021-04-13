<?php
/*
 *FRONTPAGE - Dynamic Content WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_carousel' );

/*
 * Register widget.
 */
function optimizer_register_front_carousel() {
	register_widget( 'optimizer_front_carousel' );
}


/*
 * Widget class.
 */
class optimizer_front_Carousel extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Dynamic Content', 'optimizer' ); }else{ $widgetname = __( '&diams; Dynamic Content Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_carousel', $widgetname, array(
			'classname'   => 'optimizer_front_carousel home_testi',
			'description' => __( 'Optimizer Dynamic Content widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_carousel';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_carousel_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		
		extract( $args );
		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? $instance['title'] : __('What are people saying?', 'optimizer');
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : __('Testimonial Subtitle', 'optimizer');
		$type = isset( $instance['type'] ) ? $instance['type'] : 'carousel';
		$style = isset( $instance['style'] ) ? $instance['style'] : 'style1';
		$carousel = isset( $instance['carousel'] ) ? $instance['carousel'] : array();
		$img_pos = isset( $instance['img_pos'] ) ? $instance['img_pos'] : 'top';
		$divider = isset( $instance['divider'] ) ? apply_filters('widget_title', $instance['divider']) : 'fa-stop';
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? $instance['content_bgimg'] : '';
		$pausetime = isset( $instance['pausetime'] ) ? $instance['pausetime'] : '8000';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
		?>
        <?php
		
			//WIDGET EDIT BUTTON(Customizer)
			if(is_customize_preview()){  echo '<a class="edit_widget" title="'.__('Edit ','optimizer').$this->id.'"><i class="fa fa-pencil"></i></a>'; }
			
			if ( !empty($content_bgimg) ){ $hasbgimg ='hasbgimg'; }else{ $hasbgimg =''; }
			
		echo '<div class="home_carousel_inner carousel_'.$img_pos.' carousel_'.$style.' '.$hasbgimg.' " ><div class="center">';
			echo '<div class="homeposts_title carousel_title title_'.str_replace('fa-','dvd_',$divider).'">';
				if ( $title || is_customize_preview() ){
					echo '<h2 class="home_title"><span>'.do_shortcode($title).'</span></h2>';
				}
				if ( $subtitle || is_customize_preview() ){
					echo '<div class="home_subtitle"><span>'.do_shortcode($subtitle).'</span></div>';
				}
				if ( $divider ){
					if( $divider !== 'no_divider'){
						if($divider == 'underline'){ $underline= 'title_underline';}else{$underline='';}
							echo '<div class="optimizer_divider '.$underline.' divider_style_'.str_replace('fa-','dvd_',$divider).'"><span class="div_left"></span><span class="div_middle"><i class="fa '.$divider.'"></i></span><span class="div_right"></span></div>';
					}
				}
			echo '</div>';
			
		if(!isset($instance['carousel'])){ echo '<p class="widget_warning" style="color: #fff;">'.__('Please Click the "+ Add New" button to create new Carousel','optimizer').'</p>';}

					if(!empty($carousel) && $type == 'carousel' ){
						/*START CUSTOM Carosel*/
						if( $type == 'carousel') { $looper = 'data-looper="go" class="looper slide" data-interval="'.$pausetime.'"'; }else{ $looper = ''; }
						echo '<div id="carousel-looper_'.$this->id.'" '.$looper.' ><ul class="looper-inner">';

							foreach ((array)$carousel as $cars){ 

								 echo '<li class="item">
									<div class="carousel_image">';
										if (!empty ($cars['image'])) {
											echo '<img alt="'.$cars['title'].'" class="carousel_img" src="'.$cars['image'].'" />' ;
										}
									echo '</div>
									<div class="carousel_content">'.apply_filters( 'wp_editor_widget_content', do_shortcode($cars['content']) ).'</div>
  
								 </li>';
	
							}
								   
							echo '</ul>';

						
						//LOOPER NAVIGATION  - TYPE 1
						if( $style == 'style1') {
						echo '<nav>
							<a class="looper-control" data-looper="prev" href="#carousel-looper_'.$this->id.'">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="looper-control right" data-looper="next" href="#carousel-looper_'.$this->id.'">
								<i class="fa fa-angle-right"></i>
							</a>
						</nav>';
						}
						
						//LOOPER NAVIGATION  - TYPE 2
						if( $style == 'style2' ||  $style == 'style3') {
						
							echo '<nav><ul class="looper-nav">';
								$i = 0; 
								foreach ((array)$carousel as $cars){
									echo '<li><a href="#carousel-looper_'.$this->id.'" data-looper="to" data-args="'.($i +1).'"><span></span></a></li>';
									$i++;
								}
							echo '</ul></nav>';
						}
						
					echo '</div>';  //END of testi-looper div
					
					} //CAROUSEL END
					
					
					//TABS START
					if(!empty($carousel) && $type == 'tabs' ){
						if($style == 'style1'){ $style ='minimal'; } if($style == 'style2'){ $style ='circular'; } if($style == 'style3'){ $style ='capsule'; }
						echo '<div class="tabs-container lts_tabs tabs_'.$style.'"">
						
						<ul class="tabs ">';
							foreach ((array)$carousel as $cars){ 
									echo '<li class="tabli lts_tabtitle"><a href="#" class="tabtrigger">'.do_shortcode($cars['title']).'</a></li>';
							}
						echo '</ul>';
							
						echo '<div class="lts_tab">';
							foreach ((array)$carousel as $cars){ 
									echo '<div class="lts_tab_child">
												<div class="tab_wimg">';
												if (!empty ($cars['image'])) {
													echo '<img alt="'.$cars['title'].'" class="tabs_img" src="'.$cars['image'].'" />' ;
												}
											echo '</div>
											<div class="tab_wcontent">'.apply_filters( 'wp_editor_widget_content', do_shortcode($cars['content']) ).'</div>
										</div>';
							}
						echo '</div>';
						
						echo '</div>'; //tabs-container END
						
					} //TABS END
					
					if(!empty($carousel) && $type == 'toggle' ){
						
						echo '<div class="toggle_widget_wrap toggle_'.$style.'">';
						
						foreach($carousel as $cars){
							echo '<div class="lts_toggle">';
							
								//THE BUTTONS
								echo '<div class="trigger_wrap"><a class="trigger"><i class="fa fa-plus"></i> '.do_shortcode($cars['title']).'</a></div>';
						
								//THE CONTENT
								echo '<div class="lts_toggle_content" style="display:none;">';
								
										echo '<div class="toggle_wimg">';
											if (!empty ($cars['image'])) { echo '<img alt="'.$cars['title'].'" class="tabs_img" src="'.$cars['image'].'" />' ; }
										echo '</div>';
										
										echo '<div class="toggle_wcontent">'.apply_filters( 'wp_editor_widget_content', do_shortcode($cars['content']) ).'</div><div style="clear:both"></div>';
									
								echo '</div>';//lts_toggle_content END
						
							echo '</div>';//lts_toggle END
						
						} //FOREACH END
						
						echo '</div>';//toggle_widget_wrap END
						
					} //TABS END	
					

		echo '</div></div>';

		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
			
			echo "<script>jQuery(function() { jQuery('#".$id." .looper-inner li').eq(0).addClass('active');  });</script>";
			echo '<script>
            jQuery( document ).ajaxStop( function() {
            jQuery(".lts_tab p:empty").remove(),jQuery(".lts_tabs .lts_tabtitle.emptyp_clear").remove();var i=1;jQuery(".tabs-container").each(function(){jQuery(this).find("a.tabtrigger").each(function(){jQuery(this).attr("href","#tab-"+i),i++})});var i=1;jQuery(".tabs-container").each(function(){jQuery(this).find(".lts_tab_child").not(":empty").each(function(){jQuery(this).attr("id","tab-"+i),i++})});var i=1;jQuery(".tabs-container").each(function(){jQuery(this).attr("id","tabs-container_"+i),i++}),jQuery(".tabs-container.tabs_default").each(function(){var a=jQuery(this).attr("id"),b=jQuery(this).data("active-color");jQuery("<style>body #"+a+" ul.tabs li.active a{color:"+b+"!important;border-color:"+b+"}</style>").appendTo("head")}),jQuery(".tabs-container.tabs_circular").each(function(){var a=jQuery(this).attr("id"),b=jQuery(this).data("active-color");jQuery("<style>body #"+a+" ul.tabs li.active a{color:"+jQuery("body").css("background-color")+"!important;background:"+b+"}</style>").appendTo("head")}),jQuery(".tabs-container.tabs_minimal").each(function(){var a=jQuery(this).attr("id"),b=jQuery(this).data("active-color");jQuery("<style>body #"+a+" ul.tabs li.active a{color:"+b+"!important;border-color:"+b+"}</style>").appendTo("head")}),jQuery(".tabs-container.tabs_capsule").each(function(){var a=jQuery(this).attr("id"),b=jQuery(this).data("active-color");jQuery("<style>body #"+a+" ul.tabs li.active a{color:"+jQuery("body").css("background-color")+"!important;background:"+b+";border-color:"+b+"}</style>").appendTo("head")}),jQuery(".tabs-container").easytabs({updateHash:!1}),jQuery(".lts_toggle_content").hide(),jQuery(".lts_toggle .trigger").click(function(){return jQuery(this).closest(".lts_toggle").find(".lts_toggle_content").slideToggle("fast"),!1}),jQuery(".lts_toggle a.trigger").on("click",function(){if(!jQuery(this).hasClass("down")){ jQuery(this).find("i").animateRotate(135),jQuery(this).addClass("down");  }else{  jQuery(this).find("i").animateRotate(-90),jQuery(this).removeClass("down");}}),jQuery(".lts_toggle").each(function(){jQuery(this).next("br")&&jQuery(this).next("br").addClass("tabsbr")});
            jQuery(".toggle_style3").each(function(a,b){var c=jQuery("<div/>").addClass("first_toggles"),d=jQuery("<div/>").addClass("mid_toggles"),e=jQuery("<div/>").addClass("last_toggles"),f=jQuery(this).find("div.lts_toggle:nth-child(3n+1)"),g=jQuery(this).find("div.lts_toggle:nth-child(3n+2)"),h=jQuery(this).find("div.lts_toggle:nth-child(3n+3)");f.appendTo(c),g.appendTo(d),h.appendTo(e),jQuery(this).append(c,d,e)}),jQuery(".toggle_style2").each(function(a,b){var c=jQuery("<div/>").addClass("first_toggles"),d=jQuery("<div/>").addClass("mid_toggles"),e=jQuery(this).find("div.lts_toggle:nth-child(2n+1)"),f=jQuery(this).find("div.lts_toggle:nth-child(2n+2)");e.appendTo(c),f.appendTo(d),jQuery(this).append(c,d)});
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
		
		/* No need to strip tags */
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['divider'] = strip_tags($new_instance['divider']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['style'] = strip_tags($new_instance['style']);
		$instance['img_pos'] = strip_tags($new_instance['img_pos']);
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
		$instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
		$instance['pausetime'] = strip_tags($new_instance['pausetime']);
		
		
        $instance['carousel'] = array();
		
        if ( isset( $new_instance['carousel'] ) )
        {
            foreach ( $new_instance['carousel'] as $cars )
            {
                if ( '' !== trim( $cars['title'] ) )
                    $instance['carousel'][] = $cars;
            }
        }

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
		'title' => __('What are people saying?','optimizer'),
		'subtitle' => __('Real words from real customers!','optimizer'),
		'type' => 'carousel',
		'style' => 'style1',
		'carousel' => array(),
		'img_pos' => 'top',
		'divider' => 'fa-stop',
		'title_color' => '#777777',
		'content_bg' => '#ffffff',
		'content_bgimg' => '',
		'pausetime' => '8000'
		);
      $instance = wp_parse_args( (array) $instance, $defaults ); ?>
      
      <div class="optimizer_widget_tab optimizer_widget_tab--content">

            <!-- Carousel Section TITLE Field -->
            <p>
               <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
            </p>
            
            <!-- Carousel Section Subtitle Field -->
            <p>
               <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'optimizer') ?></label>
               <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo htmlspecialchars($instance['subtitle'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
            </p>


            <!-- Carousel Type Field -->
            <p>
               <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Display As:', 'optimizer') ?></label>
               <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat dynamic_type_field">
                  <option value="carousel" <?php if ( 'carousel' == $instance['type'] ) echo 'selected="selected"'; ?>><?php _e('Carousel', 'optimizer') ?></option>
                  <option value="tabs" <?php if ( 'tabs' == $instance['type'] ) echo 'selected="selected"'; ?>><?php _e('Tabs', 'optimizer') ?></option>
                     <option value="toggle" <?php if ( 'toggle' == $instance['type'] ) echo 'selected="selected"'; ?>><?php _e('Toggle', 'optimizer') ?></option>
               </select>
            </p>
            
            
            <!-- ----------------Carousel Field------------------------ -->
            <div class="widget_repeater" data-widget-id="<?php echo $this->get_field_id( 'carousel' ); ?>" data-widget-name="<?php echo $this->get_field_name( 'carousel' ); ?>">
            <?php 
            $customtesti = isset( $instance['carousel'] ) ? $instance['carousel'] : array();
            $customtesti_num = count($customtesti);
            $customtesti[$customtesti_num+1] = '';
            $cars_html = array();
            $customtesti_counter = 0;

            foreach ( $customtesti as $cars ) 
            {   
                  if ( isset($cars['title']) )
                  {
                     $cars_html[] = sprintf(
                        '<div class="widget_input_wrap"><i class="fa fa-arrows-v"></i>
                              <span id="%4$s%2$s" class="repeat_handle" onclick="repeatOpen(this.id)">%5$s</span>
                              <input type="text" name="%1$s[%2$s][title]" value="%5$s" class="widefat" placeholder="%6$s">
                              <div class="media-picker-wrap">
                                 %7$s
                                 <input id="%3$s-%2$s-img" type="hidden" name="%1$s[%2$s][image]" value="%8$s" class="widefat media-picker">
                                 <a id="%10$s-%2$s" onclick="mediaPicker(this.id)" class="media-picker-button button">%9$s</a>
                              </div>
                                 <input id="%3$s-%2$s-cont" type="hidden" name="%1$s[%2$s][content]" value="%12$s" class="widefat">
                                 <a id="%11$s-%2$s" href="javascript:WPEditorWidget.showEditor(\'%3$s-%2$s-cont\')" class="edit-content-button button">%13$s</a>
                              <span class="remove-field button button-primary">Remove</span>
                           </div>',
                        $this->get_field_name( 'carousel' ), //1
                        $customtesti_counter, 				//2
                     $this->get_field_id('carousel').'', //3
                     $this->get_field_id('custom_add_field').'-repeat', //4
                     
                     //Title
                     esc_attr( $cars['title'] ),			 //5 - Title Value
                     __('Title (Required)','optimizer'), //6 - Title Placeholder
                     //Media
                     !empty($cars['image']) ? '<img class="media-picker-preview" src="'.esc_url($cars['image']).'" /><i class="fa fa-times media-picker-remove"></i>': '', //7
                     esc_url( $cars['image'] ),			 //8 - Image Value
                     __('Select Image', 'optimizer'),	 //9 - Image Placeholder
                     $this->get_field_id('carousel').'-mpick', //10
                     
                     //Content
                     $this->get_field_id('carousel').'-editor', //11
                     esc_attr( $cars['content']), 	//12 - Content Value
                     __('Edit Content', 'optimizer')	 //13 - Content Placeholder

                     );
                  }

                  $customtesti_counter += 1;
            }

            echo '<h4>'.__('Content','optimizer').'</h4>' . join( $cars_html );

            ?>
            
            <script type="text/javascript">
               var fieldnum = <?php echo json_encode( $customtesti_counter-1 ) ?>;
               var count = fieldnum;
               function customCarsclickFunction(buttonid){
                  var fieldname = jQuery('#'+buttonid).data('widget-fieldname');
                  var fieldid = jQuery('#'+buttonid).data('widget-fieldid');
                  
                     jQuery('#'+buttonid).prev().append("<div class='widget_input_wrap'><i class='fa fa-arrows-v'></i><span id='"+buttonid+"-repeat"+(count+1)+"' class='repeat_handle' onclick='repeatOpen(this.id)'></span><input type='text' name='"+fieldname+"["+(count+1)+"][title]' value='<?php _e( 'Title (Required)', 'optimizer' ); ?>' class='widefat' placeholder='<?php _e( 'Title (Required)', 'optimizer' ); ?>'><div class='media-picker-wrap'><input type='hidden' name='"+fieldname+"["+(count+1)+"][image]' value='' class='widefat media-picker' id='"+fieldid+"-"+(count+1)+"-img'><a id='"+fieldid+"-mpick"+(count+1)+"' class='media-picker-button button' onclick='mediaPicker(this.id)'><?php _e('Select Image', 'optimizer') ?></a></div><input type='hidden' name='"+fieldname+"["+(count+1)+"][content]' value='' class='widefat' id='"+fieldid+"-"+(count+1)+"-cont'><a href='javascript:WPEditorWidget.showEditor(\""+fieldid+"-"+(count+1)+"-cont\")' class='edit-content-button button'><?php _e('Edit Content', 'optimizer') ?></a><span class='remove-field button button-primary'>Remove</span></div>");
                     count++;
                  
               }

            </script>

            <span id="<?php echo $this->get_field_id( 'custom-field_clone' );?>" class="repeat_clone_field" data-empty-content="<?php _e('No Carousel / Tabs Added!', 'optimizer') ?>"></span>

            <?php echo '<input onclick="customCarsclickFunction(this.id)" class="button button-primary" type="button" value="' . __( '+ Add New', 'optimizer' ) . '" id="'.$this->get_field_id('custom_add_field').'" data-widget-fieldname="'.$this->get_field_name('carousel').'" data-widget-fieldid="'.$this->get_field_id('carousel').'" />';?>
            <div class="repeater_apply_message"><?php _e( 'Click the Apply Button Below to See the change', 'optimizer' ) ;?></div>
            </div>

               <!-- Carousel Pause Time Field -->
            <p>
               <label for="<?php echo $this->get_field_id( 'pausetime' ); ?>"><?php _e('Carousel Pausetime:', 'optimizer') ?></label>
               <input class="widefat cars_pausetime" id="<?php echo $this->get_field_id( 'pausetime' ); ?>" name="<?php echo $this->get_field_name( 'pausetime' ); ?>" value="<?php echo htmlspecialchars($instance['pausetime'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
            </p>

   </div>


   <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         <!-- Carousel TITLE DIVIDER Field -->
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
         <!-- Carousel Style Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Style:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat">
               <option value="style1" <?php if ( 'style1' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Style 1', 'optimizer') ?></option>
               <option value="style2" <?php if ( 'style2' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Style 2', 'optimizer') ?></option>
                  <option value="style3" <?php if ( 'style3' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Style 3', 'optimizer') ?></option>
            </select>
         </p>
         
         <!-- Carousel Column Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'img_pos' ); ?>"><?php _e('Image Alignment', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'img_pos' ); ?>" name="<?php echo $this->get_field_name( 'img_pos' ); ?>" class="widefat">
               <option value="top" <?php if ( 'top' == $instance['img_pos'] ) echo 'selected="selected"'; ?>><?php _e('Top', 'optimizer') ?></option>
               <option value="left" <?php if ( 'left' == $instance['img_pos'] ) echo 'selected="selected"'; ?>><?php _e('Left', 'optimizer') ?></option>
                  <option value="right" <?php if ( 'right' == $instance['img_pos'] ) echo 'selected="selected"'; ?>><?php _e('Right', 'optimizer') ?></option>
            </select>
         </p>
         <!-- Testimonial Title Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>

                  
         <!-- Testimonial Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
        
        
            
        <!-- Testimonial Background IMAGE FIELD -->
        <div class="widget_input_wrap">
            <label for="<?php echo $this->get_field_id( 'content_bgimg' ); ?>"><?php _e('Background Image', 'optimizer') ?></label>
            <div class="media-picker-wrap">
            <?php if(!empty($instance['content_bgimg'])) { ?>
                <img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['content_bgimg']); ?>" />
                <i class="fa fa-times media-picker-remove"></i>
            <?php } ?>
            <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'content_bgimg' ); ?>" name="<?php echo $this->get_field_name( 'content_bgimg' ); ?>" value="<?php echo esc_url($instance['content_bgimg']); ?>" type="hidden" />
            <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'content_bgimg' ).'mpick'; ?>"><?php _e('Select Image', 'optimizer') ?></a>
            </div>
        </div>

        <!-- Basic Widget Styles -->
        <?php optimizer_widget_basic_styles($instance, $this);?>
        
   </div>   
        
             
<?php
	}
	//ENQUEUE CSS
   function front_carousel_enqueue_css() {
		$settings = $this->get_settings();
		if ( empty( $settings ) ) {
			return;
		}
		foreach ( $settings as $instance_id => $instance ) {
			$id = $this->id_base . '-' . $instance_id;
			if(!is_customize_preview()){
            if ( ! is_active_widget( false, $id, $this->id_base ) ) {
               continue;
            }
            wp_add_inline_style( 'optimizer-style', $this->generate_css($id, $instance) );
			}
      }
   }

   function generate_css($id, $instance){
         $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#ffffff;';
         $rawbg =		! empty( $instance['content_bg']) ?  $instance['content_bg'] : '#ffffff';
			$title_color =		! empty( $instance['title_color']) ?   $instance['title_color'] : '#ffffff';
			$content_bgimg =		! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
						
         //Basic Styles
         $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
         $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
         $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
         $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
         $marginPadding = optimizer_widget_paddingMargin($id, $instance);
         $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

         $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg. $font_size. $font_family.'}';
         $widget_style .=  ($title_size || $title_family) ? '#'.$id.' .home_title{ ' . $title_size . $title_family. '}' : '';
         $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
         $widget_style .= '#'.$id.' .home_title, #'.$id.' .home_subtitle, #'.$id.' span.div_middle, #'.$id.' .widget_wrap{ color:' . $title_color . '}';
         $widget_style .= '#'.$id.' span.div_left, #'.$id.' .testi_content, #'.$id.' .testi_author a, #'.$id.' .testi_occu{color:'.$title_color.'opacity:0.7;}';
         $widget_style .= '#'.$id.' span.div_right{background-color:' . $title_color . '}';
         $widget_style .= '#'.$id.' .home_carousel_inner .tabs li a{ color:' . $title_color . '; border-color:' . $title_color . ';} ';
         $widget_style .= '#'.$id.' .home_carousel_inner .tabs li a.active{ color:' . $rawbg . '; background-color:' . $title_color . '}';
         $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
         
         return $widget_style;
   }
}
?>