<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_zen_lightbox.php 2008-12-09 aclarke $
 */

if (ZEN_LIGHTBOX_STATUS == 'true') {
  require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/slimbox.php');
  require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/autoload_default.php');
}
?>