<?php
/**
 * The Core Functions for LayerFramework
 *
 * These core functions are the main feature of the LayerFramework.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
 
/*********************
WP_HEAD GOODNESS
removes all the junk from the header of the site and make it fast.
*********************/
if ( ! function_exists( 'optimizer_head_cleanup' ) ) {
function optimizer_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	//Remove WP VERSION
	remove_action( 'wp_head', 'wp_generator' );
	// Remove capital_P_dangit function
	remove_filter( 'the_title', 'capital_P_dangit', 11 );
	remove_filter( 'the_content', 'capital_P_dangit', 11 );
	remove_filter( 'comment_text', 'capital_P_dangit', 31 );
	// remove WP version from css
	add_filter( 'style_loader_src', 'optimizer_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'optimizer_remove_wp_ver_css_js', 9999 );
}
} /* end bones head cleanup */
add_action( 'init', 'optimizer_head_cleanup' );


// remove WP version from RSS
function optimizer_rss_version() { return ''; }
// remove WP version from scripts
function optimizer_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}


//CONTENT WIDTH
if ( ! function_exists( 'optimizer_content_width' ) ) {
function optimizer_content_width() {
	global $content_width;
	$full_width = is_page_template( 'page-fullwidth_template.php' );
	if ( $full_width ) {
		$content_width = 1100;
	}else {
		$content_width = 690;
	}
}
}
add_action( 'template_redirect', 'optimizer_content_width' );

//UPDATED: GET THE FIRST IMAGE
if ( ! function_exists( 'optimizer_first_image' ) ) {
function optimizer_first_image() {
	if(is_404()){
		return;
	}
	global $wp_query;
/*	if( $wp_query->post_count <1){
		return;
	}*/
		global $post, $posts;
      $image_url = '';
      if(!$post){ return $image_url; }
		ob_start();
		ob_end_clean();
		if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)){;
		$image_url = $matches [1] [0];
		}
	return $image_url;
}
}
//SEO EXCERPT to Display the META DESCRIPTION
function optimizer_seo_excerpt( $post_id, $excerpt_length = 15, $trailing_character = '' ) {
    $the_post = get_post( $post_id );
    $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_excerpt ) );
 
    if ( empty( $the_excerpt ) )
	  $the_excerpt = strip_tags( strip_shortcodes( $the_post->post_content ) );
 
  $the_excerpt = substr($the_excerpt, 0, $excerpt_length);
  $the_excerpt = substr($the_excerpt, 0, strripos($the_excerpt, " "));
  $the_excerpt = rtrim($the_excerpt,",.;:- _!$&#");
  $the_excerpt = str_replace("\n", '', $the_excerpt);
    return $the_excerpt;
}


//optimizer Site title
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function optimizer_wp_title( $title, $sep ) {
		global $paged, $page;
	
		if ( is_feed() )
			return $title;
	
		// Add the site name.
		$title .= get_bloginfo( 'name' );
		$sep ='|';
		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
	
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'optimizer' ), max( $paged, $page ) );
	
		return $title;
	}
	add_filter( 'wp_title', 'optimizer_wp_title', 10, 2 );
}


//NESTED HAS_SHORTCODE Function
//SEE: https://core.trac.wordpress.org/ticket/26343
function optimizer_has_shortcode( $content, $tag ) {
	        if ( shortcode_exists( $tag ) ) {
	                preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
	                if ( empty( $matches ) )
	                        return false;
	
	                foreach ( $matches as $shortcode ) {
                        if ( $tag === $shortcode[2] ) {
                                 return true;
                        } elseif ( isset( $shortcode[5] ) && optimizer_has_shortcode( $shortcode[5], $tag ) ) {
                                return true;
                        }
	                }
	        }
	        return false;
	}

//Custom Excerpt Length
if(!function_exists( 'optimizer_excerptlength_teaser' ) ){
	function optimizer_excerptlength_teaser($length) {
		return 20;
	}
}
if(!function_exists( 'optimizer_excerptlength_index' ) ){
	function optimizer_excerptlength_index($length) {
		return 12;
	}
}
if(!function_exists( 'optimizer_excerptmore' ) ){
	function optimizer_excerptmore($more) {
		return '...';
	}
}

