<?php

/**
 * @package map_shop
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
*/

    chdir('../');
    require_once('includes/application_top.php');
    if (!isset($_SESSION['admin_id'])) {
      if (!(basename($PHP_SELF) == FILENAME_PASSWORD_FORGOTTEN . '.php')) {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }
    }
    
    function checkColumn2($table, $colname, $type, $index=false){
        global $r;
        $tmp = checkColumn($table, $colname, $type, $index);
        $r[$table][$colname] = $tmp['col'];
    }

  $r = array();
  // CUSTOMERS
  checkColumn2(TABLE_CUSTOMERS, 'termpayment', "VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'Zahlungsbedingung'");
  checkColumn2(TABLE_CUSTOMERS, 'vendornumber', "VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'lieferantennummer'");
  checkColumn2(TABLE_CUSTOMERS, 'taxid', "VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'Steuernummer'");
  checkColumn2(TABLE_CUSTOMERS, 'uid', "VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'UID'");
  checkColumn2(TABLE_CUSTOMERS, 'EORI', "VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'EORI'");
  
  // ORDERS
  checkColumn2(TABLE_ORDERS, 'delivery_date', "DATE NOT NULL COMMENT 'versanddatum'");
  checkColumn2(TABLE_ORDERS, 'delivery_time', "TIME NOT NULL COMMENT 'versandzeit'");
  checkColumn2(TABLE_ORDERS, 'EORI', "VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'EORI'");
  checkColumn2(TABLE_ORDERS, 'ordernumberextern', "VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'kundenbestellnummer'");
  
  // ORDERS_PRODUCTS
  checkColumn2(TABLE_ORDERS_PRODUCTS, 'customs_tariff_number', "INT( 10 ) NOT NULL COMMENT 'Zolltarifnummer'");
  checkColumn2(TABLE_ORDERS_PRODUCTS, 'origin', "VARCHAR( 3 ) NOT NULL");
  checkColumn2(TABLE_ORDERS_PRODUCTS, 'modelF', "VARCHAR( 32 ) NOT NULL");
  
  // PRODUCTS
  checkColumn2(TABLE_PRODUCTS, 'customs_tariff_number', "INT( 10 ) NOT NULL COMMENT 'Zolltarifnummer'");
  checkColumn2(TABLE_PRODUCTS, 'origin', "VARCHAR( 3 ) NOT NULL");
  checkColumn2(TABLE_PRODUCTS, 'modelF', "VARCHAR( 32 ) NOT NULL");
  
  // display changes
  rldp($r, 'TAB CHANGES');

  