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
 
if ( ! defined( 'WPINC' ) )  die;

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'init.php';

class roboGalleryModuleCore{

	public $gallery 	= null;
	public $scssCompiler= null;
	public $config 		= null;
	public $element 	= null;
	public $jsOptions 	= null;
	public $assets 		= null;
	public $stats 		= null;
	public $cache 		= null;
	public $cacheDB 	= null;

	public $source 		= null;

	protected $events 		= array();
	protected $contentHTML 	= array();
	protected $modules 		= array();

	public function __construct( $gallery ){
		$this->gallery = $gallery;
		$this->init();	
	}


	public function init(){

		$this->config 		= new roboGalleryModuleConfig( $this );
		
		$this->source 		= new roboGalleryModuleSource( $this );

		$this->cache 		= new roboGalleryModuleCache( $this );
		$this->cacheDB 		= new roboGalleryModuleCacheDB( $this );

		$this->scssCompiler = new roboGalleryScss( $this );
		$this->element 		= new roboGalleryModuleElement( $this );

		$this->jsOptions 	= new roboGalleryModuleJsOptions( $this );

		$this->stats 		= new roboGalleryModuleStats( $this );
		
		$this->modules['addtexts'] 	= new roboGalleryModuleAddTexts( $this );
		$this->modules['customcss'] = new roboGalleryModuleCustomCss( $this );
		$this->modules['loader'] 	= new roboGalleryModuleLoader( $this );


		if( $this->gallery->gallery_type == 'slider' ){
			$this->modules['layout.slider'] 		= new roboGalleryModuleLayoutSlider( $this );
			$this->modules['options.slider'] 		= new roboGalleryModuleOptionsSlider( $this );
			$this->modules['assets.slider'] 		= new roboGalleryModuleAssetsSlider( $this );
			$this->modules['content.slider'] 		= new roboGalleryModuleContentSlider( $this );
		} else {
			$this->modules['resize.v1'] 		= new roboGalleryModuleResizeV1( $this );		
			$this->modules['assets.v1'] 		= new roboGalleryModuleAssetsV1( $this );
				
			$this->modules['layout.v1'] 		= new roboGalleryModuleLayoutV1( $this );
			$this->modules['menu.v1'] 			= new roboGalleryModuleMenuV1( $this );
			$this->modules['lightbox.v1'] 		= new roboGalleryModuleLightboxV1( $this );
			$this->modules['grid.v1'] 			= new roboGalleryModuleGridV1( $this );
			$this->modules['grid.columns.v1']	= new roboGalleryModuleGridColumnsV1( $this );
			$this->modules['hover.v1'] 			= new roboGalleryModuleHoverV1( $this );
			$this->modules['polaroid.v1'] 		= new roboGalleryModulePolaroidV1( $this );
			$this->modules['tags.v1'] 			= new roboGalleryModuleTagsV1( $this );
			$this->modules['size.v1'] 			= new roboGalleryModuleSizeV1( $this );
			$this->modules['effects.set1'] 		= new roboGalleryModuleEffectSet1( $this );
			//$this->modules['searchv1'] 		= new roboGalleryModuleSearchV1( $this );
		}
	}


	public function renderBlock( $tag, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL, $arg5 = NULL ){		
		return $this->runEvent( $tag, $arg1, $arg2, $arg3, $arg4, $arg5 );
	}


	public function runEvent( $tag, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL, $arg5 = NULL ){
		if( !isset($this->events[$tag]) ) return ;

		$eventsActions = $this->events[$tag];
		
		if( !is_array($eventsActions) || !count($eventsActions) ) return ;

		$returnContent = '';

		foreach ($eventsActions as  $eventsAction ) {
			$returnContent .= $this->internalDoEvent( $eventsAction, $arg1, $arg2, $arg3, $arg4, $arg5  );
		}
		return $returnContent;
	}

	public function applyFilters( $tag, $value = NULL, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL, $arg5 = NULL ){
		if( !has_filter('robogallery-'.$this->gallery->id.'-'.$tag) ){
			return $value;
		}
		
		return apply_filters( 'robogallery-'.$this->gallery->id.'-'.$tag, $value, $arg1, $arg2, $arg3, $arg4, $arg5 );
	}

	public function addFilter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ){	
		return add_filter( 'robogallery-'.$this->gallery->id.'-'.$tag, $function_to_add, $priority, $accepted_args );		
	}

	public function internalDoEvent( $eventsAction, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL, $arg5 = NULL ){		
		if( !is_array($eventsAction) ) return ;
		if( !isset($eventsAction[0]) ) return ;
		$funcCallback = $eventsAction[0];
		
		return call_user_func( $funcCallback, $arg1, $arg2, $arg3, $arg4, $arg5 );
	}

	public function addEvent( $tag,  $userFunc, $before = 0 ){
		if( !$tag ) return false;
		if( !$userFunc ) return false;

		if( !isset($this->events[$tag]) ) $this->events[$tag] = array();
		if( !is_array($this->events[$tag]) ) $this->events[$tag] = array();

		$newEvent = array( $userFunc );

		if($before) array_unshift( $this->events[$tag] , $newEvent );
			else $this->events[$tag][] = $newEvent;
	}


	public function getContent( $point = '' ){
 		if( !$point ) 
 			return implode($this->contentHTML);

 		if( isset($this->contentHTML[$point]) && $this->contentHTML[$point] ) 
 			return $this->contentHTML[$point];
 		
 		return '';
 	}

 	public function setContent( $content, $point = '', $position = 'after' ){
 		if( !$content || !$point ) 
 			return ;
 		
 		if( !isset($this->contentHTML[$point]) ) 
 			$this->contentHTML[$point] = '';

 		if( $position=='after' ) $this->contentHTML[$point] .= $content;

 		if( $position=='before' ) $this->contentHTML[$point] = $content . $this->contentHTML[$point];
 	}
	

	private function minData( $value ){
		$value = str_replace( array("\n", "\r", "\t"), '', $value);

		$value = str_replace("  ", ' ', $value);
		$value = str_replace(" {", '{', $value);
		$value = str_replace("{ ", '{', $value);
		$value = str_replace(": ", ':', $value);
		$value = str_replace(", ", ',', $value);

		$value = str_replace("  ", ' ', $value);
		return $value;
	}

	public function getIdPrefix(){
		return $this->gallery->galleryId;
	}

	public function getMeta( $name ){
    	return $this->config->getMeta($name);
    }

}