<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Pullquote {

    public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_pullquote', array( $this, 'render' ) );
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
				'align'                 =>'',
				'border_color' => '#eeee22'
			), $args
		);
        extract( $defaults );
		self::$args = $defaults;
		$style = '';
		$html = '';
		$class .= ' magee-shortcode magee-pullquote';
		if($align == 'left'):
			$html .='<blockquote id="'.esc_attr($id).'" style="border-color:'.$border_color.';" class="'.esc_attr($class).'">'.do_shortcode( Helper::fix_shortcodes($content)).'</blockquote>' ;
        else:
			$html .='<blockquote id="'.esc_attr($id).'" style="border-color:'.$border_color.';" class="blockquote-reverse '.esc_attr($class).'">'.do_shortcode( Helper::fix_shortcodes($content)).'</blockquote>' ;
		endif;
		
		return $html;
   }
}

new Magee_Pullquote();