<?php
/*
*      Robo Gallery     
*      Version: 2.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/
if ( ! defined( 'WPINC' ) ) exit;

class RoboGalleryConfig {

	public static function guides() {
		
		$guides =  array(
			array(
				'link'=> 	'https://www.youtube.com/watch?v=3vBl9Ke6bsg',
				'text'=> 	__( 'How to install key?', 'robo-gallery' ),
				'class'=> 	'green'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=DdCpRuLFxzk',
				'text'=> 	__( 'How to make custom grid layout?', 'robo-gallery' ),
				'class'=> 	'violet'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=-CuGOo7XRmQ',
				'text'=> 	__( 'New Categories Manager', 'robo-gallery' ),
				'class'=> 	'green'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=mZ_yOXkxRsk',
				'text'=> 	__( 'How to setup Polaroid style?', 'robo-gallery' ),
				'class'=> 	'violet'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=m9XIeqMnhYI',
				'text'=> 	__( 'Install and configuration guide', 'robo-gallery' ),
				'class'=> 	'green'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=RrWn8tMuKsw',
				'text'=> 	__( 'How to manage gallery post?', 'robo-gallery' ),
				'class'=> 	'violet'
			),
			array(
				'link'=> 	'https://www.youtube.com/watch?v=fI3uYOlUbo4',
				'text'=> 	__( 'How to upload gallery images?', 'robo-gallery' ),
				'class'=> 	'green'
			),					
			array(
				'link'=> 	'https://www.youtube.com/watch?v=lxDR6E8erBA',
				'text'=> 	__( 'How to create shortcode?', 'robo-gallery' ),
				'class'=> 	'violet'
			),
		);

		return $guides[ array_rand( $guides ) ];
	}
}