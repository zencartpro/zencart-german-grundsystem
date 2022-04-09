<?php
/**
 * Module Template
 *
 * Template stub used to display Gift Certificates box
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_send_or_spend.php 2011-08-09 15:49:16Z hugo13 $
 */

  include(DIR_WS_MODULES . zen_get_module_directory('send_or_spend.php'));
?>
<h2><?php echo BOX_HEADING_GIFT_VOUCHER; ?></h2>
    <p><?php echo TEXT_SEND_OR_SPEND; ?></p>
    <p><?php echo  TEXT_BALANCE_IS . $customer_gv_balance; ?></p>
    <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_GV_SEND, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_SEND_A_GIFT_CERT , BUTTON_SEND_A_GIFT_CERT_ALT) . '</a>'; ?></div>
<br class="clearBoth">
