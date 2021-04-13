<?php
/*
 *FRONTPAGE - CLINETS LOGO WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_clients' );

/*
 * Register widget.
 */
function optimizer_register_front_clients() {
	register_widget( 'optimizer_front_clients' );
}


/*
 * Widget class.
 */
class optimizer_front_Clients extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Clients Logo', 'optimizer' ); }else{ $widgetname = __( '&diams; Clients Logo Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_clients', $widgetname, array(
			'classname'   => 'optimizer_front_clients clientsblck',
			'description' => __( 'Optimizer Frontpage Clients Logo Section widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_clients';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_clients_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		
		extract( $args );
		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? $instance['title'] : __('OUR CLIENTS','optimizer');
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : __('Companies Who Worked With Us','optimizer');
		$divider = isset( $instance['divider'] ) ? apply_filters('widget_title', $instance['divider']) : 'no_divider';
		$clients = isset( $instance['clients'] ) ? $instance['clients'] : array();
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '';
		$navigation = isset( $instance['navigation'] ) ? $instance['navigation'] : '';
		$grayscale_off = isset( $instance['grayscale'] ) ? $instance['grayscale'] : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
		?>
        <?php
						
		echo '<div class="centerfix"><div class="ast_clientlogos">';
		
			echo '<div class="homeposts_title title_'.str_replace('fa-','dvd_',$divider).'">';
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
			
			if(!isset($instance['clients'])){ echo '<p class="widget_warning">'.__('Please Click the "+ Add New" button from left to Add Client logos.','optimizer').'</p>';}
			if ( $clients ){
            if ( $navigation == 1 ){ $nav = 'clients_nav_on'; }else{ $nav = 'clients_nav_off'; }
            if($grayscale_off == 1 ){ $grayscale = ' clients_grayscale_off'; }else{ $grayscale = ''; }
            if(isset( $instance['autonavigate'] ) && $instance['autonavigate'] == 1 && $navigation == 1 ){ $nav = ' clients_nav_auto'; }
            
				echo '<div class="clients_logo clients_logo_nav '.$nav. $grayscale.'"><div class="center">
				
				<a class="buttons prev" href="#"><svg width="25px" height="36px" viewBox="0 0 50 80" xml:space="preserve"><polyline fill="none" stroke="rgba(0, 0, 0, 0.3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="45.63,75.8 0.375,38.087 45.63,0.375 "/></svg></a>
				
				<div class="viewport"><ul class="overview">';
							foreach ((array)$clients as $clientlogo){
								if(!empty($clientlogo['title'])){
									if(!empty($clientlogo['url'])){  $clientweb = 'href="'.esc_url($clientlogo['url']).'"'; }else{$clientweb ='';}
									
									echo '<li><a title="'.apply_filters('widget_title', $clientlogo['title']).'" '.$clientweb.' target="_blank">';
									
									if ( is_customize_preview() || $navigation == 1 ){
										echo '<img alt="'.apply_filters('widget_title', $clientlogo['title']).'" class="client_logoimg" src="'.esc_url($clientlogo['image']).'" '.optimizer_image_attr( esc_url($clientlogo['image']) ).' />';
										
									}else{
										echo '<img alt="'.apply_filters('widget_title', $clientlogo['title']).'" class="client_logoimg" src="'.get_template_directory_uri().'/assets/images/preloader.png'.'" data-src="'.esc_url($clientlogo['image']).'" '.optimizer_image_attr( esc_url($clientlogo['image']) ).' />';
									}
								
									echo '</a></li>';
								}
							} 
						 
				echo '</ul></div>
				<a class="buttons next" href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="36px" viewBox="0 0 50 80" xml:space="preserve">
    <polyline fill="none" stroke="rgba(0, 0, 0, 0.3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="0.375,0.375 45.63,38.087 0.375,75.8 "/></svg></a>
				</div></div>';
			}

		echo '</div></div>';

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
		$instance['divider'] = strip_tags( $new_instance['divider'] );
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
      $instance['navigation'] = isset( $new_instance['navigation'] ) ?  strip_tags($new_instance['navigation']) : '';
      $instance['autonavigate'] = isset( $new_instance['autonavigate'] ) ?  strip_tags($new_instance['autonavigate']) : '';
      $instance['grayscale'] = isset( $new_instance['grayscale'] ) ?  strip_tags($new_instance['grayscale']) : '';
      
		
        $instance['clients'] = array();

        if ( isset( $new_instance['clients'] ) )
        {
            foreach ( $new_instance['clients'] as $client )
            {
                if ( '' !== trim( $client['title'] ) )
                    $instance['clients'][] = $client;
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
		'title' => __('OUR CLIENTS','optimizer'),
		'subtitle' => __('Companies Who Worked With Us','optimizer'),
		'divider' => 'no_divider',
		'clients' => array(),
      'navigation' => '',
      'autonavigate' => '',
      'grayscale' => '',
		'title_color' => '#333333',
		'content_bg' => '#ffffff',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <div class="optimizer_widget_tab optimizer_widget_tab--content">
         <!-- Clinets Section TITLE Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
         <!-- Clinets Section Subtitle Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo htmlspecialchars($instance['subtitle'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
            
         <!-- Clients Field -->
         <div class="widget_repeater" data-widget-id="<?php echo $this->get_field_id( 'clients' ); ?>" data-widget-name="<?php echo $this->get_field_name( 'clients' ); ?>">
         <?php 
         $clients = isset( $instance['clients'] ) ? $instance['clients'] : array();
         $client_num = count($clients);
         $clients[$client_num+1] = '';
         $clients_html = array();
         $client_counter = 0;

         foreach ( $clients as $client ) 
         {   
               if ( isset($client['title']) )
               {
                  $client_logo_name = explode('/', esc_url($client['image']));
                  if(is_array($client_logo_name)){
                     $client_logo_title = end($client_logo_name);
                  }else{
                     $client_logo_title = '';
                  };
                  
                  $clients_html[] = sprintf(
                     '<div class="widget_input_wrap"><i class="fa fa-arrows-v"></i>
                     <span id="%9$s%2$s" class="repeat_handle" onclick="repeatOpen(this.id)">%3$s</span>
                     <input type="text" name="%1$s[%2$s][title]" value="%3$s" class="widefat" placeholder="%6$s">
                     <input type="text" name="%1$s[%2$s][url]" value="%4$s" class="widefat" placeholder="%7$s">
                     <div class="media-picker-wrap">
                        %12$s
                        <input id="%10$s-%2$s" type="hidden" name="%1$s[%2$s][image]" value="%5$s" class="widefat media-picker">
                        <a id="%11$s-%2$s" onclick="mediaPicker(this.id)" class="media-picker-button button">%8$s</a>
                     </div>
                     <span class="remove-field button button-primary button-large">Remove</span>
                  </div>',
                     $this->get_field_name( 'clients' ),
                     $client_counter,
                  esc_attr( $client['title'] ),
                     esc_url( $client['url'] ),
                  esc_url( $client['image'] ),
                  __('Client\'s Name (Required)','optimizer'),
                  __('Client\'s Website','optimizer'),
                  __('Select Image', 'optimizer'),
                  $this->get_field_id('add_field').'-repeat',
                  $this->get_field_id('clients').'',
                  $this->get_field_id('clients').'-mpick',
                  !empty($client['image']) ? '<img class="media-picker-preview" title="'.$client_logo_title.'" src="'.esc_url($client['image']).'" /><i class="fa fa-times media-picker-remove"></i>': ''
                  );
               }

               $client_counter += 1;
         }

         echo '<h4>'.__('Clients','optimizer').'</h4>' . join( $clients_html );

         ?>
         
         <script type="text/javascript">
            var fieldnum = <?php echo json_encode( $client_counter-1 ) ?>;
            var count = fieldnum;
            function clientclickFunction(buttonid){
               var fieldname = jQuery('#'+buttonid).data('widget-fieldname');
               var fieldid = jQuery('#'+buttonid).data('widget-fieldid');
               
                  jQuery('#'+buttonid).prev().append("<div class='widget_input_wrap'><i class='fa fa-arrows-v'></i><span id='"+buttonid+"-repeat"+(count+1)+"' class='repeat_handle' onclick='repeatOpen(this.id)'></span><input type='text' name='"+fieldname+"["+(count+1)+"][title]' value='<?php _e( 'Client\'s Name (Required)', 'optimizer' ); ?>' class='widefat' placeholder='<?php _e( 'Client\'s Name (Required)', 'optimizer' ); ?>'><input type='text' name='"+fieldname+"["+(count+1)+"][url]' value='http://google.com' class='widefat' placeholder='<?php _e( 'Client\'s Website', 'optimizer' ); ?>'><div class='media-picker-wrap'><input type='hidden' name='"+fieldname+"["+(count+1)+"][image]' value='' class='widefat media-picker' id='"+fieldid+"-"+(count+1)+"'><a id='"+fieldid+"-mpick"+(count+1)+"' class='media-picker-button button' onclick='mediaPicker(this.id)'><?php _e('Select Image', 'optimizer') ?></a></div><span class='remove-field button button-primary button-large'>Remove</span></div>");
                  count++;
               
            }
            
            
            jQuery( document ).on( 'load widget-added widget-updated', function () {
               
               jQuery(document).on("click", ".remove-field", function(e) {
                  jQuery(this).parent().remove();
               });
            });

         </script>

         <span id="<?php echo $this->get_field_id( 'field_clone' );?>" class="repeat_clone_field" data-empty-content="<?php _e('No Logos Added', 'optimizer') ?>"></span>

         <?php echo '<input onclick="clientclickFunction(this.id)" class="button button-primary button-large" type="button" value="' . __( '+ Add New', 'optimizer' ) . '" id="'.$this->get_field_id('add_field').'" data-widget-fieldname="'.$this->get_field_name('clients').'" data-widget-fieldid="'.$this->get_field_id('clients').'" />';?>
         <div class="repeater_apply_message"><?php _e( 'Click the Apply Button Below to See the change', 'optimizer' ) ;?></div>
         </div>
         
         <!-- Grayscale Disable Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'grayscale' ); ?>"><?php _e('Disable Grayscale Effect', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'grayscale' ); ?>" name="<?php echo $this->get_field_name( 'grayscale' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['grayscale'] ) echo 'checked'; ?> />
         </p> 
         <!-- Navigation Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'navigation' ); ?>"><?php _e('Enable Navigation', 'optimizer') ?></label>
            <input class="widefat clients_nav_opt" id="<?php echo $this->get_field_id( 'navigation' ); ?>" name="<?php echo $this->get_field_name( 'navigation' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['navigation'] ) echo 'checked'; ?> />
         </p> 


         <!-- Auto Navigation Field -->
         <p class="clients_navauto_opt" style="<?php  echo '1' == $instance['navigation'] ? 'display:block;' : 'display:none;'; ?> ">
            <label for="<?php echo $this->get_field_id( 'autonavigate' ); ?>"><?php _e('Auto Navigate', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'autonavigate' ); ?>" name="<?php echo $this->get_field_name( 'autonavigate' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['autonavigate'] ) echo 'checked'; ?> />
         </p> 

      </div>


      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
         <!-- Clients TITLE DIVIDER Field -->
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
         <!-- Clients Title Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Title Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>

                  
         <!-- Clients Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this);?>

      </div>
        
<?php
	}
	//ENQUEUE CSS
   function front_clients_enqueue_css() {
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
      $title_color =		! empty( $instance['title_color']) ?   'color: ' .$instance['title_color'] : 'color:#333333;';
      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . $font_size. $font_family.'}';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .home_title{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '#'.$id.' .home_title, #'.$id.' .home_subtitle, #'.$id.' span.div_middle{ ' . $title_color . '}';
      $widget_style .= '#'.$id.' span.div_left, #'.$id.' span.div_right{background-' . $title_color . '}';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }
}
?>