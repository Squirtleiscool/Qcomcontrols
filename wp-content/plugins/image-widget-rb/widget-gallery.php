<?php
/*  
 * RB Image Widget
 * Version:           1.0.0
 * Author:            RB  Team
 */

class rbsImageWidgetGallery {

  function __construct(){
 	/*  */   
  }

  static public function show( $ids ){
  	if( !empty( $ids ) )  echo do_shortcode('[robo-gallery id="'.$ids.'"]');
  }

}