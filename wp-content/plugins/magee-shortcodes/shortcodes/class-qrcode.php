<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_Qrcode
{
	public static $args;
	private $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() 
	{
		add_shortcode( 'ms_qrcode', array( $this,'render' ) );
	}
	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render($args, $content = '')
	{
		$defaults =  Helper::set_shortcode_defaults(

		array(
			'alt'				=> __('scan QR code','magee-shortcodes'),
			'size'				=>'100',
			'margin'			=>'4',
			'click'				=>'no',
			'fgcolor'			=>'#000000',
			'bgcolor'			=>'#FFFFFF'
		 ), $args);

		extract( $defaults );
		self::$args = $defaults;

		$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '';

		$qr_pre_output = "";
		$qr_output = "";
		$qr_post_output = "";

		!empty($content)? $content = strip_tags(trim($content)) : $content = $current_url;

		if ( $click == "yes" ) {
			$qr_pre_output = '<a href="'. $content  .'">';
			$qr_post_output = '</a>';
		}
		// check if GD is installed on the server
		if ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) {
			$fgcolor = str_replace( '#', '', $fgcolor );
			$bgcolor = str_replace( '#', '', $bgcolor );
			$qr_output = '<img class="magee-shortcode magee-qrcode" src="' .  plugins_url('Includes/qrcode-image.php', dirname(__FILE__)) .'?size=' .  $size . '&fgcolor=' . $fgcolor  .'&bgcolor=' .$bgcolor . '&content=' . $content .'" alt="' . $alt . '" width="' . $size . '" height="' . $size . '" />';
		} else {
			$qr_image = 'https://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&chl=' . $content  . '&choe=UTF-8';
			$qr_output = '<img class="magee-shortcode magee-qrcode" src="' . $qr_image  . '" alt="' . $alt . '" width="' . $size . '" height="' . $size . '" />';
		}

		return $qr_pre_output . $qr_output . $qr_post_output;
	} 
}

new Magee_Qrcode();