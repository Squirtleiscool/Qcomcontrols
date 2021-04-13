<?php 

$class = '';

if( $status['active'] ) 						$class=" addon-deactivate ";
if( !$status['active'] && $status['download'] ) $class=" addon-activate ";
if( !$status['download'] & !$commercial ) 		$class=" addon-download ";
if( $commercial && !$status['download'] ) 		$class=" addon-link ";


 ?>
<div class="rbs-gallery-addon-item addon-all<?php 
	echo ' addon-'.$category;

	if( $status['active'] ) echo ' addon-activated';
	if( $commercial ) 		echo ' addon-premium';

	?>">
	<span class="dashicons dashicons-admin-plugins icon-plugin"></span>
	<span class="addon-title"><?php echo $title; ?></span>
	
	<?php if( $status['active'] && $included ){ ?>
		<a 
			href="<?php echo admin_url($url); ?>" 
			data-slug="<?php echo $slug;?>"
			data-code="<?php echo $code;?>"
			<?php if( $included ) echo ' data-included="1" ';?>
			class=" button button-primary  addon-button addon-deactivate"
		>
			<span class="dashicons dashicons-update icon-loading icon-loading-hide"></span> 
			<span class="dashicons dashicons-yes  icon-loading icon-loading-hide"></span> 

			<span class="text"> <?php _e('Deactivate'); ?></span>
		</a>
	<?php } ?>

	<?php if( $status['active'] && !$included ){ ?>
		<a 
			href="<?php echo $pluginManagerUrl; ?>" 
			data-slug="<?php echo $slug;?>"
			data-code="<?php echo $code;?>"
			<?php if( $included ) echo ' data-included="1" ';?>
			class=" button button-primary addon-button addon-link  addon-deactivate"
		>
			<span class="dashicons dashicons-update icon-loading icon-loading-hide"></span> 
			<span class="dashicons dashicons-yes  icon-loading icon-loading-hide"></span> 

			<span class="text"> <?php _e('Deactivate'); ?></span>
		</a>
	<?php } ?>
	
	<?php if( !$status['active'] && $status['download'] ){ ?>
		<a href="#" 
			data-slug="<?php echo $slug;?>"
			data-code="<?php echo $code;?>"
			data-url="<?php echo $url; ?>"
			
			data-activate="<?php echo $activateUrl; ?>"
			data-deactivate="<?php echo $deactivateUrl; ?>" 
			data-information="<?php echo $informationUrl; ?>"
			<?php if( $included ) echo ' data-included="1" ';?>
			<?php if( $commercial ) echo ' data-commercial="1" ';?>
			class="button button-primary addon-button addon-activate"
		>
			<span class="dashicons dashicons-update icon-loading icon-loading-hide"></span> 
			<span class="dashicons dashicons-yes  icon-loading icon-loading-hide"></span> 

			<span class="text"> <?php _e('Activate'); ?></span>
		</a>
	<?php } ?>
	
	<?php if( !$status['download'] & !$commercial ){ ?>
		<a href="#"
			data-code="<?php echo $code;?>" 
			data-slug="<?php echo $slug;?>" 
			data-download="<?php echo $downloadUrl; ?>" 
			data-activate="<?php echo $activateUrl; ?>" 
			data-deactivate="<?php echo $deactivateUrl; ?>" 
			data-information="<?php echo $informationUrl; ?>" 
			class="button button-primary addon-button addon-download"
		>
			<span class="dashicons dashicons-update icon-loading icon-loading-hide"></span> 
			<span class="dashicons dashicons-yes  icon-loading icon-loading-hide"></span> 

			<span class="text"> <?php _e('Install Now'); ?> </span>
		</a>
	<?php } ?>

	<?php if( $commercial && !$status['download'] ){ ?>
		<a 
			href="<?php echo $url;?>" 
			class="button button-primary addon-button addon-link"
		>
			<span class="dashicons dashicons-update icon-loading icon-loading-hide"></span> 
			<span class="dashicons dashicons-yes  icon-loading icon-loading-hide"></span> 

			<span class="text"> <?php echo __('Purchase'); ?></span>
		</a>
	<?php } ?> 

	<div class="addon-desc"><?php _e($desc); ?></div>
	
</div>

<div class="download-error" style="display: none;">
	<?php  echo sprintf( __("Oops ... Something went wrong. WordPress don't able to download add-on. Please try again later or download it manually from <a class='thickbox open-plugin-details-modal' href='%s'>[here]</a>. In the case if this situation repeat contact our [support team]",'robo-gallery'), $informationUrl ); ?>
</div>