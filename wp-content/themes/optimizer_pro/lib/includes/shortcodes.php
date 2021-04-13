<?php

/**Shortcode Support in Text Widget **/
add_filter('widget_text', 'do_shortcode');

/**optimizer SHORTCODES **/

/**Success Alert **/
/**USAGE: [success]Your info success message[/success]**/
function layersc_scs( $atts, $content = null ) {
		extract(shortcode_atts(array('class' => '',), $atts));
		
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
		
		return '<div class="lts_scs '.$class.' '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'success', 'layersc_scs' );


/**Info Alert **/
/**USAGE: [info]Your info alert message[/info]**/
function layersc_info( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div class="lts_info '.$class.' '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'info', 'layersc_info' );


/**Warning Alert **/
/**USAGE: [warning]Your warning alert message[/warning]**/
function layersc_wng( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div class="lts_wng '.$class.' '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'warning', 'layersc_wng' );



/**Error Alert **/
/**USAGE: [error]Your error alert message[/error]**/
function layersc_err( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
		
		return '<div class="lts_err '.$class.' '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'error', 'layersc_err' );



/**Quote Shortcode **/
/**USAGE: [quote]Your Quote[/quote]**/
function layersc_quote( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'author' => '',
		'source' => '',
		'class'=> '',
	), $atts));
	$authord ='';
	if($author !== ''){
		$authord = '-'.$author;
	}
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	
		return '<div class="lts_quote_wrap '.$class.' '.$nonedit.'"><div class="lts_quote">'.do_shortcode($content).'</div><div class="lts_quote_author"><a target="_blank" href="'.$source.'">'.$authord.'</a></div></div>';
}
add_shortcode( 'quote', 'layersc_quote' );


/**Divider Shortcode **/
/**USAGE: [divider]**/
function layersc_divider( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'style' => 'solid',
		'height' => '1px',
		'color' => '#eeeeee',
		'class'=> '',
	), $atts));
	
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div class="ast_divide '.$class.' '.$nonedit.'" style="clear:both;border-bottom: '.$height.' '.$style.' '.$color.'; width:100%; height:2px; margin:15px 0;"></div>';
}
add_shortcode( 'divider', 'layersc_divider' );


/**Title Divider Shortcode **/
/**USAGE: [tdivider style="fa-stop" color="#333"]**/
function layersc_tdivider( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'style' => 'fa-stop', //fa-stop, underline, fa-star, fa-times, fa-bolt, fa-asterisk, fa-chevron-down, fa-heart, fa-plus, fa-bookmark, fa-circle-o, fa-th-large, fa-minus, fa-cog, fa-reorder, fa-diamond, fa-gg, fa-houzz, fa-rocket
		'color' => '#333',
		'class'=> '',
	), $atts));
	if($style == 'underline'){ $underline= 'title_underline';}else{$underline='';}
	
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
		//line breaks added to fix the customizer issue
		return '<div class="optimizer_divider '.$class .$underline.' '.$nonedit.'">
          <span class="div_left" style="background:'.$color.'">
		  </span>
          <span class="div_middle" style="color:'.$color.'">
		  <i class="fa '.$style.'"> </i>
		  </span>
          <span class="div_right" style="background:'.$color.'">
		  </span>
      </div>';
}
add_shortcode( 'tdivider', 'layersc_tdivider' );


/**Slider Shortcode **/
/**USAGE: [slider]**/
function layersc_slider( $atts, $content = null ) {
		extract(shortcode_atts(array(
		'effect' => 'slide',
		'pausetime' => '3000',
		'autoplay' => 'true',
		'navigation' => 'true',
		'class'=> '',
	), $atts));
	
	if($autoplay == 'true'){
		$autoplayd = 'manualAdvance:false';
	}else{
		$autoplayd = '';
	}
	
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	$content= preg_replace('<<br />>', '', $content);
		return '<div class="ast_slide_wrap '.$class.' '.$nonedit.'"><div class="ast_slider">'.$content.'</div></div><script>jQuery(window).on("load", function(){jQuery(".ast_slider").nivoSlider({ effect :"'.$effect.'", pauseTime: '.$pausetime.', directionNav: '.$navigation.', '.$autoplayd.'});   });</script>';
}
add_shortcode( 'slider', 'layersc_slider' );



/**FACEBOOK LIKE BUTTON **/
/**USAGE: [fblike]**/
function layersc_facelike( $atts, $content = null) {
		extract(shortcode_atts(array(
		'layout' => 'standard', //standard, box_count, button_count
		'action' => 'like', //like, recommend,
		'url' => urlencode(get_permalink()),
		'share' => 'true',
	), $atts));
	
if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}

return '<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, "script", "facebook-jssdk"));</script>
				
<div class="fb-like '.$nonedit.'" data-href="'.$url.'" data-layout="'.$layout.'" data-action="'.$action.'" data-show-faces="false" data-share="'.$share.'"></div>
				';

}
add_shortcode('fblike', 'layersc_facelike');


