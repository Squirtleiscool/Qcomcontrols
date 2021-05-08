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

/*
	isElementHasClass( element,  class ) : boolean
	isElementHasAttr( element,  class ) : boolean
	isElementHasStyle( element,  class ) : boolean
	
	addClass( element, class )
	addElementStyle( element, style, $value )
	setElementAttr( element, attr, value )

	getElementClasses( element, id = 0 )
	getElementStyles(  element, id = 0 )

	getElementAttr(  element, attrName )
	getElementClass( element, attrName )

	getElementAttrs( element, id = 0 )
	
*/

class  roboGalleryModuleElement{
	
	private $core 		= null;
	private $gallery 	= null;

	private $id 		= null;
	private $options_id 	= null;
	
	protected $elementClass = array();
	protected $elementAttr 	= array();
	protected $elementStyle = array();

	public function __construct( $core ){
	        $this->core 	= $core;
	        $this->gallery 	= $core->gallery;
	    
	        $this->id = $this->gallery->id;
	        $this->options_id = $this->gallery->options_id;
	    	       	
	}

	public function isElementHas( $type, $element, $attrName= '' ){
		if( !$type || !$element ) return ;
		if( !isset($this->{'element'.$type}[$element]) ) return ;
		if( !$attrName ) return true;
		if( !isset($this->{'element'.$type}[$element][$attrName]) ) return ;
		if( !$this->{'element'.$type}[$element][$attrName] ) return ;
		return true;
	}

	public function isElementHasClass( $element, $attrName= '' ){ return $this->isElementHas('Class', $element, $attrName); }
	public function isElementHasAttr(  $element, $attrName= '' ){ return $this->isElementHas('Attr', $element, $attrName); 	}
	public function isElementHasStyle( $element, $attrName= '' ){ return $this->isElementHas('Style', $element, $attrName); }
	

	public function set( $type, $element, $attrName, $value='' ){
		if( !$type || !$element || !$attrName ) return ;
		if( !$this->isElementHas( $type, $element) ) $this->{'element'.$type}[$element] = array();
		$this->{'element'.$type}[$element][$attrName] = $value;
	}

	public function addClass( $element, $attrName )						{ $this->set('Class', $element, $attrName, $attrName); 	}
	public function addElementStyle( $element, $attrName, $value='' )	{ $this->set('Style', $element, $attrName, $value); 	}
	public function setElementAttr( $element, $attrName, $value='' )	{ $this->set('Attr', $element, $attrName, $value); 		}
	


	public function getElementClasses( $element, $id = 0 ){ return $this->getElementValsList('Class', $element, $id); }
	public function getElementValsList( $type, $element, $id = 0 ){
		if( !$type || !$element ) return ;	

		$elementValsList = ' ';
		if( $id ) $elementValsList .= $this->getElementValsList( $type, $element.$id );
			
		if( !$this->isElementHas( $type, $element ) ) return $elementValsList;
		
		foreach ( $this->{'element'.$type}[$element] as $name => $value) {			
			$elementValsList .= $value.' ' ;
		}
		return $elementValsList;
	}


	public function getElementAttr( $element, $attrName ){ return $this->getElementVal('Attr', $element, $attrName); }
	public function getElementClass( $element, $attrName ){ return $this->getElementVal('Class', $element, $attrName); }
	
	public function getElementVal( $type, $element, $attrName ){
		if( !$type || !$element || !$attrName ) return ;
		if( !$this->isElementHas( $type, $element, $attrName ) ) return ;
		return $this->{'element'.$type}[$element][$attrName];
	}
	

	public function getElementStyles( $element, $id = 0 ){
		if( !$element ) return ;	
		$styles = '';
		if($id) $styles .= $this->getElementStyles( $element.$id );
			
		if( !$this->isElementHas( 'Style', $element ) ) return $styles;
		
		foreach ( $this->elementStyle[$element] as $name => $value) {
			$styles .= $name.':'.$value.';';
		}
		return $styles;		
	}

	public function getElementAttrs( $element, $id = 0 ){ return $this->getElementVals( 'Attr', $element, $id ); }
	public function getElementVals( $type, $element, $id = 0 ){
		if( !$type || !$element ) return ;	
		$attrs = '';
		if($id) $attrs .= $this->getElementVals( $type, $element.$id );
			
		if( !$this->isElementHas( $type, $element ) ) return $attrs;
		
		foreach( $this->{'element'.$type}[$element] as $name => $value){
			$attrs .= ' '.$name.'="'.$value.'" ';	
		}
		return $attrs;
	}



	/*public function updateClass( $element, $newClass, $oldClass = '' ){
		if( !$element || !$newClasses ) return ;		
		
		if( $oldClass && $this->isElementHasClass($element, $oldClass) ){
			$this->removeClass($element, $oldClass);
		}
		$this->addClass($element, $newClass);
	}

	public function removeClass( $element, $removeClass ){
		if( !$element || !$removeClass ) return ;
		if( !$this->isElementHasClass($element, $removeClass) ) return ;
		unset($this->elementClass[$element][$removeClass]);
		return true;
	}

	public function removeClasses( $element, $removeClasses ){
		if( !$element || !is_array($removeClasses) || !count($removeClasses) ) return ;
		foreach($removeClasses as $removeClass) $this->removeClass( $element, $removeClass );
	}
	*/
	

	

	
}