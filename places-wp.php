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
add_action('wp_head', 'LocationHandler::addShareLocationScript');



//  register shortcode resolve to the target HTML
//  add_shortcode('trivian_widget', 'trivian_widget_show');

