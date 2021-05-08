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

return array(
	'active' => true,
	'order' => 0,
	'settings' => array(
		'id' => 'robo-gallery-youtube',
		'title' => __('Youtube Gallery Settings', 'robo-gallery'),
		'screen' => array(  ROBO_GALLERY_TYPE_POST ),
		'context' => 'normal',
		'for' => array( 'gallery_type' => array( 'youtube', 'youtubepro' ) ),
		'priority' => 'high',
	),
	'view' => 'default',
	'content' => 
			!get_option(ROBO_GALLERY_PREFIX.'youtubeApiKey', '' ) ? 
				sprintf(
					'<div class="youtube-block-overlay"> <div> %s <a href="%s" target="_blank">%s</a> %s </div> </div>',
					__('Please follow', 'robo-gallery'),
					admin_url( 'edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=youtube'),
					__('this link', 'robo-gallery'),
					__('and set youtube API key', 'robo-gallery')		
				) 
			: 
			''
		,
	'state' => 'open',
	'style' => null,
	'fields' => array(
		array(
			'type' => 'select',
			'view' => 'default',
			'is_lock' => false,
			'name' => 'galleryYoutubeType',
			'default' => 'ids',
			'label' => 'Youtube Content Mode',
			'contentAfterBlock' => 
			'<div class="row">
				<div class="content small-12 columns text-center" >'.
					( ROBO_GALLERY_TYR ? '' : rbsGalleryUtils::getProButton( '+ ' . __('Add Youtube Channel & Playlist add-on', 'robo-gallery') ) )
			.'	</div>
			</div>',
			'contentAfter' => 
				sprintf(
					'<p>%s</p>
					<p><strong>%s</strong> %s</p>
					<p><strong>%s</strong> %s</p>
					<p><strong>%s</strong> %s</p>',
					__('Here you can setup youtube gallery in two simple steps. Select value for youtube content mode and after that youtube content ids for the videos, youtube playlist or youtube channel', 'robo-gallery'),
					__('Channel', 'robo-gallery'),
					__('- mode import videos from youtube channels. You just need to specify id(s) of the required youtube channels in the field below.', 'robo-gallery'),
					__('Playlist', 'robo-gallery'),
					__(' - mode import videos  from youtube playlists. You just need to specify id(s) of the required youtube playlists in the field below.', 'robo-gallery'),
					__('Videos by ID', 'robo-gallery'),
					__('- mode import all youtube videos with IDs from the field below.', 'robo-gallery')
				),
			'options' => array(
				'column' => '12 medium-6',
				'disabled' => ROBO_GALLERY_TYR ? array() : array( 'channel', 'playlist' ),
				'values' => array(					
					'channel' 	=> __( 'Channel', 		'robo-gallery' ),
					//'user' 		=> __( 'User videos', 	'robo-gallery' ),
					'playlist' 	=> __( 'Playlist ', 	'robo-gallery' ),
					'ids' 		=> __( 'Videos by ID', 	'robo-gallery' ),
				),
			),
		),

		array(
			'type' => 'textarea',

			'view' => 'default',
		//	'view' => 'group',
			'name' => 'galleryYoutubeValue',
			'label'=> __( 'Youtube Content IDs', 'robo-gallery' ),
			'description' =>
				sprintf(
					'%s <a href="%s" target="_blank">%s</a> %s',
					__('Please follow', 'robo-gallery'),
					admin_url( 'edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=youtube'),
					__('this link', 'robo-gallery'),
					__('and set youtube API key', 'robo-gallery')		
				),

			'default' => "fI3uYOlUbo4, \n m9XIeqMnhYI, \n svr_4Fuq9RM, \n-CuGOo7XRmQ",//'UCy1PU1Tk6zX9Ipz64v-BpKA',
			'attributes' => array(
				'rows' => 5,
				'cols' => 8
			),
			'options' => array(
				'column' => '12 medium-8 large-8',
				'columnWrap'	=> '12',
			),
		),

	),
);

