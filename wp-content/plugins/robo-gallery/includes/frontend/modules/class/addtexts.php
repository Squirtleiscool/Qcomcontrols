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

class  roboGalleryModuleAddTexts extends roboGalleryModuleAbstraction{
	
	public function init(){
		if( $pretext = $this->getMetaCur('pretext') ) $this->core->setContent( '<div>'.$pretext.'</div>', 'Begin');
		
		if( $aftertext = $this->getMetaCur('aftertext') ) $this->core->setContent( '<div>'.$aftertext.'</div>', 'End');	
	}
}