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


class rbsGalleryUtils extends roboGalleryClass{

    protected $postType;

    public function __construct(){ 
    	parent::__construct();
    	$this->postType = ROBO_GALLERY_TYPE_POST;
    }

    public function hooks(){
   
    }

    public function assets (){		
	}

	static public function isAdminArea($allowAjax = 0){ //rbsGalleryUtils::isAdminArea()
		if( !is_admin() ) return false;		
		if( !$allowAjax && defined('DOING_AJAX') && DOING_AJAX ) return false;  
		if( !$allowAjax &&  function_exists('wp_doing_ajax') && wp_doing_ajax() ) return false;
		if( isset($_REQUEST['doing_wp_cron']) ) return false;
		return true;
	}	

	static function isNewGallery(){
		return self::getIdGallery() ? false : true;
	}

	static function getIdGallery(){
		$id = 0;
		if( isset($_GET['post']) ) $id = (int) $_GET['post'];
		if( isset($_POST['post_ID']) ) $id= $_POST['post_ID'];
		return $id;
	}
 
	static function getTypeGallery( $galleryId = 0 ){
		
		$fieldName =  ROBO_GALLERY_PREFIX . 'gallery_type';
		$galleryType = 'grid';
		
		if( isset($_GET[$fieldName]) && $_GET[$fieldName] ){
			$galleryType = preg_replace( "/[^A-Za-z]/", "", $_GET[ $fieldName ] );
		}

		if(!$galleryId) $galleryId = self::getIdGallery();

		if( $galleryId ){
			$galleryType_temp = get_post_meta( $galleryId,  $fieldName , true );
			if( $galleryType_temp ) $galleryType = $galleryType_temp;
		}
		return $galleryType;
	}

	static function getSourceGallery( $galleryId = 0 ){
		
		$fieldName =  ROBO_GALLERY_PREFIX . 'gallery_type';
		$galleryType = '';
		
		if( isset($_GET[$fieldName]) && $_GET[$fieldName] ){
			$galleryType = preg_replace( "/[^A-Za-z-0-9]/", "", $_GET[ $fieldName ] );
		}

		if(!$galleryId) $galleryId = self::getIdGallery();

		if( $galleryId ){
			$galleryType_temp = get_post_meta( $galleryId,  $fieldName .'_source' , true );
			if( $galleryType_temp ) $galleryType = $galleryType_temp;
		}
		return $galleryType;
	}

	static function getThemeType(){
		$typeField = ROBO_GALLERY_PREFIX.'theme_type';
		$type = isset($_REQUEST[$typeField]) && trim($_REQUEST[$typeField]) ? trim($_REQUEST[$typeField]) : '';
		if( isset($_REQUEST['post']) && (int) $_REQUEST['post'] ){
			$type = get_post_meta( (int) $_REQUEST['post'], $typeField, true );
		}
		$type = preg_replace( '/[^a-z]/i', '', $type );
		return $type;
	}

	public static function compareVersion( $version ){
		if( !ROBO_GALLERY_TYR ) return false;
		if( !defined("ROBO_GALLERY_KEY_VERSION") ) return false;
		return version_compare( ROBO_GALLERY_KEY_VERSION , $version , '>=' );
	}

	public static function getAddonButton( $label ){
		if( ROBO_GALLERY_TYR ) return '';		
		return '<div class="content small-12 columns text-center" style="margin: 25px 0 -5px;">
					<a href="'.ROBO_GALLERY_URL_ADDONS.'" target="_blank" class="warning button">+ '.$label.'</a>
				</div>';
	}

	public static function getUpdateButton( $label ){
		if( !ROBO_GALLERY_TYR ) return '';
		
		return '<div class="content small-12 columns text-center" style="margin: 25px 0 -5px;">
					<a href="'.ROBO_GALLERY_URL_UPDATEKEY.'" target="_blank" class="hollow warning button">'.$label.'</a>
				</div>';
	}

	public static function getProButton( $label ){
		if( ROBO_GALLERY_TYR ) return '';		
		return '<a href="'.ROBO_GALLERY_URL_UPDATEPRO.'" target="_blank" class=" warning button strong " style="white-space: normal; line-height: 17px;">'.$label.'</a>';
	}

}

new rbsGalleryUtils();