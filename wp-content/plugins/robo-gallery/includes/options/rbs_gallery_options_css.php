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

$css_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'css_metabox',
    'title' 		=> __( 'Custom CSS', 'robo-gallery' ),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'show_names' 	=> false,
    'context'       => 'normal',
    'priority'      => 'low',
));

$postID = 0;
if( isset($_REQUEST['post']) && (int)$_REQUEST['post'] ) 		$postID = (int)$_REQUEST['post'];
if( isset($_REQUEST['post_ID']) && (int)$_REQUEST['post_ID'] ) 	$postID = (int)$_REQUEST['post_ID'];

if($postID){
	$css_group->add_field( array(
		'name' 			=> __('Css Style', 'robo-gallery' ),
		'id' 			=> ROBO_GALLERY_PREFIX . 'cssStyle',
		'type' 			=> 'rbstextarea',
		'default'		=> '',
		'hide_label'		=> 1,
		'bootstrap_style'=> 1,

	    'before_row' 	=> '
	    <div class="rbs_block">'
	    .'<p>'	    	
	    	.__('For example','robo-gallery').' <strong>.robogallery-gallery-'.$postID.'</strong>{ }'
	    .'</p>'
	    ,
	    'after_row'		=> '
	    	<p  class="cmb2-metabox-description">'
	    		.__('Add any custom CSS to target this specific gallery.','robo-gallery')
				.__('General custom CSS possible to define in ','robo-gallery')
				.'<a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=assets" target="_blank">'.__('gallery general settings', 'robo-gallery').'</a>'
			.'</p>
		</div>',
	));
} else {
	$css_group->add_field( array(
	    'id'            => ROBO_GALLERY_PREFIX.'css_desc',
	    'type'          => 'title',
	    'before_row'     => '<div style="display:none;">',
	    'after_row'     => '</div>
	    					<div class="desc">
	    						<label>'
	    							.__('Please save gallery first, to apply custom CSS','robo-gallery')
	    						."</label>
	    					</div>",
	));

	$css_group->add_field( array(
	    'id'            => ROBO_GALLERY_PREFIX.'cssStyle',
	    'type'          => 'hidden'	    
	));
}