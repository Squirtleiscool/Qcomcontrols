<?php
add_action('admin_head', 'wpds_admin_head');
add_action('edit_term', 'wpds_save_tax_pic');
add_action('create_term', 'wpds_save_tax_pic');
function wpds_admin_head() {
    $taxonomies = get_taxonomies();
    //$taxonomies = array('category'); // uncomment and specify particular taxonomies you want to add image feature.
    if (is_array($taxonomies)) {
        foreach ($taxonomies as $z_taxonomy) {
            add_action($z_taxonomy . '_add_form_fields', 'wpds_tax_field');
            add_action($z_taxonomy . '_edit_form_fields', 'wpds_tax_field');
        }
    }
}

// add image field in add form
function wpds_tax_field($taxonomy) {
    wp_enqueue_style('thickbox');
    wp_enqueue_script('thickbox');
    if(empty($taxonomy)) {
        echo '<div class="form-field">
                <label for="wpds_tax_pic">Picture</label>
				<input type="text" name="wpds_tax_pic" id="wpds_tax_pic" value="" />
				<input type="button" name="category_media_button" onclick="mediaPicker(this.id)" class="button custom_media_upload" style="width:120px" value="'.__('Upload Image','optimizer').'" id="cat_image_uploader" />
                
            </div>';
    }
    else{
        $wpds_tax_pic_url = get_option('wpds_tax_pic' . $taxonomy->term_id);
        echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="wpds_tax_pic">'.__('Header Image','optimizer').'</label></th>
		<td><input type="text" name="wpds_tax_pic" id="wpds_tax_pic" value="' . $wpds_tax_pic_url . '" />
		<input type="button" name="category_media_button" class="button custom_media_upload" onclick="mediaPicker(this.id)" style="width:120px" value="Upload Image" id="cat_image_uploader" /><br><br>
			';
        if(!empty($wpds_tax_pic_url))
            echo '<img src="'.$wpds_tax_pic_url.'" class="current_image" style="max-width:200px;border: 1px solid #ccc;padding: 5px;box-shadow: 5px 5px 10px #ccc;margin-top: 10px;" >';
        echo '</td></tr>';        
    }
}

// save our taxonomy image while edit or save term
function wpds_save_tax_pic($term_id) {
    if (isset($_POST['wpds_tax_pic']))
        update_option('wpds_tax_pic' . $term_id, $_POST['wpds_tax_pic']);
}

// output taxonomy image url for the given term_id (NULL by default)
function wpds_tax_pic_url($term_id = NULL) {
    if ($term_id) 
        return get_option('wpds_tax_pic' . $term_id);
    elseif (is_category())
        return get_option('wpds_tax_pic' . get_query_var('cat')) ;
    elseif (is_tax()) {
        $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        return get_option('wpds_tax_pic' . $current_term->term_id);
    }
}