<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tools_dhtml.php - amendment for Admin Profiles 2008-02-02 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (menu_header_visible('Tools')=='true') {

  $za_heading = array();
  $za_contents = array();

  $za_heading = array('text' => BOX_HEADING_TOOLS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

  $options = array( array('box' => BOX_TOOLS_TEMPLATE_SELECT, 'page' => FILENAME_TEMPLATE_SELECT),
                    array('box' => BOX_TOOLS_LAYOUT_CONTROLLER, 'page' => FILENAME_LAYOUT_CONTROLLER),
                    array('box' => BOX_TOOLS_BANNER_MANAGER, 'page' => FILENAME_BANNER_MANAGER),
                    array('box' => BOX_TOOLS_MAIL, 'page' => FILENAME_MAIL),
                    array('box' => BOX_TOOLS_NEWSLETTER_MANAGER, 'page' => FILENAME_NEWSLETTERS),
                    array('box' => BOX_TOOLS_SERVER_INFO, 'page' => FILENAME_SERVER_INFO),
                    array('box' => BOX_TOOLS_WHOS_ONLINE, 'page' => FILENAME_WHOS_ONLINE),
                    array('box' => BOX_TOOLS_ADMIN, 'page' => FILENAME_ADMIN),
                    array('box' => BOX_TOOLS_EMAIL_WELCOME, 'page' => FILENAME_EMAIL_WELCOME),
                    array('box' => BOX_TOOLS_STORE_MANAGER, 'page' => FILENAME_STORE_MANAGER),
                    array('box' => BOX_TOOLS_DEVELOPERS_TOOL_KIT, 'page' => FILENAME_DEVELOPERS_TOOL_KIT),
                    array('box' => BOX_TOOLS_EZPAGES, 'page' => FILENAME_EZPAGES_ADMIN),
                    array('box' => BOX_TOOLS_DEFINE_PAGES_EDITOR, 'page' => FILENAME_DEFINE_PAGES_EDITOR),
                    array('box' => BOX_TOOLS_SQLPATCH, 'page' => FILENAME_SQLPATCH)
                  );

  foreach ($options as $key => $value) {
    if (page_allowed($value['page'])=='true') $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
  }

  if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/tools_dhtml.php$/', $zv_file)) {
        require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
      }
    }
    $za_dir->close();
  }

  ?>
  <!-- tools //-->
  <?php
  echo zen_draw_admin_box($za_heading, $za_contents);
  ?>
  <!-- tools_eof //-->
<?php
}
?>
