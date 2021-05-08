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

class  roboGalleryModuleTagsV1 extends roboGalleryModuleAbstraction{		
	private $tags = array();
	
	public function init(){
		//TODO need check if menu isn't
		$this->core->addEvent('gallery.images.get',	array($this, 'initTags'));
		$this->core->addEvent('gallery.image.init.before', array($this, 'initImageCat'));
	}

	public function initTags(){			
		$this->tags = $this->source->getTags();
		if( !is_array($this->tags) || !count($this->tags)) return ;
		//$this->core->element->setElementAttr('tags', 'all', $this->tags );
		$this->core->addEvent('gallery.image.init.before', array($this, 'initImageTags'));		
	}

	public function initImageCat( $img ){
		if( !isset($img['id']) ) return ;
		if( !isset($img['catid']) ) return ;
		$this->element->addClass('rbs-img-block'.$img['id'], 'category'.$img['catid'] );
	}

	public function initImageTags( $img ){
		if( !isset($img['id']) ) return ;
		if( !isset($img['tags']) || !is_array($img['tags']) ) return ;

		foreach ($img['tags'] as $ctag){
			$tag = 'tag_id'.array_search( $ctag, $this->tags );
			$this->element->addClass('rbs-img-block'.$img['id'], $tag );
		}
	}
}
