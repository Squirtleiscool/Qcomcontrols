/*
*      Robo Gallery     
*      Version: 2.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/
(function($){

	/* shortcode copy to clipboard */
	$('.robo-gallery-shortcode').click( function() {
	  try {
	    this.select();
	    document.execCommand('copy');
	    $('.robo-gallery-shortcode-message').remove();
	    $(this).after('<p class="robo-gallery-shortcode-message">ShortCode copied to clipboard!</p>');
	  	if(window['roboGalleryTimerShortCode']!=undefined) clearTimeout(window['roboGalleryTimerShortCode']);
	  	window['roboGalleryTimerShortCode'] = setTimeout( function(){
	  		$('.robo-gallery-shortcode-message').remove();
	  	}, 3000);
	  } catch (err) {
	    console.log('ID 69877: Can\'t copy ShortCode ');
	  }
	});


})(jQuery);