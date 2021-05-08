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


include_once ROBO_GALLERY_APP_EXTENSIONS_PATH.'galleryType/initThemeOptions.php';

class roboGalleryClass_Type extends roboGalleryClass{
	
	public $bodyClass = null;

	public $defaultTheme = 0;

	private $moduleUrl = '';
	private $modulePath = '';

	private $gallertTypeField = '';

	public function __construct(){		


		$this->bodyClass = ROBO_GALLERY_NAMESPACE.'theme_listing';

		$this->gallertTypeField = ROBO_GALLERY_PREFIX.'gallery_type';
		
		if( !defined('ROBO_GALLERY_TYPE_GRID') ) define('ROBO_GALLERY_TYPE_GRID', 'grid');		
		

		$this->moduleUrl = plugin_dir_url( __FILE__ );
		$this->modulePath =  plugin_dir_path( __FILE__ );

		parent::__construct();		
	}

	public function getModuleFileName(){
		return __FILE__;
	}

	public function load(){
		
		//include_once 'test.php';
	}

	public function hooks(){
		$this->admin_hooks();
		$this->gallery_hooks();
		$this->gallery_list_hooks();			
	}

	public function admin_hooks(){
		if ( is_admin() !== true ) return ;
		
		/* type dialog */
		add_action( 'in_admin_header', 	array( $this, 'assets_files_dialog') );
		add_action( 'in_admin_header', 	array($this, 'initDialogHtml') );

		add_action( 'admin_menu', 		array( $this, 'menu_fix_url' ) );
		add_action( 'admin_bar_menu', 	array( $this, 'menutop_fix_url') , 999  );
	}	

	public function gallery_hooks(){

		if ( 
				is_admin() !== true || 
				rbs_gallery_get_current_post_type() != ROBO_GALLERY_TYPE_POST  ||
				( isset($_GET['page']) && $_GET['page']=='robo-gallery-stats' )
		) return ;

		add_filter(	'admin_body_class', 		array($this, 'addBodyClass'));
		add_filter( 'post_updated_messages', 	array( $this, 'gallery_updated_messages') );
	}


	public function gallery_list_hooks(){		
		if(  !rbs_gallery_is_edit_page('list')  || !rbs_gallery_get_current_post_type() == ROBO_GALLERY_TYPE_POST ) return ;

		add_filter( 'manage_'.ROBO_GALLERY_TYPE_POST.'_posts_columns' , 		array( $this, 'addColumnsToThemesListing') );
		add_action( 'manage_'.ROBO_GALLERY_TYPE_POST.'_posts_custom_column' , 	array( $this, 'renderColumnsToThemesListing'), 10, 2 );
		add_filter( 'manage_posts_columns', 									array( $this, 'columns_reorder'));
		add_action( 'in_admin_header', 											array( $this, 'assets_files') );
	}


	/* fix menu item in left menu*/
	public function menu_fix_url() {
    	global $menu;     
    	global $submenu;     

    	if( isset( $submenu['edit.php?post_type=robo_gallery_table'] ) ){
     		foreach ( $submenu['edit.php?post_type=robo_gallery_table'] as $key => $value) {
     			if( isset( $value[2] ) && $value[2] == 'post-new.php?post_type=robo_gallery_table' ){     			
     				$submenu['edit.php?post_type=robo_gallery_table'][$key][2] = 'post-new.php?post_type=robo_gallery_table'.'&showDialog=1';     			
     			}
     		}     	
     	}
	}


	/* fix menu item in top menu*/
	function menutop_fix_url( $wp_admin_bar ){  	
	 	//$wp_admin_bar->remove_node( 'new-robo_gallery_table' );	
		$wp_admin_bar->add_node( array(
	        'parent' => 'new-content',
	        'id'     => 'new-robo_gallery_table',
	        'title'  => __('Robo Gallery', 'robo-gallery'),
	        'href'   => esc_url( admin_url( 'post-new.php?post_type=robo_gallery_table&showDialog=1' ) ),
	        'meta'   => array(
	        	'onclick' => 'window.showRoboDialog(); return false'
	        )
	    ));
	 }  


	function addBodyClass($classes){
		return $classes . ' ' . $this->bodyClass;
	}


