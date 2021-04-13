(function() {

	tinymce.PluginManager.add('optimizer_mce_button', function( editor, url ) {

		editor.addButton( 'optimizer_mce_button', {
			text: 'Shortcodes',
			icon: false,
			type: 'menubutton',
			classes: 'btn widget menubtn lts_menubtn',
			menu: [
				{
				}]
				
		});


	
		editor.addButton( 'optimizer_mce_button', {
			text: 'Shortcodes',
			icon: false,
			type: 'menubutton',
			classes: 'btn widget menubtn lts_menubtn',
			menu: [
				{
					text: 'Content Editing',
					icon: 'optim_cont_edit',
					menu: [
/*----------------------------2 columns---------------------------*/
						{
							text: '2 columns',
							onclick: function() {
								editor.windowManager.open( {
									title: '2 Columns',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'colonemedia',
											label: 'First Column Content',
											text: 'Add Media',
											classes: 'meida_btn colonemedia',
										},
										{
											type: 'textbox',
											name: 'twoColumnOne',
											label: 'Content of 1st Column',
											value: '',
											multiline: true,
											classes: 'twocolonemce',
											minWidth: 300,
											minHeight: 300,
										},
										{
											type: 'button',
											name: 'coltwomedia',
											label: 'Second Column Content',
											text: 'Add Media',
											classes: 'meida_btn coltwomedia',
										},
										{
											type: 'textbox',
											name: 'twoColumnTwo',
											label: 'Content of 2nd Column',
											value: '',
											multiline: true,
											classes: 'twocoltwomce',
											minWidth: 300,
											minHeight: 300
										},
										
										
										{
											type: 'textbox',
											name: 'twoColumnOneWidth',
											label: 'Width of 1st Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 30%',
											classes: 'twocolonewidth'
										},
										
										{
											type: 'textbox',
											name: 'twoColumnTwoWidth',
											label: 'Width of 2nd Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 70%',
											classes: 'twocoltwowidth'
										},
										
										
									],
									onsubmit: function( e ) {
										
										tinyMCE.triggerSave();
										var twoColumnOneHtml = jQuery('.mce-twocolonemce').val();
										var twoColumnTwoHtml = jQuery('.mce-twocoltwomce').val();
										
										if(e.data.twoColumnOneWidth){ 
											var twoColumnOneWidth = 'width="'+e.data.twoColumnOneWidth+'"';
										}else{
											var twoColumnOneWidth =''
										}
										if(e.data.twoColumnTwoWidth){ 
											var twoColumnTwoWidth = 'width="'+e.data.twoColumnTwoWidth+'"';
										}else{
											var twoColumnTwoWidth =''
										}
							
									
							editor.insertContent( '[col2 '+twoColumnOneWidth+']' + twoColumnOneHtml + '[/col2][col2 '+twoColumnTwoWidth+']' + twoColumnTwoHtml + '[/col2]');
										
									}
								});
								
									
									//LOAD INNER TINYMCE
									optimTinyHeavy('.mce-twocolonemce', 'twocolonemce');
									optimTinyHeavy('.mce-twocoltwomce', 'twocoltwomce');
									
									//MEDIA BUTTON
									optimMedia('.mce-colonemedia','.mce-twocolonemce');
									optimMedia('.mce-coltwomedia','.mce-twocoltwomce');
									
									//WINDOW Styles
									jQuery(".mce-colonemedia, .mce-coltwomedia").prev('label').css({"font-weight":"bold"});
									optimMceWindow();

									
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="2 Columns"]').addClass('2col_window');
									jQuery(".2col_window .mce-foot>div").prepend("<a class='short_preview_btn 2col_prevbtn'><span></span>Preview</a>");
									jQuery('.short_preview_btn.2col_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var col2one = jQuery('.mce-twocolonemce').val();
                                 var col2two = jQuery('.mce-twocoltwomce').val();
                                 var col2onewidth = jQuery('.mce-twocolonewidth').val();
                                 var col2twowidth = jQuery('.mce-twocoltwowidth').val();
                                 
                                 if(col2onewidth !==''){var col2onewidth = 'style="width:'+col2onewidth+'"';}
                                 if(col2twowidth !==''){var col2twowidth = 'style="width:'+col2twowidth+'"';}
                                 
                                 if(col2one =='' && col2two ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="col2" '+col2onewidth+'>'+col2one+'</div><div class="col2" '+col2twowidth+'>'+col2two+'</div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".short_preview.2col_prev").remove();
                                 jQuery(".2col_window .mce-window-head").next('.2col_window .mce-container-body').find('.mce-container').first().prepend("<div class='short_preview 2col_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".short_preview.2col_prev").css({"height":jQuery(".2col_window .mce-window-head").next('.mce-container-body').height()});
                              
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".short_preview.2col_prev").remove();
                              }

									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
						
/*----------------------------3 columns---------------------------*/
						{
							text: '3 columns',
							onclick: function() {
								editor.windowManager.open( {
									title: '3 Columns',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'threecolonemedia',
											label: 'First Column Content',
											text: 'Add Media',
											classes: 'meida_btn threecolonemedia',
										},
										{
											type: 'textbox',
											name: 'threeColumnOne',
											label: 'Content of 1st Column',
											value: 'Write your the content of your first column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'threecolonemce',
											minWidth: 300,
											minHeight: 300,
											
										},
										{
											type: 'button',
											name: 'threecoltwomedia',
											label: 'Second Column Content',
											text: 'Add Media',
											classes: 'meida_btn threecoltwomedia',
										},
										{
											type: 'textbox',
											name: 'threeColumnTwo',
											label: 'Content of 2nd Column',
											value: 'Write your the content of your second column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'threecoltwomce',
											minWidth: 300,
											minHeight: 300,
										},
										{
											type: 'button',
											name: 'threecoltwomedia',
											label: 'Third Column Content',
											text: 'Add Media',
											classes: 'meida_btn threecolthreemedia',
										},
										{
											type: 'textbox',
											name: 'threeColumnThree',
											label: 'Content of 3rd Column',
											value: 'Write your the content of your third column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'threecolthreemce',
											minWidth: 300,
											minHeight: 300,
										},
										
										
										
										
										{
											type: 'textbox',
											name: 'threeColumnOneWidth',
											label: 'Width of 1st Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 33%',
											classes: 'threecolonewidth'
										},
										
										{
											type: 'textbox',
											name: 'twoColumnTwoWidth',
											label: 'Width of 2nd Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 33%',
											classes: 'threecoltwowidth'
										},
										
										
										{
											type: 'textbox',
											name: 'twoColumnThreeWidth',
											label: 'Width of 3rd Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 33%',
											classes: 'threecolthreewidth'
										},
										
										
									],
									onsubmit: function( e ) {
										tinyMCE.triggerSave();
										var threeColumnOneHtml = jQuery('.mce-threecolonemce').val();
										var threeColumnTwoHtml = jQuery('.mce-threecoltwomce').val();
										var threeColumnThreeHtml = jQuery('.mce-threecolthreemce').val();
										
										
										if(e.data.threeColumnOneWidth){ 
											var threeColumnOneWidth = 'width="'+e.data.threeColumnOneWidth+'"';
										}else{
											var threeColumnOneWidth =''
										}
										
										if(e.data.threeColumnTwoWidth){ 
											var threeColumnTwoWidth = 'width="'+e.data.threeColumnTwoWidth+'"';
										}else{
											var threeColumnTwoWidth =''
										}
										
										if(e.data.threeColumnThreeWidth){ 
											var threeColumnThreeWidth = 'width="'+e.data.threeColumnThreeWidth+'"';
										}else{
											var threeColumnThreeWidth =''
										}
										
										
										editor.insertContent( '[col3 ' + threeColumnOneWidth + ']' + threeColumnOneHtml + '[/col3][col3 ' + threeColumnTwoWidth + ']' + threeColumnTwoHtml + '[/col3][col3 ' + threeColumnThreeWidth + ']' + threeColumnThreeHtml + '[/col3]');
									}
								});
								
								
									//LOAD INNER TINYMCE
									optimTinyHeavy('.mce-threecolonemce', 'threecolonemce');
									optimTinyHeavy('.mce-threecoltwomce', 'threecoltwomce');
									optimTinyHeavy('.mce-threecolthreemce', 'threecolthreemce');
									
									//MEDIA BUTTON
									optimMedia('.mce-threecolonemedia','.mce-threecolonemce');
									optimMedia('.mce-threecoltwomedia','.mce-threecoltwomce');
									optimMedia('.mce-threecolthreemedia','.mce-threecolthreemce');
									
									//WINDOW Styles
									optimMceWindow();
									
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="3 Columns"]').addClass('3col_window');
									jQuery(".3col_window .mce-foot>div").prepend("<a class='short_preview_btn 3col_prevbtn'><span></span>Preview</a>");
                           jQuery('.short_preview_btn.3col_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var col3one = jQuery('.mce-threecolonemce').val();
                                 var col3two = jQuery('.mce-threecoltwomce').val();
                                 var col3three = jQuery('.mce-threecolthreemce').val();
                                 var col3onewidth = jQuery('.mce-threecolonewidth').val();
                                 var col3twowidth = jQuery('.mce-threecoltwowidth').val();
                                 var col3threewidth = jQuery('.mce-threecolthreewidth').val();
                                 
                                 if(col3onewidth !==''){var col3onewidth = 'style="width:'+col3onewidth+'"';}
                                 if(col3twowidth !==''){var col3twowidth = 'style="width:'+col3twowidth+'"';}
                                 if(col3threewidth !==''){var col3threewidth = 'style="width:'+col3threewidth+'"';}
                                 
                                 if(col3one =='' && col3two =='' && col3three ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="col3" '+col3onewidth+'>'+col3one+'</div><div class="col3" '+col3twowidth+'>'+col3two+'</div><div class="col3" '+col3threewidth+'>'+col3three+'</div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".3col_prev").remove();
                                 jQuery(".3col_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview 3col_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".3col_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									   }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".3col_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
						
/*----------------------------4 columns---------------------------*/
						{
							text: '4 columns',
							onclick: function() {
								editor.windowManager.open( {
									title: '4 Columns',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'focolonemedia',
											label: 'First Column Content',
											text: 'Add Media',
											classes: 'meida_btn focolonemedia',
										},
										{
											type: 'textbox',
											name: 'fourColumnOne',
											label: 'Content of 1st Column',
											value: 'Write your the content of your first column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'focolonemce',
											minWidth: 300,
											minHeight: 300,
										},
										{
											type: 'button',
											name: 'focoltwomedia',
											label: 'Second Column Content',
											text: 'Add Media',
											classes: 'meida_btn focoltwomedia',
										},
										{
											type: 'textbox',
											name: 'fourColumnTwo',
											label: 'Content of 2nd Column',
											value: 'Write your the content of your second column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'focoltwomce',
											minWidth: 300,
											minHeight: 300,
										},
										{
											type: 'button',
											name: 'focolthreemedia',
											label: 'Third Column Content',
											text: 'Add Media',
											classes: 'meida_btn focolthreemedia',
										},
										{
											type: 'textbox',
											name: 'fourColumnThree',
											label: 'Content of 3rd Column',
											value: 'Write your the content of your third column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'focolthreemce',
											minWidth: 300,
											minHeight: 300,
										},
										{
											type: 'button',
											name: 'focolfomedia',
											label: 'Fourth Column Content',
											text: 'Add Media',
											classes: 'meida_btn focolfomedia',
										},
										{
											type: 'textbox',
											name: 'fourColFour',
											label: 'Content of 4th Column',
											value: 'Write your the content of your fourth column here. You can add shortcodes and html here.',
											multiline: true,
											classes: 'focolfomce',
											minWidth: 300,
											minHeight: 300,
										},
										
										

										
										{
											type: 'textbox',
											name: 'foColumnOneWidth',
											label: 'Width of 1st Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 25%',
											classes: 'focolonewidth'
										},
										
										{
											type: 'textbox',
											name: 'foColumnTwoWidth',
											label: 'Width of 2nd Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 25%',
											classes: 'focoltwowidth'
										},
										
										
										{
											type: 'textbox',
											name: 'foColumnThreeWidth',
											label: 'Width of 3rd Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 25%',
											classes: 'focolthreewidth'
										},
										
										
										{
											type: 'textbox',
											name: 'foColumnFoWidth',
											label: 'Width of 4th Column (Optional)',
											value: '',
											tooltip: 'in %. eg: 25%',
											classes: 'focolfowidth'
										},
										
									],
									onsubmit: function( e ) {
										tinyMCE.triggerSave();
										var foColumnOneHtml = jQuery('.mce-focolonemce').val();
										var foColumnTwoHtml = jQuery('.mce-focoltwomce').val();
										var foColumnThreeHtml = jQuery('.mce-focolthreemce').val();
										var foColumnFourHtml = jQuery('.mce-focolfomce').val();
										
										
										
										if(e.data.foColumnOneWidth){ 
											var foColumnOneWidth = 'width="'+e.data.foColumnOneWidth+'"';
										}else{
											var foColumnOneWidth =''
										}
										
										if(e.data.foColumnTwoWidth){ 
											var foColumnTwoWidth = 'width="'+e.data.foColumnTwoWidth+'"';
										}else{
											var threeColumnTwoWidth =''
										}
										
										if(e.data.foColumnThreeWidth){ 
											var foColumnThreeWidth = 'width="'+e.data.foColumnThreeWidth+'"';
										}else{
											var foColumnThreeWidth =''
										}
											
										if(e.data.foColumnFoWidth){ 
											var foColumnFoWidth = 'width="'+e.data.foColumnFoWidth+'"';
										}else{
											var foColumnFoWidth =''
										}
										
										editor.insertContent( '[col4 '+foColumnOneWidth+']' + foColumnOneHtml + '[/col4][col4 '+foColumnTwoWidth+']' + foColumnTwoHtml + '[/col4][col4 '+foColumnThreeWidth+']' + foColumnThreeHtml + '[/col4][col4 '+foColumnFoWidth+']' + foColumnFourHtml + '[/col4]');
									}
								});
								
									//LOAD INNER TINYMCE
									optimTinyHeavy('.mce-focolonemce', 'focolonemce');
									optimTinyHeavy('.mce-focoltwomce', 'focoltwomce');
									optimTinyHeavy('.mce-focolthreemce', 'focolthreemce');
									optimTinyHeavy('.mce-focolfomce', 'focolfomce');
									
									//MEDIA BUTTON
									optimMedia('.mce-focolonemedia','.mce-focolonemce');
									optimMedia('.mce-focoltwomedia','.mce-focoltwomce');
									optimMedia('.mce-focolthreemedia','.mce-focolthreemce');
									optimMedia('.mce-focolfomedia','.mce-focolfomce');
									
									//WINDOW Styles
									optimMceWindow();
									
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="4 Columns"]').addClass('4col_window');
									jQuery(".4col_window .mce-foot>div").prepend("<a class='short_preview_btn 4col_prevbtn''><span></span>Preview</a>");
                           jQuery('.short_preview_btn.4col_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var col4one = jQuery('.mce-focolonemce').val();
                                 var col4two = jQuery('.mce-focoltwomce').val();
                                 var col4three = jQuery('.mce-focolthreemce').val();
                                 var col4fo = jQuery('.mce-focolfomce').val();
                                 var col4onewidth = jQuery('.mce-focolonewidth').val();
                                 var col4twowidth = jQuery('.mce-focoltwowidth').val();
                                 var col4threewidth = jQuery('.mce-focolthreewidth').val();
                                 var col4fowidth = jQuery('.mce-focolfowidth').val();
                                 
                                 if(col4onewidth !==''){var col4onewidth = 'style="width:'+col4onewidth+'"';}
                                 if(col4twowidth !==''){var col4twowidth = 'style="width:'+col4twowidth+'"';}
                                 if(col4threewidth !==''){var col4threewidth = 'style="width:'+col4threewidth+'"';}
                                 if(col4fowidth !==''){var col4fowidth = 'style="width:'+col4fowidth+'"';}
                                 
                                 
                                 if(col4one =='' && col4two =='' && col4three =='' && col4fo ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="col4" '+col4onewidth+'>'+col4one+'</div><div class="col4" '+col4twowidth+'>'+col4two+'</div><div class="col4" '+col4threewidth+'>'+col4three+'</div><div class="col4" '+col4fowidth+'>'+col4fo+'</div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".4col_prev").remove();
                                 jQuery(".4col_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview 4col_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".4col_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".4col_prev").remove();
                              }
                           });
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
						
						
/*----------------------------BUTTON---------------------------*/
								{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Button',
									width: 860,
									height: 400,
									body: [
										{
											type: 'textbox',
											name: 'buttonText',
											label: 'Button Text',
											value: 'My Button',
											classes: 'btn_txt',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'buttonUrl',
											label: 'Button Link',
											value: 'http://google.com',
											classes: 'btn_url',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'buttonBgColor',
											label: 'Button Background Color',
											classes: 'colpix btn_bgcolor',
											value: '#2dcb73',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'buttonTxtColor',
											label: 'Button text Color',
											classes: 'colpix btn_txtcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'listbox',
											name: 'buttonStyle',
											label: 'Button Style',
											classes: 'btn widget btn_style',
											'values': [
												{text: 'Square (Flat)', value: 'lt_flat'},
												{text: 'Square (Hollow)', value: 'lt_hollow'},
												{text: 'Circular (Flat)', value: 'lt_circular lt_flat'},
												{text: 'Circular (Hollow)', value: 'lt_circular lt_hollow'}
											]
										},
										{
											type: 'listbox',
											name: 'buttonSize',
											label: 'Button Size',
											classes: 'btn widget btn_size',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Small', value: 'small'},
												{text: 'Large', value: 'large'}
											]
										},
										{
											type: 'button', 
											label: 'Icon',
											name: 'buttonIcon', 
											text: 'Select icon', 
											classes: 'btn icon_pack',
											value: ''
										},
										{
											type: 'textbox', 
											label: '',
											name: 'buttonIconValue',  
											classes: 'icon_value button_icon_value',
											value: ''
										},
										{
											type: 'checkbox',
											name: 'buttonNewWindow',
											label: 'Open in New Window',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'buttonRounded',
											label: 'Rounded Corner',
											classes: 'btn_rounded',
											checked: true,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[button text="'+e.data.buttonText+'" url="'+e.data.buttonUrl+'" background_color="'+e.data.buttonBgColor+'" text_color="'+e.data.buttonTxtColor+'" style="' + e.data.buttonStyle + '" size="' + e.data.buttonSize + '" icon="' + e.data.buttonIconValue + '" open_new_window="' + e.data.buttonNewWindow + '" rounded="' + e.data.buttonRounded + '"]');
									}
								});

								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//LOAD FONTAWESOME ICONS
								jQuery('.mce-icon_pack').after(appendIcons);
							
								jQuery(".mce-icon_pack").click(function() {
									jQuery('.package').fadeIn();
								});
									
								jQuery(".package i").click(function() {
									var iconvalue = jQuery(this).attr('class');
									jQuery(this).parent().parent().hide();
									jQuery('.mce-icon_pack button, .mce-button_icon_value').val(iconvalue);
									jQuery('.mce-icon_pack button i').remove();
									jQuery('.mce-icon_pack button').prepend('<i class="fa '+iconvalue+'"/>')
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Button"]').addClass('button_window');
									jQuery(".button_window .mce-foot>div").prepend("<a class='short_preview_btn button_prevbtn'><span></span>Preview</a>");
                           jQuery('.button_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var btn_text = jQuery('.mce-btn_txt').val();
                                 var btn_link = jQuery('.mce-btn_url').val();
                                 var btn_bg = jQuery('.mce-btn_bgcolor').val();
                                 var btn_color = jQuery('.mce-btn_txtcolor').val();
                                 var btn_style = jQuery('.mce-btn_style button').text();
                                    if(btn_style =='Square (Flat)'){var btn_style = 'lt_flat'}
                                    if(btn_style =='Square (Hollow)'){var btn_style = 'lt_hollow'}
                                    if(btn_style =='Circular (Flat)'){var btn_style = 'lt_circular'}
                                    if(btn_style =='Circular (Hollow)'){var btn_style = 'lt_circular lt_hollow'}

                                 
                                 var btn_size = jQuery('.mce-btn_size button').text().toLowerCase();
                                 var btn_icon = jQuery('.mce-button_icon_value').val();
                                 if(btn_icon !==''){var btn_icon = '<i class="fa '+btn_icon+'"></i>';}
                                 var btn_roundedval = jQuery('.mce-btn_rounded').attr("aria-checked");
                                 var btn_rounded ='';
                                 if(btn_roundedval =='true'){var btn_rounded = 'lt_rounded';}
                                 
                                 if(btn_text ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<p style="text-align:center; margin-top:150px;"><a class="lts_button lts_button_'+btn_size+' '+btn_rounded+' '+btn_style+'" style="background:'+btn_bg+';color:'+btn_color+'!important;border-color:'+btn_bg+';" href="'+btn_link+'">'+btn_icon+' ' +btn_text+'</a></p>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".button_prev").remove();
                                 jQuery(".button_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview button_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".button_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".button_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
						
/*----------------------------Quote---------------------------*/
						{
							text: 'Quote',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Quote',
									width: 860,
									height: 500,
									body: [
										{
											type: 'textbox',
											name: 'ltsQuote',
											label: 'Quote',
											value: 'Write your the Quote here.',
											classes: 'ltsmce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										{
											type: 'textbox',
											name: 'ltsQuoteAuthor',
											label: 'Quote Author (Optional)',
											value: 'Write the name of the Quote Author here.',
											multiline: false,
											minWidth: 300,
											classes: 'ltsmce_author',
										},
										{
											type: 'textbox',
											name: 'ltsQuoteSrc',
											label: 'Quote Source (Optional)',
											value: '',
											multiline: false,
											minWidth: 300,
											classes: 'ltsmce_src',
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-ltsmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[quote author="' + e.data.ltsQuoteAuthor + '" source="' + e.data.ltsQuoteSrc + '"]' + updatedHtml + '[/quote]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-ltsmce", plugins: ["image media"],toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist image media", body_id: "my_id",forced_root_block : false, menubar:false});
								jQuery('.mce-ltsmce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-ltsmce').parent().find('iframe').css({"height":"130px"});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Quote"]').addClass('quote_window');
									jQuery(".quote_window .mce-foot>div").prepend("<a class='short_preview_btn quote_prevbtn'><span></span>Preview</a>");
                           jQuery('.quote_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var qauthor = jQuery('.mce-ltsmce_author').val();
                                 var qsource = jQuery('.mce-ltsmce_src').val();
                                 var thequoute = jQuery('.mce-ltsmce').val();
                                 if(thequoute ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_quote_wrap"><div class="lts_quote">'+thequoute+'</div><div class="lts_quote_author"><a target="_blank" href="'+qsource+'">'+qauthor+'</a></div></div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".quote_prev").remove();
                                 jQuery(".quote_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview quote_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".quote_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".quote_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------Divider---------------------------*/
						{
							text: 'Divider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Divider',
									width: 860,
									height: 200,
									body: [
										{
											type: 'listbox',
											name: 'ltsDividerStyle',
											label: 'Divider',
											classes: 'widget btn dvd_style',
											'values': [
												{text: 'Solid', value: 'solid'},
												{text: 'Dashed', value: 'dashed'},
												{text: 'Dotted', value: 'dotted'},
												{text: 'Double', value: 'double'}
											]
										},
										{
											type: 'textbox',
											name: 'ltsDividerHeight',
											label: 'Divider Height (in px)',
											value: '2px',
											multiline: false,
											minWidth: 300,
											classes: 'dvd_height',
										},
										{
											type: 'textbox',
											name: 'ltsDividerColor',
											label: 'Divider Color',
											classes: 'colpix dividercolor',
											value: '#eeeeee',
											multiline: false,
											minWidth: 300,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[divider style="' + e.data.ltsDividerStyle + '" height="' + e.data.ltsDividerHeight + '" color="' + e.data.ltsDividerColor + '"]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();								
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Divider"]').addClass('divider_window');
									jQuery(".divider_window .mce-foot>div").prepend("<a class='short_preview_btn divider_prevbtn'><span></span>Preview</a>");
									jQuery('.divider_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var dvd_style = jQuery('.mce-dvd_style button').text().toLowerCase();
                                 var dvd_height = jQuery('.mce-dvd_height').val();
                                 var dvd_color = jQuery('.mce-dividercolor').val();
                                 if(dvd_height ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="ast_divide" style="padding-top:7%;clear:both;border-bottom: '+dvd_height+' '+dvd_style+' '+dvd_color+'; width:100%; height:2px; margin:15px 0;"></div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".divider_prev").remove();
                                 jQuery(".divider_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview divider_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".divider_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
									   }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".divider_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
							},
							
							
						},
						
/*----------------------------Divider---------------------------*/
						{
							text: 'Title Divider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Title Divider',
									width: 860,
									height: 200,
									body: [
										{
											type: 'listbox',
											name: 'ltsTdividerStyle',
											label: 'Title Divider Icon',
											classes: 'widget btn tdvd_style',
											'values': [
												{text: 'Rhombus', value: 'fa-stop'},
												{text: 'Underline', value: 'underline'},
												{text: 'Star', value: 'fa-star'},
												{text: 'Cross', value: 'fa-times'},
												{text: 'Bolt', value: 'fa-bolt'},
												{text: 'Asterisk', value: 'fa-asterisk'},
												{text: 'Chevron', value: 'fa-chevron-down'},
												{text: 'Heart', value: 'fa-heart'},
												{text: 'Plus', value: 'fa-plus'},
												{text: 'Bookmark', value: 'fa-bookmark'},
												{text: 'Circle', value: 'fa-circle-o'},
												{text: 'Blocks', value: 'fa-th-large'},
												{text: 'Sides', value: 'fa-minus'},
												{text: 'Cog', value: 'fa-cog'},
												{text: 'Blinds', value: 'fa-reorder'},
												{text: 'Diamond', value: 'fa-diamond'},
												{text: 'Tetris', value: 'fa-gg'},
												{text: 'Digital', value: 'fa-houzz'},
												{text: 'Rocket', value: 'fa-rocket'}

											]
										},
										{
											type: 'textbox',
											name: 'ltsTdividerColor',
											label: 'Title Divider Color',
											classes: 'colpix tdvd_color',
											value: '#222222',
											multiline: false,
											minWidth: 300,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[tdivider style="' + e.data.ltsTdividerStyle + '" color="' + e.data.ltsTdividerColor + '"]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Title Divider"]').addClass('tdivider_window');
									jQuery(".tdivider_window .mce-foot>div").prepend("<a class='short_preview_btn tdivider_prevbtn'><span></span>Preview</a>");
									jQuery('.tdivider_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var tdvd_style_raw = jQuery('.mce-tdvd_style button').text()
                                 var tdvd_style = '';
                                 if(tdvd_style_raw =='Rhombus'){  var tdvd_style = 'fa-stop';  }
                                 if(tdvd_style_raw =='Star'){  var tdvd_style = 'fa-star';  }
                                 if(tdvd_style_raw =='Cross'){  var tdvd_style = 'fa-times';  }
                                 if(tdvd_style_raw =='Bolt'){  var tdvd_style = 'fa-bolt';  }
                                 if(tdvd_style_raw =='Asterisk'){  var tdvd_style = 'fa-asterisk';  }
                                 if(tdvd_style_raw =='Chevron'){  var tdvd_style = 'fa-chevron-down';  }
                                 if(tdvd_style_raw =='Heart'){  var tdvd_style = 'fa-heart';  }
                                 if(tdvd_style_raw =='Plus'){  var tdvd_style = 'fa-plus';  }
                                 if(tdvd_style_raw =='Bookmark'){  var tdvd_style = 'fa-bookmark';  }
                                 if(tdvd_style_raw =='Circle'){  var tdvd_style = 'fa-circle-o';  }
                                 if(tdvd_style_raw =='Blocks'){  var tdvd_style = 'fa-th-large';  }
                                 if(tdvd_style_raw =='Sides'){  var tdvd_style = 'fa-minus';  }
                                 if(tdvd_style_raw =='Cog'){  var tdvd_style = 'fa-cog';  }
                                 if(tdvd_style_raw =='Blinds'){  var tdvd_style = 'fa-reorder';  }
                                 
                                 if(tdvd_style_raw =='Diamond'){  var tdvd_style = 'fa-diamond';  }
                                 if(tdvd_style_raw =='Tetris'){  var tdvd_style = 'fa-gg';  }
                                 if(tdvd_style_raw =='Digital'){  var tdvd_style = 'fa-houzz';  }
                                 if(tdvd_style_raw =='Rocket'){  var tdvd_style = 'fa-rocket';  }
                                 
                                 
                                 var tdvd_color = jQuery('.mce-tdvd_color').val();
                                 if(tdvd_color ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_title_divider"><span class="div_left" style="background:'+tdvd_color+'"></span><span class="div_middle" style="color:'+tdvd_color+'"><i class="fa '+tdvd_style+'"></i></span><span class="div_right" style="background:'+tdvd_color+'"></span></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".tdivider_prev").remove();
                                 jQuery(".tdivider_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview tdivider_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".tdivider_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 jQuery('.tdivider_prev .div_middle i.fa-minus').after('<i class="fa fa-minus"></i><i class="fa fa-minus"></i>');
                                 
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".tdivider_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------Drop Cap---------------------------*/
						{
							text: 'Drop Cap',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Drop Cap',
									width: 860,
									height: 250,
									body: [
										{
											type: 'label',
											name: 'dropcapInfo',
											label: '',
											text: 'To Use this Shortcode, <a target="_blank" href="http://i.imgur.com/5nyh9MM.png">First highlight</a> the first letter of your paragraph with your mouse and then open up this <br> settings box and then select the background color and the text color of the Drop Cap from below. After selecing the <br> colors, click ok and the shortcode will be applied.',
											tooltip: 'Please Read This!',
											margin: '10 10 20 10',
											style: 'color:#5F85A0;background:aliceblue; border:1px solid #97BEDA; border-radius:5px;text-align:left; padding:2px 10px;line-height: 27px!important;',
											minWidth: 300,
											maxWidth: 780,
											minHeight: 90,
											classes: 'ltsinfo formathtml',
										},
										{
											type: 'textbox',
											name: 'dropcapBg',
											label: 'Drop Cap background Color',
											classes: 'colpix capbgcolor',
											value: '#6CAB00',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'dropCapColor',
											label: 'Drop Cap Text Color',
											classes: 'colpix captxtcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[drop_cap color="' + e.data.dropCapColor + '" background="' + e.data.dropcapBg + '"]' + tinyMCE.activeEditor.selection.getContent() + '[/drop_cap]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//CONVERT TEXT TO HTML
								jQuery(".mce-formathtml").html(jQuery(".mce-formathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								//WINDOW Styles
								optimMceWindow();
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Drop Cap"]').addClass('dropcap_window');
									jQuery(".dropcap_window .mce-foot>div").prepend("<a class='short_preview_btn dropcap_prevbtn'><span></span>Preview</a>");
									jQuery('.dropcap_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var capbgcolor = jQuery('.mce-capbgcolor').val();
										var captxtcolor = jQuery('.mce-captxtcolor').val();
										if(captxtcolor =='' && capbgcolor ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<p style="margin-top:40px;"><span style="color:'+captxtcolor+';background:'+capbgcolor+';" class="lts_dropcap">L</span>orem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibendum ac. Sed ultrices leo accumsan lacus aliquet faucibus. Pellentesque interdum convallis semper. Vivamus hendrerit rhoncus sapien aliquam dapibus. Nulla facilisi. Praesent pellentesque mollis ullamcorper. Donec eget neque est, id feugiat magna. Cras quam enim, sodales pretium posuere ac, imperdiet eu nisi. Pellentesque vitae vestibulum risus. Aenean eros leo, bibendum a convallis vel, fermentum in nisi. Aliquam euismod semper elit non cursus. Pellentesque fermentum, metus vitae tempus dignissim, erat turpis interdum lorem, vitae lobortis metus odio vel mauris. Fusce fermentum, sem facilisis lobortis dignissim, libero felis porttitor tellus, at volutpat velit erat vitae lectus.</p>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".dropcap_prev").remove();
										jQuery(".dropcap_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview dropcap_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".dropcap_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".dropcap_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},					
/*----------------------------LIST---------------------------*/
								{
							text: 'List',
							onclick: function() {
								editor.windowManager.open( {
									title: 'List',
									width: 860,
									height: 400,
									body: [
										{
											type: 'textbox',
											name: 'ltsList',
											label: 'Your List',
											value: 'Add Your Bulleted List here',
											classes: 'ltslistmce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										{
											type: 'listbox',
											name: 'listBulletStyle',
											label: 'Bullet Style',
											classes: 'widget btn liststyle',
											'values': [
												{text: 'Check', value: 'list1'},
												{text: 'Arrow 1', value: 'list2'},
												{text: 'Arrow 2', value: 'list3'},
												{text: 'Arrow 3', value: 'list4'},
												{text: 'Star', value: 'list5'},
												{text: 'Bullet', value: 'list6'}
											]
										},
										{
											type: 'textbox',
											name: 'listBulletColor',
											label: 'Bullet Color',
											classes: 'colpix listcolor',
											value: '#999999',
											multiline: false,
											minWidth: 300,
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-ltslistmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[list style="' + e.data.listBulletStyle + '" bullet_color="' + e.data.listBulletColor + '"]' + updatedHtml + '[/list]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-ltslistmce",toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist", body_id: "my_id",forced_root_block : false, menubar:false});
								jQuery('.mce-ltslistmce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-ltslistmce').parent().find('iframe').css({"height":"130px"});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="List"]').addClass('list_window');
									jQuery(".list_window .mce-foot>div").prepend("<a class='short_preview_btn list_prevbtn'><span></span>Preview</a>");
									jQuery('.list_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var list_style_raw = jQuery('.mce-liststyle button').text()
										var list_style = '';
										if(list_style_raw =='Check'){  var list_style = 'list1';  }
										if(list_style_raw =='Arrow 1'){  var list_style = 'list2';  }
										if(list_style_raw =='Arrow 2'){  var list_style = 'list3';  }
										if(list_style_raw =='Arrow 3'){  var list_style = 'list4';  }
										if(list_style_raw =='Star'){  var list_style = 'list5';  }
										if(list_style_raw =='Bullet'){  var list_style = 'list6';  }
										
										var listcontent = jQuery('.mce-ltslistmce').val();
										var list_color = jQuery('.mce-listcolor').val();
										if(listcontent ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div class="lts_list '+list_style+'" data-list-color="'+list_color+'">'+listcontent+'</div>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".list_prev").remove();
										jQuery(".list_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview list_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".list_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
										jQuery('<style>.lts_list li:before{color:'+list_color+'}</style>').appendTo('head');
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".list_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END

								
							},
							
							
						},	

/*----------------------------TOOLTIP---------------------------*/
						{
							text: 'Tooltip',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Tooltip',
									width: 860,
									height: 200,
									body: [
										{
											type: 'label',
											name: 'dropcapInfo',
											label: '',
											text: 'To Use this Shortcode, First <a target="_blank" href="http://i.imgur.com/HBBWNTb.png">select the text</a> that you want to use the tooltip on. Then open up this settings box and fill the <br> "Content on Hover" text field from below and Click Ok.',
											style: 'color:#5F85A0;background:aliceblue; border:1px solid #97BEDA; border-radius:5px;text-align:left; padding:2px 10px;line-height: 27px!important;',
											minWidth: 300,
											maxWidth: 800,
											minHeight: 70,
											classes: 'ltsinfo formathtml',
										},
										{
											type: 'textbox',
											name: 'tooltipContent',
											label: 'Content on hover',
											multiline: false,
											classes: 'ltsinfo tipcontent',
											minWidth: 300,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[tooltip tipcontent="' + e.data.tooltipContent + '"]' + tinyMCE.activeEditor.selection.getContent() + '[/tooltip]');
									}
								});
								//CONVERT TEXT TO HTML
								jQuery(".mce-formathtml").html(jQuery(".mce-formathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Tooltip"]').addClass('tooltip_window');
									jQuery(".tooltip_window .mce-foot>div").prepend("<a class='short_preview_btn tooltip_prevbtn'><span></span>Preview</a>");
									jQuery('.tooltip_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var tipcontent = jQuery('.mce-tipcontent').val();

										if(tipcontent ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<p style="margin-top:50px;">Lorem ipsum <a class="tooltip lts_tooltip"><span id="miniTip"><span id="miniTip_c">'+tipcontent+'</span><span id="miniTip_d"></span></span>Your Selected Text</a> consectetur adipiscing elit. Nam nec rhoncus risus. In ultrices lacinia ipsum, posuere faucibus velit bibendum ac. Sed ultrices leo accumsan lacus aliquet faucibus. Pellentesque interdum convallis semper. Vivamus hendrerit rhoncus sapien aliquam dapibus.</p>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".tooltip_prev").remove();
										jQuery(".tooltip_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview tooltip_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".tooltip_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".tooltip_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
							},
							
							
						},	

/*----------------------------ICONS---------------------------*/
								{
							text: 'Icons',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Icons',
									width: 860,
									height: 320,
									body: [
										{
											type: 'button', 
											label: 'Icon',
											name: 'iconIcon', 
											text: 'Select icon', 
											classes: 'btn icon_pack icon_select_pack',
											value: ''
										},
										{
											type: 'textbox', 
											label: '',
											name: 'buttonIconValue',  
											classes: 'icon_value button_icon_value',
											value: ''
										},
										{
											type: 'textbox',
											name: 'iconColor',
											label: 'Icon Color',
											classes: 'colpix iconcolor',
											value: '#999999',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'iconSize',
											label: 'Icon Size',
											value: '16px',
											classes: 'iconsize',
											tooltip: 'must be in px. eg: 16px',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'listbox',
											name: 'iconStyle',
											label: 'Style',
											classes: 'widget btn icon_style',
											'values': [
												{text: 'Plain', value: 'plain'},
												{text: 'Circle (Thin)', value: 'circle_thin'},
												{text: 'Circle (Thick)', value: 'circle_thick'},
												{text: 'Circle (Color)', value: 'circle_color'},
												{text: 'Square (Thin)', value: 'square_thin'},
												{text: 'Square (Thick)', value: 'square_thick'},
												{text: 'Square (Color)', value: 'square_color'}
											]
										},
										{
											type: 'textbox',
											name: 'iconLink',
											label: 'Icon Link',
											value: '',
											classes: 'iconlink',
											tooltip: 'A Url you want to link the Icon to',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'checkbox',
											name: 'iconLinkNew',
											classes: 'icon_link_new',
											label: 'Open Link in New Window',
											checked: true,
										}
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[icon type="' + e.data.buttonIconValue + '" color="' + e.data.iconColor + '" size="' + e.data.iconSize + '" style="' + e.data.iconStyle + '" link="' + e.data.iconLink + '" new_window="' + e.data.iconLinkNew + '" ]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//LOAD FONTAWESOME ICONS
								jQuery('.mce-icon_pack').after(appendIcons);
							
								jQuery(".mce-icon_pack").click(function() {
									jQuery('.package').fadeIn();
								});
								jQuery(".mce-icon_select_pack").parent().addClass('icon_select_parent');
									
								jQuery(".package i").click(function() {
									var iconvalue = jQuery(this).attr('class');
									jQuery(this).parent().parent().hide();
									jQuery('.mce-icon_pack button, .mce-button_icon_value').val(iconvalue);
									jQuery('.mce-icon_pack button i').remove();
									jQuery('.mce-icon_pack button').prepend('<i class="fa '+iconvalue+'"/>')
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Icons"]').addClass('icon_window');
									jQuery(".icon_window .mce-foot>div").prepend("<a class='short_preview_btn icon_prevbtn'><span></span>Preview</a>");
									jQuery('.icon_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var faicon = jQuery('.mce-button_icon_value').val();
										var faiconcolor = jQuery('.mce-iconcolor').val();
										var faiconsize = jQuery('.mce-iconsize').val();
										var faiconstyle = jQuery('.mce-icon_style button').text();
										if(faiconstyle =='Plain'){var faiconstyle = '';}
										if(faiconstyle =='Circle (Thin)'){var faiconstyle = 'circle_thin';}
										if(faiconstyle =='Circle (Thick)'){var faiconstyle = 'circle_thick';}
										if(faiconstyle =='Circle (Color)'){var faiconstyle = 'circle_color';}
										if(faiconstyle =='Square (Thin)'){var faiconstyle = 'square_thin';}
										if(faiconstyle =='Square (Thick)'){var faiconstyle = 'square_thick';}
										if(faiconstyle =='Square (Color)'){var faiconstyle = 'square_color';}
										var iconlink = jQuery('.mce-iconlink').val();

										if(faicon ==''){
											var shortcontent = '<h3 class="no_shortcode">Please Select an Icon!</h3>';
										}else{
											var shortcontent = '<p style="margin-top:50px;text-align:center;"><a href="'+iconlink+'" target="_blank"><i style="color:'+faiconcolor+';font-size:'+faiconsize+';width:'+faiconsize+';height:'+faiconsize+';" class="fa '+faicon+' icon_style_'+faiconstyle+'"></i></a></p>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".icon_prev").remove();
										jQuery(".icon_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview icon_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".icon_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".icon_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------HEADLINE---------------------------*/
								{
							text: 'Headline',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Headline',
									width: 860,
									height: 250,
									body: [
										{
											type: 'textbox',
											name: 'headlineText',
											label: 'Your Headline',
											value: 'My Glorious Headline',
											classes: 'headlinetxt',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'headlineColor',
											label: 'Headline Color',
											classes: 'colpix headlinecolor',
											value: '#999999',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'listbox',
											name: 'headlineStyle',
											label: 'Headline Style',
											classes: 'widget btn headlinestyle',
											'values': [
												{text: 'Left Aligned', value: 'type1'},
												{text: 'Center Aligned', value: 'type2'},
												{text: 'Right Aligned', value: 'type3'},
											]
										},
										{
											type: 'listbox',
											name: 'headlineSize',
											label: 'Headline Size',
											classes: 'widget btn headlinesize',
											'values': [
												{text: 'h1', value: 'h1'},
												{text: 'h2', value: 'h2'},
												{text: 'h3', value: 'h3'},
												{text: 'h4', value: 'h4'},
												{text: 'h5', value: 'h5'},
												{text: 'h6', value: 'h6'},
											]
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[headline type="' + e.data.headlineStyle + '" color="' + e.data.headlineColor + '" size="' + e.data.headlineSize + '"]' + e.data.headlineText + '[/headline]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Headline"]').addClass('headline_window');
									jQuery(".headline_window .mce-foot>div").prepend("<a class='short_preview_btn headline_prevbtn'><span></span>Preview</a>");
									jQuery('.headline_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var headlinetxt = jQuery('.mce-headlinetxt').val()
										var headlinecolor = jQuery('.mce-headlinecolor').val();
										var headlinestyle = jQuery('.mce-headlinestyle button').text();
										if(headlinestyle =='Left Aligned'){var headlinestyle = 'type1';}
										if(headlinestyle =='Center Aligned'){var headlinestyle = 'type2';}
										if(headlinestyle =='Right Aligned'){var headlinestyle = 'type3';}
										var headlinesize = jQuery('.mce-headlinesize button').text().toLowerCase()

										if(headlinetxt =='' && headlinesize ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<'+headlinesize+' class="lts_headline_parent lts_headline_'+headlinestyle+'"><span style="color:'+headlinecolor+';" class="lts_headline headline_'+headlinestyle+'">'+headlinetxt+'</span></'+headlinesize+'>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".headline_prev").remove();
										jQuery(".headline_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview headline_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".headline_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".headline_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
																				
//END	
					],
					},
//-----------------------------Content Editing Menu END-------------------------------					
					{
					text: 'Content Boxes',
					icon: 'optim_cont_box',
					menu: [
/*----------------------------SECTION---------------------------*/
								{
							text: 'Section',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Section',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'sectionmedia',
											label: 'Section Content',
											text: 'Add Media',
											classes: 'meida_btn sectionmedia',
										},

										{
											type: 'textbox',
											name: 'sectionContent',
											label: 'Section Content',
											value: '',
											classes: 'sectionmce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox', 
											name: 'sectxtcolor', 
											label: 'Section Text Color',
											classes: 'colpix sectxtcolor',
											value: '#666666',
											minWidth: 200,
										},
										{
											type: 'textbox', 
											name: 'sectionbgcolor', 
											label: 'Section Backgound Color',
											classes: 'colpix secbgcolor',
											value: '#eeeeee',
											minWidth: 200,
										},
										{
											type: 'button', 
											name: 'secbgimg', 
											text: 'Select Image', 
											label: 'Section Background Image',
											classes: 'secbgimg_button',
											tooltip: 'Click to Select the Section Background Image.',
											value: '',
											minWidth: 250,
											minHeight: 50,
										},
										
										
									],
									onsubmit: function( e ) {
									var sectionIMG = jQuery('.mce-secbgimg_button button').val();
									var getiframe = jQuery('.mce-sectionmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[section background_image="' + sectionIMG + '" text_color="' + e.data.sectxtcolor + '" background_color="' + e.data.sectionbgcolor + '"]' + updatedHtml + '[/section]');
									}
								});

								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//Author IMAGE UPLOAD
								jQuery(function($) {
									 var custom_uploader;
									 var row_id 
								
									 jQuery(".mce-secbgimg_button button").click(function(e) {
										e.preventDefault();
										row_id = jQuery(this).next().attr('id');
								
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Insert Images',
											button: {
												text: 'Insert Images'
											},
											type: 'image',
											multiple: true
										});
								
								
										custom_uploader.on('close',function(data) {
										 var imageArray = [];
										 images = custom_uploader.state().get('selection');
										 images.each(function(image) {
										imageArray.push(image.attributes.id); // want other attributes? Check the available ones with console.log(image.attributes);
										jQuery('.sectionimage').remove();
										jQuery('.mce-secbgimg_button').prepend("<img class='sectionimage' src=" +image.attributes.url+">");
										jQuery('.mce-secbgimg_button button').val(''+image.attributes.url+'');
										 });
										 
										  
										});
								
										//Open the uploader dialog
										custom_uploader.open();
								
									});
								});	
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-sectionmce', 'sectionmce');
								//Load Media Button
								optimMedia(".mce-sectionmedia",".mce-sectionmce");
								
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Section"]').addClass('section_window');
									jQuery(".section_window .mce-foot>div").prepend("<a class='short_preview_btn section_prevbtn'><span></span>Preview</a>");
									jQuery('.short_preview_btn.section_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var secontent = jQuery('.mce-sectionmce').val()
										var secolor = jQuery('.mce-sectxtcolor').val();
										var secbg = jQuery('.mce-secbgcolor').val();
										var secbgimg = jQuery('.mce-secbgimg_button button').val();

										if(secontent ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div style="background-color:'+secbg+'; color:'+secolor+';background-image:url('+secbgimg+');" class="lts_section"><div class="lts_section_body">'+secontent+'</div></div>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".short_preview.section_prev").remove();
										jQuery(".section_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview section_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".short_preview.section_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".short_preview.section_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
					
/*----------------------------BLOCKS---------------------------*/
						{
							text: 'Content Blocks',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Content Blocks',
									width: 860,
									height: 500,
									body: [
										{
											type: 'label',
											name: 'blocksLayoutlbl',
											label: '',
											text: 'Layout: ',
											minWidth: 300,
											maxWidth: 820,
											minHeight: 110,
											classes: 'blocks_layout',
										},
										{
											type: 'textbox',
											name: 'blocksLayout',
											label: '',
											value: 'layout1',
											minWidth: 300,
											maxWidth: 820,
											maxHeight: 4,
											classes: 'blocks_layout_value',
										},
										//BLOCK 1 Settings
										{
											type: 'label',
											name: 'block1Heading',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px">Block1 Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 40,
											classes: 'block1html',
										},
										{
											type: 'button',
											name: 'block1media',
											label: 'Block1 Content',
											text: 'Add Media',
											classes: 'meida_btn block1media',
										},
										{
											type: 'textbox',
											name: 'block1Content',
											label: 'Block1 Content',
											value: '',
											classes: 'blockonemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'block1BgColor',
											label: 'Block1 Background Color',
											classes: 'colpix block1bgcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'block1TxtColor',
											label: 'Block1 Text Color',
											classes: 'colpix block1color',
											value: '#999999',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'checkbox',
											name: 'block1Rounded',
											classes: 'block1rounded',
											label: 'Rounded Corner',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'block1Shadow',
											classes: 'block1shadow',
											label: 'Shadow',
											checked: true,
										},
										
										//BLOCK2 SETTINGS
										{
											type: 'label',
											name: 'block2Heading',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px">Block2 Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 40,
											classes: 'block2html',
										},
										{
											type: 'button',
											name: 'block2media',
											label: 'Block2 Content',
											text: 'Add Media',
											classes: 'meida_btn block2media',
										},
										{
											type: 'textbox',
											name: 'block2Content',
											label: 'Block2 Content',
											value: '',
											classes: 'blocktwomce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'block2BgColor',
											label: 'Block2 Background Color',
											classes: 'colpix block2bgcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'block2TxtColor',
											label: 'Block2 Text Color',
											classes: 'colpix block2color',
											value: '#999999',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'checkbox',
											name: 'block2Rounded',
											label: 'Rounded Corner',
											classes: 'block2rounded',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'block2Shadow',
											classes: 'block2shadow',
											label: 'Shadow',
											checked: true,
										},
										
										//BLOCK3 SETTINGS
										{
											type: 'label',
											name: 'block3Heading',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px">Block3 Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 40,
											classes: 'block3html',
										},
										{
											type: 'button',
											name: 'block3media',
											label: 'Block3 Content',
											text: 'Add Media',
											classes: 'meida_btn block3media',
										},
										{
											type: 'textbox',
											name: 'block3Content',
											label: 'Block3 Content',
											value: '',
											classes: 'blockthreemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'block3BgColor',
											label: 'Block3 Background Color',
											classes: 'colpix block3bgcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'block3TxtColor',
											label: 'Block3 Text Color',
											classes: 'colpix block3color',
											value: '#999999',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'checkbox',
											name: 'block3Rounded',
											label: 'Rounded Corner',
											classes: 'block3rounded',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'block3Shadow',
											classes: 'block3shadow',
											label: 'Shadow',
											checked: true,
										},
										
										//BLOCK4 SETTINGS
										{
											type: 'label',
											name: 'block4Heading',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px">Block4 Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 40,
											classes: 'block4html',
										},
										{
											type: 'button',
											name: 'block4media',
											label: 'Block4 Content',
											text: 'Add Media',
											classes: 'meida_btn block4media',
										},
										{
											type: 'textbox',
											name: 'block4Content',
											label: 'Block4 Content',
											value: '',
											classes: 'blockfourmce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'block4BgColor',
											label: 'Block4 Background Color',
											classes: 'colpix block4bgcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'block4TxtColor',
											label: 'Block4 Text Color',
											classes: 'colpix block4color',
											value: '#999999',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'checkbox',
											name: 'block4Rounded',
											classes: 'block4rounded',
											label: 'Rounded Corner',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'block4Shadow',
											classes: 'block4shadow',
											label: 'Shadow',
											checked: true,
										},
										
									],
									onsubmit: function( e ) {
									var blockOneiframe = jQuery('.mce-blockonemce').parent().find('iframe').attr('id');
									var blockOneHtml = jQuery('#' + blockOneiframe + '').contents().find('body').html();
									var blockTwoiframe = jQuery('.mce-blocktwomce').parent().find('iframe').attr('id');
									var blockTwoHtml = jQuery('#' + blockTwoiframe + '').contents().find('body').html();
									var blockThreeiframe = jQuery('.mce-blockthreemce').parent().find('iframe').attr('id');
									var blockThreeHtml = jQuery('#' + blockThreeiframe + '').contents().find('body').html();
									var blockFouriframe = jQuery('.mce-blockfourmce').parent().find('iframe').attr('id');
									var blockFourHtml = jQuery('#' + blockFouriframe + '').contents().find('body').html();
									
										editor.insertContent( '[blocks layout="'+e.data.blocksLayout+'"]<br>[block background="'+e.data.block1BgColor+'" text_color="'+e.data.block1TxtColor+'" rounded="'+e.data.block1Rounded+'" shadow="'+e.data.block1Shadow+'"]' + blockOneHtml + '[/block]<br><br>[block background="'+e.data.block2BgColor+'" text_color="'+e.data.block2TxtColor+'" rounded="'+e.data.block2Rounded+'" shadow="'+e.data.block2Shadow+'"]' + blockTwoHtml + '[/block]<br><br>[block background="'+e.data.block3BgColor+'" text_color="'+e.data.block3TxtColor+'" rounded="'+e.data.block3Rounded+'" shadow="'+e.data.block3Shadow+'"]' + blockThreeHtml + '[/block]<br><br>[block background="'+e.data.block4BgColor+'" text_color="'+e.data.block4TxtColor+'" rounded="'+e.data.block4Rounded+'" shadow="'+e.data.block4Shadow+'"]' + blockFourHtml + '[/block]<br>[/blocks]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//CONVERT TEXT TO HTML
								jQuery(".mce-block1html").html(jQuery(".mce-block1html").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-block2html").html(jQuery(".mce-block2html").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-block3html").html(jQuery(".mce-block3html").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-block4html").html(jQuery(".mce-block4html").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								
								//LOAD INNER TINYMCE
								optimTinyHeavy(".mce-blockonemce", "blockonemce");
								optimTinyHeavy(".mce-blocktwomce", "blocktwomce");
								optimTinyHeavy(".mce-blockthreemce", "blockthreemce");
								optimTinyHeavy(".mce-blockfourmce", "blockfourmce");

								//Load Media Button
								optimMedia(".mce-block1media",".mce-blockonemce");
								optimMedia(".mce-block2media",".mce-blocktwomce");
								optimMedia(".mce-block3media",".mce-blockthreemce");
								optimMedia(".mce-block4media",".mce-blockfourmce");
								
								//load window styles
								optimMceWindow();
								
								//BLOCKS LAYOUT
								jQuery(".mce-blocks_layout").append('<div class="blocks_layout"><span data-value="layout1" class="block1_layout block_active"><i></i></span><span data-value="layout2" class="block2_layout"><i></i><i></i></span><span data-value="layout3" class="block3_layout"><i></i><i></i><i></i></span><span data-value="layout4" class="block4_layout"><i></i><i></i><i></i><i></i></span><span data-value="layout5" class="block5_layout"><i></i><i></i><i></i></span><span data-value="layout6" class="block6_layout"><i></i><i></i><i></i></span><span data-value="layout7" class="block7_layout"><i></i><i></i></span><span data-value="layout8" class="block8_layout"><i></i><i></i></span></div>');
								jQuery(".blocks_layout span").click(function() {
									jQuery(".blocks_layout span").removeClass('block_active');
                                    jQuery(this).addClass('block_active');
									jQuery(".mce-blocks_layout_value").val(jQuery(this).data("value"));
                                });
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Content Blocks"]').addClass('blocks_window');
									jQuery(".blocks_window .mce-foot>div").prepend("<a class='short_preview_btn blocks_prevbtn'><span></span>Preview</a>");
									jQuery('.blocks_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var blockslayout = jQuery('.mce-blocks_layout_value').val();
										var block1content = jQuery('.mce-blockonemce').val();
										var block1color = jQuery('.mce-block1color').val();
										var block1bg = jQuery('.mce-block1bgcolor').val();
										var block1_roundedval = jQuery('.mce-block1rounded').attr("aria-checked");
										var block1_rounded ='';
										if(block1_roundedval =='true'){var block1_rounded = 'lt_rounded';}
										var block1_shadowval = jQuery('.mce-block1shadow').attr("aria-checked");
										var block1_shadow ='';
										if(block1_shadowval =='true'){var block1_shadow = 'lt_shadow';}
										
										var block2content = jQuery('.mce-blocktwomce').val();
										var block2color = jQuery('.mce-block2color').val();
										var block2bg = jQuery('.mce-block2bgcolor').val();
										var block2_roundedval = jQuery('.mce-block2rounded').attr("aria-checked");
										var block2_rounded ='';
										if(block2_roundedval =='true'){var block2_rounded = 'lt_rounded';}
										var block2_shadowval = jQuery('.mce-block2shadow').attr("aria-checked");
										var block2_shadow ='';
										if(block2_shadowval =='true'){var block2_shadow = 'lt_shadow';}
										
										var block3content = jQuery('.mce-blockthreemce').val();
										var block3color = jQuery('.mce-block3color').val();
										var block3bg = jQuery('.mce-block3bgcolor').val();
										var block3_roundedval = jQuery('.mce-block3rounded').attr("aria-checked");
										var block3_rounded ='';
										if(block3_roundedval =='true'){var block3_rounded = 'lt_rounded';}
										var block3_shadowval = jQuery('.mce-block3shadow').attr("aria-checked");
										var block3_shadow ='';
										if(block3_shadowval =='true'){var block3_shadow = 'lt_shadow';}
										
										var block4content = jQuery('.mce-blockfourmce').val();
										var block4color = jQuery('.mce-block4color').val();
										var block4bg = jQuery('.mce-block4bgcolor').val();
										var block4_roundedval = jQuery('.mce-block4rounded').attr("aria-checked");
										var block4_rounded ='';
										if(block4_roundedval =='true'){var block4_rounded = 'lt_rounded';}
										var block4_shadowval = jQuery('.mce-block4shadow').attr("aria-checked");
										var block4_shadow ='';
										if(block4_shadowval =='true'){var block4_shadow = 'lt_shadow';}
										

										if(block1content ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div class="lts_blocks lts_blocks_'+blockslayout+'"><div class="lts_block '+block1_shadow+' '+block1_rounded+'" style="background:'+block1bg+';color:'+block1color+';">'+block1content+'</div><div class="lts_block '+block2_shadow+' '+block2_rounded+'" style="background:'+block2bg+';color:'+block2color+';">'+block2content+'</div><div class="lts_block '+block3_shadow+' '+block3_rounded+'" style="background:'+block3bg+';color:'+block3color+';">'+block3content+'</div><div class="lts_block '+block4_shadow+' '+block4_rounded+'" style="background:'+block4bg+';color:'+block4color+';">'+block4content+'</div></div>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".blocks_prev").remove();
										jQuery(".blocks_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview blocks_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".blocks_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".blocks_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
								
							},
							
							
						},
/*----------------------------TABS---------------------------*/
						{
							text: 'Tabs',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Tabs',
									width: 860,
									height: 500,
									body: [
										{
											type: 'label',
											name: 'tabstyleHeading',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px">Tab Style Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;margin-bottom:10px;',
											minWidth: 300,
											maxWidth: 820,
											minHeight: 40,
											classes: 'tabshtml',
										},
										{
											type: 'listbox',
											name: 'ltsTabsStyle',
											label: 'Style',
											classes: 'widget btn tabs_style',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Circular', value: 'circular'},
												{text: 'Minimal', value: 'minimal'},
												{text: 'Capsule', value: 'capsule'}
											]
										},
										
										{
											type: 'textbox',
											name: 'tabActiveColor',
											label: 'Active Tab Color',
											classes: 'colpix tabactive',
											value: '#119BFF',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'label',
											name: 'tabstyleHeadingend',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold; padding-top:10px"> </h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;margin-bottom:20px;',
											minWidth: 300,
											maxWidth: 820,
											minHeight: 30,
											classes: 'tabshtmlend',
										},
									//TAB 1
										{
											type: 'textbox',
											name: 'tab1Title',
											label: 'Tab 1 Title',
											classes: 'tab1tt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'button',
											name: 'tab1media',
											label: 'Tab 1 Content',
											text: 'Add Media',
											classes: 'meida_btn tab1media',
										},
										{
											type: 'textbox',
											name: 'tab1Content',
											label: 'Tab 1 Content',
											value: '',
											classes: 'tabonemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
									//TAB 2
										{
											type: 'textbox',
											name: 'tab2Title',
											label: 'Tab 2 Title',
											classes: 'tab2tt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'button',
											name: 'tab2media',
											label: 'Tab 2 Content',
											text: 'Add Media',
											classes: 'meida_btn tab2media',
										},
										{
											type: 'textbox',
											name: 'tab2Content',
											label: 'Tab 2 Content',
											value: '',
											classes: 'tabtwomce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
									//TAB 3
										{
											type: 'textbox',
											name: 'tab3Title',
											label: 'Tab 3 Title',
											classes: 'tab3tt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'button',
											name: 'tab3media',
											label: 'Tab 3 Content',
											text: 'Add Media',
											classes: 'meida_btn tab3media',
										},
										{
											type: 'textbox',
											name: 'tab3Content',
											label: 'Tab 3 Content',
											value: '',
											classes: 'tabthreemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
									//TAB 4
										{
											type: 'textbox',
											name: 'tab4Title',
											label: 'Tab 4 Title',
											classes: 'tab4tt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'button',
											name: 'tab4media',
											label: 'Tab 4 Content',
											text: 'Add Media',
											classes: 'meida_btn tab4media',
										},
										{
											type: 'textbox',
											name: 'tab4Content',
											label: 'Tab 4 Content',
											value: '',
											classes: 'tabfourmce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
									//TAB 5
										{
											type: 'textbox',
											name: 'tab5Title',
											label: 'Tab 5 Title',
											classes: 'tab5tt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'button',
											name: 'tab5media',
											label: 'Tab 5 Content',
											text: 'Add Media',
											classes: 'meida_btn tab5media',
										},
										{
											type: 'textbox',
											name: 'tab5Content',
											label: 'Tab 5 Content',
											value: '',
											classes: 'tabfivemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										
									],
									onsubmit: function( e ) {
									var tabOneiframe = jQuery('.mce-tabonemce').parent().find('iframe').attr('id');
									var tabOneHtml = jQuery('#' + tabOneiframe + '').contents().find('body').html();
									var tabTwoiframe = jQuery('.mce-tabtwomce').parent().find('iframe').attr('id');
									var tabTwoHtml = jQuery('#' + tabTwoiframe + '').contents().find('body').html();
									var tabThreeiframe = jQuery('.mce-tabthreemce').parent().find('iframe').attr('id');
									var tabThreeHtml = jQuery('#' + tabThreeiframe + '').contents().find('body').html();
									var tabFouriframe = jQuery('.mce-tabfourmce').parent().find('iframe').attr('id');
									var tabFourHtml = jQuery('#' + tabFouriframe + '').contents().find('body').html();
									var tabFiveiframe = jQuery('.mce-tabfivemce').parent().find('iframe').attr('id');
									var tabFiveHtml = jQuery('#' + tabFiveiframe + '').contents().find('body').html();
									
										editor.insertContent( '[tabs style="' + e.data.ltsTabsStyle + '" active_color="' + e.data.tabActiveColor + '" titles="' + e.data.tab1Title + ', ' + e.data.tab2Title + ', ' + e.data.tab3Title + ', ' + e.data.tab4Title + ' ' + e.data.tab5Title + '"]<br>[tab]'+tabOneHtml+'[/tab]<br>[tab]'+tabTwoHtml+'[/tab]<br>[tab]'+tabThreeHtml+'[/tab]<br>[tab]'+tabFourHtml+'[/tab]<br>[tab]'+tabFiveHtml+'[/tab]<br>[/tabs]');
									}
								});
								
								//Tabs style title
								jQuery(".mce-tabshtml").html(jQuery(".mce-tabshtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-tabshtmlend").html(jQuery(".mce-tabshtmlend").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );

								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-tabonemce', 'tabonemce');
								optimTinyHeavy('.mce-tabtwomce', 'tabtwomce');
								optimTinyHeavy('.mce-tabthreemce', 'tabthreemce');
								optimTinyHeavy('.mce-tabfourmce', 'tabfourmce');
								optimTinyHeavy('.mce-tabfivemce', 'tabfivemce');
								
								//Media Buttons
								optimMedia('.mce-tab1media','.mce-tabonemce');
								optimMedia('.mce-tab2media', '.mce-tabtwomce');
								optimMedia('.mce-tab3media', '.mce-tabthreemce');
								optimMedia('.mce-tab4media', '.mce-tabfourmce');
								optimMedia('.mce-tab5media', '.mce-tabfivemce');
								
								//CALL THE COLORPICKER
								optimColpick();		
								
								//Window Style
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Tabs"]').addClass('tabs_window');
									jQuery(".tabs_window .mce-foot>div").prepend("<a class='short_preview_btn tabs_prevbtn'><span></span>Preview</a>");
									jQuery('.tabs_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var tabs_style = jQuery('.mce-tabs_style button').text().toLowerCase();
                                 var active_color = jQuery('.mce-tabactive').val();
                                 
                                 var tab1tt = jQuery('.mce-tab1tt').val();
                                 var tabonemce = jQuery('.mce-tabonemce').val();

                                 var tab2tt = jQuery('.mce-tab2tt').val();
                                 var tabtwomce = jQuery('.mce-tabtwomce').val();

                                 var tab3tt = jQuery('.mce-tab3tt').val();
                                 var tabthreemce = jQuery('.mce-tabthreemce').val();
                                 
                                 var tab4tt = jQuery('.mce-tab4tt').val();
                                 var tabfourmce = jQuery('.mce-tabfourmce').val();
                                 
                                 var tab5tt = jQuery('.mce-tab5tt').val();
                                 var tabfivemce = jQuery('.mce-tabfivemce').val();
                                 
                                 if(tab1tt !==''){ var tab1tt ='<li class="tabli lts_tabtitle"><a href="#">'+tab1tt+'</a></li>';}
                                 if(tab2tt !==''){ var tab2tt ='<li class="tabli lts_tabtitle"><a href="#">'+tab2tt+'</a></li>';}
                                 if(tab3tt !==''){ var tab3tt ='<li class="tabli lts_tabtitle"><a href="#">'+tab3tt+'</a></li>';}
                                 if(tab4tt !==''){ var tab4tt ='<li class="tabli lts_tabtitle"><a href="#">'+tab4tt+'</a></li>';}
                                 if(tab5tt !==''){ var tab5tt ='<li class="tabli lts_tabtitle"><a href="#">'+tab5tt+'</a></li>';}
                                 
                                 if(tabonemce !==''){ var tabonemce ='<div class="lts_tab_child">'+tabonemce+'</div>';}
                                 if(tabtwomce !==''){ var tabtwomce ='<div class="lts_tab_child">'+tabtwomce+'</div>';}
                                 if(tabthreemce !==''){ var tabthreemce ='<div class="lts_tab_child">'+tabthreemce+'</div>';}
                                 if(tabfourmce !==''){ var tabfourmce ='<div class="lts_tab_child">'+tabfourmce+'</div>';}
                                 if(tabfivemce !==''){ var tabfivemce ='<div class="lts_tab_child">'+tabfivemce+'</div>';}
                                 

                                 if(tab1tt ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="tabs-container lts_tabs tabs_'+tabs_style+' " data-active-color="'+active_color+'"><ul class="tabs ">'+tab1tt+' '+tab2tt+' '+tab3tt+' '+tab4tt+' '+tab5tt+'</ul><div class="lts_tab">'+tabonemce+' '+tabtwomce+' '+tabthreemce+' '+tabfourmce+' '+tabfivemce+'</div></div><div style="clear:both"></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".tabs_prev").remove();
                                 jQuery(".tabs_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview tabs_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".tabs_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
   //load nivoslider
                              jQuery.getScript("https://cdnjs.cloudflare.com/ajax/libs/jquery.easytabs/3.2.0/jquery.easytabs.min.js", function(){ 
                                 //Tabs Javascript
                                 jQuery(".lts_tab p:empty").remove();
                                 jQuery(".lts_tabs .lts_tabtitle.emptyp_clear").remove();
                                 var i = 1; 
                                 jQuery(".tabs-container .tabli a").each(function (){jQuery(this).attr('href', '#tab-'+i+''); i++;});
                                    
                                 var i = 1; 
                                 jQuery(".lts_tab > div").each(function (){jQuery(this).attr('id', 'tab-'+i+''); i++;});
                                    
                                 var i = 1; 
                                 jQuery(".tabs-container").each(function (){jQuery(this).attr('id', 'tabs-container_'+i+''); i++;});
                                 
                                 jQuery(".tabs-container.tabs_default").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
                                    jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+active_color+'!important;border-color:'+active_color+'}</style>').appendTo('head');
                                 });
                                    jQuery(".tabs-container.tabs_circular").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
                                    jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:#fff!important;background:'+active_color+'}</style>').appendTo('head');
                                 });
                                    jQuery(".tabs-container.tabs_minimal").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
                                    jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:'+active_color+'!important;border-color:'+active_color+';background:transparent;}</style>').appendTo('head');
                                 });
                                    jQuery(".tabs-container.tabs_capsule").each(function (){ var tabid = jQuery(this).attr('id'); var active_color = jQuery(this).data('active-color');
                                    jQuery('<style>body #'+tabid+' ul.tabs li.active a{color:#fff!important;background:'+active_color+';border-color:'+active_color+'}</style>').appendTo('head');
                                 });
                                 
                                 jQuery('#tabs-container_1, #tabs-container_2, #tabs-container_3').easytabs();
                              });
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".tabs_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END



							},

						},
/*----------------------------TOGGLE---------------------------*/
								{
							text: 'Toggle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Toggle',
									width: 860,
									height: 500,
									body: [
										{
											type: 'textbox',
											name: 'toggleTitle',
											label: 'Toggle Title',
											classes: 'togglett',
											value: '',
											multiline: false,
											minWidth: 400,
										},
										{
											type: 'button',
											name: 'togglemedia',
											label: 'Toggle Content',
											text: 'Add Media',
											classes: 'meida_btn togglemedia',
										},
										{
											type: 'textbox',
											name: 'toggleContent',
											label: 'Your Toggle Content',
											value: 'Add Your Toggle Content Here',
											classes: 'togglemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-togglemce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[toggle title="' + e.data.toggleTitle + '"]' + updatedHtml + '[/toggle]');
									}
								});
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-togglemce', 'toggle_mce');
								
								//Media Buttons
								optimMedia('.mce-togglemedia','.mce-togglemce');
								
								//Window Style
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Toggle"]').addClass('toggle_window');
									jQuery(".toggle_window .mce-foot>div").prepend("<a class='short_preview_btn toggle_prevbtn'><span></span>Preview</a>");
									jQuery('.toggle_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var togglett = jQuery('.mce-togglett').val();
										var togglemce = jQuery('.mce-togglemce').val();

										
										if(togglemce == '' || togglett== ''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div class="lts_toggle"><div class="trigger_wrap"><a class="trigger"><i class="fa fa-plus"></i> '+togglett+'</a></div><div class="lts_toggle_content" style="display:none;">'+togglemce+'</div></div><div style="clear:both"></div>';
										}
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".toggle_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
										jQuery(".toggle_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview toggle_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".toggle_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
										//TOGGLE FUNCTION
										jQuery('.lts_toggle_content').hide(); // Hide even though it's already hidden
										jQuery('.trigger').click(function() {
										jQuery(this).closest('.lts_toggle').find('.lts_toggle_content').slideToggle("fast"); 
										  return false;
									   });
										jQuery('.lts_toggle a.trigger').on('click',function(){
											jQuery(this).find('i').animateRotate(135);
											jQuery(this).addClass('down');
										}, function(){
											jQuery(this).find('i').animateRotate(-90);
											jQuery(this).removeClass('down');	
										});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".toggle_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                           }
									});
									}, 500);
									//PREVIEW END

								
							},
							
							
						},	
/*----------------------------PANEL---------------------------*/
								{
							text: 'Panel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Panel',
									width: 860,
									height: 500,
									body: [
										{
											type: 'textbox',
											name: 'panelTitle',
											label: 'Panel Title',
											classes: 'paneltitle',
											value: '',
											multiline: false,
											minWidth: 400,
										},
										{
											type: 'button',
											name: 'panelmedia',
											label: 'Panel Content',
											text: 'Add Media',
											classes: 'meida_btn panelmedia',
										},
										{
											type: 'textbox',
											name: 'panelContent',
											label: 'Panel Content',
											value: 'Add Your Panel Content Here',
											classes: 'panelmce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'panelBgColor',
											label: 'Panel head Background Color',
											classes: 'colpix panelbg',
											value: '#32a1f0',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'panelTxtColor',
											label: 'Panel head Text Color',
											classes: 'colpix panelcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-panelmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();

										editor.insertContent( '[panel title="' + e.data.panelTitle + '" background_color="' + e.data.panelBgColor + '" text_color="' + e.data.panelTxtColor + '"]' + updatedHtml + '[/panel]');
									}
								});
								
								
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-panelmce', 'panel_mce');
								
								//Media Buttons
								optimMedia('.mce-panelmedia','.mce-panelmce');
								
								//Window Style
								optimMceWindow();
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Panel"]').addClass('panel_window');
									jQuery(".panel_window .mce-foot>div").prepend("<a class='short_preview_btn panel_prevbtn'><span></span>Preview</a>");
									jQuery('.panel_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var paneltitle = jQuery('.mce-paneltitle').val();
                                 var panelcontent = jQuery('.mce-panelmce').val();
                                 var panelbg = jQuery('.mce-panelbg').val();
                                 var panelcolor = jQuery('.mce-panelcolor').val();

                                 if(panelcontent ==''){
                                    var shortcontent = '<h3 class="no_shortcode">Please Select an Icon!</h3>';
                                 }else{
                                    var shortcontent = '<div style="border-color:'+panelbg+'" class="lts_panel"><h3 style="background-color:'+panelbg+';color:'+panelcolor+'">'+paneltitle+'</h3><div class="lts_panel_body">'+panelcontent+'</div></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".panel_prev").remove();
                                 jQuery(".panel_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview panel_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".panel_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".panel_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------CALL TO ACTION---------------------------*/
								{
							text: 'Call to Action',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Call to Action',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'ctamedia',
											label: 'Call to Action Message',
											text: 'Add Media',
											classes: 'meida_btn ctamedia',
										},
										{
											type: 'textbox',
											name: 'ctaContent',
											label: 'Call to Action Message',
											value: 'Add Your Call to Action Message Here',
											classes: 'ctamce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox',
											name: 'ctaBtnTxt',
											label: 'Button Text',
											classes: 'ctabtntxt',
											value: '',
											multiline: false,
											minWidth: 400,
										},
										{
											type: 'textbox',
											name: 'ctaBtnUrl',
											label: 'Button Link',
											classes: 'ctabtnlink',
											value: '',
											multiline: false,
											minWidth: 400,
										},
										{
											type: 'textbox',
											name: 'ctaBgColor',
											label: 'CTA Background Color',
											classes: 'colpix ctabg',
											value: '#333333',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'ctaTxtColor',
											label: 'CTA Text Color',
											classes: 'colpix ctacolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'ctaBtnBgColor',
											label: 'CTA Button Background Color',
											classes: 'colpix ctabtnbg',
											value: '#32a1f0',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'ctaBtnTxtColor',
											label: 'CTA Button Text Color',
											classes: 'colpix ctabtncolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'checkbox',
											name: 'ctaRounded',
											label: 'Rounded Corner',
											classes: 'ctabtnround',
											checked: true,
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-ctamce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[callaction button_text="' + e.data.ctaBtnTxt + '" button_url="' + e.data.ctaBtnUrl + '" background_color="' + e.data.ctaBgColor + '" text_color="' + e.data.ctaTxtColor + '" button_background_color="' + e.data.ctaBtnBgColor + '" button_text_color="' + e.data.ctaBtnTxtColor + '" rounded="' + e.data.ctaRounded + '"]' + updatedHtml + '[/callaction]');
									}
								});
								
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								
									//LOAD INNER TINYMCE
									optimTinyHeavy('.mce-ctamce', 'cta_mce');
									
									//MEDIA BUTTON
									optimMedia('.mce-ctamedia','.mce-ctamce');
									
									//WINDOW Styles
									optimMceWindow();
									
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Call to Action"]').addClass('cta_window');
									jQuery(".cta_window .mce-foot>div").prepend("<a class='short_preview_btn cta_prevbtn'><span></span>Preview</a>");
									jQuery('.cta_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var ctacontent = jQuery('.mce-ctamce').val();
                                 var ctabtntxt = jQuery('.mce-ctabtntxt').val();
                                 var ctabtnlink = jQuery('.mce-ctabtnlink').val();
                                 var ctabg = jQuery('.mce-ctabg').val();
                                 var ctacolor = jQuery('.mce-ctacolor').val();
                                 var ctabtnbg = jQuery('.mce-ctabtnbg').val();
                                 var ctabtncolor = jQuery('.mce-ctabtncolor').val();
                                 var ctabtnroundval = jQuery('.mce-ctabtnround').attr("aria-checked");
                                 var ctabtnround ='0';
                                 if(ctabtnroundval =='true'){var ctabtnround = "lt_rounded";}

                                 
                                 if(ctacontent ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div style="background:'+ctabg+';color:'+ctacolor+'!important;" class="ast_shrt_action ' + ctabtnround+'"><div class="act_left">'+ctacontent+'</div><div class="act_right"><a class="'+ctabtnround+'" style="background:'+ctabtnbg+';color:'+ctabtncolor+'!important;" href="'+ctabtnlink+'">'+ctabtntxt+'</a></div></div><div style="clear:both"></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".cta_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                                 jQuery(".cta_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview cta_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".cta_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
                                 jQuery('.lts_lightbox_bttn').on("click",function(){  jQuery('<div class="lts_lightbox_content"><span onclick="closeclick();" class="ltsclose">×</span>'+lightboxmce+'</div><div class="lts_lightbox_blank"></div>').appendTo('body');  });
                                 
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".cta_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},																					
/*----------------------------Success Message Box---------------------------*/
								{
							text: 'Success Message Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Success Message Box',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'successContent',
											label: 'Success Message',
											value: 'Add Your Success Message Here',
											classes: 'successmce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-successmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[success]' + updatedHtml + '[/success]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-successmce",toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist", body_id: "success_mce",forced_root_block : false, menubar:false});
								jQuery('.mce-successmce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-successmce').parent().find('iframe').css({"height":"130px"});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Success Message Box"]').addClass('success_window');
									jQuery(".success_window .mce-foot>div").prepend("<a class='short_preview_btn success_prevbtn'><span></span>Preview</a>");
									jQuery('.success_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var content = jQuery('.mce-successmce').val();

                                 if(content ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_scs">'+content+'</div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".success_prev").remove();
                                 jQuery(".success_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview success_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".success_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".success_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END

							},
							
							
						},
/*----------------------------Info Message Box---------------------------*/
								{
							text: 'Info Message Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Info Message Box',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'infoContent',
											label: 'Info Message',
											value: 'Add Your Info Message Here',
											classes: 'infomce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-infomce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[info]' + updatedHtml + '[/info]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-infomce",toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist", body_id: "info_mce",forced_root_block : false, menubar:false});
								jQuery('.mce-infomce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-infomce').parent().find('iframe').css({"height":"130px"});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Info Message Box"]').addClass('info_window');
									jQuery(".info_window .mce-foot>div").prepend("<a class='short_preview_btn info_prevbtn'><span></span>Preview</a>");
									jQuery('.info_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var content = jQuery('.mce-infomce').val();

                                 if(content ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_info">'+content+'</div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".info_prev").remove();
                                 jQuery(".info_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview info_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".info_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".info_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
							},
							
							
						},
/*----------------------------Warning Message Box---------------------------*/
								{
							text: 'Warning Message Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Warning Message Box',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'warningContent',
											label: 'Warning Message',
											value: 'Add Your Warning Message Here',
											classes: 'warningmce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-warningmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[warning]' + updatedHtml + '[/warning]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-warningmce",toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist", body_id: "info_mce",forced_root_block : false, menubar:false});
								jQuery('.mce-warningmce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-warningmce').parent().find('iframe').css({"height":"130px"});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Warning Message Box"]').addClass('warning_window');
									jQuery(".warning_window .mce-foot>div").prepend("<a class='short_preview_btn warning_prevbtn'><span></span>Preview</a>");
									jQuery('.warning_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var content = jQuery('.mce-warningmce').val();

                                 if(content ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_wng">'+content+'</div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".warning_prev").remove();
                                 jQuery(".warning_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview warning_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".warning_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".warning_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------Error Message Box---------------------------*/
								{
							text: 'Error Message Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Error Message Box',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'errorContent',
											label: 'Error Message',
											value: 'Add Your Error Message Here',
											classes: 'errormce',
											multiline: true,
											minWidth: 300,
											minHeight: 200
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-errormce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[error]' + updatedHtml + '[/error]');
									}
								});
								//LOAD INNER TINYMCE
								tinymce.init({selector: ".mce-errormce",toolbar: " bold italic underline strikethrough alignleft aligncenter alignright alignjustify bullist numlist", body_id: "error_mce",forced_root_block : false, menubar:false});
								jQuery('.mce-errormce').prev().css({"border":"1px solid #eee"});
								jQuery('.mce-errormce').parent().find('iframe').css({"height":"130px"});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Error Message Box"]').addClass('error_window');
									jQuery(".error_window .mce-foot>div").prepend("<a class='short_preview_btn error_prevbtn'><span></span>Preview</a>");
									jQuery('.error_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var content = jQuery('.mce-errormce').val();

                                 if(content ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_err">'+content+'</div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".error_prev").remove();
                                 jQuery(".error_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview error_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".error_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".error_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
																									
//END	
					],
					},
//-----------------------------Content Boxes Menu END-------------------------------
//-----------------------------SLIDER & CAROUSEL MENU START-------------------------------					
					{
					text: 'Slider & Carousel',
					icon: 'optim_cont_sldie',
					menu: [
/*----------------------------SLIDER---------------------------*/
								{
							text: 'Slider',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Slider',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button', 
											name: 'sliderButton', 
											text: 'Select Images', 
											classes: 'slide_button',
											tooltip: 'Click to Select Images. A New Window will appear. Hold down ctrl key to select multiple images.',
											value: '',
											minWidth: 550,
											minHeight: 250,
										},
										{
											type: 'textbox',
											name: 'sliderImages',
											value: '',
											multiline: true,
											minWidth: 150,
											classes: 'slide_images',
										},
										{
											type: 'listbox',
											name: 'sliderTransition',
											label: 'Slider Animation',
											classes: 'widget btn slide_trans',
											'values': [
												{text: 'Fade', value: 'fade'},
												{text: 'Slide', value: 'slideInLeft'},
												{text: 'Fold', value: 'fold'},
												{text: 'Random', value: 'random'},
											]
										},
										{
											type: 'textbox',
											name: 'sliderTime',
											label: 'Pause Time',
											classes: 'slide_time',
											value: '3000',
											multiline: false,
											minWidth: 150,
											tooltip: 'Pause Time Between Each slide. In milliseconds'
										},
										{
											type: 'checkbox',
											name: 'sliderAuto',
											label: 'Auto Play',
											classes: 'slide_auto',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'sliderNav',
											label: 'Slider Navigation',
											classes: 'slide_nav',
											checked: true,
										},
										
									],
									onsubmit: function( e ) {
										var newSlideImages = jQuery('.mce-slide_images').html();
										editor.insertContent( '[slider effect="' + e.data.sliderTransition + '" pausetime="' + e.data.sliderTime + '" autoplay="' + e.data.sliderAuto + '" navigation="' + e.data.sliderNav + '"]' + newSlideImages + '[/slider]');
									}
								});

								//SLIDER IMAGE UPLOAD
								jQuery(function($) {
									 var custom_uploader;
									 var row_id 
								
									 jQuery(".mce-slide_button").click(function(e) {
										e.preventDefault();
										row_id = jQuery(this).next().attr('id');
								
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Insert Images',
											button: {
												text: 'Insert Images'
											},
											type: 'image',
											multiple: true
										});
								
								
										custom_uploader.on('close',function(data) {
										 var imageArray = [];
										 images = custom_uploader.state().get('selection');
										 images.each(function(image) {
										imageArray.push(image.attributes.id); // want other attributes? Check the available ones with console.log(image.attributes);
										jQuery('.mce-slide_button').append("<img class='sldimg' src=" +image.attributes.url+" />");
										jQuery('.mce-slide_button button').hide();
										jQuery('.mce-slide_images').append("<img class='sldimg' src=" +image.attributes.url+" />");
										 });
										 
										  
										});
								
										//Open the uploader dialog
										custom_uploader.open();
								
									});
								});	
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Slider"]').addClass('slider_window');
									jQuery(".slider_window .mce-foot>div").prepend("<a class='short_preview_btn slider_prevbtn'><span></span>Preview</a>");
									jQuery('.slider_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var slide_images = jQuery('.mce-slide_images').html();
                                 var slide_trans = jQuery('.mce-slide_trans button').text().toLowerCase().replace(/ /g,"_");
                                 var slide_time = jQuery('.mce-slide_time').val();
                                 var slide_auto_val = jQuery('.mce-slide_auto').attr("aria-checked");
                                 var slide_auto ='false'; if(slide_auto_val =='true'){var slide_auto = 'true';}
                                 var slide_nav_val = jQuery('.mce-slide_nav').attr("aria-checked");
                                 var slide_nav ='false'; if(slide_nav_val =='true'){var slide_nav = 'true';}
                                 
                                 if(slide_images ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="ast_slide_wrap"><div class="ast_slider">'+slide_images+'</div></div>';
                                 }
                              //load nivoslider
                              jQuery.getScript("https://cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js", function(){ 
               jQuery(".ast_slider").nivoSlider({ effect :slide_trans, pauseTime: slide_time, directionNav: slide_nav, autoplay:slide_auto,pauseOnHover:false, slices:7,controlNav:false}); 
                                 });
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".slider_prev").remove();
                                 jQuery(".slider_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview slider_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".slider_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
                                 
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".slider_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
															
							},
							
							
						},
						
/*----------------------------CAROUSEL---------------------------*/
								{
							text: 'Carousel',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Carousel',
									width: 860,
									height: 500,
									body: [
										{
											type: 'listbox',
											name: 'carouselStyle',
											label: 'Style',
											'values': [
												{text: 'Default', value: 'default'},
												{text: 'Simple', value: 'simple'},
												{text: 'Thick Border', value: 'thick_border'},
											]
										},
										{
											type: 'textbox',
											name: 'carouselBgColor',
											label: 'Carousel Background Color',
											classes: 'colpix dividercolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'carouselTxtColor',
											label: 'Carousel Text Color',
											classes: 'colpix dividercolor',
											value: '#999999',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'carouselBtnColor',
											label: 'Carousel Navigation Button Color',
											classes: 'colpix dividercolor',
											value: '#eeeeee',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'button',
											name: 'carosel1media',
											label: 'Carousel Item 1 Content',
											text: 'Add Media',
											classes: 'meida_btn carosel1media',
										},
										{
											type: 'textbox',
											name: 'carousel1Content',
											label: 'Carousel 1 Content',
											value: '',
											classes: 'carouselonemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'button',
											name: 'carosel2media',
											label: 'Carousel Item 2 Content',
											text: 'Add Media',
											classes: 'meida_btn carosel2media',
										},
										{
											type: 'textbox',
											name: 'carousel2Content',
											label: 'Carousel 2 Content',
											value: '',
											classes: 'carouseltwomce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'button',
											name: 'carosel3media',
											label: 'Carousel Item 3 Content',
											text: 'Add Media',
											classes: 'meida_btn carosel3media',
										},
										{
											type: 'textbox',
											name: 'carousel3Content',
											label: 'Carousel 3 Content',
											value: '',
											classes: 'carouselthreemce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'button',
											name: 'carosel4media',
											label: 'Carousel Item 4 Content',
											text: 'Add Media',
											classes: 'meida_btn carosel4media',
										},
										{
											type: 'textbox',
											name: 'carousel4Content',
											label: 'Carousel 4 Content',
											value: '',
											classes: 'carouselfourmce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										
									],
									onsubmit: function( e ) {
									var caroneiframe = jQuery('.mce-carouselonemce').parent().find('iframe').attr('id');
									var caroneHtml = jQuery('#' + caroneiframe + '').contents().find('body').html();
									var cartwoiframe = jQuery('.mce-carouseltwomce').parent().find('iframe').attr('id');
									var cartwoHtml = jQuery('#' + cartwoiframe + '').contents().find('body').html();
									var carthreeiframe = jQuery('.mce-carouselthreemce').parent().find('iframe').attr('id');
									var carthreeHtml = jQuery('#' + carthreeiframe + '').contents().find('body').html();
									var carfouriframe = jQuery('.mce-carouselfourmce').parent().find('iframe').attr('id');
									var carfourHtml = jQuery('#' + carfouriframe + '').contents().find('body').html();
									
										editor.insertContent( '[carousel style="'+e.data.carouselStyle+'" background="'+e.data.carouselBgColor+'" text_color="'+e.data.carouselTxtColor+'" button_color="'+e.data.carouselBtnColor+'"][carousel_item]' + caroneHtml + '[/carousel_item][carousel_item]' + cartwoHtml + '[/carousel_item][carousel_item]' + carthreeHtml + '[/carousel_item][carousel_item]' + carfourHtml + '[/carousel_item][/carousel]');
									}
								});

								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-carouselonemce', 'carouselonemce');
								optimTinyHeavy('.mce-carouseltwomce', 'carouseltwomce');
								optimTinyHeavy('.mce-carouselthreemce', 'carouselthreemce');
								optimTinyHeavy('.mce-carouselfourmce', 'carouselfourmce');
								
								//MEDIA BUTTON
								optimMedia('.mce-carosel1media','.mce-carouselonemce');
								optimMedia('.mce-carosel2media','.mce-carouseltwomce');
								optimMedia('.mce-carosel3media','.mce-carouselthreemce');
								optimMedia('.mce-carosel4media','.mce-carouselfourmce');
								
								//WINDOW Styles
								optimMceWindow();
								
							},
							
							
						},
						
//END

					],
					},	
//-----------------------------SLIDER & CAROUSEL MENU END-------------------------------						
//-----------------------------SOCIAL MENU START-------------------------------					
					{
					text: 'Social',
					icon: 'optim_cont_social',
					menu: [
/*----------------------------Facebook Like Button---------------------------*/
								{
							text: 'Facebook Like Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Facebook Like Button',
									width: 860,
									height: 200,
									body: [
										{
											type: 'listbox',
											name: 'fblikeLayout',
											label: 'Button Style',
											classes: 'widget btn fbstyle',
											'values': [
												{text: 'Standard', value: 'standard'},
												{text: 'Box Count', value: 'box_count'},
												{text: 'Button Count', value: 'button_count'},
											]
										},
										{
											type: 'listbox',
											name: 'fblikeAction',
											label: 'Action',
											classes: 'widget btn fbaction',
											'values': [
												{text: 'Like', value: 'like'},
												{text: 'Recommend', value: 'recommend'},
											]
										},
										{
											type: 'checkbox',
											name: 'fblikeShare',
											classes: 'fbshare',
											label: 'Display Share Button',
											checked: true,
										},		
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[fblike layout="'+e.data.fblikeLayout+'" action="'+e.data.fblikeAction+'" share="'+e.data.fblikeShare+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Facebook Like Button"]').addClass('fblike_window');
									jQuery(".fblike_window .mce-foot>div").prepend("<a class='short_preview_btn fblike_prevbtn'><span></span>Preview</a>");
									jQuery('.fblike_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var fbstyle = jQuery('.mce-fbstyle button').text().toLowerCase().replace(/ /g,"_");
                                 var fbaction = jQuery('.mce-fbaction button').text().toLowerCase().replace(/ /g,"_");
                                 if( fbstyle.slice(-1) == '_'){var fbstyle = fbstyle.replace(/_([^_]*)$/,'$1');}
                                 if( fbaction.slice(-1) == '_'){var fbaction = fbaction.replace(/_([^_]*)$/,'$1');}
                                 var fbshare_val = jQuery('.mce-fbshare').attr("aria-checked");
                                 var fbshare ='false';
                                 if(fbshare_val =='true'){var fbshare = 'true';}
                                 if(fbstyle ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    
                                    var shortcontent = '<iframe src="//www.facebook.com/plugins/like.php?href=http://google.com/&amp;width&amp;layout='+fbstyle+'&amp;action='+fbaction+'&amp;show_faces=false&amp;share='+fbshare+'&amp;height=35&amp" scrolling="no" frameborder="0" style="border:none; overflow:hidden; allowTransparency="true"></iframe>';
                                    
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".fblike_prev").remove();
                                 jQuery(".fblike_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview fblike_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".fblike_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".fblike_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------Twitter Share Button---------------------------*/
								{
							text: 'Twitter Share Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Twitter Share Button',
									width: 860,
									height: 200,
									body: [
										{
											type: 'listbox',
											name: 'twitterSize',
											label: 'Button Style',
											classes: 'widget btn twtsize',
											'values': [
												{text: 'Standard', value: 'standard'},
												{text: 'Big', value: 'big'},
											]
										},
										{
											type: 'textbox',
											name: 'twitterVia',
											label: 'Tweet Via(optional)',
											classes: 'twtvia',
											value: '',
											tooltip: '@your_twitter_username',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'checkbox',
											name: 'twitterCount',
											label: 'Display Share Count',
											checked: true,
											classes: 'twtshare',
										},
										{
											type: 'listbox',
											name: 'twitterCountType',
											label: 'Count Type',
											classes: 'widget btn twtcount',
											'values': [
												{text: 'Horizontal', value: 'horizontal'},
												{text: 'Vertical', value: 'vertical'},
											]
										},
		
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[tweet size="'+e.data.twitterSize+'" via="'+e.data.twitterVia+'" count="'+e.data.twitterCount+'" count_type="'+e.data.twitterCountType+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Twitter Share Button"]').addClass('twitter_window');
									jQuery(".twitter_window .mce-foot>div").prepend("<a class='short_preview_btn twitter_prevbtn'><span></span>Preview</a>");
									jQuery('.twitter_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT
                                 var twtsize = jQuery('.mce-twtsize button').text().toLowerCase();
                                 if(twtsize =='standard'){var twtsize =''}
                                 if(twtsize =='big'){var twtsize ='data-size="large"' }
                                 var twtcount = jQuery('.mce-twtcount button').text().toLowerCase();
                                 if(twtcount =='horizontal'){var twtcount =''}
                                 if(twtcount =='vertical'){var twtcount ='data-count="vertical"' }
                                 if(twtvia !==''){var twtvia = 'data-via="'+jQuery('.mce-twtvia').val()+'"';}else{var twtvia =''; }
                                 var twtshare_val = jQuery('.mce-twtshare').attr("aria-checked");
                                 var twtshare ='data-count="none"';
                                 if(twtshare_val =='true'){var twtshare = '';}
                                                
                                    var shortcontent = '<a href="https://twitter.com/share" class="twitter-share-button" '+twtvia+' '+twtcount+' '+twtsize+' '+twtcount+'>Tweet</a>';
                                    

                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".twitter_prev").remove();
                                 jQuery(".twitter_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview twitter_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".twitter_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
   !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".twitter_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------Google Plus---------------------------*/
								{
							text: 'Google+ Share Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Google+ Share Button',
									width: 860,
									height: 150,
									body: [
										{
											type: 'listbox',
											name: 'gplusStyle',
											label: 'Button Style',
											classes: 'widget btn gplustyle',
											'values': [
												{text: 'Inline', value: 'inline'},
												{text: 'Bubble', value: 'bubble'},
												{text: 'No Count', value: 'none'},
											]
										},
										{
											type: 'listbox',
											name: 'gplusSize',
											label: 'Button Size',
											classes: 'widget btn gplusize',
											'values': [
												{text: 'Medium', value: 'medium'},
												{text: 'Small', value: 'small'},
												{text: 'Large', value: 'large'},
											]
										},
		
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[gplus size="'+e.data.gplusSize+'" style="'+e.data.gplusStyle+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Google+ Share Button"]').addClass('gplus_window');
									jQuery(".gplus_window .mce-foot>div").prepend("<a class='short_preview_btn gplus_prevbtn'><span></span>Preview</a>");
									jQuery('.gplus_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 
                                 //GET PREVIEW CONTENT
                                 var gplustyle = jQuery('.mce-gplustyle button').text().toLowerCase();
                                 if(gplustyle =='no count'){var gplustyle ='none'}
                                 
                                 var gplusize = jQuery('.mce-gplusize button').text().toLowerCase();
                                 if(gplusize =='small'){var gplusize ='data-size="small"' }
                                 if(gplusize =='large'){var gplusize ='data-size="tall"' }
                                 if(gplusize =='medium'){var gplusize =''}
                                                
                                    var shortcontent = '<div class="gplus_wrap gplus_'+gplustyle+'"><div class="g-plusone" '+gplusize+' data-annotation="'+gplustyle+'"></div></div>';
                                    

                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".gplus_prev").remove();
                                 jQuery(".gplus_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview gplus_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".gplus_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
   (function() { var po = document.createElement("script"); po.type = "text/javascript"; po.async = true; po.src = "https://apis.google.com/js/plusone.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);})();
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".gplus_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------Pinterest PIN Button---------------------------*/
								{
							text: 'Pinterest Pin Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Pinterest Pin Button',
									width: 860,
									height: 150,
									body: [
										{
											type: 'listbox',
											name: 'pinitStyle',
											label: 'Button Style',
											classes: 'widget btn pinstyle',
											'values': [
												{text: 'Red', value: 'red'},
												{text: 'White', value: 'white'},
												{text: 'Gray', value: 'gray'},
											]
										},
										{
											type: 'listbox',
											name: 'pinitSize',
											label: 'Button Size',
											classes: 'widget btn pinsize',
											'values': [
												{text: 'Standard', value: 'standard'},
												{text: 'Big', value: 'big'},
											]
										},
		
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[pinit size="'+e.data.pinitSize+'" style="'+e.data.pinitStyle+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Pinterest Pin Button"]').addClass('pin_window');
									jQuery(".pin_window .mce-foot>div").prepend("<a class='short_preview_btn pin_prevbtn'><span></span>Preview</a>");
									jQuery('.pin_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 
                                 //GET PREVIEW CONTENT
                                 var pinstyle = jQuery('.mce-pinstyle button').text().toLowerCase();
                                 if(pinstyle =='red'){var pinstyle ='data-pin-color="red"' }
                                 if(pinstyle =='white'){var pinstyle ='data-pin-color="white"' }
                                 if(pinstyle =='gray'){var pinstyle =''}
                                 
                                 var pinsize = jQuery('.mce-pinsize button').text().toLowerCase();
                                 if(pinsize =='standard'){var pinsize ='' }
                                 if(pinsize =='big'){var pinsize ='data-pin-height="28"' }
                                                
                                    var shortcontent = '<a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" '+pinsize+' '+pinstyle+'><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>';
                                    
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".pin_prev").remove();
                                 jQuery(".pin_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview pin_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".pin_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
   !function(a,b,c){var d,e,f;f="PIN_"+~~((new Date).getTime()/864e5),a[f]||(a[f]=!0,a.setTimeout(function(){d=b.getElementsByTagName("SCRIPT")[0],e=b.createElement("SCRIPT"),e.type="text/javascript",e.async=!0,e.src=c+"?"+f,d.parentNode.insertBefore(e,d)},10))}(window,document,"//assets.pinterest.com/js/pinit_main.js");
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".pin_prev, #pinscript").remove();
                              }
									});
									}, 500);
									//PREVIEW END
							},
							
							
						},					
//END	

					],
					},	
//-----------------------------SOCIAL MENU END-------------------------------	
//-----------------------------Image & Video START-------------------------------					
					{
					text: 'Image & Video',
					icon: 'optim_cont_img',
					menu: [
/*----------------------------Featured Image---------------------------*/
								{
							text: 'Featured Image',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Featured Image',
									width: 860,
									height: 250,
									body: [
										{
											type: 'listbox',
											name: 'featImageSize',
											label: 'Image Size',
											classes: 'widget btn featsize',
											'values': [
												{text: 'Full', value: 'full'},
												{text: 'Medium', value: 'medium'},
												{text: 'Small', value: 'thumbnail'},
											]
										},
										{
											type: 'listbox',
											name: 'featImageAlign',
											label: 'Image Alignment',
											classes: 'widget btn featalign',
											'values': [
												{text: 'Left', value: 'alignleft'},
												{text: 'Center', value: 'aligncenter'},
												{text: 'Right', value: 'alignright'},
											]
										},	
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[featimage size="'+e.data.featImageSize+'" align="'+e.data.featImageAlign+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Featured Image"]').addClass('feat_window');
									jQuery(".feat_window .mce-foot>div").prepend("<a class='short_preview_btn feat_prevbtn'><span></span>Preview</a>");
									jQuery('.feat_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 
                                 //GET PREVIEW CONTENT
                                 var featimg = jQuery('#set-post-thumbnail').html();
                                 var featimgalign = jQuery('.mce-featalign button').text().toLowerCase();
                                 

                                                
                                    var shortcontent = '<p style="text-align:'+featimgalign+'">'+featimg+'</p>';
                                    
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".feat_prev").remove();
                                 jQuery(".feat_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview feat_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".feat_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".feat_prev, #pinscript").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},
/*----------------------------Flickr Gallery---------------------------*/
								{
							text: 'Flickr Gallery',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Flickr Gallery',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'flickrId',
											label: 'Flickr user ID',
											classes: 'flickrid',
											value: '',
											tooltip: 'Your Flickr user ID: e.g:39226613@N08 Use this website to get your user id: http://idgettr.com/ ',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'photosetId',
											label: 'Photoset ID (Optional)',
											classes: 'flickrid',
											value: '',
											tooltip: 'Your Flickr user ID: e.g:39226613@N08 Use this website to get your user id: http://idgettr.com/ ',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'flickrCount',
											label: 'Number of Images',
											classes: 'flickrnum',
											value: '12',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'listbox',
											name: 'flickrSize',
											label: 'Image Size',
											classes: 'widget btn flickrsize',
											'values': [
												{text: 'Medium', value: 'n'},
												{text: 'Thumbnail', value: 'q'},
												{text: 'Small', value: 's'},
											]
										},
										{
											type: 'textbox',
											name: 'flickrApi',
											label: 'Your Api Key',
											classes: 'flickrkey',
											value: '',
											multiline: false,
											minWidth: 300,
											tooltip: 'Your can get your Flickr Api Key by logging into flickr and then going to https://secure.flickr.com/services/apps/create/apply ',
										},	
											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[flickr id="'+e.data.flickrId+'" photoset="'+e.data.photosetId+'" count="'+e.data.flickrCount+'" photo_size="'+e.data.flickrSize+'" key="'+e.data.flickrApi+'"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Flickr Gallery"]').addClass('flickr_window');
									jQuery(".flickr_window .mce-foot>div").prepend("<a class='short_preview_btn flickr_prevbtn'><span></span>Preview</a>");
									jQuery('.flickr_prevbtn').on('click',function(){
                           if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										
										//GET PREVIEW CONTENT
										var userid = jQuery('.mce-flickrid').val();
										var userkey = jQuery('.mce-flickrkey').val();
										var flickrcount = jQuery('.mce-flickrnum').val();
										var flickrsize = jQuery('.mce-flickrsize button').text().toLowerCase();
										if(flickrsize == 'medium'){var flickrsize ='n';}
										if(flickrsize == 'thumbnail'){var flickrsize ='q';}
										if(flickrsize == 'small'){var flickrsize ='s';}
										
										if(userid == '' && userkey ==''){ var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';	}else{				
											var shortcontent = '<div id="flickr_badge_wrapper" class="clearfix flckr_'+flickrsize+'"></div>';
                              (function($){
                                 var userID = userid;
                                 var apiKey = userkey;
                                 var itemsPerPage = flickrcount; // Max is 500
                                 $.getJSON("https://api.flickr.com/services/rest/?&method=flickr.people.getPhotos&api_key=" + apiKey + "&user_id=" + userID + "&per_page=" + itemsPerPage + "&format=json&jsoncallback=?", function(data){        
                                    
                                    var htmlOutput = "<ul class=\'pd_flick_gallery\'>";
                                    //loop through the results
                                    $.each(data.photos.photo, function(i,item){
                                       // URLs
                                       var photoURL = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_"+flickrsize+".jpg";
                                       var linkURL = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + "_b.jpg";
                                       
                                       htmlOutput += '<li><a href="' + linkURL + '" target="_blank">';
                                       htmlOutput += '<img title="' + item.title + '" src="' + photoURL;
                                       htmlOutput += '" alt="' + item.title + '" />';
                                       htmlOutput += '</a></li>';
                                    });
                                    htmlOutput += "</ul><div style=\'clear:both;\'></div>";
                                       
                                    // Assign result to a unique container
                                    $("#flickr_badge_wrapper").html(htmlOutput);
                                 });
                              })(jQuery);
									}
										jQuery(this).addClass("short_prev_on");
										jQuery(".flickr_prev").remove();
										jQuery(".flickr_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview flickr_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".flickr_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".flickr_prev, #pinscript").remove();
                           }
									});
									}, 500);
							},
							
							
						},
/*----------------------------Responsive Youtube Video---------------------------*/
								{
							text: 'Responsive Youtube Video',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Responsive Youtube Video',
									width: 860,
									height: 400,
									body: [
										{
											type: 'textbox',
											name: 'ytbvdoUrl',
											label: 'Video Link',
											value: '',
											tooltip: 'example: https://www.youtube.com/watch?v=F4zX--5Ils8',
											multiline: false,
											minWidth: 300,
											classes: 'ytburl',
										},
										{
											type: 'textbox',
											name: 'ytbvdoWidth',
											label: 'Video Width',
											value: '100%',
											tooltip: 'in percent. eg: 100% ',
											multiline: false,
											minWidth: 300,
											classes: 'ytbwidth',
										},
										{
											type: 'textbox',
											name: 'ytbvdoHeight',
											label: 'Video Height',
											value: '100%',
											tooltip: 'in percent. eg: 100% ',
											multiline: false,
											minWidth: 300,
											classes: 'ytbheight',
										},
										{
											type: 'checkbox',
											name: 'ytbvdoAuto',
											label: 'Autoplay Video',
											checked: true,
											classes: 'ytbautoplay',
										},

											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[youtube width="'+e.data.ytbvdoWidth+'" height="'+e.data.ytbvdoHeight+'" autoplay="'+e.data.ytbvdoAuto+'"]'+e.data.ytbvdoUrl+'[/youtube]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Responsive Youtube Video"]').addClass('youtube_window');
									jQuery(".youtube_window .mce-foot>div").prepend("<a class='short_preview_btn youtube_prevbtn'><span></span>Preview</a>");
									jQuery('.youtube_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 
                                 //GET PREVIEW CONTENT
                                 var ytburl = jQuery('.mce-ytburl').val();
                                 var ytbheight = jQuery('.mce-ytbheight').val();
                                 var ytbwidth = jQuery('.mce-ytbwidth').val();
                                 var ytbautoplayval = jQuery('.mce-ytbautoplay').attr("aria-checked");
                                 var ytbautoplay ='';
                                 if(ytbautoplayval =='true'){var ytbautoplay = "?autoplay=1";}
                              
                                 
                                 if(ytburl ==''){ var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';	}else{
                                    
                                    var shortcontent = '<div class="ast_vid"><div class="responsive-container"><iframe class="vid_iframe" style=" width: '+ytbwidth+'; height: '+ytbheight+';" src="//www.youtube.com/embed/'+videourl(ytburl)+''+ytbautoplay+'" allowfullscreen></iframe></div></div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".youtube_prev").remove();
                                 jQuery(".youtube_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview youtube_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".youtube_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".youtube_prev, #pinscript").remove();
                              }
									});
									}, 500);
									//PREVIEW END

							},
							
							
						},
/*----------------------------Responsive Vimeo Video---------------------------*/
								{
							text: 'Responsive Vimeo Video',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Responsive Vimeo Video',
									width: 860,
									height: 400,
									body: [
										{
											type: 'textbox',
											name: 'vimvdoUrl',
											label: 'Video Link',
											value: '',
											tooltip: 'example: http://vimeo.com/65926401',
											multiline: false,
											minWidth: 300,
											classes: 'vimeourl',
										},
										{
											type: 'textbox',
											name: 'vimvdoWidth',
											label: 'Video Width',
											value: '100%',
											tooltip: 'in percent. eg: 100% ',
											multiline: false,
											minWidth: 300,
											classes: 'vimeowidth',
										},
										{
											type: 'textbox',
											name: 'vimvdoHeight',
											label: 'Video Height',
											value: '100%',
											tooltip: 'in percent. eg: 100% ',
											multiline: false,
											minWidth: 300,
											classes: 'vimeoheight',
										},
										{
											type: 'checkbox',
											name: 'vimvdoAuto',
											label: 'Autoplay Video',
											checked: true,
											classes: 'vimeoautoplay',
										},

											
									],
								
									onsubmit: function( e ) {
									
										editor.insertContent( '[vimeo width="'+e.data.vimvdoWidth+'" height="'+e.data.vimvdoHeight+'" autoplay="'+e.data.vimvdoAuto+'"]'+e.data.vimvdoUrl+'[/vimeo]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Responsive Vimeo Video"]').addClass('vimeo_window');
									jQuery(".vimeo_window .mce-foot>div").prepend("<a class='short_preview_btn vimeo_prevbtn'><span></span>Preview</a>");
									jQuery('.vimeo_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 
                                 //GET PREVIEW CONTENT
                                 var vimeourl = jQuery('.mce-vimeourl').val();
                                 var vimeoheight = jQuery('.mce-vimeoheight').val();
                                 var vimeowidth = jQuery('.mce-vimeowidth').val();
                                 var vimeoautoplayval = jQuery('.mce-vimeoautoplay').attr("aria-checked");
                                 var vimeoautoplay ='0';
                                 if(vimeoautoplayval =='true'){var vimeoautoplay = "1";}
                              
                                 
                                 if(vimeourl ==''){ var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';	}else{
                                    
                                    var shortcontent = '<div class="ast_vid"><div class="responsive-container"><iframe class="vid_iframe" style=" width: '+vimeowidth+'; height: '+vimeoheight+';" src="//player.vimeo.com/video/'+videourl(vimeourl)+'?title=1&amp;byline=0&amp;portrait=0&amp;color=00adef&amp;autoplay='+vimeoautoplay+'"></iframe></div></div>';
                                 }
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".vimeo_prev").remove();
                                 jQuery(".vimeo_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview vimeo_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".vimeo_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".vimeo_prev, #pinscript").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},					
//END	

					],
					},	
//-----------------------------Image & Video END-------------------------------		
//-----------------------------SEPCIAL START-------------------------------					
					{
					text: 'Special',
					icon: 'optim_cont_special',
					menu: [
/*----------------------------Custom Posts---------------------------*/
								{
							text: 'Custom Posts',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Custom Posts',
									width: 860,
									height: 500,
									body: [
										{
											type: 'textbox',
											name: 'postPerPage',
											label: 'Number of Posts',
											value: '9',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'listbox',
											name: 'postsLayout',
											label: 'Posts Layout',
											'values': [
												{text: 'Layout1', value: 'layout1'},
												{text: 'Layout2', value: 'layout2'},
												{text: 'Layout3', value: 'layout3'},
												{text: 'Layout4', value: 'layout4'},
												{text: 'Layout5', value: 'layout5'},
											]
										},	
										{
											type: 'label',
											name: 'postCat',
											label: 'Post Type',
											classes: 'lts_posts',
											minWidth: 300,
											minHeight: 130,
											tooltip:'Hold down ctrl key to select multiple Post Type'
										},	
										{
											type: 'label',
											name: 'postCat',
											label: 'Categories',
											classes: 'lts_cats',
											minWidth: 300,
											minHeight: 130,
											tooltip:'Hold down ctrl key to select multiple categories'
										},
										{
											type: 'label',
											name: 'postCat',
											label: 'Tags',
											classes: 'lts_tags',
											minWidth: 300,
											minHeight: 130,
											tooltip:'Only select if you want to display posts by tags. Hold down ctrl key to select multiple tags'
										},	
										{
											type: 'textbox',
											name: 'postIds',
											label: 'Posts by Ids',
											value: '',
											multiline: false,
											minWidth: 300,
											tooltip: 'Only display certain posts by their post ids. comma separated values. eg: 9,21,14'
										},									
											
									],
							
									onsubmit: function( e ) {
									var selectedpost = jQuery(".mce-lts_posts select").val(); 
									var selectedcat = jQuery(".mce-lts_cats select").val(); 
									var selectedtag = jQuery(".mce-lts_tags select").val(); 
										editor.insertContent( '[display-posts post_type="'+selectedpost+'" category="'+selectedcat+'" tag="'+selectedtag+'" layout="'+e.data.postsLayout+'" posts_per_page="'+e.data.postPerPage+'" id="'+e.data.postIds+'"]');
									}
								});
								
							jQuery('.mce-lts_cats').append('<select multiple style="width:290px;height:120px;border:1px solid #ddd;">'+lts_cats+'</select>');
							jQuery('.mce-lts_tags').append('<select multiple style="width:290px;height:120px;border:1px solid #ddd;">'+lts_tags+'</select>');
							jQuery('.mce-lts_posts').append('<select multiple style="width:290px;height:120px;border:1px solid #ddd;">'+lts_posts+'</select>');
							//WINDOW Styles
							optimMceWindow();
							
							//PREVIEW
							jQuery('[aria-label="Custom Posts"]').addClass('posts_window');
							jQuery(".posts_window .mce-foot>div").prepend("<a class='short_preview_btn posts_prevbtn'><i class='fa fa-eye-slash'></i> No Preview Available</a>");
							
							},
							
							
						},
/*----------------------------ABOUT THE AUTHOR---------------------------*/
								{
							text: 'About Author Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'About Author Box',
									width: 860,
									height: 500,
									body: [
										{
											type: 'textbox',
											name: 'authorName',
											label: 'Author Name',
											classes: 'authorname',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'button', 
											name: 'authorImg', 
											text: 'Select Image', 
											label: 'Author Image',
											classes: 'authorimg_button',
											tooltip: 'Click to Select the Author Image.',
											value: '',
											minWidth: 250,
											minHeight: 50,
										},
										{
											type: 'textbox',
											name: 'authorContent',
											label: 'Your List',
											value: 'Write Author bio here..',
											classes: 'authormce',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										{
											type: 'textbox', 
											name: 'authorNameColor', 
											label: 'Author Name Color',
											classes: 'colpix authorcolor',
											value: '#4a9ad4',
											minWidth: 200,
										},
										{
											type: 'textbox', 
											name: 'authorBgColor', 
											label: 'Backgound Color',
											classes: 'colpix authorbg',
											value: '#ffffff',
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'authorFb',
											label: 'Author Facebook url',
											classes: 'authorfb',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'authorTwt',
											label: 'Author Twitter url',
											classes: 'authortwt',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'authorGplus',
											label: 'Author Google+ url',
											classes: 'authorgoogle',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'authorLkndin',
											label: 'Author LinkedIn url',
											classes: 'authorlinkdin',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'authorWeb',
											label: 'Author Website',
											classes: 'authorweb',
											value: '',
											multiline: false,
											minWidth: 300,
										},
										
										
									],
									onsubmit: function( e ) {
									var authorIMG = jQuery('.mce-authorimg_button button').val();
									var getiframe = jQuery('.mce-authormce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
										editor.insertContent( '[author name="' + e.data.authorName + '" image="' + authorIMG + '" facebook="' + e.data.authorFb + '" twitter="' + e.data.authorTwt + '" google="' + e.data.authorGplus + '" linkedin="' + e.data.authorLkndin + '" website="' + e.data.authorWeb + '" name_text_color="' + e.data.authorNameColor + '" background="' + e.data.authorBgColor + '"]' + updatedHtml + '[/author]');
									}
								});

								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//Author IMAGE UPLOAD
								jQuery(function($) {
									 var custom_uploader;
									 var row_id 
								
									 jQuery(".mce-authorimg_button button").click(function(e) {
										e.preventDefault();
										row_id = jQuery(this).next().attr('id');
								
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Insert Images',
											button: {
												text: 'Insert Images'
											},
											type: 'image',
											multiple: true
										});
								
								
										custom_uploader.on('close',function(data) {
										 var imageArray = [];
										 images = custom_uploader.state().get('selection');
										 images.each(function(image) {
										imageArray.push(image.attributes.id); // want other attributes? Check the available ones with console.log(image.attributes);
										jQuery('.apdauthimage').remove();
										jQuery('.mce-authorimg_button').prepend("<img class='apdauthimage' src=" +image.attributes.url+">");
										jQuery('.mce-authorimg_button button').val(''+image.attributes.url+'');
										 });
										 
										  
										});
								
										//Open the uploader dialog
										custom_uploader.open();
								
									});
								});	
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-authormce', 'author_mce');
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="About Author Box"]').addClass('author_window');
									jQuery(".author_window .mce-foot>div").prepend("<a class='short_preview_btn author_prevbtn'><span></span>Preview</a>");
									jQuery('.author_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var authorname = jQuery('.mce-authorname').val();
                                 
                                 if(authorimg_button !==''){var authorimg_button = '<div class="author_image"><img src="'+jQuery('.mce-authorimg_button button').val()+'" alt="'+authorname+'" title="'+authorname+'" /></div>'; }else{ var authorimg_button = '';}
                                 var authormce = jQuery('.mce-authormce').val();
                                 var authorcolor = jQuery('.mce-authorcolor').val();
                                 var authorbg = jQuery('.mce-authorbg').val();
                                 
         if(authorfb !==''){var authorfb = '<a href="'+jQuery('.mce-authorfb').val()+'"><i class="fa fa-facebook-square"></i></a>'; }else{ var authorfb = '';}
         if(authortwt !==''){var authortwt = '<a href="'+jQuery('.mce-authortwt').val()+'"><i class="fa fa-twitter-square"></i></a>'; }else{ var authortwt = '';}
         if(authorgoogle !==''){var authorgoogle = '<a href="'+jQuery('.mce-authorgoogle').val()+'"><i class="fa fa-google-plus-square"></i></a>'; }else{ var authorgoogle = '';}
         if(authorlinkdin !==''){var authorlinkdin = '<a href="'+jQuery('.mce-authorlinkdin').val()+'"><i class="fa fa-linkedin-square"></i></a>'; }else{ var authorlinkdin = '';}
         if(authorweb !==''){var authorweb = '<a href="'+jQuery('.mce-authorweb').val()+'"><i class="fa fa-globe"></i></a>'; }else{ var authorweb = '';}
                                 
                                 if(authorname ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_author" style="background:'+authorbg+'">'+authorimg_button+'<div class="author_content"><h5 style="color:'+authorcolor+'">'+authorname+'</h5><div class="lts_author_body">'+authormce+'<p class="athor_social">'+authorfb+' '+authortwt+' '+authorgoogle+' '+authorlinkdin+' '+authorweb+'</p></div></div></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".author_prev").remove();
                                 jQuery(".author_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview author_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".author_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".author_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------LIGHTBOX SHORTCODE---------------------------*/
								{
							text: 'Lightbox Content',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Lightbox Content',
									width: 860,
									height: 500,
									body: [
										{
											type: 'button',
											name: 'lightboxmedia',
											label: 'Lightbox Content',
											text: 'Add Media',
											classes: 'meida_btn lightboxmedia',
										},
										{
											type: 'textbox',
											name: 'lightboxContent',
											label: 'Your Lightbox Content',
											value: 'Your Lightbox Content',
											classes: 'lightboxmce',
											tooltip: 'This content will show up when you click the button.',
											multiline: true,
											minWidth: 300,
											minHeight: 300
										},
										
										{
											type: 'textbox',
											name: 'lightboxButtonTxtColor',
											label: 'Button Text Color',
											classes: 'colpix lightbtntxtcolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'lightboxButtonBgColor',
											label: 'Button Background Color',
											classes: 'colpix lightbtnbg',
											value: '#32a1f0',
											multiline: false,
											minWidth: 200,
										},
										{
											type: 'textbox',
											name: 'lightboxButtonSize',
											label: 'Button Font Size',
											classes: 'lightbtnsize',
											value: '16px',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										
										{
											type: 'listbox',
											name: 'lightButtonStyle',
											label: 'Button Style',
											classes: 'btn widget lightbtn_style',
											'values': [
												{text: 'Square (Flat)', value: 'lt_flat'},
												{text: 'Square (Hollow)', value: 'lt_hollow'},
												{text: 'Circular (Flat)', value: 'lt_circular lt_flat'},
												{text: 'Circular (Hollow)', value: 'lt_circular lt_hollow'}
											]
										},
										
										{
											type: 'listbox',
											name: 'lightButtonSize',
											label: 'Button Size',
											classes: 'btn widget lightbtn_size',
											'values': [
												{text: 'Medium', value: 'medium'},
												{text: 'Small', value: 'small'},
												{text: 'Large', value: 'large'},
											]
										},
										
										{
											type: 'checkbox',
											name: 'lightboxButtonRounded',
											label: 'Rounded Corner',
											classes: 'lightbtncorner',
											checked: true,
										},
										
										{
											type: 'button', 
											name: 'lightboximgmedia', 
											text: 'Select Image', 
											label: 'Use Image Instead of Button',
											classes: 'lightboximgmedia',
											tooltip: 'Click to Select the Author Image.',
											value: '',
											minWidth: 250,
											minHeight: 50,
										},
										
									],
									onsubmit: function( e ) {
									var getiframe = jQuery('.mce-lightboxmce').parent().find('iframe').attr('id');
									var updatedHtml = jQuery('#' + getiframe + '').contents().find('body').html();
									var lightbxIMG = jQuery('.mce-lightboximgmedia button').val();
									
										editor.insertContent( '[lightbox button_text="' + e.data.lightboxTitle + '" button_text_color="' + e.data.lightboxButtonTxtColor + '" button_text_bg="' + e.data.lightboxButtonBgColor + '" button_font_size="' + e.data.lightboxButtonSize + '" button_style="' + e.data.lightButtonStyle + '" button_size="' + e.data.lightButtonSize + '" rounded="' + e.data.lightboxButtonRounded + '" image="' + lightbxIMG + '" ]' + updatedHtml + '[/lightbox]');
									}
								});

								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								
								
								//LOAD INNER TINYMCE
								optimTinyHeavy('.mce-lightboxmce', 'lightboxmce');
								
								//MEDIA BUTTON
								optimMedia('.mce-lightboxmedia','.mce-lightboxmce');
								
								//Author IMAGE UPLOAD
								jQuery(function($) {
									 var custom_uploader;
									 var row_id 
								
									 jQuery(".mce-lightboximgmedia button").click(function(e) {
										e.preventDefault();
										row_id = jQuery(this).next().attr('id');
								
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Insert Images',
											button: {
												text: 'Insert Images'
											},
											type: 'image',
											multiple: true
										});
								
								
										custom_uploader.on('close',function(data) {
										 var imageArray = [];
										 images = custom_uploader.state().get('selection');
										 images.each(function(image) {
										imageArray.push(image.attributes.id); // want other attributes? Check the available ones with console.log(image.attributes);
										jQuery('.lightboximg_preview').remove();
										jQuery('.mce-lightboximgmedia').prepend("<img class='lightboximg_preview' src=" +image.attributes.url+">");
										jQuery('.mce-lightboximgmedia button').val(''+image.attributes.url+'');
										 });
										 
										  
										});
								
										//Open the uploader dialog
										custom_uploader.open();
								
									});
								
								});
								
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Lightbox Content"]').addClass('lightbox_window');
									jQuery(".lightbox_window .mce-foot>div").prepend("<a class='short_preview_btn lightbox_prevbtn'><span></span>Preview</a>");
									jQuery('.lightbox_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var lightbtntxt = jQuery('.mce-lightbtntxt').val();
                                 var lightboxmce = jQuery('.mce-lightboxmce').val();
                                 var lightbtntxtcolor = jQuery('.mce-lightbtntxtcolor').val();
                                 var lightbtnbg = jQuery('.mce-lightbtnbg').val();
                                 var lightbtnsize = jQuery('.mce-lightbtnsize').val();
                                 var lightbtn_style = jQuery('.mce-btn_style button').text().toLowerCase();
                                 var lightbtn_size = jQuery('.mce-btn_style button').text().toLowerCase();
                                 var lightbtncornerval = jQuery('.mce-lightbtncorner').attr("aria-checked");
                                 var lightbtncorner ='0';
                                 var lightbximg = jQuery('.mce-lightboxImg').val();
                                 
                                 if(lightbtncornerval =='true'){var lightbtncorner = "lt_rounded";}
                                 //If Selected Image Instead of Button
                                 if(lightbximg !==''){var lightbtntxt = '<img src="'+lightbximg+'" />';}
                                 
                                 
                                 if(lightbtntxt =='' && lightboxmce ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<span style="color:'+lightbtntxtcolor+';background:'+lightbtnbg+';font-size:'+lightbtnsize+'" class="lts_lightbox_bttn lt_animate '+lightbtncorner+' '+lightbtn_style+' '+lightbtn_size+'">'+lightbtntxt+'</span>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".lightbox_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                                 jQuery(".lightbox_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview lightbox_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".lightbox_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                                 
                                 jQuery('.lts_lightbox_bttn').on("click",function(){  jQuery('<div class="lts_lightbox_content"><span onclick="closeclick();" class="ltsclose">×</span>'+lightboxmce+'</div><div class="lts_lightbox_blank"></div>').appendTo('body');  });
                                 
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".lightbox_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	

/*----------------------------MAP---------------------------*/
								{
							text: 'Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Map',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'mapLat',
											label: 'Latitude',
											value: '53.359286',
											multiline: false,
											minWidth: 200,
											classes: 'maplat',
										},
										{
											type: 'textbox',
											name: 'mapLong',
											label: 'longitude',
											value: '-2.040904',
											multiline: false,
											minWidth: 200,
											classes: 'maplong',
										},
										{
											type: 'textbox',
											name: 'mapText',
											label: 'Location Details',
											value: '',
											tooltip: 'This will be shown when you hover over the map marker',
											multiline: true,
											minWidth: 300,
											minHeight: 100,
											classes: 'maptxt',
										},
										{
											type: 'textbox',
											name: 'mapHeight',
											label: 'Height',
											value: '300px',
											multiline: false,
											minWidth: 200,
											classes: 'mapheight',
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[map latitude="' + e.data.mapLat + '" longitude="' + e.data.mapLong + '" text="' + e.data.mapText + '" height="' + e.data.mapHeight + '"]');
									}
								});
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Map"]').addClass('map_window');
									jQuery(".map_window .mce-foot>div").prepend("<a class='short_preview_btn map_prevbtn'><span></span>Preview</a>");
									jQuery('.map_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var maplat = jQuery('.mce-maplat').val()
                                 var maplong = jQuery('.mce-maplong').val();
                                 var maptxt = jQuery('.mce-maptxt').val();
                                 var mapheight = jQuery('.mce-mapheight').val();
                                 
                                 if(maplat =='' && maplong =='' ){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<div class="lts_map_wrap" id="map_1" style="height:'+mapheight+'"><div data-map-lat="'+maplat+'" data-map-long="'+maplong+'" data-map-text="'+maptxt+'" class="lts_map"></div></div>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".map_prev").remove();
                                 jQuery(".map_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview map_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".map_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});

                                 jQuery(".lts_map_wrap").each(function(){
                                    var lat = jQuery(this).find('.lts_map').attr('data-map-lat');
                                    var long = jQuery(this).find('.lts_map').attr('data-map-long');
                                    var text = jQuery(this).find('.lts_map').attr('data-map-text');
                                    var mapid = jQuery(this).attr('id');

                                 function initialize() {

                                 var myLatlng = new google.maps.LatLng(lat,long);
                                 var mapOptions = {
                                    zoom: 16,
                                    center: myLatlng
                                 }
                                 var map = new google.maps.Map(document.getElementById(mapid), mapOptions);
                                 
                                 var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    map: map,
                                 });
                                 var infowindow = new google.maps.InfoWindow();
                                          google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                             return function () {
                                                infowindow.setContent(text);
                                                infowindow.open(map, marker);
                                             }
                                          })(marker));

                                 }
                                 
                                 function loadScript() {
                                 var script = document.createElement('script');
                                 script.type = 'text/javascript';
                                 script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize';
                                 document.body.appendChild(script);
                                 }
                                 
                                 window.onload = loadScript;
                                 });



                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".map_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------Progress Bar---------------------------*/
						{
							text: 'Progress Bar',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Progress Bar',
									width: 860,
									height: 300,
									body: [
										{
											type: 'textbox',
											name: 'prgrssbarTitle',
											label: 'Title',
											classes: 'prgrstt',
											multiline: false,
											minWidth: 300,
											value: ''
										},
										{
											type: 'textbox',
											name: 'prgrssbarProgress',
											label: 'Percent Completed',
											classes: 'prgrstxt',
											multiline: false,
											minWidth: 300,
											value: '70'
										},
										{
											type: 'listbox',
											name: 'prgrssStyle',
											label: 'Style',
											classes: 'prgrs_style',
											'values': [
												{text: 'Bold', value: 'bold'},
												{text: 'Thin', value: 'thin'},
												{text: 'Circular', value: 'circular'},
											]
										},	
										{
											type: 'textbox',
											name: 'prgrssbarBg',
											label: 'Progress Background Color',
											classes: 'colpix prgrsbg',
											value: '#2dcb73',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'prgrssbarColor',
											label: 'Progress text Color',
											classes: 'colpix prgrscolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'checkbox',
											name: 'prgrssbarRounded',
											label: 'Rounded Corner',
											classes: 'prgrsround',
											checked: true,
										},
										{
											type: 'checkbox',
											name: 'prgrssbarStripes',
											label: 'Show Stripes',
											classes: 'prgrstripe',
											checked: true,
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[progress title=" '+ e.data.prgrssbarTitle + '" percent="' + e.data.prgrssbarProgress + '" style="' + e.data.prgrssStyle + '" background="' + e.data.prgrssbarBg + '"  color="' + e.data.prgrssbarColor + '"  rounded="' + e.data.prgrssbarRounded + '"  stripes="' + e.data.prgrssbarStripes + '"]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Progress Bar"]').addClass('progress_window');
									jQuery(".progress_window .mce-foot>div").prepend("<a class='short_preview_btn progress_prevbtn'><span></span>Preview</a>");
									jQuery('.progress_prevbtn').on('click',function(){
                           if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var prgrsstyle = jQuery('.mce-prgrs_style button').text().toLowerCase();
										var prgrstxt = jQuery('.mce-prgrstxt').val();
										var prgrstt = jQuery('.mce-prgrstt').val();
										var prgrsbg = jQuery('.mce-prgrsbg').val();
										var prgrscolor = jQuery('.mce-prgrscolor').val();
										var prgrsroundval = jQuery('.mce-prgrsround').attr("aria-checked");
										var prgrsround ='';
										if(prgrsroundval =='true'){var prgrsround = 'lt_rounded';}
										var prgrstripeval = jQuery('.mce-prgrstripe').attr("aria-checked");
										var prgrstripe ='';
										if(prgrstripeval =='true'){var prgrstripe = 'progress_stripes';}
										
										if(prgrstxt ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div class="progress_title progress_default_tt">'+prgrstt+'</div><div class="lts_progress '+prgrsround+' '+prgrstripe+' progress_'+prgrsstyle+'"><span>'+prgrstxt+'%</span><div class="lts_progress_wrap"><div title="'+prgrstxt+'%" class="lts_progress_inner" style="width:'+prgrstxt+'%;color:'+prgrscolor+';background-color:'+prgrsbg+';"></div></div></div>';
										}
										
										
										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".progress_prev").remove();
										jQuery(".progress_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview progress_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".progress_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
										
										if(prgrsstyle == 'circular'){
												var prgrspercent = (prgrstxt / 100);
												jQuery('.lts_progress').after('<div class="progress_circular"><div class="circle_progress" data-progress="'+prgrspercent+'" data-background="'+prgrsbg+'"><strong>'+prgrstxt+'%</strong></div></div><div class="progress_circular_title">'+prgrstt+'</div>');
												jQuery('.lts_progress, .progress_default_tt').hide();
												jQuery('.circle_progress').circleProgress({ value: jQuery('.circle_progress').data('progress'), size: 160, fill: { color: jQuery('.circle_progress').data('background') } });
										}
										
										
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".progress_prev").remove();
                           }
									});
									}, 500);
									//PREVIEW END

							},

						},	
/*----------------------------PRICING BOX---------------------------*/
						{
							text: 'Pricing Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Pricing Box',
									width: 860,
									height: 500,
									body: [
										{
											type: 'label',
											name: 'pricinGnrlHeader',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold;">Style Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
											classes: 'formathtml',
										},
										{
											type: 'textbox',
											name: 'PricingBackground',
											label: 'Pricing Box Background Color',
											classes: 'colpix prcbg',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'PricingColor',
											label: 'Pricing Box text Color',
											classes: 'colpix prcolor',
											value: '#999999',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'PricingButtonBg',
											label: 'Pricing Button Background Color',
											classes: 'colpix prcbtnbg',
											value: '#b3db67',
											multiline: false,
											minWidth: 300,
										},
										{
											type: 'textbox',
											name: 'PricingButtonColor',
											label: 'Pricing Button Color',
											classes: 'colpix prcbtncolor',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
										},
										
										{
											type: 'listbox',
											name: 'PricingStyle',
											label: 'Style',
											classes: 'btn widget pricing_style',
											'values': [
												{text: 'Style 1', value: '1'},
												{text: 'Style 2', value: '2'},
												{text: 'Style 3', value: '3'},
												{text: 'Style 4', value: '4'},
												{text: 'Style 5', value: '5'}
											]
										},
										
										//1st PRICING BOX 
										{
											type: 'label',
											name: 'pricingOneSettings',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold;">1st Pricing Box Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
											classes: 'poneformathtml',
										},
										{
											type: 'textbox',
											name: 'pricingOneName',
											label: 'Name*',
											classes: 'prc1_name',
											value: 'Small',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingOnePrice',
											label: 'Price',
											classes: 'prc1_price',
											value: '$19',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingOnePer',
											label: 'Price label',
											classes: 'prc1_label',
											value: 'month',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingOneDesc',
											label: 'Description',
											classes: 'prc1_desc',
											value: '',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 80,
										},
										{
											type: 'label',
											name: 'pricingFeatHeader',
											label: '',
											text: 'Features',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
										},
										{
											type: 'textbox',
											name: 'pricingOneFeat',
											label: 'Features',
											value: '<ul><li>2gb Storage</li><li>Unlimited Downloads</li><li>Forum Support</li></ul>',
											classes: 'lts_pricingonefeat',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 300,
										},
										{
											type: 'textbox',
											name: 'pricingOneBtnTxt',
											label: 'Button Text',
											classes: 'prc1_btntxt',
											value: 'Buy Now',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingOneBtnUrl',
											label: 'Button Text Link',
											classes: 'prc1_btnlink',
											value: '',
											multiline: false,
											minWidth: 300,
											maxWidth: 550,
										},
										{
											type: 'textbox',
											name: 'pricingOneRibbon',
											label: 'Featured Ribbon Text',
											classes: 'prc1_btnribon',
											tooltip: 'Keep this field empty to hide the Ribbon from this Pricing box',
											value: '',
											multiline: false,
											minWidth: 100,
											maxWidth: 100
										},
										
										//2nd PRICING BOX 
										{
											type: 'label',
											name: 'pricingTwoSettings',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold;">2nd Pricing Box Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
											classes: 'ptwoformathtml',
										},
										{
											type: 'textbox',
											name: 'pricingTwoName',
											label: 'Name*',
											classes: 'prc2_name',
											value: 'Large',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingTwoPrice',
											label: 'Price',
											classes: 'prc2_price',
											value: '$29',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingTwoPer',
											label: 'Price label',
											classes: 'prc2_label',
											value: 'month',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingTwoDesc',
											label: 'Description',
											classes: 'prc2_desc',
											value: '',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 80,
										},
										{
											type: 'label',
											name: 'pricingTwoFeatHeader',
											label: '',
											text: 'Features',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
										},
										{
											type: 'textbox',
											name: 'pricingTwoFeat',
											label: 'Features',
											value: '<ul><li>10gb Storage</li><li>Unlimited Downloads</li><li>Email Support</li></ul>',
											classes: 'lts_pricingtwofeat',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 300,
										},
										{
											type: 'textbox',
											name: 'pricingTwoBtnTxt',
											label: 'Button Text',
											classes: 'prc2_btntxt',
											value: 'Buy Now',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',

											name: 'pricingTwoBtnUrl',
											label: 'Button Text Link',
											classes: 'prc2_btnlink',
											value: '',
											multiline: false,
											minWidth: 300,
											maxWidth: 550,
										},
										{
											type: 'textbox',
											name: 'pricingTwoRibbon',
											label: 'Featured Ribbon Text',
											classes: 'prc2_btnribon',
											tooltip: 'Keep this field empty to hide the Ribbon from this Pricing box',
											value: 'PRO',
											multiline: false,
											minWidth: 100,
											maxWidth: 100
										},
										
										//3rd PRICING BOX 
										{
											type: 'label',
											name: 'pricingThreeSettings',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold;">3rd Pricing Box Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
											classes: 'pthreeformathtml',
										},
										{
											type: 'textbox',
											name: 'pricingThreeName',
											label: 'Name*',
											classes: 'prc3_name',
											value: 'EnterPrise',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingThreePrice',
											label: 'Price',
											classes: 'prc3_price',
											value: '$49',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingThreePer',
											label: 'Price label',
											classes: 'prc3_label',
											value: 'month',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingThreeDesc',
											label: 'Description',
											classes: 'prc3_desc',
											value: '',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 80,
										},
										{
											type: 'label',
											name: 'pricingThreeFeatHeader',
											label: '',
											text: 'Features',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
										},
										{
											type: 'textbox',
											name: 'pricingThreeFeat',
											label: 'Features',
											value: '<ul><li>10gb Storage</li><li>Unlimited Downloads</li><li>Email Support</li></ul>',
											classes: 'lts_pricingthreefeat',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 300,
										},
										{
											type: 'textbox',
											name: 'pricingThreeBtnTxt',
											label: 'Button Text',
											classes: 'prc3_btntxt',
											value: 'Buy Now',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingThreeBtnUrl',
											label: 'Button Text Link',
											classes: 'prc3_btnlink',
											value: '',
											multiline: false,
											minWidth: 300,
											maxWidth: 550,
										},
										{
											type: 'textbox',
											name: 'pricingThreeRibbon',
											label: 'Featured Ribbon Text',
											classes: 'prc3_btnribon',
											tooltip: 'Keep this field empty to hide the Ribbon from this Pricing box',
											value: '',
											multiline: false,
											minWidth: 100,
											maxWidth: 100
										},
										
										//4th PRICING BOX 
										{
											type: 'label',
											name: 'pricingFourSettings',
											label: '',
											text: '<h3 style="font-size: 16px!important;font-weight: bold;">4th Pricing Box Settings</h3>',
											style: 'width: 90%;border-bottom: 1px solid #eee;',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
											classes: 'pfourformathtml',
										},
										{
											type: 'textbox',
											name: 'pricingFourName',
											label: 'Name*',
											classes: 'prc4_name',
											value: '',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingFourPrice',
											label: 'Price',
											classes: 'prc4_price',
											value: '',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingFourPer',
											label: 'Price label',
											classes: 'prc4_label',
											value: '',
											multiline: false,
											minWidth: 100,
											maxWidth: 100,
										},
										{
											type: 'textbox',
											name: 'pricingFourDesc',
											label: 'Description',
											classes: 'prc4_desc',
											value: '',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 80,
										},
										{
											type: 'label',
											name: 'pricingFourFeatHeader',
											label: '',
											text: 'Features',
											minWidth: 300,
											maxWidth: 550,
											minHeight: 30,
										},
										{
											type: 'textbox',
											name: 'pricingFourFeat',
											label: 'Features',
											value: '',
											classes: 'lts_pricingfourfeat',
											multiline: true,
											minWidth: 300,
											maxWidth: 550,
											minHeight: 300,
										},
										{
											type: 'textbox',
											name: 'pricingFourBtnTxt',
											label: 'Button Text',
											classes: 'prc4_btntxt',
											value: 'Buy Now',
											multiline: false,
											minWidth: 150,
											maxWidth: 150,
										},
										{
											type: 'textbox',
											name: 'pricingFourBtnUrl',
											label: 'Button Text Link',
											classes: 'prc4_btnlink',
											value: '',
											multiline: false,
											minWidth: 300,
											maxWidth: 550,
										},
										{
											type: 'textbox',
											name: 'pricingFourRibbon',
											label: 'Featured Ribbon Text',
											classes: 'prc4_btnribon',
											tooltip: 'Keep this field empty to hide the Ribbon from this Pricing box',
											value: '',
											multiline: false,
											minWidth: 100,
											maxWidth: 100
										},
										
									],
									onsubmit: function( e ) {
									var getponeiframe = jQuery('.mce-lts_pricingonefeat').parent().find('iframe').attr('id');
									var poneupdatedHtml = jQuery('#' + getponeiframe + '').contents().find('body').html();
									var getptwoiframe = jQuery('.mce-lts_pricingtwofeat').parent().find('iframe').attr('id');
									var ptwoupdatedHtml = jQuery('#' + getptwoiframe + '').contents().find('body').html();
									var getpthreeiframe = jQuery('.mce-lts_pricingthreefeat').parent().find('iframe').attr('id');
									var pthreeupdatedHtml = jQuery('#' + getpthreeiframe + '').contents().find('body').html();
									var getpfouriframe = jQuery('.mce-lts_pricingfourfeat').parent().find('iframe').attr('id');
									var pfourupdatedHtml = jQuery('#' + getpfouriframe + '').contents().find('body').html();
									
										editor.insertContent( '[pricing style="' + e.data.PricingStyle + '" background="' + e.data.PricingBackground + '" text_color="' + e.data.PricingColor + '" button_bg_color="' + e.data.PricingButtonBg + '" button_text_color="' + e.data.PricingButtonColor + '"][pricebox name="' + e.data.pricingOneName + '" description="' + e.data.pricingOneDesc + '" features="'+poneupdatedHtml+'" price="' + e.data.pricingOnePrice + '" price_label="'+e.data.pricingOnePer+'" button_text="'+e.data.pricingOneBtnTxt+'" button_link="'+e.data.pricingOneBtnUrl+'" featured="'+e.data.pricingOneRibbon+'"][pricebox name="' + e.data.pricingTwoName + '" description="' + e.data.pricingTwoDesc + '" features="'+ptwoupdatedHtml+'" price="' + e.data.pricingTwoPrice + '" price_label="'+e.data.pricingTwoPer+'" button_text="'+e.data.pricingTwoBtnTxt+'" button_link="'+e.data.pricingTwoBtnUrl+'" featured="'+e.data.pricingTwoRibbon+'"][pricebox name="' + e.data.pricingThreeName + '" description="' + e.data.pricingThreeDesc + '" features="'+pthreeupdatedHtml+'" price="' + e.data.pricingThreePrice + '" price_label="'+e.data.pricingThreePer+'" button_text="'+e.data.pricingThreeBtnTxt+'" button_link="'+e.data.pricingThreeBtnUrl+'" featured="'+e.data.pricingThreeRibbon+'"][pricebox name="' + e.data.pricingFourName + '" description="' + e.data.pricingFourDesc + '" features="'+pfourupdatedHtml+'" price="' + e.data.pricingFourPrice + '" price_label="'+e.data.pricingFourPer+'" button_text="'+e.data.pricingFourBtnTxt+'" button_link="'+e.data.pricingFourBtnUrl+'" featured="'+e.data.pricingFourRibbon+'"][/pricing]');
									}
								});
								//CONVERT TEXT TO HTML
								jQuery(".mce-formathtml").html(jQuery(".mce-formathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-poneformathtml").html(jQuery(".mce-poneformathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-ptwoformathtml").html(jQuery(".mce-ptwoformathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-pthreeformathtml").html(jQuery(".mce-pthreeformathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								jQuery(".mce-pfourformathtml").html(jQuery(".mce-pfourformathtml").html().replace(/&lt;/g, '<').replace(/&gt;/g, '>') );
								//CALL THE COLORPICKER
								optimColpick();		
								//CALL THE COLORPICKER END
								
								//LOAD INNER TINYMCE
								optimTinyLight('.mce-lts_pricingonefeat', 'pricingone_id');
								optimTinyLight('.mce-lts_pricingtwofeat', 'pricingtwo_id');
								optimTinyLight('.mce-lts_pricingthreefeat', 'pricingthree_id');
								optimTinyLight('.mce-lts_pricingfourfeat', 'pricingfour_id');
								
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Pricing Box"]').addClass('pricing_window');
									jQuery(".pricing_window .mce-foot>div").prepend("<a class='short_preview_btn pricing_prevbtn'><span></span>Preview</a>");
									jQuery('.pricing_prevbtn').on('click',function(){
                           if(!jQuery(this).hasClass("short_prev_on")){
										//Save TinyMce fields
										tinyMCE.triggerSave();
										//GET PREVIEW CONTENT	[EDIT]
										var prcbg = jQuery('.mce-prcbg').val();
										var prcolor = jQuery('.mce-prcolor').val();
										var prcbtnbg = jQuery('.mce-prcbtnbg').val();
										var prcbtncolor = jQuery('.mce-prcbtncolor').val();
										var prcstyle = jQuery('.mce-pricing_style button').text();
										
										var prc1_name = jQuery('.mce-prc1_name').val();
										var prc1_price = jQuery('.mce-prc1_price').val();
										var prc1_label = jQuery('.mce-prc1_label').val();
										var prc1_desc = jQuery('.mce-prc1_desc').val();
										var prc1_feat = jQuery('.mce-lts_pricingonefeat').val();
										var prc1_btntxt = jQuery('.mce-prc1_btntxt').val();
										var prc1_btnlink = jQuery('.mce-prc1_btnlink').val();
										var prc1_btnribon = jQuery('.mce-prc1_btnribon').val();
										
										var prc2_name = jQuery('.mce-prc2_name').val();
										var prc2_price = jQuery('.mce-prc2_price').val();
										var prc2_label = jQuery('.mce-prc2_label').val();
										var prc2_desc = jQuery('.mce-prc2_desc').val();
										var prc2_feat = jQuery('.mce-lts_pricingtwofeat').val();
										var prc2_btntxt = jQuery('.mce-prc2_btntxt').val();
										var prc2_btnlink = jQuery('.mce-prc2_btnlink').val();
										var prc2_btnribon = jQuery('.mce-prc2_btnribon').val();
										
										var prc3_name = jQuery('.mce-prc3_name').val();
										var prc3_price = jQuery('.mce-prc3_price').val();
										var prc3_label = jQuery('.mce-prc3_label').val();
										var prc3_desc = jQuery('.mce-prc3_desc').val();
										var prc3_feat = jQuery('.mce-lts_pricingthreefeat').val();
										var prc3_btntxt = jQuery('.mce-prc3_btntxt').val();
										var prc3_btnlink = jQuery('.mce-prc3_btnlink').val();
										var prc3_btnribon = jQuery('.mce-prc3_btnribon').val();
										
										var prc4_name = jQuery('.mce-prc4_name').val();
										var prc4_price = jQuery('.mce-prc4_price').val();
										var prc4_label = jQuery('.mce-prc4_label').val();
										var prc4_desc = jQuery('.mce-prc4_desc').val();
										var prc4_feat = jQuery('.mce-lts_pricingfourfeat').val();
										var prc4_btntxt = jQuery('.mce-prc4_btntxt').val();
										var prc4_btnlink = jQuery('.mce-prc4_btnlink').val();
										var prc4_btnribon = jQuery('.mce-prc4_btnribon').val();
                                                   
                              if(prc1_label !==''){prc1_label = '<span class="price_label">/'+prc1_label+'</span>';}else{prc1_label = '';}
                              if(prc2_label !==''){prc2_label = '<span class="price_label">/'+prc2_label+'</span>';}else{prc2_label = '';}
                              if(prc3_label !==''){prc3_label = '<span class="price_label">/'+prc3_label+'</span>';}else{prc3_label = '';}
                              if(prc4_label !==''){prc4_label = '<span class="price_label">/'+prc4_label+'</span>';}else{prc4_label = '';}
                           
                              if(prc1_btnribon !==''){prc1_btnribon = '<span class="feat_wrap"><span class="pricebox_featured">'+prc1_btnribon+'</span></span>';}else{prc1_btnribon = '';}
                              if(prc2_btnribon !==''){prc2_btnribon = '<span class="feat_wrap"><span class="pricebox_featured">'+prc2_btnribon+'</span></span>';}else{prc2_btnribon = '';}
                              if(prc3_btnribon !==''){prc3_btnribon = '<span class="feat_wrap"><span class="pricebox_featured">'+prc3_btnribon+'</span></span>';}else{prc3_btnribon = '';}
                              if(prc4_btnribon !==''){prc4_btnribon = '<span class="feat_wrap"><span class="pricebox_featured">'+prc4_btnribon+'</span></span>';}else{prc4_btnribon = '';}
                                 
                              if(prc1_name !==''){prc1 = '<div class="pricebox"><div class="pricebox_inner">'+prc1_btnribon+'<div class="price_head"><h3>'+prc1_name+'</h3><span class="price_ammount">'+prc1_price+'</span>'+prc1_label+'<p class="price_desc">'+prc1_desc+'</p></div><div class="price_body">'+prc1_feat+'</div><div class="price_footer"><a href="'+prc1_btnlink+'" class="price_button">'+prc1_btntxt+'</a></div></div></div>';}else{prc1 = '';}
                              if(prc2_name !==''){prc2 = '<div class="pricebox"><div class="pricebox_inner">'+prc2_btnribon+'<div class="price_head"><h3>'+prc2_name+'</h3><span class="price_ammount">'+prc2_price+'</span>'+prc2_label+'<p class="price_desc">'+prc2_desc+'</p></div><div class="price_body">'+prc2_feat+'</div><div class="price_footer"><a href="'+prc2_btnlink+'" class="price_button">'+prc2_btntxt+'</a></div></div></div>';}else{prc2 = '';}
                              if(prc3_name !==''){prc3 = '<div class="pricebox"><div class="pricebox_inner">'+prc3_btnribon+'<div class="price_head"><h3>'+prc3_name+'</h3><span class="price_ammount">'+prc3_price+'</span>'+prc3_label+'<p class="price_desc">'+prc3_desc+'</p></div><div class="price_body">'+prc3_feat+'</div><div class="price_footer"><a href="'+prc3_btnlink+'" class="price_button">'+prc3_btntxt+'</a></div></div></div>';}else{prc3 = '';}
                              if(prc4_name !==''){prc4 = '<div class="pricebox"><div class="pricebox_inner">'+prc4_btnribon+'<div class="price_head"><h3>'+prc4_name+'</h3><span class="price_ammount">'+prc4_price+'</span>'+prc4_label+'<p class="price_desc">'+prc4_desc+'</p></div><div class="price_body">'+prc4_feat+'</div><div class="price_footer"><a href="'+prc4_btnlink+'" class="price_button">'+prc4_btntxt+'</a></div></div></div>';}else{prc4 = '';}
                                                      
										if(prc1_name =='' && prc2_name ==''){
											var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
										}else{
											var shortcontent = '<div class="lts_pricing '+prcstyle.replace('Style ','pricing_style')+'" style="color:'+prcolor+'" data-button-bg="'+prcbtnbg+'" data-button-txt="'+prcbtncolor+'" data-price-bg="'+prcbg+'" data-price-txt="'+prcolor+'">'+prc1+''+prc2+''+prc3+''+prc4+'</div>';
										}

										//GET PREVIEW CONTENT END
										jQuery(this).addClass("short_prev_on");
										jQuery(".pricing_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
										jQuery(".pricing_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview pricing_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
										jQuery(".pricing_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
										
                              jQuery('.pricebox').has('.pricebox_featured').addClass('feat_price');
                              
                              jQuery(".lts_pricing").each(function(){
                                 var button_bg = jQuery(this).attr('data-button-bg');
                                 var button_color = jQuery(this).attr('data-button-txt');
                                 var pricebox_bg = jQuery(this).attr('data-price-bg');
                                 var pricebox_txt = jQuery(this).attr('data-price-txt');
                                 //Convert Background Color to RGBA
                                 var rgbaCol = 'rgba(' + parseInt(button_bg.slice(-6,-4),16)
                                    + ',' + parseInt(button_bg.slice(-4,-2),16)
                                    + ',' + parseInt(button_bg.slice(-2),16)
                                    +',0.3)';
                                 
                                 jQuery(this).find('.price_button, .pricebox_featured').attr('style', 'color:'+button_color+'!important;background:'+button_bg+';');
                                 jQuery(this).find('.price_button').css({"borderColor":button_bg});
                                 jQuery(this).find('.pricebox').css({"background":pricebox_bg});
                                 
                                 jQuery('.pricing_style1 .pricebox_inner').hover(function(){
                                    jQuery(this).stop().animate({"borderColor": rgbaCol});
                                    jQuery(this).find('.price_head h3').stop().animate({"backgroundColor": rgbaCol, "color":button_color});
                                 }, function(){
                                    jQuery(this).stop().animate({"borderColor": "rgba(0, 0, 0, 0.04)"});
                                    jQuery(this).find('.price_head h3').stop().animate({"backgroundColor": 'rgba(0, 0, 0, 0.02)', "color":pricebox_txt});
                                 });
                              });
                              
                              jQuery(".lts_pricing.pricing_style5").each(function(){
                                 var button_bg = jQuery(this).attr('data-button-bg');
                                 var button_color = jQuery(this).attr('data-button-txt');
                                 var rgbaCol = 'rgba(' + parseInt(button_bg.slice(-6,-4),16)
                                    + ',' + parseInt(button_bg.slice(-4,-2),16)
                                    + ',' + parseInt(button_bg.slice(-2),16)
                                    +',0.5)';
                                 jQuery(this).find('.price_head h3').css({"backgroundColor":rgbaCol});
                                 jQuery(this).find('.pricebox').each(function(){
                                    jQuery(this).find('.price_ammount, .price_label').insertAfter(jQuery(this).find('.price_body'));
                                 });
                              });
										
										
										
									}else{
										jQuery(this).removeClass("short_prev_on");
                              jQuery(".pricing_prev, .lts_lightbox_blank, .lts_lightbox_content").remove();
                           }
									});
									}, 500);
									//PREVIEW END
								
							},
							
							
						},	
/*----------------------------MAP---------------------------*/
								{
							text: 'Search Form',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Search Form',
									width: 860,
									height: 200,
									body: [
										{
											type: 'textbox',
											name: 'searchLabel',
											label: 'Search Form Label',
											value: 'Search',
											multiline: false,
											minWidth: 300,
											classes: 'searchlabel',
										},
										{
											type: 'textbox',
											name: 'searchLabelColor',
											label: 'Label Text Color',
											value: '#ffffff',
											multiline: false,
											minWidth: 300,
											classes: 'colpix searchtxtcolor',
										},
										{
											type: 'textbox',
											name: 'searchLabelBackground',
											label: 'Label Background Color',
											value: '#333333',
											multiline: false,
											minWidth: 300,
											classes: 'colpix searchbgcolor',
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[searchform label="' + e.data.searchLabel + '" text_color="' + e.data.searchLabelColor + '" background_color="' + e.data.searchLabelBackground + '"]');
									}
								});
								//Colpick
								optimColpick();
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									setTimeout(function(){ 	
									jQuery('[aria-label="Search Form"]').addClass('search_window');
									jQuery(".search_window .mce-foot>div").prepend("<a class='short_preview_btn search_prevbtn'><span></span>Preview</a>");
									jQuery('.search_prevbtn').on('click',function(){
                              if(!jQuery(this).hasClass("short_prev_on")){
                                 //Save TinyMce fields
                                 tinyMCE.triggerSave();
                                 //GET PREVIEW CONTENT	[EDIT]
                                 var searchlabel = jQuery('.mce-searchlabel').val()
                                 var searchtxtcolor = jQuery('.mce-searchtxtcolor').val();
                                 var searchbgcolor = jQuery('.mce-searchbgcolor').val();
                                 
                                 if(searchlabel ==''){
                                    var shortcontent = '<h3 class="no_shortcode">No Content Found!</h3>';
                                 }else{
                                    var shortcontent = '<form role="search" method="get" class="lts_search-form" action=""><input type="search" class="search-field" placeholder="'+searchlabel+'" value="" name="s" /><input type="submit" class="search-submit" value="'+searchlabel+'" style="color:'+searchtxtcolor+';background:'+searchbgcolor+';"/></form>';
                                 }
                                 //GET PREVIEW CONTENT END
                                 jQuery(this).addClass("short_prev_on");
                                 jQuery(".search_prev").remove();
                                 jQuery(".search_window .mce-window-head").next('.mce-container-body').find('.mce-container').first().prepend("<div class='short_preview search_prev'><div class='short_preview_inner'>"+shortcontent+"</div></div>");
                                 jQuery(".search_prev").css({"height":jQuery(".mce-window-head").next('.mce-container-body').height()});
                              }else{
                                 jQuery(this).removeClass("short_prev_on");
                                 jQuery(".search_prev").remove();
                              }
									});
									}, 500);
									//PREVIEW END
							},
							
							
						},	
/*----------------------------Divider---------------------------*/
						{
							text: 'Breadcrumbs',
							onclick: function() {
								editor.windowManager.open( {
									title: 'Breadcrumbs',
									width: 860,
									height: 200,
									body: [
										{
											type: 'listbox',
											name: 'breadAlign',
											label: 'Alignment',
											classes: 'widget btn bread_style',
											'values': [
												{text: 'Center', value: 'center'},
												{text: 'Left', value: 'left'},
												{text: 'Right', value: 'right'},
											]
										},
										
									],
									onsubmit: function( e ) {
										editor.insertContent( '[breadcrumbs align="' + e.data.breadAlign + '"]');
									}
								});
								//CALL THE COLORPICKER
								optimColpick();								
								//CALL THE COLORPICKER END
								//WINDOW Styles
								optimMceWindow();
								
									//PREVIEW WINDOW
									jQuery('[aria-label="Breadcrumbs"]').addClass('breadcrumbs_window');
									jQuery(".posts_window .mce-foot>div").prepend("<a class='short_preview_btn posts_prevbtn'><i class='fa fa-eye-slash'></i> No Preview Available</a>");
									//PREVIEW END
							},
							
							
						},		
									
//END	

					],
					},	
					

//-----------------------------SEPCIAL END-------------------------------									
			]
		});
	});
})();

//MCE WINDOW STYLE FUNCTION
function optimMceWindow(){
	//WINDOW Styles
	jQuery(".mce-window .mce-foot button").first().text("Insert");
	jQuery(".mce-window-head").next('.mce-container-body').css({"position":"relative", "top":"30px", "overflowY":"hidden", "overflowX":"hidden"});	
	//jQuery(".mce-window-head").next('.mce-container-body').perfectScrollbar();
}
//TINYMCE EDITOR WITH SHORTCODE FUNCTION
function optimTinyHeavy(x, y){
	tinymce.init({selector: x, plugins: ["image media textcolor optimizer_mce_button"], toolbar: " bold italic underline forecolor alignleft aligncenter alignright alignjustify bullist numlist media removeformat fontsizeselect formatselect optimizer_mce_button", convert_urls: false, relative_urls: false, body_id: y,forced_root_block : false, menubar:false, height:200});	
}
//TINYMCE EDITOR WITH NO SHORTCODE FUNCTION	
function optimTinyLight(x, y){
	tinymce.init({selector: x, plugins: ["image media textcolor"], toolbar: " bold italic underline forecolor alignleft aligncenter alignright alignjustify bullist numlist media removeformat fontsizeselect formatselect", body_id: y,forced_root_block : false, convert_urls: false, relative_urls: false, menubar:false, height:200});
}
//MEDIA Library FUNCTION
function optimMedia(x, y){
	jQuery(x).click(function(e){var t;if(t){t.open();return}t=wp.media.frames.file_frame=wp.media({title:"Add Media",button:{text:"Insert Image"},multiple:false});t.on("select",function(){attachment=t.state().get("selection").first().toJSON();var e=jQuery(y).attr("id");var n='<img class="wp-attachment" title="'+attachment.title+'" src="'+attachment.url+'"/>';tinymce.get(e).execCommand("mceInsertContent",false,n);console.log(jQuery(y).attr("id"))});t.open()});
}
//Colpick FUNCTION
function optimColpick(){
	jQuery(".mce-colpix").each(function(){jQuery(this).css({"borderColor": jQuery(this).val()})});
	jQuery(".mce-colpix").colpick({layout:'hex',submit:0,colorScheme:'dark',onChange:function(hsb,hex,rgb,el,bySetColor) {
	jQuery(el).css('border-color','#'+hex);
	if(!bySetColor) jQuery(el).val('#'+hex);}}).keyup(function(){jQuery(this).colpickSetColor(this.value);});
}
jQuery(".mce-close").on("click",function(){
	jQuery(".short_preview").remove();
});
jQuery("div.icon_select_header .close_icon_select").on("click",function() {
		jQuery(".package").fadeOut();
});
//YOUTUBE/VIMEO URL TO ID FUNCTION
function videourl(pastedData) {
var success = false;
var media   = {};
if (pastedData.match('https://(www.)?youtube|youtu\.be')) {
    if (pastedData.match('embed')) { youtube_id = pastedData.split(/embed\//)[1].split('"')[0]; }
    else { youtube_id = pastedData.split(/v\/|v=|youtu\.be\//)[1].split(/[?&]/)[0]; }
    media.type  = "youtube";
    media.id    = youtube_id;
    success = true;
}
else if (pastedData.match('http://(player.)?vimeo\.com')) {
    vimeo_id = pastedData.split(/video\/|http:\/\/vimeo\.com\//)[1].split(/[?&]/)[0];
    media.type  = "vimeo";
    media.id    = vimeo_id;
    success = true;
}
if (success) { return media.id; }
else { alert("No valid media id detected"); }
return false;
}
function closeclick(){  jQuery(".lts_lightbox_content, .lts_lightbox_blank").hide();  }
//jQuery Rotate naimation
(function(e){e.fn.animateRotate=function(t,n,r,i){return this.each(function(){var s=e(this);e({deg:0}).animate({deg:t},{duration:n,easing:r,step:function(e){s.css({transform:"rotate("+e+"deg)"})},complete:i||e.noop})})}})(jQuery);

/*tinymce noneditable plugin*/
tinymce.PluginManager.add("noneditable",function(a){function b(a){return function(b){return-1!==(" "+b.attr("class")+" ").indexOf(a)}}function c(b){function c(b){var c=arguments,d=c[c.length-2];return d>0&&'"'==g.charAt(d-1)?b:'<span class="'+h+'" data-mce-content="'+a.dom.encode(c[0])+'">'+a.dom.encode("string"==typeof c[1]?c[1]:c[0])+"</span>"}var d=f.length,g=b.content,h=tinymce.trim(e);if("raw"!=b.format){for(;d--;)g=g.replace(f[d],c);b.content=g}}var d,e,f,g="contenteditable";d=" "+tinymce.trim(a.getParam("noneditable_editable_class","mceEditable"))+" ",e=" "+tinymce.trim(a.getParam("noneditable_noneditable_class","mceNonEditable"))+" ";var h=b(d),i=b(e);f=a.getParam("noneditable_regexp"),f&&!f.length&&(f=[f]),a.on("PreInit",function(){f&&a.on("BeforeSetContent",c),a.parser.addAttributeFilter("class",function(a){for(var b,c=a.length;c--;)b=a[c],h(b)?b.attr(g,"true"):i(b)&&b.attr(g,"false")}),a.serializer.addAttributeFilter(g,function(a){for(var b,c=a.length;c--;)b=a[c],(h(b)||i(b))&&(f&&b.attr("data-mce-content")?(b.name="#text",b.type=3,b.raw=!0,b.value=b.attr("data-mce-content")):b.attr(g,null))})})});

/*tinymce Save plugin*/
tinymce.PluginManager.add("save",function(a){function b(){var b;return b=tinymce.DOM.getParent(a.id,"form"),!a.getParam("save_enablewhendirty",!0)||a.isDirty()?(tinymce.triggerSave(),a.getParam("save_onsavecallback")?(a.execCallback("save_onsavecallback",a),void a.nodeChanged()):void(b?(a.setDirty(!1),b.onsubmit&&!b.onsubmit()||("function"==typeof b.submit?b.submit():c(a.translate("Error: Form submit field collision."))),a.nodeChanged()):c(a.translate("Error: No form element found.")))):void 0}function c(b){a.notificationManager.open({text:b,type:"error"})}function d(){var b=tinymce.trim(a.startContent);return a.getParam("save_oncancelcallback")?void a.execCallback("save_oncancelcallback",a):(a.setContent(b),a.undoManager.clear(),void a.nodeChanged())}function e(){var b=this;a.on("nodeChange dirty",function(){b.disabled(a.getParam("save_enablewhendirty",!0)&&!a.isDirty())})}a.addCommand("mceSave",b),a.addCommand("mceCancel",d),a.addButton("save",{icon:"save",text:"",tooltip:"Save Changes",cmd:"mceSave",classes: 'inline_save_bttn', disabled:!0,onPostRender:e}),a.addButton("cancel",{text:"Cancel",icon:!1,cmd:"mceCancel",disabled:!0,onPostRender:e}),a.addShortcut("Meta+S","","mceSave")});

/*Tinymce Inline Media Plugin*/
tinymce.PluginManager.add('optimedia', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('optimedia', {
        text: '',
        icon: 'image',
		tooltip: 'Media',
        onclick: function() {
			jQuery('#insert-media-button').trigger('click');
        }
    });
});

/*Tinymce Inline Shortcode Editor Plugin*/
tinymce.PluginManager.add('shorty', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('shorty', {
        text: '',
        icon: 'pluscircle',
		type: 'menubutton',
		tooltip: 'Shortcodes',
		classes: 'inline_shorty',
		menu: [
				//Button Shortcode
				{
					text: '',
					icon: 'fullscreen',
					tooltip: 'Button Shortcode',
					classes: 'btn_shorty',	
					onclick: function() {
						 var btncontent = '<a class="lts_button lts_button_default lt_rounded lt_flat inline_shortcode" target="_blank" style="background: #2dcb73; color: #ffffff; border-color: #2dcb73;" data-shortcode="[button text=&quot;Click My Button&quot; url=&quot;http://google.com&quot; background_color=&quot;#2dcb73&quot; text_color=&quot;#ffffff&quot; style=&quot;lt_flat&quot; size=&quot;default&quot; icon=&quot;&quot; open_new_window=&quot;true&quot; rounded=&quot;true&quot;]" data-btn-text="Click My Button" data-btn-url="http://google.com" data-btn-bg="#2dcb73" data-btn-color="#ffffff" data-btn-style="lt_flat" data-btn-size="default" data-btn-icon="" data-btn-window="true" data-btn-rounded="true" data-mce-style="background: #2dcb73; color: #ffffff; border-color: #2dcb73;">Click My Button</a>';
						 tinymce.activeEditor.insertContent(btncontent);
					}
				},
				//Column 2 Shortcode
				{
					text: '',
					icon: 'image',
					tooltip: 'Column 2 Shortcode',
					classes: 'col2_shorty',	
					onclick: function() {
						 var col2content = '<div class="col2wrap"><div class="col2 shortcol inline_shortcode" data-width="50%" contenteditable="true" data-shortcode="[col2 width=&quot;50%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col2]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div><div class="col2 shortcol inline_shortcode" data-width="50%" contenteditable="true" data-shortcode="[col2 width=&quot;50%&quot;]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.[/col2]">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div></div>';
						 tinymce.activeEditor.insertContent(col2content);
					}
				},
				//Column 3 Shortcode
				{
					text: '',
					icon: 'fullscreen',
					tooltip: 'Column 3 Shortcode',
					classes: 'col3_shorty',	
					onclick: function() {
						 var col3content = '<div class="col3wrap"><div class="col3 shortcol inline_shortcode" data-width="33%" contenteditable="true" data-shortcode="[col3 width=&quot;33%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col3]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div><div class="col3 shortcol inline_shortcode" data-width="33%" contenteditable="true" data-shortcode="[col3 width=&quot;33%&quot;]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.[/col3]">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div><div class="col3 shortcol inline_shortcode" data-width="33%" contenteditable="true" data-shortcode="[col3 width=&quot;33%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col3]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div></div>';
						 tinymce.activeEditor.insertContent(col3content);
					}
				},
				//Column 4 Shortcode
				{
					text: '',
					icon: 'fullscreen',
					tooltip: 'Column 4 Shortcode',
					classes: 'col4_shorty',	
					onclick: function() {
						 var col4content = '<div class="col4wrap"><div class="col4 shortcol inline_shortcode" data-width="25%" contenteditable="true" data-shortcode="[col4 width=&quot;25%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col4]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div><div class="col4 shortcol inline_shortcode" data-width="25%" contenteditable="true" data-shortcode="[col4 width=&quot;25%&quot;]Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.[/col4]">Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</div><div class="col4 shortcol inline_shortcode" data-width="25%" contenteditable="true" data-shortcode="[col4 width=&quot;25%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col4]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div><div class="col4 shortcol inline_shortcode" data-width="25%" contenteditable="true" data-shortcode="[col4 width=&quot;25%&quot;]Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.[/col4]">Capitalise on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</div></div>';
						 tinymce.activeEditor.insertContent(col4content);
					}
				}
		
		]

    });
});


/*Tinymce Inline Fullscreen Editor Plugin*/
tinymce.PluginManager.add('fullmode', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('fullmode', {
        text: '',
        icon: 'fullscreen',
		tooltip: 'Full Editor',
		classes: 'inline_fullscreen',
        onclick: function() {
			 var widgetid = tinymce.activeEditor.getBody().id; var widgetid = jQuery("#"+widgetid).closest(".widget").attr("id"); wp.customize.preview.send( "fulleditor", widgetid );
        }
    });
});

/*Tinymce Inline Cancel Edit Plugin*/
tinymce.PluginManager.add('canceledit', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('canceledit', {
        text: '',
        icon: 'remove',
		tooltip: 'Cancel Changes',
		classes: 'inline_cancel',
        onclick: function() {
			var ed = tinymce.get(tinymce.activeEditor.getBody().id);
			ed.setContent(ed.init_content);
			console.log(ed);
			ed.isNotDirty = true; jQuery('.mce-edit-focus').removeClass('contentdirty');
			setTimeout(function(){ ed.isNotDirty = true; jQuery('.mce-edit-focus').removeClass('contentdirty'); }, 2010);
        }
    });
});

/*
jquery-circle-progress - jQuery Plugin to draw animated circular progress bars
URL: http://kottenator.github.io/jquery-circle-progress/
Author: Rostyslav Bryzgunov <kottenator@gmail.com>
Version: 1.1.3
License: MIT
*/
!function(i){function t(i){this.init(i)}t.prototype={value:0,size:100,startAngle:-Math.PI,thickness:"auto",fill:{gradient:["#3aeabb","#fdd250"]},emptyFill:"rgba(0, 0, 0, .1)",animation:{duration:1200,easing:"circleProgressEasing"},animationStartValue:0,reverse:!1,lineCap:"butt",constructor:t,el:null,canvas:null,ctx:null,radius:0,arcFill:null,lastFrameValue:0,init:function(t){i.extend(this,t),this.radius=this.size/2,this.initWidget(),this.initFill(),this.draw()},initWidget:function(){var t=this.canvas=this.canvas||i("<canvas>").prependTo(this.el)[0];t.width=this.size,t.height=this.size,this.ctx=t.getContext("2d")},initFill:function(){function t(){var t=i("<canvas>")[0];t.width=e.size,t.height=e.size,t.getContext("2d").drawImage(g,0,0,r,r),e.arcFill=e.ctx.createPattern(t,"no-repeat"),e.drawFrame(e.lastFrameValue)}var e=this,a=this.fill,n=this.ctx,r=this.size;if(!a)throw Error("The fill is not specified!");if(a.color&&(this.arcFill=a.color),a.gradient){var s=a.gradient;if(1==s.length)this.arcFill=s[0];else if(s.length>1){for(var l=a.gradientAngle||0,h=a.gradientDirection||[r/2*(1-Math.cos(l)),r/2*(1+Math.sin(l)),r/2*(1+Math.cos(l)),r/2*(1-Math.sin(l))],o=n.createLinearGradient.apply(n,h),c=0;c<s.length;c++){var d=s[c],u=c/(s.length-1);Array.isArray(d)&&(u=d[1],d=d[0]),o.addColorStop(u,d)}this.arcFill=o}}if(a.image){var g;a.image instanceof Image?g=a.image:(g=new Image,g.src=a.image),g.complete?t():g.onload=t}},draw:function(){this.animation?this.drawAnimated(this.value):this.drawFrame(this.value)},drawFrame:function(i){this.lastFrameValue=i,this.ctx.clearRect(0,0,this.size,this.size),this.drawEmptyArc(i),this.drawArc(i)},drawArc:function(i){var t=this.ctx,e=this.radius,a=this.getThickness(),n=this.startAngle;t.save(),t.beginPath(),this.reverse?t.arc(e,e,e-a/2,n-2*Math.PI*i,n):t.arc(e,e,e-a/2,n,n+2*Math.PI*i),t.lineWidth=a,t.lineCap=this.lineCap,t.strokeStyle=this.arcFill,t.stroke(),t.restore()},drawEmptyArc:function(i){var t=this.ctx,e=this.radius,a=this.getThickness(),n=this.startAngle;1>i&&(t.save(),t.beginPath(),0>=i?t.arc(e,e,e-a/2,0,2*Math.PI):this.reverse?t.arc(e,e,e-a/2,n,n-2*Math.PI*i):t.arc(e,e,e-a/2,n+2*Math.PI*i,n),t.lineWidth=a,t.strokeStyle=this.emptyFill,t.stroke(),t.restore())},drawAnimated:function(t){var e=this,a=this.el,n=i(this.canvas);n.stop(!0,!1),a.trigger("circle-animation-start"),n.css({animationProgress:0}).animate({animationProgress:1},i.extend({},this.animation,{step:function(i){var n=e.animationStartValue*(1-i)+t*i;e.drawFrame(n),a.trigger("circle-animation-progress",[i,n])}})).promise().always(function(){a.trigger("circle-animation-end")})},getThickness:function(){return this.thickness?this.thickness:this.size/14},getValue:function(){return this.value},setValue:function(i){this.animation&&(this.animationStartValue=this.lastFrameValue),this.value=i,this.draw()}},i.circleProgress={defaults:t.prototype},i.easing.circleProgressEasing=function(i,t,e,a,n){return(t/=n/2)<1?a/2*t*t*t+e:a/2*((t-=2)*t*t+2)+e},i.fn.circleProgress=function(e,a){var n="circle-progress",r=this.data(n);if("widget"==e){if(!r)throw Error('Calling "widget" method on not initialized instance is forbidden');return r.canvas}if("value"==e){if(!r)throw Error('Calling "value" method on not initialized instance is forbidden');if("undefined"==typeof a)return r.getValue();var s=arguments[1];return this.each(function(){i(this).data(n).setValue(s)})}return this.each(function(){var a=i(this),r=a.data(n),s=i.isPlainObject(e)?e:{};if(r)r.init(s);else{var l=i.extend({},a.data());"string"==typeof l.fill&&(l.fill=JSON.parse(l.fill)),"string"==typeof l.animation&&(l.animation=JSON.parse(l.animation)),s=i.extend(l,s),s.el=a,r=new t(s),a.data(n,r)}})}}(jQuery);