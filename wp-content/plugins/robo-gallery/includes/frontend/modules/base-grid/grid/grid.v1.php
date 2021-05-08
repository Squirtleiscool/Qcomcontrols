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

class  roboGalleryModuleGridV1 extends roboGalleryModuleAbstraction{
	
	public function init(){		
		$this->initScss();
		$this->core->addEvent('gallery.init', array($this, 'initGrid'));
	}

	private function addScssFiles(){
 		$this->scssFiles[] = array(
 			'name' => 'grid.scss',
 			'path' => 'base-grid/grid/',
 		);
 	}
	

	public function initGrid(){

		$this->addScssFiles(); 

		$this->initBgOverlay();

		$this->initBgLoading();

		$this->initThumbs();
		
		$this->initShadow();

		$this->initBorder();
		
		$this->initJsOptions();	
		
		$this->core->addEvent('gallery.image.init.before', array($this, 'initDataForImg'));		
	}


	public function initDataForImg($img){
		$this->initImageColumns($img);
		$this->initImageEffects($img);		
		$this->initThumbsTag($img);
	}


	public function initThumbsTag( $img ){
		if( !isset($img['thumb']) ) return ;
		
		$this->element->setElementAttr('rbs-img-thumbs-block'.$img['id'], 'data-thumbnail', $img['thumb'] );
		
		if(isset($img['data'])) $this->element->setElementAttr('rbs-img-thumbs-block'.$img['id'], 'title', 	esc_attr($img['data']->post_title) );
				
		$sizeType  = $this->element->getElementAttr('global', 'sizeType');
		$width  = $sizeType && isset($img['sizeW']) ? $this->element->getElementAttr('global', 'baseWidth') : $img['sizeW'];
		$height = $sizeType && isset($img['sizeH']) ? $this->element->getElementAttr('global', 'baseHeight'): $img['sizeH'];			

		$this->element->setElementAttr('rbs-img-thumbs-block'.$img['id'], 'data-width',  $width);
		$this->element->setElementAttr('rbs-img-thumbs-block'.$img['id'], 'data-height', $height);
	}

	public function initImageColumns($img){
		if( !isset( $img['col']) || !$img['col'] || !(int)$img['col'] || !isset($img['id']) ) return ;		
		$this->element->setElementAttr('rbs-img-block'.$img['id'], 'data-columns', (int) $img['col'] );
	}

	public function initImageEffects($img){
		if( !isset( $img['effect']) || !$img['effect'] ) return ;		
		$this->element->setElementAttr('rbs-img-image-block'.$img['id'], 'data-overlay-effect', $img['effect'] );
	}

	private function initJsOptions(){
		$this->jsOptions->setOption( 'overlayEffect');
		$this->jsOptions->setOption( 'boxesToLoadStart');
		$this->jsOptions->setOption( 'boxesToLoad');
		$this->jsOptions->setOption( 'lazyLoad');
		$this->jsOptions->setOption( 'waitUntilThumbLoads');
		$this->jsOptions->setOption( 'waitForAllThumbsNoMatterWhat');		
		$this->jsOptions->setOption( 'LoadingWord');
		$this->jsOptions->setOption( 'loadMoreWord');		
		$this->jsOptions->setOption( 'noMoreEntriesWord');
		$this->jsOptions->setOption( 'horizontalSpaceBetweenBoxes');
		$this->jsOptions->setOption( 'verticalSpaceBetweenBoxes');		
	}

	private function initThumbs(){
		$this->scssVar['thumbRadius'] = (int) $this->getMeta('radius').'px';
	}

	private function initBgLoading(){
		if( !$this->getMeta('loadingBgColor') ){
			echo "empty bg";
			return ;
		}
		$this->scssVar['backgroundLoading'] = $this->getMeta('loadingBgColor');
	}

	private function initBgOverlay(){
		if( !$this->getMeta('background') ) return;
		$this->scssVar['backgroundHover'] = $this->getMeta('background');
	}

	private function initBorder(){
		if( $borderStyle = $this->getBorderStyle('border') )
			$this->addScssContent( '.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .rbs-img-container{'.$borderStyle.'}' );

		if( $borderStyle = $this->getBorderStyle('hover-border') )
			$this->addScssContent( '.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .rbs-img-container:hover{'.$borderStyle.'}' );
	}

	private function initShadow(){		
		if( $shadowStyle = $this->getShadowStyle('shadow') )
			$this->addScssContent( '.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .rbs-img-container{'.$shadowStyle.'}' );

		if( $shadowStyle = $this->getShadowStyle('hover-shadow') )
			$this->addScssContent( '.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .rbs-img-container:hover{'.$shadowStyle.'}' );
	}

	private function getBorderStyle( $name ){

		if( !$this->getMeta($name) ) return ;

 		$border = $this->getMeta( $name.'-options' );
 		if( !is_array($border) || !count($border) ) return ;
 		
 		$borderStyle = '';

		if( isset($border['width'])){
			$borderStyle.= (int) $border['width'].'px ';
			if( $name =='border'){ 
				$this->jsOptions->setValue( 'borderSize',  (int) $border['width'] );
			}
		}
		if( isset($border['style'])) $borderStyle.=  $border['style'].' ';
		if( isset($border['color'])) $borderStyle.=  $border['color'].' ';		
		return 'border: '.$borderStyle.';';
 	}


 	private function getShadowStyle( $name ){ 		
 		if( !$this->getMeta($name) ) return ;
 		
 		$shadow = $this->getMeta( $name.'-options' );
 		if( !is_array($shadow) || !count($shadow) ) return ;

 		$defaultShadow = array( 
 			'hshadow' => 0,
 			'vshadow' => 0,
 			'bshadow' => 0,
 			'color' => '',
 		);
 		$shadow = array_merge( $defaultShadow , $shadow ); 		

		$shadowStyle = (int) $shadow['hshadow'].'px '
						.(int) $shadow['vshadow'].'px '
						.(int) $shadow['bshadow'].'px '
						.$shadow['color'].' ';

		return 	'-webkit-box-shadow:'.$shadowStyle.';'.
				'-moz-box-shadow: 	'.$shadowStyle.';'.
				'-o-box-shadow: 	'.$shadowStyle.';'.
				'-ms-box-shadow: 	'.$shadowStyle.';'.
				'box-shadow: 		'.$shadowStyle.';';
 	}
}