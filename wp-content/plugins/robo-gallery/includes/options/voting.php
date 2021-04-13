<?php 
/*
*      Robo Gallery By Robosoft    
*      Version: 2.6.18
*      Contact: https://robosoft.co/robogallery/ 
*      Available only in  https://robosoft.co/robogallery/ 
*/
if ( ! defined( 'WPINC' ) ) exit;

$voting_box = new_cmb2_box( array(
    'id'            => ROBO_GALLERY_PREFIX . 'voting_metabox',
    'title'         => __( 'Suggest Feature', 'robo-gallery' ),
    'object_types'  => array( ROBO_GALLERY_TYPE_POST ),
    'context'       => 'side',
    'priority'      => 'low',
    'show_names'	=> false,
));

$voting_box->add_field( array(
    'id'            => ROBO_GALLERY_PREFIX.'voting_desc',
    'type'          => 'title',
    'before_row'    => '
	    <div class="rbs_voting">
	    	<div class="bottom_space">
	    		<a href="https://wordpress.org/support/plugin/robo-gallery" target="_blank" class="btn btn-info">
	    			'.__("What's next? Need more features?", 'robo-gallery').'
	    		</a> <br />
	    		<a href="https://wordpress.org/support/plugin/robo-gallery" target="_blank" class="btn btn-info">
	    			'.__("Just drop a line HERE with your needs.", 'robo-gallery').'
	    		</a> <br />
	    		<a href="https://wordpress.org/support/plugin/robo-gallery" target="_blank" class="btn btn-info">
	    			'.__("GRID LAYOUT, HOVER EFFECTS", 'robo-gallery').'
	    		</a>
	    	</div>
	    	<div class="rbs_block">
	    		<a href="https://wordpress.org/support/plugin/robo-gallery" target="_blank" class="btn btn-info">'.__( 'Contact Developer', 'robo-gallery' ).'</a>
	    	</div>
	    </div>
    ',
    'after_row'     => '',
));