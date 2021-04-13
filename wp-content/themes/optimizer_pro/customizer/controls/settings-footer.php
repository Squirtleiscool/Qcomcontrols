<?php


//============================FOOTER SECTION=================================

//Scroll To Top Button
$wp_customize->add_setting('optimizer[totop_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'totop_id', array(
				'label' => __('Scroll To Top Button','optimizer'),
				'description' => __( 'Turn On/Off The button that appears on bottom right when you scroll down to pages.', 'optimizer' ),
				'section' => 'footercolors_section',
				'settings' => 'optimizer[totop_id]',
			)) );


//Center Copyright
$wp_customize->add_setting('optimizer[copyright_center]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'copyright_center', array(
				'label' => __('Center Footer Widgets and Copyright Text','optimizer'),
				'section' => 'footercolors_section',
				'settings' => 'optimizer[copyright_center]',
			)) );



//FOOTER Widget Text Color
$wp_customize->add_setting( 'optimizer[footwdgtxt_color_id]', array(
	'type' => 'option',
	'default' => '#666666',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footwdgtxt_color_id', array(
				'label' => __('Footer Widget Area Text Color','optimizer'),
				'section' => 'footercolors_section',
				'settings' => 'optimizer[footwdgtxt_color_id]',
			) ) );


//FOOTER Widget Title Color
$wp_customize->add_setting( 'optimizer[footer_title_color]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color', array(
				'label' => __('Footer Widget Title Color','optimizer'),
				'section' => 'footercolors_section',
				'settings' => 'optimizer[footer_title_color]',
			) ) );



//FOOTER Widget Background Color
$wp_customize->add_setting( 'optimizer[footer_color_id]', array(
	'type' => 'option',
	'default' => '#222222',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color_id', array(
				'label' => __('Footer Widget Area Background Color','optimizer'),
				'section' => 'footercolors_section',
				'settings' => 'optimizer[footer_color_id]',
			) ) );
			
			

//FOOTER Widget Background Image
$wp_customize->add_setting( 'optimizer[footer_bg_img][url]',array( 
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_bg_img',array(
					'label'       => __( 'Footer Background Image *', 'optimizer' ),
					'section'     => 'footercolors_section',
					'settings'    => 'optimizer[footer_bg_img][url]',
					//'description' => __('This image will replace the text logo.','optimizer'),
						)
					)
			);

//----------------------------COPYRIGHT SECTION------------------------------
			
//Footer Copyright Text
$wp_customize->add_setting('optimizer[footer_text_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'wp_kses_post',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Editor_Control( $wp_customize, 'footer_text_id', array( 
				'type' => 'editor',
				'label' => __('Copyright Text','optimizer'),
				'section' => 'copyright_section',
				'settings' => 'optimizer[footer_text_id]',
			)) );


//Footer Menu
$wp_customize->add_setting('optimizer[footmenu_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'footmenu_id', array(
				'label' => __('Display Menu in Copyright Area','optimizer'),
				'section' => 'copyright_section',
				'settings' => 'optimizer[footmenu_id]',
			)) );


//Copyright Text Color
$wp_customize->add_setting( 'optimizer[copyright_txt_color]', array(
	'type' => 'option',
	'default' => '#999999',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_txt_color', array(
				'label' => __('Copyright Text Color','optimizer'),
				'section' => 'copyright_section',
				'settings' => 'optimizer[copyright_txt_color]',
			) ) );
			


//Copyright Area Background
$wp_customize->add_setting( 'optimizer[copyright_bg_color]', array(
	'type' => 'option',
	'default' => '#333333',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color', array(
				'label' => __('Copyright Area Background Color','optimizer'),
				'section' => 'copyright_section',
				'settings' => 'optimizer[copyright_bg_color]',
			) ) );
			
			
//LOGO UPLOAD FIELD
$wp_customize->add_setting( 'optimizer[copyright_bg_img][url]',array( 
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'copyright_bg_img',array(
					'label'       => __( 'Copyright Area Background Image *', 'optimizer' ),
					'section'     => 'copyright_section',
					'settings'    => 'optimizer[copyright_bg_img][url]',
					//'description' => __('This image will replace the text logo.','optimizer'),
						)
					)
			);
