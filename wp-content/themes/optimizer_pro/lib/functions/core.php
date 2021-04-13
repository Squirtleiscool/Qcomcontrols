<?php
 /**
 * The CORE functions for OPTIMIZER
 *
 * Stores all the core functions of the template.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
 $optimizer = optimizer_option_defaults();
 
//ADD BODY CLASSES
function optimizer_body_class( $classes ) {
	global $optimizer;
	// add classes to the $classes array
		$classes[] = ''.$optimizer['site_layout_id'].'';
	if(!empty($optimizer['head_transparent'])){
		$classes[] = 'has_trans_header';
	}else{
		$classes[] = 'not_trans_header';
	}
	
	if($optimizer['site_layout_id'] == 'site_boxed'){
		$classes[] = 'is_boxed';
	}
   // if(has_blocks()){
	// 	$classes[] = 'has_blocks';
	// }
   // if(is_singular( )){
   //    global $post;
   //    $optimizer_post_layout = get_post_meta( $post->ID, 'optimizer_post_layout', true);
   //    if(isset($optimizer_post_layout)){
   //       $classes[] = 'optimizer_post_layout--'.$optimizer_post_layout;
   //    }
	// }
   

	if($optimizer['social_bookmark_pos']){
		$classes[] = 'soc_pos_'.$optimizer['social_bookmark_pos'].'';
	}
	
	if(empty($optimizer['mobile_smart_resize'])){
		$classes[] = 'disable_slider_resize';
	}
	
	if(!empty($optimizer['head_sticky'])){
		$classes[] = 'has_sticky_header';
	}
	
	if(!empty($optimizer['head_sidebar'])){
		$classes[] = 'header_sidebar';
		if(!empty($optimizer['header_sidebar_style'])){
			$classes[] = $optimizer['header_sidebar_style'];
		}
   }
   
   if(!empty($optimizer['disable_slider_parallax'])){
		$classes[] = 'disable_slider_parallax';
	}

	if ( is_rtl() ) {
		$classes[] = 'layer_rtl';
	}
	if ( !is_front_page() ) {
		$classes[] = 'not_frontpage';
	}
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-prev';
	}
	if ( is_singular()){
      global $post; 
      global $wp_query; $postid = $wp_query->post->ID; 
      $custom_calsses = get_post_meta( $postid, 'custom_classes', true); 
      $custom_calsses = $custom_calsses ? explode(',', $custom_calsses) : false;
		if (optimizer_empty_content($post->post_content)) {
			$classes[] = 'has_no_content';
		}

      if($custom_calsses && is_array($custom_calsses) && count($custom_calsses) > 0){
         foreach ($custom_calsses as $key => $class) {
            $classes[] = $class;
         }
      }
	}
	
	if ( is_single()){
		if(!empty($optimizer['single_post_layout'])){
			$classes[] = 'single_style_'.$optimizer['single_post_layout'].'';
		}
		if( has_post_thumbnail() ){
			$classes[] = 'single_has_feat_image';
		}
	}
	
	if ( is_page() ) {
	global $wp_query; $postid = $wp_query->post->ID; 
	$page_header_trans = get_post_meta( $postid, 'page_header_transparent', true); 
		if(!empty($page_header_trans)){
			$classes[] = 'page_header_transparent';
		}
		
	   $page_header_menu_hide = get_post_meta( $postid, 'hide_header_menu', true); 
      $page_header_hide = get_post_meta( $postid, 'hide_header', true); 
		if(!empty($page_header_hide)){
			$classes[] = 'hide_header';
		}
      if(!empty($page_header_menu_hide)){
			$classes[] = 'hide_header_menu';
		}
	}
	//Woocommerce Classes
	if(  function_exists ( "is_woocommerce" )){
		if(is_woocommerce()){
			if(!empty($optimizer['shop_sidebar_pos'])){
				$classes[] = 'shop_sidebar_'.$optimizer['shop_sidebar_pos'].'';
			}
			if(!empty($optimizer['woo_button_style'])){
				$classes[] = 'shop_bttn_'.$optimizer['woo_button_style'].'';
			}
			if(!empty($optimizer['woo_archive_layout'])){
				$classes[] = 'woo_archive_'.$optimizer['woo_archive_layout'].'';
			}
			if(!empty($optimizer['woo_single_layout'])){
				$classes[] = 'woo_single_'.$optimizer['woo_single_layout'].'';
			}
		}
		
		//Shop Page Transparent Header Option
		$postid = get_option( 'woocommerce_shop_page_id' );
		$page_header_trans = get_post_meta( $postid, 'page_header_transparent', true); 
		if(!empty($page_header_trans) && is_shop()){
			$classes[] = 'page_header_transparent';
		}
		//Check if Page contains Woocommerce Shortcodes, If does, add the Optimizer Woocommerce Button Styles
		if(is_page()){
			global $post;
			if ( has_shortcode( $post->post_content, 'products' ) || has_shortcode( $post->post_content, 'sale_products' ) || has_shortcode( $post->post_content, 'recent_products' ) || has_shortcode( $post->post_content, 'best_selling_products' ) || has_shortcode( $post->post_content, 'featured_products' ) || has_shortcode( $post->post_content, 'top_rated_products' ) ) {
				if(!empty($optimizer['woo_button_style'])){		$classes[] = 'shop_bttn_'.$optimizer['woo_button_style'].' has_woo_shortcode';	}
			}
		}
		
		
	}
	
	return $classes;
}
add_filter( 'body_class', 'optimizer_body_class' );

	
//SIDEBAR
function optimizer_widgets_init(){

	$editbutton = (is_customize_preview() ? '<a class="edit_widget" title="Edit Widget - #%1$s"><i class="fa fa-pencil"></i></a>' : '');
	
	register_sidebar(array(
	'name'          => __('Right Sidebar', 'optimizer'),
	'id'            => 'sidebar',
	'description'   => __('When you assign widgets to this area, it will be displayed on the right side of all pages and posts', 'optimizer'),
	'before_widget' => '<div id="%1$s" class="widget %2$s" data-widget-id="%1$s"><div class="widget_wrap">'.$editbutton,
	'after_widget'  => '<span class="widget_corner"></span></div></div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>'
	));
		
	register_sidebar(array(
	'name'          => __('Footer Widgets', 'optimizer'),
	'id'            => 'foot_sidebar',
	'description'   => __('This Widget Area is displayed in the footer section of your site.', 'optimizer'),
	'before_widget' => '<li id="%1$s" class="widget %2$s" data-widget-id="%1$s"><div class="widget_wrap">'.$editbutton,
	'after_widget'  => '</div></li>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>'
	));
	
	register_sidebar(array(
	'name'          => __('Frontpage Widgets', 'optimizer'),
	'id'            => 'front_sidebar',
	'description'   => __('This Widget Area is displayed on the Frontpage', 'optimizer'),
	'before_widget' => '<div id="%1$s" class="widget %2$s" data-widget-id="%1$s"><div class="widget_wrap">'.$editbutton,
	'after_widget'  => '</div></div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
	
/*	register_sidebar(array(
	'name'          => __('Frontpage Widgets 2', 'optimizer'),
	'id'            => 'home_sidebar',
	'description'   => __('Widget Area for the frontpage', 'optimizer'),
	'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="widget_wrap">',
	'after_widget'  => '</li>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>'
	));
*/



	//UNLIMITED SIDEBARS
	global $optimizer;
	if(!empty($optimizer['custom_sidebar'])){
		
			if(is_array($optimizer['custom_sidebar'])){
				$optimizer['custom_sidebar'] = rtrim(implode(',', $optimizer['custom_sidebar']), ',');
			}
			$custom_sidebar = explode(',', $optimizer['custom_sidebar']);  

			foreach((array)$custom_sidebar as $key => $value){
				
				register_sidebar(array(
					'name'          => $value,
					'id'            => 'optimizer_'.str_replace('%','',sanitize_title($value)),
					'description'   => __('Custom Sidebar created by you', 'optimizer'),
					'before_widget' => '<div id="%1$s" class="widget %2$s" data-widget-id="%1$s"><div class="widget_wrap">'.$editbutton,
					'after_widget'  => '</div></div>',
					'before_title'  => '<h3 class="widgettitle">',
					'after_title'   => '</h3>'
				));
			}

	}
	
	
}