/**TWITTER TWEET BUTTON **/
/**USAGE: [tweet]**/
function layersc_tweet( $atts, $content = null) {
		extract(shortcode_atts(array(
		'size' => 'standard', //standard, big
		'via' => '', 
		'count' => 'true',
		'count_type' => 'horizontal' //horizontal, vertical  
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($size == 'big'){
		$size ='data-size="large"';
	}else{
		$size ='';
	}
	
	if($via !== ''){
		$via ='data-via="'.$via.'"';
	}else{
		$via ='';
	}
	
	if($count == 'true'){
		$count ='';
	}else{
		$count ='data-count="none"';
	}
	
	if($count_type == 'vertical'){
		$count_type ='data-count="vertical"';
	}else{
		$count_type ='';
	}
		
   return '<a '.$nonedit.' href="https://twitter.com/share" class="twitter-share-button" '.$via.' '.$count.' '.$size.' '.$count_type.'>Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>';
}
add_shortcode('tweet', 'layersc_tweet');


/**Pinterest BUTTON **/
/**USAGE: [pinit]**/
function layersc_pinit( $atts, $content = null) {
		extract(shortcode_atts(array(
		'size' => 'standard', //standard, big
		'style' => 'red', //red, white, gray
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($size == 'big'){
		$size ='data-pin-height="28"';
	}else{
		$size ='';
	}	
	
	if($style == 'red'){
		$style ='data-pin-color="red"';
	}elseif($style == 'white'){
		$style ='data-pin-color="white"';
	}else{
		$style ='';
	}
	
   return '<a class="'.$nonedit.'" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" '.$size.' '.$style.'><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a><script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
}
add_shortcode('pinit', 'layersc_pinit');

/**Google Plus BUTTON **/
/**USAGE: [gplus]**/
function layersc_gplus( $atts, $content = null) {
		extract(shortcode_atts(array(
		'size' => 'small', //small, medium, large
		'style' => 'inline', //inline, bubble, none
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($size == 'small'){
		$size ='data-size="small"';
	}elseif($size == 'large'){
		$size ='data-size="tall"';
	}else{
		$size ='';
	}	
	$annotation ='';
	if($style == 'none'){
		$annotation ='data-annotation="none"';
	}elseif($style == 'inline'){
		$annotation ='data-annotation="inline"';
	}
	if($style == 'inline'){
		$width = 'width:185px;';
	}else{
		$width = 'width:75px;';
	}	
   return '<div style="'.$width.' display: inline-block;" class="gplus_wrap gplus_'.$style.' '.$nonedit.'"><div class="g-plusone" '.$size.' '.$annotation.'></div></div><script type="text/javascript">
  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';
}
add_shortcode('gplus', 'layersc_gplus');



/**List Style **/
/**USAGE: 
[list]
your list items created within the editor.
[/list]
**/
function layersc_list_func($atts, $content) {
		//extract short code attr
	extract(shortcode_atts(array(
		'bullet_color' => '#999999',
		'style' => 'list1',
		'class' => ''
	), $atts));
	
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	$return_html = '<div class="lts_list '.$style.' '.$class.' '.$nonedit.'" data-list-color="'.$bullet_color.'">'.$content.'</div>';
	
	return $return_html;
}
add_shortcode('list', 'layersc_list_func');


/**Youtube Video Shortcode **/
/**USAGE: [youtube width="640" height="385" video_id="EhkHFenJ3rM"]
**/
if(class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'shortcodes' ) ){
}else{
		function layersc_youtube_func($atts, $content) {
		
			//extract short code attr
			extract(shortcode_atts(array(
				'width' => '100%',
				'height' => '100%',
				'autoplay' => 'true',
				'class' => '',
			), $atts));
			
			
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
			
			
			$content = strip_tags($content);
			if (($pos = strpos($content, "list=")) !== FALSE) { 
				$listid = substr($content, $pos+5); 
				$content ='//www.youtube.com/embed/videoseries?list='. $listid;
			}else{
				$content =str_replace('http://www.youtube.com/watch?v=', '//www.youtube.com/embed/', $content);
				$content =str_replace('https://www.youtube.com/watch?v=', '//www.youtube.com/embed/', $content);
				$content =str_replace('https://youtube.com/watch?v=', '//www.youtube.com/embed/', $content);
				$content =str_replace('https://youtu.be/', '//www.youtube.com/embed/', $content);
				$content =str_replace('https://www.youtu.be/', '//www.youtube.com/embed/', $content);
				$content =str_replace('https://www.youtu.be/', '//www.youtube.com/embed/', $content);
			}
			$rel = '?rel=0';
			if ($autoplay == 'true'){
				$autoplay= '?autoplay=1';
				$rel = '&rel=0';
				}elseif ($autoplay == 'false'){
				$autoplay= '';	
			}
			$node = 'iframe';
			
			$return_html = '<div style="clear:both;"></div><div class="ast_vid '.$class.' '.$nonedit.'"><div class="responsive-container"><'.$node.' class="vid_iframe" style=" width: '.$width.'; height: '.$height.';" src="'.$content.''.$autoplay.''.$rel.'" allowfullscreen></'.$node.'></div></div>';
			
			return $return_html;
		}
		add_shortcode('youtube', 'layersc_youtube_func');


}

/**Vimeo Video Shortcode **/
/**USAGE: [vimeo width="640" height="385" video_id="11770385"]
/ Might have issue with some servers
**/
if(class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'shortcodes' ) ){
}else{
		function layersc_vimeo_func($atts, $content) {

			//extract short code attr
			extract(shortcode_atts(array(
				'width' => '100%',
				'height' => '100%',
				'autoplay' => 'true',
				'class' => '',
			), $atts));
			
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
			
			$content = strip_tags($content);
			$content =str_replace('http://vimeo.com/', '//player.vimeo.com/video/', $content);
			$content =str_replace('https://vimeo.com/', '//player.vimeo.com/video/', $content);
			if ($autoplay == 'true'){
				$autoplay= 1;
				}elseif ($autoplay == 'false'){
				$autoplay= 0;	
				}
			$node = 'iframe';
			
			$return_html = '<div style="clear:both;"></div><div class="ast_vid '.$class.' '.$nonedit.'"><div class="responsive-container"><'.$node.' class="vid_iframe" style=" width: '.$width.'; height: '.$height.';" src="'.$content.'?title=1&amp;byline=0&amp;portrait=0&amp;color=00adef&amp;autoplay='.$autoplay.'"></'.$node.'></div></div>';
			
			return $return_html;
		}
		add_shortcode('vimeo', 'layersc_vimeo_func');
}

/**Flickr Gallery **/
/**USAGE: 
[flickr id="" type=""]
**/
function layersc_flickr_func( $atts, $content = null) {
		//extract short code attr
	extract(shortcode_atts(array(
		'id' => '', //use http://idgettr.com/ to get you flickr userid
		'count' => '9',
		'photo_size'=> 'n', //n, q, s
		'key'=> '',
		'photoset'=> '',
		'class' => '',
	), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if(!empty($photoset)) {
		$setid = $photoset;
		$setname='photosets';
		$setidname='photoset_id';
		$fetchname='photoset';
	}else{
		$setid = $id;
		$setname='people';
		$setidname='user_id';
		$fetchname='photos';
	}
	
	
	$return_html = '<div id="flickr_badge_wrapper" class="clearfix flckr_'.$photo_size.' '.$class.' '.$nonedit.'">
				<script type="text/javascript">
					(function($){
						var setID = "'.$setid.'";
						var apiKey = "'.$key.'";
						var itemsPerPage = '.$count.'; // Max is 500
						$.getJSON("https://api.flickr.com/services/rest/?&method=flickr.'.$setname.'.getPhotos&api_key=" + apiKey + "&'.$setidname.'=" + setID + "&per_page=" + itemsPerPage + "&format=json&jsoncallback=?", function(data){        
							
							var htmlOutput = "<ul class=\'pd_flick_gallery\'>";
							//loop through the results
							$.each(data.'.$fetchname.'.photo, function(i,item){
								// URLs
								var photoURL = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_'.$photo_size.'.jpg";
								var linkURL = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_b.jpg";
								
								htmlOutput += \'<li><a href="\' + linkURL + \'" target="_blank">\';
								htmlOutput += \'<img title="\' + item.title + \'" src="\' + photoURL;
								htmlOutput += \'" alt="\' + item.title + \'" />\';
								htmlOutput += \'</a></li>\';
							});
							htmlOutput += "</ul><div style=\'clear:both;\'></div>";
							   
							// Assign result to a unique container
							$("#flickr_badge_wrapper").html(htmlOutput);
							$(".pd_flick_gallery li").magnificPopup({ // the containers for all your galleries
									delegate: "a", // the selector for gallery item
									type: "image",
									gallery: {
									  enabled:true
									}
							});
						});
					})(jQuery);
				</script>
			</div>';
	
	return $return_html;
}
add_shortcode('flickr', 'layersc_flickr_func');




/**2 columns **/
/**USAGE: [col2]your text[/col2]
**/
function layersc_col2_func( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '','width' => '',), $atts));

		
		if(is_customize_preview()){ 
			$nonedit = 'inline_shortcode';
			//$short = 'contenteditable="true" data-shortcode="[col2 width=&quot;'.$width.'&quot;]'.str_replace('"', '&quot;', do_shortcode($content)).'[/col2]"';
         $short = '';
		}else{
			$nonedit = ''; $short = '';
		}

		return '<div class="col2 shortcol '.$class.' '.$nonedit.'" data-width="'.$width.'" '.$short.'>'.do_shortcode($content).'</div>';
}
add_shortcode( 'col2', 'layersc_col2_func' );


/**3 columns **/
/**USAGE: [col3]your text[/col3]
**/
function layersc_col3_func( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '','width' => '',), $atts));
	
		if(is_customize_preview()){ 
			$nonedit = 'inline_shortcode';
			$short = 'contenteditable="true" data-shortcode="[col3 width=&quot;'.$width.'&quot;]'.str_replace('"', '&quot;', do_shortcode($content)).'[/col3]"';

		}else{
			$nonedit = ''; $short = '';
		}
		
		return '<div class="col3 shortcol '.$class.' '.$nonedit.'" data-width="'.$width.'" '.$short.'>'.do_shortcode($content).'</div>';
}
add_shortcode( 'col3', 'layersc_col3_func' );



/**4 columns **/
/**USAGE: [col4]your text[/col4]
**/
function layersc_col4_func( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '','width' => '',), $atts));
	
		if(is_customize_preview()){ 
			$nonedit = 'inline_shortcode';
			$short = 'contenteditable="true" data-shortcode="[col4 width=&quot;'.$width.'&quot;]'.str_replace('"', '&quot;', do_shortcode($content)).'[/col4]"';

		}else{
			$nonedit = ''; $short = '';
		}
	
		return '<div class="col4 shortcol '.$class.' '.$nonedit.'" data-width="'.$width.'" '.$short.'>'.do_shortcode($content).'</div>';
}
add_shortcode( 'col4', 'layersc_col4_func' );

