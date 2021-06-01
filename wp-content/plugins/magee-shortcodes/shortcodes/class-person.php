<?php
namespace MageeShortcodes\Shortcodes;
use MageeShortcodes\Classes\Helper;
use MageeShortcodes\Classes\Utils;

class Magee_Person {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_person', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		Helper::get_style_depends(['font-awesome', 'magee-shortcodes']);

		$defaults =	Helper::set_shortcode_defaults(
			array(
				'id' 					=>'',
				'class' 				=>'',
				'name'					=>'',
				'style'                 =>'',	
				'title' 				=>'',
				'link_target'           =>'',
				'overlay_color'         =>'',
				'overlay_opacity'       =>'0.5',
				'picture' 				=>'',
				'piclink'				=>'#',	
				'picborder' 			=>'0',
				'picbordercolor' 		=>'',
				'picborderradius'		=>'0',
				'iconboxedradius'		=>'4px',
				'iconcolor'				=>'#595959',	
				'link1'					=>'#',
				'link2' 				=>'#',
				'link3'					=>'#',				
				'link4' 				=>'#',
				'link5' 				=>'#',
				'icon1'					=>'',
				'icon2' 				=>'',
				'icon3'					=>'',				
				'icon4' 				=>'',
				'icon5' 				=>'',
				'is_preview' => ''
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		if(is_numeric($picborder))
			$picborder = $picborder.'px';
		if(is_numeric($picborderradius))
			$picborderradius = $picborderradius.'px';
		if(is_numeric($iconboxedradius))
			$iconboxedradius = $iconboxedradius.'px';
		
		$uniqid = Utils::rand_str('person-');

        $class .= ' '.$uniqid;
		$add_class = 'col-sm-6';
		
		if($overlay_color !='')
			$overlay_color = str_replace('#','', $overlay_color);
		$r = hexdec(substr($overlay_color,0,2)) ;
		$g = hexdec(substr($overlay_color,2,2)) ;
		$b = hexdec(substr($overlay_color,4,2)) ;		
		$textstyle1 = sprintf('.'.$uniqid.' .person-vcard.person-social li a i{ border-radius: %1$s; background-color:%2$s;}', $iconboxedradius, $iconcolor);
		$textstyle1 .= sprintf('.'.$uniqid.' .person-vcard.person-social li a img{ border-radius: %1$s; background-color:%2$s;}', $iconboxedradius, $iconcolor);
		$textstyle2 = sprintf('.'.$uniqid.' .img-box img{ border-radius: %s; display: inline-block;}', $picborderradius);
		
		$imgstyle = '';
		if( $picborder !='' )
			$imgstyle .= sprintf('.'.$uniqid.' .img-box img{border-width: %s;border-style: solid;}', $picborder);
		
		if( $picbordercolor !='' )
			$imgstyle .= sprintf('.'.$uniqid.' .img-box img{border-color: %s;}', $picbordercolor);
		if( $style == 'beside'){
			$afterstyle = '.'.$uniqid.' .person-vcard .person-title:after{margin-left:auto;}';
			$leftstyle1 = '.'.$uniqid.' .person-social{text-align:left;}' ;
			$leftstyle2 = '.'.$uniqid.' .person-social li a i{margin-left:6px;} ' ;
			$css_style = sprintf( '%1$s %2$s %3$s %4$s %5$s %6$s', $textstyle1, $textstyle2, $imgstyle, $afterstyle, $leftstyle1, $leftstyle2);
		}else{
			$css_style = sprintf( '%1$s %2$s %3$s', $textstyle1, $textstyle2, $imgstyle);
		}
		if($overlay_opacity !='')
			$divimgtitle =sprintf( '<div class="img-overlay primary" style="background-color:rgba(%1$s,%2$s,%3$s,%4$s);"><div class="img-overlay-container"><div class="img-overlay-content"><i class="fa fa-link"></i></div></div></div>', $r, $g, $b, $overlay_opacity);
		
		$divimga = sprintf('<a target="%1$s" href="%2$s" ><img src="%3$s">%4$s</a>', $link_target, $piclink, $picture, $divimgtitle);	
		if( $style == 'beside'){
			$divimg = sprintf('<div class="person-img-box %1$s"><div class="img-box figcaption-middle text-center fade-in">%2$s</div></div>', $add_class, $divimga);}
		else{
			$divimg = sprintf('<div class="person-img-box"><div class="img-box figcaption-middle text-center fade-in">%s</div></div>', $divimga);
		}
		$divname = sprintf('<h3 class="person-name" style="text-transform: uppercase;">%s</h3>', $name);

		$divtitle = sprintf('<h4 class="person-title" style="text-transform: uppercase;">%s</h4>', $title);

		$divcont = sprintf('<p class="person-desc">%s</p>', do_shortcode( Helper::fix_shortcodes($content)));
		$divli = '';
		if($icon1 != ''){
		    if( stristr($icon1,'fa-')):
				$divli .= sprintf(' <li><a href="%1$s"><i class="fa %2$s"></i></a></li>', $link1, $icon1);
			else:
				$divli .= sprintf(' <li><a href="%1$s"><img src="%3$s" class="image_instead"/></i></a></li>', $link1, $icon1);
			endif;
			
		}
		if($icon2 != ''){
		    if( stristr($icon2,'fa-')):
				$divli .= sprintf(' <li><a href="%1$s"><i class="fa %2$s"></i></a></li>', $link2, $icon2);
			else:
				$divli .= sprintf(' <li><a href="%1$s"><img src="%s2$" class="image_instead"/></i></a></li>', $link2, $icon2);
			endif;  
		}
		if($icon3 != ''){
			if( stristr($icon3,'fa-')):
				$divli .= sprintf(' <li><a href="%1$s"><i class="fa %2$s"></i></a></li>', $link3, $icon3);
			else:
				$divli .= sprintf(' <li><a href="%1$s"><img src="%2$s" class="image_instead"/></i></a></li>', $link3, $icon3);
			endif;
		}
		if($icon4 != ''){
			if( stristr($icon4,'fa-')):
				$divli .= sprintf(' <li><a href="%1$s"><i class="fa %2$s"></i></a></li>', $link4, $icon4);
			else:
				$divli .= sprintf(' <li><a href="%1$s"><img src="%2$s" class="image_instead"/></i></a></li>', $link4, $icon4);
			endif;
		}
		if($icon5 != ''){
			if( stristr($icon5,'fa-')):
				$divli .= sprintf(' <li><a href="%1$s"><i class="fa %2$s"></i></a></li>', $link5, $icon5);
			else:
				$divli .= sprintf(' <li><a href="%1$s"><img src="%2$s" class="image_instead"/></i></a></li>', $link5, $icon5);
			endif;
		}	
		if( $style == 'beside'){
			$divul=sprintf('<div class="person-vcard text-left %1$s">%2$s %3$s %4$s<ul class="person-social" >%5$s</ul></div>', $add_class, $divname, $divtitle, $divcont, $divli);
		}else{
			$divul=sprintf('<div class="person-vcard text-center">%1$s %2$s %3$s<ul class="person-social" >%4$s</ul></div>', $divname, $divtitle, $divcont, $divli);
		}	
		if( $style == 'beside'){						
			$html=sprintf('%1$s<div class="magee-person-box %2$s person-box-horizontal row" id = "%3$s">%4$s %5$s</div>', $styles, $class, $id, $divimg, $divul);
        }else{
			$html=sprintf('%1$s<div class="magee-person-box %2$s " id = "%3$s">%4$s %5$s</div>', $styles, $class, $id, $divimg, $divul);
		}
		
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

new Magee_Person();