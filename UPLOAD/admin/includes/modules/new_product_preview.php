<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_product_preview.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// copy image only if modified
        if (!isset($_GET['read']) || $_GET['read'] == 'only') {
          $products_image = new upload('products_image');
          $products_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
          if ($products_image->parse() && $products_image->save($_POST['overwrite'])) {
            $products_image_name = $_POST['img_dir'] . $products_image->filename;
          } else {
            $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
          }
        }
?>