<?php
/*  
 * RB Image Widget
 * Version:           1.0.0
 * Author:            RB  Team
 */

if( !defined('WPINC') || !defined("ABSPATH") ){
	die();
}

if ( isset( $_POST['submit'] ) ) {
	check_admin_referer( 'rb-image-widget-options' );
	$this->options['enable_everywhere'] = ( $_POST['enable_everywhere'] == '1' );
	$this->save_options();
}
?>
<style> .indent {padding-left: 2em} </style>
<div class="wrap">
	<h1><?php _e( 'RB Image Widget', 'image-widget-rb'); ?></h1>
	
	<div class="card">
		<p>
			<?php 
				echo sprintf( 
					__( 'You can create manage image widget in WordPress admin widgets management section. Please <a href="%s">open this section</a> to configure RB Image Widget.', 'image-widget-rb')
					, admin_url('widgets.php')
				) ;
			?>
		</p>
	</div>

	<p>
		<?php _e('Configure your Image Widget in admin widget management tool.', 'image-widget-rb'); ?>
	</p>
	<form action="" method="post" id="image-widget-rb">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="enable_everywhere">
							<?php _e('Show dialog', 'image-widget-rb'); ?>
						</label>
					</th>
					<td>
						<ul>
							<li>
								<label for="rb_image_widget_on">
									<input type="radio" id="rb_image_widget_on" name="enable_everywhere" value="0" <?php checked( !$this->options['enable_everywhere'] );?> /> 
									<strong>
										<?php _e( 'Disable'); ?>
									</strong>
								</label>			
							</li>
							<li>
								<label for="rb_image_widget_off">
									<input type="radio" id="rb_image_widget_off" name="enable_everywhere" value="1" <?php checked( $this->options['enable_everywhere'] );?> /> 
									<strong>
										<?php _e( 'Enable'); ?>
									</strong>
								</label>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'rb-image-widget-options' ); ?>
		<p class="submit">
			<input class="button-primary" type="submit" name="submit" value="<?php _e( 'Save Changes') ?>">
		</p>
	</form>
</div>
