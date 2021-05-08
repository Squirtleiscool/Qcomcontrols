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

if( !ROBO_GALLERY_TYR || rbsGalleryUtils::compareVersion('2.1') ) return array();

return array(
	'active' => true,
	'order' => 1,
	'settings' => array(
		'id' => 'robo_gallery_update_notice',
		'title' => __('Update license key file', 'robo-gallery'),
		'screen' => array( ROBO_GALLERY_TYPE_POST ),
		'context' => 'normal',
		'priority' => 'high',
	),
	'view' => 'default',
	'state' => 'open',	
	'content' => sprintf(
		'<div class="label warning large-12 columns robo-update-key-message">
			<h6>
				<strong>%s</strong><br/>
				%s
			</h6>
		</div>
		%s',
		__('Please update license key to the latest version.', 'robo-gallery'),
		__('With latest version of the license key you get access to the full list of the latest functionality of the plugin.', 'robo-gallery'),
		rbsGalleryUtils::getUpdateButton( __('Update license key', 'robo-gallery') )
	)
);
