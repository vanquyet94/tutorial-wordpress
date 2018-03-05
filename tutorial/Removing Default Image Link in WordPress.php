<?php 
function theme_unlink_images() {
	  update_option('image_default_link_type', 'none');
}
add_action('after_setup_theme', 'theme_unlink_images');

/************** OR ********************/
function admin_imagelink_setup() {
	update_option('image_default_link_type', 'none');
}
add_action('admin_init', 'admin_imagelink_setup', 10);
