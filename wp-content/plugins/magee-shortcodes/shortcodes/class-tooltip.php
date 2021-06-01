<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Tooltip {

	public static $args;
    private  $id;


	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_tooltip', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['bootstrap','magee-shortcodes']);
		Helper::get_script_depends(['bootstrap', 'magee-shortcodes']);
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'title'					=>'',	
				'background_color'      =>'',
				'border_radius'         =>'',
				'trigger'				=>'click',
				'placement'				=>'top',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($border_radius))
			$border_radius = $border_radius.'px';
		
        $addclass = Utils::rand_str("tooltip-");
		$class .= ' magee-shortcode magee-tootip '.$addclass;
		$css_style = '';
		if($background_color !== ''){
			$css_style .= '.'.$addclass.' + .tooltip > .tooltip-inner {background-color: '.$background_color.';border-radius:'.$border_radius.';}
			.'.$addclass.' + .tooltip > .tooltip-arrow {border-'.$placement.'-color: '.$background_color.';}';
		}
		
		$html = sprintf('<span class="%1$s tooltip-text" id="%2$s" data-toggle="tooltip" data-trigger="%3$s" data-placement="%4$s" data-original-title="%5$s" >%6$s</span>', $class, $id, $trigger, $placement, $title, do_shortcode( Helper::fix_shortcodes($content)));
				
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

new Magee_Tooltip();