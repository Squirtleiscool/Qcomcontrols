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

if(!function_exists('robo_gallery_fix_menu')){
	function robo_gallery_fix_menu(){
		if( 
			isset($_GET['post_type']) && $_GET['post_type']=='robo_gallery_table' &&
			isset($_GET['page']) && $_GET['page']=='robo-gallery-support' 
		) wp_redirect( "https://robosoft.co/go.php?product=gallery&task=support".(ROBO_GALLERY_TYR?'&pro=1':'') );

		if( 
			isset($_GET['post_type']) && $_GET['post_type']=='robo_gallery_table' &&
			isset($_GET['page']) && $_GET['page']=='robo-gallery-gopro' 
		) wp_redirect( "https://robosoft.co/go.php?product=gallery&task=gopro" );

		if( 
			isset($_GET['post_type']) && $_GET['post_type']=='robo_gallery_table' &&
			isset($_GET['page']) && $_GET['page']=='robo-gallery-demo' 
		) wp_redirect( "https://robosoft.co/go.php?product=gallery&task=demo" );

		if( 
			isset($_GET['post_type']) && $_GET['post_type']=='robo_gallery_table' &&
			isset($_GET['page']) && $_GET['page']=='robo-gallery-guides' 
		) wp_redirect( "https://robosoft.co/go.php?product=gallery&task=guides" );
	}
	add_action( 'init', 'robo_gallery_fix_menu' );
}

if(!function_exists('robo_gallery_gopro_submenu_page') && ROBO_GALLERY_TYR==0 ){
	add_action('admin_menu', 'robo_gallery_gopro_submenu_page');
	function robo_gallery_gopro_submenu_page() {
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Pro Version', 'Pro Version', 'manage_options', 'robo-gallery-gopro', 'robo_gallery_gopro_submenu_page_render');
	} 
	function robo_gallery_gopro_submenu_page_render(){
		echo '<script> window.open("https://robosoft.co/go.php?product=gallery&task=gopro", "_bank"); window.open("edit.php?post_type=robo_gallery_table", "_self"); </script>'; 
	}
}

if(!function_exists('robo_gallery_support_submenu_page')){
	add_action('admin_menu', 'robo_gallery_support_submenu_page');
	function robo_gallery_support_submenu_page() {
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Robo Gallery Support', 'Support', 'manage_options', 'robo-gallery-support', 'robo_gallery_support_submenu_page_render');
	}
	function robo_gallery_support_submenu_page_render(){
		echo '<script> window.open("https://robosoft.co/go.php?product=gallery&task=support'.(ROBO_GALLERY_TYR?'&pro=1':'').'", "_bank"); window.open("edit.php?post_type=robo_gallery_table", "_self"); </script>'; 
	}
}

if(!function_exists('robo_gallery_submenu_empty')){ function robo_gallery_submenu_empty(){} }

if(!function_exists('robo_gallery_demo_submenu_page')){
	add_action('admin_menu', 'robo_gallery_demo_submenu_page');
	function robo_gallery_demo_submenu_page() {
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Robo Gallery Demo', 'Gallery Demo', 'manage_options', 'robo-gallery-demo', 'robo_gallery_submenu_empty' );
	}
}

if(!function_exists('robo_gallery_guides_submenu_page')){
	add_action('admin_menu', 'robo_gallery_guides_submenu_page');
	function robo_gallery_guides_submenu_page() {
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Robo Gallery Video Guides', 'Video Guides', 'manage_options', 'robo-gallery-guides', 'robo_gallery_submenu_empty' );
	}
}

if(!function_exists('rbs_gallery_menuConfig')){
	function rbs_gallery_menuConfig(){
		wp_enqueue_script('robo-gallery-menu', ROBO_GALLERY_URL.'js/admin/menu.js', array( 'jquery' ), ROBO_GALLERY_VERSION, true ); 

		wp_localize_script('robo-gallery-menu', 'robo_gallery_vars', array(
			'pro'		=> ROBO_GALLERY_TYR,
		));

		wp_enqueue_style ('robo-gallery-menu', ROBO_GALLERY_URL.'css/admin/menu.css', array( ), ROBO_GALLERY_VERSION );
		
		$inlineCSS = ' 
			#adminmenu li.menu-icon-robo_gallery_table img,
	        #adminmenu li[class*=menu-icon-robo_gallery_table] img,
			#adminmenu li[class*=menu-icon-robo_gallery_table] img {
			    opacity: 1;
			    max-width: 25px;
			    padding-top: 5px;
			}
			'. ( ROBO_GALLERY_TYR==0  ? '
			#menu-posts-robo_gallery_table ul.wp-submenu li:nth-child(5) a,
			#adminmenu li.menu-icon-robo_gallery_table ul li:nth-child(5) a{
				font-weight: bold;
				color: #3adb76;
			}' : '' )
		;

		wp_add_inline_style('robo-gallery-menu', $inlineCSS );
		
	}
	add_action( 'in_admin_header', 'rbs_gallery_menuConfig' );
}

