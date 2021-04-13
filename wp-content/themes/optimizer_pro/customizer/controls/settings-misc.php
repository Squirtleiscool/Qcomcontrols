<?php


//======================MISC SECTION===============================

//=======================SOCIAL Settings============================
//------SOCIAL LINKS SETTINGS

//Social links Icons Style
$wp_customize->add_setting('optimizer[social_button_style]', array(
		'type' => 'option',
        'default' => 'simple',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Control_Radio_Image( $wp_customize, 'social_button_style', array(
					'type' => 'radio-image',
					'label' => __('Social links Icons Style','optimizer'),
					'section' => 'socialinks_section',
					'settings' => 'optimizer[social_button_style]',
					'choices' => array(
						'simple' => array( 'url' => get_template_directory_uri().'/assets/images/social/social_simple.png', 'label' => 'Round' ),
						'round' => array( 'url' => get_template_directory_uri().'/assets/images/social/round.png', 'label' => 'Round' ),
						'square' => array( 'url' => get_template_directory_uri().'/assets/images/social/square.png', 'label' => 'Square' ),
						'hexagon' => array( 'url' => get_template_directory_uri().'/assets/images/social/hexagon.png', 'label' => 'Hexagon' ),
					),
			) ));


//Display Icons Color
$wp_customize->add_setting('optimizer[social_show_color]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'social_show_color', array(
				'label' => __('Display Icons Color','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[social_show_color]',
			)) );
 

//Social Icons Position
$wp_customize->add_setting('optimizer[social_bookmark_pos]', array(
		'type' => 'option',
        'default' => 'footer',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('social_bookmark_pos', array(
					'type' => 'select',
					'label' => __('Social Icons Position','optimizer'),
					'section' => 'socialinks_section',
					'settings' => 'optimizer[social_bookmark_pos]',
					'choices' => array(
							'topbar' => __( 'Topbar', 'optimizer' ),
							'header' => __( 'Header', 'optimizer' ),
							'footer' => __( 'Footer', 'optimizer' ),
							'topfoot' => __( 'Topbar + Footer', 'optimizer' ),
							'headfoot' => __( 'Header + Footer', 'optimizer' ),
					),
			) );

//Social Icons Size
$wp_customize->add_setting('optimizer[social_bookmark_size]', array(
		'type' => 'option',
        'default' => 'normal',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('social_bookmark_size', array(
					'type' => 'select',
					'label' => __('Social Icons Size','optimizer'),
					'section' => 'socialinks_section',
					'settings' => 'optimizer[social_bookmark_size]',
					'choices' => array(
							'normal' => __( 'Normal', 'optimizer' ),
							'large' => __( 'Large', 'optimizer' ),
					),
			) );


//-------------------SOCIAL LINKS----------------------

//Facebook URL
$wp_customize->add_setting('optimizer[facebook_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('facebook_field_id', array(
				'type' => 'text',
				'label' => __('LINK 1','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[facebook_field_id]',
			) );


//Twitter URL
$wp_customize->add_setting('optimizer[twitter_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('twitter_field_id', array(
				'type' => 'text',
				'label' => __('LINK 2','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[twitter_field_id]',
			) );

//Google Plus URL
$wp_customize->add_setting('optimizer[gplus_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('gplus_field_id', array(
				'type' => 'text',
				'label' => __('LINK 3','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[gplus_field_id]',
			) );

//Youtube  URL
$wp_customize->add_setting('optimizer[youtube_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('youtube_field_id', array(
				'type' => 'text',
				'label' => __('LINK 4','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[youtube_field_id]',
			) );


//Youtube  URL
$wp_customize->add_setting('optimizer[vimeo_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('vimeo_field_id', array(
				'type' => 'text',
				'label' => __('LINK 5','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[vimeo_field_id]',
			) );

//Flickr URL
$wp_customize->add_setting('optimizer[flickr_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('flickr_field_id', array(
				'type' => 'text',
				'label' => __('LINK 6','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[flickr_field_id]',
			) );


//Linkedin URL
$wp_customize->add_setting('optimizer[linkedin_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('linkedin_field_id', array(
				'type' => 'text',
				'label' => __('LINK 7','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[linkedin_field_id]',
			) );

//Pinterest URL
$wp_customize->add_setting('optimizer[pinterest_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('pinterest_field_id', array(
				'type' => 'text',
				'label' => __('LINK 8','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[pinterest_field_id]',
			) );


//Tumblr URL
$wp_customize->add_setting('optimizer[tumblr_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('tumblr_field_id', array(
				'type' => 'text',
				'label' => __('LINK 9','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[tumblr_field_id]',
			) );



//Dribble URL
$wp_customize->add_setting('optimizer[dribble_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('dribble_field_id', array(
				'type' => 'text',
				'label' => __('LINK 10','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[dribble_field_id]',
			) );


//Behance URL
$wp_customize->add_setting('optimizer[behance_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('behance_field_id', array(
				'type' => 'text',
				'label' => __('LINK 11','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[behance_field_id]',
			) );

//Instagram URL
$wp_customize->add_setting('optimizer[instagram_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('instagram_field_id', array(
				'type' => 'text',
				'label' => __('LINK 12','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[instagram_field_id]',
			) );


//RSS FEED URL
$wp_customize->add_setting('optimizer[rss_field_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('rss_field_id', array(
				'type' => 'text',
				'label' => __('RSS','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[rss_field_id]',
			) );







//-------------------SEO SECTION-----------------------

//Enable SEO
$wp_customize->add_setting('optimizer[enable_seo]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'enable_seo', array(
				'label' => __('Enable SEO','optimizer'),
				'section' => 'miscseo_section',
				'settings' => 'optimizer[enable_seo]',
			)) );


//Enable SEO
$wp_customize->add_setting('optimizer[schema]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'schema', array(
				'label' => __('Enable Schema Markup','optimizer'),
				'section' => 'miscseo_section',
				'settings' => 'optimizer[schema]',
			)) );
			

