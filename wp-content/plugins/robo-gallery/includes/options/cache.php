<?php 
/*
*      Robo Gallery By Robosoft    
*      Version: 2.6.18
*      Contact: https://robosoft.co/robogallery/ 
*      Available only in  https://robosoft.co/robogallery/ 
*/
if ( ! defined( 'WPINC' ) ) exit;

$cache_box = new_cmb2_box( array(
    'id'            => ROBO_GALLERY_PREFIX . 'cache_metabox',
    'title'         => __( 'Cache', 'robo-gallery' ),
    'object_types'  => array( ROBO_GALLERY_TYPE_POST ),
    'show_names' 	=> false,
    'context' 		=> 'normal',
    'priority' 		=> 'high',
));

$cache_box->add_field( array(
    'name'    	=> __('Cache','robo-gallery'),
    'default' 	=> '',
    'options'	=> array( 
    		'' 		=> 'Disable', 
    		'1' 	=> 'Enable', 
    ),
    'id'	  	=> ROBO_GALLERY_PREFIX .'cache',
    'type'    	=> 'rbsradiobutton',
    'before_row' 	=> '
<div class="rbs_block">

	<div class="row">
		<div class="col-sm-12">
			'.__('Make your gallery unbelievable faster. With enabled cache option you gallery load faster in ten times.', 'robo-gallery').'
		</div>
	</div>

	<br />
',
	'after_row'		=> ' 

	<div class="row">
		<div class="col-sm-12">
			'.__('If you modify settings gallery generate new cache after save.', 'robo-gallery').'<br/>
			'.__('You can configure timeout for cleaning  of the cached resources ', 'robo-gallery').' <a target="_blank" href="'.admin_url( 'edit.php?post_type=robo_gallery_table&page=robo-gallery-settings').'">'.__('here').'</a>.
		</div>
	</div>

</div> ',
));