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

$view_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'view_metabox',
    'title' 		=> __('Thumbs View Options', 'robo-gallery' ),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'cmb_styles' 	=> false,
    'show_names'	=> false,
    'context'		=> 'normal',
    'priority' 		=> 'high',
));

$view_group->add_field( array(
	'name' 			=> __('Radius', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'radius',
	'type' 			=> 'slider',
	'bootstrap_style'=> 1,
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(5),
	'min'			=> 0,
	'max'			=> 50,
	'addons'		=> 'px',
    'before_row' 	=> ' <br />
<div class="rbs_block">',
));

$view_group->add_field( array(    
    'default' 		=> rbs_gallery_set_checkbox_default_for_new_post(15),
    'id'	  		=> ROBO_GALLERY_PREFIX .'horizontalSpaceBetweenBoxes',
    'type'    		=> 'hidden',    
));

$view_group->add_field( array(    
    'default' 		=> rbs_gallery_set_checkbox_default_for_new_post(15),
    'id'	  		=> ROBO_GALLERY_PREFIX .'verticalSpaceBetweenBoxes',
	'type'    		=> 'hidden',
));

/* ======================= Shadow Start ================================= */   
$view_group->add_field( array(
	'name' 			=> __('Shadow', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'shadow',
	'type' 			=> 'switch',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(1),
	'depends' 		=> '.rbs_shadows_tabs',
    'bootstrap_style'=> 1,
    'before_row' 	=> '<br />',
));

$view_group->add_field( array(
	'name' 			=> __('Shadow Options', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'shadow-options',
	'type' 			=> 'shadow',
	'before_row' 	=> '
	<div class=" rbs_shadows_tabs" >
	',
	'after_row' 	=> '
	</div>

	<div class="rbs_border"></div>
	',
));

$view_group->add_field( array(    
    'default' 		=> rbs_gallery_set_checkbox_default_for_new_post(0),
    'id'	  		=> ROBO_GALLERY_PREFIX .'hover-shadow',
	'type'    		=> 'hidden',
));

$view_group->add_field( array(
	'name' 			=> 	'',
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'hover-shadow-options',
	'type' 			=> 	'hidden_array',	
	'default'		=> 	array(
			'color' => 'rgba(34, 25, 25, 0.4)', 
			'hshadow' 	=> '1',
			'vshadow' 	=> '3',
			'bshadow'	=> '3',
		),	
));



/* ======================= Border Start ================================= */

$view_group->add_field( array(
	'name' 			=> __('Border', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'border',
	'type' 			=> 'switch',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(0),
	'depends' 		=> '.rbs_border_tabs',
    'bootstrap_style'=> 1,
    'before_row' 	=> '<br/>',
));
     
$view_group->add_field( array(
	'name' 			=> __('Border Options', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'border-options',
	'type' 			=> 'border',
	'before_row' 	=> '
	<div class="rbs_border_tabs">',
	'after_row' 	=> '
	</div>

	<div class="roboGalleryFields">
    	<div class="row">
	    	<div class="content small-12 columns text-center" >'
	    	.( ROBO_GALLERY_TYR ? '' : rbsGalleryUtils::getProButton( '+ ' . __('Additional Functionality available in Pro version', 'robo-gallery') )).
			'</div>
		</div>
    </div>
	
</div> '
));


$view_group->add_field( array(    
    'default' 		=> rbs_gallery_set_checkbox_default_for_new_post(0),
    'id'	  		=> ROBO_GALLERY_PREFIX .'hover-border',
	'type'    		=> 'hidden',
));

$view_group->add_field( array(
	'name' 			=> 	'',
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'hover-border-options',
	'type' 			=> 	'hidden_array',	
	'default'		=> 	array(
		'color' => 'rgb(229, 64, 40)',
		'style' => 'solid',
		'width' => '5'
	),	
));