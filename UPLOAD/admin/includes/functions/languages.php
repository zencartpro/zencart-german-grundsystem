<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: languages.php 731 2021-10-25 17:49:16Z webchills $
 */
//

function zen_get_languages_directory($code)
{
  global $db;
  $language = $db->Execute("SELECT languages_id, directory
                            FROM " . TABLE_LANGUAGES . " 
                            WHERE code = '" . zen_db_input($code) . "'");

  if ($language->RecordCount() > 0) {
    $_SESSION['languages_id'] = (int)$language->fields['languages_id'];
    return $language->fields['directory'];
  } else {
    return false;
  }
}