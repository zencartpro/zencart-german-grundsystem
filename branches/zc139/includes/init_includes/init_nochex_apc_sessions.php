<?php
/**
 * nochex_apc specific session stuff
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
  $session_post = $_POST['custom'];
  $session_stuff = explode('=', $session_post);
  $apcFoundSession = true;
  if (apc_get_stored_session($session_stuff) === false) {
    apc_debug_email('APC FATAL ERROR::No saved session data available'); 
    $apcFoundSession = false;
  }
?>