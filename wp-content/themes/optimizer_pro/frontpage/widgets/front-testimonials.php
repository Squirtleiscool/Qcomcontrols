<?php
/*
 *FRONTPAGE - Testimonials WIDGET
 */
add_action( 'widgets_init', 'optimizer_register_front_testimonials' );

/*
 * Register widget.
 */
function optimizer_register_front_testimonials() {
	register_widget( 'optimizer_front_testimonials' );
}


/*
 * Widget class.
 */
class optimizer_front_Testimonials extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */

	
	function __construct() {
		if(is_customize_preview()){$widgetname = __( 'Testimonial', 'optimizer' ); }else{ $widgetname = __( '&diams; Testimonial Widget', 'optimizer' ); }
		
		parent::__construct( 'optimizer_front_testimonials', $widgetname, array(
			'classname'   => 'optimizer_front_testimonials home_testi',
			'description' => __( 'Optimizer Testimonial Section widget', 'optimizer' ),
			'customize_selective_refresh' => true,
		) );
		$this->alt_option_name = 'optimizer_front_testimonials';
		//add_action('wp_enqueue_scripts', array(&$this, 'front_testi_enqueue_css'));
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {

		
		extract( $args );
		/* Our variables from the widget settings. */
		$title = isset( $instance['title'] ) ? $instance['title'] : __('What are people saying?', 'optimizer');
		$subtitle = isset( $instance['subtitle'] ) ? $instance['subtitle'] : __('Testimonial Subtitle', 'optimizer');
		$custom_testi = isset( $instance['custom_testi'] ) ? $instance['custom_testi'] : array();
		$twitter_testi_on = isset( $instance['twitter_testi_on'] ) ? $instance['twitter_testi_on'] : '';
		$twitter_testi = isset( $instance['twitter_testi'] ) ? $instance['twitter_testi'] : array();
      $testi_layout = isset( $instance['testi_layout'] ) ? $instance['testi_layout'] : 'col1';
      $testi_alignment = isset( $instance['testi_align'] ) ? $instance['testi_align'] : 'center';
		$divider = isset( $instance['divider'] ) ? apply_filters('widget_title', $instance['divider']) : 'fa-stop';
		$content_color = isset( $instance['content_color'] ) ? $instance['content_color'] : '';
		$title_color = isset( $instance['title_color'] ) ? $instance['title_color'] : '';
		$content_bg = isset( $instance['content_bg'] ) ? $instance['content_bg'] : '';
		$content_bgimg = isset( $instance['content_bgimg'] ) ? $instance['content_bgimg'] : '';
		$testi_pausetime = isset( $instance['testi_pausetime'] ) ? $instance['testi_pausetime'] : '8000';

		/* Before widget (defined by themes). */
		echo $before_widget;
		
			//Sitegorigin Builder FIX
			echo '<span class="so_widget_id" data-panel-id="'.$this->id.'"></span>';
			if(is_customize_preview()) echo '<span class="widgetname">'.$this->name.'</span>';
			
		?>
        <?php
		
			//WIDGET EDIT BUTTON(Customizer)
			if(is_customize_preview()){  echo '<a class="edit_widget" title="'.__('Edit ','optimizer').$this->id.'"><i class="fa fa-pencil"></i></a>'; }
			
		echo '<div class="home_testi_inner testi_'.$testi_layout.' testi_align_'.$testi_alignment.'"><div class="center">';
			echo '<div class="homeposts_title testimonial_title title_'.str_replace('fa-','dvd_',$divider).'">';
				if ( $title || is_customize_preview() ){
					echo '<h2 class="home_title"><span>'.do_shortcode($title).'</span></h2>';
				}
				if ( $subtitle || is_customize_preview() ){
					echo '<div class="home_subtitle"><span>'.do_shortcode($subtitle).'</span></div>';
				}
				if ( $divider ){
					if( $divider !== 'no_divider'){
						if($divider == 'underline'){ $underline= 'title_underline';}else{$underline='';}
							echo '<div class="optimizer_divider '.$underline.' divider_style_'.str_replace('fa-','dvd_',$divider).'"><span class="div_left"></span><span class="div_middle"><i class="fa '.$divider.'"></i></span><span class="div_right"></span></div>';
					}
				}
			echo '</div>';
			
		if(!isset($instance['custom_testi'])){ echo '<p class="widget_warning" style="color: #fff;">'.__('Please Click the "+ Add New" button to create new testimonials','optimizer').'</p>';}
					/*START TWITTER TESTIMONIALS*/
					if(!empty($twitter_testi_on)){
						echo '<div class="home_tweets_wrap">';
							
								if(!empty($twitter_testi_on)){
									$i = 0;
										foreach($twitter_testi as $tweet){
											echo '<div class="home_tweet">'.wp_oembed_get(esc_url($tweet['url'])).'</div>';
										}
								}
						   
						echo '</div>';
					}elseif (!empty ($custom_testi)){
                  /*START CUSTOM TESTIMONIALS*/
                  $chunkSize = 1; if($testi_layout === 'col2'){ $chunkSize = 2; } if($testi_layout === 'col3'){ $chunkSize = 3; }
                  $testi_chunks = array_chunk($custom_testi,$chunkSize);
                  $chunk_count = count($testi_chunks);
                  if( $chunk_count > 1 ) { $looper = 'data-looper="go" class="looper slide" data-interval="'.$testi_pausetime.'"'; }else{ $looper = ''; }
						echo '<div id="testi-looper_'.$this->id.'" '.$looper.' ><ul class="looper-inner">';
                     foreach ((array)$testi_chunks as $testiChunk){ 
                        echo '<li class="item">';
                        foreach ((array)$testiChunk as $testimony){ 

                           echo '<div class="testi_item">
                              <div class="testi_content">'.do_shortcode( $testimony['testimonial']).'</div>
                              <div class="testi_author">';
                                 if (!empty ($testimony['image'])) {
                                    echo '<img alt="'.$testimony['title'].'" class="testi_avatar" src="'.$testimony['image'].'" />' ;
                                 }
                                 if(!empty($testimony['url'])){ $href = 'href="'.esc_url($testimony['url']).'"'; }else{ $href = ''; }
                                 echo '<a '.$href.'>'.$testimony['title'].'</a>';
                                 if(!empty($testimony['occupation'])){ echo '<span class="testi_occu">'.$testimony['occupation'].'</span>'; }
                           echo '</div>    
                           </div>';
                        }
                        echo '</li>';
                     }   
							echo '</ul>';

						
						//LOOPER NAVIGATION 
						if( $chunk_count > 1 ) {
							if(!empty($content_bgimg)){$hasbg = 'has_bg';}else{ $hasbg = 'has_bg'; }
						
							echo '<nav><ul class="looper-nav '.$hasbg.'">';
                        for ($i=0; $i < $chunk_count; $i++) { 
                           echo '<li><a href="#testi-looper_'.$this->id.'" data-looper="to" data-args="'.($i +1).'"><span></span></a></li>';
                        }
							echo '</ul></nav>';
						}
					
						
					echo '</div>';  //END of testi-looper div
					
					}

		echo '</div></div>';

		
		//Stylesheet-loaded in Customizer Only.
		if(is_customize_preview()){
			$id= $this->id;
			echo "<script>jQuery(function() { jQuery('#".$id." .testi_col1 .looper-inner li').eq(0).addClass('active');  });</script>";
         echo  '<style>'.$this->generate_css($id, $instance).'</style>';
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
		
		/* No need to strip tags */
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['twitter_testi_on'] = isset($new_instance['twitter_testi_on']) ? strip_tags($new_instance['twitter_testi_on']) : '';
		$instance['divider'] = strip_tags($new_instance['divider']);
      $instance['testi_layout'] = strip_tags($new_instance['testi_layout']);
      $instance['testi_align'] = strip_tags($new_instance['testi_align']);
		$instance['content_color'] = optimizer_sanitize_hex($new_instance['content_color']);
		$instance['title_color'] = optimizer_sanitize_hex($new_instance['title_color']);
		$instance['content_bg'] = optimizer_sanitize_hex($new_instance['content_bg']);
		$instance['content_bgimg'] = esc_url_raw($new_instance['content_bgimg']);
		$instance['testi_pausetime'] = strip_tags($new_instance['testi_pausetime']);
		
		
        $instance['custom_testi'] = array();
		$instance['twitter_testi'] = array();
		

        if ( isset( $new_instance['custom_testi'] ) )
        {
            foreach ( $new_instance['custom_testi'] as $testi )
            {
                if ( '' !== trim( $testi['title'] ) )
                    $instance['custom_testi'][] = $testi;
            }
        }
		
        if ( isset( $new_instance['twitter_testi'] ) )
        {
            foreach ( $new_instance['twitter_testi'] as $twitter )
            {
                if ( '' !== esc_url_raw( $twitter['url'] ) )
                    $instance['twitter_testi'][] = $twitter;
            }
        }

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
		'title' => __('What are people saying?','optimizer'),
		'subtitle' => __('Real words from real customers!','optimizer'),
		'custom_testi' => array(),
		'twitter_testi_on' => '',
		'twitter_testi' => array(),
      'testi_layout' => 'col1',
      'testi_align' => 'center',
		'divider' => 'fa-stop',
		'content_color' => '#ffffff',
		'title_color' => '#ffffff',
		'content_bg' => '#64c2ff',
		'content_bgimg' => '',
		'testi_pausetime' => '8000',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

      
      <div class="optimizer_widget_tab optimizer_widget_tab--content">

         <!-- Testimonial Section TITLE Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
         
         <!-- Testimonial Section Subtitle Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo htmlspecialchars($instance['subtitle'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>

         <!-- TESTIMONIAL Column Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'testi_layout' ); ?>"><?php _e('Testimonials Layout:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'testi_layout' ); ?>" name="<?php echo $this->get_field_name( 'testi_layout' ); ?>" class="widefat">
               <option value="col1" <?php if ( 'col1' == $instance['testi_layout'] ) echo 'selected="selected"'; ?>><?php _e('1 Column', 'optimizer') ?></option>
               <option value="col2" <?php if ( 'col2' == $instance['testi_layout'] ) echo 'selected="selected"'; ?>><?php _e('2 Column', 'optimizer') ?></option>
                  <option value="col3" <?php if ( 'col3' == $instance['testi_layout'] ) echo 'selected="selected"'; ?>><?php _e('3 Column', 'optimizer') ?></option>
            </select>
         </p>
         <!-- TESTIMONIAL Column Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'testi_align' ); ?>"><?php _e('Testimonials Alignment:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'testi_align' ); ?>" name="<?php echo $this->get_field_name( 'testi_align' ); ?>" class="widefat">
               <option value="left" <?php if ( 'left' === $instance['testi_align'] ) echo 'selected="selected"'; ?>><?php _e('Left', 'optimizer') ?></option>
               <option value="center" <?php if ( 'center' === $instance['testi_align'] ) echo 'selected="selected"'; ?>><?php _e('Center', 'optimizer') ?></option>
                  <option value="right" <?php if ( 'right' === $instance['testi_align'] ) echo 'selected="selected"'; ?>><?php _e('Right', 'optimizer') ?></option>
            </select>
         </p>
         
         <!-- ----------------Testimonial Field------------------------ -->
         <div class="widget_repeater" data-widget-id="<?php echo $this->get_field_id( 'custom_testi' ); ?>" data-widget-name="<?php echo $this->get_field_name( 'custom_testi' ); ?>">
         <?php 
         $customtesti = isset( $instance['custom_testi'] ) ? $instance['custom_testi'] : array();
         $customtesti_num = count($customtesti);
         $customtesti[$customtesti_num+1] = '';
         $customtesti_html = array();
         $customtesti_counter = 0;

         foreach ( $customtesti as $testi ) 
         {   
               if ( isset($testi['title']) )
               {
                  $client_image_name = explode('/', esc_url($testi['image']));
                  if(is_array($client_image_name)){
                     $client_image_title = end($client_image_name);
                  }else{
                     $client_image_title = '';
                  };
                  $customtesti_html[] = sprintf(
                     '<div class="widget_input_wrap"><i class="fa fa-arrows-v"></i>
                     <span id="%9$s%2$s" class="repeat_handle" onclick="repeatOpen(this.id)">%3$s</span>
                     <input type="text" name="%1$s[%2$s][title]" value="%3$s" class="widefat" placeholder="%6$s">
                     <input type="text" name="%1$s[%2$s][url]" value="%4$s" class="widefat" placeholder="%7$s">
                     <input type="text" name="%1$s[%2$s][occupation]" value="%14$s" class="widefat" placeholder="%15$s">
                     <textarea name="%1$s[%2$s][testimonial]" class="widefat">%13$s</textarea>
                     <div class="media-picker-wrap">
                        %12$s
                        <input id="%10$s-%2$s" type="hidden" name="%1$s[%2$s][image]" value="%5$s" class="widefat media-picker">
                        <a id="%11$s-%2$s" onclick="mediaPicker(this.id)" class="media-picker-button button">%8$s</a>
                     </div>
                     <span class="remove-field button button-primary">Remove</span>
                  </div>',
                     $this->get_field_name( 'custom_testi' ),
                     $customtesti_counter,
                  esc_attr( $testi['title'] ),
                     esc_url( $testi['url'] ),
                  esc_url( $testi['image'] ),
                  __('Client\'s Name (Required)','optimizer'),
                  __('Client\'s Website','optimizer'),
                  __('Select Image', 'optimizer'),
                  $this->get_field_id('custom_add_field').'-repeat',
                  $this->get_field_id('custom_testi').'',
                  $this->get_field_id('custom_testi').'-mpick',
                  !empty($testi['image']) ? '<img class="media-picker-preview" title="'.$client_image_title.'" src="'.esc_url($testi['image']).'" /><i class="fa fa-times media-picker-remove"></i>': '',
                  wp_kses_post( $testi['testimonial']),
                  esc_attr( $testi['occupation'] ),
                  __('Client\'s Occupation','optimizer')
                  );
               }

               $customtesti_counter += 1;
         }

         echo '<h4>'.__('Custom Testimonials','optimizer').'</h4>' . join( $customtesti_html );

         ?>
         
         <script type="text/javascript">
            var fieldnum = <?php echo json_encode( $customtesti_counter-1 ) ?>;
            var count = fieldnum;
            function customTesticlickFunction(buttonid){
               var fieldname = jQuery('#'+buttonid).data('widget-fieldname');
               var fieldid = jQuery('#'+buttonid).data('widget-fieldid');
               
                  jQuery('#'+buttonid).prev().append("<div class='widget_input_wrap'><i class='fa fa-arrows-v'></i><span id='"+buttonid+"-repeat"+(count+1)+"' class='repeat_handle' onclick='repeatOpen(this.id)'></span><input type='text' name='"+fieldname+"["+(count+1)+"][title]' value='<?php _e( 'Clients Name (Required)', 'optimizer' ); ?>' class='widefat' placeholder='<?php _e( 'Clients Name (Required)', 'optimizer' ); ?>'><input type='text' name='"+fieldname+"["+(count+1)+"][url]' value='http://google.com' class='widefat' placeholder='<?php _e( 'Clients Website', 'optimizer' ); ?>'><input type='text' name='"+fieldname+"["+(count+1)+"][occupation]' value='' class='widefat' placeholder='<?php _e( 'Clients Occupation', 'optimizer' ); ?>'><textarea name='"+fieldname+"["+(count+1)+"][testimonial] class='widefat sourc"+(count+1)+"' placeholder='<?php _e( 'Clients Testimony', 'optimizer' ); ?>'></textarea><div class='media-picker-wrap'><input type='hidden' name='"+fieldname+"["+(count+1)+"][image]' value='' class='widefat media-picker' id='"+fieldid+"-"+(count+1)+"'><a id='"+fieldid+"-mpick"+(count+1)+"' class='media-picker-button button' onclick='mediaPicker(this.id)'><?php _e('Select Image', 'optimizer') ?></a></div><span class='remove-field button button-primary'>Remove</span></div>");
                  count++;
               
            }

         </script>

         <span id="<?php echo $this->get_field_id( 'custom-field_clone' );?>" class="repeat_clone_field" data-empty-content="<?php _e('No Custom Testimonials Added', 'optimizer') ?>"></span>

         <?php echo '<input onclick="customTesticlickFunction(this.id)" class="button button-primary" type="button" value="' . __( '+ Add New', 'optimizer' ) . '" id="'.$this->get_field_id('custom_add_field').'" data-widget-fieldname="'.$this->get_field_name('custom_testi').'" data-widget-fieldid="'.$this->get_field_id('custom_testi').'" />';?>
         <div class="repeater_apply_message"><?php _e( 'Click the Apply Button Below to See the change', 'optimizer' ) ;?></div>
         </div>
         
         
         
         <!-- POSTS Preview Button Field -->
         <p style="clear:both">
            <label for="<?php echo $this->get_field_id( 'twitter_testi_on' ); ?>"><?php _e('Display Twitter Testimonial', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'twitter_testi_on' ); ?>" name="<?php echo $this->get_field_name( 'twitter_testi_on' ); ?>" value="1" type="checkbox" <?php if ( '1' == $instance['twitter_testi_on'] ) echo 'checked'; ?> />
         </p>
        
         <!-- ----------------Twitter Testimonial Field------------------------ -->
         
         <div class="widget_repeater" data-widget-id="<?php echo $this->get_field_id( 'twitter_testi' ); ?>" data-widget-name="<?php echo $this->get_field_name( 'twitter_testi' ); ?>">
         <?php 
         $twittertesti = isset( $instance['twitter_testi'] ) ? $instance['twitter_testi'] : array();
         $twittertesti_num = count($twittertesti);
         $twittertesti[$twittertesti_num+1] = '';
         $twittertesti_html = array();
         $twittertesti_counter = 0;

         foreach ( $twittertesti as $tweet ) 
         {   
               if ( isset($tweet['url']) )
               {
                  $twittertesti_html[] = sprintf(
                     '<div class="widget_multi-text">
                     <input type="text" name="%1$s[%2$s][url]" value="%3$s" class="widefat" placeholder="%4$s">
                     <span class="remove-field"><i class="fa fa-times"></i></span>
                  </div>',
                     $this->get_field_name( 'twitter_testi' ),
                     $twittertesti_counter,
                  esc_attr( $tweet['url'] ),
                  __('Twitter Status link','optimizer'),
                  $this->get_field_id('twitter_add_field').'-repeat'
                  );
               }

               $twittertesti_counter += 1;
         }

         echo '<h4>'.__('Twitter Testimonials','optimizer').'</h4>' . join( $twittertesti_html );

         ?>
         
         <script type="text/javascript">
            var twtcount = <?php echo json_encode( $twittertesti_counter-1 ) ?>;
            function twitterTesticlickFunction(buttonid){
               var fieldname = jQuery('#'+buttonid).data('widget-fieldname');
               var fieldid = jQuery('#'+buttonid).data('widget-fieldid');
               
                  jQuery('#'+buttonid).prev().append("<div class='widget_multi-text'><input type='text' name='"+fieldname+"["+(twtcount+1)+"][url]' value='<?php _e( 'Twitter Status link', 'optimizer' ); ?>' class='widefat' placeholder='<?php _e( 'Twitter Status link', 'optimizer' ); ?>'><span class='remove-field'><i class='fa fa-times'></i></span></div>");
                  twtcount++;
               
            }
            


         </script>

         <span id="<?php echo $this->get_field_id( 'twitter-field_clone' );?>" class="repeat_clone_field" data-empty-content="<?php _e('No Twitter Testimonials Added','optimizer') ?>"></span>

         <?php echo '<input onclick="twitterTesticlickFunction(this.id)" class="button button-primary" type="button" value="' . __( '+ Add New', 'optimizer' ) . '" id="'.$this->get_field_id('twitter_add_field').'" data-widget-fieldname="'.$this->get_field_name('twitter_testi').'" data-widget-fieldid="'.$this->get_field_id('twitter_testi').'" />';?>
         
         </div>
        
        
         <!-- Testimonial Section Subtitle Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'testi_pausetime' ); ?>"><?php _e('Testimonial Pausetime:', 'optimizer') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'testi_pausetime' ); ?>" name="<?php echo $this->get_field_name( 'testi_pausetime' ); ?>" value="<?php echo htmlspecialchars($instance['testi_pausetime'], ENT_QUOTES, "UTF-8"); ?>" type="text" />
         </p>
        
      </div>


      <div class="optimizer_widget_tab optimizer_widget_tab--style" style="display:none">
      
         <!-- TESTIMONIAL TITLE DIVIDER Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'divider' ); ?>"><?php _e('Title Divider:', 'optimizer') ?></label>
            <select id="<?php echo $this->get_field_id( 'divider' ); ?>" name="<?php echo $this->get_field_name( 'divider' ); ?>" class="widefat">
                  <option value="underline" <?php if ( 'underline' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Underline', 'optimizer') ?></option>
                  <option value="border-center" <?php if ( 'border-center' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Center)', 'optimizer') ?></option>
                  <option value="border-left" <?php if ( 'border-left' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Left)', 'optimizer') ?></option>
                  <option value="border-right" <?php if ( 'border-right' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bordered (Right)', 'optimizer') ?></option>
                  <option value="fa-stop" <?php if ( 'fa-stop' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Rhombus', 'optimizer') ?></option>
               <option value="fa-star" <?php if ( 'fa-star' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Star', 'optimizer') ?></option>
                  <option value="fa-times" <?php if ( 'fa-times' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Cross', 'optimizer') ?></option>
               <option value="fa-bolt" <?php if ( 'fa-bolt' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bolt', 'optimizer') ?></option>
               <option value="fa-asterisk" <?php if ( 'fa-asterisk' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Asterisk', 'optimizer') ?></option>
                  <option value="fa-chevron-down" <?php if ( 'fa-chevron-down' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Chevron', 'optimizer') ?></option>
               <option value="fa-heart" <?php if ( 'fa-heart' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Heart', 'optimizer') ?></option>
               <option value="fa-plus" <?php if ( 'fa-plus' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Plus', 'optimizer') ?></option>
                  <option value="fa-bookmark" <?php if ( 'fa-bookmark' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Bookmark', 'optimizer') ?></option>
               <option value="fa-circle-o" <?php if ( 'fa-circle-o' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Circle', 'optimizer') ?></option>
                  <option value="fa-th-large" <?php if ( 'fa-th-large' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Blocks', 'optimizer') ?></option>
               <option value="fa-minus" <?php if ( 'fa-minus' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Sides', 'optimizer') ?></option>
               <option value="fa-cog" <?php if ( 'fa-cog' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Cog', 'optimizer') ?></option>
                  <option value="fa-reorder" <?php if ( 'fa-reorder' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Blinds', 'optimizer') ?></option>
                  <option value="fa-diamond" <?php if ( 'fa-diamond' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Diamond', 'optimizer') ?></option>
                  <option value="fa-gg" <?php if ( 'fa-gg' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Tetris', 'optimizer') ?></option>
                  <option value="fa-houzz" <?php if ( 'fa-houzz' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Digital', 'optimizer') ?></option>
                  <option value="fa-rocket" <?php if ( 'fa-rocket' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Rocket', 'optimizer') ?></option>
                  <option value="no_divider" <?php if ( 'no_divider' == $instance['divider'] ) echo 'selected="selected"'; ?>><?php _e('Hide Divider', 'optimizer') ?></option>
            </select>
         </p>

         <!-- Testimonial Title Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_color' ); ?>"><?php _e('Title Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_color' ); ?>" name="<?php echo $this->get_field_name( 'content_color' ); ?>" value="<?php echo $instance['content_color']; ?>" type="text" />
         </p>

         
         
         <!-- Testimonial Content Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e('Text Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo $instance['title_color']; ?>" type="text" />
         </p>


                  
         <!-- Testimonial Background Color Field -->
         <p>
            <label for="<?php echo $this->get_field_id( 'content_bg' ); ?>"><?php _e('Background Color', 'optimizer') ?></label>
            <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'content_bg' ); ?>" name="<?php echo $this->get_field_name( 'content_bg' ); ?>" value="<?php echo $instance['content_bg']; ?>" type="text" />
         </p>
        
        
            
        <!-- Testimonial Background IMAGE FIELD -->
        <div class="widget_input_wrap">
            <label for="<?php echo $this->get_field_id( 'content_bgimg' ); ?>"><?php _e('Background Image', 'optimizer') ?></label>
            <div class="media-picker-wrap">
            <?php if(!empty($instance['content_bgimg'])) { ?>
                <img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['content_bgimg']); ?>" />
                <i class="fa fa-times media-picker-remove"></i>
            <?php } ?>
            <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'content_bgimg' ); ?>" name="<?php echo $this->get_field_name( 'content_bgimg' ); ?>" value="<?php echo esc_url($instance['content_bgimg']); ?>" type="hidden" />
            <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'content_bgimg' ).'mpick'; ?>"><?php _e('Select Image', 'optimizer') ?></a>
            </div>
        </div>


         <!-- Basic Widget Styles -->
         <?php optimizer_widget_basic_styles($instance, $this);?>

      </div>
             
<?php
	}
	//ENQUEUE CSS
   function front_testi_enqueue_css() {
		$settings = $this->get_settings();
		if ( empty( $settings ) ) {
			return;
		}
		foreach ( $settings as $instance_id => $instance ) {
			$id = $this->id_base . '-' . $instance_id;
			if(!is_customize_preview()){
            if ( ! is_active_widget( false, $id, $this->id_base ) ) {
               continue;
            }
            wp_add_inline_style( 'optimizer-style', $this->generate_css($id, $instance) );
			}
      }
   }


   function generate_css($id, $instance){
      $content_bg =		! empty( $instance['content_bg']) ? 'background-color: ' . $instance['content_bg'] . '; ' : 'background-color:#64c2ff;';
      $title_color =		! empty( $instance['title_color']) ?   $instance['title_color'] : '#ffffff';
      $content_bgimg =		! empty( $instance['content_bgimg']) ? 'background-image: url(' . $instance['content_bgimg'] . '); ' : '';
      $content_color =		! empty( $instance['content_color']) ? $instance['content_color'] : '#ffffff;';
               
      //Basic Styles
      $title_size = ! empty( $instance['title_size']) ? 'font-size:'.$instance['title_size'].'px;' : '';
      $font_size = ! empty( $instance['font_size']) ? 'font-size:'.$instance['font_size'].'px;' : '';
      $title_family = ! empty( $instance['title_family']) ? 'font-family:'.$instance['title_family'].';' : '';
      $font_family = ! empty( $instance['font_family']) ? 'font-family:'.$instance['font_family'].';' : '';
      $marginPadding = optimizer_widget_paddingMargin($id, $instance);
      $max_inner_width = ! empty( $instance['max_inner_width']) ? 'max-width:'.$instance['max_inner_width'].';' : '';

      $widget_style = '#'.$id.'{ ' . $content_bg . $content_bgimg. $font_size. $font_family.'}';
      $widget_style .= ($font_size || $font_family) ? '#'.$id.' .testi_content{' . $font_size . $font_family. '}' :'';
      $widget_style .= ($title_size || $title_family) ? '#'.$id.' .home_title{' . $title_size . $title_family. '}' :'';
      $widget_style .= $max_inner_width ?'#'.$id.' .widget_wrap .center{ ' . $max_inner_width.'}' : '';
      $widget_style .= '#'.$id.' .home_title, #'.$id.' .home_subtitle, #'.$id.' span.div_middle{ color:' . $content_color . '}';
      $widget_style .= '#'.$id.' .testi_content, #'.$id.' .testi_author a, #'.$id.' .testi_occu{color:'.$title_color.'; }';
      $widget_style .= '#'.$id.' span.div_left, #'.$id.' span.div_right{background-color:' . $content_color . '}';  

      $widget_style .= '@media screen and (min-width: 480px){#'.$id.' {'.$marginPadding[0].$marginPadding[1].'} } ';
      
      return $widget_style;
   }

}
?>