<?php
/*  
 * RB Image Widget
 * Version:           1.0.0
 * Author:            RB  Team
 */

class RBImageWidget extends WP_Widget {

  function __construct(){
  	
	    parent::__construct(
	      'RBImageWidget',
	      __('RB Image Widget', 'image-widget-rb' ),
	      array( 'description' => __( "Publish RB Image Widget on your website.", 'image-widget-rb' ), )
	    );
  }

  public function widget( $args, $instance ) {
  	if( !isset( $instance['galleries_id'] ) ) return ;

  	if( !isset($instance['title']) ) $instance['title'] = '';
  	if( !isset($instance['columns']) ) $instance['columns'] = 4;

  	if( !isset($args['before_title']) ) $args['before_title'] = '';
  	if( !isset($args['after_title']) ) $args['after_title'] = '';
  	if( !isset($args['before_widget']) ) $args['before_widget'] = '';
  	if( !isset($args['after_widget']) ) $args['after_widget'] = '';

	wp_enqueue_script( 'rb-image-widget-lightbox-js',	RB_IMAGE_WIDGET_URL.'assets/js/swipebox.lightbox.js', 	array( 'jquery' ), 						RB_IMAGE_WIDGET_VERSION, false );
	wp_enqueue_script( 'rb-image-widget-script-js', 	RB_IMAGE_WIDGET_URL.'assets/js/script.js', 				array( 'rb-image-widget-lightbox-js' ), RB_IMAGE_WIDGET_VERSION, false );
	wp_enqueue_style(  'rb-image-widget-style-css',		RB_IMAGE_WIDGET_URL.'assets/css/swipebox.style.css', 	array(), 								RB_IMAGE_WIDGET_VERSION, 'all' );

    $title = apply_filters( 'widget_title', $instance['title'] );

    $galleries_id = $instance['galleries_id'];
	$columns = $instance['columns'];
	if(!$columns) $columns = 4;
	$lightbox = isset($instance['lightbox']) && $instance['lightbox'] ? $instance['lightbox'] : 0;

    echo $args['before_widget'];
    if( ! empty( $title ) )     echo $args['before_title'] . $title . $args['after_title'];

    echo '<div id="'.uniqid('rb_image_widget_block_id_').'" class="rb-image-widget-block" '.($lightbox?' data-hidecaption="1" ':'').'>';
   		echo do_shortcode('[gallery ids="'.$galleries_id.'" link="file"  columns="'.$columns.'" ]');
   	echo '</div>';

    echo $args['after_widget'];
  }


  public function form( $instance ) {
	
	wp_enqueue_media();
	wp_enqueue_style('wp-jquery-ui-dialog');

	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('rb-image-widget-script-js', 	RB_IMAGE_WIDGET_URL.'assets/js/admin.script.js', array( 'jquery' ), RB_IMAGE_WIDGET_VERSION, false );


	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __( 'Images', 'rb-image-widget' );
	}

    if ( isset( $instance[ 'galleries_id' ] ) ) {
      	$galleries_id = $instance[ 'galleries_id' ];
    } else {
      	$galleries_id = ' ';
    }

     if ( isset( $instance[ 'columns' ] ) ) {
      	$columns = $instance[ 'columns' ];
    } else {
      	$columns = 4;
    }

    if ( isset( $instance[ 'lightbox' ] ) ) {
      	$lightbox = $instance[ 'lightbox' ];
    } else $lightbox = '';

    ?>
    <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
	 		<?php _e( 'Title' ); ?>:
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	
	<p align="center">
		<?php _e( 'Use manage images button to select pictures for your photo gallery', 'image-widget-rb' ); ?>:
	</p>

	<p align="center">

    	<button data-valuefield="<?php echo $this->get_field_id( 'galleries_id' ); ?>" class="button rb-image-widget-edit-button"><?php _e( 'Manage Images', 'image-widget-rb' ); ?></button>
   		<input type='hidden' id="<?php echo $this->get_field_id( 'galleries_id' ); ?>" name="<?php echo $this->get_field_name( 'galleries_id' ); ?>" value="<?php echo esc_attr( $galleries_id ); ?>" />
	<p>

	<p>
		<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Columns', 'image-widget-rb' ); ?>:</label>
		<input id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" class="tiny-text" step="1" min="1" size="3" type="number"  value="<?php echo $columns; ?>" />
	</p>

	<p>
		<input <?php checked( $lightbox , 1 ); ?> value='1' id="<?php echo $this->get_field_id( 'lightbox' ); ?>" name="<?php echo $this->get_field_name( 'lightbox' ); ?>" type="checkbox" >
		<label for="<?php echo $this->get_field_id( 'lightbox' ); ?>"><?php _e( 'Disable Caption', 'image-widget-rb' ); ?></label>
	</p>
<?php
	

    
  }

  public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = 		( ! empty( $new_instance['title'] ) ) 		? strip_tags( $new_instance['title'] ) : '';
	$instance['columns'] = 		( ! empty( $new_instance['columns'] ) ) 	? (int) $new_instance['columns'] : 3;
	$instance['lightbox'] = 	( ! empty($new_instance['lightbox'] ) ) 	? (int)  $new_instance['lightbox'] : 0;
	$instance['galleries_id'] = ( ! empty( $new_instance['galleries_id'] ) )? strip_tags($new_instance['galleries_id']) :  ' ';
	return $instance;
  }
}


function widget_init_function_rb_image_widget() {
  	register_widget( 'RBImageWidget' );
}

add_action( 'widgets_init', 'widget_init_function_rb_image_widget' );

