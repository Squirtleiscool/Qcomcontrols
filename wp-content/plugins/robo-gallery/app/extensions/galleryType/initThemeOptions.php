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


class roboGalleryClass_TypeThemeOptions extends roboGalleryClass{

	private $moduleUrl = '';
	private $modulePath = '';

	public $themeOptions = '';

	public function __construct(){		

		$this->moduleUrl = plugin_dir_url( __FILE__ );
		$this->modulePath =  plugin_dir_path( __FILE__ );

		$this->themeOptions = include  ROBO_GALLERY_APP_EXTENSIONS_PATH.'galleryType/themes/all.php';

		if( rbsGalleryUtils::compareVersion('2.1') &&  class_exists('roboGalleryThemePro') ){

			//$themeProOptions = ROBO_GALLERY_THEME_PRO;
			$themeProOptions = roboGalleryThemePro::getThemesArray();
			$this->themeOptions = array_merge( $this->themeOptions, $themeProOptions  );
			//print_r( $this->themeOptions );
		}

		parent::__construct();		

	}

	public function getModuleFileName(){
		return __FILE__;
	}

	public function hooks(){
		add_filter('cmb2_rbs_args_defaultvalue', array($this, 'initDefaultTheme'), 10 , 2);		
	}


	public function initDefaultTheme( $args , $fieldObj ){

		if( !isset($_GET['rsg_gallery_type']) || !$_GET['rsg_gallery_type'] ) return $args;
		// echo ('is new gallery');

		$typeGallery = $_GET['rsg_gallery_type'];

		if( !isset($args['_id']) || !$args['_id']  ) return $args;

		$id = preg_replace( '/^'.ROBO_GALLERY_PREFIX.'/', '', $args['_id']);

		if( !$typeGallery ) return $args;

		$typeId = 1;

		if( stripos( $typeGallery, '-' ) !== false ){
			$typeGalleryOption = explode( '-', $typeGallery);			
			if( !is_array( $typeGalleryOption ) || count($typeGalleryOption)!=2  )  return $args;
			$typeGallery 	= $typeGalleryOption[0];
			$typeId 		= $typeGalleryOption[1];
		}

		//echo "typeGallery".$typeGallery;
		//echo "typeId".$typeId;


		if( !isset($this->themeOptions[$typeGallery]) ) return $args;
		//echo ('is group exists');
		
		$fullcode = $typeGallery.'-'.$typeId;

		if( !isset($this->themeOptions[ $typeGallery ][ $typeGallery.'-'.$typeId ])  ) return $args;
		$fullcodeData = $this->themeOptions[ $typeGallery ][ $typeGallery.'-'.$typeId ];
		//echo ('is options exists');

		if( !isset($fullcodeData[ $id ])  ) return $args;
		//echo ('is field exists');
		
		$args['default'] 		= $fullcodeData[ $id ];

		if( isset( $fullcodeData['fields'][ $id ] ) ){
			//print_r( $args );
		}

		if( isset( $fullcodeData['fields'][ $id ] ) && $fullcodeData['fields'][ $id ] == 'hide' ){
			$args['type'] = is_array($args['default']) ? 'hidden_array' : 'hidden';
			//print_r( $args );
		}
	
		//echo " init_default";
		return $args;
	}



}
;

new roboGalleryClass_TypeThemeOptions();