<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
  if(isset($_GET['template_switch_id'])){
    $templ = $_GET['template_switch_id'];
  } else {
    $templ = $_COOKIE["zctemplate"];
  }
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content.= zen_draw_form('template_switch_form', zen_href_link(FILENAME_DEFAULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
  $content .= zen_draw_pull_down_menu('template_switch_id', $template_switch_sidebox_array, $templ, 'onchange="this.form.submit();" size="1'   . '" style="width: 90%; margin: auto;"') . zen_hide_session_id();
  $content .= '</form>';
  $content .= '</div>';
