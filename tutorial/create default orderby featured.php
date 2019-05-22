<?php 

// custom featured order by
if (!function_exists('woo_get_featured_product_ids')) {
	function woo_get_featured_product_ids() {
		$featured_product_id = apply_filters( 'woo_featured_product_ids', wc_get_featured_product_ids() );
		return $featured_product_id;
	}
}
	
add_filter('posts_orderby', 'featured_posts_orderby', 10, 2 );
function featured_posts_orderby( $order_by, $query ){
	global  $wpdb ;
	//print_r($query->query_vars);
	if(
		!is_admin() 
		&& 
		(
			(
				!empty($query->query_vars['post_type']) && 
				$query->query_vars['post_type'] == 'product'
			) || (
				!empty($query->query_vars['product_cat']) &&
				empty($query->query_vars['post_type'])
			)
		)
		&&
		(
			(
				!empty($query->query_vars['orderby']) && 
				$query->query_vars['orderby'] == 'menu_order title' && 
				!empty($query->query_vars['order']) && 
				$query->query_vars['order'] == 'ASC'
			) || (
				empty($query->query_vars['orderby'])
			)
		)
		){
		$feture_product_id = woo_get_featured_product_ids();
		if (is_array( $feture_product_id ) && !empty($feture_product_id)) {
			if ( empty($order_by) ) {
				$order_by = "FIELD(" . $wpdb->posts . ".ID,'" . implode( "','", $feture_product_id ) . "') DESC ";
			} else {
				$order_by = "FIELD(" . $wpdb->posts . ".ID,'" . implode( "','", $feture_product_id ) . "') DESC, " . $order_by;
			}
		}
	}
	return $order_by;
}
?>
