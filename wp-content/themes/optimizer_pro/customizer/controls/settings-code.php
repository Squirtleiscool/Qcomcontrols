<?php

//----------------------CUSTOM CODE SECTION----------------------------------
//CUSTOM CSS
$wp_customize->add_setting('optimizer[custom-css]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
) );
				$wp_customize->add_control('custom-css', array(
					'type' => 'textarea',
					'label' => __('Custom CSS','optimizer'),
					'description' => __('Quickly add some CSS to your theme by adding it to this block.', 'optimizer'),
					'section' => 'customcode_section',
					'settings' => 'optimizer[custom-css]',
				) );

//CUSTOM JAVASCRIPT
$wp_customize->add_setting('optimizer[custom-js]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_kses_html',
) );
				$wp_customize->add_control('custom-js', array(
					'type' => 'textarea',
					'label' => __('Custom Javascript *','optimizer'),
					'description' => __('Add Javascript to your theme by adding it to this block.', 'optimizer'),
					'section' => 'customcode_section',
					'settings' => 'optimizer[custom-js]',
				) );
