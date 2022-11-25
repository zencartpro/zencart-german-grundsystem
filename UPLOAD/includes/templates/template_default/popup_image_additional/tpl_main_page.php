<?php
/**
 * Override Template for common/tpl_main_page.php
 * Zen Cart German Specific (158 code in 157?
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_main_page.php 2022-11-25 16:00:52Z webchills $
 */
?>
<body id="popupAdditionalImage" class="centeredContent" onload="resize();">
<div>
<?php
// $products_values->fields['products_image']
  if (file_exists($_GET['products_image_large_additional'])) {
    echo '<a href="javascript:window.close()">' . zen_image($_GET['products_image_large_additional'], (isset($products_values->fields['products_name']) ? $products_values->fields['products_name'] . ' ' : '') . TEXT_CLOSE_WINDOW_IMAGE) . '</a>';
  } else {
    echo '<a href="javascript:window.close()">' . zen_image(DIR_WS_IMAGES . $products_image, (isset($products_values->fields['products_name']) ? $products_values->fields['products_name'] . ' ' : '') . TEXT_CLOSE_WINDOW_IMAGE) . '</a>';
  }
?>
</div>
</body>
