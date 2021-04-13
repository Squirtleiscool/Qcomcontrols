<?php
/*  
 * RB Image Widget
 * Version:           1.0.0
 * Author:            RB  Team
 */

if( !defined('WPINC') || !defined("ABSPATH") ){
	die();
}


class RB_IMAGE_WIDGET_PLUGIN {

	private $options ;
	private $options_name = 'RB_IMAGE_WIDGET';


	public function __construct() {
		$this->options = get_option( $this->options_name , array() );
		if(!isset($this->options['enable_everywhere'])) $this->options['enable_everywhere'] = 0;
		$this->hooks();
		$this->widget();
	}


	private function hooks() {
		add_action( 'plugins_loaded', array( $this, 'register_text_domain' ) );

		register_activation_hook(  RB_IMAGE_WIDGET_FILE, 	array($this, 'activation') );
		register_deactivation_hook(  RB_IMAGE_WIDGET_FILE, 	array($this, 'deactivation') );

		add_action( 'wp_loaded', array( $this, 'wp_load_hooks' ) );

	}

	private function save_options() {
		update_option( $this->options_name, $this->options );
	}

	public function register_text_domain() {
		load_plugin_textdomain( 'rb-image-widget', false, RB_IMAGE_WIDGET_PATH . 'languages' );
	}

	public static function activation(){ 	
		add_option( 'rb-image-widget-install', 1 );  	
	}
	
	public static function deactivation(){ 
		delete_option('rb-image-widget-install');		
	}

	public function widget() {
		include( RB_IMAGE_WIDGET_PATH . 'widget.php');
		include( RB_IMAGE_WIDGET_PATH . 'widget-gallery.php');
	}


	public function wp_load_hooks(){
		if( is_admin() ) {
			//add_action( 'admin_menu', array( $this, 'settings_menu' ) );
			//add_filter( 'plugin_action_links', array( $this, 'plugin_actions_links'), 10, 2 );
		}
	}

	public function plugin_actions_links( $links, $file ) {
		static $plugin;

		if( $file == 'image-widget-rb/image-widget-rb.php' && current_user_can('manage_options') ) {
			array_unshift(
				$links,
				sprintf( '<a href="%s">%s</a>', esc_attr( $this->settings_page_url() ), __( 'Settings', 'image-widget-rb' ) )
			);
		}

		return $links;
	}
	
	private function settings_page_url() {
		return add_query_arg( 'page', 'rb_image_widget_options', admin_url( 'options-general.php' ) );
	}

	public function settings_menu() {
		$title = __( 'RB Image Widget', 'rb-image-widget' );
		add_options_page( 'RB Image Widget Options',  $title, 'manage_options', 'rb_image_widget_options', array( $this, 'options' )  );
	}


	public function options() {
		include( RB_IMAGE_WIDGET_PATH .'options.php');
	}
}