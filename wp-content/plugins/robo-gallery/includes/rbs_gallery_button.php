<?php 
/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if ( ! defined( 'WPINC' ) ) exit;

function add_robo_gallery_button(){
	global $pagenow;
	if( isset( $pagenow) &&  $pagenow=='admin-ajax.php' ) return ;

	wp_enqueue_style("wp-jquery-ui-dialog");
	wp_enqueue_script('jquery-ui-dialog');
  
  	wp_enqueue_script('rbs-robo-gallery-button', ROBO_GALLERY_URL.'js/admin/editor-button.js', array( 'jquery' ), '1.0.0', true );    
  	
  	$translation_array = array( 
		'roboGalleryTitle' 	=> __('Robo Gallery','robo-gallery'),
		'closeButton'		=> __('Close','robo-gallery'),
		'insertButton'		=> __('Insert','robo-gallery'),
	);

	wp_localize_script( 'rbs-robo-gallery-button', 'robo_gallery_trans', $translation_array );
	wp_enqueue_script( 'rbs-robo-gallery-button' );

  	echo '<a href="#robo-gallery" id="insert-robo-gallery" class="button"><span class="dashicons dashicons-format-gallery" style="margin: 4px 5px 0 0;"></span>'.__( 'Add Robo Gallery' , 'robo-gallery' ).'</a>';
	
	$args = array(
	    'child_of'     => 0,
	    'sort_order'   => 'ASC',
	    'sort_column'  => 'post_title',
	    'hierarchical' => 1,
	    'echo'		=> 0,
	    'post_type' => 'robo_gallery_table'
	);
  	echo '<div id="robo-gallery" style="display: none;">'
  			.__('Select gallery', 'robo-gallery').' '.wp_dropdown_pages( $args )
  			.'<p style="margin-bottom:0px;">'.__( 'Configure it in','robo-gallery').' <a href="edit.php?post_type=robo_gallery_table" target="_blank">'.__( 'Robo Gallery plugin','robo-gallery').'</a></p>'
  		.'</div>';
}
add_action('media_buttons', 'add_robo_gallery_button', 15);
