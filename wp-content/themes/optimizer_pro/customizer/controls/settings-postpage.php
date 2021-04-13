<?php

//----------------------SINGLE POST SECTION----------------------------------

//Single Post Page Style
$wp_customize->add_setting( 'optimizer[single_post_layout]', array(
   'type' => 'option',
     'default' => 'center',
   'sanitize_callback' => 'optimizer_sanitize_choices',
) );

      $wp_customize->add_control('single_post_layout', array(
            'type' => 'select',
            'label' => __('Single Post Layout','optimizer'),
            'section' => 'singlepost_section',
            'choices' => array(
                 'default' => __('Default', 'optimizer'), 
                 'header' => __('Post with Header', 'optimizer'),
                 'narrow' => __('Narrow Layout', 'optimizer'), 
            ),
            'settings'    => 'optimizer[single_post_layout]'
      ) );


//Single Featured Image
$wp_customize->add_setting('optimizer[single_featured]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'single_featured', array(
				'label' => __('Show Featured Image','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[single_featured]',
			)) );

//Single Post Meta
$wp_customize->add_setting('optimizer[post_info_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	//'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_info_id', array(
				'label' => __('Show Post Info','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[post_info_id]',
			)) );

         //Hide Post Date 
         $wp_customize->add_setting('optimizer[hide_post_info_date]', array(
            'type' => 'option',
            'default' => '1',
            'sanitize_callback' => 'optimizer_sanitize_checkbox',
         ) );
         
            $wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_post_info_date', array(
               'label' => __('Hide Post Date','optimizer'),
               'section' => 'singlepost_section',
               'settings' => 'optimizer[hide_post_info_date]',
               'active_callback' => 'optimizer_post_info_callback',
            )) );
         //Hide Post Author
         $wp_customize->add_setting('optimizer[hide_post_info_author]', array(
            'type' => 'option',
            'default' => '1',
            'sanitize_callback' => 'optimizer_sanitize_checkbox',
         ) );
         
            $wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_post_info_author', array(
               'label' => __('Hide Post Author','optimizer'),
               'section' => 'singlepost_section',
               'settings' => 'optimizer[hide_post_info_author]',
               'active_callback' => 'optimizer_post_info_callback',
            )) );
         //Hide Post Comment Count
         $wp_customize->add_setting('optimizer[hide_post_info_comment]', array(
            'type' => 'option',
            'default' => '1',
            'sanitize_callback' => 'optimizer_sanitize_checkbox',
         ) );
         
            $wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_post_info_comment', array(
               'label' => __('Hide Post Comment Count','optimizer'),
               'section' => 'singlepost_section',
               'settings' => 'optimizer[hide_post_info_comment]',
               'active_callback' => 'optimizer_post_info_callback',
            )) );
         //Hide Post Category
         $wp_customize->add_setting('optimizer[hide_post_info_cats]', array(
            'type' => 'option',
            'default' => '1',
            'sanitize_callback' => 'optimizer_sanitize_checkbox',
         ) );
         
            $wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_post_info_cats', array(
               'label' => __('Hide Post Category','optimizer'),
               'section' => 'singlepost_section',
               'settings' => 'optimizer[hide_post_info_cats]',
               'active_callback' => 'optimizer_post_info_callback',
            )) );

//Social Share Icons
$wp_customize->add_setting('optimizer[social_single_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'social_single_id', array(
				'label' => __('Social Share Icons in Posts','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[social_single_id]',
			)) );


//About Author Option
$wp_customize->add_setting('optimizer[author_about_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'author_about_id', array(
				'label' => __('Show Post Author Bio','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[author_about_id]',
			)) );
			

//Related Posts Meta
$wp_customize->add_setting('optimizer[post_related_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_related_id', array(
				'label' => __('Related Posts','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[post_related_id]',
			)) );

