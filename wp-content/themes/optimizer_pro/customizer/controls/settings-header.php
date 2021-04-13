<?php


//----------------------SITE LAYOUT SECTION----------------------------------

//============================TOPBAR SECTION=================================

//Topbar Enable
$wp_customize->add_setting('optimizer[tophead_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'tophead_id', array(
				'label' => __('Enable Topbar','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[tophead_id]',
			)) );

//Display Topbar Menu 
$wp_customize->add_setting('optimizer[topmenu_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'topmenu_id', array(
				'label' => __('Display Topbar Menu','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topmenu_id]',
			)) );

//Topbar Menu Position
$wp_customize->add_setting('optimizer[topmenu_switch]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'topmenu_switch', array(
				'label' => __('Align Topbar Menu to Left','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topmenu_switch]',
			)) );

//Display Search Button
$wp_customize->add_setting('optimizer[topsearch_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'topsearch_id', array(
				'label' => __('Display Search Button','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topsearch_id]',
			)) );

//Topbar Phone Number
$wp_customize->add_setting('optimizer[tophone_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_kses_html',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('tophone_id', array(
				'type' => 'text',
				'label' => __('Topbar Phone Number','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[tophone_id]',
						'input_attrs'	=> array(
							'class'	=> 'mini_control',
						),
			) );

//TOPBAR Font SIZE
$wp_customize->add_setting('optimizer[topbar_font_size]', array(
	'type' => 'option',
	'default' => '15px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('topbar_font_size', array(
				'type' => 'text',
				'label' => __('Topbar Font Size','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topbar_font_size]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );
			
//TOPBAR BACKGROUND COLOR
$wp_customize->add_setting( 'optimizer[topbar_bg_color]', array(
	'type' => 'option',
	'default' => '#333333',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_bg_color', array(
				'label' => __('Topbar Background Color','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topbar_bg_color]',
			) ) );

//TOPBAR TEXT COLOR
$wp_customize->add_setting( 'optimizer[topbar_color_id]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_color_id', array(
				'label' => __('Topbar Text Color','optimizer'),
				'section' => 'headtopbar_section',
				'settings' => 'optimizer[topbar_color_id]',
			) ) );
			
			

//============================HEADER - LOGO SECTION=================================




// Site Title Font Family
$wp_customize->add_setting( 'optimizer[logo_font_id][font-family]', array(
	'type' => 'option',
	'default' => 'Open Sans',
	'sanitize_callback' => 'esc_attr',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('logo_font_family', array(
					'type' => 'select',
					'label' => __('Family','optimizer'),
					'section' => 'headlogo_section',
					'settings' => 'optimizer[logo_font_id][font-family]',
					'choices' => customizer_library_get_font_choices(),
			) );

// Site Title Font Subsets
$wp_customize->add_setting( 'optimizer[logo_font_id][subsets]', array(
	'type' => 'option',
	'default' => 'latin',
	'sanitize_callback' => 'esc_attr',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('logo_font_subsets', array(
					'type' => 'select',
					'label' => __('Subsets','optimizer'),
					'section' => 'headlogo_section',
					'settings' => 'optimizer[logo_font_id][subsets]',
					'choices' => customizer_library_get_google_font_subsets(),
			) );


//Site Title Font Size
$wp_customize->add_setting('optimizer[logo_font_id][font-size]', array(
	'type' => 'option',
	'default' => '42px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('logo_font_size', array(
				'type' => 'text',
				'label' => __('Site Title Font Size','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[logo_font_id][font-size]',
						'input_attrs'	=> array(
							'class'	=> 'mini_control',
						)
			) );
			
//Site Title Font Size
$wp_customize->add_setting('optimizer[tagline_font_size]', array(
	'type' => 'option',
	'default' => '12px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('tagline_font_size', array(
				'type' => 'text',
				'label' => __('Tagline Font Size','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[tagline_font_size]',
						'input_attrs'	=> array(
							'class'	=> 'mini_control',
						)
			) );


//Site Title Text Color
$wp_customize->add_setting( 'optimizer[logo_color_id]', array(
	'type' => 'option',
	'default' => '#555555',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'logo_color_id', array(
				'label' => __('Site Title Color','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[logo_color_id]',
			) ) );



//LOGO UPLOAD FIELD
$wp_customize->add_setting( 'optimizer[logo_image_id][url]',array( 
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image_id',array(
					'label'       => __( 'Logo Image *', 'optimizer' ),
					'section'     => 'headlogo_section',
					'settings'    => 'optimizer[logo_image_id][url]',
					//'description' => __('This image will replace the text logo.','optimizer'),
						)
					)
			);
			
//LOGO UPLOAD FIELD
$wp_customize->add_setting( 'optimizer[home_logo_id][url]',array( 
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'home_logo_id',array(
					'label'       => __( 'Logo Image for Frontpage (Optional)*', 'optimizer' ),
					'section'     => 'headlogo_section',
					'settings'    => 'optimizer[home_logo_id][url]',
					//'description' => __('This image will replace the text logo.','optimizer'),
						)
					)
			);
//Restrict Slider Height
$wp_customize->add_setting('optimizer[logo_max_width]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_kses_html',
	//'transport' => 'postMessage',
) );
			$wp_customize->add_control('logo_max_width', array(
				'type' => 'text',
				'label' => __('Logo Max Width (px)','optimizer'),
				'description' => __('in pixel (px). eg: 180px. Keep empty to disable the option.', 'optimizer'),	
				'section' => 'headlogo_section',
				'settings' => 'optimizer[logo_max_width]',
						'input_attrs'	=> array(
							'class'	=> 'mini_control',
						),
			) );

//LOGO ALIGN FIELD
$wp_customize->add_setting( 'optimizer[logo_position]', array(
		'type' => 'option',
        'default' => 'logo_left',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('logo_position', array(
					'type' => 'select',
					'label' => __('Site Title / Logo Position','optimizer'),
					'section' => 'headlogo_section',
					'choices' => array(
						'logo_left' => 'Left',
						'logo_right' => 'Right',
						'logo_middle' => 'Inside Menu (Center)',
						'logo_center' => 'Above Menu (Center)',
						'logo_center_left' => 'Above Menu (Left)',
						'topbarlogo' => 'Topbar'
					),
					'settings'    => 'optimizer[logo_position]'
			) );
			

//MENU BAR COLOR
$wp_customize->add_setting( 'optimizer[menubar_color_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menubar_color_id', array(
				'label' => __('Menu Bar Background Color','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[menubar_color_id]',
			) ) );


			
//Hide Site Title
$wp_customize->add_setting('optimizer[hide_sitett]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_sitett', array(
				'label' => __('Hide Site Title','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[hide_sitett]',
			)) );
			
//Hide Site Description
$wp_customize->add_setting('optimizer[hide_tagline]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_tagline', array(
				'label' => __('Hide Site Tagline','optimizer'),
				'section' => 'headlogo_section',
				'settings' => 'optimizer[hide_tagline]',
			)) );
			


//============================HEADER - MENU SECTION=================================

//-MENU STYLE FIELD
$wp_customize->add_setting( 'optimizer[head_menu_type]', array(
		'type' => 'option',
        'default' => '1',
		'sanitize_callback' => 'optimizer_sanitize_choices',
) );
			$wp_customize->add_control('head_menu_type', array(
					'type' => 'select',
					'label' => __('Header Menu Style *','optimizer'),
					'section' => 'headmenu_section',
					'choices' => array(
						'1' => __('Only Menu', 'optimizer'), 
						'2' => __('Menu + Description', 'optimizer'), 
						'3' => __('Icon + Menu', 'optimizer'), 
						'4' => __('Icon + Menu + Description', 'optimizer'),
						'5' => __('Only Icon', 'optimizer'),
						'6' => __('Icon + Description', 'optimizer'),
						'7' => __('Hamburger Menu', 'optimizer'),
					),
					'settings'    => 'optimizer[head_menu_type]'
			) );



//MENU TEXT COLOR
$wp_customize->add_setting( 'optimizer[menutxt_color_id]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menutxt_color_id', array(
				'label' => __('Menu Text Color','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[menutxt_color_id]',
			) ) );

//MENU HOVER TEXT COLOR
$wp_customize->add_setting( 'optimizer[menutxt_color_hover]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menutxt_color_hover', array(
				'label' => __('Menu Hover Text Color','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[menutxt_color_hover]',
			) ) );

//MENU ACTIVE TEXT COLOR
$wp_customize->add_setting( 'optimizer[menutxt_color_active]', array(
	'type' => 'option',
	'default' => '#3590ea',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menutxt_color_active', array(
				'label' => __('Menu Active Text Color','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[menutxt_color_active]',
         ) ) );
         
//SUBMENU TEXT COLOR
$wp_customize->add_setting( 'optimizer[submenu_text_color]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	//'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_text_color', array(
				'label' => __('Submenu Text Color','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[submenu_text_color]',
			) ) );

//SUBMENU BG COLOR
$wp_customize->add_setting( 'optimizer[submenu_bg_color]', array(
	'type' => 'option',
	'default' => '#000000',
	'sanitize_callback' => 'sanitize_hex_color',
	//'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'submenu_bg_color', array(
				'label' => __('Submenu Background','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[submenu_bg_color]',
			) ) );

//SUBMENU BG OPACITY
$wp_customize->add_setting( 'optimizer[submenu_bg_opacity]', array(
   'type' => 'option',
     'default' => '50',
   'sanitize_callback' => 'optimizer_sanitize_number',
   //'transport' => 'postMessage',
) );

      $wp_customize->add_control('submenu_bg_opacity', array(
            'type' => 'range',
            'label' => __('Submenu Background Opacity','optimizer'),
            'section' => 'headmenu_section',
            'input_attrs' => array(
               'min' => 0,
               'max' => 100,
               'step' => 1,
               'class' => 'range-textbox_bottom',
               'style' => 'color: #0a0',
            ),
            'settings'    => 'optimizer[submenu_bg_opacity]'
      ) );

      

//MENU TEXT SIZE
$wp_customize->add_setting('optimizer[menu_size_id]', array(
	'type' => 'option',
	'default' => '14px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('menu_size_id', array(
				'type' => 'text',
				'label' => __('Menu Font Size','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[menu_size_id]',
						'input_attrs'	=> array(
							'class'	=> 'mini_control',
						)
			) );




//Hide Header Menu
$wp_customize->add_setting('optimizer[hide_head_menu]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_head_menu', array(
				'label' => __('Hide Header Menu','optimizer'),
				'section' => 'headmenu_section',
				'settings' => 'optimizer[hide_head_menu]',
			)) );
			


//============================BASIC - HEADER SECTION=================================

//TRANSPARENT HEADER FIELD
$wp_customize->add_setting('optimizer[head_transparent]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'head_transparent', array(
				'label' => __('Transparent Header on Frontpage *','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[head_transparent]',
			)) );



//TRANSPARENT HEADER COLOR FIELD
$wp_customize->add_setting( 'optimizer[trans_header_color]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'trans_header_color', array(
				'label' => __('Transparent Header Text Color','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[trans_header_color]',
				'active_callback' => 'optimizer_transparent_header_callback',
			) ) );



//HEADER BACKGROUND COLOR
$wp_customize->add_setting( 'optimizer[head_color_id]', array(
	'type' => 'option',
	'default' => '#f5f5f5',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'head_color_id', array(
				'label' => __('Header Background Color','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[head_color_id]',
			) ) );


//HEADER Background Image
$wp_customize->add_setting( 'optimizer[header_bgimage][url]',array( 
	'type' => 'option',
	'default' =>'' ,
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_bgimage',array(
					'label'       => __( 'Header Background Image *', 'optimizer' ),
					'section'     => 'headheader_section',
					'settings'    => 'optimizer[header_bgimage][url]'
						)
					)
			);


//Display Search Button
$wp_customize->add_setting('optimizer[headsearch_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'headsearch_id', array(
				'label' => __('Display Search Button','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[headsearch_id]',
			)) );


//STICKY HEADER FIELD
$wp_customize->add_setting('optimizer[head_sticky]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
			 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'head_sticky', array(
				'label' => __('Make Header Sticky *','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[head_sticky]',
			)) );
			
			


//Left Sidebar HEADER FIELD
$wp_customize->add_setting('optimizer[head_sidebar]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
			 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'head_sidebar', array(
				'label' => __('Show Header on left *','optimizer'),
				'section' => 'headheader_section',
				'settings' => 'optimizer[head_sidebar]',
			)) );
			

//Left Header Style
$wp_customize->add_setting( 'optimizer[header_sidebar_style]', array(
		'type' => 'option',
        'default' => 'header_sidebar_default',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('header_sidebar_style', array(
					'type' => 'select',
					'label' => __('Left Header Style','optimizer'),
					'section' => 'headheader_section',
					'choices' => array(
						'header_sidebar_default' => 'Default',
						'header_sidebar_center' => 'Default (Center)',
						'header_sidebar_border' => 'Bordered',
						'header_sidebar_border_center' => 'Bordered (Center)',
					),
					'settings'    => 'optimizer[header_sidebar_style]',
					'active_callback' => 'optimizer_header_sidebar_callback',
			) );
			
			
//Left Header Content
$wp_customize->add_setting( 'optimizer[left_head_content]', array(
		'type' => 'option',
		'sanitize_callback' => 'optimizer_kses_html',
        'default' => '',
	
) );
			$wp_customize->add_control( new Optimizer_Editor_Control( $wp_customize, 'left_head_content', array( 
					'type' => 'editor',
					'label' => __('Left Header Content *','optimizer'),
					'section' => 'headheader_section',
					'settings'    => 'optimizer[left_head_content]',
					'active_callback' => 'optimizer_header_sidebar_callback',
			)) );