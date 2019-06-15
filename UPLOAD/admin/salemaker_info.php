<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: salemaker_info.php 731 2019-04-12 09:13:51Z webchills $
 */
//
require("includes/application_top.php");

require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_SALEMAKER_INFO . '.php');
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
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