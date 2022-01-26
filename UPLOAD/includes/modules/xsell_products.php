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
 * Reworked for Zen Cart 1.5.7+, lat9, December 2021
 
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: xsell_products.php 2022-01-26 16:55:51 webchills $
 */

// -----
// Provide default values, in case the admin hasn't yet updated to include
// these constants.
//
if (!defined('MAX_DISPLAY_XSELL')) define('MAX_DISPLAY_XSELL', '6');
if (!defined('XSELL_DISPLAY_PRICE')) define('XSELL_DISPLAY_PRICE', 'false');
if (!defined('SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS')) define('SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', '0');    //-If not set in admin, a value of '0' disables the display.

// -----
// Sanitize xsell-related configuration settings.
//
$common_sort_order = (defined('XSELL_USE_COMMON_SORT_ORDER') && XSELL_USE_COMMON_SORT_ORDER === 'true');
$xsell_max_display = (int)MAX_DISPLAY_XSELL;
$xsell_columns = (int)SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS;
 
// collect information on available cross-sell products for the current product-id
if ($xsell_columns >= 0 && $xsell_max_display > 0 && isset($_GET['products_id'])) {
    $xsell_query_sql = 
        "SELECT p.products_id, p.products_image, pd.products_name
           FROM " . TABLE_PRODUCTS_XSELL . " xp
                INNER JOIN " . TABLE_PRODUCTS . " p
                    ON p.products_id = xp.xsell_id
                INNER JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
                    ON pd.products_id = p.products_id
                   AND pd.language_id = " . (int)$_SESSION['languages_id'] . "
          WHERE xp.products_id = " . (int)$_GET['products_id'] . "
            AND p.products_status = 1"; 
    if ($common_sort_order === true) { 
        $xsell_query_sql .= " ORDER BY p.products_xsell_sort_order ASC";
    } else { 
        $xsell_query_sql .= " ORDER BY xp.sort_order ASC";
    }

    $xsell_query = $db->ExecuteRandomMulti($xsell_query_sql, $xsell_max_display); 
    $num_products_xsell = $xsell_query->RecordCount();

    if ($num_products_xsell === 0) {
        return;
    }

    $row = 0;
    $col = 0;
    $list_box_contents = [];
    $title = '';
    if ($xsell_columns === 0 || $num_products_xsell < $xsell_columns) {
        $col_width = floor(100 / $num_products_xsell);
    } else {
        $col_width = floor(100 / $xsell_columns);
    }
    while (!$xsell_query->EOF) {
        $next_xsell = $xsell_query->fields;
        if ($common_sort_order === true) { 
            $xsell_image = zen_image_OLD(DIR_WS_IMAGES . $next_xsell['products_image'], $next_xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
        } else { 
            $xsell_image = zen_image(DIR_WS_IMAGES . $next_xsell['products_image'], $next_xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); 
        }
        $xsell_query_text =
            '<a href="' . zen_href_link(zen_get_info_page($next_xsell['products_id']), 'products_id=' . $next_xsell['products_id']) . '">' . $xsell_image . '</a>' .
            '<br>' .
            '<a href="' . zen_href_link(zen_get_info_page($next_xsell['products_id']), 'products_id=' . $next_xsell['products_id']) . '">' . zen_output_string_protected($next_xsell['products_name']) . '</a>';
        if (XSELL_DISPLAY_PRICE === 'true') {
            $xsell_query_text .= '<br>' . zen_get_products_display_price($next_xsell['products_id']);
        }

        $list_box_contents[$row][$col] = [
            'params' => 'class="centerBoxContentsAlsoPurch xsell-centerbox centeredContent back" style="width:' . $col_width . '%;"',
            'text' => $xsell_query_text
        ]; 

        $col++;
        if ($col > ($xsell_columns - 1)) {
            $col = 0;
            $row++;
        }
        $xsell_query->MoveNextRandom();
    }
    // store data into array for display later where desired:
    $xsell_data = $list_box_contents;
}
