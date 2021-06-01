<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Piechart {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_piechart', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {
		Helper::get_style_depends(['magee-shortcodes']);
		Helper::get_script_depends(['jquery-easypiechart', 'magee-shortcodes']);
		
		$defaults =	Helper::set_shortcode_defaults(
			array(
				'class' =>'',
				'line_cap' => '',
				'percent' => '80',
				'filledcolor'=>'#fdd200',
				'unfilledcolor'=>'#f5f5f5',
				'size' =>'200',
				'font_size' =>'40px',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$chartID = Utils::rand_str('chart-');
		if(is_numeric($font_size))
			$font_size = $font_size.'px';
		
		$uniq_class   = $chartID;
		$class       .= ' '.$uniq_class;
		$size         = str_replace('px','',absint($size));
		$css_style = '.'.$uniq_class.' .chart-title{line-height: '.$size.'px;font-size:'.esc_attr($font_size).';}.'.$uniq_class.'{height:'.$size.'px;width:'.$size.'px;}';
		
		$html = '<div class="chart magee-chart-box '.esc_attr($class).'" data-percent="'.esc_attr($percent).'" id="'.$chartID.'" data-barcolor="'.esc_attr($filledcolor).'" data-trackcolor="'.esc_attr($unfilledcolor).'" data-size="'.absint($size).'" data-linecap="'.esc_attr($line_cap).'">
                                                <div class="chart-title">'.do_shortcode( Helper::fix_shortcodes($content)).'</div>
                                            </div>';
				
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

new Magee_Piechart();