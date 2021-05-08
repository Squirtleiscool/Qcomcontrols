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

class  roboGalleryModuleOptionsSlider extends roboGalleryModuleAbstraction{

	public function init(){

		$this->initBaseOption();

		$this->initAutoPlay();
 		$this->initSize();
 		$this->initPreload();
 		$this->initSliderView();
 		$this->initEffect();
 		$this->initDirection();
 		$this->initNavigation();

 		$this->initScrollbar();
 		$this->initPagination();

		$this->initRTL();
	}


	public function initRTL(){
		if ( !is_rtl() ) return ;
		$this->core->element->setElementAttr( 'robo-gallery-slider-block', 'dir', "rtl" );		
	}


 	public function initBaseOption(){
 		$this->jsOptions->setValue( 'loop',  			true );
 		$this->jsOptions->setValue( 'centeredSlides',  	true ); 		
	}


	public function initAutoPlay(){
 		if( !$this->getMeta('autoplay') )  return ;
		$this->jsOptions->setValue(
			'autoplay', 
			array(
				'delay' => $this->getMeta( 'delay' ), 
				'disableOnInteraction' => false ,
			)
		);
	}


	public function initSize(){
 		if( !$this->getMeta( 'autoWidth' ) ) {
 			$width = $this->getMeta('width');
			$widthStyle = '100%;';
			if(isset($width['value']) && isset($width['type']) ) $widthStyle = $width['value'].$width['type'];
			$this->core->element->addElementStyle( 'robo-gallery-slider-block', 'width', $widthStyle );
		}

		if( !$this->getMeta( 'autoHeight' ) ) {
			$height = $this->getMeta('height');
			$heightStyle = '100vh;';
			if(isset($height['value']) && isset($height['type']) ) $heightCss = $height['value'].$height['type'];			
			$this->core->element->addElementStyle( 'robo-gallery-slider-block', 'height', $heightCss );
		}

 	}


 	public function initPreload(){

 		switch ( $this->getMeta('preload') ) {
 			case 'off':
 					$this->jsOptions->setValue( 'preloadImages', 		false );
 					$this->jsOptions->setValue( 'updateOnImagesReady', false );
 				break;

 			case 'lazy_white':
 					$this->jsOptions->setValue( 'preloadImages', 	false );
 					$this->jsOptions->setValue( 'lazy', 			true );
 					
 					$this->core->setContent( '<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>', 'BlockImageInside');
 					$this->core->element->addClass( 'swiper-slide', 'swiper-lazy' );
 					 					
 				break;
 			case 'lazy':
 					$this->jsOptions->setValue( 'preloadImages', 	false );
 					$this->jsOptions->setValue( 'lazy', 			true );

 					$this->core->setContent( '<div class="swiper-lazy-preloader"></div>', 'BlockImageInside');
 					$this->core->element->addClass( 'swiper-slide', 'swiper-lazy' );
 				break;

 			case 'preload':
 			default:
 					$this->jsOptions->setValue( 'preloadImages', 		true );
 					$this->jsOptions->setValue( 'updateOnImagesReady', 	true );
 				break;
 		}
 	}


 	public function initSliderView(){
  		$sliderView = $this->getMeta( 'sliderView');
  		if( !is_array($sliderView) || count($sliderView) < 1 ) return ;

  		if( isset($sliderView['slidesPerView']) && $sliderView['slidesPerView'] > 0 )
  				$this->jsOptions->setValue('slidesPerView', (int)  $sliderView['slidesPerView']);

  		if( isset($sliderView['spaceBetween']) && $sliderView['spaceBetween'] > 0 )
  			$this->jsOptions->setValue('spaceBetween', (int) $sliderView['spaceBetween']);  		
 	}


 	public function initEffect(){ 		
 		//$this->jsOptions->setValue( 'effect', 'fade' );
 		$effect = $this->getMeta( 'effect');
 		if( !in_array( $effect, array('slide', 'fade', 'cube', 'coverflow', 'flip') ) ) return ;
 		$this->jsOptions->setValue( 'effect', $effect );
 	}

 	public function initDirection(){
 		$direction = $this->getMeta( 'direction');
 		if( $direction == 'vertical' || $direction == 'horizontal' ){
 			$this->jsOptions->setValue( 'direction', $direction );
 		}
 	}


 	public function initNavigation(){
 		if( $this->getMeta('nav_buttons')!='show' ) return ;
 		
 		$this->core->setContent( '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>', 'BlockImagesAfter');
 		$this->jsOptions->setValue( 'navigation', array( 'nextEl'=> '.swiper-button-next', 'prevEl'=> '.swiper-button-prev' ) ); 		
 	}


 	public function initScrollbar(){
 		if( $this->getMeta('nav_scrollbar') != 'show' ) return ;
 		$this->core->setContent( '<div class="swiper-scrollbar"></div>', 'BlockImagesAfter');
 		$this->jsOptions->setValue( 'scrollbar', array( 'el'=> '.swiper-scrollbar', 'draggable'=> true, ) ); 		
 	}


 	public function initPagination(){
 		$pagination =  $this->getMeta('nav_pagination');
 		
 		if( !$pagination ) return ;
 		
		$this->core->setContent( '<div class="swiper-pagination"></div>', 'BlockImagesAfter');
		
		$paginationOptions = array( 
			'el'			=> '.swiper-pagination', 
			'type' 			=> $pagination,
			'clickable' 	=> true,
			'dynamicBullets'=> true 
		);
		
		$this->jsOptions->setValue( 'pagination', $paginationOptions );
 	}

}