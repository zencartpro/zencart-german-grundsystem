<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: stats_products_lowstock.php 2023-04-23 19:26:51Z webchills $
 */

require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
$cat = '';
$dir = '';
$mfg = '';
$sort = '';
$status = '';
$csv = '';
$page = '';
$get_cat = '';
$get_dir = '';
$get_mfg = '';
$get_sort = '';
$get_page = '';

if (isset($_GET['page'])) {
  $_GET['page'] = (int)$_GET['page'];
}
if (isset($_GET['cat'])) {
  $_GET['cat'] = (int)$_GET['cat'];
}
if(isset($_GET['cat'])){
$get_cat = zen_db_prepare_input($_GET['cat']);
}
if(isset($_GET['dir'])){
$get_dir = zen_db_prepare_input($_GET['dir']);
}
if(isset($_GET['sort'])){
$get_sort = zen_db_prepare_input($_GET['sort']);
}
if(isset($_GET['page'])){
$get_page = zen_db_prepare_input($_GET['page']);
}
if(isset($_GET['mfg'])){
$get_mfg = zen_db_prepare_input($_GET['mfg']);
}
if(isset($_GET['status'])){
$status = zen_db_prepare_input($_GET['status']);
}
if(isset($_GET['csv'])){
$csv = zen_db_prepare_input($_GET['csv']);
}

$cat = $get_cat;
$dir = $get_dir;
$mfg = $get_mfg;
$sort = $get_sort;

$cat = $cat == '0' ? '' : $cat;

$where_array = array();
if ($cat != '') {
    $where_array[] = " master_categories_id = '".$cat."' ";
}
if ($status != ''){
    $where_array[] = " products_status = '".$status."' ";
}
if ($mfg != ''){
    $where_array[] = " manufacturers_id = '".$mfg."' ";
}
if(count($where_array) > 0){
    $db_category_where = " WHERE ".implode(" AND ", $where_array);
}
else{
    $db_category_where = '';
}

$dir = $dir == '' ? 'ASC' : $dir;
$op_dir = $dir == 'ASC' ? 'DESC' : 'ASC';
$sort = $sort == '' ? 'products_name' : $sort;

$dir_id = $dir_name = $dir_price = $dir_quantity = $dir_total = $dir_mfg_name = $dir_prdocts_min = $dir_model = 'DESC';

switch ($sort) {
    case('p.products_id'):
        $dir_id = $op_dir;
        break;
    case('products_name'):
        $dir_name = $op_dir;
        break;
    case('products_price'):
        $dir_price = $op_dir;
        break;
    case('products_quantity'):
        $dir_quantity = $op_dir;
        break;
    case('total'):
        $dir_total = $op_dir;
        break;
    case('m.manufacturers_name'):
        $dir_mfg_name = $op_dir;
        break;
    case('p.products_quantity_order_min'):
        $dir_prdocts_min = $op_dir;
        break;
    case('p.products_model'):
        $dir_model = $op_dir;
        break;
}

$lang_id = $_SESSION['languages_id'] != '' ? intval($_SESSION['languages_id']) : 1;
$products_query_raw = "select p.products_id, p.products_type, p.products_quantity, pd.products_name, p.products_model, p.products_price, (p.products_quantity * p.products_price) as total, categories_name, p.products_quantity_order_min, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd ON(p.products_id = pd.products_id AND pd.language_id = '" . $lang_id . "') LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON(cd.categories_id = p.master_categories_id AND cd.language_id = '" . $lang_id . "') left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id) " . $db_category_where . " group by p.products_id order by " . $sort . " " . $dir;
if ($csv == '1') {
    $current_inventory = $db->Execute($products_query_raw);
    while (!$current_inventory->EOF) {
        $products[] = array(
            'products_id' => $current_inventory->fields['products_id'],
            'products_model' => $current_inventory->fields['products_model'],
            'products_name' => $current_inventory->fields['products_name'],
            'categories_name' => $current_inventory->fields['categories_name'],
            'manufacturers_name' => $current_inventory->fields['manufacturers_name'],
            'products_quantity' => $current_inventory->fields['products_quantity'],
            'products_quantity_order_min' => $current_inventory->fields['products_quantity_order_min'],
            'products_price' => $currencies->format($current_inventory->fields['products_price']),
            'total' => $currencies->format($current_inventory->fields['total']),
        );
        $current_inventory->MoveNext();
    }
    $filename = 'inventory_report_' . date('Ymd_His') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    $out = fopen('php://output', 'w');
    fputcsv($out, array_keys($products['0']));
    foreach ($products as $product) {
        fputcsv($out, $product);
    }
    fclose($out);
    die();
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
      <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
    <link rel="stylesheet" media="print" href="includes/css/stylesheet_print.css">
  </head>
  <body>
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->
    <div class="container-fluid">
    <!-- body //-->
      <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
      <!-- body_text //-->
       
       <div class="row">
<div class="col-sm-offset-6 col-sm-6">
<div class="col-sm-3">
<?php echo '<a class="btn btn-primary" href="'.zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, zen_get_all_get_params('page').'&csv=1', 'SSL').'">'.INVENTORY_REPORT_TEXT_CSV.'</a>'; ?>
</div>
<div class="col-sm-3">
        <div class="form-group">
            <?php echo zen_draw_form('goto', FILENAME_STATS_PRODUCTS_LOWSTOCK, '', 'get', 'class="form-horizontal"'); ?>
            <?php echo zen_hide_session_id(); ?>           
            <?php echo zen_draw_pull_down_menu('cat', zen_get_category_tree(), $cat, 'onchange="this.form.submit();" class="form-control" id="cPath"'); ?>
          </div>
