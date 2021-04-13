<?php
/*
Template Name: Contact Page
*/
global $optimizer;
?><?php

/*if ( basename($_SERVER['PHP_SELF']) == basename(_FILE_) )
{
 die('Access Denied');
}
*/
  //response generation function

  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human       = ''.__('Human verification incorrect.', 'optimizer').'';
  $missing_content = ''.__('Please supply all information.', 'optimizer').'';
  $email_invalid   = ''.__('Email Address Invalid.', 'optimizer').'';
  $message_unsent  = ''.__('Message was not sent. Try Again.', 'optimizer').'';
  $message_sent    = ''.__('Thanks! Your message has been sent.', 'optimizer').'';

  //user posted variables
  if (isset($_POST['message_name'])){ $name = $_POST['message_name'];}else{ $name ='';  }
  if (isset($_POST['message_email'])){ $email = $_POST['message_email'];}else{ $email ='';  }
  if (isset($_POST['message_subject'])){ 
	  $subject = '['.get_bloginfo('name').'] '.$_POST['message_subject'];
  }else{ 
	  $subject = $name.''.__(' Sent a Message From', 'optimizer').''.get_bloginfo('name');  
  }
  if (isset($_POST['message_text'])){ $message = $_POST['message_text'];}else{ $message ='';  }
  if (isset($_POST['message_human'])){ $human = $_POST['message_human'];}else{ $human ='';  }

  //php mailer variables
  $to = $optimizer['contact_email_id'];
  $headers = "From: ".$to." <".$to.">\r\nReply-To:".trim($email);

  if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {

      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
			add_filter('wp_mail_content_type', 'optimizer_contact_mail_type' );
			ob_start();
				echo '<p style="border-bottom: 1px solid #DADADA;padding-bottom: 15px;"><b>From:</b> '.$name.' / '.$email.'<br></p>';
				echo wpautop($message);
					
				$message = ob_get_contents();
					
			ob_end_clean();
			
          $sent = wp_mail($to, $subject, $message, $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
		  remove_filter('wp_mail_content_type', 'optimizer_contact_mail_type' );
		  
		  if(!empty($optimizer['contactredirect'])){ if (isset($_POST['submitted'])){ wp_redirect($optimizer['contactredirect']); exit;}  }
		  
        }
      }
    }
  }
  else if (isset($_POST['submitted'])) my_contact_form_generate_response("error", $missing_content);

?>
<?php get_header(); ?>
	
    <div class="page_contact_wrap layer_wrapper <?php if ($optimizer['contact_latlong_id']) { echo 'has_contact_map'; }else{echo 'no_contact_map';} ?><?php if(!empty($optimizer['contact_sidebar'])) { ?> has_contact_sidebar<?php } ?>">
        
        <!--CUSTOM PAGE HEADER STARTS-->
        <?php $show_pgheader = get_post_meta( $post->ID, 'show_page_header', true); if (empty($show_pgheader)){ ?>
        	<?php get_template_part('framework/core','pageheader'); ?>
        <?php }else{ ?>
		<?php } ?>
        <!--CUSTOM PAGE HEADER ENDS-->

        <div id="content">
            <div class="center">
                <div class="single_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
                    <div class="single_post">
                          <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                          <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                          
                            <!--EDIT BUTTON START-->
                                <?php if ( is_user_logged_in() && is_admin() ) { ?>
                                    <div class="edit_wrap">
                            			<a href="<?php echo get_edit_post_link(); ?>">
                            				<?php _e('Edit','optimizer'); ?>
                                		</a>
                            		</div>
                                <?php } ?>
                            <!--EDIT BUTTON END-->
                            
                        <!--PAGE CONTENT START-->   
                          <div class="single_post_content">
                        	<?php if(empty($optimizer['pageheader_switch'])){ ?>
                            	<?php do_action('optimizer_before_title'); ?>
                        			<h1 class="postitle"><?php the_title(); ?></h1>
                                <?php do_action('optimizer_after_title'); ?>
							<?php } ?>

                                  <!--The MAP-->
                                  <?php if ($optimizer['contact_latlong_id']) { ?><div id="asthemap"></div><?php } ?>

                                  <div class="thn_post_wrap">
                                  
									<?php do_action('optimizer_before_content'); ?>
										<?php the_content(); ?>
                                    <?php do_action('optimizer_after_content'); ?>
                                    
                                  <!--The Contact Form-->
                                 <div class="optimizer_contact_wrap">
                                  <?php echo $response; ?>
                                  <form id="layer_contact_form" action="<?php the_permalink(); ?>" method="post">
                                    <p><input id="layer_cntct_name" placeholder="<?php _e('Name*', 'optimizer'); ?>" type="text" name="message_name" class="cont_inpt" value="<?php if (isset($_POST['message_name'])){ echo esc_attr($_POST['message_name']); } ?>"></label></p>
                                    <p><input id="layer_cntct_email" placeholder="<?php _e('Email*', 'optimizer'); ?>" type="text" name="message_email" class="cont_inpt" value="<?php if (isset($_POST['message_email'])){ echo esc_attr($_POST['message_email']); } ?>"></label></p>
                                    <p><input id="layer_cntct_subject" placeholder="<?php _e('Subject*', 'optimizer'); ?>" type="text" name="message_subject" class="cont_inpt" value="<?php if (isset($_POST['message_subject'])){ echo esc_attr($_POST['message_subject']); } ?>"></label></p>
                                    
                                    <p><textarea id="layer_cntct_msg" placeholder="<?php _e('Your Message', 'optimizer'); ?>" type="text" name="message_text"><?php if (isset($_POST['message_text'])){  echo esc_textarea($_POST['message_text']); } ?></textarea></label></p>
                                    
                                    <?php if($optimizer['gdpr_policy']){ ?>
                                    <p class="layer_cntct_gdpr"><input type="checkbox" id="layer_cntct_gdpr_policy" name="message_gdpr" class="contact_cgdpr" ><label for="layer_cntct_gdpr_policy"><?php echo do_shortcode($optimizer['gdpr_policy']); ?></label></p>
                                    <?php } ?>
                                    
                                    <p class="contact_verify"><label for="message_human"><?php _e('Human Verification', 'optimizer'); ?> <span>*</span> <br><input id="layer_cntct_math" type="text" style="width: 50px;" name="message_human"> + 3 = 5</label></p>
                                    <input type="hidden" name="submitted" value="1">
                                    <p class="contact_submit"><input type="submit" name ="send" value ="<?php _e('Send', 'optimizer'); ?>"></p>
                                  </form>
                                    </div>
                                  </div> 
                                  
                              <div style="clear:both"></div>
    
                          </div>
                          <!--PAGE CONTENT END-->   
    
                      </div>
                      <?php endwhile ?> 
                      </div>
                  
                  <?php endif ?>
                
                    </div>
                    
                <!--SIDEBAR START--> 
                <?php if(!empty($optimizer['contact_sidebar'])) { ?>
					<?php $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true); if (empty($hide_sidebar )){ ?>
                        <?php get_sidebar(); ?>
                    <?php }?>
                <?php }?> 
                <!--SIDEBAR END--> 
            
                </div>
            </div>
    </div><!--layer_wrapper class END-->
<?php get_footer(); ?>