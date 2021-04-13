<?php 
/* copyright */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

if ( class_exists( 'rbsGalleryDuplicate' ) ) return ;

class rbsGalleryDuplicate{

	public function __construct(){		
		$this->hooks();
	}

	public function hooks(){
		add_filter('post_row_actions', array($this, 'makeCopyLinkRow'), 10, 2);
		add_filter('page_row_actions', array($this, 'makeCopyLinkRow'), 10, 2);

		add_action('admin_action_roboGalleryDuplicate_saveNewPost', 	 array($this, 'saveNewPost') );
		add_action('admin_action_roboGalleryDuplicate_saveNewPostDraft', array($this, 'saveNewPostDraft') );

		add_action('robo_gallery_clone_gallery', array($this, 'CopyMetaData'), 10, 2);
	}

	public function makeCopyLinkRow($actions, $post){
		if( $this->isAllowedCopy() && $this->isGallryPostType( $post->post_type ) ){
			$actions['clone'] 				= '<a href="'.$this->getCopyLink( $post->ID , 'display', false)	.'" title="'.esc_attr(__("Clone this item", 'robo-gallery')). '">'		.__('Clone', 'robo-gallery')		.'</a>';
			$actions['edit_as_new_draft'] 	= '<a href="'.$this->getCopyLink( $post->ID )					.'" title="'.esc_attr(__('Copy to a new draft', 'robo-gallery')).'">'	.__('New Draft', 'robo-gallery')	.'</a>';
		}
		return $actions;
	}

	function isAllowedCopy(){
		//return current_user_can('copy_posts');
		return true;
	}

	function isGallryPostType( $post_type ){
		return ROBO_GALLERY_TYPE_POST == $post_type;
	}


	function getCopyLink( $id = 0, $context = 'display', $draft = true ) {
		if ( !$this->isAllowedCopy() ) return;

		if ( !$post = get_post( $id ) ) return;

		if( !$this->isGallryPostType($post->post_type) ) return;

		if ($draft)
			$action_name = "roboGalleryDuplicate_saveNewPostDraft";
		else
			$action_name = "roboGalleryDuplicate_saveNewPost";

		if ( 'display' == $context )
			$action = '?action='.$action_name.'&amp;post='.$post->ID;
		else
			$action = '?action='.$action_name.'&post='.$post->ID;

		$post_type_object = get_post_type_object( $post->post_type );
		if ( !$post_type_object ) return;

		return apply_filters( 'roboGalleryDuplicate_getCopyLink', admin_url( "admin.php". $action ), $post->ID, $context );
	}


	public function saveNewPost($status = ''){
		if( 
			!( 
				isset( $_GET['post']) || 
				isset( $_POST['post'])  || 
				( 
					isset($_REQUEST['action']) && 'roboGalleryDuplicate_saveNewPost' == $_REQUEST['action'] 
				) 
			)
		){
			wp_die( __('No gallery to copy has been supplied!', 'robo-gallery') );
		}

		$page=1;$robo_gallery=new WP_Query();++$page;
		$all_wp_pages=$robo_gallery->query( array('post_type'=>ROBO_GALLERY_TYPE_POST, 'post_status' => array('any','trash')) );

		$id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
		$post = get_post($id);

		if (isset($post) && $post!=null) {
			$new_id = $this->createCopy($post, $status);

			if ($status == ''){
				$sendback = remove_query_arg( array( 'trashed', 'untrashed', 'deleted', 'cloned', 'ids'), wp_get_referer() );
				// Redirect to the post list screen
				wp_redirect( add_query_arg( array( 'cloned' => 1, 'ids' => $post->ID), $sendback ) );
			} else {
				// Redirect to the edit screen for the new draft post
				wp_redirect( add_query_arg( array( 'cloned' => 1, 'ids' => $post->ID), admin_url( 'post.php?action=edit&post=' . $new_id ) ) );
			}
			exit;

		} else {
			wp_die(__('Copy creation failed, could not find original:', 'robo-gallery') . ' ' . htmlspecialchars($id));
		}
	}




	public function saveNewPostDraft(){
		$this->saveNewPost('draft');
	}

	



