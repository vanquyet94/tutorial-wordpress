<?php 
// order Archive
add_action( 'pre_get_posts', 'archive_change_sort_order'); 
function archive_change_sort_order($query){
    if(is_archive()):
		      //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
		      //Set the order ASC or DESC
		      $query->set( 'order', 'ASC' );
		      //Set the orderby
		      $query->set( 'orderby', 'menu_order');
	  endif;    
};
