<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2005-2006 Tim Kroeger
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 */
?>
<body id="popupAdditionalImage" class="centeredContent" onload="resize();">
<div>
<?php
// $products_values->fields['products_image']
//Begin Image Handler changes 1 of 2
//the next line is commented out for Image Handler 3
//  if (file_exists($_GET['products_image_large_additional'])) {
//End Image Handler changes 1 of 2
  echo '<a href="javascript:window.close()">' . zen_image($_GET['products_image_large_additional'], $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
//Begin Image Handler changes 2 of 2
//the next three lines are commented out for Image Handler 3
//  } else {
//    echo '<a href="javascript:window.close()">' . zen_image(DIR_WS_IMAGES . $products_image, $products_values->fields['products_name'] . ' ' . TEXT_CLOSE_WINDOW) . '</a>';
//  }
//End Image Handler changes 2 of 2
?>
</div>
</body>