if(!function_exists( 'optimizer_excerpt' ) ){
	function optimizer_excerpt($length_callback='', $more_callback='') {
		if(function_exists($length_callback)){
			add_filter('excerpt_length', $length_callback);
		}
		if(function_exists($more_callback)){
			add_filter('excerpt_more', $more_callback);
		}
		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = '<p>'.$output.'</p>';
		echo $output;
	}
}
//Get Attachment data
function optimizer_get_attachment( $attachment_id ) {

$attachment = get_post( $attachment_id );
return array(
    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
    'caption' => $attachment->post_excerpt,
    'description' => $attachment->post_content,
    'href' => get_permalink( $attachment->ID ),
    'src' => $attachment->guid,
    'title' => $attachment->post_title
);
}


//hex to rgb function
function optimizer_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
 
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

//rgb to hsl function
function optimizer_rgb2hsl( $r, $g, $b ) {
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	$r /= 255;
	$g /= 255;
	$b /= 255;
    $max = max( $r, $g, $b );
	$min = min( $r, $g, $b );
	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;
    	if( $d == 0 ){
        	$h = $s = 0; // achromatic
    	} else {
        	$s = $d / ( 1 - abs( 2 * $l - 1 ) );
		switch( $max ){
	            case $r:
	            	$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
                        if ($b > $g) {
	                    $h += 360;
	                }
	                break;
	            case $g: 
	            	$h = 60 * ( ( $b - $r ) / $d + 2 ); 
	            	break;
	            case $b: 
	            	$h = 60 * ( ( $r - $g ) / $d + 4 ); 
	            	break;
	        }			        	        
	}
	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}


//User Social Fields
// Use the user_contactmethods to add new fields
add_filter( 'user_contactmethods', 'optimizer_user_contactmethods' );

$extra_fields =  array( 
					array( 'facebook', __('Facebook', 'optimizer'), true ),
					array( 'twitter', __('Twitter', 'optimizer'), true ),
					array( 'googleplus', __('Google+', 'optimizer'), true ),
					array( 'linkedin', __('Linked In', 'optimizer'), false ),
					array( 'pinterest', __('Pinterest', 'optimizer'), false ),
					array( 'instagram', __('Instagram', 'optimizer'), false ),
					array( 'dribble', __('Dribble', 'optimizer'), false ),
					array( 'behance', __('Behance', 'optimizer'), false ),
					);

function optimizer_user_contactmethods( $user_contactmethods ) {

	// Get fields
	global $extra_fields;
	
	// Display each fields
	foreach( $extra_fields as $field ) {
		if ( !isset( $contactmethods[ $field[0] ] ) )
    		$user_contactmethods[ $field[0] ] = $field[1];
	}

    // Returns the contact methods
    return $user_contactmethods;
}

/*Optimizer Color Sanitization*/
function optimizer_sanitize_hex( $color = '#FFFFFF', $hash = true ) {
		$color = trim( $color );
		$color = str_replace( '#', '', $color );
		if ( 3 == strlen( $color ) ) {
			$color = substr( $color, 0, 1 ) . substr( $color, 0, 1 ) . substr( $color, 1, 1 ) . substr( $color, 1, 1 ) . substr( $color, 2, 1 ) . substr( $color, 2, 1 );
		}

		$substr = array();
		for ( $i = 0; $i <= 5; $i++ ) {
			$default    = ( 0 == $i ) ? 'F' : ( $substr[$i-1] );
			$substr[$i] = substr( $color, $i, 1 );
			$substr[$i] = ( false === $substr[$i] || ! ctype_xdigit( $substr[$i] ) ) ? $default : $substr[$i];
		}
		$hex = implode( '', $substr );

		return ( ! $hash ) ? $hex : '#' . $hex;

}

