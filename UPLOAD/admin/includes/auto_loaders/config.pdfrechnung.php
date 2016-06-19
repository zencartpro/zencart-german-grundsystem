<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.pdfrechnung.php 2016-06-19 07:19:17Z webchills $
 */
 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
} 

$autoLoadConfig[999][] = array(
  'autoType' => 'init_script',
  'loadFile' => 'init_pdfrechnung.php'
);
