<?php
/**
 * Module Template
 *
 * Displays content related to "also-purchased-products"
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
  $zc_show_also_purchased = false;
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_ALSO_PURCHASED_PRODUCTS));
?>

<?php if ($zc_show_also_purchased == true) { ?>
<div class="centerBoxWrapper" id="alsoPurchased">
<?php
  require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
?>
</div>
<?php } ?>
