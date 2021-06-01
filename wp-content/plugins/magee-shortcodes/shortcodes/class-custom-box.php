<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Custom_Box {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_custom_box', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'fixed_background'      =>'', 
				'background_position'   =>'', 
				'padding' 				=>'',
				'backgroundimage' 		=>'',
				'font_size' 		=>'',
				'font_color' 		=>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($padding)) $padding = $padding.'px';
		$fixed_background = ($fixed_background == 'yes')? 'fixed' : '';
		$css_style = '';
		$uniqid = Utils::rand_str('custom-box-');
		$class .= ' '.$uniqid;

		if ($backgroundimage)
			$css_style .= sprintf(' .'.$uniqid.' {padding: %1$s; background-image: url(%2$s);background-attachment: %3$s;background-position: %4$s;} ', $padding, $backgroundimage, $fixed_background, $background_position);
		if ($font_size)
			$css_style .= sprintf(' .'.$uniqid.' {font-size:%spx;} ', $font_size);
		if ($font_color)
			$css_style .= sprintf(' .'.$uniqid.' {color:%s;} ', $font_color);
		
		$html = sprintf('<div class="%1$s" id="%2$s">%3$s </div>', $class, $id, do_shortcode( Helper::fix_shortcodes($content)));
				
		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->editor->is_edit_mode() ){
			$is_preview = "1";
		}

		if ($is_preview == "1"){
			$html = sprintf( '<style type="text/css" scoped="scoped">%1$s</style>%2$s' , $css_style, $html );
		}else{
			wp_add_inline_style('magee-shortcodes', $css_style);
		}
		
		return $html;
	}
	
}

new Magee_Custom_Box();