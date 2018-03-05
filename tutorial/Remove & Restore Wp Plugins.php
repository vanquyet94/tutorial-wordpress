<?php 
/**
 * Remove and Restore ability to Add new plugins to site
 */

function remove_plugins_menu_item($role_name){
	$role = get_role( $role_name );
	$role->remove_cap( 'activate_plugins' );
	$role->remove_cap( 'install_plugins' );
	$role->remove_cap( 'upload_plugins' );
	$role->remove_cap( 'update_plugins' );
}

function restore_plugins_menu_item($role_name){
	$role = get_role( $role_name );
	$role->add_cap( 'activate_plugins' );
	$role->add_cap( 'install_plugins' );
	$role->add_cap( 'upload_plugins' );
	$role->add_cap( 'update_plugins' );
}

// remove_plugins_menu_item('administrator'); 
restore_plugins_menu_item('administrator');