add_action( 'widgets_init', 'optimizer_widgets_init' );




//Assign Thumbnail to post if it has gallery
function optimizer_gallery_thumb(){
 	global $post;
 	// Make sure the post has a gallery in it
 	if( has_shortcode( $post->post_content, 'gallery' ) ){

		$gallery = get_post_gallery( get_the_ID(), false );
		$ids = explode( ",", $gallery['ids'] );
	
		foreach( $ids as $id ) {
		   $imgurl   = wp_get_attachment_image_src( $id, array(400,270) );
		} 
	
		$first_thumb = $imgurl[0];
		return $first_thumb;
	}
 }

// force the link='file' gallery shortcode attribute:
add_filter('shortcode_atts_gallery','optimizer_overwrite_gallery_atts',10,3);
function optimizer_overwrite_gallery_atts($out, $pairs, $atts){
	global $optimizer;
	if(!empty($optimizer['post_gallery_id']))
    $out['link']='file'; 
    return $out;
}


//Default Placeholder Image
if(!function_exists( 'optimizer_placeholder_image' ) ){
	function optimizer_placeholder_image(){
		return ''. get_template_directory_uri().'/assets/images/blank_img.png';
	}
}
//Display Read More Button in Layout4
function optimizer_excerpt_more($more) {
	return '<br><a class="moretag" href="'. get_permalink() . '">'.__('+ Read More', 'optimizer').'</a>';
}
add_filter('excerpt_more', 'optimizer_excerpt_more');


