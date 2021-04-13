(function($) {
 	$('.rb-image-widget-block').each(function(index, el) {
 		var options = { hideCaption : 0 };
 		if( $(this).data('hidecaption')==1 ) options.hideCaption = 1;
 		var id = $( this).attr('id');
 		$('#'+id+' a').swipebox(options);	
 	});
}(jQuery));
