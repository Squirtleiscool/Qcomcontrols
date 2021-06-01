<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Expand {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_expand', array( $this, 'render' ) );
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
				'id' 					=>'',
				'class' 				=>'',
				'more_icon'				=>'',
				'more_icon_color'	    =>'',	
				'more_text'				=>'',
				'less_icon'				=>'',
				'less_icon_color'	    =>'', 	
				'less_text'				=>'',
				
			), $args
		);
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str("control-");
        $html ='
		<div class="magee-expand '.esc_attr($class).'" id="'.esc_attr($id).'" data-less-icon="'.esc_attr($less_icon).'" data-less-icon-color="'.esc_attr($less_icon_color).'" data-less-text="'.esc_attr($less_text).'" data-more-icon="'.esc_attr($more_icon).'" data-more-icon-color="'.esc_attr($more_icon_color).'" data-more-text="'.esc_attr($more_text).'">
            <div class="expand-control '.$uniqid.'">';
		if( stristr($more_icon,'fa-')):
			$html	.=	'<i class="fa '.esc_attr($more_icon).'" style="color:'.$more_icon_color.';"></i> ';
		else:
			$html	.=	'<img src="'.esc_attr($more_icon).'" class="image-instead"/>';
		endif;
			$html	.=	esc_attr($more_text).'</div>
				<div class="expand-content" style="display:none;">
					'.do_shortcode( Helper::fix_shortcodes($content)).'
				</div>
			</div>' ;
		
        return $html;
		
		
	}
}
new  Magee_Expand();