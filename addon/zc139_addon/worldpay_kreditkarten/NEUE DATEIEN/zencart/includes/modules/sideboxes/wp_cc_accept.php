<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: cc_accept.php,v 1.0 2004/10/15 
// Copied from featured.php and modified by Carter Harris charris@technettn.net
// Further copied by duncanad 2004/12/12
// 

// test if box should display
  $show_wp_cc_accept = true;

  if ($show_wp_cc_accept == true) {
      require($template->get_template_dir('tpl_wp_cc_accept.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_wp_cc_accept.php');
      $title =  BOX_HEADING_WP_CC_ACCEPT;
      $left_corner = false;
      $right_corner = false;
      $right_arrow = false;
	  $title_link = false;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
 }
?>