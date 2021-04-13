<?php 
/**
 * The Custom Style for LayerFramework
 *
 * Loads the dynamically generated Css in the header of the template.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
?><?php function optimizer_dynamic_css() { ?>
<?php global $optimizer; ?>
<style type="text/css">

/*Fixed Background*/
<?php if(!empty($optimizer['background_fixed'])){ echo 'html body.custom-background{ background-attachment:fixed; background-repeat:no-repeat; background-size:cover;}';} ?>

	/*BOXED LAYOUT*/
	.site_boxed .layer_wrapper, body.home.site_boxed #slidera {width: <?php echo $optimizer['center_width']; ?>%;float: left;margin: 0 <?php $centerwidth = $optimizer['center_width']; echo (100- $centerwidth)/2; ?>%;
	background-color: <?php echo $optimizer['content_bg_color']; ?>;}
	.site_boxed .stat_bg, .site_boxed .stat_bg_overlay, .site_boxed .stat_bg img, .site_boxed .is-sticky .header{width:<?php echo $optimizer['center_width']; ?>%;}
	.site_boxed .social_buttons{background-color: <?php echo $optimizer['content_bg_color']; ?>;}
	.site_boxed .center {width: 95%;margin: 0 auto;}
	.site_boxed .head_top .center{ width:95%;}
	/*Left Sidebar*/
	@media screen and (min-width: 960px){
	.header_sidebar.site_boxed #slidera, .header_sidebar.site_boxed .home_wrap.layer_wrapper, .header_sidebar.site_boxed .footer_wrap.layer_wrapper, .header_sidebar.site_boxed .page_wrap.layer_wrapper, .header_sidebar.site_boxed .post_wrap.layer_wrapper, .header_sidebar.site_boxed .page_blog_wrap.layer_wrapper, .header_sidebar.site_boxed .page_contact_wrap.layer_wrapper, .header_sidebar.site_boxed .page_fullwidth_wrap.layer_wrapper, .header_sidebar.site_boxed .category_wrap.layer_wrapper, .header_sidebar.site_boxed .search_wrap.layer_wrapper, .header_sidebar.site_boxed .fofo_wrap.layer_wrapper, .header_sidebar .site_boxed .author_wrap.layer_wrapper, .header_sidebar.site_boxed .head_top{width: calc(<?php echo $optimizer['center_width']; ?>% - 300px)!important;margin-left: calc(300px + <?php $centerwidth = $optimizer['center_width']; echo (100- $centerwidth)/2; ?>%)!important;}
	.header_sidebar.site_boxed .stat_bg_overlay, .header_sidebar.site_boxed .stat_bg{width: calc(<?php echo $optimizer['center_width']; ?>% - 300px)!important;left: 300px;}
	
	}


<?php if(!empty($optimizer['boxed_headfoot_full'])){ ?>
/*Keep Header and Footer Full width*/
.site_boxed .header_wrap.layer_wrapper, .site_boxed .footer_wrap.layer_wrapper{width: 100%!important; margin: 0 auto!important;}
.site_boxed .header_wrap.layer_wrapper .center, .site_boxed .footer_wrap.layer_wrapper .center, .site_boxed .page_wrap.layer_wrapper .page_head .pagetitle_wrap{ width: <?php echo $optimizer['center_width']; ?>%;}
<?php } ?>

/*Site Content Text Style*/
<?php $content_font = $optimizer['content_font_id']; ?>
body, input, textarea{ 
	<?php if(!empty($content_font['font-family'])){ ?>font-family:<?php echo $content_font['font-family']; ?>; <?php }else{?>font-family:'Open Sans';<?php } ?>
	<?php if(!empty($content_font['font-size'])){ ?>font-size:<?php echo $content_font['font-size']; ?>; <?php } ?>
	<?php if(!empty($content_font['font-weight'])){ ?>font-weight:<?php echo $content_font['font-weight']; ?>; <?php } ?>
}

.single_metainfo, .single_post .single_metainfo a, a:link, a:visited, .single_post_content .tabs li a{ color:<?php echo $optimizer['primtxt_color_id']; ?>;}
body .listing-item .lt_cats a{ color:<?php echo $optimizer['primtxt_color_id']; ?>;}

.sidr-class-header_s.sidr-class-head_search i:before {font-family: 'FontAwesome', <?php if(!empty($content_font['font-family'])){ ?><?php echo $content_font['font-family']; ?>; <?php }else{?>'Open Sans';<?php } ?>;}

/*LINK COLOR*/
.org_comment a, .thn_post_wrap a:not(.wp-block-button__link):link, .thn_post_wrap a:not(.wp-block-button__link):visited, .lts_lightbox_content a:link, .lts_lightbox_content a:visited, .athor_desc a:link, .athor_desc a:visited, .product_meta a:hover{color:<?php echo $optimizer['link_color_id']; ?>;}
.org_comment a:hover, .thn_post_wrap a:not(.wp-block-button__link):link:hover, .lts_lightbox_content a:link:hover, .lts_lightbox_content a:visited:hover, .athor_desc a:link:hover, .athor_desc a:visited:hover{color:<?php echo $optimizer['link_color_hover']; ?>;}


