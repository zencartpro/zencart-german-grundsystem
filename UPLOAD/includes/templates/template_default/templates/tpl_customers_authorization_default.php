<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=customers_authorization.<br />
 * Displays information if customer authorization checks fail.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_customers_authorization_default.php 730 2020-01-17 15:49:16Z webchills $
 */
?>
<div class="centerColumn" id="customerAuthDefault">

<h1 id="customerAuthDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="customerAuthDefaultImage"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_CUSTOMERS_AUTHORIZATION, OTHER_IMAGE_CUSTOMERS_AUTHORIZATION_ALT); ?></div>

<div id="customerAuthDefaultMainContent" class="content"><?php echo CUSTOMERS_AUTHORIZATION_TEXT_INFORMATION; ?></div>

<div id="customerAuthDefaultSecondaryContent" class="content"><?php echo CUSTOMERS_AUTHORIZATION_STATUS_TEXT; ?></div>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(CUSTOMERS_AUTHORIZATION_FILENAME) . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>

</div>
