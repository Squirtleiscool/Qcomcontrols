<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Countdowns {

	public static $args;
	private $google_font;
    private  $id;
	private $is_preview;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_countdowns', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['jquery-classycountdown', 'magee-shortcodes']);
		Helper::get_script_depends(['jquery-waypoints', 'jquery-countto', 'jquery-countdown','jquery-knob', 'jquery-throttle', 'jquery-classycountdown', 'jquery-countdown', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' =>'magee-countdowns',
				'class' =>'',
				'topicon' => '',
				'fontcolor' => '',
				'backgroundcolor' => '',
				'endtime' => date('Y-m-d H:i:s',strtotime(' 1 month')),
				'nowtime' => time(),
				'type' => 'normal',
				'day_field_text' => __('Days','magee-shortcodes' ),
				'hours_field_text' => __('Hours','magee-shortcodes' ),
				'minutes_field_text' => __('Minutes','magee-shortcodes' ),
				'seconds_field_text' => __('Seconds','magee-shortcodes' ),
				'google_fonts' => '',
				'circle_type_day_color' => '',
				'circle_type_hours_color' => '',
				'circle_type_minutes_color' => '',
				'circle_type_seconds_color' => '',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$countdownsID = Utils::rand_str('countdowns-');
		$addclass = Utils::rand_str('countdown-');
		$class .= ' '.$addclass;
		$css_style = '';
		$script = '';
		$boxed = '';
		$html = '';
		$this->is_preview = $is_preview;
		$nowtime = strlen($nowtime) == 10 ? $nowtime : strtotime($nowtime);
		switch($type){
			
		    case 'normal': 
			
				if( $backgroundcolor )
					$css_style .= '#'.$countdownsID.' .magee-counter-box{background-color:'.$backgroundcolor.';}';
				$boxed = 'boxed';
				if( $fontcolor)
					$css_style .= '#'.$countdownsID.' .magee-counter-box .counter-title{color:'.$fontcolor.'; }';
				$css_style .= '#'.$countdownsID.' .magee-counter-box{color:'.$fontcolor.';}';
				
				$html .= '<div class="magee-countdown-wrap center-block '.esc_attr($class).'" id="'.esc_attr($id).'">
												<ul class="magee-countdown row" id="'.$countdownsID.'">
													<li class="col-sm-3">
													<div class="magee-counter-box '.$boxed.'">
														<div class="counter days">
															<span class="counter-num"></span>
														</div>
														<span class="counter-title">
															'.__('Days','magee-shortcodes' ).'
														</span>
													</div>
													</li>
													<li class="col-sm-3">
													<div class="magee-counter-box '.$boxed.'">
														<div class="counter hours">
															<span class="counter-num"></span>
														</div>
														<span class="counter-title">
															'.__('Hours','magee-shortcodes' ).'
														</span>
													</div>	
													</li>
													<li class="col-sm-3">
													<div class="magee-counter-box '.$boxed.'">
														<div class="counter minutes">
															<span class="counter-num"></span>
														</div>
														<span class="counter-title">
															'.__('Minutes','magee-shortcodes' ).'
														</span>
													</div>	
													</li>
													<li class="col-sm-3">
													<div class="magee-counter-box '.$boxed.'">
														<div class="counter seconds">
															<span class="counter-num"></span>
														</div>
														<span class="counter-title">
															'.__('Seconds','magee-shortcodes' ).'
														</span>
													</div>	
													</li>
												</ul>
											</div>';
			
				$script .= '
					jQuery(function($) {
						$("#'.$countdownsID.'").countdown("'.$endtime.'", function(event) {
							$("#'.$countdownsID.' .days .counter-num").text(
								event.strftime("%D")
							);
							$("#'.$countdownsID.' .hours .counter-num").text(
								event.strftime("%H")
							);
							$("#'.$countdownsID.' .minutes .counter-num").text(
								event.strftime("%M")
							);
							$("#'.$countdownsID.' .seconds .counter-num").text(
								event.strftime("%S")
							);
						});
					})';
				
				break;
			case 'circle':
				$google_url = '';
				if($google_fonts !== ''){
					$google_url = str_replace(', ','|', $google_fonts );
					$google_url = esc_url('//fonts.googleapis.com/css?family=' .$google_url);
					$google_id = Utils::rand_str('wpd_google-fonts-');
					wp_enqueue_style($google_id, $google_url, false, '', false );	
				}
				$class .=' '.$countdownsID;
				if( $backgroundcolor ):
					$css_style .= '.'.$addclass.'{background-color:'.$backgroundcolor.';}';
					
				endif;
				$html .= '<div class="magee-countdown-wrap magee-countdown-circle-type '.esc_attr($class).'" data-google_font_url="'.$google_url.'" id="'.esc_attr($id).'" data-fontcolor="'.esc_attr($fontcolor).'" data-endtime="'.strtotime(esc_attr($endtime)).'" data-nowtime="'.esc_attr($nowtime).'" data-day_field_text="'.esc_attr($day_field_text).'" data-hours_field_text="'.esc_attr($hours_field_text).'" data-minutes_field_text="'.esc_attr($minutes_field_text).'" data-seconds_field_text="'.esc_attr($seconds_field_text).'" data-google_fonts="'.esc_attr($google_fonts).'" data-google_url="'.$google_url.'" data-circle_type_day_color="'.esc_attr($circle_type_day_color).'" data-circle_type_hours_color="'.esc_attr($circle_type_hours_color).'" data-circle_type_minutes_color="'.esc_attr($circle_type_minutes_color).'" data-circle_type_seconds_color="'.esc_attr($circle_type_seconds_color).'"></div>';
				break;
		}
				
		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->editor->is_edit_mode() ){
			$this->is_preview = "1";
		}


		if ($this->is_preview == "1"){
			$html = sprintf( '<style type="text/css" scoped="scoped">%1$s</style>%2$s ' ,$css_style, $html );
			$html = sprintf( '%1$s<script>%2$s</script>', $html, $script);
		}else{
			wp_add_inline_style('magee-shortcodes', $css_style);
			wp_add_inline_script('magee-shortcodes', $script, 'after');
		}

		return $html;
	} 

}

new Magee_Countdowns();