<?php
/**
 * 
 * init_zca_layout.php
 *
 * @package initSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_zca_layout.php 2021-11-28 21:21:16Z webchills $
 */
 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if ( isset($_GET['layoutType']) ) { 
  $_SESSION['layoutType'] = preg_replace('/[^a-z0-9_-]/i', '', $_GET['layoutType']);
}

if (!isset($_SESSION['layoutType'])) {
  $_SESSION['layoutType'] = 'legacy';
}
