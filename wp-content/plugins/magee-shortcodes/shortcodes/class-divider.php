<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Divider {

	public static $args;
    private  $id;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_divider', array( $this, 'render' ) );
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
				'style'					=>'normal',
				'align'                 =>'',
				'width'					=>'100',
				'margin_top'			=>'',
				'margin_bottom'			=>'',
				'border_size'			=>'',
				'border_color'			=>'#f2f2f2',
				'icon'					=>'fa-leaf',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($width)) 
			$width = $width.'px';
		if(is_numeric($margin_top))
			$margin_top = $margin_top.'px';
		if(is_numeric($margin_bottom))
			$margin_bottom = $margin_bottom.'px';
		if(is_numeric($border_size))
			$border_size = $border_size.'px';
		
		$uniq_class = Utils::rand_str('divider-');
		
		$class .= ' divider magee-divider magee-shortcode';
		$class .= ' '.$uniq_class;
		
		// normal/shadow/dotted/dashed/double line/double dashed/double dotted/image/icon/back_to_top/title_left/
		switch( $style ){
			case "normal":
			$class .= ' divider-border';
			break;
			case "shadow":
			$class .= ' divider-shadow';
			break;
			case "dotted":
			$class .= ' divider-border dotted';
			break;
			case "dashed":
			$class .= ' divider-border dashed';
			break;
			case "double_line":
			$class .= ' divider divider-border double-line';
			break;
			case "double_dashed":
			$class .= ' divider-border dashed double-line';
			break;
			case "double_dotted":
			$class .= ' divider-border dotted double-line';
			break;
			case "icon":
			$class .= ' divider-icon center';
			break;
			case "back_to_top":
			$class .= ' divider-back-to-top';
			break;
			case "image":
			$class .= '  divider-image';
			break;
			
		}

        if( $align == 'center' )
			$class .= ' center';

		$rgb = Helper::hex2rgb( $border_color );
		
		$css_style = sprintf('.'.$uniq_class.'{ margin-top: %1$s;margin-bottom:%2$s;width:%3$s;}.'.$uniq_class.' .divider-border,.'.$uniq_class.' .divider-border .divider-inner{border-bottom-width:%4$s; border-color:%5$s;}.'.$uniq_class.' i{color:%5$s;}.'.$uniq_class.' .double-line.divider-inner-item .divider-inner{border-top-width: %6$s; border-bottom-width: %7$s;}.'.$uniq_class.' .divider-border.divider-inner-item .divider-inner{ border-bottom-width: %8$s;}', $margin_top, $margin_bottom, $width, $border_size, $border_color, $border_size, $border_size, $border_size);
		
		$css_style .= '.divider-shadow .divider-inner {
			position: relative;
			background: radial-gradient(ellipse at 50% -50% , rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.1) 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0);
			  background: -webkit-radial-gradient(ellipse at 50% -50% , rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.1) 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0);
			  background: -moz-radial-gradient(ellipse at 50% -50% , rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.1) 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0);
			  background: -o-radial-gradient(ellipse at 50% -50% , rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.1) 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0);
		}
		.divider-shadow .divider-inner:after {
			background: -webkit-radial-gradient(ellipse at 50% -50%, rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.3) 0px, rgba(255, 255, 255, 0) 65%);
			background: -moz-radial-gradient(ellipse at 50% -50%, rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.3) 0px, rgba(255, 255, 255, 0) 80%);
			background: -o-radial-gradient(ellipse at 50% -50%, rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.3) 0px, rgba(255, 255, 255, 0) 80%);
			background: radial-gradient(ellipse at 50% -50%, rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', 0.3) 0px, rgba(255, 255, 255, 0) 65%);
		}';

		$html = '<div class="'.esc_attr($class).'" id="'.esc_attr($id).'"><div class="divider-inner divider-border"></div></div>';
		if( $style == 'icon' ):				
			$html = '<div class="'.esc_attr($class).'" id="'.esc_attr($id).'">
			<div class="divider-inner">
				<div class="divider-inner-item divider-border double-line">
					<div class="divider-inner"></div>
				</div>
				<div class="divider-inner-item divider-inner-icon">';
				if( stristr($icon,'fa-')):
					$html .= '<i class="fa '.esc_attr($icon).'"></i>';
				else:
					$html .= '<img class="image-instead" src="'.esc_attr($icon).'"/>';
				endif;
					$html .= '</div>
				<div class="divider-inner-item divider-border double-line">
					<div class="divider-inner"></div>
				</div>
			</div>
			</div>';
		endif;
		if( $style == 'back_to_top' )	
			$html = '<div class="'.esc_attr($class).'" id="'.esc_attr($id).'">
			<div class="divider-inner divider-border">
			<div class="divider-inner-item divider-border">
				<div class="divider-inner"></div>
			</div>
			<div class="divider-inner-item divider-inner-back-to-top">
				<a href="#" class="magee-back-to-top"><i class="fa fa-arrow-up"></i></a>
			</div>
			</div>
			</div>';							
				
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

new Magee_Divider();