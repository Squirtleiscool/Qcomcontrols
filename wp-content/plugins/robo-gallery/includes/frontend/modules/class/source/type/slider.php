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

class RoboSliderSource {

	private $core = null;

	private $id = 0;
	private $options_id = 0;

	private $thumbsource;
	private $width;
	private $height;
	private $orderby = null;

	private $cats 	 = array();
	private $items 	 = array();
	private $children= array();
	private $tags 	 = array();

	public function __construct( $id, $core ) {
		$this->core 		= $core;
		$this->id       	= $id;
		$this->options_id  	= $this->core->gallery->options_id;	
		
		$this->core->addFilter('gallery.source.items', array($this, 'initImagesOrder') );

		$this->initSize();
		$this->initSelfItems();
		$this->initChildrenList();
		$this->initChildrenItems();
		$this->initItemsData();		
	}

	public function getItems(){
		return $this->items;
	}

	public function getTags(){
		return $this->tags;
	}

	public function getCats(){
		return $this->cats;
	}

	private function initSize(){
		//default
		$this->width 		= 240;
		$this->height 		= 140;

		$this->thumbsource 	= $this->core->getMeta('source') 	? $this->core->getMeta('source') 	: 'medium'	 ;
		$this->orderby 		= $this->core->getMeta('orderby') 	? $this->core->getMeta('orderby') 	: 'categoryD';
	}


	private function initChildrenList(){
		$my_wp_query  = new WP_Query();
		$all_wp_pages = $my_wp_query->query( array(
			'post_type'      => ROBO_GALLERY_TYPE_POST,
			//'fields'      => 'id=>parent',
			//'post_parent'    => $this->id,
			'orderby'        => array( 'menu_order' => 'DESC', 'order' => 'ASC', 'title' => 'DESC' ),
			'posts_per_page' => 999,
		) );
		$this->children =  get_page_children( $this->id, $all_wp_pages );
	}


	private function initChildrenItems(){
		if( !is_array($this->children) || !count($this->children) ) return;
		
		foreach ($this->children as $child) {
			$this->initChildItems($child);
		}
	}


	private function addItems( $items ){
		if( !is_array($items) || !count($items) ) return;
		$this->items = array_merge( $this->items, $items );
	}


	private function getGalleryItems( $galleryId ){
		if(!$galleryId) return array();
		
		// important get_post_meta
		$galleryItems = get_post_meta( $galleryId, ROBO_GALLERY_PREFIX . 'galleryImages', true );

		if( !isset($galleryItems) || !is_array($galleryItems) || !count($galleryItems) )  return array();
		return $galleryItems;
	}


	private function initSelfItems() {		
		$items = $this->getGalleryItems( $this->id );
		$itemsCats = $this->getItemsCats( $items, $this->id);
		$this->addItems( $itemsCats );
	}


	private function getItemsCats( $items, $catId ) {
		$itemsCats = array();
		if( !is_array($items) || !count($items) ) return $itemsCats;
		foreach( $items as $item ) $itemsCats[] = array( 'id' => $item, 'catid' => $catId );
		return $itemsCats;
	}


	private function initChildItems( $child ){
		if( !is_object($child) ||  !isset( $child->ID ) ) return ;

		$items = $this->getGalleryItems( $child->ID );
		$post = get_post( $child->ID );
		
		if( !is_object($post) ) return ;

		$this->cats[] = array(
			'id'    => $child->ID,
			'title' => $post->post_title,
			'name'  => $post->post_name
		);

		$this->addItems( $this->getItemsCats( $items, $child->ID ) );		
	}
	

