<?php

/*Include the Core File*/
if ( !class_exists( 'WPAlchemy_MetaBox' ) ) {
include_once(get_template_directory() . '/lib/metabox/core/MetaBox.php');
}

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'optimizer_metabox_style');

function optimizer_metabox_style() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style('optimizer-metabox', get_template_directory_uri() . '/lib/metabox/meta.css');
}


/* Include the Metaboxes */
include_once(get_template_directory() . '/lib/metabox/meta-spec.php');