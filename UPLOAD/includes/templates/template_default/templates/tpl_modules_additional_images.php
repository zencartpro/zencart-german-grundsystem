<?php
/**
 * Module Template:
 * Loaded by product-type template to display additional product images.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_modules_additional_images.php 729 2011-08-09 15:49:16Z hugo13 $
 */

  require(DIR_WS_MODULES . zen_get_module_directory('additional_images.php'));
 ?>
 <?php
 if ($flag_show_product_info_additional_images != 0 && $num_images > 0) {
  ?>
<div id="productAdditionalImages">
<?php
  require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php'); ?>
</div>
<?php 
  }
?>