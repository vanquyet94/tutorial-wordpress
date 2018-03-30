<?php 
	add_filter( 'wpcf7_load_js', '__return_false' );
	add_filter( 'wpcf7_load_css', '__return_false' );
	add_action( 'the_content', 'load_cf7_assets' );
	function load_cf7_assets($content){
		global $post;
		$post_content = $post->post_content;
		if ( has_shortcode( $post_content, 'contact-form-7' ) ) {
			if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
			if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
				wpcf7_enqueue_styles();
			}
		}
		return $content;
	}
