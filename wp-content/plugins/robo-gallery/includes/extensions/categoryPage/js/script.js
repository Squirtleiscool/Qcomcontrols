;(function ($, undefined){
    
	function askConfirm() {
	    if (needToConfirm) { 
	        return "Your unsaved data will be lost."; 
	    }
	}
    
    needToConfirm = false; 
	window.onbeforeunload = askConfirm;


    function DialogEdit(options) {
    	var self = this;

    	this.$element = $('#wrapper-nestable-list');

    	this.$spinner = $('.nestable-list-spinner');

    	this.$status = $('#gallery_label_status');

        this.$edit = this.$element.find('.buttonSave');
        
        this.$nestableList = this.$element.find('.nestable-list');

        this.$nestableList.nestable({
        	group: 1, 
        	maxDepth: 100,
        	callback: function(l,e){
        		// l is the main container
        		// e is the element that was moved
        		needToConfirm = true;
        		self.statusUpdate(hierarchyPostAttributes.status.modified);
    		}
       	});
        
        window['catDialogClick'] = 0 ;

        this.init();
    }
    DialogEdit.prototype = {
        init: function() {
            var self = this;

            self.$edit.click( function(){
            	if( window['catDialogClick'] == 0 ){
            		window['catDialogClick'] = 1;
            		return self.save();
            	} else {
            		return false;
            	}
            });
            //self.show();
                
        },
        
        save : function () {
            var self = this,
                hierarchyPosts = this.$nestableList.nestable('serialise');

            self.spinner(true);
            self.statusUpdate(hierarchyPostAttributes.status.saving);
            self.$nestableList.hide();

            $.ajax({
                url: hierarchyPostAttributes.ajaxUrl,
                method: 'post',
                data: {
                    action: hierarchyPostAttributes.action.save,
                    hierarchy_posts: hierarchyPosts
                },
                success: function (response) {
                    self.spinner(false);
                    self.$nestableList.show();
                    window['catDialogClick'] = 0;;
                    self.statusUpdate(hierarchyPostAttributes.status.saved);
                    needToConfirm = false;
                },
                error: function (jqXHR) {
                	self.statusUpdate( hierarchyPostAttributes.status.error);
                    new DialogError(jqXHR.responseText);
                }
            });
        },
        spinner: function(isShow) {
            if (isShow) {
                this.$spinner.show();
            } else {
                this.$spinner.hide();
            }
        },
        statusUpdate: function(text) {
            this.$status.text(text);
        },
        destroy: function () {
        	window['catDialogClick'] = 0;
            this.$element.dialog('close');
            this.$element.remove();
        }
    };

    function DialogError(message) {
        this.$element = $('<div id="hierarchy-post-error">' + message + '</div>');
        this.show()
    }
    DialogError.prototype = {
        show: function () {
            var self = this;

            self.$element.appendTo('body');
            self.$element.dialog({
                'dialogClass' : 'wp-dialog',
                'title': hierarchyPostAttributes.status.error,
                'modal' : true,
                'autoOpen' : true,
                'closeOnEscape' : false,
                'buttons' : [
                    {
                        'text' : hierarchyPostAttributes.status.ok,
                        'class' : 'button',
                        'click' : function() { return self.destroy(); }
                    }
                ],
                'close': function() { return self.destroy(); }
            });
        },
        destroy: function () {
            this.$element.dialog('close');
            this.$element.remove();
        }
    };

    $(document).ready(function() {
        new DialogEdit( {} );
    });
}(jQuery));
