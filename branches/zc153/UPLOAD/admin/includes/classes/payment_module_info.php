<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: payment_module_info.php 729 2014-02-08 15:49:16Z webchills $
 */
//


  class paymentModuleInfo {
    var $payment_code, $keys;

// class constructor
    function paymentModuleInfo($pmInfo_array) {
      global $db;
      $this->payment_code = $pmInfo_array['payment_code'];

      for ($i = 0, $n = sizeof($pmInfo_array) - 1; $i < $n; $i++) {
        $key_value = $db->Execute("select configuration_title, configuration_value,
                                          configuration_description
                                   from " . TABLE_CONFIGURATION . "
                                   where configuration_key = '" . $pmInfo_array[$i] . "'");

        $this->keys[$pmInfo_array[$i]]['title'] = $key_value->fields['configuration_title'];
        $this->keys[$pmInfo_array[$i]]['value'] = $key_value->fields['configuration_value'];
        $this->keys[$pmInfo_array[$i]]['description'] = $key_value->fields['configuration_description'];
      }
    }
  }
?>