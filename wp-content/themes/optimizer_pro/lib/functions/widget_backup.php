<?php
add_action('wp_ajax_nopriv_optimizer_wie_save_preset', 'optimizer_wie_save_preset');
add_action('wp_ajax_optimizer_wie_save_preset', 'optimizer_wie_save_preset');
function optimizer_wie_save_preset() {
   $exportWidgets = false;
	//AJAX REQUESTS--
	if(isset($_REQUEST['sidebarid'])){			
		$thisidebar = esc_attr($_REQUEST['sidebarid']);	
	}
	if(isset($_REQUEST['presetname'])){		
		$presetname = esc_attr($_REQUEST['presetname']);
   }
   
   if(isset($_REQUEST['export'])){		
		$exportWidgets = true;
	}

	// Get all available widgets site supports
	$available_widgets = optimizer_wie_available_widgets();

	// Get all widget instances for each widget
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {

		// Get all instances for this ID base
		$instances = get_option( 'widget_' . $widget_data['id_base'] );

		// Have instances
		if ( ! empty( $instances ) ) {

			// Loop instances
			foreach ( $instances as $instance_id => $instance_data ) {

				// Key is ID (not _multiwidget)
				if ( is_numeric( $instance_id ) ) {
					$unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
					$widget_instances[$unique_instance_id] = $instance_data;
				}

			}

		}

	}
	
	// Gather sidebars with their widget instances
	$sidebars_widgets = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
	$sidebars_widget_instances = array();
	

	
//var_dump($sidebars_widget_instances);

	foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {

		//----------------

				if ( $thisidebar == $sidebar_id ) {

						// Loop widget IDs for this sidebar
						foreach ( $widget_ids as $widget_id ) {
				
							// Is there an instance for this widget ID?
							if ( isset( $widget_instances[$widget_id] ) ) {
				
								// Add to array
								$sidebars_widget_instances['x9x9x'][$widget_id] = $widget_instances[$widget_id];
				
							}
				
						}
				}

	}
	

	// Filter pre-encoded data
	$data = apply_filters( 'optimizer_wie_unencoded_export_data', $sidebars_widget_instances );

	
	// Encode the data for file contents
   $encoded_data = json_encode( $data );

   //var_dump($encoded_data);
   
   //If export widget requested, send the wie file
   if($exportWidgets){
      $encoded_data = str_replace('x9x9x','page_x9x9x', $encoded_data);
      $filename = 'page-widgets.wie'; // append
		// Generate export file contents
      $file_contents = apply_filters( 'optimizer_wie_generate_export_data', $encoded_data );
		$filesize = strlen( $file_contents );
		// Headers to prompt "Save As"
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename=' . $filename );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . $filesize );
		// Clear buffering just in case
		@ob_end_clean();
		flush();
		// Output file contents
		echo $file_contents;
		// Stop execution
		wp_die();
   }
	
	//Get entire array
	$optimizerpresets = get_option('optimizer_presets');
	
	$newarray = array_keys($optimizerpresets);

	$currentpresets = implode(', ', $newarray);
    echo $currentpresets;
	
	if(!empty($presetname)){
		//Alter the options array appropriately
		$optimizerpresets[$presetname] = $encoded_data;
		
		//Update entire array
		update_option('optimizer_presets', $optimizerpresets);
	}
	
	// Stop execution
	wp_die();
}


