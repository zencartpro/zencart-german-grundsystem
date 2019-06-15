<?php
/**
 * Side Box Template: Searchbox for column header
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_search_header.php 731 2019-04-12 17:49:16Z webchills $
 */
$content = '';
$content .= zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', $request_type, false), 'get');
$content .= zen_draw_hidden_field('main_page', FILENAME_ADVANCED_SEARCH_RESULT);
$content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();

$content .= zen_draw_input_field('keyword', '', 'size="6" maxlength="30" style="width: 100px" placeholder="' . HEADER_SEARCH_DEFAULT_TEXT . '" ');

$content .= '&nbsp;';

if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'yes') {
    $content .= zen_image_submit(BUTTON_IMAGE_SEARCH, HEADER_SEARCH_BUTTON);
} else {
    $content .= '<input type="submit" value="' . HEADER_SEARCH_BUTTON . '" style="width: 60px" />';
}

$content .= '</form>';
