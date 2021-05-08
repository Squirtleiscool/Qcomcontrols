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

class  roboGalleryModuleHoverV1 extends roboGalleryModuleAbstraction{

	const hoverTypeDisable 	= 0;
	const hoverTypeEffect 	= 'baseEffect';
	
	const hoverTypeIcons 	= 1;
	const hoverTypeTemplate = 2;

	private $style = array();
	private $hoverType = null;

	private $linkIcon 	= '';
	private $zoomIcon 	= '';
	private $titleHover = '';
	private $descHover 	= '';
	
	public function init(){
		$this->initScss();
		//$this->core->addEvent('gallery.block.before', array($this, 'initHover'));
		$this->core->addEvent('gallery.init', array($this, 'initHover'));
	}


	public function initHover(){
		$this->hoverType = $this->getMeta('hover');
		if( $this->hoverType == self::hoverTypeDisable ) return ;

		//if( $this->getMeta('effectType') != self::hoverTypeEffect ) return ;

		$this->initMobileHover();
		$this->initIconsHover();
		$this->initTemplateHover();		

		$this->initCssStyle();

		$this->core->addEvent('gallery.image.init', array($this, 'getHoverContent'));
	}
	

	private function initCssStyle(){
		if( !is_array($this->style) && !count($this->style) ) return ;

		foreach ($this->style as $elClass => $cssStyle) {
			$this->scssContent .= '.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .'.$elClass.'{'
				.$cssStyle
			.'}';
		}
		
	}

	private function initMobileHover(){
		if( !$this->getMeta('noHoverOnMobile' ) ) return ;
		$this->jsOptions->setValue( 'noHoverOnMobile',  'false' );			
	}

	private function initTemplateHover(){
		if( $this->hoverType != self::hoverTypeTemplate  ) return ;
		$this->templateHover= $this->getMeta('desc_template');
	}

	private function initIconsHover(){		
		if( $this->hoverType != self::hoverTypeIcons) return ;

		$this->linkIcon 	= $this->getTemplateItem( $this->getMeta('linkIcon'), 'rbsLinkIcon', 1 );
		$this->zoomIcon 	= $this->getTemplateItem( $this->getMeta('zoomIcon'), 'rbsZoomIcon', 1 , ($this->getMeta('thumbClick')?' rbs-lightbox':'') );
		$this->titleHover 	= $this->getTemplateItem( $this->getMeta('showTitle'),'rbsTitle', 	 '@TITLE@' );
		$this->descHover 	= $this->getTemplateItem( $this->getMeta('showDesc'), 'rbsDesc', 	 '@DESC@' );
	}


 	private function getTemplateItem( $item, $class = '', $template = '', $addClass = '' ){
		
		if( !is_array($item) 		 || !count($item) ) 	return ;
		if( !isset($item['enabled']) || !$item['enabled'] ) return ;
		
		$this->style[$class] = '';

		if( isset($item['fontSize'])) 		$this->style[$class] .= ' font-size:'.      (int)$item['fontSize'].'px;';
		if( isset($item['fontLineHeight'])) $this->style[$class] .= ' line-height:'.	(int)$item['fontLineHeight'].'%;';
		if( isset($item['color'])) 			$this->style[$class] .= ' color:'.			$item['color'].';';
		if( isset($item['fontBold'])) 		$this->style[$class] .= ' font-weight:'.	($item['fontBold']		?'bold'		:'normal').';';
		if( isset($item['fontItalic'])) 	$this->style[$class] .= ' font-style:'.		($item['fontItalic']	?'italic'	:'normal').';';
		if( isset($item['fontUnderline'])) 	$this->style[$class] .= ' text-decoration:'.($item['fontUnderline'] ?'underline':'none').';';
		if( isset($item['colorHover'])) 	$this->style[$class] .= ' &:hover{ color:'.	$item['colorHover'].'; }';

		if( $template!=1 ) return '<div class="'.$class.' '.$addClass.'">'.$template.'</div>'; 

		if(isset($item['colorBg'])) $this->style[$class] .= 'background:'.$item['colorBg'].';';

		if(isset($item['color']) && isset($item['borderSize']) && $item['borderSize'])
			$this->style[$class] .= 'border:'.(int)$item['borderSize'].'px solid '.$item['color'].';';

		if(isset($item['colorHover']) && isset($item['borderSize']) && $item['borderSize'])
			$this->style[$class] .= '&:hover{ border:'.(int)$item['borderSize'].'px solid '.$item['colorHover'].'; }';

		if(isset($item['colorBgHover']))
			$this->style[$class] .= '&:hover{ background:'.$item['colorBgHover'].'; }';
		
		return '<i class="fa '.$item['iconSelect'].' '.$class.' '.$addClass.'" ></i>';
	}


	function getHoverContent( $img ){			
			$hoverHTML = '';

			if($this->hoverType == self::hoverTypeIcons ){
				$hoverHTML .= $this->titleHover;
				if( $this->linkIcon || $this->zoomIcon ){
					$hoverHTML .= '<div class="rbsIcons">';
					if($this->linkIcon && $img['link'])
						$hoverHTML .= '<a href="@LINK@" '.($img['typelink']?'target="_blank"':'').' title="@TITLE@">'
										.$this->linkIcon
									.'</a>';
					if($this->zoomIcon) $hoverHTML .= $this->zoomIcon;
					$hoverHTML .= '</div>';
				}
				$hoverHTML .= $this->descHover;
			}


			/* robo_gallery check in class */
			if( $this->hoverType == self::hoverTypeTemplate  && $this->templateHover){
				$hoverHTML = $this->templateHover; 
			}


			if($hoverHTML){				
				$hoverHTML =  str_replace( 
					array('@TITLE@','@CAPTION@','@DESC@', '@LINK@', '@VIDEOLINK@'), 
					array( 
						$img['data']->post_title,
						$img['data']->post_excerpt,
						$img['data']->post_content,
						$img['link'],
						$img['videolink'],
					), 
					$hoverHTML
				);
			}
			$hoverHTML = '<div class="thumbnail-overlay">'.$hoverHTML.'</div>'; //.( !$this->zoomIcon ?'rbs-lightbox':'')
			
			return $hoverHTML;
		}

}