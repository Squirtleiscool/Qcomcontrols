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


return array(
	'active' => true,
	'order' => 5,
	'settings' => array(
		'id' => 'robo-gallery-slider-lazyload',
		'title' => __('Lazy Load Settings ', 'robo-gallery'),
		'screen' => array(  ROBO_GALLERY_TYPE_POST ),
		'context' => 'normal',
		'priority' => 'high', //'default',
		'for' => array( 'gallery_type' => array( 'slider' ) ),		
		'callback_args' => null,
	),
	'view' => 'default',
	'state' => 'open',
	'fields' => array(

		array(
			'type' => 'radio',
			'view' => 'buttons-group',		
			'name' => 'preload',
			'default' => 'preload',
			'label' => __('Preload', 'robo-gallery'),
			'options' => array(
				'values' => array(
					array(
						'value' => 'off',
						'label' => 'Off',
					),
					array(
						'value' => 'preload',
						'label' => 'On',
					),
					array(
						'value' => 'lazy',
						'label' => 'LazyLoad Dark',
					),
					array(
						'value' => 'lazy_white',
						'label' => 'LazyLoad Light',
					),
				),
			),
		),

		array(
			'type' => 'hidden',
			'view' => 'default',
			'name' => 'effect',
			'default' => 'slide',
		),
		array(
			'type' => 'hidden',
			'view' => 'default',
			'name' => 'nav_pagination',
			'default' => 'bullets',
		),
		
	),
);
