<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: popup_iamge.php 732 2020-01-18 09:49:16Z webchills $
 */

  require('includes/application_top.php');

  foreach($_GET as $key => $value) {
    switch ($key) {
      case 'banner':
        $banners_id = zen_db_prepare_input($_GET['banner']);

        $banner = $db->Execute("select banners_title, banners_image, banners_html_text
                                from " . TABLE_BANNERS . "
                                where banners_id = '" . (int)$banners_id . "'");

        $page_title = $banner->fields['banners_title'];

        if ($banner->fields['banners_html_text']) {
          $image_source = $banner->fields['banners_html_text'];
        } elseif ($banner->fields['banners_image']) {
          $image_source = zen_image(DIR_WS_CATALOG_IMAGES . $banner->fields['banners_image'], $page_title);
        }
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $page_title; ?></title>
<script>
var i=0;

function resize() {
  if (navigator.appName == 'Netscape') i = 40;
  window.resizeTo(document.images[0].width + 30, document.images[0].height + 60 - i);
}
</script>
</head>
<body onload="resize();">
<?php echo $image_source; ?>
</body>
</html>
