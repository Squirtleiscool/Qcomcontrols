<?php
/* 
*      Robo Gallery     
*      Version: 3.0.5 - 66649
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */
 
if ( ! defined( 'WPINC' ) )  die;

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'abstraction.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'jsoptions.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'source/source.php';


require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'assets.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'config.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'scss.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'element.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'stats.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'size.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'grid/grid.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'grid/grid.columns.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'hover/hover.v1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'effects.set1.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'polaroid.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'tags.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'menu/menu.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'lightbox/lightbox.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'loader.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'addtexts.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'customcss.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'cache.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'cachedb.php';


require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'layout.v1/layout.v1.php';

require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'resize.php';
require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'seo.php';

//require_once ROBO_GALLERY_FRONTEND_MODULES_PATH.'search.php';