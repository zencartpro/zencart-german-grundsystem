<?php
/**
 * search sidebox - displays keyword-search field for customer to initiate a search
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: search.php 729 2011-08-09 15:49:16Z hugo13 $
 */

  require($template->get_template_dir('tpl_search.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_search.php');

  $title = '<label>' . BOX_HEADING_SEARCH . '</label>';
  $title_link = false;
  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>