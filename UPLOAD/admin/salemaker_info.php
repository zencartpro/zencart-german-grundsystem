<?php
/**
 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: salemaker_info.php 2023-10-23 18:13:51Z webchills $
 */
//
require("includes/application_top.php");
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
  </head>
  <body>
    <h1 class="text-center"><?php echo HEADING_TITLE; ?></h1>
    <?php echo zen_draw_separator(); ?>
    <h3><?php echo SUBHEADING_TITLE; ?></h3>
    <div class="main"><?php echo INFO_TEXT; ?></div>
    <p align="center" class="main"><a href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a></p>
  </body>
</html>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');