<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 2015-12-22 12:11:04Z webchills $
 */

define('HEADING_TITLE', 'Bitte wählen Sie...');
define('BOX_TITLE_ORDERS', 'Bestellungen');
define('BOX_TITLE_STATISTICS', 'Statistiken');
define('BOX_ENTRY_SUPPORT_SITE', 'Supportseite');
define('BOX_ENTRY_SUPPORT_FORUMS', 'Support-Forum');
define('BOX_ENTRY_MAILING_LISTS', 'Mailingliste');
define('BOX_ENTRY_BUG_REPORTS', 'Fehlerberichte');
define('BOX_ENTRY_FAQ', 'FAQ');
define('BOX_ENTRY_LIVE_DISCUSSIONS', 'Live-Diskussion');
define('BOX_ENTRY_CVS_REPOSITORY', 'CVS Repository');
define('BOX_ENTRY_INFORMATION_PORTAL', 'Info Portal');
define('BOX_CONNECTION_PROTECTED', 'Sie werden durch eine %s gesicherte SSL Verbindung  geschützt.');
define('BOX_CONNECTION_UNPROTECTED', 'Sie verwenden <font color="#ff0000">keine</font> sichere SSL Verbindung.');
define('BOX_CONNECTION_UNKNOWN', 'unbekannt');
define('CATALOG_CONTENTS', 'Inhalte');
define('TOOLS_BACKUP', 'Sicherung');
define('TOOLS_BANNERS', 'Werbebanner');
define('TOOLS_FILES', 'Dateien');

// statistics
define('REPORTS_PRODUCTS', 'Artikel');
define('REPORTS_ORDERS', 'Bestellungen');
define('BOX_ENTRY_CUSTOMERS', 'Kunden:');
define('BOX_ENTRY_NEWSLETTERS', 'Newsletter Abonnenten:');
define('BOX_ENTRY_PRODUCTS', 'Artikel:');
define('BOX_ENTRY_PRODUCTS_OFF', 'Deaktivierte Artikel:');
define('BOX_ENTRY_REVIEWS', 'Bewertungen:');
define('BOX_ENTRY_REVIEWS_PENDING', 'Ausstehende Überprüfungen für Bewertungen:');
define('BOX_ENTRY_NEW_CUSTOMERS', 'Neue Kunden:');
define('BOX_ENTRY_NEW_ORDERS', 'Neue Bestellungen:');
define('BOX_ENTRY_SPECIALS_EXPIRED', 'Abgelaufene Sonderpreise');
define('BOX_ENTRY_FEATURED_EXPIRED', 'Abgelaufene empfohlene Artikel');
define('BOX_ENTRY_SALEMAKER_EXPIRED', 'Abgelaufene Abverkäufe');
define('BOX_ENTRY_SPECIALS_ACTIVE', 'Aktive Sonderpreise');
define('BOX_ENTRY_FEATURED_ACTIVE', 'Aktive empfohlene Artikel');
define('BOX_ENTRY_SALEMAKER_ACTIVE', 'Aktive Abverkäufe');
define('LAST_10_DAYS', 'Counter Historie für die letzten %s Tage');
define('SESSION', 'Session');
define('TOTAL', 'Gesamt');

// DASHBOARD - HOME PAGE OF ADMIN - CUSTOMERS section
define('BOX_TITLE_CUSTOMERS', 'Kunden');
define('BOX_ENTRY_CUSTOMERS_NORMAL', '- Full Accounts :');
define('BOX_ENTRY_CUSTOMERS_TOTAL', 'Total Customer Accounts :');
define('BOX_ENTRY_CUSTOMERS_TOTAL_DISTINCT', 'Total Distinct Customers :');

define('TEXT_REMOVE', 'Remove');
define('TEXT_UPDATE', 'Update');
define('TEXT_CONFIRM_REMOVE', 'Are you sure you want to remove this widget from the dashboard?');
define('TEXT_WIDGET_UPDATE_HEADER', 'Widget Settings have been updated');

define ('TEXT_TIMER_SELECT_NONE', 'No Refresh');
define ('TEXT_TIMER_SELECT_1MIN', 'Refresh every Minute');
define ('TEXT_TIMER_SELECT_5MIN', 'Refresh every 5 Minutes');
define ('TEXT_TIMER_SELECT_10MIN', 'Refresh every 10 Minutes');
define ('TEXT_TIMER_SELECT_15MIN', 'Refresh every 15 Minutes');

define ('TEXT_NO_WIDGETS_TO_INSTALL', 'There are currently no widgets available to install.');
define('TEXT_FORM_ERROR_CHOOSE_ZONE', 'Please choose a Zone');
define('TEXT_WARNING_SUPERUSER_REQUIRED', 'Only a Superuser can complete the initial setup. You will not be able to use your Admin until this is done.');
define('TEXT_HEADING_SETUP_WIZARD', 'Initial Setup Wizard');

define('TEXT_FORM_LEGEND_REQUIRED_SETUP', 'Required Setup Information');
define('TEXT_FORM_LABEL_STORE_NAME', 'Store Name');
define('TEXT_FORM_LABEL_STORE_OWNER', 'Store Owner');
define('TEXT_FORM_LABEL_STORE_OWNER_EMAIL', 'Store Owner Email');
define('TEXT_FORM_LABEL_STORE_COUNTRY', 'Store Country');
define('TEXT_FORM_LABEL_STORE_ZONE', 'Store Zone');
define('TEXT_FORM_LABEL_STORE_ADDRESS', 'Store Address');
define('TEXT_STORE_NAME', 'Name Ihres Shops');
define('TEXT_STORE_OWNER', 'Shopinhaber');
define('TEXT_STORE_OWNER_EMAIL', 'Emailadresse des Shopinhabers');
define('TEXT_STORE_COUNTRY', 'Land des Shops');
define('TEXT_STORE_ZONE', 'Bundeland des Shops');
define('TEXT_STORE_ADDRESS', 'Adresse des Shops');
define('HEADING_TITLE_WIZARD', 'Erstinstallationsassistent');
define('TEXT_STORE_DETAILS', 'Bitte geben Sie hier grundlegende Details zu Ihrem Shop an. Alle Felder sind Pflichtfelder.');
