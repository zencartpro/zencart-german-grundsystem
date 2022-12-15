<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_main_page.php 2022-11-26 08:22:16Z webchills $
 */

?>
<body id="popupImage" class="centeredContent" onload="resize();">
<div>
<?php
  // $products_values->fields['products_image']
  echo '<a href="javascript:window.close()">' . zen_image($products_image_large, $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW_IMAGE) . '</a>';
?>
</div>
</body>