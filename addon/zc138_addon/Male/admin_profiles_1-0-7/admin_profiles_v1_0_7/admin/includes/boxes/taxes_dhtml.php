<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: taxes_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (menu_header_visible('Taxes')=='true') {

  $za_heading = array();
  $za_contents = array();

  $za_heading = array('text' => BOX_HEADING_LOCATION_AND_TAXES, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array('box' => BOX_TAXES_COUNTRIES, 'page' => FILENAME_COUNTRIES),
                    array('box' => BOX_TAXES_ZONES, 'page' => FILENAME_ZONES),
                    array('box' => BOX_TAXES_GEO_ZONES, 'page' => FILENAME_GEO_ZONES),
                    array('box' => BOX_TAXES_TAX_CLASSES, 'page' => FILENAME_TAX_CLASSES),
                    array('box' => BOX_TAXES_TAX_RATES, 'page' => FILENAME_TAX_RATES)
                  );

  foreach ($options as $key => $value) {
    if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
  }

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/taxes_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }

  ?>
  <!-- taxes //-->
  <?php
  echo zen_draw_admin_box($za_heading, $za_contents);
  ?>
  <!-- taxes_eof //-->
<?php
}
?>