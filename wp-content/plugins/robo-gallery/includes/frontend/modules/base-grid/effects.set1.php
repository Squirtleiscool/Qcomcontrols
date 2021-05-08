<?php
/* 
*      Robo Gallery     
*      Version: 3.0.7 - 90614
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */

if ( ! defined( 'WPINC' ) ) exit;

class  roboGalleryModuleEffectSet1 extends roboGalleryModuleAbstraction{
	
	private $effect = 'zoe';
	private $template = '';

	public function init(){
		if( $this->getMeta('effectType') != 'set1') return ;

		$this->initScss();
		//$this->core->addEvent('gallery.block.before', array($this, 'initHover'));
		$this->core->addEvent('gallery.init', array($this, 'initEffect'));
	}

	public function initEffect(){
		//$this->effect = $this->getMeta('effectStyle'); //'lily' 'sadie' roxy
		if(!$this->effect) return ;

		$this->core->jsOptions->setValue( 'effectType',  	'set1Effect' );

		$this->core->element->addClass('robo_gallery', 'rbs_effect_set1');
		$this->core->element->addClass('robo_gallery', 'effect-'.$this->effect);
		$this->core->jsOptions->setValue( 'effectStyle', $this->effect );

		$this->initContentTemplate();

		$this->core->addEvent('gallery.image.rbs-img-thumbs-block', array($this, 'renderImgThumbsBlock') ); 		
	}
	private function internoetics_mb_strimwidth($string, $start = 0, $width = 120, $trimmarker = '...') {
  		$len = strlen(trim($string));
  		$newstring = ( ($len > $width) && ($len != 0) ) ? rtrim(mb_strimwidth($string, $start, $width - strlen($trimmarker))) . $trimmarker : $string;
 		return $newstring;
	}

	public function renderImgThumbsBlock($item){
		$hoverHTML = $this->template;
		
		$hoverHTML =  str_replace( 
			array('@TITLE@','@CAPTION@','@DESC@', '@LINK@', '@VIDEOLINK@'), 
			array( 
				$this->internoetics_mb_strimwidth( $item['data']->post_title, 0, 25),
				$item['data']->post_excerpt,
				$item['data']->post_content,
				$item['link'],
				$item['videolink'],
			), 
			$hoverHTML
		);
		return $hoverHTML;
	}

	private function initContentTemplate(){
		$template = 
		'<figcaption>								
			<h2>@TITLE@</h2>
			<p class="icon-links">
				
				<a href="#"><span class="icon-eye"></span></a>
				<a href="#"><span class="icon-paper-clip"></span></a>
			</p>
            <p class="description">@DESC@</p>                				
        </figcaption>';

		/*

		<a href="#"><span class="icon-heart"></span></a>

		$template = 

		'<figcaption>
			<div>
				<h2>@TITLE@</h2>
       			<p>@DESC@</p>
        	</div>
    	</figcaption>';*/

    	$this->template = $template;

	}

	private function initBlockClass(){

	}

	private function initImageClass(){

	}

}