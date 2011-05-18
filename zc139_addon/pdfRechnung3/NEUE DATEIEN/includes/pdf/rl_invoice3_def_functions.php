<?php
/**
 * 
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/ 
 * @version $Id$
 */

  function getOrtDatum(){
      if($_SESSION['language']){
          $ret = 'Wien, ' . date(DATE_FORMAT);
      } else {
          $ret = 'Vienna, ' . date(DATE_FORMAT);
      }
      $ret = RL_INVOICE3_CITY2 . date(DATE_FORMAT); 
      return $ret;
  }
  
  function getDBFieldValue($orderID){
      global $db;
      $sql = 'SELECT products_model FROM ' . TABLE_ORDERS_PRODUCTS . ' WHERE orders_id=' . $orderID;
      $res = $db->execute($sql);
      $ret = 'Artikelnummern: ';
      while (!$res->EOF){
        $ret .= $res->fields['products_model'] . '  ';
        $res->MoveNext();
      }
      return $ret;
  }  
  
  function getCustomerFieldValue($customerID, $fieldName){
      global $db;
      $sql = 'SELECT ' . $fieldName . ' FROM ' . TABLE_CUSTOMERS . ' WHERE customers_id=' . $customerID;
      $res = $db->execute($sql);
      $ret = $sql . '::konnte kunden nicht finden';
      while (!$res->EOF){
        $ret = $res->fields[$fieldName];
        $res->MoveNext();
      }
      return $ret;
  }  
  
  function getInvNr($oID){
      return ENTRY_ORDER_ID . sprintf("%s%05d", RL_INVOICE3_ORDER_ID_PREFIX, $oID);
  }
  
  function getInvDate($oID){
      return zen_date_short(date("Y-m-d H:i", time()));
  }
  
  function getPos($glob){
	$glob->lfd += 10; 
      return $glob->lfd ;
  }
  
  function getProdDetailWidthE($pdf){
      return $pdf->getProdDetailWidth();
  }
  