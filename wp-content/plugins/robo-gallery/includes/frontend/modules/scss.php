<?php

if ( ! defined( 'WPINC' ) )  die;

class roboGalleryScss{
    private $Compiler;

    private $core;
    private $gallery;

    private $scssPath = '';

    private $content = '';
    private $contentImport = '';

    private $scssFiles = array();

    private $Variables = array();

    private $cacheFileName = '';
    private $cacheFilePath = '';
    private $cacheFileUrl = '';
    private $cacheId;
    private $cached = 0;

    private $debug = 0;


    public function __construct( $core ){    	
    	require_once ROBO_GALLERY_VENDOR_PATH.'scss/init.php';
    	
        //$this->Compiler = new Compiler();
        $this->Compiler = robogallery_scss_init();
        
        $this->core = $core;
        $this->gallery = $core->gallery;		

       	$this->scssPath = ROBO_GALLERY_FRONTEND_MODULES_PATH;

       	$this->initCache();

       	$this->core->addEvent('gallery.block.before', array($this, 'compile'));
    }

    private function initCache(){
    	$this->cacheId = $this->core->getMeta('cache_id');
		$this->cacheFileName = 'robo_gallery_css_id'.$this->gallery->id.'_'.$this->cacheId.'.css';
		$this->cacheFilePath = ROBO_GALLERY_CACHE_CSS_PATH.$this->cacheFileName;
		$this->cacheFileUrl  = ROBO_GALLERY_CACHE_CSS_URL.$this->cacheFileName;
		if( !$this->debug && file_exists($this->cacheFilePath) ) $this->cached = 1;
    }

    public function compile(){
    	if($this->cached){    		
    		$this->includeCss();
    		return ;
    	}
    	$this->initVariables();
        $this->initImport();
        $this->initContent();        
    	$css = $this->Compiler->compile( $this->contentImport . $this->content );
    	if( !$this->writeCache($css)  ){    		
    		$this->core->setContent( $css, 'CssBefore' );
    		//CssBefore
    		//return $css;
    	}
    }


    public function writeCache( $css ){
    	//if( $this->debug ) return false;

  		if( is_writable(dirname($this->cacheFilePath) ) && file_put_contents( $this->cacheFilePath, $css) ) {
  			$this->cached = true;
        	$this->includeCss();
        	return true;	
  		}

  		//global $wp_filesystem;
  		//if(! $wp_filesystem->put_contents( $this->cacheFilePat, $css, FS_CHMOD_FILE)){
    		//return new WP_Error('writing_error', 'Error when writing file'); //return error object
    	//	return false;
		//}
		
  		return false;        
    }


    private function includeCss(){
        wp_enqueue_style( 'robo-gallery-dynamic-id'.$this->gallery->id, $this->cacheFileUrl, array(), ROBO_GALLERY_VERSION, 'all');        
    }

  
    public function addVariables( $varArray ){
    	if(!is_array($varArray) || !count($varArray) ) return ;
    	$this->Variables = array_merge( $this->Variables, $varArray );
    }

    public function initVariables(){
    	$defaultVariable = array(
    		'galleryid' => $this->gallery->id
    	);
    	$this->addVariables( $defaultVariable );
    	$this->core->runEvent('scss.initVariables', $this);
    	$this->Compiler->setVariables( $this->Variables );
    }

    public function addFile( $fileName, $filePath ){
    	$fileNameWithPath = $this->scssPath.$filePath;
    	//if( !file_exists( $fileNameWithPath ) ) return ;
    	$this->contentImport .= ' @import "'.$fileName.'";';
    	$this->Compiler->addImportPath( $fileNameWithPath );
    }

    public function initImport(){
    	$this->core->runEvent('scss.initImport', $this);
    }

    public function addContent( $content, $position = 'after' ){
    	if( $position == 'before') $this->content =  $content . $this->content;
    	if( $position == 'after') $this->content .= $content;
    }

    public function initContent(){
    	$this->core->runEvent('scss.initContent', $this);
    }
}
