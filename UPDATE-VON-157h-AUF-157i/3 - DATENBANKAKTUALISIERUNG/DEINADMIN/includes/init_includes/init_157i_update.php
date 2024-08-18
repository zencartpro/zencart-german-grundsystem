<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei sofort wieder vom Server !!!!!
* @copyright Copyright 2003-2024 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* Zen Cart German Version - www.zen-cart-pro.at
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_157i_update.php 2024-08-17 09:58:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {
	
	
// -----
// German Translations Date
// 
//
$db->Execute("REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES 
('20240818', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Uebersetzungen', now(), now());");

// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7i', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7i', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7i', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.7i deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.157i_update.php<br/>DEINADMIN/includes/init_includes/init_157i_update.php', 'success'); 
}