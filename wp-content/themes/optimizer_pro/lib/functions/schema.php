<?php

/**
 * Schema Markup for Optimizer
 *
 * Integrates the Schema Markup in whole site if Enabled
 *
 * @package Optimizer
 * 
 * @since Optimizer 0.4.4
 */
 
 
if(!function_exists( 'optimizer_schema_page_type' ) ){
	function optimizer_schema_page_type(){
		global $optimizer; 
		if($optimizer['schema']){
			$schema = 'http://schema.org/';
		 
			// Is blog single, archive or category
			if( is_singular( 'post' ) )
			{
				$type = "Blog";
			}
			else if( is_archive()||is_category())
			{
				$type = "Blog";
			}
			// Is static front page
			else if(is_home() || is_front_page())
			{
				$type = "Website";
			}
			// Is author page
			elseif( is_author() )
			{
				$type = 'ProfilePage';
			}
			// Is search results page
			elseif( is_search() )
			{
				$type = 'SearchResultsPage';
			}
			// Is a general page
			 else
			{
				$type = 'WebPage';
			}
	 
			$schematype =  'itemscope="itemscope" itemtype="' . $schema . $type . '"';
		
		}else{
			$schematype = '';
		}
		
		echo $schematype;
		
	}
}

if(!function_exists( 'optimizer_schema_item_type' ) ){
	function optimizer_schema_item_type($type){
		global $optimizer; 
		if($optimizer['schema']){
			$schema = 'http://schema.org/';
		 
			
			// Is single post 
			if($type =='header'){		$type = "WPHeader";					}
			if($type =='menu'){			$type = "SiteNavigationElement";	}
			if($type =='sidebar'){		$type = "WPSideBar";				}
			if($type =='footer'){		$type = "WPFooter";					}
			if($type =='author'){		$type = "Person";					}
			if($type =='post'){			$type = "BlogPosting";				}
			if($type =='author'){		$type = "Person";				}
			if($type =='blog'){			$type = "Blog";				}
	
			$schematype =  'itemscope itemtype="' . $schema . $type . '"';
		
		}else{
			$schematype = '';
		}
		
		echo $schematype;
		
	}
}

if(!function_exists( 'optimizer_schema_prop' ) ){
	function optimizer_schema_prop($type){
		global $optimizer; 
		if($optimizer['schema']){
			
			// Is single post
			if($type =='main'){		$type = "mainContentOfPage";		}
			if($type =='post'){		$type = "blogPost";		}
			if($type =='title'){		$type = "headline";		}
			if($type =='date'){			$type = "datePublished";		}
			if($type =='modified'){			$type = "dateModified";		}
			if($type =='author'){		$type = "author";		}
			if($type =='image'){		$type = "image";		}
			if($type =='category'){		$type = "about";		}
			if($type =='tags'){		$type = "keywords";		}
			if($type =='content'){		$type = "mainEntityOfPage";		}
			if($type =='text'){		$type = "text";		}
			if($type =='name'){		$type = "name";		}
				
				//Content
				$content = '';
				if($type =='date'){		$content = 'content="'.the_time('c').'"';		}
				if($type =='modified'){		$content = 'content="'.the_time('c').'"';	}

			
			$schemaprop =  'itemprop="'.$type.'" '.$content.'';
		
		}else{
			$schemaprop = '';
		}
		
		echo $schemaprop;
	}
}


function Optimizer_single_schema(){
	global $optimizer; 

	if($optimizer['schema']){
	//Post Image
	$image = optimizer_placeholder_image(); $width = '500'; $height = '350';
	if ( has_post_thumbnail() ){  
		$image = get_the_post_thumbnail_url();
		$imageid =get_post_thumbnail_id();
		$imageattr = wp_prepare_attachment_for_js($imageid);  
		$width = $imageattr['width'];
		$height = $imageattr['height'];
	}
	
	echo '<div style="display:none" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
	<meta itemprop="url" content="'.$image.'" />
	<meta itemprop="width" content="'.$width.'" />
	<meta itemprop="height" content="'.$height.'" />
	</div>';
	
	
	//Date
	echo '<time datetime="'.get_the_date('c').'" itemprop="datePublished"></time><time datetime="'.get_the_modified_date('c').'" itemprop="dateModified"></time>';
	
	//Publisher Info
	if(!empty($optimizer['logo_image_id'])){ $logo = $optimizer['logo_image_id']['url'];}else{ $logo ='http://dummyimage.com/600x60/fff/333333.png&text='.get_bloginfo('name').''; }
	echo    
	"<div style='display:none' itemprop='publisher' itemscope='itemscope' itemtype='https://schema.org/Organization'>
		<span itemprop='name'>".get_bloginfo('name')."</span>
		<div itemprop='logo' itemscope='itemscope' itemtype='https://schema.org/ImageObject'>
			<!-- Render Logo if avaialble -->
			<meta itemprop='url' content='".$logo."'/> 
			<meta itemprop='width' content='600'/> <!-- Logos should be no wider than 600px. -->
			<meta itemprop='height' content='60'/> <!-- and no taller than 60px.-->
			
		</div>
    </div>";
	
	}
	
}
add_action('optimizer_after_single_meta','Optimizer_single_schema');


global $optimizer; 
if($optimizer['schema']){
	add_filter( 'nav_menu_link_attributes', 'optimizer_menu_schema', 10, 3 );
	function optimizer_menu_schema( $atts, $item, $args )
	{
	
			$atts['itemprop'] = 'url';
			return $atts;
	
	}
	
}