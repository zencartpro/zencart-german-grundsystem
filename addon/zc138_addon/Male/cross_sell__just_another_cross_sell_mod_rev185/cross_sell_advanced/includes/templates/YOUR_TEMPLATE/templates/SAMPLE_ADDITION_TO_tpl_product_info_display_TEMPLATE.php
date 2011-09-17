<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 */
?>

<!-- BOF: Cross-Sell information -->
<?php
// THIS CODE WOULD BE ADDED INTO YOUR TPL_PRODUCT_INFO_DISPLAY.PHP WHEREVER YOU WANT TO DISPLAY THE CROSS_SELL BOX:
  require($template->get_template_dir('tpl_modules_xsell_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_xsell_products.php');
?>
<!-- EOF: Cross-Sell information -->