//Front Page Meta Title
$wp_customize->add_setting('optimizer[meta_title_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'sanitize_text_field',
) );
			$wp_customize->add_control('meta_title_id', array(
				'type' => 'text',
				'label' => __('Front Page Meta Title','optimizer'),
				'section' => 'miscseo_section',
				'settings' => 'optimizer[meta_title_id]',
			) );


//Front Page Meta Descrition
$wp_customize->add_setting('optimizer[meta_desc_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_attr',
) );
			$wp_customize->add_control('meta_desc_id', array(
				'type' => 'textarea',
				'label' => __('Front Page Meta Description','optimizer'),
				'section' => 'miscseo_section',
				'settings' => 'optimizer[meta_desc_id]',
			) );


//Google Analytics
$wp_customize->add_setting('optimizer[google_analytics_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_attr',
) );
			$wp_customize->add_control('google_analytics_id', array(
				'type' => 'textarea',
				'label' => __('Google Analytics','optimizer'),
				'section' => 'miscseo_section',
				'settings' => 'optimizer[google_analytics_id]',
				'description' => __('Add The Whole code provided by Google. Not the id.', 'optimizer'),
			) );

//Default Social Share Image
$wp_customize->add_setting( 'optimizer[social_thumb_id][url]',array( 
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'social_thumb_id',array(
					'label'       => __( 'Default Social Share Image', 'optimizer' ),
					'description' => __('Select Social Share thumbnail for frontpage. Thumbnails for Posts pages are automatically assigned from Featured Image or the First image of the post.', 'optimizer'),
					'section'     => 'miscseo_section',
					'settings'    => 'optimizer[social_thumb_id][url]'
						)
					)
			);



//----------------------MOBILE LAYOUT SECTION----------------------------------


//Header Mobile Menu Type
$wp_customize->add_setting('optimizer[mobile_menu_type]', array(
		'type' => 'option',
        'default' => 'hamburger',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('mobile_menu_type', array(
					'type' => 'select',
					'label' => __('Mobile Menu Type (Header)','optimizer'),
					'section' => 'miscmobile_section',
					'settings' => 'optimizer[mobile_menu_type]',
					'choices' => array(
							'hamburger' => __( 'Hamburger', 'optimizer' ),
							'dropdown' => __( 'Dropdown', 'optimizer' ),
							'simple' => __( 'Simple', 'optimizer' ),
					),
			) );
	
	
//Mobile Menu Topbar
$wp_customize->add_setting('optimizer[mobile_menu_topbar]', array(
		'type' => 'option',
        'default' => 'simple',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('mobile_menu_topbar', array(
					'type' => 'select',
					'label' => __('Mobile Menu Type (Topbar)','optimizer'),
					'section' => 'miscmobile_section',
					'settings' => 'optimizer[mobile_menu_topbar]',
					'choices' => array(
							'simple' => __( 'Simple', 'optimizer' ),
							'hamburger' => __( 'Hamburger', 'optimizer' ),
					),
			) );
			

//Hamburger Background Color FIELD
$wp_customize->add_setting( 'optimizer[hamburger_bg]', array(
	'type' => 'option',
	'default' => '#222222',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hamburger_bg', array(
				'label' => __('Hamburger Background Color','optimizer'),
				'section' => 'miscmobile_section',
				'settings' => 'optimizer[hamburger_bg]',
			) ) ); 


//Hide Mobile Slider 
$wp_customize->add_setting('optimizer[mobile_smart_resize]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'mobile_smart_resize', array(
				'label' => __('Smart Resize Slider Image','optimizer'),
				'section' => 'miscmobile_section',
				'settings' => 'optimizer[mobile_smart_resize]',
			)) );
						

//Hide Mobile Slider 
$wp_customize->add_setting('optimizer[hide_mob_slide]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_mob_slide', array(
				'label' => __('Hide Slider in Mobile','optimizer'),
				'section' => 'miscmobile_section',
				'settings' => 'optimizer[hide_mob_slide]',
			)) );
			
			
//Hide Mobile Right Sidebar 
$wp_customize->add_setting('optimizer[hide_mob_rightsdbr]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_mob_rightsdbr', array(
				'label' => __('Hide Right Sidebar in Mobile','optimizer'),
				'section' => 'miscmobile_section',
				'settings' => 'optimizer[hide_mob_rightsdbr]',
			)) );
			
			
			