//Alter the Read More Link
add_filter( 'the_content_more_link', 'optimizer_more_link', 10, 2 );

function optimizer_more_link( $more_link, $more_link_text ) {
	return str_replace( $more_link_text, __('+ Read More', 'optimizer'), $more_link );
}

//optimizer CUSTOM Search Form
function optimizer_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input placeholder="' . esc_attr__( 'Search &hellip;', 'optimizer' ) . '" type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'optimizer' ) .'" />
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'optimizer_search_form' );


//**************Toptimizer COMMENTS******************//
if(!function_exists( 'optimizer_comment' ) ){
function optimizer_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
     <div class="comm_edit"><?php edit_comment_link(__('Edit', 'optimizer'),'','') ?></div>
      
      
      <div class="comment-author vcard">
            <div class="avatar"><?php echo get_avatar($comment,$size='30' ); ?></div>
            <div class="comm_auth"><?php printf(__('%s', 'optimizer'), get_comment_author_link()) ?></div>
            <a class="comm_date"><i class="fa-clock-o"></i><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . __(' ago', 'optimizer'); ?></a>
            
            <div class="comm_reply">
              <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'before' =>'<i class="fa-reply"></i> '))) ?>
            </div>
        
      </div>
      
      
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'optimizer') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_comment"><?php comment_text() ?></div>
     
     </div>
<?php
        }

}
		
//**************TRACKBACKS & PINGS******************//
function optimizer_ping($comment, $args, $depth) {
 
$GLOBALS['comment'] = $comment; ?>
	
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   
     <div id="comment-<?php comment_ID(); ?>" class="comment-body">
           <?php edit_comment_link(__('Edit', 'optimizer'),'  ','') ?>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.', 'optimizer') ?></em>
         <br />
      <?php endif; ?>

      <div class="org_ping">
      	<?php printf(__('<cite class="citeping">%s</cite> <span class="says">:</span>', 'optimizer'), get_comment_author_link()) ?>
	  	<?php comment_text() ?>
            <div class="comm_meta_reply">
            <div class="comm_date"><i class="fa-clock-o"></i><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></div>
            </div>
     </div>
     </div>
     
     
<?php }



//GET EXIF DTAT FROM IMAGE
add_action('wp_ajax_nopriv_optimizer_get_exif', 'optimizer_get_exif');
add_action('wp_ajax_optimizer_get_exif', 'optimizer_get_exif');

