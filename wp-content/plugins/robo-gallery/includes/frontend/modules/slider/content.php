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

class  roboGalleryModuleContentSlider extends roboGalleryModuleAbstraction{

	public function init(){

		if( $this->getMeta('content') == 'show' ){
			$this->core->addEvent('gallery.image.init', array($this, 'getImageDescription') );
		}
	}

	public function getImageDescription($img){

		if( empty($img['data']) ) return ;		

		$desc = '';		
		switch ( $this->getMeta('content_source') ){
			case 'title':
					$desc = $img['data']->post_title;
				break;
			case 'caption':
					$desc = $img['data']->post_excerpt;
				break;
			case 'desc':
					$desc .= $img['data']->post_content;
				break;
			
			default:				
				break;
		}
		
		if( !$desc ) return '';

		$theme = 'swiper-slide-desc-'.( $this->getMeta('content_theme') == 'light' ? 'light' : 'dark' );

		return '<div class="swiper-slide-desc '.$theme.'">'.$desc.'</div>';
	}

}