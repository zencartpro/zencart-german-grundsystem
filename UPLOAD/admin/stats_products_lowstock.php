<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: stats_products_lowstock.php 731 2016-02-17 08:39:51Z webchills $
 */

require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

$get_cat = zen_db_prepare_input($_GET['cat']);
$get_dir = zen_db_prepare_input($_GET['dir']);
$get_sort = zen_db_prepare_input($_GET['sort']);
$get_page = zen_db_prepare_input($_GET['page']);
$get_mfg = zen_db_prepare_input($_GET['mfg']);
$status = zen_db_prepare_input($_GET['status']);
$csv = zen_db_prepare_input($_GET['csv']);


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
    $db_category_where = " WHERE ".explode(" AND ", $where_array);
}
else{
    $db_category_where = '';
}


$dir = $dir == '' ? 'ASC' : $dir;
$op_dir = $dir == 'ASC' ? 'DESC' : 'ASC';
$sort = $sort == '' ? 'products_name' : $sort;

$dir_id = $dir_name = $dir_price = $dir_quantity = $dir_total = $dir_mfg_name = $dir_prdocts_min = 'DESC';

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
$products_query_raw = "select p.products_id, products_quantity, pd.products_name, p.products_model, p.products_price, (products_quantity * p.products_price) as total, categories_name, p.products_quantity_order_min, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd using(products_id) LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON(cd.categories_id = p.master_categories_id AND cd.language_id = '" . $lang_id . "') left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id) " . $db_category_where . " group by p.products_id order by " . $sort . " " . $dir;
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
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
        <title><?php echo TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="includes/menu.js"></script>
        <script type="text/javascript" src="includes/general.js"></script>
        <script type="text/javascript">
            <!--
          function init()
            {
                cssjsmenu('navbar');
                if (document.getElementById)
                {
                    var kill = document.getElementById('hoverJS');
                    kill.disabled = true;
                }
            }
            // -->
        </script>
    </head>
    <body onload="init()">
        <!-- header //-->
        <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
        <!-- header_eof //-->

        <!-- body //-->
        <table border="0" width="100%" cellspacing="2" cellpadding="2">
            <tr>
                <!-- body_text //-->
                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td><a href="./stats_products_lowstock.php?page=all&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&cat=<?php echo $cat; ?>"><?php echo INVENTORY_SHOW_ALL; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./stats_products_lowstock.php?sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&cat=<?php echo $cat; ?>"><?php echo INVENTORY_SHOW_PAGINATED; ?></a></td>
                            <td align="right">
                                <form method="get" action="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&dir='.$replace_dir.'&sort=replace_sort', 'SSL'); ?>"><?php echo zen_draw_pull_down_menu('cat', zen_get_category_tree(), $cat, 'onChange="this.form.submit();"'); ?></form>
                                <br/>
                                <?php
                                echo '<a href="'.zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, zen_get_all_get_params('page').'&csv=1', 'SSL').'">'.INVENTORY_REPORT_TEXT_CSV.'</a>';
                                ?>
                            </td>
                        </tr>      
                        <tr>
                            <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                <tr class="dataTableHeadingRow">
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_id.'&sort=p.products_id', 'SSL'); ?>"><b><?php echo TABLE_HEADING_NUMBER; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_model.'&sort=p.products_model', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MODEL; ?></b></a></td>
                                                    <td class="dataTableHeadingContent"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_name.'&sort=products_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_PRODUCTS; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_name.'&sort=cd.categories_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MASTERCATEGORY; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_mfg_name.'&sort=m.manufacturers_name', 'SSL'); ?>"><b><?php echo TABLE_HEADING_MANUFACTURER; ?></b></a></td>                
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_quantity.'&sort=products_quantity', 'SSL'); ?>"><b><?php echo TABLE_HEADING_QUANTITY; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="center"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_prdocts_min.'&sort=p.products_quantity_order_min', 'SSL');  ?>"><b><?php echo TABLE_HEADING_MINIMUM_QUANTITY; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="right"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_price.'&sort=products_price', 'SSL'); ?>"><b><?php echo TABLE_HEADING_PRICE; ?></b></a></td>
                                                    <td class="dataTableHeadingContent" align="right"><a href="<?php echo zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, 'page='.$get_page.'&cat='.$cat.'&dir='.$dir_total.'&sort=total', 'SSL');  ?>"><b><?php echo TABLE_HEADING_TOTAL; ?></b></a></td>
                                                </tr>
                                                <?php
                                                if (isset($get_page) && ($get_page > 1))
                                                    $rows = $get_page * MAX_DISPLAY_SEARCH_RESULTS_REPORTS - MAX_DISPLAY_SEARCH_RESULTS_REPORTS;
                                                $rows = 0;

