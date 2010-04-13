<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: localization_dhtml.php 6027 2007-03-21 09:11:58Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_LOCALIZATION, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_LOCALIZATION_CURRENCIES, 'link' => zen_href_link(FILENAME_CURRENCIES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_LOCALIZATION_LANGUAGES, 'link' => zen_href_link(FILENAME_LANGUAGES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_LOCALIZATION_ORDERS_STATUS, 'link' => zen_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL'));
if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/localization_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
  $za_dir->close();
}
?>
<!-- localization //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- localization_eof //-->
