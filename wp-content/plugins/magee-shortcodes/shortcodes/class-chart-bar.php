<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Chart_Bar {

	public static $args;
    private  $id;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_chart_bar', array( $this, 'render_parent' ) );
		add_shortcode( 'ms_bar', array( $this, 'render_child' ) );
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
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('bar-');
		$this->id = $uniqid;
		
		$html = '<canvas id="'.esc_attr($this->id).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" class="magee-shortcode magee-chart-bar'.esc_attr($class).'"></canvas>';
		$script = '
		var buyers = document.getElementById("'.$this->id.'").getContext(\'2d\');
		var barData = {
			labels : ['.do_shortcode($label).'],
			datasets : ['.strip_tags(do_shortcode(Helper::fix_shortcodes($content))).'
			]
	    }

		var barOptions = {
			type: "bar",
			data: barData
		}
		new Chart(buyers, barOptions);
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
				'title' =>'',
				'data' =>'',
				'fillcolor' =>'',
				'fillopacity' =>'',
				'strokecolor' =>'',
				'strokeopacity' => '',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;

        $fillcolor = str_replace('#','', $fillcolor);
		if(strlen($fillcolor) == 6 ):
			$r1 = hexdec(substr($fillcolor,0,2)) ;
			$g1 = hexdec(substr($fillcolor,2,2)) ;
			$b1 = hexdec(substr($fillcolor,4,2)) ;
		endif;
		$strokecolor = str_replace('#','', $strokecolor);
		if(strlen($strokecolor) == 6 ):
			$r2 = hexdec(substr($strokecolor,0,2)) ;
			$g2 = hexdec(substr($strokecolor,2,2)) ;
			$b2 = hexdec(substr($strokecolor,4,2)) ;
		endif;
		
		$html = '{
				label: "'.$title.'",
				backgroundColor : "rgba('.$r1.','.$g1.','.$b1.','.esc_attr($fillopacity).')",
				borderColor : "rgba('.$r2.','.$g2.','.$b2.','.esc_attr($strokeopacity).')",
				data : ['.$data.'],
			    },';
		return $html;
	 }	
}		

new Magee_Chart_Bar();