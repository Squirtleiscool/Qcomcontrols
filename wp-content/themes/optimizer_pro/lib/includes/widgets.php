<?php

/*
	/* ---------------------------- */
	/* -------- Flickr Photostream Widget -------- */
	/* ---------------------------- */
add_action( 'widgets_init', 'thn_flckr_widgets' );

/*
 * Register widget.
 */
function thn_flckr_widgets() {
	register_widget( 'thn_flckr_widget' );
}

/*
 * Widget class.
 */
class thn_flckr_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	
	function __construct() {
		parent::__construct( 'thn_flckr_widget', __( 'Flickr Photo', 'optimizer' ), array(
			'classname'   => 'thn_flckr_widget',
			'description' => __( 'An Optimizer Widget that displays Flickr image stream from your Flickr account', 'optimizer' ),
		) );
		$this->alt_option_name = 'thn_flckr_widget';
	}
	

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings.  */
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : 'My Photostream';
		$flickrID = isset( $instance['flickrID'] ) ? $instance['flickrID'] : '25182021@N05';
		$postcount = isset( $instance['postcount'] ) ? $instance['postcount'] : '9';
		$type = isset( $instance['type'] ) ? $instance['type'] : 'user';
		$display = isset( $instance['display'] ) ? $instance['display'] : 'random';
		$size = isset( $instance['size'] ) ? $instance['size'] : 'thumb';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display Flickr Photos */
		 ?>
			
			<div id="flickr_badge_wrapper" class="clearfix widget_flicrk_<?php echo $size; ?>">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=m&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
			</div>
		
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = absint($new_instance['postcount']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['size'] = strip_tags($new_instance['size']);
		
		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'My Photostream',
		'flickrID' => '25182021@N05',
		'postcount' => '9',
		'type' => 'user',
		'display' => 'random',
		'size' => 'thumb',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>

		<!-- Flickr ID: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'optimizer') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" type="text" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'optimizer') ?></label>
			<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
				<option <?php if ( '3' == $instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
                <option <?php if ( '4' == $instance['postcount'] ) echo 'selected="selected"'; ?>>4</option>
                <option <?php if ( '5' == $instance['postcount'] ) echo 'selected="selected"'; ?>>5</option>
                <option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
                <option <?php if ( '7' == $instance['postcount'] ) echo 'selected="selected"'; ?>>7</option>
				<option <?php if ( '8' == $instance['postcount'] ) echo 'selected="selected"'; ?>>8</option>
				<option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
                <option <?php if ( '10' == $instance['postcount'] ) echo 'selected="selected"'; ?>>10</option>
			</select>
		</p>
		
		<!-- Type: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'optimizer') ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>
		</p>
		
        <!-- Image Size: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Image Size', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat">
                <option value="thumb"  <?php if ( 'thumb' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'optimizer') ?></option>
                <option value="medium"  <?php if ( 'medium' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Medium', 'optimizer') ?></option>
            </select>
        </p>
        
		<!-- Display: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'optimizer') ?></label>
			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
				<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
				<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
			</select>
		</p>
        
		
	<?php
	}
}



/* ---------------------------- */
/* -------- Facebook Likebox Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_fb_widgets' );

/*
 * Register widget.
 */
function ast_fb_widgets() {
	register_widget( 'ast_fb_widget' );
}

/*
 * Widget class.
 */
