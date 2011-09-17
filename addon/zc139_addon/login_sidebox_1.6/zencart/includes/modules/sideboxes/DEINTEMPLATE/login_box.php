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
// $Id$
//

// Designed for Zen Cart v1.00 Alpha
// Created by: Linda McGrath ZenCart@WebMakers.com
// http://www.thewebmakerscorner.com

// Edited by: Ian Manson thor@paradise.net.nz 2006 08 13
// to include my account links when actually logged in

// show box when not logged in, and not when login/create account/forgot password pages are showing
// change title of box when logged in

  if (($_GET['main_page'] != FILENAME_LOGIN && $_GET['main_page'] != FILENAME_CREATE_ACCOUNT && $_GET['main_page'] != FILENAME_PASSWORD_FORGOTTEN)) {

      $login_box[] = TEXT_LOGIN_BOX;

      if ((!$_SESSION['customer_id'])) {
            $title =  BOX_HEADING_LOGIN_BOX;
      } else {
            $title =  BOX_HEADING_LOGGEDIN_BOX;
      }

      require($template->get_template_dir('tpl_login_box.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_login_box.php');

      $left_corner = false;
      $right_corner = false;
      $right_arrow = false;
      $title_link = false;

      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
 }
?>