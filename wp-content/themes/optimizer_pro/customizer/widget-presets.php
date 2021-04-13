<?php /*
PRESET WIDGETS

 */?>



<div id="widget_presets">

    <!--<div class="widget_preset_left">
    <div class="widget_preset_header">Preset Widgets</div>
    	<ul>
        	<li class="active_presw"><a href="#preset_text">Advanced Text</a></li>
            <li><a href="#preset_blocks">Blocks</a></li>
            <li><a href="#preset_video">Video</a></li>
            <li><a href="#preset_posts">Posts</a></li>
            <li><a href="#preset_contact">Contact</a></li>
        </ul>
    </div>-->
    
    <div class="widget_preset_right" style="display:none;"><i class="fa fa-angle-left"></i>
    
    	<?php $preloader =  get_template_directory_uri().'/assets/images/preloader.png'; ?>
    
    	<!--TEXT-->
    	<div id="tab_optimizer_front_text" class="preset_tabs active_preset_tab">
        	<h4>Advanced Text Widget Presets</h4>
        	<a id="text_preset1" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/laVOjHp.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset2" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/sI7yWB6.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset3" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/nisbBVJ.jpg" title="Click to Insert This Preset Widget" /></a>
        	<a id="text_preset4" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/VRbNf2z.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset5" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/l66Up4W.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset6" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/53NLlKH.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset7" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/u8GcJlm.jpg" title="Click to Insert This Preset Widget" /></a>
        	<a id="text_preset8" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/vwqSofV.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset9" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/rbPWI5l.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="text_preset10" onClick="import_text(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/NyPM4eN.jpg" title="Click to Insert This Preset Widget" /></a>
        </div>
        
        <!--BLOCKS-->
    	<div id="tab_optimizer_front_blocks" class="preset_tabs">
        	<h4>Blocks Widget Presets</h4>
        	<a id="blocks_preset1" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/qrHnzZp.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset2" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/tA84pY0.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset3" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/HhaUv2p.png" title="Click to Insert This Preset Widget" /></a>
        	<a id="blocks_preset4" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/RwPOnIG.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset5" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/RVtBb0z.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset6" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/pGmanzX.png" title="Click to Insert This Preset Widget" /></a>
        	<a id="blocks_preset7" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/jwjvEFe.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset8" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/voUPeNG.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset9" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/SAGbKkD.png" title="Click to Insert This Preset Widget" /></a>
        	<a id="blocks_preset10" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/iobqmK6.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset11" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/Ht2cbru.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset12" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/M7RnIIm.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset13" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/Inpt0MA.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset14" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/VkgTCHm.png" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset15" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/MJ06ByL.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="blocks_preset16" onClick="import_blocks(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/aG9zIZm.jpg" title="Click to Insert This Preset Widget" /></a>
        </div>
        
        
        <!--VIDEO-->
    	<div id="tab_optimizer_front_video" class="preset_tabs">
        	<h4>Video Widget Presets</h4>
        	<a id="video_preset1" onClick="import_video(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/AvYvDpg.png" title="Click to Insert This Preset Widget" /></a>
            <a id="video_preset2" onClick="import_video(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/h2qmrbU.png" title="Click to Insert This Preset Widget" /></a>
            <a id="video_preset3" onClick="import_video(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/Dy5lO3r.png" title="Click to Insert This Preset Widget" /></a>
        </div>

        
        <!--POSTS-->
    	<div id="tab_optimizer_front_posts" class="preset_tabs">
        	<h4>Posts Widget Presets</h4>
        	<a id="posts_preset1" onClick="import_posts(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/i4waY5H.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="posts_preset2" onClick="import_posts(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/0H2r3eU.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="posts_preset3" onClick="import_posts(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/BQrPVfM.jpg" title="Click to Insert This Preset Widget" /></a>
        	<a id="posts_preset4" onClick="import_posts(this.id)"><img  src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/XXhcWcb.png" title="Click to Insert This Preset Widget" /></a>
            <a id="posts_preset5" onClick="import_posts(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/mLyddCu.png" title="Click to Insert This Preset Widget" /></a>
            <a id="posts_preset6" onClick="import_posts(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/3wgtnLg.png" title="Click to Insert This Preset Widget" /></a>
        </div>
            
        <!--CONTACT-->
    	<div id="tab_optimizer_front_map" class="preset_tabs">
        	<h4>Contact Widget Presets</h4>
        	<a id="contact_preset1" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/FeNLe26.png" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset2" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/KUs0QzG.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset3" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/jjK17ss.jpg" title="Click to Insert This Preset Widget" /></a>
        	<a id="contact_preset4" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/SEkKcfO.png" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset5" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/9GXrv85.png" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset6" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/EeRJxPy.png" title="Click to Insert This Preset Widget" /></a>
        	<a id="contact_preset7" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/GrFLMnc.png" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset8" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/mmgNVRF.png" title="Click to Insert This Preset Widget" /></a>
            <a id="contact_preset9" onClick="import_contact(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/2TxH7ri.jpg" title="Click to Insert This Preset Widget" /></a>
        </div>
        
        
        <!--CTA-->
    	<div id="tab_optimizer_front_cta" class="preset_tabs">
        	<h4>CTA Widget Presets</h4>
        	<a id="cta_preset1" onClick="import_cta(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/hqZogOk.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="cta_preset2" onClick="import_cta(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/zawAj4c.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="cta_preset3" onClick="import_cta(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/cADb7oJ.jpg" title="Click to Insert This Preset Widget" /></a>
        </div>  
        
        
        
        <!--NEWSLETTER-->
    	<div id="tab_optimizer_front_newsletter" class="preset_tabs">
        	<h4>Newsletter Widget Presets</h4>
        	<a id="newsletter_preset1" onClick="import_newsletter(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/qdqL7ky.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="newsletter_preset2" onClick="import_newsletter(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/fvqPbqZ.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="newsletter_preset3" onClick="import_newsletter(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/WumdzCH.jpg" title="Click to Insert This Preset Widget" /></a>
            <a id="newsletter_preset4" onClick="import_newsletter(this.id)"><img src="<?php echo $preloader; ?>" data-src="http://i.imgur.com/HrbiIC7.jpg" title="Click to Insert This Preset Widget" /></a>
        </div>  

        
    </div>

</div>