<?php 
/**
 * The Header for LayerFramework
 *
 * Displays all of the <head> section and everything
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
 
//global $optimizerdb;
/*OPTION DEFAULTS*/ 
global $optimizer;
$optimizer = optimizer_option_defaults();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> <?php optimizer_schema_page_type(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />	
<?php // Google Chrome Frame for IE ?>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<?php // Meta Tags ?>
<?php if(!empty($optimizer['enable_seo'])){   ?>
<?php get_template_part('framework/core','seo'); ?>
<?php }?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<?php if(function_exists('wp_body_open')){ wp_body_open(); } ?>

<?php do_action('optimizer_body_top'); ?>

<!--HEADER-->
	<?php do_action('optimizer_before_header'); ?>
        <div class="header_wrap layer_wrapper">
            <?php get_template_part('template_parts/head','type1'); ?>
        </div>
    <?php do_action('optimizer_after_header'); ?>
    
    
<!--Header END-->

	<!--Slider START-->
	
		<?php if (is_home() && is_front_page()) { ?>
        	<?php do_action('optimizer_before_slider'); ?>
            
            <div id="slidera" class="layer_wrapper <?php if(!empty($optimizer['hide_mob_slide'])){ echo 'mobile_hide_slide';} ?>">
                <?php $slidertype = $optimizer['slider_type_id']; 
				if(!empty($slidertype))
                	get_template_part('frontpage/slider',$slidertype); ?>
            </div> 
            
            <?php do_action('optimizer_after_slider'); ?>
          <?php } ?> 
	
      <!--Slider END-->