<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_main_page.php 729 2011-08-09 15:49:16Z hugo13 $
 */

?>
<body id="popupImage" class="centeredContent" onload="resize();">
<div>
<?php
  // $products_values->fields['products_image']
  echo '<a href="javascript:window.close()">' . zen_image($products_image_large, $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
?>
</div>
</body>