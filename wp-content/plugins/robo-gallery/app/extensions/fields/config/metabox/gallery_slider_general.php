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
	'order' => 2,
	'settings' => array(
		'id' => 'robo-gallery-slider-general',
		'title' => __('General Slider Options', 'robo-gallery'),
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
			'name' => 'autoWidth',
			'label' => __('Slider Auto Width', 'robo-gallery'),
			'default' => 1,
			'options' => array(
				'size' => 'large',
				'onLabel' => 'On',
				'offLabel' => 'Off',
			),
			"dependents" => array(
				0 => array(
					'show' => array('#wrap-field-width'),
				),
				1 => array(
					'hide' => array('#wrap-field-width'),
				),
			)
		),

		array(
			'type' => 'composite',
			'view' => 'default',
			'name' => 'width',
			'id'	=> 'width',
			'label' => __('Slider Width ', 'robo-gallery'),
			'description' => __( '', 'robo-gallery') ,
			'fields' => array(
				array(
					'type' => 'text',
					'view' => 'default/llc4',
					'name' => 'value',
					'default' => 100,
				),

				array(
					'type' => 'select',
					'view' => 'default/c2',
					'name' => 'type',
					'default' => '%',
					'options' => array(
						'values' => array(				
							'px' => 'px',
							'%' => '%',
						),
					),
				),
			)
		),

		array(
			'type' => 'checkbox',
			'view' => 'switch',
			'name' => 'autoHeight',
			'label' => __('Slider Auto Height', 'robo-gallery'),
			'default' => 1,
			'options' => array(
				'size' => 'large',
				'onLabel' => 'On',
				'offLabel' => 'Off',
			),
			"dependents" => array(
				0 => array(
					'show' => array('#wrap-field-height'),
				),
				1 => array(
					'hide' => array('#wrap-field-height'),
				),
			)
		),

		array(
			'type' => 'composite',
			'view' => 'default',
			'name' => 'height',
			'id'	=> 'height',
			'label' => __('Slider Height', 'robo-gallery'),
			'description' => __( 'in our gallery we use smart algorithm for the size calculation. In Max Width option you define maximum allowed size of the gallery box', 'robo-gallery') ,
			'fields' => array(

				array(
					'type' => 'text',
					'view' => 'default/llc4',
					'name' => 'value',
					'default' => 100,
				),

				array(
					'type' => 'select',
					'view' => 'default/c2',
					'name' => 'type',
					'default' => 'vh',
					'options' => array(
						'values' => array(				
							'px' => 'px',
							'%' => '%',
							'vh' 	=> 'vh',
						),
					),
				),
			)
		),



		array(
			'type' => 'select',
			'view' => 'default',
			'is_lock' => false,
			'name' => 'orderby',
			'default' => 'categoryD',
			'label' => 'Images order by ',
			'description' => '',
			'options' => array(
				'column' => 8,
				'values' => array(					
					'categoryD' => __( 'Category &darr;', 'robo-gallery' ),
					'categoryU' => __( 'Category &uarr;', 'robo-gallery' ),

					'titleD' 	=> __( 'Title &darr;', 'robo-gallery' ),
					'titleU' 	=> __( 'Title &uarr;', 'robo-gallery' ),

					'dateD' 	=> __( 'Date &darr;', 'robo-gallery' ),
					'dateU' 	=> __( 'Date &uarr;', 'robo-gallery' ),

					'random' 	=> __( 'Random', 'robo-gallery' ),
				),
			),
		),


		array(
			'type' => 'radio',
			'view' => 'buttons-group',

			'name' => 'source',
			'default' => 'original',

			'label' => __('Slider Images Quality', 'robo-gallery'),

			'description' => sprintf(
								' %s <a href="%s" target="_blank">%s</a>', 
								__('here you can customize thumbnails quality, depend of this value you will have different thumbnails resolution. Please check values for the thumbnails resolutions', 'robo-gallery'),
								admin_url( 'options-media.php' ),
								__('here', 'robo-gallery')
							),

			'options' => array(
				'values' => array(
					array(
						'value' => 'thumbnail',
						'label' => 'Small',
					),
					array(
						'value' => 'medium',
						'label' => 'Medium',
					),
					array(
						'value' => 'medium_large',
						'label' => 'Large',
					),
					array(
						'value' => 'original',
						'label' => 'Full',
					)
				),
			),
		),
	
	),
);
