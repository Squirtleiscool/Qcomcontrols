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

if ( ! defined( 'WPINC' ) ) exit;


function robo_gallery_hide_fieldattachment() {
	echo "<style>"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_line,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_col,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_type_link,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_video_link,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_effect,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_tags,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_link{display:none;}"
	/*.".compat-attachment-fields tr.compat-field-rsg_gallery_col,"*/
	.".compat-attachment-fields tr.compat-field-rsg_gallery_type_link,"
/*	.".compat-attachment-fields tr.compat-field-rsg_gallery_video_link,"
	.".compat-attachment-fields tr.compat-field-rsg_gallery_effect,"*/
	.".compat-attachment-fields tr.compat-field-rsg_gallery_link{"
		.(!ROBO_GALLERY_TYR?"z-index: 1000;opacity: 0.4;pointer-events: none;":"") 
	."}
	</style>";
}
add_action('admin_head', 'robo_gallery_hide_fieldattachment');
 	
 	if( !function_exists('roboGalleryGetMediaOptions') ){
	 	function roboGalleryGetMediaOptions( $listSelect, $selectOption = ''){
			$optionsHtml = '';
			if(count($listSelect))
				foreach($listSelect as $key => $value) $optionsHtml .= '<option value="'.$key.'" '.selected($selectOption, $key, 0).'>'.$value.'</option>';
			return $optionsHtml;
		}
	}

	function robo_gallery_attachment_field_credit( $form_fields, $post ) {
		
		$form_fields[ROBO_GALLERY_PREFIX.'gallery_line'] = array(
			'label' => '',
			'input' => 'html',
			'html' 	=> ( !ROBO_GALLERY_TYR ?'<br/><br/><span>Robo Gallery <br> Available in PRO </span>':'<h4>'.__('Robo Gallery', 'robo-gallery').'</h4>')
		);
		
		$form_fields[ROBO_GALLERY_PREFIX.'gallery_tags'] = array(
			'label' => __('Tags'),
			'input' => 'textarea',
			'value' => get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_tags', true ),
		);

		$value = get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_col', true );
		$selectBox = 
		"<select name='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_col]' id='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_col]'>
    		<option value='1' ".($value=='1' || !$value?'selected':'').">1</option>
    		<option value='2' ".($value=='2'?'selected':'').">2</option>
    		<option value='3' ".($value=='3'?'selected':'').">3</option>
    		<option value='4' ".($value=='4'?'selected':'').">4</option>
    		<option value='5' ".($value=='5'?'selected':'').">5</option>
    		<option value='6' ".($value=='6'?'selected':'').">6</option>
		</select>";

		$form_fields[ROBO_GALLERY_PREFIX.'gallery_col'] = array(
			'label' => __('Column'),
			'input' => 'html',
			'value' => $value,
			'html' => $selectBox 
		);
		
		$form_fields[ROBO_GALLERY_PREFIX.'gallery_link'] = array(
			'label' => __('Link'),
			'input' => 'text',
			'value' => get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_link', true ),
		);

		$value = get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_type_link', true );
		$selectBox = 
		"<select name='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_type_link]' id='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_type_link]'>
    		<option value='1' ".($value=='1'?'selected':'').">".__( 'On' )."</option>
    		<option value='0' ".($value=='0' || !$value ?'selected':'').">".__( 'Off')."</option>
		</select>";

		$form_fields[ROBO_GALLERY_PREFIX.'gallery_type_link'] = array(
			'label' 	=> __('Blank Link'),
			'input' 	=> 'html',
			'default' 	=> 'link',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		$form_fields[ROBO_GALLERY_PREFIX.'gallery_video_link'] = array(
			'label' => __('Video'),
			'input' => 'text',
			'value' => get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_video_link', true ),
		);

		
		$value = get_post_meta( $post->ID, ROBO_GALLERY_PREFIX.'gallery_effect', true );
		
		$listSelect = array(
			 'push-up' 				=> __( 'push-up' , 'cmb' ),
			 'push-down'	 		=> __( 'push-down' , 'cmb' ),
			 'push-up-100%' 		=> __( 'push-up-100%' , 'cmb' ),
			 'push-down-100%' 		=> __( 'push-down-100%' , 'cmb' ),
			 'reveal-top'			=> __( 'reveal-top' , 'cmb' ),
			 'reveal-bottom' 		=> __( 'reveal-bottom' , 'cmb' ),
			 'reveal-top-100%' 		=> __( 'reveal-top-100%' , 'cmb' ),
			 'reveal-bottom-100%' 	=> __( 'reveal-bottom-100%' , 'cmb' ),
			 'direction-aware' 		=> __( 'direction-aware' , 'cmb' ),
			 'direction-aware-fade' => __( 'direction-aware-fade' , 'cmb' ),
			 'direction-right' 		=> __( 'direction-right' , 'cmb' ),
			 'direction-left' 		=> __( 'direction-left' , 'cmb' ),
			 'direction-top' 		=> __( 'direction-top' , 'cmb' ),
			 'direction-bottom' 	=> __( 'direction-bottom' , 'cmb' ),
			 'fade' 				=> __( 'fade', 'cmb' ),
			 '' 					=> __( 'inherit', 'cmb' ),
		);
		$selectBox = "<select name='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_effect]' id='attachments[{$post->ID}][".ROBO_GALLERY_PREFIX."gallery_effect]'>";
		$selectBox .= roboGalleryGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';

		
		$form_fields[ROBO_GALLERY_PREFIX.'gallery_effect'] = array(
			'label' 	=> __('Effect'),
			'input' 	=> 'html',
			'default' 	=> 'link',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'robo_gallery_attachment_field_credit', 10, 2 );

	

	function robo_gallery_attachment_field_credit_save( $post, $attachment ) {
		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_tags'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_tags', sanitize_text_field($attachment[ROBO_GALLERY_PREFIX.'gallery_tags']) );

		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_video_link'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_video_link', esc_url( $attachment[ROBO_GALLERY_PREFIX.'gallery_video_link'] ) );
		
		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_link'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_link', esc_url( $attachment[ROBO_GALLERY_PREFIX.'gallery_link'] ) );

		
		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_type_link'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_type_link',  sanitize_text_field($attachment[ROBO_GALLERY_PREFIX.'gallery_type_link']) );
		
		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_col'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_col',  (int) $attachment[ROBO_GALLERY_PREFIX.'gallery_col'] );
		

		if( isset( $attachment[ROBO_GALLERY_PREFIX.'gallery_effect'] ) )
			update_post_meta( $post['ID'], ROBO_GALLERY_PREFIX.'gallery_effect', sanitize_text_field($attachment[ROBO_GALLERY_PREFIX.'gallery_effect']) );
		
		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'robo_gallery_attachment_field_credit_save', 10, 2 );