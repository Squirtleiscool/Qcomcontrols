<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;

class Magee_RSS_feed {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_rss_feed', array( $this, 'render' ) );
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
				'url'      => '',
				'number'      => 3,
				'class'      => '',
				'id'    => '',
			), $args
		);
		extract( $defaults );
		self::$args = $defaults;
		$html = '';
		$class .= ' magee-shortcode magee-feed';
		
		if( $url !== ''):
			include_once( ABSPATH . WPINC . '/feed.php' );
			$rss = fetch_feed( esc_url($url) );
			$maxitems = 0 ;
			if(! is_wp_error($rss)):
				$maxitems = $rss->get_item_quantity(esc_attr($number));
				$rss_items = $rss->get_items( 0, $maxitems );
			endif;
			$html  = '<ul class="'.esc_attr($class).'" id="'.esc_attr($id).'">';
			if($maxitems == 0):
				$html .= '<li>'._e( 'No items', 'magee-shortcodes').'</li>' ;
			else:
				foreach ( $rss_items as $item){
					$html .= '<li>';
					$html .= '<a target="_blank" href="'.esc_url($item->get_permalink()).'" ' ;
					$html .= 'title="'.sprintf(__( 'Posted %s', 'magee-shortcodes'), $item->get_date('j F Y | g:i a')).'">';
					$html .= $item->get_title();
					$html .= '</a>' ;
					$html .= '</li>' ;
				}
			endif;
			$html .= '</ul>' ;
		
		endif;
		return $html;
	}   
	
}

new Magee_RSS_feed();