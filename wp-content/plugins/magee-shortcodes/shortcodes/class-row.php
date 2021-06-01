<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Row {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_row', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'no_padding'         =>''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$class .= ' magee-shortcode magee-row';

		if( $no_padding == 'yes')
			$class .= ' no-padding';

		$html = sprintf('<div id="%1$s" class="%2$s row">%3$s</div>', $id, $class, do_shortcode( Helper::fix_shortcodes($content)));
  	
		return $html;
	}
	
}

new Magee_Row();