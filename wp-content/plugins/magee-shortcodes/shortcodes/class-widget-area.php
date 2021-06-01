<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Widget_Area {
    
	
	public static $args;
	private $id;
    
	/**
	 * Initiate the shortcode
	 */
    public function __construct() {
	 
	    add_shortcode( 'ms_widget_area', array( $this,'render' ) );
	
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
			'class'			 	=> '',
			'id'				=> '',
			'background_color'	=> '',
			'name'				=> '',
			'padding'			=> '',
			'is_preview' => ''
			), $args
		);
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($padding)){
			$padding = $padding.'px';
		}
		$html = '';
		$css_style = '';

		$uniqid = Utils::rand_str('widget-');
		if(isset($background_color) || isset($padding)) {
			$css_style = '.'.$uniqid.'{background-color:'.esc_attr($background_color).';padding:'.esc_attr($padding).';}' ;
		}
		
		$html .= '<div class="'.esc_attr($class).' '.$uniqid.'" id="'.esc_attr($id).'">';
		ob_start();
		if ( function_exists( 'dynamic_sidebar' ) &&
			dynamic_sidebar( $name )
		) {
			// All is good, dynamic_sidebar() already called the rendering
		}
		$html .= ob_get_clean();
		$html .= '<div class="magee-widget-area">'.do_shortcode( $content ).'</div></div>';
	
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

new Magee_Widget_Area();