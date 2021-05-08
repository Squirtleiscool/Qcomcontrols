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

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'core.php';

class roboGallery{

 	public $id = 0;
 	public $options_id = 0;
 	public $gallery_type = 'grid';
 	public $galleryId = '';	

 	public $returnHtml = '';

 	public $isAjaxCall = false;	

 	public $core = null;

 	public $attr = array();

 	function __construct( $attr ){
 
 		if (defined('DOING_AJAX') && DOING_AJAX) $this->isAjaxCall = true;
 		
 		if( !is_array($attr) || !isset($attr['id']) ) return ; 		

 		$this->attr = $attr;
 		$this->galleryId = 'rbs_gallery_'.uniqid();	
		$this->id = $attr['id'];
		$this->initTypeGallery();
		$this->initOptionId();
		$this->core = new roboGalleryModuleCore( $this );
		$this->core->runEvent('gallery.init');
 	}

 	private function initTypeGallery(){ 		
 		if( $gallery_type = get_post_meta( $this->id, ROBO_GALLERY_PREFIX.'gallery_type', true ) ){
 			$this->gallery_type = $gallery_type;
 		} else {
 			echo 'empty type gallery ';
 		}
 	}

 	private function initOptionId(){ 
 		$this->options_id = $this->id;
 		$option_id = (int) get_post_meta( $this->id, ROBO_GALLERY_PREFIX.'options', true );
  		if( $option_id > 0  ) $this->options_id = $option_id;		
 	}

 	public function getGallery( ){

 		if( !$this->id ) return '';
 		$this->returnHtml = '';
 
 		if( $this->returnHtml = $this->core->renderBlock('gallery.render.begin.before') ) return $this->returnHtml; 		

 		$this->core->runEvent('gallery.render.begin');
 		
 		$this->core->jsOptions->setValue( 'mainContainer', '#robo_gallery_main_block_'.$this->galleryId );
 		$this->core->jsOptions->setValue( 'wrapContainer', '#robo-gallery-wrap-'.$this->galleryId );

		$this->core->runEvent('gallery.images.get' );

		$this->core->runEvent('gallery.block.before');
		
		$this->returnHtml = $this->getBlockGalery();

		$this->core->runEvent('gallery.block.after');

		$this->core->runEvent('gallery.render.end');
		
		return $this->returnHtml;
 	}

 	private function getBlockGalery(){
 		if( !count($this->core->source->getItems()) ) return $this->showEmptyMessage();
 		return $this->core->renderBlock('gallery.block.main');
 	}


 	private function showEmptyMessage(){
 		switch ( $this->gallery_type ) {
			case 'youtubepro':
			case 'youtube':
				return $this->showEmptyMessageVideo();
				break;
			default:
				 return $this->showEmptyMessageImage();
				break;
		} 

 	}

 	private function showEmptyMessageImage(){
		return sprintf( 
			'<p><strong>%s</strong><br/>%s<br /><strong>%s</strong></p>',
			__('No Images.', 'robo-gallery'),
			__('Please upload images in images manager section. Click on Manage Images button on the right side of the gallery settings.', 'robo-gallery'),
			get_post_meta( $this->options_id, ROBO_GALLERY_PREFIX.'menuSelfImages', true ) ? 
				'' :
				__("Please make sure that you didn't enabled option: Images of the Current Gallery. Option should have Show value to show images.", 'robo-gallery')
		);			
 	}

 	private function showEmptyMessageVideo(){ 		
		return sprintf(
			'<p><strong>%s</strong><br/>%s<br /></p>',
			__('No Youtube Videos.', 'robo-gallery'),
			__('Please make sure that you setup Youtube API key in gallery settings.  Check values of the video content IDs. Please contact Robo Gallery support if you can\'t find the reason of this problem.', 'robo-gallery')
		);			
 	}

 }