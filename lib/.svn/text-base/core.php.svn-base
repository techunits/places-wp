<?php

function trivian_widget_activation() {
  return true;
}

function trivian_widget_deactivation() {    
  return true;
}

//  add trivian notice to footer
function trivian_widget_footer_notice(){        
  echo '<div id="trivian-notice">Thank you for using <a href="http://www.trivian.com/home" title="Trivian - Social Trivia Quiz Gaming">Trivian</a>.</div>';
}

//  show trivian menu
function register_trivian_widget_menu_page() {
  add_menu_page('Trivian Widget - Social Trivia Quiz Gaming', 'Trivian Widget', 'add_users', TRIVIAN_WIDGET_DIR.'/welcome.php', '',   TRIVIAN_WIDGET_URL.'resources/images/favicon.png');
  //  add_menu_page('Trivian Widget - Social Trivia Quiz Gaming', 'Trivian Widget', 'add_users', '', 'trivian_menu_page',   MONGOLANTERN_URL.'resources/images/logo.png', 21);
}

//  show trivian widget
function trivian_widget_show($param) {
  //  extract wordpress shortcode paramters
  $param = shortcode_atts( array(
    'gameid'  =>  false
  ), $param);
  
  if(false === $param['gameid']) {
    return false;
  }
  else {
    $widgetUrl = 'https://widget.trivian.com/home?gameId='.$param['gameid'];
  }
  
  echo '<iframe style="width: 980px; height: 1000px;" border="0" src="'.$widgetUrl.'"></iframe>';
}
