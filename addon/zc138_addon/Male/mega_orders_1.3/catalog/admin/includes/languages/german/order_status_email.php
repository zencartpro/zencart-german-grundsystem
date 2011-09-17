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
//  DESCRIPTION:   Super Orders allows you to send      //
//  status update e-mails from several different        //
//  locations.  COnsequently the defines for the e-mail //
//  text had to be moved to a standalone location, to   //
//  avoid having the text defined in multiple           //
//  language files.                                     //
//////////////////////////////////////////////////////////
// $Id: order_status_email.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bestell Update');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailierte Rechung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestell-Datum:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>Die Anmerkungen für Ihre Bestellung sind: </em>');
define('EMAIL_TEXT_STATUS_UPDATED', 'Ihre Bestellung ist zum folgenden Status aktualisiert worden:' . "\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>Neuer Status:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Antworten Sie bitte dieser E-Mail, wenn Sie irgendwelche Fragen haben.' . "\n");
?>