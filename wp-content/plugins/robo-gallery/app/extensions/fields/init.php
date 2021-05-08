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

define('ROBO_GALLERY_FIELDS_PATH', 			dirname(__FILE__) . '/');

define('ROBO_GALLERY_FIELDS_PATH_CONFIG', 	ROBO_GALLERY_FIELDS_PATH . 'config/');
define('ROBO_GALLERY_FIELDS_SUB_FIELDS', 	ROBO_GALLERY_FIELDS_PATH_CONFIG . 'metabox/sub-fields/');

define('ROBO_GALLERY_FIELDS_PATH_FIELD', 	ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsField/');

define('ROBO_GALLERY_FIELDS_TEMPLATE', 		ROBO_GALLERY_FIELDS_PATH . 'template/');

define('ROBO_GALLERY_FIELDS_URL', 			plugin_dir_url(__FILE__));

define('ROBO_GALLERY_FIELDS_BODY_CLASS', 	'roboGalleryFields');

require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFields.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsAjax.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsHelper.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsConfig.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsConfig/roboGalleryFieldsConfigReaderInterface.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsConfig/roboGalleryFieldsConfigReader.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsMetaBoxClass.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsFieldFactory.php';
require_once ROBO_GALLERY_FIELDS_PATH . 'include/roboGalleryFieldsView.php';

roboGalleryFields::getInstance()->init();