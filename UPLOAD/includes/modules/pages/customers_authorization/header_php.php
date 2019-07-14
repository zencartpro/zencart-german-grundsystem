<?php
/**
 * Customer Authorization 
 *
 * @package page
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 729 2011-08-09 15:49:16Z hugo13 $
 */


$sql = "SELECT customers_authorization 
        FROM " . TABLE_CUSTOMERS . " 
        WHERE customers_id = :customersID";

$sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
$check_customer = $db->Execute($sql);

$_SESSION['customers_authorization'] = $check_customer->fields['customers_authorization'];

if ($_SESSION['customers_authorization'] != '1') {
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

if (CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true') $flag_disable_right = true;
if (CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true') $flag_disable_left = true;
if (CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true') $flag_disable_footer = true;
if (CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true') $flag_disable_header = true;

?>