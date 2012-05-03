<?php
/**
 * @package admin
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @version $Id: functions_metatags_manufacturers.php 2012-03-26 19:46:29Z webchills $
 */


/**
 * Manufacturers specific metatags
 */
  function zen_get_manufacturer_metatags_manu_title($manufacturer_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_title
                              from ".TABLE_MANUFACTURERS_META.
                              " where manufacturers_id = '" . (int)$manufacturer_id . "'
                              and language_id = '" . (int)$language_id . "'");

    return $category->fields['metatags_title'];
  }

  function zen_get_manufacturer_metatags_manu_description($manufacturer_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_description
                              from ".TABLE_MANUFACTURERS_META.
                              " where manufacturers_id = '" . (int)$manufacturer_id . "'
                              and language_id = '" . (int)$language_id . "'");

    return $category->fields['metatags_description'];
  }

  function zen_get_manufacturer_metatags_manu_keywords($manufacturer_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_keywords
                              from ".TABLE_MANUFACTURERS_META.
                              " where manufacturers_id = '" . (int)$manufacturer_id . "'
                              and language_id = '" . (int)$language_id . "'");

    return $category->fields['metatags_keywords'];
  }

 
?>