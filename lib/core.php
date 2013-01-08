<?php

function places_wp_activation() {
  //  create database schema
  PlacesWPInstaller::createDatabaseSchema();
  
  return true;
}

function places_wp_deactivation() {    
  return true;
}

//  add notice to footer
function places_wp_footer_notice(){        
  echo '<div id="trivian-notice">Thank you for using Places WP by <a href="http://www.techunits.com" title="Places WP - Advanced Places Plugin for Wordpress">Techunits</a>.</div>';
}

//  show places menu
function register_places_wp_menu_page() {
  add_menu_page('Places WP - Places Support Wordpress', 'Places', 'add_users', PLACES_WP_DIR.'/welcome.php', '',   PLACES_WP_URL.'resources/images/placesIcon.png');
  //  add_menu_page('Trivian Widget - Social Trivia Quiz Gaming', 'Trivian Widget', 'add_users', '', 'trivian_menu_page',   MONGOLANTERN_URL.'resources/images/logo.png', 21);
}
