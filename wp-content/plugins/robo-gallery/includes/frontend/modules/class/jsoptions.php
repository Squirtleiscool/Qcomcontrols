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

class  roboGalleryModuleJsOptions{
	private $id 		= null;
	private $options_id = null;

	protected $options 	= array();	


	public function __construct( $core ){
	        $this->core 	= $core;
	        $this->gallery 	= $core->gallery;

	        $this->id 		= $this->gallery->id;
	        $this->options_id 	= $this->gallery->options_id;

	       	$this->initJsOptions();
	}


	private function initJsOptions(){
		$this->setValue( 'version', ROBO_GALLERY_VERSION);
		$this->setValue( 'id', $this->id);
		$this->setValue( 'class', 'id'.$this->id);
		$this->setValue( 'roboGalleryDelay', 1000 );
		$this->setValue( 'mainContainer', '#robo_gallery_main_block_'.$this->gallery->galleryId );
	}


	static function setNestedArrayValue(&$array, $path, &$value, $delimiter = '/') {
	    $pathParts = explode($delimiter, $path);
	    $current = &$array;
	    foreach($pathParts as $key){
	    	if( !is_array($current) ) $current = array();
	        $current = &$current[$key];
	    }
	    $backup = $current;
	    $current = $value;
	    return $backup;
	}


	public function setValue( $valName, $value ){
		if( strpos($valName, '/')!==false ){
			self::setNestedArrayValue( $this->options, $valName, $value);
			return ;
		}

		if( isset($this->options[$valName]) ){
			if( is_array($this->options[$valName]) ){
				if( is_array($value) ) $this->options[$valName] = $this->options[$valName] + $value;
					else $this->options[$valName][] = $value;
			}
			return ;
		}
		$this->options[$valName] = $value;
	}

	
	public function setJsFunction($valName, $funcCode){
		if(is_array($funcCode)){
			if( count($funcCode)){
				foreach ($funcCode as $funcName => $funcCodeCur ) {					
					$this->setJsFunction($valName.'/'.$funcName, $funcCodeCur);
				}
			}
			return ;
		}
	    $this->setValue($valName, '|***'.$funcCode.'***|');
	}


	public function setOption( $valName ){
		$value = $this->core->getMeta($valName);
		if($value===null){
			//echo "null for ".$valName."<br />";
			return ;		
		}
		$this->setValue($valName , $value);
	}


	private static function fixJsFunction( $json ){
		return  str_replace(
			array( '"|***', '***|"' ),
			array( '', 		'' 		),
			$json
		);
	}


	public function getOptionList(){
		$json = json_encode( $this->options,  JSON_NUMERIC_CHECK );
		$json = self::fixJsFunction($json);
		return $json;
	}

}