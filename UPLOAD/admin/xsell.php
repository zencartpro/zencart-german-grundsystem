<?php
/**
 * @package Cross Sell Advanced
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for ZenCart V1.5.2 by RodG Dec 2013   
 * Reworked for ZenCart V1.5.6 by webchills Aug 2019
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: xsell.php 1 2019-07-28 11:16:51 webchills $
 */

global $db ;  
require 'includes/application_top.php';
require DIR_WS_CLASSES . 'currencies.php';
$currencies = new currencies();
$languages_id = $_SESSION['languages_id'];
switch($_GET['action']){
  case 'update_cross' :
    if ($_POST['product']){
      foreach ($_POST['product'] as $temp_prod){
        $db->execute('delete from ' . TABLE_PRODUCTS_XSELL . ' where xsell_id = "'.$temp_prod.'" and products_id = "'.$_GET['add_related_product_ID'].'"');
      }
    }

    $sort_start_query = $db->execute('select sort_order from ' . TABLE_PRODUCTS_XSELL . ' where products_id = "'.$_GET['add_related_product_ID'].'" order by sort_order desc limit 1');
  
    $sort_start = $sort_start_query->fields ; 
    $sort = (($sort_start['sort_order'] > 0) ? $sort_start['sort_order'] : '0');
    if ($_POST['cross']){
      foreach ($_POST['cross'] as $temp){
        $sort++;
        $insert_array = array();
        $insert_array = array('products_id' => $_GET['add_related_product_ID'],
        'xsell_id' => $temp,
        'sort_order' => $sort);
        zen_db_perform(TABLE_PRODUCTS_XSELL, $insert_array);
      }
    }
    $messageStack->add(CROSS_SELL_SUCCESS, 'success');
    break;
  case 'update_sort' :
    foreach ($_POST as $key_a => $value_a){
      $db->execute('update ' . TABLE_PRODUCTS_XSELL . ' set sort_order = "' . $value_a . '" where xsell_id = "' . $key_a . '"');
    }
    $messageStack->add(SORT_CROSS_SELL_SUCCESS, 'success');
    break;
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <style>
  .productmenutitle{
    cursor:pointer;
    margin-bottom: 0px;
    background-color:orange;
    color:#FFFFFF;
    font-weight:bold;
    font-family:ms sans serif;
    width:100%;
    padding:3px;
    font-size:12px;
    text-align:center;
  
  }
  .productmenutitle1{
    cursor:pointer;
    margin-bottom: 0px;
    background-color: red;
    color:#FFFFFF;
    font-weight:bold;
    font-family:ms sans serif;
    width:100%;
    padding:3px;
    font-size:12px;
    text-align:center;
  
  }
</style>
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

<body onLoad="init()" >
      <!-- header //-->
      <?php require DIR_WS_INCLUDES . 'header.php'; ?>
      <!-- header_eof //-->
      <div class="container-fluid">
        <!-- body //-->

  <table border="0" width="100%" cellspacing="0" cellpadding="0">
   <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '100%', '10');?></td>
   </tr>
   <tr>
    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
   </tr>
   <tr>
    <td><?php echo TEXT_XSELL_INFO; ?></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '100%', '15');?></td>
   </tr>
  </table>

