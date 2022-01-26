<?php
/**
 * Cross Sell Advanced
 * Zen Cart German Specific
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for Zen Cart v1.5.7+, lat9, December 2021
 
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_xsell_products.php 2022-01-26 16:56:51 webchills $
 */
// calculate whether any cross-sell products are configured for the current product, and display if relevant
require DIR_WS_MODULES . zen_get_module_directory(FILENAME_XSELL_PRODUCTS);

if (!empty($xsell_data)) {
    $list_box_contents = $xsell_data;
    $title = '<h2 class="centerBoxHeading">' . TEXT_XSELL_PRODUCTS . '</h2>';
?>
<div class="centerBoxWrapper" id="crossSell">
<?php
/**
 * require the list_box_content template to display the cross-sell info. This info was prepared in modules/xsell_products.php
 */
require $template->get_template_dir('tpl_columnar_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common') . '/tpl_columnar_display.php';
?>
</div>
<?php
}
