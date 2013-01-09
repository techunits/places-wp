<?php

define('PLACES_WP_DIR', plugin_dir_path(__FILE__));
define('PLACES_WP_URL', plugin_dir_url(__FILE__));
define('PLACES_WP_VERSION', '1.0.1');

//  include required lib files
require_once(PLACES_WP_DIR.'lib'.DIRECTORY_SEPARATOR.'installer'.DIRECTORY_SEPARATOR.'installer.php');

//  remove database schema
PlacesWPInstaller::removeDatabaseSchema();
