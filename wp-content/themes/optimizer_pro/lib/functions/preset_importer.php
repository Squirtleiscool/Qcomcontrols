<?php

if(!function_exists( 'optimizer_preset_import' ) ){
	function optimizer_preset_import() {
		
			global $wp_filesystem;
			if (empty($wp_filesystem)) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
		
		$presets = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27');
		
		foreach ($presets as $preset) {
			if (isset($_POST['import_preset'.$preset]) && check_admin_referer( 'optimizer_restorePreset'.$preset, 'optimizer_restorePreset'.$preset ) ) {
				
				//IMPORT OPTIONS
				$filecontent = trim($wp_filesystem->get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-options.json'));
				//IF $wp_filesystem->get_contents disabled by host, use curl()
				if(empty($filecontent)){ $filecontent = trim(curl_get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-options.json')); }
				$string = str_replace("\n","",$filecontent); 
				$options = json_decode($string, true);
				update_option('optimizer', $options);
				
				//IMPORT WIDGETS
				$widgets_data = trim($wp_filesystem->get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-widgets.wie'));
				//if $wp_filesystem->get_contents disabled by host, use curl()
				if(empty($widgets_data)){ $widgets_data = trim(curl_get_contents(get_template_directory_uri().'/lib/presets/demo'.$preset.'-widgets.wie')); }
				$widgets_data = json_decode( $widgets_data );
				optimizer_wie_import_data( $widgets_data );
				
				//Redirect After
				$redirect = admin_url('/customize.php'); 
				wp_redirect( $redirect);
			}
		}
	}	
}
add_action( 'init', 'optimizer_preset_import' );

/*========================================= HELPERS ==========================================*/

function optimizer_wie_available_widgets() {
	global $wp_registered_widget_controls;
	$widget_controls = $wp_registered_widget_controls;
	$available_widgets = array();
	foreach ( $widget_controls as $widget ) {
		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];
		}
	}
	return apply_filters( 'optimizer_wie_available_widgets', $available_widgets );
}

function optimizer_wie_add_mime_types( $mime_types ) {
	$mime_types['wie'] = 'application/json';
	$mime_types['ttf'] = 'application/x-font-sfnt';
	$mime_types['eot'] = 'application/vnd.ms-fontobject';
	$mime_types['woff'] = 'application/x-font-woff';
	return $mime_types;
}
add_filter( 'upload_mimes', 'optimizer_wie_add_mime_types' );



/*========================================= IMPORT ==========================================*/

/**
 * Import widget JSON data
 *
 * @since 0.4
 * @global array $wp_registered_sidebars
 * @param object $data JSON widget data from .wie file
 * @return array Results array
 */
function optimizer_wie_import_data( $data ) {
	global $wp_registered_sidebars;
	// Have valid data?
	// If no data or could not decode
	if ( empty( $data ) || ! is_object( $data ) ) {
		wp_die(
			__( 'Import data could not be read. Please try a different file.', 'optimizer' ),
			'',
			array( 'back_link' => true )
		);
	}
	// Hook before import
	do_action( 'optimizer_wie_before_import' );
	$data = apply_filters( 'optimizer_wie_import_data', $data );
	// Get all available widgets site supports
	$available_widgets = optimizer_wie_available_widgets();
	// Get all existing widget instances
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}
	// Begin results
	$results = array();
	// Loop import data's sidebars
	foreach ( $data as $sidebar_id => $widgets ) {
		// Skip inactive widgets
      // (should not be in export file)
      
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}
		// Check if sidebar is available on this site
      // Otherwise add widgets to inactive, and say so
		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
			$sidebar_available = true;
			$use_sidebar_id = $sidebar_id;
			$sidebar_message_type = 'success';
			$sidebar_message = '';
		} else {
			$sidebar_available = false;
			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			$sidebar_message_type = 'error';
			$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'optimizer' );
      }
		// Result for sidebar
		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
		$results[$sidebar_id]['message'] = $sidebar_message;
      $results[$sidebar_id]['widgets'] = array();

      $sidebars_widgets = get_option( 'sidebars_widgets' ); 
		// Loop widgets
		foreach ( $widgets as $widget_instance_id => $widget ) {
			$fail = false;
			// Get id_base (remove -# from end) and instance ID number
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
			// Does site support this widget?
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = __( 'Site does not support widget', 'optimizer' ); // explain why widget not imported
         }
			// Filter to modify settings object before conversion to array and import
			// Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
			// Ideally the newer optimizer_wie_widget_settings_array below will be used instead of this
			$widget = apply_filters( 'optimizer_wie_widget_settings', $widget ); // object
			// Convert multidimensional objects to multidimensional arrays
			// Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
			// Without this, they are imported as objects and cause fatal error on Widgets page
			// If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
			// It is probably much more likely that arrays are used than objects, however
			$widget = json_decode( json_encode( $widget ), true );
			// Filter to modify settings array
			// This is preferred over the older optimizer_wie_widget_settings filter above
			// Do before identical check because changes may make it identical to end result (such as URL replacements)
			$widget = apply_filters( 'optimizer_wie_widget_settings_array', $widget );
         // Does widget with identical settings already exist in same sidebar?
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
				// Get existing widgets in this sidebar
				//$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go
				// Loop widgets with ID base
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
				foreach ( $single_widget_instances as $check_id => $check_widget ) {
					// Is widget in same sidebar and has identical settings?
					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
						$fail = true;
						$widget_message_type = 'warning';
						$widget_message = __( 'Widget already exists', 'optimizer' ); // explain why widget not imported
						break;
					}
				}
			}
			// No failure
			if ( ! $fail ) {
				// Add widget instance
				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
				$single_widget_instances[] = $widget; // add it
					// Get the key it was given
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );
					// If key is 0, make it 1
					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}
					// Move _multiwidget to end of array for uniformity
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}
					// Update option with new widget
					update_option( 'widget_' . $id_base, $single_widget_instances );
				// Assign widget instance to sidebar
				//$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
            $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar

            //error_log(json_encode(get_option( 'sidebars_widgets' )["optimizer_frontpage-test"]));
				// Success message
				if ( $sidebar_available ) {
					$widget_message_type = 'success';
					$widget_message = __( 'Imported', 'optimizer' );
				} else {
					$widget_message_type = 'warning';
					$widget_message = __( 'Imported to Inactive', 'optimizer' );
				}
			}
			// Result for widget instance
			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget['title'] ) ? $widget['title'] : __( 'No Title', 'optimizer' ); // show "No Title" if widget instance is untitled
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
      }

      if(count($sidebars_widgets) > 0){
         update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data
      }
      
   }

	// Hook after import
	do_action( 'optimizer_wie_after_import' );
	// Return results
	return apply_filters( 'optimizer_wie_import_results', $results );
}


