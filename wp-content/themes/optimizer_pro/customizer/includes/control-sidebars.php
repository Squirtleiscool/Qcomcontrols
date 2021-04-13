<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom tags control
 */
class Optimizer_Sidebar_Control extends WP_Customize_Control
{
	
	
	public $type = 'sidebars';
      /**
       * Render the content on the theme customizer page
       */
	public function render_content()
	 { ?>
     		<label>
				<?php if ( !empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>
            </label>
        <!--SIDEBARS-->
		<div class="sidebar_lists">
			<?php global $optimizer;
			if(!empty($optimizer['custom_sidebar'])){
				
				if(is_array($optimizer['custom_sidebar'])){
					$optimizer['custom_sidebar'] = rtrim(implode(',', $optimizer['custom_sidebar']), ',');
				}
				$custom_sidebar = explode(',', $optimizer['custom_sidebar']);  
					foreach((array)$custom_sidebar as $key => $value){
						echo '<div class="sidebar_name"><span>'.$value.'</span><form method="post" action=""><input name="remove_sidebar_name" type="hidden" value="'.htmlspecialchars($value).'" ><input name="remove_sidebar_id" type="hidden" value="optimizer_'.trim(preg_replace('/ +/', '-', preg_replace('/[^A-Za-z0-9 ]/', '-', urldecode(html_entity_decode(strip_tags(strtolower($value))))))).'" ><button title="'.__('Delete Sidebar','optimizer').'" name="delcustoms" type="submit"><i class="fa fa-times"></i></button></form></div>';
					}
            
             }else{ ?>
            	<p><?php _e('No Custom Sidebars Created', 'optimizer'); ?></p>
            <?php } ?>
        </div>
        <form method="post" action="">
        <input id="sidebar_nameid" type="text" name="addsidebar" value="" placeholder="<?php _e('Your Sidebar Name..','optimizer'); ?>">
        
		<button id="addsidebar" class="button add-sidebar-buttom" name="addsidebarpost" type="submit"><?php _e( 'Add Sidebar', 'optimizer' ); ?></button>
		</form>
		
        <!--<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" id="<?php echo $this->id; ?>" class="editorfield">-->
			
		
		<?php
	}

}