function optimizer_get_exif(){ 
	$id= $_REQUEST['id'];

    $meta = wp_get_attachment_metadata($id);
           
	 if($meta[image_meta][camera] != ''){
		 echo '<label>'.__('Credit :', 'optimizer').  '</label>'.$meta["image_meta"]["credit"].'<br />';
		 echo '<label>'.__('Camera :', 'optimizer').  '</label>'.$meta["image_meta"]["camera"].'<br />';
		 echo '<label>'.__('Focal Length :', '').  '</label>'.$meta["image_meta"]["focal_length"].'<br />';
		 echo '<label>'.__('Aperture :', '').  '</label>'.$meta["image_meta"]["aperture"].'<br />';
		 echo '<label>'.__('ISO :', 'optimizer'). '</label>'.$meta["image_meta"]["iso"].'<br />';
		 echo '<label>'.__('Shutter Speed :', '').  '</label>'.$meta["image_meta"]["shutter_speed"].'<br />';
		 echo '<label>'.__('Created :', 'optimizer').  '</label>'.$meta["image_meta"]["created_timestamp"].'<br />';
		 echo '<label>'.__('Copyright :', 'optimizer').  '</label>'.$meta["image_meta"]["copyright"];
	 }else{
		 echo '<p class="no_exif"><i class="fa fa-exclamation-circle"></i> '.__('EXIF Data Not Available', 'optimizer').'</p>';
		 }
	die();
}


//COMMENT FORM DEFAULT FIELDS
if(!function_exists( 'optimizer_comment_form_fields' ) ){
	function optimizer_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		global $optimizer;
		
		$fields['author'] = '<div class="comm_wrap"><p class="comment-form-author"><input placeholder="' . __( 'Name', 'optimizer' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' /></p>';
	
		$fields['email'] = '<p class="comment-form-email"><input placeholder="' . __( 'Email', 'optimizer' ) . '" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' /></p>';
	
		$fields['url'] = '<p class="comment-form-url"><input placeholder="' . __( 'Website', 'optimizer' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></p></div>';
		return $fields;
	}
}

add_filter('comment_form_default_fields','optimizer_comment_form_fields');

//CHECK IF POST HAS CONTENT OR NOT
function optimizer_empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}


/*------CONTACT FORM-------*/
add_action('wp_ajax_optimizer_send_message', 'optimizer_send_message' );
add_action('wp_ajax_nopriv_optimizer_send_message', 'optimizer_send_message' );

if(!function_exists( 'optimizer_contact_widget_email' ) ){
	function optimizer_contact_widget_email(){
		return get_option( 'admin_email' );	
	}
}
if(!function_exists( 'optimizer_send_message' ) ){
	function optimizer_send_message($to) {
			
			if (isset($_POST['contact_message'])) {
				add_filter('wp_mail_content_type', 'optimizer_contact_mail_type' );
				$to = optimizer_contact_widget_email();
				$to = explode(",",$to);
				
				$subject = get_bloginfo('name')." | ". esc_html($_POST['contact_subject']);
				if (isset($_POST['contact_extra'])) {$extra_field = ' / '.esc_html($_POST['contact_extra']); }else{$extra_field = '';}
				
				
				ob_start();
					echo '<p style="border-bottom: 1px solid #DADADA;padding-bottom: 15px;"><b>From:</b> '.esc_html($_POST['contact_name']).' / '.sanitize_email($_POST['contact_email']).''.$extra_field.' <br></p>';
					echo wp_kses(wpautop($_POST['contact_message']), '');
				
					$message = ob_get_contents();
				
				ob_end_clean();
	
				//$mail = wp_mail($to, $subject, $message, $headers);
				foreach($to as $email_address)
				{
					$headers = "From: ".sanitize_email($email_address)." <".sanitize_email($email_address).">\r\nReply-To:".sanitize_email($_POST['contact_email']);
					wp_mail($email_address, $subject, $message, $headers);
				}
				//if($mail){
					echo 'success';
				//}
				remove_filter('wp_mail_content_type', 'optimizer_contact_mail_type' );
			}
			
			exit();
			
	}
}
function optimizer_contact_mail_type() { return "text/html"; }


/*=======Gallery Styles=========*/
add_action('print_media_templates', 'optimizer_gallery_control');
function optimizer_gallery_control() {
  ?>
  <script type="text/html" id="tmpl-optimizer-gallery-setting">
    <label class="setting">
      <span><?php _e('Style', 'optimizer'); ?></span>
      <select name="style" data-setting="style">
        <option value="0"> Default </option>
        <option value="1"> Square </option>
		<option value="2"> Square (Spaced) </option>
        <option value="3"> Masonry </option>
		<option value="4"> Masonry (Spaced) </option>
		<option value="5"> Slideshow </option>
      </select>
    </label>
  </script>

  <script>

   jQuery(function() {

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        style: '0'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('optimizer-gallery-setting')(view);
        }
      });

    });

  </script>
  <?php

}

