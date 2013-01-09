<?php

/*
Plugin Name: Places WP
Description: Places is the most popular wordpress extension to enable places support into your wordpress website/blog.
Version: 1.0.1
Author: Skall - Techunits
Author URI: http://www.techunits.com
Plugin URI: http://www.techunits.com
*/

define('PLACES_WP_DIR', plugin_dir_path(__FILE__));
define('PLACES_WP_URL', plugin_dir_url(__FILE__));
define('PLACES_WP_VERSION', '1.0.1');

//  include required lib files
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'installer'.DIRECTORY_SEPARATOR.'installer.php');
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'core.php');
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'session.php');

require_once(PLACES_WP_DIR.'module'.DIRECTORY_SEPARATOR.'location.php');

//  register required hooks
register_activation_hook(__FILE__, 'places_wp_activation');
register_deactivation_hook(__FILE__, 'places_wp_deactivation');


//  add action to the plugin
add_action('admin_menu', 'register_places_wp_menu_page');

//  add the share location script to head section
add_action('wp_head', 'LocationHandler::addGeoLocationMetaTag');
add_action('wp_print_scripts', 'LocationHandler::addShareLocationScript');

//  add savelocationinfo action hook
add_action('wp_ajax_saveLocationInfo', 'LocationHandler::saveLocationInfo');
add_action('wp_ajax_nopriv_saveLocationInfo', 'LocationHandler::saveLocationInfo'); // need this to serve non logged in users

//  add_action('init', 'place_register');
/*register_taxonomy('Place Types', array(
  'place'
), array(
  'hierarchical'    => true,
  'label'           =>  "Place Types",
  'singular_label'  =>  "Place Type"
));*/

//  register shortcode resolve to the target HTML
//  add_shortcode('trivian_widget', 'trivian_widget_show');