	function gallery_updated_messages( $messages ) {

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages[ROBO_GALLERY_TYPE_POST] = array(
		    0  => '', // Unused. Messages start at index 1.

		    1  => __( 'Robo Gallery updated.', 'robo-gallery' ),
		    2  => __( 'Custom field updated.', 'robo-gallery' ),
		    3  => __( 'Custom field deleted.', 'robo-gallery' ),
		    4  => __( 'Robo Gallery updated.', 'robo-gallery' ),
		    
		    /* translators: %s: date and time of the revision */
		    5  => isset( $_GET['revision'] ) ? sprintf( __( 'Robo Gallery restored to revision from %s', 'robo-gallery' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		    
		    6  => __( 'Robo Gallery published.', 'robo-gallery' ),
		    7  => __( 'Robo Gallery saved.', 'robo-gallery' ),
		    8  => __( 'Robo Gallery submitted.', 'robo-gallery' ),
		    9  => sprintf(
		        	__( 'Robo Gallery scheduled for: <strong>%1$s</strong>.', 'robo-gallery' ),
		        	date_i18n( __( 'M j, Y @ G:i' ), 
		        	strtotime( $post->post_date ) 
		        )
		    ),
		    10 => __( 'Robo Gallery draft updated.', 'robo-gallery' )
		);

		return $messages;
	}


	function addColumnsToThemesListing($columns) { 
		return array_merge($columns, 
			array( 				
				'RoboGalleryThemeColumnType' => __('Type', 'robo-gallery'),
			)
		); 
	}


	function renderColumnsToThemesListing( $column, $post_id ) {
	    
	    switch ( $column ) {
			case 'RoboGalleryThemeColumnType':
				$this->printGalleryType( $post_id );
			break;
		}
	}


	private function printGalleryType( $post_id ){
		$post_id = (int) $post_id;
		if( $post_id==false ) return ;		
		$typeGallery = get_post_meta( $post_id, $this->gallertTypeField , true );

		if( !$typeGallery || $typeGallery=='grid' ) $typeGallery = 'Grid';
		if( $typeGallery=='gridpro' ) $typeGallery = 'Grid Pro';

		if( $typeGallery=='wallstylepro' ) $typeGallery = 'Wallstyle Pro';

		if( $typeGallery=='masonry' ) $typeGallery = 'Masonry';
		if( $typeGallery=='masonrypro' ) $typeGallery = 'Masonry Pro';

		if( $typeGallery=='mosaic' ) $typeGallery = 'Mosaic';
		if( $typeGallery=='mosaicpro' ) $typeGallery = 'Mosaic Pro';

		if( $typeGallery=='masonry' ) $typeGallery = 'Masonry';
		if( $typeGallery=='masonrypro' ) $typeGallery = 'Masonry Pro';

		if( $typeGallery=='youtube' ) $typeGallery = 'Youtube';
		if( $typeGallery=='youtubepro' ) $typeGallery = 'Youtube Pro';

		if( $typeGallery=='polaroid' ) $typeGallery = 'Polaroid';
		if( $typeGallery=='polaroidpro' ) $typeGallery = 'Polaroid Pro';

		printf(
			'<strong>%s</strong>',
			ucfirst( $typeGallery )
		);
	}

	function columns_reorder($columns) {
		$all_columns = array();
		$type_column = 'RoboGalleryThemeColumnType'; 
		foreach($columns as $key => $value) {
			//echo $value;
			$all_columns[$key] = $value;
			if( $key == 'title' ){
				
				if( isset($columns[$type_column]) ) $all_columns[$type_column] = $columns[$type_column];
					else $all_columns[$type_column] = '';
				//print_r($all_columns);
			}
		}
		return $all_columns;
	}


	function assets_files(){
		//wp_enqueue_style (ROBO_GALLERY_ASSETS_PREFIX.'themes-listing', $this->moduleUrl.'css/themes.listing.css', array( ), ROBO_GALLERY_VERSION );
		//wp_enqueue_script (ROBO_GALLERY_ASSETS_PREFIX.'themes-listing', $this->moduleUrl.'js/themes.listing.js', array('jquery'), ROBO_GALLERY_VERSION );
	}

	function assets_files_dialog(){					

		wp_register_script( ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2-cfg', $this->moduleUrl.'build/j.js', array(  ), ROBO_GALLERY_VERSION, true ); 

		wp_localize_script( ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2-cfg', 'robo_js_config', array(
				'imagesUrl' 	=> $this->moduleUrl . 'build/',
				'createUrl' 	=> admin_url('post-new.php?post_type='.ROBO_GALLERY_TYPE_POST.'&'.$this->gallertTypeField.'='),
				'premiumVersion'=> ROBO_GALLERY_TYR,
				'showDialog' 	=> isset($_GET['showDialog']) && $_GET['showDialog'] ? 1 : 0
		));     
		wp_enqueue_script( 	ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2-cfg' );

		wp_add_inline_script( ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2-cfg', 	$this->getDialogScript() );

		wp_enqueue_script( ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2', $this->moduleUrl.'build/static/js/bundle.min.js', array( ), ROBO_GALLERY_VERSION, true );

		wp_enqueue_style ( ROBO_GALLERY_ASSETS_PREFIX.'admin-dialog-v2', $this->moduleUrl.'build/static/css/main.min.css', array( ), ROBO_GALLERY_VERSION );
	}


	public function getDialogScript(){		
		$script = '; const RoboGalleryTypeBodyClass = "'.$this->bodyClass.'"; ';
		$script .= file_get_contents( $this->modulePath.'js/themes.select.js' );
		return $script;
	}

	public static function initDialogHtml(){
		echo '<div id="rootRoboTypeDialog"></div>';
	}

}

$themeClass = new roboGalleryClass_Type();



  


/*

add_filter('views_edit-robo_gallery_table','my_filter');

function my_filter($views){
	echo "ffffffffffffffffffff";
    $views['import'] = '<a href="#" class="primary">Import</a>';
    print_r($views);
    return $views;
}

add_action( 'edit_form_top', 'top_form_edit' );

function top_form_edit( $post ) {
    //if( 'portfolio' == $post->post_type )
        echo "<a href='#' id='my-custom-header-link'>$post->post_type</a>";
}*/