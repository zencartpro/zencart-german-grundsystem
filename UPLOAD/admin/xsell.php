<?php
/**
 * Cross Sell Advanced
 * Zen Cart German Specific
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for ZenCart V1.5.2 by RodG Dec 2013
 * Reworked for Zen Cart v1.5.7+ by lat9, Dec. 2021
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: xsell.php 1 2019-07-28 11:16:51 webchills $
 */
require 'includes/application_top.php';

// -----
// Bring in the currencies' class, used by the zen_draw_products_pulldown function within
// /admin/includes/modules/xsell/category_product_selection.php.
//
require DIR_WS_CLASSES . 'currencies.php';
$currencies = new currencies();

// -----
// Initialize the languages-id in use and determine the action/next-action to be performed.
//
$languages_id = $_SESSION['languages_id'];
$action = (isset($_POST['action'])) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');
$next_action = (isset($_POST['next_action'])) ? $_POST['next_action'] : (isset($_GET['next_action']) ? $_GET['next_action'] : '');

// -----
// Initialize variables used by the forms present in /includes/modules/xsell/category_product_selection.php
//
if (!empty($_POST['xsell_pid'])) {
    $xsell_pid = (int)$_POST['xsell_pid'];
} elseif (!empty($_GET['xsell_pid'])) {
    $xsell_pid = (int)$_GET['xsell_pid'];
} else {
    $xsell_pid = 0;
}
if ($xsell_pid === 0) {
    unset($_GET['xsell_pid']);
} else {
    $_GET['xsell_pid'] = $xsell_pid;
}

$xsell_main_pid = (isset($_POST['xsell_main_pid'])) ? (int)$_POST['xsell_main_pid'] : (isset($_GET['xsell_main_pid']) ? (int)$_GET['xsell_main_pid'] : 0);
if ($xsell_main_pid === 0) {
    unset($_GET['xsell_main_pid']);
} else {
    $_GET['xsell_main_pid'] = $xsell_main_pid;
}

if (!empty($_POST['xsell_category_id'])) {
    $xsell_category_id = (int)$_POST['xsell_category_id'];
} elseif (!empty($_GET['xsell_category_id'])) {
    $xsell_category_id = (int)$_GET['xsell_category_id'];
} else {
    $xsell_category_id = 0;
}
if ($xsell_category_id === 0) {
    unset($_GET['xsell_category_id']);
} else {
    $_GET['xsell_category_id'] = $xsell_category_id;
}

// -----
// Handle the main products' pagination.
//
$xsell_page = (isset($_GET['page']) && ctype_digit($_GET['page'])) ? (int)$_GET['page'] : 1;
if ($xsell_page < 1) {
    $xsell_page = 1;
}

