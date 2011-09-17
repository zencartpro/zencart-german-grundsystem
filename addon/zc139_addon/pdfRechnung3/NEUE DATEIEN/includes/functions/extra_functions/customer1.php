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

    function addCustomerFields(){
        $data_array = array();
        $data_array = array(
            array('fieldName'=>'vendornumber', 'value'=>zen_db_prepare_input($_POST['vendornumber']), 'type'=>'string'),
            array('fieldName'=>'taxid', 'value'=>zen_db_prepare_input($_POST['taxid']), 'type'=>'string'),
            array('fieldName'=>'EORI', 'value'=>zen_db_prepare_input($_POST['EORI']), 'type'=>'string'),
            array('fieldName'=>'uid', 'value'=>zen_db_prepare_input($_POST['uid']), 'type'=>'string')
        );
        return $data_array;
    }

    function checkDelivery(){
        if (zen_not_null($_POST['delivery_date'])) {
          $_SESSION['delivery_date'] = zen_db_prepare_input($_POST['delivery_date']);
        }
        if (zen_not_null($_POST['delivery_time'])) {
          $_SESSION['delivery_time'] = zen_db_prepare_input($_POST['delivery_time']);
        }
        if (zen_not_null($_POST['ordernumberextern'])) {
          $_SESSION['ordernumberextern'] = zen_db_prepare_input($_POST['ordernumberextern']);
        }
    }
    
    function setDelivery(){
         $t = array('delivery_date'     => $_SESSION['delivery_date'],   
                    'delivery_time'     => $_SESSION['delivery_time'],   
                    'ordernumberextern' => $_SESSION['ordernumberextern'],   
                    );
         $t = array();
         return $t;
    }