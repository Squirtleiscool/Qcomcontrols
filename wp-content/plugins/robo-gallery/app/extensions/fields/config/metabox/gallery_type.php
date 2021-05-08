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

$type = rbsGalleryUtils::getTypeGallery();
$source = rbsGalleryUtils::getSourceGallery();

return array(
	'active' => true,
	'order' => 0,
	'settings' => array(
		'id' => 'robo-gallery-theme-type',
		'title' => __('Current Gallery Type', 'robo-gallery'),
		'screen' => array(  ROBO_GALLERY_TYPE_POST ),
		'context' => 'normal',
		'priority' => 'high',
	),
	'view' => 'default',
	'state' => 'open',
	'content' => 'template::content/gallery_type/type' . ( $type ? '_'.$type : '' ),
	'fields' => array(
		array(
			'type' => 'hidden',
			'view' => 'default',
			'name' => 'gallery_type',
			'default' => $type,
		),
		array(
			'type' => 'hidden',
			'view' => 'default',
			'name' => 'gallery_type_source',
			'default' => $source,
		),
	),
);