	private function initItemsData() {

		if ( ! is_array( $this->items ) || !count( $this->items ) ){
			$this->items = array();
			return;
		}
		
		$counterImg = 0;

		foreach ( $this->items as $imgKey => $img ) {
			
			$imgId = $img['id'];

			$thumb = wp_get_attachment_image_src( $imgId, $this->thumbsource );

			if ( ! is_array( $thumb ) || count( $thumb ) < 1 ) {
				unset( $this->items[ $imgKey ] );
				continue ;
			}

			++$counterImg;
			
			$this->items[ $imgKey ]['id']		= $imgId;
			$this->items[ $imgKey ]['image']    = wp_get_attachment_url( $imgId );
			$this->items[ $imgKey ]['thumb']    = ( isset( $thumb[0] ) ) ? $thumb[0] : '';
			$this->items[ $imgKey ]['sizeW']    = ( isset( $thumb[1] ) ) ? $thumb[1] : $this->width; //*($i%2 ? 1.5: 1)
			$this->items[ $imgKey ]['sizeH']    = ( isset( $thumb[2] ) ) ? $thumb[2] : $this->height;
			$this->items[ $imgKey ]['data']     = get_post( $imgId );
			$this->items[ $imgKey ]['link']     = get_post_meta( $imgId, ROBO_GALLERY_PREFIX . 'gallery_link', true );
			$this->items[ $imgKey ]['typelink'] = get_post_meta( $imgId, ROBO_GALLERY_PREFIX . 'gallery_type_link', true );
			$this->items[ $imgKey ]['videolink']= $this->getItemVideoLink($imgId);
			$this->items[ $imgKey ]['col']    	= get_post_meta( $imgId, ROBO_GALLERY_PREFIX . 'gallery_col', true );
			$this->items[ $imgKey ]['effect'] 	= get_post_meta( $imgId, ROBO_GALLERY_PREFIX . 'gallery_effect', true );
			$this->items[ $imgKey ]['alt']    	= get_post_meta( $imgId, '_wp_attachment_image_alt', true );
			$this->items[ $imgKey ]['tags'] 	= $this->getItemTags( $imgId );									
		}		

		$this->items = $this->core->applyFilters( 'gallery.source.items', $this->items );
	}

	private function getItemVideoLink( $imgId ){
		$videolink = get_post_meta( $imgId, ROBO_GALLERY_PREFIX.'gallery_video_link', true );
		if(!$videolink) return '';
		if( strpos( $videolink, 'youtu' ) !== false ){
			$matches = array();
			preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $videolink, $matches );
			if( is_array( $matches ) && isset( $matches[0] ) && $matches[0] ) $videolink = 'https://youtube.com/v=' . $matches[0];
		}
		return $videolink;
	}


	private function getItemTag( $imageId ){ 
		return get_post_meta( $imageId, ROBO_GALLERY_PREFIX . 'gallery_tags', true ); 
	}

	private function getItemTags( $imageId ) {
		$tagsArray = array();
		
		$tags = $this->getItemTag( $imageId );

		if( !$tags ) return $tagsArray;

		$tags = explode( ',', $tags );
		
		if( !is_array($tags) || !count($tags) ) return $tagsArray;

		foreach ($tags as $key => $tag) {
			$tag   = trim($tag);
			$tags[$key] = $tag;
			if ( array_search( $tag, $this->tags ) === false )  $this->tags[] = $tag;
		}
		
		$tagsArray = $tags;		

		return $tagsArray;
	}
	

	public function initImagesOrder( $items ) {
		
		switch ( $this->orderby ) {
			case 'random': 		shuffle($items ); 							break;
			case 'titleU': 		usort( $items, array( $this, 'titleUp' ) ); break;
			case 'titleD':		usort( $items, array( $this, 'titleDown' ) );break;
			case 'dateU':		usort( $items, array( $this, 'dateUp' ) ); 	break;
			case 'dateD':		usort( $items, array( $this, 'dateDown' ) );break;
			case 'categoryU':	$items = array_reverse( $items ); 			break;
			case 'categoryD': 	default: 									break;
		}
		if( !is_array($items) ) $items = array();
		return $items;		
	}


	/*  ====  */

	private function titleUp( $item1, $item2 ) {
		return strcasecmp( $item1['data']->post_title, $item2['data']->post_title ) * - 1;
	}

	private function titleDown( $item1, $item2 ) {
		return strcasecmp( $item1['data']->post_title, $item2['data']->post_title );
	}

	private function dateUp( $item1, $item2 ) {
		if ( $item1['data']->post_date == $item2['data']->post_date ) {
			return 0;
		}
		if ( $item1['data']->post_date > $item2['data']->post_date ) {
			return 1;
		} else {
			return - 1;
		}
	}

	private function dateDown( $item1, $item2 ) {
		if ( $item1['data']->post_date == $item2['data']->post_date ) {
			return 0;
		}
		if ( $item1['data']->post_date > $item2['data']->post_date ) {
			return - 1;
		} else {
			return 1;
		}
	}

}