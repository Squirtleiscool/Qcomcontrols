<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Vimeo {
    
	
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() {
	 
	    add_shortcode( 'ms_vimeo', array( $this,'render' ) );
	
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
		$sid = '';
		$class .= ' magee-vimeo';
		if( $autoplay == 'yes'):
		$autoplay = '1';
		else:
		$autoplay = '0';
		endif;
		if( $loop == 'yes'):
		$loop = '1';
		else:
		$loop = '0';
		endif;
		if( $controls == 'yes'):
		$controls = '1';
		else:
		$controls = '0';
		endif;
		if( $mute == 'yes'):
		$mute = '1';
		else:	 
		$mute = '0';
		endif; 
		$sid = Utils::rand_str("");
		$script = '';

		if($link !== ''){
			if(preg_match( '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $link, $match)){
			$sid = $match[5];
			};
		}
		$html = "<div id=\"vimeo\" class=\"magee-shortcode magee-vimeo-video vimeo-video " .$position . "\" data-width='".$width."' data-height='".$height."' data-mute='".$mute."'>";
		if ($mute == 1) {
			wp_enqueue_script( 'jquery-froogaloop', 'https://f.vimeocdn.com/js/froogaloop2.min.js',
				array( 'jquery' ),
				null, // No version of the jQuery froogaloop2 Plugin.
				true 
			);
		}
		preg_match('/https/', $link, $link_match);
		
		if( ($width == '100%' && $height == '100%') || ($width == '' && $height == '')):
			if(implode($link_match) == ''){
				$html .= "<iframe id=\"player_" .$sid  ."\" class=\"" .$class ."\"  src=\"http://player.vimeo.com/video/" .$sid ."?api=1&player_id=player_" .$sid ."&title=0&amp;amp;byline=0&amp;amp;portrait=0&amp;amp;color=d01e2f&amp;amp;&loop=" .$loop. "&controls=" .$controls. "&autoplay=" .$autoplay. "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>" ;
			}else{
				$html .= "<iframe id=\"player_" .$sid  ."\" class=\"" .$class ."\"  src=\"https://player.vimeo.com/video/" .$sid ."?api=1&player_id=player_" .$sid ."&title=0&amp;amp;byline=0&amp;amp;portrait=0&amp;amp;color=d01e2f&amp;amp;&loop=" .$loop. "&controls=" .$controls. "&autoplay=" .$autoplay. "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
			}
		else:
			if(implode($link_match) == ''){
				$html .= "<iframe id=\"player_" .$sid  ."\" class=\"" .$class ."\" width=\"" .$width."\" height=\"" .$height."\" style=\"width:" .$width.";height:".$height.";\" src=\"http://player.vimeo.com/video/" .$sid ."?api=1&player_id=player_" .$sid ."&title=0&amp;amp;byline=0&amp;amp;portrait=0&amp;amp;color=d01e2f&amp;amp;&loop=" .$loop. "&controls=" .$controls. "&autoplay=" .$autoplay. "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
			}else{
				$html .= "<iframe id=\"player_" .$sid  ."\" class=\"" .$class ."\" width=\"" .$width."\" height=\"" .$height."\" style=\"width:" .$width.";height:".$height.";\" src=\"https://player.vimeo.com/video/" .$sid ."?api=1&player_id=player_" .$sid ."&title=0&amp;amp;byline=0&amp;amp;portrait=0&amp;amp;color=d01e2f&amp;amp;&loop=" .$loop. "&controls=" .$controls. "&autoplay=" .$autoplay. "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
			}
		
		
		endif;

		$html .= '</div>';
		if ($mute == 1) {

			$script = 'jQuery(function($) {
				var vimeo_iframe = $(\'#player_' .$sid .'\')[0];
				var player = $f(vimeo_iframe);
				player.addEvent(\'ready\', function() {
				player.api(\'setVolume\', 0);
				});
			});';

			wp_add_inline_script('magee-shortcodes', $script, 'after');
		}
				
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

new Magee_Vimeo();