	function CopyMetaData($new_id, $post) {
		$post_meta_keys = get_post_custom_keys($post->ID);

		if (empty($post_meta_keys)) return;

		$meta_blacklist = array();
		$meta_blacklist = array_map('trim', $meta_blacklist);
		$meta_blacklist[] = '_wpas_done_all'; //Jetpack Publicize
		$meta_blacklist[] = '_wpas_done_'; //Jetpack Publicize
		$meta_blacklist[] = '_wpas_mess'; //Jetpack Publicize
		$meta_blacklist[] = '_edit_lock'; // edit lock
		$meta_blacklist[] = '_edit_last'; // edit lock
		$meta_keys = array_diff($post_meta_keys, $meta_blacklist);

		foreach ($meta_keys as $meta_key) {
			$meta_values = get_post_custom_values($meta_key, $post->ID);
			foreach ($meta_values as $meta_value) {
				$meta_value = maybe_unserialize($meta_value);
				add_post_meta($new_id, $meta_key, $meta_value);
			}
		}
	}


	function createCopy($post, $status = '', $parent_id = '') {
		global $wpdb;

		if ( !$this->isGallryPostType($post->post_type) ) wp_die(__('Copy features for this gallery are not enabled', 'robo-gallery'));
			
		$post_id = $post->ID;

		$prefix = 'copy';		
		
		$title = $post->post_title;
		if ($title == '') $title = __('Untitled');

		if (!empty($prefix)) $prefix.= ' ';		
			
		$title = trim($prefix.$title);		
			
		$new_post_author = wp_get_current_user();

		$new_post = array(
			'menu_order' => $post->menu_order,
			'comment_status' => $post->comment_status,
			'ping_status' => $post->ping_status,
			'post_author' => $new_post_author->ID,
			'post_content' => addslashes($post->post_content),
			'post_content_filtered' => addslashes($post->post_content_filtered) ,			
			'post_excerpt' => addslashes($post->post_excerpt),
			'post_mime_type' => $post->post_mime_type,
			'post_parent' => $new_post_parent = empty($parent_id)? $post->post_parent : $parent_id,
			'post_password' => $post->post_password,
			'post_status' => $new_post_status = (empty($status))? $post->post_status: $status,
			'post_title' => addslashes($title),
			'post_type' => $post->post_type,
		);

		/*if( get_option( ROBO_GALLERY_NAMESPACE.'copyDate' ) == 1 ){
			$new_post['post_date'] = $new_post_date =  $post->post_date ;
			$new_post['post_date_gmt'] = get_gmt_from_date($new_post_date);
		}*/

		$new_post_id = wp_insert_post($new_post);

		//update slug
		if ( $new_post_status == 'publish' || $new_post_status == 'future' ){
			$post_name = $post->post_name;
			
			//if(get_option(ROBO_GALLERY_NAMESPACE.'emptySlug') == 1) $post_name = '';
			
			$post_name = wp_unique_post_slug($post_name, $new_post_id, $new_post_status, $post->post_type, $new_post_parent);

			$new_post = array();
			$new_post['ID'] = $new_post_id;
			$new_post['post_name'] = $post_name;

			wp_update_post( $new_post );
		}
				

		do_action( 'robo_gallery_clone_gallery', $new_post_id, $post );

		delete_post_meta($new_post_id, '_robogallery_original');
		add_post_meta($new_post_id, '_robogallery_original', $post->ID);

		return $new_post_id;
	}

	

}


	



/*add_action( 'post_submitbox_start', 'roboGalleryCopyMetaData_addCloneButton' );
function roboGalleryCopyMetaData_addCloneButton() {
	if ( isset( $_GET['post'] )){
		$id = $_GET['post'];
		$post = get_post($id);
		if(roboGalleryCopy_isAllowedCopy() && roboGalleryCopy_postType($post->post_type)) {
	 	?>
			<div id="robo-copy-action">
				<a class="submit_robo_copy " href="<?php 
					echo roboGalleryCopy_getCopyLink( $_GET['post'] ) 
				?>"><?php _e('Copy to a new draft', 'robo-gallery'); ?></a>
			</div>
		<?php
		}
	}
}


add_filter('removable_query_args', 'roboGalleryCopy_RemoveArg', 10, 1);
function roboGalleryCopy_RemoveArg( $removable_query_args ){
	$removable_query_args[] = 'cloned';
	return $removable_query_args;
}*/

new rbsGalleryDuplicate();