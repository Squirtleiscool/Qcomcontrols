<?php
/*
Plugin Name: Robo Gallery
Plugin URI: https://robosoft.co/gallery
Description: Gallery modes photo gallery, images gallery, video gallery, Polaroid gallery, gallery lighbox, portfolio gallery, responsive gallery
Version: 3.0.7
Author: RoboSoft
Author URI: https://robosoft.co/gallery
License: GPLv3 or later
Text Domain: robo-gallery
Domain Path: /languages
*/

if( !defined('WPINC') ) die;
if( !defined("ABSPATH") ) exit;

define("ROBO_GALLERY_VERSION", 				'3.0.7' ); 


define("ROBO_GALLERY", 						1 );

define("ROBO_GALLERY_MAIN_FILE", 			__FILE__ );

define("ROBO_GALLERY_OPTIONS", 				'rbs_opt_' ); 

define( "ROBO_GALLERY_PREFIX",     			'rsg_');

define("ROBO_GALLERY_TYPE_POST",  			'robo_gallery_table');
define("ROBO_GALLERY_THEME_POST",  			'robo_gallery_theme_type');

define("ROBO_GALLERY_NAMESPACE", 			'robo_gallery_');
define("ROBO_GALLERY_ASSETS_PREFIX", 		'robo_gallery_assets_');

define("ROBO_GALLERY_PATH", 				plugin_dir_path( ROBO_GALLERY_MAIN_FILE ) );
define("ROBO_GALLERY_URL", 					plugin_dir_url( __FILE__ ));

define("ROBO_GALLERY_SPECIAL", 				0 ); 
define("ROBO_GALLERY_EVENT_DATE", 			'2016-12-08' ); 
define("ROBO_GALLERY_EVENT_HOUR", 			20 ); 

define("ROBO_GALLERY_INCLUDES_PATH", 		ROBO_GALLERY_PATH.'includes/');

define("ROBO_GALLERY_VENDOR_PATH", 			ROBO_GALLERY_PATH.'vendor/');

define("ROBO_GALLERY_CACHE_CSS_PATH", 		ROBO_GALLERY_PATH.'cache/css/');
define("ROBO_GALLERY_CACHE_CSS_URL", 		ROBO_GALLERY_URL.'cache/css/');

define("ROBO_GALLERY_FRONTEND_PATH", 		ROBO_GALLERY_INCLUDES_PATH.'frontend/');
define("ROBO_GALLERY_FRONTEND_EXT_PATH",	ROBO_GALLERY_FRONTEND_PATH.'extensions/');
define("ROBO_GALLERY_FRONTEND_MODULES_PATH",ROBO_GALLERY_FRONTEND_PATH.'modules/');


define("ROBO_GALLERY_OPTIONS_PATH", 		ROBO_GALLERY_INCLUDES_PATH.'options/');
define("ROBO_GALLERY_EXTENSIONS_PATH", 		ROBO_GALLERY_INCLUDES_PATH.'extensions/');

/* fields */
define("ROBO_GALLERY_CMB_PATH", 			ROBO_GALLERY_PATH.'cmb2/');
define("ROBO_GALLERY_CMB_FILEDS_PATH", 		ROBO_GALLERY_CMB_PATH.'fields/');


define("ROBO_GALLERY_APP_PATH", 			ROBO_GALLERY_PATH.'app/');
define("ROBO_GALLERY_APP_EXTENSIONS_PATH", 	ROBO_GALLERY_APP_PATH.'extensions/');


define('ROBO_GALLERY_URL_ADDONS', admin_url( 'edit.php?post_type='.ROBO_GALLERY_TYPE_POST.'&page=robo_gallery_table-addons' ));


define('ROBO_GALLERY_URL_UPDATEPRO', 'https://robosoft.co/go.php?product=gallery&task=gopro');
define('ROBO_GALLERY_URL_UPDATEKEY', 'https://robosoft.co/go.php?product=gallery&task=updatekey');

/* activation */
include_once ROBO_GALLERY_APP_EXTENSIONS_PATH.'activation/init.php';

/* core function */
include_once ROBO_GALLERY_APP_EXTENSIONS_PATH.'core/init.php';

/* key */
include_once ROBO_GALLERY_APP_EXTENSIONS_PATH.'key/init.php';

/* language */
include_once ROBO_GALLERY_APP_EXTENSIONS_PATH.'language/init.php';

/* legacy */
require_once ROBO_GALLERY_INCLUDES_PATH.'rbs_gallery_init.php';

/* app */
require_once ROBO_GALLERY_APP_PATH.'app.php';