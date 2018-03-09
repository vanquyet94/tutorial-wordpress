<?php

//defining the filter that will be used to select posts by 'post formats'
function add_post_formats_filter_to_post_administration(){
    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'exhibitionopen'){
        $post_formats_args = array(
            "select_name" => "exhibition_id",
			"post_type"	=> "exhibition"
        );
        //if we have a post format already selected, ensure that its value is set to be selected
        if(isset($_GET['exhibition_id'])){
            $post_formats_args['selected'] = sanitize_text_field($_GET['exhibition_id']);
        }
        wp_dropdown_posts($post_formats_args);
    }
}
add_action('restrict_manage_posts','add_post_formats_filter_to_post_administration');


function add_post_format_filter_to_posts($query){
    global $post_type, $pagenow;
    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'exhibitionopen'){
        if(isset($_GET['exhibition_id'])){
            //get the desired post format
            $post_format = sanitize_text_field($_GET['exhibition_id']);
            //if the post format is not 0 (which means all)
            if($post_format != 0){
                $query->query_vars['meta_query'] = array(
                    "relation" => "AND",
					array(
						"key" => "exhibitionid",
						"value" => "\"{$post_format}\"",
						"compare" => "LIKE"
					)
                );
            }
        }
    }   
}
add_action('pre_get_posts','add_post_format_filter_to_posts');


// Admin function wp_dropdown_posts
// https://github.com/vanquyet94/wordpress-dropdown-posts
