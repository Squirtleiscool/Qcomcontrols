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

class  roboGalleryModuleConfig{

	private $id = null;
	private $options_id = null;
	private $config = array();	

	public function __construct( $core ){
       $this->core = $core;
       $this->gallery = $core->gallery;

       $this->id = $this->gallery->id;
       $this->options_id = $this->gallery->options_id; 
         
       $this->initConfig();
	}

	public function initConfig(){
			$this->config = array();
			
			$config = get_post_meta( $this->options_id );
			//$this->core->doEvent('gallery.config.get', $config);
	        if( !is_array($config) || !count($config) ) return ;

	        foreach ($config as $key => $value) {

	        	if( !is_array($value) || !isset($value[0]) ) continue ;
	        	$value = $value[0];
	        	if( is_serialized($value) ) $value =  maybe_unserialize( $value );
	        	
	        	//$this->core->doEvent('gallery.config.set.', $key, $value);	        	
	        	$this->config[$key] =  $value;
	        }	
	        //print_r($this->config);
	        //print_r( array_keys($this->config) );
	        //$this->core->doEvent('gallery.config.init', $this->config);			
	}

	public function getMetaRaw( $name ){
    	if( !isset($this->config[$name]) ) return ;
    	return $this->config[$name];
    }

    public function getMeta( $name ){    	
    	return $this->getMetaRaw( ROBO_GALLERY_PREFIX.$name );	
    }

    public function getMetaCur( $name ){
    	return get_post_meta( $this->id, ROBO_GALLERY_PREFIX.$name, true );
    }
}
