<?php

if ( ! defined( 'WPINC' ) ) exit;

$button_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'button_metabox',
    'title' 		=> __( 'Menu Options', 'robo-gallery' ),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
));


$button_group->add_field( array(
	 'id'            => ROBO_GALLERY_PREFIX.'menuUpdate',
    'type'          => 'title',    
    'before_row'    => 
    '<div class="roboGalleryFields">
    	<div class="row">
    		<div class="content small-12 columns text-center" style="margin: 14px 0 -7px;"> '.
				rbsGalleryUtils::getProButton( '+ '.__('Additional Functionality available in Pro version', 'robo-gallery') ).'
			</div>
		</div>
    </div>',    
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuSelfImages',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuSelfImages',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menu',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuTag',
	'type' 			=> 	'hidden',	
	'default'		=> 	'offText',	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuTagSort',
	'type' 			=> 	'hidden',	
	'default'		=> 	'',	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuRoot',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),	
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuRootLabel',
	'type' 			=> 	'hidden',	
	'default'		=> 	__('All', 'robo-gallery' ),
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'menuSelf',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'buttonFill',
	'type' 			=> 	'hidden',	
	'default'		=> 	'flat',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'buttonColor',
	'type' 			=> 	'hidden',	
	'default'		=> 	'blue',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'buttonType',
	'type' 			=> 	'hidden',	
	'default'		=> 	'normal',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'buttonSize',
	'type' 			=> 	'hidden',	
	'default'		=> 	'large',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'buttonAlign',
	'type' 			=> 	'hidden',	
	'default'		=> 	'left',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'paddingLeft',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(5),
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'paddingBottom',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(10),
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'searchEnable',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(0),
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'searchColor',
	'type' 			=> 	'hidden',	
	'default'		=> 	'rgba(0, 0, 0)',
));

$button_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'searchLabel',
	'type' 			=> 	'hidden',	
	'default'		=> 	__('search', 'robo-gallery' ),
));
