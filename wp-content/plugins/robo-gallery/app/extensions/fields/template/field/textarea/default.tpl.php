<?php
	$colCount = 12;  
	if(isset($options['column'])) $colCount = $options['column'];
	
	$colCountWrap = 12;
	if(isset($options['columnWrap'])) $colCountWrap = $options['columnWrap'];
?>
<div class="field small-<?php echo $colCountWrap; ?> columns">
	<?php if ($label) : ?>
		<label>
			<?php echo $label; ?>
		</label>
	<?php endif; ?>
		
	<div class="input-group small-<?php echo $colCount; ?>">
		<textarea id="<?php echo $id; ?>" <?php echo $attributes; ?> name="<?php echo $name; ?>" ><?php echo $value; ?></textarea>
	</div>	

	<?php if ($description) : ?>
		<p class="help-text"><?php echo $description; ?></p>
	<?php endif; ?>
</div>
