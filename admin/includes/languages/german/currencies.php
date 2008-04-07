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
//  $Id: currencies.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE','W&auml;hrungen');
define('TABLE_HEADING_CURRENCY_NAME','W&auml;hrung');
define('TABLE_HEADING_CURRENCY_CODES','Code');
define('TABLE_HEADING_CURRENCY_VALUE','Einstellung');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_INFO_EDIT_INTRO','F&uuml;hren Sie hier bitte die notwendigen &Auml;nderungen durch');
define('TEXT_INFO_CURRENCY_TITLE','Titel:');
define('TEXT_INFO_CURRENCY_CODE','Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT','W&auml;hrungssymbol links:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT','W&auml;hrungssymbol rechts:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT','Dezimalstellen Trennzeichen:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT','1000er Trennzeichen');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES','Dezimalstellen:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED','Letzte Aktualisierung:');
define('TEXT_INFO_CURRENCY_VALUE','Wert:');
define('TEXT_INFO_CURRENCY_EXAMPLE','Beispielausgabe:');
define('TEXT_INFO_INSERT_INTRO','Bitte tragen Sie die neue W&auml;hrung mit den relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diese W&auml;hrung wirklich l&ouml;schen?');
define('TEXT_INFO_HEADING_NEW_CURRENCY','Neue W&auml;hrung');
define('TEXT_INFO_HEADING_EDIT_CURRENCY','W&auml;hrung bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CURRENCY','W&auml;hrung l&ouml;schen');
define('TEXT_INFO_SET_AS_DEFAULT',TEXT_SET_DEFAULT . '(Ein manuelles Update der W&auml;hrungskurse ist notwendig)');
define('TEXT_INFO_CURRENCY_UPDATED','Der Umrechnungskurs f&uuml;r %s (%s) wurde mit %s aktualisiert.');
define('ERROR_REMOVE_DEFAULT_CURRENCY','Fehler: Die Standardw&auml;hrung kann nicht gel&ouml;scht werden. Legen Sie eine andere W&auml;hrung als Standard fest und versuchen Sie es noch einmal.');
define('ERROR_CURRENCY_INVALID','Fehler: Der Umrechnungskurs f&uuml;r %s (%s) konnte mit %s nicht aktualisiert werden. Haben Sie den richtigen W&auml;hrungs-Code eingeben?');
define('WARNING_PRIMARY_SERVER_FAILED','Warnung: Der prim&auml;re Aktualisierungs-Server (%s) konnte nach %s (%s) Versuchen nicht erreicht werden - Es wird versucht, die Aktualisierung &uuml;ber den sekund&auml;ren Server durchzuf&uuml;hren.');


?>