<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Audio {
    
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() {
	    add_shortcode( 'ms_audio', array( $this,'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
     function render( $args, $content = '') {
		
		Helper::get_style_depends(['audioplayer', 'magee-shortcodes']);
		Helper::get_script_depends(['jquery-audioplayer', 'magee-shortcodes']);

		$defaults =  Helper::set_shortcode_defaults(
			array(
				'id'                    =>'',
				'class'                 =>'',
				'mute'                  =>'',
				'mp3'                   =>'',
				'ogg'                   =>'',
				'wav'                   =>'',
				'autoplay'              =>'',
				'loop'                  =>'',    
				'controls'              =>'yes', 
				'style'                 =>'dark',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$addclass = Utils::rand_str('audio-');
		$class .= ' '.$addclass;
		$mute = ( $mute =='yes')? 1 : '';
		$autoplay = ( $autoplay =='yes')? 'autoplay' : 0;
		$loop = ( $loop =='yes')? 'loop' : '';
		$controls = ( $controls =='yes')? '' : 'controls';

		$html = '<audio preload="auto" class="magee-shortcode ms-audio '.esc_attr($class).'" data-style="'.$style.'" data-controls="'.$controls.'"  id="'.esc_attr($id).'" data-mute="'.$mute.'" data-loop="'.$loop.'" data-autoplay="false" >';
		if( !empty($mp3)){
			$html .= '<source src="'.esc_url($mp3).'" type="audio/mpeg">';
		}
		if( !empty($ogg)){
			$html .= '<source src="'.esc_url($ogg).'" type="audio/ogg">' ;
		}
		if( !empty($wav)){
			$html .= '<source src="'.esc_url($ogg).'" type="audio/wav">' ;
		}
		$html .= __('Your browser does not support the audio element.', 'magee-shortcodes');
		$html .='</audio>'	 ;
	
		return $html;
	 } 	 
}		 
new Magee_Audio();	