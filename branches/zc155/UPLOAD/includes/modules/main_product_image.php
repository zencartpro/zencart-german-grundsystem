<?php
/**
 * main_product_image module
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_product_imag.php 2014-03-28 12:38:06Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$products_image_extension = substr($products_image, strrpos($products_image, '.'));
$products_image_base = preg_replace('/'.$products_image_extension . '$/', '', $products_image);
$products_image_medium = DIR_WS_IMAGES . 'medium/' . $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extension;
$products_image_large  = DIR_WS_IMAGES . 'large/' . $products_image_base . IMAGE_SUFFIX_LARGE .  $products_image_extension;