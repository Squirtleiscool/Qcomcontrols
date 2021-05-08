<?php 
/* 
*      Robo Gallery     
*      Version: 3.0.7 - 90614
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */

if ( ! defined( 'WPINC' ) ) exit;

class RoboGalleryRestAPI {

	public function __construct(){}


    public static function init(){
    	add_action( 'rest_api_init', array( 'RoboGalleryRestAPI', 'add_restapi_meta_field' ) );
    }

 
	public static function add_restapi_meta_field() {
	    // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
	    register_rest_field( ROBO_GALLERY_TYPE_POST, 'meta-fields', array(
	           'get_callback'    => array( 'RoboGalleryRestAPI', 'get_post_meta_for_api'),
	           'schema'          => null,
	        )
	    );
	}

 
	public static function get_post_meta_for_api( $object ){

	    $post_id = $object['id'];
	    $metaData = get_post_meta( $post_id );
	     
	    if(!empty( $metaData['rsg_shadow-options'][0] )){
	    	$metaData['rsg_shadow-options'][0] = unserialize( $metaData['rsg_shadow-options'][0] );
	    }

	    if( !empty($metaData['rsg_galleryImages'][0]) ){

	    	function toInt($n){ return (int) $n; }		

	    	$imagesArray = unserialize( $metaData['rsg_galleryImages'][0] );
	    	$imagesArray = array_map('toInt', $imagesArray);
	    	$metaData['rsg_galleryImages'] = array( 'count' => count($imagesArray), 'items' => $imagesArray );
	    }

	    if(!empty($metaData['rsg_width-size'])){
	    	$metaData['rsg_width-size'] = unserialize( $metaData['rsg_width-size'][0] );
	    }

	    return $metaData;
	}
	
}

RoboGalleryRestAPI::init();