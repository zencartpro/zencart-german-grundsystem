<?php
/**
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: SpecialsDashboardWidget.php 2021-12-28 17:56:29Z webchills $
 */

if (!zen_is_superuser() && !check_page(FILENAME_SALEMAKER, '')) return;

// to disable this module for everyone, uncomment the following "return" statement so the rest of this file is ignored
// return;

$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_SPECIALS . " WHERE status = 0", false, true, 1800);
$specials = $result->fields['count'];
$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_SPECIALS . " WHERE status = 1", false, true, 1800);
$specials_act = $result->fields['count'];
$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_FEATURED . " WHERE status = 0", false, true, 1800);
$featured = $result->fields['count'];
$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_FEATURED . " WHERE status = 1", false, true, 1800);
$featured_act = $result->fields['count'];
$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_SALEMAKER_SALES . " WHERE sale_status = 0", false, true, 1800);
$salemaker = $result->fields['count'];
$result = $db->Execute("SELECT count(*) as count FROM " . TABLE_SALEMAKER_SALES . " WHERE sale_status = 1", false, true, 1800);
$salemaker_act = $result->fields['count'];
?>

 <div class="panel panel-default reportBox">
    <div class="panel-heading header"><?php echo BOX_TITLE_FEATURES_SALES; ?></div>
    <table class="table table-striped table-condensed">
      <tr>
        <td><?php echo BOX_ENTRY_SPECIALS_EXPIRED; ?></td>
        <td class="text-right"><?php echo $specials; ?></td>
      </tr>
      <tr>
        <td><?php echo BOX_ENTRY_SPECIALS_ACTIVE; ?></td>
        <td class="text-right"><?php echo $specials_act; ?></td>
      </tr>
      <tr>
        <td><?php echo BOX_ENTRY_FEATURED_EXPIRED; ?></td>
        <td class="text-right"><?php echo $featured; ?></td>
      </tr>
      <tr>
        <td><?php echo BOX_ENTRY_FEATURED_ACTIVE; ?></td>
        <td class="text-right"><?php echo $featured_act; ?></td>
      </tr>
      <tr>
        <td><?php echo BOX_ENTRY_SALEMAKER_EXPIRED; ?></td>
        <td class="text-right"><?php echo $salemaker; ?></td>
      </tr>
      <tr>
        <td><?php echo BOX_ENTRY_SALEMAKER_ACTIVE; ?></td>
        <td class="text-right"><?php echo $salemaker_act; ?></td>
      </tr>
    </table>
  </div>
