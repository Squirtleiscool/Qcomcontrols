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

if ( ! defined( 'WPINC' ) ) exit;

function roboGalleryTag($content){
    global $post;
    if( post_password_required() ) return $content;
    if( get_post_type() != ROBO_GALLERY_TYPE_POST || !is_main_query() ) return $content;
	return $content.do_shortcode("[robo-gallery id={$post->ID}]");
}
add_filter( 'the_content', 'roboGalleryTag');


function robo_gallery_shortcode( $attr ) { 	
	if( !isset($attr) || !isset($attr['id']) ) return '';

	$gallery = new roboGallery($attr);
	
	return $gallery->getGallery();	
}
add_shortcode( 'robo-gallery', 'robo_gallery_shortcode' );


