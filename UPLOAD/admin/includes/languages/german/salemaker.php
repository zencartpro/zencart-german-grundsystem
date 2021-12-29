<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: salemaker.php 2021-12-03 15:39:16Z webchills $
 */

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
define('TEXT_INFO_HEADING_COPY_SALE','Kopiere Abverkauf');
define('TEXT_INFO_COPY_INTRO','Geben Sie bitte einen Namen für die Kopie von <br>"%s"');
define('TEXT_INFO_HEADING_DELETE_SALE','Abverkauf löschen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Abverkauf wirklich löschen?');
define('TEXT_MORE_INFO', '(Weitere Infos)');
define('TEXT_WARNING_SALEMAKER_PREVIOUS_CATEGORIES','&nbsp;WARNUNG: %s Für diese Kategorie gibt es bereits Abverkäufe');