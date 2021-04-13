<?php

if ( ! class_exists( 'RoboGallery_Blocks' ) ) {

	class RoboGallery_Blocks {

		public $prefix = 'block-robo-gallery-';

		function __construct() {
			add_action( 'enqueue_block_assets', array( $this, 'block_assets') );

			add_action( 'enqueue_block_editor_assets', array( $this, 'editor_assets') );

			add_action( 'init', array( $this, 'php_block_init' ) );

			add_action( 'wp_ajax_robo_gallery_get_gallery_json', array($this, 'ajaxGetGalleryJson') );
		}

		function block_assets(){ 
			wp_enqueue_style(
				$this->prefix.'style-css', 
				plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), 
				array( 'wp-editor' ),
				ROBO_GALLERY_VERSION		
			);
		}

		function editor_assets(){ 

			wp_enqueue_script(
				$this->prefix.'block-js',
				plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
				array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
				ROBO_GALLERY_VERSION,
				true // Enqueue the script in the footer.
			);

			wp_enqueue_style(
				$this->prefix.'block-editor-css',
				plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), 
				array( 'wp-edit-blocks' ),
				ROBO_GALLERY_VERSION
			);
		}

		function php_block_init(){

			if ( !function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type( 'robo/block-robo-gallery', array(
			    'render_callback' => array( $this, 'renderBlock'),
			    'attributes'	  => array(
					'galleryid'	 => array(
						'type'		=> 'number',
						'default' 	=> 0,
					),
					'assetsincludeforced' => array(
						'type' 		=> 'boolean',
						'default' 	=> false
					),
				),
			) );

		}

		function isCorrectAttributes( $attributes ){
			return is_array($attributes) &&  isset($attributes['galleryid']) && $attributes['galleryid']>0;
		}

		function getAttributes( $attributes ){
			$attr = array('id'=>$attributes['galleryid']);
			//$attr['assetsIncludeForced'] = true;
			return $attr;
		}

		function renderBlock( $attributes ) {
	
			if( !$this->isCorrectAttributes( $attributes ) ){
				return sprintf( 
					'<div><strong>%s</strong>: %s</div>', 
					'Robo Gallery', 
					__("You didn't select any Robo Gallery item in editor. Please select one from the list or create new gallery",'robo-gallery')
				) ;
			}
			
			if( !class_exists('roboGallery') ) return 'Robo Gallery:: Error 999';
				
			$gallery = new roboGallery( $this->getAttributes( $attributes ) );
			return $gallery->getGallery();
    
		}

		function ajaxGetGalleryJson() { 

			$query = new WP_Query( 
				array( 
					'post_type' => ROBO_GALLERY_TYPE_POST,
					'post_status' => array( 'publish', 'private', 'future' ),
					'nopaging' =>  true
				)
			);

			$posts = $query->posts;

			$returnJson = array();

			if( is_array($posts) && count($posts)){
				foreach($posts as $post) {
					$returnJson[] = array(
						'id' => $post->ID,
						'title' => esc_js($post->post_title),
						'parent' => $post->post_parent,
					);
				}
			}
			wp_send_json( $returnJson );
			wp_die();
		}
	}
}

new RoboGallery_Blocks();



/*add_filter( 'block_categories', 'block_robo_gallery_add_category', 10, 2 );

function block_robo_gallery_add_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'robo-blocks',
				'title' => __( 'Robo Gallery Blocks', 'robo-gallery' ),
				'icon'  => 'wordpress',
			),
		)
	);
}*/