//Hide Mobile Page Headers
$wp_customize->add_setting('optimizer[hide_mob_page_header]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_mob_page_header', array(
				'label' => __('Hide Page Headers in Mobile','optimizer'),
				'section' => 'miscmobile_section',
				'settings' => 'optimizer[hide_mob_page_header]',
			)) );



//---------------------------CUSTOM FONT SECTION ----------------------------------

//TTF File
$wp_customize->add_setting('optimizer[custom_font_ttf]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('custom_font_ttf', array(
				'type' => 'text',
				'label' => __('ttf','optimizer'),
				'section' => 'customfont_section',
				'settings' => 'optimizer[custom_font_ttf]',
			) );
			
//EOT File
$wp_customize->add_setting('optimizer[custom_font_eot]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('custom_font_eot', array(
				'type' => 'text',
				'label' => __('eot','optimizer'),
				'section' => 'customfont_section',
				'settings' => 'optimizer[custom_font_eot]',
			) );

//WOFF File
$wp_customize->add_setting('optimizer[custom_font_woff]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('custom_font_woff', array(
				'type' => 'text',
				'label' => __('woff','optimizer'),
				'section' => 'customfont_section',
				'settings' => 'optimizer[custom_font_woff]',
			) );
			
//---------------------------OTHER MISC SECTION ----------------------------------


//Lightbox Feature
$wp_customize->add_setting('optimizer[post_lightbox_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox'
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_lightbox_id', array(
				'label' => __('Lightbox Feature *','optimizer'),
				'section' => 'miscother_section',
				'settings' => 'optimizer[post_lightbox_id]',
			)) );

//Enhanced Gallery Feature
$wp_customize->add_setting('optimizer[post_gallery_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox'
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_gallery_id', array(
				'label' => __('Enhanced Gallery *','optimizer'),
				'section' => 'miscother_section',
				'settings' => 'optimizer[post_gallery_id]',
				'description' => __( 'Replaces your boring WordPress galleries with Optimizer slideshow gallery system.', 'optimizer' ),
			)) );
			
//Smooth Scroll Feature
$wp_customize->add_setting('optimizer[smoothscroll]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox'
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'smoothscroll', array(
				'label' => __('Disable Smooth Scroll *','optimizer'),
				'section' => 'miscother_section',
				'settings' => 'optimizer[smoothscroll]',
				'description' => __( 'Disables the smooth scrolling effect when you scroll up/down', 'optimizer' ),
			)) );

//Disable SmoothScroll
$wp_customize->add_setting('optimizer[social_show_color]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'social_show_color', array(
				'label' => __('Display Icons Color','optimizer'),
				'section' => 'socialinks_section',
				'settings' => 'optimizer[social_show_color]',
			)) );
			

//Lightbox Feature
$wp_customize->add_setting('optimizer[inline_editor]', array(
	'type' => 'option',
	'default' => '',
	'transport' => 'postMessage',
	'sanitize_callback' => 'optimizer_sanitize_checkbox'
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'inline_editor', array(
				'label' => __('Inline Editor in Customizer','optimizer'),
				'description' => __( 'Enabling this option will display an inline text editor in widgets. Please refresh the page to take effect. Note: Enabling this option will make the Customizer a little slow.', 'optimizer' ),
				'section' => 'miscother_section',
				'settings' => 'optimizer[inline_editor]',
			)) );
		
//CUSTOM 404 Page
/*get list of pages*/
$layerpages = get_all_page_ids(); 
$pageList = array('' => __( 'Default', 'optimizer' ));
foreach($layerpages as $page) {
	$pageList[$page] = get_the_title($page);
}	

$wp_customize->add_setting('optimizer[custom_404]', array(
		'type' => 'option',
        'default' => '',
		'sanitize_callback' => 'optimizer_sanitize_choices',
) );
 
			$wp_customize->add_control('custom_404', array(
					'type' => 'select',
					'label' => __('Use This Page as 404 Page*','optimizer'),
					'section' => 'miscother_section',
					'settings' => 'optimizer[custom_404]',
					'choices' =>$pageList,
			) );
			
//Google Map Api Key
$wp_customize->add_setting('optimizer[map_api]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_attr',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('map_api', array(
				'type' => 'text',
				'label' => __('Google Map Api Key','optimizer'),
				'section' => 'miscother_section',
				'settings' => 'optimizer[map_api]',
			) );


//Optimizer Auto Backup
$wp_customize->add_setting('optimizer[auto_backup]', array(
		'type' => 'option',
        'default' => 'off',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('auto_backup', array(
					'type' => 'select',
					'label' => __('Email Optimizer Backup','optimizer'),
					'description' => __( 'Enabling this feature will auto backup and send your Optimizer Theme and Widget Settings to your Wordpress admin email address.', 'optimizer' ),
					'section' => 'miscother_section',
					'settings' => 'optimizer[auto_backup]',
					'choices' => array(
							'off' => __( 'Never', 'optimizer' ),
							'daily' => __( 'Daily', 'optimizer' ),
							'weekly' => __( 'Weekly', 'optimizer' ),
					),
			) );