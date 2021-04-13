<?php 
/**
 * The FRONTPAGE WIDGET AREA  for LayerFramework
 *
 * Displays The FRONTPAGE WIDGET AREA Element on Frontpage
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>

<?php $frontwidget = $optimizer['home_sort_id']; if(!empty($frontwidget['front-widgets'])){ ?>
<!--Homepage Widgets-->
        <div class="home_sidebar <?php if(!empty($optimizer['hide_mob_frontwdgt'])){ echo 'mobile_hide_frontwdgt';} ?>">
            <div id="home_widgets">
                <div class="center">
                    <div class="widgets frontwdgt_col<?php echo $optimizer['frontwdgt_columns']; ?>">
                        <ul><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home_sidebar') ) : ?><?php endif; ?></ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>