<?php

namespace SaberTheme;


class QueryComponent {

  public function __construct() {

    require_once(SABER_THEME_PATH.'src/components/query/QueryPostType.php');
    add_action('init', [$this, 'registerPostTypes']);
    add_filter('single_template', [$this, 'singlePageTemplates'] );


  }

  public function registerPostTypes() {

    $pt = new QueryPostType;
    $pt->register();

  }

  public function singlePageTemplates( $single ) {

    global $post;

    if ( $post->post_type == 'query' ) {
      return SABER_THEME_PATH . 'src/components/query/templates/query-single.php';
    }

    return $single;

  }

}
