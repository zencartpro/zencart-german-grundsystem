<?php
/**
 * search_header ("sidebox") - this is a search field that appears in the navigation header
 * (it's not really a "sidebox" per se).
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: search_header.php 2019-04-14 18:49:16Z webchills $
 */

$search_header_status = $db->Execute("SELECT layout_box_name FROM " . TABLE_LAYOUT_BOXES . " WHERE (layout_box_status=1 OR layout_box_status_single=1) AND layout_template ='" . $template_dir . "' AND layout_box_name='search_header.php'");

if ($search_header_status->RecordCount() != 0) {
    $show_search_header= true;
}

if (!empty($show_search_header)) {

    require $template->get_template_dir('tpl_search_header.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes'). '/tpl_search_header.php';

    $title = '<label>' . BOX_HEADING_SEARCH . '</label>';
    $title_link = false;
    require $template->get_template_dir('tpl_box_header.php', DIR_WS_TEMPLATE, $current_page_base, 'common') . '/tpl_box_header.php';
}
