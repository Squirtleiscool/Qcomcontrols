<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Popover {

	public static $args;
    private  $id;
	private  $num;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_popover', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['magee-shortcodes']);
		Helper::get_script_depends(['bootstrap', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'magee-popover',
				'class' 				=>'',
				'title'					=>'',	
				'triggering_text' 		=>'',
				'trigger'				=>'click',
				'placement'				=>'top',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;

		$class .= ' magee-popover magee-shortcode';

		$html = sprintf('<span class="%1$s" id="popper" data-toggle="popover" data-trigger="%3$s" data-placement="%4$s" 
		data-content="%5$s" data-original-title="%6$s" >%7$s</span>', $class, $id, $trigger, $placement, do_shortcode( Helper::fix_shortcodes($content)), $title, $triggering_text);
		
		if ($is_preview == "1"){
			$html .= '<style>.magee-popover{top: 150px; position: absolute; left: 300px;}</style>';
		}
		
		

		return $html;
	}
	
}

new Magee_Popover();