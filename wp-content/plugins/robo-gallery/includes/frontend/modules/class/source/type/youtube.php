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

class RoboYoutubeSource {

	private $core = null;
	private $cacheDB = null;
	private $gallery = null;

	private $id = 0;

	private $resourceId = '';
	private $resourceType = 'user';	

	private $resourceCountMax = 50;
	private $youtubeCacheTime = 12;

	private $api_key='';	
	
	private $errors = array();

	private $items = array();
	private $tags = array();
	private $cats = array();

	private $incorrectParams = false;


	public function __construct( $id, $core ) {
		$this->core 	= $core;
		$this->cacheDB 	= $core->cacheDB;
		$this->gallery 	= $core->gallery;

		$this->id       = $id;		
		
		$this->options_id= $this->core->gallery->options_id;		

		$this->initResource();

		if( !$this->isCorrectParams() ){
			$this->incorrectParams = true;			
			//print_r($this->errors);
			return false;
		}

		$this->initItems();
	}

	public function getItems(){ return $this->items; 	}
	public function getTags(){	return $this->tags; 	}
	public function getCats(){ 	return $this->cats; 	}

	private function initResource(){
		$this->api_key   		= get_option( ROBO_GALLERY_PREFIX.'youtubeApiKey' );
		$this->youtubeCacheTime = get_option( ROBO_GALLERY_PREFIX.'youtubeCacheTime' );

		$this->resourceCountMax = get_post_meta( $this->id, ROBO_GALLERY_PREFIX.'youtube_count_max', true );

		$this->resourceType= get_post_meta( $this->id, ROBO_GALLERY_PREFIX.'galleryYoutubeType', true );
		//echo $this->resourceType;
		$this->resourceId 	= get_post_meta( $this->id, ROBO_GALLERY_PREFIX.'galleryYoutubeValue', true );
		//echo $this->resourceId;

	}

	private function isCorrectParams(){
		if( ! (int) $this->resourceCountMax ) $this->resourceCountMax = 50;
		if( ! (int) $this->youtubeCacheTime ) $this->youtubeCacheTime = 12;
		
		if( !$this->api_key ){
			$this->errors[] = 'Youtube  api is empty';
			return false;
		}

		if( !$this->resourceType || !$this->resourceId ){
			$this->errors[] = 'Youtube source is empty';
			return false;
		}
		
		if( in_array( $this->resourceType, array( 'user', 'playlist', 'channel', 'ids' ) )===false  ){
			$this->errors[] = 'type Youtube source is incorrect';
			return false;
		}
		
		if( !$this->resourceId ){
			$this->errors[] = 'value Youtube source is incorrect';
			return false;	
		}			
		
		switch( substr( $this->resourceId, 0, 2 ) ){
			case 'UC':
					if( $this->resourceType != 'channel' ){
						$this->errors[] = 'type Youtube channel source is incorrect';
						return false;	
					}
				break;
			case 'PL':
					if( $this->resourceType != 'playlist' ){
						$this->errors[] = 'type Youtube playlist source is incorrect';
						return false;
					}
				break;
			default:  
				/*if( $this->resourceType != 'user' ){
					$this->errors[] = 'type Youtube user source is incorrect';
					return false;
				}*/
		}
		return true;
	}

	private function getApiUrl( $resourceId ){
		switch ($this->resourceType) {
			case 'channel':
					$api_url = $this->urlChannel( $resourceId );
				break;
			case 'playlist':
					$api_url = $this->urlPlayList( $resourceId );
				break;
			case 'user':
					$api_url = $this->urlUserName( $resourceId );
				break;
			case 'ids':
					$api_url = $this->urlIds( $resourceId );
				break;
			default:
				    $api_url = false;
				break;
		}
		return $api_url;
	}

