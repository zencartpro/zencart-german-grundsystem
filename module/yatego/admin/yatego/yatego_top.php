<?php
/*
  $Id$

  Yatego Export for Zen-Cart
  by www.pocketbit.net 05/2007. All rights reserved
  converted from OSC to ZenCart by 
    JeffClay 
    Hugo13 (http://edv.langheiter.com/zencart/ )

*/
chdir('../');
require('includes/application_top.php');

/**
 * init smarty environment
 */
$smarty = setSmarty ();

/**
 * header stuff
 */
$smarty->assign('path', '../');
$smarty -> display('header.tpl.html');
require(DIR_WS_INCLUDES . 'header.php');


require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

$_GET['page'] = 1;

function draw_top_pull_down($name, $parameters = '', $exclude = '') {
    global $currencies;
    global $db;

    if ($exclude == '') {
        $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
        $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';

    $products = $db->EXECUTE("select substring(article_id,6) as products_id, p.article_name, p.price_brutto FROM yategoexport as p WHERE deleteproduct='0' order by article_name ");
    // $products_query = $db->Execute($top_query_raw);//
    while (!$products->EOF) {
        if (!in_array($products['products_id'], $exclude)) {
            $select_string .= '<option value="' . $products['products_id'] . '">' . $products['article_name'] . '</option>';
        }
        $products->MoveNext();
    }

    $select_string .= '</select>';
    return $select_string;
}

$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (zen_not_null($action)) {
    switch ($action) {
        case 'setflag':
            zen_set_specials_status($_GET['id'], $_GET['flag']);

            zen_redirect(zen_href_link('top_yatego.php', (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['id'], 'NONSSL'));
            break;
        case 'insert':
            $products_id = zen_db_prepare_input($_POST['products_id']);

            $products_price = zen_db_prepare_input($_POST['products_price']);
            $specials_price = zen_db_prepare_input($_POST['specials_price']);
            $day = zen_db_prepare_input($_POST['day']);
            $month = zen_db_prepare_input($_POST['month']);
            $year = zen_db_prepare_input($_POST['year']);

            if (substr($specials_price, -1) == '%') {
                $new_special_insert = $db->EXECUTE("select products_id, products_price from yategoexport where products_id = '" . (int)$products_id . "'");
                // $new_special_insert = zen_db_fetch_array($new_special_insert_query);//
                $products_price = $new_special_insert->fields['products_price'];
                $specials_price = ($products_price - (($specials_price / 100) * $products_price));
            }

            $db->Execute("UPDATE yategoexport SET top='1' WHERE substring(article_id,6) ='" . (int)$products_id . "'");

            zen_redirect(zen_href_link('top_yatego.php', 'page=' . $_GET['page']));
            break;
        case 'update':
            $specials_id = zen_db_prepare_input($_POST['specials_id']);
            $products_price = zen_db_prepare_input($_POST['products_price']);
            $specials_price = zen_db_prepare_input($_POST['specials_price']);
            $day = zen_db_prepare_input($_POST['day']);
            $month = zen_db_prepare_input($_POST['month']);
            $year = zen_db_prepare_input($_POST['year']);

            if (substr($specials_price, -1) == '%') $specials_price = ($products_price - (($specials_price / 100) * $products_price));

            $expires_date = '';
            if (zen_not_null($day) && zen_not_null($month) && zen_not_null($year)) {
                $expires_date = $year;
                $expires_date .= (strlen($month) == 1) ? '0' . $month : $month;
                $expires_date .= (strlen($day) == 1) ? '0' . $day : $day;
            }

            $db->Execute("update specials set specials_new_products_price = '" . zen_db_input($specials_price) . "', specials_last_modified = now(), expires_date = '" . zen_db_input($expires_date) . "' where specials_id = '" . (int)$specials_id . "'");

            zen_redirect(zen_href_link('top_yatego.php', 'page=' . $H_GET['page'] . '&sID=' . $specials_id));
            break;
        case 'deleteconfirm':
            $products_id = zen_db_prepare_input($_GET['sID']);
            // Hier
            $db->Execute("UPDATE yategoexport SET top='0' WHERE substring(article_id,6) ='" . (int)$products_id . "'");

            zen_redirect(zen_href_link('top_yatego.php', 'page=' . $_GET['page']));
            break;
    }
}

$smarty->assign('msg', $msg);
$x = zen_draw_form('yatego_anlegen', 'yatego/yatego_cat.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"');
$smarty->assign('yatego_cat_form', zen_draw_form('yatego_anlegen', 'yatego/yatego_cat.php', '&action=anlegen', 'post', 'enctype="multipart/form-data"'));
$smarty->assign('yatego_cat_btnsave', str_replace('includes/languages', '../includes/languages', zen_image_submit('button_save.gif', IMAGE_INSERT)));

$smarty->assign('cat', $hv);
$smarty -> display('yatego_top.tpl.html');

/**
 * footer stuff
 */
require(DIR_WS_INCLUDES . 'footer.php');

exit();
######################
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS;
?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;
?>">
<title><?php echo TITLE;
?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<?php
if (($action == 'new') || ($action == 'edit')) {

    ?>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css">
<script language="JavaScript" src="includes/javascript/calendarcode.js"></script>
<?php
}

?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<div id="popupcalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="999" valign="top"><table border="0" width="999" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->

<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE;
?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
?></td>
          </tr>
        </table></td>
      </tr>
<?php
if (($action == 'new') || ($action == 'edit')) {
    $form_action = 'insert';
    if (($action == 'edit') && isset($_GET['sID'])) {
        $form_action = 'update';
        $product = $db->Execute("select p.article_name, p.price_brutto  from yategoexport as p where substring(p.article_id,6) = '" . (int)$_GET['sID'] . "'");
        // $product = zen_db_fetch_array($product_query);//
        $sInfo = new objectInfo($product);
    } else {
        $sInfo = new objectInfo(array());

        $specials_array = array();
        $specials = $db->EXECUTE("select p.products_id from products p, specials s where s.products_id = p.products_id");
        while (!$specials->EOF) {
            $specials_array[] = $specials->fields['products_id'];
            $specials->MoveNext();
        }
    }

    ?>
      <tr><form name="new_special" <?php echo 'action="' . zen_href_link('top_yatego.php', zen_get_all_get_params(array('action', 'info', 'sID')) . 'action=' . $form_action, 'NONSSL') . '"';
    ?> method="post"><?php if ($form_action == 'update') echo zen_draw_hidden_field('specials_id', $_GET['sID']);
    ?>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_PRODUCT;
    ?>&nbsp;</td>
            <td class="main"><?php echo draw_top_pull_down('products_id', 'style="font-size:10px"', $specials_array);
    echo zen_draw_hidden_field('products_price', (isset($sInfo->products_price) ? $sInfo->products_price : ''));
    ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="right" valign="top"><br><?php echo (($form_action == 'insert') ? zen_image_submit('button_insert.gif', IMAGE_INSERT) : zen_image_submit('button_update.gif', IMAGE_UPDATE)) . '&nbsp;&nbsp;&nbsp;<a href="' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . (isset($_GET['sID']) ? '&sID=' . $_GET['sID'] : '')) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
    ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
} else {

    ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS;
    ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRODUCTS_PRICE;
    ?></td>
              </tr>
<?php

    $specials_query = "select substring(article_id,6) as products_id, p.article_name, p.price_brutto FROM yategoexport as p WHERE top='1' ORDER BY p.article_name";
    $specials = $db->EXECUTE($specials_query);
    while (!$specials->EOF) {
        if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $specials['products_id']))) && !isset($sInfo)) {
            // $products = tep_db_fetch_array($products_query);
            // $sInfo_array = array_merge($specials, $products);
            $sInfo = new objectInfo($specials);
        }
        if (isset($sInfo) && is_object($sInfo) && ($specials['products_id'] == $sInfo->products_id)) {
            echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . '&sID=' . $sInfo->products_id . '&action=edit') . '\'">' . "\n";
        } else {
            echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . '&sID=' . $specials['products_id']) . '\'">' . "\n";
        }

        ?>
                <td  class="dataTableContent"><?php echo $specials['article_name'];
        ?></td>
                <td  class="dataTableContent" align="right"><?php echo $currencies->format($specials->fields['price_brutto']);
        ?>  </td>

      </tr>

