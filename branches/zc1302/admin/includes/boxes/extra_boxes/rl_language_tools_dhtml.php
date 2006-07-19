<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
define('RL_LANGUAGE_BOX', 'rl_language');
define('FILENAME_RL_LANGUAGE', 'rl_language');
  $za_contents[] = array('text' => RL_LANGUAGE_BOX, 'link' => zen_href_link(FILENAME_RL_LANGUAGE, '', 'NONSSL'));
?>