<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_music_functions.php 729 2014-02-08 15:49:16Z webchills $
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

    return $music_genre->fields['music_genre_url'];
  }
?>
