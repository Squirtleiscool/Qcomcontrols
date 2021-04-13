<?php
add_action( 'init', 'optimizer_convert_redux' );
function optimizer_convert_redux() {

	
if(isset($_POST['convert']) && check_admin_referer( 'optimizer_convert', 'optimizer_convert' ) ) {
	$optimizer = get_option('optimizer');
	$active_widgets = get_option( 'sidebars_widgets' );
	$home_blocks = $optimizer['home_sort_id'];

if ($home_blocks):

foreach ($home_blocks as $key=>$value) {

    switch($key) {
	//About Section
    case 'about':
		if(!empty($home_blocks['about'])){
				//ABOUT SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_about-1';
				// The latest 15 questions from WordPress Stack Exchange.
				$about_content[ 1 ] = array (
					'title' => $optimizer['about_header_id'],
					'subtitle' => $optimizer['about_preheader_id'],
					'content' => $optimizer['about_content_id'],
					'divider' => $optimizer['divider_icon'],
					'title_color' => $optimizer['about_header_color'],
					'content_color' => $optimizer['about_text_color'],
					'content_bg' => $optimizer['about_bg_color'],
					'content_bgimg' => $optimizer['about_bg_image']['url'],
				);
				update_option( 'widget_optimizer_front_about', $about_content );
		}
	
	break;
    case 'blocks':
		if(!empty($home_blocks['blocks'])){
				//BLOCKS SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_blocks-1';
				// The latest 15 questions from WordPress Stack Exchange.
				$blocks_content[ 1 ] = array (
					'block1title' => $optimizer['block1_text_id'],
					'block1img' => $optimizer['block1_image']['url'],
					'block1content' =>  $optimizer['block1_textarea_id'],
					'block2title' => $optimizer['block2_text_id'],
					'block2img' => $optimizer['block2_image']['url'],
					'block2content' =>  $optimizer['block2_textarea_id'],
					'block3title' => $optimizer['block3_text_id'],
					'block3img' => $optimizer['block3_image']['url'],
					'block3content' => $optimizer['block3_textarea_id'],
					'block4title' => $optimizer['block4_text_id'],
					'block4img' => $optimizer['block4_image']['url'],
					'block4content' => $optimizer['block4_textarea_id'],
					'block5title' => $optimizer['block5_text_id'],
					'block5img' => $optimizer['block5_image']['url'],
					'block5content' => $optimizer['block5_textarea_id'],
					'block6title' => $optimizer['block6_text_id'],
					'block6img' => $optimizer['block6_image']['url'],
					'block6content' => $optimizer['block6_textarea_id'],
					
					'blockstitlecolor' => $optimizer['blocktitle_color_id'],
					'blockstxtcolor' => $optimizer['blocktxt_color_id'],
					'blocksbgcolor' => $optimizer['midrow_color_id'],
					'blocksbgimg' => $optimizer['blocks_bgimg']['url'],
				);
				update_option( 'widget_optimizer_front_blocks', $blocks_content );
				
		}
	break;
	
	
	case 'welcome-text':
		if(!empty($home_blocks['welcome-text'])){
				//WELCOME TEXT SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_text-1';
				// The latest 15 questions from WordPress Stack Exchange.
				$text_content[ 1 ] = array (
					'title' => __('Welcome Text','optimizer'),
					'content' => $optimizer['welcm_textarea_id'],
					'padtopbottom' => '2',
					'paddingside' => '2',
					'parallax' => '',
					'content_color' => $optimizer['welcometxt_color_id'],
					'content_bg' => $optimizer['welcome_color_id'],
					'content_bgimg' => $optimizer['welcome_bg_image']['url'],
				);
				//Updated Below --With Newsletter Widget
				if(empty($home_blocks['newsletter'])){
					update_option( 'widget_optimizer_front_text', $text_content );	
				}
				
		}
	break;
	
	
	case 'posts':
		if(!empty($home_blocks['posts'])){
				//POSTS SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_posts-1';
				// The latest 15 questions from WordPress Stack Exchange.
				$posts_content[ 1 ] = array (
					'title' => $optimizer['posts_title_id'],
					'subtitle' => $optimizer['posts_subtitle_id'],
					'layout' => $optimizer['front_layout_id'],
					'type' => $optimizer['n_posts_type_id'],
					'pages' => $optimizer['n_pages_id'],
					'count' => $optimizer['n_posts_field_id'],
					'category' => $optimizer['posts_cat_id'],
					'previewbtn' => $optimizer['post_zoom'],
					'linkbtn' => $optimizer['post_readmo'],
					'divider' => $optimizer['divider_icon'],
					'navigation' => $optimizer['navigation_type'],
					'postbgcolor' => $optimizer['frontposts_color_id'],
					'titlecolor' => $optimizer['frontposts_title_color'],
					'secbgcolor' => $optimizer['frontposts_bg_color'],
				);
				update_option( 'widget_optimizer_front_posts', $posts_content );
		}
	break;
	
	
	case 'call-to-action':
		if(!empty($home_blocks['call-to-action'])){
				//CTA SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_cta-1';
				// The latest 15 questions from WordPress Stack Exchange.
				$cta_content[ 1 ] = array (
					'title' => __('Converted CTA','optimizer'),
					'content' => $optimizer['call_textarea_id'],
					'buttontxt' => $optimizer['call_text_id'],
					'buttonlink' => $optimizer['call_url_id'],
					'buttonalign' => $optimizer['cta_button_align'],
					'buttonstyle' => $optimizer['cta_button_style'],
					'buttontxtcolor' => $optimizer['callbttntext_color_id'],
					'buttonbgcolor' => $optimizer['callbttn_color_id'],
					'ctatxtcolor' => $optimizer['calltxt_color_id'],
					'ctabgcolor' => $optimizer['callbg_color_id'],
					'ctabgimg' => $optimizer['cta_bg_image']['url'],
				);
				update_option( 'widget_optimizer_front_cta', $cta_content );
		}
	break;
	
	
	
	case 'testimonials':
		if(!empty($home_blocks['testimonials'])){
				//TESTIMONIALS SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_testimonials-1';
				// Convert Custom Testimonials Array
					$custom_testi = $optimizer['custom_testi'];

					if(!empty($custom_testi)){
						foreach ( $custom_testi as $k=>$v )
						{
	  						$custom_testi[$k] ['testimonial'] = $custom_testi[$k] ['description'];
							unset($custom_testi[$k]['description']);
							unset($custom_testi[$k]['sort']);
							unset($custom_testi[$k]['attachment_id']);
							unset($custom_testi[$k]['thumb']);
							unset($custom_testi[$k]['height']);
							unset($custom_testi[$k]['width']);
						}
						
						$testimonials = $custom_testi;
					}else{
						$testimonials = '';
					}
					
				// TWITTER Testimonials Array
					$tweets = $optimizer['twitter_testimonial'];

					if(!empty($tweets)){
						$newTweets = array();
						foreach($tweets as $key => $value) {
							$newTweets[$key]['url'] = $value;
						}
						
						$convertedtweets = $newTweets;
					}else{
						$convertedtweets = '';
					}

				$testi_content[ 1 ] = array (
					'title' => $optimizer['testi_title_id'],
					'subtitle' => $optimizer['testi_subtitle_id'],
					'custom_testi' => $testimonials,
					'twitter_testi_on' => $optimizer['twitter_testi_on'],
					'twitter_testi' => $convertedtweets,
					'testi_layout' => $optimizer['testi_layout'],
					'divider' => $optimizer['divider_icon'],
					'title_color' => $optimizer['testi_color_id'],
					'content_bg' => $optimizer['testi_bg_color'],
					'content_bgimg' => $optimizer['testi_bg_image']['url'],
				);
				update_option( 'widget_optimizer_front_testimonials', $testi_content );	
				
		}	
	break;
	
	
	
	case 'location-map':
		if(!empty($home_blocks['location-map'])){
				//MAP SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_map-1';
					// Convert Clients Logo Array
					$maps = $optimizer['map_markers'];

					if(!empty($maps)){
						foreach ( $maps as $k=>$v )
						{
	  						$maps[$k] ['latlong'] = $maps[$k] ['url'];
	  						unset($maps[$k]['url']);
							unset($maps[$k]['image']);
							unset($maps[$k]['sort']);
							unset($maps[$k]['attachment_id']);
							unset($maps[$k]['thumb']);
							unset($maps[$k]['height']);
							unset($maps[$k]['width']);
						}
						
					$locations = $maps;
					}else{
						
					$locations = '';
					}
				$map_content[ 1 ] = array (
					'title' => $optimizer['map_title_id'],
					'subtitle' => $optimizer['map_subtitle_id'],
					'locations' => $locations,
					'height' => $optimizer['map_height'],
					'divider' => $optimizer['divider_icon'],
					'title_color' => $optimizer['map_title_color'],
					'content_bg' => $optimizer['map_bg_color'],
					'style' => 'map_default',
					'zoom' => '2',
				);
				update_option( 'widget_optimizer_front_map', $map_content );
		}
	break;
	
	
	case 'newsletter':
		if(!empty($home_blocks['newsletter'])){
				//NEWSLETTER SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_text-2';
				// The latest 15 questions from WordPress Stack Exchange.
				$text_content[ 2 ] =array (
					'title' => __('Converted Newsletter','optimizer'),
					'content' => '<h3 style="text-align: center;">'.$optimizer['newsletter_title_id'].'</h3><p style="text-align: center;">'.$optimizer['newsletter_subtitle_id'].'</p>'.$optimizer['newsletter_form_id'],
					'padtopbottom' => '2',
					'paddingside' => '2',
					'parallax' => '',
					'content_color' => $optimizer['newsletter_txt_color'],
					'content_bg' => $optimizer['newsletter_bg_color'],
					'content_bgimg' => $optimizer['newsletter_bg_image']['url'],
				);
				update_option( 'widget_optimizer_front_text', $text_content );	
				
		}
	break;
	
	
	
	case 'client-logos':
		if(!empty($home_blocks['client-logos'])){
				//CLIENTS SECTION--------------------------------------------
				$active_widgets[ 'front_sidebar' ][] = 'optimizer_front_clients-1';
					// Convert Clients Logo Array
					$elem = $optimizer['client_logo'];

					if(!empty($elem)){
						foreach ($elem as $key => $subArr) {
							unset($subArr['description']);
							unset($subArr['sort']);
							unset($subArr['attachment_id']);
							unset($subArr['thumb']);
							unset($subArr['height']);
							unset($subArr['width']);
							$data[$key] = $subArr;  
						}
						
					$clients = $data;
					}else{
						
					$clients = '';
					}

				
				$clients_content[ 1 ] = array (
					'title' => $optimizer['client_title_id'],
					'subtitle' => $optimizer['client_subtitle_id'],
					'clients' => $clients,
					'title_color' => $optimizer['client_title_color'],
					'content_bg' => $optimizer['client_bg_color'],
				);
				update_option( 'widget_optimizer_front_clients', $clients_content );
		}
	break;
	
	
    } //end of SWITCH

} //end of FOREACH

endif;
		
	
	
		//Assign Widgets to frontpage sidebar
		update_option( 'sidebars_widgets', $active_widgets );
		
		//Convert Redux Sidebars to comma separated list from array
		if(!empty($optimizer['custom_sidebar'])){
			$optimizer['custom_sidebar'] = implode(',', $optimizer['custom_sidebar']);
		}
		

		
		//Update Nivo/Accordion Slider------------
		if(!empty($optimizer['slides'])){
			//$nivoacc = array();
			$slides = $optimizer['slides'];
			
			//Update attachments with Title,description, button text, button link
			foreach($slides as $slide){
				wp_update_post(array('ID' => absint($slide['attachment_id']), 'post_title'  => esc_attr($slide['title']), 'post_content' => esc_url_raw($slide['url']), 'post_excerpt' => wp_kses_post($slide['description']) ));
				update_post_meta( absint($slide['attachment_id']), '_wp_attachment_image_alt', $slide['button_text'] );
			}
			
			//convert old slides attachment id to new comma separated list
			$sids = array();
			foreach($slides as $slide) $sids[] = $slide['attachment_id'];
			$attlist = implode(",",$sids);
			//Set New atachments to new slider
			$optimizer['nivo_accord_slider'] = $attlist;
		}
		
		
		//Update convert =1  and Nivo/Accordion Slides
		$optimizer['converted'] = '1';
		update_option( 'optimizer', $optimizer );
	
		//After Conversion Redirect to Customizer
        $redirect = admin_url('/customize.php'); 
		wp_redirect( $redirect);
	}
}