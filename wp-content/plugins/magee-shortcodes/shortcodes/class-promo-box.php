<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Promo_Box {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_promo_box', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['magee-shortcodes']);
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'style'                 =>'',
				'border_color'			=>'',
				'border_width'			=>'0',
				'border_position'		=>'left',
				'background_color'		=>'',
				'button_color'			=>'',
				'button_link'			=>'#',
				'button_icon'			=>'',
				'button_text'			=>'',
				'button_text_color'     =>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if (is_numeric($border_width))
			$border_width = $border_width.'px';
		
		$uniq_class = Utils::rand_str('promo_box-');
		$action_class = Utils::rand_str('promo-action-');
		$class .= ' '.$uniq_class;
		$html   = '';
		$css_style = '';

        if ($button_text == '') {
			$css_style .= '.'.$action_class.'{display:none;}' ;
		}
		$css_style .= sprintf('.'.$uniq_class.'.boxed{border-'.esc_attr($border_position).'-width: %s; background-color:%s;border-'.esc_attr($border_position).'-color:%s;}', $border_width, $background_color, $border_color);
		
		if ( $button_color !='' )
			$css_style .=sprintf('.'.$uniq_class.' .promo-action a{background-color:%s;}', $button_color);
		if ($button_text_color !='')
			$css_style .=sprintf('.'.$uniq_class.' .promo-action a{color:%s !important;}', $button_text_color);
		if ( $style == 'boxed') {
			$class .= ' boxed';
			//$css_style .= $textstyle;	
		}
		
		
		$html .= '<div class="magee-shortcode magee-promo-box '.esc_attr($class).'" id="'.esc_attr($id).'">
                                        <div class="promo-info">
                                            '. do_shortcode( Helper::fix_shortcodes($content)).'
                                        </div>								
                                        <div class="promo-action '.$action_class.'">
                                            <a href="'.esc_url($button_link).'" class="btn-normal btn-lg">';
											if ($button_icon) {
												if ( stristr($button_icon,'fa-')):
													$html .= '<i class="fa '.esc_attr($button_icon).'"></i>'; 
												else:
													$html .= '<img src="'.esc_attr($button_icon).'" class="image-instead"/>'; 
												endif;
											}
		$html .= 						    esc_attr($button_text).'</a>
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

new Magee_Promo_Box();