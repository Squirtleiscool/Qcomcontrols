<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Slider {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_slider', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'bootstrap', 'magee-shortcodes']);
		Helper::get_script_depends(['bootstrap', 'magee-shortcodes']);
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		
		$sliderContent = array();
		if(isset($id) && is_numeric($id)){
			$custom = get_post_custom($id);

			if(isset($custom["magee_custom_slider"][0]))
	    		$sliderContent = json_decode( $custom["magee_custom_slider"][0] ,true);
		}
		$slider_id  = Utils::rand_str( 'magee-slider-' );
		$html     = "";
		$indicators = "";
		$items      = "";
		$class .= ' carousel slide magee-slider magee-shortcode';
		
		if ( is_array($sliderContent) && count($sliderContent) > 0 ) {
			$html .= '<div id="'.$slider_id.'" class="'.$class.'" data-ride="carousel">';
			$i       = 0;
			foreach ( $sliderContent as $slide ) {
				$active = "";
				if($i == 0) $active = "active";
				$image       = wp_get_attachment_image_src( $slide['id'] , "full");
				$indicators .= '<li data-target="#'.$slider_id.'" data-slide-to="'.$i.'" class="'.$active.'"></li>';
				
				$items      .= '<div class="item '.$active.'"><img src="'.esc_url($image[0]).'" alt="'.esc_attr($slide['title']).'" /><div class="carousel-caption">'.do_shortcode( Helper::fix_shortcodes(wp_kses_post($slide['caption'])) ).'</div></div>';
				
				$i++;
			}

			$html .= '<ol class="carousel-indicators">'.$indicators.'</ol>';
			$html .= '<div class="carousel-inner">'.$items.'</div>';
			$html .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev">';
			$html .= '<span class="fa fa-angle-left"></span>';
			$html .= '</a>';
			$html .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next">';
			$html .= '<span class="fa fa-angle-right"></span>';
			$html .= '</a>';
			$html .= '</div>';
		}
		
		return $html;
	}

}

new Magee_Slider();