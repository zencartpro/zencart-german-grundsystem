<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_tabular_display.php 2023-10-25 19:33:58Z webchills $

 */
$zco_notifier->notify('NOTIFY_TPL_TABULAR_DISPLAY_START', $current_page_base, $list_box_contents);

$cell_scope = (empty($cell_scope)) ? 'col' : $cell_scope;
$cell_title = (empty($cell_title)) ? 'list' : $cell_title;
?>
<div id="<?php echo 'cat' . $cPath . 'List'; ?>" class="tabTable">
<?php
foreach ($list_box_contents as $row => $cols) {
    $r_params = '';
    if (isset($list_box_contents[$row]['params'])) {
        $r_params .= ' ' . $list_box_contents[$row]['params'];
    }
?>
    <div<?php echo $r_params; ?>>
<?php
    foreach ($cols as $num => $col) {
        $c_params = '';
        $cell_type = ($row == 0) ? 'li' : 'div';
        if (isset($col['params'])) {
            $c_params .= ' ' . $col['params'];
        }
        if (!empty($col['align'])) {
            $c_params .= ' align="' . $col['align'] . '"';
        }
//        if ($cell_type == 'th') {
//            $c_params .= ' scope="' . $cell_scope . '" id="' . $cell_title . 'Cell' . $row . '-' . $num.'"';
//        }
        if (isset($col['text'])) {
            echo $col['text'] . "\n";
        }
    }
?>
    </div>
<?php
}
?>
</div>
<?php
$zco_notifier->notify('NOTIFY_TPL_TABULAR_DISPLAY_END', $current_page_base, $list_box_contents);