</div>
            <?php echo '</form>'; ?>
                              
        </div>
      </div>

        <table class="table table-hover">
					<thead>
                                                <tr class="dataTableHeadingRow">
                                                    <th class="dataTableHeadingContent left"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_id.'&sort=p.products_id', 'SSL'); ?>"><b><?php echo TABLE_HEADING_NUMBER; ?></b></a></td>
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_model.'&sort=p.products_model', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MODEL; ?></b></a></td>
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_name.'&sort=products_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_PRODUCTS; ?></b></a></td>
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_name.'&sort=cd.categories_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MASTERCATEGORY; ?></b></a></td>
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_mfg_name.'&sort=m.manufacturers_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MANUFACTURER; ?></b></a></td>                
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_quantity.'&sort=products_quantity', 'SSL'); ?>"><b><?php echo TABLE_HEADING_QUANTITY; ?></b></a></td>
                                                    <th class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_prdocts_min.'&sort=p.products_quantity_order_min', 'SSL');  ?>"><b><?php echo TABLE_HEADING_MINIMUM_QUANTITY; ?></b></a></td>
                                                    <th class="dataTableHeadingContent right"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_price.'&sort=products_price', 'SSL'); ?>"><b><?php echo TABLE_HEADING_PRICE; ?></b></a></td>
                                                    <th class="dataTableHeadingContent right"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_total.'&sort=total', 'SSL');  ?>"><b><?php echo TABLE_HEADING_TOTAL; ?></b></a></td>
                                                </tr>
        </thead>
        <tbody>
                                                <?php
                                                if (isset($get_page) && ($get_page > 1))
                                                $rows = $get_page * MAX_DISPLAY_SEARCH_RESULTS_REPORTS - MAX_DISPLAY_SEARCH_RESULTS_REPORTS;
                                                $rows = 0;
                                                $total =0;
                                                
                                                $products_split = new splitPageResults($get_page, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $products_query_raw, $products_query_numrows);
                                                
                                                $products = $db->Execute($products_query_raw);
                                                while (!$products->EOF) {

// only show low stock on products that can be added to the cart

                                                    if ($zc_products->get_allow_add_to_cart($products->fields['products_id']) == 'Y') {
                                                        $rows++;

                                                        if (strlen($rows) < 2) {
                                                            $rows = '0' . $rows;
                                                        }
                                                        $product_type = zen_get_products_type($products->fields['products_id']);
                                                        $type_handler = $zc_products->get_admin_handler($products->fields['products_type']);
                                                        $cPath = zen_get_product_path($products->fields['products_id']);
                                                        $total += $products->fields['total']
                                                        ?>
                                                        <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products->fields['products_id']); ?>'">
                                                            <td class="dataTableContent left"><?php echo $products->fields['products_id']; ?>&nbsp;</td>
                                                            <td class="dataTableContent"><?php echo $products->fields['products_model']; ?>&nbsp;</td>                                                           
                                                            <td class="dataTableContent"><a href="<?php echo zen_href_link($type_handler, '&product_type=' . $product_type . '&cPath=' . $cPath . '&pID=' . $products->fields['products_id'] . '&action=new_product'); ?>"><?php echo $products->fields['products_name']; ?></a></td>
                                                            <td class="dataTableContent"><?php echo $products->fields['categories_name']; ?>&nbsp;</td>
                                                            <td class="dataTableContent"><?php echo $products->fields['manufacturers_name']; ?>&nbsp;</td>
                                                            <td class="dataTableContent"><?php echo $products->fields['products_quantity']; ?>&nbsp;</td>
                                                            <td class="dataTableContent"><?php echo $products->fields['products_quantity_order_min']; ?>&nbsp;</td>
                                                            <td class="dataTableContent right"><?php echo $currencies->format($products->fields['products_price']); ?>&nbsp;</td>
                                                            <td class="dataTableContent right"><?php echo $currencies->format($products->fields['total']); ?>&nbsp;</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $products->MoveNext();
                                                }
                                                ?>
                                                <tr class="dataTableHeadingRow">
                                                    <td colspan="8">&nbsp;</td>
                                                    <th class="dataTableHeadingContent right"><?php echo $currencies->format($total); ?></th>            
                                                </tr> 
						</tbody>
                                            </table>
      <table class="table">
                                        <tr>
                                            
                                                        <td><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $get_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                                                        <td class="text-right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, MAX_DISPLAY_PAGE_LINKS, $get_page, "sort=$sort&dir=$dir&cat=$cat"); ?></td>
                                                    </tr>
                                                </table>
                <!-- body_text_eof //-->
 

    <!-- body_eof //-->
	</div>
    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>