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

$shortcode_group = new_cmb2_box( array(
    'id'            => ROBO_GALLERY_PREFIX.'shortcode_metabox',
    'title'         => __('Gallery Shortcode','robo-gallery'),
    'object_types'  => array( ROBO_GALLERY_TYPE_POST ),
    'context'       => 'side',
    'priority'      => 'low',
));

if(isset($_GET['post'])){
	$shortcode_group->add_field( array(
	    'id'            => ROBO_GALLERY_PREFIX.'short_desc',
	    'type'          => 'title',
	    'before_row'    => '<div class="rbs_shortcode">[robo-gallery id="'.(int) $_GET['post'].'"]</div>',
	    'after_row'     => '<div class="desc">'.__('use this shortcode to insert this gallery into page, post or widget','robo-gallery')."</div>",
	));
}