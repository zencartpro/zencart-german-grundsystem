<?php
  function getOrtDatum(){
      if($_SESSION['language']){
          $ret = 'Wien, ' . date(DATE_FORMAT);
      } else {
          $ret = 'Vienna, ' .date(DATE_FORMAT);
      }
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
  