<?php
global $db ;  
if ($_GET['add_related_product_ID'] == ''){
$products_query_raw = 'select p.products_id, p.products_model, pd.products_name, p.products_id from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by p.products_id asc';
$products_split = new splitPageResults($_GET['page'], 50, $products_query_raw, $products_query_numrows);
$products_query = $db->execute($products_query_raw) or die(mysql_error());
   
?>
  <table border="0" cellspacing="1" cellpadding="2" bgcolor="#FCFCFC" align="center">
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
   <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" width="75"><?php echo TABLE_HEADING_PRODUCT_ID;?></td>
    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL;?></td>
    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME;?></td>
    <td class="dataTableHeadingContent" nowrap><?php echo TABLE_HEADING_CURRENT_SELLS;?></td>
    <td class="dataTableHeadingContent" colspan="2" nowrap align="center"><?php echo TABLE_HEADING_UPDATE_SELLS;?></td>
   </tr>
<?php

while (!$products_query->EOF) {
    $products = $products_query->fields ; 
?>
   <tr onMouseOver="cOn(this); this.style.cursor='pointer'; this.style.cursor='hand';" onMouseOut="cOut(this);" bgcolor='#F5F5F5' onClick=document.location.href="<?php echo zen_href_link(FILENAME_XSELL, 'add_related_product_ID=' . $products['products_id'], 'NONSSL');?>">
    <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
    <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_model'];?>&nbsp;</td>
    <td class="dataTableContent" valign="top">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
    <td class="dataTableContent" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
$products_cross_query = $db->execute('select p.products_id, p.products_model, pd.products_name, p.products_id, x.products_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$products['products_id'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by x.sort_order asc');
$i=0;
while (!$products_cross_query->EOF){
    $products_cross = $products_cross_query->fields ;
  $i++;
?>
   <tr>
    <td class="dataTableContent">&nbsp;<?php echo $i . '.&nbsp;&nbsp;<b>' . $products_cross['products_model'] . '</b>&nbsp;' . $products_cross['products_name'];?>&nbsp;</td>
   </tr>
<?php
$products_cross_query->MoveNext() ;
}
if ($i <= 0){
?>
   <tr>
    <td class="dataTableContent">&nbsp;<?php echo TEXT_NO_CROSS_SELLS_DEFINED;?>&nbsp;</td>
   </tr>
<?php
} else {
?>
   <tr>
    <td class="dataTableContent"><?php echo zen_draw_separator('pixel_trans.gif', '100%', '10');?></td>
   </tr>
<?php
}
?>
    </table></td>
    <td class="dataTableContent" valign="top">&nbsp;<a href="<?php echo zen_href_link(FILENAME_XSELL, zen_get_all_get_params(array('action')) . 'add_related_product_ID=' . $products['products_id'], 'NONSSL');?>"><?php echo TEXT_EDIT_SELLS;?></a>&nbsp;</td>
    <td class="dataTableContent" valign="top" align="center">&nbsp;<?php echo (($i > 0) ? '<a href="' . zen_href_link(FILENAME_XSELL, zen_get_all_get_params(array('action')) . 'sort=1&add_related_product_ID=' . $products['products_id'], 'NONSSL') .'">'.TEXT_SORT.'</a>&nbsp;' : '--')?></td>
   </tr>
<?php
$products_query->MoveNext();
}
?>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
  </table>
<?php
} elseif ($_GET['add_related_product_ID'] != '' && $_GET['sort'] == '') {
  $products_name_query = $db->execute('select pd.products_name, p.products_model, p.products_image from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"');
  

 $products_name = $products_name_query->fields ;
   
  ?>
  <table border="0" cellspacing="0" cellpadding="0" bgcolor="#FCFCFC" align="center">
<?php
$products_query_raw = 'select p.products_id, p.products_model, p.products_image, p.products_price, pd.products_name, p.products_id from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by p.products_id asc';
$products_split = new splitPageResults($_GET['page'], 50, $products_query_raw, $products_query_numrows);
$products_query = $db->execute($products_query_raw);
?>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_form('update_cross', FILENAME_XSELL, zen_get_all_get_params(array('action')) . 'action=update_cross', 'post');?><table cellpadding="1" cellspacing="1" border="0">
   <tr>
    <td colspan="6"><table cellpadding="3" cellspacing="0" border="0" width="100%">
     <tr class="dataTableHeadingRow">
      <td valign="top" align="center" colspan="2"><span class="pageHeading"><?php echo TEXT_SETTING_SELLS.': '.$products_name['products_name'].' ('.TEXT_MODEL.': '.$products_name['products_model'].') ('.TEXT_PRODUCT_ID.': '.$_GET['add_related_product_ID'].')';?></span></td>
     </tr>
     <tr class="dataTableHeadingRow">
      <td align="center" width="95%"><?php echo (file_exists(DIR_FS_CATALOG_IMAGES.$products['products_image']) ?  zen_image(DIR_WS_CATALOG_IMAGES.$products_name['products_image'], '', '', MEDIUM_IMAGE_HEIGHT) : DIR_WS_CATALOG_IMAGES.$products_name['products_image'] );?></td>
      <td align="right" width="5%" valign="bottom"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE) . '<br><br><a href="'.zen_href_link(FILENAME_XSELL, 'men_id=catalog').'">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '<br><br>' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>';?></td>
     </tr>
    </table></td>
   </tr>
     <tr class="dataTableHeadingRow">
      <td class="dataTableHeadingContent" width="75">&nbsp;<?php echo TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_CROSS_SELL_THIS;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
   </tr>
