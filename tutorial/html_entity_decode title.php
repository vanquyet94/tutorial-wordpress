<?php
function veas_filter_the_title( $title ) {
    return html_entity_decode($title);
}
add_filter( 'the_title', 'veas_filter_the_title' );
