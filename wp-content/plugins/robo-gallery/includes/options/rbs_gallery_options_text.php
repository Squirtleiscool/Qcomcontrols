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

$text_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'text_metabox',
    'title' 		=> __( 'Text Addons', 'robo-gallery' ),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'show_names' 	=> false,
    'context'       => 'side',
    'priority'      => 'low',
));

$text_group->add_field( array(
	'name' 			=> __('Pre Text', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'pretext',
	'type' 			=> 'rbstextarea',
	'default'		=> '',
	'hide_label'		=> 1,
	'bootstrap_style'=> 1,

    'before_row' 	=> '
    <div class="rbs_block"><label>'.__('Pre Text', 'robo-gallery' ).'</label>',
));

$text_group->add_field( array(
	'name' 			=> __('After Text', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'aftertext',
	'type' 			=> 'rbstextarea',
	'default'		=> '',
	'hide_label'		=> 1,
	'bootstrap_style'=> 1,

    'before_row' 	=> '
    <label>'.__('After Text', 'robo-gallery' ).'</label>',
	'after_row'		=> '
</div>',
));