<?php if(get_background_color() == ''){?> .tabs li.active, .lts_tab, #frontsidebar, .fixed_wrap.fixindex.dummypost, #slidera{ background-color:#<?php echo get_background_color(); ?>;} <?php } ?>

<?php if ( is_single() || is_page() ) { ?>
/*-----------------------------Single Post Background------------------------------------*/
<?php global $wp_query; $postid = $wp_query->post->ID; $singlebg = get_post_meta($postid, 'single_bg', true); 
if(!empty($singlebg['background-image'])){ $bgimage = $singlebg['background-image']; }else{ $bgimage = ''; } 
if(!empty($singlebg['background-color'])){ $bgcolor = $singlebg['background-color'];  }else{ $bgcolor = ''; } 
if(!empty($singlebg['background-repeat'])){ $bgrepeat = $singlebg['background-repeat']; }else{ $bgrepeat = ''; } 
if(!empty($singlebg['background-attachment'])){ $bgattachment = $singlebg['background-attachment']; }else{ $bgattachment = ''; } 

if($singlebg){
	if($bgcolor || $bgimage) { ?>
		body.postid-<?php echo $postid; ?>, body.page-id-<?php echo $postid;?>{ 
			<?php if($bgcolor){ ?>background-color:<?php echo $bgcolor;?>!important;<?php } ?>
			<?php if($bgimage){ ?>background-image:url('<?php echo $bgimage;?>')!important; <?php } ?>
			<?php if($bgrepeat){ ?>background-repeat: <?php echo $bgrepeat;?> ;<?php } ?>
			<?php if($bgattachment){ ?>background-attachment: <?php echo $bgattachment;?> ;<?php } ?>
		}
	<?php } ?>
<?php } ?>
/*----------------------------------------------------*/		

<?php if(isset($optimizer['blog_layout_width']) && !empty($optimizer['blog_layout_width'])){ ?>body.single-post #content > .center { max-width: <?php echo $optimizer['blog_layout_width']; ?>; }'; <?php } ?>

<?php } ?>

<?php if(is_search() ) { ?> 
   .search_wrap .hentry .imgwrap, .lay4 .post_image{ display:none;}
   .lay4 .post_content { width: 100%; }
<?php } ?>


<?php if ( is_single() || is_page() || is_category() || is_tag() || is_author() || (get_post_type() == 'product' && is_archive()) ) { ?>
.page_head, .author_div, .single.single_style_header .single_post_header{ background-color:<?php echo $optimizer['page_header_color']; ?>; color:<?php echo $optimizer['page_header_txtcolor']; ?>;text-align:<?php echo $optimizer['page_header_align'];?>;}
.page_head .postitle{color:<?php echo $optimizer['page_header_txtcolor']; ?>;}	
.page_head .layerbread a, .page_head .woocommerce-breadcrumb{color:<?php echo $optimizer['page_header_txtcolor']; ?>;}	
.single_post_header, .single.single_style_header .single_post_content .postitle, .single_style_header .single_metainfo, .single_style_header .single_metainfo i, .single_style_header .single_metainfo a{color:<?php echo $optimizer['page_header_txtcolor']; ?>;}

<?php } ?>

<?php if ( is_page() ) { ?>
/*-----------------------------Page Header Colors------------------------------------*/
<?php global $wp_query; $postid = $wp_query->post->ID; 
$page_header_bg = get_post_meta( $postid, 'page_header_bg', true); 
$page_header_color = get_post_meta( $postid, 'page_header_txt', true);
$page_head_align = get_post_meta( $postid, 'page_head_align', true);
$hide_page_title = get_post_meta( $postid, 'hide_page_title', true);
	if($page_header_bg || $page_header_color) { ?>
		body.page-id-<?php echo $postid; ?> .page_head {
			<?php if($page_header_bg){ ?>background-color:<?php echo $page_header_bg;?>;<?php } ?>
			<?php if($page_header_color){ ?>color:<?php echo $page_header_color;?>;<?php } ?>
			<?php if($page_head_align){ ?>text-align:<?php echo $page_head_align;?>;<?php } ?>
			}
		<?php if(!empty($hide_page_title) ) {?>	
		body.page-id-<?php echo $postid; ?> .page_head .postitle, body.page-id-<?php echo $postid; ?> .page_head .layerbread{ display:none;}
		<?php } ?>
		body.page-id-<?php echo $postid; ?> .page_head .pagetitle_wrap, body.page-id-<?php echo $postid; ?> .page_head .pagetitle_wrap h1, body.page-id-<?php echo $postid; ?> .page_head .pagetitle_wrap a{
			<?php if($page_header_color){ ?>color:<?php echo $page_header_color;?>;<?php } ?>
			}
	<?php } ?>
/*----------------------------------------------------*/	
<?php } ?>

<?php if ( class_exists( 'WooCommerce' ) ) { //If Wooceommerce  ?>
	<?php if ( is_shop() ) { ?>
	/*-----------------------------Shop Page Header Colors------------------------------------*/
	<?php $postid = get_option( 'woocommerce_shop_page_id' );
	$page_header_bg = get_post_meta( $postid, 'page_header_bg', true); 
	$page_header_color = get_post_meta( $postid, 'page_header_txt', true);
	$page_head_align = get_post_meta( $postid, 'page_head_align', true);
	$hide_page_title = get_post_meta( $postid, 'hide_page_title', true);
		if($page_header_bg || $page_header_color) { ?>
			body.post-type-archive-product .page_head {
				<?php if($page_header_bg){ ?>background-color:<?php echo $page_header_bg;?>;<?php } ?>
				<?php if($page_header_color){ ?>color:<?php echo $page_header_color;?>;<?php } ?>
				<?php if($page_head_align){ ?>text-align:<?php echo $page_head_align;?>;<?php } ?>
				}
			<?php if(!empty($hide_page_title) ) {?>	
			body.post-type-archive-product .page_head .postitle, body.post-type-archive-product .page_head .layerbread{ display:none;}
			<?php } ?>
			body.post-type-archive-product .page_head .pagetitle_wrap, body.post-type-archive-product .page_head .pagetitle_wrap h1, body.post-type-archive-product .page_head .pagetitle_wrap a{
				<?php if($page_header_color){ ?>color:<?php echo $page_header_color;?>;<?php } ?>
				}
		<?php } ?>
	/*----------------------------------------------------*/	
	<?php } ?>
<?php } ?>

/*-----------------------------Static Slider Content box------------------------------------*/
<?php if($optimizer['slider_type_id'] =='noslider'){ ?>#slidera{min-height:initial;}<?php } ?>
.stat_content_inner .center{width:<?php echo $optimizer['static_textbox_width']; ?>%;}
.stat_content_inner{bottom:<?php echo $optimizer['static_textbox_bottom']; ?>%; color:<?php echo $optimizer['slider_txt_color']; ?>;}

/*SLIDER HEIGHT RESTRICT*/
<?php if(!empty($optimizer['slider_height'])){ ?>
.static_gallery.nivoSlider, #zn_nivo{ max-height: <?php echo str_replace('%', 'vh', $optimizer['slider_height']); ?>!important;}
#stat_img.stat_has_vid { max-height: <?php echo str_replace('%', 'vh', $optimizer['slider_height']); ?>!important; overflow: hidden;}
.stat_bg img, .stat_bg, .stat_bg_img, .stat_bg_overlay{ height: <?php echo str_replace('%', 'vh', $optimizer['slider_height']); ?>!important; }
<?php } ?>



<?php if($optimizer['slidefont_size_id']){ ?>
/*SLIDER FONT SIZE*/
#accordion h3 a, #zn_nivo h3 a{font-size:<?php echo $optimizer['slidefont_size_id']; ?>; line-height:1.3em}
<?php } ?>
/*STATIC SLIDE CTA BUTTONS COLORS*/
.static_cta1.cta_hollow, .static_cta1.cta_hollow_big, .static_cta1.cta_hollow_small, .static_cta1.cta_square_hollow, .static_cta1.cta_square_hollow_big, .static_cta1.cta_square_hollow_small{ background:transparent!important; color:<?php echo $optimizer['static_cta1_txt_color']; ?>;}
.static_cta1.cta_flat, .static_cta1.cta_flat_big, .static_cta1.cta_flat_small, .static_cta1.cta_rounded, .static_cta1.cta_rounded_big, .static_cta1.cta_rounded_small, .static_cta1.cta_hollow:hover, .static_cta1.cta_hollow_big:hover, .static_cta1.cta_hollow_small:hover, .static_cta1.cta_square, .static_cta1.cta_square_small, .static_cta1.cta_square_big, .static_cta1.cta_square_hollow:hover, .static_cta1.cta_square_hollow_small:hover, .static_cta1.cta_square_hollow_big:hover{ background:<?php echo $optimizer['static_cta1_bg_color']; ?>!important; color:<?php echo $optimizer['static_cta1_txt_color']; ?>; border-color:<?php echo $optimizer['static_cta1_bg_color']; ?>!important;}


.static_cta2.cta_hollow, .static_cta2.cta_hollow_big, .static_cta2.cta_hollow_small, .static_cta2.cta_square_hollow, .static_cta2.cta_square_hollow_big, .static_cta2.cta_square_hollow_small{ background:transparent!important; color:<?php echo $optimizer['static_cta2_txt_color']; ?>;}
.static_cta2.cta_flat, .static_cta2.cta_flat_big, .static_cta2.cta_flat_small, .static_cta2.cta_rounded, .static_cta2.cta_rounded_big, .static_cta2.cta_rounded_small, .static_cta2.cta_hollow:hover, .static_cta2.cta_hollow_big:hover, .static_cta2.cta_hollow_small:hover, .static_cta2.cta_square, .static_cta2.cta_square_small, .static_cta2.cta_square_big, .static_cta2.cta_square_hollow:hover, .static_cta2.cta_square_hollow_small:hover, .static_cta2.cta_square_hollow_big:hover{ background:<?php echo $optimizer['static_cta2_bg_color']; ?>!important; color:<?php echo $optimizer['static_cta2_txt_color']; ?>; border-color:<?php echo $optimizer['static_cta2_bg_color']; ?>!important;}

/*------------------------SLIDER HEIGHT----------------------*/
/*Slider Height*/
#accordion, #slide_acord, .accord_overlay{ height:<?php echo $optimizer['slide_height']; ?>;}
.kwicks li{ max-height:<?php echo $optimizer['slide_height']; ?>;min-height:<?php echo $optimizer['slide_height']; ?>;}



/*-----------------------------COLORS------------------------------------*/
		/*Header Color*/
		.header{ position:relative!important; background-color:<?php echo $optimizer['head_color_id']; ?>; 
		<?php if (!empty($optimizer['header_bgimage']['url']))  { ?>background-image:url('<?php echo $optimizer['header_bgimage']['url']; ?>');<?php } ?>
		}
		<?php if($optimizer['slider_type_id'] == 'noslider'){ ?>
		/*Header Color*/
		body .header{ position:relative!important; background-color:<?php echo $optimizer['head_color_id']; ?>;}
		.page #slidera, .single #slidera, .archive #slidera, .search #slidera, .error404 #slidera{ height:auto!important;}
		<?php } ?>

		<?php if(!empty($optimizer['head_transparent'])){ ?>
		.home.has_trans_header .header_wrap {float: left; position:relative;width: 100%;}
		.home.has_trans_header .header{position: absolute!important;z-index: 999;}
		
		.home.has_trans_header .header, .home.has_trans_header.page.page-template-page-frontpage_template .header{ background-color:transparent!important; background-image:none;}
		.home.has_trans_header .head_top{background-color: rgba(0, 0, 0, 0.3);}
		<?php } ?>
		
		.header_sidebar .head_inner{background-color:<?php echo $optimizer['head_color_id']; ?>; <?php if (!empty($optimizer['header_bgimage']['url']))  { ?>background-image:url('<?php echo $optimizer['header_bgimage']['url']; ?>');<?php } ?>}
		
		<?php if ($optimizer['head_color_id'] == '#ffffff' || $optimizer['head_color_id'] =='#FFFFFF'){ ?>
			<?php $background_color = get_background_color(); if($background_color == 'FFFFFF' || $background_color == 'ffffff' || $background_color == 'f7f7f7'){?>
				/*If Header and Background both set to White Display a Border under the Header*/
				body.single .header{box-shadow: 0 0 3px rgba(0, 0, 0, 0.25);}
			<?php } ?>
		<?php } ?>
		
		/*Boxed Header should have boxed width*/
		body.home.site_boxed .header_wrap.layer_wrapper{width: <?php echo $optimizer['center_width']; ?>%;float: left;margin: 0 <?php $centerwidth = $optimizer['center_width']; echo (100- $centerwidth)/2; ?>%;}

		.home.has_trans_header.page .header, .home.has_trans_header.page-template-page-frontpage_template .is-sticky .header{ background-color:<?php echo $optimizer['head_color_id']; ?>!important;}
		@media screen and (max-width: 480px){
		.home.has_trans_header .header{ background-color:<?php echo $optimizer['head_color_id']; ?>!important;}
		}
		
		<?php if(!empty($optimizer['head_sticky'])){ ?>
		/*Sticky Header*/
		.header{z-index: 9999;}
		body .is-sticky .header{position: fixed!important;box-shadow: 0 0 4px rgba(0, 0, 0, 0.2); z-index:999!important;}
		<?php } ?>
		
		.home .is-sticky .header, .page_header_transparent .is-sticky .header{ position:fixed!important; background-color:<?php echo $optimizer['head_color_id']; ?>!important;box-shadow: 0 0 4px rgba(0, 0, 0, 0.2)!important; transition-delay:0.3s; -webkit-transition-delay:0.3s; -moz-transition-delay:0.3s;}
		
		/*TOPBAR COLORS*/
		.head_top, #topbar_menu ul li a{ font-size:<?php echo $optimizer['topbar_font_size']; ?>;}
		.head_top, .page_header_transparent .is-sticky .head_top, #topbar_menu #optimizer_minicart {background-color:<?php echo $optimizer['topbar_bg_color']; ?>;}
		#topbar_menu #optimizer_minicart{color:<?php echo $optimizer['topbar_color_id']; ?>;}
		.page_header_transparent .head_top {  background: rgba(0, 0, 0, 0.3);}
		.head_search, .top_head_soc a, .tophone_on .head_phone, .tophone_on .head_phone span, .tophone_on .head_phone i, .tophone_on .head_phone a, .topsearch_on .head_phone a, .topsearch_on .head_search i, #topbar_menu ul li a, body.has_trans_header.home .is-sticky .head_top a, body.page_header_transparent .is-sticky .head_top a, body.has_trans_header.home .is-sticky #topbar_menu ul li a, body.page_header_transparent .is-sticky #topbar_menu ul li a, #topbar-hamburger-menu{color:<?php echo $optimizer['topbar_color_id']; ?>;}
		.head_top .social_bookmarks.bookmark_hexagon a:before {border-bottom-color: rgba(<?php echo optimizer_hex2rgb($optimizer['topbar_color_id']);?>, 0.3)!important;}
		.head_top .social_bookmarks.bookmark_hexagon a i {background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['topbar_color_id']);?>, 0.3)!important;}
		.head_top .social_bookmarks.bookmark_hexagon a:after { border-top-color:rgba(<?php echo optimizer_hex2rgb($optimizer['topbar_color_id']);?>, 0.3)!important;}
		
		/*LOGO*/
		<?php $logofont = $optimizer['logo_font_id']; ?>
		.logo h2, .logo h1, .logo h2 a, .logo h1 a{ 
			<?php if(!empty($logofont['font-family'])){ ?>font-family:'<?php echo $logofont['font-family']; ?>'; <?php } ?>
			<?php if(!empty($logofont['font-size'])){ ?>font-size:<?php echo $logofont['font-size']; ?>;<?php } ?>
			color:<?php echo $optimizer['logo_color_id']; ?>;
      }

      <?php if(!empty($optimizer['logo_max_width'])){ ?>.logo img { max-width: <?php echo $optimizer['logo_max_width']; ?>; }'; <?php } ?>
      
		span.desc{font-size: <?php echo $optimizer['tagline_font_size']; ?>;}
		body.has_trans_header.home .header .logo h2, body.has_trans_header.home .header .logo h1, body.has_trans_header.home .header .logo h2 a, body.has_trans_header.home .header .logo h1 a, body.has_trans_header.home span.desc, body.page_header_transparent .header .logo h2, body.page_header_transparent .header .logo h1, body.page_header_transparent .header .logo h2 a, body.page_header_transparent .header .logo h1 a, body.page_header_transparent span.desc, body.has_trans_header.home .head_top a{ color:<?php echo $optimizer['trans_header_color']; ?>;}
		body.has_trans_header .is-sticky .header .logo h2 a, body.has_trans_header .is-sticky .header .logo h1 a, body.page_header_transparent .is-sticky .header .logo h2 a, body.page_header_transparent .is-sticky .header .logo h1 a{color:<?php echo $optimizer['logo_color_id']; ?>;}
		#simple-menu, body.home.has_trans_header .is-sticky #simple-menu{color:<?php echo $optimizer['menutxt_color_id']; ?>;}
		body.home.has_trans_header #simple-menu{color:<?php echo $optimizer['trans_header_color']; ?>;}
		span.desc{color:<?php echo $optimizer['logo_color_id']; ?>;}
		body.has_trans_header.home .is-sticky span.desc, body.page_header_transparent .is-sticky span.desc{color:<?php echo $optimizer['logo_color_id']; ?>;}
		
		body.has_trans_header.home .is-sticky .header .logo h2 a, body.has_trans_header.home .is-sticky .header .logo h1 a, body.page_header_transparent .is-sticky .header .logo h2 a, body.page_header_transparent .is-sticky .header .logo h1 a{color:<?php echo $optimizer['logo_color_id']; ?>;}
				
		/*MENU Text Color*/
		#topmenu ul li a, .header_s.head_search i{color:<?php echo $optimizer['menutxt_color_id'] ?>;}
		body.has_trans_header.home #topmenu ul li a, body.page_header_transparent #topmenu ul li a, body.page_header_transparent .head_top a, body.has_trans_header.home #topbar_menu ul li a, body.page_header_transparent #topbar_menu ul li a, .home.has_trans_header .head_soc .social_bookmarks a, .page_header_transparent .head_soc .social_bookmarks a{ color:<?php echo $optimizer['trans_header_color']; ?>;}
		body.header_sidebar.home #topmenu ul li a, #topmenu #optimizer_minicart{color:<?php echo $optimizer['menutxt_color_id'] ?>;}
      
      #topmenu ul li ul:not(.mega-sub-menu){background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['submenu_bg_color']);?>, <?php echo ((int)$optimizer['submenu_bg_opacity'] / 100); ?>);}
      
		#topmenu ul li ul li a:hover{ background-color:<?php echo $optimizer['sec_color_id']; ?>; color:<?php echo $optimizer['sectxt_color_id']; ?>;}
		.head_soc .social_bookmarks a, .home.has_trans_header .is-sticky .head_soc .social_bookmarks a, .page_header_transparent .is-sticky .head_soc .social_bookmarks a{color:<?php echo $optimizer['menutxt_color_id'] ?>;}
		.head_soc .social_bookmarks.bookmark_hexagon a:before {border-bottom-color: rgba(<?php echo optimizer_hex2rgb($optimizer['menutxt_color_id']);?>, 0.3)!important;}
		.head_soc .social_bookmarks.bookmark_hexagon a i {background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['menutxt_color_id']);?>, 0.3)!important;}
		.head_soc .social_bookmarks.bookmark_hexagon a:after { border-top-color:rgba(<?php echo optimizer_hex2rgb($optimizer['menutxt_color_id']);?>, 0.3)!important;}
		body.has_trans_header.home .is-sticky #topmenu ul li a, body.page_header_transparent .is-sticky #topmenu ul li a{color:<?php echo $optimizer['menutxt_color_id'] ?>;}
      
      /*SUBMENU Text Color*/
      #topmenu ul li ul li a, body.has_trans_header.home #topbar_menu ul li ul li a, body.page_header_transparent #topbar_menu ul li ul li a, body.header_sidebar.home #topmenu ul li a{color:<?php echo $optimizer['submenu_text_color'] ?>;}

		/*Menu Highlight*/
		#topmenu li.menu_highlight_slim{ border-color:<?php echo $optimizer['menutxt_color_id'] ?>;}
		#topmenu li.menu_highlight_slim:hover{ background-color:<?php echo $optimizer['sec_color_id']; ?>;border-color:<?php echo $optimizer['sec_color_id']; ?>;}
		#topmenu li.menu_highlight_slim:hover>a{ color:<?php echo $optimizer['sectxt_color_id']; ?>!important;}
		#topmenu li.menu_highlight{ background-color:<?php echo $optimizer['sec_color_id']; ?>; border-color:<?php echo $optimizer['sec_color_id']; ?>;}
		#topmenu li.menu_highlight a, #topmenu li.menu_highlight_slim a{color:<?php echo $optimizer['sectxt_color_id']; ?>!important;}
		#topmenu li.menu_highlight:hover{border-color:<?php echo $optimizer['sec_color_id'] ?>; background-color:transparent;}
		#topmenu li.menu_highlight:hover>a{ color:<?php echo $optimizer['sec_color_id'] ?>!important;}
		
		#topmenu ul li.menu_hover a{border-color:<?php echo $optimizer['menutxt_color_hover']; ?>;}
		#topmenu ul.menu>li:hover:after{background-color:<?php echo $optimizer['menutxt_color_hover']; ?>;}
		#topmenu ul li.menu_hover>a, body.has_trans_header.home #topmenu ul li.menu_hover>a, #topmenu ul li.current-menu-item>a[href*="#"]:hover{color:<?php echo $optimizer['menutxt_color_hover'] ?>;}
		#topmenu ul li.current-menu-item>a, body.header_sidebar #topmenu ul li.current-menu-item>a, body.has_trans_header.header_sidebar .is-sticky #topmenu ul li.current-menu-item>a, body.page_header_transparent.header_sidebar .is-sticky #topmenu ul li.current-menu-item>a{color:<?php echo $optimizer['menutxt_color_active'] ?>;}
		#topmenu ul li.current-menu-item.onepagemenu_highlight>a, body.header_sidebar #topmenu ul li.menu_hover>a{color:<?php echo $optimizer['menutxt_color_hover'] ?>!important;}
		#topmenu ul li ul li.current-menu-item.onepagemenu_highlight a { color: #FFFFFF!important;}
		#topmenu ul li ul{border-color:<?php echo $optimizer['menutxt_color_hover']; ?> transparent transparent transparent;}

		.logo_center_left #topmenu, .logo_center #topmenu{background-color:<?php if(!empty( $optimizer['menubar_color_id'])) { echo $optimizer['menubar_color_id'];}else{ 'transparent'; }; ?>;}
		.left_header_content, .left_header_content a{color:<?php echo $optimizer['menutxt_color_id'] ?>;}


