<?php
/**
 * @package IH3
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright 2005-2006 Tim Kroeger (original author)
 * @revisited by ckosloff/DerManoMann/C Jones/Nigelt74/K Hudson/Nagelkruid
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * 2011-05-13 12:46:50 webchills$
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