<?php
/**
 * @package admin
 * @copyright Portions 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: catalog_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$za_contents = array();

if (menu_header_visible('Catalog')=='true') {

  $za_heading = array('text' => BOX_HEADING_CATALOG, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array( 'page' => FILENAME_CATEGORIES, 'box' => BOX_CATALOG_CATEGORIES_PRODUCTS),
          array( 'page' => FILENAME_PRODUCT_TYPES, 'box' => BOX_CATALOG_PRODUCT_TYPES),
          array( 'page' => FILENAME_PRODUCTS_PRICE_MANAGER, 'box' => BOX_CATALOG_PRODUCTS_PRICE_MANAGER),
          array( 'page' => FILENAME_OPTIONS_NAME_MANAGER, 'box' => BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER),
          array( 'page' => FILENAME_OPTIONS_VALUES_MANAGER, 'box' => BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER),
          array( 'page' => FILENAME_ATTRIBUTES_CONTROLLER, 'box' => BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER),
          array( 'page' => FILENAME_DOWNLOADS_MANAGER, 'box' => BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER),
          array( 'page' => FILENAME_PRODUCTS_OPTIONS_NAME, 'box' => BOX_CATALOG_PRODUCT_OPTIONS_NAME),
          array( 'page' => FILENAME_PRODUCTS_OPTIONS_VALUES, 'box' => BOX_CATALOG_PRODUCT_OPTIONS_VALUES),
          array( 'page' => FILENAME_MANUFACTURERS, 'box' => BOX_CATALOG_MANUFACTURERS),
          array( 'page' => FILENAME_REVIEWS, 'box' => BOX_CATALOG_REVIEWS),
          array( 'page' => FILENAME_SPECIALS, 'box' => BOX_CATALOG_SPECIALS),
          array( 'page' => FILENAME_FEATURED, 'box' => BOX_CATALOG_FEATURED),
          array( 'page' => FILENAME_SALEMAKER, 'box' => BOX_CATALOG_SALEMAKER),
          array( 'page' => FILENAME_PRODUCTS_EXPECTED, 'box' => BOX_CATALOG_PRODUCTS_EXPECTED)
          );
  foreach ($options as $key => $value) {
    if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
  }

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/catalog_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }

  echo zen_draw_admin_box($za_heading, $za_contents);

}
?>