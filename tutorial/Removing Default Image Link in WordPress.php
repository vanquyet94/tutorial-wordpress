<?php 
function theme_unlink_images() {
	  update_option('image_default_link_type', 'none');
}
add_action('after_setup_theme', 'theme_unlink_images');
