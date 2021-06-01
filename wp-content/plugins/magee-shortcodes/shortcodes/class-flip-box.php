<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Flip_Box {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_flip_box', array( $this, 'render' ) );
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
				'id' 				=>'',
				'class' 			=>'',
				'direction'			=>'horizontal',
				'front_paddings'	=>'',
				'front_color'       =>'',
				'front_background'	=>'',
				'front_color'		=>'',
				'back_paddings'		=>'',
				'back_color'        =>'', 
				'back_background'	=>'',
				'back_color'		=>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($front_paddings))
			$front_paddings = $front_paddings.'px';
		if(is_numeric($back_paddings))
			$back_paddings = $back_paddings.'px';
		
		$uniq_class = Utils::rand_str('flip-box-');
		$class .= ' magee-shortcode magee-flip-box';
		$class .= ' '.$uniq_class;
		$class .= ' '.$direction;
		$html   = '';

		if( $content ):
		
			$contentsplit  = explode("|||", $content);
			$front_content = isset($contentsplit[0])?$contentsplit[0]:'';
			$back_content = isset($contentsplit[1])?$contentsplit[1]:'';
			
			$css_style = '.'.$uniq_class.' .flipbox-front{background-color:'.$front_background.';}.'.$uniq_class.' .flipbox-front .flipbox-content{padding:'.$front_paddings.';color:'.$front_color.';}.'.$uniq_class.' .flipbox-back{background-color:'.$back_background.';}.'.$uniq_class.' .flipbox-back .flipbox-content{padding:'.$back_paddings.';color:'.$back_color.'}';
			$html .= '<div class="magee-flipbox-wrap '.$class.'" id="'.$id.'" data-direction="'.$direction.'">
							<div class="magee-flipbox">
								<div class="flipbox-front">
									<div class="flipbox-content">
										'. do_shortcode( Helper::fix_shortcodes($front_content)).'
									</div>
								</div>
								<div class="flipbox-back">
									<div class="flipbox-content">
										'. do_shortcode( Helper::fix_shortcodes($back_content)).'
									</div>
								</div>
							</div>
						</div>';
		
		endif;
				
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

new Magee_Flip_Box();