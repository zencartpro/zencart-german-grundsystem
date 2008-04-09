<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id$
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
define('TEXT_SALEMAKER_DEDUCTION_TYPE','?????Typ:??');
define('TEXT_SALEMAKER_PRICERANGE_FROM','Artikel Preisbereich:');
define('TEXT_SALEMAKER_PRICERANGE_TO','?????bis???????');
define('TEXT_SALEMAKER_SPECIALS_CONDITION','Wenn Sonderangebot:');
define('TEXT_SALEMAKER_DATE_START','Startdatum:');
define('TEXT_SALEMAKER_DATE_END','Enddatum:');
define('TEXT_SALEMAKER_CATEGORIES','<b>oder</b> &uuml;berpr&uuml;fen Sie die Kategorien f&uuml;r die dieser Abverkauf gelten soll:');
define('TEXT_SALEMAKER_POPUP','<a href="javascript:session_win();"><span class="errorText"><b>Klicken Sie hier um Tipps f&uuml;r die Verwendung des Abverkaufsmanagers zu erhalten.</b></span></a>');
define('TEXT_SALEMAKER_POPUP1','<a href="javascript:session_win1();"><span class="errorText"><b>(Weitere Informationen)</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY','Sofort');
define('TEXT_SALEMAKER_NEVER','Nie');
define('TEXT_SALEMAKER_ENTIRE_CATALOG','Aktivieren Sie diese Box wenn Sie den Abverkauf auf <b>alle Artikel</b> anwenden wollen:');
define('TEXT_SALEMAKER_TOP','Kompletter Katalog');
define('TEXT_INFO_DATE_ADDED','Erstelldatum:');
define('TEXT_INFO_DATE_MODIFIED','Letzte &Auml;nderung:');
define('TEXT_INFO_DATE_STATUS_CHANGE','Letzte Status&auml;nderung:');
define('TEXT_INFO_SPECIALS_CONDITION','Sonderkonditionen:');
define('TEXT_INFO_DEDUCTION','Reduzierung:');
define('TEXT_INFO_PRICERANGE_FROM','Preisbereich:');
define('TEXT_INFO_PRICERANGE_TO','bis');
define('TEXT_INFO_DATE_START','Startet:');
define('TEXT_INFO_DATE_END','L&auml;uft ab:');
define('SPECIALS_CONDITION_DROPDOWN_0','Sonderpreise ignorieren - Auf Artikelpreis anwenden und Sonderpreis durch Abverkaufspreis ersetzen');
define('SPECIALS_CONDITION_DROPDOWN_1','Abverkaufsoptionen ignorieren - Keinen Abverkaufspreis anwenden wenn ein Sonderpreis existiert');
define('SPECIALS_CONDITION_DROPDOWN_2','Abverkaufspreis zu Sonderpreis hinzuf&uuml;gen - sonst auf den Artikelpreis anwenden');
// moved to english.php
/*
define('DEDUCTION_TYPE_DROPDOWN_0','Betrag der Reduzierung:');
define('DEDUCTION_TYPE_DROPDOWN_1','Prozent');
define('DEDUCTION_TYPE_DROPDOWN_2','Neuer Preis');
*/
define('TEXT_INFO_HEADING_COPY_SALE','Kopiere Abverkauf');
define('TEXT_INFO_COPY_INTRO','Geben Sie bitte einen Namen f&uuml;r die Kopie von <br>??&quot;%s&quot;');
define('TEXT_INFO_HEADING_DELETE_SALE','Abverkauf l&ouml;schen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Abverkauf wirklich l&ouml;schen?');
define('TEXT_MORE_INFO', '(More Info)' . ' !!!TRANSLATE!!! file: admin/includes/languages/LANGUAGE/salemaker.php at line 357');
define('TEXT_WARNING_SALEMAKER_PREVIOUS_CATEGORIES','&nbsp;Warning : %s sales already include this category' . ' !!!TRANSLATE!!! file: admin/includes/languages/LANGUAGE/salemaker.php at line 357');


?>