<?php
/**
 * adresskorrektur functions
 *
 * @package functions
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: adresskorrektur.php 2016-08-15 09:49:16Z webchills $
 */

if(!function_exists('zen_field_exists')) {
    function zen_field_exists($table,$field) {
        global $db;
        $describe_query = $db -> Execute("describe $table");
        while (!$describe_query -> EOF) {
            if ($d_row["Field"] == "$field") {
                 return true;
            }
            $describe_query -> MoveNext();
        }

        return false;
    }
}

if(!function_exists('zen_html_quotes')) {
    function zen_html_quotes($string) {
        if(function_exists('zen_db_output'))
            return zen_db_output($string);
        return htmlspecialchars($string, ENT_COMPAT, CHARSET, TRUE);
    }
}

if(!function_exists('zen_html_unquote')) {
    function zen_html_unquote($string) {
        return htmlspecialchars_decode($string, ENT_COMPAT);
    }
}

function adresskorrektur_get_order_by_id($oID) {
    global $db, $order;

    // Retrieve the order
    $order = new order($oID);  

    return $order;
  }