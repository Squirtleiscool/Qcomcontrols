<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Panel {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_panel', array( $this, 'render' ) );
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
				'title' 				=>'',
				'border_color'			=>'',
				'title_background_color' =>'',
				'title_color' 		=>'',
				'border_radius'			=>'',
				'border_width'			=>'1',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$add_class  = Utils::rand_str('panel-');
		$class     .= ' '.$add_class;
		$css_style  = '';
		
		if( is_numeric($border_radius) )
			$border_radius = $border_radius.'px';

		if( $title_color )
			$css_style .= '.'.$add_class.' h3.panel-title{color:'.esc_attr($title_color).';}';
		if( $border_color )
			$css_style .= '.'.$add_class.'{border-color:'.esc_attr($border_color).';}';
		if( $border_width )
			$css_style .= '.'.$add_class.'{border-width:'.absint($border_width).'px;border-style: solid;}';
		if( $title_background_color )
			$css_style .= '.'.$add_class.' .panel-heading{background-color:'.esc_attr($title_background_color).';over-flow:hidden;}';
		$css_style .= '.'.$add_class.' .panel-heading{padding:5px 10px;}';
		$css_style .= '.'.$add_class.' .panel-body{padding:15px 10px;}';

		if( $border_radius )
			$css_style .= '.'.$add_class.'{border-radius:'.esc_attr($border_radius).';}';
		
		$content = do_shortcode( Helper::fix_shortcodes($content));

		$class .= ' magee-shortcode panel magee-panel';

        $html    = sprintf('<div class="%1$s" id="%2$s">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">%3$s</h3>
                                        </div>
                                        <div class="panel-body">
                                            %4$s
                                        </div>
                                    </div>', esc_attr($class), esc_attr($id), esc_attr($title), $content);
				
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

new Magee_Panel();