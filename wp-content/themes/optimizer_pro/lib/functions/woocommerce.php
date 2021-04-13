<?php
 /**
 * The WOOCOMMERCE functions for OPTIMIZER
 *
 * Stores all the Woocommerce functions of the template.
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
  if (!class_exists( 'WooCommerce' )){
	return;
 }
 
 $optimizer = optimizer_option_defaults();
 
 
 /**
 * Enque Optimizer Woocommerce Style
 */
function optimizer_woo_assets() { 
	if ( !is_admin() ) {
		if ( class_exists( 'WooCommerce' )){
			wp_enqueue_style( 'woo-style', get_template_directory_uri().'/assets/css/woo.css');
		}
	}
}
	
add_action('wp_enqueue_scripts', 'optimizer_woo_assets');
 


 /**
 * WOOCOMMERCE SHOP PAGE
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);	
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'optimizer_woo_wrapper_start', 10);
function optimizer_woo_wrapper_start() { ?>
<?php $optimizer = optimizer_option_defaults(); ?>
    <div class="page_wrap layer_wrapper">
    	<?php if(is_shop() || ( !empty($optimizer['woo_cat_header']) && (is_product_category() || is_product_tag()) )) { ?>
        <!--CUSTOM PAGE HEADER STARTS-->
        	<?php $shoppageid = get_option( 'woocommerce_shop_page_id' ); $show_pgheader = get_post_meta( $shoppageid, 'show_page_header', true); if (empty($show_pgheader)){ ?>
            	<?php get_template_part('framework/core','pageheader'); ?>
            <?php } ?>
        <!--CUSTOM PAGE HEADER ENDS-->
        <?php } ?>
        
        
				<?php 
				//NO SIDEBAR LOGIC
				$nosidebar ='has_sidebar';
				$shopsidebar = $optimizer['shop_sidebar_id'];
				$hidesidebar = get_post_meta(get_the_ID(), 'hide_sidebar', true);
				$sidebar = get_post_meta(get_the_ID(), 'sidebar', true);
				
				$shoppageid = get_option( 'woocommerce_shop_page_id' );
				if(is_archive()){
					$hidesidebar = get_post_meta($shoppageid, 'hide_sidebar', true);
					$sidebar = get_post_meta($shoppageid, 'sidebar', true);
				}
				

				
                if (!empty( $hidesidebar )){
                        $nosidebar = 'no_sidebar';
                }else{
						if(empty( $shopsidebar ) && !is_active_sidebar( $shopsidebar )){
							$nosidebar = 'no_sidebar'; 
                        }elseif(!empty( $sidebar ) && is_active_sidebar( $sidebar )){
                            $nosidebar = 'has_sidebar'; 
						}elseif(empty( $sidebar ) && is_active_sidebar( $sidebar )){
							$nosidebar = 'no_sidebar'; 
                        }elseif($shopsidebar == 'sidebar' && !is_active_sidebar( 'sidebar' ) ){ 
                            $nosidebar = 'no_sidebar'; 
                 		}elseif($shopsidebar !== 'sidebar' && is_active_sidebar( 'sidebar' ) ){ 
                            $nosidebar = 'has_sidebar'; 
                 		}    
                } ?>
                <?php $page_template = get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_wp_page_template', true ); if($page_template =='template_parts/page-leftsidebar_template.php'){ $sidebar_pos = 'left_sidebar';}else{ $sidebar_pos = ''; }?>
        <div id="content">
            <div class="center">
                <div class="single_wrap <?php echo $nosidebar; ?> <?php echo $sidebar_pos; ?>">
                    
                    <div class="single_post">

<?php }




add_action('woocommerce_after_main_content', 'optimizer_woo_wrapper_end', 10);
function optimizer_woo_wrapper_end() {?>
  </div></div> <?php get_sidebar(); ?> </div></div></div>
<?php }


/*Remove Breadcrumbs from SHOP page*/
add_action( 'wp_head', 'optimizer_remove_wc_breadcrumbs' );
function optimizer_remove_wc_breadcrumbs() {
	$optimizer = optimizer_option_defaults(); 
	if(is_shop() || ( !empty($optimizer['woo_cat_header']) && (is_product_category() || is_product_tag()) )) { 
    	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}
 
/**
 * Place a cart icon with number of items and total cost in the menu bar.
 */
 
 function optimizer_minicart($output = false) {
    if(!$output) ob_start();
    //$template_file = get_template_part('/lib/functions/mini','cart');
    include(get_template_directory(). '/lib/functions/mini-cart.php');
    if(!$output) return ob_get_clean();
}

add_filter('wp_nav_menu_items','optimizer_wcmenucart', 10, 2);
function optimizer_wcmenucart($menu, $args) {
	global $optimizer;
	$cart_pos = $optimizer['woo_cart_pos'];
	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || $cart_pos !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		global $optimizer;
		$cart_pos = $optimizer['site_layout_id'];
		$viewing_cart = __('View your shopping cart', 'optimizer');
		$start_shopping = __('Start shopping', 'optimizer');
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		if($cart_contents_count > 1){
			$cart_contents = $cart_contents_count. __(' items', 'optimizer');
		}else{
			$cart_contents = $cart_contents_count. __(' item', 'optimizer');
		}
		$cart_total = $woocommerce->cart->get_cart_total();
		
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="woocom_cart_icon menu-item '.$cart_pos.'"><i class="fa-shopping-cart"></i> <a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="woocom_cart_icon menu-item"><i class="fa-shopping-cart"></i> <a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}
			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
			$menu_item .= '<li id="optimizer_minicart_wrap">'.optimizer_minicart().'</li>';
			

		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}
