<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: 1_0_1.php 2018-06-19 18:55:51Z webchills $
 */

$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '1.0.1' WHERE configuration_key = 'IT_RECHT_KANZLEI_MODUL_VERSION' LIMIT 1;");
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '".md5(time() . rand(0,99999))."' WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN' LIMIT 1;");

//check if page_key column already exists - if not add it and prefill IT Recht Kanzlei EZ pages
    $sql ="SHOW COLUMNS FROM ".TABLE_EZPAGES." LIKE 'page_key'";
    $result = $db->Execute($sql);
    if(!$result->RecordCount())
    {
    $sql = "ALTER TABLE ".TABLE_EZPAGES." ADD page_key varchar(64) NOT NULL DEFAULT 0";
    $db->Execute($sql);
    $db->Execute("INSERT IGNORE INTO ".TABLE_EZPAGES." (languages_id, pages_title, alt_url, alt_url_external, pages_html_text, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter, page_key) VALUES
    (43, 'Datenschutzbestimmungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
    (43, 'Widerrufsrecht', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
    (43, 'Impressum', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-impressum'),
    (43, 'Allgemeine Geschäftsbedingungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb'),
    (1, 'Privacy', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
    (1, 'Revocation Clause', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
    (1, 'Imprint', '', '', '', 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 'itrk-impressum'),
    (1, 'Terms and Conditions', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb')");
    } 