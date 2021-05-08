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
 
if ( ! defined( 'WPINC' ) )  die;

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/abstraction.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/assets.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/config.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/cache.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/cachedb.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/scss.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/element.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/jsoptions.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/stats.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/customcss.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/addtexts.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/source/class.source.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'class/loader.php';


require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/assets.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/menu/menu.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/grid/grid.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/grid/grid.columns.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/hover.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/layout.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/effects.set1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/polaroid.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/resize.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/seo.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/size.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/tags.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/lightbox.php';
//require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'base-grid/search.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'slider/layout.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'slider/assets.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'slider/options.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'slider/content.php';