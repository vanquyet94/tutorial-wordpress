<?php 
function sp_custom_notice() {
	if ( isset( $_GET['add_to_wishlist']) ) {
		//$url = do_shortcode('[yith_wcwl_add_to_wishlist]');
		$wishlistid = get_option('yith_wcwl_wishlist_page_id');
		if(is_numeric($wishlistid)){
			$wishlisturl = get_permalink($wishlistid);
			wc_add_notice( sprintf(__('<a href="%s" class="button wc-forward">View wishlist</a> A product has been added to your wishlist','theme-omazz'),$wishlisturl), 'success' );
		}else{			
			wc_add_notice( __('A product has been added to your wishlist','theme-omazz'), 'success' );
		}
	}
}
add_action( 'wp', 'sp_custom_notice' );
