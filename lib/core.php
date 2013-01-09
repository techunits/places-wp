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

function place_register() { 
	$labels = array(
		'name'          =>  _x('Places', 'post type general name'),
		'singular_name' =>  _x('Place', 'post type singular name'),
		'add_new'       =>  _x('Add New Place', 'place item'),
		'add_new_item'  =>  __('Add New Place'),
		'edit_item'     =>  __('Edit Place'),
		'new_item'      =>  __('New Place'),
		'view_item'     =>  __('View Place'),
		'search_items'  =>  __('Search Place'),
		'not_found'     =>  __('No places added, yet.'),
		'not_found_in_trash'  =>  __('Nothing found in Trash'),
		'parent_item_colon'   =>  ''
	);
 
	$args = array(
    'labels'              =>  $labels,
    'public'              =>  true,
    'publicly_queryable'  =>  true,
    'show_ui'             =>  true,
    'query_var'           =>  true,
    'menu_icon'           =>  PLACES_WP_URL.'resources/images/placesIcon.png',
    'rewrite'             =>  true,
    'capability_type'     =>  'post',
    'hierarchical'        =>  false,
    'menu_position'       =>  null,
    'supports'            =>  array('title', 'editor', 'thumbnail')
  ); 
  
  //  register new post type: place
	register_post_type('place', $args );
}



