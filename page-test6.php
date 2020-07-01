<?php


get_header();

acf_form_head();

?>

<?php

  $settings = [
    'post_id' => 'new_post',
    'new_post' => [
      'post_type'   => 'phrase',
      'post_status' => 'publish'
    ],
    //'field_groups' => ['group_5e921cc71a7c6'],
    'submit_value' => 'Create Post',
  ];
  acf_form( $settings );

?>

<?php get_footer(); ?>
