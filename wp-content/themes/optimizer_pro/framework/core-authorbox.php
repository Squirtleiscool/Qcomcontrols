<?php 
/**
 * The Author Box for LayerFramework
 *
 * Displays Author Box on single posts page.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<div class="author_box <?php if (empty($optimizer['author_about_id'])){ echo 'hide_authorbox'; }?>">
    <div class="author_avatar">
    <?php echo get_avatar( get_the_author_meta('ID') , 100); ?>
    </div>
    <div class="author_inner">
        <h5><?php echo get_the_author_meta('display_name'); ?></h5>
        <div class="athor_desc">
        <?php echo get_the_author_meta('description'); ?>
        </div>
        
        <div class="athor_social">
			<?php if (get_the_author_meta('user_url')) { ?>
            <a class="auth_website" href="<?php echo the_author_meta('user_url',get_the_author_meta('ID')); ?>" target="_blank"><i class="fa-globe"></i></a>
            <?php } ?>
			<?php if (get_user_meta( get_the_author_meta('ID'), 'facebook', true )) { ?>
            <a class="auth_facebook" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'facebook', true ); ?>" target="_blank"><i class="fa-facebook"></i></a>
            <?php } ?>
            <?php if (get_user_meta( get_the_author_meta('ID'), 'twitter', true )) { ?>
            <a class="auth_twt" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'twitter', true ); ?>" target="_blank"><i class="fa-twitter"></i></a>
            <?php } ?>
            <?php if (get_user_meta( get_the_author_meta('ID'), 'googleplus', true )) { ?>
            <a class="auth_googleplus" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'googleplus', true ); ?>" target="_blank"><i class="fa-google-plus"></i></a>
            <?php } ?>
            <?php if (get_user_meta( get_the_author_meta('ID'), 'linkedin', true )) { ?>
            <a class="auth_linkedin" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'linkedin', true ); ?>" target="_blank"><i class="fa-linkedin"></i></a>
            <?php } ?> 
            <?php if (get_user_meta( get_the_author_meta('ID'), 'pinterest', true )) { ?>
            <a class="auth_pinterest" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'pinterest', true ); ?>" target="_blank"><i class="fa-pinterest"></i></a>
            <?php } ?> 
            <?php if (get_user_meta( get_the_author_meta('ID'), 'instagram', true )) { ?>
            <a class="auth_instagram" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'instagram', true ); ?>" target="_blank"><i class="fa-instagram"></i></a>
            <?php } ?> 
            <?php if (get_user_meta( get_the_author_meta('ID'), 'dribble', true )) { ?>
            <a class="auth_dribble" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'dribble', true ); ?>" target="_blank"><i class="fa-dribbble"></i></a>
            <?php } ?> 
            <?php if (get_user_meta( get_the_author_meta('ID'), 'behance', true )) { ?>
            <a class="auth_behance" href="<?php echo get_user_meta( get_the_author_meta('ID'), 'behance', true ); ?>" target="_blank"><i class="fa-behance"></i></a>
            <?php } ?> 
            
        </div>
    </div>
</div>