<?php if($optimizer['sec_color_id']){ ?>
		/*BASE Color*/
		.widget_border, .heading_border, #wp-calendar #today, .thn_post_wrap .more-link:hover, .moretag:hover, .search_term #searchsubmit, .error_msg #searchsubmit, #searchsubmit, .optimizer_pagenav a:hover, .nav-box a:hover .left_arro, .nav-box a:hover .right_arro, .pace .pace-progress, .homeposts_title .menu_border, span.widget_border, .ast_login_widget #loginform #wp-submit, .prog_wrap, .lts_layout1 a.image, .lts_layout2 a.image, .lts_layout3 a.image, .rel_tab:hover .related_img, .wpcf7-submit, .nivoinner .slide_button_wrap .lts_button, #accordion .slide_button_wrap .lts_button, .img_hover, p.form-submit #submit, .contact_form_wrap, .style2 .contact_form_wrap .contact_button, .style3 .contact_form_wrap .contact_button, .style4 .contact_form_wrap .contact_button, .optimizer_front_slider #opt_carousel .slidee li .acord_text .slide_button_wrap a, .hover_topborder .midrow_block:before, .acord_text p a{background-color:<?php echo $optimizer['sec_color_id'] ?>;} 
		
		.share_active, .comm_auth a, .logged-in-as a, .citeping a, .lay3 h2 a:hover, .lay4 h2 a:hover, .lay5 .postitle a:hover, .nivo-caption p a, .org_comment a, .org_ping a, .no_contact_map .contact_submit input, .contact_submit input:hover, .widget_calendar td a, .ast_biotxt a, .ast_bio .ast_biotxt h3, .lts_layout2 .listing-item h2 a:hover, .lts_layout3 .listing-item h2 a:hover, .lts_layout4 .listing-item h2 a:hover, .lts_layout5 .listing-item h2 a:hover, .rel_tab:hover .rel_hover, .post-password-form input[type~=submit], .bio_head h3, .blog_mo a:hover, .ast_navigation a:hover, .lts_layout4 .blog_mo a:hover{color:<?php echo $optimizer['sec_color_id'] ?>;}
		#home_widgets .widget .thn_wgt_tt, #sidebar .widget .thn_wgt_tt, #footer .widget .thn_wgt_tt, .astwt_iframe a, .ast_bio .ast_biotxt h3, .ast_bio .ast_biotxt a, .nav-box a span{color:<?php echo $optimizer['sec_color_id'] ?>;}
		.pace .pace-activity{border-top-color: <?php echo $optimizer['sec_color_id']; ?>!important;border-left-color: <?php echo $optimizer['sec_color_id']; ?>!important;}
		.pace .pace-progress-inner{box-shadow: 0 0 10px <?php echo $optimizer['sec_color_id'] ?>, 0 0 5px <?php echo $optimizer['sec_color_id']; ?>;
		  -webkit-box-shadow: 0 0 10px <?php echo $optimizer['sec_color_id'] ?>, 0 0 5px <?php echo $optimizer['sec_color_id']; ?>;
		  -moz-box-shadow: 0 0 10px <?php echo $optimizer['sec_color_id'] ?>, 0 0 5px <?php echo $optimizer['sec_color_id']; ?>;}
		
		.fotorama__thumb-border, .ast_navigation a:hover{ border-color:<?php echo $optimizer['sec_color_id'] ?>!important;}
		
		.hover_colorbg .midrow_block:before{ background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['sec_color_id']);?>, 0.3);}
		
		/*Text Color on BASE COLOR Element*/
		.icon_round a, #wp-calendar #today, .moretag:hover, .search_term #searchsubmit, .error_msg #searchsubmit, .optimizer_pagenav a:hover, .ast_login_widget #loginform #wp-submit, #searchsubmit, .prog_wrap, .rel_tab .related_img i, .lay1 h2.postitle a, .nivoinner .slide_button_wrap .lts_button, #accordion .slide_button_wrap .lts_button, .lts_layout1 .icon_wrap a, .lts_layout2 .icon_wrap a, .lts_layout3 .icon_wrap a, .lts_layout1 .icon_wrap a:hover, .lts_layout2 .icon_wrap a:hover, .lts_layout3 .icon_wrap a:hover, .optimizer_front_slider #opt_carousel .slidee li .acord_text .slide_button_wrap a{color:<?php echo $optimizer['sectxt_color_id']; ?>!important;}
		.thn_post_wrap .listing-item .moretag:hover, body .lts_layout1 .listing-item .title, .lts_layout2 .img_wrap .optimizer_plus, .img_hover .icon_wrap a, #footer .widgets .widget .img_hover .icon_wrap a, body .thn_post_wrap .lts_layout1 .icon_wrap a, .wpcf7-submit, p.form-submit #submit, .optimposts .type-product span.onsale, .style2 .contact_form_wrap .contact_button, .style3 .contact_form_wrap .contact_button, .style4 .contact_form_wrap .contact_button, .lay3.portfolio_wrap .post_content .catag_list, .lay3.portfolio_wrap .post_content .catag_list a, .lay3.portfolio_wrap h2 a{color:<?php echo $optimizer['sectxt_color_id']; ?>!important;}
		.hover_colorbg .midrow_block:before, .hover_colorbg .midrow_block:hover .block_content, .hover_colorbg .midrow_block:hover h2, .hover_colorbg .midrow_block:hover h3, .hover_colorbg .midrow_block:hover h4, .hover_colorbg .midrow_block:hover a, .contact_form_wrap .contact_button, .contact_buttn_spinner, .acord_text p a{color:<?php echo $optimizer['sectxt_color_id']; ?>!important;}		
		



