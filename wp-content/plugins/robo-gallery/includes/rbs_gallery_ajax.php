<?php
/*
*      Robo Gallery     
*      Version: 2.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2017
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if ( ! defined( 'WPINC' ) ) exit;


if(!function_exists('rbs_gallery_ajax_init')){
	function rbs_gallery_ajax_init(){
		function rbs_gallery_ajax_callback(){

			if( !isset($_POST['function']) || !$_POST['function'] ) return ;
			$functionName = $_POST['function'];
			if ( preg_match("[^a-z_]", $functionName) ) return ;
			$functionName = 'rbs_ajax_'.$functionName;
			switch ($functionName) {
				case 'rbs_ajax_create_article_form': 	rbs_ajax_create_article_form(); break;
				case 'rbs_ajax_create_article': 		rbs_ajax_create_article(); 		break;
				case 'rbs_ajax_posts_list': 			rbs_ajax_posts_list(); 			break;
				case 'rbs_ajax_reset_views': 			rbs_ajax_reset_views(); 		break;
				default:	return ;													break;
			}
			wp_die();
		}
		add_action( 'wp_ajax_rbs_gallery', 'rbs_gallery_ajax_callback' );
	}
	add_action( 'admin_init', 'rbs_gallery_ajax_init' );
}