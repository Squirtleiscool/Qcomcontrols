/*
*      Robo Gallery     
*      Version: 2.4
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2016
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

jQuery(function(){
	var roboGalleryUpdateProDialog = jQuery("#rbs_dialog_update_pro_key");
	
	var bodyClass = roboGalleryUpdateProDialog.data("body");
	if(bodyClass) jQuery("body").addClass(bodyClass);
	roboGalleryUpdateProDialog.dialog({
		'dialogClass' : 'wp-dialog',
		'title': roboGalleryUpdateProDialog.data('title'),
		'modal' : true,
		'autoOpen' : roboGalleryUpdateProDialog.data('open'),
		'width': '450', // overcomes width:'auto' and maxWidth bug
	    'maxWidth': 450,
	    'height': 'auto',
	    'fluid': true, 
	    'resizable': false,
		'responsive': true,
		'draggable': false,
		'closeOnEscape' : true,
		'buttons' : [{
				'text'  : 	roboGalleryUpdateProDialog.data('close'),
				'class' : 	'button button-default rbs_dialog_close',
				'click' : 	function() { jQuery(this).dialog('close'); }
		},
		{
				'text' : 	roboGalleryUpdateProDialog.data('info'),
				'class' : 	'button-primary rbs_close_dialog',
				'click' : 	function(){
					window.open("https://robosoft.co/go.php?product=gallery&task=support",'_blank');
				}
		}
		],
		open: function( event, ui ) {}
	});
	window['roboGalleryUpdateProDialog'] = roboGalleryUpdateProDialog;
	jQuery(".ui-dialog-titlebar-close").addClass("ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close");
	
	jQuery('.rbs-block-update-pro').click( function(event ){
		event.preventDefault();
		roboGalleryUpdateProDialog.dialog("open");
	});
});