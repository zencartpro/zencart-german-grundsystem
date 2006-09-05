<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

?>
<ul>
  <li id="welcome">Willkommen</li>
  <li id="licenseaccept">Lizenz</li>
  <li id="inspection">Voraussetzungen</li>
  <li id="system">System Setup</li>
  <li id="phpbb">phpBB Setup</li>
  <li id="database">Datenbank Setup</li>
<?php if ((isset($is_upgradable) && $is_upgradable) || (isset($is_upgrade) && $is_upgrade)) { ?>
  <li id="databaseupg">Datenbank Upgrade</li>
<?php } ?>
  <li id="store">Store Setup</li>
  <li id="admin">Admin Setup</li>
  <li id="finish">Finished</li>
</ul>
