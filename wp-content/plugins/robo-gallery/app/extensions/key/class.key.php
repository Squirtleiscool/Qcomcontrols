<?php
/* @@copyright@ */


if(!defined('WPINC')) die;
if(!defined("ABSPATH")) exit;

class Robo_Gallery_Key {

	public function __construct(){

	}

	public static function getKeyPath() {
		$proPath 	= '';
		$key_dir  	= 'robogallerykey';
		$key_file 	= $key_dir.'.php';
		$proPath = ROBO_GALLERY_PATH.$key_file;
		if( file_exists($proPath) ) return $proPath;
		for($i=-1;$i<6;$i++){ 
			$proPath = WP_PLUGIN_DIR.'/'.$key_dir.($i!=-1?'-'.$i:'').'/'.$key_file;
			if ( file_exists($proPath) ) return $proPath;
		}
		return false;
	}
}

/*
ROBO_GALLERY_KEY  - old 
ROBO_GALLERY_KEY_VERSION  - old version number


ROBO_GALLERY_PRO - test
ROBO_GALLERY_KEY_PATH
ROBO_GALLERY_KEY_PATH_DIR



NEW
ROBO_GALLERY_TYR
ROBO_GALLERY_TYR_PATH
ROBO_GALLERY_TYR_PATH_DIR

*/


if( $keyPath = Robo_Gallery_Key::getKeyPath() /*&& 2==3*/ ){	
	include_once( $keyPath );
} 

if( !defined("ROBO_GALLERY_TYR") )  define("ROBO_GALLERY_TYR", 0);