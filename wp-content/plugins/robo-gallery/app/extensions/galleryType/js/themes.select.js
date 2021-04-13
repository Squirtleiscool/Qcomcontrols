

(function () {
	
	const RoboGalleryTypeDialog = function(event){
		event.preventDefault();	
		window.showRoboDialog( );	
		return false;
	};


	const roboClickNewAddFunction = function(elem){
		if( elem.addEventListener ){
		   elem.addEventListener( 'click', RoboGalleryTypeDialog );
		   elem.addEventListener( 'dblclick', RoboGalleryTypeDialog );
		}else if( elem.attachEvent ){
		   elem.attachEvent( 'onclick', RoboGalleryTypeDialog);
		}
	}


	var RoboGalleryTypeDialogMenuMainItem = document.getElementById('menu-posts-robo_gallery_table');
	var RoboGalleryTypeDialogMenuUlSubItems = RoboGalleryTypeDialogMenuMainItem.lastChild;
	var RoboGalleryTypeDialogMenuLiSubItems = RoboGalleryTypeDialogMenuUlSubItems.children;

	if( RoboGalleryTypeDialogMenuLiSubItems.length > 0 ){
		var RoboGalleryTypeDialogMenuLiSubItem = RoboGalleryTypeDialogMenuLiSubItems.item(2);
		var RoboGalleryTypeDialogMenuASubItem = RoboGalleryTypeDialogMenuLiSubItem.lastChild;
		roboClickNewAddFunction(RoboGalleryTypeDialogMenuASubItem);
	}


	//var RoboGalleryTypeDialogContent = document.getElementById('robo-gallery-type-select');
	//console.log('RoboGalleryTypeBodyClass', RoboGalleryTypeBodyClass);
	var typePage = document.getElementsByClassName(RoboGalleryTypeBodyClass);
	//console.log('test', typePage);
	if( typePage.length > 0 ){
		var buttonAdd = typePage[0].getElementsByClassName('page-title-action');
		if( buttonAdd.length > 0 ){
			roboClickNewAddFunction(buttonAdd[0]);
			urlDialog = buttonAdd[0].href;
			
			if( urlDialog.search('&showDialog=1') === -1 ){
				buttonAdd[0].href += '&showDialog=1';	
			}
		}
	}

})();