/**5 columns **/
/**USAGE: [col5]your text[/col5]
**/
function layersc_col5_func( $atts, $content = null ) {
	extract(shortcode_atts(array('class' => '','width' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div class="col5 shortcol '.$class.' '.$nonedit.'" data-width="'.$width.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'col5', 'layersc_col5_func' );


/**Tabs **/
/**USAGE: [tabs titles="Tab One, Tab Two"][tab]your content[/tab][tab]your content[/tab][/tabs]
**/
function layersc_tabs($atts, $content = null) {
	extract(shortcode_atts(array(
		"titles" => '',
		"style" => '', //default, circualr, minimal, capsule
		"active_color"=>'#119BFF',
		"class" => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
		
		
	$titlearr=explode(',',$titles);
	$html='<div class="tabs-container lts_tabs tabs_'.$style.' '.$class.' '.$nonedit.'" data-active-color="'.$active_color.'"><ul class="tabs ">';
	foreach($titlearr as $title){

		$html.='<li class="tabli lts_tabtitle"><a href="#" class="tabtrigger">'.$title.'</a></li>';

	}
	$html.='</ul><div class="lts_tab">'.do_shortcode($content).'</div></div><div style="clear:both"></div>';
	return $html;
}
add_shortcode('tabs', 'layersc_tabs');

function layersc_tab($atts, $content = null) {
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	return '<div class="lts_tab_child '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode('tab', 'layersc_tab');

/**Toggles **/
/**USAGE: [toggle title="ToggleMe"]your content[/toggle]
**/
function layersc_toggle($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"id" => '',
		"class" => '',
	), $atts));
	$titlearr=explode(',',$title);
	$html='<div class="lts_toggle '.$class.'" id="'.$id.'"><div class="trigger_wrap">';
	foreach($titlearr as $title){
		$html.='<a class="trigger"><i class="fa fa-plus"></i> '.$title.'</a></div>';
	}
	$html.='<div class="lts_toggle_content" style="display:none;">'.do_shortcode($content).'<div style="clear:both"></div></div></div>';
	return $html;
}
add_shortcode('toggle', 'layersc_toggle');



/**Custom Button Shortcode **/
/**USAGE: [button class="violet"][/button]
**/
function layersc_button_func($atts, $content = null) {

	//extract short code attr
	extract(shortcode_atts(array(
	'text'=> '',
	'url' => 'http://www.google.com',
	'background_color' => '#2dcb73'	,
	'text_color' => '#ffffff',
	'style' => 'lt_flat', //lt_flat, lt_hollow, lt_circular
	'size' => 'default', //default, large, small
	'icon'=>'',
	'onclick'=>'',
	'open_new_window' => true,
	'rounded' => 'false',
	'class' => '',
	), $atts));
	
	$roundeds =''; $open_new_windows =''; $icons =''; $shortwindow =''; $shortround ='';
	if ($rounded == 'true'){
		$roundeds= 'lt_rounded';
		$shortround ='true';
	}
	if ($rounded == 'false'){
		$roundeds= '';
	}
		
	if ($icon !== ''){
		$icons = '<i class="fa '.$icon.'"></i> ';
		}
	if ($open_new_window == 'true'){
		$open_new_windows= 'target="_blank"';
		$shortwindow ='true';
		}
	if ($open_new_window == 'false'){
		$open_new_windows= '';
		}
		
	if ($onclick !== ''){
		$onclick = 'onclick='.$onclick .'';
		}
		
		if(is_customize_preview()){ 
			$nonedit = 'inline_shortcode';
			$short = 'data-shortcode="[button text=&quot;'.$text.'&quot; url=&quot;'.$url.'&quot; background_color=&quot;'.$background_color.'&quot; text_color=&quot;'.$text_color.'&quot; style=&quot;'.$style.'&quot; size=&quot;'.$size.'&quot; icon=&quot;'.$icon.'&quot; open_new_window=&quot;'.$shortwindow.'&quot; rounded=&quot;'.$shortround.'&quot;]"';
			$inline = 'data-btn-text="'.$text.'"  data-btn-url="'.$url.'" data-btn-bg="'.$background_color.'" data-btn-color="'.$text_color.'" data-btn-style="'.$style.'" data-btn-size="'.$size.'" data-btn-icon="'.$icon.'"  data-btn-window="'.$shortwindow.'"  data-btn-rounded="'.$shortround.'"  data-btn-class="'.$class.'"   ';
			$href ='';
		}else{
			$nonedit = ''; $inline ='';$short = '';
			
			$href = 'href="'.$url.'"';
		}
		
	
	$return_html = '<a class="lts_button lts_button_sc lts_button_'.$size.' '.$roundeds.' '.$style.' '.$class.' '.$nonedit.'" '.$open_new_windows.' style="background:'.$background_color.';color:'.$text_color.';border-color:'.$background_color.';" '.$href.' '.$short.' '.$inline.' '.$onclick.'>'.$icons .$text.'</a>';
	
	return $return_html;
}

add_shortcode('button', 'layersc_button_func');


/**Call to Action Shortcode **/
/**USAGE: [callaction url=""][/button]
**/
function layersc_callaction_func($atts, $content = null) {

	//extract short code attr
	extract(shortcode_atts(array( 
	'button_url' => 'http://www.google.com', 
	'button_text' => 'My Button',
	'button_background_color' => '#e64429',
	'button_text_color' => '#ffffff'	,
	'background_color' => '#2dcb73'	,
	'text_color' => '#ffffff',
	'rounded'=> '',
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($rounded == 'true'){
		$rounded = ' lt_rounded';
	}else{
		$rounded = '';
	}
	
	$return_html = '<div style="background:'.$background_color.';color:'.$text_color.'!important;" class="ast_shrt_action'.$rounded.' '.$class.' '.$nonedit.'"><div class="act_left">'.$content.'</div><div class="act_right"><a class="'.$rounded.'" style="background:'.$button_background_color.';color:'.$button_text_color.'!important;" href="'.$button_url.'">'.$button_text.'</a></div></div><div style="clear:both"></div>';
	
	return $return_html;
}

add_shortcode('callaction', 'layersc_callaction_func');

/**Table Shortcode **/
/**USAGE: [table]
**/
function layersc_table_func( $atts ) {
    extract( shortcode_atts( array(
        'cols' => 'none',
        'data' => 'none',
		'class' => '',
    ), $atts ) );
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
	$output = "";
    $output .= '<table class="ast_table '.$class.' '.$nonedit.'"><tr class="th">';
    foreach($cols as $col):
        $output .= '<td>'.$col.'</td>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'.$datum.'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
        $output .= '</table>';
    return $output;
}
add_shortcode( 'table', 'layersc_table_func' );



/**Featured Image SHORTCODE **/
/** [featimage align="left"]**/
function layersc_featimage($atts) {

	//extract short code attr
	extract(shortcode_atts(array('align' => 'alignleft', 'size'=>'full', 'class' => '',), $atts));

	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if (has_post_thumbnail() ) {
		$image_id = get_post_thumbnail_id();  
		$image_url = wp_get_attachment_image_src($image_id, $size);  
		$image_url = $image_url[0]; 
		$result = '<div class="'.$class.' '.$nonedit.'" style="width:100%;"><img src="'.$image_url.'" class="'.$align.'" /><div style="clear:both"></div></div>';
		return $result;
	}
	return;
}

add_shortcode('featimage', 'layersc_featimage');


/**ToolTip **/
/**USAGE: [tooltip]Your Tooltip text here[/tooltip]**/
function layersc_tooltip( $atts, $content = null ) {
	extract(shortcode_atts(array('tipcontent' => '',  'class' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<span class="tooltip lts_tooltip '.$class.' '.$nonedit.'" title="'.$tipcontent.'">'.do_shortcode($content).'</span>';
}
add_shortcode( 'tooltip', 'layersc_tooltip' );


/**Drop Cap **/
/**USAGE: [drop_cap]Your Drop Cap text here[/drop_cap]**/
function layersc_dropcap( $atts, $content = null ) {
	extract(shortcode_atts(array('color' => '#fff' , 'background' => '#2dcb73', 'class' => '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<span style="color:'.$color.';background:'.$background.';" class="lts_dropcap '.$class.' '.$nonedit.'">'.do_shortcode($content).'</span>';
}
add_shortcode( 'drop_cap', 'layersc_dropcap' );


/**PROGRESS BAR **/
/**USAGE: [progress percent="40"]**/
function layersc_progress( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'title' => '' ,
	'percent' => '70' ,
	'style' => 'bold' , //bold, thin, circular
	'color' => '#fff' , 
	'background' => '#2dcb73', 
	'rounded'=> "false", 
	'stripes'=> "true",
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
		
	if($rounded == "true"){
		$rounded = 'progress_rounded';
	}else{
		$rounded = '';
		}
		
	if($stripes == "true"){
		$stripes = ' progress_stripes';
	}else{
		$stripes = '';
		}
		
	if(!empty($title)){$title = '<div class="progress_title">'.do_shortcode($title).'</div>';	}else{ $title = '';	}
	
	if($style == "circular"){ $circular = '<div class="circle_progress" data-progress="'.($percent/100).'" data-background="'.$background.'"><strong>'.$percent.'%</strong></div>'.$title;}else{ $circular = '';}
		
		return '<div class="progressbar_wrap progress_'.$style.' '.$nonedit.'">'.$title.'<div class="lts_progress '.$rounded. $stripes.' '.$class.'"><span>'.$percent.'%</span><div class="lts_progress_wrap"><div title="'.$percent.'%" class="lts_progress_inner tooltip" style="width:'.$percent.'%;color:'.$color.';background-color:'.$background.';"></div></div></div>'.$circular.'</div>';
		
		
}
add_shortcode( 'progress', 'layersc_progress' );

/**Section SHORTCODE **/
/**USAGE: [section]Your Content[/section]**/
function layersc_section( $atts, $content = null ) {
	extract(shortcode_atts(array('background_image' => '', 'text_color' => '#666666','background_color' => '#eeeeee','class'=> '',), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if(!empty($background_image)){
		$background_image= 'background-image:url('.$background_image.')';
		}
	  return '<div style="background-color:'.$background_color.'; color:'.$text_color.';'.$background_image.'" class="lts_section '.$class.' '.$nonedit.'"><div class="lts_section_body">'.do_shortcode($content).'</div></div>';
}
add_shortcode( 'section', 'layersc_section' );


/**Block Shortcode **/
/**USAGE: [block width="full" background="#ffffff" text_color="#555" shadow="true"]Your Content[/block]**/
function layersc_block( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'text_color' => '#999999',
	'background' => '#ffffff',
	'shadow'=> false,
	'rounded'=> false,
	'class'=> '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($shadow !==''){
		$shadow = '';
	}else{
		$shadow = 'lt_shadow';
	}
	
	if($rounded =='true'){
		$rounded = 'lt_rounded';
	}else{
		$rounded = '';
	}
	
		return '<div class="lts_block '.$shadow.' '.$rounded.' '.$class.' '.$nonedit.'" style="background:'.$background.';color:'.$text_color.';">'.do_shortcode($content).'</div>';
}
add_shortcode( 'block', 'layersc_block' );

function layersc_blocks( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'layout' => 'layout1', 
	'class'=> '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div class="lts_blocks lts_blocks_'.$layout.' '.$class.' '.$nonedit.'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'blocks', 'layersc_blocks' );



/**PANEL SHORTCODE **/
/**USAGE: [panel title="Your Panel Title"]Your Content[/panel]**/
function layersc_panel( $atts, $content = null ) {
	extract(shortcode_atts(array('title' => '', 'text_color' => '#ffffff','background_color' => '#428bca','class'=> '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '<div style="border-color:'.$background_color.'" class="lts_panel '.$class.' '.$nonedit.'"><h3 style="background-color:'.$background_color.';color:'.$text_color.'">'.$title.'</h3><div class="lts_panel_body">'.do_shortcode($content).'<div style="clear:both"></div></div></div>';
}
add_shortcode( 'panel', 'layersc_panel' );



/**ABOUT AUTHOR SHORTCODE **/
/**USAGE: [author name="Jane Doe" image="" facebook="" twitter="" google="" linkedin="" website=""]Author bio[/author]**/
function layersc_author( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'name' => '', 
	'name_text_color' => '#428bca',
	'background' => '',
	'image' => '',
	'facebook' => '',
	'twitter' => '',
	'google' => '',
	'linkedin' => '',
	'website' => '',
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if($image !==''){$image ='<div class="author_image"><img src="'.$image.'" alt="'.$name.'" title="'.$name.'" /></div>';  }else{  $image ='';  }
	
	if($facebook !==''){ $facebook ='<a href="'.esc_url($facebook).'"><i class="fa fa-facebook-square"></i></a>';  }else{  $facebook ='';  }
	if($twitter !==''){ $twitter ='<a href="'.esc_url($twitter).'"><i class="fa fa-twitter-square"></i></a>';  }else{  $twitter ='';  }
	if($google !==''){ $google ='<a href="'.esc_url($google).'"><i class="fa fa-google-plus-square"></i></a>';  }else{  $google ='';  }
	if($linkedin !==''){ $linkedin ='<a href="'.esc_url($linkedin).'"><i class="fa fa-linkedin-square"></i></a>';  }else{  $linkedin ='';  }
	if($website !==''){ $website ='<a href="'.esc_url($website).'"><i class="fa fa-globe"></i></a>';  }else{  $website ='';  }
	
		return '
		<div class="lts_author '.$class.' '.$nonedit.'" style="background:'.$background.'">
			'.$image.'
			<div class="author_content">
				<h5 style="color:'.$name_text_color.'">'.$name.'</h5>
				<div class="lts_author_body">'.do_shortcode($content).'
				<p class="athor_social">'.$facebook. $twitter .$google .$linkedin .$website.'</p>
				</div>
			</div>
		</div>';
}
add_shortcode( 'author', 'layersc_author' );


/**CAROUSEL SHORTCODE **/
/**USAGE: [carousel border_style="thick"][carousel_item]Your HTML Content Here[/carousel_item][/carousel]**/
function layersc_carousel( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'style' => 'default', //default or thick_border
	'background' => '#ffffff',
	'button_color'=> '#eeeeee;',
	'text_color' => '#999999',
	'class' => '',
	), $atts));

	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '
		<div class="looper slide lts_looper lts_'.$style.' '.$class.' '.$nonedit.'" data-looper="go" data-interval="4000" data-buttoncolor="'.$button_color.'" style="background:'.$background.';color:'.$text_color.'">
			<div class="looper-inner">
			'.do_shortcode($content).'
			</div>
			<nav>
				<ul class="looper-nav"></ul>
			</nav>
		</div>	
			';
}
add_shortcode( 'carousel', 'layersc_carousel' );

function layersc_carousel_item( $atts, $content = null ) {
	
		return '<div class="item">'.do_shortcode($content).'</div>';
}
add_shortcode( 'carousel_item', 'layersc_carousel_item' );


/**Section SHORTCODE **/
/**USAGE: [search label="Search" text_color="#ffffff" background_color="#333333"]**/
function layersc_searchform( $atts, $content = null ) {
	extract(shortcode_atts(array('label' => 'Search', 'text_color' => '#666666','background_color' => '#eeeeee','class'=> '',), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}

	  return '<form role="search" method="get" class="lts_search-form '.$class.' '.$nonedit.'" action="'.home_url( '/' ).'">
		<input type="search" class="search-field" placeholder="'.$label.'" value="'.get_search_query().'" name="s" />
	<input type="submit" class="search-submit" value="'.$label.'" style="color:'.$text_color.';background:'.$background_color.';"/></form>';
	  
}
add_shortcode( 'searchform', 'layersc_searchform' );



/**PRICING SHORTCODE **/
/**USAGE: [pricing background="#ffffff" text_color="#999" button_color="#8ab71b"][pricebox]Your HTML Content Here[/pricebox][/pricing]**/
function layersc_pricing( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'background' => '#ffffff',
	'text_color' => '#999999', 
	'button_bg_color' => '#8ab71b', 
	'button_text_color' => '#ffffff',
	'style' => '1',
	'class' => '',
	), $atts));
	
		if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
		return '
		<div class="lts_pricing '.$class.' '.$nonedit.' pricing_style'.$style.'" style="color:'.$text_color.'" data-button-bg="'.$button_bg_color.'" data-button-txt="'.$button_text_color.'" data-price-bg="'.$background.'" data-price-txt="'.$text_color.'">
		'.do_shortcode($content).'
		</div>	
			';
}
add_shortcode( 'pricing', 'layersc_pricing' );

function layersc_pricebox( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name' => 'Package1', 
		'price' => '$30', 
		'price_label'=> 'month',
		'description' => '',
		'features'=>'',
		'button_text'=>'Signup',
		'button_link'=>'',
		'featured'=> '',
	), $atts));
		
		if($price_label !==''){
			$price_label = '<span class="price_label">/'.$price_label.'</span>';
		}else{
		$price_label = '';
		}
		
		if($featured !==''){
			$featured = '<span class="feat_wrap"><span class="pricebox_featured">'.$featured.'</span></span>';
		}else{
		$featured = '';
		}
		
		if($name !==''){		
		return '
		<div class="pricebox"><div class="pricebox_inner">
			'.$featured.'
			<div class="price_head">
			<h3>'.$name.'</h3>
			<span class="price_ammount">'.$price.'</span>'.$price_label.'
			<p class="price_desc">'.do_shortcode($description).'</p>
			</div>
			<div class="price_body">'.do_shortcode($features).'</div>
			<div class="price_footer"><a href="'.$button_link.'" class="price_button">'.$button_text.'</a></div>
		</div></div>';
		}
}
add_shortcode( 'pricebox', 'layersc_pricebox' );

/**Lightbox Shortcode **/
/**USAGE: [lightbox button_text="Check This Out"] Your content that you want to display in a lightbox [/lightbox]
**/
function layersc_lightbox_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'button_text' => '',
		'button_text_color' => '',
		'button_text_bg' => '',
		'button_font_size' => '',
		'button_style' => 'lt_flat', //lt_flat, lt_hollow, lt_circular
		'button_size' => 'medium', //medium, large, small
		'rounded'=>'true',
		'image'=>'',
		'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	if ($button_text_color !== ''){
		$button_text_color= 'color:'.$button_text_color.';';
		}
	if ($button_text_bg !== ''){
		$button_text_bg= 'background:'.$button_text_bg.';';
		}
	if ($button_font_size !== ''){
		$button_font_size= 'font-size:'.$button_font_size.';';
		}
	if ($rounded == 'true'){
		$rounded= 'lt_rounded';
	}else{
		$rounded= '';
	}
	$hasimg = '';
	if (!empty($image)){
		$button_text = '<img src="'.$image.'" />';
		$hasimg = 'ltbximg';
	}
	
		
	
	$return_html = '<span style="'.$button_text_color. $button_text_bg .$button_font_size.'" class="lts_lightbox_bttn lt_animate '.$rounded.' '.$button_style.' '.'lts_button_'.$button_size.' '.$class.' '.$nonedit.' '.$hasimg.'">'.$button_text.'</span><div style="display:none" class="lts_lightbox_content">'.do_shortcode($content).'</div>';
	
	
	return $return_html;
}
add_shortcode('lightbox', 'layersc_lightbox_func');




/**MAP SHORTCODE **/
/**USAGE: [map latitude="53.359286" longitude="-2.040904" text="This Text Appears when you hover over the bubble"]**/
function layersc_map( $atts, $content = null ) {
	global $optimizer;
	if(!empty($optimizer['map_api'])){ $mapkey = 'https://maps.googleapis.com/maps/api/js?key='.$optimizer['map_api'].''; }else{ $mapkey = 'https://maps.googleapis.com/maps/api/js?sensor=false';}
	
	wp_enqueue_script('optimizer_map',get_template_directory_uri().'/assets/js/map-styles.js', array('jquery'),'1.0', true);
	wp_enqueue_script('optimizer_googlemaps', $mapkey, array('jquery'),'1.0', true);
	extract(shortcode_atts(array(
		'latitude' => '53.359286' , 
		'longitude' => '-2.040904', 
		'text' => 'Your Location Details.',
		'height' => '300px',
		'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	return '<div class="lts_map_wrap '.$class.' '.$nonedit.'" style="height:'.$height.'"><div data-map-lat="'.$latitude.'" data-map-long="'.$longitude.'" data-map-text="'.$text.'" class="lts_map"></div></div>';

}
add_shortcode( 'map', 'layersc_map' );


/**ICON SHORTCODE **/
/**USAGE: [icon type="fa-star" color="#999999" size="20px"]**/
function layersc_icon( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'type' => 'fa-star',
	'color'=> '',
	'size'=> '',
	'style'=> '', //plain, circle_thin, circle_thick, circle_color, square_thin, square_thick, square_color
	'link'=> '',
	'new_window'=> 'true',
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	$widthheight = '';
	$bgcolor = '';
	$linkstart = '';
	$linkend = '';
	
	if ( $style !== '' || $style !== 'plain'){
		$widthheight = 'width:'.$size.';height:'.$size.';';
	}

	if($style == 'circle_color' || $style == 'square_color'){
		$bgcolor = 'background:'.$color.';';
	}
	if ( $link !== '' ){
		if($new_window == 'true'){
			$linkstart = '<a target="_blank" href="'.esc_url($link ).'">';
		}else{	
			$linkstart = '<a href="'.esc_url($link ).'">';
		}
		$linkend = '</a>';
	}

	
	return ''.$linkstart.'<i style="color:'.$color.';font-size:'.$size.';'.$widthheight.' '.$bgcolor.'" class="fa '.$type.' '.$class.' icon_style_'.$style.' '.$nonedit.'"></i>'.$linkend.'';
}
add_shortcode( 'icon', 'layersc_icon' );

/**CUSTOM HEADLINE SHORTCODE **/
/**USAGE: [headline type="type1"][/headline]**/
function layersc_headline( $atts, $content = null ) {
	extract(shortcode_atts(array(
	'type' => 'type1', 
	'color'=> '#999999',
	'text'=> '',
	'size' => 'h2',
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	return '<'.$size.' class="lts_headline_parent lts_headline_'.$type.' '.$class.' '.$nonedit.'"><span style="color:'.$color.';" class="lts_headline headline_'.$type.'">'.do_shortcode($content).'</span></'.$size.'>';
}
add_shortcode( 'headline', 'layersc_headline' );



/**
 * @package Display Posts
 * @version 2.4
 * @author Bill Erickson <bill@billerickson.net>
 * @copyright Copyright (c) 2011, Bill Erickson
 * @link http://www.billerickson.net/shortcode-to-display-posts/
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
// Create the shortcode
add_shortcode( 'display-posts', 'optimizer_display_posts_shortcode' );
function optimizer_display_posts_shortcode( $atts ) {

	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'title'              => '',
		'author'              => '',
		'category'            => '',
		'layout'			  => 'layout1',
		'date_format'         => 'F jS, Y ',
		'display_posts_off'   => false,
		'exclude_current'     => true,
		'id'                  => false,
		'ignore_sticky_posts' => false,
		'image_size'          => 'large',
		'include_title'       => true,
		'include_author'      => false,
		'include_content'     => false,
		'include_date'        => false,
		'include_excerpt'     => true,
		'meta_key'            => '',
		'meta_value'          => '',
		'no_posts_message'    => '',
		'offset'              => 0,
		'order'               => 'DESC',
		'orderby'             => 'date',
		'post_parent'         => false,
		'post_status'         => 'publish',
		'post_type'           => 'post',
		'posts_per_page'      => '10',
		'tag'                 => '',
		'tax_operator'        => 'IN',
		'tax_term'            => false,
		'taxonomy'            => false,
		'wrapper'             => 'div',
		'wrapper_class'       => 'display-posts-listing',
		'class'					=> '',
		'wrapper_id'          => false,
	), $atts, 'display-posts' );


	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	// End early if shortcode should be turned off
	if( $atts['display_posts_off'] )
		return;

	$shortcode_title = sanitize_text_field( $atts['title'] );
	$author = sanitize_text_field( $atts['author'] );
	$category = sanitize_text_field( $atts['category'] );
	$layout = sanitize_text_field( $atts['layout'] );
	$date_format = sanitize_text_field( $atts['date_format'] );
	$exclude_current = optimizer_display_posts_bool( $atts['exclude_current'] );
	$id = $atts['id']; // Sanitized later as an array of integers
	$ignore_sticky_posts = optimizer_display_posts_bool( $atts['ignore_sticky_posts'] );
	$image_size = sanitize_key( $atts['image_size'] );
	$include_title = optimizer_display_posts_bool( $atts['include_title'] );
	$include_author = optimizer_display_posts_bool( $atts['include_author'] );
	$include_content = optimizer_display_posts_bool( $atts['include_content'] );
	$include_date = optimizer_display_posts_bool( $atts['include_date'] );
	$include_excerpt = optimizer_display_posts_bool( $atts['include_excerpt'] );
	$meta_key = sanitize_text_field( $atts['meta_key'] );
	$meta_value = sanitize_text_field( $atts['meta_value'] );
	$no_posts_message = sanitize_text_field( $atts['no_posts_message'] );
	$offset = intval( $atts['offset'] );
	$order = sanitize_key( $atts['order'] );
	$orderby = sanitize_key( $atts['orderby'] );
	$post_parent = $atts['post_parent']; // Validated later, after check for 'current'
	$post_status = $atts['post_status']; // Validated later as one of a few values
	$post_type = sanitize_text_field( $atts['post_type'] );
	$posts_per_page = intval( $atts['posts_per_page'] );
	$tag = sanitize_text_field( $atts['tag'] );
	$tax_operator = $atts['tax_operator']; // Validated later as one of a few values
	$tax_term = sanitize_text_field( $atts['tax_term'] );
	$taxonomy = sanitize_key( $atts['taxonomy'] );
	$wrapper = sanitize_text_field( $atts['wrapper'] );
	$wrapper_class = sanitize_html_class( $atts['wrapper_class'] );
	$class = sanitize_html_class( $atts['class'] );
	
	if( !empty( $wrapper_class ) )
		$wrapper_class = ' class="' . $wrapper_class . ' lts_'.$layout.' '.$class.'"';
	$wrapper_id = sanitize_html_class( $atts['wrapper_id'] );
	if( !empty( $wrapper_id ) )
		$wrapper_id = ' id="' . $wrapper_id . '"';

	//If Category null display empty\
	if($category =='null'){
		$category='';
		}
	//If tag null display empty\
	if($tag =='null'){
		$tag='';
		}
	//If post_type null display empty\
	if($post_type =='null'){
		$post_type='';
		}

	// Set up initial query for post
	$args = array(
		'category_name'       => $category,
		'order'               => $order,
		'orderby'             => $orderby,
		'post_type'           => explode( ',', $post_type ),
		'posts_per_page'      => $posts_per_page,
		'tag'                 => $tag,
	);
	


	// Ignore Sticky Posts
	if( $ignore_sticky_posts )
		$args['ignore_sticky_posts'] = true;

	// Meta key (for ordering)
	if( !empty( $meta_key ) )
		$args['meta_key'] = $meta_key;

	// Meta value (for simple meta queries)
	if( !empty( $meta_value ) )
		$args['meta_value'] = $meta_value;

	// If Post IDs
	if( $id ) {
		$posts_in = array_map( 'intval', explode( ',', $id ) );
		$args['post__in'] = $posts_in;
	}

	// If Exclude Current
	if( $exclude_current )
		$args['post__not_in'] = array( get_the_ID() );

	// Post Author
	if( !empty( $author ) )
		$args['author_name'] = $author;

	// Offset
	if( !empty( $offset ) )
		$args['offset'] = $offset;

	// Post Status	
	$post_status = explode( ', ', $post_status );		
	$validated = array();
	$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
	foreach ( $post_status as $unvalidated )
		if ( in_array( $unvalidated, $available ) )
			$validated[] = $unvalidated;
	if( !empty( $validated ) )		
		$args['post_status'] = $validated;


	// If taxonomy attributes, create a taxonomy query
	if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {

		// Term string to array
		$tax_term = explode( ', ', $tax_term );

		// Validate operator
		if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) )
			$tax_operator = 'IN';

		$tax_args = array(
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $tax_term,
					'operator' => $tax_operator
				)
			)
		);

		// Check for multiple taxonomy queries
		$count = 2;
		$more_tax_queries = false;
		while( 
			isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && 
			isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] ) 
		):

			// Sanitize values
			$more_tax_queries = true;
			$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
	 		$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
	 		$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts['tax_' . $count . '_operator'] : 'IN';
	 		$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';

	 		$tax_args['tax_query'][] = array(
	 			'taxonomy' => $taxonomy,
	 			'field' => 'slug',
	 			'terms' => $terms,
	 			'operator' => $tax_operator
	 		);

			$count++;

		endwhile;

		if( $more_tax_queries ):
			$tax_relation = 'AND';
			if( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) ) )
				$tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
		endif;

		$args = array_merge( $args, $tax_args );
	}

	// If post parent attribute, set up parent
	if( $post_parent ) {
		if( 'current' == $post_parent ) {
			global $post;
			$post_parent = get_the_ID();
		}
		$args['post_parent'] = intval( $post_parent );
	}

	// Set up html elements used to wrap the posts. 
	// Default is ul/li, but can also be ol/li and div/div
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if( ! in_array( $wrapper, $wrapper_options ) )
		$wrapper = 'ul';
	$inner_wrapper = 'div' == $wrapper ? 'div' : 'li';


	$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $original_atts ) );
	if ( ! $listing->have_posts() )
		return apply_filters( 'display_posts_shortcode_no_results', wpautop( $no_posts_message ) );

	$inner = '';
	$cats = '';
	while ( $listing->have_posts() ): $listing->the_post(); global $post;

		$image = $date = $author = $excerpt = $content = '';

		if ( $include_title )
			if( $layout == 'layout1'){
				$title = '<h2 class="lt_animate"><a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) .'">'. get_the_title() .'</a></h2>';
			}else{
				$title = '<h2 class="lt_animate"><a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) .'">' . get_the_title().'</a></h2>';
			}
		
		if( $layout !== 'layout5'){
		if ( $image_size && has_post_thumbnail() )  
			$image = '<div class="img_wrap"><div class="icon_wrap animated fadeInUp"><a href="' . get_permalink() . '"><i class="fa fa-plus"></i></a></div><a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a></div>';
			
			if ( !has_post_thumbnail() && optimizer_first_image() !== '') 
			$image = '<div class="img_wrap"><a href="' . get_permalink() . '"><i class="optimizer_plus">+</i></a><a class="image" href="' . get_permalink() . '"><img src="' . optimizer_first_image('large'). '" /></a></div>';
			
			if ( $image_size && !has_post_thumbnail() && optimizer_first_image() == '') 
			$image = '<div class="img_wrap"><a href="' . get_permalink() . '"><i class="optimizer_plus">+</i></a><a class="image" href="' . get_permalink() . '"><img src="' . optimizer_placeholder_image(). '" width="500" height="350" /></a></div>';
		}
		
		if( $layout == 'layout4' || $layout == 'layout5' )
			$date = ' <span class="lt_date"><i class="fa-calendar"></i> ' . get_the_date( $date_format ) . '</span>';

		if( $layout == 'layout4' || $layout == 'layout5' )
			$author = apply_filters( 'display_posts_shortcode_author', ' <span class="lt_author"><i class="fa-user"></i> ' . get_the_author() . '</span>' );

		if( $layout == 'layout4' || $layout == 'layout5' )
			$cats = apply_filters( 'display_posts_shortcode_author', ' <div class="lt_cats"><i class="fa-th-list"></i> ' . get_the_category_list() . '</div>' );
			
		if ( $include_excerpt ) 
			if($layout == 'layout2' || $layout == 'layout3'){
			$excerpt = '<span class="excerpt">' . wp_trim_words( strip_shortcodes($post->post_content), 18) . '</span>';
			}
			if($layout == 'layout4'){
			$excerpt = '<span class="excerpt">' . wp_trim_words( strip_shortcodes($post->post_content), 55). '</span><div class="blog_mo"><a href="' . get_permalink() . '">'.__('+ Read More', 'optimizer').'</a></div>';
			}
			
		if( $include_content || $layout == 'layout5' ) {
			add_filter( 'shortcode_atts_display-posts', 'optimizer_display_posts_off', 10, 3 );
			$content = '<div class="lt_content">' . apply_filters( 'the_content', get_the_content() ) . '</div>'; 
			remove_filter( 'shortcode_atts_display-posts', 'optimizer_display_posts_off', 10, 3 );
		}

		$class = array( 'listing-item' );
		$class = sanitize_html_class( apply_filters( 'display_posts_shortcode_post_class', $class, $post, $listing, $original_atts ) );
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">'. $image . $title . $date . $author . $cats . $excerpt . $content . '</' . $inner_wrapper . '>';

		// If post is set to private, only show to logged in users
		if( 'private' == get_post_status( get_the_ID() ) && !current_user_can( 'read_private_posts' ) )
			$output = '';

		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class );

	endwhile; wp_reset_postdata();

	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . $wrapper_class . $wrapper_id . '>', $original_atts );
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts );

	$return = $open;

	if( $shortcode_title ) {

		$title_tag = apply_filters( 'display_posts_shortcode_title_tag', 'h2', $original_atts );

		$return .= '<' . $title_tag . ' class="display-posts-title">' . $shortcode_title . '</' . $title_tag . '>' . "\n";
	}

	$return .= $inner . $close;

	return $return;
}


/**
 * Turn off display posts shortcode 
 * If display full post content, any uses of [display-posts] are disabled
 *
 * @param array $out, returned shortcode values 
 * @param array $pairs, list of supported attributes and their defaults 
 * @param array $atts, original shortcode attributes 
 * @return array $out
 */
function optimizer_display_posts_off( $out, $pairs, $atts ) {
	$out['display_posts_off'] = apply_filters( 'display_posts_shortcode_inception_override', true );
	return $out;
}

/**
 * Convert string to boolean
 * because (bool) "false" == true
 *
 */
function optimizer_display_posts_bool( $value ) {
	return !empty( $value ) && 'true' == $value ? true : false;
}

/**Call to Action Shortcode **/
/**USAGE: [callaction url=""][/button]
**/
function optmizersc_breadcrumbs($atts, $content = null) {
	
	extract(shortcode_atts(array(
	'align' => 'center', 
	'home'=> __('Home','optimizer'),
	'class' => '',
	), $atts));
	
	if(is_customize_preview()){ $nonedit = 'mceNonEditable blockshortcode';}else{$nonedit = '';}
	
	$return_html = '<div class="breadcrumbs_shortcode bread_align_'.$align.' '.$class.' '.$nonedit.'">'.breadcrumb_trail(array( 'show_browse'=> false,'echo'=> false, 'labels' => array('home' => $home ) )).'</div>';
	
	return $return_html;
}

add_shortcode('breadcrumbs', 'optmizersc_breadcrumbs');