<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Progress {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_progress', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['bootstrap', 'magee-shortcodes']);
		Helper::get_script_depends(['magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 				=>'',
				'class' 			=>'',
				'style'				=>'normal',
				'percent'           => '50',
				'text'              =>'',
				'height'            => 30,
				'color'        =>'',
				'direction'        => 'left',
				'textposition'     => 'on',
				'number' => 'yes',
				'rounded' =>'on',
				'striped' =>'none',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$unqid = Utils::rand_str("circle-");
		$percent = str_replace('%','', $percent);
		$percent = esc_attr($percent).'%';
		$css_style = 'width: '.esc_attr($percent).';';
		$html = '';

		if ($style == 'circle'):
			$css_style .= '
			.'.$unqid.'{padding: 3px;border: 1px solid #e3e3e3;border-radius:'.($height+5).'px !important;background-color:#fcfcfc !important;}
			.'.$unqid.' .progress-bar{border-radius:'.$height.'px !important;}
			.'.$unqid.' .progress-title{line-height:'.($height-10).'px !important;}
			';
			
		endif;
		
		if (is_numeric($height))
			$height      = $height.'px';
		$line_height = '';
		$bar_height  = '';

		if ( $height ) {
			$bar_height = 'height:'.esc_attr($height).';';
			$line_height = 'line-height:'.esc_attr($height).'';
		}
		
		if ( $direction == 'left' ) {
			$a = 'left';
			$b = 'right';
		} else{
			$a = 'right';
			$b = 'left';
		}
		  
		$progress = '';
		$progress_bar = '';
		  
		if ( $textposition == 'above' ) {
			$progress .= ' progress-sm';
		}

        if ($number == 'no')
			$percent = '';
		if ($rounded == 'on')
			$progress .= ' rounded';
		
		if ($striped == 'none')
			$progress_bar .= ' none-striped';
		if ($striped == 'striped')
			$progress_bar .= ' progress-bar-striped';
		if ($striped == 'striped animated')
			$progress_bar .= ' progress-bar-striped animated hinge infinite';
		
		if ( $color )
			$css_style .= 'background-color:'.esc_attr($color).';'; 
		
		$html .= '<div class="magee-progress-box '.esc_attr($class).'" id="'.esc_attr($id).'">';
		
		if ( $textposition == '2' ) {
			$html .= '<div class="porgress-title text-'.$a.' clearfix">'.esc_textarea($text).' <div class="pull-'.$b.'">'.esc_attr($percent).'</div></div>';
		}
		$html .= '<div class="progress '.$progress.' '.$unqid.'" style="'.$bar_height.'">
												<div class="progress-bar pull-'.$a.' '.esc_attr($progress_bar).'" role="progressbar" aria-valuenow="'.esc_textarea($text).'" aria-valuemin="0" aria-valuemax="100" style="'.$css_style.'">';
		if ( $textposition == '1' ) {								
			$html .= '<div class="progress-title text-'.$a.' clearfix" style="'.$line_height.'">'.esc_textarea($text).' <div class="pull-'.$b.'">'.esc_attr($percent).'</div></div>';
		}

        $html .= ' </div></div>';
			  											
		$html .= '</div>';
		
		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->editor->is_edit_mode() ){
			$is_preview = "1";
		}

		if ($is_preview == "1"){
			$html = sprintf( '<style type="text/css" scoped="scoped">%1$s</style>%2$s' , $this->css_style, $html );
		}else{
			wp_add_inline_style('magee-shortcodes', $this->css_style);
		}
		
		return $html;
	} 
	
}

new Magee_Progress();