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

class  roboGalleryModuleLightboxV1 extends roboGalleryModuleAbstraction{		

	public function init(){		
		$this->initScss();
		$this->core->addEvent('gallery.init', array($this, 'initLightbox') );
	}

	public function initLightbox( ){
		/* set rtl for swipe */
		if( is_rtl() ) $this->jsOptions->setValue( 'touchRtl', true );

		$this->jsOptions->setOption( 'deepLinking' );

		$this->initLightboxText();

		$this->initSocialButton();
		
		$this->initActionButton();
		
		$this->initBg();
		
		$this->core->addEvent('gallery.image.init.before', array($this, 'initImageData'));

		$this->core->addEvent('gallery.image.init', array($this, 'renderLightboxDescription'));
	}

	public function initImageData( $img ){
		
		$this->initLightboxClick($img);
		
		$this->initLightboxPanel($img);

		$this->initLightboxVideoLink($img) || $this->initLightboxLink($img) || $this->initLightboxImageLink($img);
	}			
	
	public function initLightboxImageLink( $img ){
		if( !isset( $img['image'] ) || !$img['image'] ) return false;
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-popup', $img['image'] );
		return true;
	}

	public function initLightboxVideoLink( $img ){
		if( !isset($img['videolink']) || !$img['videolink'] ) return false;
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-popup', $img['videolink'] );
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-type', 'iframe' );
		return true;
	}

	public function initLightboxLink($img){
		if( empty($img['link']) ) return false;
		
		if( !$this->getMeta('hover') ) return false;

		if( !empty($this->getMeta('zoomIcon')['enabled']) ) return false;

		if( !empty($this->getMeta('linkIcon')['enabled']) ) return false;
		
		$linkType = empty($img['typelink']) ? 'link' : 'blanklink';
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-type', $linkType );
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-popup', $img['link'] );
		return true;	
	}

	public function initLightboxClick($img){
		if( $this->getMeta('thumbClick') ) return ;
		$this->element->addClass('rbs-img-image-block'.$img['id'], 'rbs-lightbox' );
	}

	public function renderLightboxDescription( $img ){
		if( empty($img['data']) ) return ;
		$this->initLightboxDescription( $img );
		$this->initLightboxAltDescription( $img );
		return '<div class="rbs-img-data-popup" '.$this->element->getElementAttrs('rbs-img-data-popup', $img['id']).'></div>';
	}

	private function initLightboxAltDescription( $img ){
		if( empty($img['alt']) ) return ;
		$this->element->setElementAttr('rbs-img-data-popup'.$img['id'], 'data-alt', esc_attr($img['alt']) );
	}

	private function initLightboxDescription( $img ){
		$lightboxText = '';
		switch ( $this->getMeta('lightboxSource') ) {
			case 'title':
					$lightboxText = $img['data']->post_title;
				break;
			case 'desc':
					$lightboxText = $img['data']->post_content;
				break;
			case 'caption':
					$lightboxText = $img['data']->post_excerpt;
				break;
		}		
		$this->element->setElementAttr( 'rbs-img-data-popup'.$img['id'], 'title', esc_attr($lightboxText) );
	}


	public function initLightboxPanel( $img ){

		if( !$this->getMeta('lightboxDescPanel' ) ) return ;
		if( empty($img['data']) ) return ;

		$descBoxData=''; 		

		switch( $this->getMeta('lightboxDescSource') ){
			case 'caption': 
				$descBoxData = $img['data']->post_excerpt;
				break;

			case 'desc': 
				$descBoxData = $img['data']->post_content;
				break;

			default:
			case 'title':
				$descBoxData = $img['data']->post_title;
				break;
		}

		if(!$descBoxData) return ;

		$this->element->setElementAttr('rbs-img-image-block'.$img['id'], 'data-descbox', esc_attr($descBoxData) );
	}


	private function initSocialButton(){
		if( !$this->core->getMeta('lightboxSocial') ) 			return ;
	
		if( $this->core->getMeta('lightboxSocialFacebook') ) 	$this->jsOptions->setValue('facebook', 	true);
		if( $this->core->getMeta('lightboxSocialTwitter') ) 	$this->jsOptions->setValue('twitter', 	true);
		if( $this->core->getMeta('lightboxSocialPinterest') ) 	$this->jsOptions->setValue('pinterest', true);
		if( $this->core->getMeta('lightboxSocialVK') ) 			$this->jsOptions->setValue('vk', 		true);
	}


		

	private function initBg(){
		$lightboxBackground = $this->core->getMeta( 'lightboxBackground');
		if( !$lightboxBackground ) return ;
		$this->scssVar['lightboxBackground'] = $lightboxBackground;
		$this->scssContent .= '.robo-lightbox-id#{$galleryid}:not(#no-robo-galery) .mfp-ready.mfp-bg{ background-color: $lightboxBackground; }';
	}

	private function initActionButton(){
		
		if( $this->core->getMeta('lightboxSourceButton') ){
			$this->jsOptions->setValue( 'hideSourceImage', true );
		}

		if( !$this->core->getMeta('lightboxClose') ){
			$this->scssContent .= '.robo-lightbox-id#{$galleryid}:not(#no-robo-galery) .mfp-container .mfp-close{ display:none; }';
		}

		if( !$this->core->getMeta('lightboxArrow') )
			$this->scssContent .= '.robo-lightbox-id#{$galleryid}:not(#no-robo-galery) .mfp-container .mfp-arrow{ display:none; }';
	}

	private function initLightboxText(){

		if( $lightboxColor = $this->getMeta('lightboxColor') ){
			$this->scssVar['lightboxColor'] = $lightboxColor;
			$this->scssContent .= '
			.robo-lightbox-id#{$galleryid}:not(#no-robo-galery) .mfp-bottom-bar{
				.mfp-title,.mfp-counter { color: $lightboxColor; }
			}';
		}

		if( $this->getMeta('lightboxDescPanel')){
			$this->jsOptions->setValue( 'descBox',  true );
			$this->jsOptions->setValue( 'descBoxClass',  'rbs_desc_panel_'.$this->core->getMeta('lightboxDescClass') );
		}

		if( !$this->getMeta('lightboxTitle') ) $this->jsOptions->setValue( 'hideTitle',  true );
		
		$lightboxCounterText="";
		if( $this->getMeta('lightboxCounter') ){
			$lightboxCounterText = '%curr% '.esc_attr($this->getMeta('lightboxCounterText')).' %total%';
		}
		$this->jsOptions->setValue( 
			'lightboxOptions/gallery', 
			array(  
				'enabled' => true, 
				'tCounter' => $lightboxCounterText 
			) 
		);


		if( $this->getMeta('lightboxMobile') ){
			$this->jsOptions->setValue( 'lightboxOptions',  array(
				'image'=> array(
					'verticalFit' => true
				),
				'mainClass' => "my-mfp-slide-bottom mfp-img-mobile"
			));
		}
		
	}

}