/*========================================= EXPORT ==========================================*/


function optimizer_wie_generate_export_data() {

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
	foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {

		// Skip inactive widgets
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}

		// Skip if no data or not an array (array_version)
		if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
			continue;
		}

		// Loop widget IDs for this sidebar
		foreach ( $widget_ids as $widget_id ) {

			// Is there an instance for this widget ID?
			if ( isset( $widget_instances[$widget_id] ) ) {

				// Add to array
				$sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];

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

/**
 * Send export file to user
 *
 * Triggered by URL like /wp-admin/tools.php?page=widget-importer-exporter&export=1
 *
 * The data is JSON with .wie extension in order not to confuse export files with other plugins.
 *
 * @since 0.1
 */
 
add_action('wp_ajax_nopriv_optimizer_wie_send_export_file', 'optimizer_wie_send_export_file');
add_action('wp_ajax_optimizer_wie_send_export_file', 'optimizer_wie_send_export_file');
function optimizer_wie_send_export_file() {

		// Build filename
		// Single Site: yoursite.com-widgets.wie
		// Multisite: site.multisite.com-widgets.wie or multisite.com-site-widgets.wie
		//$site_url = site_url( '', 'http' );
		//$site_url = trim( $site_url, '/\\' ); // remove trailing slash
		//$filename = str_replace( 'http://', '', $site_url ); // remove http://
		//$filename = str_replace( array( '/', '\\' ), '-', $filename ); // replace slashes with -
		$filename = 'theme-widgets.wie'; // append
		//$filename = apply_filters( 'optimizer_wie_export_filename', $filename );

		// Generate export file contents
		$file_contents = optimizer_wie_generate_export_data();
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
		die();


}