// allow script & iframe tag within posts
if ( ! function_exists( 'optimizer_allow_html' ) ) {
function optimizer_allow_html( $allowedposttags ){
	global $allowedposttags;
    $allowedposttags['script'] = array(
        'type' => true,
        'src' => true,
        'height' => true,
        'width' => true,
    );
    $allowedposttags['div'] = array(
        'id' => true,
        'class' => true,
        'style' => true,
        'onclick' => true,
		'tabindex' => true,
    );
    $allowedposttags['form'] = array(
        'id' => true,
        'class' => true,
        'action' => true,
        'method' => true,
        'name' => true,
        'style' => true,
        'target' => true,
		'novalidate' => true,
    );
    $allowedposttags['input'] = array(
        'id' => true,
        'class' => true,
        'name' => true,
        'style' => true,
        'placeholder' => true,
		'tabindex' => true,
		'type' => true,
		'value' => true,
    );
    $allowedposttags['button'] = array(
        'id' => true,
        'class' => true,
        'name' => true,
        'style' => true,
		'tabindex' => true,
		'type' => true,
		'value' => true,
    );
    $allowedposttags['textarea'] = array(
        'id' => true,
        'class' => true,
        'name' => true,
        'style' => true,
		'tabindex' => true,
		'type' => true,
    );
    $allowedposttags['style'] = array(
        'id' => true,
        'class' => true,
        'name' => true,
        'style' => true,
		'type' => true,
    );

    return $allowedposttags;
}
}
add_filter('wp_kses_allowed_html','optimizer_allow_html', 1);


//**Return an ID of an attachment by searching the database with the file URL (Inexpensive query)**//
function optimizer_attachment_id_by_url( $url ) {
   $attachment = attachment_url_to_postid( $url );
	return $attachment;
}

//Get Image alt from image src
function optimizer_image_alt( $attachment ) {
	$imgid = optimizer_attachment_id_by_url($attachment);
	
	if($imgid){
		$imgaltraw = wp_prepare_attachment_for_js($imgid); 
		$imgalt = $imgaltraw['alt'];
		if(!empty($imgalt)){ $imgalt = 'alt="'.$imgaltraw['alt'].'"'; }
		
	}else{
		$imgalt = '';
	}
	
	return $imgalt;
}

//Get Image width/height from image src
function optimizer_image_attr( $attachment ) {
	$imgid = optimizer_attachment_id_by_url($attachment);
	
	if($imgid){
		$imgaltraw = wp_prepare_attachment_for_js($imgid); 
		$imgwidth = $imgaltraw['width'];
		$imgheight = $imgaltraw['height'];
		if(!empty($imgwidth)){ $imgwidth = 'width="'.$imgaltraw['width'].'"'; }
		if(!empty($imgheight)){ $imgheight = 'height="'.$imgaltraw['height'].'"'; }
		
	}else{
		$imgwidth = '';
		$imgheight = '';
	}
	
	return $imgwidth.' '.$imgheight;
}

//Allow all HTMl for Newsletter Widget Form Field
function optimizer_sanitize_html($content ) {
	return $content;
}

//CURL fle get content function. Required for preset import
if ( ! function_exists( 'curl_get_contents' ) ) {
	function curl_get_contents ($Url) {}
}

function optimizer_get_instagram_media($token, $user, $limit = 10, $fields = 'media_url,permalink,media_type,caption', $restrict = [ 'IMAGE' ]) {
   // The request URL. see: https://developers.facebook.com/docs/instagram-basic-display-api/reference/user
   if(!$token || !$user){ return array(); }
	$request_url = 'https://graph.instagram.com/' . $user . '?fields=media&access_token=' . $token;

	$output = get_transient( 'optimizer_instagram_feed_' . $user ); // Our transient should have a unique name, so we pass the user id as an extra precaution.
	if ( false === ( $data = $output ) || empty( $output ) ) {
		// Prepare the data variable and set it as an empty array.
		$data = [];
		// Make the request
		$response      = wp_safe_remote_get( $request_url );
		$response_body = '';
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$response_body = json_decode( $response['body'] );
		}
		if ( $response_body && isset( $response_body->media->data ) ) {
			$i = 0;
			// Get each media item from it's ID and push it to the $data array.
			foreach ( $response_body->media->data as $media ) {
				if ( $limit > $i ) {
					$request_media_url = 'https://graph.instagram.com/' . $media->id . '?fields=' . $fields . '&access_token=' . $token;
					$media_response    = wp_safe_remote_get( $request_media_url );
					if ( is_array( $media_response ) && ! is_wp_error( $media_response ) ) {
						$media_body = json_decode( $media_response['body'] );
					}
					if ( in_array( $media_body->media_type, $restrict, true ) ) {
						$i ++;
						$data[] = $media_body;
					}
				}
			}
		}
		// Store the data in the transient and keep if for an hour.
		set_transient( 'optimizer_instagram_feed_' . $user, $data, HOUR_IN_SECONDS );

		// Refresh the token to make sure it never expires 
		wp_safe_remote_get( 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=' . $token );
		$output = $data;
	}

	return $output;

}

