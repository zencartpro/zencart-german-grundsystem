<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: object_info.php 729 2014-02-08 15:49:16Z webchills $
 */
//

  class objectInfo {

// class constructor
    function objectInfo($object_array) {
//this line should be added, but should be tested first:
//      if (!is_array($object_array)) return;
      reset($object_array);
      while (list($key, $value) = each($object_array)) {
        $this->$key = zen_db_prepare_input($value);
      }
    }
  }
?>
