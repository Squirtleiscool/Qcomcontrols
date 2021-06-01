<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_List {

	public static $args;
    private  $id;
	private static $icon_a;
	private static $css_style;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode( 'ms_list', array( $this, 'render_parent' ) );
        add_shortcode( 'ms_list_item', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_parent( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'item_border' 			=>'no',
				'item_size' 			=>'12px',
				'class' 				=>'',
				'icon_a' 					=>'',
				'icon_color_a' 			=>'',
				'icon_boxed_a' 			=>'no',
				'background_color_a' 		=>'',
				'boxed_shape_a' 			=>'circle',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
        if(is_numeric($item_size))
			$item_size = $item_size.'px';

		$uniq_class = Utils::rand_str('list-');
		$class = ' magee-shortcode '.$uniq_class;

		if($item_border == 'yes') {
		   $class .=  ' magee-icon-list icon-list-border';
		}

        $this->icon_a = $icon_a;

		if(isset($this->icon_a) && $this->icon_a !== ''):
			if($icon_boxed_a == 'yes'){
				$class .=  ' '.$uniq_class.'-icon-list-'.$boxed_shape_a;
			}
			if( stristr($icon_a,'fa-')):
				$textstyle =' .'.$uniq_class.' ul {margin: 0;} .'.$uniq_class.' li{list-style-type: none;padding-bottom: .8em;position: relative;padding-left: 2em;font-size:'.$item_size.'}
					.'.$uniq_class.' li i{text-align: center;width: 1.6em;height: 1.6em;line-height: 1.6em;position: absolute;top: 0;
						left: 0;background-color: '.$background_color_a.';color: '.$icon_color_a.';} 
					.'.$uniq_class.'-icon-list-circle li i {border-radius: 50%;} .'.$uniq_class.'-icon-list-square li i {border-radius: 0;}';
			else:
			$textstyle =' .'.$uniq_class.' ul {margin: 0;} .'.$uniq_class.' li{list-style-type: none;padding-bottom: .8em;position: relative;padding-left: 2em;font-size:'.$item_size.'}
				.'.$uniq_class.' li img{text-align: center;width: 1.6em;height: 1.6em;line-height: 1.6em;position: absolute;top: 0;
					left: 0;background-color: '.$background_color_a.';color: '.$icon_color_a.';} 
				.'.$uniq_class.'-icon-list-circle li img{border-radius: 50%;} .'.$uniq_class.'-icon-list-square li img{border-radius: 0;}';
			endif;
			
			$html = sprintf('<ul class="magee-icon-list %1$s" id="%2$s">%3$s</ul>', $class, $id,do_shortcode( Helper::fix_shortcodes($content)));
		
		else:	
		   		   
			$textstyle = ' .'.$uniq_class.' ul {margin: 0;} .'.$uniq_class.' li{list-style-type: none;padding-bottom: .8em;position: relative;padding-left: 2em;font-size:'.$item_size.'}';
			$html = sprintf('<ul class="magee-icon-list %1$s" id="%2$s">%3$s</ul>', $class, $id,do_shortcode( Helper::fix_shortcodes($content)));
		
		endif;

		$css_style =  $textstyle.$this->css_style;
		
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
	
	/**
	 * Render the child shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
		function render_child( $args, $content = '') {
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
			    'icon' 					=>'',
				'icon_color' 			=>'',
				'icon_boxed' 			=>'no',
				'background_color' 		=>'',
				'boxed_shape' 			=>'circle',
				'is_preview' => ''
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
		$uniqid_li = Utils::rand_str('li-');
		$css_style = '';

		if( isset($this->icon_a) && $this->icon_a !== '' ):
		    if( stristr($this->icon_a, 'fa-')):				 
				$html =sprintf('<li><i class="fa %1$s"></i> %2$s</li>', $this->icon_a, do_shortcode( Helper::fix_shortcodes($content)));
			else:
				$html =sprintf('<li><img src="%1$s" class="image_instead"/> %2$s</li>', $this->icon_a, do_shortcode( Helper::fix_shortcodes($content))); 
			endif;
		else:
		
			if($icon_boxed == 'yes'):
				if( $boxed_shape == 'circle'):
					$css_style .= ' .'.$uniqid_li.' i {border-radius: 50%;} .'.$uniqid_li.' img {border-radius: 50%;}';	
				else:
					$css_style .= ' .'.$uniqid_li.' i {border-radius: 0;} .'.$uniqid_li.' img {border-radius: 0;}';	
				endif;
			endif;
			
			if( stristr($icon,'fa-')):
				$css_style .= ' .'.$uniqid_li.' i{text-align: center;width: 1.6em;height: 1.6em;line-height: 1.6em;position: absolute;top: 0;
						left: 0;background-color: '.$background_color.';color: '.$icon_color.';} '; 	
				$html = sprintf('<li class="%1$s"><i class="fa %2$s"></i> %3$s</li>', $uniqid_li, $icon, do_shortcode( Helper::fix_shortcodes($content)));
			elseif(!$icon):
				$html = sprintf('<li class="%1$s"> %2$s</li>', $uniqid_li, do_shortcode( Helper::fix_shortcodes($content))); 
			else:
				$css_style .= ' .'.$uniqid_li.' img{text-align: center;width: 1.6em;height: 1.6em;line-height: 1.6em;position: absolute;top: 0;
						left: 0;background-color: '.$background_color.';color: '.$icon_color.';} ';
				$html = sprintf('<li class="%1$s"><img src="%2$s" class="image_instead"/> %3$s</li>', $uniqid_li, $icon, do_shortcode( Helper::fix_shortcodes($content))); 
			endif;
		endif;

		$this->css_style .= $css_style;

		return $html;
	}
}

new Magee_List();