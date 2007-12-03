<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: reports_dhtml.php 6027 2007-03-21 09:11:58Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_REPORTS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_REPORTS_PRODUCTS_VIEWED, 'link' => zen_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_REPORTS_PRODUCTS_PURCHASED, 'link' => zen_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_REPORTS_ORDERS_TOTAL, 'link' => zen_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_REPORTS_PRODUCTS_LOWSTOCK, 'link' => zen_href_link(FILENAME_STATS_PRODUCTS_LOWSTOCK, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_REPORTS_CUSTOMERS_REFERRALS, 'link' => zen_href_link(FILENAME_STATS_CUSTOMERS_REFERRALS, '', 'NONSSL'));
if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/reports_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
  $za_dir->close();
}
?>
<!-- reports //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- reports_eof //-->