switch ($action){
    // -----
    // A new category has been selected via xsell's category_product_selection.php forms, either to choose
    // a new, main product to cross-sell or to add a cross-sell product to a main product.
    //
    case 'new_cat':
        if ($next_action !== '') {
            $next_action = '&action=' . $next_action;
        }
        if ($xsell_main_pid !== 0) {
            $next_action .= '&xsell_main_pid=' . $xsell_main_pid;
        }
        zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&xsell_category_id=' . $xsell_category_id . $next_action));
        break;

    // -----
    // A product has been selected from the upper categories/products form, then this is either a request
    // to create a new cross-sell (selecting the main product) or to add a product cross-sell to a selected
    // product.
    //
    case 'set_xsell_pid':
        // -----
        // If selected from the plugin's main-page, then a 'main' product has been selected for cross-sell
        // definitions; the next action will be to create that main cross-sell.
        //
        if ($next_action === '') {
            $next_action = 'new_xsell';
            $main_pid = (int)$_POST['xsell_pid'];
        // -----
        // Otherwise, a product was selected from the 'new_xsell' action.  That product is a cross-sell for the
        // currently-selected main product.
        //
        } else {
            if ($xsell_main_pid === 0) {
                $messageStack->add_session(ERROR_NO_MAIN_PRODUCT, 'error');
                zen_redirect(zen_href_link(FILENAME_XSELL));
            } else {
                $check = $db->Execute(
                    "SELECT products_id
                       FROM " . TABLE_PRODUCTS . "
                      WHERE products_id = $xsell_main_pid
                      LIMIT 1"
                );
                if ($check->EOF) {
                    $messageStack->add_session(sprintf(ERROR_INVALID_MAIN_PRODUCT, $xsell_main_pid), 'error');
                    zen_redirect(zen_href_link(FILENAME_XSELL));
                }
                $check = $db->Execute(
                    "SELECT *
                       FROM " . TABLE_PRODUCTS_XSELL . "
                      WHERE products_id = $xsell_main_pid
                        AND xsell_id = " . (int)$_POST['xsell_pid'] . "
                      LIMIT 1"
                );
                if (!$check->EOF) {
                    $messageStack->add_session(ERROR_CROSS_SELL_EXISTS, 'error');
                    zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&action=new_xsell&xsell_main_pid=' . (int)$_POST['xsell_main_pid']));
                }
            }
            $sql_data_array = [
                'products_id' => $xsell_main_pid,
                'xsell_id' => (int)$_POST['xsell_pid'],
                'sort_order' => 1
            ];
            zen_db_perform(TABLE_PRODUCTS_XSELL, $sql_data_array);
            $products_name = zen_get_products_name($xsell_main_pid);
            $messageStack->add_session(sprintf(CROSS_SELL_SUCCESS, $products_name, $xsell_main_pid), 'success');
            $main_pid = $xsell_main_pid;
        }
        $next_action = '&action=' . $next_action;
        zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&xsell_main_pid=' . $main_pid . $next_action));
        break;

    // -----
    // The admin has requested that multiple products (by model numbers) be added to the current
    // 'main' product, possibly selling those products "both ways".
    //
    case 'multi_xsell':
        // -----
        // There's got to be a main cross-sell product; if not, head back to the main, listing display.
        //
        if ($xsell_main_pid === 0) {
            $messageStack->add_session(ERROR_NO_MAIN_PRODUCT, 'error');
            zen_redirect(zen_href_link(FILENAME_XSELL));
        }

        // -----
        // Up to six (6) model numbers can be supplied for the multiple cross-sell additions.  They don't
        // have to be supplied 'in-order', so they'll each be checked to see if any were supplied.
        //
        $models = [];
        for ($i = 1; $i <= 6; $i++) {
            if (isset($_POST['model' . $i]) && $_POST['model' . $i] !== '') {
                $models[] = $_POST['model' . $i];
            }
        }
        $models = array_unique($models);
        if (count($models) === 0) {
            $messageStack->add(ERROR_NO_MODELS, 'error');
            $action = 'new_xsell';
            break;
        }

        // -----
        // At this point, at least one model number was supplied.  Make sure that each model
        // number is associated with a single, valid product.  If not, kick back for the admin
        // to correct.
        //
        $error = false;
        $products = [];
        foreach ($models as $next_model) {
            $model_products_ids = $db->Execute(
                "SELECT products_id
                   FROM " . TABLE_PRODUCTS . "
                  WHERE products_model = '" . zen_db_input($next_model) . "'"
            );
            switch ($model_products_ids->RecordCount()) {
                case 0:
                    $error = true;
                    $messageStack->add(sprintf(ERROR_MODEL_NO_EXIST, $next_model), 'error');
                    break;
                case 1:
                    $products[] = $model_products_ids->fields['products_id'];
                    break;
                default:
                    $error = true;
                    $messageStack->add(sprintf(ERROR_MODEL_MULTIPLE_PRODUCTS, $next_model), 'error');
                    break;
            }
        }
        if ($error === true) {
            $action = 'new_xsell';
            break;
        }

        // -----
        // Whew!  At least one valid model number has been supplied.  Create the cross-sells
        // for the main product (and optionally the main product to each each model-number specified).
        //
        $selling_both_ways = (isset($_POST['both_ways']) && $_POST['both_ways'] === '1');
        $xsells_inserted = 0;
        foreach ($products as $xsell_products_id) {
            $check = $db->Execute(
                "SELECT *
                   FROM " . TABLE_PRODUCTS_XSELL . "
                  WHERE products_id = $xsell_main_pid
                    AND xsell_id = $xsell_products_id
                  LIMIT 1"
            );
            if ($check->EOF) {
                $xsells_inserted++;
                $db->Execute(
                    "INSERT INTO " . TABLE_PRODUCTS_XSELL . "
                        (products_id, xsell_id, sort_order)
                     VALUES
                        ($xsell_main_pid, $xsell_products_id, 1)"
                );
            }
            if ($selling_both_ways === true) {
                $check = $db->Execute(
                    "SELECT *
                       FROM " . TABLE_PRODUCTS_XSELL . "
                      WHERE products_id = $xsell_products_id
                        AND xsell_id = $xsell_main_pid
                      LIMIT 1"
                );
                if ($check->EOF) {
                    $xsells_inserted++;
                    $db->Execute(
                        "INSERT INTO " . TABLE_PRODUCTS_XSELL . "
                            (products_id, xsell_id, sort_order)
                         VALUES
                            ($xsell_products_id, $xsell_main_pid, 1)"
                    );
                }
            }
        }
        if ($xsells_inserted === 0) {
            $messageStack->add(NO_MULTI_XSELLS_CREATED, 'warning');
            $action = 'new_xsell';
            break;
        }

        $messageStack->add_session(sprintf(MULTI_XSELL_SUCCESS, $xsells_inserted), 'success');
        zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&action=new_xsell&xsell_main_pid=' . $xsell_main_pid));
        break;

    // -----
    // The admin has requested a modification to the currently defined cross-sells for a main
    // product, either updating those cross-sells' sort-orders or removing a cross-sell for the
    // current main product.
    //
    // The following $_POST variables are expected:
    //
    // - xsell_main_pid ... The 'main' cross-sell being modified; used to redirect back after processing.
    // - sort ............. An array of sort_orders, keyed by their products_xsell 'ID' values.
    // - del .............. An (optional) array of cross-sells to be removed, keyed by their products_xsell 'ID' values.
    //
    case 'update':
        if (empty($_POST['xsell_main_pid'])) {
            $messageStack->add_session(ERROR_MISSING_MAIN_PRODUCT, 'error');
            zen_redirect(zen_href_link(FILENAME_XSELL));
        }

        if (!empty($_POST['del']) && is_array($_POST['del'])) {
            $db->Execute(
                "DELETE FROM " . TABLE_PRODUCTS_XSELL . "
                  WHERE `ID` IN (" . implode(',', array_keys($_POST['del'])) . ")"
            );
        }

        if (!empty($_POST['sort']) && is_array($_POST['sort'])) {
            foreach ($_POST['sort'] as $xsell_id => $sort_order) {
                $db->Execute(
                    "UPDATE " . TABLE_PRODUCTS_XSELL . "
                        SET sort_order = " . (int)$sort_order . "
                      WHERE `ID` = " . (int)$xsell_id . "
                      LIMIT 1"
                );
            }
        }

        $products_name = zen_get_products_name((int)$_POST['xsell_main_pid']);
        $messageStack->add_session(sprintf(CROSS_SELL_SUCCESS, $products_name, $_POST['xsell_main_pid']), 'success');
        zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&action=new_xsell&xsell_main_pid=' . $_POST['xsell_main_pid']));
        break;

    // -----
    // The admin has requested that a 'main' cross-sell and its cross-sell products be removed.
    //
    case 'delete':
        if (!empty($_POST['xsell_main_delete'])) {
            $products_name = zen_get_products_name($_POST['xsell_main_delete']);
            if (!empty($products_name)) {
                $db->Execute(
                    "DELETE FROM " . TABLE_PRODUCTS_XSELL . "
                      WHERE products_id = " . $_POST['xsell_main_delete']
                );
                $messageStack->add_session(sprintf(MAIN_CROSS_SELL_REMOVED, $products_name), 'success');
            }
        }
        zen_redirect(zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page));
        break;

    // -----
    // Managing cross-sells for a 'main' product.  If there's no main product, something's
    // gone awry; let the admin know and head back to the main page.
    //
    case 'new_xsell':
        if ($xsell_main_pid === 0) {
            $messageStack->add_session(ERROR_MISSING_MAIN_PRODUCT, 'error');
            zen_redirect(zen_href_link(FILENAME_XSELL));
        }
        break;

    default:
        break;
}
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
    <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
    <style>
    .smaller { font-size: smaller; }
    .mb-3 { margin-bottom: 1rem; }
    </style>