<?php
        $specials = MoveNext();
    }

    ?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellpadding="0"cellspacing="2">
<?php
    if (empty($action)) {

        ?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . '&action=new') . '">' . zen_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>';
        ?></td>
                  </tr>
<?php
    }

    ?>
                </table></td>
              </tr>
            </table></td>
<?php
    $heading = array();
    $contents = array();

    switch ($action) {
        case 'delete':
            $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>');

            $contents = array('form' => zen_draw_form('specials', 'top_yatego.php', 'page=' . $_GET['page'] . '&sID=' . $sInfo->products_id . '&action=deleteconfirm'));
            $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
            $contents[] = array('text' => '<br><b>' . $sInfo->products_name . '</b>');
            $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . '&sID=' . $sInfo->products_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
            break;
        default:

            if (is_object($sInfo)) {
                $heading[] = array('text' => '<b>' . $sInfo->article_name . '</b>');
                $contents[] = array('align' => 'center', 'text' => '<br/><a href="' . zen_href_link('top_yatego.php', 'page=' . $_GET['page'] . '&sID=' . $sInfo->products_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a><br/><br/>');
            }
            break;
    }
    if ((zen_not_null($heading)) && (zen_not_null($contents))) {
        echo '            <td width="25%" valign="top">' . "\n";

        $box = new box;
        echo $box->infoBox($heading, $contents);

        echo '            </td>' . "\n";
    }
}

?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
