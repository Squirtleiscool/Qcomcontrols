<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Chart_Doughnut {

	public static $args;
    private $id;
	private static $data;
	private static $bgcolor;
	private static $label;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
        add_shortcode( 'ms_chart_doughnut', array( $this, 'render_parent' ) );
		add_shortcode( 'ms_doughnut', array( $this, 'render_child' ) );
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
				'is_preview'           => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('doughnut-');
		$this->id = $uniqid;
		do_shortcode(Helper::fix_shortcodes($content));

		$html = '<canvas id="'.esc_attr($this->id).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" class="'.esc_attr($class).'"></canvas>';
		$script = '
		var buyers = document.getElementById("'.$this->id.'").getContext(\'2d\');
		var doughnutData = {
			labels: ['.implode(',', self::$label).'],
			datasets: [{
				data: ['.implode(',', self::$data).'],
				backgroundColor: ['.implode(',', self::$bgcolor).'],
				hoverOffset: 4
			}]
		};
		var doughnutOptions = {
			type: "doughnut",
			data: doughnutData
		}
		new Chart(buyers, doughnutOptions);';

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
				'label' =>'',
				'value' =>'',
				'color' =>'',
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		self::$data[] = $value;
		self::$bgcolor[] = "'".$color."'";
		self::$label[] = "'".$label."'";

	 }	
}		

new Magee_Chart_Doughnut();