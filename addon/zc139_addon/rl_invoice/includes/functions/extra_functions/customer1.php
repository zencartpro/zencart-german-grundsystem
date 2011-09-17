<?php
    // $Id$
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
         return $t;
    }