add_action('wp_ajax_nopriv_optimizer_import_custom_preset', 'optimizer_import_custom_preset');
add_action('wp_ajax_optimizer_import_custom_preset', 'optimizer_import_custom_preset');
function optimizer_import_custom_preset(){
	
	if(isset($_REQUEST['getsidebarid'])){
      if(isset($_REQUEST['getsidebarid'])){	$sidebarid = $_REQUEST['getsidebarid'];	}

      //Import Users Preset
      if(isset($_REQUEST['getpresetname']) && !empty($_REQUEST['getpresetname'])){
         if(isset($_REQUEST['getpresetname'])){	$preset_name = $_REQUEST['getpresetname'];	}

         if($preset_name === 'optimizer_front_sidebar'){
            $optimizerFrontWidgets = optimizer_frontpage_widgets();
            $widgets_data = str_replace('front_sidebar', $sidebarid, $optimizerFrontWidgets);
         }else{
            $optimizerpresets = get_option('optimizer_presets');
            $widgets_data =str_replace('x9x9x', $sidebarid, $optimizerpresets[$preset_name]);
         }

         $widgets_data = json_decode( $widgets_data );
         optimizer_wie_import_data( $widgets_data );
      }
      //Import Optimizer Presets
      if(isset($_REQUEST['getpresetid']) && !empty($_REQUEST['getpresetid'])){
         $preset = $_REQUEST['getpresetid'];
         global $wp_filesystem;
         if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
         }
         //IMPORT WIDGETS
         $widgets_data = trim($wp_filesystem->get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-widgets.wie'));
         //if $wp_filesystem->get_contents disabled by host, use curl()
         if(empty($widgets_data)){ $widgets_data = trim(curl_get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-widgets.wie')); }
         $widgets_data = str_replace('front_sidebar', $sidebarid, $widgets_data);
         $widgets_data = json_decode( $widgets_data );
         $customWidgetData = new stdClass();
         $customWidgetData->$sidebarid = $widgets_data->$sidebarid;

         optimizer_wie_import_data( $customWidgetData );
      }

      //Import Custom Wie File
      if(isset($_REQUEST['customdata']) && !empty($_REQUEST['customdata'])){
         //IMPORT WIDGETS
         $widgets_data = stripslashes($_REQUEST['customdata']);
         $widgets_data = str_replace('page_x9x9x', $sidebarid, $widgets_data);
         $widgets_data = json_decode( $widgets_data );
         $customWidgetData = new stdClass();
         $customWidgetData->$sidebarid = $widgets_data->$sidebarid;
         optimizer_wie_import_data( $customWidgetData );
      }


   }

   wp_die();
}

function optimizer_frontpage_widgets(){
   $widget_instances = array();
   $available_widgets = optimizer_wie_available_widgets();
	foreach ( $available_widgets as $widget_data ) {
		// Get all instances for this ID base
		$instances = get_option( 'widget_' . $widget_data['id_base'] );
		// Have instances
		if ( ! empty( $instances ) ) {
			// Loop instances
			foreach ( $instances as $instance_id => $instance_data ) {
				// Key is ID (not _multiwidget)
				if ( is_numeric( $instance_id ) ) {
					$unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
					$widget_instances[$unique_instance_id] = $instance_data;
				}
			}
		}
   }
   $sidebars_widgets = get_option( 'sidebars_widgets' ); 
   $sidebars_widget_instances = array();
   foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {
      if(is_array($widget_ids)){
         foreach ( $widget_ids as $widget_id ) {
            if ( isset( $widget_instances[$widget_id] ) ) {
               if($sidebar_id === 'front_sidebar'){
                  $sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];
               }
            }
         }
      }
   }
	// Filter pre-encoded data
	$data = apply_filters( 'optimizer_wie_unencoded_export_data', $sidebars_widget_instances );
	// Encode the data for file contents
	$encoded_data = json_encode( $data );
   // Return contents
	return apply_filters( 'optimizer_wie_generate_export_data', $encoded_data );
}


add_action('wp_ajax_nopriv_optimizer_remove_custom_preset', 'optimizer_remove_custom_preset');
add_action('wp_ajax_optimizer_remove_custom_preset', 'optimizer_remove_custom_preset');
function optimizer_remove_custom_preset(){
	
	if(isset($_REQUEST['presetremove'])){
		
		$preset_name = $_REQUEST['presetremove'];
		$optimizerpresets = get_option('optimizer_presets');
		
		if(!empty($preset_name)){
			//remove the preset
			unset($optimizerpresets[$preset_name]);
			//Update entire array
			update_option('optimizer_presets', $optimizerpresets);
		}
		
		// Stop execution
		wp_die();

	}

}