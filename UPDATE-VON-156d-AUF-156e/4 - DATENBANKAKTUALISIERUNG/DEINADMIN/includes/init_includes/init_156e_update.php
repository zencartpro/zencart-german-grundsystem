<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei sofort wieder vom Server !!!!!
* @copyright Copyright 2003-2020 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_156e_update.php 2020-02-05 19:42:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {


// -----
// möglicherweise fehlenden Eintrag ADMIN_NAME_MINIMUM_LENGTH ergänzen
// 
//

$db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin Usernames', 'ADMIN_NAME_MINIMUM_LENGTH', '4', 'Minimum length of admin usernames (must be 4 or more)', '2', '18', now());");


// -----
// Mehrfachlink Kategorie Manager im Hauptmenue sichtbar schalten
// 
//
$db->Execute("UPDATE ".TABLE_ADMIN_PAGES." SET display_on_menu = 'Y' WHERE page_key = 'productsToCategories';");
// -----
// Image Handler auf 5.1.8 aktualisieren
// 
//
$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'IH_VERSION';");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.1.6', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$messageStack->add('Image Handler erfolgreich auf Version 5.1.8 aktualisiert', 'success');

// -----
// orders_status Tabelle mit sort_order erweitern
// 
//

//check if sort_order column already exists - if not add it
$sql ="SHOW COLUMNS FROM ".TABLE_ORDERS_STATUS." LIKE 'sort_order'";
$result = $db->Execute($sql);
if(!$result->RecordCount())
{
$sql = "ALTER TABLE ".TABLE_ORDERS_STATUS." ADD sort_order int(11) NOT NULL default '0'";
$db->Execute($sql);
}
$messageStack->add('Tabelle orders_status erfolgreich aktualisiert', 'success');

// -----
// Nicht mehr verwendete configs entfernen
// 
//
$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'ADMIN_DEMO';");
$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'UPLOAD_FILENAME_EXTENSIONS';");
$messageStack->add('Veraltete Konfigurationen erfolgreich entfernt', 'success');

// -----
// Neue Konfigurationsoptionen hinzufügen
// 
//
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION."  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Include meta-tags in product search?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 'true', 'Should a product\'s meta-tag keywords and meta-tag descriptions be considered in any <code>advanced_search_results</code> displayed?', 1, 18, now(), 'zen_cfg_select_option(array(\'true\', \'false\'),');");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION."  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Default for Notify Customer on Order Status Update?', 'NOTIFY_CUSTOMER_DEFAULT', '1', 'Set the default email behavior on status update to Send Email, Do Not Send Email, or Hide Update.', 1, 120, now(), now(), NULL, 'zen_cfg_select_drop_down(array( array(\'id\'=>\'1\', \'text\'=>\'Email\'), array(\'id\'=>\'0\', \'text\'=>\'No Email\'), array(\'id\'=>\'-1\', \'text\'=>\'Hide\')),');");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION_LANGUAGE."  (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Voreinstellung für Kundenbenachrichtigung beim Update einer Bestellung', 'NOTIFY_CUSTOMER_DEFAULT', 43, 'Was soll beim Aktualisieren einer Bestellung bezüglich Kundenbenachrichtigung voreingestellt sein?<br/><br/>1 = Email = Kunde wird über die Aktualisierung per Email informiert<br/><br/>2 = No Email = Es wird bei der Aktualisierung kein Mail an den Kunden geschickt<br/><br/>3 = Hide = Es wird kein Email geschickt und der Eintrag in der Bestellhistorie ist für den Kunden nicht sichtbar', now(), now()),
('Metatags in der Artikelsuche einbeziehen?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 43, 'Sollen die für einen Artikel definierten Meta Tag Keywords und Meta Tag Beschreibungen in der Erweiterten Suche miteinbezogen werden?', now(), now());");
$messageStack->add('Neue Konfigurationsoptionen erfolgreich hinzugefügt', 'success');


// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.6e', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6d->1.5.6e', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.6', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6d->1.5.6e', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.6e deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.156e_update.php<br/>DEINADMIN/includes/init_includes/init_156e_update.php', 'success'); 
}