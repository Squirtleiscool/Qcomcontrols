<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Dailymotion {
    
	
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() { 
	    add_shortcode( 'ms_dailymotion', array( $this,'render' ) );
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
				'id'                    =>'',
				'class'                 =>'',
				'width'                 =>'',
				'height'                =>'',
				'mute'                  =>'',
				'link'                  =>'',
				'autoplay'              =>'',
				'loop'                  =>'',    
				'controls'              =>'',  
				'highlight'             =>'',
				'logo'             =>'',
				'info'             =>'',
				'related'             =>'',
				'quality'             =>'',
			), $args
		);
	
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($width))
			$width = $width.'px';
		if(is_numeric($height))
			$height = $height.'px';

		$autoplay = ($autoplay == 'yes') ? 1:0;
		$loop = ($loop == 'yes') ? 1:0;
		$controls = ($controls == 'yes') ? 1:0;
		$mute = ($mute == 'yes') ? 1:0;
		$logo = ($logo == 'yes') ? 1:0;
		$info = ($info == 'yes') ? 1:0;
		$related = ($related == 'yes') ? 1:0;

		if( $link !== '') 
			$link = strtok(basename(esc_url($link)),'_');
		if( ($width == '100%' || $width == '') &&  ($height == '100%' || $height == '')):
			$html = '<div id="dailymotion" class="magee-shortcode magee-dailymotion" data-width="'.$width.'" data-height="'.$height.'"><iframe id="'.esc_attr($id).'" class="'.esc_attr($class).'" src="//www.dailymotion.com/embed/video/' . $link . '?autoplay='.$autoplay.'&loop='.$loop.'&controls='.$controls.'&mute='.$mute.'&ui-highlight='.$highlight.'&ui-logo='.$logo.'&ui-start-screen-info='.$info.'&endscreen-enable='.$related.'&quality='.$quality.'" frameborder="0" allowfullscreen></iframe></div>';	
		else:
			$html = '<div id="dailymotion" class="magee-shortcode magee-dailymotion" data-width="'.$width.'" data-height="'.$height.'"><iframe id="'.esc_attr($id).'" class="'.esc_attr($class).'" width="'.$width.'" height="'.$height.'" src="//www.dailymotion.com/embed/video/' . $link . '?autoplay='.$autoplay.'&loop='.$loop.'&controls='.$controls.'&mute='.$mute.'&ui-highlight='.$highlight.'&ui-logo='.$logo.'&ui-start-screen-info='.$info.'&endscreen-enable='.$related.'&quality='.$quality.'" frameborder="0" allowfullscreen></iframe></div>';
		endif;		   
		return $html;
	 } 
	 
}

new Magee_Dailymotion();