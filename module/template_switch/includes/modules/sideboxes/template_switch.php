<?php
/**
 * manufacturers sidebox - displays a list of manufacturers so customer can choose to filter on their products only
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

// test if template_switch sidebox should show
$show_template_switch=true;
$tmpl = file(DIR_WS_IMAGES . 'templates.txt');

if ($show_template_switch) {
    $template_switch_sidebox_array=array();
    foreach ($tmpl as $key => $tmplName) {
        $template_switch_sidebox_array[]=array
        (
        'id'   => str_replace("\n", '', $tmplName),
        'text' => str_replace("\n", '', $tmplName)
        );
    }
    require ($template->get_template_dir('tpl_template_switch.php', DIR_WS_TEMPLATE, $current_page_base,'sideboxes') . '/tpl_template_switch.php');
    $title = '<label>' . BOX_HEADING_TEMPLATE_SWITCH . '</label>';
    $title_link = false;
    require ($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
} 
?>