<?php
/** 
 * Zen Cart German Specific (zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: multilanguage_country_names_functions.php 2023-10-31 12:49:16Z webchills $
 */
  function zen_get_multilanguagecountry_name($country_id, $lang_id = '') {
    global $db;

    $language_id = (empty($lang_id) ? (int)$_SESSION['languages_id'] : $lang_id);

    $country = $db->Execute("SELECT countries_name
                             FROM " . TABLE_COUNTRIES_NAME . "
                             WHERE countries_id = " . (int)$country_id . "
                             AND language_id = " . (int)$language_id);

    if ($country->RecordCount() < 1) {
      return $country_id;
    } else {
      return $country->fields['countries_name'];
    }
  }