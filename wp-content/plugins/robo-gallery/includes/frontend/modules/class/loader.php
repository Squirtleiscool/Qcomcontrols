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

class  roboGalleryModuleLoader  extends roboGalleryModuleAbstraction{

	public function init(){
		$this->core->setContent( $this->initHtml(), 'FirstInit', 'before');		
		$this->core->setContent( $this->initCss(), 'CssBefore', 'before');	
		$this->jsOptions->setValue( 'loadingContainer',  '#'.$this->galleryId.'-block-loader' );
		$this->jsOptions->setValue( 'loadingContainerObj',  $this->galleryId.'-block-loader' );	
	}


	public function initHtml(){
		return '<div id="'.$this->galleryId.'-block-loader" class="'.$this->galleryId.'Spinner">'
					.'<div class="'.$this->galleryId.'Rect1"></div> '
					.'<div class="'.$this->galleryId.'Rect2"></div> '
					.'<div class="'.$this->galleryId.'Rect3"></div> '
					.'<div class="'.$this->galleryId.'Rect4"></div> '
					.'<div class="'.$this->galleryId.'Rect5"></div>'
			.'</div>';
	}


	public function initCss(){
		return  		
			'.'.$this->galleryId.'Spinner{
				margin: 50px auto;
				width: 50px;
				height: 40px;
				text-align: center;
				font-size: 10px;
			}
			.'.$this->galleryId.'Spinner > div{
			  background-color: #333;
			  height: 100%;
			  width: 6px;
			  display: inline-block;
			  -webkit-animation: '.$this->galleryId.'-stretchdelay 1.2s infinite ease-in-out;
			  animation: '.$this->galleryId.'-stretchdelay 1.2s infinite ease-in-out;
			}
			.'.$this->galleryId.'Spinner .'.$this->galleryId.'Rect2 {
			  -webkit-animation-delay: -1.1s;
			  animation-delay: -1.1s;
			}
			.'.$this->galleryId.'Spinner .'.$this->galleryId.'Rect3 {
			  -webkit-animation-delay: -1.0s;
			  animation-delay: -1.0s;
			}
			.'.$this->galleryId.'Spinner .'.$this->galleryId.'Rect4 {
			  -webkit-animation-delay: -0.9s;
			  animation-delay: -0.9s;
			}
			.'.$this->galleryId.'Spinner .'.$this->galleryId.'Rect5 {
			  -webkit-animation-delay: -0.8s;
			  animation-delay: -0.8s;
			}
			@-webkit-keyframes '.$this->galleryId.'-stretchdelay {
			  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
			  20% { -webkit-transform: scaleY(1.0) }
			}
			@keyframes '.$this->galleryId.'-stretchdelay {
			  0%, 40%, 100% { 
			    transform: scaleY(0.4);
			    -webkit-transform: scaleY(0.4);
			  }  20% { 
			    transform: scaleY(1.0);
			    -webkit-transform: scaleY(1.0);
			  }
			}
		';		
	}
	
}