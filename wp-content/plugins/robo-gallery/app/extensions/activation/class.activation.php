<?php
/* @@copyright@ */

if(!defined('WPINC')) die;
if(!defined("ABSPATH")) exit;

if( class_exists( 'Robo_Gallery_Install' ) ) return;

class Robo_Gallery_Install {
	public function __construct(){
		$this->hooks();
	}

	public function hooks(){
		register_activation_hook( ROBO_GALLERY_MAIN_FILE, array( $this, 'activation' ) );
		register_deactivation_hook( ROBO_GALLERY_MAIN_FILE, array( $this, 'deactivation' ) );
	}

	public function activation() {
		update_option( 'robo_gallery_after_install', '1' );
	}

	public function deactivation() {

	}
}

new Robo_Gallery_Install();