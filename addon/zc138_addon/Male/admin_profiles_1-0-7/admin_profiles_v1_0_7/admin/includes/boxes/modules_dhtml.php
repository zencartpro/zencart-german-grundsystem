<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: modules_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$za_contents = array();

if (menu_header_visible('Modules')=='true') {

  $za_heading = array('text' => BOX_HEADING_MODULES, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array( 'page' => FILENAME_MODULES, 'box' => BOX_MODULES_PAYMENT, 'set' => 'set=payment'),
                    array( 'page' => FILENAME_MODULES, 'box' => BOX_MODULES_SHIPPING, 'set' => 'set=shipping'),
                    array( 'page' => FILENAME_MODULES, 'box' => BOX_MODULES_ORDER_TOTAL, 'set' => 'set=ordertotal')
                  );

  foreach ($options as $key => $value)
  if (page_allowed($value['page'].$value['set'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], $value['set'], 'NONSSL'));

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/modules_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }
  ?>

  <!-- modules //-->
  <?php
  echo zen_draw_admin_box($za_heading, $za_contents);
  ?>
  <!-- modules_eof //-->
<?php
}
?>