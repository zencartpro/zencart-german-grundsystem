<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: reports_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  $za_contents = array();
  $za_heading = array();

if (menu_header_visible('Reports')=='true') {

  $za_heading = array('text' => BOX_HEADING_REPORTS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array('box' => BOX_REPORTS_PRODUCTS_VIEWED, 'page' => FILENAME_STATS_PRODUCTS_VIEWED),
                    array('box' => BOX_REPORTS_PRODUCTS_PURCHASED, 'page' => FILENAME_STATS_PRODUCTS_PURCHASED),
                    array('box' => BOX_REPORTS_ORDERS_TOTAL, 'page' => FILENAME_STATS_CUSTOMERS),
                    array('box' => BOX_REPORTS_PRODUCTS_LOWSTOCK, 'page' => FILENAME_STATS_PRODUCTS_LOWSTOCK),
                    array('box' => BOX_REPORTS_CUSTOMERS_REFERRALS, 'page' => FILENAME_STATS_CUSTOMERS_REFERRALS)
                  );

  foreach ($options as $key => $value) {
    if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
  }

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
<?php
}
?>