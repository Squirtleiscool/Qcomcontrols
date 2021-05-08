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

class  roboGalleryModuleMenuV1 extends roboGalleryModuleAbstraction{
	
	private $buttonClass = '';

	public function init(){
		if( !$this->getMeta('menu') ) return ;

		$this->initScss(); 
		$this->core->addEvent('gallery.init', array($this, 'initMenu'));
	}

	public function initMenu( ){
		$this->core->addEvent('gallery.images.get',	array($this, 'renderMenu'));				
		//$this->core->addEvent('gallery.block.before',	array($this, 'renderMenu'));				
	}	

	public function renderMenu(){ 		
 		
 		$this->jsOptions->setValue( 'filterContainer',  	'#'.$this->gallery->galleryId.'filter' );

 		$this->addScssFiles(); 		

 		$this->initSearch(); 		
 		
 		$this->initAlign();
 		
 		$this->initButtonStyle();

 		$this->applyButtonStyle();

 		$this->initButtons();
 		
 		$this->core->setContent( $this->getTemplate(), 'BlockBefore', 'before' );
 	}

 	private function addScssFiles(){
 		$this->scssFiles[] = array(
 			'name' => 'menu.scss',
 			'path' => 'base-grid/menu/',
 		 );
 	}

 	private function initButtons(){		
 		$this->getRootButton();
 		$retHtml = '';
 		if( $this->getMeta('menuTag') ){
 			$retHtml .= $this->getTagsMenu();
 		} else {
 			$retHtml .= $this->getCategoryMenu();
 		}
 		$this->core->setContent( $retHtml, 'menuV1.buttons' );
 	}


 	private function getRootButton(){ 
 		if( !$this->getMeta('menuRoot') ) return ;

		$rootLabel =  $this->getMeta('menuRootLabel');
		$rootButton = $this->button( $rootLabel, '*' );
		$this->core->setContent( $rootButton, 'menuV1.buttons', 'before');
 	}

 	private function button( $label, $filter='' ){
		return '<a class="button '.$this->buttonClass.' " href="#" data-filter="'.$filter.'">'.esc_attr($label).'</a>';
 	}

 	private function getTemplate(){
 		return 
 		$this->core->getContent('menuV1.begin')
 		.'<div '
 			.'class="rbs_gallery_button '.$this->core->getContent('menuV1.block.class').'" '
 			.'id="'.$this->gallery->galleryId.'filter" '
 			.'style=" display: none;" '
 			.'>'
 				.$this->core->getContent('menuV1.buttons')
 		.'</div>'
 		.$this->core->getContent('menuV1.end');
 	}

 	private function initAlign(){
 		$align = $this->getMeta('buttonAlign');
 		if($align){
 			$align = ' rbs_gallery_align_'.$align;
 			$this->core->setContent( $align, 'menuV1.block.class');
 		}
 		 		
 		$this->scssVar['paddingLeft'] 	= (int) $this->getMeta('paddingLeft');
 		$this->scssVar['paddingBottom'] = (int) $this->getMeta('paddingBottom');
 	}


 	private function initSearch(){
 		if( ! $this->getMeta('searchEnable') ) return '';

		$searchColor = $this->getMeta('searchColor');
		if($searchColor){
			$this->scssVar['searchColor'] = $searchColor;
			$this->scssContent .= ' 
			.robo-gallery-wrap-id#{$galleryid}:not(#no-robo-galery) .rbs_search_wrap{ 
				color: $searchColor;
				input.rbs-search{ 
					border-color: $searchColor; 
					color: $searchColor; 
					&::placeholder { 
						color: $searchColor; 
					}
				}				
			}';
		}

		$retHtml = ''; 
		/* Search gallery item block */
		$retHtml .= '<div class="rbs_search_wrap">';
			$searchLabel =  $this->getMeta('searchLabel');
			$retHtml .= '<input type="text" class="rbs-search" placeholder="'.$searchLabel.'" />';
		$retHtml .= '</div>';

		/* Setup  gallery */
		$this->jsOptions->setValue( 'search',  		'#'.$this->gallery->galleryId.'filter .rbs-search' );
		$this->jsOptions->setValue( 'searchTarget',  '.rbs-img-image' );

		$this->core->setContent( $retHtml, 'menuV1.buttons');		
 	}

 	private function getTagsMenu($class='', $style=''){
			$retHtml = '';
			
			$menuTagSort = $this->getMeta('menuTagSort');

			$tags = $this->source->getTags();
			
			if( !is_array($tags) ) return ;

			if($menuTagSort=='asc')	asort($tags);
			if($menuTagSort=='desc')arsort($tags);	

			foreach ($tags as $key => $title) {				
				$retHtml .= $this->button( $title, '.tag_id'.$key );
			}

 			return $retHtml;
		}


 	private function getCategoryMenu(){
 		$categories = $this->source->getCats();

 		if( !is_array($categories) || !count($categories) ) return ;

 		$retHtml ='';

 		foreach ( $categories as $category) {
 			$retHtml .= $this->button( $category['title'], '.category'.$category['id'] );
 		}
		return $retHtml;
 	}


 	private function initButtonStyle(){

 		$optionName = 'button';

 		$class = ''; 		

		switch ( $this->getMeta($optionName.'Fill') ) {
 			case 'flat': 	$class .= 'button-flat';	break;
 			case '3d': 		$class .= 'button-3d'; 		break;
 			case 'border': 	$class .= 'button-border'; 	break;
 			case 'normal': default: $class .= 'button'; break;
 		}


 		switch ( $this->getMeta($optionName.'Color') ) {
 			case 'blue': 	$class .= '-primary '; 	break;
	 		case 'green': 	$class .= '-action '; 	break;
	 		case 'orange': 	$class .= '-highlight '; break;
	 		case 'red': 	$class .= '-caution '; 	break;
	 		case 'purple': 	$class .= '-royal '; 	break;
	 		case 'gray': default: $class .= ' '; 	break;
 		}

 		switch ( $this->getMeta($optionName.'Type') ) {
 			case 'rounded': $class .= 'button-rounded ';break;
 			case 'pill': 	$class .= 'button-pill '; 	break;
 			case 'circle': 	$class .= 'button-circle '; break;
 			case 'normal': default: 					break;
 		}

 		switch ( $this->getMeta($optionName.'Size') ) {
 			case 'jumbo': 	$class .= 'button-jumbo '; 	break;
 			case 'large': 	$class .= 'button-large '; 	break;
 			case 'small': 	$class .= 'button-small '; 	break;
 			case 'tiny': 	$class .= 'button-tiny '; 		break;
 			case 'normal': default: 					break;
 		} 		
 		$this->buttonClass = $class; 		
 	}


 	private function applyButtonStyle(){
 		$this->jsOptions->setValue( 'loadMoreClass', $this->buttonClass );
 		$this->core->element->setElementAttr('menu', 'class', $this->buttonClass );
 	}

}