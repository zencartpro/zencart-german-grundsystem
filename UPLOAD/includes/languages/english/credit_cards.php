<?php
/**
* Zen Cart German Specific (158 code in 157)
* @copyright Copyright 2003-2023 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: credit_cards.php 2023-10-29 17:49:16Z webchills $
*/


if (!defined('SHOW_ACCEPTED_CREDIT_CARDS')) {
return;
}
global $template, $current_page_base; 

define('TEXT_ACCEPTED_CREDIT_CARDS', '<strong>We accept:</strong> ');

define('TEXT_CC_ENABLED_VISA','Visa');
define('TEXT_CC_ENABLED_MC','MC');
define('TEXT_CC_ENABLED_AMEX','AmEx');
define('TEXT_CC_ENABLED_DINERS_CLUB','Diners Club');
define('TEXT_CC_ENABLED_DISCOVER','Discover');
define('TEXT_CC_ENABLED_JCB','JCB');
define('TEXT_CC_ENABLED_AUSTRALIAN_BANKCARD','Australian Bankcard');
define('TEXT_CC_ENABLED_SOLO','Solo');
define('TEXT_CC_ENABLED_DEBIT','Debit');
define('TEXT_CC_ENABLED_MAESTRO','Maestro');

define('IMAGE_CC_ENABLED_VISA', zen_image($template->get_template_dir('cc1.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc1.gif'));
define('IMAGE_CC_ENABLED_MC', zen_image($template->get_template_dir('cc2.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc2.gif'));
define('IMAGE_CC_ENABLED_AMEX', zen_image($template->get_template_dir('cc3.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc3.gif'));
define('IMAGE_CC_ENABLED_DINERS_CLUB', zen_image($template->get_template_dir('cc4.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc4.gif'));
define('IMAGE_CC_ENABLED_DISCOVER', zen_image($template->get_template_dir('cc5.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc5.gif'));
define('IMAGE_CC_ENABLED_JCB', zen_image($template->get_template_dir('cc6.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc6.gif'));
define('IMAGE_CC_ENABLED_AUSTRALIAN_BANKCARD', zen_image($template->get_template_dir('cc7.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc7.gif'));
define('IMAGE_CC_ENABLED_SOLO', zen_image($template->get_template_dir('cc8.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc8.gif'));
define('IMAGE_CC_ENABLED_DEBIT', zen_image($template->get_template_dir('cc9.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc9.gif'));
define('IMAGE_CC_ENABLED_MAESTRO', zen_image($template->get_template_dir('cc10.gif', DIR_WS_TEMPLATE, $current_page_base, 'images/icons') . '/' . 'cc10.gif'));