<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: customers_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();

  if (menu_header_visible('Customers')=='true') {

  $za_heading = array();
  $za_contents = array();

  $za_heading = array('text' => BOX_HEADING_CUSTOMERS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array('box' => BOX_CUSTOMERS_CUSTOMERS, 'page' => FILENAME_CUSTOMERS),
                    array('box' => BOX_CUSTOMERS_ORDERS, 'page' => FILENAME_ORDERS),
                    array('box' => BOX_CUSTOMERS_GROUP_PRICING, 'page' => FILENAME_GROUP_PRICING),
                    array('box' => BOX_CUSTOMERS_PAYPAL, 'page' => FILENAME_PAYPAL)
                  );

  foreach ($options as $key => $value) {
    if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
  }

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/customers_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }

  ?>
  <!-- customers //-->
  <?php
  echo zen_draw_admin_box($za_heading, $za_contents);
  ?>
  <!-- customers_eof //-->
<?php
}
?>
