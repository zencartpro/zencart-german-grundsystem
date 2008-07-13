<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_admin_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (menu_header_visible('GV_Admin')=='true') {

  $za_heading = array();
  $za_contents = array();

  $za_heading = array('text' => BOX_HEADING_GV_ADMIN, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  // don't Coupons unless installed
  if (MODULE_ORDER_TOTAL_COUPON_STATUS=='true' && page_allowed(FILENAME_COUPON_ADMIN)=='true') {
    $za_contents[] = array('text' => BOX_COUPON_ADMIN, 'link' => zen_href_link(FILENAME_COUPON_ADMIN, '', 'NONSSL'));
   } // coupons installed

  // don't Gift Vouchers unless installed
  if (MODULE_ORDER_TOTAL_GV_STATUS=='true') {
    $options = array( array('box' => BOX_GV_ADMIN_QUEUE, 'page' => FILENAME_GV_QUEUE),
                      array('box' => BOX_GV_ADMIN_MAIL, 'page' => FILENAME_GV_MAIL),
                      array('box' => BOX_GV_ADMIN_SENT, 'page' => FILENAME_GV_SENT)
                     );
    foreach ($options as $key => $value) {
      if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
    }
  }

  // if both are off display msg
  if (!defined('MODULE_ORDER_TOTAL_COUPON_STATUS') and !defined('MODULE_ORDER_TOTAL_GV_STATUS')) {
    $za_contents[] = array('text' => NOT_INSTALLED_TEXT, 'link' => '');
  } // coupons and gift vouchers not installed

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/gv_admin_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
  $za_dir->close();
  }
  ?>
  <!-- gv_admin //-->
  <?php echo zen_draw_admin_box($za_heading, $za_contents); ?>
  <!-- gv_admin_eof //-->

<?php
}
?>