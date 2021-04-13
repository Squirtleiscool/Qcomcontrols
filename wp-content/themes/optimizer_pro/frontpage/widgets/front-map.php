<?php
/*
 *FRONTPAGE - MAP WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_map' );

/*
 * Register widget.
 */
function optimizer_register_front_map() {
	register_widget( 'optimizer_front_map' );
}


/*
 * Widget class.
 */
class optimizer_front_Map extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Contact', 'optimizer' ); }else{ $widgetname = __( '&diams; Contact Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_map', $widgetname, array(
			'classname'   => 'optimizer_front_map mapblock',
			'description' => __( 'Optimizer Frontpage Contact lets you display Conact Form and Live Map.', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_map';
		add_action('wp_enqueue_scripts', array(&$this, 'optimizer_map_styles'));
		//add_action('wp_enqueue_scripts', array(&$this, 'front_map_enqueue_css'));
		add_action('wp_footer', array(&$this,  'optimizer_map_run'), 100);
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		
		extract( $args );
		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? $instance['title']: __('GET IN TOUCH','optimizer');
		$subtitle = isset( $instance['subtitle'] ) ? apply_filters( 'wp_editor_widget_content', $instance['subtitle'] )  : __('Come have a cup of coffee with us','optimizer');
		$contactform = isset( $instance['contactform'] ) ? $instance['contactform'] : '';
		$contactfield1 = isset( $instance['contactfield1'] ) ? $instance['contactfield1'] : '';
		$contactstyle = isset( $instance['contactstyle'] ) ? $instance['contactstyle'] : 'style1';
		$contactalign = isset( $instance['contactalign'] ) ? $instance['contactalign'] : 'right';
		
		$gdpr_policy_field = isset( $instance['gdpr_policy'] ) ? $instance['gdpr_policy'] : 'I agree with this Site\'s Privacy Policy';
		
		$locations = isset( $instance['locations'] ) ? $instance['locations'] : array( );
		$height = isset( $instance['height'] ) ? apply_filters('widget_title', $instance['height']) : '500px';
		$divider = isset( $instance['divider'] ) ? apply_filters('widget_title', $instance['divider']) : 'fa-stop';
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? esc_url($instance['content_bgimg']) : '';
		$style = isset( $instance['style'] ) ? apply_filters('widget_title', $instance['style']) : 'map_default';
		$zoom = isset( $instance['zoom'] ) ? absint($instance['zoom']) : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
		?>
        <?php
		
			//WIDGET EDIT BUTTON(Customizer)
			if(is_customize_preview()){  echo '<a class="edit_widget" title="'.__('Edit ','optimizer').$this->id.'"><i class="fa fa-pencil"></i></a>'; }
			
			if(!empty($contactalign)) $contactalign ='form_'.$contactalign;
			
		$var = $this->id;
		echo '<div class="centerfix"><div class="ast_map '.(empty($locations) && !empty($contactform) ?'no_map': 'has_map').' '.$contactstyle.' '.$contactalign.'">';
			
		if ( !empty($title) || !empty($subtitle)){
				echo '<div class="homeposts_title title_'.str_replace('fa-','dvd_',$divider).'">';
					if ( $title || is_customize_preview() ){
						echo '<h2 class="home_title"><span>'.do_shortcode($title).'</span></h2>';
					}
					if ( $subtitle || is_customize_preview() ){
						echo '<div class="home_subtitle">'.do_shortcode($subtitle).'</div>';
					}
					
					if ( $divider ){
						if( $divider !== 'no_divider'){
							if($divider == 'underline'){ $underline= 'title_underline';}else{$underline='';}
								echo '<div class="optimizer_divider '.$underline.' divider_style_'.str_replace('fa-','dvd_',$divider).'"><span class="div_left"></span><span class="div_middle"><i class="fa '.$divider.'"></i></span><span class="div_right"></span></div>';
						}
					}
				echo '</div>';
		}
			
			
			echo  '<div class="contact_map_wrap">';
			if ( !empty($contactform) ){
				
				if (isset($_POST['contact_name'])){ $contact_name = esc_attr($_POST['contact_name']); }else{  $contact_name =  ''; }
				if (isset($_POST['contact_email'])){  $contact_email =  esc_attr($_POST['contact_email']); }else {  $contact_email =  ''; }
				if (isset($_POST['contact_subject'])){  $contact_subject =  esc_attr($_POST['contact_subject']); }else{  $contact_subject =  ''; }
				if (isset($_POST['contact_message'])){   $contact_message =  esc_textarea($_POST['contact_message']); }else{  $contact_message =  ''; }
				if (isset($_POST['contact_extra'])){   $contact_field1 =  esc_attr($_POST['contact_extra']); }else{  $contact_field1 =  ''; }
				if (isset($_POST['gdpr_policy'])){   $gdpr_policy =  esc_attr($_POST['gdpr_policy']); }else{  $gdpr_policy =  ''; }
				
				if ( !empty($contactfield1) ){$has_extra_field = 'has_extra_field';}else{$has_extra_field = '';}
				echo '<div class="contact_form_wrap '.$has_extra_field.'"><form id="'.$this->id.'_form">';
				
					echo '<p><input placeholder="'.__('Name*', 'optimizer').'" type="text" name="contact_name" class="contact_input contact_name" value="'.$contact_name.'"></label></p>';
					echo '<p><input placeholder="'. __('Email*', 'optimizer').'" type="text" name="contact_email" class="contact_input contact_email" value="'.$contact_email.'"></label></p>';
					if ( !empty($contactfield1) ){
						echo '<p><input placeholder="'.sprintf( __( '%1$s', 'optimizer' ), $contactfield1 ).'" type="text" name="contactfield1" class="contact_input contact_extra" value="'.$contact_field1.'"></p>';
					}
					echo '<p><input placeholder="'. __('Subject*', 'optimizer').'" type="text" name="contact_subject" class="contact_input contact_subject" value="'.$contact_subject.'"></p>';
					echo '<p><textarea placeholder="'. __('Your Message', "optimizer").'" class="contact_message" name="contact_message">'.$contact_message.'</textarea></p>';
					
					if ( !empty($gdpr_policy_field) ){
						echo '<p class="contact_widget_gdpr_policy"><input type="checkbox" name="gdpr_policy" class="contact_cgdpr" id="'.$this->id.'_gdpr_policy" ><label for="'.$this->id.'_gdpr_policy">'.do_shortcode($gdpr_policy_field).'</label></p>';
					}else{
						echo '<p class="contact_widget_gdpr_policy" style="display:none"><input type="checkbox" name="gdpr_policy" class="contact_cgdpr" id="'.$this->id.'_gdpr_policy" checked><label for="'.$this->id.'_gdpr_policy">'.do_shortcode($gdpr_policy_field).'</label></p>';
					}
					echo '<p><input id="'.$this->id.'_submit" onclick="optimizerContact(this.id)" type="button" class="contact_button" name ="send" value ="'.__('Send', 'optimizer').'"></p>';
					
				echo '</form></div>';
				
			}
			
			if ( !empty($contactform) ){
				$minheight = 'min-height:500px;';
			}else{$minheight = '';}
			if ( $locations ){
				if ( $locations ){$height = 'height:'.$height.';'; }else{ $height =''; }
				echo '<div id="asthemap-'.$var.'" style="'.$height. $minheight.'" class="asthemap"></div>';
			}
		
		echo '</div>'; //contact_map_wrap ENDS	

		echo '</div></div>';
		
		?>


<?php if (!empty ($locations) && is_customize_preview() ){ ?>	
	<script>
		if (document.getElementById("asthemap-<?php echo $var; ?>")) {
				<?php $vars = str_replace('-','_',$var); ?>
				
				function initialize_<?php echo $vars; ?>() {
					
					var locations_<?php echo $vars; ?> = [
					<?php foreach ((array)$locations as $location){ ?>
						['<?php $description = preg_replace("/\r\n|\r|\n/",'<br/>',$location['description']); $description = addslashes($description); echo do_shortcode($description); ?>', <?php echo $location['latlong']; ?>],
					<?php } ?>	
					];
					
					
					window.map_<?php echo $vars; ?> = new google.maps.Map(document.getElementById("asthemap-<?php echo $var; ?>"), {
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						scrollwheel: false,
						<?php if($style !== 'map_default') { ?>
						styles: <?php echo $style; ?>
						<?php } ?>				
					});
				
					var infowindow = new google.maps.InfoWindow();
				
					var bounds = new google.maps.LatLngBounds();
				
					for (i = 0; i < locations_<?php echo $vars; ?>.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations_<?php echo $vars; ?>[i][1], locations_<?php echo $vars; ?>[i][2]),
							map: map_<?php echo $vars; ?>
						});
				
						bounds.extend(marker.position);
				
						google.maps.event.addListener(marker, 'click', (function (marker, i) {
							return function () {
								infowindow.setContent(locations_<?php echo $vars; ?>[i][0]);
								infowindow.open(map_<?php echo $vars; ?>, marker);
							}
						})(marker, i));
					}
				
					map_<?php echo $vars; ?>.fitBounds(bounds);
				
					var listener = google.maps.event.addListener(map_<?php echo $vars; ?>, "idle", function () {
							map_<?php echo $vars; ?>.setZoom(<?php echo $zoom; ?>);
						google.maps.event.removeListener(listener);
					});
				}
				
				google.maps.event.addDomListener(window, 'load', initialize_<?php echo $vars; ?>);
				jQuery(document).ajaxStop(initialize_<?php echo $vars; ?>)
		}
	</script>
