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

class roboGalleryFields{

	protected static $instance;

	protected $config;

	protected function __construct(){
		$this->config = new roboGalleryFieldsConfig();
	}

	public static function getInstance(){
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init(){
		add_action('init', 					array($this, 'addMetaBoxes'));
		add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
		add_filter('admin_body_class', 		array($this, 'adminBodyClass'));
	}

	public function addMetaBoxes(){
		foreach ((array)$this->config->get('metabox') as $name => $metaBoxConfig) {
			new roboGalleryFieldsMetaBoxClass($metaBoxConfig);
		}
	}

	public function enqueueScripts(){

		$screen = get_current_screen();
		if ('post' !== $screen->base) {
			return;
		}
		
		/* CSS */
		wp_enqueue_style( ROBO_GALLERY_ASSETS_PREFIX.'app-style', 			ROBO_GALLERY_FIELDS_URL . 'asset/core/css/app-style.css', array(), 1);
		
		wp_enqueue_style( ROBO_GALLERY_ASSETS_PREFIX.'app-update-key', 		ROBO_GALLERY_FIELDS_URL . 'asset/fields/css/update.key.css', array(), 1);
		
		wp_enqueue_style( ROBO_GALLERY_ASSETS_PREFIX.'color-pick', 	ROBO_GALLERY_FIELDS_URL . 'asset/vanilla-picker-master/src/picker.css', array(), 1);

		wp_enqueue_style( ROBO_GALLERY_ASSETS_PREFIX.'help', 			ROBO_GALLERY_FIELDS_URL . 'asset/help/help.css', array(), 1);
		
		/* JS */
		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'foundation', 	ROBO_GALLERY_FIELDS_URL . 'asset/foundation/foundation.min.js', array('jquery'), false, true);		

		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'tinycolor', 	ROBO_GALLERY_FIELDS_URL . 'asset/tinycolor/dist/tinycolor-min.js', array(), false, false);
		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'color-pick', 	ROBO_GALLERY_FIELDS_URL . 'asset/vanilla-picker-master/dist/vanilla-picker.min.js', array( ROBO_GALLERY_ASSETS_PREFIX.'tinycolor' ), false, false);
		
		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'app', 			ROBO_GALLERY_FIELDS_URL . 'asset/core/js/app.js', array(ROBO_GALLERY_ASSETS_PREFIX.'foundation'), false, true);
		
		/*wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		
		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'help', 			ROBO_GALLERY_FIELDS_URL . 'asset/help/help.js', array('jquery', 'jquery-ui-dialog'), false, true);
		$translation_array = array(
		    'close' => __( 'Close', 'robo-gallery' ),
		    'title' => __( 'Robo Gallery :: Help', 'robo-gallery' ),
		);
		wp_localize_script( ROBO_GALLERY_ASSETS_PREFIX.'help', ROBO_GALLERY_PREFIX.'fields_help_i18', $translation_array );
*/
		//fields

		// youtube
		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'-field-type-youtube', ROBO_GALLERY_FIELDS_URL.'asset/fields/youtube/script.js', array(), ROBO_GALLERY_VERSION, false);
		wp_enqueue_style ( ROBO_GALLERY_ASSETS_PREFIX.'-field-type-youtube', ROBO_GALLERY_FIELDS_URL.'asset/fields/youtube/style.css', array( ), '' );

	}


	public function adminBodyClass($classes){
		return $classes . ' ' . ROBO_GALLERY_FIELDS_BODY_CLASS;
	}

	public function getConfig(){
		return $this->config;
	}
}
