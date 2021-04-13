<?php 
/**
 * The Frontpage CLIENTS for LayerFramework
 *
 * Displays The CLIENTS Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>


<!--Homepage CLIENTS LOGO START-->
    <div class="centerfix">
        <div class="ast_clientlogos <?php if(!empty($optimizer['hide_mob_clients'])){ echo 'mobile_hide_clients';} ?>">
        
            <?php if($optimizer['client_title_id'] || $optimizer['client_subtitle_id']) { ?>
            <div class="homeposts_title">
            	<?php if($optimizer['client_title_id']) { ?><h2 class="home_title"><span><?php echo do_shortcode($optimizer['client_title_id']); ?></span></h2><?php } ?>
                <?php if($optimizer['client_subtitle_id']) { ?><div class="home_subtitle"><?php echo do_shortcode($optimizer['client_subtitle_id']); ?></div><?php } ?> 
            </div>
            <?php } ?>
         
        <!--CLIENT LOGO STARTS-->   
        <div class="clients_logo">
            <div class="center">
            <?php if (!empty ($optimizer['client_logo'])){ ?>
				<?php foreach ((array)$optimizer['client_logo'] as $clientlogo){ ?> 
                    <a title="<?php echo $clientlogo['title']; ?>" <?php if ($clientlogo['url']) {?>href="<?php echo esc_url($clientlogo['url']); ?>"<?php } ?>>
                    <img alt="<?php echo $clientlogo['title']; ?>" class="client_logoimg" src="<?php echo $clientlogo['image']; ?>" width="<?php echo $clientlogo['width']; ?>"  height="<?php echo $clientlogo['height']; ?>" />
                    </a>
                <?php } ?>
             <?php } ?>    
             
            </div>
        </div>
        <!--CLIENT LOGO END--> 
        
        </div>
     </div>

<!--Homepage CLIENTS LOGO END-->

