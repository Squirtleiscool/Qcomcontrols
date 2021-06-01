<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Label {
    
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() {
	 
	    add_shortcode( 'ms_label', array( $this,'render' ) );
	
	}
	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
     function render( $args, $content = '') {
	 
		Helper::get_style_depends(['magee-shortcodes']);

		$defaults =  Helper::set_shortcode_defaults(
			
		array(
			'background_color' => '',
			'text_color' => '',
		), $args
		);
	
		extract( $defaults );
		self::$args = $defaults;

		$html = sprintf('<span class="magee-shortcode label magee-label" style="background-color:%1$s;color:%2$s;">%3$s</span>', $background_color, $text_color,do_shortcode($content));
		
		return $html;
		 
	}	 
}

new Magee_Label();