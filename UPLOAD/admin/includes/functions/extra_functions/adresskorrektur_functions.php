<?php
/**
 * adresskorrektur functions
 *
 * Zen Cart German Specific
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: adresskorrektur_functions.php 2023-11-03 18:25:16Z webchills $
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

function adresskorrektur_get_order_by_id($oID) {
    global $db, $order;

    // Retrieve the order
    $order = new order($oID);  

    return $order;
  }