//Update cart count on Ajax "Add to cart" click
add_filter( 'woocommerce_add_to_cart_fragments', 'optimizer_wcmenucart_update' );
function optimizer_wcmenucart_update( $fragments ) {
	ob_start();
	?>
   <a class="wcmenucart-contents" href="<?php echo function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'optimizer'); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'optimizer'), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.wcmenucart-contents'] = ob_get_clean();
	if ( WC()->cart->get_cart_contents_count() == 0 ) {
			echo '<li id="optimizer_minicart_wrap"><div id="optimizer_minicart"><span>'.__('No Item found on your cart.', 'optimizer').'</span></div></li>';
		}else{
			echo '<li id="optimizer_minicart_wrap">';
			optimizer_minicart(true);
			echo '</li>';
		}
   $fragments['li#optimizer_minicart_wrap'] = ob_get_clean(); 

	return $fragments;
}


function optimizer_shop_page_title() { 
return false; 
} 
add_filter('woocommerce_show_page_title', 'optimizer_shop_page_title');

function optimizer_is_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}

function optimizer_woo_price_sale() {
	echo woocommerce_show_product_loop_sale_flash(); 
	
}
add_action( 'optimizer_inside_front_post_thumb', 'optimizer_woo_price_sale' );

function optimizer_woo_content() {
	//do_action( 'woocommerce_after_shop_loop_item' );
	//do_action( 'woocommerce_after_shop_loop_item_title' );
	woocommerce_template_loop_add_to_cart();
	woocommerce_template_loop_price();
	woocommerce_template_loop_rating();


}
add_action( 'optimizer_after_front_post', 'optimizer_woo_content' );


/*ARCHIVE PAGE*/
function optimizer_woo_archive_imgrwrap_before( ) {		if(is_post_type_archive('product')) wp_reset_query(); echo '<div class="imgwrap">';	}
add_action( 'woocommerce_before_shop_loop_item', 'optimizer_woo_archive_imgrwrap_before' );

function optimizer_woo_archive_imgrwrap_after( ) {		if(is_post_type_archive('product')) wp_reset_query(); echo '</div>';		}
add_action( 'woocommerce_before_shop_loop_item_title', 'optimizer_woo_archive_imgrwrap_after' );


function optimizer_woo_archive_remove_actions( ) {	
	global $optimizer;
	if(is_archive()){ 
		if($optimizer['woo_archive_layout'] == 'layout2' || $optimizer['woo_archive_layout'] == 'layout3' || $optimizer['woo_archive_layout'] == 'layout4' || $optimizer['woo_archive_layout'] == 'layout5'){
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' , 10);
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		}
		if($optimizer['woo_archive_layout'] == 'layout5'){
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		}
	}
	
}
add_action( 'wp_head', 'optimizer_woo_archive_remove_actions' );

function optimizer_woo_archive_content( ) {	
	global $optimizer;
	if(is_archive()){ 
	
		if($optimizer['woo_archive_layout'] == 'layout2' || $optimizer['woo_archive_layout'] == 'layout4'){
			echo '<div class="post_content">';
			echo '<p>'.get_the_excerpt().'</p>';
			woocommerce_template_loop_add_to_cart();
			woocommerce_template_loop_price();
			woocommerce_template_loop_rating();
			echo '</div>';
		}
		if($optimizer['woo_archive_layout'] == 'layout3' ){
			echo '<div class="post_content">';
			woocommerce_template_loop_rating();
			woocommerce_template_loop_add_to_cart();
			woocommerce_template_loop_price();
			echo '</div>';
		}
		if($optimizer['woo_archive_layout'] == 'layout5' ){
			echo '<div class="post_content">';
			echo '<a href="' . get_the_permalink() . '"><h3>' . get_the_title() . '</h3></a>';
			echo '<p>'.get_the_excerpt().'</p>';
			woocommerce_template_loop_add_to_cart();
			woocommerce_template_loop_price();
			woocommerce_template_loop_rating();
			echo '</div>';
		}
	}

}
add_action( 'woocommerce_after_shop_loop_item', 'optimizer_woo_archive_content' );


/*SINGLE PAGES --------------------------------*/

function optimizer_woo_single_remove_actions( ) {	
	global $optimizer;
	if(is_single()){ 
		if($optimizer['woo_single_layout'] == 'layout2'){
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		}
	}
	
}
add_action( 'wp_head', 'optimizer_woo_single_remove_actions' );

function optimizer_woo_single_add_actions( ) {	
	global $optimizer;
	if(is_single()){ 
		if($optimizer['woo_single_layout'] == 'layout2'){
			add_action( 'woocommerce_after_add_to_cart_button', 'woocommerce_template_single_price', 20 );
			//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 29 );

		}
		
	}
	
}
add_action( 'woocommerce_single_product_summary', 'optimizer_woo_single_add_actions' );


function optimizer_single4_before_title( ) {		if(is_single()) echo '<div class="woo_product_data">';	}
function optimizer_single4_after_title( ) {		if(is_single()) echo '</div>';	}
function optimizer_single4_before_content( ) {		if(is_single()) echo '<div class="woo_product_meta">';	}
function optimizer_single4_after_content( ) {		if(is_single()) echo '</div>';	}

function optimizer_woo_single_cats( ) {	
	global $optimizer;
	global $post, $product;
	
	if(is_single()){ 
		if($optimizer['woo_single_layout'] == 'layout2' || $optimizer['woo_single_layout'] == 'layout3'){
         if(function_exists('wc_get_product_category_list')){
            echo wc_get_product_category_list( $product->get_id(), ' / ', '<span class="woo_cats_in"> ', '</span>' );
         }

		}
		
	}
	
}
add_action( 'woocommerce_single_product_summary', 'optimizer_woo_single_cats', 4 );