<?php } ?>

/*Sidebar Widget Background Color */
#sidebar .widget{ background-color:<?php echo $optimizer['sidebar_color_id']; ?>;}
/*Widget Title Color */
#sidebar .widget .widgettitle, #sidebar .widget .widgettitle a{color:<?php echo $optimizer['sidebar_tt_color_id'] ?>;}
#sidebar .widget li a, #sidebar .widget, #sidebar .widget .widget_wrap{ color:<?php echo $optimizer['sidebartxt_color_id'] ?>;}
#sidebar .widget .widgettitle, #sidebar .widget .widgettitle a, #sidebar .home_title{font-size:<?php echo $optimizer['wgttitle_size_id']; ?>;}

<?php if($optimizer['footer_title_color']){ ?>
#footer .widgets .widgettitle, #copyright a{color:<?php echo $optimizer['footer_title_color']; ?>;}
<?php } ?>

<?php if($optimizer['footer_color_id']){ ?>
/*FOOTER WIDGET COLORS*/
#footer{background-color: <?php echo $optimizer['footer_color_id']; ?>; <?php if (!empty($optimizer['footer_bg_img']['url']))  { ?>background-image:url('<?php  echo $optimizer['footer_bg_img']['url']; ?>');<?php } ?>}
#footer .widgets .widget a, #footer .widgets{color:<?php echo $optimizer['footwdgtxt_color_id']; ?>;}
#footer .widgets .ast_scoial.social_style_round_text a span{color:<?php echo $optimizer['footwdgtxt_color_id']; ?>;}
<?php } ?>
/*COPYRIGHT COLORS*/
#copyright{background-color: <?php echo $optimizer['copyright_bg_color']; ?>; <?php if (!empty($optimizer['copyright_bg_img']['url']))  { ?>background-image:url('<?php  echo $optimizer['copyright_bg_img']['url']; ?>');<?php } ?> background-size: cover;}
#copyright a, #copyright{color: <?php echo $optimizer['copyright_txt_color']; ?>;}
.foot_soc .social_bookmarks a{color:<?php echo $optimizer['copyright_txt_color'] ?>}
.foot_soc .social_bookmarks.bookmark_hexagon a:before {border-bottom-color: rgba(<?php echo optimizer_hex2rgb($optimizer['copyright_txt_color']);?>, 0.3);}
.foot_soc .social_bookmarks.bookmark_hexagon a i {background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['copyright_txt_color']);?>, 0.3);}
.foot_soc .social_bookmarks.bookmark_hexagon a:after { border-top-color:rgba(<?php echo optimizer_hex2rgb($optimizer['copyright_txt_color']);?>, 0.3);}



