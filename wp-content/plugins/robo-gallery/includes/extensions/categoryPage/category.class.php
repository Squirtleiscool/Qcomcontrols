<?php
/*
*      Robo Gallery     
*      Version: 2.7.0
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

class ROBO_GALLERY_CATEGORY_PAGE{
   
    protected $postType;

    protected $assetsUri;

    protected $currentPostOrder;

    public function __construct($postType){ 
    
        $this->postType = $postType;

        $this->assetsUri = plugin_dir_url(__FILE__);

        add_action("wp_ajax_hierarchy_{$this->postType}_page_save", 	array($this, 'ajaxDialogSave'));

		add_action( 'init', array($this, 'initMenu') );
    }

    public function showSorting(){
    	$this->enqueueScripts();
	    $this->ajaxDialog();
    }

    public function addMenuItem(){ 
    	add_submenu_page( 'edit.php?post_type=robo_gallery_table', 'Robo Gallery Sorting', 'Sorting', 'manage_options', 'robo-gallery-category-page', array($this, 'showSorting' ) );
    }

    public function initMenu(){ 
    	add_action('admin_menu', array($this, 'addMenuItem'), 10);
    }

    
    public function enqueueScripts(){ 
        $screen = get_current_screen();

        if ($this->postType !== $screen->post_type) {
            return;
        }

        wp_enqueue_style(
            'hierarchy-post-attributes-style',
            $this->assetsUri . 'css/style.css',
            array()
        );
        wp_enqueue_style('wp-jquery-ui-dialog');

        wp_enqueue_script('jquery-ui-dialog');

        wp_enqueue_script(
            'hierarchy-post-attributes-nestable-js',
            $this->assetsUri . 'js/jquery.nestable.js',
            array(),
            false,
            true
        );
        wp_enqueue_script(
            'hierarchy-post-attributes-js',
            $this->assetsUri . 'js/script.js',
            array('hierarchy-post-attributes-nestable-js'),
            false,
            true
        );

        $postTypeObject = get_post_type_object($this->postType);

       wp_localize_script(
            'hierarchy-post-attributes-js',
            'hierarchyPostAttributes',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),

                'action' => array(
                    'save' => "hierarchy_{$this->postType}_page_save",
                ),
            
                'status' => array(
                	'saved'		=> __('Saved', 'robo-gallery'),
                	'modified'	=> __('Modified', 'robo-gallery'),
                	'saving'	=> __('Saving', 'robo-gallery'),
                	'error'		=> __('Error', 'robo-gallery'),
                	'ok'		=> __('OK', 'robo-gallery'),
                )
            )
        );
    }



    public function ajaxDialog() {
        $this->checkPermission();
        $postTree = $this->getPostTree( $this->postType);
        echo '<div class="wrap">';
        	echo '<h1>'.__('Robo Gallery Sorting', 'robo-gallery').
        			'<span id="gallery_label_status" class="title-count theme-count">'.__('No changes', 'robo-gallery').'</span>'
        		.'</h1> ';
	        echo '<div id="wrapper-nestable-list">';
	        	echo '<button class="buttonSave button button-primary">Save</button> <br/> <br/>';
	        	echo '<div class="nestable-list dd"> '.$this->theNestableList($postTree).' </div> ';
	        	echo '<div class="nestable-list-spinner"> <img src="'.admin_url('/images/spinner-2x.gif').'" /> </div> ';
	        	echo '<br/> <button class="buttonSave button button-primary">Save</button>';
	        echo '</div>';
        echo '</div>';

    }


    public function ajaxDialogSave() {
        $this->checkPermission();

        if (!isset($_POST['hierarchy_posts'])) {
            header('HTTP/1.0 403 Forbidden');
            echo 'Error #100  Please post ticket with this Error ID into support section.';
            die();
        }
        if (!is_array($_POST['hierarchy_posts'])) {
            header('HTTP/1.0 403 Forbidden');
            echo 'Error #101  Please post ticket with this Error ID into support section.';
            die();
        }

        $hierarchyPosts = $_POST['hierarchy_posts'];
        $this->currentPostOrder = 0;
        foreach ($hierarchyPosts as $order => $postData) {
            $this->updatePostHierarchy($postData);
        }
    }


    protected function getPostTree($postType){
        $args = array(
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $postMap = array();
        $postTree = array();

        foreach (get_posts($args) as $post) {
            if (isset($postMap[$post->ID])) {
                $postMap[$post->ID]['post'] = $post;
                $postData = &$postMap[$post->ID];
            } else {
                $postData = array('post' => $post, 'children' => array());
                $postMap[$post->ID] = &$postData;
            }
            if (0 == $post->post_parent) {
                $postTree["{$post->menu_order}-{$post->ID}"] = &$postData;
            } else {
                $postMap[$post->post_parent]['children'][$post->ID] = &$postData;
            }
            unset($postData);
        }
        
        // Adding children posts with lost parent to tree
        foreach ($postMap as &$postData) {
            if (!isset($postData['post']) && is_array($postData['children'])) {
                foreach ($postData['children'] as &$childPostData) {
                    $childPost = $childPostData['post'];
                    $postTree["{$childPost->menu_order}-{$childPost->ID}"] = &$childPostData;
                }
            }
        }
        asort($postTree);

        return $postTree;
    }


    protected function theNestableList(array $tree){
		$returnHtml = '<ol class="dd-list">';
	        foreach ($tree as $item):
	            $returnHtml .= '<li class="dd-item" data-id="'.$item['post']->ID.'">';
	            	$returnHtml .= '<div class="dd-handle">';
	                        $title = esc_attr($item['post']->post_title);
	                        $returnHtml .=  "{$title} [{$item['post']->ID}: {$item['post']->post_name}]" ;
	                $returnHtml .= '</div>';
	                if (!empty($item['children'])):
	                        $returnHtml .= $this->theNestableList($item['children']);
	                endif;
	            $returnHtml .= '</li>';
        	endforeach;
    	$returnHtml .= '</ol>';
        return $returnHtml ;
    }


    protected function checkPermission(){
        $postTypeObject = get_post_type_object($this->postType);
        if (!current_user_can($postTypeObject->cap->edit_posts)) {
            header('HTTP/1.0 403 Forbidden');
            echo sprintf("You don't have permission for editing this %s", $postTypeObject->labels->name);
            die();
        }
    }


    protected function updatePostHierarchy($postData, $parentId = 0){
        $this->currentPostOrder++;
        wp_update_post(array(
            'ID' => absint($postData['id']),
            'post_parent' => absint($parentId),
            'menu_order' => $this->currentPostOrder
        ));

        if (!empty($postData['children'])) {
            foreach ($postData['children'] as $childPostData) {
                $this->updatePostHierarchy($childPostData, $postData['id']);
            }
        }
    }
}