//NEXT/PREVIOUS Posts
$wp_customize->add_setting('optimizer[post_nextprev_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_nextprev_id', array(
				'label' => __('Next and Previous Posts','optimizer'),
				'description'  => __('Display Next and Previous Posts Under Single Post', 'optimizer' ),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[post_nextprev_id]',
			)) );


///Show Comments
$wp_customize->add_setting('optimizer[post_comments_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'post_comments_id', array(
				'label' => __('Comments','optimizer'),
				'description'  => __('Show/Hide Comments in Posts and Pages', 'optimizer' ),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[post_comments_id]',
			)) );


//Leave a Reply Text
$wp_customize->add_setting('optimizer[leave_reply_title]', array(
	'type' => 'option',
	'default' => __('Leave a Reply','optimizer'),
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('leave_reply_title', array(
				'type' => 'text',
				'label' => __('Leave a Reply','optimizer'),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[leave_reply_title]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );
			
//Leave a Reply Text
$wp_customize->add_setting('optimizer[blog_layout_width]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'sanitize_text_field',
) );
			$wp_customize->add_control('blog_layout_width', array(
				'type' => 'text',
				'label' => __('Max Width','optimizer'),
            'description'  => __('in px, eg: 1000px. Keep empty to remove width restriction.', 'optimizer' ),
				'section' => 'singlepost_section',
				'settings' => 'optimizer[blog_layout_width]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );

//----------------------PAGE HEADER SECTION----------------------------------

///Turn On Page Header
$wp_customize->add_setting('optimizer[pageheader_switch]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'pageheader_switch', array(
				'label' => __('Turn On Page Header','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[pageheader_switch]',
			)) );



//Breadcrumbs
$wp_customize->add_setting('optimizer[breadcrumbs_id]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'breadcrumbs_id', array(
				'label' => __('Enable Breadcrumbs','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[breadcrumbs_id]',
			)) );

//Page Header Default Background color
$wp_customize->add_setting( 'optimizer[page_header_color]', array(
	'type' => 'option',
	'default' => '#EEEFF5',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_header_color', array(
				'label' => __('Page Header Background','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[page_header_color]',
			) ) );

//Page Header Default Text color
$wp_customize->add_setting( 'optimizer[page_header_txtcolor]', array(
	'type' => 'option',
	'default' => '#555555',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_header_txtcolor', array(
				'label' => __('Page Header Text color','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[page_header_txtcolor]',
			) ) );


//Page Title Font Size
$wp_customize->add_setting('optimizer[pgtitle_size_id]', array(
	'type' => 'option',
	'default' => '32px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('pgtitle_size_id', array(
				'type' => 'text',
				'label' => __('Page Title Font Size','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[pgtitle_size_id]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );
			
			
//Page Header Text Alignment
$wp_customize->add_setting( 'optimizer[page_header_align]', array(
		'type' => 'option',
        'default' => 'center',
		'sanitize_callback' => 'optimizer_sanitize_choices',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control('page_header_align', array(
					'type' => 'select',
					'label' => __('Page Header Text Alignment','optimizer'),
					'section' => 'pageheader_section',
					'choices' => array(
						  'left' => __('Left', 'optimizer'), 
						  'right' => __('Right', 'optimizer'),
                    'center' => __('Center', 'optimizer'), 
                    'middle' => __('Center Middle', 'optimizer'), 
					),
					'settings'    => 'optimizer[page_header_align]'
			) );

//Page Header Default Image
$wp_customize->add_setting( 'optimizer[page_header_image][url]',array( 
	'type' => 'option',
	'default' => '' ,
	'sanitize_callback' => 'esc_url_raw',
	)
);

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_header_image',array(
					'label'       => __( 'Page header Default Image *', 'optimizer' ),
					'section'     => 'pageheader_section',
					'settings'    => 'optimizer[page_header_image][url]'
						)
					)
			);
			
			
///Turn On Page Header on Widgetzed Pages
$wp_customize->add_setting('optimizer[pageheader_widgetized]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'pageheader_widgetized', array(
				'label' => __('Enable Page Header in Widgetized Pages','optimizer'),
				'section' => 'pageheader_section',
				'settings' => 'optimizer[pageheader_widgetized]',
				'description' => __( 'When You customize Pages with widgets, the page header is disabled by default. Enable this option to display the Page header in Widgetized Pages.', 'optimizer' ),
			)) );
			

//----------------------BLOG PAGE SECTION----------------------------------


/*GET LIST OF CATEGORIES*/
$layercats = get_categories(); 
$newList = array();
foreach($layercats as $category) {
	$newList[$category->term_id] = $category->cat_name;
}	
//BLOG CATEGORY SELECT
//Page Header Default Text color
$wp_customize->add_setting( 'optimizer[blog_cat_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_multicheck'
) );

$wp_customize->add_control( new Optimizer_Multicheck_Control( $wp_customize, 'blog_cat_id', array(
        'type' => 'multicheck',
        'label' => __('Display Blog Posts from selected Categories *','optimizer'),
        'section' => 'blogpage_section',
        'choices' =>$newList,
		'settings'    => 'optimizer[blog_cat_id]'
)) );

//Blog Page Post Count
$wp_customize->add_setting('optimizer[blog_num_id]', array(
	'type' => 'option',
	'default' => '9',
	'sanitize_callback' => 'optimizer_sanitize_number',
) );
			$wp_customize->add_control('blog_num_id', array(
				'type' => 'text',
				'label' => __('Blog Page Posts Count *','optimizer'),
				'section' => 'blogpage_section',
				'settings' => 'optimizer[blog_num_id]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );

//Blog LAYOUT SELECT
$wp_customize->add_setting('optimizer[blog_layout_id]', array(
		'type' => 'option',
        'default' => '1',
		'sanitize_callback' => 'optimizer_sanitize_number'
) );
 
			$wp_customize->add_control( new Optimizer_Control_Radio_Image( $wp_customize, 'blog_layout_id', array(
					'type' => 'radio-image',
					'label' => __('Blog Page Layout *','optimizer'),
					'section' => 'blogpage_section',
					'settings' => 'optimizer[blog_layout_id]',
					'choices' => array(
						'1' => array( 'url' => get_template_directory_uri().'/assets/images/blog_layout1.png', 'label' => 'Blog Layout 1' ),
						'2' => array( 'url' => get_template_directory_uri().'/assets/images/blog_layout2.png', 'label' => 'Blog Layout 2' ),
						'3' => array( 'url' => get_template_directory_uri().'/assets/images/blog_layout3.png', 'label' => 'Blog Layout 3' ),
						'4' => array( 'url' => get_template_directory_uri().'/assets/images/blog_layout4.png', 'label' => 'Blog Layout 4' ),
						'5' => array( 'url' => get_template_directory_uri().'/assets/images/blog_layout5.png', 'label' => 'Blog Layout 4' ),
					),
			) ));


///Blog Page Thumbnails
$wp_customize->add_setting('optimizer[show_blog_thumb]', array(
	'type' => 'option',
	'default' => '1',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
 
				$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'show_blog_thumb', array(
					'label' => __('Blog Page Thumbnails *','optimizer'),
					'section' => 'blogpage_section',
					'settings' => 'optimizer[show_blog_thumb]',
				)) );



//----------------------CONTACT PAGE SECTION----------------------------------


//Contact Page email Address
$wp_customize->add_setting('optimizer[contact_email_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'sanitize_email',
) );
			$wp_customize->add_control('contact_email_id', array(
				'type' => 'text',
				'label' => __('Contact Page email Address *','optimizer'),
				'section' => 'contactpage_section',
				'settings' => 'optimizer[contact_email_id]',
			) );

//Contact Page Lattitude/Logitude
$wp_customize->add_setting('optimizer[contact_latlong_id]', array(
	'type' => 'option',
	'default' => '53.359286, -2.040904',
	'sanitize_callback' => 'sanitize_text_field',
) );
			$wp_customize->add_control('contact_latlong_id', array(
				'type' => 'text',
				'label' => __('Contact Page Map Latitude and Longitude *','optimizer'),
				'description' => __( 'Latitude and Longitude should be separated by comma. eg: 53.359286 , -2.040904 To find your location\'s latitude and longitude, use <a target="_blank" href="http://www.doogal.co.uk/LatLong.php">this website</a>', 'optimizer' ),
				'section' => 'contactpage_section',
				'settings' => 'optimizer[contact_latlong_id]',
			) );

//Contact Page Address
$wp_customize->add_setting('optimizer[contact_location_id]', array(
	'type' => 'option',
	'default' => 'Automattic, Inc. 60 29th Street #343 San Francisco, California 94110-4929 USA',
	'sanitize_callback' => 'wp_kses_post',
) );
			$wp_customize->add_control('contact_location_id', array(
				'type' => 'textarea',
				'label' => __('Contact Page Map Bubble Text *','optimizer'),
				'section' => 'contactpage_section',
				'settings' => 'optimizer[contact_location_id]',
			) );


///Contact page Sidebar
$wp_customize->add_setting('optimizer[contact_sidebar]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
) );
 
			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'contact_sidebar', array(
				'label' => __('Show Sidebar in Contact page *','optimizer'),
				'section' => 'contactpage_section',
				'settings' => 'optimizer[contact_sidebar]',
			)) );