<?php } ?>

	<?php
	
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
		$instance['subtitle'] = wp_kses_post( $new_instance['subtitle']);
		$instance['contactform'] = isset($new_instance['contactform']) ? strip_tags( $new_instance['contactform']) : '';
		$instance['contactfield1'] = strip_tags( $new_instance['contactfield1']);
		$instance['contactstyle'] = strip_tags( $new_instance['contactstyle']);
		$instance['contactalign'] = strip_tags( $new_instance['contactalign']);
		$instance['gdpr_policy'] =  $new_instance['gdpr_policy'];
		$instance['height'] = strip_tags( $new_instance['height']);
		$instance['divider'] = strip_tags($new_instance['divider']);
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
		$instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
		$instance['style'] = strip_tags( $new_instance['style']);
		$instance['zoom'] = absint( $new_instance['zoom']);
		
        $instance['locations'] = array();

        if ( isset( $new_instance['locations'] ) )
        {
            foreach ( $new_instance['locations'] as $location )
            {
                if ( '' !== trim( $location['latlong'] ) )
                    $instance['locations'][] = $location;
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
		'title' => __('OUR LOCATION','optimizer'),
		'subtitle' => __('Come Have coffee with us','optimizer'),
		'contactform' => '', 
		'contactfield1' => '', 
		'contactstyle' => 'style1',
		'contactalign' => 'right',
		'gdpr_policy' => __('I agree with this Site\'s Privacy Policy','optimizer'),
		'locations' => array(),
		'height' => '500px',
		'divider' => 'fa-stop',
		'title_color' => '#333333',
		'content_bg' => '#ffffff',
		'content_bgimg' => '',
		'style' => 'map_default',
		'zoom' => '2',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <div class="optimizer_widget_tab optimizer_widget_tab--content">
         <!-- MAP TITLE Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
         <!-- MAP Subtitle Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo esc_attr($instance['subtitle']); ?>" type="hidden" />
               <a href="javascript:WPEditorWidget.showEditor('<?php echo $this->get_field_id( 'subtitle' ); ?>');" class="button edit-content-button"><?php _e( 'Edit content', 'optimizer' ) ?></a>
         </p>
         
      
         <a class="widget_contact_title widget_active_contact"><?php _e('Contact Form', 'optimizer') ?></a> <a class="widget_map_title"><?php _e('Map', 'optimizer') ?></a>
         <!-- Contact Form Field -->
         <p class="widget_contact_fields">
            <label for="<?php echo $this->get_field_id( 'contactform' ); ?>"><?php _e('Display Contact Form', 'optimizer') ?>
               </label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'contactform' ); ?>" name="<?php echo $this->get_field_name( 'contactform' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['contactform'] ) echo 'checked'; ?> /><br>
               <small><?php _e('Emails will be sent to your WordPress Admin Email Address.', 'optimizer') ?></small>
         </p>
         
         <!-- Contact Form Additional Field -->
         <p class="widget_contact_fields">
            <label for="<?php echo $this->get_field_id( 'contactfield1' ); ?>"><?php _e('Contact Form Additional Field', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'contactfield1' ); ?>" name="<?php echo $this->get_field_name( 'contactfield1' ); ?>" value="<?php echo htmlspecialchars($instance['contactfield1'], ENT_QUOTES, "UTF-8"); ?>" type="text" placeholder="<?php _e('Field Name (e.g: Phone Number)','optimizer');?>" />
         </p> 

         <!-- Contact Form Style -->
         <p class="widget_contact_fields">
            <label for="<?php echo $this->get_field_id( 'contactstyle' ); ?>"><?php _e('Contact Form Style:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'contactstyle' ); ?>" name="<?php echo $this->get_field_name( 'contactstyle' ); ?>" class="widefat">
               <option value="style1" <?php if ( 'style1' == $instance['contactstyle'] ) echo 'selected="selected"'; ?>><?php _e('Style 1', 'optimizer') ?></option>
               <option value="style2" <?php if ( 'style2' == $instance['contactstyle'] ) echo 'selected="selected"'; ?>><?php _e('Style 2', 'optimizer') ?></option>
                  <option value="style3" <?php if ( 'style3' == $instance['contactstyle'] ) echo 'selected="selected"'; ?>><?php _e('Style 3', 'optimizer') ?></option>
               <option value="style4" <?php if ( 'style4' == $instance['contactstyle'] ) echo 'selected="selected"'; ?>><?php _e('Style 4', 'optimizer') ?></option>
               <option value="style5" <?php if ( 'style5' == $instance['contactstyle'] ) echo 'selected="selected"'; ?>><?php _e('Style 5', 'optimizer') ?></option>
               
            </select>
         </p>
         
         
         <!-- Contact Form Style -->
         <p class="widget_contact_fields">
            <label for="<?php echo $this->get_field_id( 'contactalign' ); ?>"><?php _e('Contact Form Alignment:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'contactalign' ); ?>" name="<?php echo $this->get_field_name( 'contactalign' ); ?>" class="widefat">
               <option value="left" <?php if ( 'left' == $instance['contactalign'] ) echo 'selected="selected"'; ?>><?php _e('Left', 'optimizer') ?></option>
               <option value="center" <?php if ( 'center' == $instance['contactalign']) echo 'selected="selected"'; ?>><?php _e('Center', 'optimizer') ?></option>
                  <option value="right" <?php if ( 'right' == $instance['contactalign'] ) echo 'selected="selected"'; ?>><?php _e('Right', 'optimizer') ?></option>
            </select>
         </p>
         
         <!-- Contact Form GDPR -->
         <p class="widget_contact_fields">
            <label for="<?php echo $this->get_field_id( 'gdpr_policy' ); ?>"><?php _e('GDPR Consent Checkbox', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gdpr_policy' ); ?>" name="<?php echo $this->get_field_name( 'gdpr_policy' ); ?>" value="<?php echo htmlspecialchars($instance['gdpr_policy'], ENT_QUOTES, "UTF-8"); ?>" type="text" placeholder="<?php _e('I agree with this Site\'s Privacy Policy','optimizer');?>" /><br>
            <small><?php _e('Clear the field to hide the checkbox in the Contact Form', 'optimizer') ?></small>
         </p> 
         
         <!-- MAP Location Field -->
         <div class="widget_repeater widget_map_fields" data-widget-id="<?php echo $this->get_field_id( 'locations' ); ?>" data-widget-name="<?php echo $this->get_field_name( 'locations' ); ?>">
         <?php 
         $locations = isset( $instance['locations'] ) ? $instance['locations'] : array();
         $location_num = count($locations);
         $locations[$location_num+1] = '';
         $locations_html = array();
         $location_counter = 0;

         foreach ( $locations as $location ) 
         {   
               if ( isset($location['title']) && isset($location['latlong']) )
               {
                  $locations_html[] = sprintf(
                     '<div class="widget_input_wrap"><span id="%9$s%2$s" class="repeat_handle" onclick="repeatOpen(this.id)">%3$s</span><input type="text" name="%1$s[%2$s][title]" value="%3$s" class="widefat sourc%2$s" placeholder="%6$s"><input type="text" name="%1$s[%2$s][latlong]" value="%4$s" class="widefat sourc%2$s" placeholder="%7$s"><textarea name="%1$s[%2$s][description]" class="widefat sourc%2$s" placeholder="%8$s">%5$s</textarea><span class="remove-field button button-primary button-large">Remove</span></div>',
                     $this->get_field_name( 'locations' ),
                     $location_counter,
                  esc_attr( $location['title'] ),
                     esc_attr( $location['latlong'] ),
                  esc_attr( $location['description'] ),
                  __('Location Title (Required)','optimizer'),
                  __('Latitude , Longitude (Required)','optimizer'),
                  __('Location Description','optimizer'),
                  $this->get_field_id('add_field').'-repeat'
                  );
               }

               $location_counter += 1;
         }

         echo '<h4>'.__('Locations','optimizer').'</h4>' . join( $locations_html );

         ?>
         
         <script type="text/javascript">
            var fieldnum = <?php echo json_encode( $location_counter-1 ) ?>;
            var count = fieldnum;
            function mapclickFunction(buttondid){
               //var count = fieldnum;
               var fieldname = jQuery('#'+buttondid).data('widget-fieldname');
               var fieldid = jQuery('#'+buttondid).data('widget-fieldid');
               
                  jQuery('#'+buttondid).prev().append("<div class='widget_input_wrap'><span id='"+buttondid+"-repeat"+(count+1)+"' class='repeat_handle' onclick='repeatOpen(this.id)'></span><input type='text' name='"+fieldname+"["+(count+1)+"][title]' value='<?php _e( 'Location Name (Required)', 'optimizer' ); ?>' class='widefat' placeholder='<?php _e( 'Location Title (Required)', 'optimizer' ); ?>'><input type='text' name='"+fieldname+"["+(count+1)+"][latlong]' value='53.359286 , -2.040904' class='widefat sourc"+(count+1)+"' placeholder='<?php _e( 'Latitude , Longitude (Required)', 'optimizer' ); ?>'><textarea name='"+fieldname+"["+(count+1)+"][description] class='widefat sourc"+(count+1)+"' placeholder='<?php _e( 'Location Description', 'optimizer' ); ?>'></textarea><span class='remove-field button button-primary button-large'>Remove</span></div>");
                  count++;
               
            }
            

            jQuery( document ).on( 'load widget-added widget-updated', function () {
               
               jQuery(document).on("click", ".remove-field", function(e) {
                  jQuery(this).parent().remove();
               });
            });

         </script>

         <span id="<?php echo $this->get_field_id( 'field_clone' );?>" class="repeat_clone_field" data-empty-content="<?php _e('No Map Location Added', 'optimizer') ?>"></span>

         <?php echo '<input onclick="mapclickFunction(this.id)" class="button button-primary button-large" type="button" value="' . __( '+ Add New', 'optimizer' ) . '" id="'.$this->get_field_id('add_field').'" data-widget-fieldname="'.$this->get_field_name('locations').'" data-widget-fieldid="'.$this->get_field_id('locations').'" />';?>
         </div>
         

         <!-- MAP Height Field -->
         <p class="widget_map_fields">
         <?php _e('If your Maps are not working you will have to <a href="https://optimizerwp.com/documentation/get-google-map-api-key/" target="_blank">Get a Map Api Key</a> and then insert the key in Customize > Miscellaneous > Other > Google Map Api Key.','optimizer');?>
         </p>
         
         <!-- MAP Height Field -->
         <p class="widget_map_fields">
            <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Map Height:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" type="text" />
         </p>
         
      
         <!-- MAP Content STYLE Field -->
         <p class="widget_map_fields">
            <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Map Style:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat">
               <option value="map_default" <?php if ( 'map_default' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Default', 'optimizer') ?></option>
               <option value="map_bluish" <?php if ( 'map_bluish' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Bluish', 'optimizer') ?></option>
                  <option value="map_angel" <?php if ( 'map_angel' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Angel', 'optimizer') ?></option>
               <option value="map_pale" <?php if ( 'map_pale' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Pale', 'optimizer') ?></option>
               <option value="map_gowalla" <?php if ( 'map_gowalla' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Gowalla', 'optimizer') ?></option>
                  <option value="map_pastel" <?php if ( 'map_pastel' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Pastel', 'optimizer') ?></option>
               <option value="map_old" <?php if ( 'map_old' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Old', 'optimizer') ?></option>
               <option value="map_light" <?php if ( 'map_light' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Light', 'optimizer') ?></option>
                  <option value="map_dark" <?php if ( 'map_dark' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Dark', 'optimizer') ?></option>
               <option value="map_greyscale" <?php if ( 'map_greyscale' == $instance['style'] ) echo 'selected="selected"'; ?>><?php _e('Greyscale', 'optimizer') ?></option>
                  
            </select>
         </p>
         
         <!-- Map Zoom Field -->
         <p class="widget_map_fields">
            <label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php _e('Map Zoom', 'optimizer') ?></label>
            <input class="widefat optimizer_range_slider" id="<?php echo $this->get_field_id( 'zoom' ); ?>" name="<?php echo $this->get_field_name( 'zoom' ); ?>" value="<?php echo $instance['zoom']; ?>" type="range" min="2" max="20" />
         </p>


      </div>
        

      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">

         <!-- MAP TITLE DIVIDER Field -->
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
         
         <!-- Map Title Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Title Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>

                  
         <!-- Map Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
         
         <!-- MAP Background Image Field -->
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
         <?php optimizer_widget_basic_styles($instance, $this);?>

      </div>


<?php
	}
	
		//Load the Map Styles
		function optimizer_map_styles() { 
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
				if ( ! empty( $instance['locations'] ) ) {  
					global $optimizer;
					if(!empty($optimizer['map_api'])){ $mapkey = 'https://maps.googleapis.com/maps/api/js?key='.$optimizer['map_api'].''; }else{ $mapkey = 'https://maps.googleapis.com/maps/api/js?sensor=false';}
					wp_enqueue_script('optimizer_map',get_template_directory_uri().'/assets/js/map-styles.js', array('jquery'),'1.0', true);
					wp_enqueue_script('optimizer_googlemaps', $mapkey, array('jquery'),'1.0', true);
				}
					
				}
			}
		}




	function optimizer_map_run(){
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
		$idbase = str_replace('-','_',$id);
		if ( ! empty( $instance['locations'] ) ) {$locations = $instance['locations'];  }else{$locations = '';}
		if ( ! empty( $instance['style'] ) ) {$style = $instance['style'];  }else{$style = '';}
		if ( ! empty( $instance['zoom'] ) ) {$zoom = $instance['zoom'];  }else{$zoom = '';}
		$var = $id;
		
if (!empty ($locations)){ ?>	
	<script>
		if (document.getElementById("asthemap-<?php echo $var; ?>")) {
				<?php $vars = str_replace('-','_',$var); ?>
				
				function initialize_<?php echo $vars; ?>() {
					
					var locations_<?php echo $vars; ?> = [
					<?php foreach ((array)$locations as $location){ ?>
						['<?php $description = preg_replace("/\r\n|\r|\n/",'<br/>',$location['description']); $description = addslashes($description); echo do_shortcode($description); ?>', <?php echo $location['latlong']; ?>],
					<?php } ?>	
					];
					
					
					window.map_<?php echo $vars; ?> = new google.maps.Map(document.getElementById("asthemap-<?php echo $var; ?>"), {
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						scrollwheel: false,
						<?php if($style !== 'map_default') { ?>
						styles: <?php echo $style; ?>
						<?php } ?>				
					});
				
					var infowindow = new google.maps.InfoWindow();
				
					var bounds = new google.maps.LatLngBounds();
				
					for (i = 0; i < locations_<?php echo $vars; ?>.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations_<?php echo $vars; ?>[i][1], locations_<?php echo $vars; ?>[i][2]),
							map: map_<?php echo $vars; ?>
						});
				
						bounds.extend(marker.position);
				
						google.maps.event.addListener(marker, 'click', (function (marker, i) {
							return function () {
								infowindow.setContent(locations_<?php echo $vars; ?>[i][0]);
								infowindow.open(map_<?php echo $vars; ?>, marker);
							}
						})(marker, i));
					}
					
					var center;
					function calculateCenter() {
					  center = map_<?php echo $vars; ?>.getCenter();
					}
				
					map_<?php echo $vars; ?>.fitBounds(bounds);
				
					var listener = google.maps.event.addListener(map_<?php echo $vars; ?>, "idle", function () {
						map_<?php echo $vars; ?>.setZoom(<?php echo $zoom; ?>);
						google.maps.event.removeListener(listener);
						calculateCenter();
					});
					
					google.maps.event.addDomListener(window, 'resize', function() {
					  map_<?php echo $vars; ?>.setCenter(center);
					});
				}
				

				google.maps.event.addDomListener(window, 'load', initialize_<?php echo $vars; ?>);
				jQuery(document).ajaxStop(initialize_<?php echo $vars; ?>)
		}
	</script>
<?php }
	}
}
}
		
		
   //ENQUEUE CSS
   function front_map_enqueue_css() {
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
      $content_bg = ! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ': 'background-color:#ffffff;';
      $content_bgimg = ! empty( $instance['content_bgimg'] ) ? 'background-image: url(' . $instance['content_bgimg'] . '); ': '';  
      $title_color = ! empty( $instance['title_color'] ) ? $instance['title_color'] . '; ' : '#333333;';

      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . ''.$content_bgimg. $font_size. $font_family.'}';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .home_title{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '#'.$id.' .home_title, #'.$id.' .home_subtitle, #'.$id.' span.div_middle{ color:' . $title_color . '}';
      $widget_style .= '#'.$id.' span.div_left, #'.$id.' span.div_right{background-color:' . $title_color . '}';
      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';

      return $widget_style;
   }
}
?>