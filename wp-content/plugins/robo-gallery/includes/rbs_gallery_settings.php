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

class Robo_Gallery_Settings {

	private $active_tab = '';

	function __construct(){
		$this->init();
	}


	function init(){
		$this->hooks();
	}

	function hooks(){
		
		add_action( 'admin_init', array( $this, 'settings') );
		add_action('admin_menu', array( $this, 'menu') ) ;
	}

	function menu(){
		add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Settings Robo Gallery', 'Settings', 'manage_options', 'robo-gallery-settings', array( $this, 'page') );
	}


	function settings(){
		register_setting( 'robo_gallery_settings_cache', ROBO_GALLERY_PREFIX.'cache' );

		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'categoryShow' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'jqueryVersion' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'fontLoad' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'delay' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'debugEnable' );
		register_setting( 'robo_gallery_settings_comp', ROBO_GALLERY_PREFIX.'expressPanel' );

		register_setting( 'robo_gallery_settings_post', ROBO_GALLERY_PREFIX.'postShowText' );
		register_setting( 'robo_gallery_settings_post', ROBO_GALLERY_PREFIX.'cloneBlock' );
		
		register_setting( 'robo_gallery_settings_seo', ROBO_GALLERY_PREFIX.'seo' );

		register_setting( 'robo_gallery_settings_assets', ROBO_GALLERY_PREFIX.'cssFiles' );
		register_setting( 'robo_gallery_settings_assets', ROBO_GALLERY_PREFIX.'jsFiles' );

