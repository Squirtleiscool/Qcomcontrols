
      
      <div class="optimizer_sidebar_meta">
           
          <p>
              <label><?php _e( 'Custom Right Sidebar', 'optimizer' ); ?></label>
              <?php $mb->the_field('sidebar'); ?>
              <select name="<?php $mb->the_name(); ?>">
				  <?php 
				  $allsidebars = $GLOBALS['wp_registered_sidebars'];
					unset($allsidebars['foot_sidebar']); 
					unset($allsidebars['front_sidebar']); 
				  foreach($allsidebars as $sidebar ) { ?>
                        <option value="<?php echo $sidebar['id']; ?>"<?php if ($mb->get_the_value() == $sidebar['id']) echo ' selected="selected"'; ?>><?php echo $sidebar['name']; ?></option>
                    <?php }?>
              </select>
          </p>
          
         <?php /* Sidebar Position (ONLY FOR PAGES) */?>
         <?php $screen = get_current_screen();
		 if ( $screen->parent_base == 'edit' && $screen->id == 'page' ){ ?> 
          <p>
              <label><?php _e( 'Custom Full Width Sidebar', 'optimizer' ); ?></label>
              <?php $mb->the_field('page_sidebar'); ?>
              <select name="<?php $mb->the_name(); ?>">
              		<option value="null"<?php if ($mb->get_the_value() == 'null') echo ' selected="selected"'; ?>><?php _e('No Sidebar', 'optimizer'); ?></option>
				  <?php 
                   	$allsidebars = $GLOBALS['wp_registered_sidebars'];
					unset($allsidebars['sidebar']); 
					unset($allsidebars['foot_sidebar']); 
					unset($allsidebars['front_sidebar']); 
					if(!empty($allsidebars))
				  foreach($allsidebars as $sidebar ) { ?>
                        <option value="<?php echo $sidebar['id']; ?>"<?php if ($mb->get_the_value() == $sidebar['id']) echo ' selected="selected"'; ?>><?php echo $sidebar['name']; ?></option>
                    <?php }?>
              </select>
          </p>
          
          <?php } ?>
             

       
          <p>
              <label><?php _e( 'Hide Sidebar', 'optimizer' ); ?></label>
              <?php $mb->the_field('hide_sidebar'); ?>
              <input type="checkbox" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/>
          </p>
      
      </div>
