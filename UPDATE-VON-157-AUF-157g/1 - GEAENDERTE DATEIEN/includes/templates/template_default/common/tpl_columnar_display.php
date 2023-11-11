<?php
/**
 * Common Template - tpl_columnar_display.php
 *
 * This file is used for generating columnar output where needed, based on the supplied array of table-cell contents.
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_columnar_display.php 2023-10-25 19:37:16Z webchills $
 */

$zco_notifier->notify('NOTIFY_TPL_COLUMNAR_DISPLAY_START', $current_page_base, $list_box_contents, $title);
?>

<div class="">

<?php if ($title) { ?>
<?php echo $title; ?>
<?php } ?>

<div class="">
<?php
if (is_array($list_box_contents)) {
    foreach ($list_box_contents as $row => $cols) {

        $r_params = 'class=""';
        if (isset($list_box_contents[$row]['params'])) {
            $r_params = $list_box_contents[$row]['params'];
        }
?>

<div <?php echo $r_params; ?>>
<?php
    foreach ($cols as $col) {
        if ($cols === 'params') {
            continue; // a $cols index named 'params' is only display-instructions ($r_params above) for the row, no data, so skip this iteration
        }

        if (!empty($col['wrap_with_classes'])) { 
            echo '<div class="' . $col['wrap_with_classes'] . '">';
        }

      $c_params = "";
      if (isset($col['params'])) $c_params .= ' ' . (string)$col['params'];
      if (isset($col['text'])) {
            echo '<div' . $c_params . '>' . $col['text'] .  '</div>';
        }

        if (!empty($col['wrap_with_classes'])) { 
            echo '</div>';
      }
      echo PHP_EOL;
    }
?>
</div>
<br class="clearBoth">

<?php
  }
}
?>
</div>
</div>

<?php $zco_notifier->notify('NOTIFY_TPL_COLUMNAR_DISPLAY_END', $current_page_base, $list_box_contents, $title);
