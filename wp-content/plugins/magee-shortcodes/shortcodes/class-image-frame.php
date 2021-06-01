<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Image_Frame {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_image_frame', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['prettyphoto', 'font-awesome', 'magee-shortcodes']);
		Helper::get_script_depends(['jquery-prettyphoto', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' =>'',
				'class' =>'',
				'src' =>'',
				'border_radius' =>'0',
				'light_box' => '',
				'link' =>'',
				'link_target' =>'',
				'is_preview' => ''

			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($border_radius))
			$border_radius = $border_radius.'px';
		
		$addclass = Utils::rand_str('radius');
		$class .= ' '.$addclass;
		$css_style = '';
		$css_style .= '.'.$addclass.'{border-radius:'.$border_radius.';}';

		$html = '<div class="magee-shortcode magee-image-frame img-frame rounded">';
		
        $html .= '<div class="img-box figcaption-middle text-center fade-in '.esc_attr($class).'" id="'.esc_attr($id).'">';
		if( $light_box == 'yes'):
			$html .= '<a target="'.esc_attr($link_target).'" href="'.esc_url($src).'" rel="prettyPhoto[pp_gal]">
															<img src="'.esc_url($src).'" class="feature-img ">
															<div class="img-overlay dark">
																<div class="img-overlay-container">
																	<div class="img-overlay-content">
																		<i class="fa fa-search"></i>
																	</div>
																</div>
															</div>
														</a>';
												
		else:
			if( $link !='' ):
				$html .= '<a target="'.esc_attr($link_target).'" href="'.esc_url($link).'">
															<img src="'.esc_url($src).'" class="feature-img ">
															<div class="img-overlay dark">
																<div class="img-overlay-container">
																	<div class="img-overlay-content">
																		<i class="fa fa-link"></i>
																	</div>
																</div>
															</div>
														</a>';
			else:
			
			$html .= ' <img src="'.esc_url($src).'" class="feature-img">
															<div class="img-overlay dark">
																<div class="img-overlay-container">
																	<div class="img-overlay-content">
																	</div>
																</div>
															</div>';
			
			endif;
		
		endif;											
        $html .= '</div></div>';
		
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

new Magee_Image_Frame();