<?php

//----------------------HELP SECTION----------------------------------

//Basic Instructions
$wp_customize->add_setting('optimizer[help-tuts]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
) );
				$wp_customize->add_control( new Optimizer_Controls_Info_Control( $wp_customize, 'help-tuts', array(
					//'type' => 'info',
					//'label' => __('Create a Website with Optimizer','optimizer'),
					'description' => __('<a class="video_tuts">Basic Instructions</a>','optimizer'),
					'section' => 'video_section',
					'settings' => 'optimizer[help-tuts]',
				) ) );



//CUREATE A WEBSITE
$wp_customize->add_setting('optimizer[help-createbus]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
) );
				$wp_customize->add_control( new Optimizer_Controls_Info_Control( $wp_customize, 'help-createbus', array(
					//'type' => 'info',
					//'label' => __('Create a Website with Optimizer','optimizer'),
					'description' => __('<a class="createbus">Create a Website with Optimizer</a>','optimizer'),
					'section' => 'video_section',
					'settings' => 'optimizer[help-createbus]',
				) ) );


$wp_customize->add_setting('optimizer[help-faq]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
) );
				$wp_customize->add_control( new Optimizer_Controls_Info_Control( $wp_customize, 'help-faq', array(
					//'type' => 'info',
					//'label' => __('Frequently Asked Questions','optimizer'),
					'description' => __('<a class="createbus">Frequently Asked Questions</a>','optimizer'),
					'section' => 'otherhelp_section',
					'settings' => 'optimizer[help-faq]',
				) ) );
				
				
$wp_customize->add_setting('optimizer[help-resource]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
) );
				$wp_customize->add_control( new Optimizer_Controls_Info_Control( $wp_customize, 'help-resource', array(
					//'type' => 'info',
					//'label' => __('Frequently Asked Questions','optimizer'),
					'description' => __('<a target="_blank" href="https://optimizerwp.com/resource-center/">Free Resources</a>','optimizer'),
					'section' => 'otherhelp_section',
					'settings' => 'optimizer[help-resource]',
				) ) );
