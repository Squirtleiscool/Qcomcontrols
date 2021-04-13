<?php

/**
 * SEO PLUGIN SUPPORT
 *
 * Count the words in pages that are made with Optimizer Widgets 
 *
 * @package LayerFramework
 * 
 * @since  Optimizer 0.4.1
 */


function optimizer_rankmath_widget_analysis() {
	if ( class_exists( 'RankMath' ) && function_exists('optimizer_get_widget_data')){
		$screen = get_current_screen();
      if ( $screen->parent_base == 'edit' && $screen->id == 'page' ){ 

			 global $post;
			 $widgetized = get_post_meta( $post->ID, 'widgetized', true );
          $sidebarid = get_post_meta( $post->ID, 'page_sidebar', true );
          $widgetdata = optimizer_get_widget_data($sidebarid);
          $widgetdata = str_replace('"',"'",$widgetdata);
          $widgetdata = optimizer_highlight_focus_keywords('rankmath', $widgetdata);

            if($widgetized == '1' && $sidebarid !=='null' ){
               echo '<script>console.warn("RankMath!!!")</script>';
               echo '<script>
                     wp.hooks.addFilter( "rank_math_content", "optimizer", function(){
                        console.warn("RankMath Content Set!!!");
                        return `'.$widgetdata.'`;
                     } );
                     if(document.getElementById("widget_content_meta_html")){
                        document.getElementById("widget_content_meta_html").innerHTML = `'.$widgetdata.'`;
                     }
                  </script>';
            }
		}
   }
}
add_action('in_admin_footer', 'optimizer_rankmath_widget_analysis');


//_yoast_wpseo_focuskw

function optimizer_highlight_focus_keywords($service='yoast', $widgetdata) {
   if ( class_exists( 'RankMath' ) || class_exists( 'WPSEO_Recalculate' )){
      $metaKey = 'rank_math_focus_keyword';
      if($service === 'yoast'){
         $metaKey = '_yoast_wpseo_focuskw';
      }
      global $post;
      $focus_keyword = get_post_meta( $post->ID, $metaKey, true );
      if($focus_keyword){ 
         $focus_keywords = explode(',', $focus_keyword);  
         if(isset($focus_keywords[0])){
           $widgetdata = str_replace($focus_keywords[0],'<i class="optimizer_focus_key">'.$focus_keywords[0].'</i>',$widgetdata);
         }
         if(isset($focus_keywords[1])){
           $widgetdata = str_replace($focus_keywords[1],'<i class="optimizer_focus_other">'.$focus_keywords[1].'</i>',$widgetdata);
         }
         if(isset($focus_keywords[2])){
           $widgetdata = str_replace($focus_keywords[2],'<i class="optimizer_focus_other">'.$focus_keywords[2].'</i>',$widgetdata);
         }
      }
   }
   return $widgetdata;
}

function optimizer_yoast_widget_analysis() {
	if ( class_exists( 'WPSEO_Recalculate' ) && function_exists('optimizer_get_widget_data')){
			$screen = get_current_screen();
		 ?>
		<?php if ( $screen->parent_base == 'edit' && $screen->id == 'page' ){ 
		
			 global $post;
			 $widgetized = get_post_meta( $post->ID, 'widgetized', true );
          $sidebarid = get_post_meta( $post->ID, 'page_sidebar', true );
          $widgetdata = optimizer_get_widget_data($sidebarid);
          $widgetdata = optimizer_highlight_focus_keywords('yoast', $widgetdata);

					if($widgetized == '1' && $sidebarid !=='null' ){
						echo '<script>
							(function($) {
								$(window).on("load", function(){
									/**
									 * Set up the Yoast Optimizer WIDGET Analysis 
									 */
									YoastWidgetFAnalysis = function() {
										// Register with YoastSEO
										YoastSEO.app.registerPlugin("yoastWidgetAnalysis", {status: "ready"});
										YoastSEO.app.registerModification("content", this.addAcfFieldsToContent, "yoastWidgetAnalysis", 5);
									}
							
									YoastWidgetFAnalysis.prototype.addAcfFieldsToContent = function(data) {
										var optim_widget_content = "";
										
											optim_widget_content += `'.str_replace('"',"'",$widgetdata).'`;
							
										return data + optim_widget_content;
									};
							
									new YoastWidgetFAnalysis();
								});
							}(jQuery));
                     if(document.getElementById("widget_content_meta_html")){
                        document.getElementById("widget_content_meta_html").innerHTML = `'.$widgetdata.'`;
                     }
							</script>';
						}
				} ?>
		
	<?php } 
}
add_action('in_admin_footer', 'optimizer_yoast_widget_analysis');