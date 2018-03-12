<?php
add_action('save_post','save_post_callback');
function save_post_callback($post_id){
	global $post; 
    if ($post->post_type != 'MY_CUSTOM_POST_TYPE_NAME'){
        return;
    }
    //if you get here then it's your post type so do your thing....
}
/********************** OR *****************/
// New solution, as of WP 3.7: save_post_{$post_type}
add_action( 'save_post_my_post_type', 'wpse63478_save' );
function wpse63478_save() {
    //save stuff
}
