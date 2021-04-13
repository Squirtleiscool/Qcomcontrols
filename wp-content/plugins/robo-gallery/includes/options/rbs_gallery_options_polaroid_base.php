<?php

if ( ! defined( 'WPINC' ) ) exit;

$polaroid_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'polaroid_metabox',
    'title' 		=> __( 'Polaroid Style Options', 'robo-gallery' ),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
));

$polaroid_group->add_field( array(
	 'id'            => ROBO_GALLERY_PREFIX.'polaroidUpdate',
    'type'          => 'title',
    'before_row'    => 
    '<div class="roboGalleryFields">
    	<div class="row">
	    	<div class="content small-12 columns text-center" style="margin: 20px 0 0;"> '.
				rbsGalleryUtils::getProButton( '+ '.__('Additional Functionality available in Pro version', 'robo-gallery') ).'
			</div>
		</div>
    </div>',    
));

$polaroid_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'polaroidOn',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(0),
));

$polaroid_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'polaroidSource',
	'type' 			=> 	'hidden',	
	'default'		=> 	'desc',
));

$polaroid_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'polaroidBackground',
	'type' 			=> 	'hidden',	
	'default'		=> 	'#ffffff',
));

$polaroid_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'polaroidAlign',
	'type' 			=> 	'hidden',	
	'default'		=> 	'center',
));