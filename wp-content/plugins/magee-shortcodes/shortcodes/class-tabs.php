<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Tabs {

	public static $args;
    private  $id;
	private  $num;
	private  $item_tital;
	private  $colorid;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_tabs', array( $this, 'render_parent' ) );
        add_shortcode( 'ms_tab', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render_parent( $args, $content = '') {

		Helper::get_style_depends(['bootstrap', 'magee-shortcodes']);
		Helper::get_script_depends(['bootstrap', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'title_color'			=>'',
				'style'					=>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		$uniqid = Utils::rand_str('tabs-');
		$this->id = $uniqid;
		$class .= ' '.$uniqid;
        $this->num = 1;
		$this->item_tital='';
		// $this->colorid = Utils::rand_str('tab-');
		$items_content = do_shortcode(Helper::fix_shortcodes($content));		
		$txtsty1='';
		$tab_content_class = '';
		
		switch($style)
		{
			case 'simple':
				$class .=' tab-line ';
				$txtsty1 = ' list-inline ';
				break;
			case 'simple justified':
				$class .=' tab-line ';
				$txtsty1 = ' list-inline nav-justified ';
				break;
			case 'button':
				$class .=' tab-pills ';
				$txtsty1 = ' nav nav-pills ';
				break;
			case 'button justified':
				$class .=' tab-pills ';
				$txtsty1 = ' nav nav-pills nav-justified';
				break;
			case 'normal':
				$class .=' tab-normal ';
				$txtsty1 = ' nav nav-tabs ';
				break;
			case 'normal justified':
				$class .=' tab-normal ';
				$txtsty1 = ' nav nav-tabs nav-justified';
				break;
			case 'vertical':
				$class .=' tab-normal tab-vertical tab-vertical-left clearfix ';
				$txtsty1 = ' nav nav-tabs nav-stacked pull-left ';
				$tab_content_class = 'pull-left';
				break;
			case 'vertical right':
				$class .=' tab-normal tab-vertical tab-vertical-right clearfix ';
				$txtsty1 = ' nav nav-tabs nav-stacked pull-right ';
				break;
		}
		
		
		$css_style = ' .'.$uniqid.' h4, .'.$uniqid.' i{color:'.$title_color.'}';

		$class .= ' magee-shortcode magee-tab-box';

		$html= '<div class="'.$class.'" role="tabpanel" data-example-id="togglable-tabs" id="'.$id.'">
               <ul id="" class="'.$txtsty1.'" role="tablist">'.$this->item_tital.'
               </ul><div id="" class="tab-content '.$tab_content_class.'">'.$items_content.'</div></div>';
		
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
				'icon' =>'',
			), $args
		);

		extract( $defaults );
		self::$args = $defaults;
		$itemId = ' '.$this->id."-".$this->num;
		
		$tabid = Utils::rand_str('tab-');
		
		$txtstyle='';
		$txtbl = ' false';
		$txtat = '' ;
		if($this->num == 1)
		{
			$txtstyle='active';
			$txtbl = 'true';
			$txtat = 'active in';
		}
        $this->item_tital .= sprintf(' <li role="presentation" class="'.$txtstyle.'"><a href="#'.$tabid.'" id="'.$tabid.'-tab" role="tab" data-toggle="tab" aria-controls="'.$tabid.'" aria-expanded="'.$txtbl.'"><h4 class="tab-title '.$this->colorid.' "> <i class="fa '.$icon.'"></i>'.$title.'</h4></a></li>');
				 
		 $html = '<div role="tabpanel" class="tab-pane fade '.$txtat.'" id="'.$tabid.'"><p>'.do_shortcode( Helper::fix_shortcodes($content)).'</p></div>';
		 
  		$this->num++;
		return $html;
	}
}

new Magee_Tabs();