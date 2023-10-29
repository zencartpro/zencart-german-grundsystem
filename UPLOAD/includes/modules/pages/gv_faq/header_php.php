<?php
/**
 * GV FAQ 
 * 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2023-10-29 21:03:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_GV_FAQ');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$customer_has_gv_balance = false;
$customer_gv_balance = 0;

if (zen_is_logged_in() && !zen_in_guest_checkout()) {
    $customer = new Customer;
    $gv_balance = $customer->getData('gv_balance');
    $customer_has_gv_balance = !empty($gv_balance);
    $customer_gv_balance = !is_null($gv_balance) ? $currencies->format($gv_balance) : false;
}

$gv_faq_item =  (empty($_GET['faq_item'])) ? 0 : (int)$_GET['faq_item'];

$subHeadingText = 'SUB_HEADING_TEXT_' . $gv_faq_item;
$subHeadingTitle = 'SUB_HEADING_TITLE_' . $gv_faq_item;
if (!defined($subHeadingText)) $subHeadingText = 'SUB_HEADING_TEXT_0';
if (!defined($subHeadingTitle)) $subHeadingTitle = 'SUB_HEADING_TITLE_0';
$subHeadingText = constant($subHeadingText);
$subHeadingTitle = constant($subHeadingTitle);

$breadcrumb->add(NAVBAR_TITLE);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_GV_FAQ');
