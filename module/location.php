<?php

class LocationHandler {

  //  save location info to session and database for further processing
  public static function saveLocationInfo() {
    global $wpdb;
    if(!empty($_SERVER['REMOTE_ADDR']) && '127.0.0.1' != $_SERVER['REMOTE_ADDR']) {
      SessionHandler::Init();
      SessionHandler::Set('location', array(
        'latitude'  =>  $_GET['data']['latitude'], 
        'longitude' =>  $_GET['data']['longitude']
      ));
      
      //  save data to table
      $table_name = $wpdb->prefix . "geoIpLocation";
      $wpdb->query("INSERT INTO $table_name (ip, location) VALUES ('{$_SERVER['REMOTE_ADDR']}', GeomFromText('POINT({$_GET['data']['latitude']} {$_GET['data']['longitude']})'))");
    }
    
    exit('SUCCEED');
  }
  
  public static function addGeoLocationMetaTag($param = array()) {
    SessionHandler::Init();
    if(false !== ($locationInfo = SessionHandler::Get('location'))) {
    echo '<meta name="geo.position" content="'.$locationInfo['latitude'].';'.$locationInfo['longitude'].'" />
          <meta name="ICBM" content="'.$locationInfo['latitude'].', '.$locationInfo['longitude'].'" />';
    }
    
    echo '<meta name="places-poweredby" content="Techunits" />';
  }
  
  public static function addShareLocationScript() {
    //  include wordpress default jquery
    wp_enqueue_script('jquery');
    
    SessionHandler::Init();
    
    $html = '';
    if(false !== ($locationInfo = SessionHandler::Get('location'))) {
      $html .=  '<script type="text/javascript">
                  var geolocationObj = new Object;
                  geolocationObj.random = '.rand().';
                  geolocationObj.latitude = '.$locationInfo['latitude'].';
                  geolocationObj.longitude = '.$locationInfo['longitude'].';
                </script>';
    }
    
    $html .= '<script type="text/javascript">
              function handleGeoLocationError() {
                return false;
              }
              
              
              function setCurrentGeoLocation(position) {
                var ajaxurl = \''.admin_url('admin-ajax.php').'\';
                var locationData = {
		              latitude: position.coords.latitude,
		              longitude: position.coords.longitude
	              };
                jQuery.get(ajaxurl, {
                  data: locationData,
                  action: \'saveLocationInfo\',
                },
                function(response) {
                  console.log(response);
		              //  alert("Got this from the server: " + response);
	              });
              }
              
              if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setCurrentGeoLocation, handleGeoLocationError, { 
                    enableHighAccuracy: true, 
                    timeout: 10 * 1000 * 1000, 
                    maximumAge: 86400
                  }
                );
              }
            </script>';
            
    echo $html;
  }
}

