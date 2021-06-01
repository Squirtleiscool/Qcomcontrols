<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Youtube {
    
	
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() {
	 
	    add_shortcode( 'ms_youtube', array( $this,'render' ) );
	
	}
	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
     function render( $args, $content = '') {
		
		Helper::get_style_depends(['magee-shortcodes']);
		Helper::get_script_depends(['magee-shortcodes']);
	
		$defaults =  Helper::set_shortcode_defaults(
			
			array(
				'type'               =>'',
				'id'                    =>'',
				'class'                 =>'',
				'width'                 =>'',
				'height'                =>'',
				'mute'                  =>'',
				'link'                  =>'',
				'autoplay'        =>'',
				'loop'            =>'',    
				'controls'        =>'',  
				'position'   => 'left',
				'is_preview' => ''
			), $args
		);
	
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($width))
			$width = $width.'px';
		if(is_numeric($height))
			$height = $height.'px';
		
		$autoplay = ( $autoplay == 'yes') ? 1 : 0;
		$loop = ( $loop == 'yes') ? 1 : 0;
		$controls = ( $controls == 'yes') ? 1 : 0;
		$mute = ( $mute == 'yes') ? 1 : 0;
		$autoplay = ( $autoplay == 'yes') ? 1 : 0;
		$autoplay = ( $autoplay == 'yes') ? 1 : 0;
		$autoplay = ( $autoplay == 'yes') ? 1 : 0;
	
		$html = '';
		$sid = Utils::rand_str("");
		$wid = Utils::rand_str("youtube-");
		$script = '';

		if(preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $link, $matches) ){
			$sid = $matches[0];
		};
		
		if( ($width == '100%' && $height == '100%') || ($width == '' && $height == '')):
		$html .= "<div id=\"".$wid."\" class=\"magee-shortcode magee-youtube youtube-video " .$position . "\"><iframe id=\"player_".$sid."\" class=\"".$class."\" src=\"//www.youtube.com/embed/" . $sid . "?rel=0&controls=".$controls."&loop=".$loop."&playlist=".$sid."&autoplay=".$autoplay."&enablejsapi=".$mute."\" frameborder=\"0\" allowfullscreen></iframe>";
		
			$$script .= "
			jQuery(function($) {
				var tag = document.createElement('script');
				var tag = document.createElement('script');
				tag.src = \"//www.youtube.com/iframe_api\";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				var player;
				function onYouTubeIframeAPIReady() {
					player = new YT.Player('player_" .$sid ."', {
					events: {
						'onReady': onPlayerReady
					}
					});
				}
				function onPlayerReady(event) {
					player.playVideo();
					event.target.mute();
				}
			});
			";
						
			$script .=  '
			jQuery(function($) {
				divwidth = $("#'.$wid.'").width();
				width = $("#player_'.$sid.'").width();
				height = $("#player_'.$sid.'").height();
				op = height/width;
				$("#player_'.$sid.'").width(divwidth);
				$("#player_'.$sid.'").height(op*divwidth);
			});';
				
		$html .= "</div>";
		else:
		$html .= "<div id=\"".$wid."\" class=\"youtube-video " .$position . "\"><iframe id=\"player_".$sid."\" class=\"".$class."\" width=\"".$width."\" height=\"".$height."\" src=\"//www.youtube.com/embed/" . $sid . "?rel=0&controls=".$controls."&loop=".$loop."&playlist=".$sid."&autoplay=".$autoplay."&enablejsapi=".$mute."\" frameborder=\"0\" allowfullscreen></iframe>";
		
		$script .= "
		jQuery(function($) {
			var tag = document.createElement('script');
			var tag = document.createElement('script');
			tag.src = \"//www.youtube.com/iframe_api\";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player_" .$sid ."', {
				events: {
					'onReady': onPlayerReady
				}
				});
			}
			function onPlayerReady(event) {
				player.playVideo();
				event.target.mute();
			}
		});
			";
		$html .= "</div>"; 
		endif;
		
		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->editor->is_edit_mode() ){
			$is_preview = "1";
		}

		if ($is_preview == "1"){
			$html = sprintf( '%1$s<script>%2$s</script>' , $html, $script );
		}else{
			wp_add_inline_script('magee-shortcodes', $script, 'after');
		}

		return $html; 
	 } 
	 
}

new Magee_Youtube();