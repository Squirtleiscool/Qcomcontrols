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



function robo_gallery_field_getGalleryOptions($galleryId, $value){

	/* default option */
	$tagOptions = '<option value="0" '.selected( $value, 0, false ).'>'.__('none').'</option>';

	$args = array(
	    	'meta_key'     	=> ROBO_GALLERY_PREFIX . 'gallery_type',
	    	'meta_value'   	=> get_post_meta( $galleryId, ROBO_GALLERY_PREFIX . 'gallery_type', true ),
	    	'meta_compare' 	=> '==',	    	
	        'post_type' 	=> ROBO_GALLERY_TYPE_POST,
	        'order'     	=> 'ASC',	   
	        'orderby'   	=> 'title',	   
	        'posts_per_page'=> 100, 
	        //'exclude' => 
    	);

	$galleryList = get_posts( $args );		
	
	if( !is_array($galleryList) || !count($galleryList) ) return $tagOptions;

	foreach ( $galleryList as $gallery ){
        
        if( $gallery->ID == $galleryId  || !$gallery->ID ) continue ;

    	$tagOptions .= '<option value="'.$gallery->ID.'" '.selected( $value, $gallery->ID, false ).'> '
    	.' &nbsp; '.$gallery->post_title. ' ['.$gallery->ID.']'
    	.'</option>';
    };
    
	return $tagOptions;
}

function jt_cmb2_render_rbsgallery_field_callback( $field, $value, $object_id, $object_type, $field_type_object ){
	
	$value =  ( (int) $value ) > 0  ? (int)$value : $field->args('default');	
	?>
	
	<div class="form-horizontal">		
		<div class="form-group">
		    <div class="col-sm-12">
		    	<?php echo $field->args('desc'); ?>
		    </div>
	  	</div>

		<div class="form-group">
	    	<label class="col-sm-2  control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html( $field->args( 'name' ) ); ?></label>
		    <div class="col-sm-10">
			     <select name="<?php echo $field_type_object->_name(); ?>" id="<?php echo $field_type_object->_id(); ?>" class="rbs_select form-control">
			    	<?php
			    	echo robo_gallery_field_getGalleryOptions( $object_id,  $value );    	
			    	?>
				</select>
			<?php
		      	 $depends = $field->args('depends');
				if( is_array($depends) && count($depends) ){ ?>
					<script type="text/javascript">
						var  <?php echo $field_type_object->_id(); ?>_depends = <?php echo json_encode($field->args('depends')); ?>;
					</script>
				<?php } ?>
		    </div>
		</div>
		
		<div class="form-group">
		    <div class="col-sm-12  ">
		    	<?php echo $field->args('desc2'); ?>
		    </div>
	  	</div>

	</div>
<?php
}
add_filter( 'cmb2_render_rbsgallery', 'jt_cmb2_render_rbsgallery_field_callback', 10, 5 );