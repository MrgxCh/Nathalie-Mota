<?php

$args = array(
 'post_type'        => 'photo',
'posts_per_page'   => 8,
'category'         => '',
);
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) {
while ( $the_query->have_posts() ) {
$the_query->the_post(); 

} // end while
} // end if
wp_reset_query();
?>