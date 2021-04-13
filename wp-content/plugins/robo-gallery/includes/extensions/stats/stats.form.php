<?php 
/*
*      Robo Gallery     
*      Version: 1.2
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

$countPosts = wp_count_posts(ROBO_GALLERY_TYPE_POST);

$args = array(
	'post_type'  => ROBO_GALLERY_TYPE_POST,
	'meta_key'   => 'gallery_views_count',
	'posts_per_page' =>-1,
);
$allViews = 0;
$loop = new WP_Query($args);
$allImages = 0;

$clearStat = 0;
if ( isset( $_GET['clearStat'] ) && $_GET['clearStat']==1 ) $clearStat=1;

if ( $loop->have_posts() ){
	for ($i=0; $i <count($loop->posts) ; $i++) { 

		$images = get_post_meta( $loop->posts[$i]->ID, ROBO_GALLERY_PREFIX.'galleryImages', true);
		if( isset($images) && is_array($images) && count($images) ){
			$allImages += count($images);
		}
		if($clearStat){
			delete_post_meta( $loop->posts[$i]->ID, 'gallery_views_count');
			add_post_meta( $loop->posts[$i]->ID, 'gallery_views_count', '0');
		}
		$amt = get_post_meta( $loop->posts[$i]->ID, 'gallery_views_count', true);
		if ($amt) {$allViews += $amt;};
	}
}


?>
<div class="wrap">
	<h1  class="rbs-stats">
		<?php _e('Robo Gallery Statistics', 'robo-gallery'); ?> 
		<a id="robo_gallery_reset_stat" href="edit.php?post_type=robo_gallery_table&page=robo-gallery-stats&clearStat=1" class="page-title-action"><?php _e('Reset', 'robo-gallery'); ?></a>
	</h1>

	<?php if(isset($_GET['clearStat']) && $_GET['clearStat']==1 ){ ?>
		<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
			<p><strong><?php _e('Statistics Reset.', 'robo-gallery'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php _e('Dismiss this notice.'); ?></span>
			</button>
		</div>
	<?php } ?>

<br>

<?php 
	
if(!function_exists('rbs_stats_tabs')){
	function rbs_stats_tabs( $current = 'gallery' ) {
	    $tabs = array( 
	    		'gallery' => __('Gallery Statistics', 'robo-gallery'), 
	    		'export' => __('Images Statistics', 'robo-gallery') 
	    );
	    echo '<h2 class="nav-tab-wrapper">';
		    foreach( $tabs as $tab => $name ){
		        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
		        echo '<a class="nav-tab'.$class.'" href="edit.php?post_type=robo_gallery_table&page=robo-gallery-stats&tab='.$tab.'">'.$name.'</a>';
		    }
	    echo '</h2>';
	}
}
$tab = 'gallery';

switch ($tab) {
	case 'gallery':
	?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label ><?php _e('Total Views', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $allViews ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Total Images', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $allImages ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Total Galleries', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->publish + $countPosts->draft + $countPosts->trash ; ?></p>
				</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Published', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->publish ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Drafts', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->draft ; ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label ><?php _e('Trash', 'robo-gallery'); ?></label>
				</th>
				<td>
					<p><?php echo $countPosts->trash ; ?></p>
				</td>
			</tr>
			
		</tbody>
	</table>
	<?php
		break;

	default:
 	case 'images':
?>
<?php 
	break;

	case 'import':

 } ?>
</div>
<?php 