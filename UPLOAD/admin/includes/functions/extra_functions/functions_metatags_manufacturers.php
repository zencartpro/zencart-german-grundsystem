<?php
/**
* @package manufacturer metatags
* @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: functions_metatags_manufacturers.php 1 2019-07-27 11:23:04 webchills $
*/

/**
 * Manufacturers specific metatags
 */
function zen_get_manufacturer_metatags_title ($manufacturer_id, $language_id) {
  global $db;
  $category = $db->Execute ("SELECT * FROM " . TABLE_MANUFACTURERS_META . " WHERE manufacturers_id = " . (int)$manufacturer_id . " AND language_id = " . (int)$language_id . " LIMIT 1");
  
  return ($category->EOF) ? '' : $category->fields['metatags_title'];
}

function zen_get_manufacturer_metatags_description ($manufacturer_id, $language_id) {
  global $db;
  $category = $db->Execute ("SELECT * FROM " . TABLE_MANUFACTURERS_META . " WHERE manufacturers_id = " . (int)$manufacturer_id . " AND language_id = " . (int)$language_id . " LIMIT 1");

  return ($category->EOF) ? '' : $category->fields['metatags_description'];
}

function zen_get_manufacturer_metatags_keywords ($manufacturer_id, $language_id) {
  global $db;
  $category = $db->Execute ("SELECT * FROM " . TABLE_MANUFACTURERS_META . " WHERE manufacturers_id = " . (int)$manufacturer_id . " AND language_id = " . (int)$language_id . " LIMIT 1");

  return ($category->EOF) ? '' : $category->fields['metatags_keywords'];
}