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

class  roboGalleryModuleCache extends roboGalleryModuleAbstraction{

	public $cache = true;
	public $cacheTime = true;
	public $cacheId = true;
	
	public function init(){		
		return ;
		if( !$this->getMetaCur('cache') ) return ;
		
		$this->cacheId = $this->gallery->id ;

		$this->initCacheTime();

		$this->core->addEvent('gallery.render.begin.before',array($this, 'readCache'));
		$this->core->addEvent('gallery.render.end', 		array($this, 'saveCache'));
	}

	public function initCacheTime(){
		$this->cacheTime = (int) get_option(ROBO_GALLERY_PREFIX.'cache', '12');
		if(!$this->cacheTime) $this->cacheTime = 12;
		$this->cacheTime = $this->cacheTime * HOUR_IN_SECONDS;
	}

	public function readCache(){	
 		return get_transient( ROBO_GALLERY_PREFIX.'cache_id'.$this->cacheId );
	}

	public function saveCache(){			
		set_transient( ROBO_GALLERY_PREFIX.'cache_id'.$this->cacheId , $this->gallery->returnHtml, $this->cacheTime );
	}
}