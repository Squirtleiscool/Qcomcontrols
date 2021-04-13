<?php
/*
Plugin Name: Image Widget RB
Plugin URI: https://wordpress.org/support/plugin/image-widget-rb
Description: Most simple and fast way to create image widget to your sidebar
Version: 1.0.8
Author: rbPlugins
Author URI: https://www.facebook.com/rb.plugins.5
License: GPLv3 or later
Text Domain: image-widget-rb
Domain Path: /languages/
*/

/* */
if( !defined('WPINC') || !defined("ABSPATH") ) die();


define("RB_IMAGE_WIDGET_URL", 		plugin_dir_url( __FILE__ ) );
define("RB_IMAGE_WIDGET_PATH", 		plugin_dir_path( __FILE__ ) );
define("RB_IMAGE_WIDGET_FILE", 		__FILE__ );

define("RB_IMAGE_WIDGET_VERSION", 	'1.0.8' );

add_action( 'plugins_loaded', 'rb_image_widget_load_textdomain' );
function rb_image_widget_load_textdomain() {
  load_plugin_textdomain( 'image-widget-rb', false, dirname(plugin_basename( __FILE__ )) . '/languages' ); 
}

include_once( RB_IMAGE_WIDGET_PATH.'class.plugin.php');
$rb_image_widget_plugin = new RB_IMAGE_WIDGET_PLUGIN();