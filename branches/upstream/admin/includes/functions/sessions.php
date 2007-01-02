<?php
/**
 * functions/sessions.php
 * Session functions
 *
 * @package functions
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sessions.php 5240 2006-12-14 05:25:18Z ajeh $
 */

  if (STORE_SESSIONS == 'db') {
    if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
      $SESS_LIFE = 1440;
    }

    function _sess_open($save_path, $session_name) {
      return true;
    }

    function _sess_close() {
      return true;
    }

    function _sess_read($key) {
      global $db;
      $value = $db->Execute("select value
                             from " . TABLE_SESSIONS . "
                             where sesskey = '" . zen_db_input($key) . "'
                             and expiry > '" . time() . "'");

      if ($value->fields['value']) {
        return $value->fields['value'];
      }

      return false;
    }

    function _sess_write($key, $val) {
      global $SESS_LIFE, $db;
      if (!is_object($db)) {
        //PHP 5.2.0 bug workaround ...
        $db = new queryFactory();
        $db->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
      }

      $expiry = time() + $SESS_LIFE;
      $value = $val;

      $total = $db->Execute("select count(*) as total
                             from " . TABLE_SESSIONS . "
                             where sesskey = '" . zen_db_input($key) . "'");

      if ($total->fields['total'] > 0) {
        return $db->Execute("update " . TABLE_SESSIONS . "
                             set expiry = '" . zen_db_input($expiry) . "',
                                 value = '" . zen_db_input($value) . "'
                             where sesskey = '" . zen_db_input($key) . "'");
      } else {
        return $db->Execute("insert into " . TABLE_SESSIONS . "
                             values ('" . zen_db_input($key) . "', '" . zen_db_input($expiry) . "',
                                     '" . zen_db_input($value) . "')");
      }
    }

    function _sess_destroy($key) {
      global $db;
      return $db->Execute("delete from " . TABLE_SESSIONS . "
                           where sesskey = '" . zen_db_input($key) . "'");
    }

    function _sess_gc($maxlifetime) {
      global $db;
      $db->Execute("delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'");

      return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
  }

  function zen_session_start() {
    return session_start();
  }

  function zen_session_register($variable) {
    return session_register($variable);
  }

  function zen_session_is_registered($variable) {
    return session_is_registered($variable);
  }

  function zen_session_unregister($variable) {
    return session_unregister($variable);
  }

  function zen_session_id($sessid = '') {
    if ($sessid != '') {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function zen_session_name($name = '') {
    if ($name != '') {
      return session_name($name);
    } else {
      return session_name();
    }
  }

  function zen_session_close() {
    if (function_exists('session_close')) {
      return session_close();
    }
  }

  function zen_session_destroy() {
    return session_destroy();
  }

  function zen_session_save_path($path = '') {
    if ($path != '') {
      return session_save_path($path);
    } else {
      return session_save_path();
    }
  }
?>