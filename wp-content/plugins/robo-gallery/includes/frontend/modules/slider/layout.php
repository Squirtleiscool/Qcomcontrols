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

class  roboGalleryModuleLayoutSlider extends roboGalleryModuleAbstraction{

	public function init(){		
		$this->core->addEvent('gallery.block.main', 		array($this, 'renderMainBlock')	 );
		$this->core->addEvent('gallery.image.init.before', 	array($this, 'prepareImageData') );
	}


	public function renderMainBlock(){

		return 
	 		$this->core->getContent('Begin')
	 		.'<style type="text/css" scoped>'.$this->core->getContent('CssBefore').'</style>'

			.'<div id="robo-gallery-slider-wrap'.$this->galleryId.'" class="robo-gallery-slider-wrap robo-gallery-slider-wrap-id'.$this->id.' robo-gallery-'.$this->getMeta('gallery_type_source').'">'
			
				.$this->core->getContent('FirstInit')
				.$this->core->getContent('BlockBefore')

				.'<div id="robo-gallery-slider-block-'.$this->galleryId.'"  data-options="'.$this->galleryId.'" 
					class="swiper-container robo-gallery-slider-container robo-gallery-slider-'.$this->id.'" 
					style="'.$this->core->element->getElementStyles('robo-gallery-slider-block').'  display: none;"
					'.$this->core->element->getElementAttrs('robo-gallery-slider-block').'
				>'
					
					.$this->core->getContent('BlockImagesBefore')
			
					.'<div id="'.$this->galleryId.'" class="swiper-wrapper robo-slider-gallery '.$this->core->element->getElementClasses('robo_gallery').'">'
						. $this->renderImagesBlock()			
					.'</div>'

					.$this->core->getContent('BlockImagesAfter')

				.'</div>'

				.$this->core->getContent('BlockAfter')

			.'</div>'			
				
			.'<script>'.$this->compileJavaScript().'</script>'

			.$this->core->getContent('End');
	}


	public function renderImagesBlock(){
		$returnHtml = '';
 		$items = $this->core->source->getItems();
		foreach ( $items as $item){
			if( !is_array($item) ) continue ;
			$returnHtml .= $this->getItem( $item );
		}
		return $returnHtml;
	}


	public function getItem($item){
 		$this->core->runEvent('gallery.image.init.before', $item);

 		$returnHtml = 
 			$this->core->renderBlock('gallery.image.begin', $item)
 			.'<div class="swiper-slide '.$this->core->element->getElementClasses('swiper-slide').'" 
 					style="'.$this->core->element->getElementStyles('swiper-slide', $item['id']).'" ' 
 					.$this->core->element->getElementAttrs('swiper-slide', $item['id'])
 			.'>'
				.$this->core->renderBlock('gallery.image.init', $item)
				.$this->core->getContent('BlockImageInside')
		    .'</div>'
			.$this->core->renderBlock('gallery.image.end', $item);

		$this->core->runEvent('gallery.image.init.after', $item);
		return $returnHtml;
 	}


 	public function prepareImageData($img){
 		if(empty($img['thumb'])) return ;
		$this->core->element->addElementStyle( 'swiper-slide', 'background-image', "url('".$img['thumb']."')" );
 	} 	


 	public function compileJavaScript(){
 		return 'var '.$this->galleryId.' = '.$this->core->jsOptions->getOptionList().';' ;
 	}
}