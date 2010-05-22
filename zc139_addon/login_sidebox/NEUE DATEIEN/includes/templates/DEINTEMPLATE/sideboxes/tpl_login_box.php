<?php
/**
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: login_box.php 2010-05-22 18:37:46 webchills $
 */

$content = "<!--loginSideBox-->";
$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">';

if(!$_SESSION['customer_id']) {

   $content .=zen_draw_form('login_box', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));
   $content .=LOGIN_BOX_EMAIL_ADDRESS . '<br />' . zen_draw_input_field('email_address', '', 'size="24"').'<br />';
   $content .=LOGIN_BOX_PASSWORD . '<br />' . zen_draw_password_field('password', '', 'size="24"') . '<br />';
   $content .= zen_draw_hidden_field('securityToken', $_SESSION['securityToken']);
   $content .='<div class="centeredContent">'.zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT).'</div>';
   $content .='</form>';
   $content .='<br/><a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . LOGIN_BOX_PASSWORD_FORGOTTEN . '</a>' . '<br />' . '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . LOGIN_BOX_CREATE_ACCOUNT . '</a>' . '<br />';
}  else {
   
   $content .= '<ul>';
   $content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT . '</a></li>';
   $content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . LOGIN_BOX_SHOPPING_CART . '</a></li>';
   $content .= '<li><a class="loginBoxLinks" href="' . zen_href_link(FILENAME_LOGOFF, '', 'SSL') . '">' . LOGIN_BOX_LOGOFF . '</a></li>';
   $content .= '</ul>';
}

$content .= '</div>';

?>