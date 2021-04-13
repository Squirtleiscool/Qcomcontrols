<div class="robo_gallery_tooltip">
	<h5 class="inline-block robo-gallery-help-label"><?php echo $label; ?></h5>
 
	<span 
		class="dashicons dashicons-info robo-gallery-help-button" 
		data-help="help_content_<?php echo $id; ?>"
	></span>
	<span class="robo_gallery_tooltiptext">
		<?php _e('Click for information', 'robo-gallery'); ?>	
	</span>

	<?php if($help) : ?>
		<div id="help_content_<?php echo $id; ?>" class="robo-gallery-help-dialog">
			<?php echo $help; ?>
		</div>
	<?php endif; ?>
</div>