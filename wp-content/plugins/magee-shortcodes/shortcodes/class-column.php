<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Column {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_column', array( $this, 'render' ) );
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

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'align'                 =>'', 
				'style'					=>'1/1',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$class .= ' magee-shortcode magee-column';
		$columnclass='';
		switch($style)
		{
			case '1/1':
				$columnclass='col-md-12';
				break;
			case '1/2':
				$columnclass='col-md-6';
				break;
			case '1/3':
				$columnclass='col-md-4';
				break;
			case '1/4':
				$columnclass='col-md-3';
				break;
			case '1/5':
				$columnclass='col-md-1_5';
				break;
			case '1/6':
				$columnclass='col-md-2';
				break;
			case '2/3':
				$columnclass='col-md-8';
				break;
			case '2/5':
				$columnclass='col-md-2_5';
				break;
			case '3/4':
				$columnclass='col-md-9';
				break;
			case '3/5':
				$columnclass='col-md-3_5';
				break;
			case '4/5':
				$columnclass='col-md-4_5';
				break;
			case '5/6':
				$columnclass='col-md-10';
				break;
		}
		
		$html = sprintf('<div class="%1$s %2$s" id="%3$s" style="text-align:%4$s;">%5$s</div>', $class, $columnclass, $id, esc_attr($align), do_shortcode( Helper::fix_shortcodes($content)));
		
		return $html;
	}
	
}

new Magee_Column();