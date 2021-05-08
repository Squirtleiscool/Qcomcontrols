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


class roboGalleryFieldsFieldTextColor extends roboGalleryFieldsField{
	const FORMAT_RGB 	= 'rgb';
	const FORMAT_RGBA 	= 'rgba';
	const FORMAT_HEX 	= 'hex';

	const REGULAR_RGB 	= '/rgb\( ?[0-9]{1,3} ?, ?[0-9]{1,3} ?, ?[0-9]{1,3} ?\)/i';
	const REGULAR_RGBA 	= '/rgba\( ?[0-9]{1,3} ?, ?[0-9]{1,3} ?, ?[0-9]{1,3} ?, ?(0|1|1.0|0.0|(0?)\.([0-9]{1,3})) ?\)/i';
	const REGULAR_HEX 	= '/#[0-9a-f]{6}/i';

	protected function normalize($value){

		$format = isset($this->options['color-format']) ? $this->options['color-format'] : self::FORMAT_HEX ;

		$value = parent::normalize($value);

		if( isset($this->options['alpha']) && $this->options['alpha'] ) $format = self::FORMAT_RGBA;

		switch ($format) {
				
			case self::FORMAT_RGBA:
				return preg_match( self::REGULAR_RGBA, $value) || preg_match( self::REGULAR_RGB , $value) || preg_match( self::REGULAR_HEX , $value)
					? $value
					: null;
			case self::FORMAT_HEX:
			case self::FORMAT_RGB:
				return preg_match( self::REGULAR_RGBA , $value) || preg_match( self::REGULAR_RGB , $value) || preg_match( self::REGULAR_HEX , $value)
					? $value
					: null;
			default:
				return null;
		}
	}
}
