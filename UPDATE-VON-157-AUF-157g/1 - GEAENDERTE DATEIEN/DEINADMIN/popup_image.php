<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: popup_image.php 2021-10-24 18:21:16Z webchills $
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
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $page_title; ?></title>
<script>
function resize() {
  window.resizeTo(document.images[0].width + 30, document.images[0].height + 60);
}
</script>
</head>
<body onload="resize();">
<?php echo $image_source; ?>
</body>
</html>