/*-------------------------------------TYPOGRAPHY--------------------------------------*/


/*Post Titles, headings and Menu Font*/
h1, h2, h3, h4, h5, h6, #topmenu ul li a, .postitle, .product_title{ 
   <?php if(!empty($optimizer['ptitle_font_id']['font-family'])){ ?>font-family:<?php echo $optimizer['ptitle_font_id']['font-family']; ?>; <?php } ?> 
   <?php if(!empty($optimizer['ptitle_font_id']['font-weight'])){ ?>font-weight:<?php echo $optimizer['ptitle_font_id']['font-weight']; ?>; <?php } ?>
}

<?php if((!empty($optimizer['txt_upcase_id']))){ ?>
#topmenu ul li a, .midrow_block h3, .lay1 h2.postitle, .more-link, .moretag, .single_post .postitle, .related_h3, .comments_template #comments, #comments_ping, #reply-title, #submit, #sidebar .widget .widgettitle, #sidebar .widget .widgettitle a, .search_term h2, .search_term #searchsubmit, .error_msg #searchsubmit, #footer .widgets .widgettitle, .home_title, body .lts_layout1 .listing-item .title, .lay4 h2.postitle, .lay2 h2.postitle a, #home_widgets .widget .widgettitle, .product_title, .page_head h1{ text-transform:uppercase;}
<?php } ?>

