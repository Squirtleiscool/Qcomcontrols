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

if ( ! defined( 'WPINC' ) )  die;

wp_enqueue_media();
wp_enqueue_style('wp-jquery-ui-dialog');
wp_enqueue_script('jquery-ui-dialog');

wp_enqueue_script(  ROBO_GALLERY_ASSETS_PREFIX.'-field-type-gallery-lib', ROBO_GALLERY_FIELDS_URL.'asset/fields/gallery/js/gallery.lib.min.js', array('jquery'), false, true);

wp_register_script( ROBO_GALLERY_ASSETS_PREFIX.'-field-type-gallery', ROBO_GALLERY_FIELDS_URL.'asset/fields/gallery/js/script.min.js', array('jquery'), false, true);
wp_enqueue_script(  ROBO_GALLERY_ASSETS_PREFIX.'-field-type-gallery' );

$translation_array = array( 
	'iconUrl' => admin_url('/images/spinner.gif') 
);

wp_localize_script( ROBO_GALLERY_ASSETS_PREFIX.'-field-type-gallery', 'roboGalleryFieldGallery', $translation_array );


wp_enqueue_style ( ROBO_GALLERY_ASSETS_PREFIX.'-field-type-gallery', ROBO_GALLERY_FIELDS_URL.'asset/fields/gallery/style.css', array( ), '' );

if ( $value == null || empty( $value ) || $value == ' ' || $value == '' ) $value = '';
?>

<?php if ($label) : ?>
	<div class="field small-12 columns">
		<label>
			<?php echo $label; ?>
		</label>
	</div>
<?php endif; ?>

<div class="content small-12 columns small-centered text-center">

	<button type="button" data-id="<?php echo $id; ?>" class="success large button expanded roboGalleryFieldImagesButton">
		<?php _e('Manage Images', 'robo-gallery'); ?>
	</button>
	<?php $value = is_array($value) ? implode(',', $value) : $value; ?>
	<input id="<?php echo $id; ?>" <?php echo $attributes; ?> type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
</div>

<?php if ($description) : ?>
	<div class="content small-12 columns">
		<p class="help-text"><?php echo $description; ?></p>
	</div>
<?php endif; ?>
	
<div class="content small-12 columns">
	<p class="help-text">
		<?php _e('Open images manager and configure <strong>Link</strong>, <strong>Tags</strong> and <strong>Video</strong> (YouTube, Vimeo) for every gallery image.', 'robo-gallery'); ?>
	</p>		
</div>

<div class="content small-12 columns small-centered text-center">
	<div id="robo_gallery_images_preview" class="text-center">
		<span class="spinner is-active" style="margin-right: 50%; margin-bottom: -25px;"></span>
	</div>
</div>

<?php if (!ROBO_GALLERY_TYR) : ?>
	<div class="content small-12 columns text-center" style="margin: 25px 0 -20px;">				
		<?php echo rbsGalleryUtils::getProButton( '+ ' . __('Add Link  Add-on', 'robo-gallery') ); ?>		
	</div>	
<?php endif; ?>
