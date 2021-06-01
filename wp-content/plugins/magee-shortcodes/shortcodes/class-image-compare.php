<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Image_Compare {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_image_compare', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['twentytwenty', 'magee-shortcodes']);
		Helper::get_script_depends(['jquery-event-move', 'jquery-twentytwenty', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' =>'',
				'class' =>'',
				'style' => '',
				'percent' => '',
				'image_left' =>'',
				'image_right' =>'',
				'before_label' => '',
				'after_label' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$unqid = Utils::rand_str( 'image-compare-');
		$class .= ' '.$unqid;
		$html = '<div  id="'.esc_attr($id).'" class="magee-shortcode magee-image-compare twentytwenty-container '.esc_attr($class).'" data-before_label="'.esc_attr($before_label).'" data-after_label="'.esc_attr($after_label).'" data-pct="'.esc_attr($percent).'" data-orientation="'.esc_attr($style).'">
				  <img src="'.$image_left.'">
		          <img src="'.$image_right.'">
				</div>' ;	
		return $html;
	}
	
}

new Magee_Image_Compare();