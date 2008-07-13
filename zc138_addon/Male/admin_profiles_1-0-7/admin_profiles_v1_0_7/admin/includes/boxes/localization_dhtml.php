<?php
/**
 * @package admin
 * @copyright Portions 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: localization_dhtml.php - amendment for Admin Levels 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$za_contents = array();

if (menu_header_visible('Localization')=='true') {

  $za_heading = array('text' => BOX_HEADING_LOCALIZATION, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array( 'page' => FILENAME_CURRENCIES, 'box' => BOX_LOCALIZATION_CURRENCIES),
                    array( 'page' => FILENAME_LANGUAGES, 'box' => BOX_LOCALIZATION_LANGUAGES),
                    array( 'page' => FILENAME_ORDERS_STATUS, 'box' => BOX_LOCALIZATION_ORDERS_STATUS)
                  );
  foreach ($options as $key => $value)
  if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));

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
<?php
}
?>