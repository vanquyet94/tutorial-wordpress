~~~php
<?php 
function exhibition_load_admin(WP_Query $query){
	global $current_user;
    if ( 'exhibition' == $query->get('post_type')) {
		$query->set( 'author',$current_user->ID);
    }
}
if(is_admin()){
    add_action( 'pre_get_posts', 'exhibition_load_admin' );
}