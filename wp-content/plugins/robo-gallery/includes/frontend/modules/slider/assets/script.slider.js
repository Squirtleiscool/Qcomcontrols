/* copy_banner_php */

(function() {
	var roboSliders 		= document.getElementsByClassName('robo-gallery-slider-container');	

	if( roboSliders == null || roboSliders.length < 1 ){
		console.log('RoboGallery :: Slider :: sliders not found');
		return ;
	}

	for (var i = 0; i < roboSliders.length; i++)  buildRoboSlider( roboSliders[i] );

	function buildRoboSlider( roboSlider ){
		if( roboSlider.getAttribute('data-options') == undefined ) return ;

		var id 				= roboSlider.id,
			options_id		= roboSlider.getAttribute('data-options'),
			objectOptions 	= window[options_id],
			loader          = window[objectOptions.loadingContainerObj];

		//console.log('id: ', id, 'objectOptions: ', objectOptions );
		
		if( roboSlider.style.display == 'none' ) roboSlider.style.display = 'block';

		window['obj_'+id] = new Swiper( '#'+id, objectOptions);
		if( loader !== null ) loader.style.display = "none";
	}
})();