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



define( "ROBO_GALLERY_ICON_PRO",  '<button type="button"  class="btn btn-danger btn-xs rbs-label-pro">Pro</button>');
define( "ROBO_GALLERY_LABEL_PRO", '<span>'.__( 'Available in', 'robo-gallery' ).'</span> '.ROBO_GALLERY_ICON_PRO);

define( "ROBO_GALLERY_ICON_UPDATE_PRO",  '<button type="button"  class="btn btn-success btn-xs rbs-label-pro">Pro</button>');
define( "ROBO_GALLERY_LABEL_UPDATE_PRO", '<span>'.__( 'Please update ', 'robo-gallery' ).'</span> '.ROBO_GALLERY_ICON_UPDATE_PRO.'<span>'.__( ' key', 'robo-gallery' ).'</span> ');


if( is_admin() ){
	$photonic_options = get_option( 'photonic_options', array() );
	if( !isset($photonic_options['disable_editor']) || $photonic_options['disable_editor']!='on' ){
		$photonic_options['disable_editor'] = 'on';
		delete_option("photonic_options");
		add_option( 'photonic_options', $photonic_options );
	}
	
	add_action( 'plugins_loaded', 'rbs_hide_messages' );
	function rbs_hide_messages(){
		$titleMes = 'ban';
		remove_action( 'init', 'gallery_'.$titleMes.'k_admin_notice_class'  );
	}
}

rbs_gallery_include( array( 'rbs_gallery_config.php', 'rbs_gallery_button.php', 'rbs_gallery_widget.php'), ROBO_GALLERY_INCLUDES_PATH );

if(!function_exists('rbs_gallery_is_edit_page')){

    function rbs_gallery_is_edit_page($new_edit = null){
        global $pagenow;

        if( !is_admin() ) return false;
        if( defined('DOING_AJAX') && DOING_AJAX ) return false;

        if($new_edit == "list")             return in_array( $pagenow, array( 'edit.php',  ) );
            elseif($new_edit == "edit")     return in_array( $pagenow, array( 'post.php' ) );
                elseif($new_edit == "new")  return in_array( $pagenow, array( 'post-new.php' ) );
                    else  	return in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ) );
    }
}

if(!function_exists('rbs_gallery_get_current_post_type')){
    function rbs_gallery_get_current_post_type() {
        global $post, $typenow, $current_screen;
        if ( $post && $post->post_type )                          return $post->post_type;
          elseif( $typenow )                                      return $typenow;
          elseif( $current_screen && $current_screen->post_type ) return $current_screen->post_type;
          elseif( isset( $_REQUEST['post_type'] ) && !is_array($_REQUEST['post_type']) )  return sanitize_key( $_REQUEST['post_type'] );
          elseif (isset( $_REQUEST['post'] ) && get_post_type($_REQUEST['post']))         return get_post_type($_REQUEST['post']);
        return null;
    }
}

function create_post_type_robo_gallery() { 

	require_once ROBO_GALLERY_INCLUDES_PATH.'rbs_class_update.php';


  	$label = array(
            'name' => 'Robo Gallery',
            'singular_name' => __( 'Robo Gallery', 	 		'robo-gallery' ),
            'all_items'     => __( 'Manage Galleries', 		'robo-gallery' ),
            'add_new'       => __( 'Add Gallery / Images', 	'robo-gallery' ),
            'add_new_item'  => __( 'Add Gallery', 			'robo-gallery' ),
            'edit_item'     => __( 'Edit Gallery', 			'robo-gallery' ),

            'add_new_item'  	=> __( 'Add New Robo Gallery', 			'robo-gallery' ),
            'view_item'			=> __( 'View Robo Gallery', 			'robo-gallery' ),
            
    		'search_items'      => __( 'Search Robo Galleries', 		'robo-gallery' ),
    		'parent_item_colon' => __( 'Parent Robo Galleries:', 		'robo-gallery' ),
    		'not_found'         => __( 'No galleries found.', 			'robo-gallery' ),
    		'not_found_in_trash'=> __( 'No galleries found in Trash.', 	'robo-gallery' ),

    		'menu_name'          => _x( 'Robo Gallery', 'admin menu', 			'robo-gallery' ),
    		'name_admin_bar'     => _x( 'Robo Gallery', 'add new on admin bar', 'robo-gallery' ),

    );


    $supportArray = array( 'title', 'comments', 'author' ); //, 'thumbnail'
	if( get_option(ROBO_GALLERY_PREFIX.'categoryShow', 0) ){
		$supportArray[] = 'page-attributes';
	}	


    $args = array(
          'labels' =>  $label,

          'description'        => __( 'Description. text la la ', 'robo-gallery' ),

          'rewrite'         => array( 'slug' => 'gallery', 'with_front' => true ),
          'public'      	=> true,
          'has_archive'   	=> false,
          'hierarchical'  	=> true,
          'supports'    	=> $supportArray,
          'menu_icon'     	=> path_join( ROBO_GALLERY_URL, 'images/admin/robo_gallery_icon_32.png'), //'dashicons-format-gallery',

          'show_in_menu'	=> true,
          'menu_position'	=> 10,

          'show_in_rest'       => true,
    	'rest_base'          => 'robogallery',

    /*'publicly_queryable' => true,
    'show_ui'            => true,
    
    'query_var'          => true,    
    'capability_type'    => 'post',
      
    
    'rest_controller_class' => 'WP_REST_Posts_Controller',*/
    );
    

    register_post_type( ROBO_GALLERY_TYPE_POST, $args);

    if ( 
    	is_admin() && 
    	get_option( 'robo_gallery_after_install', 0 ) == '1'
    ) {

    	add_action( 'wp_loaded', 'roboGalleryInstallRefresh' );
    }
}
add_action( 'init', 'create_post_type_robo_gallery' );

