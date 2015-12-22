<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: languages.php 729 2014-02-08 15:49:16Z webchills $
 */
//

  function zen_get_languages_directory($code) {
    global $db;
    $language = $db->Execute("select languages_id, directory 
                              from " . TABLE_LANGUAGES . " 
                              where code = '" . zen_db_input($code) . "'");

    if ($language->RecordCount() > 0) {
      $_SESSION['languages_id'] = $language->fields['languages_id'];
      return $language->fields['directory'];
    } else {
      return false;
    }
  }
?>