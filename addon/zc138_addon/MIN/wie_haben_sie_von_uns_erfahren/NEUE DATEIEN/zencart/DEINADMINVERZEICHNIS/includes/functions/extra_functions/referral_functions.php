<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: general.php 277 2004-09-10 23:03:52Z wilt $
//

  
  // rmh referral
  function zen_get_sources_name($source_id, $customers_id) {
    global $db;

    if ($source_id == '9999') {
      $sources_query = "select sources_other_name as sources_name from " . TABLE_SOURCES_OTHER . " where customers_id = '" . (int)$customers_id . "'";
    } else {
      $sources_query = "select sources_name from " . TABLE_SOURCES . " where sources_id = '" . (int)$source_id . "'";
    }

    $sources=$db->Execute($sources_query);

    if ($sources->RecordCount()<= 0) {
      if ($source_id == '9999') {
        return TEXT_OTHER;
      } else {
        return TEXT_NONE;
     }
    } else {
      return $sources->fields['sources_name'];
    }

  }

?>
