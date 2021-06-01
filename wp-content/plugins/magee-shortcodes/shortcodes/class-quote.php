<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Quote {

    public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_quote', array( $this, 'render' ) );
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
				'cite'                  =>'',
				'url'                   =>'',
				'quotecolor' =>'',
				'is_preview' => ''

			), $args
		);
        extract( $defaults );
		self::$args = $defaults;
		$css_style = "";
		$unqid = Utils::rand_str("quote-");

		$class .= " magee-shortcode magee-blockquote ".$unqid;

		if ($url) {
			$cite = '<a href="' . $url . '" target="_blank">'.$cite.'</a>';
		}
		if ($quotecolor) {
			$css_style .= '.'.$unqid.' blockquote::before {color: '.$quotecolor.';}';
		}

		$html ='<div class="'.esc_attr($class).'" id="'.esc_attr($id).'">';
		$html .='<blockquote><p>'.do_shortcode( Helper::fix_shortcodes($content)).'</p>';
		$html .= '<footer>'.$cite.'</footer>' ;
		$html .='</blockquote>'; 
		$html .='</div>';
		
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

new Magee_Quote();