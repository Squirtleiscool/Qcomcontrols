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

class  roboGalleryModuleLayoutV1 extends roboGalleryModuleAbstraction{

	public function init(){		
		$this->core->addEvent('gallery.block.main', array($this, 'renderMainBlock'));
	}

	

	public function renderMainBlock(){

		return 
	 		$this->core->getContent('Begin')

	 		.'<style type="text/css" scoped>'.$this->core->getContent('CssBefore').'</style>'

			.'<div class="robo-gallery-wrap robo-gallery-wrap-id'.$this->id.' robo-gallery-'.$this->getMeta('gallery_type_source').'">'
				.$this->core->getContent('FirstInit')

				.$this->core->getContent('BlockBefore')

				.'<div id="robo_gallery_main_block_'.$this->galleryId.'" class="robogallery-gallery-'.$this->id.'" style="'.$this->core->element->getElementStyles('robo-gallery-main-block').'  display: none;">'
					
					.$this->core->getContent('BlockImagesBefore')

					.'<div id="'.$this->galleryId.'" data-options="'.$this->galleryId.'" style="width:100%;" class="robo_gallery '.$this->core->element->getElementClasses('robo_gallery').'">'
						. $this->renderImagesBlock()
					.'</div>'

					.$this->core->getContent('BlockImagesAfter')

				.'</div>'

				.$this->core->getContent('BlockAfter')

			.'</div>'			
				
			.'<script>'.$this->compileJavaScript().'</script>'

			.$this->core->getContent('End');

	}

	private function renderImagesBlock(){
		$returnHtml = '';
 		$items = $this->core->source->getItems();
		foreach ( $items as $item) {
			if( !is_array($item) ) continue ;
			$returnHtml .= $this->getItemV1( $item );
		}
		return $returnHtml;
	}

	
	private function getItemV1($item){
 		$this->core->runEvent('gallery.image.init.before', $item);
 		$returnHtml = 
 			'<div class="rbs-img'.$this->core->element->getElementClasses('rbs-img-block', $item['id']).'" ' .$this->core->element->getElementAttrs('rbs-img-block', $item['id']).'>'
		            .'<div class="rbs-img-image '.$this->core->element->getElementClasses('rbs-img-image-block', $item['id']).'" '.$this->core->element->getElementAttrs('rbs-img-image-block', $item['id']).'>'
		            	.'<div class="rbs-img-thumbs" '.$this->core->element->getElementAttrs('rbs-img-thumbs-block', $item['id']).'></div>'
						.$this->core->renderBlock('gallery.image.init', $item)
		            .'</div>'
					.$this->core->renderBlock('gallery.image.end', $item)
		        .'</div>';
		$this->core->runEvent('gallery.image.init.after', $item);
		return $returnHtml;
 	}

 	private function getItemV2( $item ){
 		$this->core->runEvent('gallery.image.init.before', $item);
 		$returnHtml = 
 			'<div class="rbs-img  '.$this->core->element->getElementClasses('rbs-img-block', $item['id']).'" ' .$this->core->element->getElementAttrs('rbs-img-block', $item['id']).'>'
		            .'<div class="rbs-img-image '.$this->core->element->getElementClasses('rbs-img-image-block', $item['id']).'" '.$this->core->element->getElementAttrs('rbs-img-image-block', $item['id']).'>'
		            	.'<div class="rbs-img-thumbs" '.$this->core->element->getElementAttrs('rbs-img-thumbs-block', $item['id']).'>'
							//.$this->core->renderBlock('gallery.image.init', $item)
							.$this->core->renderBlock('gallery.image.rbs-img-thumbs-block', $item)
		            	.'</div>'."\n"
		            	.$this->core->renderBlock('gallery.image.init', $item)
		            .'</div>'."\n"
					.$this->core->renderBlock('gallery.image.end', $item)
		        .'</div>'."\n";
		$this->core->runEvent('gallery.image.init.after', $item);
		return $returnHtml;
 	}

 	public function compileJavaScript(){
 		return 'var '.$this->galleryId.' = '.$this->core->jsOptions->getOptionList().';' ;
 	}

}