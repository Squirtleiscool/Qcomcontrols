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

class roboGalleryFieldsHelper{

	public static function addField( $fileName, $dirName = '' ){
		
		if( !$fileName ) return array('type' => 'skip');

		if( !$dirName ) $dirName = ROBO_GALLERY_FIELDS_SUB_FIELDS;

		if( !file_exists($dirName.$fileName) ) return array('type' => 'skip');

		return include $dirName.$fileName;
	}


	public static function addFields( $fileName, $dirName = '' ){
		if( !$fileName ) return array();	

		if( !$dirName ) $dirName = ROBO_GALLERY_FIELDS_PATH_CONFIG.'metabox/';

		if( !file_exists($dirName.$fileName) ) return array();

		return include $dirName.$fileName;
	}


	public static function addExtFields( $fileName, $dirName = '' ){

		if( !ROBO_GALLERY_TYR ) return array();

		if( !$dirName ) $dirName = ROBO_GALLERY_KEY_PATH_DIR.'fields/';

		return self::addFields( $fileName, $dirName );
	}	

	public static function addDependOptions( $fileName, $fileExtName, $dirName = '' , $dirExtName = '' ){

		if( ROBO_GALLERY_TYR ){
			if(!$dirExtName) $dirExtName = ROBO_GALLERY_KEY_PATH_DIR.'fields/';
			return self::addFields( $fileExtName, $dirExtName );
		}

		return self::addFields( $fileName, $dirName );
	}


	public static function addDependField( $fileName, $fileExtName, $dirName = '' , $dirExtName = '' ){

		if( ROBO_GALLERY_TYR ){
			if(!$dirExtName) $dirExtName = ROBO_GALLERY_KEY_PATH_DIR.'fields/subfields/';
			return self::addField( $fileExtName, $dirExtName );
		}

		return self::addField( $fileName, $dirName );
	}



}
