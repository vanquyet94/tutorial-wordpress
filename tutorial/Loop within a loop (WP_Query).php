<?php 
$query = new WP_Query($args);

while ($query->have_posts()) :

    // initialization for $inner_args & backup the current global $post
    $inner_query = new WP_Query($inner_args);

    while ($inner_query->have_posts()) :
        // do something
    endwhile;

    // restore the global $post from the previously created backup
    $query->reset_postdata();

endwhile;
