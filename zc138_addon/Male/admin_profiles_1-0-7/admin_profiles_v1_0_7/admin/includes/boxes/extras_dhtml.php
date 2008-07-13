<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: extras_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (menu_header_visible('Extras')=='true') {

  $za_heading = array();
  $za_contents = array();

  $za_heading = array('text' => BOX_HEADING_EXTRAS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/extras_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }

  ?>
  <!-- extras //-->
  <?php
  echo zen_draw_admin_box($za_heading, $za_contents);
  ?>
  <!-- extras_eof //-->
<?php
}
?>