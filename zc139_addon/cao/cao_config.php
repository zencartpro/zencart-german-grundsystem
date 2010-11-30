<?php
/**
* $Id$
*/
$debug = true;
/* log-level == welche aktion soll geloggt werden */
$debug_types = array('all' => 0,
    'action' => 1,
    'SendScriptVersion' => 0,
    'SendProducts' => 0,
    'SendCategories' => 0,
    'SendManufacturers' => 0,
    'SendOrders' => 0, 
    'SendCustomersNewsletter' => 1, 
    // updateCao<>shop
    'ProductsUpdate' => 0,
    'SendCustomers' => 1,
    'products_image_upload' => 1,
    

    'artikel' => 1,
    'katalog' => 1,
    'hersteller' => 1,
    'kunden' => 1,
    'bestellungen' => 1,
    'update' => 1,
    'transfer' => 1,
    'login' => 1,
    'upload' => 0,
    'im' => 1,
    'logon' => 1,
    'action' => 1,
    'xml' => 1,
    );
$minModel = 25; // länge der artikelnummer

define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
// path to ORIGINAL; must exist
define('ORIGINAL', '');
define('ORIGINAL', 'original/');
define('USE_IMAGERESIZE', false); // bei false werden keine unterschiedlichen bildgröössen erzeugt
define('DIR_FS_IMAGE_MAGICK', '/usr/bin/');

define('CHANGE2PRODUCT_MODELL', false); // ändert bildnamen auf artikelnummer und füllt mit __ auf 
 
// bildgrössen & folder
$sizes = array(
            'small' => array('width' => '60', 'height' => '40', 'folder' => ''),
            'medium' => array('width' => '120', 'height' => '80', 'folder' => 'medium/'),
            'large' => array('width' => '800', 'height' => '600', 'folder' => 'large/'),
            'verylarge' => array('width' => '1024', 'height' => '800', 'folder' => 'verylarge/'),
    );

/**
* nur die userdefined-fields 1..5 werden von cao übergeben
* !!! die gemappten felder müssen in der tabele products existieren
* you can also map to existing fields
*/
$userfieldMapping = array(
    '4' => 'productsheetlink',
    '5' => 'products_image',
    );

$order_total_class['ot_cod_fee']['prefix'] = '+';
$order_total_class['ot_cod_fee']['tax'] = '19';

$order_total_class['ot_customer_discount']['prefix'] = '-';
$order_total_class['ot_customer_discount']['tax'] = '19';

$order_total_class['ot_gv']['prefix'] = '-';
$order_total_class['ot_gv']['tax'] = '0';

$order_total_class['ot_loworderfee']['prefix'] = '+';
$order_total_class['ot_loworderfee']['tax'] = '19';

$order_total_class['ot_shipping']['prefix'] = '+';
$order_total_class['ot_shipping']['tax'] = '19';

$version_nr = '1.56';
$version_datum = '2010.11.23';

define('SET_TIME_LIMIT', 1); // aktivieren um SetTimeLimit einzuschalten
