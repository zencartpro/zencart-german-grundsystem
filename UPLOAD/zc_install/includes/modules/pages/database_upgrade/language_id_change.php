<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: language_id_change.php 731 2011-08-09 19:15:09Z hugo13 $
//

 function changeLanguageID($dbx, $from, $fromS, $to, $create = true){
     $mnl = false;
     $lang = split("'", $from);
     $dbx = new queryFactory;
     $dbx -> Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

     $sql = "SELECT * from " . DB_PREFIX . "languages WHERE name IN($from) ORDER by languages_id";
     $result = $dbx -> Execute($sql);
     if($result -> RecordCount() == 0 && !$create){
         return;
         }
     if($result -> RecordCount() == 0 && $create){
         $sql = "INSERT INTO  " . DB_PREFIX . "languages VALUES ('','" . $lang[1] . "','" . $fromS . "','icon.gif','" . $lang[1] . "',20); ";
         $resultLanguage = $dbx -> Execute($sql);
         $sql = "SELECT * from " . DB_PREFIX . "languages WHERE name IN($from) ORDER by languages_id";
         $result = $dbx -> Execute($sql);
         $mnl = true;
         }
     # $sql = "ALTER TABLE " . DB_PREFIX . "configuration_group ADD language_id INT( 11 ) DEFAULT '1' NOT NULL AFTER configuration_group_id ;";
    # $resultSQL = $dbx -> Execute($sql);
    while (!$result -> EOF){
         if($result -> fields['languages_id'] != $to){ // beginn change
             $changeTable = array(
                '0' => array('table' => DB_PREFIX . 'categories_description', 's' => ''),
                 # '1' => array('table' => DB_PREFIX . 'configuration_group', 's' => ''),
                '2' => array('table' => DB_PREFIX . 'orders_status', 's' => ''),
                 '3' => array('table' => DB_PREFIX . 'products_description', 's' => ''),
                 '4' => array('table' => DB_PREFIX . 'products_options', 's' => ''),
                 '5' => array('table' => DB_PREFIX . 'products_options_values', 's' => ''),
                
                 '6' => array('table' => DB_PREFIX . 'manufacturers_info', 's' => 's'),
                 '7' => array('table' => DB_PREFIX . 'record_artists_info', 's' => 's'),
                 '8' => array('table' => DB_PREFIX . 'record_company_info', 's' => 's'),
                 '9' => array('table' => DB_PREFIX . 'reviews_description', 's' => 's'),
                 '10' => array('table' => DB_PREFIX . 'languages', 's' => 's')
                );
             # print_r($changeTable);
            foreach($changeTable as $key => $value){
                 $query = "UPDATE " . $value['table'] . " SET language" . $value['s'] . "_id = '" . $to . "' WHERE language" . $value['s'] . "_id = '" . $result -> fields['languages_id'] . "';" ;
                 # echo($query . "<br />");
                $result2 = $dbx -> Execute($query);
                 }
             }
         $result -> MoveNext();
         }
     if($mnl == true){
         makeNewLanguage($dbx, $to, $lang[1], $fromS, 'icon.gif', $lang[1]);
         }
     }

 function makeNewLanguage($db, $insert_id = 1, $name = 'English', $code = 'en', $image = 'icon.gif', $directory = 'english', $sortorder = 100){
     include('../includes/database_tables.php');
     $check = $db -> Execute("select * from " . TABLE_LANGUAGES . " where code = '" . $code . "'");
     if ($check -> RecordCount() > 0){
         $lID = getDefaultLanguageID($db);
         // create additional categories_description records
        $categories = $db -> Execute("select c.categories_id, cd.categories_name,
                                    categories_description
                                      from " . TABLE_CATEGORIES . " c
                                      left join " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                      on c.categories_id = cd.categories_id
                                      where cd.language_id = '" . (int)$lID . "'");
        
         while (!$categories -> EOF){
             $db -> Execute("insert into " . TABLE_CATEGORIES_DESCRIPTION . "
                          (categories_id, language_id, categories_name,
                          categories_description)
                          values ('" . (int)$categories -> fields['categories_id'] . "', '" . (int)$insert_id . "',
                                  '" . zen_db_input($categories -> fields['categories_name']) . "',
                                  '" . zen_db_input($categories -> fields['categories_description']) . "')");
             $categories -> MoveNext();
             }
        
         // create additional products_description records
        $products = $db -> Execute("select p.products_id, pd.products_name, pd.products_description,
                                           pd.products_url
                                    from " . TABLE_PRODUCTS . " p
                                    left join " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                    on p.products_id = pd.products_id
                                    where pd.language_id = '" . (int)$lID . "'");
        
         while (!$products -> EOF){
             $db -> Execute("insert into " . TABLE_PRODUCTS_DESCRIPTION . "
                        (products_id, language_id, products_name, products_description, products_url)
                        values ('" . (int)$products -> fields['products_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($products -> fields['products_name']) . "',
                                '" . zen_db_input($products -> fields['products_description']) . "',
                                '" . zen_db_input($products -> fields['products_url']) . "')");
             $products -> MoveNext();
             }
        
         // create additional products_options records
         $del = "DELETE FROM " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$insert_id . "'";
         $db -> Execute($del);
        $products_options = $db -> Execute("select products_options_id, products_options_name,
                              products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size,
                              products_options_images_per_row, products_options_images_style
                                           from " . TABLE_PRODUCTS_OPTIONS . "
                                           where language_id = '" . (int)$lID . "'");
        
         while (!$products_options -> EOF){
             $db -> Execute("insert into " . TABLE_PRODUCTS_OPTIONS . "
                                    (products_options_id, language_id, products_options_name,
                                    products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style)
                                                            values ('" . (int)$products_options -> fields['products_options_id'] . "',
                                                                    '" . (int)$insert_id . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_name']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_sort_order']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_type']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_length']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_comment']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_size']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_images_per_row']) . "',
                                                                    '" . zen_db_input($products_options -> fields['products_options_images_style']) . "')");
            
             $products_options -> MoveNext();
             }
        
         // create additional products_options_values records
        $products_options_values = $db -> Execute("select products_options_values_id,
                                                                products_options_values_name, products_options_values_sort_order
                                                   from " . TABLE_PRODUCTS_OPTIONS_VALUES . "
                                                   where language_id = '" . (int)$lID . "'");
        
         while (!$products_options_values -> EOF){
             $db -> Execute("replace into " . TABLE_PRODUCTS_OPTIONS_VALUES . "
                        (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order)
                                                values ('" . (int)$products_options_values -> fields['products_options_values_id'] . "',
                                                                    '" . (int)$insert_id . "', '" . zen_db_input($products_options_values -> fields['products_options_values_name']) . "', '" . zen_db_input($products_options_values -> fields['products_options_values_sort_order']) . "')");
            
             $products_options_values -> MoveNext();
             }
        
         // create additional manufacturers_info records
        $manufacturers = $db -> Execute("select m.manufacturers_id, mi.manufacturers_url
                                               from " . TABLE_MANUFACTURERS . " m
                                                   left join " . TABLE_MANUFACTURERS_INFO . " mi
                                                   on m.manufacturers_id = mi.manufacturers_id
                                                   where mi.languages_id = '" . (int)$lID . "'");
        
         while (!$manufacturers -> EOF){
             $db -> Execute("insert into " . TABLE_MANUFACTURERS_INFO . "
                                    (manufacturers_id, languages_id, manufacturers_url)
                                                      values ('" . $manufacturers -> fields['manufacturers_id'] . "', '" . (int)$insert_id . "',
                                                              '" . zen_db_input($manufacturers -> fields['manufacturers_url']) . "')");
            
             $manufacturers -> MoveNext();
             }
        
         // create additional orders_status records
         $del = "DELETE FROM " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$insert_id . "'";
         $db -> Execute($del);
        $orders_status = $db -> Execute("select orders_status_id, orders_status_name
                                               from " . TABLE_ORDERS_STATUS . "
                                           where language_id = '" . (int)$lID . "'");
        
         while (!$orders_status -> EOF){
             $db -> Execute("insert into " . TABLE_ORDERS_STATUS . "
                                      (orders_status_id, language_id, orders_status_name)
                                                        values ('" . (int)$orders_status -> fields['orders_status_id'] . "',
                                                          '" . (int)$insert_id . "',
                                                          '" . zen_db_input($orders_status -> fields['orders_status_name']) . "')");
             $orders_status -> MoveNext();
             }
         if (isset($_POST['default']) && ($_POST['default'] == 'on')){
             $db -> Execute("update " . TABLE_CONFIGURATION . "
                               set configuration_value = '" . zen_db_input($code) . "'
                        where configuration_key = 'DEFAULT_LANGUAGE'");
             }
         }
     }
 function getDefaultLanguageID($db){
     $sql = "SELECT * FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_LANGUAGE'";
     $res = $db -> Execute($sql);
     $sql = "SELECT * FROM " . TABLE_LANGUAGES . " WHERE code='" . $res -> fields['configuration_value'] . "'";
     $res2 = $db -> Execute($sql);
     return $res2 -> fields['languages_id'];
     }
# function zen_db_input($string){
#     return addslashes($string);
#     }
 function isMultiLingual($db) {
    include('../includes/database_tables.php');
    $sql = "SHOW  TABLES  LIKE  '" . TABLE_CONFIGURATION_LANGUAGE . "'";
    $db = new queryFactory;
    $db -> Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");
    $res = $db -> Execute($sql);
    if($res -> RecordCount() == 0 ){
        return false;
    } else {
        return true;
    }
 }




 ?>
