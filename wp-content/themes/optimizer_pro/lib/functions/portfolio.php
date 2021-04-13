<?php
/*PORTFOLIO POST TYPE SUPPORT 
PLUGIN1 : https://wordpress.org/plugins/portfolio-post-type/
PLUGIN2 : https://wordpress.org/plugins/jetpack/
*/

if(function_exists('portfolio_post_type_init') || ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) ){
require(get_template_directory() . '/framework/core-portfolio.php');	


	add_filter( 'template_include', 'optimizer_devins_portfolio_support', 99 );
			
	function optimizer_devins_portfolio_support( $template ) {

				if ( is_singular( 'portfolio' ) || is_singular( 'jetpack-portfolio' ) ) {
					$new_template = locate_template( array( 'optimizer-single-portfolio.php' ) );
					if ( '' != $new_template ) {
						return $new_template ;
					}
				}

				return $template;
	}
			
	add_filter( 'template_include', 'optimizer_portfolio_archive_support', 99 );
	function optimizer_portfolio_archive_support( $template ) {
					
				if ( is_tax( 'portfolio_category' ) ||is_tax( 'portfolio_tag' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' )  || is_post_type_archive( 'portfolio' ) || is_post_type_archive( 'jetpack-portfolio' ) ) {
					$new_template = locate_template( array( 'optimizer-portfolio-archive.php' ) );
					if ( '' != $new_template ) {
						return $new_template ;
					}
				}
			
				return $template;
	}



function optimizer_portfolio_assets() { 
	if ( !is_admin() ) {
		
			wp_enqueue_style( 'portfolio-style', get_template_directory_uri().'/assets/css/portfolio.css');
			wp_enqueue_script( 'portfolio-js', get_template_directory_uri().'/assets/js/portfolio.js', array('jquery'), '', true);
			if (is_archive() ){
				wp_enqueue_script('optimizer_masonry',get_template_directory_uri().'/assets/js/masonry.js', array('jquery'), '', true);
			}	

	}
}
	
add_action('wp_enqueue_scripts', 'optimizer_portfolio_assets');


add_action('wp_footer', 'optimizer_portfolio_masonry');
function optimizer_portfolio_masonry() { ?>
			<?php if ( is_archive() ) { ?>
				
				<script type="text/javascript">
					//Layout3 Masonry
					var container = document.querySelector('.port_layout_3');
					var msnry;
					if(container){
						imagesLoaded( container, function() {
							new Masonry( container, {
						  // options
						  itemSelector: '.hentry'
						});
						});
					}
				</script>
				<?php } ?>
<?php }

} //Plugin Check condition ENDS