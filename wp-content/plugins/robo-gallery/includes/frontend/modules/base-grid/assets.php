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

class  roboGalleryModuleAssetsV1 extends roboGalleryModuleAssets{

	protected function initJsFilesListAlt(){			
		$this->files['js']['robo-gallery-alt'] = array( 'url' => ROBO_GALLERY_URL.'js/robo_gallery_alt.js', 'depend' => array() );
	}

	protected function initJsFilesList(){	
		$this->files['js']['jquery'] 		= array( 'url' => '',  									 'depend' => array()  );
		$this->files['js']['robo-gallery'] 	= array( 'url' => ROBO_GALLERY_URL.'js/robo_gallery.js', 'depend' => array('jquery') );
	}

	protected function initCssFilesList(){
		$this->files['css']['gallery'] = array( 'url' => ROBO_GALLERY_URL.'css/gallery.css', 'depend' => array() );

		if( get_option( ROBO_GALLERY_PREFIX.'fontLoad', 'on' )=='on'){
			$this->files['css']['font'] = array( 'url' => ROBO_GALLERY_URL.'css/gallery.font.css', 'depend' => array() );
		}
	}

}