#topmenu ul li a{font-size:<?php echo $optimizer['menu_size_id']; ?>;}
#topmenu ul li {line-height: <?php echo $optimizer['menu_size_id']; ?>;}

.single .single_post_content .postitle, .single-product h1.product_title, .single-product h2.product_title{font-size:<?php echo $optimizer['ptitle_size_id']; ?>;}

.page .page_head .postitle, .page .single_post .postitle, .archive .single_post .postitle{font-size:<?php echo $optimizer['pgtitle_size_id']; ?>;}



<?php if($optimizer['primtxt_color_id']){ ?>
/*Body Text Color*/
body, .home_cat a, .comment-form-comment textarea, .single_post_content .tabs li a, .thn_post_wrap .listing-item .moretag{ color:<?php echo $optimizer['primtxt_color_id']; ?>;}
<?php } ?>	
	

<?php if($optimizer['title_txt_color_id']){ ?>
/*Post Title */
.postitle, .postitle a, .nav-box a, h3#comments, h3#comments_ping, .comment-reply-title, .related_h3, .nocomments, .lts_layout2 .listing-item h2 a, .lts_layout3 .listing-item h2 a, .lts_layout4 .listing-item h2 a, .lts_layout5 .listing-item h2 a, .author_inner h5, .product_title, .woocommerce-tabs h2, .related.products h2, .lts_layout4 .blog_mo a, .optimposts .type-product h2.postitle a, .woocommerce ul.products li.product h3, .portfolio_wrap .hover_style_5 h2 a, .portfolio_wrap .hover_style_5 .post_content .catag_list a, .portfolio_wrap .hover_style_5 .post_content .catag_list{ text-decoration:none; color:<?php echo $optimizer['title_txt_color_id'] ?>;}
<?php } ?>

/*Headings Color in Post*/
.thn_post_wrap h1, .thn_post_wrap h2, .thn_post_wrap h3, .thn_post_wrap h4, .thn_post_wrap h5, .thn_post_wrap h6{color:<?php echo $optimizer['heading_color_id'] ?>;}



