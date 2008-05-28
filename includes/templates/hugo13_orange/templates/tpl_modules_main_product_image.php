<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?>
<div id="productMainImage" class="centeredContent back">
<!-- bof Zen Lightbox v1.4 aclarke 2007-09-15 -->
<?php

if ($current_page_base == 'product_reviews') {

$zen_lightbox_products_name = $products_name_reviews_page;

} else {

$zen_lightbox_products_name = $products_name;

}

if (ZEN_LIGHTBOX_STATUS == 'true') {

echo '<script language="javascript" type="text/javascript"><!--
document.write(\'<a href="' . zen_lightbox($products_image_large, addslashes($products_name), LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT) . '" rel="lightbox[gallery]" title="' . addslashes($zen_lightbox_products_name) . '">' . zen_image($products_image_medium, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>\')//--></script>';

} else {

echo '<script language="javascript" type="text/javascript"><!--
document.write(\'<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '\\\')">' . zen_image($products_image_medium, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>\')//--></script>';

}

?>
<!-- eof Zen Lightbox v1.4 aclarke 2007-09-15 -->
<noscript>
<?php
  echo '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '" target="_blank">' . zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
?>
</noscript>
</div>