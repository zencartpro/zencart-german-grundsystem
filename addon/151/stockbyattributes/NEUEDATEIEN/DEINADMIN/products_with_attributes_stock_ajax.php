<?php
/**
 * @package attrib for ajax
 * @copyright Copyright 2006 rainer langheiter, http://edv.langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: products_with_attributes_stock_ajax.php 389 2008-11-14 16:02:14Z hugo13 $
 */
 
require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
require(DIR_WS_CLASSES . 'products_with_attributes_stock.php');
include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/products_with_attributes_stock.php'); 

$stock = new products_with_attributes_stock;
    if($_GET['save']==1){
        $x = $stock->saveAttrib();
        zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));
    } else {
        $x = $stock->displayFilteredRows();
        print_r($x);
        //zen_redirect(zen_href_link(FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, '', 'NONSSL'));
    }


function saveAttrib(){
    global $db;
    foreach ($_POST as $key => $value) {
        $id = intval(str_replace('stockid-', '', $key));
        if($id > 0){
            $sql = "UPDATE products_with_attributes_stock SET quantity = '$value' WHERE products_with_attributes_stock.stock_id =$id LIMIT 1";
            $db->execute($sql);
        }
    
    }
    return 'OK';  
}
//eof