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

/* todo: singleton */

if ( ! defined( 'WPINC' ) ) exit;

class roboGalleryModuleCacheDB {

	private $core = null;
	private $cache_time = 3000;	
	private $table_name = '';
	private $wpdb = null;

	public function __construct( $core ) {
		$this->core = $core;
		$this->init();
		$this->checkVersion();
	}

	private function init(){
		global $wpdb;
		
		$this->wpdb 	  = $wpdb;
		$this->table_name = $wpdb->prefix.'robogallery_cache';
		$this->cache_time = (int) get_site_option( ROBO_GALLERY_PREFIX.'dbcache_time', 3000);
		//$this->wpdb->show_errors();
	}

	private function checkVersion() { 
	    $saved_db_version = (int) get_site_option( ROBO_GALLERY_PREFIX.'dbcache_version', -1);
	    
	    if( $saved_db_version==-1 ) add_site_option( ROBO_GALLERY_PREFIX.'dbcache_version', 0);
	    
	    if ( $saved_db_version < 100 && $this->createTables() ) {
	    	update_site_option( ROBO_GALLERY_PREFIX.'dbcache_version', 100);
	    }
	}

	private function createTables(){
		$charset_collate = $this->wpdb->get_charset_collate();
		$sql = "CREATE TABLE IF NOT EXISTS ".$this->table_name ." (
			id int(11) NOT NULL AUTO_INCREMENT,
			cache_id varchar(255) DEFAULT NULL,
			cache_content longtext NOT NULL,
			time bigint(11) DEFAULT '0' NOT NULL,			
			UNIQUE KEY id (id)
		)  $charset_collate;";
		//require_once( ABSPATH.'wp-admin/includes/upgrade.php' );
		//dbDelta( $sql );
		$result = $this->wpdb->get_results($sql);		
		return true;
	}

	public function update( $resourceId, $data ){
		$oldCache = $this->getContent( $resourceId );
		
		if ( is_array($oldCache) ){
			echo 'run delete';
			$this->delete( $resourceId );
		}
 		
		$this->wpdb->insert(
			$this->table_name, 
			array(
				'cache_id' 		=> $resourceId,
				'cache_content' => json_encode($data),
				'time' 			=> time()
			),
			array( '%s', '%s' ,'%d')
		);
		//print_r($this->wpdb);
	}

	public function delete( $resourceId ){		
		return $this->wpdb->delete( $this->table_name, array( 'cache_id' => $resourceId ), array( '%s' ) );
	}

	public function getContent( $resourceId, $cache_time = 0 ){		return false;
		$sql = $this->wpdb->prepare( 'SELECT * FROM '.$this->table_name.' WHERE cache_id = %s limit 1', $resourceId );
		$row = $this->wpdb->get_row( $sql );	
		//var_dump($row);
		if( !is_object($row) || !$row->cache_content || !$row->time ) return false;	
		
		if(!$cache_time) $cache_time = $this->cache_time;

		if( time() - $row->time >= $this->cache_time ){
			$this->delete($resourceId);
			return false;	
		} 

		return json_decode( $row->cache_content, 1 );		
	}

}