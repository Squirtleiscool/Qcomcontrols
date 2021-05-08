<?php 
/* 
*      Robo Gallery     
*      Version: 3.0.7 - 90614
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php

 */ 
?>

<div class="rbsDashboardGallery-div">
    <h2><?php _e( 'How To Configure Your First Gallery?', 'robo-gallery' );?></h2>
   
	<ol>
		<li><?php  echo sprintf( __('Click <a href="%s" target="_blank">Add Gallery link</a> on the left side menu.', 'robo-gallery' ), admin_url('edit.php?post_type='.ROBO_GALLERY_TYPE_POST.'&showDialog=1')); ?><br/></li>
		<li><?php _e( 'Define some Gallery title on top in another case title will be generated automatically when you click on save button.', 'robo-gallery' ); ?><br/></li>
		<li><?php _e( 'Click on Manage Images button on the right side to open section where you can upload or manage your gallery resources.', 'robo-gallery' ); ?><br/></li>
		<li><?php _e( 'After save of the Publish button, below title you can find Permalink field with direct link to the created gallery on front end.', 'robo-gallery' ); ?><br/></li>
	</ol>
    <p class="rbsDashboardGallery-p">
    	<strong><?php _e( 'That\'s it! Your first Robo Gallery Created!', 'robo-gallery' ); ?></strong>
    </p>
</div>

<div class="rbsDashboardGallery-div">
    <h2><?php _e( 'Robo Gallery is Gutenberg ready!', 'robo-gallery' );?></h2>
    <p class="rbsDashboardGallery-p">
    	<?php _e(' Current version tested and work properly in Gutenberg editor. Just create gallery and copy / paste shortcode of the selected gallery into Gutenberg post.', 'robo-gallery'); ?>
    </p>
</div>

<div class="rbsDashboardGallery-div">
    <h2><?php _e( 'Where to find Shortcode?', 'robo-gallery' );?></h2>
    <p class="rbsDashboardGallery-p">
    	<?php _e('In the gallery list last column contain shortcode of the every item in the list. Just click on this field and Shortcode will be copied to the clipboard. Another place where you can find shortcode - gallery settings / right side column widget.', 'robo-gallery'); ?>
    </p>
</div>

<div class="rbsDashboardGallery-div">
    <h2><?php _e( 'Need some Help ?', 'robo-gallery' );?></h2>
    <p class="rbsDashboardGallery-p"><?php
        echo sprintf(  __( 'If you have some questions or any kind of problems with gallery installation or configuration feel free to <a href="%s"  target="_blank">post ticket here</a>. ', 'robo-gallery' ), 'https://wordpress.org/support/plugin/robo-gallery' ); 
        ?> <br/>  <?php 
        echo sprintf(  __( 'If you have some new features request or some functionality update for our gallery plugin please <a href="%s"  target="_blank">post some message</a> with description.', 'robo-gallery' ), 'https://wordpress.org/support/plugin/robo-gallery' ); 
        ?>
    </p>
    <a class="button button-primary button-hero " href="https://wordpress.org/support/plugin/robo-gallery" target="_blank">POST SUPPORT TICKET</a>
</div>
