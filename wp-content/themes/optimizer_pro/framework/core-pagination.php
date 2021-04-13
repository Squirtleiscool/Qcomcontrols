<?php 
/**
 * The Related Posts Function for LayerFramework
 *
 * Displays The Post Pagination .
 *
 * @package LayerFramework
 * 
 * @since  LayerFramework 1.0
 */
global $optimizer;?>
<?php function optimizer_pagination($navigation='numbered', $query='') { ?>
		<?php if($navigation !== 'no_nav') { ?>
                <?php if($navigation == 'numbered' || $navigation == 'numbered_ajax') { ?>
                    <div class="ast_pagenav <?php echo (int)$query->max_num_pages >= 10 ? 'ast_pagenav--dottedPagination': '' ; ?>" data-query-count="1" data-query-max="<?php echo $query->max_num_pages; ?>">
                        <?php
							if($query == ''){
								global $wp_query;
								$big = 999999999; // need an unlikely integer
									echo paginate_links( array(
										'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format' => '?paged=%#%',
										'current' => max( 1, get_query_var('paged') ),
										'total' => $wp_query->max_num_pages,
										'show_all'     => true,
										'prev_next'    => false,
										'add_args' => false
									) );
							}else if($query !== ''){
								$big = 999999999; // need an unlikely integer
									echo paginate_links( array(
										'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format' => '?paged=%#%',
										'current' => max( 1, get_query_var('paged') ),
										'total' => $query->max_num_pages,
										'show_all'     => true,
										'prev_next'    => false,
										'add_args' => false
									) );
							}
                        ?>
                    </div>
                <?php } ?>
                <?php if($navigation == 'oldnew') { ?>
                    <div class="ast_navigation" data-query-count="1" data-query-max="<?php echo $query->max_num_pages; ?>">
                        <div class="alignleft"><i class="fa fa-angle-left nav_maxed"></i></div>
                        <div class="alignright"><i class="fa fa-angle-right"></i></div>
                    </div>
                <?php } ?>
                <?php if($navigation == 'infscroll' || $navigation == 'infscroll_auto'){ ?>
                    <div id="nav-below" data-infinte-next="2" data-infinite-max="<?php echo $query->found_posts; ?>">
                        <div class="nav-next"><?php
						if($query == ''){
						global $wp_query;
							next_posts_link(__('+ More','optimizer'), $wp_query->max_num_pages);
						}else if($query !== ''){
							next_posts_link(__('+ More','optimizer'), $query->max_num_pages);
						}
						 
						  ?></div>
                    </div> 
                <?php } ?>
        <?php } ?>
<?php } ?>