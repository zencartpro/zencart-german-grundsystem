<?php
/**
 * banner_box sidebox - used to display "square" banners in sideboxes
 *
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: banner_box.php 2020-01-17 13:49:16Z webchills $
 */

// test if box should display
$show_banner_box = true;
if (SHOW_BANNERS_GROUP_SET7 == '') {
  $show_banner_box = false;
}

if ($show_banner_box == true) {
  $banner_box = array();
  $banner_box[] = TEXT_BANNER_BOX;
  $banner_box_group= SHOW_BANNERS_GROUP_SET7;

  require($template->get_template_dir('tpl_banner_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_banner_box.php');

// if no active banner in the specified banner group then the box will not show
// uses banners in the defined group $banner_box_group
  if ($content != '') {
    $title =  BOX_HEADING_BANNER_BOX;
    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
  }
}
