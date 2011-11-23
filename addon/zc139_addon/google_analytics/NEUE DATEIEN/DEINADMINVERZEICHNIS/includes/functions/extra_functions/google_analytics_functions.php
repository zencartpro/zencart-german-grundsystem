<?php
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Portions Copyright (c) 2003 osCommerce                               |
// | Portions Copyright (c) 2004 zen-cart   							  |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | file: google_analytics_functions.php, 2008/01/09					  |
// | Functions for creating the dropdown box of Languages				  |
// | Author: Eric Leuenberger - http://www.ZenCartOptimization.com	      |
// +----------------------------------------------------------------------+
//
  function zen_cfg_pull_down_google_languages($languages_id, $key = '') {
    global $db;
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
    $google_languages = $db->Execute("select languages_id, name, code from " . TABLE_GOOGLE_ANALYTICS_LANGUAGES . " order by sort_order");
    $google_languages_array = array(array('id' => '0', 'text' => TEXT_DEFAULT));

    while (!$google_languages->EOF) {

      $google_languages_array[] = array('id' => $google_languages->fields['code'],
                                'text' => $google_languages->fields['name']);

								
      $google_languages->MoveNext();
    }

    return zen_draw_pull_down_menu($name, $google_languages_array, $languages_id);
  }
?>
