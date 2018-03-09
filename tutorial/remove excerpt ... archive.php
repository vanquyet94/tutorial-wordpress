<?php
// remove ... excerpt more
function remove_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'remove_excerpt_more');
