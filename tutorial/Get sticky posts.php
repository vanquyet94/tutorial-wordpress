<?php
$sticky = get_option('sticky_posts');
rsort( $sticky );
$sticky = array_slice( $sticky, 0, 10);
query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
if (have_posts()) :
    while (have_posts()) : the_post();
        the_title();
        the_excerpt();
    endwhile;
endif;
?>
