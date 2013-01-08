<?php

if (file_exists("../../../../wp-load.php")) {
  require_once("../../../../wp-load.php");
}
else {
  exit('!!! FAILED !!!');
}



if(!empty($_SERVER['REMOTE_ADDR']) && '127.0.0.1' != $_SERVER['REMOTE_ADDR'] && !empty($_GET['latitude']) && !empty($_GET['longitude'])) {
  global $wpdb;
  SessionHandler::Init();
  SessionHandler::Set('location', array(
    'latitude'  =>  $_GET['latitude'], 
    'longitude' =>  $_GET['longitude']
  ));
  
  //  save data to table
  $table_name = $wpdb->prefix . "geoIpLocation";
  $wpdb->query("INSERT INTO $table_name (ip, location) VALUES ('{$_SERVER['REMOTE_ADDR']}', GeomFromText('POINT({$_GET['latitude']} {$_GET['longitude']})'))");
  
  exit('SUCCEED');
}


exit('FAILED');
