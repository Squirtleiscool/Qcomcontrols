(function ($) { 
	$("html").on('click', ".rb-image-widget-edit-button", function(event){

		event.preventDefault();
		var valField = $( "#"+$(this).data("valuefield") );
		wp.media.gallery.edit("[gallery ids='"+valField.val()+"']").on("update", function(g){
			var id_array = [];
			$.each(g.models, function(id, img) { id_array.push(img.id); });
			valField.val(id_array.join(","));
			valField.change();
		});
		if( valField.val()=="" || valField.val()==" " ){
			setTimeout(
				function(){
					$(".media-frame-menu .media-menu-item").eq(2).click();
			}, 500);
		}
	});
}(jQuery)); 