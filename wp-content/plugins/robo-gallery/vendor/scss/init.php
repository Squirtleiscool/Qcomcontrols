<?php

if ( ! defined( 'WPINC' ) )  die;

if( function_exists('robogallery_scss_init') ) return ;
	
function robogallery_scss_init() {

	$php_legacy= false;

	if( !function_exists('version_compare') || !defined('PHP_VERSION') || version_compare(PHP_VERSION, '5.7') < 0 ){
		$php_legacy = true;
	}
	 
	if($php_legacy){
		require_once ROBO_GALLERY_VENDOR_PATH.'scss/legacy.php';
		return robogallery_init_sccs_compile_legacy();
	} else {
		require_once ROBO_GALLERY_VENDOR_PATH.'scss/current.php';
		return robogallery_init_sccs_compile_current();
	}
}