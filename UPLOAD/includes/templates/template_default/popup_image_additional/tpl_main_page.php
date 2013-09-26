<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 731 2013-01-26 13:49:16Z webchills $
 */
?>
<body id="popupAdditionalImage" class="centeredContent" onload="resize();">
<div>
<?php
// $products_values->fields['products_image']
  if (file_exists($_GET['products_image_large_additional'])) {
    echo '<a href="javascript:window.close()">' . zen_image($_GET['products_image_large_additional'], $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
  } else {
    echo '<a href="javascript:window.close()">' . zen_image(DIR_WS_IMAGES . $products_image, $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
  }
?>
</div>
</body>