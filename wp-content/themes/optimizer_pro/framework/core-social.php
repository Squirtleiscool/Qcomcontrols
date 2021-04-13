<?php 
/**
 * The SHARE THIS Function for LayerFramework
 *
 * Displays The social Bookmark icons on single posts page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<div class="social_bookmarks<?php if(!empty($optimizer['social_show_color'])) { ?> social_color<?php } ?> bookmark_<?php echo $optimizer['social_button_style'];?> bookmark_size_<?php echo $optimizer['social_bookmark_size']; ?>">
	  <?php do_action('optimizer_before_bookmarks'); ?>
	  <?php if(!empty($optimizer['facebook_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_fb" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['facebook_field_id']); ?>"><i class="fa-facebook"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['twitter_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_twt" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['twitter_field_id']); ?>"><i class="fa-twitter"></i></a><?php } ?>
      <?php if(!empty($optimizer['gplus_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_gplus" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['gplus_field_id']); ?>"><i class="fa-google-plus"></i></a> 
      <?php } ?>
      <?php if(!empty($optimizer['youtube_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_ytb" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['youtube_field_id']); ?>"><i class="fa-youtube-play"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['vimeo_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_vimeo" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['vimeo_field_id']); ?>"><i class="fa-vimeo"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['flickr_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_flckr" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['flickr_field_id']); ?>"><i class="fa-flickr"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['linkedin_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_lnkdin" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['linkedin_field_id']); ?>"><i class="fa-linkedin"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['pinterest_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_pin" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['pinterest_field_id']); ?>"><i class="fa-pinterest"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['tumblr_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_tmblr" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['tumblr_field_id']); ?>"><i class="fa-tumblr"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['dribble_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_dribble" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['dribble_field_id']); ?>"><i class="fa-dribbble"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['behance_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_behance" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['behance_field_id']); ?>"><i class="fa-behance"></i></a>
      <?php } ?>
      <?php if(!empty($optimizer['instagram_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_insta" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['instagram_field_id']); ?>"><i class="fa-instagram"></i></a>
      <?php } ?>  
      <?php if(!empty($optimizer['rss_field_id']) || is_customize_preview()){ ?>
      	<a target="_blank" class="ast_rss" rel="noopener" or rel="noreferrer" href="<?php echo esc_url($optimizer['rss_field_id']); ?>"><i class="fa-rss"></i></a>
      <?php } ?>
      <?php do_action('optimizer_after_bookmarks'); ?>
</div>