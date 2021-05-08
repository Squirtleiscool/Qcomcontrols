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

class  roboGalleryModuleAbstraction{

	protected $id 			= null;
	protected $options_id 	= null;
	protected $galleryId  	= null;

	protected $core 		= null;
	protected $source 		= null;
	protected $gallery 		= null;
	protected $scssCompiler = null;
	protected $jsOptions 	= null;
	protected $element 		= null;
	
	protected $modulePath 	= null;
	protected $moduleUrl 	= null;
	
	protected $scssFiles 	= array();
	protected $scssVar 		= array();
	protected $scssContent 	=  '';


	/* 
		core - roboGalleryModuleCore
	*/
	public function __construct( $core ){
		$this->core 		= $core;
		$this->source 		= $core->source;
		$this->gallery 		= $this->core->gallery;
		$this->scssCompiler = $this->core->scssCompiler;
		$this->jsOptions 	= $this->core->jsOptions;
		$this->element 		= $this->core->element;
		
		$this->id = $this->gallery->id;
		$this->options_id = $this->gallery->options_id;
		$this->galleryId  = $this->gallery->galleryId;

		$classInfo 			= new ReflectionClass($this);
		$this->modulePath 	= plugin_dir_path($classInfo->getFileName());
		$this->moduleUrl 	= plugin_dir_url($classInfo->getFileName());

		$this->init();
	}


	public function init(){}


	public function addScssContent( $scss, $position = 'after' ){
		if($position=='after') $this->scssContent .= $scss;
			else $this->scssContent = $scss . $this->scssContent;
	}


	public function initScss(){
		$this->core->addEvent('scss.initImport', 		array($this, 'importScss'));
		$this->core->addEvent('scss.initVariables', 	array($this, 'initVariables'));
		$this->core->addEvent('scss.initContent', 		array($this, 'initContent'));
	}


	public function importScss( $scssCompiler ){
		if(!is_array($this->scssFiles) || !count($this->scssFiles)) return ;

		foreach ($this->scssFiles as $scssFile){
			if( count($scssFile)!=2 || !isset($scssFile['name']) || !isset($scssFile['path']) ) continue ;
			
			$scssCompiler->addFile( $scssFile['name'], $scssFile['path'] );	
		}
		
	}


	public function initVariables( $scssCompiler ){
		$scssCompiler->addVariables( $this->scssVar );
	}


	public function initContent( $scssCompiler ){		
		$scssCompiler->addContent( $this->scssContent );
	}
	

	public function getMeta( $optionName ){
		return $this->core->config->getMeta( $optionName );
	}	

	public function getMetaCur( $optionName ){
		return $this->core->config->getMetaCur( $optionName );
	}

}