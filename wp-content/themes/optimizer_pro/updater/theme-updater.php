<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://optimizerwp.com', // Site where EDD is hosted
		'item_name' => 'Optimizer PRO', // Name of theme
		'theme_slug' => 'optimizer', // Theme slug
		'version' => '0.8.0', // The current version of this theme
		'author' => 'OptimizerWP', // The author of this theme
		'download_id' => '', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Optimizer License', 'optimizer' ),
		'enter-key' => __( 'Enter your theme license key.', 'optimizer' ),
		'license-key' => __( 'License Key', 'optimizer' ),
		'license-action' => __( 'License Action', 'optimizer' ),
		'deactivate-license' => __( 'Deactivate License', 'optimizer' ),
		'activate-license' => __( 'Activate License', 'optimizer' ),
		'status-unknown' => __( 'License status is unknown.', 'optimizer' ),
		'renew' => __( 'Renew?', 'optimizer' ),
		'unlimited' => __( 'unlimited', 'optimizer' ),
		'license-key-is-active' => __( 'License key is active.', 'optimizer' ),
		//'expires%s' => __( 'Expires %s.', 'optimizer' ),
		'expires%s' => __( 'Lifetime License.', 'optimizer' ),
		'lifetime'  => __( 'Lifetime License.', 'optimizer' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'optimizer' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'optimizer' ),
		'license-key-expired' => __( 'License key has expired.', 'optimizer' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'optimizer' ),
		'license-is-inactive' => __( 'License is inactive.', 'optimizer' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'optimizer' ),
		'site-is-inactive' => __( 'Site is inactive.', 'optimizer' ),
		'license-status-unknown' => __( 'License status is unknown.', 'optimizer' ),
		'update-notice' => __( 'Before updating, please Backup your theme options from Appearance> Customize > Settings', 'optimizer' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'optimizer' )
	)

);