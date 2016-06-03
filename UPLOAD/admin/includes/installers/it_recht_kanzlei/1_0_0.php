<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: 1_0_0.php  2016-06-01 09:13:51Z webchills $
 */
 
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'IT Recht Kanzlei'
LIMIT 1;");


$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 'nein', 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br/>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', @gid, 1, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', '".md5(time() . rand(0,99999))."', 'Authentifizierungs-Token den Sie der IT-Recht Kanzlei mitteilen.<br/>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', @gid, 2, NULL, NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION', '1.0', 'Diese Nummer nur dann ändern, wenn sie von der IT-Recht Kanzlei dazu aufgefordert werden. (Voreinstellung: 1.0)', @gid, 3, NULL, NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 'itrk-agb', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br/>Voreinstellung: itrk-agb', @gid, 4, NULL, NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 'itrk-datenschutz', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br/>Voreinstellung: itrk-datenschutz.', @gid, 5, NULL, NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 'itrk-widerruf', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br/>Voreinstellung: itrk-widerruf.', @gid, 6, NULL, NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 'itrk-impressum', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br/>Voreinstellung: itrk-impressum', @gid, 7, NULL, NOW(), NULL, NULL),
('IT Recht Kanzlei - pdf der AGB', 'IT_RECHT_KANZLEI_PDF_AGB', 'true', 'Sollen die AGB auch als pdf verfügbar sein?', @gid, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('IT Recht Kanzlei - pdf der Datenschutzerklärung', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 'true', 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', @gid, 9, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('IT Recht Kanzlei - pdf der Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 'true', 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', @gid, 10, NULL, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('IT Recht Kanzlei - Speicherort der pdf Datei', 'IT_RECHT_KANZLEI_PDF_FILE', 'includes/pdf', 'In welchem Ordner am Server sollen die pdf gespeichert werden? Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', @gid, 11, NULL, NOW(), NULL, NULL)");


$db->Execute("ALTER TABLE ".TABLE_EZPAGES." ADD page_key varchar(64) NOT NULL default 0");


$db->Execute("INSERT INTO ".TABLE_EZPAGES." (languages_id, pages_title, alt_url, alt_url_external, pages_html_text, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter, page_key) VALUES
(43, 'Datenschutzbestimmungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
(43, 'Widerrufsrecht', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
(43, 'Impressum', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-impressum'),
(43, 'Allgemeine Geschäftsbedingungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb'),
(1, 'Privacy', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
(1, 'Revocation Clause', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
(1, 'Imprint', '', '', '', 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 'itrk-impressum'),
(1, 'Terms and Conditions', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb')");

$admin_page = 'configITRechtKanzlei';
// delete configuration menu
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
// add configuration menu
if (!zen_page_key_exists($admin_page)) {
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'IT Recht Kanzlei'
LIMIT 1;");

$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('configITRechtKanzlei','BOX_CONFIGURATION_IT_RECHT_KANZLEI','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid)");
$messageStack->add('IT Recht Kanzlei Konfiguration erfolgreich hinzugefügt.', 'success');  
}
$admin_page = 'toolsITRechtKanzlei';
// delete tools menu
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
// add tools menu
if (!zen_page_key_exists($admin_page)) {
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'IT Recht Kanzlei'
LIMIT 1;");
$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('toolsITRechtKanzlei','BOX_TOOLS_IT_RECHT_KANZLEI','FILENAME_IT_RECHT_KANZLEI','','tools','Y',100)");      
$messageStack->add('IT Recht Kanzlei Tools-Seite erfolgreich hinzugefügt.', 'success');
}
