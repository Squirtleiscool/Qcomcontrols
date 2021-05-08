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

if ( ! defined( 'WPINC' ) ) exit;


class rbsGalleryListing extends roboGalleryClass{

    protected $postType;

    protected $title;

    public $view;

    /*  ==============   */
    public function __construct(){ 
    	if( rbs_gallery_get_current_post_type() != ROBO_GALLERY_TYPE_POST ) return ;
    	parent::__construct();
    	$this->postType = ROBO_GALLERY_TYPE_POST;
    	//$this->view = new rbsGalleryClassView( $this->path.'templates/' );
    }

    public function hooks(){
    	global $page;
    	add_action( 'init', array($this, 'init') );

    	add_action( 'manage_'.ROBO_GALLERY_TYPE_POST.'_posts_custom_column', array($this, 'custom_columns'), 10, 2 );
    	add_filter( 'manage_'.ROBO_GALLERY_TYPE_POST.'_posts_columns',  array($this, 'custom_header'));

    	if(  rbs_gallery_is_edit_page('list') ){
    		/*if( isset($_GET['showproinfo']) && $_GET['showproinfo'] && !ROBO_GALLERY_PRO ){  
	    		//add_action('admin_print_styles-' . $page, array($this, 'admin_styles'));
	    		//add_action('in_admin_header', array($this, 'show_info') );
	    	}*/
    		add_action( 'in_admin_header', array($this, 'assets') );
    	}
    }

    public function assets (){		
		wp_enqueue_script('robo-gallery-lising-js', ROBO_GALLERY_URL.'js/admin/listing.js', array( 'jquery' ), ROBO_GALLERY_VERSION, true ); 
		wp_enqueue_style ('robo-gallery-lising-css', ROBO_GALLERY_URL.'css/admin/list.css', array( ), ROBO_GALLERY_VERSION );
		
		/* remove extra content from OUR PLUGIN settings section */
		$css_inline = '#wpbody .fs-notice,#wpbody .fs-sticky,#wpbody .fs-has-title,#wpbody .wd-admin-notice,#wpbody .ngg_admin_notice{ display: none !important;}';
		wp_add_inline_style('robo-gallery-lising-css', $css_inline);
	}

    public function custom_header($columns) { 
		return array_merge(
				$columns, 
				array( 
					'rbs_gallery_views' => __('Views','robo-gallery'), 
					'rbs_gallery' 		=> __('Shortcode' ,'robo-gallery') 
				)
		); 
	}

    public function  custom_columns( $column, $post_id ) {
	    switch ( $column ) {
			case 'rbs_gallery' :
				global $post;
				//$slug = '' ; $slug = $post->post_name;
		        $shortcode = '
				<input readonly="readonly" size="23" value="[robo-gallery id='.$post_id.']" class="robo-gallery-shortcode" type="text" />';
			    echo $shortcode; 
			    break;

			case 'rbs_gallery_views' :
				global $post;
		        echo (int) get_post_meta( $post->ID, 'gallery_views_count', true);
			    break;
	    }
	}


    public function show_info(){
    	wp_enqueue_style("wp-jquery-ui-dialog");
		wp_enqueue_script('jquery-ui-dialog');

		wp_enqueue_script('robo-gallery-info', ROBO_GALLERY_URL.'js/admin/info.js', array( 'jquery' ), ROBO_GALLERY_VERSION, true ); 
		wp_enqueue_style ('robo-gallery-info', ROBO_GALLERY_URL.'css/admin/info.css', array( ), '' );
		
		echo '<div id="rbs_showInformation" '
					.'style="display: none;" '
					.'data-open="1" '
					.'data-title="'.__('Get Robo Gallery Pro version', 'robo-gallery').'" '
					.'data-close="'.__('Close').'" '
					.'data-info="'.__('Get Pro version', 'robo-gallery').'"'
				.'>'
				.__('You can create only 3 galleries. Update to PRO to get unlimited galleries', 'robo-gallery')
			.'</div>';
    }
}

new rbsGalleryListing();


/*add_action( 'load-edit.php', function() {
  add_filter( 'views_edit-'.ROBO_GALLERY_TYPE_POST, 'robo_gallery_listing_tabs' ); 
});

function robo_gallery_listing_tabs() {
 echo '
 <br/>
  <h2 class="nav-tab-wrapper">
    <a class="nav-tab" href="admin.php?page=gallery">Gallery</a>
    <a class="nav-tab nav-tab-active" href="edit.php?post_type=statistics">Statistics</a>
    <a class="nav-tab" href="edit.php?post_type=backup">Backup</a>
  </h2><br/>
 ';
}*/