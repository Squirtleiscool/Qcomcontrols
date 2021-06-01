<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Accordion {

	public static $args;
    private  $id;
	private  $num;
	private $is_preview;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_accordion', array( $this, 'render_parent' ) );
        add_shortcode( 'ms_accordion_item', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_parent( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'magee-shortcodes']);
		Helper::get_script_depends(['magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' =>'',
				'class' =>'',
				'style'=>'simple',
				'type' => 1,
				'icon' => '',
				'background_color' => '',
				'color' => '',
				'is_preview' => '',
				'open_multiple' => 'no'
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('accordion-');
		$class .= ' '.$uniqid;
		$this->id = $uniqid;
        $this->num = 1;
		$this->is_preview = $is_preview;
		
		$type = $icon == 'arrow'? 1: $type;
		$type = $icon == 'plus'? 2: $type;
		$type = $icon == 'none'? 3: $type;

		$css_style = '';
	
		if($background_color !== '')
			$css_style .= '.'.$uniqid.' .panel-heading{
			background-color:'.$background_color.' !important;}
			.'.$uniqid.'{border-color:'.$background_color.' !important;}';
		
		if($color !== '')
			$css_style .= '.'.$uniqid.' .panel-title{color:'.$color.' !important;}
			.'.$uniqid.' .panel-title i{color:'.$color.';}
			.'.$uniqid.' .panel-heading .accordion-toggle:after{color:'.$color.';}';

		$class .= ' style'.$type.' magee-shortcode panel-group magee-accordion accordion-'.$style;
		
		$html = '<div class="'.esc_attr($class).'" role="tablist" aria-multiselectable="'.esc_attr($open_multiple).'" id="'.esc_attr($this->id).'">'.do_shortcode( Helper::fix_shortcodes($content)).'</div>';
		
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
				'title' =>'',
				'status' =>'',
				'is_preview' => ''
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
        $html = '';

		if( $status == "open" ) {
			$status   = "in";
			$expanded = "true";
			$collapse = "";
		}
		else{
			$status = "";
			$expanded = "false";
			$collapse = "collapsed";
		}
		
        $itemId = 'collapse'.$this->id."-".$this->num;
		$panelId = 'panel'.$this->id."-".$this->num;
		
		$html .= '<div class="panel panel-default " id="'.$panelId.'">';

		$html .= '<div class="panel-heading" role="tab" id="heading'.$itemId.'">
				<a class="accordion-toggle '.$collapse.'" data-toggle="collapse" data-parent="#'.$this->id.'" href="#'.$itemId.'" aria-expanded="'.$expanded.'" aria-controls="'.$itemId.'">
					<h4 class="panel-title">
							'.esc_attr($title).'
					</h4>
				</a>
			</div>
			<div id="'.$itemId.'" class="panel-collapse collapse '.$status.'" role="tabpanel" aria-labelledby="heading'.$itemId.'" aria-expanded="'.$expanded.'">
				<div class="panel-body">
					'.do_shortcode( Helper::fix_shortcodes($content)).'
					<div class="clear"></div>
				</div>
			</div>
		</div>';
        
		$this->num++;
       
		return $html;
	}
}
new Magee_Accordion();