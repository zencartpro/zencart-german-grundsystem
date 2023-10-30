<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: functions_music_products.php 2023-10-30 14:57:16Z webchills $
 */

function zen_update_music_artist_clicked($artistId, $languageId)
{
    global $db;
    $sql = "UPDATE " . TABLE_RECORD_ARTISTS_INFO . " SET url_clicked = url_clicked +1, date_last_click = NOW() WHERE artists_id = :artistId: AND languages_id = :languageId:";
    $sql = $db->bindVars($sql, ':artistId:', $artistId, 'integer');
    $sql = $db->bindVars($sql, ':languageId:', $languageId, 'integer');
    $db->execute($sql);
}

function zen_update_record_company_clicked($recordCompanyId, $languageId)
{
    global $db;
    $sql = "UPDATE " . TABLE_RECORD_COMPANY_INFO . " SET url_clicked = url_clicked +1, date_last_click = NOW() WHERE record_company_id = :rcId: AND languages_id = :languageId:";
    $sql = $db->bindVars($sql, ':rcId:', $recordCompanyId, 'integer');
    $sql = $db->bindVars($sql, ':languageId:', $languageId, 'integer');
    $db->execute($sql);
}