</head>
<body>
<?php require DIR_WS_INCLUDES . 'header.php'; ?>

<div class="container-fluid">
    <h1><?php echo HEADING_TITLE . ' &mdash; <span class="smaller">v' . XSELL_VERSION . '</span>'; ?></h1>
<?php
// -----
// Entry for overall display of current cross-sells with the option to create a new cross-sell ...
//
if ($action !== 'new_xsell') {
    $current_xsells_raw =
        "SELECT DISTINCT p.products_id, p.products_image, p.products_model, pd.products_name, p.master_categories_id
           FROM " . TABLE_PRODUCTS . " p
                INNER JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
                    ON pd.products_id = p.products_id
                   AND pd.language_id = $languages_id
                INNER JOIN " . TABLE_PRODUCTS_XSELL . " x
                    ON x.products_id = p.products_id
          ORDER BY p.products_id";
    $xsells_split = new splitPageResults($xsell_page, MAX_DISPLAY_SEARCH_RESULTS, $current_xsells_raw, $xsells_query_numrows);
    $current_xsells = $db->Execute($current_xsells_raw);

    $no_xsells = $current_xsells->EOF;

    $all_get_params = zen_get_all_get_params(['page', 'x', 'y', 'action', 'next_action', 'xsell_main_pid']);
    $next_action = '';
?>
    <p><?php echo TEXT_MAIN_INSTRUCTIONS; ?></p>
    <h2><?php echo SUBHEADING_MAIN_ADD; ?></h2>
<?php
    require DIR_WS_MODULES . 'xsell/category_product_selection.php';

    echo zen_draw_form('delete', FILENAME_XSELL, zen_get_all_get_params(['action', 'next_action']) . 'action=delete&page=' . $xsell_page, 'post', 'id="delete-form"');
    echo zen_draw_hidden_field('xsell_main_delete', '', 'id="main_delete"');
?>
    <h2><?php echo SUBHEADING_MAIN_TITLE; ?></h2>

    <div class="row mb-3">
        <div class="col-sm-6">
            <?php echo $xsells_split->display_count($xsells_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $xsell_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>
        </div>
        <div class="col-sm-6 text-right">
            <?php echo $xsells_split->display_links($xsells_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $xsell_page); ?>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="dataTableHeadingRow">
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_PRODUCT_ID; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL; ?></th>
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_CURRENT_SELLS; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_ACTION; ?></th>
            </tr>
        </thead>
        <tbody>
<?php
    if ($no_xsells === true) {
?>
            <tr class="dataTableRow text-center">
                <td colspan="6" class="dataTableContent"><?php echo TEXT_NO_CROSS_SELLS; ?></td>
            </tr>
<?php
    } else {
        foreach ($current_xsells as $xsell) {
            $current_xsells = $db->Execute(
                "SELECT COUNT(*) AS count
                   FROM " . TABLE_PRODUCTS_XSELL . "
                  WHERE products_id = " . $xsell['products_id']
            );
?>
            <tr class="dataTableRow">
                <td class="dataTableContent text-center"><?php echo $xsell['products_id']; ?></td>
                <td class="dataTableContent"><?php echo zen_image(DIR_WS_CATALOG_IMAGES . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-thumbnail"'); ?></td>
                <td class="dataTableContent xsell-pname"><?php echo zen_output_string_protected($xsell['products_name']); ?></td>
                <td class="dataTableContent"><?php echo zen_output_string_protected($xsell['products_model']); ?></td>
                <td class="dataTableContent text-center"><?php echo $current_xsells->fields['count']; ?></td>
                <td class="dataTableContent">
                    <a href="<?php echo zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page . '&action=new_xsell&xsell_main_pid=' . $xsell['products_id']); ?>" role="button" class="btn btn-primary"><?php echo IMAGE_EDIT; ?></a>
                    <button type="submit" data-pid="<?php echo $xsell['products_id']; ?>" class="btn btn-danger xsell-main-delete"><?php echo IMAGE_DELETE; ?></button>
                </td>
            </tr>
<?php
        }
    }
?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6">
            <?php echo $xsells_split->display_count($xsells_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $xsell_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>
        </div>
        <div class="col-sm-6 text-right">
            <?php echo $xsells_split->display_links($xsells_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $xsell_page); ?>
        </div>
    </div>
<?php
    echo '</form>';
// -----
// Rendering starts to gather information for a new/edited cross-sell product.
//
} else {
    $main_product = zen_get_products_name($xsell_main_pid) . ' [' . $xsell_main_pid . ']';
    $next_action = $action;
?>
    <h2><?php echo sprintf(SUBHEADING_TITLE_NEW, $main_product); ?></h2>
    <p><?php echo TEXT_EDIT_INSTRUCTIONS; ?></p>

    <h3><?php echo SUBHEADING_NEW_ADD; ?></h3>
<?php
    $current_xsells = $db->Execute(
        "SELECT x.*
           FROM " . TABLE_PRODUCTS_XSELL . " x
          WHERE x.products_id = $xsell_main_pid
          ORDER BY x.sort_order, x.xsell_id"
    );
    $no_xsells = $current_xsells->EOF;

    // -----
    // Render the form through which a single product can be selected as a cross-sell for the current
    // 'main' product.
    //
    require DIR_WS_MODULES . 'xsell/category_product_selection.php';

    // -----
    // Render the form through which multiple products_model values can be supplied as cross-sells for
    // the current 'main' product.
    //
?>
    <h3><?php echo SUBHEADING_MULTI_ADD; ?></h3>
    <?php echo zen_draw_form('multi', FILENAME_XSELL, 'action=multi_xsell', 'post', 'class="form-horizontal"') . zen_draw_hidden_field('xsell_main_pid', $xsell_main_pid) . zen_draw_hidden_field('page', $xsell_page); ?>
    <div class="row mb-3">
<?php
    for ($i = 1; $i <= 6; $i++) {
        $model_field_name = 'model' . $i;
        $model_default = (isset($_POST[$model_field_name])) ? zen_output_string_protected($_POST[$model_field_name]) : '';
?>
        <div class="col-sm-4 col-md-2"><?php echo zen_draw_input_field($model_field_name, $model_default, 'class="form-control"'); ?></div>
<?php
    }
?>
    </div>
    <div class="row">
        <div class="col-sm-6 text-right">
            <?php echo zen_draw_label(TEXT_BOTH_WAYS, 'both-ways', 'class="control-label"') . '&nbsp;&nbsp;' . zen_draw_checkbox_field('both_ways', '1', false, '', 'id="both-ways"'); ?>
        </div>
        <div class="col-sm-6 text-left">
            <button type="submit" class="btn btn-info"><?php echo IMAGE_GO; ?></button>
        </div>
    </div>
    <?php echo '</form>'; ?>
<?php

    // -----
    // Render the form through which current cross-sells for the selected 'main' product can be removed
    // or their sort-orders updated.
    //
    echo zen_draw_form('update', FILENAME_XSELL, zen_get_all_get_params(['action', 'next_action']) . 'action=update', 'post');
    echo zen_draw_hidden_field('xsell_main_pid', $xsell_main_pid) . zen_draw_hidden_field('page', $xsell_page);
?>
    <h3><?php echo SUBHEADING_MANAGE_EXISTING; ?></h3>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="dataTableHeadingRow">
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_PRODUCT_ID; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></th>
                <th class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL; ?></th>
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_PRODUCT_SORT; ?></th>
                <th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_REMOVE; ?></th>
            </tr>
        </thead>
        <tbody>
<?php
    if ($no_xsells === true) {
?>
            <tr class="dataTableRow text-center">
                <td colspan="6" class="dataTableContent"><?php echo TEXT_NO_CROSS_SELL_PRODUCTS; ?></td>
            </tr>
<?php
    } else {
        foreach ($current_xsells as $xsell) {
            $xsell_id = $xsell['xsell_id'];
            $products_name = zen_get_products_name($xsell_id);
?>
            <tr class="dataTableRow">
                <td class="dataTableContent text-center"><?php echo $xsell['xsell_id']; ?></td>
                <td class="dataTableContent"><?php echo zen_image(DIR_WS_CATALOG_IMAGES . zen_get_products_image($xsell_id), $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-thumbnail"'); ?></td>
                <td class="dataTableContent"><?php echo zen_output_string_protected($products_name); ?></td>
                <td class="dataTableContent"><?php echo zen_output_string_protected(zen_get_products_model($xsell_id)); ?></td>
                <td class="dataTableContent text-center"><?php echo zen_draw_input_field('sort[' . $xsell['ID'] . ']', $xsell['sort_order'], 'class="form-control text-right" size="4"'); ?></td>
                <td class="dataTableContent text-center"><?php echo zen_draw_checkbox_field('del[' . $xsell['ID'] . ']', '1', false); ?></td>
            </tr>
<?php
        }
    }
?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            <a href="<?php echo zen_href_link(FILENAME_XSELL, 'page=' . $xsell_page); ?>" role="button" class="btn btn-default"><?php echo IMAGE_BACK; ?></a>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-info" type="submit"><?php echo IMAGE_UPDATE; ?></button>
        </div>
    </div>
<?php
    echo '</form>';
}
?>
</div>
<!-- body_eof //-->
<!-- footer //-->
<div class="footer-area"><?php require DIR_WS_INCLUDES . 'footer.php'; ?></div>
<!-- footer_eof //-->
</body>
</html>
<?php
require DIR_WS_INCLUDES . 'application_bottom.php';

