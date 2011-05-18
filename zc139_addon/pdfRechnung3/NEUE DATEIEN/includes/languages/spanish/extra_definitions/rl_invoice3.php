<?php
/**
 * 
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/ 
 * @version $Id$
 */

define('RL_INVOICE3_FILE_MISSING', 'ERROR - Unable to find file.<br />
Please contact us directly to report this error.
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
define('RL_INVOICE3_ENTRY_DATE_INVOICE','Invoicedate:');
define('RL_INVOICE3_ORDERINVOICE', 'AUFTRAGSBESTÄTIGUNG UND RECHNUNG:');
define('RL_INVOICE3_INVOICEDATE', 'Rechnungsdatum:');
define('RL_INVOICE3_CITY2', 'Wien, ');
define('RL_INVOICE3_CONTACT', 'Kontakt:');
define('RL_INVOICE3_TEL', 'Telefon:');
define('RL_INVOICE3_MAIL', 'E-Mail:');
define('RL_INVOICE3_ORDERFROM', 'Ihre Bestellung vom:');
define('RL_INVOICE3_ORDERID', 'Bestellnummer:');
define('RL_INVOICE3_BUYER', 'Besteller:');
define('RL_INVOICE3_CUSTOMERNO', 'Kundennummer:');
define('RL_INVOICE3_THEEND', 'wir wünschen ihnen viel spass mit unseren produkten & hoffen, sie bald wieder im shop begrüssen zu dürfen');
