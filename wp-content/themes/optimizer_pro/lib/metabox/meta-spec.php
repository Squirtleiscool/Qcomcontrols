<?php

$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => 'optimizer_custom_meta',
	'title' => __('Optimizer Options','optimizer'),
	'types' => array('post','page'),
	'template' => get_template_directory() . '/lib/metabox/basic-meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT
));

$custom_metabox = $full_mb = new WPAlchemy_MetaBox(array
(
	'id' => 'optimizer_sidebar_meta',
	'title' => __('Sidebar','optimizer'),
	'types' => array('post', 'page'), // added only for pages and to custom post type "events"
	'context' => 'side', // same as above, defaults to "normal"
	'priority' => 'low', // same as above, defaults to "high"
	'template' => get_template_directory() . '/lib/metabox/sidebar-meta.php',
	'mode' => WPALCHEMY_MODE_EXTRACT
));


/* eof */