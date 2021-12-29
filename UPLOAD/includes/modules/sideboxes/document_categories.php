<?php
/**
 * document_categories sidebox - displays the categories sidebox containing ONLY "document" products (product type = 3)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: document_categories.php 730 2015-12-22 09:49:16Z webchills $
 */

    $main_category_tree = new category_tree;
    $row = 0;
    $box_categories_array = array();

// don't build a tree when no categories
    $check_categories = $db->Execute("select c.categories_id from " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCT_TYPES . " pt, " . TABLE_PRODUCT_TYPES_TO_CATEGORY . " ptc where pt.type_master_type = 3 and ptc.product_type_id = pt.type_id and c.categories_id = ptc.category_id and c.categories_status=1 limit 1");
    if ($check_categories->RecordCount() > 0) {
      $box_categories_array = $main_category_tree->zen_category_tree(3);
      require($template->get_template_dir('tpl_document_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_document_categories.php');

      $title = BOX_HEADING_DOCUMENT_CATEGORIES;
      $title_link = false;

      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
    }

