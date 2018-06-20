<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zen_colorbox.php 2018-06-13 webchills $
 */

function zen_colorbox($src, $alt = '', $width = '', $height = '', $parameters = '') {
  global $template_dir;
  
  //auto replace with defined missing image
  if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
    $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
  }

  if ((empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false')) {
    return false;
  }

  // if not in current template switch to template_default
  if (!file_exists($src)) {
    $src = str_replace(DIR_WS_TEMPLATES . $template_dir, DIR_WS_TEMPLATES . 'template_default', $src);
  }

  // hook for handle_image() function such as Image Handler etc
  if (function_exists('handle_image')) {
    $newimg = handle_image($src, $alt, $width, $height, $parameters);
    list($src, $alt, $width, $height, $parameters) = $newimg; 
  }

  $basepath = "";
  $realBase = realpath($basepath);
  $userpath = $basepath . $src;
  $realUserPath = realpath($userpath);

  if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
      $src = ''; // This is chosen as compared to say a missing image file as a security related action.  Basically in a working, secure system there should be no reason that this is ever executed.
  }

  $image = zen_output_string($src);

  return $image;
}
