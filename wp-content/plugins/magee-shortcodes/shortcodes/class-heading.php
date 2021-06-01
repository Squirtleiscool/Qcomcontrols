<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Title {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_heading', array( $this, 'render' ) );
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
				'id' 					=> '',
				'class' 				=> '',
				'style'					=> 'none',	
				'color'				    => '',
				'border_color'          => '',
				'text_align'            => '',
				'font_weight'           => '400',
				'font_size'            	=> '36px',
				'margin_top'            => '',
				'margin_bottom'         => '',
				'border_width'          => '5px',
				'responsive_text'       => '',
				'is_preview' => ''

			), $args 
		);
		
		extract( $defaults );
		self::$args = $defaults;
		
		$uniqid = Utils::rand_str('heading-');
		$class .=' magee-shortcode magee-heading '.$uniqid;
		$css_style = '';

 		if(is_numeric($font_size))
			$font_size = $font_size.'px';
		if(is_numeric($margin_top))
			$margin_top = $margin_top.'px';
		if(is_numeric($margin_bottom))
			$margin_bottom = $margin_bottom.'px';
		if(is_numeric($border_width))
			$border_width = $border_width.'px';
		if ('none' == $style || 'doubleline' == $style){
			$css_style  .= '
					.'.$uniqid.' .heading-inner {
						border-style: none;
					}';
		}

		
		$css_style  .= '
					.'.$uniqid.'.magee-heading{
						font-size:'.$font_size.';
						font-weight:'.$font_weight.';
						margin-top:'.$margin_top.';
						margin-bottom:'.$margin_bottom.';
						color: '.$color.';
						border-color: '.$border_color.';
						text-align: '.$text_align.';
					}
					.'.$uniqid.'.heading-border .heading-inner {
						border-width: '.$border_width.';
					}
				.'.$uniqid.'.heading-doubleline .heading-inner:before,
				.'.$uniqid.'.heading-doubleline .heading-inner:after {
						border-color: '.$border_color.';
						border-width: '.$border_width.';
					}
				';
		
		if( $style == 'none'){
			$html = '<h1 class="magee-heading  '.esc_attr($class).'" id="'.$id.'" data-fontsize="'.$font_size.'" data-responsive="'.$responsive_text.'"><span class="heading-inner">'.do_shortcode( Helper::fix_shortcodes($content)).'</span></h1>';
		}else{					
			$html = '<h1 class="magee-heading heading-'.$style.' '.esc_attr($class).'" id="'.$id.'" data-fontsize="'.$font_size.'" data-responsive="'.$responsive_text.'"><span class="heading-inner">'.do_shortcode( Helper::fix_shortcodes($content)).'</span></h1>';
		}
				
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

new Magee_Title();