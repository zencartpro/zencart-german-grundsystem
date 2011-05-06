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

// Updated to 1.3 standard (XHTML compliant) 2006/06/07  Rick Suffolk
// Edited by: Ian Manson thor@paradise.net.nz 2006 08 13 to include some my account links when actually logged in
// Updated 2007 12 10 for compatibility with v1.3.8

$content = "<!-- loginSideBox -->" . "\n\n";
$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';

if(!$_SESSION['customer_id']) {

   $content .=zen_draw_form('login_box', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginFormSidebox"');
   $content .=LOGIN_BOX_EMAIL_ADDRESS . '<br />' . zen_draw_input_field('email_address', '', 'size="20"').'<br />';
   $content .=LOGIN_BOX_PASSWORD . '<br />' . zen_draw_password_field('password', '', 'size="20"') . '<br />';
   $content .='<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . LOGIN_BOX_PASSWORD_FORGOTTEN . '</a>' . '<br />' . '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . LOGIN_BOX_CREATE_ACCOUNT . '</a>' . '<br />';
   $content .= zen_draw_hidden_field('securityToken', $_SESSION['securityToken']);
   $content .='<br /><div class="centeredContent">'.zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT).'</div>';
   $content .='</form>';
}  else {
   
   $content .= '<div class="centeredContent">' . LOGIN_BOX_WELCOMEUSER . '</div>';
   $content .= '<div class="centeredContent">' . $_SESSION['customer_first_name'] . ' ' . $_SESSION['customer_last_name'] . '</div>';
   $content .= '<ul>';
   $content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT . '</a></li>';
   $content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . LOGIN_BOX_SHOPPING_CART . '</a></li>';
   //$content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_LOGOFF, '', 'SSL') . '">' . LOGIN_BOX_LOGOFF . '</a></li>';
   $content .= '</ul>';
   $content .= '<div class="centeredContent"><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_LOGOFF, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_LOG_OFF, BUTTON_LOG_OFF_ALT) . '</a></div>';
}

$content .= '</div>';

