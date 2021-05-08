/* 
*      Robo Gallery     
*      Version: 3.0.7 - 90614
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */

(function(RBPLUGINMANAGER, $, undefined) {

	RBPLUGINMANAGER.toConsole = function (message){
		console.log(message);
	}

	RBPLUGINMANAGER.showSpinner = function($btn) {
		RBPLUGINMANAGER.toConsole('function: showSpinner');
		var $container = $btn.find('.icon-loading.dashicons-update');
		$container.removeClass('icon-loading-hide').addClass('spin');
	};

	RBPLUGINMANAGER.hideSpinner = function($btn) {
		RBPLUGINMANAGER.toConsole('function: hideSpinner');
		var $container = $btn.find('.icon-loading.dashicons-update');
		$container.removeClass('spin').addClass('icon-loading-hide');
	};
	
	RBPLUGINMANAGER.showError = function($btn) {
		RBPLUGINMANAGER.toConsole('function: showError');
		$btn.parent().next('.download-error').css('display', 'block');		
	};

	RBPLUGINMANAGER.updateButtonLabel = function($btn, label) {
		RBPLUGINMANAGER.toConsole('function: updateButtonLabel');
		$btn.find('span.text').text(label);
	};

	RBPLUGINMANAGER.clearClassButton = function( $btn , newClass) {
		$btn.removeClass('addon-activate addon-download addon-link thickbox open-plugin-details-modal').addClass(newClass);
	};


	RBPLUGINMANAGER.updateButtonActivated = function($btn) {
		RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.installed );
		RBPLUGINMANAGER.hideSpinner( $btn );
		if( $btn.attr('data-commercial') == 1 ){
			RBPLUGINMANAGER.clearClassButton( $btn, 'addon-link');
			$btn.attr('href', $btn.attr('data-url'));
		} else {
			RBPLUGINMANAGER.clearClassButton( $btn, 'addon-link thickbox open-plugin-details-modal');
			$btn.attr('href', $btn.attr('data-information'));	
		}
		
		$btn.parent().addClass('addon-activated');
		$btn.find('.dashicons-yes').removeClass('icon-loading-hide');	
	};

	RBPLUGINMANAGER.updateButtonIncludedActivated = function($btn) {
		RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.activated );
		$btn.find('.dashicons-yes').removeClass('icon-loading-hide');
		RBPLUGINMANAGER.clearClassButton( $btn);
		RBPLUGINMANAGER.hideSpinner( $btn );
		setTimeout(function() { 
			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.deactivate );
			RBPLUGINMANAGER.clearClassButton( $btn, 'addon-deactivate');
			$btn.find('.dashicons-yes').addClass('icon-loading-hide');
			$btn.parent().addClass('addon-activated');
			$btn.removeClass('disabled');
		}, 2000);		
	};

	RBPLUGINMANAGER.updateButtonIncludedDeactivated = function($btn) {
		RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.deactivated );
		$btn.find('.dashicons-yes').removeClass('icon-loading-hide');
		RBPLUGINMANAGER.clearClassButton( $btn);
		RBPLUGINMANAGER.hideSpinner( $btn );
		setTimeout(function() { 
			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.activate );
			RBPLUGINMANAGER.clearClassButton( $btn, 'addon-activate');
			$btn.find('.dashicons-yes').addClass('icon-loading-hide');
			$btn.parent().removeClass('addon-activated');
			$btn.removeClass('disabled');
		}, 2000);		
	};


	RBPLUGINMANAGER.bindActionButtons = function() {
		$('a.addon-button').on('click', function(e) {
			
			var $btn = $(this);


			if ($btn.attr('target') == '_blank' || $btn.hasClass('addon-link') ) {
				RBPLUGINMANAGER.toConsole('open link');
				return true;
			}

			e.preventDefault();

			if ($btn.is('.disabled')) {
				RBPLUGINMANAGER.toConsole('disabled');
				return false;
			}

			/*var confirmMsg = $(this).data('confirm');

			if (confirmMsg) {
				RBPLUGINMANAGER.toConsole('with confirmation');
				if (confirm(confirmMsg)) {
					RBPLUGINMANAGER.showSpinner($btn);
					$btn.addClass('disabled');
				} else {
					return false;
				}
			} else {*/

				$btn.addClass('disabled');
				RBPLUGINMANAGER.showSpinner($btn);

				RBPLUGINMANAGER.toConsole('without');

				if( $btn.hasClass('addon-activate') ){

					if( $btn.data('included')==1 ) RBPLUGINMANAGER.activateIncludedPlugin( $btn );
						else RBPLUGINMANAGER.activatePlugin( $btn );

				}else if($btn.hasClass('addon-deactivate')) {

					if( $btn.data('included')==1 ) RBPLUGINMANAGER.deactivateIncludedPlugin( $btn );

				}else if($btn.hasClass('addon-download')) {
					
					RBPLUGINMANAGER.downloadPlugin( $btn );	
				
				}

				return false;
			/*}*/
		});
	};

	

	RBPLUGINMANAGER.downloadPlugin = function( $btn ) {
			
			var url = $btn.data('download'),
				slug = $btn.data('slug'),
				code = $btn.data('code');

			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.downloading );

			RBPLUGINMANAGER.toConsole('download slug:'+slug+' code:'+code);
			RBPLUGINMANAGER.toConsole('Download  ' + url);

			jQuery.ajax({
	        	method: "POST",
	        	url: url,
	        }).done(function() {

				RBPLUGINMANAGER.toConsole('Done download');

				jQuery.ajax({ // Check if plugin installed
					type: 'POST',
					url: ajaxurl,
					
					data: {
						'action': 'rb_check_status',
						'plugin': code
					},

					error: function(){
					  RBPLUGINMANAGER.toConsole('Error: check unsuccessful');
					  RBPLUGINMANAGER.hideSpinner( $btn );
					  RBPLUGINMANAGER.showError( $btn );
					},
					success: function(response){
						var pluginStatus = JSON.parse( response );						
						
						RBPLUGINMANAGER.toConsole(pluginStatus);

						if( pluginStatus.download == 1) {
							/* plugin downloaded */
							if(pluginStatus.active==1){
								/* plugin activate */
								RBPLUGINMANAGER.updateButtonActivated( $btn);
							} else {
								/* plugin don't activate */
								RBPLUGINMANAGER.activatePlugin( $btn );
							}
													
						} else {
							RBPLUGINMANAGER.toConsole('Error: download unsuccessful');
							RBPLUGINMANAGER.hideSpinner( $btn );
							RBPLUGINMANAGER.showError( $btn );
						}
					}
				});
	        })
            .fail(function() {
            	RBPLUGINMANAGER.toConsole('Error: send request unsuccessful');
            	RBPLUGINMANAGER.hideSpinner( $btn );
              	RBPLUGINMANAGER.showError( $btn );
            });

	};

	RBPLUGINMANAGER.activateIncludedPlugin = function( $btn ) {
		

			var url = $btn.data('activate'),
				slug = $btn.data('slug'),
				code = $btn.data('code');

			RBPLUGINMANAGER.toConsole('Activate Included slug:'+slug+' code:'+code);
			RBPLUGINMANAGER.toConsole('Activate  ' + url);

			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.activating )

			jQuery.ajax({
	        	method: "POST",
	        	url: ajaxurl,
					
				data: {
					'action': 'rb_activate_included_plugin',
					'plugin': code
				},
	        }).done(function() {
				RBPLUGINMANAGER.toConsole('Activated');

				jQuery.ajax({ // Check if plugin installed
					type: 'POST',
					url: ajaxurl,
					data: {
						'action': 'rb_check_status',
						'plugin': code
					},
					error: function(){
					  RBPLUGINMANAGER.hideSpinner($btn);
					  RBPLUGINMANAGER.showError($btn);
					},
					success: function(response){
						var pluginStatus = JSON.parse(response);

						RBPLUGINMANAGER.toConsole(pluginStatus);

						if( pluginStatus.download == 1 && pluginStatus.active==1 ) {
								/* plugin active */
								RBPLUGINMANAGER.updateButtonIncludedActivated( $btn);		
						} else {
							RBPLUGINMANAGER.hideSpinner($btn);
							RBPLUGINMANAGER.showError($btn);
						}
					}
				});
	        })
            .fail(function() {
            	RBPLUGINMANAGER.hideSpinner($btn);
				RBPLUGINMANAGER.showError($btn);
            });

	};

	RBPLUGINMANAGER.deactivateIncludedPlugin = function( $btn ) {
		

			var slug = $btn.data('slug'),
				code = $btn.data('code');

			RBPLUGINMANAGER.toConsole('Deactivate Included slug:'+slug+' code:'+code);

			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.deactivating )

			jQuery.ajax({
	        	method: "POST",
	        	url: ajaxurl,
					
				data: {
					'action': 'rb_deactivate_included_plugin',
					'plugin': code
				},
	        }).done(function() {
				
				RBPLUGINMANAGER.toConsole('Deactivated');

				jQuery.ajax({ // Check if plugin installed
					type: 'POST',
					url: ajaxurl,
					data: {
						'action': 'rb_check_status',
						'plugin': code
					},
					error: function(){
					  RBPLUGINMANAGER.hideSpinner($btn);
					  RBPLUGINMANAGER.showError($btn);
					},
					success: function(response){
						var pluginStatus = JSON.parse(response);

						RBPLUGINMANAGER.toConsole(pluginStatus);

						if( pluginStatus.active==0 ) {
								/* plugin active */
								RBPLUGINMANAGER.updateButtonIncludedDeactivated( $btn);		
						} else {
							RBPLUGINMANAGER.hideSpinner($btn);
							RBPLUGINMANAGER.showError($btn);
						}
					}
				});
	        })
            .fail(function() {
            	RBPLUGINMANAGER.hideSpinner($btn);
				RBPLUGINMANAGER.showError($btn);
            });

	};

	RBPLUGINMANAGER.activatePlugin = function( $btn ) {
		

			var url = $btn.data('activate'),
				slug = $btn.data('slug'),
				code = $btn.data('code');

			RBPLUGINMANAGER.toConsole('Activate slug:'+slug+' code:'+code);
			RBPLUGINMANAGER.toConsole('Activate  ' + url);

			RBPLUGINMANAGER.updateButtonLabel( $btn, rbsGalleryAddonAttributes.labels.activating )

			jQuery.ajax({
	        	method: "POST",
	        	url: url,
	        }).done(function() {
				RBPLUGINMANAGER.toConsole('Activated');

				jQuery.ajax({ // Check if plugin installed
					type: 'POST',
					url: ajaxurl,
					data: {
						'action': 'rb_check_status',
						'plugin': code
					},
					error: function(){
					  RBPLUGINMANAGER.hideSpinner($btn);
					  RBPLUGINMANAGER.showError($btn);
					},
					success: function(response){
						var pluginStatus = JSON.parse(response);

						RBPLUGINMANAGER.toConsole(pluginStatus);

						if( pluginStatus.download == 1 && pluginStatus.active==1 ) {
								/* plugin active */
								RBPLUGINMANAGER.updateButtonActivated( $btn);		
						} else {
							RBPLUGINMANAGER.hideSpinner($btn);
							RBPLUGINMANAGER.showError($btn);
						}
					}
				});
	        })
            .fail(function() {
            	RBPLUGINMANAGER.hideSpinner($btn);
				RBPLUGINMANAGER.showError($btn);
            });

	};

	//hook up clicking the tag links above the extensions
	RBPLUGINMANAGER.bindTagLinks = function() {
		$('.rbs-gallery-addons-labels span.twoj-addon-label').on('click', function() {
			var tag = $(this);
			var filter = tag.data('category');
			if( tag.hasClass('click') ){
				$('.rbs-gallery-addon-browser .extensions .rbs-gallery-addon-item').removeClass('uncolored');
				$('.rbs-gallery-addons-labels .twoj-addon-label').removeClass('uncolored');
				tag.removeClass('click');
			} else {
				$('.rbs-gallery-addon-browser .rbs-gallery-addon-item').addClass('uncolored');
				$('.rbs-gallery-addons-labels .twoj-addon-label').addClass('uncolored').removeClass('click');			
				$('.rbs-gallery-addon-browser .extensions .addon-' + filter).removeClass('uncolored');
				$('.rbs-gallery-addon-browser .extensions .addon-' + filter).prependTo('.rbs-gallery-addon-browser .extensions');
				$('.rbs-gallery-addons-labels .twoj-addon-label.addon-' + filter).removeClass('uncolored').addClass('click');
			}
			
			
		});
	};

	RBPLUGINMANAGER.bindTabs = function() {
		$(".rbs-gallery-nav-tabs a.nav-tab").click( function(e) {

			e.preventDefault();

			$this = $(this);

			$this.parents(".nav-tab-wrapper:first").find(".nav-tab-active").removeClass("nav-tab-active");
			$this.addClass("nav-tab-active");

			var filter = $this.attr('href').replace('#', '');
			$('.rbs-gallery-addon-browser .extensions .rbs-gallery-addon-item').hide();
			$('.rbs-gallery-addon-browser .extensions .addon-' + filter).show();
		});

		if (window.location.hash) {
			$('a.nav-tab[href="' + window.location.hash + '"]').click();
		} else {
			$('a.nav-tab-all').click();
		}

		return false;
	};

	RBPLUGINMANAGER.showConfirm = function() {

		RBPLUGINMANAGER.toConsole('function showConfirm');

		var rbsConfirmDialog = $("#rbs-addons-confirm-dialog");

		let slug = rbsConfirmDialog.attr('data-slug');;

		rbsConfirmDialog.dialog({
			'dialogClass' : 'wp-dialog',
			'title': rbsGalleryAddonAttributes.labels.confirm_title,
			'modal' : true,
			'autoOpen' : true,
			'width': '450', // overcomes width:'auto' and maxWidth bug
		    'maxWidth': 450,
		    'height': 'auto',
		    'fluid': true, 
		    'resizable': false,
			'responsive': true,
			'draggable': false,
			'closeOnEscape' : true,
			'buttons' : [{
				'text' : 	rbsGalleryAddonAttributes.labels.confirm_button,
				'class' : 	'button-primary rbs_close_dialog',
				'click' : 	function(){
					$(this).dialog('close');
					$('.addon-button[data-slug="'+slug+'"]').click();
				}
			},
			{
				'text'  : 	rbsGalleryAddonAttributes.labels.confirm_cancel,
				'class' : 	'button button-default rbs_dialog_close',
				'click' : 	function() { $(this).dialog('close'); }
			}],
			//open: function( event, ui ) {}
		});
		window['rbsConfirmDialog'] = rbsConfirmDialog;
	};

	$(function() { //wait for ready
		if(rbsGalleryAddonAttributes.pluginConfirm) RBPLUGINMANAGER.showConfirm();
		RBPLUGINMANAGER.bindTabs();
		RBPLUGINMANAGER.bindActionButtons();
		RBPLUGINMANAGER.bindTagLinks();
	});

}( window.RBPLUGINMANAGER = window.RBPLUGINMANAGER || {}, jQuery));


