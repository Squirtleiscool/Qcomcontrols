<?php


//-----------------------------------------------   PORTFOLIO	--------------------------------------------------------

if(function_exists('portfolio_post_type_init') || ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) ){

	//ADD PORTFOLIO SECTION
	$wp_customize->add_section( 'portfolio_section', array(
		'title'       => __( 'Portfolio Settings', 'optimizer' ),
		'priority'    => 10,
		'panel'       => 'misc_panel',
	) );	

//Portfolio Archive layout setting.
$wp_customize->add_setting('optimizer[portfolio_layout]', array(
		'type' => 'option',
		'default'           => '1',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('portfolio_layout',array(
						'type' => 'select',
						'label'    => esc_html__( 'Portfolio Archive Layout*', 'optimizer' ),
						'section'  => 'portfolio_section',
						'settings' => 'optimizer[portfolio_layout]',
						'choices'  => array(
							'1' => __('Square', 'optimizer'), 
							'2' => __('Square (Spaced)', 'optimizer'),
							'3' => __('Masonry', 'optimizer'), 
							'4' => __('Masonry (Spaced)', 'optimizer'), 
							//'5' => __('Slider', 'optimizer'), 
					  )
			  ) );
			  


//Hover layout setting.
$wp_customize->add_setting('optimizer[portfolio_hover_layout]', array(
		'type' => 'option',
		'default'           => '1',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('portfolio_hover_layout',array(
						'type' => 'select',
						'label'    => esc_html__( 'Portfolio Archive Hover Style*', 'optimizer' ),
						'section'  => 'portfolio_section',
						'settings' => 'optimizer[portfolio_hover_layout]',
						'choices'  => array(
							'1' => __('Style 1', 'optimizer'), 
							'2' => __('Style 2', 'optimizer'),
							'3' => __('Style 3', 'optimizer'), 
							'4' => __('Style 4', 'optimizer'), 
							'5' => __('Disable Hover: Always Show Title', 'optimizer'), 
					  )
			  ) );
			  
			  

//Portfolio Single layout setting.
$wp_customize->add_setting('optimizer[portfolio_single_layout]', array(
		'type' => 'option',
		'default'           => '1',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('portfolio_single_layout',array(
						'type' => 'select',
						'label'    => esc_html__( 'Portfolio Single Layout*', 'optimizer' ),
						'section'  => 'portfolio_section',
						'settings' => 'optimizer[portfolio_single_layout]',
						'choices'  => array(
							'1' => __('Content on Right', 'optimizer'), 
							'2' => __('Content on Left', 'optimizer'),
							'3' => __('Content on Top', 'optimizer'), 
							'4' => __('Content on Bottom', 'optimizer'), 
							'5' => __('Plain', 'optimizer'), 
					  )
			  ) );
	


//Share Buttons
$wp_customize->add_setting('optimizer[portfolio_share]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'portfolio_share', array(
				'label' => __('Display Share Buttons','optimizer'),
				'section' => 'portfolio_section',
				'settings' => 'optimizer[portfolio_share]',
			)) );
			

	
}//Portfolio Plugin Check ENDS





//----------------------WOOCOMMERCE--------------------------------------

//Woocommerce Shop Page Sidebar
if ( class_exists( 'WooCommerce' ) ) {
	
	//ADD Woocommerce SECTION
	$wp_customize->add_section( 'woo_section', array(
		'title'       => __( 'Woocommerce Settings', 'optimizer' ),
		'priority'    => 10,
		'panel'       => 'misc_panel',
	) );	


//Woocommerce Primary COLOR FIELD
$wp_customize->add_setting( 'optimizer[woo_prim_color]', array(
	'type' => 'option',
	'default' => '#a46497',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woo_prim_color', array(
				'label' => __('Primary Color','optimizer'),
				'section' => 'woo_section',
				'settings' => 'optimizer[woo_prim_color]',
			) ) );

//Woocommerce Secondary COLOR FIELD
$wp_customize->add_setting( 'optimizer[woo_sec_color]', array(
	'type' => 'option',
	'default' => '#77a464',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woo_sec_color', array(
				'label' => __('Price Tag Color','optimizer'),
				'section' => 'woo_section',
				'settings' => 'optimizer[woo_sec_color]',
			) ) );

			
//Woocommerce Secondary COLOR FIELD
$wp_customize->add_setting( 'optimizer[woo_sale_color]', array(
	'type' => 'option',
	'default' => '#77a464',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woo_sale_color', array(
				'label' => __('Sale Ribbon Color','optimizer'),
				'section' => 'woo_section',
				'settings' => 'optimizer[woo_sale_color]',
			) ) );
//Woocommerce Secondary COLOR FIELD
$wp_customize->add_setting( 'optimizer[woo_title_color]', array(
	'type' => 'option',
	'default' => '#777777',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woo_title_color', array(
				'label' => __('Archive Product Title Color','optimizer'),
				'section' => 'woo_section',
				'settings' => 'optimizer[woo_title_color]',
         ) ) );
         
//Woocommerce Secondary COLOR FIELD
$wp_customize->add_setting( 'optimizer[woo_button_color]', array(
	'type' => 'option',
	'default' => '#EAEAEA',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'woo_button_color', array(
				'label' => __('Archive Product Button Color','optimizer'),
				'section' => 'woo_section',
				'settings' => 'optimizer[woo_button_color]',
         ) ) );
         
//Woocommerce Buttons Style
$wp_customize->add_setting('optimizer[woo_button_style]', array(
		'type' => 'option',
		'default'           => 'topbar',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('woo_button_style',array(
						'type' => 'select',
						'label'    => esc_html__( 'Button Style*', 'optimizer' ),
						'section'  => 'woo_section',
						'settings' => 'optimizer[woo_button_style]',
						'choices'  => array(
							'rounded' => __('Rounded', 'optimizer'), 
							'square' => __('Square', 'optimizer'),
							'circular' => __('Circular', 'optimizer'), 
							'rounded_hollow' => __('Rounded (Hollow)', 'optimizer'), 
							'square_hollow' => __('Square (Hollow)', 'optimizer'),
							'circular_hollow' => __('Circular (Hollow)', 'optimizer'), 
					  )
			  ) );



		
//Cart Icon Position
$wp_customize->add_setting('optimizer[woo_cart_pos]', array(
		'type' => 'option',
		'default'           => 'topbar',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('woo_cart_pos',array(
						'type' => 'select',
						'label'    => esc_html__( 'Woocommerce Cart Icon*', 'optimizer' ),
						'section'  => 'woo_section',
						'settings' => 'optimizer[woo_cart_pos]',
						'choices'  => array(
							'topbar' => __('In Topbar', 'optimizer'), 
							'primary' => __('In Header', 'optimizer'),
							'none' => __('Disabled', 'optimizer'), 
					  )
			  ) );
			  
//Archive Layout
$wp_customize->add_setting('optimizer[woo_archive_layout]', array(
		'type' => 'option',
		'default'           => 'layout0',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('woo_archive_layout',array(
						'type' => 'select',
						'label'    => esc_html__( 'Archive Layout*', 'optimizer' ),
						'section'  => 'woo_section',
						'settings' => 'optimizer[woo_archive_layout]',
						'choices'  => array(
							'layout0' => __('Default', 'optimizer'), 
							'layout1' => __('Layout 1', 'optimizer'), 
							'layout2' => __('Layout 2', 'optimizer'),
							'layout3' => __('Layout 3', 'optimizer'), 
							'layout4' => __('Layout 4', 'optimizer'), 
							'layout5' => __('Layout 5', 'optimizer'),
					  )
			  ) );
			  
//Archive Layout
$wp_customize->add_setting('optimizer[woo_single_layout]', array(
		'type' => 'option',
		'default'           => 'layout0',
		'sanitize_callback' => 'sanitize_key',
	)
);

		  // Add the layout control.
		  $wp_customize->add_control('woo_single_layout',array(
						'type' => 'select',
						'label'    => esc_html__( 'Single Product Layout*', 'optimizer' ),
						'section'  => 'woo_section',
						'settings' => 'optimizer[woo_single_layout]',
						'choices'  => array(
							'layout0' => __('Default', 'optimizer'), 
							'layout1' => __('Layout 1', 'optimizer'), 
							'layout2' => __('Layout 2', 'optimizer'),
							'layout3' => __('Layout 3', 'optimizer'), 
					  )
			  ) );
			  
			  

/*GET LIST OF SIDEBARS*/
$listSidebars = array();
foreach($GLOBALS['wp_registered_sidebars'] as $sidebar ) {
	$listSidebars[$sidebar['id']] = $sidebar['name'];
}

	
	$wp_customize->add_setting( 'optimizer[shop_sidebar_id]', array(
			'type' => 'option',
			'default' => 'sidebar',
			'sanitize_callback' => 'optimizer_sanitize_choices',
	) );
				$wp_customize->add_control('shop_sidebar_id', array(
						'type' => 'select',
						'label' => __('Sidebar for Woocommerce*','optimizer'),
						'section' => 'woo_section',
						'choices' => $listSidebars,
						'settings'    => 'optimizer[shop_sidebar_id]'
				) );
				
	$wp_customize->add_setting( 'optimizer[shop_sidebar_pos]', array(
			'type' => 'option',
			'default' => 'right',
			'sanitize_callback' => 'optimizer_sanitize_choices',
	) );
				$wp_customize->add_control('shop_sidebar_pos', array(
						'type' => 'select',
						'label' => __('Sidebar Position*','optimizer'),
						'section' => 'woo_section',
						'choices'  => array(
							'right' => __('Right', 'optimizer'),
							'left' => __('Left', 'optimizer'), 
							'bottom' => __('Bottom', 'optimizer'), 
							'disabled' => __('Hide', 'optimizer'), 
					  	),
						'settings'    => 'optimizer[shop_sidebar_pos]'
				) );
				

	//Display Header Image in Category Pages
	$wp_customize->add_setting('optimizer[woo_cat_header]', array(
		'type' => 'option',
		'default' => '',
		'sanitize_callback' => 'optimizer_sanitize_checkbox',
	) );
				$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'woo_cat_header', array(
					'label' => __('Display Header in Category Pages','optimizer'),
					'section' => 'woo_section',
					'settings' => 'optimizer[woo_cat_header]',
				)) );
			


}