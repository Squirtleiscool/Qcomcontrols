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


class rbsGalleryAddons{
   
    protected $postType;

    protected $title;

    protected $assetsUri;

    protected $actionName;

    protected $tag;
    
    protected $addons;

    protected $menuTag='';

    protected $pluginConfirm = '';

    public $view;

    public function __construct( $postType ){ 
    	
    	if (!$postType) {
			throw new Exception( "Could not set post type");
		} 

        $this->postType = $postType;

        $this->checkDepends();

        $this->addons = $this->getAddons();

        $this->checkRequestVars();

        $this->title = rbsGalleryBrand::getPluginName();

        $this->assetsUri = plugin_dir_url(__FILE__);

        $this->path = plugin_dir_path( __FILE__ );

        $this->tag = "{$this->postType}-file";

        $this->view = new rbsGalleryClassView( $this->path.'templates/' );
        
        $this->addAjaxHooks();
        
		add_action( 'init', array($this, 'init') );
    }
    
    private function addAjaxHooks(){
    	/* check_status */
        add_action('wp_ajax_rb_check_status', 		array($this, 'getPluginStatus'));

        /* activate included plugin */
        add_action('wp_ajax_rb_activate_included_plugin', array($this, 'activateIncludedPlugin') );

        /* deactivate included plugin */
        add_action('wp_ajax_rb_deactivate_included_plugin', array($this, 'deactivateIncludedPlugin') );
    }

