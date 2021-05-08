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

class roboGalleryClass_ImageResize extends roboGalleryClass{

	private $moduleUrl = '';
	private $modulePath = '';	

	public function __construct(){
		
		add_image_size( 'RoboGalleryMansoryImagesCenter', 	600, 1024, 	array("center", "center") 	);		
		add_image_size( 'RoboGalleryMansoryImagesTop', 		600, 1024, 	array("top", "center") 		);		
		
		$this->moduleUrl 	= plugin_dir_url( 	__FILE__ );
		$this->modulePath 	= plugin_dir_path( 	__FILE__ );

		parent::__construct();		
	}

	public function getModuleFileName(){
		return __FILE__;
	}

	public function load(){}

	public function hooks(){}

}

$imageResize = new roboGalleryClass_ImageResize();