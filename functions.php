<?php

define("BBJ_THEME_VERSION", "3.2.0.3");
define("BBJ_ROOT", dirname(__FILE__));
define("BBJ_INCLUDES", BBJ_ROOT . "/includes");
define("BBJ_IMAGES", get_theme_file_uri("/images"));
define("BBJ_MB_FILES", BBJ_INCLUDES . "/MB");
define("BBJ_THEME_URL", get_theme_file_uri());
define("BBJ_THEME_PATH", get_theme_file_uri() . "/");
define("BBJ_THEME_DIST_PATH", BBJ_THEME_PATH . "build/");
define("BBJ_THEME_DIST_URL", BBJ_THEME_URL . "/build/");
define("BBJ_THEME_INC", BBJ_THEME_PATH . "includes/");
define("BBJ_THEME_BLOCK_DIR", BBJ_THEME_INC . "blocks/");

require_once BBJ_INCLUDES . "/core.php";
require_once BBJ_INCLUDES . "/director.php";
require "includes/cpt.php";
require "includes/breadcrumbs.php";
require "includes/routes.php";
require "includes/search-route.php";
require 'includes/ads.php';

//Include Metabox Files
require_once BBJ_MB_FILES . "/create-tables.php";
//require_once BBJ_MB_FILES . "/relationships.php";
require_once BBJ_MB_FILES . "/custom-blocks.php";

// Load general scripts
function load_assets()
{
  wp_enqueue_style("needed", BBJ_THEME_PATH . "style.css", [], BBJ_THEME_VERSION);
  wp_enqueue_script("frontend", BBJ_THEME_DIST_PATH . "index.js", ["jquery", "wp-element"], BBJ_THEME_VERSION, true);
  wp_enqueue_style("frontend", BBJ_THEME_DIST_PATH . "index.css", [], BBJ_THEME_VERSION);
  wp_enqueue_style("tailwind", BBJ_THEME_DIST_PATH . "index-style.css", [], BBJ_THEME_VERSION);
  wp_enqueue_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");

  wp_localize_script("frontend", "playerData", [
    "root_url" => get_site_url(),
    "nonce" => wp_create_nonce("wp_rest"),
  ]);
}

add_action("wp_enqueue_scripts", "load_assets");

function admin_includes()
{
  wp_register_style("bbj-admin-css", get_template_directory_uri() . "/includes/blocks/feed-updates/style.css", [], BBJ_THEME_VERSION);
  wp_enqueue_style("bbj-admin-css");
}
add_action("admin_enqueue_scripts", "admin_includes");

// Create Menu
function bbj_menu()
{
  register_nav_menus([
    "bbj-main-menu" => _("Main Menu"),
    "bbj-secondary-menu" => _("Second Menu"),
    "bbj-footer-menu" => _("Footer Menu"),
  ]);
}
add_action("init", "bbj_menu");

// Load admin scripts
function load_admin_scripts()
{
}

// Add options page
if (function_exists("acf_add_options_page")) {
  acf_add_options_page();
}

// always update values of all bidirectional fields
add_filter("acfe/bidirectional/force_update", "__return_true");

// or target a specific field only
add_filter("acfe/bidirectional/force_update/name=my_field", "__return_true");

// if (function_exists("register_sidebar")) {
//   register_sidebar();
// }

add_filter('comment_flood_filter', '__return_false');