<?php
if ( ! defined( 'WPINC' ) )  die;

if( function_exists('robogallery_init_sccs_compille_legacy') ) return ;

function robogallery_init_sccs_compile_legacy(){
	require_once ROBO_GALLERY_VENDOR_PATH.'scss/scssphp-0.12/scss.inc.php';
	return new scssc();
}
