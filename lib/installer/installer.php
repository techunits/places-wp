<?php

class PlacesWPInstaller {
  public static function createDatabaseSchema() {
    global $wpdb;
    add_option("places_wp_db_version", PLACES_WP_VERSION);
    
    //  create new tables as required
    $table_name = $wpdb->prefix . "geoIpLocation";
    $sql =  "CREATE TABLE $table_name (
              `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
              `ip` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
              `location` Point NOT NULL,
              `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              `status` BINARY(1) DEFAULT 1,
              PRIMARY KEY  (`id`),
              UNIQUE KEY  `ugl_ip` (`ip`),
              SPATIAL INDEX (`location`)
            );";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    //  insert an dummy data
    $wpdb->query("INSERT INTO $table_name (ip, location) VALUES ('121.246.189.222', GeomFromText('POINT(22.30 88.67)'))");

    return true;
  }
  
  public static function removeDatabaseSchema() {
    global $wpdb;
    delete_option("places_wp_db_version");
    
    //  create new tables as required
    $table_name = $wpdb->prefix . "geoIpLocation";
    $wpdb->query("DROP TABLE $table_name");
    
    return false;
  }
}
