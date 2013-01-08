<?php

class SessionHandler {

  /**
    * Set Value for a Session Key
   */
  public static function Set($key, $value) {
    $_SESSION[$key] = $value;
  }

  /**
    * Get Value for a Session Key
   */
  public static function Get($key) {
    if(isset($_SESSION[$key])) {
      return($_SESSION[$key]);
    }
    return false;
  }

  /**
    * Destroy a Session Key
   */
  public static function Kill($key) {
    if(isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
      return true;
    }
    return false;
  }

  /**
    * Start a New Session
   */
  public static function Init() {
    ini_set('session.gc_maxlifetime', 32000000);
    session_set_cookie_params(320000000);
    session_cache_expire(1);
    @session_start();
    if('undefined' == session_id()) {
      session_regenerate_id();
    }
  }

  /**
    * Reload Session with New SessionID
   */
  public static function Reload($session_id) {
    session_id($session_id);
    session_write_close();
    @session_start();
  }
  
}
