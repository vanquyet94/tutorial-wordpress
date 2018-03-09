<?php 
// add class active menu wordpress
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
		$classes[] = 'active ';
    }
    return $classes;
}

// or add class parent menu active

add_filter('nav_menu_css_class', 'add_active_class', 10, 2 );
function add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && 
		in_array( 'current-menu-item', $classes ) ||
		in_array( 'current-menu-ancestor', $classes ) ||
		in_array( 'current-menu-parent', $classes ) ||
		in_array( 'current_page_parent', $classes ) ||
		in_array( 'current_page_ancestor', $classes )
    ){
		$classes[] = "active";
	}
	return $classes;
}
