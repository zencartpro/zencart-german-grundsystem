<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php with Image Handler 730 2012-11-30 18:49:16Z webchills $
 */
?>
<body id="popupAdditionalImage" class="centeredContent" onload="resize();">
<div>
<?php
// $products_values->fields['products_image']
//Begin Image Handler changes 1 of 2
//the next line is commented out for Image Handler 4
//  if (file_exists($_GET['products_image_large_additional'])) {
//End Image Handler changes 1 of 2
  echo '<a href="javascript:window.close()">' . zen_image($_GET['products_image_large_additional'], $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
//Begin Image Handler changes 2 of 2
//the next three lines are commented out for Image Handler 4
//  } else {
//    echo '<a href="javascript:window.close()">' . zen_image(DIR_WS_IMAGES . $products_image, $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
//  }
//End Image Handler changes 2 of 2
?>
</div>
</body>