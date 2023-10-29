<?php
/**
 * column_right module 
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: column_right.php 2023-10-29 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
use App\Models\LayoutBox;
use Zencart\ResourceLoaders\SideboxFinder;
use Zencart\FileSystem\FileSystem;

$column_box_default='tpl_box_default_right.php';
// Check if there are boxes for the column
$sideboxes = LayoutBox::where('layout_box_location', 1)
                      ->where('layout_box_status', 1)
                      ->where('layout_template', $template_dir)
                      ->orderBy('layout_box_sort_order')
                      ->limit(100)->get();

$column_width = (int)BOX_WIDTH_RIGHT;
foreach ($sideboxes as $sidebox) {
    $boxFile = (new SideboxFinder(new FileSystem))->sideboxPath($sidebox, $template_dir, true);
    if ($boxFile !== false) {
        $box_id = zen_get_box_id($sidebox['layout_box_name']);
        include($boxFile . $sidebox['layout_box_name']);
    }
}
$box_id = '';
