<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: modules.php 631 2020-01-18 10:05:14Z webchills $
 */

define('HEADING_TITLE_MODULES_PAYMENT','Zahlungsarten');
define('HEADING_TITLE_MODULES_SHIPPING','Versandarten');
define('HEADING_TITLE_MODULES_ORDER_TOTAL','Zusammenfassung');
define('HEADING_TITLE_MODULES_PRODUCT_TYPES', 'Artikeltypen Modul');
define('TABLE_HEADING_MODULES', 'Modul');
define('TABLE_HEADING_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_ORDERS_STATUS','Auftragsstatus');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_MODULE_DIRECTORY', 'Modulverzeichnis:');

define('ERROR_MODULE_FILE_NOT_FOUND', 'FEHLER: Ein Modul wurde wegen einer fehlenden Sprachdatei nicht geladen: ');
define('TEXT_EMAIL_SUBJECT_ADMIN_SETTINGS_CHANGED', 'ALARM: Ihre Admineinstellungen in Ihrem Shop wurden geändert.');
define('TEXT_EMAIL_MESSAGE_ADMIN_SETTINGS_CHANGED', 'Dies ist eine automatische E-Mail von Ihrem Zen-Cart Shop, um Sie auf eine vorgenommene Änderung in Ihren administrativen Einstellungen hinzuweisen: ' . "\n\n" . 'HINWEIS: Für das Modul [%s] wurden die Einstellungen verändert, die Änderung erfolgte durch den Admin Benutzer %s.' . "\n\n" . 'Wenn Sie diese Änderung nicht veranlasst haben, ist es empfehlenswert diese sofort zu überprüfen.' . "\n\n" . 'Sollten Sie bereits Kenntnis über diese Änderungen haben, dann ignorieren Sie diese automatisch generierte E-Mail.');
define('TEXT_EMAIL_MESSAGE_ADMIN_MODULE_INSTALLED', 'Dies ist eine automatische E-Mail von Ihrem Zen-Cart Shop, um Sie auf eine vorgenommene Änderung in Ihren administrativen Einstellungen hinzuweisen: ' . "\n\n" . 'HINWEIS: Das Modul [%s] wurde von dem Admin Benutzer %s installiert.' . "\n\n" . 'Wenn Sie diese Änderung nicht veranlasst haben, ist es empfehlenswert diese sofort zu überprüfen.' . "\n\n" . 'Sollten Sie bereits Kenntnis über diese Änderungen haben, dann ignorieren Sie diese automatisch generierte E-Mail.');
define('TEXT_EMAIL_MESSAGE_ADMIN_MODULE_REMOVED', 'Dies ist eine automatische E-Mail von Ihrem Zen-Cart Shop, um Sie auf eine vorgenommene Änderung in Ihren administrativen Einstellungen hinzuweisen: ' . "\n\n" . 'HINWEIS: Das Modul [%s] wurde von dem Admin Benutzer %s entfernt.' . "\n\n" . 'Wenn Sie diese Änderung nicht veranlasst haben, ist es empfehlenswert diese sofort zu überprüfen.' . "\n\n" . 'Sollten Sie bereits Kenntnis über diese Änderungen haben, dann ignorieren Sie diese automatisch generierte E-Mail.');
define('TEXT_DELETE_INTRO', 'Wollen Sie dieses Modul wirklich entfernen?');
define('TEXT_WARNING_SSL_EDIT', 'ALARM: <a href="http://www.zen-cart-pro.at/forum" target="_blank">Aus Sicherheitsgründen sind Änderungen deaktiviert, solange für Ihren Adminbereich keine SSL Verschlüsselung aktiviert wurde</a>.');
define('TEXT_WARNING_SSL_INSTALL', 'ALARM: <a href="http://www.zen-cart-pro.at/forum" target="_blank">Aus Sicherheitsgründen ist die Installation dieses Modules deaktiviert, solange für Ihren Adminbereich keine SSL Verschlüsselung aktiviert wurde</a>.');
