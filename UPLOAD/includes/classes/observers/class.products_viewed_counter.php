<?php
/**
 * @package plugins
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: aclass.products_viewed_counter.php 1 2019-07-22 08:13:51Z webchills $ 
 */

class products_viewed_counter extends base {

  function __construct() {
    $this->attach($this, array('NOTIFY_PRODUCT_VIEWS_HIT_INCREMENTOR'));
  }

  function update(&$class, $eventID, $paramsArray = array())
  {
    if ($eventID == 'NOTIFY_PRODUCT_VIEWS_HIT_INCREMENTOR')
    {
      if (defined('LEGACY_PRODUCTS_VIEWED_COUNTER') && LEGACY_PRODUCTS_VIEWED_COUNTER == 'on')
      {
        global $db;
        $sql = "update " . TABLE_PRODUCTS_DESCRIPTION . "
                set        products_viewed = products_viewed+1
                where      products_id = '" . (int)$paramsArray . "'
                and        language_id = '" . (int)$_SESSION['languages_id'] . "'";
        $res = $db->Execute($sql);
      }
    }
  }
}
