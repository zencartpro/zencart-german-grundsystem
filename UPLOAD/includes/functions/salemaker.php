<?php
/**
 * salemaker functions
 *
 * @package functions
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: salemaker.php 729 2011-08-09 15:49:16Z hugo13 $
 */

////
// Set the status of a salemaker sale
  function zen_set_salemaker_status($sale_id, $status) {
    global $db;
    $sql = "update " . TABLE_SALEMAKER_SALES . "
            set sale_status = '" . (int)$status . "', sale_date_status_change = now()
            where sale_id = '" . (int)$sale_id . "'";

    return $db->Execute($sql);
   }

////
// Auto expire salemaker sales
  function zen_expire_salemaker() {
    global $db;

    $date_range = time();
    $zc_sale_date = date('Ymd', $date_range);

    $salemaker_query = "select sale_id
                       from " . TABLE_SALEMAKER_SALES . "
                       where sale_status = '1'
                       and ((" . $zc_sale_date . " >= sale_date_end and sale_date_end != '0001-01-01')
                       or (" . $zc_sale_date . " < sale_date_start and sale_date_start != '0001-01-01'))";

    $salemaker = $db->Execute($salemaker_query);

    if ($salemaker->RecordCount() > 0) {
      while (!$salemaker->EOF) {
        zen_set_salemaker_status($salemaker->fields['sale_id'], '0');
        zen_update_salemaker_product_prices($salemaker->fields['sale_id']);
        $salemaker->MoveNext();
      }
    }
  }

////
// Auto start salemaker sales
  function zen_start_salemaker() {
    global $db;

    $date_range = time();
    $zc_sale_date = date('Ymd', $date_range);

    $salemaker_query = "select sale_id
                       from " . TABLE_SALEMAKER_SALES . "
                       where sale_status = '0'
                       and (((sale_date_start <= " . $zc_sale_date . " and sale_date_start != '0001-01-01') and (sale_date_end > " . $zc_sale_date . "))
                       or ((sale_date_start <= " . $zc_sale_date . " and sale_date_start != '0001-01-01') and (sale_date_end = '0001-01-01'))
                       or (sale_date_start = '0001-01-01' and sale_date_end > " . $zc_sale_date . "))
                       ";

    $salemaker = $db->Execute($salemaker_query);

    if ($salemaker->RecordCount() > 0) {
      while (!$salemaker->EOF) {
        zen_set_salemaker_status($salemaker->fields['sale_id'], '1');
        zen_update_salemaker_product_prices($salemaker->fields['sale_id']);
        $salemaker->MoveNext();
      }
    }

// turn off salemaker sales if not active yet
    $salemaker_query = "select sale_id
                       from " . TABLE_SALEMAKER_SALES . "
                       where sale_status = '1'
                       and (" . $zc_sale_date . " < sale_date_start and sale_date_start != '0001-01-01')
                       ";

    $salemaker = $db->Execute($salemaker_query);

    if ($salemaker->RecordCount() > 0) {
      while (!$salemaker->EOF) {
        zen_set_salemaker_status($salemaker->fields['sale_id'], '0');
        zen_update_salemaker_product_prices($salemaker->fields['sale_id']);
        $salemaker->MoveNext();
      }
    }
  }
?>