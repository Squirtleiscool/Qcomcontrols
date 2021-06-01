<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Chart_Line {

	public static $args;
    private  $id;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_chart_line', array( $this, 'render_parent' ) );
		add_shortcode( 'ms_line', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_parent( $args, $content = '') {

		Helper::get_style_depends(['magee-shortcodes']);
		Helper::get_script_depends(['chart', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
			    'width'                => '',
				'height'               => '',
			    'class'                => '',
				'id'                   => '',
				'label'                => '',
				'is_preview'		   => '',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('line-');
		$this->id = $uniqid;
		
		$html = '<canvas id="'.esc_attr($this->id).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" class="'.esc_attr($class).'"></canvas>';
		$script = '
		var buyers = document.getElementById("'.$this->id.'").getContext(\'2d\');
		
		var lineData = {
			labels : ['.strip_tags(do_shortcode($label)).'],
			datasets : ['.strip_tags(do_shortcode(Helper::fix_shortcodes($content))).']	
	    }
		var lineOptions = {
			type: "line",
			data: lineData
		}
		new Chart(buyers, lineOptions);
		';

		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::instance()->editor->is_edit_mode() ){
			$is_preview = "1";
		}

		if ($is_preview == "1"){
			$html = sprintf( '%1$s<script>%2$s</script>', $html, $script);
		}else{
			wp_add_inline_script('chart', $script, 'after');
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
				'title' => '',
				'data' =>'',
				'fillcolor' =>'',
				'fillopacity' =>'',
				'strokecolor' =>'',
				'pointcolor' =>'',
				'pointstrokecolor' =>'',
				'pointhoverbackgroundcolor' =>'',
				'pointborderwidth' =>'',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		
        $fillcolor = str_replace('#','', $fillcolor);
		if(strlen($fillcolor) == 6 ):
		$r = hexdec(substr($fillcolor,0,2)) ;
		$g = hexdec(substr($fillcolor,2,2)) ;
		$b = hexdec(substr($fillcolor,4,2)) ;
		endif;
		
		$html = '{
				label: "'.$title.'",
				backgroundColor : "rgba('.$r.','.$g.','.$b.','.esc_attr($fillopacity).')",
				borderColor : "'.$strokecolor.'",
				pointBackgroundColor : "'.$pointcolor.'",
				pointBorderColor : "'.$pointstrokecolor.'",
				pointHoverBackgroundColor: "'.$pointhoverbackgroundcolor.'",
				pointborderwidth: "'.$pointborderwidth.'",
				data : ['.$data.'],
			    },';
		return $html;
	 }	
}		

new Magee_Chart_Line();