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
//return '';
$hover_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX . 'hover_metabox',
    'title' 		=> __( 'Hover Options', 'robo-gallery' ), 
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'show_names'	=> false,
    'context' 		=> 'normal',
));

$hover_group->add_field( array(
	'name'             => __('Clickable Thumbnails', 'robo-gallery' ),
	'id'               => ROBO_GALLERY_PREFIX . 'thumbClick',
	'type'             => 'rbsselect',
	'show_option_none' => false,
	'desc'			=> __('When you enable this mode entire thumbnail get clickable, not only hover buttons', 'robo-gallery' ),
	'default'          => rbs_gallery_set_checkbox_default_for_new_post(0),
	'options'          => array(
		'0' 	=> __( 'On' , 	'robo-gallery' ),
		'1' 	=> __( 'Off' , 	'robo-gallery' ),
	),
	'before_row'	=> '
<div class="rbs_block"> <br />',
));




$hover_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'hover',
	'type' 			=> 	'hidden',	
	'default'		=> 	rbs_gallery_set_checkbox_default_for_new_post(1),	
));


$hover_group->add_field( array(
	'name' 			=> __('No Hover for Mobile', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'noHoverOnMobile', 
	'type' 			=> 'switch', 
	'desc'			=> __('this option turn off hover effect only for mobile devices', 'robo-gallery' ),
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(0),
	'bootstrap_style'=> 1,
));

$hover_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'background',
	'type' 			=> 	'hidden',	
	'default'		=> 	'rgba(7, 7, 7, 0.5)',	
));

$hover_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'overlayEffect',
	'type' 			=> 	'hidden',	
	'default'		=> 	'direction-aware-fade',	
));
   
$hover_group->add_field( array(
	'name' 			=> __('Show Title', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'showTitle',
	'type' 			=> 'font',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(1),
	'bootstrap_style'=> 1,
    'default'		=> array(
    	'enabled'	=> rbs_gallery_set_checkbox_default_for_new_post(1),
    	'color'		=> 'rgb(255, 255, 255)',
    	'colorHover'=> 'rgb(255, 255, 255)',
    	'fontBold'  => 'bold',
    	'fontSize'  => '12',
    ),
    'before_row'=> 	'
    	<div class="rbs_gallery_hover_options_blok">
		    <div role="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#hover_text" aria-controls="hover_text" role="tab" data-toggle="tab">'.__('Title', 'robo-gallery' ).'</a></li>
					<li role="presentation"><a href="#hover_linkicon" aria-controls="hover_linkicon" role="tab" data-toggle="tab">'.__('Link Button', 'robo-gallery' ).'</a></li>
					<li role="presentation"><a href="#hover_zoomicon" aria-controls="hover_zoomicon" role="tab" data-toggle="tab">'.__('Zoom Button', 'robo-gallery' ).'</a></li>					
				</ul>
				<div class="tab-content">
		        	<div role="tabpanel" class="tab-pane active" id="hover_text"><br/>',
	'after_row'		=> '
					</div>'
));

$hover_group->add_field( array(
	'name' 			=> __('Link Icon', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'linkIcon',
	'type' 			=> 'font',
	'bootstrap_style'=> 1,
    'default'		=> array(
    	'enabled'	=> rbs_gallery_set_checkbox_default_for_new_post(0),
    	'iconSelect'=> 'fa-link',

    	'color'		=> '#ffffff',
    	'colorHover'=> '#ffffff',
    	'fontSize'  => '20',
    ),
    'icon'			=> 1,
    'before_row'	=> '
	        		<div role="tabpanel" class="tab-pane" id="hover_linkicon"><br/>', 
	'after_row'		=> '
					</div>'
));

$hover_group->add_field( array(
	'name' 			=> __('Zoom Icon', 'robo-gallery' ),
	'id' 			=> ROBO_GALLERY_PREFIX . 'zoomIcon',
	'type' 			=> 'font',
	'bootstrap_style'=> 1,
    'default'		=> array(
    	'enabled'	=> rbs_gallery_set_checkbox_default_for_new_post(1),
    	'iconSelect'=> 'fa-search-plus',

    	'color'		=> '#ffffff',
    	'colorHover'=> 'rgb(174, 174, 174)',
    	'colorBg'	=> 'rgba(13, 130, 241, 0)',
    	'colorBgHover'	=> 'rgba(6, 70, 130, 0)',
    	'borderSize'	=> '0',
    	'fontSize'  => '30',
    ),
    'icon'			=> 1,
    'before_row'	=> '
	        		<div role="tabpanel" class="tab-pane" id="hover_zoomicon"><br/>',
	'after_row'		=> '
					</div>
				</div>
			</div>
		</div>

		<div class="roboGalleryFields">
	    	<div class="row">
		    	<div class="content small-12 columns text-center" >'
		    	.( ROBO_GALLERY_TYR ? '' : rbsGalleryUtils::getProButton( '+ ' . __('Additional Functionality available in Pro version', 'robo-gallery') )).
				'</div>
			</div>
    	</div>
		
	</div>'
));


$hover_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'showDesc',
	'type' 			=> 	'hidden_array',	
	'default'		=> 	array(
    	'enabled'	=> rbs_gallery_set_checkbox_default_for_new_post(0),
    	'color'		=> '#000000',
    	'colorHover'=> '#000000',
    	'fontSize'  => '24',
    ),	
));

$hover_group->add_field( array(
	'id' 			=> 	ROBO_GALLERY_PREFIX . 'desc_template',
	'type' 			=> 	'hidden',	
	'default'		=> 	'<div class="rbs-hover-title">@TITLE@</div>'."\n".
		'<div class="rbs-hover-caption">@CAPTION@</div>'."\n".
		'<div class="rbs-hover-text">@DESC@</div>'."\n".
		'<div class="rbs-hover-more"><a href="@LINK@">Read more</a></div>'."\n",
));
