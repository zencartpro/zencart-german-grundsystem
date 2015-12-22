<?php
/**
 * metatags retrieval functions for admin
 *
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_metatags.php 730 2014-02-08 15:49:16Z webchills $
 * @no-docs
 */

/**
 * product-specific meta tags
 */
  function zen_get_metatags_title($product_id, $language_id) {
    global $db;
    $product = $db->Execute("select metatags_title
                             from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . "
                             where products_id = '" . (int)$product_id . "'
                             and language_id = '" . (int)$language_id . "'");
    if ($product->EOF) return '';
    return $product->fields['metatags_title'];
  }

  function zen_get_metatags_keywords($product_id, $language_id) {
    global $db;
    $product = $db->Execute("select metatags_keywords
                             from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . "
                             where products_id = '" . (int)$product_id . "'
                             and language_id = '" . (int)$language_id . "'");
    if ($product->EOF) return '';
    return $product->fields['metatags_keywords'];
  }

  function zen_get_metatags_description($product_id, $language_id) {
    global $db;
    $product = $db->Execute("select metatags_description
                             from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . "
                             where products_id = '" . (int)$product_id . "'
                             and language_id = '" . (int)$language_id . "'");
    if ($product->EOF) return '';
    return $product->fields['metatags_description'];
  }

/**
 * Category-specific metatags
 */
  function zen_get_category_metatags_title($category_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_title
                              from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . "
                              where categories_id = '" . (int)$category_id . "'
                              and language_id = '" . (int)$language_id . "'");
    if ($category->EOF) return '';
    return $category->fields['metatags_title'];
  }

  function zen_get_category_metatags_description($category_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_description
                              from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . "
                              where categories_id = '" . (int)$category_id . "'
                              and language_id = '" . (int)$language_id . "'");
    if ($category->EOF) return '';
    return $category->fields['metatags_description'];
  }

  function zen_get_category_metatags_keywords($category_id, $language_id) {
    global $db;
    $category = $db->Execute("select metatags_keywords
                              from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . "
                              where categories_id = '" . (int)$category_id . "'
                              and language_id = '" . (int)$language_id . "'");
    if ($category->EOF) return '';
    return $category->fields['metatags_keywords'];
  }

