<?php

define('BBJ_THEME_VERSION', '2.0.2');
define('BBJ_THEME_URL', get_theme_file_uri());
define('BBJ_THEME_PATH', get_theme_file_uri() . '/');
define('BBJ_THEME_DIST_PATH', BBJ_THEME_PATH . 'build/');
define('BBJ_THEME_DIST_URL', BBJ_THEME_URL . '/build/' );
define('BBJ_THEME_INC', BBJ_THEME_PATH . 'includes/');
define('BBJ_THEME_BLOCK_DIR', BBJ_THEME_INC . 'blocks/');


require ('includes/core.php');
require ('includes/meta-box.php');
require ('includes/cpt.php');
require ('includes/breadcrumbs.php');


// Load general scripts
function load_assets() {
  wp_enqueue_style('needed', BBJ_THEME_PATH . 'style.css', array(), BBJ_THEME_VERSION);  
	wp_enqueue_script('frontend', BBJ_THEME_DIST_PATH . 'index.js', array('jquery'), BBJ_THEME_VERSION, true);  
  wp_enqueue_style('frontend', BBJ_THEME_DIST_PATH . 'index.css', array(), BBJ_THEME_VERSION);  
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@500;600;700&display=swap');
}

add_action ('wp_enqueue_scripts', 'load_assets');


// Load admin scripts 
function load_admin_scripts() {

}


// Add options page 
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


// always update values of all bidirectional fields
add_filter('acfe/bidirectional/force_update', '__return_true');

// or target a specific field only
add_filter('acfe/bidirectional/force_update/name=my_field', '__return_true');