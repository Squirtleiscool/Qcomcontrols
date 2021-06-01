<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Testimonial {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_testimonial', array( $this, 'render' ) );
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
				'style'					=>'normal',
				'name'					=>'',
				'avatar'				=>'',
				'byline'			=>'',
				'alignment'				=>'none',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$txtalign = '';
		$txtbox = '';
		$divimg = '';

		$txtsl = 'style1';				
		if($alignment=='center') {
			$txtalign='text-center';
			$txtsl = 'style2';
		}
		if($style == 'box') {
			$txtbox='testimonial-boxed';
		}
		$divcont = sprintf('<div class="testimonial-content"><div class="testimonial-quote">%s</div></div>',do_shortcode( Helper::fix_shortcodes($content)));
		if ($avatar) $divimg = sprintf('<div class="testimonial-avatar"><img src="%s" class="img-circle"></div>', $avatar);
		$divauthor = sprintf('<div class="testimonial-author"><h4 class="name" style="text-transform: uppercase;color: #000;">%1$s</h4><div class="title">%2$s</div></div>', $name, $byline);
		$divtitle = sprintf('<div class="testimonial-vcard %1$s"> %2$s %3$s </div>', $txtsl, $divimg, $divauthor);
		$html = sprintf('<div class="magee-shortcode magee-testimonial-box %1$s %2$s %3$s" is="%4$s">%5$s %6$s</div>', $txtalign, $txtbox, $class, $id, $divcont, $divtitle);		
   	
		return $html;
	}
	
}

new Magee_Testimonial();