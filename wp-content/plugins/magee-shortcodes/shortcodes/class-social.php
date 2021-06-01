<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Social {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_social', array( $this, 'render' ) );
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
				'id' 					=>'magee-social',
				'class' 				=>'',
				'icon_size'				=>'',
				'effect_3d'				=>'no',
				'title'					=>'',
				'icon'					=>'',
				'iconlink'				=>'#',
				'icontarget'            =>'',
				'iconcolor'				=>'#A0A0A0',
				'backgroundcolor'		=>'transparent',
				'iconboxedradius'		=>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($icon_size))
			$icon_size = $icon_size.'px';
		$class .= ' magee-shortcode magee-social';

		$uqid =  Utils::rand_str('social-');
		$sty3d = '';
		$css_style = sprintf(' .%1$s_social_icon_acolor{ color: %2$s !important ; background-color: %3$s !important; font-size: %4$s; }',
			$uqid, $iconcolor, $backgroundcolor, $icon_size);

		if ( $effect_3d=='yes') {
			$sty3d .=' icon-3d';
		}	
		
		switch($iconboxedradius)
		{
			case 'normal':

				break;					
			case 'boxed':
					$sty3d .=' icon-boxed';
				break;
			case 'rounded':
					$sty3d .=' icon-boxed rounded';
				break;
			case 'circle':
					$sty3d .=' icon-boxed circle';
				break;
		}
		
		if( stristr($icon,'fa-')):	
			$html = sprintf('<a href="%1$s" target="%2$s" id="%3$s" class="fa %4$s magee-icon  %5$s %6$s %7$s_social_icon_acolor" data-toggle="tooltip" data-placement="top" title="" data-original-title="%8$s"></a>',
			$iconlink, $icontarget, $id, $icon, $sty3d, $class, $uqid, $title);
		else:
			$html = sprintf('<a href="%1$s" target="%2$s" id="%3$s" class="fa magee-icon  %4$s %5$s %6$s_social_icon_acolor" data-toggle="tooltip" data-placement="top" title="" data-original-title="%7$s"><img src="%8$s" class="image_instead"/></a>', $iconlink, $icontarget, $id, $sty3d, $class, $uqid, $title, $icon);
			
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

new Magee_Social();