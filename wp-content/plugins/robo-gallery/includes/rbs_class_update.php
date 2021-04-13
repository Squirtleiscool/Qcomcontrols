<?php
/* @@copyright@ */

if(!defined('WPINC')) die;
if(!defined("ABSPATH")) exit;

class RoboGalleryUpdate {
	public $posts = array();

	public $needUpdate = 1;

	public $dbVersionOld = false;

	public $dbVersion = false;

	public $fieldArray = array(
			'1.3.5' => array(
					'lightboxCounter' => 1,
			),
			'1.3.6' => array(
					'lightboxClose' => 1,
			),
			'1.3.7' => array(
					'lightboxArrow' => 1,
			),
			'1.3.8' => array(
					'menuSelfImages' => 1,
			),
			'1.3.9' => array(
					'menuSelfImages' => 1,
			),
			'2.5.2' => array(
					'lightboxCounterText' => ' of ',
			),
			'2.5.3' => array(
					'lightboxSocialFacebook' 	=> 1,
					'lightboxSocialTwitter' 	=> 1,
					'lightboxSocialGoogleplus' 	=> 1,
					'lightboxSocialPinterest' 	=> 1,
					'lightboxSocialVK' 			=> 0,
			),
			'3.0.0' => array(
					'gallery_type' 	=> 'grid',
			)
		); 

	public $functionArray = array(
		);

	public function __construct(){
		
		$curVersion = get_option( 'RoboGalleryInstallVersion', 0 );

		if( $curVersion != ROBO_GALLERY_VERSION ){
			update_option('RoboGalleryInstallDate', time() );
			update_option('RoboGalleryInstallVersion', ROBO_GALLERY_VERSION );
		}
		
		$this->dbVersionOld = get_option( 'rbs_gallery_db_version', 0 );

		$this->dbVersion = ROBO_GALLERY_VERSION;

		if( $this->dbVersionOld == $this->dbVersion )  $this->needUpdate = false;

		if( $this->needUpdate ){
			update_option( 'robo_gallery_after_install', '1' );
			update_option( 'rbs_gallery_db_version', ROBO_GALLERY_VERSION );
			$this->posts = $this->getGalleryPost();
			$this->update();
		}
	}


	public function getGalleryPost(){
		$my_wp_query = new WP_Query();
 		return $my_wp_query->query( 
				array( 
					'post_type' => ROBO_GALLERY_TYPE_POST, 
					'posts_per_page' => 999, 
				)
			);
	}
	
	public function fieldInit( $fields ){
		for($i=0;$i<count($this->posts);$i++){
			$postId = $this->posts[$i]->ID;
			if( count($fields) ){
				foreach($fields as $key => $value){
					add_post_meta( $postId, ROBO_GALLERY_PREFIX.$key, $value, true );
				}
			}
		}
	}



	public function update(){
		if( count($this->fieldArray) ){
			foreach($this->fieldArray as $version => $fields){
				if( 
					version_compare( $version, $this->dbVersionOld, '>') || 
					version_compare( $version, $this->dbVersion, '<=') 
				){
					if( isset($fields) ) $this->fieldInit( $fields );
				}
			}
		}
	}
}
$update = new RoboGalleryUpdate();