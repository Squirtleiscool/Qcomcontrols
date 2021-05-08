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

class  roboGalleryModuleResizeV1  extends roboGalleryModuleAbstraction{

	public function init(){		
		
		$this->core->addFilter('gallery.source.items', array($this, 'resizeImg'), 0, 1 );

		if( in_array( $this->getMeta('gallery_type'), array('mosaicpro', 'mosaic') ) ) {
			$this->core->addFilter('gallery.source.items', array($this, 'resizeImgMosaicFree'), 0, 1 );
		}		
		if( in_array( $this->getMeta('gallery_type'), array('masonrypro', 'masonry') ) ) {			
			$this->core->addFilter('gallery.source.items', array($this, 'resizeImgMasonryFree'), 0, 1 );
		}
	}

	public function resizeImg( $items ){
		
		//echo 'Gallery Type :: ' . $this->getMeta('gallery_type') . '<br/ >';
		//echo 'Gallery Demo :: '.$this->getMeta('gallery_type_source') . '<br/ >';
		
		if ( ! is_array( $items ) || !count( $items ) ){
			return array();
		}

		//if($this->getMeta('gallery_type') != 'mosaic') return $items;
		
		return $items;
	}


	public function resizeImgMasonryFree( $items ){

		if ( ! is_array( $items ) || !count( $items ) ) return array();		

		$counterImg = 0;
		

		foreach ( $items as $imgKey => $img ) {

			if( $counterImg == 31 ) $counterImg = 7;

			$counterImg++;			
			
             //                               2 5  4   6    4  4    6  4    6   4  4   6   4   6 
			if( !in_array( $counterImg, array( 2, 7, 11, 17, 21, 25, 31,/* 35, 41, 45, 49, 55, 59, 65*/ ) ) ){
				$thumbMasonry = wp_get_attachment_image_src( $img['id'], 'RoboGalleryMansoryImagesTop' );

				if ( ! is_array( $thumbMasonry ) || count( $thumbMasonry ) < 2 ) {
					echo "empty thumbs ";
					continue ;
				}

				$items[ $imgKey ]['thumb']    = $thumbMasonry[0];
				$items[ $imgKey ]['sizeW']    = $thumbMasonry[1]; //*($i%2 ? 1.5: 1)
				$items[ $imgKey ]['sizeH']    = $thumbMasonry[2];
			}
		}
		return $items;
	}


	public function resizeImgMosaicFree( $items ){

		if ( ! is_array( $items ) || !count( $items ) ) return array();

		$counterImg = 0;

		foreach ( $items as $imgKey => $img ) {

			$counterImg++;

			if( $counterImg == 1){
				$items[ $imgKey ]['col'] = 4;
			}

			if( $counterImg == 5){
				$items[ $imgKey ]['col'] = 3;
			}

			if( $counterImg == 10){
				$items[ $imgKey ]['col'] = 2;
			}

			if( $counterImg == 13 ){
				$items[ $imgKey ]['col'] = 4;
			}

			if( $counterImg == 19 ){
				$counterImg = 0;
			}
			
		}
		return $items;
	}
}