	private function getJsonRequest( $apiUrl, $params = array() ){
		
		if(!$apiUrl){
			$this->errors[] = 'Youtube request error - api url is empty';
			return false;
		}

		$request = wp_safe_remote_get($apiUrl, $params );

		if ( is_wp_error( $request ) ) {
			$this->errors[] = 'wp request error';
    		return false;
		}

		$requestBody = wp_remote_retrieve_body( $request );		
		
		if(!$requestBody) return false;		

		$requestJSON = json_decode( $requestBody, 1 );	


		if ( !empty($buf['error']) ) {
			$this->errors[] = 'Youtube get data error' ;
			$this->errors[] = $buf['error'];
			return false;
		}

		return $requestJSON;
	}

	private function getVideoFromYoutube( ){
		$jsonResponse = '';

		$resourceId = $this->resourceId;
		$apiUrl = $this->getApiUrl( $resourceId );

		if( !$apiUrl ){
			$this->errors[] = 'Youtube error input data';
			return $jsonResponse;
		}

		$jsonResponse = $this->getJsonRequest($apiUrl);
		if ( !$jsonResponse ) return false;


		$this->cacheDB->update( $this->resourceId, $jsonResponse );
		return $jsonResponse;
	}

	public function initItems(){

		$cache_data = $this->cacheDB->getContent( $this->resourceId , $this->youtubeCacheTime );
		
		//$cache_data = false;  // debug 

		$jsonResponse = $cache_data ? $cache_data : $this->getVideoFromYoutube();
		
		
		if( count($this->errors) ){
			//echo "Error in YouTube request answer";
			//print_r($this->errors);
			return ;
		}

		$arr = array();

		if (  !isset( $jsonResponse['items']) || !count($jsonResponse['items']) ) {
			//echo "YouTube request answer is empty";
			return ;
		}

		foreach ( $jsonResponse['items'] as $v ){
			
			if( !$this->isVideo($v) ){
				//echo " isVideo continue";
				continue ;
			}
			if( !$this->isThumbExists($v) ){
				//echo " isThumbExists continue";
				continue ;
			}
			
			$videoId = $this->getVideoId($v);

			$item = array(
				'id' => $videoId
			);

			//$item['url']				
			$item['videolink']            = 'https://www.youtube.com/watch?v='.$videoId;
			
			$item['data'] = new stdClass();
			$item['data']->post_excerpt = 'post_excerpt';
			$item['data']->post_content = $v['snippet']['description'];
			$item['data']->post_title   = $v['snippet']['title'];

			$item['image']    	= $v['snippet']['thumbnails']['high']['url'];
			$item['thumb']    	= $v['snippet']['thumbnails']['high']['url'];
			
			if(isset($v['snippet']['thumbnails']['high']['width'])) $item['sizeW'] = $v['snippet']['thumbnails']['high']['width'];
				else $item['sizeW'] = 240;

			if( isset($v['snippet']['thumbnails']['high']['height']) ) $item['sizeH'] = $v['snippet']['thumbnails']['high']['height'];
				else $item['sizeH'] = 240;
				
			$item['link']     	= '';
			$item['typelink'] 	= '';

			$item['col']        = '';
			$item['effect']     = '';
			$item['alt']        = '';
			$item['tags']       = null;
			$item['catid']      = $this->id;
			$item['galleryType']= 'youtube';			

			$arr[] = $item;			
		}

		$this->items = $arr;
		//print_r($arr);
	}

	private function isVideo( $item ){
		switch ( $this->resourceType ) {
			case 'ids':
				 if( !isset( $item['kind'] ) || $item['kind'] != 'youtube#video' )  return false ;	
				break;

			case 'playlist':
				 if( !isset( $item['kind'] ) || $item['kind'] != 'youtube#playlistItem' )  return false ;	
				break;			 
			
			default:
				 if( !isset( $item['id']['kind'] ) || $item['id']['kind'] != 'youtube#video' )  return false ;
				break;
		}
		return true;
	}

	private function isThumbExists( $item ){
		if( !isset( $item['snippet'] ) || !isset( $item['snippet']['thumbnails'] ) )  return false ;
		return true;
	}

