<?php
/**
 
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: product_music_functions.php 2023-10-31 12:49:16Z webchills $
 */
//
 
////
// Return the artists URL in the needed language
  function zen_get_artists_url($artists_id, $language_id) {
    global $db;
    $artist = $db->Execute("select artists_url
                                  from " . TABLE_RECORD_ARTISTS_INFO . "
                                  where artists_id = '" . (int)$artists_id . "'
                                  and languages_id = '" . (int)$language_id . "'");
    if ($artist->EOF) return '';
    return $artist->fields['artists_url'];
  }
////
// Return the Record Company URL in the needed language
  function zen_get_record_company_url($record_company_id, $language_id) {
    global $db;
    $record_company = $db->Execute("select record_company_url
                                  from " . TABLE_RECORD_COMPANY_INFO . "
                                  where record_company_id = '" . (int)$record_company_id . "'
                                  and languages_id = '" . (int)$language_id . "'");
    if ($record_company->EOF) return '';
    return $record_company->fields['record_company_url'];
  }

////
// Return the Music Genre URL in the needed language
  function zen_get_music_genre_url($music_genre_id, $language_id) {
    global $db;
    $music_genre = $db->Execute("select music_genre_url
                                  from " . TABLE_RECORD_COMPANY_INFO . "
                                  where music_genre_id = '" . (int)$music_genre_id . "'
                                  and languages_id = '" . (int)$language_id . "'");
    if ($music_genre->EOF) return '';
    return $music_genre->fields['music_genre_url'];
  }