<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei sofort wieder vom Server !!!!!
* @copyright Copyright 2003-2019 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_156d_update.php 2019-11-03 20:00:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {


// -----
// Image Handler auf 5.1.6 aktualisieren
// 
//
$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'IH_VERSION';");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.1.6', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$messageStack->add('Image Handler erfolgreich auf Version 5.1.6 aktualisiert', 'success');

// -----
// Logfiles Version aktualisieren
// 
//
$db->Execute ("UPDATE ".TABLE_CONFIGURATION." SET configuration_value = '2.1.2' WHERE configuration_key = 'DISPLAY_LOGS_VERSION';");
$messageStack->add('Logfiles Version erfolgreich auf Version 2.1.2 aktualisiert', 'success');
// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.6d', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6c->1.5.6d', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.6', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6c->1.5.6d', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.6d deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.156d_update.php<br/>DEINADMIN/includes/init_includes/init_156d_update.php', 'success'); 
}