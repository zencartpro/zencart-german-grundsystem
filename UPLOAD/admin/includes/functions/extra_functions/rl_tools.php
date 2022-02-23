<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: rl_tools.php 2022-02-23 21:28:16Z webchills $
 */
 
function getProdTypeLangArr($fields){
    global $db;  
    $key = $fields['configuration_key'] ?? '';
    $lang['configuration_title'] = $fields['configuration_title'] ?? '';
    $lang['configuration_description'] = $fields['configuration_description'] ?? '';   
    $sql = "SELECT configuration_title, configuration_description
                            FROM " . TABLE_PRODUCT_TYPE_LAYOUT_LANGUAGE . "
                            WHERE configuration_key = :configurationKey AND languages_id = :languagesID";
    $sql = $db->bindVars($sql, ':configurationKey', $key, 'string');
    $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
    $res = $db->Execute($sql);   
    if(!$res->EOF){
        $lang =  $res->fields;
    }
    return $lang;  
}


function rldp($call, $cname = 'NIX', $show = true)
{
     if($show){
         echo '<br />' . $cname . ":<pre>";
         if (!is_array($call)){
             $call = htmlspecialchars($call);
             }
         print_r($call);
         if (is_array($call)){
             reset($call);
             }
         echo "</pre><hr></hr>";
         }
    }