	private function getVideoId( $item ){
		$videoId = '';	
		if(  isset($item['id']['videoId']) ) $videoId = $item['id']['videoId'];
		if ( $this->resourceType == 'playlist' )  $videoId = $item['snippet']['resourceId']['videoId'];
		if ( $this->resourceType == 'ids' && isset($item['id']) )  $videoId = $item['id'];
		return $videoId;
	}

	private function urlUserName( $resourceId ) {
		$idParams =  $this->getIdParams( $resourceId );
		if(!$idParams) return false;

		$url_one = 'https://www.googleapis.com/youtube/v3/channels?part=id&'
		           . 'forUsername=' . urlencode( $idParams )
		           . '&key=' . urlencode( $this->api_key );


		$res = $this->getJsonRequest( $url_one );

		if ( !$res )  return false;		
		
		if( !isset($res['items'][0]['id']) ) return false;

		$id  = $res['items'][0]['id'];
		
		$url_two = 'https://www.googleapis.com/youtube/v3/search?part=snippet,id'
		           . '&key=' . urlencode( $this->api_key )
		           . '&maxResults=' . $this->resourceCountMax

		           . '&channelId=' . urlencode( $id )
		           . '&order=date';
		
		return $url_two;
	}

	

	private function urlIds( $resourceId ) {

		$idParams =  $this->getIdParams( $resourceId );
		if(!$idParams) return false;

		//videos?part=snippet%2CcontentDetails%2Cstatistics&id=Ks-_Mh1QhMc&id=j9_0v_hWqUo&key=[YOUR_API_KEY] HTTP/1.
		//. '&order=date'

		$api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,id'
		           . '&key=' . urlencode( $this->api_key )
		           .$idParams
		           ;
		
		return $api_url;
	}

	private function urlChannel( $resourceId ) {

		$idArray = $this->getIdArray($resourceId);
		
		if( !is_array($idArray) || !count($idArray) ){
			$this->errors[] = 'Youtube playlist id error input data';
			return false;
		}

		$api_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet,id'
		           . '&key=' . urlencode( $this->api_key )
		           . '&maxResults=' . $this->resourceCountMax
		           . '&order=date'
		           . '&channelId=' . urlencode( $idArray[0] )
		           ;
		return $api_url;
	}

	private function urlPlayList( $resourceId ) {

		$idArray = $this->getIdArray($resourceId);
		
		if( !is_array($idArray) || !count($idArray) ){
			$this->errors[] = 'Youtube playlist id error input data';
			return false;
		}

		$api_url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,id'
		           . '&key=' . urlencode( $this->api_key )
		           . '&maxResults=' . $this->resourceCountMax
		           . '&playlistId=' . urlencode( $idArray[0] );
		return $api_url;
	}



	/*  
	====================================================================
	======Helper
	====================================================================
	*/

	private function getIdArray( $resourceId ){
		
		$ids = array();

		if( !$this->isIds($resourceId) ){
			$ids[] = $resourceId;
			return $ids;
		}

		$split_result = preg_split('/[|;,. \n]/', $resourceId );
		
		if( !is_array($split_result) || !count($split_result) ) return false;

		foreach ($split_result as  $value) {
			if( trim($value) ) $ids[] = trim($value);
		}
		if( !count($split_result) ) return false;

		return $ids;
	}

	private function isIds( $resourceId ){		

		if( 
			stripos( $this->resourceId, "\n" ) !== false 	||
			stripos( $this->resourceId, ";" ) !== false 	|| 
			stripos( $this->resourceId, "," ) !== false 	||
			stripos( $this->resourceId, "." ) !== false 	||
			stripos( $this->resourceId, "|" ) !== false 	||
			stripos( $this->resourceId, " " ) !== false   
		){
			return true; 
		}

		return false;
	}

	private function getIdParams($resourceId, $paramName = '&id='){
		$idArray = $this->getIdArray($resourceId);
		
		if( !is_array($idArray) ){
			$this->errors[] = 'Youtube ids error input data';
			return false;
		}
		$idParams = '';

		foreach ($idArray as $value) {
			$idParams .= $paramName. urlencode( $value );
		}
		//$idParams = $paramName.implode( $paramName, $idArray);
		return $idParams;
	}

}