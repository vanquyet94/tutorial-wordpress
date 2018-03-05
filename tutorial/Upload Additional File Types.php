<?php
add_filter( 'upload_mimes', 'wordpress_upload_types', 1, 1 );
function wordpress_upload_types($mime_types){
	  $mime_types['svg'] = 'image/svg+xml';     // Adding .svg extension
	  $mime_types['json'] = 'application/json'; // Adding .json extension

	  unset( $mime_types['xls'] );  // Remove .xls extension
	  unset( $mime_types['xlsx'] ); // Remove .xlsx extension

	  return $mime_types;
}
/************ OR ************/
define( 'ALLOW_UNFILTERED_UPLOADS', true );
