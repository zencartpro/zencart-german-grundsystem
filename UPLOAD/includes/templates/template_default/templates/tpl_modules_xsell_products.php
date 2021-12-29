<?php
/**
 * @package Cross Sell Advanced
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for ZenCart V1.5.2 by RodG Dec 2013   
 * Reworked for ZenCart V1.5.6 by webchills Aug 2019
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_xsell_products.php 2021-12-28 21:56:51 webchills $
 */

// calculate whether any cross-sell products are configured for the current product, and display if relevant
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_XSELL_PRODUCTS));
$xsell_data = $list_box_contents;
if (zen_not_null($xsell_data)) {
  $info_box_contents = array();
  $list_box_contents = $xsell_data;
  $title = '';
?>
<!-- bof: tpl_modules_xsell_products -->
<div class="centerBoxWrapper" id="crossSell">
<h2 class="centerBoxHeading"><?php echo TEXT_XSELL_PRODUCTS; ?></h2>
<?php
/**
 * require the list_box_content template to display the cross-sell info. This info was prepared in modules/xsell_products.php
 */
require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
?>
</div>
<!-- eof: tpl_modules_xsell_products -->
<?php } ?>