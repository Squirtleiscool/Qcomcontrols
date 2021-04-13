<?php

function optimizer_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('Optimizer Widgets', 'optimizer'),
        'filter' => array(
            'groups' => array('optimizer')
        )
    );

    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'optimizer_add_widget_tabs', 20);


function optimizer_add_widget_icons($widgets){
	$widgets['optimizer_front_text']['groups'] = array('optimizer');
    $widgets['optimizer_front_about']['groups'] = array('optimizer');
	$widgets['optimizer_front_blocks']['groups'] = array('optimizer');
	$widgets['optimizer_front_posts']['groups'] = array('optimizer');
	$widgets['optimizer_front_video']['groups'] = array('optimizer');
	$widgets['optimizer_front_map']['groups'] = array('optimizer');
	$widgets['optimizer_front_cta']['groups'] = array('optimizer');	
	$widgets['optimizer_front_portfolio']['groups'] = array('optimizer');
	$widgets['optimizer_front_slider']['groups'] = array('optimizer');
	$widgets['optimizer_front_carousel']['groups'] = array('optimizer');
	$widgets['optimizer_front_newsletter']['groups'] = array('optimizer');		
	$widgets['optimizer_front_clients']['groups'] = array('optimizer');
	$widgets['optimizer_front_testimonials']['groups'] = array('optimizer');
	
	
	$widgets['ast_bio_widget']['groups'] = array('optimizer');
	$widgets['ast_countdown_widget']['groups'] = array('optimizer');	
	$widgets['ast_scoial_widget']['groups'] = array('optimizer');
	$widgets['thn_flckr_widget']['groups'] = array('optimizer');
	$widgets['ast_fb_widget']['groups'] = array('optimizer');
	$widgets['ast_gplus_widget']['groups'] = array('optimizer');		
	$widgets['ast_instagram_widget']['groups'] = array('optimizer');
	$widgets['optimizer_pinterest_widget']['groups'] = array('optimizer');
	
	//Declare Icons
	$widgets['optimizer_front_text']['icon'] = 'fa fa-align-left';
    $widgets['optimizer_front_about']['icon'] = 'fa fa-heart';
	$widgets['optimizer_front_blocks']['icon'] = 'fa fa-th-large';
	$widgets['optimizer_front_posts']['icon'] = 'fa fa-file-text';
	$widgets['optimizer_front_video']['icon'] = 'fa fa-play-circle-o';
	$widgets['optimizer_front_map']['icon'] = 'fa fa-envelope';
	$widgets['optimizer_front_cta']['icon'] = 'fa fa-bullhorn';	
	$widgets['optimizer_front_portfolio']['icon'] = 'fa fa-briefcase';
	$widgets['optimizer_front_slider']['icon'] = 'fa fa-desktop';
	$widgets['optimizer_front_carousel']['icon'] = 'fa fa-clone';
	$widgets['optimizer_front_newsletter']['icon'] = 'dashicons dashicons-email-alt';		
	$widgets['optimizer_front_clients']['icon'] = 'fa fa-gittip';
	$widgets['optimizer_front_testimonials']['icon'] = 'fa fa-group';
	
	$widgets['ast_bio_widget']['icon'] = 'fa fa-user';
	$widgets['ast_countdown_widget']['icon'] = 'fa fa-clock-o';	
	$widgets['ast_scoial_widget']['icon'] = 'fa fa-share-alt';
	$widgets['thn_flckr_widget']['icon'] = 'fa fa-flickr';
	$widgets['ast_fb_widget']['icon'] = 'fa fa-facebook-official';
	$widgets['ast_gplus_widget']['icon'] = 'fa fa-google-plus';		
	$widgets['ast_instagram_widget']['icon'] = 'fa fa-instagram';
	$widgets['optimizer_pinterest_widget']['icon'] = 'fa fa-pinterest';
	
	
    return $widgets;
}
add_filter('siteorigin_panels_widgets', 'optimizer_add_widget_icons');


function optimizer_so_scripts() {
   wp_add_inline_script( 'jquery-migrate', 'jQuery(function() {  jQuery(".so-panel.widget").each(function (){   jQuery(this).attr("id", jQuery(this).find(".so_widget_id").attr("data-panel-id"))  });  });' );
}
add_action( 'wp_enqueue_scripts', 'optimizer_so_scripts' );