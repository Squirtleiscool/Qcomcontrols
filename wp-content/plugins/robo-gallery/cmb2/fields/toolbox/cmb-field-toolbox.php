<?php
/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/


class RBS_TOOLBOX {

	public function hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'rbs_setup_admin_scripts' ) );
	//	if(!ROBO_GALLERY_PRO) add_action( 'in_admin_header', array( $this, 'rbs_setup_admin_header' ) );
		//if(ROBO_GALLERY_PRO) add_action( 'in_admin_header', array( $this, 'rbs_gallery_dialog_updatepro' ) );
		add_action( 'in_admin_header', array( $this, 'rbs_setup_admin_script' ) );
	}
	
	public function rbs_setup_admin_script(){
		//echo '<script type="text/javascript"> var ROBO_GALLERY_PRO = '.ROBO_GALLERY_PRO.';</script>';
		echo '<script type="text/javascript"> var ROBO_GALLERY_TYR = '.ROBO_GALLERY_TYR.';</script>';

		/* Express panel +*/
		if( isset($_GET['post']) && get_option(  ROBO_GALLERY_PREFIX.'expressPanel' ) ){
		echo '
			<div id="robo_gallery_savebutton_dialog_id" class="robo_gallery_savebutton_dialog_hide">
				<h3>Express Panel</h3>
				<p>
					click update button to save your changes rigth away
				</p>
				<p>
					<button id="robo_gallery_update_button" class="button button-primary button-large">Update</button>
				</p>
			</div> 
			<script type="text/javascript">
				var panelDiv = document.getElementById("robo_gallery_savebutton_dialog_id");
				document.body.appendChild(panelDiv); 
				panelDiv.className = "robo_gallery_savebutton_dialog";
				var buttonRoboGallerySave = document.getElementById("robo_gallery_update_button");
				buttonRoboGallerySave.onclick = function(){ document.getElementById("publish").click(); return false };  
			</script>';
		}
		/* Express panel - */
		/*
				<p><a href="#rsg_button_metabox">Menu Options</a></p>
				<p><a href="#rsg_polaroid_metabox">Polaroid Style Options</a></p>
		*/
	}

	public function rbs_setup_admin_header(){
		echo '<div id="rbs_showInformation" '
						.'style="display: none;" '
						.'data-body="rbs_edit" '
						.'data-open="0" '
						.'data-title="'.__('Get Robo Gallery Pro version', 'robo-gallery').'" '
						.'data-close="'.__('Close', 'robo-gallery').'" '
						.'data-info="'.	__('Get Pro version', 'robo-gallery').'"'
					.'>'
					.__('This function available in PRO version', 'robo-gallery')
				.'</div>';
	}

	public function rbs_gallery_dialog_updatepro(){
		echo '<div id="rbs_dialog_update_pro_key" '
						.'style="display: none;" '
						.'data-body="rbs_edit" '
						.'data-open="0" '
						.'data-title="'.__('Update Robo Gallery PRO Key', 'robo-gallery').'" '
						.'data-close="'.__('Close', 'robo-gallery').'" '
						.'data-info="'.	__('Goto Clients section', 'robo-gallery').'"'
					.'>'
					.__('This function available in latest versions of the plugin. <br/>
							Please login to <a href="https://robosoft.co/clients/" target="_blank">client member place section</a>  and download latest version of the <strong>Robo Gallery Key plugin</strong>.<br/><br/>
							Install this key on the website and all features will be enabled.<br/>
							All previous functionality will be available with old Pro Key. <br/>
							Update required only for the case if you wish to enable all latest functions implemented in new version of the plugin.', 'robo-gallery')
				.'</div>';
	}

	public function rbs_setup_admin_scripts() {

		wp_enqueue_media();
		wp_enqueue_style("wp-jquery-ui-dialog");
		wp_enqueue_script('jquery-ui-dialog');

		//if(!ROBO_GALLERY_PRO){
		//if(!ROBO_GALLERY_TYR){
			//wp_enqueue_script('robo-gallery-info', ROBO_GALLERY_URL.'js/admin/info.js', array( 'jquery' ), ROBO_GALLERY_VERSION, false ); 
			//wp_enqueue_style ('robo-gallery-info', ROBO_GALLERY_URL.'css/admin/info.css', array( ), ROBO_GALLERY_VERSION );
		//}

		//if(ROBO_GALLERY_PRO){
		//if(ROBO_GALLERY_TYR){
			//wp_enqueue_script('robo-gallery-dialog-update-pro', ROBO_GALLERY_URL.'js/admin/update.js', array( 'jquery' ), ROBO_GALLERY_VERSION, false ); 
		//}

		//bootstrap
		wp_enqueue_script( 	'rbs_bootstrap', 			ROBO_GALLERY_URL.'addons/bootstrap/js/bootstrap.min.js', 		array('jquery'), ROBO_GALLERY_VERSION, false);
		wp_enqueue_style ( 	'rbs_bootstrap', 			ROBO_GALLERY_URL.'addons/bootstrap/css/bootstrap.min.css',			array(), ROBO_GALLERY_VERSION, 'all');
		
		//checkbox
		wp_enqueue_script( 'rbs-toolbox-toggles-js', 	ROBO_GALLERY_URL.'addons/toggles/js/bootstrap-toggle.js', 	array( 'jquery', 'rbs_bootstrap' ), ROBO_GALLERY_VERSION, false );
		wp_enqueue_style(  'rbs-toolbox-toggles-css',	ROBO_GALLERY_URL.'addons/toggles/css/bootstrap-toggle.css', 	array(), ROBO_GALLERY_VERSION, 'all' );

		//iconPicker
		wp_enqueue_script( 	'rbs-toolbox-iconset', 		ROBO_GALLERY_URL.'addons/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.3.0.min.js', 		array( 'jquery', 'rbs_bootstrap' ), ROBO_GALLERY_VERSION, true );
		wp_enqueue_script( 	'rbs-toolbox-icon', 		ROBO_GALLERY_URL.'addons/bootstrap-iconpicker/js/bootstrap-iconpicker.js', 							array( 'jquery', 'rbs_bootstrap', 'rbs-toolbox-iconset' ), ROBO_GALLERY_VERSION, true );		
		wp_enqueue_style( 	'rbs-toolbox-icon-css', 	ROBO_GALLERY_URL.'addons/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css', 						array(), ROBO_GALLERY_VERSION, 'all' );
		
		wp_enqueue_style( 	'rbs-toolbox-icon-fonts', 	ROBO_GALLERY_URL.'css/gallery.font.css', 	array(), ROBO_GALLERY_VERSION, 'all' );
			
		//color
		wp_enqueue_script( 'rbs-toolbox-color-tinycolor', ROBO_GALLERY_URL.'addons/color/bootstrap.colorpickersliders.tinycolor.js', 	array( 'jquery', 'rbs_bootstrap' ), ROBO_GALLERY_VERSION, false );
		wp_enqueue_script( 'rbs-toolbox-color', ROBO_GALLERY_URL.'addons/color/bootstrap.colorpickersliders.js', 						array( 'jquery', 'rbs_bootstrap' ), ROBO_GALLERY_VERSION, false );
		wp_enqueue_style( 'rbs-toolbox-color', ROBO_GALLERY_URL.'addons/color/bootstrap.colorpickersliders.css', 						array(), ROBO_GALLERY_VERSION, 'all' );

		//slider
		wp_enqueue_script( 'rbs-toolbox-bootstrap-slider', ROBO_GALLERY_URL.'addons/bootstrap-slider/js/bootstrap-slider.js', 	array( 'jquery', 'rbs_bootstrap' ), ROBO_GALLERY_VERSION, false );
		wp_enqueue_style( 'rbs-toolbox-bootstrap-slider', ROBO_GALLERY_URL.'addons/bootstrap-slider/css/bootstrap-slider.css', 	array(), ROBO_GALLERY_VERSION, 'all' );

		//admin.base
		wp_register_script( 'rbs-toolbox-admin-edit', ROBO_GALLERY_URL.'js/admin/edit.js', 	array( 'jquery' ), ROBO_GALLERY_VERSION, true );
		
		$translation_array = array(
			'rbs_info_clone_text' => __( 'disabled because you select gallery clone option', 'robo-gallery' ),
		);
		wp_localize_script( 'rbs-toolbox-admin-edit', 'rbs_toolbox_translation', $translation_array );
		wp_enqueue_script(  'rbs-toolbox-admin-edit' );

		wp_enqueue_style ( 	'rbs-toolbox-admin-edit',  ROBO_GALLERY_URL.'css/admin/edit.css' );
	}
}
$rbs_tololbox = new RBS_TOOLBOX();
$rbs_tololbox->hooks();