class ast_fb_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function __construct() {
		parent::__construct( 'ast_fb_widget', __( 'Facebook Likebox', 'optimizer' ), array(
			'classname'   => 'ast_fb_widget',
			'description' => __( 'An Optimizer Widget that displays Facebook Likebox of your Facebook Page.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_fb_widget';
	}
	

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : __('Follow Us on Facebook','optimizer');
		$num = isset( $instance['num'] ) ? $instance['num'] : 'https://www.facebook.com/layerthemes';
		$height = isset( $instance['height'] ) ? $instance['height'] : '200px';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* Display a containing div */
		echo '<div class="ast_fb">';

		/* Display Facebook Iframe */
	
	echo '<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=219966444765853";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, "script", "facebook-jssdk"));</script>

<div class="fb-page" data-href="'.esc_url($num).'" data-height="'.$height.'" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="'.$num.'">Facebook</a></blockquote></div></div>
';

		echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = esc_url_raw($new_instance['num']);
		$instance['height'] = strip_tags($new_instance['height']);

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Follow Us on Facebook',
		'num' => 'https://www.facebook.com/layerthemes',
		'height' => '200px'
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>

		<!-- Number of Posts: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Facebook Page url:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_url($instance['num']); ?>" type="text" />
		</p>
        
        <!-- Number of Posts: Text Input -->
        <p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height of the like Box', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" type="text" />
		</p>
		
		
	<?php
	}

}


/* ---------------------------- */
/* -------- Google Plus Followers Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_gplus_widgets' );

/*
 * Register widget.
 */
function ast_gplus_widgets() {
	register_widget( 'ast_gplus_widget' );
}

/*
 * Widget class.
 */
class ast_gplus_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function __construct() {
		parent::__construct( 'ast_gplus_widget', __( 'Google + Followers', 'optimizer' ), array(
			'classname'   => 'ast_gplus_widget',
			'description' => __( 'An Optimizer widget that displays your Google Plus Followers.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_gplus_widget';
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. 290*/
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : __('Follow on Google Plus','optimizer');
		$num = isset( $instance['num'] ) ? $instance['num'] : 'https://plus.google.com/+JonathanBeri';
		$gplus_width = isset( $instance['gplus_width'] ) ? $instance['gplus_width'] : '290';
		$templatepath = get_template_directory_uri();

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* Display a containing div */
		echo '<div class="ast_gplus">';


		echo '<script type="text/javascript">
      (function() {
        window.___gcfg = {\'lang\': \'en\'};
        var po = document.createElement(\'script\');
        po.type = \'text/javascript\';
        po.async = true;
        po.src = \'https://apis.google.com/js/plusone.js\';
        var s = document.getElementsByTagName(\'script\')[0];
        s.parentNode.insertBefore(po, s);
      })();
    </script><div class="wc-gplusmod"><div class="g-plus" data-action="followers" data-height="290" data-href="'.esc_url($num).'?prsrc=2" data-source="blogger:blog:followers" data-width="'.$gplus_width.'"></div></div>';

		echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = esc_url_raw($new_instance['num']);
		$instance['gplus_width'] = $new_instance['gplus_width'];

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => __('Follow on Google Plus','optimizer'),
		'num' => 'https://plus.google.com/+JonathanBeri',
		'gplus_width' => '290'
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>

		<!-- Number of Posts: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Google Plus Url:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" type="text" />
		</p>
        
		<!-- Number of Posts: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus_width' ); ?>"><?php _e('Box Width:', 'optimizer') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'gplus_width' ); ?>" name="<?php echo $this->get_field_name( 'gplus_width' ); ?>" value="<?php echo $instance['gplus_width']; ?>" type="text" />
		</p>
		
		
	<?php
	}

}


/* ---------------------------- */
/* -------- BIO Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_bio_widgets' );


/*
 * Register widget.
 */
function ast_bio_widgets() {
	register_widget( 'ast_bio_widget' );
}

/*
 * Widget class.
 */
class ast_bio_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	
	function __construct() {
		parent::__construct( 'ast_bio_widget', __( 'Biography', 'optimizer' ), array(
			'classname'   => 'ast_bio_widget',
			'description' => __( 'An Optimizer Biography widget to display your biography.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_bio_widget';
		add_action('wp_enqueue_scripts', array(&$this, 'front_bio_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings.  */
		$title = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title'] ) : '';
		$image_uri = isset( $instance['image_uri'] ) ? $instance['image_uri'] : '';
		$name =  isset( $instance['name'] ) ? $instance['name'] : 'John Doe';
		$occu = 	isset( $instance['occu'] ) ? $instance['occu'] : __('Blogger','optimizer');	
		$bio =  isset( $instance['bio'] ) ? $instance['bio'] : __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.','optimizer');
		
		$bgcolor = isset( $instance['bgcolor'] ) ? $instance['bgcolor'] : '';
		$txtcolor = isset( $instance['txtcolor'] ) ? $instance['txtcolor'] : '';
		$titlecolor = isset( $instance['titlecolor'] ) ? $instance['titlecolor'] : '';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		/* Display a containing div */
		echo '<div class="ast_bio">';
		echo '<div class="bio_head"><img alt="'.$name.'" class="ast_bioimg" src="'.esc_url($image_uri).'" '.optimizer_image_attr( esc_url($image_uri) ).' '.optimizer_image_alt(esc_url($image_uri) ).' /></div>';
		
		echo '<div class="ast_biotxt"><h3><span>'.$name.'</span></h3><span class="ast_bioccu"><span>'.$occu.'</span></span><p><span>'.do_shortcode($bio).'</span></p></div>';

		echo '</div>';
		
		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
			
			$postbgcolor =		'';
			$titlecolor =		'';
			$secbgcolor =		'';
			
			if ( ! empty( $instance['bgcolor'] ) ){	$bgcolor = 'background-color: ' . $instance['bgcolor'] . '; ';}
			if ( ! empty( $instance['txtcolor'] ) ){	$txtcolor = 'color: ' . $instance['txtcolor'] . '; ';}
			if ( ! empty( $instance['titlecolor'] ) ) {	$titlecolor = 'color: ' . $instance['titlecolor'] . '; ';}

			
			echo '<style>#'.$id.' .widget_wrap{ '.$bgcolor.' }#'.$id.' .widgettitle, #'.$id.' .ast_biotxt h3{'.$titlecolor.' } #'.$id.' .ast_biotxt{' . $txtcolor. '}</style>';
			
		}

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
		
        $instance['image_uri'] = esc_url_raw( $new_instance['image_uri'] );
        $instance['name'] = strip_tags( $new_instance['name'] );
        $instance['occu'] = strip_tags( $new_instance['occu'] );
		$instance['bio'] = wp_kses_post( $new_instance['bio'] );
		
		$instance['bgcolor'] = optimizer_sanitize_hex( $new_instance['bgcolor'] );
		$instance['txtcolor'] = optimizer_sanitize_hex( $new_instance['txtcolor'] );
		$instance['titlecolor'] = optimizer_sanitize_hex( $new_instance['titlecolor'] );

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'image_uri' => get_template_directory_uri().'/assets/images/biowidget_pp.jpg',
		'name' => 'Jhon Doe',
		'occu' => __('Blogger','optimizer'),
		'bio' => __('Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.','optimizer'),
		'bgcolor' => '',
		'txtcolor' => '',
		'titlecolor' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
    </p>
    
    
		<!-- BIO Image Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php _e('Image', 'optimizer') ?></label>
			<div class="media-picker-wrap">
            <?php if(!empty($instance['image_uri'])) { ?>
				<img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['image_uri']); ?>" />
                <i class="fa fa-times media-picker-remove"></i>
            <?php } ?>
            <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" value="<?php echo esc_url($instance['image_uri']); ?>" type="hidden" />
            <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'image_uri' ).'mpick'; ?>"><?php _e('Select Image', 'optimizer') ?></a>
            </div>
		</p>
    
    <p>
      <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php echo $instance['name']; ?>" class="widefat" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id('occu'); ?>"><?php _e('Occupation', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('occu'); ?>" id="<?php echo $this->get_field_id('occu'); ?>" value="<?php echo $instance['occu']; ?>" class="widefat" />
    </p>
        
        <p>
        <label><?php _e('Description', 'optimizer'); ?></label>
        <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('bio'); ?>" name="<?php echo $this->get_field_name('bio'); ?>"><?php echo $instance['bio']; ?></textarea>
        </p>
		
        
        <!-- Widget Backgrounnd Color Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'bgcolor' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
			<input class="widefat color-picker" id="<?php echo $this->get_field_id( 'bgcolor' ); ?>" name="<?php echo $this->get_field_name( 'bgcolor' ); ?>" value="<?php echo $instance['bgcolor']; ?>" type="text" />
		</p>
        
        <!-- Widget Text Color Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'txtcolor' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
			<input class="widefat color-picker" id="<?php echo $this->get_field_id( 'txtcolor' ); ?>" name="<?php echo $this->get_field_name( 'txtcolor' ); ?>" value="<?php echo $instance['txtcolor']; ?>" type="text" />
		</p>
        
        <!-- Widget Title Color Field -->
		<p>
			<label for="<?php echo $this->get_field_id( 'titlecolor' ); ?>"><?php _e('Title Color', 'optimizer') ?></label>
			<input class="widefat color-picker" id="<?php echo $this->get_field_id( 'titlecolor' ); ?>" name="<?php echo $this->get_field_name( 'titlecolor' ); ?>" value="<?php echo $instance['titlecolor']; ?>" type="text" />
		</p>
        

		
	<?php
	}


		//ENQUEUE CSS
        function front_bio_enqueue_css() {
		$settings = $this->get_settings();
		if(!is_customize_preview()){
		if ( empty( $settings ) ) {
			return;
		}

			foreach ( $settings as $instance_id => $instance ) {
				$id = $this->id_base . '-' . $instance_id;
	
				if ( ! is_active_widget( false, $id, $this->id_base ) ) {
					continue;
				}
				
			$postbgcolor =		'';
			$titlecolor =		'';
         $secbgcolor =		'';
         $txtcolor =		'';
         $bgcolor =		'';
			
			if ( ! empty( $instance['bgcolor'] ) ){	$bgcolor = 'background-color: ' . $instance['bgcolor'] . '; ';}
			if ( ! empty( $instance['txtcolor'] ) ){	$txtcolor = 'color: ' . $instance['txtcolor'] . '; ';}
			if ( ! empty( $instance['titlecolor'] ) ) {	$titlecolor = 'color: ' . $instance['titlecolor'] . '; ';}
				
				$widget_style = '#'.$id.' .widget_wrap{ '.$bgcolor.' }#'.$id.' .widgettitle, #'.$id.' .ast_biotxt h3{'.$titlecolor.' } #'.$id.' .ast_biotxt{' . $txtcolor. '}';
				wp_add_inline_style( 'optimizer-style', $widget_style );
			}
		}
	} //END FOREACH
}


/* ---------------------------- */
/* -------- Instagram Widget -------- */
/* ---------------------------- */
add_action( 'widgets_init', 'ast_instagram_widgets' );


/*
 * Register widget.
 */
function ast_instagram_widgets() {
	register_widget( 'ast_instagram_widget' );
}

/*
 * Widget class.
 */
class ast_instagram_Widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	function __construct() {
		parent::__construct( 'ast_instagram_widget', __( 'Instagram', 'optimizer' ), array(
			'classname'   => 'ast_instagram_widget',
			'description' => __( 'An Instagram widget that let\'s you display your Instagram photos.', 'optimizer' ),
		) );
		$this->alt_option_name = 'ast_instagram_widget';
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title =        isset($instance['title']) ? apply_filters('widget_title', $instance['title'] ) :'';
		$client_id =    isset($instance['client_id']) ? $instance['client_id'] :'';
		$access_token = isset($instance['access_token']) ? $instance['access_token'] :'';
		$num =          isset($instance['num']) ?$instance['num'] :'';
		$size =         isset( $instance['size'] ) ? $instance['size'] : 'thumb';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

         
		/* Display a containing div */
		echo '<ul id="ast_instagram" class="widget_insta_'.$size.' widget_insta-'.$this->id.'">';
      $photos = optimizer_get_instagram_media( $access_token, $client_id, $num);
      if($photos){
         foreach ($photos as $key => $photo) {
            if(isset($photo->media_url) && isset($photo->permalink)){
               echo '<li><a href="'.esc_url( $photo->permalink ).'" target="_blank"><img src="'. $photo->media_url.'"></a></li>';
            }
         }
      }
		echo '</ul>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
        $instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['client_id'] = strip_tags( $new_instance['client_id']);
		$instance['access_token'] = strip_tags( $new_instance['access_token']);
		$instance['num'] = absint( $new_instance['num']);	
		$instance['size'] = strip_tags( $new_instance['size']);	
		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => '',
		'client_id' => '',
		'access_token' => '',
		'num' => '9',
		'size' => 'thumb',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id('client_id'); ?>"><?php _e('Instagram user id number', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('client_id'); ?>" id="<?php echo $this->get_field_id('client_id'); ?>" value="<?php echo $instance['client_id']; ?>" class="widefat" />
    </p>    <p>
      <label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Instagram Access Token', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('access_token'); ?>" id="<?php echo $this->get_field_id('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" class="widefat" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of Photos', 'optimizer'); ?></label>
      <input type="text" name="<?php echo $this->get_field_name('num'); ?>" id="<?php echo $this->get_field_id('num'); ?>" value="<?php echo $instance['num']; ?>" class="widefat" />
    </p>
    
    <!-- Image Size: Text Input -->
    <p>
        <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Image Size', 'optimizer') ?></label>
        <select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat">
            <option value="thumb"  <?php if ( 'thumb' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'optimizer') ?></option>
            <option value="medium"  <?php if ( 'medium' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Medium', 'optimizer') ?></option>
            <option value="large"  <?php if ( 'large' == $instance['size'] ) echo 'selected="selected"'; ?>><?php _e('Large', 'optimizer') ?></option>
        </select>
    </p>

   
    <p>
		<!--WIDGET TIPS-->
         <ul class="widget_tips">
             <li><i class="fa fa-info-circle"></i> <?php _e('To Retrive your user id number and Access token, Please follow ','optimizer'); ?> <a target="_blank" href="https://optimizerwp.com/documentation/activating-instagram-widget/"><?php _e('This Instruction','optimizer'); ?> </a>
             </li>
         </ul>
	</p>
	<?php
	}

}





/* ---------------------------- */
/* -------- Pinterest Widget -------- */
/* ---------------------------- */
include_once(ABSPATH . WPINC . '/feed.php');

// Register the widget.
add_action( 'widgets_init', 'optimizer_register_pinterest_widget' );

function optimizer_register_pinterest_widget() {
	register_widget( 'optimizer_pinterest_widget' );
}


class optimizer_pinterest_Widget extends WP_Widget {



	function __construct() {
		parent::__construct( 'optimizer_pinterest_widget', __( 'Pinterest', 'optimizer' ), array(
			'classname'   => 'optimizer_pinterest_widget',
			'description' => __( 'This Widget lets you add Pinterest Pinboards', 'optimizer' ),
		) );
		$this->alt_option_name = 'optimizer_pinterest_widget';
	}
	
	
    /**
     * Widget settings.
     */
    protected $widget = array(
            // Default title for the widget in the sidebar.
            'title' => 'Recent pins',
            // Default widget settings.
            'username' => 'layerthemes',
            'num' => 12,
            'new_window' => 0,
            // RSS cache lifetime in seconds.
            'cache_lifetime' => 900,
            // Pinterest url
            'pinterest_feed_url' => 'https://pinterest.com/%s/feed.rss',
			'size' => 'thumb'
    );
    
    var $start_time;
    var $protocol;

    
    function widget($args, $instance) {
        extract($args);
        echo($before_widget);
		if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
        $title = apply_filters('widget_title', $instance['title']);
        echo($before_title . $title . $after_title);
		$size = isset( $instance['size'] ) ? $instance['size'] : 'thumb';
        ?>
        <div id="pinterest-pinboard-widget-container" class="widget_pinterest_<?php echo $size; ?>">
            <div class="pinboard">
            <?php

            // Get the RSS.
            $username = $instance['username'];
            $num = $instance['num'];
            $new_window = $instance['new_window'];
            $pins = $this->get_pins($username, $num);
			$size = isset( $instance['size'] ) ? $instance['size'] : 'thumb';
			
            if (is_null($pins)) {
                echo("Unable to load Pinterest pins for '$username'\n");
            } else {
                // Render the pinboard.
                $count = 0;
                foreach ($pins as $pin) {

                    $title = $pin['title'];
                    $url = $pin['url'];
                    $image = $pin['image'];
                    echo("<a href=\"$url\"");
                    if ($new_window) {
                        echo(" target=\"_blank\"");
                    }
                    echo("><img src=\"$image\" alt=\"$title\" title=\"$title\" /></a>");
                    $count++;

                }
            }
            ?>
            </div>
            <div class="pin_link">
                <a class="pin_logo" href="https://pinterest.com/<?php echo($username) ?>/">
                    <img src="https://passets-cdn.pinterest.com/images/small-p-button.png" width="16" height="16" alt="<?php _e('Follow Me on Pinterest' ,'optimizer') ?>" />
                </a>
                <span class="pin_text"><a target="_blank" href="http://pinterest.com/<?php echo($username) ?>/" <?php if ($new_window) { ?>target="_blank"<?php } ?>><?php _e('More Pins' ,'optimizer') ?></a></span>
            </div>
        </div>
        <?php
        echo($after_widget);
    }
	


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['num'] = strip_tags($new_instance['num']);
        $instance['new_window'] = isset($new_instance['new_window']) ? 1 : 0;
		$instance['size'] = strip_tags($new_instance['size']);

        return $instance;
    }
    
    function form($instance) {
        // load current values or set to default.
        $title = array_key_exists('title', $instance) ? esc_attr($instance['title']) : $this->widget['title'];
        $username = array_key_exists('username', $instance) ? esc_attr($instance['username']) : $this->widget['username'];
        $num = array_key_exists('num', $instance) ? esc_attr($instance['num']) : $this->widget['num'];
        $new_window = array_key_exists('new_window', $instance) ? esc_attr($instance['new_window']) : $this->widget['new_window'];
		$size = array_key_exists('size', $instance) ? esc_attr($instance['size']) : $this->widget['size'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'optimizer'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title', 'optimizer'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:', 'optimizer'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username', 'optimizer'); ?>" type="text" value="<?php echo $username; ?>" />
        </p>
        
        <!-- Image Size: Text Input -->
        <p>
            <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Image Size', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat">
                <option value="thumb"  <?php if ( 'thumb' == $size ) echo 'selected="selected"'; ?>><?php _e('Thumbnail', 'optimizer') ?></option>
                <option value="medium"  <?php if ( 'medium' == $size ) echo 'selected="selected"'; ?>><?php _e('Medium', 'optimizer') ?></option>
                <option value="large"  <?php if ( 'large' == $size ) echo 'selected="selected"'; ?>><?php _e('Large', 'optimizer') ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Number of Pins', 'optimizer'); ?></label>
            <input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $num; ?>" size="3" />
            <span><small><?php _e(' (Max 25)', 'optimizer'); ?></small></span>
        </p>
        
        <p>
            <input id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window', 'optimizer'); ?>" type="checkbox" <?php if ($new_window) { ?>checked="checked" <?php } ?> />
            <label for="<?php echo $this->get_field_id('new_window'); ?>"><?php _e('Open links in a new window?', 'optimizer'); ?></label>
        </p>        
        <?php
    }


    
    /**
     * Retrieve RSS feed for username, and parse the data needed from it.
     * Returns null on error, otherwise a hash of pins.
     */
    function get_pins($username, $num) {

        // Set caching.
        //add_filter('wp_feed_cache_transient_lifetime', create_function('$a', 'return '. $this->widget['cache_lifetime'] .';'));
		add_filter( 'wp_feed_cache_transient_lifetime' . function($a) {return $this->widget['cache_lifetime'];},999);

        // Get the RSS feed.
        $url = sprintf($this->widget['pinterest_feed_url'], $username);
        $rss = fetch_feed($url);
        if (is_wp_error($rss)) {
            return null;
        }
		$size = $this->widget['size'];
        
        $maxitems = $rss->get_item_quantity($num);
        $rss_items = $rss->get_items(0, $maxitems);
        
        $pins;
        if (is_null($rss_items)) {
            $pins = null;
        } else {
            // Pattern to replace for the images.
            $search = array('236x');
			if($size == 'large'){$replace = array('736x');}else{$replace = array('236x');}
            
            // Add http replace is running secure.
            if ($this->is_secure()) {
                array_push($search, 'http://');
                array_push($replace, $this->protocol);
            }
            $pins = array();
            foreach ($rss_items as $item) {
                $title = $item->get_title();
                $description = $item->get_description();
                $url = $item->get_permalink();
                if (preg_match_all('/<img src="([^"]*)".*>/i', $description, $matches)) {
                    $image = str_replace($search, $replace, $matches[1][0]);
                }
                array_push($pins, array(
                    'title' => $title,
                    'image' => $image,
                    'url' => $url
                ));
            }
        }
        return $pins;
    }
    
    
    /**
     * Check if the server is running SSL.
     */
    function is_secure() {
        return !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off'
            || $_SERVER['SERVER_PORT'] == 443;
    } 

}