		register_setting( 'robo_gallery_settings_youtube', ROBO_GALLERY_PREFIX.'youtubeApiKey' );
		register_setting( 'robo_gallery_settings_youtube', ROBO_GALLERY_PREFIX.'youtubeCacheTime' );
		
	}

	function tabs( ){
		echo '
		<h2 class="nav-tab-wrapper">
			<a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=cache" class="nav-tab '.( $this->active_tab == 'cache' ? 'nav-tab-active' : '' ).'">
		    	'.__('Cache Settings', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=assets" class="nav-tab '.( $this->active_tab == 'assets' ? 'nav-tab-active' : '' ).'">
		    	'.__('Custom JS\CSS', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=comp" class="nav-tab '.( $this->active_tab == 'comp' ? 'nav-tab-active' : '' ).'">
		    	'.__('Compatibility Settings', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=post" class="nav-tab '.( $this->active_tab == 'post' ? 'nav-tab-active' : '' ).'">
		    	'.__('Create Post Settings', 'robo-gallery').'
		    </a>
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=seo" class="nav-tab '.( $this->active_tab == 'seo' ? 'nav-tab-active' : '' ).'">
		    	'.__('SEO Optimization', 'robo-gallery').'
		    </a>		    
		    <a href="edit.php?post_type=robo_gallery_table&page=robo-gallery-settings&tab=youtube" class="nav-tab '.( $this->active_tab == 'youtube' ? 'nav-tab-active' : '' ).'">
		    	'.__('Youtube API Settings', 'robo-gallery').'
		    </a>
		</h2>';
	}	


	function page(){		

		$this->active_tab =   isset( $_GET[ 'tab' ] ) ? sanitize_title($_GET[ 'tab' ]) : 'cache' ;

		echo '<div class="wrap">';
			echo '<h1>'.__('Robo Gallery Settings', 'robo-gallery').'</h1>';
		
			settings_errors();

			$this->tabs();

			echo '<form method="post" action="options.php?tab='.$this->active_tab.'">';
				
				echo '<table class="form-table">';

				if( $this->active_tab == 'cache' ) {

			    	settings_fields( 'robo_gallery_settings_cache' ); 
					do_settings_sections( 'robo_gallery_settings_cache' ); 
			        $this->cacheOptions();

			    } elseif( $this->active_tab == 'comp' ) {

			    	settings_fields( 'robo_gallery_settings_comp' ); 
					do_settings_sections( 'robo_gallery_settings_comp' ); 
			        $this->compOptions();

			    } elseif( $this->active_tab == 'assets' ) {

			    	settings_fields( 'robo_gallery_settings_assets' ); 
					do_settings_sections( 'robo_gallery_settings_assets' ); 
			        $this->assetsOptions();

			    } elseif( $this->active_tab == 'post' ) {

			    	settings_fields( 'robo_gallery_settings_post' ); 
					do_settings_sections( 'robo_gallery_settings_post' ); 
			        $this->postOptions();

			    } elseif( $this->active_tab == 'youtube' ) {

			    	settings_fields( 'robo_gallery_settings_youtube' ); 
					do_settings_sections( 'robo_gallery_settings_youtube' ); 
			        $this->youtubeOptions();

			    } else {

			    	settings_fields( 'robo_gallery_settings_seo' ); 
					do_settings_sections( 'robo_gallery_settings_seo' ); 
			        $this->seoOptions();

			    } 
			    
			    echo '</table>';

				submit_button();

			echo '</form>';
		echo '</div>';

	}


	function youtubeOptions(){
		$option_youtube = get_option(ROBO_GALLERY_PREFIX.'youtubeApiKey', '');
		 ?>
			<tr>
				<th scope="row"><?php _e('Youtube Api Key', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<input name="<?php echo ROBO_GALLERY_PREFIX.'youtubeApiKey'; ?>" id="<?php echo ROBO_GALLERY_PREFIX.'youtubeApiKey'; ?>" value="<?php echo $option_youtube; ?>" class="regular-text code" type="text">
						<span id="robo-youtube-api-resultcheck"></span>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="description">
						<?php 
							echo sprintf( 
								'%s <a href="%s" target="_black">%s</a> %s',
								__("If you don't know how to create Youtube API key please follow ", 'robo-gallery'),
								'https://developers.google.com/youtube/v3/getting-started',
								__("this official instruction ", 'robo-gallery'),
								__("for the google developers console", 'robo-gallery')
							);
						?>
					</p>
				</td>
			</tr>
		<?php

		$option_youtube_cache = (int) get_option(ROBO_GALLERY_PREFIX.'youtubeCacheTime', '12');

		if(!$option_youtube_cache) $option_youtube_cache = 12;
		 ?>
			<tr id="robo-options-block-youtube-api">
				<th scope="row"><?php _e('Clear cache timeout', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<input name="<?php echo ROBO_GALLERY_PREFIX.'youtubeCacheTime'; ?>" id="<?php echo ROBO_GALLERY_PREFIX.'youtubeCacheTime'; ?>" value="<?php echo $option_youtube_cache; ?>" class="small-text" type="text"> hours
					</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="description">
						<?php _e("This is timeout for the clear youtube gallery cache option. Value in hours for the cleaning period of the cached resources.", 'robo-gallery'); ?>
					</p>
				</td>
			</tr>
		<?php
	}

	function cacheOptions(){
		$option_cache = (int) get_option(ROBO_GALLERY_PREFIX.'cache', '12');

		if(!$option_cache) $option_cache = 12;
		 ?>
			<tr>
				<th scope="row"><?php _e('Clear cache timeout', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<input name="<?php echo ROBO_GALLERY_PREFIX.'cache'; ?>" id="<?php echo ROBO_GALLERY_PREFIX.'cache'; ?>" value="<?php echo $option_cache; ?>" class="small-text" type="text"> hours
					</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="description">
						<?php _e("This is timeout for the clear gallery cache option. Value in hours for the cleaning period of the cached resources.", 'robo-gallery'); ?>
					</p>
				</td>
			</tr>
		<?php
	}

	function assetsOptions(){

		$cssFiles = trim(get_option( ROBO_GALLERY_PREFIX.'cssFiles', ''));
		$jsFiles = trim(get_option( ROBO_GALLERY_PREFIX.'jsFiles', ''));
		 ?>
			<tr>
				<th scope="row"><?php _e('Css Files', 'robo-gallery'); ?></th>
				<td>
					<p>
						<label>
							<?php _e('Just add custom CSS files to this field.','robo-gallery');?>		
						</label>
					</p>
					<textarea 
						name="<?php echo ROBO_GALLERY_PREFIX.'cssFiles'; ?>" 
						id="<?php echo ROBO_GALLERY_PREFIX.'cssFiles'; ?>" 
						class="large-text code" 
						cols="50" 
						rows="5"><?php echo $cssFiles; ?></textarea>
					<p class="description">
						<?php _e('Path for included files from the WordPress Root Directory','robo-gallery');?><br/>
						<?php _e('Sample path:','robo-gallery');?> <code>wp-content/plugins/robogallery/css/custom.css</code>							
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('JS Files', 'robo-gallery'); ?></th>
				<td>
					<p>
						<label>
							<?php _e('Just add custom JS files to this field.','robo-gallery');?>
						</label>
					</p>
					<textarea 
						name="<?php echo ROBO_GALLERY_PREFIX.'jsFiles'; ?>" 
						id="<?php echo ROBO_GALLERY_PREFIX.'jsFiles'; ?>"  
						class="large-text code" 
						cols="50" 
						rows="5"><?php echo $jsFiles; ?></textarea>
					<p class="description">
						<?php _e('Path for included files from the WordPress Root Directory','robo-gallery');?><br/>
						<?php _e('Sample path:','robo-gallery');?> <code>wp-content/plugins/robogallery/js/custom.js</code>							
					</p>
				</td>
			</tr>
			
		<?php
	}


	function compOptions(){
		 ?>
			<tr>
				<th scope="row"><?php _e('Categories Manager', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'categoryShow'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'categoryShow', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'categoryShow'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'categoryShow')==1 ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('jQuery Version', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('jQuery Version', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Default'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='build' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion', 'build')=='build' ) echo " checked='checked'";?> /> <?php _e('Default'); ?>
						</label><br />
						<label title='<?php _e('Alternative', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='robo' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion')=='robo' ) echo " checked='checked'";?>  /> <?php _e('Alternative', 'robo-gallery'); ?>
						</label>
						<p class="description">[for the case if you have jQuery version conflicts on page]</p>
						<br />
						<label title='<?php _e('Forced include', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'jqueryVersion'; ?>' value='forced' <?php if( get_option(ROBO_GALLERY_PREFIX.'jqueryVersion')=='forced' ) echo " checked='checked'";?>  /> <?php _e('Forced include', 'robo-gallery'); ?>
						</label>
						<p class="description">[ for the case when Your theme do not use WordPress API ]</p>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Font Awesome', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Font Awesome', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Load'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'fontLoad'; ?>' value='on' <?php if( get_option(ROBO_GALLERY_PREFIX.'fontLoad', 'on')=='on' ) echo " checked='checked'";?> /> <?php _e('Load'); ?>
						</label><br />
						<label title='<?php _e('Don\'t load', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'fontLoad'; ?>' value='off' <?php if( get_option(ROBO_GALLERY_PREFIX.'fontLoad')=='off' ) echo " checked='checked'";?>  /> <?php _e('Don\'t load', 'robo-gallery'); ?>
						</label>
						<p class="description">[ <?php _e('for the case if Your theme already have awesome fonts loaded', 'robo-gallery'); ?>' ]</p>
					</fieldset>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('Size Calculations Delay', 'robo-gallery'); ?></th>
				<td>
					<input name="<?php echo ROBO_GALLERY_PREFIX.'delay'; ?>" id="<?php echo ROBO_GALLERY_PREFIX.'delay'; ?>" value="<?php echo (int) get_option(ROBO_GALLERY_PREFIX.'delay', '1000'); ?>" class="small-text" type="text"> ms.
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Debug'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable'); ?></span></legend>
						<label title='<?php _e('Enable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'debugEnable'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'debugEnable')==1 ) echo " checked='checked'"; ?> /> <?php _e('Enable'); ?>
						</label><br />
						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'debugEnable'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'debugEnable', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Express panel', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable'); ?></span></legend>
						<label title='<?php _e('Enable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'expressPanel'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'expressPanel')==1 ) echo " checked='checked'"; ?> /> <?php _e('Enable'); ?>
						</label><br />
						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'expressPanel'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'expressPanel', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
		<?php
	}


	function postOptions(){
		?>
			<tr>
				<th scope="row"><?php _e('Text Block', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show Text', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'postShowText'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'postShowText', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'postShowText'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'postShowText')=='1' ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Clone Block', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Show Clone Block', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Show'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'cloneBlock'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'cloneBlock', '') ) echo " checked='checked'"; ?> /> <?php _e('Show'); ?>
						</label><br />
						<label title='<?php _e('Hide'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'cloneBlock'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'cloneBlock')=='1' ) echo " checked='checked'"; ?>  /> <?php _e('Hide'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>
		<?php
	}


	function seoOptions(){
		?>
			<tr>
				<th scope="row"><?php _e('Add SEO content', 'robo-gallery'); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Enable [thumbs]', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Enable [thumbs]', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='2' <?php if( get_option(ROBO_GALLERY_PREFIX.'seo')=='2' ) echo " checked='checked'"; ?> /> <?php _e('Enable [thumbs]', 'robo-gallery'); ?>
						</label><br />

						<legend class="screen-reader-text"><span><?php _e('Enable [thumbs + link]', 'robo-gallery'); ?></span></legend>
						<label title='<?php _e('Enable [thumbs + link]', 'robo-gallery'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='1' <?php if( get_option(ROBO_GALLERY_PREFIX.'seo')=='1' ) echo " checked='checked'"; ?> /> <?php _e('Enable [thumbs + link]', 'robo-gallery'); ?>
						</label><br />

						<label title='<?php _e('Disable'); ?>'>
							<input type='radio' name='<?php echo ROBO_GALLERY_PREFIX.'seo'; ?>' value='0' <?php if( !get_option(ROBO_GALLERY_PREFIX.'seo', '') ) echo " checked='checked'"; ?>  /> <?php _e('Disable', 'robo-gallery'); ?>
						</label><br />			
					</fieldset>
				</td>
			</tr>

		<?php
	}

}
		
$settings = new Robo_Gallery_Settings();
