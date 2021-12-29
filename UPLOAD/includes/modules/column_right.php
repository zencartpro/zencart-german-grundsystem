<?php
/**
 * column_right module 
 *
 * @package templateStructure
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: column_right.php 2020-02-29 21:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$column_box_default='tpl_box_default_right.php';
// Check if there are boxes for the column
$column_right_display= $db->Execute("select layout_box_name from " . TABLE_LAYOUT_BOXES . " where layout_box_location=1 and layout_box_status=1 and layout_template ='" . $template_dir . "'" . ' order by layout_box_sort_order');

// safety row stop
$box_cnt=0;
$column_width = (int)BOX_WIDTH_RIGHT;
while (!$column_right_display->EOF and $box_cnt < 100) {
  $box_cnt++;
  $box_file = DIR_WS_MODULES . zen_get_module_sidebox_directory($column_right_display->fields['layout_box_name']);
  if (file_exists($box_file)) {
    $box_id = zen_get_box_id($column_right_display->fields['layout_box_name']);
    include($box_file);
  }

  $column_right_display->MoveNext();
} // while column_right
$box_id = ''; 
?>