<?php

   while (!$products_query->EOF) { 
     $products = $products_query->fields ; 
  $xsold_query = $db->execute('select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$_GET['add_related_product_ID'].'" and xsell_id = "'.$products['products_id'].'"');
 
 $xsold_count = $xsold_query->RecordCount() ;
  ?>
   <tr bgcolor='#FCFCFC'>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_model'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo (is_file(DIR_FS_CATALOG_IMAGES.$products['products_image']) ?  zen_image(DIR_WS_CATALOG_IMAGES.$products['products_image'], '', '', SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : '<br>No Image<br>');?>&nbsp;</td>
 <td class="dataTableContent">&nbsp;<?php echo zen_draw_hidden_field('product[]', $products['products_id']) . zen_draw_checkbox_field('cross[]', $products['products_id'], ($xsold_count > 0), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo TEXT_CROSS_SELL;?></label>&nbsp;</td>
   
    <td class="dataTableContent">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
    <td class="dataTableContent">&nbsp;<?php echo $currencies->format($products['products_price']);?>&nbsp;</td>
   </tr>
<?php
$products_query->MoveNext() ; 
}
?>
  </table></form></td>
   </tr>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
  </table>
<?php
}elseif($_GET['add_related_product_ID'] != '' && $_GET['sort'] != ''){
  $products_name_query = $db->execute('select pd.products_name, p.products_model, p.products_image from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"');

$products_name = $products_name_query->fields ; 
  ?>
  <table border="0" cellspacing="0" cellpadding="0" bgcolor="#FCFCFC" align="center">
<?php
$products_query_raw = 'select p.products_id as products_id, p.products_price, p.products_image, p.products_model, pd.products_name, p.products_id, x.products_id as xproducts_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by x.sort_order asc';
$products_split = new splitPageResults($_GET['page'], 50, $products_query_raw, $products_query_numrows);
$sort_order_drop_array = array();
for($i=1;$i<=$products_query_numrows;$i++){
  $sort_order_drop_array[] = array('id' => $i, 'text' => $i);
}
$products_query = $db->execute($products_query_raw);
?>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_form('update_sort', FILENAME_XSELL, zen_get_all_get_params(array('action')) . 'action=update_sort', 'post');?><table cellpadding="1" cellspacing="1" border="0">
   <tr>
    <td colspan="6"><table cellpadding="3" cellspacing="0" border="0" width="100%">
     <tr class="dataTableHeadingRow">
      <td valign="top" align="center" colspan="2"><span class="pageHeading"><?php echo TEXT_SETTING_SELLS.': '.$products_name['products_name'].' ('.TEXT_MODEL.': '.$products_name['products_model'].') ('.TEXT_PRODUCT_ID.':'.$_GET['add_related_product_ID'].')';?></span></td>
     </tr>
     <tr class="dataTableHeadingRow">
      <td align="center" width="95%"><?php echo zen_image(DIR_WS_CATALOG_IMAGES.$products_name['products_image'], '', '', MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT);?></td>
      <td align="right" valign="bottom" width="5%"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE) . '<br><br><a href="'.zen_href_link(FILENAME_XSELL, 'men_id=catalog').'">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';?></td>
     </tr>
    </table></td>
   </tr>
   <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT_SORT;?>&nbsp;</td>
   </tr>
<?php

   while (!$products_query->EOF){ 
    $products = $products_query->fields ;
?>
   <tr bgcolor='#F5F5F5'>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_id'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_model'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo (is_file(DIR_FS_CATALOG_IMAGES.$products['products_image']) ?  zen_image(DIR_WS_CATALOG_IMAGES.$products['products_image'], '', '', SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : '<br>'.TEXT_NO_IMAGE.'<br>');?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products['products_name'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $currencies->format($products['products_price']);?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo zen_draw_pull_down_menu($products['products_id'], $sort_order_drop_array, $products['sort_order']);?>&nbsp;</td>
     </tr>
<?php
$products_query->MoveNext() ; 
}
?>
    </table></form></td>
   </tr>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, 50, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, 50, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
  </table>
<?php
}
?>
<!-- body_text_eof //-->
      </div>
      <!-- body_eof //-->
      <!-- footer //-->
  <?php require DIR_WS_INCLUDES . 'footer.php'; ?>
      <!-- footer_eof //-->
    </body>
  </html>