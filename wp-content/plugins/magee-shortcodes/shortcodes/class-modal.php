<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Modal {

	public static $args;
    private  $id;
	private $modal_anchor_text;
	private $modal_content;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_modal', array( $this, 'render' ) );
		add_shortcode( 'ms_modal_anchor_text', array( $this, 'render_modal_anchor_text' ) );
		add_shortcode( 'ms_modal_content', array( $this, 'render_modal_content' ) );
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
				'effect'                =>'',	
				'title' 				=>'',
				'title_color' 			=>'',
				'heading_background' 	=>'',
				'background' 			=>'',
				'color' 				=>'',
				'width' 				=>'',
				'height' 				=>'',
				'overlay_color' 		=>'#000000',
				'overlay_opacity' 		=>'0.3',
				'close_icon'            =>'yes',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('modal-');
		$this->id = $uniqid;
        if(isset($width) && is_numeric($width))
			$width = $width.'px';
		if(isset($height) && is_numeric($height))
			$height = $height.'px';
		 
		$css_style = '';

		if(isset($title_color) && $title_color !== '')
			$css_style .='#'.$uniqid.' .magee-modal-title-wrapper h3{color:'.$title_color.'}';
		if(isset($heading_background) && $heading_background !== '')
			$css_style .='#'.$uniqid.' .magee-modal-title-wrapper{background:'.$heading_background.'}';
		if(isset($background) && $background !== '')
			$css_style .='#'.$uniqid.' .magee-modal-content-wrapper{background:'.$background.'}';
		if(isset($color) && $color !== '')
			$css_style .='#'.$uniqid.' .magee-modal-content-wrapper{color:'.$color.'}';
		if(isset($width) && $width !== '')
			$css_style .='#'.$uniqid.' .magee-modal-content-wrapper{width:'.$width.'}';
		if(isset($height) && $height !== '')
			$css_style .='#'.$uniqid.' .magee-modal-content-wrapper{height:'.$height.'}';
		if(isset($overlay_color) && $overlay_color !== ''){
			$overlay_color = Helper::hex2rgb($overlay_color);
		}
		$css_style .='#'.$uniqid.' .magee-modal-overlay{background-color:rgba('.$overlay_color[0].','.$overlay_color[1].','.$overlay_color[2].','.$overlay_opacity.');}';
		
        do_shortcode( Helper::fix_shortcodes($content));

		$class .= ' magee-shortcode magee-modal-trigger';

		$html = sprintf('<div 
		id="%1$s" 
		class="%2$s" 
		data-id="%3$s" 
		data-title="%4$s" 
		data-content="%5$s" 
		data-effect="%6$s" 
		data-close_icon="%7$s"
		>%8$s
		</div>', $id, $class, $uniqid, esc_attr($title), wp_kses_post($this->modal_content), $effect, $close_icon, wp_kses_post($this->modal_anchor_text));
				
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
	function render_modal_anchor_text( $args, $content = '') {
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'is_preview' => ''
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
						 
		$this->modal_anchor_text = do_shortcode( Helper::fix_shortcodes($content));

		return $this->modal_anchor_text;
	}
	
	/**
	 * Render the child shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_modal_content( $args, $content = '') {
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'is_preview' => ''
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
						 
		$this->modal_content = do_shortcode( Helper::fix_shortcodes($content));
		
		return $this->modal_content;
	
	}
	
}

new Magee_Modal();