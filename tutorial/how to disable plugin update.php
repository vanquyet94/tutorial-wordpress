 <?php 
 function my_filter_plugin_updates( $value ) {
   	if( isset( $value->response['facebook-comments-plugin/facebook-comments.php'] ) ) {        
      	unset( $value->response['facebook-comments-plugin/facebook-comments.php'] );
	}
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );
