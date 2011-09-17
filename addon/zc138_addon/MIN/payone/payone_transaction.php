<?php
/**
*
* @package payment
* @copyright Copyright 2008 rainer langheiter, http://edv.langheiter.com
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
*
* Title: PAYONE
* $Id$
*/

  require('includes/application_top.php');

  function update_tx($data){
    global $db;
    $sql="SELECT * FROM po_transactions WHERE txid='".$data['txid']."'";
    $check_query = $db->Execute($sql);
    
    $result = mysql_query($sql) or die($sql."\n=>".mysql_error());

    if($check_query->RecordCount() > 0){
        $sql="UPDATE po_transactions SET memo='$x', status='".$data['txaction']."',failedcause='".$data['failedcause']."',failedcost='".$data['failedcost']."',balance='".$data['balance']."' WHERE txid='".$data['txid']."'";
        $result = mysql_query($sql) or die($sql."\n=>".mysql_error());
        $oID = $check_query->fields['orders_id'];
        $sta = 'Status: ' . $data['txaction'] . '  // failedcause: ' . $data['failedcause'] . '  // failedcost: ' .$data['failedcost'] . '  // balance: ' . $data['balance'];
        $sql_data_array = array('orders_id' => (int)$oID,
                                'orders_status_id' => '2',
                                'date_added' => 'now()',
                                'comments' => $sta,
                                'customer_notified' => false
                             );                                            
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
    }
    else {
        $sql="INSERT INTO po_transactions (`txid`, `memo`, `param`, `po_userid`,`amount`, `clearingtype`, `txtime`, `portalid`, `productid`, `aid`, `status`, `po_accessid`, `failedcause`, `balance`) VALUES ('".$data['txid']."', '$x', '".$data['param']."', '".$data['userid']."', '".$data['price']."', '".$data['clearingtype']."', '".$data['txtime']."', '".$data['portalid']."', '".$data['productid']."', '".$data['aid']."', '".$data['txaction']."', '".$data['accessid']."', '".$data['failedcause']."', '".$data['balance']."');";
        $result = mysql_query($sql) or die($sql."\n=>".mysql_error());
    }
    
}

$data = Array();
$data['param'] = 'NIX';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $request=$_POST;
} else {
    $request=$_GET;
}

$requestData = array_merge($data, $request);

update_tx($requestData);
echo "TSOK";