//MODIFY GALLERY SHORTCODE (If Jetpack Tiled Gallery is disabled)
if(class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' )){
	
		//DO NOT LOAD THE THEME GALLERY
		
	}else{
		remove_shortcode('gallery');
		function optimizer_gallery_shortcode( $attr ) {
		
				if(!empty($attr['style'])){ $attr['style']= $attr['style']; }else{ $attr['style'] = ''; }
				$output = gallery_shortcode( $attr );
				$output = str_replace('<div', '<div data-gallery-style="'.$attr['style'].'"', $output);
		
			return $output;
		}
		
		add_shortcode( 'gallery', 'optimizer_gallery_shortcode' );
}

//Static Slider Slideshow Nivo Slider pauseTime
if(!function_exists( 'optimizer_statslideshow_time' ) ){
	function optimizer_statslideshow_time(){
		global $optimizer;
		
		echo $optimizer['static_slide_timer'];
	}
}

//Static Slider Slideshow Nivo Slider pauseTime
if(!function_exists( 'optimizer_accordion_mobile_default_slide' ) ){
	function optimizer_accordion_mobile_default_slide(){
		echo '1';
	}
}

//Static Slider Slideshow Nivo Slider pauseTime
if(!function_exists( 'optimizer_testimonial_interval' ) ){
	function optimizer_testimonial_interval(){
		echo '8000';
	}
}

//Auto Backup Optimizer Settings
function optimizer_add_weekly( $schedules ) {
	// add a 'weekly' schedule to the existing set
	$schedules['weekly'] = array(
		'interval' => 604800,
		'display' => __('Once Weekly', 'optimizer')
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'optimizer_add_weekly' ); 

function optimizer_autobackup() {

		global $wp_filesystem;
		global $optimizer;
		
		if($optimizer['auto_backup'] == 'daily' || $optimizer['auto_backup'] == 'weekly'){
			$tmpfname = tempnam(get_template_directory(), 'themesettings-'. date("d-m-Y") .'-'); //Create the Temp File
			$widgetfname = tempnam(get_template_directory(), 'widgetsettings-'. date("d-m-Y") .'-'); //Create the Temp File
			
			$theme_settings = json_encode(get_option('optimizer'));
			$widget_settings = optimizer_wie_generate_export_data();
	
			$wp_filesystem->put_contents( str_replace('.tmp','',$tmpfname).'.json',$theme_settings,  FS_CHMOD_FILE ); //Write Contet in the Temp File
			$wp_filesystem->put_contents( str_replace('.tmp','',$widgetfname).'.wie',$widget_settings,  FS_CHMOD_FILE ); //Write Contet in the Temp File
			
			$attachments = array();
			array_push($attachments, str_replace('.tmp','',$tmpfname).'.json' );
			array_push($attachments, str_replace('.tmp','',$widgetfname).'.wie' );
			
			$headers = 'From: '.get_bloginfo( 'name' ).' <'.get_option( 'admin_email' ).'>' . "\r\n";
			wp_mail(get_option( 'admin_email' ), 'Optimizer Backup ['. date("d/m/Y") .']', 'Your Optimizer '.$optimizer['auto_backup'].' Backup', $headers, $attachments);
			
			//Delete The Temp Files
			unlink($tmpfname); unlink(str_replace('.tmp','',$tmpfname).'.json');
			unlink($widgetfname); unlink(str_replace('.tmp','',$widgetfname).'.wie');
		}

}
add_action( 'optimizer_backup_task', 'optimizer_autobackup' );

if ( ! wp_next_scheduled( 'optimizer_backup_task' ) ) {
	global $optimizer;
	if($optimizer['auto_backup'] == 'daily'){	wp_schedule_event( time(), 'daily', 'optimizer_backup_task' );	}
	if($optimizer['auto_backup'] == 'weekly'){	wp_schedule_event( time(), 'weekly', 'optimizer_backup_task' );	}
}