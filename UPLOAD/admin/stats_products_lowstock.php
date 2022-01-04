<?php
/**
 * Zen Cart German Specific - additional functions missing in this beta

 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: stats_products_lowstock.php 2021-01-02 15:21:51Z webchills $
 */

require('includes/application_top.php');
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>
    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
  </head>
  <body onload="init()">
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->
    <div class="container-fluid">
      <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
      <!-- body //-->
      <table class="table table-hover">
        <thead>
          <tr class="dataTableHeadingRow">
            <th class="dataTableHeadingContent right"><?php echo TABLE_HEADING_NUMBER; ?></th>
            <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
            <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_VIEWED; ?></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $products_query_raw = "SELECT p.products_id, pd.products_name, p.products_quantity, p.products_type
                                   FROM " . TABLE_PRODUCTS . " p,
                                        " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                   WHERE p.products_id = pd.products_id
                                   AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
                                   ORDER BY p.products_quantity, pd.products_name";
            $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $products_query_raw, $products_query_numrows);
            $products = $db->Execute($products_query_raw);
            foreach ($products as $product) {
// only show low stock on products that can be added to the cart
              if ($zc_products->get_allow_add_to_cart($product['products_id']) == 'Y') {
                $type_handler = $zc_products->get_admin_handler($product['products_type']);
                $cPath = zen_get_product_path($product['products_id']);
                ?>
              <tr class="dataTableRow" onclick="document.location.href = '<?php echo zen_href_link($type_handler, '&product_type=' . $product['products_type'] . '&cPath=' . $cPath . '&pID=' . $product['products_id'] . '&action=new_product'); ?>'">
                <td class="dataTableContent text-right"><?php echo $product['products_id']; ?></td>
                <td class="dataTableContent"><a href="<?php echo zen_href_link($type_handler, '&product_type=' . $product['products_type'] . '&cPath=' . $cPath . '&pID=' . $product['products_id'] . '&action=new_product'); ?>"><?php echo $product['products_name']; ?></a></td>
                <td class="dataTableContent text-center"><?php echo $product['products_quantity']; ?></td>
              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
      <table class="table">
        <tr>
          <td><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
          <td class="text-right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
        </tr>
      </table>
      <!-- body_text_eof //-->
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
