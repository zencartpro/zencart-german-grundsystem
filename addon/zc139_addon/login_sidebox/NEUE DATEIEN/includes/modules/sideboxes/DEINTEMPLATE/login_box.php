<?php
/**
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: login_box.php 2003/11/21 22:55:46 ajeh $
 */


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