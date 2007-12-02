<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_manufacturers_select.php 4771 2006-10-17 05:32:42Z ajeh $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content.= zen_draw_form('manufacturers_form', zen_href_link(FILENAME_DEFAULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
  $content .= zen_draw_pull_down_menu('manufacturers_id', $manufacturer_sidebox_array, (isset($_GET['manufacturers_id']) ? $_GET['manufacturers_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" style="width: 90%; margin: auto;"') . zen_hide_session_id();
  $content .= '</form>';
  $content .= '</div>';
?>