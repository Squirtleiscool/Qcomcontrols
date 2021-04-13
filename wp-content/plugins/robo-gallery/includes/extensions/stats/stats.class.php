<?php
/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2019, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if ( ! defined( 'WPINC' ) ) exit;

class ROBO_GALLERY_STATS{

    protected $postType;
    protected $assetsUri;

    public function __construct($postType){
        $this->postType = $postType;
        $this->assetsUri = plugin_dir_url(__FILE__);
        add_action('admin_footer', array($this, 'script'));
    }

    public function script(){ 
        if ( 
        		rbs_gallery_get_current_post_type() == ROBO_GALLERY_TYPE_POST && 
        		rbs_gallery_is_edit_page('list') 
        ) {
        	?>
			<script type="text/javascript">
				(function ($, undefined){

					$(document).ready(function() {
				        $(".wp-admin.edit-php.post-type-robo_gallery_table .wrap .page-title-action:last").
				        	after("<a href='edit.php?post_type=robo_gallery_table&page=robo-gallery-stats' id='rbs_stats_button' class='page-title-action'><?php _e('Statistics Gallery', 'robo-gallery'); ?></a>");
				    });
					
				}(jQuery));
			</script>
        	<?php
        }
    }
}
