<?php

/*
Plugin Name: Trivian Widget
Description: Trivian Widget - Social Trivia Quiz Gaming. You can now have your own Trivian to your website.
Version: 1.0.2
Author: Skall - Techunits
Author URI: http://www.techunits.com
Plugin URI: http://www.trivian.com/home
*/

define('PLACES_WP_DIR', plugin_dir_path(__FILE__));
define('PLACES_WP_URL', plugin_dir_url(__FILE__));
define('PLACES_WP_VERSION', '1.0.1');

//  include required files
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'core.php');
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'widget.php');

//  register required hooks
register_activation_hook(__FILE__, 'places_wp_activation');
register_deactivation_hook(__FILE__, 'places_wp_deactivation');


//  add action to the plugin
add_action('admin_menu', 'register_trivian_widget_menu_page');
add_action("widgets_init", array(
  'Trivian_Widget_WP', 
  'register'
));


//  register shortcode resolve to the target HTML
add_shortcode('trivian_widget', 'trivian_widget_show');

