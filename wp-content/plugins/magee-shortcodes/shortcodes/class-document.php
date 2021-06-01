<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Document {

    public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_document', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'magee-shortcodes']);
		Helper::get_script_depends(['magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'width'                 =>'',
				'height'                =>'',
				'responsive'            =>'',
				'url'                   =>'',
				'viewer'                =>'',
			), $args
		);
        extract( $defaults );
		self::$args = $defaults;
		
		$html = '';
		switch(esc_attr($viewer)){
			case 'google':
				$html .= '<div id="'.esc_attr($id).'" class="magee-shortcode magee-document ' .esc_attr($class) . '" data-responsive="'.esc_attr($responsive).'" data-width="'.esc_attr($width).'" data-height="'.esc_attr($height).'"><iframe src="//docs.google.com/viewer?url='.esc_url($url) .'&embedded=true" width="' . esc_attr($width) . 'px" height="'.esc_attr($height). 'px" ></iframe></div>';
			break;
			case 'microsoft':
				$html .= '<div id="'.esc_attr($id).'" class="magee-shortcode magee-document ' .esc_attr($class) . '" data-responsive="'.esc_attr($responsive).'" data-width="'.esc_attr($width).'" data-height="'.esc_attr($height).'"><iframe src="//view.officeapps.live.com/op/embed.aspx?src='.esc_url($url) .'" width="' . esc_attr($width) . 'px" height="' .  esc_attr($height) . 'px" class="su-document' .esc_attr($class) . '" id="'.esc_attr($id).'"></iframe></div>';
			break;
		}
		
		return $html;
		
   }
}

new Magee_Document();