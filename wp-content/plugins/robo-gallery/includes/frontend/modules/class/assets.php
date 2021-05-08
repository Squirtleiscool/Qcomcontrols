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

class  roboGalleryModuleAssets{

	protected $id = null;
	protected $options_id = null;
	
	protected $jsFiles = array();
	protected $cssFiles = array();

	protected $files = array(
		'js' 	=> array(),
		'css' => array(),
	);

	protected $altVersion = false;

	protected $typeInclude = null; //  api, forced, 

	protected $modulePath 	= null;
	protected $moduleUrl 	= null;	


	public function __construct( $core ){
        $this->core = $core;
        $this->gallery = $core->gallery;
        
        $this->id = $this->gallery->id;
        $this->options_id = $this->gallery->options_id;  

        $classInfo 			= new ReflectionClass($this);
		$this->modulePath 	= plugin_dir_path($classInfo->getFileName());
		$this->moduleUrl 	= plugin_dir_url($classInfo->getFileName());

       	$this->initAssets();
	}

	public function initAssets(){
		$this->initTypeInclude();						
		$this->initFiles();			
		//$this->core->doEvent('gallery.assets.init', $this);

		//	add_action( 'get_footer', array($this, 'addCssFiles') );
		//	add_action( 'get_footer', array($this, 'addJsFiles') );
		$this->addJsFiles();
		$this->addCssFiles();			
	}


	public function initTypeInclude(){

		$this->typeInclude = 'api';
		if( get_option( ROBO_GALLERY_PREFIX.'jqueryVersion', 'build' )!='build' ){
			$this->altVersion = true;
			if( get_option( ROBO_GALLERY_PREFIX.'jqueryVersion', 'build' )=='forced' ){
				$this->typeInclude = 'forced';
			}

		}

 		if ( !empty($_GET['action']) && $_GET['action'] == 'elementor' ) { // fix for elementor editor 
			$this->typeInclude = 'forced';
		}
				
		if( 
			is_array($this->gallery->attr) && 
			isset($this->gallery->attr['assetsIncludeForced']) && 
			$this->gallery->attr['assetsIncludeForced'] 
		){ 
			$this->typeInclude = 'forced';	
		}

		//$this->core->doEvent('gallery.assets.init.type', $this->typeInclude);
	}

	protected function initJsFilesListAlt(){			
		//TODO add js alt files
	}


	protected function initJsFilesList(){	
		//TODO add js files
	}

	protected function initCssFilesList(){
		//TODO add css files
	}

	protected function initFiles(){
		if($this->altVersion) $this->initJsFilesListAlt();
		if(!$this->altVersion)  $this->initJsFilesList();
		$this->initCssFilesList();
		//$this->core->doEvent('gallery.assets.init.files', $this->files);
	}

	public function addCssFiles(){
		$this->initCustomAssets('css');
		$this->addCssFilesApi();
		$this->addCssFilesForced();
	}

	public function addJsFiles(){
		$this->initCustomAssets('js');
		$this->addJsFilesApi();
		$this->addJsFilesForced();
	}

	protected function checkFileParams($fileParams){
		if( !is_array($fileParams) ) return  false;
		if( !isset($fileParams['url']) ) return  false;
		if( !isset($fileParams['depend']) || !is_array($fileParams['depend']) ) return  false;
		return  true;
	}

	public function addCssFilesApi(){
		if($this->typeInclude!='api') return ;
		foreach ($this->files['css'] as $fileLabel => $fileParams){
			if( !$this->checkFileParams($fileParams) ) continue ;
			wp_enqueue_style( $fileLabel, $fileParams['url'], $fileParams['depend'], ROBO_GALLERY_VERSION );			
		}
	}

	public function addCssFilesForced(){
		if($this->typeInclude!='forced' ) return ;
		$scriptTags = '';
		foreach ($this->files['css'] as $fileLabel => $fileParams){
			if( !$this->checkFileParams($fileParams) ) continue ;			
			$scriptTags .= '<link id="'.$fileLabel.'" rel="stylesheet" type="text/css" href="'.$fileParams['url'].'">';
		}
		$this->core->setContent( $scriptTags, 'End' );
	}



	public function addJsFilesApi(){
		if($this->typeInclude!='api') return ;

		foreach ($this->files['js'] as $fileLabel => $fileParams){
			if( !$this->checkFileParams($fileParams) ) continue ;			
			
			wp_enqueue_script( $fileLabel, $fileParams['url'], $fileParams['depend'], ROBO_GALLERY_VERSION, true);
		}
	}

	public function addJsFilesForced(){
		if($this->typeInclude!='forced' ) return ;
		$scriptTags = '';
		foreach ($this->files['js'] as $fileLabel => $fileParams){
			if( !$this->checkFileParams($fileParams) ) continue ;
			$scriptTags .= ' <script type="text/javascript" src="'.$fileParams['url'].'"></script>';
		}
		$this->core->setContent( $scriptTags, 'End' );
	}


 	function initCustomAssets( $type = 'css' ) {

 		$customOptionFiles = get_option( ROBO_GALLERY_PREFIX.$type.'Files', '' );
 		if( $customOptionFiles ){
 			if( strpos( $customOptionFiles, ';')!==false ){
 				$customOptionFiles = explode(';', $customOptionFiles);
 			} else if(  strpos( $customOptionFiles, "\n")!==false  ){
 				$customOptionFiles = explode( "\n", $customOptionFiles);
 			} else $customOptionFiles = array( $customOptionFiles );
 		}

 		if( !is_array($customOptionFiles) || !count($customOptionFiles)) $customOptionFiles = array();
 		$customFiles = array();
 		for ($i = 0; $i < count($customOptionFiles); $i++){
 			$customFiles['robo-gallery-'.$type.'-custom-file'.$i] = array(
 				'url' => site_url( trim( str_replace('\\', '/', $customOptionFiles[$i]) ) ),
 				'depends' => array()
 			);
 		}

 		if( !is_array($customFiles) || !count($customFiles) ) return ;

 		$this->files[$type] = array_merge($this->files[$type], $customFiles); 		
 	}

}