    private function checkDepends(){
    	if( !function_exists('is_plugin_active') ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    	include_once plugin_dir_path( __FILE__ ).'class.addons.action.php';
    }
		

    public function checkRequestVars(){
    	if(
    		isset($_GET['plugin_confirm']) && 
    		$_GET['plugin_confirm'] 
    	){
			$plugin = sanitize_text_field( $_GET['plugin_confirm'] );
			
			$status = $this->checkPluginStatus( $plugin );

			if( !$status['error'] && !$status['active'] ) $this->pluginConfirm = $plugin;
    	} 
    }


    public function showAddons(){
    	$this->enqueueScripts();
	    $this->renderAddons();
    }

    public function addMenuItem(){ 
    	$this->menuTag = add_submenu_page( 'edit.php?post_type='.$this->postType, $this->title.' Add-ons', 'Add-ons', 'manage_options', $this->postType.'-addons', array($this, 'showAddons' ) );
    }


    public function init(){ 
    	add_action('admin_menu', array($this, 'addMenuItem'), 10);
    }
    
    public function enqueueScripts(){ 
        $screen = get_current_screen();

        if ($this->postType !== $screen->post_type) return;

      	

        wp_enqueue_style(
            $this->tag,
            $this->assetsUri . 'css/style.css',
            array()
        );

        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_script('jquery-ui-dialog');

        add_thickbox();

        wp_enqueue_script('plugin-install');

        wp_enqueue_script(
            $this->tag.'-js',
            $this->assetsUri . 'js/script.js',
            array('jquery'),
            false,
            true
        );

        /*$custom_css = "html body div#wpcontent div.fs-notice, .ngg_admin_notice{display: none !important; }";
        wp_add_inline_style( $this->tag, $custom_css );*/

       	wp_localize_script(
            $this->tag.'-js',

            'rbsGalleryAddonAttributes', 

            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),

                'action' => array(
                    'save' => '', //$this->actionName
                ),

                'pluginConfirm' => $this->pluginConfirm ? 1 : 0,
            
                'labels' => array(
                	'download'			=> __('Download', 'robo-gallery'),
                	'downloading'		=> __('Downloading', 'robo-gallery'),

                	'activate'			=> __('Activate', 'robo-gallery'),
                	'activating'		=> __('Activating', 'robo-gallery'), 
                	'activated'			=> __('Activated', 'robo-gallery'), 

                	'deactivate'		=> __('Deactivate', 'robo-gallery'),   
                	'deactivating'		=> __('Deactivating', 'robo-gallery'),   
                	'deactivated'		=> __('Deactivated', 'robo-gallery'),   
   

                	'information'		=> __('Information', 'robo-gallery'),     

                	'installnow'		=> __('Install Now', 'robo-gallery'),     
                	'installing'		=> __('Installing', 'robo-gallery'),     
                	'installed'			=> __('Installed', 'robo-gallery'),   

                	'confirm_title' 	=> __('Confirmation', 'robo-gallery'),   
                	'confirm_desc' 		=> __('Please confirm that you wish to install new Add-on:', 'robo-gallery'),   
                	'confirm_cancel' 	=> __('Cancel', 'robo-gallery'),   
                	'confirm_button' 	=> __('Confirm', 'robo-gallery'),   
                ),
            )
        );
    }

    
    public function confirmDialog(){
    	
    	$params = array(
    		'title' => '',
    		'slug' => '',
    	);    	

    	if( isset($this->addons[$this->pluginConfirm]) ){

    		if( isset($this->addons[$this->pluginConfirm]['title']) ){
    			$params['title'] = $this->addons[$this->pluginConfirm]['title'];
    		}

    		if( isset($this->addons[$this->pluginConfirm]['slug']) ){
    			$params['slug'] = $this->addons[$this->pluginConfirm]['slug'];
    		}
    	} 
    	echo $this->view->content("confirm", $params);
    }


    public function renderAddons() {

        /*$this->checkPermission();*/

        if($this->pluginConfirm) $this->confirmDialog();
        	

        $params=array( 
        	'addons' 		=> '',
        	'categories' 	=> $this->getCategories(),
        );

        if(!count($this->addons)) return '';

        foreach ($this->addons as $code => $addon ) {
        	$params['addons']  .= $this->renderAddon( $code, $addon );
        }

        echo $this->view->content("addons", $params);
    }


    public function getAddonData( $addon, $elem ){
    	return isset($addon[$elem]) ? $addon[$elem] :  null;
	}


	public function getDownloadUrl( $slug ){
	 	return esc_url(
	 		wp_nonce_url(
	 			self_admin_url('update.php?action=install-plugin&plugin=' . $slug), 
	 			'install-plugin_' . $slug)
	 	);
	}

	private function getActivateUrl( $plugin, $action = 'activate' ) {
		if ( strpos( $plugin, '/' ) ) {
			$plugin = str_replace( '\/', '%2F', $plugin );
		}
		$url = sprintf( admin_url( 'plugins.php?action=' . $action . '&plugin=%s&plugin_status=all&paged=1&s' ), $plugin );
		$_REQUEST['plugin'] = $plugin;
		$url = wp_nonce_url( $url, $action . '-plugin_' . $plugin );
		return $url;
	}

	private function getManagerUrl( $plugin ) {
		$url = sprintf( admin_url( 'plugins.php?plugin_status=search&paged=1&s=%s' ), strtolower($plugin) );
		return $url;
	}

   	public function renderAddon( $code, $addon ){

   		$slug = $this->getAddonData($addon, 'slug');

   		$fileName = $this->getAddonData($addon, 'file');

   		$status = $this->checkPluginStatus($code);

		$templatingFields = array( 
			'title' 	=> $this->getAddonData($addon, 'title'), 
			
			'slug' 		=> $slug,
			'code'		=> $code,

			'status' 	=> $status,

			'commercial'=> $this->getAddonData($addon, 'commercial'), 
			'public' 	=> $this->getAddonData($addon, 'public'), 
			'included' 	=> $this->getAddonData($addon, 'included'), 

			'desc' 	=> $this->getAddonData($addon, 'desc'),
			
			'category' 	=> $this->getAddonData($addon, 'category'),

			'url'		=> $this->getAddonData($addon, 'url'),
		);

		$templatingFields['downloadUrl'] = $this->getDownloadUrl( $slug )  ;
		$templatingFields['activateUrl'] = $this->getActivateUrl( $fileName );
		
		$templatingFields['deactivateUrl'] = admin_url( 'plugins.php?plugin_status=all&paged=1&s');
		$templatingFields['informationUrl'] = admin_url('plugin-install.php?tab=plugin-information&plugin='.$slug.'&TB_iframe=true&width=600&height=550');		
		
		$templatingFields['pluginManagerUrl'] = $this->getManagerUrl($slug);		

		$nonce = '';

   		//print_r($templatingFields);
		return $this->view->content("addon", $templatingFields);
   	}

   	private function putAddon( $addonConfig  ){

   		$addonDefaultConfig = array(
   			'title' 	=> '',
   			'category' 	=> '',
   			
   			'slug'		=> '',
   			'file'		=> '',

   			/*'price' 	=> 0,*/

   			'commercial'=> 0,			
			'included'	=> 0,
			'public' 	=> 0,

			'desc'		=> '',

	);

   		if(!is_array($addonConfig)) return $addonDefaultConfigl;

   		return array_merge( $addonDefaultConfig, $addonConfig );
   	}

   	public function deactivateIncludedPlugin(){
   		$status = array( 'result' => false );
   		$plugin = sanitize_text_field( $_POST['plugin'] );
   		$this->checkPermission();   		
   		$status['result'] = $this->activatePlugin($plugin,'deactivate');
   		echo json_encode($status);
		exit;
   	}

   	public function activateIncludedPlugin(){   	
   		$status = array( 'result' => false );
   		$plugin = sanitize_text_field( $_POST['plugin'] );
   		$this->checkPermission();
   		$status['result'] = $this->activatePlugin($plugin);
   		echo json_encode($status);
		exit;
   	}


   	public function activatePlugin( $plugin, $action = 'activate' ){
   		if(!$plugin ) return false;
   		$activateCode =  $action=='activate' ? 1 : 0;

   		//echo ROBO_GALLERY_OPTIONS.'addon_'.$plugin;

   		update_option( ROBO_GALLERY_OPTIONS.'addon_'.$plugin, $activateCode );
   		return true;
   	}

   	public function getAddons(){

   		$addons =array();

   		$addons['robogallerypro'] = $this->putAddon( 
   			array(
   				'title' 	=> 'Robo Gallery Pro',
   				'category' 	=> 'gallery',
   				'url'		=> 'https://robosoft.co/robogallery/#pricing',
   				'slug'		=> 'robogallerykey',
   				'file'		=> 'robogallerykey/robogallerykey.php',
   				'desc'		=> 'with PRO version you get more advanced functionality and even more flexibility in settings and gallery design. Get access to more add-ons which extend functionality of the plugin.',
   				'commercial'=> 1,
   			)
   		);

   		/*$addons['lightbox'] = $this->putAddon( 
   			array(
   				'title' 	=> 'Lightbox Pro',
   				'category' 	=> 'lightbox',
   				'url'		=> 'https://google.com',
   				'slug'		=> 'akismet',
   				'file'		=> 'akismet/akismet.php',
   				'commercial'=> 1,
   			)
   		);*/


   		$addons['widget'] = $this->putAddon( 
   			array(
   				'title' 	=> 'Gallery Widget',
   				'category' 	=> 'interface',
   				'slug'		=> 'image-widget-rb',
   				'file'		=> 'image-widget-rb/image-widget-rb.php',
   				'desc'		=> 'Here you can  configure gallery widget  for the sidebars. Simple settings make you able to configure your widget gallery in few simple steps.',
   				'public'=> 1,
   			)
   		);

   		$addons['backup'] = $this->putAddon( 
   			array(
   				'title' 	=> 'BackUp ',
   				'category' 	=> 'navigation',
   				'slug'		=> 'backup',
   				'desc'		=> 'Advanced gallery backup add-on with wide range of backup customization modes. Back up and restore galleries with or without images in few clicks.',
   				'included'  => 1
   			)
   		);

   		$addons['stats'] = $this->putAddon( 
   			array(
   				'title' 	=> 'Statistics',
   				'category' 	=> 'menu',
   				'slug'		=> 'stats',
   				'desc'		=> 'Advanced statistics gallery add-on with very simple and effective interface. Just few clicks and you get all information for your gallery users visits. View statistics by gallery  /  total  / all elements.',
   				'included' 	=> 1,
   			)
   		);

   		return $addons;
   	}

   	public function getCategories(){
   		return Array ( 
			'all' => 		Array ( 'name' => 'All' ),
			'activated' => 	Array ( 'name' => 'Active' ),
		/*	'featured' => 	Array ( 'name' => 'Featured' ), 
			'free' => 		Array ( 'name' => 'Free' ),*/
			'premium' => 	Array ( 'name' => 'Premium' ),
		);
   	}

   	function checkPluginStatus( $plugin ){

   		$status = array(
   			'download' 	=> 0,
			'active' 	=> 0,
			'message' 	=> '',
			'error' 	=> 0,
		);
   		
   		if( !$plugin ){
   			$status['error'] = 1;
   			$status['message'] = 'Error:: input parameters is empty';
   			return $status;	
   		} 

   		if( !isset( $this->addons[$plugin] ) ){
   			$status['error'] = 1;
   			$status['message'] = 'Error:: plugin not found';
   			return $status;	
   		}
    		
		$item = $this->addons[$plugin];

		if($item['included']){
			$status['download'] = 1;
			$status['active'] = get_option( ROBO_GALLERY_OPTIONS.'addon_'.$plugin, 0 ) ? 1 : 0;
			return $status;
		}

		/* for not included */
		if( isset($item['slug']) && isset($item['file']) ){

			$plugin_dir = ABSPATH . 'wp-content/plugins/'.$item['slug'].'/';
			$plugin_file = ABSPATH . 'wp-content/plugins/'.$item['file'];

			if ( is_dir($plugin_dir) && file_exists($plugin_file) ){

    			$status['download'] = 1;

    			if( is_plugin_active( $item['file'] ) )  $status['active'] = 1;
    		}

		} else {
			$status['message'] = 'Error:: plugin file is empty';
			$status['error'] = 1;
		}

   		return $status;
   	}

    function getPluginStatus(  ){
    	$plugin =  sanitize_text_field( $_POST['plugin'] );

    	$status = $this->checkPluginStatus($plugin);

		echo json_encode($status);
		exit;
	}


    protected function checkPermission(){
       if (!current_user_can('activate_plugins')) {
            header('HTTP/1.0 403 Forbidden');
            echo __("You don't have permission for activate plugin");
            die();
        }
    }

	
}
