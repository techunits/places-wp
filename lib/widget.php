<?php

class Trivian_Widget_WP {
  function manageSettings() {
    $data = get_option('trivian_widget');
    echo '<p><label>Widget Button Heading <input name="trivian_widget_title" type="text" value="'.$data['title'].'" /></label></p>';
    echo '<p><label>Trivian GameId <input name="trivian_widget_gameid" type="text" value="'.$data['gameid'].'" /></label></p>';
    
    //  save data
    if(isset($_POST['trivian_widget_gameid'])){
      $data['title'] = attribute_escape($_POST['trivian_widget_title']);
      $data['gameid'] = attribute_escape($_POST['trivian_widget_gameid']);
      update_option('trivian_widget', $data);
    }
  }
  
  function displayWidget($args){
    $data = get_option('trivian_widget');
    echo '<div class="trivianWidgetLaunch">';
    echo '<!-- Trivian Widget: Start  -->
          <script type="text/javascript" charset="utf-8">
            var trivianWidgetOptions = new Object;
            trivianWidgetOptions.gameId = \''.$data['gameid'].'\';
            document.write(unescape("%3Cscript src=\'http://widget.trivian.com/js/tlib.js\' type=\'text/javascript\'%3E%3C/script%3E"));
            document.write(unescape("%3Cscript src=\'http://widget.trivian.com/js/v1.js\' type=\'text/javascript\'%3E%3C/script%3E"));
          </script>
          <!-- Trivian Widget: End  -->';
    echo '</div>';
    return true;
  }
  
  function register() {
    register_sidebar_widget('Trivian Widget', array('Trivian_Widget_WP', 'displayWidget'));
    register_widget_control('Trivian Widget', array('Trivian_Widget_WP', 'manageSettings'));
  }
}
