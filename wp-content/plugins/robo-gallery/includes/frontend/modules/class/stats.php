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

class  roboGalleryModuleStats extends roboGalleryModuleAbstraction{
	
	public function init(){
		$this->core->addEvent('gallery.init', array($this, 'updateCountView'));	
	}

	public function updateCountView( ){
		if(!$this->id) return ;		
		$count_key = 'gallery_views_count';
		
		$countView = (int) get_post_meta( $this->id, $count_key, true);
		if( !$countView){
			$countView = 0;
			delete_post_meta( $this->id, $count_key);
			add_post_meta( $this->id, $count_key, '0');
		}
		update_post_meta( $this->id, $count_key, ++$countView);
	}
}