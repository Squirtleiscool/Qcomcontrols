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

if ( !class_exists( 'rbsGalleryDashboard' ) ){


    class rbsGalleryDashboard
    {
        protected $title = false;
        protected $config = array();
        
        protected $default_item = array( 
        				'title' => '',
	                    'menu_title' 	=> '',
	                    'name' 			=> '',
	                    'content' 		=> '',
	                    'parent_slug' 	=> '',
	                    'url' 			=> '',
                	);

        protected $slug = false;
        protected $active_content = false;
        protected $url_external_button1 = false;
        protected $url_external_button2 = false;
        protected $active_tab = false;
        protected $page_name = false;
        protected $page_menu = false;
        protected $page_title = false;

        public function __construct()
        {
            $this->title = __('Welcome to Robo Gallery', 'robo-gallery');
            $this->slug = 'edit.php?post_type='.ROBO_GALLERY_TYPE_POST;
            $this->page_name = __('Overview', 'robo-gallery');

            $this->page_menu = 'overview';
            $this->tag = 'robo-gallery-overview';

            $this->page_title = 'Robo Gallery Overview';

            $this->url_external_button1 = 'https://robosoft.co/robogallery/#overview';
            $this->url_external_button2 = 'https://robosoft.co/robogallery/#pricing';

            $config = array(
                
                array(
                    'title' => __('Overview', 'robo-gallery'),
                    'name' => 'overview',
                    'content' => 'overview.php',
                    'parent_slug' => $this->slug
                ),
				array(
                    'title' => __('Add-ons', 'robo-gallery'),
                    'url' => $this->slug.'&page=robo_gallery_table-addons',

                ),
				array(
                    'title' => __('Help & Support', 'robo-gallery'),
                    'name' => 'video-guide',
                    'content' => 'video_guide.php',
                    'parent_slug' => $this->slug

                ),
				array(
                    'title' => __('Demos', 'robo-gallery'),
                    'url' => 'https://robosoft.co/robogallery/#overview',

                ),
				array(
                    'title' => __('Get Pro Version', 'robo-gallery'),
                    'url' => 'https://robosoft.co/robogallery/#pricing',

                )
            );

       		for ($i = 0; $i < count($config); $i++) {
       			$this->config[] = array_merge( $this->default_item, $config[$i] );
       		}

            
            if ( count($this->config) && is_array($this->config) && isset($this->slug) ){
                add_action('admin_menu', array($this, 'add_menu_items'));
            }

            if( isset($_GET['firstview']) && $_GET['firstview']==1 ){
            	delete_option( 'robo_gallery_redirect_overview' );
            }
        }


        function add_menu_items(){

            $page = add_submenu_page($this->slug, $this->page_title, $this->page_name, 'manage_options', $this->page_menu, array($this, 'view'));
            add_action('admin_print_styles-' . $page, array($this, 'admin_styles'));
            
        }


        function showTabs()
        {
        	$returnHTML = '';
            $this->active_tab = isset($_GET['tab']) && $_GET['tab'] ? sanitize_title($_GET['tab']) : $this->config[0]['name'];
            foreach ($this->config as $item) {

                $link = '#';
                if ( $item['content'] ) {
                    $link = $this->slug . '&page=' . $this->page_menu .'&tab=' . $item['name'];
                } elseif( $item['url'] ) {
                    $link = $item['url'];
                }
                if ( $this->active_tab === $item['name'] ) {
                    $this->active_content = $item['content'];
                }
                $returnHTML .= 
                '<a href="'.$link.'" '.( !$item['content'] ?'target="_blank"':'').' class="nav-tab '.( $this->active_tab == $item['name'] ? 'nav-tab-active' : '').'">
                    '.$item['title'].'
                </a>';
            }
            echo $returnHTML;
        }

        function admin_styles()
        {
            wp_enqueue_style( $this->tag, plugins_url('assets/style.css', __FILE__));
        }

        function view()
        {
            $this->active_tab = isset($_GET['page']) ? sanitize_title($_GET['page']) : $this->config[0]['name']; 
            ?>
            <div class="wrap about-wrap">
                <div class="rbsDashboardGallery-external-button">
                    <h1 class="rbsDashboardGallery-title"><?php _e($this->title, "robo-gallery"); ?>
                        <a href="<?php echo $this->url_external_button1; ?>" target="_blank" class="rbsDashboardGallery-button one"><?php _e( 'Demos','robo-gallery' ); ?></a>
                        <a href="<?php echo $this->url_external_button2; ?>" target="_blank" class="rbsDashboardGallery-button"><?php _e( 'Pro version','robo-gallery' ); ?></a>
                    </h1>
                </div>

                <div class="about-text">
                    <?php 
                    	_e('Robo Gallery is advanced responsive photo gallery plugin.', 'robo-gallery'); 
                    	echo '<br/>';
                    	_e('Flexible gallery images management tools. Links, videos and gallery lightbox support. ', 'robo-gallery'); 
                    	echo '<br/>';
                    	_e('In our gallery you can easily customize layouts and interface styles. ', 'robo-gallery'); 
                    	echo '<br/>';
                    	echo sprintf(  
                    		__( 'If you have some questions or any kind of problems with gallery installation or configuration feel free to <a href="%s" target="_blank">post ticket here</a>', 'robo-gallery' ), 
                    		'https://wordpress.org/support/plugin/robo-gallery'
                    	); 
                    	?>
                </div>

                <h2 class="nav-tab-wrapper"><?php $this->showTabs(); ?></h2>

                <?php $this->showContent(); ?>
            </div>
            <?php
        }

        function showContent()
        {
            if ( $this->active_content && file_exists(plugin_dir_path( __FILE__ ) . $this->active_content)) {
                require_once plugin_dir_path( __FILE__ ). $this->active_content;
            }
        }
    }
}
new rbsGalleryDashboard();