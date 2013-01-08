<?php

class LocationHandler {
  public static function addGeoLocationMetaTag($param = array()) {
    SessionHandler::Init();
    /*foreach($param as $key  =>  $value) {
      
    }*/
    
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
                  geolocationObj.latitude = '.$locationInfo['latitude'].';
                  geolocationObj.longitude = '.$locationInfo['longitude'].';
                </script>';
    }
    
    $html .= '<script type="text/javascript">
              function handleGeoLocationError() {
                return false;
              }
              
              function setCurrentGeoLocation(position) {
                jQuery(function($) {
                  $.ajax({
                    url: "'.PLACES_WP_URL.'ajax/saveLocation.php?latitude="+position.coords.latitude+"&longitude="+position.coords.longitude,
                    cache: true,
                    async: true,
                    success: function(response) {
                      console.log(response);
                    }
                  });
                });
              }
              
              if(navigator.geolocation) {
                //if(null == geolocationObj.latitude || null == geolocationObj.longitude) {
                  navigator.geolocation.getCurrentPosition(setCurrentGeoLocation, handleGeoLocationError, { 
                      enableHighAccuracy: true, 
                      timeout: 10 * 1000 * 1000, 
                      maximumAge: 0 
                    }
                  );
                //}
              }
            </script>';
            
    echo $html;
  }
}