if(!function_exists('roboGalleryInstallRefresh')){
	function roboGalleryInstallRefresh(){
		
		global $wp_rewrite;
		$wp_rewrite->flush_rules();

		if( delete_option( 'robo_gallery_after_install' ) ){
			update_option( 'robo_gallery_redirect_overview', true );	
		}

	}
}

if(!function_exists('roboGalleryRedirectOverview')){
	function roboGalleryRedirectOverview(){
		if( get_option( 'robo_gallery_redirect_overview', false ) ){
			delete_option( 'robo_gallery_redirect_overview' );
	 		wp_redirect( admin_url('edit.php?post_type='.ROBO_GALLERY_TYPE_POST.'&page=overview&firstview=1') );
	 		exit();	
		}		
	}
}
add_action( 'admin_init', 'roboGalleryRedirectOverview' );


rbs_gallery_include('cache.php', ROBO_GALLERY_INCLUDES_PATH);

if(!function_exists('rbs_gallery_main_init')){
    function rbs_gallery_main_init() {

		if( 
			rbs_gallery_get_current_post_type() == ROBO_GALLERY_TYPE_POST && 
			( rbs_gallery_is_edit_page('new') || rbs_gallery_is_edit_page('edit') ) &&
			rbsGalleryUtils::getTypeGallery() != 'slider'
		){

		    // Adding the Metabox class
		    rbs_gallery_include('init.php', ROBO_GALLERY_CMB_PATH);

		     /* Field */
		    rbs_gallery_include( array( 	
		    	'toolbox/cmb-field-toolbox.php',
		    	'gallery/cmb-field-gallery.php', 
				'size/cmb-field-size.php',
				'loading/cmb-field-loading.php',
				'color/jw-cmb2-rgba-colorpicker.php',
				'border/cmb-field-border.php',
				'shadow/cmb-field-shadow.php',
				'switch/cmb-field-switch.php',
				'rbsselect/cmb-field-rbsselect.php',
				'slider/cmb-field-slider.php',
				'colums/cmb-field-colums.php',
				'rbstext/cmb-field-rbstext.php',
				'rbstextarea/cmb-field-rbstextarea.php',
				'font/cmb-field-font.php',
				'rbsgallery/cmb-field-rbsgallery.php',
				'multisize/rbs-multiSize.php',
				'rbsradiobutton/rbs-radiobutton.php',
				'padding/rbs-padding.php',				
				'hidden_array/init.php'

		    ), ROBO_GALLERY_CMB_FILEDS_PATH);
		   
		    rbs_gallery_include('rbs_gallery_edit.php', ROBO_GALLERY_INCLUDES_PATH);
		}

		/* only backend */
		if( is_admin() ){
			rbs_gallery_include( array(
				'rbs_gallery_media.php', 
				'rbs_gallery_menu.php', 
				'rbs_gallery_settings.php' 
			), ROBO_GALLERY_INCLUDES_PATH);
		}

		/* Frontend*/
		rbs_gallery_include(array( 'rbs_gallery_class.php', 'rbs_gallery_frontend.php' ), ROBO_GALLERY_FRONTEND_PATH);		

		/* AJAX */
		rbs_gallery_include('rbs_gallery_ajax.php', ROBO_GALLERY_INCLUDES_PATH);
		rbs_gallery_include('rbs_create_post_ajax.php', ROBO_GALLERY_EXTENSIONS_PATH);

		/*  Init function */

		/* backup init */
		if( get_option( ROBO_GALLERY_OPTIONS.'addon_backup', 0 )  ){
			rbs_gallery_include('backup/backup.init.php', 		ROBO_GALLERY_EXTENSIONS_PATH);
		}
			/* category init */
		if( 
			!get_option(ROBO_GALLERY_PREFIX.'categoryShow', 0) &&
			!( isset($_GET['page']) && $_GET['page'] != 'robo-gallery-cat' ) 
		){
			rbs_gallery_include('category/category.init.php', 	ROBO_GALLERY_EXTENSIONS_PATH);
		}

		// check for v3
		//rbs_gallery_include('categoryPage/category.init.php', 	ROBO_GALLERY_EXTENSIONS_PATH);
		

		/* stats init */
		if( get_option( ROBO_GALLERY_OPTIONS.'addon_stats', 0 )  ){
			rbs_gallery_include('stats/stats.init.php', 	ROBO_GALLERY_EXTENSIONS_PATH);
		}
	}
}

add_action( 'plugins_loaded', 'rbs_gallery_main_init' );


require_once ROBO_GALLERY_EXTENSIONS_PATH . 'block/src/init.php';
