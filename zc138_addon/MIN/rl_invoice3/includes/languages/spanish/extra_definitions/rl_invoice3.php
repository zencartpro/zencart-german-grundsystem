<?php
// EDITED BY STEVE FOR SPANISH
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
//  $Id: rl_invoice3.php 491 2009-01-30 05:54:23Z hugo13 $
//
// added by STEVE
define('RL_INVOICE3_FILE_MISSING', 'No se encuentra el archivo. Contáctenos directamente para informarnos del error
<br />
Gracias<br />
<c/f: ');

define('TABLE_HEADING_COMMENTS', 'Comentarios');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Productos');
define('TABLE_HEADING_TAX3', 'IVA');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_EXTRA','Opciones');
define('TABLE_HEADING_QTY','Cant.');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '(-IVA)');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON', '(-IVA)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '(+IVA)');

define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (-IVA)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON','Total(-IVA)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (+IVA)');


define('ENTRY_CUSTOMER', 'Cliente:');

define('ENTRY_SOLD_TO', 'Dirección de Facturación:');
define('ENTRY_SHIP_TO', 'Dirección del Envío:');
define('ENTRY_PAYMENT_METHOD', 'Método de Pago:');
define('ENTRY_SUB_TOTAL', 'SubTotal:');
define('ENTRY_TAX', 'IVA:');
define('ENTRY_SHIPPING', 'Envío:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Fecha del Pedido:');
define('ENTRY_NAME', 'Nombre:');
define('ENTRY_EMAIL_ADDRESS','Email:');

define('ENTRY_ORDER_ID','Factura: ');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;GRATIS');

define('LIEFERADRESSE', 'Dirección del Envío');
define('RECHNUNGSADRESSE', 'Dirección de Facturación');

define('RL_INVOICE3_INVLINK_PRE', 'hugo13_');
define('RL_INVOICE3_INVLINK', 'factura.pdf');
define('RL_INVOICE3_INVLINK_TEXT', 'descarga:');

define('RL_INVOICE3_SUBTOTAL', 'Subtotal: ');
define('RL_INVOICE3_BALANCE', 'Saldo: ');
define('RL_INVOICE3_PAYMENT_METHOD','Opción de Pago:');
//added by Steve
define('RL_INVOICE3_SHIPPING_METHOD','Opción de Envío:');
