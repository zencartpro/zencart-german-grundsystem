<?php
/**
 * @package worldpay_payment_module
 * @copyright Copyright Philip Clarke - http://exploitingIT.co.uk
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $ worldpay payment module version 2.0 $
 */
?>
<?php
define('TABLE_WORLDPAY_PAYMENTS', DB_PREFIX . 'worldpay_payments');

$sql = "SHOW TABLES LIKE '". TABLE_WORLDPAY_PAYMENTS ."'";
$prevDBSetup = $db->Execute($sql);

if($prevDBSetup->RecordCount()){

	$za_contents[] = array('text' => BOX_CUSTOMERS_WORLDPAY_RESPONSE, 'link' => zen_href_link(FILENAME_WORLDPAY_RESPONSE, '', 'NONSSL'));

}
?>