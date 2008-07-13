<?php
//
// +----------------------------------------------------------------------+
// | Live Help 1.1 for Zen Cart                                           |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 Bao Bao E-commerce                                |
// |                                                                      |
// | http://www.buybaobao.com                                             |
// |                                                                      |
// | Portions Copyright (c) 2006 Bao Bao E-commerce                       |
// +----------------------------------------------------------------------+
//

  require($template->get_template_dir('tpl_live_help.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_live_help.php');

  $title =  BOX_HEADING_LH_TITLE;
  $left_corner = false;
  $right_corner = false;
  $right_arrow = false;
  $title_link = false;

  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>