//  This query can pull specials prices
//  $products_query_raw = "select p.products_id, products_quantity, pd.products_name, p.products_price, (products_quantity * p.products_price) as total, specials_new_products_price, (products_quantity * specials_new_products_price) as total_special, categories_name FROM ".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd using(products_id) LEFT JOIN ".TABLE_SPECIALS." s using(products_id) $db_category_join LEFT JOIN ".TABLE_CATEGORIES_DESCRIPTION." cd ON(cd.categories_id = p.master_categories_id AND cd.language_id = '1') $db_category_where group by p.products_id order by $sort $dir";
                                                // $products_query_raw = "select p.products_id, products_quantity, pd.products_name, p.products_price, (products_quantity * p.products_price) as total, categories_name, p.products_quantity_order_min, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd using(products_id) LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON(cd.categories_id = p.master_categories_id AND cd.language_id = '" . $lang_id . ") left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id) " . $db_category_where . " group by p.products_id order by " . $sort . " " . $dir;

                                                if ($get_page != 'all')
                                                    $products_split = new splitPageResults($get_page, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $products_query_raw, $products_query_numrows);
                                                $products = $db->Execute($products_query_raw);
                                                while (!$products->EOF) {

// only show low stock on products that can be added to the cart
                                                    if ($zc_products->get_allow_add_to_cart($products->fields['products_id']) == 'Y') {
                                                        $rows++;

                                                        if (strlen($rows) < 2) {
                                                            $rows = '0' . $rows;
                                                        }
                                                        $cPath = zen_get_product_path($products->fields['products_id']);
                                                        $total += $products->fields['total']
                                                        ?>
                                                        <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products->fields['products_id']); ?>'">
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['products_id']; ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['products_model']; ?>&nbsp;</td>
                                                            <td class="dataTableContent"><?php echo '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products->fields['products_id']) . '">' . $products->fields['products_name'] . '</a> '; ?></td>
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['categories_name']; ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['manufacturers_name']; ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['products_quantity']; ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="center"><?php echo $products->fields['products_quantity_order_min']; ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="right"><?php echo $currencies->format($products->fields['products_price']); ?>&nbsp;</td>
                                                            <td class="dataTableContent" align="right"><?php echo $currencies->format($products->fields['total']); ?>&nbsp;</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    $products->MoveNext();
                                                }
                                                ?>
                                                <tr class="dataTableHeadingRow">
                                                    <td colspan="8">&nbsp;</td>
                                                    <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($total); ?></td>            
                                                </tr> 
                                            </table></td>
                                    </tr>
                                    <?php if (is_object($products_split)) { ?>          
                                        <tr>
                                            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                    <tr>
                                                        <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, $get_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                                                        <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_REPORTS, MAX_DISPLAY_PAGE_LINKS, $get_page, "sort=$sort&dir=$dir&cat=$cat"); ?></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                    <?php } ?>                   
                                </table></td>
                        </tr>
                    </table></td>
                <!-- body_text_eof //-->
            </tr>
        </table>
        <!-- body_eof //-->

        <!-- footer //-->
        <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        <!-- footer_eof //-->
    </body>
</html>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');