function optimizer_get_widget_data($sidebar_id) {
	global $wp_registered_sidebars, $wp_registered_widgets;
	
	// Holds the final data to return
	$output = array();
	
	if( !$sidebar_id ) {
		// There is no sidebar registered with the name provided.
		return $output;
	} 
	
	// A nested array in the format $sidebar_id => array( 'widget_id-1', 'widget_id-2' ... );
	$sidebars_widgets = wp_get_sidebars_widgets();
	$widget_ids = isset($sidebars_widgets[$sidebar_id]) ? $sidebars_widgets[$sidebar_id] : array();
	
	if( !$widget_ids ) {
		// Without proper widget_ids we can't continue. 
		return array();
	}
	
	// Loop over each widget_id so we can fetch the data out of the wp_options table.
	foreach( $widget_ids as $id ) {
		// The name of the option in the database is the name of the widget class.  
		$option_name = $wp_registered_widgets[$id]['callback'][0]->option_name;
		
		// Widget data is stored as an associative array. To get the right data we need to get the right key which is stored in $wp_registered_widgets
		$key = $wp_registered_widgets[$id]['params'][0]['number'];
		$widget_data = get_option($option_name);
		if(isset($wp_registered_widgets[$id]['name'])){
         $widget_data[$key]['widgetname'] = str_replace('&diams; ','',$wp_registered_widgets[$id]['name']);
      }
		// Add the widget data on to the end of the output array.
		$output[] = $widget_data[$key];
	}

   $finalWidgetContent = '';
   foreach( $output as $ar ) {

      // error_log(json_encode($ar));

      $finalWidgetContent .= '<div class="optimizer_widget" data-widgetname="'.(!empty($ar['widgetname']) ? esc_attr($ar['widgetname']) : '').'">';
         //Common Widget Content
         if(!empty($ar['title'])){    $finalWidgetContent .= '<h2>'.$ar['title'].'</h2>'; }
         if(!empty($ar['subtitle'])){  $finalWidgetContent .= '<i>'.$ar['subtitle'].'</i>';   }
         if(!empty($ar['desc'])){  $finalWidgetContent .= do_shortcode($ar['desc']); }
         if(!empty($ar['content'])){   $finalWidgetContent .= do_shortcode($ar['content']); }
         if(!empty($ar['text'])){   $finalWidgetContent .= do_shortcode($ar['text']); }

         //Blocks Widget Content
         if((isset($ar['block1title']) && !empty($ar['block1title']) || (isset($ar['block1content']) && !empty($ar['block1content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block1title']) && !empty($ar['block1title'])){   $finalWidgetContent .= '<h3>'.$ar['block1title'].'</h3>'; } if(!empty($ar['block1img'])){   $finalWidgetContent .= '<img src="'.$ar['block1img'].'" />'; } if(!empty($ar['block1content'])){   $finalWidgetContent .= $ar['block1content']; }
         if((isset($ar['block1title']) && !empty($ar['block1title']) || (isset($ar['block1content']) && !empty($ar['block1content'])) )){  $finalWidgetContent .= '</section>';}
         
         if((isset($ar['block2title']) && !empty($ar['block2title']) || (isset($ar['block2content']) && !empty($ar['block2content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block2title']) && !empty($ar['block2title'])){   $finalWidgetContent .= '<h3>'.$ar['block2title'].'</h3>'; } if(!empty($ar['block2img'])){   $finalWidgetContent .= '<img src="'.$ar['block2img'].'" />'; } if(!empty($ar['block2content'])){   $finalWidgetContent .= $ar['block2content']; }
         if((isset($ar['block2title']) && !empty($ar['block2title']) || (isset($ar['block2content']) && !empty($ar['block2content'])) )){  $finalWidgetContent .= '</section>';}

         if((isset($ar['block3title']) && !empty($ar['block3title']) || (isset($ar['block3content']) && !empty($ar['block3content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block3title']) && !empty($ar['block3title'])){   $finalWidgetContent .= '<h3>'.$ar['block3title'].'</h3>'; } if(!empty($ar['block3img'])){   $finalWidgetContent .= '<img src="'.$ar['block3img'].'" />'; } if(!empty($ar['block3content'])){   $finalWidgetContent .= $ar['block3content']; }
         if((isset($ar['block3title']) && !empty($ar['block3title']) || (isset($ar['block3content']) && !empty($ar['block3content'])) )){ $finalWidgetContent .= '</section>';}

         if((isset($ar['block4title']) && !empty($ar['block4title']) || (isset($ar['block4content']) && !empty($ar['block4content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block4title']) && !empty($ar['block4title'])){   $finalWidgetContent .= '<h3>'.$ar['block4title'].'</h3>'; } if(!empty($ar['block4img'])){   $finalWidgetContent .= '<img src="'.$ar['block4img'].'" />'; } if(!empty($ar['block4content'])){   $finalWidgetContent .= $ar['block4content']; }
         if((isset($ar['block4title']) && !empty($ar['block4title']) || (isset($ar['block4content']) && !empty($ar['block4content'])) )){  $finalWidgetContent .= '</section>';}

         if((isset($ar['block5title']) && !empty($ar['block5title']) || (isset($ar['block5content']) && !empty($ar['block5content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block5title']) && !empty($ar['block5title'])){   $finalWidgetContent .= '<h3>'.$ar['block5title'].'</h3>'; } if(!empty($ar['block5img'])){   $finalWidgetContent .= '<img src="'.$ar['block5img'].'" />'; } if(!empty($ar['block5content'])){   $finalWidgetContent .= $ar['block5content']; }
         if((isset($ar['block5title']) && !empty($ar['block5title']) || (isset($ar['block5content']) && !empty($ar['block5content'])) )){  $finalWidgetContent .= '</section>';}

         if((isset($ar['block6title']) && !empty($ar['block6title']) || (isset($ar['block6content']) && !empty($ar['block6content'])) )){  $finalWidgetContent .= '<section class="optimizer_widget_block">';}
         if(isset($ar['block6title']) && !empty($ar['block6title'])){   $finalWidgetContent .= '<h3>'.$ar['block6title'].'</h3>'; } if(!empty($ar['block6img'])){   $finalWidgetContent .= '<img src="'.$ar['block6img'].'" />'; } if(!empty($ar['block6content'])){   $finalWidgetContent .= $ar['block6content']; }
         if((isset($ar['block6title']) && !empty($ar['block6title']) || (isset($ar['block6content']) && !empty($ar['block6content'])) )){  $finalWidgetContent .= '</section>';}

         //Testimonial Widget
         if(isset($ar['custom_testi']) && is_array($ar['custom_testi']) && count($ar['custom_testi'])){ 
            foreach ((array)$ar['custom_testi']as $testimony){ 
               if(!empty($testimony['testimonial'])){
                  $finalWidgetContent .= '<section class="optimizer_widget_block optimizer_widget_block--testimonial">';
                     $finalWidgetContent .= '<p>'.$testimony['testimonial'].'</p>';
                     if(!empty($testimony['title'])){ $finalWidgetContent .= $testimony['title'];  }
                     if(!empty($testimony['occupation'])){ $finalWidgetContent .= ' / '.$testimony['occupation'];  }
                  $finalWidgetContent .= '</section>';
               }
            }
         }

         //Dynamic Widget
         if(isset($ar['carousel']) && is_array($ar['carousel']) && count($ar['carousel'])){ 
            $dynamicType = !empty($ar['type']) ? $ar['type'] : 'carousel';
            $finalWidgetContent .= '<div class="optimizer_widget_dynamic_wrap optimizer_widget_dynamic_wrap--'.$dynamicType.'">';
            foreach ((array)$ar['carousel'] as $index => $dynamic){ 
               if(!empty($dynamic['content'])){
                  $finalWidgetContent .= '<section class="optimizer_widget_block" data-widgetname="'.$dynamicType.' Item '.($index+1).'">';
                     if(!empty($dynamic['title'])){ $finalWidgetContent .= '<a>'.$dynamic['title'].'</a>';  }
                     if(!empty($dynamic['image'])){ $finalWidgetContent .= '<img src="'.$dynamic['image'].'" alt="'.(!empty($dynamic['title']) ? $dynamic['title'] : '').'" />'; }
                     $finalWidgetContent .= do_shortcode($dynamic['content']);
                  $finalWidgetContent .= '</section>';
               }
            }
            $finalWidgetContent .= '</div>';
         }

         
         //Brave Widgets
         if(!empty($ar['section_title'])){    $finalWidgetContent .= '<h2>'.$ar['section_title'].'</h2>'; }
         if(!empty($ar['slider_title'])){    $finalWidgetContent .= '<h1>'.$ar['slider_title'].'</h1>'; }
         if(!empty($ar['section_pretitle'])){  $finalWidgetContent .= '<i>'.$ar['section_pretitle'].'</i>';   }
         if(!empty($ar['section_content_right'])){   $finalWidgetContent .= do_shortcode($ar['section_content_right']); }
         if(!empty($ar['slider_content_right'])){   $finalWidgetContent .= do_shortcode($ar['slider_content_right']); }

         //Brave Tabs Widget
         if(isset($ar['items']) && is_array($ar['items']) && count($ar['items'])){ 
            foreach ((array)$ar['items']as $tab){ 
               if(!empty($tab['title']) && !empty($tab['content'])){
                  $finalWidgetContent .= '<section class="optimizer_widget_block">';
                     $finalWidgetContent .= '<a>'.$tab['title'].'</a>';
                     $finalWidgetContent .= do_shortcode($tab['content']);
                  $finalWidgetContent .= '</section>';
               }
            }
         }


      $finalWidgetContent .= '</div>';
	}

   //error_log(($finalWidgetContent));

	return $finalWidgetContent;
}

//Allow Widgetized Pages to appear in Search
add_filter( 'the_posts', function ( $posts, \WP_Query $wp_query ){
   if($wp_query && !empty($wp_query->query['s'])){
      $searchTerm = $wp_query->query['s'];
      $pages = get_pages(); 
      $matched_pages = array(); 
      foreach ( $pages as $page ) {
         $sidebarid = get_post_meta($page->ID, "page_sidebar", true);
         if( !empty($sidebarid) ){
           $widgetContent = optimizer_get_widget_data($sidebarid);
           //error_log($sidebarid.' : ');
           $widgetContent = isset($widgetContent) && is_string($widgetContent) ? $widgetContent : false;
           if($widgetContent && stripos($widgetContent, $searchTerm ) !== false ){  
               array_push($matched_pages, $page);
               $page->post_content = $widgetContent;
            }
         }
      }

      $posts = array_merge( $matched_pages, $posts );
   }
   return $posts;
}, 10, 2 );


add_action('admin_head', 'optimizer_get_all_widgetized_pages'); //For Customizer page
add_action('customize_controls_print_footer_scripts', 'optimizer_get_all_widgetized_pages'); //For Widgets.php page
function optimizer_get_all_widgetized_pages(){
   global $current_screen;
   if(is_customize_preview() ||( $current_screen && isset($current_screen->id) && $current_screen->id === 'widgets' )){ 
      $args = array(
         'post_type' => 'page',
         'post_status' => 'any',
         'numberposts' => -1, 
         'meta_query' => array( array( 'key' => 'widgetized', 'value' => true,'compare' => 'LIKE' ) ) 
      );

      $widget_query = new WP_Query( $args );
      $allWidgetizedPages = array();
      //error_log(json_encode($widget_query));
      if(isset($widget_query->posts) && is_array($widget_query->posts) && count($widget_query->posts) > 0){
         foreach ((array)$widget_query->posts as $key => $page) {
            if(isset($page->guid)){
               $sidebar = get_post_meta($page->ID, "page_sidebar", true);
               if($sidebar){
                  $item = new stdClass();
                  $item->ID = $page->ID;
                  $item->title = esc_attr($page->post_title);
                  $item->url = get_permalink($page->ID);
                  $item->name = $page->post_name;
                  $item->sidebar = $sidebar;
                  $allWidgetizedPages[] = $item;
               }
            }
         }
      }

      echo '<script type="text/javascript">var optimizer_widgetized_pages = '.json_encode($allWidgetizedPages).'</script>';
   }
}