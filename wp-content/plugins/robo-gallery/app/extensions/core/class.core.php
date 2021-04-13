<?php
/* @@copyright@ */

if(!defined('WPINC')) die;
if(!defined("ABSPATH")) exit;

if( !function_exists('rbs_gallery_include') ){
	function rbs_gallery_include( $filesForInclude, $path = '' ){
		$filesArray = array();
		if(empty($filesForInclude)) return;
		
		if( !is_array($filesForInclude) ) $filesArray[] = $filesForInclude;
			else $filesArray = $filesForInclude;

		for ($i=0; $i < count($filesArray); $i++) { 
			$item = $filesArray[$i];
			if( file_exists($path.$item) ) require_once $path.$item;
		}
	}
}


if( class_exists( 'Robo_Gallery_Core' ) ) return;

class Robo_Gallery_Core {
	public function __construct(){}
}

new Robo_Gallery_Core();