//Contact Form Redirect Url
$wp_customize->add_setting('optimizer[contactredirect]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'esc_url_raw',
) );
			$wp_customize->add_control('contactredirect', array(
				'type' => 'text',
				'label' => __('Redirect to this page after Submission *','optimizer'),
				'section' => 'contactpage_section',
				'settings' => 'optimizer[contactredirect]',
			) );


//Contact Form GDPR
$wp_customize->add_setting('optimizer[gdpr_policy]', array(
	'type' => 'option',
	'default' => 'I agree with this Site\'s Privacy Policy',
	'sanitize_callback' => 'wp_kses_post',
) );
			$wp_customize->add_control('gdpr_policy', array(
				'type' => 'text',
				'label' => __('GDPR Consent Checkbox Text','optimizer'),
				'section' => 'contactpage_section',
				'description' => __( 'Clear This field to hide the GDPR Checkbox' ),
				'settings' => 'optimizer[gdpr_policy]',
			) );

//---------Post & Page Color SETTINGS---------------------	

//Post Title Font Size
$wp_customize->add_setting('optimizer[ptitle_size_id]', array(
	'type' => 'option',
	'default' => '32px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('ptitle_size_id', array(
				'type' => 'text',
				'label' => __('Post Title Font Size','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[ptitle_size_id]',
			) );


//Post Title Color
$wp_customize->add_setting( 'optimizer[title_txt_color_id]', array(
	'type' => 'option',
	'default' => '#666666',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'title_txt_color_id', array(
				'label' => __('Post Title Color','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[title_txt_color_id]',
			) ) );
			
			
//Post Title Color
$wp_customize->add_setting( 'optimizer[heading_color_id]', array(
	'type' => 'option',
	'default' => '#666666',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_color_id', array(
				'label' => __('h1, h2, h3, h4, h5, h6 Color','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[heading_color_id]',
			) ) );


//Link Color (Regular)
$wp_customize->add_setting( 'optimizer[link_color_id]', array(
	'type' => 'option',
	'default' => '#3590ea',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_id', array(
				'label' => __('Link Color (Regular)','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[link_color_id]',
			) ) );

//Link Color (HOVER)
$wp_customize->add_setting( 'optimizer[link_color_hover]', array(
	'type' => 'option',
	'default' => '#1e73be',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
				'label' => __('Links Color (Hover)','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[link_color_hover]',
			) ) );



//---------SOCIAL SHARE SETTINGS------------------------------

//Display Share Icons on Pages too
$wp_customize->add_setting('optimizer[social_page_id]', array(
	'type' => 'option',
	'default' => '',
	'sanitize_callback' => 'optimizer_sanitize_checkbox',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'social_page_id', array(
				'label' => __('Display Share Icons on Pages','optimizer'),
				'section' => 'socialshare_section',
				'settings' => 'optimizer[social_page_id]',
			)) );


//Social Share Icons Position
$wp_customize->add_setting('optimizer[share_position]', array(
		'type' => 'option',
        'default' => 'after',
		'sanitize_callback' => 'optimizer_sanitize_choices',
) );
 
			$wp_customize->add_control('share_position', array(
					'type' => 'select',
					'label' => __('Social Share Icons Position *','optimizer'),
					'section' => 'socialshare_section',
					'settings' => 'optimizer[share_position]',
					'choices' => array(
						  'left' => __( 'Left', 'optimizer' ),
						  'before' => __( 'Before Content', 'optimizer' ),
						  'after' => __( 'After Content', 'optimizer' ),
					),
			) );


//Share This Label
$wp_customize->add_setting('optimizer[share_label]', array(
	'type' => 'option',
	'default' => __('Share This','optimizer'),
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('share_label', array(
				'type' => 'text',
				'label' => __('Share This Label','optimizer'),
				'section' => 'socialshare_section',
				'settings' => 'optimizer[share_label]',
							'input_attrs'	=> array(
								'class'	=> 'mini_control',
							)
			) );



//LAYOUT SELECT
$wp_customize->add_setting('optimizer[share_button_style]', array(
		'type' => 'option',
        'default' => 'round',
		'sanitize_callback' => 'sanitize_key',
		'transport' => 'postMessage',
) );
 
			$wp_customize->add_control( new Optimizer_Control_Radio_Image( $wp_customize, 'share_button_style', array(
					'type' => 'radio-image',
					'label' => __('Share Button Style','optimizer'),
					'section' => 'socialshare_section',
					'settings' => 'optimizer[share_button_style]',
					'choices' => array(
						'round' => array( 'url' => '%s/assets/images/social/round.png', 'label' => 'Round' ),
						'square' => array( 'url' => '%s/assets/images/social/square.png', 'label' => 'Square' ),
						'hexagon' => array( 'url' => '%s/assets/images/social/hexagon.png', 'label' => 'Hexagon' ),
						'round_color' => array( 'url' => '%s/assets/images/social/round_color.png', 'label' => 'Rounded (Colored)' ),
						'square_color' => array( 'url' => '%s/assets/images/social/square_color.png', 'label' => 'Square (Colored)' ),
						'hexagon_color' => array( 'url' => '%s/assets/images/social/hexagon_color.png', 'label' => 'Hexagon (Colored)' ),
					),
			) ));



//---------SIDEBAR & WIDGET Color SETTINGS---------------------	

//Sidebar Widgets Background Color
$wp_customize->add_setting( 'optimizer[sidebar_color_id]', array(
	'type' => 'option',
	'default' => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_color_id', array(
				'label' => __('Sidebar Widgets Background','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[sidebar_color_id]',
			) ) );


//Sidebar Widget Title Color
$wp_customize->add_setting( 'optimizer[sidebar_tt_color_id]', array(
	'type' => 'option',
	'default' => '#666666',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_tt_color_id', array(
				'label' => __('Sidebar Widget Title Color','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[sidebar_tt_color_id]',
			) ) );


//Sidebar Widget Text Color
$wp_customize->add_setting( 'optimizer[sidebartxt_color_id]', array(
	'type' => 'option',
	'default' => '#999999',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport' => 'postMessage',
) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebartxt_color_id', array(
				'label' => __('Sidebar Widget Text Color','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[sidebartxt_color_id]',
			) ) );


//Sidebar Widget Title Font Size
$wp_customize->add_setting('optimizer[wgttitle_size_id]', array(
	'type' => 'option',
	'default' => '16px',
	'sanitize_callback' => 'sanitize_text_field',
	'transport' => 'postMessage',
) );
			$wp_customize->add_control('wgttitle_size_id', array(
				'type' => 'text',
				'label' => __('Sidebar Widget Title Font Size','optimizer'),
				'section' => 'postpage_color_section',
				'settings' => 'optimizer[wgttitle_size_id]',
			) );


//CATEGORY LAYOUT SELECT
$wp_customize->add_setting('optimizer[cat_layout_id]', array(
		'type' => 'option',
        'default' => '1',
		'sanitize_callback' => 'optimizer_sanitize_choices',
) );
 
			$wp_customize->add_control( new Optimizer_Control_Radio_Image( $wp_customize, 'cat_layout_id', array(
					'type' => 'radio-image',
					'label' => __('Category & Archive Page layout *','optimizer'),
					'section' => 'category_section',
					'settings' => 'optimizer[cat_layout_id]',
					'choices' => array(
						'1' => array( 'url' => get_template_directory_uri().'/assets/images/layout1.png', 'label' => 'Layout 1' ),
						'2' => array( 'url' => get_template_directory_uri().'/assets/images/layout2.png', 'label' => 'Layout 2' ),
						'3' => array( 'url' => get_template_directory_uri().'/assets/images/layout3.png', 'label' => 'Layout 3' ),
						'4' => array( 'url' => get_template_directory_uri().'/assets/images/layout4.png', 'label' => 'Layout 4' ),
						'5' => array( 'url' => get_template_directory_uri().'/assets/images/layout5.png', 'label' => 'Layout 5' ),
					),
			) ));

//Search LAYOUT SELECT
$wp_customize->add_setting('optimizer[search_layout_id]', array(
   'type' => 'option',
     'default' => '1',
   'sanitize_callback' => 'optimizer_sanitize_choices',
) );

      $wp_customize->add_control( new Optimizer_Control_Radio_Image( $wp_customize, 'search_layout_id', array(
            'type' => 'radio-image',
            'label' => __('Search Page layout *','optimizer'),
            'section' => 'search_section',
            'settings' => 'optimizer[search_layout_id]',
            'choices' => array(
               '1' => array( 'url' => get_template_directory_uri().'/assets/images/layout1.png', 'label' => 'Layout 1' ),
               '2' => array( 'url' => get_template_directory_uri().'/assets/images/layout2.png', 'label' => 'Layout 2' ),
               '3' => array( 'url' => get_template_directory_uri().'/assets/images/layout3.png', 'label' => 'Layout 3' ),
               '4' => array( 'url' => get_template_directory_uri().'/assets/images/layout4.png', 'label' => 'Layout 4' ),
               //'5' => array( 'url' => get_template_directory_uri().'/assets/images/layout5.png', 'label' => 'Layout 5' ),
            ),
      ) ));
      //Hide Post Thumbnail
      $wp_customize->add_setting('optimizer[hide_search_thumbnail]', array(
         'type' => 'option',
         'default' => '',
         'sanitize_callback' => 'optimizer_sanitize_checkbox',
      ) );
      
         $wp_customize->add_control( new Optimizer_Controls_Toggle_Control( $wp_customize, 'hide_search_thumbnail', array(
            'label' => __('Hide Post Thumbnail','optimizer'),
            'section' => 'search_section',
            'settings' => 'optimizer[hide_search_thumbnail]',
            'active_callback' => 'optimizer_search_layout_callback',
         )) );


function optimizer_post_info_callback( $control ) {
   $layout_setting = $control->manager->get_setting('optimizer[post_info_id]')->value();
      
   if ( $layout_setting == '1' ) return true;
      
   return false;
}

function optimizer_search_layout_callback( $control ) {
   $layout_setting = $control->manager->get_setting('optimizer[search_layout_id]')->value();
      
   if ( $layout_setting == '2' || $layout_setting == '3' || $layout_setting == '4' ) return true;
      
   return false;
}