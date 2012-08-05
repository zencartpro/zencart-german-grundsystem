<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: navigation.php 731 2011-08-09 19:15:09Z hugo13 $
 */

?>
<ul>
  <li id="welcome">Willkommen</li>
  <li id="licenseaccept">GPL Lizenz</li>
  <li id="inspection">Systempr&uuml;fung</li>
  <li id="system">Servereinstellungen</li>
  <li id="database">Datenbankanbindung</li>
<?php if ((isset($is_upgradable) && $is_upgradable) || (isset($is_upgrade) && $is_upgrade)) { ?>
  <li id="databaseupg">Datenbank Upgrade</li>
<?php } ?>
  <li id="store">Shopkonfiguration</li>
  <li id="admin">Administrator Konto</li>
  <li id="finish">Fertigstellung</li>
</ul>
