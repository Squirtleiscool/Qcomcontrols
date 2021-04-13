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

$loading_group = new_cmb2_box( array(
    'id' 			=> ROBO_GALLERY_PREFIX.'loading_metabox',
    'title' 		=> __('Loading Options','robo-gallery'),
    'object_types' 	=> array( ROBO_GALLERY_TYPE_POST ),
    'context' 		=> 'normal',
    'show_names' 	=> false,
));

$loading_group->add_field(array(
	'name' 			=> __('Lazy Load','robo-gallery'),
	'id' 			=> ROBO_GALLERY_PREFIX . 'lazyLoad',
	'type' 			=> 'switch',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(1),
	'bootstrap_style'=> 1,
	'before_row' 	=> ' <br />
<div class="rbs_block rbs_loading_tabs">
	<div role="tabpanel">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#loading_options" aria-controls="loading_options" role="tab" data-toggle="tab">'.__('Loading Options','robo-gallery').'</a></li>
			<li role="presentation"><a href="#loading_text" aria-controls="loading_text" role="tab" data-toggle="tab">'.__('Loading Text','robo-gallery').'</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="loading_options"><br/>
				',
));

$loading_group->add_field( array(
	'name' 			=> __('Images Amount','robo-gallery'),
	'id' 			=> ROBO_GALLERY_PREFIX . 'boxesToLoadStart',
	'type' 			=> 'slider',
	'bootstrap_style'=> 1,
	'desc'			=> __('Amount of the  images which gallery load on start by default', 'robo-gallery'),
	'default'		=> 12,
	'min'			=> 1,
	'max'			=> 50,
));
$loading_group->add_field(array(
	'name' 			=> __('Load More Amount','robo-gallery'),
	'id' 			=> ROBO_GALLERY_PREFIX . 'boxesToLoad',
	'type' 			=> 'slider',
	'desc'			=> __('Amount of the image in load more pagination step. After click on Load more button gallery load this amount of new images', 'robo-gallery'),
	'bootstrap_style'=> 1,
	'default'		=> 8,
	'min'			=> 1,
	'max'			=> 50,
));

 $loading_group->add_field(array(
	'name' 			=> __('Wait Thumbs Load','robo-gallery'),
	'id' 			=> ROBO_GALLERY_PREFIX . 'waitUntilThumbLoads',
	'type' 			=> 'switch',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(1),
	'bootstrap_style'=> 1,
));

 $loading_group->add_field(array(
	'name' 			=> __('Wait No Matter What','robo-gallery'),
	'id' 			=> ROBO_GALLERY_PREFIX . 'waitForAllThumbsNoMatterWhat',
	'type' 			=> 'switch',
	'default'		=> rbs_gallery_set_checkbox_default_for_new_post(0),
	'bootstrap_style'=> 1,
));

$loading_group->add_field( array(
    'name'    => __('Bg Color','robo-gallery'),
    'id'	  => ROBO_GALLERY_PREFIX .'loadingBgColor',
    'type'    => 'rbstext',
    'small'			=> 1,
	'default'  		=> '#ffffff',
	'data-default' 	=>  '#ffffff',
    'class'			=> 'form-control rbs_color rbs_hover_bg_color',
    'after_row'		=>'
    		</div> '
));

$loading_group->add_field( array(
    'name'    => __('Loading Label','robo-gallery'),
    'default' => 'Loading...',
    'id'	  => ROBO_GALLERY_PREFIX .'LoadingWord',
    'type'    => 'rbstext',
    'before_row' 	=> '
			<div role="tabpanel" class="tab-pane" id="loading_text"><br/>
			',
));

$loading_group->add_field( array(
    'name'    => __('Load More Label','robo-gallery'),
    'default' => 'Load More',
    'id'	  => ROBO_GALLERY_PREFIX .'loadMoreWord',
    'type'    => 'rbstext'
));

$loading_group->add_field( array(
    'name'    => __('No More Entries Label','robo-gallery'),
    'default' => 'No More Entries',
    'id'	  => ROBO_GALLERY_PREFIX .'noMoreEntriesWord',
    'type'    => 'rbstext',
    'after_row'		=>'
			</div>
		</div>
	</div>
</div>'
));
	 
	