<?php if ( class_exists( 'WooCommerce' )){ ?>
	/*/*Woocommerce Colors---------------------*/
	/*Primary Color*/
	.woocommerce .woocommerce-error,.woocommerce .woocommerce-info,.woocommerce .woocommerce-message{border-top:3px solid <?php echo $optimizer['woo_prim_color']; ?>;}
	.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt:disabled[disabled],.woocommerce #respond input#submit.alt:disabled[disabled]:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt:disabled[disabled],.woocommerce a.button.alt:disabled[disabled]:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt:disabled[disabled],.woocommerce button.button.alt:disabled[disabled]:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt:disabled[disabled],.woocommerce input.button.alt:disabled[disabled]:hover, .woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_shopping_cart_content a.button.checkout.wc-forward{background-color:<?php echo $optimizer['woo_prim_color']; ?>;color:#fff!important;}
	
	
	#optimizer_minicart .button.checkout.wc-forward, .woocommerce-page.shop_bttn_rounded_hollow #optimizer_minicart .button.checkout.wc-forward, .woocommerce-page.shop_bttn_circular_hollow #optimizer_minicart .button.checkout.wc-forward, .woocommerce-page.shop_bttn_square_hollow #optimizer_minicart .button.checkout.wc-forward{background-color:<?php echo $optimizer['woo_prim_color']; ?>!important; border:none!important;}
	
	/*Primary Hover Color (Darker variant of Primary Color)*/
	.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{background-color:<?php $primhover = optimizer_hex2rgb($optimizer['woo_prim_color']); $rgb = explode(",", $primhover);  $primhover = optimizer_rgb2hsl($rgb[0], $rgb[1], $rgb[2]); echo 'hsla('.$primhover[0].', '.($primhover[1] *100).'%, '.(($primhover[2] *100) -10).'%, 1)'; ?>!important;}
	
.woocommerce-page.shop_bttn_rounded_hollow #respond input#submit, .woocommerce-page.shop_bttn_rounded_hollow a.button, .woocommerce-page.shop_bttn_rounded_hollow button.button, .woocommerce-page.shop_bttn_rounded_hollow input.button, .woocommerce-page.shop_bttn_rounded_hollow .widget_product_search input[type="submit"], .woocommerce-page.shop_bttn_rounded_hollow .optimposts .type-product a.button.add_to_cart_button, .woocommerce-page.archive.shop_bttn_rounded_hollow ul.products li.product .button, 
.woocommerce-page.shop_bttn_square_hollow #respond input#submit, .woocommerce-page.shop_bttn_square_hollow a.button, .woocommerce-page.shop_bttn_square_hollow button.button, .woocommerce-page.shop_bttn_square_hollow input.button, .woocommerce-page.shop_bttn_square_hollow .widget_product_input[type="submit"], .woocommerce-page.shop_bttn_square_hollow .optimposts .type-product a.button.add_to_cart_button, .woocommerce-page.archive.shop_bttn_square_hollow ul.products li.product .button, 
.woocommerce-page.shop_bttn_circular_hollow #respond input#submit, .woocommerce-page.shop_bttn_circular_hollow a.button, .woocommerce-page.shop_bttn_circular_hollow button.button, .woocommerce-page.shop_bttn_circular_hollow input.button, .woocommerce-page.shop_bttn_circular_hollow .widget_product_search input[type="submit"], .woocommerce-page.shop_bttn_circular_hollow .optimposts .type-product a.button.add_to_cart_button, .woocommerce-page.archive.shop_bttn_circular_hollow ul.products li.product .button{color:<?php echo $optimizer['woo_prim_color'];?>!important;}


.woocommerce-page.shop_bttn_rounded_hollow #respond input#submit:hover, .woocommerce-page.shop_bttn_rounded_hollow a.button:hover, .woocommerce-page.shop_bttn_rounded_hollow button.button:hover, .woocommerce-page.shop_bttn_rounded_hollow input.button:hover, .woocommerce-page.shop_bttn_rounded_hollow button.button.alt:hover, .woocommerce-page.shop_bttn_square_hollow #respond input#submit:hover, .woocommerce-page.shop_bttn_square_hollow a.button:hover, .woocommerce-page.shop_bttn_square_hollow button.button:hover, .woocommerce-page.shop_bttn_square_hollow input.button:hover, .woocommerce-page.shop_bttn_square_hollow button.button.alt:hover, .woocommerce-page.shop_bttn_circular_hollow #respond input#submit:hover, .woocommerce-page.shop_bttn_circular_hollow a.button:hover, .woocommerce-page.shop_bttn_circular_hollow button.button:hover, .woocommerce-page.shop_bttn_circular_hollow input.button:hover, .woocommerce-page.shop_bttn_circular_hollow button.button.alt:hover, .woocommerce-page.shop_bttn_rounded_hollow .widget_product_search input[type="submit"]:hover, .woocommerce-page.shop_bttn_square_hollow .widget_product_search input[type="submit"]:hover, .woocommerce-page.shop_bttn_circular_hollow .widget_product_search input[type="submit"]:hover, .optimposts .type-product a.button.add_to_cart_button:hover{background-color:<?php echo $optimizer['woo_prim_color']; ?>!important;color:#fff!important; border-color:<?php echo $optimizer['woo_prim_color']; ?>!important;}

	.optimposts .lay4_wrap .type-product a.button.add_to_cart_button:hover, .optimposts .lay5_wrap .type-product a.button.add_to_cart_button:hover, .archive.shop_bttn_circular_hollow ul.products li.product .button:hover, .archive.shop_bttn_rounded_hollow ul.products li.product .button:hover:hover, .archive.shop_bttn_square_hollow ul.products li.product .button:hover, .optimposts .type-product a.button.add_to_cart_button:hover, .archive.woocommerce-page ul.products li.product a.button.add_to_cart_button:hover, .has_woo_shortcode ul.products li.product a.button.add_to_cart_button:hover{background-color:<?php echo $optimizer['woo_prim_color']; ?>!important;color:#fff!important; border-color:<?php echo $optimizer['woo_prim_color']; ?>;}
	.optimposts .lay2_wrap .type-product a.button.add_to_cart_button:hover:before, .optimposts .lay3_wrap .type-product a.button.add_to_cart_button:hover:before, .optimposts .lay4_wrap .type-product h2.postitle a{color:<?php echo $optimizer['woo_prim_color'] ?>;}
	/* .optimposts .type-product a.button.add_to_cart_button{ color:initial;} */
	.shop_bttn_rounded_hollow .optimposts.lay1 .type-product a.button.add_to_cart_button:hover, .shop_bttn_square_hollow .optimposts.lay1 .type-product a.button.add_to_cart_button:hover, .shop_bttn_circular_hollow .optimposts.lay1 .type-product a.button.add_to_cart_button:hover{background-color:<?php echo $optimizer['woo_prim_color']; ?>;color:#fff; border-color:<?php echo $optimizer['woo_prim_color']; ?>;}
	
	.lay2 h2.postitle:hover a, .optimposts .type-product h2.postitle a:hover, .archive.woocommerce-page.woo_archive_layout2 ul.products li.product h3:hover{color:<?php echo $optimizer['woo_prim_color']; ?>;}
	
	/*Price Tag Color*/
	.woocommerce div.product p.price,.woocommerce div.product span.price, .woocommerce div.product .stock, .woocommerce ul.products li.product .price, .woocommerce-cart .cart-collaterals .cart_totals .discount td, .optimposts .lay2_wrap .type-product span.price, .optimposts .lay3_wrap .type-product span.price, .optimposts .lay4_wrap  .type-product span.price{color:<?php echo $optimizer['woo_sec_color']; ?>;}
	.optimposts .lay2_wrap .type-product a.button.add_to_cart_button:before, .optimposts .lay3_wrap .type-product a.button.add_to_cart_button:before{color:<?php echo $optimizer['woo_sec_color'] ?>;}
   

   /*Archive Product Title Color*/
   .woocommerce ul.products li.product .woocommerce-loop-product__title{color:<?php echo $optimizer['woo_title_color'] ?>;}
   .woocommerce ul.products li.product .add_to_cart_button {background:<?php echo $optimizer['woo_button_color'] ?>!important;}
	
	/*Sale Color*/
	.woocommerce span.onsale, .optimposts .type-product span.onsale, .woo-slider #post_slider li.sale .woo_sale{color:#fff!important;background-color:<?php echo $optimizer['woo_sale_color']; ?>!important;}
	#optimizer_minicart_wrap a.button.wc-forward{background-color:<?php echo $optimizer['woo_sale_color']; ?>!important; border:none!important;}
	
	/*Other Colors*/
	<?php $othercolor = optimizer_hex2rgb($optimizer['primtxt_color_id']); $rgb = explode(",", $othercolor);  $othercolor = optimizer_rgb2hsl($rgb[0], $rgb[1], $rgb[2]); ?>
	.woocommerce ul.product_list_widget li a:nth-child(1) .product-title, #sidebar .widget_recent_reviews ul.product_list_widget li a:nth-child(1){color:<?php echo $optimizer['sidebar_tt_color_id'] ?>;}
	.woocommerce .cart_totals .order-total, #order_review tfoot, .woocommerce.single .product .woocommerce-tabs ul.tabs li.active a{ color:<?php echo 'hsla('.$othercolor[0].', '.($othercolor[1] *100).'%, '.(($othercolor[2] *100) -20).'%, 1)'; ?>;}
	.woocommerce.single.woo_single_layout1 .product .woocommerce-tabs ul.tabs li.active{border-top-color:<?php echo 'hsla('.$othercolor[0].', '.($othercolor[1] *100).'%, '.(($othercolor[2] *100) -20).'%, 1)'; ?>;}
	
	<?php if(!get_background_color() == ''){?> .woocommerce.single.woo_single_layout2 .product .woocommerce-tabs ul.tabs li.active{ background-color:#<?php echo get_background_color(); ?>;} <?php } ?>
	/*WishList Colors*/
	.woocommerce .add_to_wishlist.single_add_to_wishlist.button, .woocommerce .add_to_wishlist.single_add_to_wishlist.button:hover, .woocommerce div.product p.price del, .woocommerce div.product span.price del{color: <?php echo $optimizer['primtxt_color_id']; ?>;}
	.yith-wcwl-wishlistexistsbrowse a, .archive.woocommerce-page ul.products li.product h3:hover{color:<?php echo $optimizer['woo_prim_color']; ?>;}

	#topmenu #optimizer_minicart{background-color:<?php $primhover = optimizer_hex2rgb($optimizer['head_color_id']); $rgb = explode(",", $primhover);  $primhover = optimizer_rgb2hsl($rgb[0], $rgb[1], $rgb[2]); echo 'hsla('.$primhover[0].', '.($primhover[1] *100).'%, '.(($primhover[2] *100) +10).'%, 1)'; ?>!important;}

<?php } //Wooocommer END?>


<?php if(!empty($optimizer['lay_show_title']) ) { ?>
.lay1 .post_content h2{ background-color:rgba(<?php echo optimizer_hex2rgb($optimizer['sec_color_id']);?>, 0.7)!important;bottom: 0;position: absolute;width: 100%;box-sizing: border-box;}
.lay1 h2.postitle a{font-size: 0.7em!important;}
.lay1 .post_content{ top:auto!important; bottom:0;}
.img_hover .icon_wrap{bottom: 50%;}
.lay1 .lay1_tt_on .post_image.lowreadmo .icon_wrap {top: 40px;}
<?php } ?>

<?php if(!$optimizer['show_blog_thumb'] ) { ?>
.page-template-template_partspage-blog_template-php .lay4 .post_content{width:100%;}
<?php } ?>

<?php if(!empty($optimizer['show_blog_thumb']) &&  $optimizer['blog_layout_id'] == '2' ) { ?>
.page-template-page-blog_template .imgwrap {max-height: 250px;overflow: hidden;}
<?php } ?>

<?php if($optimizer['head_menu_type'] =='7'){ ?>
#topmenu{ display:none;}
#simple-menu{ display:block;}
<?php } ?>


.lay4 .ast_navigation .alignleft i:after, .lay5 .ast_navigation .alignleft i:after {content: "<?php _e('Previous Posts', 'optimizer'); ?>";}
.lay4 .ast_navigation .alignright i:after, .lay5 .ast_navigation .alignright i:after {content: "<?php _e('Next Posts', 'optimizer'); ?>";}
<?php $content_font = $optimizer['content_font_id']; if(isset($content_font['font-family'])) {?>
.lay4 .ast_navigation .alignleft i:after, .lay5 .ast_navigation .alignleft i:after , .lay4 .ast_navigation .alignright i:after, .lay5 .ast_navigation .alignright i:after{ font-family:<?php echo $content_font['font-family'];?>;}
<?php } ?>

.sidr{ background-color:<?php echo $optimizer['hamburger_bg']; ?>}


@media screen and (max-width: 480px){
body.home.has_trans_header .header .logo h1 a, body.home.has_trans_header .header .desc{ color:<?php echo $optimizer['logo_color_id']; ?>!important;}
body.home.has_trans_header .header #simple-menu, body.has_trans_header.home #topmenu ul li a{color:<?php echo $optimizer['menutxt_color_id']; ?>!important;}
}

<?php $statimg = $optimizer['static_image_id'];
if(!empty($statimg['url']) && (!empty($optimizer['static_video_id']['url']) || !empty($optimizer['slide_ytbid']))){ ?>
	@media screen and (max-width: 1024px){
		.is-ios #stat_img.stat_has_img.stat_has_vid { background: url("<?php echo $statimg['url']; ?>") 50% 0% / cover no-repeat!important;}
	}
<?php } ?>


<?php if(!empty($optimizer['logo_image_id']['url'])){   ?>
<?php $logoimgid = optimizer_attachment_id_by_url($optimizer['logo_image_id']['url']);  $imgaltraw = wp_prepare_attachment_for_js($logoimgid);  $logowidth = $imgaltraw['width']; ?>
@media screen and (max-width: 1024px) and (min-width: 481px){.logobefore, .logoafter{width: calc(50% - <?php echo $logowidth + 20; ?>px);} }
<?php } ?>


/*CUSTOM FONT---------------------------------------------------------*/
<?php if( $optimizer['custom_font_ttf'] && $optimizer['custom_font_eot'] && $optimizer['custom_font_woff'] ){ ?>
<?php
	$fonturl = $optimizer['custom_font_ttf'];    
	$fontname = substr($fonturl, strrpos($fonturl, "/") + 1);  
	$fontname = str_replace('.ttf','', $fontname);
	?>

@font-face {
	font-family: '<?php echo $fontname; ?>';
	src: url('<?php echo $optimizer['custom_font_eot']; ?>');
	src: url('<?php echo $optimizer['custom_font_eot']; ?>?#iefix') format('embedded-opentype'),
		url('<?php echo $optimizer['custom_font_woff']; ?>') format('woff'),
		url('<?php echo $optimizer['custom_font_ttf']; ?>')  format('truetype');
	font-style: normal;
}
<?php } ?>
/*CUSTOM CSS*/
<?php if ( ! empty ( $optimizer['custom-css'] ) ) { ?><?php echo stripslashes(htmlspecialchars_decode($optimizer['custom-css'])); ?><?php } ?>
</style>

<!--[if IE 9]>
<style type="text/css">
.text_block_wrap, .postsblck .center, .home_testi .center, #footer .widgets, .clients_logo img{opacity:1!important;}
#topmenu ul li.megamenu{ position:static!important;}
</style>
<![endif]-->
<!--[if IE]>
#searchsubmit{padding-top:12px;}
<![endif]-->
<?php } ?>
<?php add_action( 'wp_head', 'optimizer_dynamic_css'); ?>