<?php
/**
 * Zen Colorbox
 * Zen Cart German Specific
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: zen_colorbox.php 2019-06-17 09:37:12 webchills $
 */

if (ZEN_COLORBOX_STATUS == 'true') {
    if (ZEN_COLORBOX_GALLERY_MODE == 'true') {
      $rel = 'colorbox';
    } else {
      $rel = 'colorbox-' . rand(100, 999);
    }
    $script_link = '<script type="text/javascript"><!--' . "\n" . 'document.write(\'' . ($flag_display_large ? '<a href="' . zen_colorbox($products_image_large, addslashes($products_name), LARGE_IMAGE_MAX_WIDTH, LARGE_IMAGE_MAX_HEIGHT) . '" rel="' . $rel . '" title="' . addslashes($products_name) . '">' . $thumb_slashes . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>' : $thumb_slashes) . '\');' . "\n" . '//--></script>';
  } else {
    $script_link = '<script type="text/javascript"><!--' . "\n" . 'document.write(\'' . ($flag_display_large ? '<a href="javascript:popupWindow(\\\'' . str_replace($products_image_large, urlencode(addslashes($products_image_large)), $large_link) . '\\\')">' . $thumb_slashes . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>' : $thumb_slashes) . '\');' . "\n" . '//--></script>';
  }
