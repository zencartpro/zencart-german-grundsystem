<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart-pro.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart-pro.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

//  $Id: salemaker.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE','Abverkaufsmanager');
define('TABLE_HEADING_SALE_NAME','Abverkaufsbezeichnung');
define('TABLE_HEADING_SALE_DEDUCTION','Reduzierung');
define('TABLE_HEADING_SALE_DATE_START','Startdatum');
define('TABLE_HEADING_SALE_DATE_END','Enddatum');
define('TABLE_HEADING_STATUS','Status');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_SALEMAKER_NAME','Abverkaufsbezeichnung:');
define('TEXT_SALEMAKER_DEDUCTION','Reduzierung:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE','     Typ:  ');
define('TEXT_SALEMAKER_PRICERANGE_FROM','Artikel Preisbereich:');
define('TEXT_SALEMAKER_PRICERANGE_TO','     bis       ');
define('TEXT_SALEMAKER_SPECIALS_CONDITION','Wenn Sonderangebot:');
define('TEXT_SALEMAKER_DATE_START','Startdatum:');
define('TEXT_SALEMAKER_DATE_END','Enddatum:');
define('TEXT_SALEMAKER_CATEGORIES','<b>oder</b> überprüfen Sie die Kategorien für die dieser Abverkauf gelten soll:');
define('TEXT_SALEMAKER_POPUP','<a href="javascript:session_win();"><span class="errorText"><b>Klicken Sie hier um Tipps für die Verwendung des Abverkaufsmanagers zu erhalten.</b></span></a>');
define('TEXT_SALEMAKER_POPUP1','<a href="javascript:session_win1();"><span class="errorText"><b>(Weitere Informationen)</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY','Sofort');
define('TEXT_SALEMAKER_NEVER','Nie');
define('TEXT_SALEMAKER_ENTIRE_CATALOG','Aktivieren Sie diese Box wenn Sie den Abverkauf auf <b>alle Artikel</b> anwenden wollen:');
define('TEXT_SALEMAKER_TOP','Kompletter Shop');
define('TEXT_INFO_DATE_ADDED','Erstellt am:');
define('TEXT_INFO_DATE_MODIFIED','Letzte Änderung:');
define('TEXT_INFO_DATE_STATUS_CHANGE','Letzte Statusänderung:');
define('TEXT_INFO_SPECIALS_CONDITION','Sonderkonditionen:');
define('TEXT_INFO_DEDUCTION','Reduzierung:');
define('TEXT_INFO_PRICERANGE_FROM','Preisbereich:');
define('TEXT_INFO_PRICERANGE_TO',' bis ');
define('TEXT_INFO_DATE_START','Startet:');
define('TEXT_INFO_DATE_END','Endet:');
define('SPECIALS_CONDITION_DROPDOWN_0','Sonderpreise ignorieren - Auf Artikelpreis anwenden und Sonderpreis durch Abverkaufspreis ersetzen');
define('SPECIALS_CONDITION_DROPDOWN_1','Abverkaufsoptionen ignorieren - Keinen Abverkaufspreis anwenden wenn ein Sonderpreis existiert');
define('SPECIALS_CONDITION_DROPDOWN_2','Abverkaufspreis zu Sonderpreis hinzufügen - sonst auf den Artikelpreis anwenden');
// moved to english.php
/*
define('DEDUCTION_TYPE_DROPDOWN_0','Betrag der Reduzierung:');
define('DEDUCTION_TYPE_DROPDOWN_1','Prozent');
define('DEDUCTION_TYPE_DROPDOWN_2','Neuer Preis');
*/
define('TEXT_INFO_HEADING_COPY_SALE','Kopiere Abverkauf');
define('TEXT_INFO_COPY_INTRO','Geben Sie bitte einen Namen für die Kopie von <br>"%s"');
define('TEXT_INFO_HEADING_DELETE_SALE','Abverkauf löschen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Abverkauf wirklich löschen?');
define('TEXT_MORE_INFO', '(Weitere Infos)');
define('TEXT_WARNING_SALEMAKER_PREVIOUS_CATEGORIES','&nbsp;WARNUNG: %s Für diese Kategorie gibt es bereits Abverkäufe');
