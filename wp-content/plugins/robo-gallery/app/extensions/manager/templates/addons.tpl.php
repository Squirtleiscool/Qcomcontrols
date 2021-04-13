<style>
	
</style>
<div class="wrap rbs-gallery-addon-wrap">
	<h1>
		<?php printf( __( '%s Add-ons', 'yo-gallery' ), rbsGalleryBrand::getPluginName() ); ?>
		<span class="spinner"></span>
	</h1>

	<div class="rbs-gallery-addon-text">
		<?php printf( __( "Add-ons for %s it's even more awesome functionality and flexibility for the core gallery plugin.", 'yo-gallery' ), rbsGalleryBrand::getPluginName() ); ?>
	</div>

	<h2 class="rbs-gallery-nav-tabs nav-tab-wrapper">
	<?php 
		foreach ( $categories as $category_slug => $category ) {
			echo "<a href=\"#{$category_slug}\" class=\"nav-tab nav-tab-{$category_slug}\">{$category['name']}</a>";
		}
	?>
		<?php if(2==3){ ?>
		<div class="rbs-gallery-addons-labels">
			<span class='twoj-addon-label addon-menu' data-category="menu">				<?php _e( 'Menu', 		'yo-gallery' ); ?></span>
			<span class='twoj-addon-label addon-lightbox' data-category="lightbox">		<?php _e( 'Lightbox', 	'yo-gallery' ); ?></span>
			<span class='twoj-addon-label addon-navigation' data-category="navigation">	<?php _e( 'Navigation', 'yo-gallery' ); ?></span>
		</div>
		<?php } ?>
	</h2>
</div>

<div class="rbs-gallery-addon-browser rbs-gallery-addon-items">
	<div class="extensions">
		<?php echo $addons; ?> 
	</div>
</div>
