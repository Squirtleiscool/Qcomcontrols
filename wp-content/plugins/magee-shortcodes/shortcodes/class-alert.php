<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Alert {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_alert', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['font-awesome','bootstrap', 'magee-shortcodes']);
		Helper::get_script_depends(['magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'icon'					=>'',	
				'background_color' 		=>'',
				'text_color' 			=>'',
				//'border_color'		    =>'',
				'border_width'			=>'',
				'border_radius'			=>'',
				'dismissable'			=>'',
				'box_shadow'			=>'',
				'is_preview' => ''
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
		$add_class = Utils::rand_str('alert-');
		$class     .= ' '.$add_class;
		$css_style  = '';
		$icon_str   = '';
		$html = '';

		if( is_numeric($border_width) )
			$border_width = $border_width.'px';
		if( is_numeric($border_radius) )
			$border_radius = $border_radius.'px';
		
		if( $background_color )
			$css_style .= 'background-color:'.esc_attr($background_color).';';
		if( $text_color ) {
			$css_style .= 'color:'.esc_attr($text_color).';';
			$css_style .= 'border-color:'.esc_attr($text_color).';';
		}
		if( $border_width )
			$css_style .= 'border-width:'.esc_attr($border_width).';';
		if( $border_radius )
			$css_style .= 'border-radius:'.esc_attr($border_radius).';';
		
		if( $box_shadow == 'yes' )
			$class .= ' box-shadow';
		
		if( $dismissable == 'yes' ) {
			$icon_str .= '<a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a>';
			$class .= ' alert-dismissible';
		}
		
		if( stristr($icon,'fa-')):
			$icon_str .= '<i class="fa '.esc_attr($icon).'"></i>';
		else:
			$icon_str .= '<img class="image-instead" src="'.esc_attr($icon).'" style="padding-right:10px"/>';
		endif;

		$css_style  = sprintf( '.magee-alert.%1$s{%2$s}.magee-alert.%1$s span{color:%3$s;}', $add_class , $css_style, $text_color);

		$content = $icon_str.do_shortcode( Helper::fix_shortcodes($content));

		$html .= sprintf('<div class="magee-shortcode alert magee-alert %1$s " role="alert" id= "%2$s">%3$s</div>', $class, $id, $content);
        
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

new Magee_Alert();