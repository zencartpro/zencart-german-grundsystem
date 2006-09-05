<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
//  $Id: layout_controller.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('HEADING_TITLE','Tabellenspalten');

define('TABLE_HEADING_LAYOUT_BOX_NAME','Name der Box');
define('TABLE_HEADING_LAYOUT_BOX_STATUS','Linke/Rechte Box<br />Status');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE','Einzelne Spalte-<br />Status');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION','Links der Rechts<br />Status');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Box<br />Sortierreihenfolge');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Box<br />Sortierreihenfolge');
define('TABLE_HEADING_ACTION','Aktion');

define('TEXT_INFO_EDIT_INTRO','F&uuml;hren Sie hier bitte die notwendigen Änderungen durch');
define('TEXT_INFO_LAYOUT_BOX','Ausgew&auml;hlte Box:');
define('TEXT_INFO_LAYOUT_BOX_NAME','Name der Box:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','Lokation: (Einzelne Boxen ignorieren diese Einstellung)');
define('TEXT_INFO_LAYOUT_BOX_STATUS','Linke/Rechte Box');
define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE','Einzelner Boxstatus:');
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','EIN= 1 AUS=0');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Box Sortierreihenfolge');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Box Sortierreihenfolge');
define('TEXT_INFO_INSERT_INTRO','Tragen Sie bitte die neue Box mit den notwendigen Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diese Box wirklich l&ouml;schen?');
define('TEXT_INFO_HEADING_NEW_BOX','Neue Box');
define('TEXT_INFO_HEADING_EDIT_BOX','Box bearbeiten');
define('TEXT_INFO_HEADING_DELETE_BOX','Box l&ouml;schen');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','L&ouml;sche fehlende Box aus der Templateliste:');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','HINWEIS: Dieser Vorgang l&ouml;scht keine Dateien und Sie k&ouml;nnen die Box wieder hinzuf&uuml;gen, in dem Sie die dazu notwendigen Dateien in das daf&uuml;r vorgesehene Verzeichnis kopieren.<br /><br /><strong>L&ouml;sche Box: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','Setze die Sortierreihenfolge aller Boxen f&uuml;r dieses Template auf die STANDARDWERTE zur&uuml;ck:');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','Dieser Vorgang l&ouml;scht keine dieser Boxen. Es wird nur die aktuellen Sortierreihenfolge zur&uuml;ckgesetzt');
define('TEXT_INFO_BOX_DETAILS','Boxdetails:');

////////////////

define('HEADING_TITLE_LAYOUT_TEMPLATE','Seitenlayout Vorlage (Template)');

define('TABLE_HEADING_LAYOUT_TITLE','Titel');
define('TABLE_HEADING_LAYOUT_VALUE','Wert');
define('TABLE_HEADING_ACTION','Aktion');


define('TEXT_MODULE_DIRECTORY','Verzeichnis des Seitenlayouts:');
define('TEXT_INFO_DATE_ADDED','Erstelldatum:');
define('TEXT_INFO_LAST_MODIFIED','Letzte Änderung:');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT','Layout');
define('BOX_LAYOUT_COLUMNS','Spaltenlayout Einstellungen');

// file exists
define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<font color="ff0000"><b>FEHLT</b></font><br />');


// Success message
define('SUCCESS_BOX_DELETED','Das Template der Box wurde entfernt:');
define('SUCCESS_BOX_RESET','Alle Einstellungen wurden auf die Standardeinstellungen zur&uuml;ckgesetzt:');
define('SUCCESS_BOX_UPDATED','Die Einstellungen der Box wurden aktualisiert:');

define('TEXT_ON','EIN');
define('TEXT_OFF','AUS');
define('TEXT_LEFT','LINKS');
define('TEXT_RIGHT','RECHTS');
?>
