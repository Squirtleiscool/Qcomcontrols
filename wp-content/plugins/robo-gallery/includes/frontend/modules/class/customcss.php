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

class  roboGalleryModuleCustomCss extends roboGalleryModuleAbstraction{
	
	public function init(){
		if( $customCss = $this->getMeta('cssStyle') ) $this->core->setContent( $customCss, 'CssBefore');		
	}
}