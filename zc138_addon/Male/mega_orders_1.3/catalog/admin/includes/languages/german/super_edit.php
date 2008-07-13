<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Generates a pop-up window to edit    //
//  the selected order information, broken into         //
//  sections: contact, product, history, and total.     //
//////////////////////////////////////////////////////////
// $Id: super_edit.php 25 2006-02-03 18:55:56Z BlindSide $
*/

// include the language file for super_orders.php since they overlap so much
require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_SUPER_ORDERS . '.php');

define('HEADER_EDIT_ORDER', 'Editing Order #');
define('HEADER_EDIT_TOTAL', 'Order Total Values');
define('HEADER_EDIT_CONTACT', 'Kontaktdaten');
define('HEADER_EDIT_HISTORY', 'Bestellhistorie');

define('TABLE_HEADING_DELETE_COMMENTS', 'L&ouml;sche');
define('ENTRY_NAME', 'Name:');
define('ENTRY_ADDRESS', 'Adresse:');
define('ENTRY_POSTCODE', 'Plz:');
define('ENTRY_CHANGE_CUSTOMER', 'Point order at a different customer:');

define('BUTTON_CANCEL', 'Abbrechen');
define('BUTTON_SUBMIT', 'Senden');

define('TEXT_SPLIT_EXPLAIN', 'Products will move to Order #');
define('COMMENTS_SPLIT_OLD', 'Bestellung wurde geteilt.  Neue Bestellung: ');
define('COMMENTS_SPLIT_NEW', 'Von geteilter Bestellung erfasst.  Original Bestellung: ');

define('NL', "\n");

?>