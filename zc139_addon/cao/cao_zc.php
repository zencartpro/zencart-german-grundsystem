<?php

/**
 * CAO-Faktura für Windows Version 1.0                                                     *
 *       Copyright (C) 2003 Jan Pokrandt / Jan@JP-SOFT.de                                        *
 * 
 *       This program is free software; you can redistribute it and/or                           *
 *       modify it under the terms of the GNU General Public License                             *
 *       as published by the Free Software Foundation; either version 2                          *
 *       of the License, or any later version.                                                   *
 * 
 *       This program is distributed in the hope that it will be useful,                         *
 *       but WITHOUT ANY WARRANTY; without even the implied warranty of                          *
 *       MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                           *
 *       GNU General Public License for more details.                                            *
 * 
 *       You should have received a copy of the GNU General Public License                       *
 *       along with this program; if not, write to the Free Software                             *
 *       Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 */


 
chdir('../');
// require('cao_config.php');
require_once('includes/application_top.php');
require('cao_zen_helper.php');

define('DIR_WS_FUNCTIONS', '../includes/functions/');
define('DIR_WS_INCLUDES', '../includes/');
require_once(DIR_WS_INCLUDES . 'classes/upload.php');

$cao = new cao();
    $sw = array_merge($_GET, $_POST);
    $action = $sw['action'];
    $cao->action = $action;
    $cao->writeXML(print_r($sw, true), 'action');


if (!$cao->caoLogin()) {
    $cao->writeXML('LOGIN_ERROR !!!!!');
    exit;
} else {
    $cao->writeXML('LOGIN_OK', 'login');
    
    switch ($action) {
        case 'products_image_upload':
            $x = print_r($_FILES, true);
            $cao->writeXML($x, 'products_image_upload');
        
            $products_image = new upload('products_image');
            #$products_image = 'abc21';
            #die(print_r($products_image, true));
            #$cao->writeXML(print_r($products_image, true), 'products_image_upload');
            $cao->ProductsImageUpload ();
            #die('::'.__LINE__.$action);            
            exit;

        case 'version': // Ausgabe Scriptversion
            $cao->SendScriptVersion ();
            exit;

        case 'products_export':
            $cao->SendProducts();
            exit;

        case 'categories_export':
            $cao->SendCategories ();
            exit;

        case 'manufacturers_export':
            $cao->SendManufacturers ();
            exit;

        case 'customers_export':
            $cao->SendCustomers();
            exit;

        case 'orders_export':
            $cao->SendOrders();
            exit;

        case 'customers_newsletter_export':
            $cao->SendCustomersNewsletter ();
            exit;

        case 'config_export':
            ###SendShopConfig ();  // no never
            exit;

        case 'update_tables':
            UpdateTables ();
            exit;

        case 'send_log':
            ###SendLog ();
            exit;

        case 'products_update':
            $cao->ProductsUpdate();
            exit;

        case 'manufacturers_update':
            $cao->ManufacturersUpdate ();
            exit;

        case 'manufacturers_image_upload':
            $cao->ManufacturersImageUpload ();
            exit;

        case 'categories_image_upload':
            CategoriesImageUpload ();
            exit;

        case 'products_image_upload':
            $products_image = new upload('products_image');
            die('107');
            $cao->writeXML($products_image, 'products_image_upload');
            
            $cao->ProductsImageUpload ();
            exit;

        case 'products_image_upload_med':
            ProductsImageUploadMed ();
            exit;

        case 'products_image_upload_large':
            ProductsImageUploadLarge ();
            exit;

        case 'manufacturers_erase':
            ManufacturersErase ();
            exit;

        case 'products_erase':
            ProductsErase ();
            exit;

        case 'products_specialprice_update':
            ProductsSpecialPriceUpdate ();
            exit;

        case 'products_specialprice_erase':
            ProductsSpecialPriceErase ();
            exit;

        case 'categories_update':
            CategoriesUpdate ();
            exit;

        case 'categories_erase':
            CategoriesErase ();
            exit;

        case 'prod2cat_update':
            Prod2CatUpdate ();
            exit;

        case 'prod2cat_erase':
            Prod2CatErase ();
            exit;

        case 'order_update':
            OrderUpdate ();
            exit;

        case 'customers_update':
            CustomersUpdate ();
            exit;

        case 'customers_erase':
            CustomersErase ();
            exit;

        case 'xsell_update':
            XsellUpdate ();
            exit;

        case 'xsell_erase':
            XsellErase ();
            exit;

        default :
            ShowHTMLMenu ();
            exit; 
            // #########################################
            
    } 
} 

