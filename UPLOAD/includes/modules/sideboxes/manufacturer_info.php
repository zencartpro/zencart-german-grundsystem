<?php
/**
 * manufacturer_info sidebox - displays extra info about the selected product's manufacturer details (if defined in Admin->Catalog->Manufacturers)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: manufacturer_info.php 2022-04-09 16:17:16Z webchills $
 */

  if (isset($_GET['products_id'])) {
    $sql = "SELECT m.manufacturers_id, m.manufacturers_name, m.manufacturers_image,
                   mi.manufacturers_url
            FROM " . TABLE_MANUFACTURERS . " m
            LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " mi ON (m.manufacturers_id = mi.manufacturers_id AND mi.languages_id = " . (int)$_SESSION['languages_id'] . ")
            INNER JOIN " . TABLE_PRODUCTS . " p ON (p.manufacturers_id = m.manufacturers_id)
            WHERE p.products_id = " . (int)$_GET['products_id'];

    $manufacturer_info_sidebox = $db->Execute($sql);

    if ($manufacturer_info_sidebox->RecordCount() > 0) {

      require($template->get_template_dir('tpl_manufacturer_info.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_manufacturer_info.php');
      $title =  BOX_HEADING_MANUFACTURER_INFO;
      $title_link = false;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
    }
  }