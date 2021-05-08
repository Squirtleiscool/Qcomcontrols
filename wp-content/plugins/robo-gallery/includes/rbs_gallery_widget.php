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

class rbs_widget extends WP_Widget {

  function __construct(){
    parent::__construct(
      'rbs_widget', 
      __( 'Robo Gallery Widget' , 'robo-gallery' ),
      array( 'description' => __( "Publish gallery on your website.", 'robo-gallery' ), ) 
    );
  }

  public function getIdGallery( $galleryId ){


  		$gallery_params = array(
			'numberposts'   => 1,			
			'post_type'        =>  ROBO_GALLERY_TYPE_POST,
			'post_status'      => 'publish',
		);
  	

		switch ($galleryId) {
			case -99:
					$gallery_params['orderby'] = 'date';
        			$gallery_params['order'] = 'DESC';
				break;
			case -98:
					$gallery_params['orderby'] = 'rand';
				break;
			case -97:
					$gallery_params['orderby'] = 'meta_value_num';
        			$gallery_params['meta_key'] = 'gallery_views_count';
        			$gallery_params['order'] = 'DESC';
				break;
			
		}
		$posts_array = get_posts( $gallery_params ); 

		if( isset($posts_array[0]) && isset($posts_array[0]->ID) ){
			$galleryId = $posts_array[0]->ID;
		}

		return $galleryId;
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    $galleryId = $instance['galleryId'];

    echo $args['before_widget'];

    if( ! empty( $title ) )     echo $args['before_title'] . $title . $args['after_title'];

    if( $galleryId == -99 || $galleryId == -98 || $galleryId == -97 ){
    	$galleryId = $this->getIdGallery($galleryId);
    }

    echo do_shortcode('[robo-gallery id="'.$galleryId.'"]');
    
    echo $args['after_widget'];
  }

  public function galleryList($selected){
  	$args = array(
		'sort_order'   => 'ASC',
		'sort_column'  => 'post_title',
		'hierarchical' => 0,
		'exclude'      => '',
		'include'      => '',
		'meta_key'     => '',
		'meta_value'   => '',
		'authors'      => '',
		'child_of'     => 0,
		'selected'     => $selected,
		/*'parent'       => -1,*/
		'exclude_tree' => '',
		'number'       => '',
		'offset'       => 0,
		'post_type'    => ROBO_GALLERY_TYPE_POST,
		'post_status'  => 'publish',
	);
  	?>
	<select id="<?php echo $this->get_field_id( 'galleryId' );?>" name="<?php echo $this->get_field_name( 'galleryId' );?>" > 
		<option value="-99" <?php selected( $selected, -99 ); ?>><?php echo esc_attr( '- '.__( 'Latest Gallery', 'robo-gallery' ) ); ?></option> 
		<option value="-98" <?php selected( $selected, -98 ); ?>><?php echo esc_attr( '- '.__( 'Random Gallery', 'robo-gallery' ) ); ?></option> 
		<option value="-97" <?php selected( $selected, -97 ); ?>><?php echo esc_attr( '- '.__( 'Most Viewed Gallery', 'robo-gallery' ) ); ?></option> 
		<option value="-100" disabled>-----------------------------</option> 
		<?php 
			$pages = get_pages($args); 
			echo walk_page_dropdown_tree( $pages, 0, $args );
		?>
	</select>
	<?php 
  }



  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    } else {
      $title = __( 'Gallery Widget', 'robo-gallery' );
    }
    
    if ( isset( $instance[ 'galleryId' ] ) ) {
        $galleryId = (int) $instance[ 'galleryId' ];
    }
    else {
        $galleryId = 0;
    }

    
	
	if( !class_exists('rbsImageWidgetGallery') && !ROBO_GALLERY_TYR){
		?>
		<p>
			<?php _e('You need to install new version of the widget to make it work. Install free or paid version of the Image Widget.', 'robo-gallery'); ?>
		</p>
		<p style="text-align: center; margin-bottom: 0;">
			<a class="button" href="<?php echo esc_url( self_admin_url( 'edit.php?post_type='.ROBO_GALLERY_TYPE_POST.'&page='.ROBO_GALLERY_TYPE_POST.'-addons&plugin_confirm=widget') ); ?>" style="margin-bottom: 12px;"><?php _e('Install Free Version', 'robo-gallery'); ?></a>
			 
			<a class="button button-primary" href="https://robosoft.co/go.php?product=gallery&task=gopro" target="_blank"> <?php _e( 'Install Paid Version','robo-gallery'); ?></a>
		</p>
	<?php 
	}	
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
	 		<?php _e( 'Title' ); ?>:
		</label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'galleryId' ); ?>"><?php _e( 'Gallery:' ); ?></label> 
		<?php 
			$this->galleryList($galleryId); 
		?>
	</p>
	
	<p>
		<?php _e( 'Configure it in','robo-gallery');?> 
		<a target="_blank" href="edit.php?post_type=robo_gallery_table">
			<?php _e( 'Robo Gallery plugin','robo-gallery');?>
		</a>
	</p>
	<script type="text/javascript">

		jQuery(document).ready( function($) {
			//jQuery('#<?php echo $this->get_field_id( 'galleryId' ); ?>').addClass('widefat'); 
		});
	</script>
    <?php 
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( isset($new_instance['title']) && !empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
    $instance['galleryId'] = ( ! empty( $new_instance['galleryId'] ) ) ? (int) $new_instance['galleryId'] : 0;
    return $instance;
  }

    function prevDropdownPages(){
  	$args = array(
		'child_of'     		=> 0,
		'sort_order'   		=> 'ASC',
		'sort_column'  		=> 'post_title',
		'hierarchical' 		=> 1,
		'selected'     		=> $galleryId,
		'name'         		=> $this->get_field_name( 'galleryId' ),
		'id'           		=> $this->get_field_id( 'galleryId' ),
		'echo'    			=> 1,
		'post_type' 		=> ROBO_GALLERY_TYPE_POST,
		'show_option_none'  => 'Latest Gallery',
		'option_none_value' => '-99',
    );

    wp_dropdown_pages( $args ); 
  }

}

function rbs_load_widget(){ register_widget( 'rbs_widget' );  }

add_action( 'widgets_init', 'rbs_load_widget' );