<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: index_default.php 785 2011-09-20 08:13:51Z webchills $
 */

  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>
<iframe src="includes/templates/template_default/templates/ueber_zencart.html"></iframe>
<form method="post" action="index.php?main_page=license<?php echo zcInstallAddSID(); ?>">
  <input type="submit" name="submit" class="button" value="<?php echo INSTALL; ?>" />
</form>