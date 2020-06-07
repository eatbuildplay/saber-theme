<?php get_header(); ?>

<h1>Query</h1>

<?php

$fields = get_fields($post->ID);
var_dump( $fields );

// loop over meta query repeater to form meta query

$queryArgs = [
  'post_type'     => $fields['post_type'],
  'numberposts'   => $fields['limit'],
  'order'         => $fields['order'],
  'orderby'       => $fields['orderby'],
  'meta_query'    => []
];
$posts = get_posts( $queryArgs );

var_dump( $queryArgs);
var_dump($posts);

?>

<?php get_footer(); ?>
