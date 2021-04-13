<?php 
/**
 * The SEO Meta Tags for LayerFramework
 *
 * Displays the meta tags in header.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php if( is_front_page() ) { ?>
    <meta name="title" content="<?php if($optimizer['meta_title_id']){echo $optimizer['meta_title_id']; }else{ echo bloginfo('name'); }?>">
    <meta name="description" content="<?php echo $optimizer['meta_desc_id']; ?>">

<?php }elseif ( is_page() || is_single() ) { ?>

	<?php global $wp_query; $postid = $wp_query->post->ID; 
    $seo_title = get_post_meta( $postid, 'seo_title', true); 
    $seo_desc = get_post_meta( $postid, 'seo_description', true); ?>
    <meta name="title" content="<?php if($seo_title){echo $seo_title; }else{ the_title_attribute(); }?>">
    <meta name="description" content="<?php $seo_desc = get_post_meta( $postid, 'seo_description', true); if($seo_desc){echo $seo_desc;}else{ echo optimizer_seo_excerpt($post->ID, 115);  }?>">

<?php } ?>

<?php if( is_category() && !empty(category_description())) { ?>
   <meta name="description" content="<?php echo trim(esc_attr(strip_tags(category_description())));?>">
<?php } ?>

<?php if( is_tag() && !empty(tag_description()) ) { ?>
   <meta name="description" content="<?php echo trim(esc_attr(strip_tags(tag_description())));?>">
<?php } ?>

<meta property="og:title" content="<?php if( is_front_page() ) { echo bloginfo('name');  }else{ echo the_title_attribute();} ?>"/>
<meta property="og:type" content="<?php if( is_singular('post') ) { echo 'article'; } elseif( is_singular('product') ){ echo 'product'; }else{ echo 'website';}?>"/>
<meta property="og:url" content="<?php if( is_page() || is_single() ) { echo the_permalink();  }else{ echo home_url();} ?>" />

<?php if( is_front_page() ) { ?>
<meta property="og:description" content="<?php echo $optimizer['meta_desc_id']; ?>"/>
<meta property="og:image" content="<?php if(!empty($optimizer['social_thumb_id']['url'])){$defthumb = $optimizer['social_thumb_id'];  echo $defthumb['url']; }?>"/>
<?php }else{ ?>
<meta property="og:description" content="<?php if ( is_page() || is_single() ) {?><?php echo optimizer_seo_excerpt($post->ID, 300); ?><?php }?>"/>
  <?php if ( has_post_thumbnail() ) : ?>
<meta property="og:image" content="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'large', true); echo $thumb_url[0];?>"/>
  <?php elseif(optimizer_first_image()): ?>
<meta property="og:image" content="<?php echo optimizer_first_image(); ?>"/>
  <?php else : ?>
<meta property="og:image" content="<?php if(!empty($optimizer['social_thumb_id']['url'])){$defthumb = $optimizer['social_thumb_id'];  echo $defthumb['url']; }?>"/>
  <?php endif; ?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>

<?php } ?>

<!--HOME-->
<?php if( is_front_page() ) { ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php echo esc_url( home_url( '/' ) );?>">
<meta name="twitter:title" content="<?php echo bloginfo('name'); ?>">
<meta name="twitter:description" content="<?php echo $optimizer['meta_desc_id']; ?>">
<meta name="twitter:image" content="<?php if(!empty($optimizer['social_thumb_id']['url'])){$defthumb = $optimizer['social_thumb_id'];  echo $defthumb['url']; }?>">
<?php } ?>


<!--Summary-->
<?php if( is_singular('post') ) { ?>
<?php $content = $post->post_content; if( optimizer_has_shortcode( $content, 'gallery' ) ) {?><?php }else{ ?>
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php the_permalink(); ?>">
<meta name="twitter:title" content="<?php the_title_attribute(); ?>">
<meta name="twitter:description" content="<?php echo optimizer_seo_excerpt($post->ID, 200); ?>">
  <?php if ( has_post_thumbnail() ) : ?>
<meta name="twitter:image" content="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail', true); echo $thumb_url[0];?>">
  <?php elseif(!optimizer_first_image()): ?>
<meta name="twitter:image" content="<?php echo optimizer_first_image(); ?>">
  <?php else : ?>
<meta name="twitter:image" content="<?php if(!empty($optimizer['social_thumb_id']['url'])){$defthumb = $optimizer['social_thumb_id'];  echo $defthumb['url']; }?>">
  <?php endif; ?>
  <?php } ?>
<?php } ?>

<!--Photo-->
<?php if(is_attachment()) { ?>
<?php global $post; $twtphotoimage = wp_get_attachment_image_src( $post->ID, 'large' ); ?>
<meta name="twitter:card" content="photo">
<meta name="twitter:title" content="<?php the_title_attribute(); ?>">
<meta name="twitter:image" content="<?php echo $twtphotoimage[0];?>">
<meta name="twitter:image:width" content="<?php echo $twtphotoimage[1];?>">
<meta name="twitter:image:height" content="<?php echo $twtphotoimage[2];?>">
<?php } ?>

<?php if ( is_page() || is_single() ) {?>
<!--Gallery-->
<?php $content = $post->post_content; if( optimizer_has_shortcode( $content, 'gallery' ) ) {?>
<?php $gallerys = get_post_gallery_images(); if(count($gallerys) >3) { ?>
<meta name="twitter:card" content="gallery">
<meta name="twitter:title" content="<?php the_title_attribute(); ?>">
<meta name="twitter:description" content="<?php echo optimizer_seo_excerpt($post->ID, 200); ?>">
<meta name="twitter:image0:src" content="<?php echo $gallerys[0] ?>">
<meta name="twitter:image1:src" content="<?php echo $gallerys[1] ?>">
<meta name="twitter:image2:src" content="<?php echo $gallerys[2] ?>">
<meta name="twitter:image3:src" content="<?php echo $gallerys[3] ?>">
<?php } ?>
<?php } ?>
<?php } ?>

<!--Product-->
<?php if (class_exists('Woocommerce') && is_singular('product')) { ?>
<meta name="twitter:card" content="product">
<meta name="twitter:title" content="<?php the_title_attribute(); ?>">
<meta name="twitter:description" content="<?php echo optimizer_seo_excerpt($post->ID, 200); ?>">
<meta name="twitter:image" content="https://twitter.siglercompanies.com/graphics/00000001/mug-new.jpg">
<meta name="twitter:data1" content="$3">
<meta name="twitter:label1" content="Price">
<meta name="twitter:data2" content="Black">
<meta name="twitter:label2" content="Color">
<?php } ?>
