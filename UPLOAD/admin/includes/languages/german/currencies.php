<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: currencies.php 2023-10-28 15:49:16Z webchills $
 */

define('HEADING_TITLE','Währungen');

define('TABLE_HEADING_CURRENCY_NAME','Währung');
define('TABLE_HEADING_CURRENCY_CODES','Code');
define('TABLE_HEADING_CURRENCY_VALUE','Wechselkurs');


define('TEXT_INFO_CURRENCY_TITLE','Name:');
define('TEXT_INFO_CURRENCY_CODE','Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT','Währungssymbol links:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT','Währungssymbol rechts:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT','Dezimalstellen Trennzeichen:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT','1000er Trennzeichen');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES','Dezimalstellen:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED','Letzte Aktualisierung:');


define('TEXT_INFO_CURRENCY_VALUE','Wert:<br><br><strong>Achtung, wenn hier ein anderer Wert als 1 eingetragen ist, dann wird der jeweilige Artikelpreis mit diesem Wert multipliziert (siehe auch unter Beispielausgabe)!</strong><br><br>');
define('TEXT_INFO_CURRENCY_EXAMPLE','Beispielausgabe:');
define('TEXT_INFO_INSERT_INTRO','Bitte tragen Sie die neue Währung mit den relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diese Währung wirklich löschen?');
define('TEXT_INFO_HEADING_NEW_CURRENCY','Neue Währung');
define('TEXT_INFO_HEADING_EDIT_CURRENCY','Währung bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CURRENCY','Währung löschen');
define('TEXT_INFO_SET_AS_DEFAULT','Als Standard setzen (Ein manuelles Update der Währungskurse ist notwendig)');


define('ERROR_REMOVE_DEFAULT_CURRENCY','FEHLER: Die Standardwährung kann nicht gelöscht werden. Legen Sie eine andere Währung als Standard fest und versuchen Sie es noch einmal.');

define('ERROR_INVALID_CURRENCY_ENTRY', 'FEHLER: Ihre Angaben sind unvollständig und wurden nicht gespeichert. Sie müssen einen Code und einen Namen angeben.');
