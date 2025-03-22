<?php
/**
 * currencies sidebox - allows customer to select from available currencies
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: currencies.php 2023-10-26 19:07:16Z webchills $
 */

// test if box should display; it's not displayed on checkout-related pages
$show_currencies = (strpos($current_page, 'checkout') !== 0);

if ($show_currencies === true && isset($currencies) && is_object($currencies)) {
    $currencies_array = [];
    foreach ($currencies->currencies as $key => $value) {
        $currencies_array[] = ['id' => $key, 'text' => $value['title']];
    }

    $hidden_get_variables = zen_post_all_get_params('currency');

    require $template->get_template_dir('tpl_currencies.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_currencies.php';

    $title =  BOX_HEADING_CURRENCIES;
    $title_link = false;
    require $template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default;
}
