<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei vom Server !!!!!
* @copyright Copyright 2003-2018 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: init_155f_update.php 2018-06-20 13:43:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {
// -----
// Neue DSGVO Menüs hinzufügen falls nicht vorhanden
// 
//   
if (!zen_page_key_exists('dsgvo_kundenexport')) {
// DSGVO Kundenexport
zen_register_admin_page('dsgvo_kundenexport', 'BOX_DSGVO_KUNDENEXPORT','FILENAME_DSGVO_KUNDENEXPORT', '', 'customers', 'Y', 40);
$messageStack->add('Neues Menü DSGVO Kundenexport unter Kunden erfolgreich hinzugefügt', 'success');
}
if (!zen_page_key_exists('customers_without_order')) {
// Kunden, die nie etwas bestellt haben
zen_register_admin_page('customers_without_order', 'BOX_CUSTOMERS_WITHOUT_ORDER','FILENAME_CUSTOMERS_WITHOUT_ORDER', '', 'customers', 'Y', 30);
$messageStack->add('Neues Menü Kunden, die nie etwas bestellt haben unter Kunden erfolgreich hinzugefügt', 'success');
}
// -----
// Image Handler von 4.4 to 5.1.0 aktualisieren
// 
//
$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'IH_VERSION';");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.1.0', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images background', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency', 4, 82, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images compression quality', 'SMALL_IMAGE_QUALITY', '85', 'Specify the desired image quality for small jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 88, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('IH Cache File-naming Convention', 'IH_CACHE_NAMING', 'Readable', 'Choose the method that <em>Image Handler</em> uses to name the resized images in the <code>cache/images</code> directory.<br /><br />The <em>Hashed</em> method was used by Image Handler versions prior to 4.3.4 and uses an &quot;MD5&quot; hash to produce the filenames.  It can be &quot;difficult&quot; to visually identify the original file using this method.  If you are upgrading Image Handler from a version prior to 4.3.4 <em>and</em> you have hard-coded links in product (or other) definitions to those images, <b>do not change</b> this setting from <em>Hashed</em>.<br /><br />Image Handler v4.3.4 (unreleased) introduced the concept of a <em>Readable</em> name for those resized images.  This is a good choice for new installations of <em>IH</em> or for upgraded installations that do not have hard-coded image links.', 4, 1006, now(), NULL, 'zen_cfg_select_option(array(\'Hashed\', \'Readable\'),');");
$db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images background', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency', 4, 82, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$messageStack->add('Image Handler erfolgreich auf Version 5.1.0 aktualisiert', 'success');
// -----
// Google Analytics DSGVO konform
// 
//
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'ga(\'set\', \'anonymizeIp\', true);' WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE' LIMIT 1;");
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'Enable' WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED' LIMIT 1;");
$messageStack->add('Google Analytics erfolgreich für Anonymize IP konfiguriert', 'success');
// -----
// Gespeicherte IP Adressen löschen
// 
//
$db->Execute("UPDATE ".TABLE_ORDERS." SET ip_address = '' WHERE ip_address != '';");
$messageStack->add('Gespeicherte IP Adressen erfolgreich gelöscht', 'success');
// -----
// auf neueste deutsche Konfigurationsübersetzungen aktualisieren
// 
//
$db->Execute("REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Like Button - Facebook Like Button aktivieren?', 'FACEBOOK_LIKE_BUTTON_STATUS', 43, 'Wollen Sie den Facebook Like Button aktivieren?<br/>Hinweis: Diese Facebook Like Button Integration ist KEINE Shariff-Lösung und daher nicht DSGVO-konform.<br/>Wir raten von einer Aktivierung jedweder Like Buttons ab!', now(), now()),
('GA - Benutzerdefinierten Tracking Code nach dem Hauptcode einfügen?', 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED', 43, 'Google Analytics:<br/><br/>Wollen Sie einen weiteren benutzerdefinierten Trackingcode nach dem normalen Google Analytics Hauptcode einfügen? Das kann genutzt werden, um den Code an Ihre ganz individuellen Erfordernisse anzupassen. Fügen Sie Tracking Objekte entsprechend der Dokumentation der Google Analytics Website</a> ein.<br/><br/>Voreingestellt ist: Aktiviert, damit der weiter unten vorkonfigurierte Code zur IP-Adressen Anonymisierung aufgerufen wird, um Google Analytics DSGVO-konform zu betreiben.<br/><br/>', now(), now()),
('GA - Benutzerdefinierter Tracking Code', 'GOOGLE_ANALYTICS_CUSTOM_CODE', 43, 'Google Analytics:<br/><br/>Falls Sie benutzerdefinierten Tracking Code aktiviert haben, fügen Sie diesen hier ein.<br/>Voreingestellt ist bereits die Anonymisierung der IP-Adresse, um Google Analytics DSGVO-konform zu betreiben.<br/><br/>', now(), now()),
('IH - Benennung der Bilder im cache/images Ordner', 'IH_CACHE_NAMING', 43, 'Wählen Sie die Methode aus, die Image Handler verwendet, um die skalierten Bilder im Verzeichnis cache/images zu benennen. <br /> <br /> Die <em> Hashed </ em> Methode wurde von Image Handler-Versionen vor 4.3.4 verwendet und verwendet einen MD5 - Hash, um die Dateinamen zu erzeugen. Es kann schwierig sein, die ursprüngliche Datei mithilfe dieser Methode visuell zu identifizieren. Wenn Sie in Ihren Produktbeschreibungen (oder anderen Seiten) fest codierte Links zu diesen Bildern haben, ändern Sie diese Einstellung auf <em> Hashed </ em>. <br /> <br />Seit Image Handler 5.1 können die Bilder mit einem <em> lesbaren Namen </ em> erzeugt werden. Dies ist eine gute Wahl für Neuinstallationen oder für aktualisierte Installationen ohne fest codierte Bildverknüpfungen und nun als Standard (Readable) voreingestellt.', now(), now());");

// -----
// Datum der Sprachversion aktualisieren
// 
//
$db->Execute ("REPLACE INTO ".TABLE_PRODUCT_TYPE_LAYOUT_LANGUAGE." (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES ('20180619', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Übersetzungen', now(), now());");
$messageStack->add('deutsche Konfigurationsübersetzungen erfolgreich aktualisiert', 'success');
// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.5f', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.5e->1.5.5f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.5', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.5e->1.5.5f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.5f deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.155f_update.php<br/>DEINADMIN/includes/init_includes/init_155f_update.php', 'success'); 
}