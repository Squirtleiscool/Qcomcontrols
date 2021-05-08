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
	'order' => 4,
	'settings' => array(
		'id' => 'robo-gallery-slider-animation',
		'title' => __('Animation Options', 'robo-gallery'),
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
			'type' => 'checkbox',
			'view' => 'switch',
			'name' => 'autoplay',
			'label' => __('Slider autoplay', 'robo-gallery'),
			'default' => 0,
			'options' => array(
				'size' => 'large',
				'onLabel' => 'On',
				'offLabel' => 'Off',
			),
			"dependents" => array(
				0 => array(
					'hide' => array('#wrap-field-custom-delay'),
				),
				1 => array(
					'show' => array('#wrap-field-custom-delay'),
				),
			)
		),

		array(
			'type' => 'text',
			'view' => 'group',
			'name' => 'delay',
			'id'	=> 'custom-delay',
			'label' => __('Delay', 'robo-gallery'),
			'default' => 1500,
			'cb_sanitize' => 'intval',
			'options' => array(
				'rightLabel' 	=> 'ms',
				'column'		=> '12',
				'columnWrap'	=> '12  medium-6',
			),
			
		),

		array(
			'type' => 'radio',
			'view' => 'buttons-group',		
			'name' => 'direction',
			'default' => 'horizontal',
			'label' => __('Direction', 'robo-gallery'),
			'options' => array(
				'values' => array(
					array(
						'value' => 'vertical',
						'label' => 'Vertical',
					),
					array(
						'value' => 'horizontal',
						'label' => 'Horizontal',
					),
					
				),
			),
		),

	
	),
);
