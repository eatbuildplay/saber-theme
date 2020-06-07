<?php

define( 'SABER_THEME_PATH', plugin_dir_path( __FILE__ ) );
define( 'SABER_THEME_URL', plugin_dir_url( __FILE__ ) );
define( 'SABER_THEME_VERSION', '1.0.0' );

// add_action('init', 'saberThemeInit');
function saberThemeInit() {

  require_once(SABER_THEME_PATH.'src/core/TemplateImporter.php');

  $ti = new \SaberTheme\TemplateImporter();
  $template_json_file = SABER_THEME_PATH.'templates/test1.json';
  $ti->import_json_file_to_elementor_library( $template_json_file );

}

function saberRegisterMenu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'saberRegisterMenu' );

if( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}

add_action('wp_enqueue_scripts', 'saberScripts');
function saberScripts() {

  wp_enqueue_script(
    'particles-js',
    get_template_directory_uri() . '/assets/particles/particles.js',
    array(),
    true
  );

  wp_enqueue_script(
    'saber-skeleton-plugin-js',
    get_template_directory_uri() . '/assets/avnSkeleton/avnPlugin.js',
    array('jquery'),
    true
  );

  wp_enqueue_script(
    'saber-skeleton-js',
    get_template_directory_uri() . '/assets/avnSkeleton/avnSkeleton.js',
    array('jquery'),
    true
  );

  wp_enqueue_script(
    'saber-js',
    get_template_directory_uri() . '/assets/saber.js',
    array(
      'jquery',
      'saber-skeleton-js',
      'particles-js'
    ),
    true
  );


  /* styles */

  wp_enqueue_style(
    'saber-skeleton-css',
    get_template_directory_uri() . '/assets/avnSkeleton/avnSkeleton.css',
    array(),
    true
  );



  wp_enqueue_style(
    'saber-style',
    get_template_directory_uri() . '/style.css',
    array(),
    true
  );

}


/* Class Requires */
require_once(SABER_THEME_PATH.'src/core/PostType.php');


add_action('init', 'loadComponents', 0);
function loadComponents() {

  require_once(SABER_THEME_PATH.'src/components/query/QueryComponent.php');
  new \SaberTheme\QueryComponent();

}
